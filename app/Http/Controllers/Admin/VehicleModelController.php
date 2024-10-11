<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function index()
    {
        $this->authorize('All Vehicle Model');
        $data['models'] = VehicleModel::all();
        return view('admin.fleets.vehicle_models.index',$data);
    }

    public function store(Request $request){
        $this->authorize('Add Vehicle Model');

        VehicleModel::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Model Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Vehicle Model');

        $model = VehicleModel::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Model Data Fatched.',
            'model' => $model
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Vehicle Model');

        VehicleModel::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Model Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Vehicle Model');

        VehicleModel::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Vehicle Model deleted successfully');
    }
}
