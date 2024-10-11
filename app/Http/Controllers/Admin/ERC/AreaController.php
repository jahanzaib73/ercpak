<?php

namespace App\Http\Controllers\Admin\ERC;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaAttachment;
use App\Models\AssignedArea;
use App\Models\City;
use App\Models\ProtocolLiaison;
use App\Models\Province;
use App\Models\Team;
use App\Models\TeamMember;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $data['cities'] = City::whereStatus(1)->get();
        $data['provinces'] = Province::whereStatus(1)->get();
        $data['areas'] = Area::latest()->get();
        return view('admin.erc.areas.index', $data);
    }
    public function store(Request $request)
    {
        $this->authorize('Create Area');

        try {
            DB::beginTransaction();
            $area = Area::create([
                'area_name' => $request->area_name,
                'city_id' => $request->city_id,
                'province_id' => $request->province_id,
                'polygon_coordinates' => $request->polygon,
            ]);

            if ($request->has('area_photoes')) {
                foreach ($request->area_photoes as $file) {

                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('area_photos'), $fileName);
                    $url = asset('/area_photos/' . $fileName);

                    AreaAttachment::create([
                        'attachment_name' => $fileName,
                        'attachment_url' => $url,
                        'area_id' => $area->id,
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Area Created Successfully',
            ], 200);
        } catch (Exception $exception) {
            //throw $th;
        }
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Area');

        try {
            // dd($request->all());
            DB::beginTransaction();
            $area = Area::findOrFail($request->area_id);
            $area->update([
                'area_name' => $request->area_name,
                'city_id' => $request->city_id,
                'province_id' => $request->province_id,
                'polygon_coordinates' => $request->polygon,
            ]);

            if ($request->has('area_photoes')) {
                foreach ($request->area_photoes as $file) {

                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('area_photos'), $fileName);
                    $url = asset('/area_photos/' . $fileName);

                    AreaAttachment::create([
                        'attachment_name' => $fileName,
                        'attachment_url' => $url,
                        'area_id' => $area->id,
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Area Updated Successfully',
            ], 200);
        } catch (Exception $exception) {
            //throw $th;
        }
    }


    public function assignArea(Request $request)
    {
        AssignedArea::create([
            'area_id' => $request->area_id,
            'member_id' => $request->member_id,
            'team_id' => $request->team_id,
            'session_year' => $request->year,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Area Created Successfully',
        ], 200);
    }

    public function getAllAreas(Request $request)
    {
        if ($request->showAll == 'true') {
            $areaIds = AssignedArea::pluck('area_id');
        } else {
            $areaIds = AssignedArea::where('session_year', $request->session)->pluck('area_id');
        }

        // $data = Area::with([
        //     'getSignleAssignArea' => function ($query) use ($request) {
        //         return $query->where('session_year', $request->session)->with('team', 'member');
        //     }
        // ])->whereIn('id', $areaIds)->get();

        $data = Area::with([
            'getSignleAssignArea' => function ($query) use ($request) {
                return $query->where('session_year', $request->session)->with('team', 'member');
            }
        ])->whereIn('id', $areaIds)->get();

        // Loop through the $data collection and add URL details
        $data->transform(function ($area) {
            $area->url = route('areas.detail', ['id' => $area->id]); // Adjust the route name and parameters as needed
            return $area;
        });

        return response()->json([
            'status' => true,
            'message' => 'Data Fatched',
            'data' => $data
        ], 200);
    }

    public function areaDetail($id)
    {
        $this->authorize('View Area');

        $data['area'] = Area::with('getSignleAssignArea.team', 'photos')->findOrFail($id);

        $latestSessionYear = AssignedArea::where('area_id', $data['area']->id)->max('session_year');

        $memberIds = AssignedArea::where('area_id', $data['area']->id)->where('session_year', $latestSessionYear)->pluck('member_id');
        $teamIds = AssignedArea::where('area_id', $data['area']->id)->where('session_year', $latestSessionYear)->pluck('team_id');

        // $memberIds = AssignedArea::where('session_year', Carbon::now()->year)->where('area_id', $data['area']->id)->pluck('member_id');
        // $teamIds = AssignedArea::where('session_year', Carbon::now()->year)->where('area_id', $data['area']->id)->pluck('team_id');
        $data['currentMembers'] = TeamMember::whereIn('id', $memberIds)->get();
        $data['currentTeam'] = Team::whereIn('id', $teamIds)->first();
        $data['officials'] = ProtocolLiaison::where('protocol_liaisontype_id', 1)->where('city_id', $data['area']->city_id)->get();
        $data['notables'] = ProtocolLiaison::where('protocol_liaisontype_id', 2)->where('city_id', $data['area']->city_id)->get();
        $data['assignAreas'] = AssignedArea::with('member', 'team')->where('area_id', $data['area']->id)->get();
        return view('admin.erc.areas.detail', $data);
    }
}
