<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PurchaseOrder extends Model
{
    use HasFactory, LogsActivity;

    const REQUSITION = 0;
    const REQUSITIONAPPROVED = 1;
    const COMPARATIVE = 2;
    const COMPARATIVEAPPROVED = 3;
    const POOPEN = 4;
    const POCLOSED = 5;
    const COMPARATIVEPENDING = 6;
    const POPENDING = 7;


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function requestBy()
    {
        return $this->belongsTo(User::class, 'request_by_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    public function purchaseOrderWos()
    {
        return $this->hasMany(PurchaseOrderWo::class, 'purchase_order_id', 'id');
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function comparatives()
    {
        return $this->hasMany(Comparative::class, 'purchase_order_id', 'id');
    }

    public static function totalRequsition()
    {
        return self::whereStatus(self::REQUSITION)->orWhareStatus(self::REQUSITIONAPPROVED)->count();
    }

    public static function totalPO()
    {
        return self::whereStatus(self::POOPEN)->count();
    }

    public static function TotalPOclosted()
    {
        return self::whereStatus(self::POCLOSED)->count();
    }

    public static function totalComparatve()
    {
        return self::whereStatus(self::COMPARATIVE)->orWhareStatus(self::COMPARATIVEAPPROVED)->count();
    }

    public function attachments()
    {
        return $this->hasMany(PurchaseOrderAttachment::class, 'purchase_order_id', 'id');
    }
}
