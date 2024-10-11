<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RemainderType;
use Illuminate\Http\Request;

class RemainderTypeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
       $this->authorize('All Remainder Type');

        if($id){
            $data['remainderType'] = RemainderType::findOrFail($id);
        }

        $data['remainderTypes'] = RemainderType::orderBy('id','desc')->get();
        return view('admin.meetings_remainders/remainders/remainders_type/index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->authorize('Add Remainder Type');
        $request->validate([
            'name' => 'required|unique:remainder_types|max:255|min:3',
        ]);

        RemainderType::create($request->all());

        return redirect()->route('remainders-types.index')->with('success','Remainder Type Created Successfully!');
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
       $this->authorize('Edit Remainder Type');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:remainder_types,name,'.$id,
        ]);

        RemainderType::findOrFail($id)->update($request->all());

        return redirect()->route('remainders-types.index')->with('success','Remainder Type Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->authorize('Delete Remainder Type');
        RemainderType::findOrFail($id)->delete();
        return redirect()->route('remainders-types.index')->with('success','Remainder Type Deleted Successfully!');

    }
}
