<?php

namespace App\Http\Controllers\Admin\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Location;
use App\Models\Project;
use App\Models\ProjectAttachment;
use App\Models\ProjectTask;
use App\Models\ProjectTaskAttachment;
use App\Models\ProjectTaskType;
use App\Models\Task;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::with('tasks')->latest();
            return DataTables::eloquent($projects)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = '';
                    if (Project::NOTSTARTED === $row->status) {
                        $status = '<span class="badge badge-info">Waiting to Start</span>';
                    } elseif (Project::INPROGRESS === $row->status) {
                        $status = '<div class="progress" style="height: 38px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="color: ' . ($row->calculateOverallCompletionPercentage() <= 0 ? 'black' : 'white') . '; width: ' . $row->calculateOverallCompletionPercentage() . '%;" aria-valuenow="' . $row->calculateOverallCompletionPercentage() . '" aria-valuemin="0" aria-valuemax="100">' . $row->calculateOverallCompletionPercentage() . '%</div>
                  </div>';
                    } elseif (Project::COMPLETED === $row->status) {
                        return '<a href="#" class="btn btn-success w-100"><i class="fa-solid fa-thumbs-up" aria-hidden="true"></i></a>';
                    }
                    return $status;
                })->addColumn('totalTasks', function ($row) {
                    return optional($row->tasks)->count();
                })->addColumn('budget', function ($row) {
                    return $row->budget . ' ' . optional($row->currency)->name;
                })->addColumn('balance', function ($row) {
                    return $row->getBalanceAmount();
                })->addColumn('projectType', function ($row) {
                    return optional($row->projectType)->name;
                })->addColumn('spend', function ($row) {
                    return $row->getSpendAmount();
                })->addColumn('action', function ($row) {
                    if (Auth::user()->can('View Project')) {
                        $btn = '<a href=' . route('projects.show', ['id' => $row]) . ' data-toggle="tooltip" data-original-title="Show" class="edit btn btn-info btn-sm"><i class="fa fa-eye"></i<</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }


        $data['currencies'] = Currency::whereStatus(1)->get();
        $data['taskTypes'] = ProjectTaskType::whereStatus(1)->get();
        $data['projects'] = Project::latest()->get();
        $data['projectTasks'] = ProjectTask::with('project')->latest()->get();
        return view('admin.project_managements.projects.index', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Project');

        $url = null;
        $fileName = null;
        $type = null;
        if ($request->has('feature_image')) {
            $extension = $request->feature_image->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->feature_image->move(public_path('project'), $fileName);
            $url = asset('/project/' . $fileName);
            $type = $extension;
        }

        $project = Project::create([
            "project_name" => $request->project_name,
            "budget" => $request->budget,
            "currency_id" => $request->currency_id ?: 0,
            "project_date" => $request->project_date,
            "notes" => $request->notes,
            "notes_arabic" => $request->notes_arabic,
            "task_type_id" => $request->task_type_id,
            "featured_image" => $fileName,
            'featured_image_url' =>  $url,
            'featured_image_type' =>  $type,
        ]);

        if ($request->has('files')) {
            foreach ($request->file('files') as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $file->move(public_path('project_task'), $fileName);
                $url = asset('/project_task/' . $fileName);
                $type = $extension;
                ProjectAttachment::create([
                    'file_name' => $fileName,
                    'file_type' => $type,
                    'file_url' => $url,
                    'project_id' => $project->id,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Project Added Successfully',
        ], 200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Project');

        $url = null;
        $fileName = null;
        $type = null;
        if ($request->has('feature_image')) {
            $extension = $request->feature_image->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->feature_image->move(public_path('project'), $fileName);
            $url = asset('/project/' . $fileName);
            $type = $extension;
        }

        $project = Project::findOrFail($request->id);
        $project->update([
            "project_name" => $request->project_name,
            "budget" => $request->budget,
            "currency_id" => $request->currency_id ?: 0,
            "project_date" => $request->project_date,
            "notes" => $request->notes,
            "notes_arabic" => $request->notes_arabic,
            "task_type_id" => $request->task_type_id,
            "featured_image" => $fileName ? $fileName : $project->featured_image,
            'featured_image_url' =>  $url ? $url : $project->featured_image_url,
            'featured_image_type' =>  $type ? $type : $project->featured_image_type,
        ]);

        if ($request->has('files')) {
            foreach ($request->file('files') as $file) {
                $extension = $file->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $file->move(public_path('project_task'), $fileName);
                $url = asset('/project_task/' . $fileName);
                $type = $extension;
                ProjectAttachment::create([
                    'file_name' => $fileName,
                    'file_type' => $type,
                    'file_url' => $url,
                    'project_id' => $project->id,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Project Added Successfully',
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('View Project');

        $data['project'] = Project::with('tasks', 'attachments')->findOrFail($id);
        $data['currencies'] = Currency::whereStatus(1)->get();
        $data['taskTypes'] = ProjectTaskType::whereStatus(1)->get();
        $data['users'] = User::where('role_id', '!=', 1)->get();
        $data['projectTasks'] = ProjectTask::with('project', 'expenses')->latest()->where('project_id', $data['project']->id)->get();
        $data['taskNumber'] = ProjectTask::all()->count() + 1;
        $data['vendors'] = Vendor::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        // dd($data);
        return view('admin.project_managements.projects.show', $data);
    }

    public function startProject(Request $request)
    {
        $this->authorize('Start Task');

        try {
            DB::beginTransaction();

            $task = ProjectTask::findOrFail($request->ProjectTaskId);
            $task->task_started_date = $request->date;
            $task->latitude = $request->latitude;
            $task->longitude = $request->longitude;
            $task->start_description = $request->start_description;
            $task->start_description_arabic = $request->start_description_arabic;
            // $task->task_type_id = $request->task_type_id;
            $task->status = ProjectTask::INPROGRESS;
            $task->update();

            $project = Project::findOrFail($task->project_id);
            if (empty($project->start_project_date)) {
                $project->status = Project::INPROGRESS;
                $project->start_project_date = $request->date;
                $project->update();
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
                        'source' => 1,
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Project has been started successfully',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function completeProject(Request $request)
    {
        try {
            DB::beginTransaction();

            $task = ProjectTask::findOrFail($request->ProjectTaskIdCompleted);
            $task->task_completed_date = $request->completed_date;
            $task->task_percentage = 100;
            $task->completed_description = $request->completed_description;
            $task->completed_description_arabic = $request->completed_description_arabic;
            $task->status = ProjectTask::COMPLETED;
            $task->update();

            $project = Project::findOrFail($task->project_id);

            if ($project->tasks()->where('status', '!=', ProjectTask::COMPLETED)->count() <= 0) {
                $project->status = Project::COMPLETED;
                $project->complete_project_date = $request->completed_date;
                $project->update();
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Project has been completed successfully',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function projectById(Request $request)
    {
        $project = Project::with('tasks')->findOrFail($request->projectId);
        return response()->json([
            'status' => true,
            'message' => 'Project has been fatched successfully',
            'data' => $project
        ], 200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Project');

        Project::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Project Deleted Successfully');
    }
}
