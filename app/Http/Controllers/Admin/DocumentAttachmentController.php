<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentControl;
use App\Models\DocumentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentAttachmentController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($document_id)
    {
        $this->authorize('All Document Control Attachment');
        $data['documentAttachments'] = DocumentImage::where('document_id',$document_id)->latest()->get();
        $data['document_id'] = $document_id;
        return view('admin.document_controls.attachments.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('Add Document Control Attachment');
        $data['document_id'] = $id;
        return view('admin.document_controls.attachments.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Document Control Attachment');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'certificate_name' => ['required','string','in:letter_received,issued_by_consulte'],
            'notes' => ['required','string'],
            'attachment' => ['required','mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf'],
        ],[
            'certificate_name.required'=>'The File Category field is required',
            'certificate_name.string'=>'The File Category field should be a string',
            'certificate_name.in'=>'The File Category field should be Letters Received OR Issued by Consulte',
        ]);

        $document = DocumentControl::findOrFail($request->document_id);

        $attchment = $request->attachment;
        $extension = $attchment->getClientOriginalExtension();
        $fileName = rand(1,100000).time().'.'.$extension;
        $attchment->move(public_path('protocol-liason-team'), $fileName);
        $url = asset('/protocol-liason-team/'.$fileName);
        $originalName = $attchment->getClientOriginalName();


        DocumentImage::create([
            'document_number' => $document->document_number.'-'.(DocumentImage::getCount()),
            'name' => $request->name,
            'notes' => $request->notes,
            'certificate_name' => $request->certificate_name,
            'original_name' => $originalName,
            'url' => $url,
            'certificate_name' => $request->certificate_name,
            'document_id' => $document->id,
            'user_id' => Auth::id()
        ]);



        return redirect()->route('document-control-attachments.index',['id' => $request->document_id])->with('success','Document Uploaded Successfully');
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
    public function edit($id,$document_id)
    {
        $this->authorize('Edit Document Control Attachment');
        $data['attachment'] = DocumentImage::where('id',$id)->where('document_id',$document_id)->first();
        $data['document_id'] = $document_id;

        return view('admin.document_controls.attachments.edit',$data);
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
        $this->authorize('Edit Document Control Attachment');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'certificate_name' => ['required','string','in:letter_received,issued_by_consulte'],
            'notes' => ['required','string'],
        ]);

        $documentImage = DocumentImage::where('id',$id)->first();

        if($request->has('attachment')){
            $attchment = $request->attachment;
            $extension = $attchment->getClientOriginalExtension();
            $fileName = rand(1,100000).time().'.'.$extension;
            $attchment->move(public_path('protocol-liason-team'), $fileName);
            $url = asset('/protocol-liason-team/'.$fileName);
            $originalName = $attchment->getClientOriginalName();

            $documentImage->update([
                'name' => $request->name,
                'notes' => $request->notes,
                'original_name' => $originalName,
                'url' => $url,
                'certificate_name' => $request->certificate_name,
            ]);
        }else{
            $documentImage->update([
                'name' => $request->name,
                'notes' => $request->notes,
                'certificate_name' => $request->certificate_name,
            ]);
        }



        return redirect()->route('document-control-attachments.index',['id' => $request->document_id])->with('success','Team Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$document_id)
    {
        $this->authorize('Delete Document Control Attachment');
        DocumentImage::where('id',$id)->where('document_id',$document_id)->delete();
        return redirect()->route('document-control-attachments.index',['id' => $document_id])->with('success','Attachment Deleted Successfully');
    }
}
