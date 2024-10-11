<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleMake;
use Illuminate\Http\Request;

class VehicleMakeController extends Controller
{
    public function index()
    {
        $this->authorize('All Vehicle Make');
        $data['makes'] = VehicleMake::all();
        return view('admin.fleets.vehicle_makes.index',$data);
    }

    public function store(Request $request){

        $this->authorize('Add Vehicle Make');
        VehicleMake::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Make Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Vehicle Make');
        $make = VehicleMake::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Make Data Fatched.',
            'make' => $make
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Vehicle Make');
        VehicleMake::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Make Updated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Vehicle Make');
        VehicleMake::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Vehicle Make deleted successfully');
    }
}
