<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $this->authorize('All Complaint Type');

        if($id){
            $data['complaintType'] = ComplaintType::findOrFail($id);
        }

        $data['complaintTypes'] = ComplaintType::orderBy('id','desc')->get();
        return view('admin.complaint-types.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Complaint Type');
        $request->validate([
            'name' => 'required|unique:complaint_types|max:255|min:3',
        ]);

        ComplaintType::create($request->all());

        return redirect()->route('complaint-types.index')->with('success','Complaint Type Created Successfully!');
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
        $this->authorize('Edit Complaint Type');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:complaint_types,name,'.$id,
        ]);

        ComplaintType::findOrFail($id)->update($request->all());

        return redirect()->route('complaint-types.index')->with('success','Complaint Type Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Complaint Type');
        ComplaintType::findOrFail($id)->delete();
        return redirect()->route('complaint-types.index')->with('success','Complaint Type Deleted Successfully!');

    }
}
