<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CostCenter;
use App\Models\Fuel;
use App\Models\Location;
use App\Models\PurchaseOrder;
use App\Models\Trip;
use App\Models\TripAttachments;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use App\Traits\VehicleStateTrait;
use App\Traits\VehicleStatusTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use Yajra\DataTables\Facades\DataTables;

class TripController extends Controller
{
    use VehicleStateTrait, VehicleStatusTrait;
    public function index(Request $request)
    {
        $trips = Trip::with('costCenter', 'vehicle.model', 'official', 'driver')->latest()->get();
        // dd($trips);
        $this->authorize('All Trips');
        if ($request->ajax()) {

            return DataTables::of($trips)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View Trips')) {
                        $btn .= '<a href=' . route('trips.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }
                    return $btn;
                })->addColumn('trip_status', function ($row) use ($request) {

                    $status = '';
                    if ($row->status == Trip::OPEN) {
                        $status = '<span class="badge badge-primary">Trip Open</span>';
                    } else if ($row->status == Trip::CLOSED) {
                        $status = '<span class="badge badge-info">Closed</span>';
                    } else if ($row->status == Trip::CANCELLED) {
                        $status = '<span class="badge badge-danger">Cancelled</span>';
                    }

                    return $status;
                })->addColumn('status', function ($row) use ($request) {

                    return $this->getVehicleStatusForTrip($row);
                })->addColumn('image', function ($row) use ($request) {

                    return '<a href=' . optional($row->vehicle)->image_url . ' target="_blank"><img width="100" src=' . optional($row->vehicle)->image_url . ' /></a>';
                })->addColumn('costCenter', function ($row) use ($request) {

                    return optional($row->costCenter)->title ?: 'N/A';
                })->addColumn('vehicle_number', function ($row) use ($request) {

                    return optional($row->vehicle)->vehicle_number ?: 'N/A';
                })->addColumn('model', function ($row) use ($request) {

                    return optional(optional($row->vehicle)->model)->name ?: 'N/A';
                })->addColumn('origin', function ($row) use ($request) {

                    return optional($row)->origin ?: 'N/A';
                })->addColumn('destination', function ($row) use ($request) {

                    return optional($row)->destination ?: 'N/A';
                })->addColumn('driver', function ($row) use ($request) {

                    return optional($row->driver)->full_name ?: 'N/A';
                })->addColumn('official', function ($row) use ($request) {

                    return optional($row->official)->full_name ?: 'N/A';
                })->addColumn('distance', function ($row) use ($request) {

                    return $row->return_meetr_reading ? $row->return_meetr_reading - $row->exit_meetr_reading : 'N/A';
                })->addColumn('attachments', function ($row) use ($request) {

                    return count($row->attachments);
                })
                ->rawColumns(['action', 'status', 'image', 'trip_status'])
                ->make(true);
        }

        $data = [];
        $data['locations'] = Location::whereStatus(1)->get();
        $data['purchaseOrder'] = PurchaseOrder::whereStatus(PurchaseOrder::COMPARATIVEAPPROVED)->get();
        $data['workorders'] = WorkOrder::all();
        $data['fuelSlip'] = Fuel::all();
        $data['costCenters'] = CostCenter::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();
        $data['vehicles'] = Vehicle::whereStatus(Vehicle::AVAILABLE)->get();
        $data['states'] = $this->getStates();

        return view('new-admin.fleets.trips.index', $data);
    }

    public function tracking(Request $request)
    {
        if ($request->ajax()) {
            $trips = Trip::where('status', 0)->with('vehicle.model', 'driver')->latest();

            return DataTables::of($trips)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View Trips')) {
                        $btn .= '<a href=' . route('tracking.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                    return $this->getVehicleStatusForTrip($row);
                })->addColumn('trip_number', function ($row) use ($request) {

                    return 'N/A';
                })->addColumn('vehicle_type', function ($row) use ($request) {

                    return optional($row->vehicle->type)->name ?: 'N/A';
                })->addColumn('vehicle_number', function ($row) use ($request) {

                    return optional($row->vehicle)->vehicle_number ?: 'N/A';
                })->addColumn('vehicle_model', function ($row) use ($request) {

                    return optional($row->vehicle->model)->name ?: 'N/A';
                })->addColumn('model', function ($row) use ($request) {

                    return optional(optional($row->vehicle)->model)->name ?: 'N/A';
                })->addColumn('origin', function ($row) use ($request) {

                    return optional($row)->origin ?: 'N/A';
                })->addColumn('destination', function ($row) use ($request) {

                    return optional($row)->destination ?: 'N/A';
                })->addColumn('driver', function ($row) use ($request) {

                    return optional($row->driver)->full_name ?: 'N/A';
                })
                ->rawColumns(['action', 'status', 'image', 'trip_status'])
                ->make(true);
        }
        $data = [];
        $data['trips'] = json_encode(Trip::latest()->get());
        return view('admin.fleets.tracking.index', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Trips');

        try {
            DB::beginTransaction();
            $trip = Trip::create([
                "vehicle_id" => $request->vehicle_id,
                "driver_id" => $request->driver_id,
                "official_id" => $request->official_id,
                "cost_center_id" => $request->cost_center_id,
                "origin" => $request->origin,
                "destination" => $request->destination,
                "purchase_order_id" => $request->purchase_order_id ?: 0,
                "work_order_id" => $request->work_order_id ?: 0,
                "fuel_slip_id" => $request->fuel_slip_id ?: 0,
                "exit_datetime_out" => $request->exit_datetime,
                "exit_meetr_reading" => $request->exit_meetr_reading,
                "notes" => $request->notes,
            ]);

            Vehicle::findOrFail($trip->vehicle_id)->update([
                'status' => Vehicle::ONMOVE,
                'current_meter_reading' => $request->exit_meetr_reading
            ]);

            $fuel = Fuel::where('vehicle_id', $trip->vehicle_id)->first();
            if ($fuel) {
                $fuel->update([
                    'vehicle_meter_reading' => $request->exit_meetr_reading
                ]);
            }

            if ($request->has('atachments')) {

                foreach ($request->atachments as $attachment) {

                    $extension = $attachment->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $attachment->move(public_path('trip_attachments'), $fileName);
                    $url = asset('/trip_attachments/' . $fileName);

                    TripAttachments::create([
                        'file_name' => $fileName,
                        'file_url' => $url,
                        'file_extension' => $extension,
                        'user_id' => Auth::id(),
                        'trip_id' => $trip->id,
                        'type' => 'Exit Document',
                    ]);
                }
            }


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Trip Added Successfully'
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
        $this->authorize('View Trips');
        $data = [];
        $data['trip'] = Trip::with('costCenter', 'vehicle.model', 'official.designation', 'driver.designation')->findorFail($id);
        $data['locations'] = Location::whereStatus(1)->get();
        $data['costCenters'] = CostCenter::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();
        $data['vheicles'] = Vehicle::whereStatus(Vehicle::AVAILABLE)->orWhere('id', optional($data['trip']->vehicle)->id)->get();
        $data['purchaseOrder'] = PurchaseOrder::whereStatus(PurchaseOrder::COMPARATIVEAPPROVED)->get();
        $data['workorders'] = WorkOrder::all();
        $data['fuelSlip'] = Fuel::all();
        return view('admin.fleets.trips.show', $data);
    }

    public function tracker($id)
    {
        $trip = Trip::with('vehicle.trips', 'vehicle.model', 'driver.designation')->findOrFail($id, ['id', 'vehicle_id', 'driver_id', 'coordinates', 'origin', 'destination', 'status', 'created_at', 'return_datetime_out', 'exit_datetime_out']);
        $coordinates = json_decode($trip->coordinates);
        $stops = [];
        $previousCoordinate = null;

        if ($coordinates) {
            foreach ($coordinates as $coordinate) {
                if (property_exists($coordinate, 'timestamp')) {
                    // Convert timestamp to DateTime object for comparison
                    $currentTimestamp = Carbon::createFromTimestampMs($coordinate->timestamp);
                    /** @var $currentTimestamp is assigned to @var $coordinate->timestamp for next iteration **/
                    $coordinate->timestamp = $currentTimestamp;
                    // If it's not the first iteration, calculate the difference
                    if ($previousCoordinate) {
                        $differenceInMinutes = $currentTimestamp->diffInMinutes($previousCoordinate->timestamp);
                        // If difference is greater than 5 minutes, count it as a stop
                        if ($differenceInMinutes >= 5) {
                            $stops[] = [
                                'minutes' => $differenceInMinutes,
                                'lat' => $coordinate->lat,
                                'lng' => $coordinate->lng,
                            ];
                        }
                    }
                    /** Assign current @var $coordinate as @var $previousCoordinate for the next iteration **/
                    $previousCoordinate = $coordinate;
                }
            }
        }
        $data = [];
        $data['trip'] = $trip;
        $data['stops'] = $stops;
        return view('admin.fleets.tracking.show', $data);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Trips');

        $trip = Trip::with('costCenter', 'vehicle.model', 'official.designation', 'driver.designation')->findorFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Recored Fatched',
            'trip' => $trip
        ], 200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Trips');


        $trip = Trip::findOrFail($request->id);


        $trip->update([
            "vehicle_id" => $request->vehicle_id,
            "driver_id" => $request->driver_id,
            "official_id" => $request->official_id,
            "cost_center_id" => $request->cost_center_id,
            "origin" => $request->origin,
            "destination" => $request->destination,
            "purchase_order_id" => $request->purchase_order_id ?: $trip->purchase_order_id,
            "work_order_id" => $request->work_order_id ?: $trip->work_order_id,
            "fuel_slip_id" => $request->fuel_slip_id ?: $trip->fuel_slip_id,
            "exit_datetime_out" => $request->exit_datetime,
            "exit_meetr_reading" => $request->exit_meetr_reading,
            "notes" => $request->notes
        ]);

        Vehicle::findOrFail($trip->vehicle_id)->update([
            'current_meter_reading' => $request->exit_meetr_reading
        ]);

        $fuel = Fuel::where('vehicle_id', $trip->vehicle_id)->first();
        if ($fuel) {
            $fuel->update([
                'vehicle_meter_reading' => $request->exit_meetr_reading
            ]);
        }

        if ($request->has('atachments')) {

            foreach ($request->atachments as $attachment) {

                $extension = $attachment->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $attachment->move(public_path('trip_attachments'), $fileName);
                $url = asset('/trip_attachments/' . $fileName);

                TripAttachments::create([
                    'file_name' => $fileName,
                    'file_url' => $url,
                    'file_extension' => $extension,
                    'user_id' => Auth::id(),
                    'trip_id' => $trip->id,
                    'type' => 'Exit Document',
                ]);
            }
        }

        FacadesSession::put('success', 'Trip Update Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Trip Update Successfully'
        ], 200);
    }

    public function closeForm(Request $request)
    {

        $this->authorize('Close Trips');

        $trip = Trip::with('costCenter', 'vehicle.model', 'official.designation', 'driver.designation')->findOrFail($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Recored Fatched',
            'trip' => $trip
        ], 200);
    }

    public function tripClose(Request $request)
    {
        $this->authorize('Close Trips');


        try {
            DB::beginTransaction();
            $trip = Trip::findorFail($request->trip_id);
            $vehile = Vehicle::where('id', $trip->vehicle_id)->first();

            if ($request->return_mtr_reading < $vehile->current_meter_reading) {
                return response()->json([
                    'status' => false,
                    'message' => 'Meter Reading should be greater then vehicle currunt meter reading'
                ], 200);
            }

            if ($request->has('attachments')) {

                foreach ($request->attachments as $attachment) {

                    $extension = $attachment->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $attachment->move(public_path('trip_attachments'), $fileName);
                    $url = asset('/trip_attachments/' . $fileName);

                    TripAttachments::create([
                        'file_name' => $fileName,
                        'file_url' => $url,
                        'file_extension' => $extension,
                        'user_id' => Auth::id(),
                        'trip_id' => $trip->id,
                        'type' => 'Closed Document',
                    ]);
                }
            }

            $trip->update([
                'return_meetr_reading' => $request->return_mtr_reading,
                'return_datetime_out' => $request->return_date_time,
                'return_notes' => $request->notes,
                'status' => Trip::CLOSED
            ]);

            $vehile->update([
                'status' => Vehicle::AVAILABLE,
                'current_meter_reading' => $request->return_mtr_reading
            ]);

            $fuel = Fuel::where('vehicle_id', $trip->vehicle_id)->first();
            if ($fuel) {
                $fuel->update([
                    'vehicle_meter_reading' => $request->return_mtr_reading
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'messsage' => 'Trip Closed',
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function tripCancel(Request $request)
    {
        $this->authorize('Cancel Trips');

        try {
            DB::beginTransaction();
            $trip = Trip::findorFail($request->trip_id);
            $vehile = Vehicle::where('id', $trip->vehicle_id)->first();

            $trip->update([
                'status' => Trip::CANCELLED,
                'cancelled_reason' => $request->reason
            ]);

            $vehile->update([
                'status' => Vehicle::AVAILABLE,
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'messsage' => 'Trip Cancelled',
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        $this->authorize('Delete Trips');

        $trip = Trip::findOrFail($id);
        Vehicle::findOrFail($trip->vehicle_id)->update([
            'status' => Vehicle::AVAILABLE
        ]);
        $trip->delete();
        return redirect()->route('trips.index')->with('success', 'Record deleted successfully');
    }

    public function vehicleById(Request $request)
    {
        if ($request->type == 'trip') {
            $data = Trip::with('vehicle.model', 'official.designation', 'driver.designation')->findOrFail($request->id);
        } else {
            $data = Vehicle::with('model')->findOrFail($request->id);
        }
        return response()->json([
            'status' => true,
            'messsage' => 'Data Fatched',
            'data' => $data,
            'type' => $request->type
        ], 200);
    }

    public function getUser(Request $request)
    {
        $user = User::with('designation')->findOrFail($request->id);
        return response()->json([
            'status' => true,
            'messsage' => 'Data Fatched',
            'data' => $user
        ], 200);
    }

    public function generateReport($id)
    {
        $this->authorize('Generate Trip Report');
        $data['trip'] = Trip::with('costCenter', 'vehicle.model', 'official.designation', 'driver.designation')->findorFail($id);
        return view('admin.fleets.trips.report', $data);
    }
}
