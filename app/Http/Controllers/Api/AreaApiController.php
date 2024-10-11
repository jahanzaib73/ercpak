<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapAreaResource;
use App\Models\Area;
use App\Models\AssignedArea;
use App\Models\Province;
use Illuminate\Http\Request;

class AreaApiController extends Controller
{
    public function getAllAreas(Request $request)
    {
        $areaIds = AssignedArea::query();

        if ($request->showAll == 'true') {
            // Fetch all area_ids if showAll is true
            $areaIds = $areaIds;
        } else {
            // Filter by session_year if showAll is not true
            $areaIds = $areaIds->where('session_year', $request->session);
        }

        // Add condition for province_id if it's not 0
        if ($request->province_id != 0) {
            $areaIds->whereHas('area', function($query) use ($request) {
                $query->where('province_id', $request->province_id);
            });
        }

        // Get the area_ids
        $areaIds = $areaIds->pluck('area_id');

        $areas = Area::with([
            'getSignleAssignArea' => function ($query) use ($request) {
                return $query->where('session_year', $request->session)->with('team', 'member');
            }
        ])->whereIn('id', $areaIds)->get();

        $response = MapAreaResource::collection($areas);

        $provinces = Province::whereStatus(1)->select('id', 'name')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data Fatched',
            'areas' => $response,
            'provinces' => $provinces,
        ], 200);
    }


    public function getMapData(Request $request)
    {
        $assignedAreaIds = AssignedArea::where('member_id', $request->member_id)
            ->where('session_year', $request->session_year)
            ->whereHas('area', function ($query) use ($request) {
                if ($request->province_id != 0) {
                    $query->where('province_id', $request->province_id);
                }
            })
            ->pluck('area_id');
        $data = Area::select('id', 'area_name', 'status', 'polygon_coordinates', 'created_at')->with('getSignleAssignArea:id,area_id,team_id,session_year,created_at', 'getSignleAssignArea.team:id,team_name,team_name_urdu,team_color,team_symbol,team_symbol_url,created_at')->whereIn('id', $assignedAreaIds)->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Received',
            'data' => $data,
        ], 200);
    }
}
