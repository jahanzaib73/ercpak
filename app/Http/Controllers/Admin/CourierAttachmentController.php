<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\CourierAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($courier_id)
    {
        $this->authorize('All Courier Attachment');
        $data['courierAttachments'] = CourierAttachment::where('courier_id',$courier_id)->latest()->get();
        $data['courier_id'] = $courier_id;
        return view('admin.couriers.attachments.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->authorize('Add Courier Attachment');
        $data['courier_id'] = $id;
        return view('admin.couriers.attachments.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Courier Attachment');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'notes' => ['required','string'],
            'attachment' => ['required','mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf'],
        ]);

        $courier = Courier::findOrFail($request->courier_id);

        $attchment = $request->attachment;
        $extension = $attchment->getClientOriginalExtension();
        $fileName = rand(1,100000).time().'.'.$extension;
        $attchment->move(public_path('courier-attachment'), $fileName);
        $url = asset('/courier-attachment/'.$fileName);
        $originalName = $attchment->getClientOriginalName();


        CourierAttachment::create([
            'file_name' => $request->name,
            'notes' => $request->notes,
            'file_extension' => $extension,
            'file_url' => $url,
            'courier_id' => $courier->id,
            'user_id' => Auth::id()
        ]);



        return redirect()->route('courier-attachments.index',['id' => $request->courier_id])->with('success','Attachment Uploaded Successfully');
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
    public function edit($id,$courier_id)
    {
        $this->authorize('Edit Courier Attachment');
        $data['attachment'] = CourierAttachment::where('id',$id)->where('courier_id',$courier_id)->first();
        $data['courier_id'] = $courier_id;

        return view('admin.couriers.attachments.edit',$data);
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
        $this->authorize('Edit Courier Attachment');
        $request->validate([
            'name' => ['required','string','min:3','max:255'],
            'notes' => ['required','string'],
        ]);

        $attachment = CourierAttachment::where('id',$id)->first();

        if($request->has('attachment')){
            $attchment = $request->attachment;
            $extension = $attchment->getClientOriginalExtension();
            $fileName = rand(1,100000).time().'.'.$extension;
            $attchment->move(public_path('protocol-liason-team'), $fileName);
            $url = asset('/protocol-liason-team/'.$fileName);
            $originalName = $attchment->getClientOriginalName();

            $attachment->update([
                'file_name' => $request->name,
                'notes' => $request->notes,
                'file_extension' => $extension,
                'file_url' => $url,
            ]);
        }else{
            $attachment->update([
                'file_name' => $request->name,
                'notes' => $request->notes,
            ]);
        }



        return redirect()->route('courier-attachments.index',['id' => $request->courier_id])->with('success','Attachment Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$courier_id)
    {
        $this->authorize('Delete Courier Attachment');
        CourierAttachment::where('id',$id)->where('courier_id',$courier_id)->delete();
        return redirect()->route('courier-attachments.index',['id' => $courier_id])->with('success','Attachment Deleted Successfully');
    }
}
