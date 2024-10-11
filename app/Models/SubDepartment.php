<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubDepartment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // protected static function booted()
    // {
    //     if(!isSuperAdmin()){
    //         static::addGlobalScope('filterData', function (Builder $builder) {
    //             $builder->where('user_id', Auth::id());
    //         });
    //     }

    // }

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Department has been {$eventName} by " . optional(Auth::user())->full_name;
    }
}
