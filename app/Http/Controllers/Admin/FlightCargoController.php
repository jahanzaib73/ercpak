<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FlightCargoStoreRequest;
use App\Http\Requests\FlightCargoUpdateRequest;
use App\Models\AircraftVessel;
use App\Models\FlightCargo;
use App\Models\FlightCargoImage;
use App\Models\FlightCargoType;
use App\Models\FlightType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class FlightCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $flightCargos = FlightCargo::with('user')->when(($request->moduleNmae == 'record_by_flight'), function ($query) {
                $query->where('flight_cargo_type_id', 1);
            })->when(($request->moduleNmae == 'record_by_sea'), function ($query) {
                $query->where('flight_cargo_type_id', 2);
            })->when(($request->moduleNmae == 'record_by_road'), function ($query) {
                $query->where('flight_cargo_type_id', 3);
            })->latest();
            return DataTables::of($flightCargos)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) use ($request){
                        $btn = '';
                        if(Auth::user()->can('View Flight and Cargo')){
                            $btn = '<div class="d-flex align-items-center"><a href='.route('flight-and-cargos.show',$row->id).' title="Show Detail" class="btn btn-eye-icon  btn-sm edit"><i class="fa fa-eye"></i></a>';
                        }
                        if(Auth::user()->can('Edit Flight and Cargo')){
                            $btn .= ' | <a href='.route('flight-and-cargos.edit',$row->id).' title="Edit Record" class="btn bg-info btn-sm edit text-white_record text-white"><i class="fa fa-edit"></i></a>';
                        }
                        if(Auth::user()->can('Delete Flight and Cargo')){
                            $btn .= ' | <a href='.route('flight-and-cargos.delete',$row->id).' title="Delete Record" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i></a>';
                        }
                        if($row->status == 0 && $request->moduleNmae == 'record_by_flight'&&Auth::user()->can('Mark Close Flight and Cargo')){
                            $btn .= ' | <a href='.route('flight-and-cargos.flightclosed',['id'=>$row->id,'type' =>$request->moduleNmae]).' title="Mark as Close" class="btn bg-info btn-sm"><i class="mdi mdi-close text-white"></i></a>';
                            $btn .= ' | <a href="javascript:void(0)" title="Mark as Canclled" data-id='.$row->id.' class="btn bg-info btn-sm cancelled"><i class="fa fa-window-close-o text-white"></i></a>';
                        }

                        if($row->status == 0 && ($request->moduleNmae == 'record_by_sea' || $request->moduleNmae == "record_by_road")&&Auth::user()->can('Mark Canclled Flight and Cargo')){
                            $btn .= ' | <a href="javascript:void(0)" title="Mark as Closed"  data-id='.$row->id.' class="btn btn-danger text-white btn-sm closeed"><i class="mdi mdi-close text-white"></i></a></div>';
                        }

                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                        $status = '';
                        if($request->moduleNmae == 'record_by_flight'){
                            if($row->status == 0){
                                $status = '<span class="badge badge-info">Scheduled</span>';
                            }else if($row->status == 1){
                                $status = '<span class="badge badge-danger">Closed</span>';
                            }else if($row->status == 2){
                                $status = '<span class="badge badge-danger">Canceled</span>';
                            }
                        }else{
                            if($row->status == 0){
                                $status = '<span class="badge badge-danger">Open</span>';
                            }else if($row->status == 1){
                                $status = '<span class="badge badge-danger">Closed</span>';
                            }
                        }


                    return $status;
                })->addColumn('flight_cargo_type_id', function ($row) {
                    return ucfirst(optional($row->flightCargoType)->name);
                })->addColumn('aircraft_vessel_id', function ($row) {
                    return ucfirst(optional($row->aircraft)->name);
                })->addColumn('flight_type_id', function ($row) {
                    return ucfirst(optional($row->flightType)->name);
                })->addColumn('flight_number', function ($row) {
                    return $row->flight_number ?? 'N/A';
                })->addColumn('created_by', function ($row) {
                    return optional($row->user)->full_name;
                })->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data['allstate'] = FlightCargo::allState();
        $data['todayAllstate'] = FlightCargo::todayAllState();

        $data['allStateByAir'] = FlightCargo::paiChartAllData(1);
        $data['todayStateByAir'] = FlightCargo::paiCHartTodayData(1);

        $data['allStateBySea'] = FlightCargo::paiChartAllData(2);
        $data['todayStateBySea'] = FlightCargo::paiCHartTodayData(2);

        $data['allStateByRoad'] = FlightCargo::paiChartAllData(3);
        $data['todayStateByRoad'] = FlightCargo::paiCHartTodayData(3);

        if ($request->module_name == 'record_by_flight') {
            $this->authorize('View By Flight');
            $data['moduleName'] = 'record_by_flight';
            return view('admin.flight_and_cargo.flight_and_cargo.index_by_flight', $data);
        } elseif ($request->module_name == 'record_by_sea') {
            $this->authorize('View By Sea');
            $data['moduleName'] = 'record_by_sea';
            return view('admin.flight_and_cargo.flight_and_cargo.index_by_sea', $data);
        } elseif ($request->module_name == 'record_by_road') {
            $this->authorize('View By Road');
            $data['moduleName'] = 'record_by_road';
            return view('admin.flight_and_cargo.flight_and_cargo.index_by_road', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module)
    {
        $this->authorize('Add Flight and Cargo');
        $data['flightCargoType'] = FlightCargoType::whereStatus(1)->get();
        $data['flightTypes'] = FlightType::whereStatus(1)->get();
        $data['aircrafts'] = AircraftVessel::whereStatus(1)->get();
        if ($module == 'record_by_flight') {
            $module = 1;
        } elseif ($module == 'record_by_sea') {
            $module = 2;
        } elseif ($module == 'record_by_road') {
            $module = 3;
        }
        $data['module'] = $module;
        return view('admin.flight_and_cargo.flight_and_cargo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlightCargoStoreRequest $request)
    {
        $this->authorize('Add Flight and Cargo');
        if ($request->flight_cargo_type_id == 1) {

            $byFlight = $this->_storeByFlightData($request);

            if ($request->has('arrival_vehicle_attachment')) {
                $this->_storeAttachments($request->arrival_vehicle_attachment, $byFlight, 'record_by_flight', 'arrival_vehicle_attachment');
            }
            if ($request->has('arrival_flight_cargo_attachment')) {
                $this->_storeAttachments($request->arrival_flight_cargo_attachment, $byFlight, 'record_by_flight', 'arrival_flight_cargo_attachment');
            }
            if ($request->has('arrival_faicon_attachment')) {
                $this->_storeAttachments($request->arrival_faicon_attachment, $byFlight, 'record_by_flight', 'arrival_faicon_attachment');
            }
            if ($request->has('arrival_flight_vehicle_attachment')) {
                $this->_storeAttachments($request->arrival_flight_vehicle_attachment, $byFlight, 'record_by_flight', 'arrival_flight_vehicle_attachment');
            }

            return redirect()->route('flight-and-cargos.index', ['module_name' => 'record_by_flight'])->with('success', 'Data stored successfully.');
        } elseif ($request->flight_cargo_type_id == 2) {
            $bySea = $this->_storeBySeaData($request);

            if ($request->has('sea_vehicle_attachment')) {
                $this->_storeAttachments($request->sea_vehicle_attachment, $bySea, 'record_by_sea', 'sea_vehicle_attachment');
            }
            if ($request->has('sea_cargo_attachment')) {
                $this->_storeAttachments($request->sea_cargo_attachment, $bySea, 'record_by_sea', 'sea_cargo_attachment');
            }
            if ($request->has('sea_cargo_other_attachment')) {
                $this->_storeAttachments($request->sea_cargo_other_attachment, $bySea, 'record_by_sea', 'sea_cargo_other_attachment');
            }
            if ($request->has('sea_cargo_photos')) {
                $this->_storeAttachments($request->sea_cargo_photos, $bySea, 'record_by_sea', 'sea_cargo_photos');
            }

            return redirect()->route('flight-and-cargos.index', ['module_name' => 'record_by_sea'])->with('success', 'Data stored successfully.');
        } elseif ($request->flight_cargo_type_id == 3) {

            $byRoad = $this->_storeByRoadData($request);
            if ($request->has('road_cargo_list_attachments')) {
                $this->_storeAttachments($request->road_cargo_list_attachments, $byRoad, 'record_by_road', 'road_cargo_list_attachments');
            }
            if ($request->has('by_road_cargo_photos')) {
                $this->_storeAttachments($request->by_road_cargo_photos, $byRoad, 'record_by_road', 'by_road_cargo_photos');
            }
            return redirect()->route('flight-and-cargos.index', ['module_name' => 'record_by_road'])->with('success', 'Data stored successfully.');
        }

        return redirect()->route('flight-and-cargos.index')->with('error', 'Something went wrong.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View Flight and Cargo');
        $data['flightCargo'] = FlightCargo::findOrFail($id);

        return view('admin.flight_and_cargo/flight_and_cargo/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit Flight and Cargo');
        $data['flightCargoType'] = FlightCargoType::whereStatus(1)->get();
        $data['flightTypes'] = FlightType::whereStatus(1)->get();
        $data['aircrafts'] = AircraftVessel::whereStatus(1)->get();
        $data['flightCargo'] = FlightCargo::findOrFail($id);

        return view('admin.flight_and_cargo/flight_and_cargo/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FlightCargoUpdateRequest $request, $id)
    {
        $this->authorize('Edit Flight and Cargo');
        if ($request->air_type == 1) {
            $byFlight = $this->_updateByFlightData($request, $id);
            if ($request->has('arrival_vehicle_attachment')) {
                $this->_storeAttachments($request->arrival_vehicle_attachment, $byFlight, 'record_by_flight', 'arrival_vehicle_attachment');
            }
            if ($request->has('arrival_flight_cargo_attachment')) {
                $this->_storeAttachments($request->arrival_flight_cargo_attachment, $byFlight, 'record_by_flight', 'arrival_flight_cargo_attachment');
            }
            if ($request->has('arrival_faicon_attachment')) {
                $this->_storeAttachments($request->arrival_faicon_attachment, $byFlight, 'record_by_flight', 'arrival_faicon_attachment');
            }
            if ($request->has('arrival_flight_vehicle_attachment')) {
                $this->_storeAttachments($request->arrival_flight_vehicle_attachment, $byFlight, 'record_by_flight', 'arrival_flight_vehicle_attachment');
            }
            return redirect()->route('flight-and-cargos.index', ['module_name' => 'record_by_flight'])->with('success', 'Data stored successfully.');
        } elseif ($request->sea_type == 2) {
            $bySea = $this->_updateBySeaData($request, $id);
            if ($request->has('sea_vehicle_attachment')) {
                $this->_storeAttachments($request->sea_vehicle_attachment, $bySea, 'record_by_sea', 'sea_vehicle_attachment');
            }
            if ($request->has('sea_cargo_attachment')) {
                $this->_storeAttachments($request->sea_cargo_attachment, $bySea, 'record_by_sea', 'sea_cargo_attachment');
            }
            if ($request->has('sea_cargo_other_attachment')) {
                $this->_storeAttachments($request->sea_cargo_other_attachment, $bySea, 'record_by_sea', 'sea_cargo_other_attachment');
            }
            if ($request->has('sea_cargo_photos')) {
                $this->_storeAttachments($request->sea_cargo_photos, $bySea, 'record_by_sea', 'sea_cargo_photos');
            }
            return redirect()->route('flight-and-cargos.index', ['module_name' => 'record_by_sea'])->with('success', 'Data stored successfully.');
        } elseif ($request->road_type == 3) {
            $byRoad = $this->_updateByRoadData($request, $id);
            if ($request->has('road_cargo_list_attachments')) {
                $this->_storeAttachments($request->road_cargo_list_attachments, $byRoad, 'record_by_road', 'road_cargo_list_attachments');
            }
            if ($request->has('by_road_cargo_photos')) {
                $this->_storeAttachments($request->by_road_cargo_photos, $byRoad, 'record_by_road', 'by_road_cargo_photos');
            }
            return redirect()->route('flight-and-cargos.index', ['module_name' => 'record_by_road'])->with('success', 'Data stored successfully.');
        }

        return redirect()->route('flight-and-cargos.index')->with('error', 'Something went wrong.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Flight and Cargo');
        FlightCargo::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data deleted successfully.');
    }

    public function flightCanceled(Request $request)
    {
        $this->authorize('Mark Canclled Flight and Cargo');
        $flightCargo = FlightCargo::findOrFail($request->id);
        $flightCargo->status = 2;
        $flightCargo->cencelled_comment = $request->comment;
        $flightCargo->cencelled_date = Carbon::now();
        $flightCargo->update();

        return response()->json([
            'status' => true,
            'message' => 'Flight Cancelled successfully.'
        ], 200);
    }

    public function flightComplete(Request $request)
    {
        $this->authorize('Mark Close Flight and Cargo');
        $flightCargo = FlightCargo::findOrFail($request->id);
        $flightCargo->status = 1;
        $flightCargo->cencelled_comment = $request->comment;
        $flightCargo->cencelled_date = Carbon::now();
        $flightCargo->update();

        return response()->json([
            'status' => true,
            'message' => 'Flight Cancelled successfully.'
        ], 200);
    }

    public function flightclosed($id, $type)
    {
        $this->authorize('Mark Close Flight and Cargo');
        $data['id'] = $id;
        $data['type'] = $type;
        return view('admin.flight_and_cargo.flight_and_cargo.close_flight', $data);
    }

    public function flightclosedStore(Request $request)
    {

        $request->validate([
            'departure_flight_origin' => ['required'],
            'departure_flight_date_time' => ['required'],
            'departure_flight_destination' => ['required'],
            'departure_flight_destination_date_time' => ['required'],

            'departure_number_of_passengers' => ['required_if:departure_is_flight_passengers,on'],
            'departure_attachment' => ['required_if:departure_is_flight_passengers,on'],
            'departure_weight_of_flight_cargo' => ['required_if:departure_is_flight_cargo,on'],
            'departure_cargo_attachment' => ['required_if:departure_is_flight_cargo,on'],

            'departure_number_of_faicons' => ['required_if:departure_is_flight_faicons,on'],
            'departure_faicon_attachment' => ['required_if:departure_is_flight_faicons,on'],

            'departure_number_of_flight_vehicle' => ['required_if:departure_is_flight_vehicles,on'],
            'departure_flight_vehicle_attachment' => ['required_if:departure_is_flight_vehicles,on'],
        ], [
            'departure_flight_origin.required' => 'Origin field is required.',
            'departure_flight_date_time.required' => 'Date Time field is required.',
            'departure_flight_destination.required' => 'Destination field is required.',
            'departure_flight_destination_date_time.required' => 'Date Time field is required.',

            'departure_number_of_passengers.required_if' => 'Number Of Passengers field is required.',
            'departure_attachment.required_if' => 'Attachments Of Passengers field is required.',
            'departure_weight_of_flight_cargo.required_if' => 'Wheight of Cargo field is required.',
            'departure_cargo_attachment.required_if' => 'Attachments of Cargo field is required.',
            'departure_number_of_faicons.required_if' => 'Falcon field is required.',
            'departure_faicon_attachment.required_if' => 'Falcon Attachments field is required.',
            'departure_number_of_flight_vehicle.required_if' => 'Number Of Vehicles field is required.',
            'departure_flight_vehicle_attachment.required_if' => 'Vehicles Attachments field is required.',
        ]);

        $id = Crypt::decrypt($request->id);
        $flightCargo = FlightCargo::findOrFail($id);

        $flightCargo->departure_flight_origin = $request->departure_flight_origin;
        $flightCargo->departure_flight_date_time = $request->departure_flight_date_time;
        $flightCargo->departure_flight_destination = $request->departure_flight_destination;
        $flightCargo->departure_flight_destination_date_time = $request->departure_flight_destination_date_time;
        $flightCargo->departure_is_flight_passengers = $request->departure_is_flight_passengersc == 'on' ? 1 : 0;
        $flightCargo->departure_number_of_passengers = $request->departure_number_of_passengers;
        $flightCargo->departure_is_flight_cargo = $request->departure_is_flight_cargo == 'on' ? 1 : 0;
        $flightCargo->departure_weight_of_flight_cargo = $request->departure_weight_of_flight_cargo;
        $flightCargo->departure_is_flight_faicons = $request->departure_is_flight_faicons == 'on' ? 1 : 0;
        $flightCargo->departure_number_of_faicons = $request->departure_number_of_faicons;
        $flightCargo->departure_is_flight_vehicles = $request->departure_is_flight_vehicles == 'on' ? 1 : 0;
        $flightCargo->departure_number_of_flight_vehicle = $request->departure_number_of_flight_vehicle;
        $flightCargo->departure_flight_notes = $request->departure_flight_notes;
        $flightCargo->status = 1; //Closed
        $flightCargo->update();


        if ($request->has('departure_attachment')) {
            $this->_storeAttachments($request->departure_attachment, $flightCargo, 'departure_flight_image', 'departure_attachment');
        }
        if ($request->has('departure_cargo_attachment')) {
            $this->_storeAttachments($request->departure_cargo_attachment, $flightCargo, 'departure_flight_image', 'departure_cargo_attachment');
        }
        if ($request->has('departure_faicon_attachment')) {
            $this->_storeAttachments($request->departure_faicon_attachment, $flightCargo, 'departure_flight_image', 'departure_faicon_attachment');
        }
        if ($request->has('departure_flight_vehicle_attachment')) {
            $this->_storeAttachments($request->departure_flight_vehicle_attachment, $flightCargo, 'departure_flight_image', 'departure_flight_vehicle_attachment');
        }
        if ($request->has('departure_flight_photos')) {
            $this->_storeAttachments($request->departure_flight_photos, $flightCargo, 'departure_flight_image', 'departure_flight_photos');
        }

        return redirect()->route('flight-and-cargos.index', ['module_name' => 'record_by_flight'])->with('success', 'Flight Closed Successfully.');
    }

    private function _storeByFlightData(Request $request)
    {
        return FlightCargo::Create([
            'flight_number' => $request->flight_number,
            'flight_type_id' => $request->flight_type_id,
            'flight_cargo_type_id' => $request->flight_cargo_type_id,
            'aircraft_vessel_id' => $request->aircraft_vessel_id,
            'flight_belongs_to' => $request->flight_belongs_to,
            'flight_notes' => $request->flight_notes,
            'arrival_flight_origin' => $request->arrival_flight_origin,
            'arrival_flight_date_time' => $request->arrival_flight_date_time,
            'arrival_flight_destination' => $request->arrival_flight_destination,
            'arrival_flight_destination_date_time' => $request->arrival_flight_destination_date_time,
            'arrival_is_flight_passengers' => $request->arrival_is_flight_passengers == 'on' ? 1 : 0,
            'arrival_number_of_passengers' => $request->arrival_number_of_passengers,
            'arrival_is_flight_cargo' => $request->arrival_is_flight_cargo == 'on' ? 1 : 0,
            'arrival_weight_of_flight_cargo' => $request->arrival_weight_of_flight_cargo,
            'arrival_is_flight_faicons' => $request->arrival_is_flight_faicons == 'on' ? 1 : 0,
            'arrival_number_of_faicons' => $request->arrival_number_of_faicons,
            'arrival_is_flight_vehicles' => $request->arrival_is_flight_vehicles == 'on' ? 1 : 0,
            'arrival_number_of_flight_vehicle' => $request->arrival_number_of_flight_vehicle,
            'arrival_flight_notes' => $request->arrival_flight_notes,
            'user_id' => Auth::id(),
        ]);
    }

    private function _storeBySeaData(Request $request)
    {

        return FlightCargo::Create([
            'flight_cargo_type_id' => $request->flight_cargo_type_id,
            'flight_type_id' => $request->flight_type_id,
            'sea_vessel_number' => $request->sea_vessel_number,
            'sea_vessel_type' => $request->sea_vessel_type,
            'sea_notes' => $request->sea_notes,
            'sea_arrival_origin' => $request->sea_arrival_origin,
            'sea_arrival_date_time' => $request->sea_arrival_date_time,
            'sea_destination' => $request->sea_destination,
            'sea_destination_date_time' => $request->sea_destination_date_time,
            'cargo_belongs_to' => $request->cargo_belongs_to,
            'cargo_notes' => $request->cargo_notes,
            'is_sea_cargo_vehicles' => $request->is_sea_cargo_vehicles == 'on' ? 1 : 0,
            'number_of_vehicle' => $request->number_of_vehicle,
            'is_sea_cargo' => $request->is_sea_cargo == 'on' ? 1 : 0,
            'weight_of_cargo' => $request->weight_of_cargo,
            'is_sea_cargo_other' => $request->is_sea_cargo_other == 'on' ? 1 : 0,
            'sea_cargo_other_details' => $request->sea_cargo_other_details,
            'user_id' => Auth::id(),
        ]);
    }

    private function _storeByRoadData(Request $request)
    {
        return FlightCargo::Create([
            'flight_cargo_type_id' => $request->flight_cargo_type_id,
            'road_arrival_origin' => $request->road_arrival_origin,
            'road_arrival_date_time' => $request->road_arrival_date_time,
            'road_destination' => $request->road_destination,
            'road_destination_date_time' => $request->road_destination_date_time,
            'road_cargo_belongs_to' => $request->road_cargo_belongs_to,
            'road_notes' => $request->road_notes,
            'road_type_of_cargo' => $request->road_type_of_cargo,
            'road_list_of_cargo' => $request->road_list_of_cargo,
            'road_driver_name' => $request->road_driver_name,
            'road_driver_number' => $request->road_driver_number,
            'road_vehicle_number_type' => $request->road_vehicle_number_type,
            'user_id' => Auth::id(),
        ]);
    }

    private function _updateByFlightData(Request $request, $id)
    {

        $flightCargoByFlight = FlightCargo::findOrFail($id);
        $flightCargoByFlight->update([
            'flight_number' => $request->flight_number,
            'flight_type_id' => $request->flight_type_id,

            'aircraft_vessel_id' => $request->aircraft_vessel_id,
            'flight_belongs_to' => $request->flight_belongs_to,
            'flight_notes' => $request->flight_notes,

            'arrival_flight_origin' => $request->arrival_flight_origin,
            'arrival_flight_date_time' => $request->arrival_flight_date_time,
            'arrival_flight_destination' => $request->arrival_flight_destination,
            'arrival_flight_destination_date_time' => $request->arrival_flight_destination_date_time,
            'arrival_is_flight_passengers' => $request->arrival_is_flight_passengers == 'on' ? 1 : 0,
            'arrival_number_of_passengers' => $request->arrival_number_of_passengers,
            'arrival_is_flight_cargo' => $request->arrival_is_flight_cargo == 'on' ? 1 : 0,
            'arrival_weight_of_flight_cargo' => $request->arrival_weight_of_flight_cargo,
            'arrival_is_flight_faicons' => $request->arrival_is_flight_faicons == 'on' ? 1 : 0,
            'arrival_number_of_faicons' => $request->arrival_number_of_faicons,
            'arrival_is_flight_vehicles' => $request->arrival_is_flight_vehicles == 'on' ? 1 : 0,
            'arrival_number_of_flight_vehicle' => $request->arrival_number_of_flight_vehicle,
            'arrival_flight_notes' => $request->arrival_flight_notes,
        ]);

        return $flightCargoByFlight;
    }

    private function _updateBySeaData(Request $request, $id)
    {

        $bySeaData = FlightCargo::findOrFail($id);
        $bySeaData->update([

            'flight_type_id' => $request->flight_type_id,
            'sea_vessel_number' => $request->sea_vessel_number,
            'sea_vessel_type' => $request->sea_vessel_type,
            'sea_notes' => $request->sea_notes,
            'sea_arrival_origin' => $request->sea_arrival_origin,
            'sea_arrival_date_time' => $request->sea_arrival_date_time,
            'sea_destination' => $request->sea_destination,
            'sea_destination_date_time' => $request->sea_destination_date_time,
            'cargo_belongs_to' => $request->cargo_belongs_to,
            'cargo_notes' => $request->cargo_notes,
            'is_sea_cargo_vehicles' => $request->is_sea_cargo_vehicles == 'on' ? 1 : 0,
            'number_of_vehicle' => $request->number_of_vehicle,
            'is_sea_cargo' => $request->is_sea_cargo == 'on' ? 1 : 0,
            'weight_of_cargo' => $request->weight_of_cargo,
            'is_sea_cargo_other' => $request->is_sea_cargo_other == 'on' ? 1 : 0,
            'sea_cargo_other_details' => $request->sea_cargo_other_details,
        ]);

        return $bySeaData;
    }

    private function _updateByRoadData(Request $request, $id)
    {

        $byRoadData = FlightCargo::findOrFail($id);
        $byRoadData->update([
            'road_arrival_origin' => $request->road_arrival_origin,
            'road_arrival_date_time' => $request->road_arrival_date_time,
            'road_destination' => $request->road_destination,
            'road_destination_date_time' => $request->road_destination_date_time,
            'road_cargo_belongs_to' => $request->road_cargo_belongs_to,
            'road_notes' => $request->road_notes,
            'road_type_of_cargo' => $request->road_type_of_cargo,
            'road_list_of_cargo' => $request->road_list_of_cargo,
            'road_driver_name' => $request->road_driver_name,
            'road_driver_number' => $request->road_driver_number,
            'road_vehicle_number_type' => $request->road_vehicle_number_type,
        ]);

        return $byRoadData;
    }

    private function _storeAttachments($attchments, $model, $moduleType, $attachmentType)
    {
        foreach ($attchments as $attchment) {
            $extension = $attchment->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $attchment->move(public_path('letter_received'), $fileName);
            $url = asset('/letter_received/' . $fileName);

            FlightCargoImage::create([
                'file_name' => $fileName,
                'orignal_file_name' => $attchment->getClientOriginalName(),
                'file_type' => $extension,
                'file_url' => $url,
                'module_type' => $moduleType,
                'module_type_id' => $model->id,
                'attachment_type_name' => $attachmentType
            ]);
        }
    }
}
