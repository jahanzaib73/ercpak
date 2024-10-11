<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Models\IssueOrder;
use App\Models\ItemCategory;
use App\Models\Location;
use App\Models\PurchaseOrderItem;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryApiController extends Controller
{
    public function index() {
        $inventories = Inventory::with('type', 'make', 'category', 'unitType', 'warehouse', 'location', 'user')->get();
        $warehouses = Warehouse::whereStatus(1)->get();
        $locations = Location::whereStatus(1)->get();
        $itemCategories = ItemCategory::whereStatus(1)->get();
        $inventoryResources = InventoryResource::collection($inventories);
        return response()->json([
            'inventories' => $inventoryResources,
            'warehouses'=> $warehouses,
            'locations'=> $locations,
            'itemCategories'=> $itemCategories
        ]);
    }

    public function show($id)
    {
        $data = [];
        $data['inventory'] = Inventory::with('property', 'type', 'make', 'category', 'unitType', 'warehouse', 'location')->findorFail($id);

        $timelineData = [];
        $purchaseTimeline = PurchaseOrderItem::where('item_id', $data['inventory']->id)->get();
        $index = 0;
        foreach ($purchaseTimeline as $po) {
            $timelineData[$index]['date'] = Carbon::parse($po->created_at)->toDateTimeString();
            $timelineData[$index]['has_status'] = '1';
            $timelineData[$index]['description'] = 'Received against PO#- ' . $po->purchase_order_id;
            $timelineData[$index]['user'] = optional(optional($po->purchaseOrder)->user)->full_name;
            $index++;
        }

        $issueTimeline = IssueOrder::where('item_id', $data['inventory']->id)->get();
        foreach ($issueTimeline as $io) {
            $timelineData[$index]['date'] = Carbon::parse($io->created_at)->toDateTimeString();
            $timelineData[$index]['has_status'] = '2';
            $timelineData[$index]['description'] = 'Issue against to (' . optional(optional($io->invoice)->issueBy)->full_name . ') Issue Order#- ' . $io->invoice_id;
            $timelineData[$index]['user'] = optional(optional($io->invoice)->requestBy)->full_name;
            $index++;
        }
        $data['timelineData'] = $timelineData;
        
        return response()->json($data);
    }
}
