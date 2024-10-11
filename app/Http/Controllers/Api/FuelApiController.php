<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FuelResource;
use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelApiController extends Controller
{
    public function index(){
        $fuels = Fuel::with('costCenter:id,title', 'vehicle.model:id,name', 'fuelMan.designation:id,name', 'fuelType:id,name')->latest()->get();
        $response = FuelResource::collection($fuels);
        return response()->json(['fuels' => $fuels]);
    }

    public function show($id)
    {
        $fuelQty = 0;
        $fuel = Fuel::with('costCenter:id,title', 'vehicle.model:id,name', 'fuelMan.designation:id,name', 'fuelType:id,name')->findOrFail($id);
        $fuelHistory = Fuel::where('vehicle_id', $fuel->vehicle_id)->get(['id', 'fuel_type_id', 'qty', 'created_at']);
        foreach ($fuelHistory as $item) {
            $fuelQty += $item->qty;
        }
        $fuelEconomy = round($fuel->vehicle->current_meter_reading / $fuelQty);
        $fuel['fuelEconomy'] = $fuelEconomy;
        return response()->json([
            'fuel' => $fuel,
            'fuelHistory' => $fuelHistory,
        ]);
    }
}
