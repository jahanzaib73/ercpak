<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $this->authorize('All Vehicle Type');
        $data['types'] = VehicleType::all();
        return view('admin.fleets.vehicle_type.index',$data);
    }

    public function store(Request $request){
        $this->authorize('Add Vehicle Type');
        VehicleType::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Type Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Vehicle Type');
        $type = VehicleType::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Type Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Vehicle Type');

        VehicleType::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Type Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Vehicle Type');

        VehicleType::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Vehicle Type deleted successfully');
    }
}
