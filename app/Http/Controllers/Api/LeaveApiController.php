<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attandance;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaveApiController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        $leaves = Leave::select('id', 'start_date', 'end_date', 'reason', 'total_days', 'status', 'created_at')->where('user_id', '=', $user->id)->get();
        $totalLeaves = (int) $user->leaves;
        $availedLeaves = (int) $user->getLeavesCount();
        $leavesBalance = (int) $user->getLeavesBalance();
        return response()->json([
            'leaves' => $leaves,
            'totalLeaves' => $totalLeaves,
            'availedLeaves' => $availedLeaves,
            'leavesBalance' => $leavesBalance,
        ]);
    }

    public function userLeaves()
    {
        $user = User::findOrFail(Auth::id());
        $userLeaves = Leave::select('id', 'start_date', 'end_date', 'reason', 'total_days', 'status', 'created_at')->where('user_id', '=', $user->id)->get();
        $totalLeaves = (int) $user->leaves;
        $availedLeaves = (int) $user->getLeavesCount();
        $leavesBalance = (int) $user->getLeavesBalance();
        return response()->json([
            'userLeaves' => $userLeaves,
            'totalLeaves' => $totalLeaves,
            'availedLeaves' => $availedLeaves,
            'leavesBalance' => $leavesBalance,
        ]);
    }

    public function storeLeave(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required',
            ]);

            $startDateString = $request->input('start_date');
            $endDateString = $request->input('end_date');

            $startDate = new DateTime($startDateString);
            $endDate = new DateTime($endDateString);

            // Calculate the duration of leave
            $numberOfDays = $endDate->diff($startDate)->days + 1;

            // Create a new Leave model instance and save the data
            // Add $numberOfDays to the request data
            $requestData = $request->all();
            $requestData['total_days'] = $numberOfDays;

            // Create a new Leave model instance and save the data
            Leave::create($requestData);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Leave Applied Successfully"
            ], 200);
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Something went wrong"
            ], 422);
        }
    }

    public function approveLeave($id)
    {
        try {
            DB::beginTransaction();

            $leave = Leave::findOrFail($id);
            $leave->status = Leave::APPROVED;
            $leave->update();

            // Assuming $startDate and $endDate are instances of Carbon
            $startDate = Carbon::parse($leave->start_date);
            $endDate = Carbon::parse($leave->end_date);

            // Create an array to store all the dates
            $dateRange = [];

            // Iterate through each day between start and end dates
            while ($startDate->lte($endDate)) {
                $dateRange[] = $startDate->toDateString(); // Add the current date to the array
                $startDate->addDay(); // Move to the next day
            }
            // dd($leave, $dateRange);

            foreach ($dateRange as $date) {
                // Check if an attendance record exists for the current date
                $existingAttendance = Attandance::where([
                    'user_id' => $leave->user_id,
                    'date_time' => $date,
                ])->first();

                if ($existingAttendance) {
                    // Update the attendance status if the record exists
                    $existingAttendance->update([
                        'attandance_status' => Attandance::LEAVE,
                    ]);
                } else {
                    // Create a new attendance record if it doesn't exist
                    Attandance::create([
                        'user_id' => $leave->user_id,
                        'date_time' => $date,
                        'attandance_status' => Attandance::LEAVE,
                    ]);
                }
            }


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Attendance Approved successfully"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Something went wrong"
            ], 422);
        }
    }
}
