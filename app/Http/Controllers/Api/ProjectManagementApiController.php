<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Http\Request;

class ProjectManagementApiController extends Controller
{
    public function index()
    {
        $projects = Project::select('id', 'project_name', 'project_date', 'status', 'featured_image_url', 'created_at')->with('tasks:id,task_name,project_id')->latest()->get();
        
        $projects = $projects->map(function ($project) {
            $project->tasksCount = $project->tasks->count();
            unset($project->tasks); // Remove tasks from the response if you don't need them anymore
            return $project;
        });

        return response()->json([
            'projects'=> $projects,
        ]);
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
