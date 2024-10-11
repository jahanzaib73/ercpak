<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attandance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttandanceApiController extends Controller
{
    public function attandanceForm()
    {
        $attendances = Attandance::select('date_time', 'attandance_status')->where('user_id', Auth::user()->id)->get();
        return response()->json(['attendances' => $attendances]);
    }

    public function attandanceStore(Request $request)
    {
        $user = Auth::user();

        $existingAttendance = Attandance::where('user_id', $user->id)
            ->whereDate('date_time', Carbon::now()->toDateString())
            ->first();

        if ($existingAttendance) {
            $success = false;
            $message = 'Attendance already marked for today';
        } else {
            Attandance::create([
                'user_id' => $user->id,
                'date_time' => Carbon::now(),
                'attandance_status' => Attandance::PRESENT
            ]);
            $success = true;
            $message = 'Attendance marked successfully';
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function getUserAttandance()
    {
        $attandace = Attandance::where('user_id', Auth::user()->id)->get();
        return response()->json([
            'status' => true,
            'data' => $attandace
        ], 200);
    }
}
