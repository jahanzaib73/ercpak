<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\Inventory;
use App\Models\TaskWorkOrder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\WorkOrder;
use App\Models\WorkorderAttachment;
use App\Models\WorkOrderItem;
use App\Models\WorkorderTaskPerformed;
use App\Traits\VehicleStateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WorkOrderController extends Controller
{
    use VehicleStateTrait;
    public function index(Request $request)
    {
        $this->authorize('All Work Orders');
        if ($request->ajax()) {

            if ($request->status == "-1") {
                $workOrder = WorkOrder::whereHas('inspection', function ($query) {
                    $query->whereStatus(Inspection::CLOSED);
                })->latest();
            } else {

                $workOrder = WorkOrder::whereHas('inspection', function ($query) {
                    $query->whereStatus(Inspection::CLOSED);
                })->where('status', $request->status)->latest();
            }


            return DataTables::of($workOrder)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View Work Orders')){
                    $btn .= '<a href=' . route('work-orders.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                    $status = '';
                    if ($row->status == WorkOrder::OPEN) {
                        $status = '<span class="badge badge-primary">Open</span>';
                    } else if ($row->status == WorkOrder::CLOSED) {
                        $status = '<span class="badge badge-danger">Closed</span>';
                    } else if ($row->status == WorkOrder::PENDING) {
                        $status = '<span class="badge badge-danger">Pending</span>';
                    }

                    return $status;
                })->addColumn('image', function ($row) use ($request) {

                    return '<a href=' . optional(optional($row->inspection)->vehicle)->image_url . ' target="_blank"><img width="100" src=' . optional(optional($row->inspection)->vehicle)->image_url . ' /></a>';
                })->addColumn('costCenter', function ($row) use ($request) {

                    return optional(optional($row->inspection)->costCenter)->title ?: 'N/A';
                })->addColumn('vehicle_number', function ($row) use ($request) {

                    return optional(optional($row->inspection)->vehicle)->vehicle_number ?: 'N/A';
                })->addColumn('model', function ($row) use ($request) {

                    return optional(optional(optional($row->inspection)->vehicle)->model)->name ?: 'N/A';
                })->addColumn('inspection_number', function ($row) use ($request) {

                    return optional($row->inspection)->id ?: 'N/A';
                })->addColumn('date', function ($row) use ($request) {

                    return optional($row->inspection)->date ?: 'N/A';
                })->addColumn('meter_reading', function ($row) use ($request) {

                    return optional($row->inspection)->meter_reading ?: 'N/A';
                })->addColumn('attachments', function ($row) use ($request) {

                    // return count($row->attachments);
                    return 0;
                })->addColumn('inspection_type', function ($row) use ($request) {
                    $type = '';
                    if (optional($row->inspection)->inspection_type == 0) {
                        $type = '<span class=""badge badge-danger">Vehicle</span>';
                    } else {
                        $type = '<span class="badge badge-danger">Asset</span>';
                    }
                    return  $type;
                })
                ->rawColumns(['action', 'status', 'image', 'inspection_type'])
                ->make(true);
        }

        $data = [];
        $data['states'] = $this->getStates();

        return view('new-admin.fleets.work_orders.index', $data);
    }

    public function show($id)
    {
        $this->authorize('View Work Orders');

        $data = [];
        $data['wo'] = WorkOrder::with('inspection.assignedTehnicians.user')->findOrFail($id);

        $data['users'] = User::whereStatus(1)->get();
        $data['venderos'] = Vendor::whereStatus(1)->get();
        $data['tasks'] = TaskWorkOrder::whereStatus(1)->get();
        $data['inventroyItems'] = Inventory::whereStatus(1)->get();
        // dd($data);
        return view('admin.fleets.work_orders.show', $data);
    }

    public function workOrderClosed(Request $request)
    {
        $this->authorize('Close Work Orders');
        $workOrder = WorkOrder::findOrFail($request->workorder_id);
        $workOrderTaskPerformed = WorkorderTaskPerformed::where('work_order_id', $workOrder->id)->count();
        if ($workOrderTaskPerformed <= 0) {
            $request->validate([
                'tasks' => ['required_if:type,save'],
                'tasks.*' => ['required_if:type,save'],
                'remarks' => ['required_if:type,save'],
                'remarks.*' => ['required_if:type,save'],
            ]);
        }

        try {
            DB::beginTransaction();

            $workOrder->update([
                // 'technicians_notes' => $request->close_remark,
                'user_id' => Auth::id(),
                'status' => $request->type == 'close' ? WorkOrder::PENDING : WorkOrder::OPEN
            ]);

            for ($i = 0; $i < count($request->tasks); $i++) {
                if (!empty($request['tasks'][$i]) && !empty($request['remarks'][$i]))
                    WorkorderTaskPerformed::create([
                        'task_id' => $request['tasks'][$i],
                        'remarks' => $request['remarks'][$i],
                        'work_order_id' => $workOrder->id
                    ]);
            }

            for ($i = 0; $i < count($request->inspection_items); $i++) {
                if (!empty($request['inspection_items'][$i]) && !empty($request['qty'][$i]) && !empty($request['remarks_inv'][$i]))
                    WorkOrderItem::create([
                        'item_id' => $request['inspection_items'][$i],
                        'qty' => $request['qty'][$i],
                        'remarks' => $request['remarks_inv'][$i],
                        'workorder_id' => $workOrder->id
                    ]);
            }

            if ($request->has('files_upload_input')) {
                foreach ($request->files_upload_input as $file) {

                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('workorder_attachment'), $fileName);
                    $url = asset('/workorder_attachment/' . $fileName);

                    WorkorderAttachment::create([
                        'file_name' => $fileName,
                        'file_url' => $url,
                        'file_extension' => $extension,
                        'user_id' => Auth::id(),
                        'work_order_id' => $workOrder->id,
                    ]);
                }
            }
            // if ($request->type == 'close') {
            //     $inspection = Inspection::where('id', $workOrder->inspection_id)->first();
            //     if ($inspection && $inspection->inspection_type == 0) {
            //         Vehicle::findOrFail($inspection->vehicle_id)->update([
            //             'status' => Vehicle::AVAILABLE
            //         ]);
            //     }
            // }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Inspection Approved'
            ]);
        } catch (\Exception $th) {
            dd($th);
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
