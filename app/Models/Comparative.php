<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparative extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Inventory::class, 'item_id', 'id');
    }

    public function purchaseOrderItem()
    {
        return $this->belongsTo(PurchaseOrderItem::class, 'purchase_order_id', 'purchase_order_id');
    }
}
