<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index()
    {
        $this->authorize('All Item Category');
        $data['types'] = ItemCategory::all();
        return view('admin.inventories.item_category.index',$data);
    }

    public function store(Request $request){
        $this->authorize('Add Item Category');

        ItemCategory::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item CAtegory Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Item Category');

        $type = ItemCategory::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Item CAtegory Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Item Category');

        ItemCategory::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item CAtegory Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Item Category');
        ItemCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item CAtegory deleted successfully');
    }
}
