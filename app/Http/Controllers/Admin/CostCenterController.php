<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CostCenter;
use Illuminate\Http\Request;

class CostCenterController extends Controller
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
            $data['costCenter'] = CostCenter::findOrFail($id);
        }

        $data['costCenters'] = CostCenter::orderBy('id','desc')->get();
        return view('new-admin.user_management.cost-centers.index',compact('data'));
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
            'title' => 'required|unique:cost_centers|max:255|min:3',
        ]);

        CostCenter::create($request->all());

        return redirect()->route('cost-centers.index')->with('success','Cost Center Created Successfully!');
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
            'title' => 'required|max:255|min:3|unique:cost_centers,title,'.$id,
        ]);

        CostCenter::findOrFail($id)->update($request->all());

        return redirect()->route('cost-centers.index')->with('success','Cost Center Updated Successfully!');


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
        CostCenter::findOrFail($id)->delete();
        return redirect()->route('cost-centers.index')->with('success','Cost Center Deleted Successfully!');

    }
}
