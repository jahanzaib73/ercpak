<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderWo extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class, 'workorder_id', 'id');
    }
}
