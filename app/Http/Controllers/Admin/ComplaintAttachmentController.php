<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintAtachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($complaint_id)
    {
        $this->authorize('All Complaint Attachment');
        $data['complaintAttachments'] = ComplaintAtachment::where('complaint_id',$complaint_id)->latest()->get();
        $data['complaint_id'] = $complaint_id;
        return view('admin.complaints.attachments.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('Add Complaint Attachment');
        $data['complaint_id'] = $id;
        return view('admin.complaints.attachments.create',$data);
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
            'attachment' => ['required','mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf'],
        ],[
            'certificate_name.required'=>'The File Category field is required',
            'certificate_name.string'=>'The File Category field should be a string',
            'certificate_name.in'=>'The File Category field should be Letters Received OR Issued by Consulte',
        ]);

        $complaint = Complaint::findOrFail($request->complaint_id);

        $attchment = $request->attachment;
        $extension = $attchment->getClientOriginalExtension();
        $fileName = rand(1,100000).time().'.'.$extension;
        $attchment->move(public_path('protocol-liason-team'), $fileName);
        $url = asset('/protocol-liason-team/'.$fileName);
        $originalName = $attchment->getClientOriginalName();


        ComplaintAtachment::create([
            'complaint_number' => $complaint->id.'-'.ComplaintAtachment::getCount(),
            'name' => $request->name,
            'notes' => $request->notes,
            'url' => $url,
            'complaint_id' => $complaint->id,
            'user_id' => Auth::id()
        ]);



        return redirect()->route('complaint-attachments.index',['id' => $request->complaint_id])->with('success','Document Uploaded Successfully');
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
    public function edit($id,$complaint_id)
    {
        $this->authorize('Edit Complaint Attachment');
        $data['attachment'] = ComplaintAtachment::where('id',$id)->where('complaint_id',$complaint_id)->first();
        $data['complaint_id'] = $complaint_id;
        return view('admin.complaints.attachments.edit',$data);
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
        ]);

        $complaintAttachment = ComplaintAtachment::where('id',$id)->first();

        if($request->has('attachment')){
            $attchment = $request->attachment;
            $extension = $attchment->getClientOriginalExtension();
            $fileName = rand(1,100000).time().'.'.$extension;
            $attchment->move(public_path('protocol-liason-team'), $fileName);
            $url = asset('/protocol-liason-team/'.$fileName);
            $originalName = $attchment->getClientOriginalName();

            $complaintAttachment->update([
                'name' => $request->name,
                'notes' => $request->notes,
                'url' => $url,
            ]);
        }else{
            $complaintAttachment->update([
                'name' => $request->name,
                'notes' => $request->notes,
            ]);
        }



        return redirect()->route('complaint-attachments.index',['id' => $request->complaint_id])->with('success','Team Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$complaint_id)
    {
        $this->authorize('Delete Complaint Attachment');
        ComplaintAtachment::where('id',$id)->where('complaint_id',$complaint_id)->delete();
        return redirect()->route('complaint-attachments.index',['id' => $complaint_id])->with('success','Attachment Deleted Successfully');
    }
}
