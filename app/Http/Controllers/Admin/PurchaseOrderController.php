<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comparative;
use App\Models\DeliveryNote;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderAttachment;
use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrderWo;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Warehouse;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('All Purchase Orders');
        if ($request->ajax()) {

            $inventories = PurchaseOrder::with('user', 'vendor', 'location', 'warehouse')
                ->when($request->purchase_order_filter, function ($q) use ($request) {
                    if ($request->purchase_order_filter == 'Requisition') {
                        $q->whereStatus(PurchaseOrder::REQUSITION)->orWhere('status', PurchaseOrder::REQUSITIONAPPROVED);
                    } else if ($request->purchase_order_filter == 'Comparatives') {
                        $q->whereStatus(PurchaseOrder::COMPARATIVE)->orWhere('status', PurchaseOrder::COMPARATIVEAPPROVED);
                    } else if ($request->purchase_order_filter == 'POs') {
                        $q->whereStatus(PurchaseOrder::POOPEN)->orWhere('status', PurchaseOrder::POCLOSED);
                    }
                })->latest();

            return DataTables::of($inventories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    $status = '';
                    if ($row->status == PurchaseOrder::REQUSITION) {
                        $status = 'REQUSITION';
                    } else if ($row->status == PurchaseOrder::REQUSITIONAPPROVED) {
                        $status = 'REQUSITION';
                    } else if ($row->status == PurchaseOrder::COMPARATIVE) {
                        $status = 'COMPARATIVE';
                    } else if ($row->status == PurchaseOrder::COMPARATIVEPENDING) {
                        $status = 'COMPARATIVEPENDING';
                    } else if ($row->status == PurchaseOrder::COMPARATIVEAPPROVED) {
                        $status = 'COMPARATIVEAPPROVED';
                    } else if ($row->status == PurchaseOrder::POOPEN) {
                        $status = 'POOPEN';
                        $btn .= '<div class="d-flex justify-content-between align-items-center"><a href=' . route('purchase-orders.delivery.note.form', ['id' => $row->id]) . ' title="Delivery Note" class="btn btn-eye-icon btn-sm show"><i class="fa-solid fa-pen-to-square"></i></a> | ';
                    } else if ($row->status == PurchaseOrder::POPENDING) {
                        $status = 'POPENDING';
                    } else if ($row->status == PurchaseOrder::POCLOSED) {
                        $status = 'POCLOSED';
                    }
                    if (Auth::user()->can('View Purchase Order')) {

                        $btn .= '<a href=' . route('purchase-orders.show', ['id' => $row->id, 'status' => $status]) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }
                    if (Auth::user()->can('Upload Attachment Purchase Order')) {

                        $btn .= ' | <a href="javascript:void(0)" data-id=' . $row->id . ' data-status=' . $row->status . ' title="Add Attachments" class="btn btn-eye-icon btn-sm upload_attachment"><i class="fa fa-file"></i></a></div>';
                    }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {
                    $status = '';
                    if ($row->status == PurchaseOrder::REQUSITION) {
                        $status .= '<span class=""badge badge-danger">Requisition</span>';
                    } else if ($row->status == PurchaseOrder::REQUSITIONAPPROVED) {
                        $status .= '<span class=""badge badge-danger">Requisition Approved</span>';
                    } else if ($row->status == PurchaseOrder::COMPARATIVE) {
                        $status .= '<span class="badge badge-info">Comparative</span>';
                    } else if ($row->status == PurchaseOrder::COMPARATIVEPENDING) {
                        $status .= '<span class="badge badge-info">Comparative Pending</span>';
                    } else if ($row->status == PurchaseOrder::COMPARATIVEAPPROVED) {
                        $status .= '<span class="badge badge-info">Comparative Approved</span>';
                    } else if ($row->status == PurchaseOrder::POOPEN) {
                        $status .= '<span class="badge badge-primary">PO Open</span>';
                    } else if ($row->status == PurchaseOrder::POPENDING) {
                        $status .= '<span class="badge badge-primary">PO Pending</span>';
                    } else if ($row->status == PurchaseOrder::POCLOSED) {
                        $status .= '<span class="badge badge-danger">PO Closed</span>';
                    }
                    return $status;
                })->addColumn('image', function ($row) use ($request) {
                    return '<a href=' . $row->image_url . ' target="_blank"><img width="50" src=' . $row->image_url . ' ></a>';
                })->addColumn('unitType', function ($row) use ($request) {
                    return optional($row->unitType)->name;
                })->addColumn('created_by', function ($row) use ($request) {
                    return optional($row->user)->full_name;
                })->addColumn('inventory_type', function ($row) use ($request) {
                    if ($row->inventroy_type == 0) {
                        return 'INVENTORY';
                    } else {
                        return 'ASSET';
                    }
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }

        $data = [];

        $data['totalRequsition'] = Inventory::totalItems();
        $data['totalPO'] = Inventory::totalInventory();
        $data['totalPOclosted'] = Inventory::totalAsset();
        $data['totalComparatve'] = Inventory::totalWarehouses();

        return view('admin.inventories.purchase_orders.index', $data);
    }

    public function create()
    {
        $this->authorize('Add Requisition');

        $data['workOrders'] = WorkOrder::whereStatus(0)->get();
        $data['users'] = User::whereStatus(1)->get();
        $data['vendors'] = Vendor::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['warehouses'] = Warehouse::whereStatus(1)->get();
        $data['items'] = Inventory::whereStatus(1)->get();

        return view('admin.inventories.purchase_orders.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Requisition');

        $request->validate([
            'inspection_items.*' => ['required'],
            'qty.*' => ['required'],
            'remarks.*' => ['required'],
            // 'workorder_ids' => ['required'],
        ]);
        try {
            DB::beginTransaction();

            $requsition = PurchaseOrder::create([
                'date' => $request->date,
                'location_id' => $request->location_id,
                'request_by_id' => $request->user_id,
                'vendor_id' => $request->vendor_id,
                'warehouse_id' => $request->warehouse_id,
                'terms' => $request->term,
                'ship_via' => $request->ship_via,
                'notes' => $request->notes,
                'user_id' => Auth::id(),
            ]);

            if (!empty($request->workorder_ids)) {
                foreach ($request->workorder_ids as $id) {
                    PurchaseOrderWo::create(
                        [
                            'workorder_id' => $id,
                            'purchase_order_id' => $requsition->id,
                        ]
                    );
                }
            }


            // dd($request->all(), $request->inspection_items, count($request->inspection_items));
            for ($i = 0; $i < count($request->inspection_items); $i++) {
                // dump($request['inspection_items'][$i], $request['qty'][$i], $request['remarks'][$i], $requsition->id, $request->all());
                PurchaseOrderItem::create([
                    'item_id' => $request['inspection_items'][$i],
                    'qty' => $request['qty'][$i],
                    'remarks' => $request['remarks'][$i],
                    'purchase_order_id' => $requsition->id
                ]);
            }
            // die;


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Inventory Added Successfully',
                'url' => route('purchase-orders.index')
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'stack' => $ex
            ], 200);
        }
    }

    public function show($id, $status)
    {

        $this->authorize('View Purchase Order');

        $data = [];
        if ($status == 'REQUSITION') {
            $data['purchaseOrder'] =  PurchaseOrder::with('user', 'vendor', 'location', 'warehouse')->findorFail($id);
            $data['vendors'] = Vendor::where('status', 1)->get();
        } else if ($status == 'COMPARATIVE') {
            $data['purchaseOrder'] =  PurchaseOrder::with('user', 'vendor', 'location', 'warehouse')->findorFail($id);
            // dd($data);
            $data['vendors'] = Vendor::where('status', 1)->get();
        } else if ($status == 'COMPARATIVEPENDING' || $status == 'COMPARATIVEAPPROVED') {
            $this->authorize('Comparative Approved');

            $data['purchaseOrder'] =  PurchaseOrder::with('user', 'vendor', 'location', 'warehouse', 'comparatives', 'comparatives.vendor', 'comparatives.item')->findorFail($id);
            $data['matchingComparatives'] = Comparative::whereColumn('approved_vendor_id', '=', 'vendor_id')->where('purchase_order_id', $id)->orderBy('id', 'desc')->first();
            // $data['comparatives'] = Comparative::where('purchase_order_id', $id)
            //     ->whereColumn('approved_vendor_id', '=', 'comparatives.vendor_id') // Compare with vendor_id in the comparatives table
            //     ->get(); // Use get() to retrieve multiple matching comparatives if they exist
            // dd($data['comparatives']);
            $data['vendors'] = Vendor::where('status', 1)->get();

            $vendorCounts = Comparative::where('purchase_order_id', $id)
                ->select('vendor_id', DB::raw('COUNT(vendor_id) as count'))
                ->groupBy('vendor_id')
                ->count();

            $itemVendorIds = Comparative::where('purchase_order_id', $id)->select('item_id', 'vendor_id')
                ->distinct()
                ->get()
                ->groupBy('item_id')
                ->toArray();

            // Build an array to hold the results
            $results = [];
            $columnName = [];

            foreach ($itemVendorIds as $itemId => $vendors) {
                $itemData = Comparative::with('item')
                    ->where('item_id', $itemId)->first(); // Retrieve data for the item
                $result = [
                    'item_id' => $itemId,
                    'item_data' => $itemData,
                ];

                foreach ($vendors as $index => $vendor) {
                    $vendorId = $vendor['vendor_id'];

                    $comparative = Comparative::with('vendor')
                        ->where('item_id', $itemId)
                        ->where('vendor_id', $vendorId)
                        ->orderBy('created_at', 'desc')
                        ->first();

                    $result[$index] = [
                        'name' => $comparative->vendor->name, // Replace 'name' with the actual vendor name column
                        'price' => $comparative->item_price,
                    ];

                    $columnName[] = $comparative->vendor->name;
                }

                $results[] = $result;
            }

            $data['comparatives'] = $results;
            $data['columnName'] = array_unique($columnName);
            return view('admin.inventories.purchase_orders.reports.comparative_report', $data);
        } else if ($status == 'POOPEN' || $status == 'POPENDING' || $status == 'POCLOSED') {

            $data['purchaseOrder'] =  PurchaseOrder::with('parent', 'parent.user', 'parent.vendor', 'parent.location', 'parent.warehouse', 'parent.comparatives', 'parent.comparatives.vendor', 'parent.comparatives.item')->findorFail($id);
            $parent = $data['purchaseOrder']->parent;
            $data['parent'] = $parent;
            $data['matchingComparatives'] = Comparative::with('vendor')->whereColumn('approved_vendor_id', '=', 'vendor_id')->where('purchase_order_id', $data['purchaseOrder']->parent->id)->orderBy('id', 'desc')->first();
            $data['comparatives'] = Comparative::where('purchase_order_id', $data['purchaseOrder']->parent->id)
                ->whereColumn('approved_vendor_id', '=', 'comparatives.vendor_id') // Compare with vendor_id in the comparatives table
                ->get(); // Use get() to retrieve multiple matching comparatives if they exist

            return view('admin.inventories.purchase_orders.reports.po_open', $data);
        }

        return view('admin.inventories.purchase_orders.show', $data);
    }

    public function delete($id)
    {
        $this->authorize('Delete Purchase Order');

        Inventory::findOrFail($id)->delete();
        return redirect()->route('inventories.index')->with('success', 'Record deleted successfully');
    }

    public function purchaseOrderReport($id)
    {

        $data = [];
        $data['purchaseOrder'] =  PurchaseOrder::with('user', 'vendor', 'location', 'warehouse')->findorFail($id);
        return view('admin.inventories.purchase_orders.reports.purchase_order', $data);
    }

    public function purchaseOrderApproved($id)
    {
        $purchaseOrder =  PurchaseOrder::findorFail($id);
        $purchaseOrder->approved_by = Auth::id();
        $purchaseOrder->status = PurchaseOrder::REQUSITIONAPPROVED;
        $purchaseOrder->update();

        PurchaseOrder::create([
            'date' => $purchaseOrder->date,
            'location_id' => $purchaseOrder->location_id,
            'request_by_id' => $purchaseOrder->user_id,
            'vendor_id' => $purchaseOrder->vendor_id,
            'warehouse_id' => $purchaseOrder->warehouse_id,
            'terms' => $purchaseOrder->term,
            'ship_via' => $purchaseOrder->ship_via,
            'notes' => $purchaseOrder->notes,
            'parent_id' => $purchaseOrder->id,
            'status' => PurchaseOrder::COMPARATIVE,
            'user_id' => Auth::id(),
            'approved_by' => $purchaseOrder->approved_by
        ]);
        return redirect()->route('purchase-orders.index')->with('success', 'Approved SUccessfully');
    }

    public function storeComparative(Request $request)
    {
        try {
            DB::beginTransaction();
            $purchaseOrder = PurchaseOrder::findOrFail($request->purchaseOrderId);
            $purchaseOrder->update([
                'status' => PurchaseOrder::COMPARATIVEPENDING
            ]);

            // $po = PurchaseOrder::create([
            //     'date' => $purchaseOrder->date,
            //     'location_id' => $purchaseOrder->location_id,
            //     'request_by_id' => $purchaseOrder->user_id,
            //     'vendor_id' => $purchaseOrder->vendor_id,
            //     'warehouse_id' => $purchaseOrder->warehouse_id,
            //     'terms' => $purchaseOrder->term,
            //     'ship_via' => $purchaseOrder->ship_via,
            //     'notes' => $purchaseOrder->notes,
            //     'parent_id' => $purchaseOrder->id,
            //     'status' => PurchaseOrder::POOPEN,
            //     'user_id' => Auth::id(),
            //     'approved_by' => $purchaseOrder->approved_by
            // ]);

            foreach ($request->vendorWiseData as $comparative) {

                Comparative::create([
                    'purchase_order_id' => $request->purchaseOrderId,
                    'vendor_id' => $comparative['vendorId'],
                    'item_id' => $comparative['item_id'],
                    'sub_total' => $comparative['sub_total'],
                    'cgst' => $comparative['cgst'],
                    'cgst_amount' => $comparative['cgst_tax_amount'],
                    'total_amount' => $comparative['total_amount'],
                    'item_price' => $comparative['price'],
                    'qty' => $comparative['qty'],
                    'approved_vendor_id' => $request->approvedVendor,
                    'date' => $request->date,
                ]);
            }


            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "PO Created Successfully",
                'url' => route('purchase-orders.index')
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'stack' => $ex
            ], 500);
        }
    }

    public function poClosed(Request $request)
    {
        $this->authorize('Purchase Order Close PO');
        try {
            DB::beginTransaction();
            $quantities = $request->input('quantities');
            $purchaseOrderId = $request->input('purchaseOrderId');
            $purchaseParentOrderId = $request->input('purchaseParentOrderId');
            $oldQTY = 0;
            $receivedQTY = 0;
            foreach ($quantities as $item) {
                $itemId = $item['itemId'];
                $receivedQuantity = $item['receivedQuantity'];
                $oldQuantity = $item['oldQuantity'];

                // Find the item in your model and update its received quantity
                $itemModel = Comparative::where('item_id', $itemId)->where('purchase_order_id', $purchaseParentOrderId)->first();
                // dd($itemModel, $purchaseParentOrderId);
                // Add the new received quantity to the old quantity
                $oldQTY = $oldQuantity + $receivedQuantity;
                $receivedQTY = $oldQuantity + $receivedQuantity;

                $itemModel->received_qty = $receivedQuantity;
                $itemModel->update();

                $item = Inventory::findOrFail($itemId);

                $item->qty = $receivedQTY;
                $item->update();
            }

            if ($receivedQTY >= $oldQTY) {
                $purchaseOrder = PurchaseOrder::findOrFail($purchaseOrderId);
                $purchaseOrder->status = PurchaseOrder::POPENDING;
                $purchaseOrder->update();
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Received quantities updated successfully'
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function deliveryNoteForm($poId)
    {
        $this->authorize('Purchase Order Delivery Note');

        $data['purchaseOrder'] =  PurchaseOrder::with('parent', 'parent.user', 'parent.vendor', 'parent.location', 'parent.warehouse', 'parent.comparatives', 'parent.comparatives.vendor', 'parent.comparatives.item')->findorFail($poId);
        $parent = $data['purchaseOrder']->parent;
        $data['parent'] = $parent;
        $data['matchingComparatives'] = Comparative::with('vendor')->whereColumn('approved_vendor_id', '=', 'vendor_id')->where('purchase_order_id', $data['purchaseOrder']->parent->id)->orderBy('id', 'desc')->first();
        $data['comparatives'] = Comparative::where('purchase_order_id', $data['purchaseOrder']->parent->id)
            ->whereColumn('approved_vendor_id', '=', 'comparatives.vendor_id') // Compare with vendor_id in the comparatives table
            ->get(); // Use get() to retrieve multiple matching comparatives if they exist
        $data['users'] = User::whereStatus(1)->get();
        $totalDn = DeliveryNote::count();
        $data['DnNumber'] = 0;

        $data['deliveryNote'] = DeliveryNote::where('purchase_order_id', $data['purchaseOrder']->id)->first();

        if ($data['deliveryNote']) {
            $data['DnNumber'] =  $data['deliveryNote']->id;
        } else {
            $data['DnNumber'] = $totalDn + 1;
        }

        return view('admin.inventories.purchase_orders.delivery_note', $data);
    }

    public function getAttachment(Request $request)
    {
        $attachments = PurchaseOrderAttachment::where('purchase_order_id', $request->poId)
            ->where('purchase_order_status', $request->poStatus)
            ->get();

        return response()->json([
            'status' => true,
            'attachments' => $attachments
        ], 200);
    }
    public function uploadAttachment(Request $request)
    {
        $this->authorize('Upload Attachment Purchase Order');
        $po = PurchaseOrder::where('id', $request->purchaseOrderId)
            ->where('status', $request->purchaseOrderStatus)
            ->first();
        foreach ($request->file('files') as $file) {
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $file->move(public_path('purchase_order_images'), $fileName);
            $url = asset('/purchase_order_images/' . $fileName);

            PurchaseOrderAttachment::create([
                'file_name' => $fileName,
                'file_url' => $url,
                'file_extension' => $extension,
                'user_id' => Auth::id(),
                'purchase_order_id' => $po->id,
                'purchase_order_status' => $po->status
            ]);
        }

        Session::put('success', 'Attachment Added Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Attachment Added Successfully'
        ], 200);
    }
}
