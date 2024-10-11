<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IssuingAuthority;
use Illuminate\Http\Request;

class IssuingAuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
       $this->authorize('All Issuing Authority');

        if($id){
            $data['issuingAuthorit'] = IssuingAuthority::findOrFail($id);
        }

        $data['issuingAuthorits'] = IssuingAuthority::latest()->get();
        return view('admin.meetings_remainders/remainders/ issuing_authority/index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->authorize('Add Issuing Authority');

        $request->validate([
            'name_of_issuing_authorities' => 'required|unique:issuing_authorities|max:255|min:3',
            'contact_person_name' => 'required|max:255|min:3',
            'contact_person_number' => 'required|unique:issuing_authorities|max:11|min:11',
        ]);


        $logo = '';
        $logo_url = '';
        if($request->has('logo')){
            $logo = rand(1,100000).time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('issuing_authority_logo'), $logo);
            $logo_url = asset('/issuing_authority_logo/'.$logo);
        }

        IssuingAuthority::create([
            'name_of_issuing_authorities' => $request->name_of_issuing_authorities,
            'contact_person_name' => $request->contact_person_name,
            'contact_person_number' => $request->contact_person_number,
            'logo' => $logo,
            'logo_url' => $logo_url,
            'status' => $request->status,
        ]);

        return redirect()->route('issuing-authorities.index')->with('success','Issuing Authority Created Successfully!');
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
       $this->authorize('Edit Issuing Authority');
        $request->validate([
            'name_of_issuing_authorities' => 'required|max:255|min:3|unique:issuing_authorities,name_of_issuing_authorities,'.$id,
            'contact_person_name' => 'required|max:255|min:3',
            'contact_person_number' => 'required|min:11|max:11|unique:issuing_authorities,contact_person_number,'.$id,
        ]);

        $logo = '';
        $logo_url = '';
        if($request->has('logo')){
            $logo = rand(1,100000).time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('issuing_authority_logo'), $logo);
            $logo_url = asset('/issuing_authority_logo/'.$logo);
        }

        IssuingAuthority::findOrFail($id)->update([
            'name_of_issuing_authorities' => $request->name_of_issuing_authorities,
            'contact_person_name' => $request->contact_person_name,
            'contact_person_number' => $request->contact_person_number,
            'logo' => $logo,
            'logo_url' => $logo_url,
            'status' => $request->status,
        ]);

        return redirect()->route('issuing-authorities.index')->with('success','Issuing Authority Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->authorize('Delete Issuing Authority');
        IssuingAuthority::findOrFail($id)->delete();
        return redirect()->route('issuing-authorities.index')->with('success','Issuinging Authority Deleted Successfully!');

    }
}
