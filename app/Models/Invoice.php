<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function requestBy()
    {
        return $this->belongsTo(User::class, 'request_by', 'id');
    }

    public function issueBy()
    {
        return $this->belongsTo(User::class, 'issue_by', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id', 'id');
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id', 'id');
    }

    public function Workorder()
    {
        return $this->belongsTo(WorkOrder::class, 'work_order_id', 'id');
    }
}
