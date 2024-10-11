<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\MeetingEmailJob;
use App\Models\Location;
use App\Models\Meeting;
use App\Models\MeetingHostParticipant;
use App\Models\ProtocolLiaison;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('All Meeting');
        if ($request->ajax()) {
            // dd($request->all());
            $meetings = Meeting::with('user', 'location')->latest();

            return DataTables::of($meetings)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) use ($request){
                        $btn='';
                        if (Auth::user()->can('View Meeting')){
                            $btn .= '<div class="d-flex align-items-center"><a href='.route('meetings.show',$row->id).' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                        }
                        if (Auth::user()->can('Edit Meeting')){
                            $btn .= ' | <a href='.route('meetings.edit',$row->id).' title="Edit Record" class="btn bg-info text-light btn-sm"><i class="fa fa-edit"></i></a>';
                        }
                        if (Auth::user()->can('Delete Meeting')){
                            $btn .= ' | <a href='.route('meetings.delete',$row->id).' onclick="return confirm(\'Are you sure?\')" title="Delete Record" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i></a>';
                        }
                        if (Auth::user()->can('All Meeting Remainder')){
                            $btn .= ' | <a href='.route('meetings.remainder.index',$row->id).' title="Add Remainders" class="btn btn-gray btn-sm remainder"><i class="fa fa-bell"></i></a></div>';
                        }
                        return $btn;
                    })->addColumn('status', function($row) use ($request){

                        $status = '';
                        if($row->status == 0){
                            $status = '<span class="badge badge-info">Schedule</span>';
                        }else if($row->status == 1){
                            $status = '<span class="badge badge-danger">Closed</span>';
                        }

                    return $status;
                })
                ->addColumn('number_of_participent', function ($row) {
                    return $row->participantCount;
                })->addColumn('number_of_host', function ($row) {
                    return $row->hostCount;
                })->addColumn('created_by', function ($row) {
                    return optional($row->user)->full_name;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data['totalMeeting'] = Meeting::totalMeetings();
        $data['todayMeeting'] = Meeting::todayMeetings();
        $data['totalPastMeeting'] = Meeting::totalPastMeetings();
        $data['totalUpcommingMeeting'] = Meeting::totalUpcommingMeetings();

        return view('admin.meetings_remainders.meetings.index', $data);
    }

    public function create()
    {
        $this->authorize('Add Meeting');
        $data['hostParticipents'] = ProtocolLiaison::with('protocolLiaisonType')->select('id', 'official_name', 'notable_name', 'protocol_liaisontype_id')->where('protocol_liaisontype_id', 1)
            ->orWhere('protocol_liaisontype_id', 2)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        return view('admin.meetings_remainders/meetings/create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Meeting');
        $request->validate([
            'meeting_title' => ['required', 'min:3', 'max:255'],
            'meeting_date_time' => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:' . now()->toDateTimeLocalString()],
            'meeting_end_date_time' => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:' . now()->toDateTimeLocalString()],
            'meeting_location' => ['required', 'numeric'],
            'host' => ['required', 'array'],
            'participant' => ['required', 'array'],
            'meeting_detail' => ['required', 'min:3'],
        ]);
        try {
            DB::beginTransaction();
            $meeting = Meeting::create([
                'meeting_title' => $request->meeting_title,
                'meeting_date_time' => $request->meeting_date_time,
                'meeting_end_date_time' => $request->meeting_end_date_time,
                'meeting_location' => $request->meeting_location,
                'meeting_detail' => $request->meeting_detail,
                'user_id' => Auth::id(),
            ]);

            foreach ($request->host as $hostId) {
                $hostType = explode(':', $hostId);
                MeetingHostParticipant::create([
                    'member_type' => 'Host',
                    'member_id' => $hostType[0],
                    'official_notable_type' => $hostType[1],
                    'meeting_id' => $meeting->id,
                ]);
            }

            foreach ($request->participant as $participantId) {
                $participantHostType = explode(':', $participantId);
                MeetingHostParticipant::create([
                    'member_type' => 'Participant',
                    'member_id' => $participantHostType[0],
                    'official_notable_type' => $participantHostType[1],
                    'meeting_id' => $meeting->id,
                ]);
            }

            MeetingEmailJob::dispatch($meeting, 'Added');
            DB::commit();

            return redirect()->route('meetings.index')->with('success', 'Meeting created successfully!');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        $this->authorize('View Meeting');
        $data['meeting'] = Meeting::with('hosts.officialNotable', 'participants.officialNotable')->findOrFail($id);
        return view('admin.meetings_remainders/meetings/show', $data);
    }

    public function edit($id)
    {
        $this->authorize('Edit Meeting');
        $data['hostParticipents'] = ProtocolLiaison::select('id', 'official_name', 'notable_name', 'protocol_liaisontype_id')->where('protocol_liaisontype_id', 1)
            ->orWhere('protocol_liaisontype_id', 2)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['meeting'] = Meeting::findOrFail($id);
        return view('admin.meetings_remainders/meetings/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('Edit Meeting');
        $request->validate([
            'meeting_title' => ['required', 'min:3', 'max:255'],
            'meeting_date_time' => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:' . now()->toDateTimeLocalString()],
            'meeting_end_date_time' => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:' . now()->toDateTimeLocalString()],
            'meeting_location' => ['required', 'numeric', 'max:255'],
            'host' => ['required', 'array'],
            'participant' => ['required', 'array'],
            'meeting_detail' => ['required', 'min:3'],
        ]);

        try {
            DB::beginTransaction();
            $meeting = Meeting::findOrFail($id);
            $meeting->update([
                'meeting_title' => $request->meeting_title,
                'meeting_date_time' => $request->meeting_date_time,
                'meeting_end_date_time' => $request->meeting_end_date_time,
                'meeting_location' => $request->meeting_location,
                'meeting_detail' => $request->meeting_detail,
            ]);

            MeetingHostParticipant::where('meeting_id', $id)->delete();

            foreach ($request->host as $hostId) {
                $hostType = explode(':', $hostId);
                MeetingHostParticipant::create([
                    'member_type' => 'Host',
                    'member_id' => $hostType[0],
                    'official_notable_type' => $hostType[1],
                    'meeting_id' => $meeting->id,
                ]);
            }

            foreach ($request->participant as $participantId) {
                $participantHostType = explode(':', $participantId);
                MeetingHostParticipant::create([
                    'member_type' => 'Participant',
                    'member_id' => $participantHostType[0],
                    'official_notable_type' => $participantHostType[1],
                    'meeting_id' => $meeting->id,
                ]);
            }

            MeetingEmailJob::dispatch($meeting, 'Updated');
            DB::commit();

            return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully!');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function delete($id)
    {
        $this->authorize('Delete Meeting');
        try {
            DB::beginTransaction();

            $meeting = Meeting::findOrFail($id);
            MeetingHostParticipant::where('meeting_id', $meeting->id)->delete();
            $meeting->delete();
            DB::commit();
            return redirect()->route('meetings.index')->with('success', 'Meeting deletd successfully!');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function clanderView(Request $request)
    {
        $this->authorize('Meeting Clander View');
        if ($request->ajax()) {
            $meetings = Meeting::all();
            $clandarData = [];
            $index = 0;
            foreach ($meetings as $meeting) {
                $clandarData[$index]['title'] = $meeting->meeting_title;
                $clandarData[$index]['url'] = route('meetings.show', ['id' => $meeting->id]);
                $clandarData[$index]['start'] = Carbon::parse($meeting->meeting_date_time)->toDateString();
                $index++;
            }

            $data['totalMeeting'] = Meeting::totalMeetings();
            $data['todayMeeting'] = Meeting::todayMeetings();
            $data['totalPastMeeting'] = Meeting::totalPastMeetings();
            $data['totalUpcommingMeeting'] = Meeting::totalUpcommingMeetings();

            return response()->json([
                'status' => true,
                'clandarData' => $clandarData,
                'chartData' => $data
            ], 200);
        }
        return view('admin.meetings_remainders.meetings.clander_view');
    }
}
