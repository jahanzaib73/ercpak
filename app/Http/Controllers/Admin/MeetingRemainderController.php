<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MeetingRemainderDateTime;
use Illuminate\Http\Request;

class MeetingRemainderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($meetingId)
    {
        $this->authorize('All Meeting Remainder');
        $data['remainders'] = MeetingRemainderDateTime::where('module_id',$meetingId)->where('module_name','Meeting')->get();
        $data['meeting_id'] = $meetingId;
        return view('admin.meetings_remainders.meetings.remainders.index',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Meeting Remainder');
        $request->validate([
            'date_time' => ['required','date_format:Y-m-d\TH:i','unique:meeting_remainder_date_times,date_time','after_or_equal:'.now()->toDateTimeLocalString()]
        ],[
            'date_time.unique' => 'Remainder with this date time already added.',
            'date_time.after_or_equal' => 'Remainder date should be current or future date.'
        ]);
        MeetingRemainderDateTime::create([
            'date_time' => $request->date_time,
            'module_name' => 'Meeting',
            'module_id' => $request->meeting_id,
        ]);

        return redirect()->back()->with('success','Remainder added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Meeting Remainder');
        MeetingRemainderDateTime::findOrFail($id)->delete();
        return redirect()->back()->with('success','Remainder deleted successfully.');
    }
}
