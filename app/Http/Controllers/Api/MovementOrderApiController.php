<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovementOrderResource;
use App\Http\Resources\MovementOrderShowResource;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovementOrderApiController extends Controller
{
    public function index()
    {
        $trips = Trip::with('costCenter', 'vehicle.model', 'official', 'driver')->latest()->get();
        $response = MovementOrderResource::collection($trips);

        return response()->json(['movementOrders' => $response], 200);
    }

    public function show($id)
    {
        $trip = Trip::with('costCenter', 'vehicle.model', 'official.designation', 'driver.designation')->findorFail($id);
        $response = new MovementOrderShowResource($trip);

        $coordinates = json_decode($trip->coordinates);
        $stops = [];
        $previousCoordinate = null;

        if ($coordinates) {
            foreach ($coordinates as $coordinate) {
                if (property_exists($coordinate, 'timestamp')) {
                    // Convert timestamp to DateTime object for comparison
                    $currentTimestamp = Carbon::createFromTimestampMs($coordinate->timestamp);
                    $coordinate->timestamp = $currentTimestamp;
                    // If it's not the first iteration, calculate the difference
                    if ($previousCoordinate !== null) {
                        $differenceInMinutes = $currentTimestamp->diffInMinutes($previousCoordinate->timestamp);
                        // If difference is greater than 5 minutes, count it as a stop
                        if ($differenceInMinutes >= 5) {
                            $stops[] = [
                                'time' => $differenceInMinutes,
                                'currentTimestamp' => $currentTimestamp
                            ];
                        }
                    }
                    // Assign current timestamp as previous for the next iteration
                    $previousCoordinate = $coordinate;
                }
            }
        }

        return response()->json([
            'movementOrder' => $response,
            'stops' => $stops,
        ], 200);
    }
}
