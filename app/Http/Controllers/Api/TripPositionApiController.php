<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripPositionApiController extends Controller
{
    public function getTrips()
    {
        $vehicleWithTrips = Vehicle::with(['model:id,name', 'activeTrip.driver:id,designation_id,first_name,last_name,email,profile_pic_url', 'activeTrip.driver.designation:id,name'])->findOrFail(Auth::id(), ['id', 'vehicle_number', 'image_url', 'vehicle_model_id']);
        $response = new TripResource($vehicleWithTrips);
        return response()->json(['vehicleWithTrips' => $response], 200);
    }

    public function tripHistory($id)
    {
        $trip = Trip::findOrFail($id, ['id', 'coordinates']);
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
                            $stops[] = $differenceInMinutes;
                        }
                    }
                    // Assign current timestamp as previous for the next iteration
                    $previousCoordinate = $coordinate;
                }
            }
        }
        return response()->json(['stops' => $stops], 200);
    }

    public function positionChanged(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:trips,id'],
            'coordinates' => ['required'],
        ]);
        $trip = Trip::find($request->id);
        $coords = $trip->coordinates
            ? array_merge(
                json_decode(
                    $trip->coordinates,
                    true
                ),
                json_decode(
                    $request->coordinates,
                    true
                )
            )
            : $request->coordinates;
        $trip->coordinates = $coords;
        $updated = $trip->update();

        $message = $updated ? "Data updated!" : "Failed to update data!";
        $success = $updated;
        return response()->json([
            'message' => $message,
            'success' => $success
        ]);
    }

    public function latestLocation($id = null)
    {
        if ($id) {
            $trip = Trip::findOrFail($id);
            return response()->json(['trip' => $trip]);
        }
        $trips = Trip::where('status', 0)->latest()->get();
        return response()->json(['trips' => $trips]);
    }
}
