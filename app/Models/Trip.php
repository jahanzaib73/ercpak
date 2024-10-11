<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Trip extends Model
{
    use HasFactory, LogsActivity;

    const OPEN = 0;
    const CLOSED = 1;
    const CANCELLED = 2;
    protected $guarded = [];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function official()
    {
        return $this->belongsTo(User::class, 'official_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(TripAttachments::class, 'trip_id', 'id');
    }

    public static function getQtyPrie($request)
    {
        $totalDistance = self::when($request->filled('driver_id'), function ($query) use ($request) {
            $query->where('driver_id', $request->driver_id);
        })
            ->when($request->filled('from_date'), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->from_date);
            })
            ->when($request->filled('to_date'), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->to_date);
            })->when($request->filled('vehicle_id'), function ($query) use ($request) {
                $query->where('vehicle_id', $request->vehicle_id);
            })->when($request->filled('costCenter'), function ($query) use ($request) {
                $query->where('cost_center_id', $request->costCenter);
            })->sum('qty'); // Calculate the total quantity

        return [
            'totalDistance' => $totalDistance,
        ];
    }
}
