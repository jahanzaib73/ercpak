<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Inventory extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id', 'id');
    }
    public function make()
    {
        return $this->belongsTo(ItemMake::class, 'make_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id', 'id');
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class, 'unit_type_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function property()
    {
        return $this->belongsTo(ProtocolLiaison::class, 'property_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(InventoryAttachment::class, 'inventory_id', 'id');
    }

    public static function totalItems()
    {
        return self::count();
    }

    public static function totalInventory()
    {
        return self::where('inventroy_type', 0)->count();
    }

    public static function totalAsset()
    {
        return self::where('inventroy_type', 1)->count();
    }

    public static function totalWarehouses()
    {
        return Warehouse::whereStatus(1)->count();
    }

    public function purchaseOrderItem()
    {
        return $this->belongsTo(PurchaseOrderItem::class, 'item_id', 'id');
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id', 'id');
    }
}
