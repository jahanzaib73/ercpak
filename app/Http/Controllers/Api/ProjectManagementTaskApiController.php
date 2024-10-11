<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectTaskMember;
use App\Models\TaskActivity;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectManagementTaskApiController extends Controller
{
    public function showTasks($projectId)
    {
        $project = Project::where('id', $projectId)->select('id', 'project_name', 'project_date', 'status', 'featured_image_url', 'created_at')->with('tasks:id,task_name,project_id,task_date,status,featured_image_url')->latest()->get();

        return response()->json([
            'project' => $project
        ]);
    }

    public function taskDetail($id)
    {
        $task = ProjectTask::select('id', 'task_name', 'task_date', 'task_started_date', 'task_completed_date', 'project_id', 'featured_image', 'featured_image_url', 'featured_image_type', 'status', 'user_id', 'done_by', 'created_at', 'latitude', 'longitude')
            ->with('members.user:id,first_name,last_name,profile_pic_url,profile_pic_name,designation_id,created_at', 'members.user.designation:id,name', 'project:id,project_name,featured_image_url,status', 'project.attachments')
            ->findOrFail($id);
        $activities = TaskActivity::select('id', 'name', 'date', 'latitude', 'longitude', 'description', 'created_at')
            ->where('task_id', $id)
            ->with('attachments')
            ->get();
        return response()->json([
            'task' => $task,
            'activities' => $activities,
        ]);
    }

    public function employeeTasks()
    {
        $tasks = ProjectTaskMember::where('member_id', auth()->id())
        ->whereHas('task', function($query) {
            $query->where('status', 1);
        })->with('task:id,task_name,task_date,status,featured_image_url,created_at')->get();
        return response()->json([
            'tasks'=> $tasks
        ]);
    }
}
