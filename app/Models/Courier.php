<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Courier extends Model
{
    use HasFactory,LogsActivity;

    const ONGATE = 0;
    const HANDOVER = 1;
    const RECEIVED = 2;


    protected $guarded = [];

    public static function totalCouriers()
    {
        return Courier::count();
    }

    public static function todayCouriers()
    {
        return Courier::whereDate('created_at',Carbon::today()->toDateString())->count();
    }

    public static function totalReceivedCouriers()
    {
        return Courier::whereStatus(Courier::RECEIVED)->count();
    }

    public static function todayReceivedCouriers()
    {
        return Courier::whereStatus(Courier::RECEIVED)->whereDate('updated_at',Carbon::today()->toDateString())->count();
    }

    public static function totalPendingCouriers()
    {
        return Courier::whereStatus(Courier::ONGATE)->count();
    }

    public static function todayPendingCouriers()
    {
        return Courier::whereStatus(Courier::ONGATE)->whereDate('updated_at',Carbon::today()->toDateString())->count();
    }

    public static function totalHandoverCouriers()
    {
        return Courier::whereStatus(Courier::HANDOVER)->count();
    }

    public static function todayHandoverCouriers()
    {
        return Courier::whereStatus(Courier::HANDOVER)->whereDate('updated_at',Carbon::today()->toDateString())->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver','id');
    }
    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by','id');
    }
    public function handoverTo()
    {
        return $this->belongsTo(User::class, 'handover_to','id');
    }

    public function sender()
    {
        return $this->belongsTo(ProtocolLiaison::class, 'sender_id','id');
    }

    protected static function booted()
    {
        // if(!hasAllPermissionsCustom()){
        //     static::addGlobalScope('filterData', function (Builder $builder) {
        //         $builder->where('user_id', Auth::id());
        //     });
        // }

    }
}
