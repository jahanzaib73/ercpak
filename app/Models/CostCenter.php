<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;
class CostCenter extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id() ? Auth::id() : 1;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

     // Customize log description
     public function getDescriptionForEvent(string $eventName): string
     {
         return "Cost Center has been {$eventName} by ".optional(Auth::user())->full_name;
     }
}
