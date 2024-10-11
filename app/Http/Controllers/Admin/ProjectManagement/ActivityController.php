<?php

namespace App\Http\Controllers\Admin\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\ProjectTaskAttachment;
use App\Models\TaskActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $activity = TaskActivity::create([
                "name" => $request->name,
                "location_id" => $request->location_id,
                "date" => $request->date,
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
                "description" => $request->description,
                "description_arabic" => $request->description_arabic,
                'task_id' => $request->task_id,
            ]);

            if ($request->has('files')) {
                foreach ($request->file('files') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('project_task_activity'), $fileName);
                    $url = asset('/project_task_activity/' . $fileName);
                    $type = $extension;
                    ProjectTaskAttachment::create([
                        'file_name' => $fileName,
                        'file_type' => $type,
                        'file_url' => $url,
                        'task_id' => $activity->id,
                        'source' => 2
                    ]);
                }
            }


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Activity Added Successfully',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }
}
