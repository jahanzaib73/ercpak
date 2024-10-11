<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CostCenter;
use App\Models\Fuel;
use App\Models\InpectionItemChecklist;
use App\Models\Inspection;
use App\Models\InspectionBy;
use App\Models\InspectionChecklist;
use App\Models\InspectionPhoto;
use App\Models\ProtocolLiaison;
use App\Models\Technician;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\WorkOrder;
use App\Traits\VehicleStateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InspectionController extends Controller
{
    use VehicleStateTrait;
    public function index(Request $request)
    {
        $this->authorize('All Inspection');
        if ($request->ajax()) {
            $trips = Inspection::with('vehicle.model', 'costCenter', 'user', 'property')
                ->whereHas('property', function ($query) {
                    $query->where('protocol_liaisontype_id', 5);
                })
                ->orWhereDoesntHave('property')
                ->latest();

            return DataTables::of($trips)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('Show Inspection')) {
                        $btn .= '<a href=' . route('inspections.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                    $status = '';
                    if ($row->status == Inspection::OPEN) {
                        $status = '<span class="badge badge-danger">Open</span>';
                    } else if ($row->status == Inspection::CLOSED) {
                        $status = '<span class="badge badge-danger">Closed</span>';
                    }

                    return $status;
                })->addColumn('image', function ($row) use ($request) {

                    return '<a href=' . optional($row->vehicle)->image_url . ' target="_blank"><img width="100" src=' . optional($row->vehicle)->image_url . ' /></a>';
                })->addColumn('costCenter', function ($row) use ($request) {

                    return optional($row->costCenter)->title ?: 'N/A';
                })->addColumn('vehicle_number', function ($row) use ($request) {

                    return optional($row->vehicle)->vehicle_number ?: 'N/A';
                })->addColumn('model', function ($row) use ($request) {

                    return optional(optional($row->vehicle)->model)->name ?: 'N/A';
                })->addColumn('attachments', function ($row) use ($request) {

                    return count($row->attachments);
                })->addColumn('property', function ($row) use ($request) {

                    return optional($row->property)->property_name ?: 'N/A';
                })->addColumn('inspection_type', function ($row) use ($request) {
                    $type = '';
                    if ($row->inspection_type == 0) {
                        $type = '<span class="badge badge-danger">Vehicle</span>';
                    } else {
                        $type = '<span class="badge badge-danger">Asset</span>';
                    }
                    return $type;
                })
                ->rawColumns(['action', 'status', 'image', 'inspection_type'])
                ->make(true);
        }

        $data = [];
        $data['states'] = $this->getStates();

        return view('admin.fleets.inspections.index', $data);
    }

    public function create()
    {
        $this->authorize('Add Inspection');

        $data = [];
        $data['costCenters'] = CostCenter::whereStatus(1)->get();
        $data['items'] = InspectionChecklist::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();
        $data['vehicles'] = Vehicle::whereStatus(Vehicle::AVAILABLE)->get();
        $data['properties'] = ProtocolLiaison::where('protocol_liaisontype_id', 5)->get();

        return view('admin.fleets.inspections.create', $data);
    }
    public function store(Request $request)
    {
        $this->authorize('Add Inspection');

        $request->validate([
            'inspection_type' => ['required', 'in:0,1'],
            'vehicle_id' => ['required_if:inspection_type,0'],
            'meter_reading' => ['required_if:inspection_type,0'],
            'property_id' => ['required_if:inspection_type,1'],
            'date' => ['required', 'date'],
            'cost_center_id' => ['required', 'numeric'],
            'inspection_bies' => ['required', 'array'],
            'inspection_items' => ['required', 'array'],
            'inspection_items.*' => ['required', 'string'], // You can adjust the rule for the items as needed
            'inspection_items_status' => ['required', 'array'],
            'inspection_items_status.*' => ['required', 'string'], // You can adjust the rule for the statuses as needed
            'remarks' => ['required', 'array'],
            'remarks.*' => ['required', 'string'], // You can adjust the rule for the remarks as needed
        ]);

        try {

            DB::beginTransaction();
            $vehicle = null;
            if ($request->has('vehicle_id') && !empty($request->vehicle_id)) {
                $vehicle = Vehicle::findOrFail($request->vehicle_id);
                if ($request->meter_reading < $vehicle->current_meter_reading) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Meter Reading should be greater then vehicle currunt meter reading'
                    ], 200);
                }
            }

            $inspection = Inspection::create([
                'inspection_type' => $request->inspection_type,
                'vehicle_id' => $request->vehicle_id ?: 0,
                'property_id' => $request->property_id ?: 0,
                'cost_center_id' => $request->cost_center_id,
                'meter_reading' => $request->meter_reading ?: 0,
                'date' => $request->date,
                'remarks' => $request->notes,
            ]);
            if ($vehicle)
                $vehicle->update([
                    'current_meter_reading' => $request->meter_reading ?: $vehicle->current_meter_reading,
                    'status' => Vehicle::ONWORKSHOP
                ]);

            foreach ($request->inspection_bies as $inspectionBy) {
                InspectionBy::create([
                    'inspection_id' => $inspection->id,
                    'user_id' => $inspectionBy
                ]);
            }

            for ($i = 0; $i < count($request->inspection_items); $i++) {
                InpectionItemChecklist::create([
                    'inspection_checklist_id' => $request['inspection_items'][$i],
                    'status' => $request['inspection_items_status'][$i],
                    'remarks' => $request['remarks'][$i],
                    'inspection_id' => $inspection->id
                ]);
            }

            if ($request->has('files')) {

                foreach ($request->files as $index => $attachment) {
                    foreach ($attachment as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $fileName = rand(1, 100000) . time() . '.' . $extension;
                        $file->move(public_path('inspections_photo'), $fileName);
                        $url = asset('/inspections_photo/' . $fileName);

                        InspectionPhoto::create([
                            'file_name' => $fileName,
                            'file_url' => $url,
                            'file_type' => $extension,
                            'user_id' => Auth::id(),
                            'inspection_id' => $inspection->id,
                        ]);
                    }
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Inspection Added Successfully',
                'url' => route('inspections.index')
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $this->authorize('Show Inspection');

        $data = [];
        $data['inspection'] = Inspection::with('inspectionBies.user.designation', 'vehicle.model', 'costCenter', 'user', 'inspectionChecklistItems.inspectionItem')->findOrFail($id);

        $data['users'] = User::whereStatus(1)->get();
        $data['venderos'] = Vendor::whereStatus(1)->get();

        // dd($data);
        return view('admin.fleets.inspections.show', $data);
    }

    public function edit(Request $request)
    {

        // $fuel = Fuel::with('costCenter','vehicle.model','fuelMan','fuelType','official.designation','driver.designation','trip')->findOrFail($request->id);
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Recored Fatched',
        //     'fuel' => $fuel
        // ],200);
    }



    public function delete($id)
    {
        // $fuel = Fuel::findOrFail($id);
        // $fuel->delete();
        // return redirect()->route('fuels.index')->with('success','Record deleted successfully');
    }

    public function getFuelSummery()
    {
        $fuelData = DB::table('fuels')
            ->join('fuel_types', 'fuels.fuel_type_id', '=', 'fuel_types.id')
            ->select('fuel_types.name as fuel_type_name')
            ->selectRaw('
                SUM(CASE WHEN MONTH(`date`) = 1 THEN qty*price ELSE 0 END) AS JanTotal,
                SUM(CASE WHEN MONTH(`date`) = 2 THEN qty*price ELSE 0 END) AS FebTotal,
                SUM(CASE WHEN MONTH(`date`) = 3 THEN qty*price ELSE 0 END) AS MarTotal,
                SUM(CASE WHEN MONTH(`date`) = 4 THEN qty*price ELSE 0 END) AS AprTotal,
                SUM(CASE WHEN MONTH(`date`) = 5 THEN qty*price ELSE 0 END) AS MayTotal,
                SUM(CASE WHEN MONTH(`date`) = 6 THEN qty*price ELSE 0 END) AS JuneTotal,
                SUM(CASE WHEN MONTH(`date`) = 7 THEN qty*price ELSE 0 END) AS JulyTotal,
                SUM(CASE WHEN MONTH(`date`) = 8 THEN qty*price ELSE 0 END) AS AugTotal,
                SUM(CASE WHEN MONTH(`date`) = 9 THEN qty*price ELSE 0 END) AS SeptTotal,
                SUM(CASE WHEN MONTH(`date`) = 10 THEN qty*price ELSE 0 END) AS OctTotal,
                SUM(CASE WHEN MONTH(`date`) = 11 THEN qty*price ELSE 0 END) AS NovTotal,
                SUM(CASE WHEN MONTH(`date`) = 12 THEN qty*price ELSE 0 END) AS DecTotal
            ')
            ->groupBy('fuel_type_id', 'fuel_types.name')
            ->orderBy('fuel_type_id')
            ->get();

        return response()->json([
            'status' => true,
            'fuelData' => $fuelData
        ], 200);
    }

    // public function inspectionApproved(Request $request)
    // {
    //     $this->authorize('Approve Inspection');
    //     try {
    //         DB::beginTransaction();
    //         $inspection = Inspection::findOrFail($request->inspectionId);
    //         $inspection->update([
    //             'vendor_id' => $request->vendor_id,
    //             'admin_approve_remarks' => $request->admin_remarks,
    //             'approved_by_id' => Auth::id(),
    //             'status' => Inspection::CLOSED
    //         ]);

    //         if ($request->technicians_ids) {
    //             foreach ($request->technicians_ids as $technicain) {
    //                 Technician::create([
    //                     'user_id' => $technicain,
    //                     'inspection_id' => $inspection->id
    //                 ]);
    //             }
    //         }
    //         WorkOrder::create([
    //             'inspection_id' => $inspection->id
    //         ]);

    //         DB::commit();
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Inspection Approved'
    //         ]);
    //     } catch (\Exception $th) {

    //         DB::rollBack();
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ]);
    //     }
    // }
}
