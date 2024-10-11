<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desigination;
use Illuminate\Http\Request;

class DesiginationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $this->authorize('All Designation');

        if($id){
            $data['desigination'] = Desigination::findOrFail($id);
        }

        $data['desiginations'] = Desigination::orderBy('id','desc')->get();
        return view('new-admin.user_management.desigination.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Designation');
        $request->validate([
            'name' => 'required|unique:desiginations|max:255|min:3',
        ]);

        Desigination::create($request->all());

        return redirect()->route('desiginations.index')->with('success','Designation Created Successfully!');
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
        $this->authorize('Edit Designation');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:desiginations,name,'.$id,
        ]);

        Desigination::findOrFail($id)->update($request->all());

        return redirect()->route('desiginations.index')->with('success','Designation Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Designation');
        Desigination::findOrFail($id)->delete();
        return redirect()->route('desiginations.index')->with('success','Designation Deleted Successfully!');

    }
}
