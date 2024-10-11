<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class Vehicle extends Authenticatable
{
    use HasFactory,LogsActivity, HasApiTokens;

    const OUTOFSERVICE = 0;
    const AVAILABLE = 1;
    const UNAVAILABLE = 2;
    const ONMOVE = 3;
    const ONWORKSHOP = 4;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

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

    public static function allVehicles(){
        return self::count();
    }

    public static function onMove(){
        return self::whereStatus(self::ONMOVE)->count();
    }

    public static function onWorkshop(){
        return self::whereStatus(self::ONWORKSHOP)->count();
    }

    public static function outOfService(){
        return self::whereStatus(self::OUTOFSERVICE)->count();
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id','id');
    }

    public function make()
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id','id');
    }

    public function type()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id','id');
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id','id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id','id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id','id');
    }

    public function attachments()
    {
        return $this->hasMany(VehicleAttachment::class, 'vehicle_id','id');
    }

    public function activeTrip()
    {
        return $this->hasMany(Trip::class, 'vehicle_id', 'id')->where('status', 0);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'vehicle_id', 'id');
    }
}
