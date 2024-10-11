<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class FlightCargo extends Model
{
    use HasFactory, LogsActivity;
    protected $guarded = [];

    public function flightCargoType()
    {
        return $this->belongsTo(FlightCargoType::class,'flight_cargo_type_id','id');
    }

    public function flightType()
    {
        return $this->belongsTo(FlightType::class,'flight_type_id','id');
    }

    public function aircraft()
    {
        return $this->belongsTo(AircraftVessel::class,'aircraft_vessel_id','id');
    }



    public static function allState()
    {
        return FlightCargo::count();
    }

    public static function todayAllState()
    {
        return FlightCargo::whereDate('created_at',Carbon::today()->toDateString())->count();
    }

    public static function paiChartAllData($moudleId)
    {
        return FlightCargo::where('flight_cargo_type_id',$moudleId)->count();
    }

    public static function paiCHartTodayData($moudleId)
    {
        return FlightCargo::where('flight_cargo_type_id',$moudleId)->whereDate('created_at',Carbon::today()->toDateString())->count();
    }


    protected static function booted()
    {
        if(!isSuperAdmin()){
            static::addGlobalScope('filterData', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            });
        }

    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {

        return "Flight and Cargo ".optional($this->flightCargoType)->name." has been {$eventName} by ".optional(Auth::user())->full_name;
    }
}
