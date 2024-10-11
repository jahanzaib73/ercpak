<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    public function index()
    {
        $this->authorize('All Unit Type');
        $data['types'] = UnitType::all();
        return view('admin.inventories.unit_type.index',$data);
    }

    public function store(Request $request){
        $this->authorize('Add Unit Type');

        UnitType::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Unit Type Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Unit Type');

        $type = UnitType::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Unit Type Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Unit Type');

        UnitType::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Unit Type Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Unit Type');

        UnitType::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Unit Type deleted successfully');
    }
}
