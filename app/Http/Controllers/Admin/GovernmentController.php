<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Government;
use Illuminate\Http\Request;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
         $this->authorize('All Government');
        if($id){
            $data['government'] = Government::findOrFail($id);
        }

        $data['governments'] = Government::orderBy('id','desc')->get();
        // return view('admin.departments/governments/index', compact('data'));
        return view('new-admin.depertments.governments.index', compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->authorize('Add Government');
        $request->validate([
            'name' => 'required|unique:governments|max:255|min:3',
        ]);

        Government::create($request->all());

        return redirect()->route('government.index')->with('success','Government Created Successfully!');
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
         $this->authorize('Edit Government');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:governments,name,'.$id,
        ]);

        Government::findOrFail($id)->update($request->all());

        return redirect()->route('government.index')->with('success','Government Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Government');
        Government::findOrFail($id)->delete();
        return redirect()->route('government.index')->with('success','Government Deleted Successfully!');
    }
}
