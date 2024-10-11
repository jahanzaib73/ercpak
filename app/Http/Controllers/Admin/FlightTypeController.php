<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlightType;
use Illuminate\Http\Request;

class FlightTypeController extends Controller
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
            $data['flightType'] = FlightType::findOrFail($id);
        }

        $data['flightTypes'] = FlightType::orderBy('id','desc')->get();

        return view('admin.flight_and_cargo/flight_type/index', compact('data'));
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
            'name' => 'required|unique:flight_types|max:255|min:3',
        ]);

        FlightType::create($request->all());

        return redirect()->route('flight-type.index')->with('success','Flight Type Created Successfully!');
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
            'name' => 'required|max:255|min:3|unique:flight_types,name,'.$id,
        ]);

        FlightType::findOrFail($id)->update($request->all());

        return redirect()->route('flight-type.index')->with('success','Flight Type Updated Successfully!');


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
        FlightType::findOrFail($id)->delete();
        return redirect()->route('flight-type.index')->with('success','Flight Type Deleted Successfully!');

    }
}
