<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DocumentCategory;
use App\Models\DocumentControl;
use App\Models\DocumentImage;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentControlController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('All Document');
        $query = DocumentControl::with('user')->when($request->start_date, function($q) use ($request){
            return $q->where('date',$request->start_date);
        })->when($request->end_date, function($q) use ($request){
            return $q->where('date',$request->end_date);
        })->when($request->start_date && $request->end_date, function ($query) use ($request) {
            // dd($request->all());
            return $query->whereDate('date','<=',$request->start_date)->orWhereDate('date','>=',$request->end_date);
        })->where('task_id',0)->orderBy('id','desc');

        if(!isSuperAdmin()){
            $data['documents'] = $query->where('user_id',Auth::id())->get();
        }else{
            $data['documents'] = $query->get();
        }

        $data['all'] = DocumentControl::allDOcument();
        $data['todayDocuments'] = DocumentControl::todayDocuments();
        $data['allExternal'] = DocumentControl::allExternal();
        $data['todayExternal'] = DocumentControl::todayExternal();
        $data['allInternal'] = DocumentControl::allInternal();
        $data['todayInternal'] = DocumentControl::todayInternal();

        return view('admin.document_controls.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($taskId=0)
    {

        $this->authorize('Add Document');
        $documentCategory = DocumentCategory::whereStatus(1)->get();
        $department = Department::whereStatus(1)->get();
        $locations = Location::whereStatus(1)->get();
        return view('admin.document_controls/create',compact('documentCategory','department','locations','taskId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Document');
        $request->validate([
            'location_id' => ['required','string'],
            'document_type' => ['required','string'],
            'date' => ['required','date'],
            'document_category_id' => ['required','numeric'],
            // 'subject' => ['required','string','min:3','max:255'],
            // 'department_id' => ['required','numeric'],
            // 'body' => ['required','string','min:10'],
            // 'letter_received' => ['required'],
            // 'issued_by_consulte' => ['required'],
        ],[
            // 'document_category_id.required' => "The Document Category field is required.",
            // 'document_category_id.numeric' => "The Document Category Should be numeric.",
            // 'department_id.required' => "The Department field is required.",
            // 'department_id.numeric' => "The Department Should be numeric.",
        ]);
        try {
            DB::beginTransaction();
            $data = $request->except('letter_received','issued_by_consulte');
            $data['user_id'] = Auth::id();

            $data['document_number'] = DocumentCategory::whereId($request->document_category_id)->first()->document_number.'-'.(DocumentControl::where('document_category_id',$request->document_category_id)->count() + 1);

            $documentControl = DocumentControl::create($data);

            if($request->has('letter_received')){
                $letterReceivedFiles = $request->letter_received;
                foreach($letterReceivedFiles as $latter){
                    $fileName = rand(1,100000).time().'.'.$latter->extension();
                    $latter->move(public_path('letter_received'), $fileName);
                    $url = asset('/letter_received/'.$fileName);

                    DocumentImage::create([
                        'name' => $fileName,
                        'original_name' => $latter->getClientOriginalName(),
                        'url' => $url,
                        'certificate_name' => 'letter_received',
                        'document_id' => $documentControl->id
                    ]);
                }
            }


            if($request->has('issued_by_consulte')){
                $issuedConsulteFiles = $request->issued_by_consulte;
                foreach($issuedConsulteFiles as $consulte){
                    $fileName = rand(1,100000).time().'.'.$consulte->extension();
                    $consulte->move(public_path('issued_by_consulte'), $fileName);
                    $url = asset('/issued_by_consulte/'.$fileName);

                    DocumentImage::create([
                        'name' => $fileName,
                        'original_name' => $consulte->getClientOriginalName(),
                        'url' => $url,
                        'certificate_name' => 'issued_by_consulte',
                        'document_id' => $documentControl->id
                    ]);


                }
            }


            DB::commit();
            if($request->task_id > 0){
                return redirect()->route('tasks.index')->with('success','Document added successfully!');
            }
            return redirect()->route('documents-control.index')->with('success','Document added successfully!');

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View Document');
        $document = DocumentControl::findOrFail($id);
        return view('admin.document_controls/show',compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit Document');
        $document = DocumentControl::findOrFail($id);
        $department = Department::whereStatus(1)->get();

        return view('admin.document_controls/edit',compact('document','department'));
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
        $this->authorize('Edit Document');
        $data = $request->except('letter_received','issued_by_consulte');

        $documentControl = DocumentControl::findOrFail($id);
        $documentControl->update($data);

        if($request->has('letter_received')){
            $letterReceivedFiles = $request->letter_received;
            foreach($letterReceivedFiles as $latter){
                $fileName = rand(1,100000).time().'.'.$latter->extension();
                $latter->move(public_path('letter_received'), $fileName);
                $url = asset('/letter_received/'.$fileName);

                DocumentImage::create([
                    'name' => $fileName,
                    'original_name' => $latter->getClientOriginalName(),
                    'url' => $url,
                    'certificate_name' => 'letter_received',
                    'document_id' => $documentControl->id
                ]);
            }
        }


        if($request->has('issued_by_consulte')){
            $issuedConsulteFiles = $request->issued_by_consulte;
            foreach($issuedConsulteFiles as $consulte){
                $fileName = rand(1,100000).time().'.'.$consulte->extension();
                $consulte->move(public_path('issued_by_consulte'), $fileName);
                $url = asset('/issued_by_consulte/'.$fileName);

                DocumentImage::create([
                    'name' => $fileName,
                    'original_name' => $consulte->getClientOriginalName(),
                    'url' => $url,
                    'certificate_name' => 'issued_by_consulte',
                    'document_id' => $documentControl->id
                ]);


            }
        }

        return redirect()->back()->with('success','Document Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Add Document');
        DocumentControl::findOrFail($id)->delete();
        return redirect()->back()->with('success','Document Deleted Successfully!');

    }

    public function markClosed(Request $request, $id)
    {
        $this->authorize('Mark Close Document');
        DocumentControl::findOrFail($id)->update([
            'status' => 1,
            'close_date' => Carbon::now(),
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success','Document Closed Successfully!');
    }
}
