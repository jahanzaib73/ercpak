<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaManagementResource;
use App\Models\Area;
use App\Models\AssignedArea;
use App\Models\ProtocolLiaison;
use App\Models\Province;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamManagementApiController extends Controller
{
    public function index(Request $request)
    {
        $assigedAreasQuery = AssignedArea::when($request->filter_team_id, function ($query) use ($request) {
            if ($request->filter_team_id > 0) {
                $query->where('team_id', $request->filter_team_id);
            }
        })->where('session_year', $request->session_year)
            ->whereHas('area', function ($query) use ($request) {
                if ($request->province_id != 0) {
                    $query->where('province_id', $request->province_id);
                }
            });

        $teamMembers = TeamMember::with('team', 'user:id,first_name,last_name,designation_id,profile_pic_url', 'user.designation:id,name')->whereIn('id', $assigedAreasQuery->pluck('member_id'))->get();

        $provinces = Province::whereStatus(1)->select('id', 'name')->get();
        // Create an empty array to store cities grouped by provinces for each team member
        $teamMembers->map(function ($teamMember) use ($request, $provinces) {
            $assignedAreaIds = AssignedArea::when($request->filter_team_id, function ($query) use ($request) {
                if ($request->filter_team_id > 0) {
                    $query->where('team_id', $request->filter_team_id);
                }
            })->where('session_year', $request->session_year)->where('member_id', $teamMember->id)->pluck('area_id');


            // Create an array to store cities grouped by provinces
            $citiesByProvinces = [];

            foreach ($provinces as $province) {
                $cities = Area::whereIn('id', $assignedAreaIds)
                    ->where('province_id', $province->id)
                    ->pluck('area_name');
                $citiesByProvinces[$province->name] = $cities->isEmpty() ? [] : $cities;
            }

            // Attach the grouped cities to the team member
            $teamMember->cities_by_province = $citiesByProvinces;
        });

        $response = AreaManagementResource::collection($teamMembers);

        $teams = Team::whereStatus(1)->select('id', 'team_name')->get();
        $sessionYears = AssignedArea::pluck('session_year')->unique();

        return response()->json([
            'teamMembers' => $response,
            'teams' => $teams,
            'sessionYears' => $sessionYears,
            'provinces' => $provinces
        ]);
    }

    public function show($id)
    {
        $member = TeamMember::with('team:id,team_name,team_name_urdu,team_color,team_symbol,team_symbol_url,created_at', 'user:id,first_name,last_name,profile_pic_url')->findOrFail($id);
        $provinces = Province::whereStatus(1)->select('id', 'name', 'arabic_name', 'country_id')->get();
        $sessionYears = AssignedArea::pluck('session_year')->unique();

        return response()->json([
            'member' => $member,
            'provinces' => $provinces,
            'sessionYears' => $sessionYears,
        ]);
    }

    public function getAllotedAreas(Request $request)
    {
        $assignedAreaIds = AssignedArea::where('member_id', $request->member_id)
            ->where('session_year', $request->session_year)
            ->whereHas('area', function ($query) use ($request) {
                if ($request->province_id != 0) {
                    $query->where('province_id', $request->province_id);
                }
            })
            ->pluck('area_id');

        // Get all provinces
        $provinces = Province::all();

        // Create an array to store cities grouped by provinces
        $citiesByProvinces = [];

        foreach ($provinces as $province) {
            $cities = Area::whereIn('id', $assignedAreaIds)
                ->where('province_id', $province->id)
                ->pluck('area_name');
            $citiesByProvinces[$province->name] = $cities->isEmpty() ? [] : $cities;
        }
        return response()->json([
            'citiesByProvinces' => $citiesByProvinces,
        ]);
    }

    public function areaDetail($id)
    {

        $area = Area::select('id', 'city_id', 'province_id', 'area_name', 'status', 'polygon_coordinates', 'created_at')->with('getSignleAssignArea:id,area_id,team_id,session_year,created_at', 'getSignleAssignArea.team:id,team_name,team_name_urdu,team_color,team_symbol,team_symbol_url,created_at', 'photos:id,area_id,attachment_name,attachment_url,created_at', 'province:id,name')->findOrFail($id);

        $provinces = Province::whereStatus(1)->select('id', 'name')->get();

        $latestSessionYear = AssignedArea::where('area_id', $area->id)->max('session_year');

        $memberIds = AssignedArea::where('area_id', $area->id)->where('session_year', $latestSessionYear)->pluck('member_id');
        $teamIds = AssignedArea::where('area_id', $area->id)->where('session_year', $latestSessionYear)->pluck('team_id');

        $currentMembers = TeamMember::whereIn('id', $memberIds)->select('id', 'member_name', 'photo_name', 'photo_url', 'created_at')->get();
        $officials = ProtocolLiaison::where('protocol_liaisontype_id', 1)->where('city_id', $area->city_id)->select('id', 'official_name', 'official_designation', 'phone')->get();
        $notables = ProtocolLiaison::where('protocol_liaisontype_id', 2)->where('city_id', $area->city_id)->select('id', 'official_name', 'notable_name', 'official_designation', 'phone')->get();
        $assignAreas = AssignedArea::select('id', 'member_id', 'session_year', 'created_at')->with('member:id,member_name,photo_name,photo_url,created_at')->where('area_id', $area->id)->get();

        // Map officials with photo URLs
        $mappedOfficials = $officials->map(function ($official) {
            $photos = getProtocolLiaisonAttchments(ProtocolLiaison::OFFICIAL, $official->id, 'official_photo');
            $official->photo_url = $photos->first() ? $photos->first()->file_url : '';
            return $official;
        });

        // Map notables with photo URLs
        $mappedNotables = $notables->map(function ($notable) {
            $photos = getProtocolLiaisonAttchments(ProtocolLiaison::NOTABLE, $notable->id, 'notable_photo');
            $notable->photo_url = $photos->first() ? $photos->first()->file_url : '';
            return $notable;
        });

        return response()->json([
            'area' => $area,
            'currentMembers' => $currentMembers,
            'officials' => $mappedOfficials,
            'notables' => $mappedNotables,
            'assignAreas' => $assignAreas,
            'provinces' => $provinces
        ]);
    }

}
