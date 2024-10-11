<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    const NOTSTARTED = 0;
    const INPROGRESS = 1;
    const COMPLETED = 2;

    protected $guarded = [];

    public static function allProjects()
    {
        return self::count();
    }

    public static function notStartedProjects()
    {
        return self::whereStatus(self::NOTSTARTED)->count();
    }

    public static function inprogressProjects()
    {
        return self::whereStatus(self::INPROGRESS)->count();
    }

    public static function completedProjects()
    {
        return self::whereStatus(self::COMPLETED)->count();
    }

    public static function getStats()
    {
        $data['allProjects'] = self::allProjects();
        $data['notStarted'] = self::notStartedProjects();
        $data['inprogressProjects'] = self::inprogressProjects();
        $data['completedprojects'] = self::completedProjects();
        return $data;
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class, 'project_id', 'id');
    }

    public function calculateOverallCompletionPercentage()
    {
        $totalTasks = $this->tasks->count();

        if ($totalTasks === 0) {
            return 0;
        }

        $completedTasks = $this->tasks()->where('project_tasks.status', self::COMPLETED)->count();

        return round(($completedTasks / ($totalTasks)) * 100, 2);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id() ?: 0;
        });
    }

    public function attachments()
    {
        return $this->hasMany(ProjectAttachment::class, 'project_id', 'id');
    }

    public function getSpendAmount()
    {
        $totalTaskAmount = $this->tasks()->sum('amount');
        $totalExpenseAmount = $this->tasks->flatMap(function ($task) {
            return $task->expenses;
        })->sum('amount');

        $currency = optional($this->currency)->name;

        return number_format($totalTaskAmount + $totalExpenseAmount, 2) . $currency;
    }

    public function projectType()
    {
        return $this->belongsTo(ProjectTaskType::class, 'task_type_id', 'id');
    }


    public function getBalanceAmount()
    {
        return number_format($this->budget - ($this->tasks()->sum('amount') + $this->tasks->sum(function ($task) {
            return $task->expenses()->sum('amount');
        })), 2) . optional($this->currency)->name;
    }
}
