<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
       $this->authorize('All Province');

        if($id){
            $data['province'] = Province::findOrFail($id);
        }

        $data['provinces'] = Province::with('country')->orderBy('id','desc')->get();
        $data['countries'] = Country::whereStatus(1)->get();
        // return view('admin.user_management.provices.index', compact('data'));
        return view('new-admin.user_management.provices.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->authorize('Add Province');
        $request->validate([
            'name' => 'required|unique:provinces|max:255|min:3',
            'country_id' => 'required|numeric',
        ]);

        Province::create($request->all());

        return redirect()->route('provinces.index')->with('success','Province Created Successfully!');
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
       $this->authorize('Edit Province');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:provinces,name,'.$id,
            'country_id' => 'required|numeric',
        ]);

        Province::findOrFail($id)->update($request->all());

        return redirect()->route('provinces.index')->with('success','Province Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->authorize('Delete Province');
        Province::findOrFail($id)->delete();
        return redirect()->route('provinces.index')->with('success','Province Deleted Successfully!');

    }
}
