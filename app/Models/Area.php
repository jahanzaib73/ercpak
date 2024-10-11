<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Area extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedAreas()
    {
        return $this->hasMany(AssignedArea::class);
    }

    public function getSignleAssignArea()
    {
        return $this->belongsTo(AssignedArea::class, 'id', 'area_id');
    }

    public function photos()
    {
        return $this->hasMany(AreaAttachment::class, 'area_id', 'id');
    }
}
