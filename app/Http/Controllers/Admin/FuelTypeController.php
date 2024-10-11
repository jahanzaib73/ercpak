<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    public function index()
    {
        $this->authorize('All Fuel Type');

        $data['types'] = FuelType::all();
        return view('admin.fleets.fuel_type.index',$data);
    }

    public function store(Request $request){

        $this->authorize('Add Fuel Type');

        FuelType::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Fuel Type Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {

        $this->authorize('Edit Fuel Type');
        
        $type = FuelType::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Fuel Type Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Fuel Type');

        FuelType::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Fuel Type Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Fuel Type');

        FuelType::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Fuel Type deleted successfully');
    }
}
