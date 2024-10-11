<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $this->authorize('All Country');

        if($id){
            $data['country'] = Country::findOrFail($id);
        }

        $data['countries'] = Country::orderBy('id','desc')->get();
        // return view('admin.user_management.countries.index', compact('data'));
        return view('new-admin.user_management.countries.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Country');
        $request->validate([
            'name' => 'required|unique:countries|max:255|min:3',
        ]);

        Country::create($request->all());

        return redirect()->route('countries.index')->with('success','Country Created Successfully!');
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
        $this->authorize('Edit Country');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:countries,name,'.$id,
        ]);

        Country::findOrFail($id)->update($request->all());

        return redirect()->route('countries.index')->with('success','Country Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Country');
        Country::findOrFail($id)->delete();
        return redirect()->route('countries.index')->with('success','Country Deleted Successfully!');

    }
}
