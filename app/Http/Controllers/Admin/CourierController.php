<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourierStoreReuqest;
use App\Models\Courier;
use App\Models\CourierReceiverHandover;
use App\Models\Department;
use App\Models\ProtocolLiaison;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('All Courier');
        if ($request->ajax()) {

            $tasks = Courier::with('user')->latest();
            return  DataTables::of($tasks)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) use ($request){
                        $btn = '';
                        if (Auth::user()->can('Show Courier')){
                            $btn = '<a href='.route('couriers.show',$row->id).' title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a>';
                        }
                        if (Auth::user()->can('Edit Courier')){
                            $btn .= ' | <a href='.route('couriers.edit',$row->id).' title="Edit Record" class="btn bg-info btn-sm edit text-white"><i class="fa fa-edit"></i></a>';
                        }
                        if (Auth::user()->can('Delete Courier')){
                            $btn .= ' | <a href='.route('couriers.delete',$row->id).' onclick="return confirm(\'Are you sure?\')" title="Delete Record" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i></a>';
                        }
                        if (Auth::user()->can('All Courier Attachment')){
                            $btn .= ' | <a href='.route('courier-attachments.index',$row->id).' title="Courier Attachments" class="btn btn-success btn-sm delete"><i class="fa fa-file"></i></a>';
                        }

                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                    $status = '';
                    if ($row->status == Courier::ONGATE) {
                        $status = '<span class="badge badge-info">GATE</span>';
                    } else if ($row->status == Courier::HANDOVER) {

                            $status = '<span class="badge badge-danger">With HANDOVER: '.optional($row->handoverTo)->full_name.'</span>';
                        }else if($row->status == Courier::RECEIVED){
                            $status = '<span class="badge badge-danger">Delivered</span>';
                        }

                    return $status;
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('created_by', function ($row) {
                    return optional($row->user)->full_name;
                })
                ->addColumn('receiver', function ($row) {
                    return optional($row->receiverUser)->full_name;
                })

                ->addColumn('handover_to', function ($row) {
                    return optional($row->handoverTo)->full_name;
                })->addColumn('sender_id', function ($courier) {
                    return optional($courier->sender)->official_name ? optional($courier->sender)->official_name . ' (Official)' : optional($courier->sender)->notable_name . ' (Notable)';
                })


                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data = [];
        $data['allstate'] = Courier::totalCouriers();
        $data['todayAllstate'] = Courier::todayCouriers();

        $data['allStateReceived'] = Courier::totalReceivedCouriers();
        $data['todayStateReceived'] = Courier::todayReceivedCouriers();

        $data['allStatePending'] = Courier::totalPendingCouriers();
        $data['todayStatePending'] = Courier::todayPendingCouriers();

        $data['allStateHandover'] = Courier::totalHandoverCouriers();
        $data['todayStateHandover'] = Courier::todayHandoverCouriers();

        return view('admin.couriers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('Received Item');
        $data['senders'] = ProtocolLiaison::where('protocol_liaisontype_id', 1)->orWhere('protocol_liaisontype_id', 2)->get();
        $data['users'] = User::whereStatus(1)->where('role_id', '<>', 1)->where('employee_type', 'Regular')->get();
        $data['departments'] = Department::whereStatus(1)->get();
        return view('admin.couriers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourierStoreReuqest $request)
    {
        // $this->authorize('Received Item');
        try {

            DB::beginTransaction();

            $courier = Courier::create([
                'date_time' => $request->date_time,
                'item_received' => $request->item_received,
                'item_quantity' => $request->item_quantity,
                'item_description' => $request->item_description,
                'sender_id' => $request->sender_id ?: 0,
                'receiver' => $request->receiver ?: 0,
                'received_by' => $request->received_by ?: 0,
                'handover_to' => $request->handover_to ?: 0,
                'remarks' => $request->remarks,
                'user_id' => Auth::id(),
            ]);

            $receiver = $courier->receiver;
            if ($receiver) {
                CourierReceiverHandover::create([
                    'type' => User::RECEIVER,
                    'user_id' => $receiver,
                    'courier_id' => $courier->id,
                ]);
            }


            $handover_to = $courier->handover_to;
            if ($handover_to) {
                CourierReceiverHandover::create([
                    'type' => User::HANDOVER,
                    'user_id' => $handover_to,
                    'courier_id' => $courier->id,
                ]);
            }

            DB::commit();
            return redirect()->route('couriers.index')->with('success', 'Courier Received successfully.');
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
        // $this->authorize('View Tasks');
        $data['courier'] = Courier::with('user', 'receiverUser', 'receivedBy', 'handoverTo')->findOrFail($id);

        return view('admin.couriers/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $this->authorize('Edit Courier');
        $data['courier'] = Courier::findOrFail($id);
        $data['senders'] = ProtocolLiaison::where('protocol_liaisontype_id', 1)->orWhere('protocol_liaisontype_id', 2)->get();
        $data['users'] = User::whereStatus(1)->where('role_id', '<>', 1)->where('employee_type', 'Regular')->get();

        return view('admin.couriers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourierStoreReuqest $request, $id)
    {
        // $this->authorize('Edit Courier');
        try {
            DB::beginTransaction();
            $courier = Courier::find($id);
            $courier->update([
                'date_time' => $request->date_time,
                'item_received' => $request->item_received,
                'item_quantity' => $request->item_quantity,
                'item_description' => $request->item_description,
                'sender_id' => $request->sender_id ?: 0,
                'receiver' => $request->receiver ?: 0,
                'received_by' => $request->received_by ?: 0,
                'handover_to' => $request->handover_to ?: 0,
                'remarks' => $request->remarks,
                'user_id' => Auth::id(),
            ]);

            $receiver = $courier->receiver;
            if ($receiver) {
                CourierReceiverHandover::where('user_id', $receiver)->where('type', User::RECEIVER)->delete();
                CourierReceiverHandover::create([
                    'type' => User::RECEIVER,
                    'user_id' => $receiver,
                    'courier_id' => $courier->id,
                ]);
            }


            $handover_to = $courier->handover_to;
            if ($handover_to) {
                CourierReceiverHandover::where('user_id', $receiver)->where('type', User::HANDOVER)->delete();
                CourierReceiverHandover::create([
                    'type' => User::HANDOVER,
                    'user_id' => $handover_to,
                    'courier_id' => $courier->id,
                ]);
            }

            DB::commit();
            return redirect()->route('couriers.index')->with('success', 'Data updated successfully.');
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
        $this->authorize('Delete Courier');
        Courier::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data deleted successfully.');
    }

    public function changeStatus($key, $id)
    {
        $courier = Courier::findOrFail($id);
        // dd($key,$id);
        if ($courier) {
            if ($key == 'RECEIVED') {
                $courier->update([
                    'status' => Courier::RECEIVED
                ]);
            } else {
                $courier->update([
                    'status' => Courier::HANDOVER
                ]);
            }
        }
        return redirect()->back()->with('success', 'Status changed successfully.');
    }

    public function addProtocol(Request $request)
    {
        if ($request->type == 'OFFICIAL') {
            ProtocolLiaison::create([
                'official_name' => $request->name,
                'phone' => $request->phone_number,
                'department_id' => $request->department_id,
                'protocol_liaisontype_id' => 1,
                'user_id' => Auth::id(),
            ]);
        } elseif ($request->type == 'NOTABLE') {
            ProtocolLiaison::create([
                'notable_name' => $request->name,
                'phone' => $request->phone_number,
                'department_id' => $request->department_id,
                'protocol_liaisontype_id' => 2,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->back()->with('success', 'Data Added');
    }
}
