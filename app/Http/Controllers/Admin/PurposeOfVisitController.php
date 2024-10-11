<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurposeOfVisit;
use Illuminate\Http\Request;

class PurposeOfVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $this->authorize('All Purpose of Visit');

        if($id){
            $data['purposeOfVisit'] = PurposeOfVisit::findOrFail($id);
        }

        $data['purposeOfVisits'] = PurposeOfVisit::orderBy('id','desc')->get();
        return view('new-admin.guest_vistors.purpose_of_visits.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Purpose of Visit');
        $request->validate([
            'name' => 'required|unique:purpose_of_visits|max:255|min:3',
            'type' => ['required']
        ]);

        PurposeOfVisit::create($request->all());

        return redirect()->route('purpose-of-visits.index')->with('success','Data Created Successfully!');
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
        $this->authorize('Edit Purpose of Visit');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:purpose_of_visits,name,'.$id,
            'type' => ['required']
        ]);

        PurposeOfVisit::findOrFail($id)->update($request->all());

        return redirect()->route('purpose-of-visits.index')->with('success','Data Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Purpose of Visit');
        PurposeOfVisit::findOrFail($id)->delete();
        return redirect()->route('purpose-of-visits.index')->with('success','Data Deleted Successfully!');

    }
}
