<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTaskMember extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
    public function task()
    {
        return $this->belongsTo(ProjectTask::class, 'task_id', 'id');
    }
}
