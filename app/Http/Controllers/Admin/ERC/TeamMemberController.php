<?php

namespace App\Http\Controllers\Admin\ERC;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AssignedArea;
use App\Models\Province;
use App\Models\Team;
use App\Models\TeamMember;
use App\Traits\ProvinceCityTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeamMemberController extends Controller
{
    use ProvinceCityTrait;

    public function index()
    {
        $data['teams'] = Team::whereStatus(1)->get();
        $data['teamMembers'] = TeamMember::latest()->get();
        return view('admin.erc.team_members.index', $data);
    }


    public function store(Request $request)
    {
        $this->authorize('Add Member');
        $url = null;
        $fileName = null;
        if ($request->has('member_photo')) {
            $extension = $request->member_photo->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->member_photo->move(public_path('team_member'), $fileName);
            $url = asset('/team_member/' . $fileName);
        }

        TeamMember::create([
            "member_name" => $request->team_member_name,
            "team_id" => $request->team_id ?: 0,
            "photo_name" => $fileName,
            'photo_url' =>  $url,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Team Member Added Successfully',
        ], 200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Member');
        // dd($request->all());
        $member = TeamMember::findOrFail($request->member_id);
        $url = $member->photo_url;
        $fileName = $member->photo_name;
        if ($request->has('member_photo')) {
            $extension = $request->member_photo->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->member_photo->move(public_path('team_member'), $fileName);
            $url = asset('/team_member/' . $fileName);
        }

        $member->update([
            "member_name" => $request->team_member_name,
            "team_id" => $request->team_id ?: 0,
            "photo_name" => $fileName,
            'photo_url' =>  $url,
            'status' =>  $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Team Member Updated Successfully',
        ], 200);
    }

    public function show($id)
    {
        $this->authorize('View Member');
        $data['member'] = TeamMember::with('team', 'user')->findOrFail($id);
        $data['provinces'] = Province::whereStatus(1)->get();
        $data['session_years'] = AssignedArea::pluck('session_year')->unique();

        return view('admin.erc.team_members.show', $data);
    }

    public function getAllotedAreas(Request $request)
    {
        $areaIds = AssignedArea::where('member_id', $request->member_id)->where('session_year', $request->session_year)->pluck('area_id');
        $data = Area::whereIn('id', $areaIds);
        // dd($data);
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('baluchistan', function ($row) use ($request) {
                return optional($row->province)->name == 'Baluchistan' ? "<a target='_blank' href=" . route('areas.detail', ['id' => $row->id]) . " class='text-danger'>" . optional(optional($row->city))->name . "</a>"  : '';
            })->addColumn('punjab', function ($row) use ($request) {
                return optional($row->province)->name == 'Punjab' ? "<a target='_blank' href=" . route('areas.detail', ['id' => $row->id]) . " class='text-danger'>" . optional(optional($row->city))->name . "</a>"  : '';
            })->addColumn('sindh', function ($row) use ($request) {
                return optional($row->province)->name == 'Sindh' ? "<a target='_blank' href=" . route('areas.detail', ['id' => $row->id]) . " class='text-danger'>" . optional(optional($row->city))->name . "</a>"  : '';
            })->addColumn('kpk', function ($row) use ($request) {
                return optional($row->province)->name == 'Khyber Pk' ? "<a target='_blank' href=" . route('areas.detail', ['id' => $row->id]) . " class='text-danger'>" . optional(optional($row->city))->name . "</a>"  : '';
            })
            ->rawColumns(['baluchistan', 'punjab', 'sindh', 'kpk'])
            ->make(true);
    }

    public function getMapData(Request $request)
    {
        $areaIds = AssignedArea::where('member_id', $request->member_id)->where('session_year', $request->session_year)->pluck('area_id');
        $data = Area::with('getSignleAssignArea.team')->whereIn('id', $areaIds)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Received',
            'data' => $data,
        ], 200);
    }
}
