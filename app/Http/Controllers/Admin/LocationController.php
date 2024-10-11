<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\Province;
use Illuminate\Http\Request;

class LocationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
       $this->authorize('All Location');

        if($id){
            $data['location'] = Location::findOrFail($id);
        }

        $data['locations'] = Location::orderBy('id','desc')->get();
        $data['provinces'] = Province::whereStatus(1)->get();
        $data['countries'] = Country::whereStatus(1)->get();
        $data['cities'] = City::whereStatus(1)->get();
        // return view('admin.user_management.locations.index', compact('data'));
        return view('new-admin.user_management.locations.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->authorize('Add Location');
        $request->validate([
            'name' => 'required|unique:locations|max:255|min:3',
            'country_id' => ['required','numeric'],
            'city_id' => ['required','numeric'],
            'province_id' => ['required','numeric'],
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')->with('success','Location Created Successfully!');
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
       $this->authorize('Edit Location');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:locations,name,'.$id,
            'country_id' => ['required','numeric'],
            'city_id' => ['required','numeric'],
            'province_id' => ['required','numeric'],
        ]);

        Location::findOrFail($id)->update($request->all());

        return redirect()->route('locations.index')->with('success','Location Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->authorize('Delete Location');
        Location::findOrFail($id)->delete();
        return redirect()->route('locations.index')->with('success','Location Deleted Successfully!');

    }
}
