<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comparative;
use App\Models\DeliveryNote;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryNoteController extends Controller
{
    public function storeDeliveryNoteForPO(Request $request)
    {

        try {
            DB::beginTransaction();

            $purchaseOrder = PurchaseOrder::findOrFail($request->po_id);

            $delivery = DeliveryNote::where('purchase_order_id', $purchaseOrder->id)->first();
            if ($delivery) {
                $delivery->update([
                    'notes' => $request->notes_for_company,
                    'date' => $request->date,
                    'purchase_order_id' => $purchaseOrder->id,
                    'dispatched_by' => $request->dispatched_by,
                    'checked_by' => $request->checked_by,
                    'received_by' => $request->received_by,
                ]);
            } else {
                DeliveryNote::create([
                    'notes' => $request->notes_for_company,
                    'date' => $request->date,
                    'purchase_order_id' => $purchaseOrder->id,
                    'dispatched_by' => $request->dispatched_by,
                    'checked_by' => $request->checked_by,
                    'received_by' => $request->received_by,
                ]);
            }



            // Initialize an empty associative array to store the extracted data
            $productData = [];
            $data = $request->all();
            $purchaseOrderParant = $purchaseOrder->parent;
            // Loop through the payload
            foreach ($data as $key => $value) {
                // Use a regular expression to check if the key follows the pattern "item_N"
                if (preg_match('/^item_(\d+)$/i', $key, $matches)) {
                    // Extract the product ID from the key
                    $productID = $matches[1];
                    // Assign the product ID as the key and the value as the value in the associative array
                    $productData[$productID] = $value;

                    $itemModel = Comparative::where('item_id', $productID)->whereColumn('approved_vendor_id', '=', 'comparatives.vendor_id')->where('purchase_order_id', $purchaseOrderParant->id)->first();
                    // dd($itemModel);
                    $itemModel->delivery_note_qty = $value;
                    $itemModel->update();
                }
            }

            // Now, $productData contains the product IDs as keys and their associated values
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Delivery Note Added',
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            // dd($ex);
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'stack' => $ex
            ], $ex->getCode() ?: 500);
        }
    }
}
