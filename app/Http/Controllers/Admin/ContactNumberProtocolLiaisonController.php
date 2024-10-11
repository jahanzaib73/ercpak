<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProtocolLiaisonContect;
use Illuminate\Http\Request;

class ContactNumberProtocolLiaisonController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($protocolLiaisonId)
    {
        $this->authorize('All Protocol and Liaison Contact');
        $data['contacts'] = ProtocolLiaisonContect::where('protocol_liaison_id',$protocolLiaisonId)->latest()->get();
        $data['protocolLiaisonId'] = $protocolLiaisonId;
        return view('admin.protocol_liaisons.contact_numbers.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('All Protocol and Liaison Contact');
        $data['protocolLiaisonId'] = $id;
        return view('admin.protocol_liaisons/contact_numbers/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Protocol and Liaison Contact');
        $request->validate([
            'contact_number' => ['required','string','min:11','max:11'],
        ]);

        ProtocolLiaisonContect::create([
            'contact_numebr' => $request->contact_number,
            'protocol_liaison_id'=> $request->protocolLiaisonId
        ]);
        return redirect()->route('protocol-liaison-contact-numbers.index',['id' => $request->protocolLiaisonId])->with('success','Contact Number Added Successfully');
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
        $this->authorize('Edit Protocol and Liaison Contact');
        $data['contact'] = ProtocolLiaisonContect::where('id',$id)->where('protocol_liaison_id',$protocolLiaisonId)->first();
        $data['protocolLiaisonId'] = $protocolLiaisonId;
        return view('admin.protocol_liaisons/contact_numbers/edit',$data);
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
        $this->authorize('Edit Protocol and Liaison Contact');
        $request->validate([
            'contact_number' => ['required','string','min:11','max:11'],
        ]);

        $contact = ProtocolLiaisonContect::where('id',$id)->where('protocol_liaison_id',$request->protocolLiaisonId)->first();

        $contact->update([
            'contact_numebr' => $request->contact_number,
        ]);

        return redirect()->route('protocol-liaison-contact-numbers.index',['id' => $request->protocolLiaisonId])->with('success','Contact Number Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$protocolLiaisonId)
    {
        $this->authorize('Delete Protocol and Liaison Contact');
        ProtocolLiaisonContect::where('id',$id)->where('protocol_liaison_id',$protocolLiaisonId)->delete();
        return redirect()->route('protocol-liaison-contact-numbers.index',['id' => $protocolLiaisonId])->with('success','Contact Number Deleted Successfully');
    }
}
