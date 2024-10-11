<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AircraftVessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirCraftTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        // if(!isSuperAdmin()){
        //     abort(403,'You don\'t have permission to access on this resource');
        // }

        if($id){
            $data['airCraftType'] = AircraftVessel::findOrFail($id);
        }

        $query = AircraftVessel::orderBy('id','desc');

        if(!isSuperAdmin()){
            $data['airCraftTypes'] = $query->where('user_id',Auth::id())->get();
        }else{
            $data['airCraftTypes'] = $query->get();
        }

        return view('admin.flight_and_cargo/aircraft_type/index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(!isSuperAdmin()){
        //     abort(403,'You don\'t have permission to access on this resource');
        // }
        $request->validate([
            'name' => 'required|unique:aircraft_vessels|max:255|min:3',
        ]);

        AircraftVessel::create($request->all());

        return redirect()->route('aircraft-type.index')->with('success','Aircraft Type Created Successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if(!isSuperAdmin()){
        //     abort(403,'You don\'t have permission to access on this resource');
        // }
        $request->validate([
            'name' => 'required|max:255|min:3|unique:aircraft_vessels,name,'.$id,
        ]);

        AircraftVessel::findOrFail($id)->update($request->all());

        return redirect()->route('aircraft-type.index')->with('success','Aircraft Type Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!isSuperAdmin()){
        //     abort(403,'You don\'t have permission to access on this resource');
        // }
        AircraftVessel::findOrFail($id)->delete();
        return redirect()->route('aircraft-type.index')->with('success','Aircraft Type Deleted Successfully!');

    }
}
