<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($taskId)
    {
        $this->authorize('All Task Lists');
        $data['taskLists'] = TaskAttachment::where('task_id',$taskId)->get();
        $data['taskId'] = $taskId;
        return view('admin.tasks.task_list.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('Add Task Lists');
        $data['taskId'] = $id;
        return view('admin.tasks.task_list.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('Add Task Lists');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'notes' => ['required','string'],
            'subject' => ['required','string'],
            'attachment' => ['required','mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf'],
        ],[
            'attachment.required'=>'The File is required',
            'attachment.string'=>'The File should be a string',
            'attachment.in'=>'The File should be Letters Received OR Issued by Consulte',
        ]);

        $task = Task::findOrFail($request->taskId);

        $attachment = $request->attachment;
        $extension = $attachment->getClientOriginalExtension();
        $fileName = rand(1,100000).time().'.'.$extension;
        $attachment->move(public_path('task_attachments'), $fileName);
        $url = asset('/task_attachments/'.$fileName);

        TaskAttachment::create([
            'file_name' => $request->name,
            'notes' => $request->notes,
            'subject' => $request->subject,
            'file_extension' => $extension,
            'file_url' => $url,
            'user_id' => Auth::id(),
            'task_id' => $task->id,
        ]);

        return redirect()->route('task-list.index',['id' => $request->taskId])->with('success','Task added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->authorize('Edit Task Lists');
        $data['task'] = TaskAttachment::findOrFail($id);
        return view('admin.tasks.task_list.edit',$data);
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
        $this->authorize('Edit Task Lists');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'notes' => ['required','string'],
            'subject' => ['required','string'],
        ]);

        $task = TaskAttachment::findOrFail($id);

        $status = 0;
        if($request->has('status')&&$request->status == 'on'){
            $status = 1;
        }

        if($request->has('attachment')){
            $attachment = $request->attachment;
            $extension = $attachment->getClientOriginalExtension();
            $fileName = rand(1,100000).time().'.'.$extension;
            $attachment->move(public_path('task_attachments'), $fileName);
            $url = asset('/task_attachments/'.$fileName);

            $task->update([
                'file_name' => $request->name,
                'subject' => $request->subject,
                'notes' => $request->notes,
                'file_extension' => $extension,
                'file_url' => $url,
                'status' => $status,
            ]);
        }else{
            $task->update([
                'subject' => $request->subject,
                'notes' => $request->notes,
                'file_name' => $request->name,
                'status' => $status,
            ]);
        }

        return redirect()->route('task-list.index',['id' => $request->taskId])->with('success','Task Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Task Lists');
        $task = TaskAttachment::where('id',$id)->first();
        $taskId = $task->task_id;
        $task->delete();
        return redirect()->route('task-list.index',['id' => $taskId])->with('success','Task Deleted Successfully');
    }
}
