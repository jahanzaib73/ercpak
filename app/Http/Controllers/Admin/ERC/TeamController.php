<?php

namespace App\Http\Controllers\Admin\ERC;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $data['teams'] = Team::latest()->get();
        $data['cities'] = City::whereStatus(1)->get();
        $data['countries'] = Country::whereStatus(1)->get();
        return view('admin.erc.teams.index', $data);
    }

    public function store(Request $request)
    {

        $this->authorize('Add Team');
        // dd($request);
        $url = null;
        $fileName = null;
        if ($request->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->file->move(public_path('teams'), $fileName);
            $url = asset('/teams/' . $fileName);
        }

        Team::create([
            "team_name" => $request->team_name,
            "team_name_urdu" => $request->team_name_urdu,
            "team_color" => $request->team_color ?: 0,
            "city_id" => $request->team_city ?: 0,
            "country_id" => $request->team_country ?: 0,
            "team_symbol" => $fileName,
            'team_symbol_url' =>  $url,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Team Added Successfully',
        ], 200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Team');

        $team = Team::findOrFail($request->team_id);

        $url = $team->team_symbol_url;
        $fileName = $team->team_symbol_url;
        if ($request->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->file->move(public_path('teams'), $fileName);
            $url = asset('/teams/' . $fileName);
        }

        $team->update([
            "team_name" => $request->team_name,
            "team_name_urdu" => $request->team_name_urdu,
            "team_color" => $request->team_color ?: 0,
            "city_id" => $request->team_city ?: 0,
            "country_id" => $request->team_country ?: 0,
            "team_symbol" => $fileName,
            'team_symbol_url' =>  $url,
            'status' =>  $request->team_status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Team Updated Successfully',
        ], 200);
    }

    public function getAllTeams()
    {
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Data Fatched',
        //     'data' => Area::all()
        // ], 200);
    }
}
