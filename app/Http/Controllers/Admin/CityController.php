<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $this->authorize('All City');

        if($id){
            $data['city'] = City::findOrFail($id);
        }

        $query = City::with('province')->orderBy('id','desc');

        if(!isSuperAdmin()){
            $data['cites'] = $query->where('user_id',Auth::id())->get();
        }else{
            $data['cites'] = $query->get();
        }

        $data['provinces'] = Province::whereStatus(1)->get();
        return view('new-admin.user_management.cities.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add City');
        $request->validate([
            'name' => 'required|unique:cities|max:255|min:3',
            'province_id' => 'required|numeric',
        ]);

        City::create($request->all());

        return redirect()->route('cities.index')->with('success','City Created Successfully!');
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
        $this->authorize('Edit City');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:cities,name,'.$id,
            'province_id' => 'required|numeric',
        ]);

        City::findOrFail($id)->update($request->all());

        return redirect()->route('cities.index')->with('success','City Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete City');
        City::findOrFail($id)->delete();
        return redirect()->route('cities.index')->with('success','City Deleted Successfully!');

    }
}
