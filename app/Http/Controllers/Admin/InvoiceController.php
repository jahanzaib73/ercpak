<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comparative;
use App\Models\CostCenter;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\IssueOrder;
use App\Models\Location;
use App\Models\PurchaseOrder;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $invoices = Invoice::with('requestBy', 'issueBy', 'location', 'warehouse', 'costCenter', 'purchaseOrder', 'Workorder')->latest();

            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    $type = '';
                    if ($row->is_purchase_order) {
                        $type = 'PO';
                    } elseif ($row->is_work_order) {
                        $type = 'WO';
                    }
                    // if (Auth::user()->can('View Meeting')){
                    $btn .= '<a href=' . route('trips.show', $row->id) . ' title="Print Preview" class="btn btn-info btn-sm show"><i class="fa fa-print"></i></a>';
                    $btn .= ' | <a href=' . route('invoices.detail.form', ['id' => $row->id, 'type' => $type]) . ' title="Add Invoice Detail" class="btn btn-info btn-sm show"><i class="fa  fa-info-circle"></i></a>';
                    // }
                    return $btn;
                })->addColumn('trip_status', function ($row) use ($request) {

                    $status = '';
                    // if ($row->status == Trip::OPEN) {
                    //     $status = '<span class="badge badge-primary">Trip Open</span>';
                    // } else if ($row->status == Trip::CLOSED) {
                    //     $status = '<span class="badge badge-info">Closed</span>';
                    // } else if ($row->status == Trip::CANCELLED) {
                    //     $status = '<span class="badge badge-danger">Cancelled</span>';
                    // }

                    return $status;
                })->addColumn('costCenter', function ($row) use ($request) {
                    return optional($row->costCenter)->title;
                })->addColumn('is_purchase_order', function ($row) use ($request) {
                    return $row->is_purchase_order ? '<span class=""badge badge-danger">Yes</span>' : '<span class="badge badge-danger">No</span>';
                })->addColumn('is_work_order', function ($row) use ($request) {
                    return $row->is_work_order ? '<span class=""badge badge-danger">Yes</span>' : '<span class="badge badge-danger">No</span>';
                })->addColumn('request_by', function ($row) use ($request) {
                    return optional($row->requestBy)->full_name;
                })->addColumn('issue_by', function ($row) use ($request) {
                    return optional($row->issueBy)->full_name;
                })
                ->rawColumns(['action', 'status', 'costCenter', 'is_purchase_order', 'is_work_order'])
                ->make(true);
        }

        $data = [];

        return view('admin.inventories.issue_orders.index', $data);
    }

    public function create()
    {
        $data['users'] = User::whereStatus(1)->get();
        $data['warehouses'] = Warehouse::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['costcenters'] = CostCenter::whereStatus(1)->get();
        $data['workorders'] = WorkOrder::all();
        $data['po'] = PurchaseOrder::whereStatus(4)->get();
        return view('admin.inventories.issue_orders.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'date' => 'required|date',
            'request_by' => 'required',
            'issued_by' => 'required',
            'warehouse_id' => 'required',
            'location_id' => 'required',
            'cost_center_id' => 'required',
            'purchase_order_id' => 'required_if:is_po,on',
            'work_order_id' => 'required_if:is_wo,on',
        ]);

        Invoice::create([
            "date" => $request->date,
            "request_by" => $request->request_by,
            "is_purchase_order" => (isset($request->is_po) && $request->is_po == "on") ? 1 : 0,
            "purchase_order_id" => $request->purchase_order_id ?: 0,
            "is_work_order" => (isset($request->is_wo) && $request->is_wo == "on") ? 1 : 0,
            "work_order_id" => $request->work_order_id ?: 0,
            "issue_by" => $request->issued_by,
            "warehouse_id" => $request->warehouse_id,
            "location_id" => $request->location_id,
            "cost_center_id" => $request->cost_center_id,
            "notes" => $request->note
        ]);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');
    }

    public function invoiceDetailForm($id, $type)
    {
        $data['invoice'] = Invoice::with('requestBy', 'issueBy', 'location', 'warehouse', 'costCenter', 'purchaseOrder', 'Workorder')->findOrFail($id);
        $data['users'] = User::whereStatus(1)->get();
        if ($type == "PO") {
            $data['purchaseOrder'] =  PurchaseOrder::with('parent', 'parent.user', 'parent.vendor', 'parent.location', 'parent.warehouse', 'parent.comparatives', 'parent.comparatives.vendor', 'parent.comparatives.item')->findorFail($data['invoice']->purchase_order_id);
            $parent = $data['purchaseOrder']->parent;
            $data['comparatives'] = Comparative::where('purchase_order_id', $data['purchaseOrder']->parent->id)
                ->whereColumn('approved_vendor_id', '=', 'comparatives.vendor_id') // Compare with vendor_id in the comparatives table
                ->get();
            return view('admin.inventories.issue_orders.invoices.po_invoice', $data);
        } elseif ($type == "WO") {
            $data['items'] = optional($data['invoice']->Workorder)->items;
            return view('admin.inventories.issue_orders.invoices.wo_invoice', $data);
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function issueOrderPoStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $purchaseOrder = PurchaseOrder::findOrFail($request->po_id);
            $purchaseOrderParant = $purchaseOrder->parent;

            $productData = [];
            foreach ($data as $key => $value) {
                if (preg_match('/^item_(\d+)$/i', $key, $matches)) {
                    $productID = $matches[1];
                    $productData[$productID] = $value;
                }
            }
            foreach ($productData as $id => $qty) {

                $itemModel = Comparative::where('item_id', $id)->whereColumn('approved_vendor_id', '=', 'comparatives.vendor_id')->where('purchase_order_id', $purchaseOrderParant->id)->first();
                $itemModel->qty = $itemModel->qty - $qty;
                $itemModel->update();

                $item = Inventory::findOrFail($id);
                $item->qty = $item->qty - $qty;
                $item->update();

                IssueOrder::updateOrCreate([
                    'invoice_id'   => $request->invoice_id,
                    'po_id'   => $request->po_id,
                    'item_id' => $id
                ], [
                    'invoice_id' => $request->invoice_id,
                    'item_id' => $id,
                    'po_id' => $request->po_id,
                    'recommanded_by' => $request->recommended_by,
                    'approved_by' => $request->approved_by,
                    'issued_qty' => $qty,
                    'special_notes' => $request->special_notes,
                ]);
            }
            DB::commit();
            Session::put('success', 'Order Issue Success');
            return response()->json([
                'status' => true,
                'message' => 'Order Issue Success',
                'url' => route('invoices.index')
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'stack' => $exception
            ], 200);
        }
    }

    public function issueOrderWoStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            $purchaseOrder = WorkOrder::findOrFail($request->wo_id);
            // dd($request->all());
            $productData = [];
            foreach ($data as $key => $value) {
                if (preg_match('/^item_(\d+)$/i', $key, $matches)) {
                    $productID = $matches[1];
                    $productData[$productID] = $value;
                }
            }

            foreach ($productData as $id => $qty) {
                $item = Inventory::findOrFail($id);

                $item->qty = $item->qty - $qty;
                $item->update();

                $issueOrder = IssueOrder::updateOrCreate([
                    'invoice_id'   => $request->invoice_id,
                    'wo_id' => $request->wo_id,
                    'item_id' => $id
                ], [
                    'invoice_id' => $request->invoice_id,
                    'item_id' => $id,
                    'wo_id' => $request->wo_id,
                    'recommanded_by' => $request->recommended_by,
                    'approved_by' => $request->approved_by,
                    'issued_qty' => $qty,
                    'special_notes' => $request->special_notes,
                ]);
            }
            DB::commit();
            Session::put('success', 'Order Issue Success');
            return response()->json([
                'status' => true,
                'message' => 'Order Issue Success',
                'url' => route('invoices.index')
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'stack' => $exception
            ], 200);
        }
    }
}
