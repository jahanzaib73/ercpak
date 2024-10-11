<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CostCenter;
use App\Models\Fuel;
use App\Models\FuelAttachment;
use App\Models\FuelType;
use App\Models\Inventory;
use App\Models\PurchaseOrder;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class FuelController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('All Fuels Slip');
        if ($request->ajax()) {
            $trips = Fuel::with('costCenter', 'vehicle.model', 'fuelMan', 'fuelType', 'official', 'driver', 'trip')->latest();

            return DataTables::of($trips)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View Fuels Slip')){
                    $btn .= '<a href=' . route('fuels.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }

                    return $btn;
                })->addColumn('trip_status', function ($row) use ($request) {

                    $status = '';
                    // if($row->status == Trip::OPEN){
                    //     $status = '<span class="badge badge-primary">Trip Open</span>';
                    // }else if($row->status == Trip::CLOSED){
                    //     $status = '<span class="badge badge-info">Closed</span>';
                    // }else if($row->status == Trip::CANCELLED){
                    //     $status = '<span class="badge badge-danger">Cancelled</span>';
                    // }

                    return $status;
                })->addColumn('image', function ($row) use ($request) {

                    return '<a href=' . optional($row->vehicle)->image_url . ' target="_blank"><img width="100" src=' . optional($row->vehicle)->image_url . ' /></a>';
                })->addColumn('costCenter', function ($row) use ($request) {

                    return optional($row->costCenter)->title ?: 'N/A';
                })->addColumn('vehicle_number', function ($row) use ($request) {

                    return optional($row->vehicle)->vehicle_number ?: 'N/A';
                })->addColumn('model', function ($row) use ($request) {

                    return optional(optional($row->vehicle)->model)->name ?: 'N/A';
                })->addColumn('fuelMan', function ($row) use ($request) {

                    return optional($row->fuelMan)->full_name ?: 'N/A';
                })->addColumn('fuelType', function ($row) use ($request) {

                    return optional($row->fuelType)->name ?: 'N/A';
                })->addColumn('driver', function ($row) use ($request) {

                    return optional($row->driver)->full_name ?: 'N/A';
                })->addColumn('official', function ($row) use ($request) {

                    return optional($row->official)->full_name ?: 'N/A';
                })->addColumn('distance', function ($row) use ($request) {

                    return $row->return_meetr_reading ? $row->return_meetr_reading - $row->exit_meetr_reading : 'N/A';
                })->addColumn('attachments', function ($row) use ($request) {

                    return count($row->attachments);
                })->addColumn('total', function ($row) use ($request) {

                    return number_format($row->qty * $row->price, 2);
                })->addColumn('price', function ($row) use ($request) {

                    return number_format($row->price, 2);
                })->addColumn('lastRefuelDate', function ($row) use ($request) {

                    return Fuel::where('vehicle_id', $row->vehicle_id)->orderBy('id', 'DESC')->first()->date;
                })
                ->rawColumns(['action', 'status', 'image', 'trip_status'])
                ->make(true);
        }

        $data = [];

        $data['costCenters'] = CostCenter::whereStatus(1)->get();
        $data['fuelTypes'] = FuelType::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();
        $data['vheicles'] = Vehicle::whereStatus(Vehicle::AVAILABLE)->get();
        $data['trips'] = Trip::whereStatus(Trip::OPEN)->get();
        $data['makes'] = VehicleMake::whereStatus(1)->get();
        $data['models'] = VehicleModel::whereStatus(1)->get();
        $data['types'] = VehicleType::whereStatus(1)->get();
        $data['purchaseOrder'] = PurchaseOrder::whereStatus(PurchaseOrder::COMPARATIVEAPPROVED)->get();
        $data['workorders'] = WorkOrder::all();
        $data['hobc'] = Inventory::where('fuel_type_id', 3)->sum('qty');
        $data['super'] = Inventory::where('fuel_type_id', 2)->sum('qty');
        $data['disel'] = Inventory::where('fuel_type_id', 1)->sum('qty');
        // $data['states'] = $this->getStates();

        return view('new-admin.fleets.fuels.index', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Fuels Slip');

        try {

            $tripId = 0;
            $vehicleId = $request->vehicle_id;
            if ($request->trip_id) {
                $trip = Trip::findOrFail($request->trip_id);
                $tripId = $trip->id;
                $vehicleId = $trip->vehicle_id;
            }

            DB::beginTransaction();
            $vehicle = Vehicle::findOrFail($vehicleId);
            if ($request->vehicle_meter_reading < $vehicle->current_meter_reading) {
                return response()->json([
                    'status' => false,
                    'message' => 'Meter Reading should be greater then vehicle currunt meter reading'
                ], 200);
            }

            $fuel = Fuel::create([
                "date" => $request->exit_datetime,
                "vehicle_meter_reading" => $request->vehicle_meter_reading,
                "notes" => $request->notes,
                "qty" => $request->qty ?: 0,
                "trip_id" => $tripId,
                "vehicle_id" => $vehicleId,
                "driver_id" => $request->driver_id ?: 0,
                "official_id" => $request->official_id ?: 0,
                "cost_center_id" => $request->cost_center_id ?: 0,
                "fuel_tank_id" => $request->fuel_tank_id ?: 0,
                "fuel_type_id" => $request->fuel_type_id ?: 0,
                "fuel_man_id" => $request->fuel_man_id ?: 0,
                "price" => $request->price ?: 0,
                'purchase_order_id' => $request->purchase_order_id ?: 0,
                'work_order_id' => $request->work_order_id ?: 0,
            ]);

            $vehicle->update([
                'current_meter_reading' => $request->vehicle_meter_reading
            ]);

            if ($request->has('atachments')) {

                foreach ($request->atachments as $attachment) {

                    $extension = $attachment->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $attachment->move(public_path('trip_attachments'), $fileName);
                    $url = asset('/trip_attachments/' . $fileName);

                    FuelAttachment::create([
                        'file_name' => $fileName,
                        'file_url' => $url,
                        'file_extension' => $extension,
                        'user_id' => Auth::id(),
                        'fuel_id' => $fuel->id,
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Fuel Added Successfully'
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

        $this->authorize('View Fuels Slip');

        $data = [];
        $data['fuel'] = Fuel::with('costCenter', 'vehicle.model', 'fuelMan', 'fuelType', 'official.designation', 'driver.designation', 'trip')->findOrFail($id);
        $data['lastRefuelDate'] = Fuel::where('vehicle_id', $data['fuel']->vehicle_id)->orderBy('id', 'DESC')->first()->date;
        $data['costCenters'] = CostCenter::whereStatus(1)->get();
        $data['fuelTypes'] = FuelType::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();
        $data['vheicles'] = Vehicle::whereStatus(Vehicle::AVAILABLE)->get();
        $data['trips'] = Trip::whereStatus(Trip::OPEN)->get();
        $data['purchaseOrder'] = PurchaseOrder::whereStatus(PurchaseOrder::COMPARATIVEAPPROVED)->get();
        $data['workorders'] = WorkOrder::all();
        // dd($data);
        return view('admin.fleets.fuels.show', $data);
    }

    public function edit(Request $request)
    {

        $this->authorize('Edit Fuel Slip');

        $fuel = Fuel::with('costCenter', 'vehicle.model', 'fuelMan', 'fuelType', 'official.designation', 'driver.designation', 'trip')->findOrFail($request->id);

        return response()->json([
            'status' => true,
            'message' => 'Recored Fatched',
            'fuel' => $fuel
        ], 200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Fuel Slip');

        try {

            $tripId = 0;
            $vehicleId = $request->vehicle_id;
            if ($request->trip_id) {
                $trip = Trip::findOrFail($request->trip_id);
                $tripId = $trip->id;
                $vehicleId = $trip->vehicle_id;
            }

            DB::beginTransaction();
            $vehicle = Vehicle::findOrFail($vehicleId);
            if ($request->vehicle_meter_reading < $vehicle->current_meter_reading) {
                return response()->json([
                    'status' => false,
                    'message' => 'Meter Reading should be greater then vehicle currunt meter reading'
                ], 200);
            }

            $fuel = Fuel::findOrfail($request->id);
            $fuel->update([
                "date" => $request->exit_datetime,
                "vehicle_meter_reading" => $request->vehicle_meter_reading,
                "notes" => $request->notes,
                "qty" => $request->qty ?: 0,
                "trip_id" => $tripId,
                "vehicle_id" => $vehicleId,
                "driver_id" => $request->driver_id ?: 0,
                "official_id" => $request->official_id ?: 0,
                "cost_center_id" => $request->cost_center_id ?: 0,
                "fuel_tank_id" => $request->fuel_tank_id ?: 0,
                "fuel_type_id" => $request->fuel_type_id ?: 0,
                "fuel_man_id" => $request->fuel_man_id ?: 0,
                "price" => $request->price ?: 0,
                'purchase_order_id' => $request->purchase_order_id ?: 0,
                'work_order_id' => $request->work_order_id ?: 0
            ]);

            $vehicle->update([
                'current_meter_reading' => $request->vehicle_meter_reading
            ]);

            if ($request->has('atachments')) {

                foreach ($request->atachments as $attachment) {

                    $extension = $attachment->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $attachment->move(public_path('trip_attachments'), $fileName);
                    $url = asset('/trip_attachments/' . $fileName);

                    FuelAttachment::create([
                        'file_name' => $fileName,
                        'file_url' => $url,
                        'file_extension' => $extension,
                        'user_id' => Auth::id(),
                        'fuel_id' => $fuel->id,
                    ]);
                }
            }
            DB::commit();
            Session::put('success', 'Trip Update Successfully');
            return response()->json([
                'status' => true,
                'message' => 'Fule Slip Update Successfully'
            ], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ], 500);
        }
    }


    public function delete($id)
    {

        $this->authorize('Delete Fuel Slip');
        $fuel = Fuel::findOrFail($id);
        $fuel->delete();
        return redirect()->route('fuels.index')->with('success', 'Record deleted successfully');
    }

    public function getFuelSummery()
    {


        $fuelData = DB::table('fuels')
            ->join('fuel_types', 'fuels.fuel_type_id', '=', 'fuel_types.id')
            ->select('fuel_types.name as fuel_type_name')
            ->selectRaw('
        SUM(CASE WHEN MONTH(`date`) = 1 THEN qty ELSE 0 END) AS JanQty,
        SUM(CASE WHEN MONTH(`date`) = 2 THEN qty ELSE 0 END) AS FebQty,
        SUM(CASE WHEN MONTH(`date`) = 3 THEN qty ELSE 0 END) AS MarQty,
        SUM(CASE WHEN MONTH(`date`) = 4 THEN qty ELSE 0 END) AS AprQty,
        SUM(CASE WHEN MONTH(`date`) = 5 THEN qty ELSE 0 END) AS MayQty,
        SUM(CASE WHEN MONTH(`date`) = 6 THEN qty ELSE 0 END) AS JuneQty,
        SUM(CASE WHEN MONTH(`date`) = 7 THEN qty ELSE 0 END) AS JulyQty,
        SUM(CASE WHEN MONTH(`date`) = 8 THEN qty ELSE 0 END) AS AugQty,
        SUM(CASE WHEN MONTH(`date`) = 9 THEN qty ELSE 0 END) AS SeptQty,
        SUM(CASE WHEN MONTH(`date`) = 10 THEN qty ELSE 0 END) AS OctQty,
        SUM(CASE WHEN MONTH(`date`) = 11 THEN qty ELSE 0 END) AS NovQty,
        SUM(CASE WHEN MONTH(`date`) = 12 THEN qty ELSE 0 END) AS DecQty,
        SUM(CASE WHEN MONTH(`date`) = 1 THEN qty * price ELSE 0 END) AS JanTotal,
        SUM(CASE WHEN MONTH(`date`) = 2 THEN qty * price ELSE 0 END) AS FebTotal,
        SUM(CASE WHEN MONTH(`date`) = 3 THEN qty * price ELSE 0 END) AS MarTotal,
        SUM(CASE WHEN MONTH(`date`) = 4 THEN qty * price ELSE 0 END) AS AprTotal,
        SUM(CASE WHEN MONTH(`date`) = 5 THEN qty * price ELSE 0 END) AS MayTotal,
        SUM(CASE WHEN MONTH(`date`) = 6 THEN qty * price ELSE 0 END) AS JuneTotal,
        SUM(CASE WHEN MONTH(`date`) = 7 THEN qty * price ELSE 0 END) AS JulyTotal,
        SUM(CASE WHEN MONTH(`date`) = 8 THEN qty * price ELSE 0 END) AS AugTotal,
        SUM(CASE WHEN MONTH(`date`) = 9 THEN qty * price ELSE 0 END) AS SeptTotal,
        SUM(CASE WHEN MONTH(`date`) = 10 THEN qty * price ELSE 0 END) AS OctTotal,
        SUM(CASE WHEN MONTH(`date`) = 11 THEN qty * price ELSE 0 END) AS NovTotal,
        SUM(CASE WHEN MONTH(`date`) = 12 THEN qty * price ELSE 0 END) AS DecTotal
    ')
            ->groupBy('fuel_type_id', 'fuel_types.name')
            ->orderBy('fuel_type_id')
            ->get();


        return response()->json([
            'status' => true,
            'fuelData' => $fuelData,
        ], 200);
    }

    public function generateReport($id)
    {
        $this->authorize('Print Fuel Slip');
        $data['fuel'] = Fuel::with('costCenter', 'vehicle.model', 'fuelMan', 'fuelType', 'official.designation', 'driver.designation', 'trip')->findOrFail($id);
        $lastFuel = Fuel::where('vehicle_id', $data['fuel']->vehicle_id)->orderBy('id', 'DESC')->first();
        $data['lastRefuelDate'] = $lastFuel->date;
        $data['lastRefuelqty'] = $lastFuel->qty;

        return view('admin.fleets.fuels.report', $data);
    }
}
