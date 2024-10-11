<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProjectTask extends Model
{
    use HasFactory;

    const NOTSTARTED = 0;
    const INPROGRESS = 1;
    const COMPLETED = 2;

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doneBy()
    {
        return $this->belongsTo(User::class, 'done_by', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public static function allTasks()
    {
        return self::count();
    }

    public static function notStartedTasks()
    {
        return self::whereStatus(self::NOTSTARTED)->count();
    }

    public static function inprogressTasks()
    {
        return self::whereStatus(self::INPROGRESS)->count();
    }

    public static function completedTasks()
    {
        return self::whereStatus(self::COMPLETED)->count();
    }

    public static function getStats()
    {
        $data['allTasks'] = self::allTasks();
        $data['notStartedTasks'] = self::notStartedTasks();
        $data['inprogressTasks'] = self::inprogressTasks();
        $data['completedTasks'] = self::completedTasks();
        return $data;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id() ?: 0;
        });
    }

    public function members()
    {
        return $this->hasMany(ProjectTaskMember::class, 'task_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'task_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(ProjectTaskAttachment::class, 'task_id', 'id');
    }
}
