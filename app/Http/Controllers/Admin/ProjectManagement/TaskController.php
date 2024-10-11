<?php

namespace App\Http\Controllers\Admin\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectTaskAttachment;
use App\Models\ProjectTaskMember;
use App\Models\Task;
use App\Models\TaskActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projectTasks = ProjectTask::with('project', 'currency', 'user', 'doneBy')->where('project_id', $request->project_id)->latest();
            return DataTables::eloquent($projectTasks)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = '';

                    if (ProjectTask::NOTSTARTED == $row->status) {
                        $status = '<span class="badge badge-info">Waiting to Start</span>';
                    } elseif (ProjectTask::INPROGRESS == $row->status) {
                        $status = '<div class="progress" style="height: 38px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="color: ' . ($row->task_percentage <= 0 ? 'black' : 'white') . '; width: ' . $row->task_percentage . '%;" aria-valuenow="' . $row->task_percentage . '" aria-valuemin="0" aria-valuemax="100">' . $row->task_percentage . '%</div>
                  </div>';
                    } elseif (ProjectTask::COMPLETED == $row->status) {
                        $status = '<a href="#" class="btn btn-success w-100"><i class="fa-solid fa-thumbs-up" aria-hidden="true"></i></a>';
                    }

                    return $status;
                })
                ->addColumn('project', function ($row) {
                    return optional($row->project)->project_name;
                })->addColumn('budget', function ($row) {
                    return $row->amount . ' ' . optional($row->currency)->name;
                })->addColumn('user', function ($row) {
                    return optional($row->user)->full_name;
                })->addColumn('doneBy', function ($row) {
                    return optional($row->user)->full_name;
                })->addColumn('startDate', function ($row) {
                    if (!empty($row->task_started_date)) {
                        return $row->task_started_date;
                    } else {
                        if (Auth::user()->can('Start Task')) {
                            return '<a href="javascript:void(0)" class="btn btn-secondary w-100 projectStart" data-name="' . $row->task_name . '"  data-id="' . $row->id . '"><i class="fa-solid fa-play" aria-hidden="true"></i></a>';
                        }
                    }
                })->addColumn('complatedDate', function ($row) {
                    // dd('here');
                    if (!empty($row->task_started_date) && $row->status == ProjectTask::INPROGRESS) {

                        return '<a href="#" class="btn btn-info w-100 projectCompleted" data-name="' . $row->task_name . '"  data-id="' . $row->id . '"><i class="fa-solid fa-check" aria-hidden="true"></i></a>';
                    } else {
                        return $row->task_completed_date;
                    }
                })->addColumn('action', function ($row) {
                    $btn = '';
                    if (Auth::user()->can('View Task')) {
                        $btn .= '<a href=' . route('projects.tasks.detail', ['id' => $row]) . ' data-toggle="tooltip" data-original-title="Show" class="edit btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    }
                    if (Auth::user()->can('Task Percentage')) {
                        $btn .= ' | <a href="javascript:void(0)" data-id=' . $row->id . ' data-percentage=' . $row->task_percentage . ' class="taskPercentage btn btn-success btn-sm"><i class="fa fa-percent"></i></a>';
                    }
                    if ($row->status != ProjectTask::COMPLETED && Auth::user()->can('Edit Task'))
                        $btn .= ' | <a href="javascript:void(0)" data-id=' . $row->id . '  class="editTask btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>';
                    if ($row->expenses()->count() <= 0 && Auth::user()->can('Delete Task'))
                        $btn .= ' | <a href=' . route('task.delete', ['id' => $row]) . ' onclick="return confirm(\'Are You Sure?\')" data-toggle="tooltip" data-original-title="Show" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action', 'status', 'startDate', 'complatedDate'])
                ->make(true);
        }
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Task');

        try {
            DB::beginTransaction();
            $task = ProjectTask::findOrFail($request->task_id);
            $project = Project::findOrFail($task->project_id);
            $tasksAmount = ProjectTask::where('project_id', $project->id)->sum('amount') + $request->amount;

            if ($tasksAmount > $project->budget) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your total Project budget is: ' . $project->budget . ' and your tasks amount old and current is: ' . $tasksAmount,
                ], 200);
            }

            $url = null;
            $fileName = null;
            $type = null;
            if ($request->has('featured_image')) {
                $extension = $request->featured_image->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $request->featured_image->move(public_path('project_task'), $fileName);
                $url = asset('/project_task/' . $fileName);
                $type = $extension;
            }

            $task->update([
                "task_name" => $request->task_name,
                "task_type_id" => $request->task_type_id,
                "location_id" => $request->location_id,
                "task_date" => $request->task_date ?: 0,
                "amount" => $request->amount,
                "currency_id" => $request->currency_id,
                "task_description" => $request->task_description,
                "task_description_arabic" => $request->task_description_arabic,
                "featured_image" => $fileName ?: $task->featured_image,
                'featured_image_url' =>  $url ?: $task->featured_image_url,
                'featured_image_type' =>  $type ?: $task->featured_image_type,
            ]);

            ProjectTaskMember::where('task_id', $task->id)->delete();
            foreach ($request->member_id as $memberId) {
                ProjectTaskMember::create([
                    'member_id' => $memberId,
                    'task_id' => $task->id,
                ]);
            }

            if ($request->has('files')) {
                foreach ($request->file('files') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('project_task'), $fileName);
                    $url = asset('/project_task/' . $fileName);
                    $type = $extension;
                    ProjectTaskAttachment::create([
                        'file_name' => $fileName,
                        'file_type' => $type,
                        'file_url' => $url,
                        'task_id' => $task->id,
                    ]);
                }
            }


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Task Added Successfully',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function store(Request $request)
    {
        $this->authorize('Add Task');

        try {
            DB::beginTransaction();

            $project = Project::findOrFail($request->project_id);
            $tasksAmount = ProjectTask::where('project_id', $project->id)->sum('amount') + $request->amount;

            if ($tasksAmount > $project->budget) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your total Project budget is: ' . $project->budget . ' and your tasks amount old and current is: ' . $tasksAmount,
                ], 200);
            }

            $url = null;
            $fileName = null;
            $type = null;
            if ($request->has('featured_image')) {
                $extension = $request->featured_image->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $request->featured_image->move(public_path('project_task'), $fileName);
                $url = asset('/project_task/' . $fileName);
                $type = $extension;
            }

            $task = ProjectTask::create([
                "task_name" => $request->task_name,
                "task_type_id" => $request->task_type_id,
                "location_id" => $request->location_id,
                "task_date" => $request->task_date ?: 0,
                "amount" => $request->amount,
                "currency_id" => $request->currency_id,
                "task_description" => $request->task_description,
                "task_description_arabic" => $request->task_description_arabic,
                "featured_image" => $fileName,
                'featured_image_url' =>  $url,
                'featured_image_type' =>  $type,
                'project_id' => $request->project_id,
            ]);

            foreach ($request->member_id as $memberId) {
                ProjectTaskMember::create([
                    'member_id' => $memberId,
                    'task_id' => $task->id,
                ]);
            }

            if ($request->has('files')) {
                foreach ($request->file('files') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('project_task'), $fileName);
                    $url = asset('/project_task/' . $fileName);
                    $type = $extension;
                    ProjectTaskAttachment::create([
                        'file_name' => $fileName,
                        'file_type' => $type,
                        'file_url' => $url,
                        'task_id' => $task->id,
                    ]);
                }
            }


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Task Added Successfully',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function storePercentage(Request $request)
    {
        $task = ProjectTask::findOrFail($request->ProjectTaskIdPerecntage);
        if (($request->task_percentage) > 100) {
            return response()->json([
                'status' => false,
                'message' => 'Your task percentage is greater than 100. Percentage should be a number between 0 and 100',
            ], 200);
        }

        $task->task_percentage = $request->task_percentage;
        $task->update();
        return response()->json([
            'status' => true,
            'message' => 'Task Updated Successfully',
        ], 200);
    }

    public function taskDetail($id)
    {
        $this->authorize('View Task');

        $data['task'] = ProjectTask::with('members.user', 'project.attachments', 'location')->findOrFail($id);
        $data['task_percentage'] = $data['task']->project->calculateOverallCompletionPercentage();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['activities'] = TaskActivity::with('task', 'location', 'user')->where('task_id', $id)->get();
        return view('admin.project_managements.tasks.detail', $data);
    }

    public function delete($id)
    {
        $this->authorize('Delete Task');

        ProjectTask::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Task Deleted Successfully');
    }

    public function taskById(Request $request)
    {
        $task = ProjectTask::with('members', 'project.attachments', 'location')->findOrFail($request->taskId);
        $memberIds = $task->members()->pluck('member_id')->toArray();
        return response()->json([
            'status' => true,
            'message' => 'Task Fatched Successfully',
            'data' => $task,
            'memberIds' => $memberIds
        ], 200);
    }

    public function showReportForm($id)
    {
        $data['task'] = ProjectTask::with('members.user', 'project.attachments', 'location')->findOrFail($id);
        return view('admin.project_managements.tasks.report', $data);
    }
}
