<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use App\Models\Inventory;
use App\Models\InventoryAttachment;
use App\Models\IssueOrder;
use App\Models\ItemCategory;
use App\Models\ItemMake;
use App\Models\ItemType;
use App\Models\Location;
use App\Models\ProtocolLiaison;
use App\Models\PurchaseOrderItem;
use App\Models\UnitType;
use App\Models\Vehicle;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InventroyController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('All Inventories');
        if ($request->ajax()) {
            $inventories = Inventory::with('type', 'make', 'category', 'unitType', 'warehouse', 'location', 'user')
                ->when($request->inventory_type, function ($q) use ($request) {

                    $q->where('inventroy_type', $request->inventory_type == 'inventory' ? 0 : 1);
                })->when($request->warehouse_id, function ($q) use ($request) {
                    $q->where('warehouse_id', $request->warehouse_id);
                })->when($request->location_id, function ($q) use ($request) {
                    $q->where('location_id', $request->location_id);
                })->latest();

            return DataTables::of($inventories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View Inventories')){
                    $btn .= '<a href=' . route('inventories.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {
                    $status = '';
                    if ($row->status == 1) {
                        $status .= '<span class=""badge badge-danger">Stock Available</span>';
                    } else {
                        $status .= '<span class="badge badge-danger">Out of Stock</span>';
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
                    } elseif ($row->inventroy_type == 1) {
                        return 'ASSET';
                    } else {
                        return 'Fuel';
                    }
                })->addColumn('fuel_type', function ($row) use ($request) {
                    //    return $row->fuel_type_id;
                    return optional($row->fuelType)->name;
                    // if ($row->inventroy_type == 0) {
                    //     return 'INVENTORY';
                    // } elseif ($row->inventroy_type == 1) {
                    //     return 'ASSET';
                    // } else {
                    //     return 'Fuel';
                    // }
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }

        $data = [];
        $data['itemTypes'] = ItemType::whereStatus(1)->get();
        $data['propertise'] = ProtocolLiaison::where('protocol_liaisontype_id', 5)->get();
        $data['itemMakes'] = ItemMake::whereStatus(1)->get();
        $data['itemCategories'] = ItemCategory::whereStatus(1)->get();
        $data['UnitTypes'] = UnitType::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['warehouses'] = Warehouse::whereStatus(1)->get();
        $data['fuelTypes'] = FuelType::whereStatus(1)->get();

        $data['totalItems'] = Inventory::totalItems();
        $data['totalInventory'] = Inventory::totalInventory();
        $data['totalAsset'] = Inventory::totalAsset();
        $data['totalWarehouses'] = Inventory::totalWarehouses();

        return view('admin.inventories.inventories.index', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Inventories');

        $url = null;
        $fileName = null;
        if ($request->has('file')) {
            // $extension = $request->file->getClientOriginalExtension();
            // $fileName = rand(1, 100000) . time() . '.' . $extension;
            // $request->file->move(public_path('inventory_images'), $fileName);
            // $url = asset('/inventory_images/' . $fileName);
            $imageData = storeImage($request, 'inventory_images');
            $url = $imageData['url'];
            $fileName = $imageData['filename'];
        }

        Inventory::create([
            'item_code' => strtoupper(generateItemCode()),
            'item_number' => $request->item_number,
            'barcode' => $request->barcode,
            'item_name' => $request->item_name,
            'description' => $request->description,
            'item_type_id' => $request->item_type_id ?: 0,
            'make_id' => $request->item_make_id ?: 0,
            'category_id' => $request->item_category_id ?: 0,
            'unit_type_id' => $request->unit_type_id ?: 0,
            'upc' => $request->upc,
            'unit_cost' => $request->unit,
            'room_number' => $request->room_number,
            'qty' => $request->qty,
            'bin' => $request->bin,
            'warehouse_id' => $request->warehouse_id ?: 0,
            'location_id' => $request->location_id ?: 0,
            'is_expiry_available' => $request->is_expiry_available ?: 0,
            'is_warranty_available' => $request->is_warranty_available ?: 0,
            'expiry_date' => $request->expiry,
            'warranty_date' => $request->warranty,
            'warranty_notes' => $request->warranty_notes,
            'notes' => $request->notes,
            'user_id' => Auth::id(),
            'image_name' => $fileName,
            'image_url' => $url,
            'inventroy_type' => $request->inventory_type,
            'fuel_type_id' => $request->fuel_type_id ?: 0,
            'property_id' => $request->inventory_type == 1 ? $request->property_id : 0,
            'status' => $request->qty > 0 ? 1 : 0
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Inventory Added Successfully',
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('View Inventories');

        $data = [];
        $data['inventory'] = Inventory::with('property', 'type', 'make', 'category', 'unitType', 'warehouse', 'location')->findorFail($id);
        $data['itemTypes'] = ItemType::whereStatus(1)->get();
        $data['itemMakes'] = ItemMake::whereStatus(1)->get();
        $data['itemCategories'] = ItemCategory::whereStatus(1)->get();
        $data['UnitTypes'] = UnitType::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['propertise'] = ProtocolLiaison::where('protocol_liaisontype_id', 5)->get();
        $data['warehouses'] = Warehouse::whereStatus(1)->get();
        $data['propertise'] = ProtocolLiaison::where('protocol_liaisontype_id', 5)->get();
        $data['fuelTypes'] = FuelType::whereStatus(1)->get();

        $timelineData = [];
        $purchaseTimeline = PurchaseOrderItem::where('item_id', $data['inventory']->id)->get();
        $index = 0;
        foreach ($purchaseTimeline as $po) {
            $timelineData[$index]['date'] = Carbon::parse($po->created_at)->toDateTimeString();
            $timelineData[$index]['description'] = 'Received against PO#- ' . $po->purchase_order_id;
            $timelineData[$index]['user'] = optional(optional($po->purchaseOrder)->user)->full_name;
            $index++;
        }

        $issueTimeline = IssueOrder::where('item_id', $data['inventory']->id)->get();
        foreach ($issueTimeline as $io) {
            $timelineData[$index]['date'] = Carbon::parse($io->created_at)->toDateTimeString();
            $timelineData[$index]['description'] = 'Issue against to (' . optional(optional($io->invoice)->issueBy)->full_name . ') Issue Order#- ' . $io->invoice_id;
            $timelineData[$index]['user'] = optional(optional($io->invoice)->requestBy)->full_name;
            $index++;
        }
        $data['timelineData'] = $timelineData;


        return view('admin.inventories.inventories.show', $data);
    }


    public function storeAttachment(Request $request)
    {
        $this->authorize('Upload Attachment Inventories');

        $attachment = $request->file;
        $extension = $attachment->getClientOriginalExtension();
        $fileName = rand(1, 100000) . time() . '.' . $extension;
        $attachment->move(public_path('inventory_attachments'), $fileName);
        $url = asset('/inventory_attachments/' . $fileName);

        InventoryAttachment::create([
            'file_name' => $request->file_name,
            'file_extension' => $extension,
            'file_url' => $url,
            'user_id' => Auth::id(),
            'inventory_id' => $request->id,
        ]);
        Session::put('success', 'Attachment Added Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Attachment added'
        ], 200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Inventories');

        $inventory = Inventory::with('property', 'type', 'make', 'category', 'unitType', 'warehouse', 'location')->findorFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Recored Fatched',
            'inventory' => $inventory
        ], 200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Inventories');

        $inventory = Inventory::findOrFail($request->id);
        $url = null;
        $fileName = null;
        if ($request->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->file->move(public_path('inventory_images'), $fileName);
            $url = asset('/inventory_images/' . $fileName);
        }

        $inventory->update([
            'item_code' => strtoupper(generateItemCode()),
            'item_number' => $request->item_number,
            'barcode' => $request->barcode,
            'item_name' => $request->item_name,
            'description' => $request->description,
            'item_type_id' => $request->item_type_id ?: 0,
            'make_id' => $request->item_make_id ?: 0,
            'category_id' => $request->item_category_id ?: 0,
            'unit_type_id' => $request->unit_type_id ?: 0,
            'upc' => $request->upc,
            'unit_cost' => $request->unit,
            'qty' => $request->qty,
            'bin' => $request->bin,
            'warehouse_id' => $request->warehouse_id ?: 0,
            'location_id' => $request->location_id ?: 0,
            'is_expiry_available' => $request->is_expiry_available ?: 0,
            'is_warranty_available' => $request->is_warranty_available ?: 0,
            'expiry_date' => $request->expiry,
            'warranty_date' => $request->warranty,
            'room_number' => $request->room_number,
            'warranty_notes' => $request->warranty_notes,
            'notes' => $request->notes,
            'user_id' => Auth::id(),
            'image_name' => $fileName,
            'image_url' => $url ? $url : $inventory->image_url,
            'inventroy_type' => $request->inventory_type,
            'fuel_type_id' => $request->fuel_type_id ?: 0,
            'property_id' => $request->inventory_type == 1 ? $request->property_id : 0,
            'status' => $request->qty > 0 ? 1 : 0
        ]);

        Session::put('success', 'Inventory Update Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Inventory Update Successfully'
        ], 200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Inventories');

        Inventory::findOrFail($id)->delete();
        return redirect()->route('inventories.index')->with('success', 'Record deleted successfully');
    }
}
