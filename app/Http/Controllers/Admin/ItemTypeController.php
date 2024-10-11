<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemType;
use Illuminate\Http\Request;

class ItemTypeController extends Controller
{
    public function index()
    {
        $this->authorize('All Item Type');
        $data['types'] = ItemType::all();
        return view('admin.inventories.item_type.index',$data);
    }

    public function store(Request $request){

        $this->authorize('Add Item Type');
        ItemType::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item Type Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Item Type');

        $type = ItemType::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Item Type Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Item Type');

        ItemType::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item Type Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Item Type');

        ItemType::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item Type deleted successfully');
    }
}
