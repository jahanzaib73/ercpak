<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleFuelResource;
use App\Http\Resources\VehicleResource;
use App\Http\Resources\VehicleShowResource;
use App\Http\Resources\VehicleTripResource;
use App\Models\Fuel;
use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('model', 'make', 'type')->latest()->get();
        $vehicleModels = VehicleModel::get(['id', 'name']);
        $vehicleTypes = VehicleType::get(['id', 'name']);
        $response = VehicleResource::collection($vehicles);
        return response()->json([
            "vehicles"=> $response,
            "vehicleModels"=> $vehicleModels,
            "vehicleTypes"=> $vehicleTypes,
        ]);
    }

    public function show($id)
    {
        $vehicle = Vehicle::with('make', 'model', 'type')->findorFail($id);
        $vehicleShowResponse = new VehicleShowResource($vehicle);

        $vehicleFuels = Fuel::where('vehicle_id', $vehicle->id)->with('fuelType')->get();
        $vehicleFuelsResponse = VehicleFuelResource::collection($vehicleFuels);

        $vehicleTrips = Trip::where('vehicle_id', $vehicle->id)->get();
        $vehicleTripsResponse = VehicleTripResource::collection($vehicleTrips);

        return response()->json([
            'vehicle' => $vehicleShowResponse,
            'vehicleFuels' => $vehicleFuelsResponse,
            'vehicleTrips' => $vehicleTripsResponse,
        ]);
    }
}
