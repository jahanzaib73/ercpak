<?php

namespace App\Http\Controllers\Admin\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectTaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProjectManagementController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('All Project');
        if ($request->ajax()) {
            $projects = Project::with('tasks')->when($request->filled(['start_date', 'end_date']), function ($query) use ($request) {
                $startDate = date('Y-m-d', strtotime($request->input('start_date')));
                $endDate = date('Y-m-d', strtotime($request->input('end_date')));
                return $query->whereBetween('project_date', [$startDate, $endDate]);
            })->latest();
            return DataTables::eloquent($projects)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = '';
                    if (Project::NOTSTARTED == $row->status) {
                        $status = '<span class="badge badge-info">Waiting to Start</span>';
                    } elseif (Project::INPROGRESS == $row->status) {
                        $status = '<div class="progress" style="height: 38px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="color: ' . ($row->calculateOverallCompletionPercentage() <= 0 ? 'black' : 'white') . '; width: ' . $row->calculateOverallCompletionPercentage() . '%;" aria-valuenow="' . $row->calculateOverallCompletionPercentage() . '" aria-valuemin="0" aria-valuemax="100">' . $row->calculateOverallCompletionPercentage() . '%</div>
                  </div>';
                    } elseif (Project::COMPLETED == $row->status) {
                        return '<a href="#" class="btn btn-success w-100"><i class="fa-solid fa-thumbs-up" aria-hidden="true"></i></a>';
                    }
                    return $status;
                })->addColumn('totalTasks', function ($row) {
                    return optional($row->tasks)->count();
                })->addColumn('budget', function ($row) {
                    return $row->budget . ' ' . optional($row->currency)->name;
                })->addColumn('budget', function ($row) {
                    return $row->budget . ' ' . optional($row->currency)->name;
                })->addColumn('balance', function ($row) {
                    return $row->getBalanceAmount() ?: 0;
                })->addColumn('balance', function ($row) {
                    return $row->getBalanceAmount() ?: 0;
                })->addColumn('projectType', function ($row) {
                    return optional($row->projectType)->name;
                })->addColumn('spend', function ($row) {
                    return $row->getSpendAmount();
                })->addColumn('action', function ($row) {
                    $btn = '';
                    if (Auth::user()->can('View Project')) {
                        $btn .= '<div class="d-flex align-items-center"><a href=' . route('projects.show', ['id' => $row]) . ' data-toggle="tooltip" data-original-title="Show" class="edit btn btn-info btn-sm"><i class="fa fa-eye"></i></a>';
                    }
                    if ($row->status != Project::COMPLETED && Auth::user()->can('Edit Project'))
                        $btn .= ' | <a href="javascript:void(0)" data-id=' . $row->id . '  class="editProject btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></a>';
                    if ($row->tasks()->count() <= 0 && Auth::user()->can('Delete Project'))
                        $btn .= ' | <a href=' . route('project.delete', ['id' => $row]) . ' onclick="return confirm(\'Are You Sure?\')" data-toggle="tooltip" data-original-title="Show" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';

                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }


        $data['currencies'] = Currency::whereStatus(1)->get();
        $data['taskTypes'] = ProjectTaskType::whereStatus(1)->get();
        $data['projects'] = Project::latest()->get();
        $data['projectTasks'] = ProjectTask::with('project')->latest()->get();
        return view('admin.project_managements.index', $data);
    }

    public function getstats()
    {
        $data['projectStats'] = Project::getStats();
        $data['taskStats'] = ProjectTask::getStats();
        return response()->json([
            'status' => true,
            'message' => 'Data for project stats',
            'data' => $data
        ], 200);
    }
}
