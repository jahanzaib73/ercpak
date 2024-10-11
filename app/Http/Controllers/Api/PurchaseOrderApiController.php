<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use App\Models\Comparative;
use App\Models\Inventory;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderApiController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('user', 'vendor', 'location', 'warehouse', 'requestBy')->get();
        $response = PurchaseOrderResource::collection($purchaseOrders);
        return response()->json(['purchaseOrders' => $response], 200);
    }

    public function show($id, $status)
    {

        $data = [];
        if ($status == 'REQUSITION' || $status == 'COMPARATIVE') {
            $data['purchaseOrder'] =  PurchaseOrder::with('user', 'vendor', 'location', 'warehouse', 'purchaseOrderItems.item', 'purchaseOrderItems.item.unitType', 'requestBy')->findorFail($id);
        } else if ($status == 'COMPARATIVEPENDING' || $status == 'COMPARATIVEAPPROVED') {
            $data['purchaseOrder'] =  PurchaseOrder::with('user', 'vendor', 'location', 'warehouse', 'purchaseOrderItems.item', 'purchaseOrderItems.item.unitType', 'requestBy', 'comparatives', 'comparatives.vendor', 'comparatives.item')->findorFail($id);
            $data['matchingComparatives'] = Comparative::whereColumn('approved_vendor_id', '=', 'vendor_id')->where('purchase_order_id', $id)->orderBy('id', 'desc')->first();

            $itemVendorIds = Comparative::where('purchase_order_id', $id)->select('item_id', 'vendor_id')
                ->distinct()
                ->get()
                ->groupBy('item_id')
                ->toArray();

            // Build an array to hold the results
            $results = [];
            $columnName = [];

            foreach ($itemVendorIds as $itemId => $vendors) {
                $itemData = Comparative::with('item.unitType')
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

                    $result['vendorPrices'][] = [
                        'name' => $comparative->vendor->name, // Replace 'name' with the actual vendor name column
                        'price' => $comparative->item_price,
                        'approved' => $comparative->id == $data['matchingComparatives']->id ? true : false,
                    ];
                }

                $results[] = $result;
            }

            $data['comparatives'] = $results;
            return response()->json(['data' => $data], 200);
        } else if ($status == 'POOPEN' || $status == 'POPENDING' ||  $status == 'POCLOSED') {

            $data['purchaseOrder'] =  PurchaseOrder::with('vendor', 'location', 'warehouse', 'purchaseOrderItems.item', 'purchaseOrderItems.item.unitType', 'requestBy', 'parent', 'parent.user', 'parent.vendor', 'parent.location', 'parent.warehouse', 'parent.comparatives', 'parent.comparatives.vendor', 'parent.comparatives.item')->findorFail($id);
            $parent = $data['purchaseOrder']->parent;
            $data['parent'] = $parent;
            $data['matchingComparatives'] = Comparative::with('vendor')->whereColumn('approved_vendor_id', '=', 'vendor_id')->where('purchase_order_id', $data['purchaseOrder']->parent->id)->orderBy('id', 'desc')->first();
            $data['comparatives'] = Comparative::with('item.unitType:id,name')->where('purchase_order_id', $data['purchaseOrder']->parent->id)
                ->whereColumn('approved_vendor_id', '=', 'comparatives.vendor_id') // Compare with vendor_id in the comparatives table
                ->get(); // Use get() to retrieve multiple matching comparatives if they exist

            return response()->json(['data' => $data], 200);
        }

        return response()->json(['data' => $data], 200);
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
        return response()->json(['success' => true, 'message' => 'Approved Successfully'], 200);
    }

    public function approvedComparative($id)
    {
        try {
            DB::beginTransaction();
            $purchaseOrder = PurchaseOrder::findOrFail($id);
            if ($purchaseOrder->status == PurchaseOrder::COMPARATIVEPENDING) {
                $purchaseOrder->update([
                    'status' => PurchaseOrder::COMPARATIVEAPPROVED,
                ]);

                $po = PurchaseOrder::create([
                    'date' => $purchaseOrder->date,
                    'location_id' => $purchaseOrder->location_id,
                    'request_by_id' => $purchaseOrder->user_id,
                    'vendor_id' => $purchaseOrder->vendor_id,
                    'warehouse_id' => $purchaseOrder->warehouse_id,
                    'terms' => $purchaseOrder->term,
                    'ship_via' => $purchaseOrder->ship_via,
                    'notes' => $purchaseOrder->notes,
                    'parent_id' => $purchaseOrder->id,
                    'status' => PurchaseOrder::POOPEN,
                    'user_id' => Auth::id(),
                    'approved_by' => $purchaseOrder->approved_by
                ]);
                $message = "Comparative Approved Successfully";
            } else {
                $message = "Comparative Not Pending!";
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $message,
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'stack' => $ex
            ], 500);
        }
    }

    public function poClosed($id)
    {
        try {
            DB::beginTransaction();
            $purchaseOrder = PurchaseOrder::findOrFail($id);
            if ($purchaseOrder->status == PurchaseOrder::POPENDING) {
                $purchaseOrder->status = PurchaseOrder::POCLOSED;
                $purchaseOrder->update();
                $message = "Purchase Order Closed Successfully";
            } else {
                $message = "Purchase Order Not Pending!";
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $message,
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'stack' => $ex
            ], 500);
        }
    }
}
