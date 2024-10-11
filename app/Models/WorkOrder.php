<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WorkOrder extends Model
{
    use HasFactory, LogsActivity;

    const OPEN = 0;
    const CLOSED = 1;
    const PENDING = 2;

    protected $guarded = [];
    public function inspection()
    {
        return $this->belongsTo(Inspection::class, 'inspection_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(WorkorderAttachment::class, 'work_order_id', 'id');
    }

    public function taskPerformed()
    {
        return $this->hasMany(WorkorderTaskPerformed::class, 'work_order_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(WorkOrderItem::class, 'workorder_id', 'id');
    }
}
