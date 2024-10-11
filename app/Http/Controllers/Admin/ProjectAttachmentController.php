<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProtocolLiaison;
use App\Models\ProtocolLiaisonImage;
use Illuminate\Http\Request;

class ProjectAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id)
    {
        $this->authorize('All Complaint Attachment');
        $data['complaintAttachments'] = ProtocolLiaisonImage::where('module_type_id',$project_id)
        ->where('module_type',ProtocolLiaison::PROJECT)->latest()->get();
        $data['project_id'] = $project_id;
        return view('admin.protocol_liaisons.attachments.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('Add Complaint Attachment');
        $data['project_id'] = $id;
        return view('admin.protocol_liaisons.attachments.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Complaint Attachment');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'notes' => ['required','string'],
            'lat' => ['required'],
            'lng' => ['required'],
            'attachment' => ['required','mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf'],
        ],[
            'certificate_name.required'=>'The File Category field is required',
            'certificate_name.string'=>'The File Category field should be a string',
            'certificate_name.in'=>'The File Category field should be Letters Received OR Issued by Consulte',
        ]);

        $project = ProtocolLiaison::findOrFail($request->project_id);

        $attachment = $request->attachment;
        $extension = $attachment->getClientOriginalExtension();
        $fileName = rand(1,100000).time().'.'.$extension;
        $attachment->move(public_path( ProtocolLiaison::PROJECT), $fileName);
        $url = asset('/'. ProtocolLiaison::PROJECT.'/'.$fileName);

        ProtocolLiaisonImage::create([
            'file_name' => $request->name,
            'notes' => $request->notes,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'orignal_file_name' => $attachment->getClientOriginalName(),
            'file_type' => $extension,
            'file_url' => $url,
            'module_type' => ProtocolLiaison::PROJECT,
            'module_type_id' => $project->id,
            'attachment_type_name' => 'project_photo'
        ]);

        return redirect()->route('project-attachments.index',['id' => $request->project_id])->with('success','Document Uploaded Successfully');
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
    public function edit($id,$project_id)
    {
        $this->authorize('Edit Complaint Attachment');
        $data['attachment'] = ProtocolLiaisonImage::where('id',$id)->where('module_type_id',$project_id)->first();
        $data['project_id'] = $project_id;
        return view('admin.protocol_liaisons.attachments.edit',$data);
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
        $this->authorize('Edit Complaint Attachment');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'notes' => ['required','string'],
            'lat' => ['required'],
            'lng' => ['required'],
        ]);

        $projectImage = ProtocolLiaisonImage::where('id',$id)->first();

        if($request->has('attachment')){
            $attachment = $request->attachment;
            $extension = $attachment->getClientOriginalExtension();
            $fileName = rand(1,100000).time().'.'.$extension;
            $attachment->move(public_path( ProtocolLiaison::PROJECT), $fileName);
            $url = asset('/'. ProtocolLiaison::PROJECT.'/'.$fileName);

            $projectImage->update([
                'file_name' => $request->name,
                'notes' => $request->notes,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'orignal_file_name' => $attachment->getClientOriginalName(),
                'file_type' => $extension,
                'file_url' => $url,
            ]);
        }else{
            $projectImage->update([
                'file_name' => $request->name,
                'notes' => $request->notes,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
        }



        return redirect()->route('project-attachments.index',['id' => $request->project_id])->with('success','Team Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$project_id)
    {
        $this->authorize('Delete Complaint Attachment');
        ProtocolLiaisonImage::where('id',$id)->where('module_type_id',$project_id)->delete();
        return redirect()->route('project-attachments.index',['id' => $project_id])->with('success','Attachment Deleted Successfully');
    }
}
