<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class ProtocolLiaison extends Model
{
    use HasFactory, LogsActivity;

    const OFFICIAL = "Official";
    const NOTABLE = "Notable";
    const COMPANY = "Company";
    const PROJECT = "Project";
    const PROPERTY = "Property";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public static function allState()
    {
        return ProtocolLiaison::count();
    }

    public static function todayAllState()
    {
        return ProtocolLiaison::whereDate('created_at',Carbon::today()->toDateString())->count();
    }

    public static function paiChartAllData($moudleId)
    {
        return ProtocolLiaison::where('protocol_liaisontype_id',$moudleId)->count();
    }

    public static function paiCHartTodayData($moudleId)
    {
        return ProtocolLiaison::where('protocol_liaisontype_id',$moudleId)->whereDate('created_at',Carbon::today()->toDateString())->count();
    }


    protected static function booted()
    {
        // if(!hasAllPermissionsCustom()){
        //     static::addGlobalScope('filterData', function (Builder $builder) {
        //         $builder->where('user_id', Auth::id());
        //     });
        // }

    }

    public function contacts()
    {
        return $this->hasMany(ProtocolLiaisonContect::class,'protocol_liaison_id','id');
    }

    public function members()
    {
        return $this->hasMany(ProtocolLiaisonPeople::class,'protocol_liaison_id','id');
    }

    public function officialImage()
    {
        return $this->belongsTo(ProtocolLiaisonImage::class,'id','module_type_id');
    }

    public function primaryNumber()
    {
        return $this->belongsTo(ProtocolLiaisonContect::class,'id','protocol_liaison_id');
    }

    public function protocolLiaisonType()
    {
        return $this->belongsTo(ProtocolLiaisonType::class,'protocol_liaisontype_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Protocol and Liaison ".optional($this->protocolLiaisonType)->name." has been {$eventName} by ".optional(Auth::user())->full_name;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }


    public function visits()
    {
        return $this->hasMany(GuestVistor::class, 'guest_id','id');
    }
}
