<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlightCargoType;
use Illuminate\Http\Request;

class FlightCargoTypeController extends Controller
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
            $data['flightCargoType'] = FlightCargoType::findOrFail($id);
        }

        $data['flightCargoTypes'] = FlightCargoType::orderBy('id','desc')->get();

        return view('admin.flight_and_cargo/flight_cargo_type/index', compact('data'));
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
            'name' => 'required|unique:flight_cargo_types|max:255|min:3',
        ]);

        FlightCargoType::create($request->all());

        return redirect()->route('flight-cargo-type.index')->with('success','Flight Cargo Type Created Successfully!');
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
            'name' => 'required|max:255|min:3|unique:flight_cargo_types,name,'.$id,
        ]);

        FlightCargoType::findOrFail($id)->update($request->all());

        return redirect()->route('flight-cargo-type.index')->with('success','Flight Cargo Type Updated Successfully!');


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
        FlightCargoType::findOrFail($id)->delete();
        return redirect()->route('flight-cargo-type.index')->with('success','Flight Cargo Type Deleted Successfully!');

    }
}
