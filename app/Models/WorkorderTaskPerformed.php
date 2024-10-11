<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkorderTaskPerformed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(TaskWorkOrder::class, 'task_id','id');
    }
}
