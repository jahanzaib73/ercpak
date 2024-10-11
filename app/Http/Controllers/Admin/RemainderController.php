<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RemainderStoreRequest;
use App\Http\Requests\RemainderUpdateRequest;
use App\Jobs\MeetingEmailJob;
use App\Models\Employee;
use App\Models\EmployeeRemainder;
use App\Models\IssuingAuthority;
use App\Models\Remainders;
use App\Models\RemainderType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RemainderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('All Remainder');
        if ($request->ajax()) {

            $flightCargos = Remainders::with('user', 'remainderType', 'issuingAuthority')->latest();
            return DataTables::of($flightCargos)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) use ($request){
                        $btn = '';
                        if (Auth::user()->can('View Remainder')){
                            $btn = '<a href='.route('remainders.show',$row->id).' title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a>';
                        }
                        if (Auth::user()->can('Edit Remainder')){
                            $btn .= ' | <a href='.route('remainders.edit',$row->id).' title="Edit Record" class="btn bg-info btn-sm edit text-white"><i class="fa fa-edit"></i></a>';
                        }
                        if (Auth::user()->can('Delete Remainder')){
                            $btn .= ' | <a href='.route('remainders.delete',$row->id).' onclick="return confirm(\'Are you sure?\')" title="Delete Record" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i></a>';
                        }
                        if($row->status != Remainders::COMPLATED&&Auth::user()->can('Mark as Complete Remainder'))
                            $btn .= ' | <a href='.route('remainders.mark.completed',$row->id).' onclick="return confirm(\'Are you sure?\')" title="Mark as Completed" class="btn btn-gray btn-sm"><i class=" mdi mdi-check"></i></a>';

                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                        $status = '';
                        if($row->status == Remainders::UPCOMMING){
                            $status = '<span class="badge badge-info">UPCOMMING</span>';
                        }else if($row->status == Remainders::COMPLATED){
                            $status = '<span class=""badge badge-danger">COMPLETED</span>';
                        }else if($row->status == Remainders::CANCELED){
                            $status = '<span class=""badge badge-danger">CANCELED</span>';
                        }

                    return $status;
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('remainder_type_id', function ($row) {
                    return ucfirst(optional($row->remainderType)->name);
                })
                ->addColumn('issuing_authority_id', function ($row) {
                    return ucfirst(optional($row->issuingAuthority)->name_of_issuing_authorities);
                })->addColumn('created_by', function ($row) {
                    return optional($row->user)->full_name;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data['allstate'] = Remainders::totalRemainders();
        $data['todayAllstate'] = Remainders::todayRemainders();

        $data['allStateCompleted'] = Remainders::totalCompletedRemainders();
        $data['todayStateCompleted'] = Remainders::todayCompletedRemainders();

        $data['allStateUpcomming'] = Remainders::totalUpcommingRemainders();
        $data['todayStateUpcomming'] = Remainders::todayUpcommingRemainders();

        return view('admin.meetings_remainders.remainders.remainders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Add Remainder');
        $data['remainderTypes'] = RemainderType::whereStatus('1')->get();
        $data['issuingAuthority'] = IssuingAuthority::whereStatus('1')->get();
        $data['employees'] = User::whereStatus(1)->get();
        return view('admin.meetings_remainders.remainders.remainders.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RemainderStoreRequest $request)
    {
        $this->authorize('Add Remainder');
        try {
            DB::beginTransaction();
            $remainder = Remainders::create([
                'title' => $request->title,
                'remainder_type_id' => $request->remainder_type_id,
                'issuing_authority_id' => $request->issuing_authority_id,
                'expairy_date' => $request->is_expairy_date == 1 ? $request->expairy_date : null,
                'is_expairy_date' => $request->is_expairy_date == 1 ? 1 : 0,
                'detail' => $request->detail,
                'date_time' => $request->date_time,
                'user_id' => Auth::id(),
            ]);

            foreach ($request->employee_id as $id) {
                EmployeeRemainder::create([
                    'employee_id' => $id,
                    'remainder_id' => $remainder->id,
                ]);
            }

            MeetingEmailJob::dispatch($remainder, 'Created', true);

            DB::commit();
            return redirect()->route('remainders.index')->with('success', 'Data stored successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
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
        $this->authorize('View Remainder');
        $data['remainder'] = Remainders::with('remainderType', 'issuingAuthority', 'employee')->findOrFail($id);

        return view('admin.meetings_remainders/remainders/remainders/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit Remainder');
        $data['remainder'] = Remainders::findOrFail($id);
        $data['remainderTypes'] = RemainderType::whereStatus('1')->get();
        $data['issuingAuthority'] = IssuingAuthority::whereStatus('1')->get();
        $data['employees'] = User::whereStatus(1)->get();

        return view('admin.meetings_remainders/remainders/remainders/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RemainderUpdateRequest $request, $id)
    {
        $this->authorize('Edit Remainder');
        try {
            DB::beginTransaction();
            $remainder = Remainders::findOrFail($id);
            $remainder->update([
                'title' => $request->title,
                'remainder_type_id' => $request->remainder_type_id,
                'issuing_authority_id' => $request->issuing_authority_id,
                'expairy_date' => $request->is_expairy_date == 1 ? $request->expairy_date : null,
                'is_expairy_date' => $request->is_expairy_date == 1 ? 1 : 0,
                'detail' => $request->detail,
                'date_time' => $request->date_time,
            ]);

            EmployeeRemainder::where('remainder_id', $remainder->id)->delete();
            foreach ($request->employee_id as $id) {
                EmployeeRemainder::create([
                    'employee_id' => $id,
                    'remainder_id' => $remainder->id,
                ]);
            }

            MeetingEmailJob::dispatch($remainder, 'Updated', true);
            DB::commit();
            return redirect()->route('remainders.index')->with('success', 'Data updated successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Remainder');
        Remainders::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data deleted successfully.');
    }

    public function markCompleted($id)
    {
        $this->authorize('Mark as Complete Remainder');
        Remainders::findOrFail($id)->update([
            'status' => Remainders::COMPLATED
        ]);
        return redirect()->back()->with('success', 'Remainder mark completed successfully.');
    }
}
