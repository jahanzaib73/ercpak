<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class MeetingHostParticipant extends Model
{
    use HasFactory;
    // use HasFactory,LogsActivity;
    protected $guarded = [];

    public function officialNotable()
    {
        return $this->belongsTo(ProtocolLiaison::class, 'member_id','id');
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
        return $this->belongsTo(User::class,'user_id','id');
    }

    protected static function booted()
    {
        if(!isSuperAdmin()){
            static::addGlobalScope('filterData', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            });
        }

    }

    // // Customize log description
    // public function getDescriptionForEvent(string $eventName): string
    // {
    //     return "Meeting Host has been {$eventName} by ".optional(Auth::user())->full_name;
    // }
}
