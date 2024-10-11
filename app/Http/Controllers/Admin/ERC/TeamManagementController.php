<?php

namespace App\Http\Controllers\Admin\ERC;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AssignedArea;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use App\Models\Team;
use App\Models\TeamMember;
use App\Traits\ProvinceCityTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TeamManagementController extends Controller
{
    use ProvinceCityTrait;

    public function index(Request $request)
    {
        $this->authorize('All Area');

        if ($request->ajax()) {

            $assigedAreasQuery = AssignedArea::when($request->filter_team_id, function ($query) use ($request) {
                if ($request->filter_team_id > 0) {
                    $query->where('team_id', $request->filter_team_id);
                }
            })->where('session_year', $request->session_year);

            $data = TeamMember::with('team')->whereIn('id', $assigedAreasQuery->pluck('member_id'));
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (Auth::user()->can('View Area')) {
                        $btn .= '<a href=' . route('teams.members.show', ['id' => $row->id]) . ' title="View Detail"><i class="fa-solid fa-eye text-info"></a>';
                    }
                    return $btn;
                })->addColumn('name', function ($row) {
                    return $row->member_name . "<br><b>" . optional($row->team)->team_name . "</b>";
                })->addColumn('image', function ($row) {
                    return "<img src=" . $row->photo_url . " alt='' width='50' />";
                })->addColumn('baluchistan', function ($row) use ($request) {
                    return  $this->getBluchistanCities($request, $row->id) ? "<a href='javascript:void(0)' class='text-danger'>" . $this->getBluchistanCities($request, $row->id) . "</a>" : 'N/A';
                })->addColumn('punjab', function ($row) use ($request) {
                    return $this->getPunjabCities($request, $row->id) ? "<a href='javascript:void(0)' class='text-danger'>" . $this->getPunjabCities($request, $row->id) . "</a>" : 'N/A';
                })->addColumn('sindh', function ($row) use ($request) {
                    return $this->getSindhCities($request, $row->id) ? "<a href='javascript:void(0)' class='text-danger'>" . $this->getSindhCities($request, $row->id) . "</a>" : 'N/A';
                })->addColumn('kpk', function ($row) use ($request) {
                    return $this->getKPKCities($request, $row->id) ? "<a href='javascript:void(0)' class='text-danger'>" . $this->getKPKCities($request, $row->id) . "</a>" : 'N/A';
                })
                ->rawColumns(['action', 'image', 'name', 'baluchistan', 'punjab', 'sindh', 'kpk'])
                ->make(true);
        }
        return view('admin.erc.index', $this->getBaseData());
    }

    private function getBaseData()
    {
        $data['cities'] = City::whereStatus(1)->get();
        $data['provinces'] = Province::whereStatus(1)->get();
        $data['countries'] = Country::whereStatus(1)->get();
        $data['teams'] = Team::with('members')->whereStatus(1)->get();
        $data['areas'] = Area::whereStatus(1)->get();
        $data['members'] = TeamMember::whereStatus(1)->get();
        $data['session_years'] = AssignedArea::pluck('session_year')->unique();

        return $data;
    }

    public function getStats(Request $request)
    {
        $assignedAreas = AssignedArea::where('session_year', $request->session)->get();

        $data['allAreasCount'] = $this->getAreasCount($assignedAreas);
        $data['allMembersCount'] = $this->getMembersCount($assignedAreas);
        $data['cardsData'] = $this->getCardsData($assignedAreas);

        return response()->json([
            'status' => true,
            'message' => "Stats Fetched",
            'data' => $data
        ]);
    }

    private function getAreasCount($assignedAreas)
    {
        return count($assignedAreas->pluck('area_id')->unique());
    }

    private function getMembersCount($assignedAreas)
    {
        return count($assignedAreas->pluck('member_id')->unique());
    }

    private function getCardsData($assignedAreas)
    {
        $teamIds = $assignedAreas->pluck('team_id')->unique()->toArray();
        $teams = Team::with('members')->whereIn('id', $teamIds)->get();
        $data = [];
        foreach ($teams as $key => $team) {
            $data[$key]['team_id'] = $team->id;
            $data[$key]['team_name'] = $team->team_name;
            $data[$key]['team_color'] = $team->team_color;
            $data[$key]['team_name_urdu'] = $team->team_name_urdu;
            $data[$key]['team_symbol_url'] = $team->team_symbol_url;
            $data[$key]['totalMembers'] = $assignedAreas->where('team_id', $team->id)->pluck('member_id')->unique()->count();
            $data[$key]['totalAreas'] = $assignedAreas->where('team_id', $team->id)->pluck('area_id')->unique()->count();
        }
        return $data;
    }
}
