<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProjectTaskAttachment;
use App\Models\TaskActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityApiController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'task_id' => ['required'],
                'files' => ['nullable']
            ]);

            $activity = TaskActivity::create([
                "name" => $request->name,
                "date" => Carbon::today()->toDateString(),
                "latitude" => $request->latitude,
                "longitude" => $request->longitude,
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
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
