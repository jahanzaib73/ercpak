<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\DocumentImage;
use App\Models\GuestVistor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('All Complaint');
        $query = Complaint::with('user')->orderBy('id','desc');

        if(!isSuperAdmin()){
            $complaints = $query->where('user_id',Auth::id())->get();
        }else{
            $complaints = $query->get();
        }

        $totalComplaints = Complaint::totalComplaints();
        $todayRecords = Complaint::todayComplaints();

        $totalCompletedComplaints = Complaint::totalCompletedComplaints();
        $todayCompletedComplaints = Complaint::todayCompletedComplaints();

        $totalPendingComplaints = Complaint::totalPendingComplaints();
        $todayPendingComplaints = Complaint::todayPendingComplaints();

        return view('admin.complaints.index',compact('totalPendingComplaints','todayPendingComplaints','complaints','totalComplaints','todayRecords','totalCompletedComplaints','todayCompletedComplaints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Add Complaint');
        $complaintTypes = ComplaintType::whereStatus(1)->get();

        $complaintPersonsData = [];
        $users = User::whereStatus(1)->where('role_id','<>',1)->get();
        $guestVisitors = GuestVistor::with('guest')->get();

        $index = 0;
        if($users){
            foreach($users as $user){
                $complaintPersonsData[$index]['id'] = $user->id;
                $complaintPersonsData[$index]['name'] = $user->full_name.' (Employee)';
                $index++;
            }
        }
        if($guestVisitors){
            foreach($guestVisitors as $guestVistor){
                $complaintPersonsData[$index]['id'] = $guestVistor->id.':'.$guestVistor->type;
                $complaintPersonsData[$index]['name'] = $this->getGuestData($guestVistor);
                $index++;
            }
        }

        // dd($complaintPersonsData);
        return view('admin.complaints.create',compact('complaintTypes','complaintPersonsData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Complaint');
        $request->validate([
            'complaint_date' => ['required','date'],
            'complaint_person_id' => ['required','string'],
            'complaint_against' => ['required','string','min:3','max:255'],
            'complaint_detail' => ['required','string','min:10'],
            'mobile' => ['required','string','min:11','max:11'],
            'complaint_type_id' => ['required','numeric'],
        ],[
            'complaint_type_id.required' => "The complaint type field is required.
            ",
            'complaint_type_id.numeric' => "The complaint type id Should be numeric.
            ",
        ]);

        $complaintNumber = getComplaintNumber();
        $complaint = Complaint::create([
            'complaint_date' => $request->complaint_date,
            'complaint_person_id' => explode(':',$request->complaint_person_id)[0],
            'complaint_person_type' => isset(explode(':',$request->complaint_person_id)[1]) ? explode(':',$request->complaint_person_id)[1] : 'EMPLOYEE',
            'complaint_against' => $request->complaint_against,
            'complaint_detail' => $request->complaint_detail,
            'mobile' => $request->mobile,
            'complaint_type_id' => $request->complaint_type_id,
            'user_id' => Auth::id(),
            'complaint_number' => $complaintNumber,
        ]);

        if($request->has('Complaint_files')){
            $issuedConsulteFiles = $request->Complaint_files;
            foreach($issuedConsulteFiles as $consulte){
                $fileName = rand(1,100000).time().'.'.$consulte->extension();
                $consulte->move(public_path('document_complaint'), $fileName);
                $url = asset('/document_complaint/'.$fileName);

                DocumentImage::create([
                    'name' => $fileName,
                    'original_name' => $consulte->getClientOriginalName(),
                    'url' => $url,
                    'certificate_name' => 'complaint_document',
                    'document_id' => $complaint->id
                ]);


            }
        }

        return redirect()->route('complaints.index')->with('success','Your Complaint register against complaint id: '.$complaintNumber);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View Complaint');
        $complaint = Complaint::findOrFail($id);
        return view('admin.complaints/show',compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit Complaint');
        $complaint = Complaint::findOrFail($id);
        $complaintTypes = ComplaintType::whereStatus(1)->get();
        $complaintPersonsData = [];
        $users = User::whereStatus(1)->where('role_id','<>',1)->get();
        $guestVisitors = GuestVistor::with('guest')->get();

        $index = 0;
        if($users){
            foreach($users as $user){
                $complaintPersonsData[$index]['id'] = $user->id;
                $complaintPersonsData[$index]['name'] = $user->full_name.' (Employee)';
                $complaintPersonsData[$index]['type'] = 'EMPLOYEE';
                $index++;
            }
        }
        if($guestVisitors){
            foreach($guestVisitors as $guestVistor){
                $complaintPersonsData[$index]['id'] = $guestVistor->id.':'.$guestVistor->type;
                $complaintPersonsData[$index]['name'] = $this->getGuestData($guestVistor);
                $complaintPersonsData[$index]['type'] = $guestVistor->type;
                $complaintPersonsData[$index]['type_id'] = $guestVistor->id;
                $index++;
            }
        }
        return view('admin.complaints.edit',compact('complaint','complaintTypes','complaintPersonsData'));
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
        $this->authorize('Edit Complaint');
        $request->validate([
            'complaint_date' => ['required','date'],
            'complaint_person_id' => ['required','string'],
            'complaint_against' => ['required','string','min:3','max:255'],
            'complaint_detail' => ['required','string','min:10'],
            'mobile' => ['required','string','min:11','max:11'],
            'complaint_type_id' => ['required','numeric'],
        ],[
            'complaint_type_id.required' => "The complaint type field is required.
            ",
            'complaint_type_id.numeric' => "The complaint type id Should be numeric.
            ",
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            'complaint_date' => $request->complaint_date,
            'complaint_person_id' => explode(':',$request->complaint_person_id)[0],
            'complaint_person_type' => isset(explode(':',$request->complaint_person_id)[1]) ? explode(':',$request->complaint_person_id)[1] : 'EMPLOYEE',
            'complaint_against' => $request->complaint_against,
            'complaint_detail' => $request->complaint_detail,
            'mobile' => $request->mobile,
            'complaint_type_id' => $request->complaint_type_id
        ]);

        if($request->has('Complaint_files')){
            $issuedConsulteFiles = $request->Complaint_files;
            foreach($issuedConsulteFiles as $consulte){
                $fileName = rand(1,100000).time().'.'.$consulte->extension();
                $consulte->move(public_path('document_complaint'), $fileName);
                $url = asset('/document_complaint/'.$fileName);

                DocumentImage::create([
                    'name' => $fileName,
                    'original_name' => $consulte->getClientOriginalName(),
                    'url' => $url,
                    'certificate_name' => 'complaint_document',
                    'document_id' => $complaint->id
                ]);


            }
        }

        return redirect()->back()->with('success','Complaint Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Complaint');
        Complaint::findOrFail($id)->delete();
        return redirect()->back()->with('success','Complaint Deleted Successfully!');

    }

    public function markCompletd($id)
    {
        $this->authorize('Mark Complete Complaint');
        Complaint::findOrFail($id)->update([
            'status' => 1,
            'completed_date' => Carbon::now()
        ]);

        return redirect()->back()->with('success','Complaint Completed Successfully!');
    }

    private function getGuestData($guestVistor){

        if($guestVistor->type == 'VISTORS'){
            return $guestVistor->vistor_name.'('.$guestVistor->type.')';
        }else{
            if($guestVistor->guest&&$guestVistor->guest->official_name){
                return $guestVistor->guest->official_name.' ('.$guestVistor->type.') - (OFFICIAL)';
            }elseif($guestVistor->guest&&$guestVistor->guest->notable_name){
                return $guestVistor->guest->notable_name.' ('.$guestVistor->type.') - (NOTABLE)';
            }
        }
    }
}
