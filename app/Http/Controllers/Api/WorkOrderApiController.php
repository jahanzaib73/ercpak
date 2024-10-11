<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InspectionResource;
use App\Http\Resources\InspectionShowResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WorkOrderResource;
use App\Http\Resources\WorkOrderShowResource;
use App\Models\Inspection;
use App\Models\Inventory;
use App\Models\TaskWorkOrder;
use App\Models\Technician;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkOrderApiController extends Controller
{
    public function index()
    {
        $inspections = Inspection::with('vehicle.model', 'costCenter', 'user', 'property')
            ->whereHas('property', function ($query) {
                $query->where('protocol_liaisontype_id', 5);
            })
            ->orWhereDoesntHave('property')
            ->latest()->get();
        $inspectionsResponse = InspectionResource::collection($inspections);
        $workOrders = WorkOrder::whereHas('inspection', function ($query) {
            $query->whereStatus(Inspection::CLOSED);
        })->with('inspection.costCenter:id,title', 'inspection.user', 'inspection.property', 'inspection.vehicle.model')->latest()->get();
        $workOrdersResponse = WorkOrderResource::collection($workOrders);
        return response()->json([
            'inspections' => $inspections,
            'workOrders' => $workOrders
        ]);
    }

    public function show($id)
    {
        $wo = WorkOrder::with('inspection.assignedTehnicians.user.designation', 'inspection.vehicle.model', 'inspection.costCenter', 'inspection.inspectionChecklistItems.inspectionItem', 'inspection.attachments')->findOrFail($id);
        $response = new WorkOrderShowResource($wo);
        return response()->json(['wo' => $response]);
    }

    public function showInspection($id)
    {
        $inspection = Inspection::with('inspectionBies.user.designation', 'vehicle.model', 'costCenter', 'inspectionChecklistItems.inspectionItem', 'attachments')->findOrFail($id);
        $users = User::whereStatus(1)->get();
        $vendors = Vendor::whereStatus(1)->get(['id', 'name']);
        $inspectionResponse = new InspectionShowResource($inspection);
        $usersResponse = UserResource::collection($users);
        return response()->json([
            'inspection' => $inspectionResponse,
            'users' => $usersResponse,
            'vendors' => $vendors,
        ]);
    }
    public function approveInspection(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'inspectionId' => ['required', 'exists:inspections,id'],
                'vendor_id' => ['required', 'exists:vendors,id'],
                'technicians_ids' => ['required', 'array'],
                'adminRemarks' => ['nullable'],
            ]);

            $inspection = Inspection::findOrFail($request->inspectionId);

            $inspection->update([
                'vendor_id' => $request->vendor_id,
                'admin_approve_remarks' => $request->admin_remarks,
                'approved_by_id' => Auth::id(),
                'status' => Inspection::CLOSED
            ]);

            WorkOrder::create([
                'inspection_id' => $inspection->id
            ]);

            if ($request->technicians_ids) {
                foreach ($request->technicians_ids as $technicain) {
                    Technician::create([
                        'user_id' => $technicain,
                        'inspection_id' => $inspection->id
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Inspection Approved'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function closeWorkOrder(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'workOrderId' => ['required', 'exists:work_orders,id'],
                'closeRemark' => ['nullable'],
            ]);

            $workOrder = WorkOrder::findOrFail($request->workOrderId);

            $workOrder->update([
                'technicians_notes' => $request->closeRemark,
                'status' => WorkOrder::CLOSED,
            ]);

            $inspection = Inspection::findOrFail($workOrder->inspection_id);
            if ($inspection && $inspection->inspection_type == 0) {
                Vehicle::findOrFail($inspection->vehicle_id)->update([
                    'status' => Vehicle::AVAILABLE
                ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Work Order Closed'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ]);
        }
    }

}
