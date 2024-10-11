<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectTaskType;
use Illuminate\Http\Request;

class ProjectTaskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $this->authorize('All Project Task Type');

        if ($id) {
            $data['complaintType'] = ProjectTaskType::findOrFail($id);
        }

        $data['complaintTypes'] = ProjectTaskType::orderBy('id', 'desc')->get();
        return view('admin.project_task_types.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Project Task Type');
        $request->validate([
            'name' => 'required|unique:complaint_types|max:255|min:3',
        ]);

        ProjectTaskType::create($request->all());

        return redirect()->route('project-task-types.index')->with('success', 'Project Task Type Created Successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('Edit Project Task Type');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:complaint_types,name,' . $id,
        ]);

        ProjectTaskType::findOrFail($id)->update($request->all());

        return redirect()->route('project-task-types.index')->with('success', 'Project Task Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Project Task Type');
        ProjectTaskType::findOrFail($id)->delete();
        return redirect()->route('project-task-types.index')->with('success', 'Project Task Type Deleted Successfully!');
    }
}
