<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InspectionChecklist;
use Illuminate\Http\Request;

class InspectionChecklistController extends Controller
{
    public function index()
    {
        $this->authorize('All Inspection Check List');
        $data['items'] = InspectionChecklist::all();
        return view('admin.fleets.inspection_checklist.index',$data);
    }

    public function store(Request $request){

        $this->authorize('Add Inspection Check List');

        InspectionChecklist::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {

        $this->authorize('Edit Inspection Check List');

        $type = InspectionChecklist::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Item Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Inspection Check List');

        InspectionChecklist::findOrFail($request->id)->update([
            'name' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Inspection Check List');

        InspectionChecklist::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item deleted successfully');
    }
}
