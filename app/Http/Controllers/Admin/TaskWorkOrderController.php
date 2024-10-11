<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskWorkOrder;
use Illuminate\Http\Request;

class TaskWorkOrderController extends Controller
{

    public function index()
    {
        $this->authorize('All Task Workorders');
        $data['tasks'] = TaskWorkOrder::all();
        return view('admin.fleets.task_workorder.index',$data);
    }

    public function store(Request $request){

        $this->authorize('Add Task Workorders');

        TaskWorkOrder::create([
            'title' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Task Added Successfully.'
        ],200);
    }

    public function edit(Request $request)
    {

        $this->authorize('Edit Task Workorders');

        $type = TaskWorkOrder::findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Task Data Fatched.',
            'type' => $type
        ],200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Task Workorders');

        TaskWorkOrder::findOrFail($request->id)->update([
            'title' => $request->editName,
            'status' => $request->editStatus,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Task Udated Successfully.'
        ],200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Task Workorders');

        TaskWorkOrder::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Task deleted successfully');
    }
}
