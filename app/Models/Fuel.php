<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Fuel extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function official()
    {
        return $this->belongsTo(User::class, 'official_id', 'id');
    }

    public function fuelMan()
    {
        return $this->belongsTo(User::class, 'fuel_man_id', 'id');
    }


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id', 'id');
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id', 'id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(FuelAttachment::class, 'fuel_id','id');
    }

    public static function getQtyPrie($request)
    {
        $totalQty = self::when($request->filled('fuelType'), function ($query) use ($request) {
            $query->where('fuel_type_id', $request->fuelType);
        })
        ->when($request->filled('from_date'), function ($query) use ($request) {
            $query->whereDate('date', '>=', $request->from_date);
        })
        ->when($request->filled('to_date'), function ($query) use ($request) {
            $query->whereDate('date', '<=', $request->to_date);
        })->when($request->filled('vehicle_id'), function ($query) use ($request) {
            $query->where('vehicle_id', $request->vehicle_id);
        })->when($request->filled('costCenter'), function ($query) use ($request) {
            $query->where('cost_center_id', $request->costCenter);
        })->sum('qty'); // Calculate the total quantity

        $totalPrice = self::when($request->filled('fuelType'), function ($query) use ($request) {
            $query->where('fuel_type_id', $request->fuelType);
        })
        ->when($request->filled('from_date'), function ($query) use ($request) {
            $query->whereDate('date', '>=', $request->from_date);
        })
        ->when($request->filled('to_date'), function ($query) use ($request) {
            $query->whereDate('date', '<=', $request->to_date);
        })->when($request->filled('vehicle_id'), function ($query) use ($request) {
            $query->where('vehicle_id', $request->vehicle_id);
        })->when($request->filled('costCenter'), function ($query) use ($request) {
            $query->where('cost_center_id', $request->costCenter);
        })->sum(DB::raw('qty * price')); // Calculate the total price

        return [
            'totalQty' => $totalQty,
            'totalPrice' => $totalPrice,
        ];
    }
}
