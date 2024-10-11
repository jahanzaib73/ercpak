<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $this->authorize('All Task Category');

        if($id){
            $data['taskCategory'] = TaskCategory::findOrFail($id);
        }

        $data['taskCategories'] = TaskCategory::orderBy('id','desc')->get();
        return view('admin.tasks.task-categories.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Task Category');
        $request->validate([
            'name' => 'required|unique:task_categories|max:255|min:3',
        ]);

        TaskCategory::create($request->all());

        return redirect()->route('task-categories.index')->with('success','Task Category Created Successfully!');
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
        $this->authorize('Edit Task Category');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:task_categories,name,'.$id,
        ]);

        TaskCategory::findOrFail($id)->update($request->all());

        return redirect()->route('task-categories.index')->with('success','Task Categories Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Task Category');
        TaskCategory::findOrFail($id)->delete();
        return redirect()->route('task-categories.index')->with('success','Task Categories Deleted Successfully!');

    }
}
