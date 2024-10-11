<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Models\Department;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskTeam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('All Tasks');
        if ($request->ajax()) {

            $tasks = Task::with('user', 'department', 'taskCategory', 'taskOwner')->latest();
            // dd($tasks->get());
            return DataTables::of($tasks)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) use ($request){
                        $btn = '';
                        if (Auth::user()->can('View Tasks')){
                            $btn = '<a href='.route('tasks.show',$row->id).' title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a>';
                        }
                        if (Auth::user()->can('Edit Tasks')){
                            $btn .= ' | <a href='.route('tasks.edit',$row->id).' title="Edit Record" class="btn bg-info btn-sm edit text-white"><i class="fa fa-edit"></i></a>';
                        }
                        if (Auth::user()->can('Delete Tasks')){
                            $btn .= ' | <a href='.route('tasks.delete',$row->id).' onclick="return confirm(\'Are you sure?\')" title="Delete Record" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i></a>';
                        }
                        if(Auth::user()->can('Approve Task')&&$row->status != Task::COMPLETED&&$row->status != Task::CANCELED&&$row->status != Task::APPROVED)
                            $btn .= ' | <a href='.route('tasks.approve.page',$row->id).' title="Aprove" class="btn btn-gray btn-sm"><i class=" mdi mdi-check"></i></a>';

                    if (Auth::user()->can('Cancel Task') && $row->status != Task::COMPLETED && $row->status != Task::CANCELED && $row->status != Task::APPROVED)
                        $btn .= ' | <a href=' . route('tasks.mark.cancel', $row->id) . ' onclick="return confirm(\'Are you sure?\')"  title="Cancel" class="btn btn-danger btn-sm"><i class=" mdi mdi-close"></i></a>';

                        if((Auth::user()->can('Add Task List')&&$row->status == Task::APPROVED)&&$row->status != Task::COMPLETED&&$row->status != Task::CANCELED&&count($row->documentControls)<1)
                            $btn .= ' | <a href='.route('documents-control.create',$row->id).' title="Task List" class="btn btn-gray mt-1 btn-sm"><i class=" mdi mdi-file-check"></i></a>';

                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                        $status = '';
                        if($row->status == Task::PENDING){
                            $status = '<span class="badge badge-danger">PENDING</span>';
                        }else if($row->status == Task::INPROGRESS){
                            $status = '<span class="badge badge-primary">INPROGRESS</span>';
                        }else if($row->status == Task::COMPLETED){
                            $status = '<span class=""badge badge-danger">COMPLETED</span>';
                        }else if($row->status == Task::CANCELED){
                            $status = '<span class="badge badge-danger">CANCELED</span>';
                        }else if($row->status == Task::APPROVED){
                            $status = '<span class="badge badge-warning">APPROVED</span>';
                        }

                    return $status;
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('created_by', function ($row) {
                    return optional($row->user)->full_name;
                })
                ->addColumn('taskOwner', function ($row) {
                    return optional($row->taskOwner)->full_name;
                })->addColumn('job_type', function ($row) {
                    return optional($row->taskCategory)->name;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data = [];
        $data['allstate'] = Task::totalTasks();
        $data['todayAllstate'] = Task::todayTasks();

        $data['allStateCompleted'] = Task::totalCompletedTasks();
        $data['todayStateCompleted'] = Task::todayCompletedTasks();

        $data['allStatePending'] = Task::totalPendingTasks();
        $data['todayStatePending'] = Task::todayPendingTasks();

        $data['allStateCAncelled'] = Task::totalCancelledTasks();
        $data['todayStateCAncelled'] = Task::todayCancelledTasks();

        return view('admin.tasks.tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Add Tasks');
        $data['departments'] = Department::whereStatus('1')->get();
        $data['taskCategories'] = TaskCategory::whereStatus(1)->get();
        return view('admin.tasks.tasks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $this->authorize('Add Tasks');
        try {

            DB::beginTransaction();
            Task::create([
                'task_category_id' => $request->task_category_id,
                'date' => $request->date,
                'department_id' => $request->department_id,
                'description' => $request->description,
                'task_owner_id' =>  Auth::id(),
                'user_id' => Auth::id(),
            ]);

            DB::commit();
            return redirect()->route('tasks.index')->with('success', 'Task stored successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View Tasks');
        $data['task'] = Task::with('taskMembersIds.user', 'user', 'department', 'taskCategory', 'taskOwner', 'documentControls')->findOrFail($id);
        $data['document'] = optional($data['task']->documentControls())->first();
        return view('admin.tasks.tasks.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit Tasks');
        $data['task'] = Task::findOrFail($id);
        $data['departments'] = Department::whereStatus('1')->get();
        $data['taskCategories'] = TaskCategory::whereStatus(1)->get();

        return view('admin.tasks.tasks.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, $id)
    {
        $this->authorize('Edit Tasks');
        try {
            DB::beginTransaction();
            $task = Task::find($id);
            $task->update([
                'task_category_id' => $request->task_category_id,
                'date' => $request->date,
                'department_id' => $request->department_id,
                'description' => $request->description,
                'status' => (($request->has('status') && $request->status == 'on') ? Task::COMPLETED : $task->status)
            ]);
            DB::commit();
            return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Tasks');
        Task::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

    public function markCancel($id)
    {
        $this->authorize('Cancel Task');
        Task::findOrFail($id)->update([
            'status' => Task::CANCELED
        ]);
        return redirect()->back()->with('success', 'Task has been Cancelled successfully.');
    }

    public function taskApprovePage($id)
    {
        $this->authorize('Approve Task');
        $data['task'] = Task::with('user', 'department', 'taskCategory', 'taskOwner')->findOrFail($id);
        $data['users'] = User::where('role_id', 0)->whereStatus(1)->get();
        return view('admin.tasks.tasks.approve_task', $data);
    }

    public function tasApprove(Request $request)
    {
        $this->authorize('Approve Task');

        foreach ($request->employees as $employee) {
            TaskTeam::create([
                'task_ownar_id' => Auth::id(),
                'assigned_user_id' => $employee,
                'assigned_by' => Auth::id(),
                'task_id' => $request->task_id,
            ]);
        }
        Task::findOrFail($request->task_id)->update([
            'status' => Task::APPROVED
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task has been Approved successfully.');
    }
}
