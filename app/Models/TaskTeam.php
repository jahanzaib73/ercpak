<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTeam extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id','assigned_user_id');
    }

    public function task()
    {
        return $this->hasOne(Task::class, 'id','task_id');
    }
}
