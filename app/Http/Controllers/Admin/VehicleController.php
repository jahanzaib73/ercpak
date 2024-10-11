<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\Inspection;
use App\Models\Location;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleAttachment;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Traits\VehicleStateTrait;
use App\Traits\VehicleStatusTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    use VehicleStateTrait, VehicleStatusTrait;
    public function index(Request $request)
    {
        $this->authorize('All Vehicles');
        if ($request->ajax()) {
            $vehicles = Vehicle::latest();

            return DataTables::of($vehicles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    // if (Auth::user()->can('View Meeting')){
                    $btn .= '<a href=' . route('vehicles.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    // }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {
                    return $this->getStatus($row);
                })->addColumn('image', function ($row) use ($request) {

                    return '<a href=' . $row->image_url . ' target="_blank"><img width="100" src=' . $row->image_url . ' /></a>';
                })->addColumn('vehicle_model', function ($row) use ($request) {

                    return optional($row->model)->name ?: 'N/A';
                })->addColumn('vehicle_make', function ($row) use ($request) {

                    return optional($row->make)->name ?: 'N/A';
                })->addColumn('vehicle_type', function ($row) use ($request) {

                    return optional($row->type)->name ?: 'N/A';
                })->addColumn('fuel_type', function ($row) use ($request) {

                    return optional($row->fuelType)->name ?: 'N/A';
                })->addColumn('owner', function ($row) use ($request) {

                    return optional($row->owner)->full_name ?: 'N/A';
                })->addColumn('department', function ($row) use ($request) {

                    return optional($row->department)->name ?: 'N/A';
                })->addColumn('is_outsource', function ($row) use ($request) {

                    $isOutsource = '';
                    if ($row->is_outsource == 0) {
                        $isOutsource = '<span class="badge badge-primary">No</span>';
                    } else {
                        $isOutsource = '<span class="badge badge-info">Yes</span>';
                    }
                    return $isOutsource;
                })
                ->rawColumns(['action', 'status', 'image', 'is_outsource'])
                ->make(true);
        }

        $data = [];
        $data['makes'] = VehicleMake::whereStatus(1)->get();
        $data['models'] = VehicleModel::whereStatus(1)->get();
        $data['types'] = VehicleType::whereStatus(1)->get();
        $data['fuelTypes'] = FuelType::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['departments'] = Department::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();

        $data['states'] = $this->getStates();
        return view('admin.fleets.vehicles.index', $data);
    }

    public function store(Request $request)
    {

        $this->authorize('Add Vehicles');

        $url = null;
        if ($request->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->file->move(public_path('vehicle_images'), $fileName);
            $url = asset('/vehicle_images/' . $fileName);
        }

        Vehicle::create([
            "vehicle_number" => $request->vehicle_number,
            "vehicle_make_id" => $request->vehicle_make_id ?: 0,
            "vehicle_model_id" => $request->vehicle_model_id ?: 0,
            "vehicle_type_id" => $request->vehicle_type_id ?: 0,
            "color" => $request->color,
            "engine_number" => $request->engine_number,
            "chassis_number" => $request->chassis_number,
            "fuel_type_id" => $request->fuel_type_id ?: 0,
            "year" => $request->year,
            "owner_id" => $request->owner_id ?: 0,
            "current_meter_reading" => $request->current_meter_reading,
            "base_meter_reading" => $request->base_meter_reading,
            "department_id" => $request->department_id ?: 0,
            "location_id" => $request->location_id ?: 0,
            "status" => $request->status ?: 1,
            "notes" => $request->notes,
            'image_url' =>  $url,
            'is_outsource' =>  $request->is_outsource ?: 0,
            'password' => encrypt($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vehicle Added Successfully',
            'vehicles' => Vehicle::whereStatus(Vehicle::AVAILABLE)->get()
        ], 200);
    }

    public function show($id)
    {
        $data = [];
        $data['vehicle'] = Vehicle::with('make', 'model', 'type', 'fuelType', 'owner', 'user', 'location', 'department')->findorFail($id);
        $data['makes'] = VehicleMake::whereStatus(1)->get();
        $data['models'] = VehicleModel::whereStatus(1)->get();
        $data['types'] = VehicleType::whereStatus(1)->get();
        $data['fuelTypes'] = FuelType::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['departments'] = Department::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();

        $timelineData = [];
        $fuelData = Fuel::where('vehicle_id', $data['vehicle']->id)->get();
        $index = 0;
        foreach ($fuelData as $fuel) {
            $timelineData[$index]['date'] = Carbon::parse($fuel->created_at)->toDateTimeString();
            $timelineData[$index]['description'] = 'Fuel entry against #: ' . $fuel->id;
            // $timelineData[$index]['user'] = optional(optional($fuel->purchaseOrder)->user)->full_name;
            $index++;
        }

        $tripTimeline = Trip::where('vehicle_id', $data['vehicle']->id)->get();
        foreach ($tripTimeline as $trip) {
            $timelineData[$index]['date'] = Carbon::parse($trip->created_at)->toDateTimeString();
            $timelineData[$index]['description'] = 'Trip Entry against Trip#: ' . $trip->id;
            // $timelineData[$index]['user'] = optional(optional($io->invoice)->requestBy)->full_name;
            $index++;
        }

        $inspectionTimeline = Inspection::where('vehicle_id', $data['vehicle']->id)->get();
        foreach ($inspectionTimeline as $inspection) {
            $timelineData[$index]['date'] = Carbon::parse($inspection->created_at)->toDateTimeString();
            $timelineData[$index]['description'] = 'Workorder Entry against #' . $inspection->id;
            // $timelineData[$index]['user'] = optional(optional($io->invoice)->requestBy)->full_name;
            $index++;
        }


        $data['timelineData'] = $timelineData;

        return view('admin.fleets.vehicles.show', $data);
    }


    public function storeAttachment(Request $request)
    {
        $this->authorize('Upload File Vehicles');

        $attachment = $request->file;
        $extension = $attachment->getClientOriginalExtension();
        $fileName = rand(1, 100000) . time() . '.' . $extension;
        $attachment->move(public_path('vehicle_attachments'), $fileName);
        $url = asset('/vehicle_attachments/' . $fileName);

        VehicleAttachment::create([
            'file_name' => $request->file_name,
            'file_extension' => $extension,
            'file_url' => $url,
            'user_id' => Auth::id(),
            'vehicle_id' => $request->id,
        ]);
        Session::put('success', 'Vehicle Attachment Added Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Attachment added'
        ], 200);
    }

    public function edit(Request $request)
    {

        $this->authorize('Edit Vehicles');

        $vehicle = Vehicle::with('make', 'model', 'type', 'fuelType', 'owner', 'user', 'location', 'department')->findorFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Recored Fatched',
            'vehicle' => $vehicle
        ], 200);
    }

    public function update(Request $request)
    {

        $this->authorize('Edit Vehicles');

        $vehicle = Vehicle::findOrFail($request->id);
        $url = null;
        if ($request->has('image') && $request->image != 'undefined') {
            $extension = $request->image->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->image->move(public_path('vehicle_images'), $fileName);
            $url = asset('/vehicle_images/' . $fileName);
        }

        $vehicle->update([
            "vehicle_number" => $request->vehicle_number,
            "vehicle_make_id" => $request->vehicle_make_id,
            "vehicle_model_id" => $request->vehicle_model_id,
            "vehicle_type_id" => $request->vehicle_type_id,
            "color" => $request->color,
            "engine_number" => $request->engine_number,
            "chassis_number" => $request->chassis_number,
            "fuel_type_id" => $request->fuel_type_id,
            "year" => $request->year,
            "owner_id" => $request->owner_id,
            "current_meter_reading" => $request->current_meter_reading,
            "department_id" => $request->department_id,
            "location_id" => $request->location_id,
            "status" => $request->status,
            "notes" => $request->notes,
            'image_url' =>  $url ?: $vehicle->image_url
        ]);

        Session::put('success', 'Vehicle Update Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Vehicle Update Successfully'
        ], 200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Vehicles');

        Vehicle::findOrFail($id)->delete();
        return redirect()->route('vehicles.index')->with('success', 'Record deleted successfully');
    }
}
