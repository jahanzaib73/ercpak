<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $this->authorize('All Warehouses');
        $data['warehouses'] = Warehouse::all();
        return view('admin.inventories.warehouses.index',$data);
    }

    public function store(Request $request){
        $this->authorize('Add Warehouses');

        Warehouse::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Warehouse Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Warehouses');

        $type = Warehouse::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Warehouse Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Warehouses');

        Warehouse::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Warehouse Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Warehouses');

        Warehouse::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Warehouse deleted successfully');
    }
}
