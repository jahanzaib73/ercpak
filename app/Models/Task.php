<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use HasFactory,LogsActivity;

    const PENDING = 0;
    const INPROGRESS = 1;
    const COMPLETED = 2;
    const CANCELED = 3;
    const APPROVED = 4;

    protected $guarded = [];

    public static function totalTasks()
    {
        return Task::count();
    }

    public static function todayTasks()
    {
        return Task::whereDate('created_at',Carbon::today()->toDateString())->count();
    }

    public static function totalCompletedTasks()
    {
        return Task::whereStatus(Task::APPROVED)->count();
    }

    public static function todayCompletedTasks()
    {
        return Task::whereStatus(Task::APPROVED)->whereDate('updated_at',Carbon::today()->toDateString())->count();
    }

    public static function totalPendingTasks()
    {
        return Task::whereStatus(Task::PENDING)->count();
    }

    public static function todayPendingTasks()
    {
        return Task::whereStatus(Task::PENDING)->whereDate('updated_at',Carbon::today()->toDateString())->count();
    }

    public static function totalCancelledTasks()
    {
        return Task::whereStatus(Task::CANCELED)->count();
    }

    public static function todayCancelledTasks()
    {
        return Task::whereStatus(Task::CANCELED)->whereDate('updated_at',Carbon::today()->toDateString())->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function taskCategory()
    {
        return $this->belongsTo(TaskCategory::class,'task_category_id','id');
    }

    public function taskOwner()
    {
        return $this->belongsTo(User::class,'task_owner_id','id');
    }

    protected static function booted()
    {
        if(!isSuperAdmin()){
            static::addGlobalScope('filterData', function (Builder $builder) {
                $tasksId = TaskTeam::where('assigned_user_id',Auth::id())->pluck('task_id');
                $builder->whereIn('id', $tasksId)->orWhere('user_id',Auth::user()->id);
            });
        }

    }

     // Customize log description
     public function getDescriptionForEvent(string $eventName): string
     {
         return "Task has been {$eventName} by ".optional(Auth::user())->full_name;
     }

     public function taskMembersIds()
     {
         return $this->hasMany(TaskTeam::class, 'task_id','id');
     }

     public function documentControls()
     {
         return $this->hasMany(DocumentControl::class, 'task_id','id');
     }
}
