<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProtocolLiaisonPeople;
use Illuminate\Http\Request;

class TeamProtocolLiaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($protocolLiaisonId)
    {
        $this->authorize('All Teams');
        $data['teams'] = ProtocolLiaisonPeople::where('protocol_liaison_id',$protocolLiaisonId)->latest()->get();
        $data['protocolLiaisonId'] = $protocolLiaisonId;
        // dd();
        return view('admin.protocol_liaisons/teams/index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('Add Teams');
        $data['protocolLiaisonId'] = $id;
        return view('admin.protocol_liaisons.teams.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Teams');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'Designation' => ['required','string','min:3','max:255'],
            'contact_number' => ['required','string','min:11','max:11'],
            'team_memberphoto' => ['required','image','mimes:jpg,jpeg,png,gif'],
        ],[
            'team_memberphoto.required' => 'Photo field is required',
            'team_memberphoto.image' => 'Photo should be image format',
            'team_memberphoto.mimes' => 'Photo should be in jpg,jpeg,png,gif formmat',
        ]);

        $attchment = $request->team_memberphoto;
        $extension = $attchment->getClientOriginalExtension();
        $fileName = rand(1,100000).time().'.'.$extension;
        $attchment->move(public_path('protocol-liason-team'), $fileName);
        $url = asset('/protocol-liason-team/'.$fileName);
        $originalName = $attchment->getClientOriginalName();


        ProtocolLiaisonPeople::create([
            'name' => $request->name,
            'Designation' => $request->Designation,
            'contact_number' => $request->contact_number,
            'photo_name' => $fileName,
            'photo_original_name' => $originalName,
            'photo_url' => $url,
            'protocol_liaison_id'=> $request->protocolLiaisonId
        ]);
        return redirect()->route('protocol-liaison-teams.index',['id' => $request->protocolLiaisonId])->with('success','Team Member Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$protocolLiaisonId)
    {
        $this->authorize('Edit Teams');
        $data['teamMember'] = ProtocolLiaisonPeople::where('id',$id)->where('protocol_liaison_id',$protocolLiaisonId)->first();
        $data['protocolLiaisonId'] = $protocolLiaisonId;
        return view('admin.protocol_liaisons.teams.edit',$data);
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
        $this->authorize('Edit Teams');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'Designation' => ['required','string','min:3','max:255'],
            'contact_number' => ['required','string','min:11','max:11'],
        ]);

        $member = ProtocolLiaisonPeople::where('id',$id)->where('protocol_liaison_id',$request->protocolLiaisonId)->first();

        $member->update([
            'name' => $request->name,
            'Designation' => $request->Designation,
            'contact_number' => $request->contact_number
        ]);

        if($request->team_memberphoto){
            $attchment = $request->team_memberphoto;
            $extension = $attchment->getClientOriginalExtension();
            $fileName = rand(1,100000).time().'.'.$extension;
            $attchment->move(public_path('protocol-liason-team'), $fileName);
            $url = asset('/protocol-liason-team/'.$fileName);
            $originalName = $attchment->getClientOriginalName();

            $member->update([
                'photo_name' => $fileName,
                'photo_original_name' => $originalName,
                'photo_url' => $url,
            ]);
        }

        return redirect()->route('protocol-liaison-teams.index',['id' => $request->protocolLiaisonId])->with('success','Team Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$protocolLiaisonId)
    {
        $this->authorize('Delete Teams');
        ProtocolLiaisonPeople::where('id',$id)->where('protocol_liaison_id',$protocolLiaisonId)->delete();
        return redirect()->route('protocol-liaison-teams.index',['id' => $protocolLiaisonId])->with('success','Team Member Deleted Successfully');
    }
}
