<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAllowance;
use Illuminate\Http\Request;

class UserAllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $this->authorize('All Country');
        $data['allowance_owner_id'] = $id;
        $data['allowances'] = UserAllowance::where('allowance_owner_id',$id)->orderBy('id','desc')->get();

        return view('admin.user_management.user-allowances.index', compact('data'));
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
            'name' => 'required|max:255|min:3',
            'amount' => ['required','numeric']
        ]);

        UserAllowance::create($request->all());

        return redirect()->route('user-allowances.index',$request->allowance_owner_id)->with('success','User Allowance Added Successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $this->authorize('Edit Country');
    //     $request->validate([
    //         'name' => 'required|max:255|min:3|unique:user_allowances,name,'.$id,
    //         'amount' => ['required','numeric']
    //     ]);

    //     UserAllowance::findOrFail($id)->update($request->all());

    //     return redirect()->route('countries.index')->with('success','User Allowance Updated Successfully!');


    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Country');
        UserAllowance::findOrFail($id)->delete();
        return redirect()->back()->with('success','User Allowance Deleted Successfully!');

    }
}
