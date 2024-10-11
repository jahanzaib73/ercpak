<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemMake;
use Illuminate\Http\Request;

class ItemMakeController extends Controller
{
    public function index()
    {
        $this->authorize('All Item Make');
        $data['makes'] = ItemMake::all();
        return view('admin.inventories.item_makes.index',$data);
    }

    public function store(Request $request){
        $this->authorize('Add Item Make');

        ItemMake::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item Make Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Item Make');

        $make = ItemMake::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Item Make Data Fatched.',
            'make' => $make
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Item Make');

        ItemMake::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item Make Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Item Make');

        ItemMake::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item Make deleted successfully');
    }
}
