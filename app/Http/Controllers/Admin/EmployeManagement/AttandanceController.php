<?php

namespace App\Http\Controllers\Admin\EmployeManagement;

use App\Http\Controllers\Controller;
use App\Models\Attandance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttandanceController extends Controller
{
    public function attandanceForm()
    {
        $attendances = Attandance::select('date_time', 'attandance_status')->where('user_id', Auth::user()->id)->get();

        return view('admin.employee_management.attandance_form', compact('attendances'));
    }

    public function attandanceStore(Request $request)
    {
        $user = Auth::user();

        $existingAttendance = Attandance::where('user_id', $user->id)
            ->whereDate('date_time', Carbon::now()->toDateString())
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'Attendance already marked for today');
        }

        Attandance::create([
            'user_id' => $user->id,
            'date_time' => Carbon::now(),
            'attandance_status' => Attandance::PRESENT
        ]);

        return redirect()->back()->with('success', 'Attendance marked successfully');
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
