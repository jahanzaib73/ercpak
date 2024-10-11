@extends('layouts.app')
@section('flight_and_cargo-active-class', 'active')
@section('content')
<div class="container-fluid">
    <div class="page-head">
        <h4 class="mt-2 mb-2">Flight & Cargo</h4>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12 col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div id="by_air_container" class="@if ($flightCargo->flight_cargo_type_id != '1') d-none @endif">
                        <div class="row mb-3 ">
                            <div class="col-12 col-md-8">
                                <div class="col-4">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Flight Details
                                </h5>
                                </div>
                                <div class="col-8">

                                </div>
                                
                            </div>
                            <div class="col-12 col-md-4 d-flex justify-content-end">
                                <div class="mb-3 mr-0 text-right">{!! DNS1D::getBarcodeHTML("$flightCargo->flightCargo", 'C39') !!}</div>
                                <h2 class="header-title  text-right" style="font-weight: bold; font-size: 17px;">

                                    <!-- {{ $flightCargo->id }} -->
                                </h2>
                            </div>
                        </div>
                        <hr>

                        <!-- FLIGHT DETAILS ======================= -->

                        <section class="container-fd">
                            <div class="row">

                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class=" d-flex align-items-center font-weight-bold text-white bg-danger">
                                            <div>
                                                <h4 class="mb-0 py-1"><span class="mdi mdi-airplane "></span></h4>

                                            </div>
                                            <div>
                                                <h5 class="mb-0">Flight Number</h5>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold text-center" style="border: 1px solid #AF8B45;">
                                            <div>
                                                <h5 class="mb-0 py-1">{{ $flightCargo->flight_number }}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="d-flex align-items-center font-weight-bold text-white bg-danger">
                                            <div>
                                                <h4 class="mb-0 py-1"><span class="mdi mdi-airplane "></span></h4>

                                            </div>
                                            <div>
                                                <h5 class="mb-0">Flight Type</h5>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold text-center" style="border: 1px solid #AF8B45;">
                                            <div>
                                                <h5 class="mb-0 py-1">{{ optional($flightCargo->flightType)->name }}</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center font-weight-bold text-white bg-danger">
                                            <div>
                                                <h4 class="mb-0 py-1"><span class="mdi mdi-airplane "></span></h4>

                                            </div>
                                            <div>
                                                <h5 class="mb-0">Aircraft</h5>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold text-center" style="border: 1px solid #AF8B45;">
                                            <div>
                                                <h5 class="mb-0 py-1">{{ optional($flightCargo->flightType)->name }}</h5>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="d-flex align-items-center font-weight-bold text-white bg-danger">
                                            <div>
                                                <h4 class="mb-0 py-1"><span class="mdi mdi-airplane "></span></h4>

                                            </div>
                                            <div>
                                                <h5 class="mb-0">Flight Belongs To</h5>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold text-center" style="border: 1px solid #AF8B45;">
                                            <div>
                                                <h5 class="mb-0 py-1">{{ $flightCargo->flight_belongs_to }}</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center font-weight-bold text-white bg-danger">
                                            <div>
                                                <h4 class="mb-0 py-1"><span class="mdi mdi-airplane "></span></h4>

                                            </div>
                                            <div>
                                                <h5 class="mb-0">Flight Record #</h5>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold text-center" style="border: 1px solid #AF8B45;">
                                            <div>
                                                <h5 class="mb-0 py-1">{{ $flightCargo->id }}</h5>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="d-flex align-items-center font-weight-bold text-white bg-danger">
                                            <div>
                                                <h4 class="mb-0 py-1"><span class="mdi mdi-airplane "></span></h4>

                                            </div>
                                            <div>
                                                <h5 class="mb-0">Date</h5>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold text-center" style="border: 1px solid #AF8B45;">
                                            <div>
                                                <h5 class="mb-0 py-1">{{ $flightCargo->arrival_flight_date_time }}</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </section>
                        <hr>
                        <!-- PHOTOS OF FLIGHT =========================      -->
                        <br>
                        <section class="container-pic">
                            <div>
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Photos of Cargo</h5>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 d-flex">

                                    @forelse (getFlightCargoAttchments('departure_flight_image', $flightCargo->id, 'departure_flight_photos') as $attchment)
                                    @if (
                                    $attchment->file_type == 'png' ||
                                    $attchment->file_type == 'jpg' ||
                                    $attchment->file_type == 'jpeg' ||
                                    $attchment->file_type == 'gif')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}">
                                            <img src="{{ $attchment->file_url }}" width="100%" height="100%" alt="{{ $attchment->orignal_file_name }}">
                                        </a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'pdf')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'xls')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @endif
                                    @empty
                                    <div class="col">
                                        <p style="font-weight: bolder">N/A</p>
                                    </div>
                                    @endforelse
                                </div>

                            </div>
                        </section>

                        <hr>

                        <!-- FLIGHT ARRIVING DETAILS========================= -->

                        <section class="container-io">
                            <div class="row mb-3 ">
                                <div class="col-md-6">
                                    <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Arrival</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 15px;"><span class="mdi mdi-airplane-takeoff"></span>
                                                <p class="pl-2 mb-0">Origin</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 15px; ">{{ $flightCargo->arrival_flight_origin }}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-calendar-range"></span>
                                                <p class="pl-2 mb-0">Date Time</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 15px; ">{{ $flightCargo->arrival_flight_date_time }}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-airplane-landing"></span>
                                                <p class="pl-2 mb-0">Destination</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 15px; ">{{ $flightCargo->arrival_flight_destination }}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-calendar-range"></span>
                                                <p class="pl-2 mb-0">Date Time</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 15px; ">{{ $flightCargo->arrival_flight_destination_date_time }}</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- ARRIVING PASSENGER & CARGO DETAILS========================= -->

                        <section class="container-arr">
                            <div class="row mb-3 ">
                                <div class="col-md-6">
                                    <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Arriving Passenger & Cargo Details</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-airplane-takeoff"></span>
                                                <p class="pl-2 mb-0">Passengers</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->arrival_is_flight_passengers == '1' ? 'Yes' : 'No' }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label class="pt-2 pl-2" style="font-weight: bold; font-size: 15px;">Number of
                                                    Passengers</label>
                                            </div>
                                            <div class="col-5 mr-0 py-2 pl-2 text-right">
                                                <h5>{{ $flightCargo->arrival_number_of_passengers ?: '0' }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3">
                                            @forelse (getFlightCargoAttchments('record_by_flight', $flightCargo->id, 'arrival_vehicle_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <img src="{{ $attchment->file_url }}" width="100" height="100" style="border-radius: 50%;" alt="{{ $attchment->orignal_file_name }}">
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-bag-checked"></span>
                                                <p class="pl-2 mb-0">Cargo</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->arrival_is_flight_cargo == '1' ? 'Yes' : 'No' }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label class="pt-2 pl-2 style=" font-weight: bold; font-size: 15px;">Weight of Cargo</label>
                                            </div>
                                            <div class="col-5 mr-0 text-right">
                                                <h5>{{ $flightCargo->arrival_weight_of_flight_cargo ?: '0' }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3 pt-2 pl-2">
                                            @forelse (getFlightCargoAttchments('record_by_flight', $flightCargo->id, 'arrival_flight_cargo_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-bird"></span>
                                                <p class="pl-2 mb-0">Falcon</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->arrival_is_flight_faicons == '1' ? 'Yes' : 'No' }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label style="font-weight: bold; font-size: 15px;">Number of Falcon</label>
                                            </div>
                                            <div class="col-5 mr-0 text-right">
                                                <h5>{{ $flightCargo->arrival_number_of_faicons ?: 0 }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3">
                                            @forelse (getFlightCargoAttchments('record_by_flight', $flightCargo->id, 'arrival_faicon_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-bird"></span>
                                                <p class="pl-2 mb-0">Vehicles</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->arrival_is_flight_vehicles == '1' ? 'Yes' : 'No' }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label style="font-weight: bold; font-size: 15px;">Number of Vehicles</label>
                                            </div>
                                            <div class="col-5 mr-0 text-right">
                                                <h5>{{ $flightCargo->arrival_number_of_flight_vehicle ?: 0 }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3">
                                            @forelse (getFlightCargoAttchments('record_by_flight', $flightCargo->id, 'arrival_flight_vehicle_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <img src="{{ $attchment->file_url }}" width="100%" height="100%" alt="{{ $attchment->orignal_file_name }}">
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <hr>


                        <hr>

                        <!-- DEPARTURE DETAILS ============================== -->

                        <section class="container-z">
                            @if ($flightCargo->status == 1)
                            <div class="row mb-3 ">
                                <div class="col-md-6">
                                    <h5 class="header-title " style="font-weight: bold; font-size: 17px;">
                                        Departure
                                    </h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-airplane-takeoff"></span>
                                                <p class="pl-2 mb-0">Origin</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->departure_flight_origin }}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-calendar-range"></span>
                                                <p class="pl-2 mb-0">Date Time</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->departure_flight_date_time }}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-airplane-landing"></span>
                                                <p class="pl-2 mb-0">Destination</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->departure_flight_destination }}</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <di bg-dangerv>
                                            <label class="d-flex text-white text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-calendar-range"></span>
                                                <p class="pl-2 mb-0">Date Time</p>
                                            </label>
                                        </di>
                                        <div style="border: 1px solid; border-color: #AF8B45; text-align:center;">
                                            <label class="text-center mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->departure_flight_destination_date_time }}</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- DEPARTURE PASSENGER & CARGO DETAILS========================= -->

                        <section class="container-arr">
                            <div class="row mb-3 ">
                                <div class="col-md-6">
                                    <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Departure Passenger & Cargo Details</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-airplane-takeoff"></span>
                                                <p class="pl-2 mb-0">Passengers</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->departure_is_flight_passengers == '1' ? 'Yes' : 'No' }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label class="pt-2 pl-2" style="font-weight: bold; font-size: 15px;">Number of
                                                    Passengers</label>
                                            </div>
                                            <div class="col-5 mr-0 py-2 pl-2 text-right">
                                                <h5>{{ $flightCargo->departure_number_of_passengers ?: 0 }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3">
                                            @forelse (getFlightCargoAttchments('departure_flight_image', $flightCargo->id, 'departure_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <div>
                                                        <img src="{{ $attchment->file_url }}" width="100" height="100" style="border-radius: 50%;" alt="{{ $attchment->orignal_file_name }}">
                                                    </div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-bag-checked"></span>
                                                <p class="pl-2 mb-0">Cargo</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->arrival_is_flight_cargo == '1' ? 'Yes' : 'No' }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label class="pt-2 pl-2 style=" font-weight: bold; font-size: 15px;">Weight of Cargo</label>
                                            </div>
                                            <div class="col-5 mr-0 text-right">
                                                <h5>{{ $flightCargo->departure_weight_of_flight_cargo ?: 0 }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3 pt-2 pl-2">
                                            @forelse (getFlightCargoAttchments('departure_flight_image', $flightCargo->id, 'departure_cargo_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-bird"></span>
                                                <p class="pl-2 mb-0">Falcon</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->departure_is_flight_faicons }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label style="font-weight: bold; font-size: 15px;">Number of Falcon</label>
                                            </div>
                                            <div class="col-5 mr-0 text-right">
                                                <h5>{{ $flightCargo->departure_number_of_faicons ?: 0 }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3">
                                            @forelse (getFlightCargoAttchments('departure_flight_image', $flightCargo->id, 'departure_faicon_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between bg-danger">
                                            <label class="d-flex text-white mb-0 py-2 pl-2" style="font-weight: bold; font-size: 17px;"><span class="mdi mdi-bird"></span>
                                                <p class="pl-2 mb-0">Vehicles</p>
                                            </label>
                                            <label class=" mb-0 py-2 pr-2 text-white" style="font-weight: bold; font-size: 17px; ">{{ $flightCargo->departure_is_flight_vehicles }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col d-flex mb-0 pb-0" style="border:solid 1px #AF8B45;">
                                            <div class="col-7">
                                                <label style="font-weight: bold; font-size: 15px;">Number of Vehicles</label>
                                            </div>
                                            <div class="col-5 mr-0 text-right">
                                                <h5>{{ $flightCargo->departure_number_of_flight_vehicle ?: 0 }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row  mb-3">
                                            @forelse (getFlightCargoAttchments('departure_flight_image', $flightCargo->id, 'departure_flight_vehicle_attachment') as $attchment)
                                            @if (
                                            $attchment->file_type == 'png' ||
                                            $attchment->file_type == 'jpg' ||
                                            $attchment->file_type == 'jpeg' ||
                                            $attchment->file_type == 'gif')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}">
                                                    <img src="{{ $attchment->file_url }}" width="100%" height="100" alt="{{ $attchment->orignal_file_name }}">
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'pdf')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-pdf-box"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @elseif($attchment->file_type == 'xls')
                                            <div class="col">
                                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px">
                                                    <div class="text-danger"><i class="mdi mdi-file-excel"></i></div>
                                                </a>
                                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col">
                                                <p style="font-weight: bolder">N/A</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="container-z">
                            <div class="form-group">
                                <label style="font-weight: bold; font-size: 17px;">Notes</label>
                                <div class="border solid ">
                                    <p>{{ $flightCargo->departure_flight_notes }}</p>
                                </div>

                            </div>
                        </section>
                        <hr>
                        @endif

                    </div>

                    <!-- ================BY SEA SHIP================== -->

                    <div id="by_sea_container" class="@if ($flightCargo->flight_cargo_type_id != '2') d-none @endif">

                        <div class="row  bg-danger mb-3 pt-0 mt-0">
                            <div class="col-md-6">
                                <h5 class="header-title py-3 text-white" style="font-weight: bold; font-size: 17px;">By Sea</h5>
                            </div>
                            <div class="col-md-6">
                                <h5 class="header-title py-3 text-right text-white" style="font-weight: bold; font-size: 17px;">
                                    Case#
                                    {{ $flightCargo->id }}
                                </h5>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Ship Details
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Vessel Number</label>
                                    </div>

                                    <h5 class="text-center pt-1">{{ $flightCargo->sea_vessel_number }}</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Vessel Type</label>
                                    </div>
                                    <h5 class="text-center pt-1">{{ $flightCargo->sea_vessel_type }}</h5>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="bg-danger d-flex justify-content-center">
                                    <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Notes</label>
                                </div>
                                <h6>{{ $flightCargo->sea_notes }}</h6>
                            </div>
                        </div>


                        <hr>
                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Arrival</h5>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Origin</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->sea_arrival_origin }}</h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Date Time</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->sea_arrival_date_time }}</h6>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Destination</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->sea_destination }}</h6>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Date Time</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->sea_destination_date_time }}</h6>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-6">
                            <div class="bg-danger d-flex justify-content-center">
                                <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Cargo Belongs To</label>
                            </div>
                            <h6>{{ $flightCargo->cargo_belongs_to }}</h6>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="bg-danger d-flex justify-content-center">
                                <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Notes</label>
                            </div>
                            <h6>{{ $flightCargo->cargo_notes }}</h6>
                        </div>

                        <hr>

                        <div class="row mb-3 mt-3">
                            <div class="col-md-6">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Arriving
                                    Cargo Details</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-4">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-around">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Vehicles</label>
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">No. of Vehicles</label>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <h6 class="text-center pt-1">{{ $flightCargo->is_sea_cargo_vehicles == 1 ? 'Yes' : 'No' }}</h6>
                                        <h6 class="text-center pt-1">{{ $flightCargo->number_of_vehicle ?: 0 }} </h5>
                                    </div>

                                </div>

                                <div class="row text-center mb-3">
                                    @forelse (getFlightCargoAttchments('record_by_sea', $flightCargo->id, 'sea_vehicle_attachment') as $attchment)
                                    @if (
                                    $attchment->file_type == 'png' ||
                                    $attchment->file_type == 'jpg' ||
                                    $attchment->file_type == 'jpeg' ||
                                    $attchment->file_type == 'gif')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}">
                                            <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                        </a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'pdf')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'xls')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @endif
                                    @empty
                                    <div class="col">
                                        <p style="font-weight: bolder">N/A</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-12 col-md-4">

                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-around">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Cargo</label>
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Weight of Cargo</label>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <h6 class="text-center pt-1">{{ $flightCargo->is_sea_cargo == 1 ? 'Yes' : 'No' }}</h6>
                                        <h6 class="text-center pt-1">{{ $flightCargo->weight_of_cargo ?: 0 }} </h5>
                                    </div>

                                </div>


                                <div class="row text-center mb-3">
                                    @forelse (getFlightCargoAttchments('record_by_sea', $flightCargo->id, 'sea_cargo_attachment') as $attchment)
                                    @if (
                                    $attchment->file_type == 'png' ||
                                    $attchment->file_type == 'jpg' ||
                                    $attchment->file_type == 'jpeg' ||
                                    $attchment->file_type == 'gif')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}">
                                            <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                        </a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'pdf')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'xls')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @endif
                                    @empty
                                    <div class="col">
                                        <p style="font-weight: bolder">N/A</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-around">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Other</label>
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Details</label>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        <h6 class="text-center pt-1">{{ $flightCargo->is_sea_cargo_other == 1 ? 'Yes' : 'No' }}</h6>
                                        <h6 class="text-center pt-1">{{ $flightCargo->sea_cargo_other_details ?: 0 }} </h5>
                                    </div>

                                </div>


                                <div class="row text-center mb-3">
                                    @forelse (getFlightCargoAttchments('record_by_sea', $flightCargo->id, 'sea_cargo_other_attachment') as $attchment)
                                    @if (
                                    $attchment->file_type == 'png' ||
                                    $attchment->file_type == 'jpg' ||
                                    $attchment->file_type == 'jpeg' ||
                                    $attchment->file_type == 'gif')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}">
                                            <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                        </a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'pdf')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'xls')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @endif
                                    @empty
                                    <div class="col">
                                        <p style="font-weight: bolder">N/A</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Photos of
                                    Cargo</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-12">
                                <label for="">Photos</label>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            @forelse (getFlightCargoAttchments('record_by_sea', $flightCargo->id, 'sea_cargo_photos') as $attchment)
                            @if (
                            $attchment->file_type == 'png' ||
                            $attchment->file_type == 'jpg' ||
                            $attchment->file_type == 'jpeg' ||
                            $attchment->file_type == 'gif')
                            <div class="col">
                                <a target="_blank" href="{{ $attchment->file_url }}">
                                    <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                </a>
                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                            </div>
                            @elseif($attchment->file_type == 'pdf')
                            <div class="col">
                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                            </div>
                            @elseif($attchment->file_type == 'xls')
                            <div class="col">
                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                            </div>
                            @endif
                            @empty
                            <div class="col">
                                <p style="font-weight: bolder">N/A</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- ================BY ROAD================== -->

                    <div id="by_road_container" class="@if ($flightCargo->flight_cargo_type_id != '3') d-none @endif">


                        <div class="row bg-danger mb-3 pt-0 mt-0">
                            <div class="col-md-6">
                                <h5 class="header-title py-3 text-white" style="font-weight: bold; font-size: 17px;">By Road</h5>
                            </div>
                            <div class="col-md-6">
                                <h5 class="header-title py-3 text-right text-white" style="font-weight: bold; font-size: 17px;">
                                    Case#
                                    {{ $flightCargo->id }}
                                </h5>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">

                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Origin</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_arrival_origin }}</h6>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Date Time</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_arrival_date_time }}</h6>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Destination</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_destination }}</h6>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Date Time</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_destination_date_time }}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-12 col-md-6">
                                <div class="bg-danger d-flex justify-content-center">
                                    <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Cargo Belongs To</label>
                                </div>
                                <h6>{{ $flightCargo->road_cargo_belongs_to }}</h6>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="bg-danger d-flex justify-content-center">
                                    <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Notes</label>
                                </div>
                                <h6>{{ $flightCargo->road_notes }}</h6>
                            </div>

                            <hr>

                        </div>

                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Arriving
                                    Cargo Details</h5>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-12 col-md-6">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Type of Cargo</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_type_of_cargo }}</h6>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">List of Cargo</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_list_of_cargo ?: 'N/A' }}</h6>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label style="font-weight: bold; font-size: 17px;">Attchments</label>
                                    </div>
                                </div>
                                <div class="row  mb-3">
                                    @forelse (getFlightCargoAttchments('record_by_road', $flightCargo->id, 'road_cargo_list_attachments') as $attchment)
                                    @if (
                                    $attchment->file_type == 'png' ||
                                    $attchment->file_type == 'jpg' ||
                                    $attchment->file_type == 'jpeg' ||
                                    $attchment->file_type == 'gif')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}">
                                            <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                        </a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'pdf')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @elseif($attchment->file_type == 'xls')
                                    <div class="col">
                                        <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                        <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                                    </div>
                                    @endif
                                    @empty
                                    <div class="col">
                                        <p style="font-weight: bolder">N/A</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Driver
                                    Details</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Driver Name</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_driver_name ?: 'N/A' }}</h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Driver Number</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_driver_number ?: 'N/A' }}</h6>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group border">
                                    <div class="bg-danger d-flex justify-content-center">
                                        <label class="text-white pt-1" style="font-weight: bold; font-size: 17px;">Vehicle Number & Type</label>
                                    </div>
                                    <h6 class="text-center pt-1">{{ $flightCargo->road_vehicle_number_type ?: 'N/A' }}</h6>
                                </div>
                            </div>


                        </div>

                        <hr>
                        <div class="row mb-3 ">
                            <div class="col-md-6">
                                <h5 class="header-title " style="font-weight: bold; font-size: 17px;">Photos of
                                    Cargo</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-xl-12">
                                <label style="font-weight: bold; font-size: 17px;">Photos</label>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            @forelse (getFlightCargoAttchments('record_by_road', $flightCargo->id, 'by_road_cargo_photos') as $attchment)
                            @if (
                            $attchment->file_type == 'png' ||
                            $attchment->file_type == 'jpg' ||
                            $attchment->file_type == 'jpeg' ||
                            $attchment->file_type == 'gif')
                            <div class="col">
                                <a target="_blank" href="{{ $attchment->file_url }}">
                                    <img src="{{ $attchment->file_url }}" width="100" height="100" alt="{{ $attchment->orignal_file_name }}">
                                </a>
                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                            </div>
                            @elseif($attchment->file_type == 'pdf')
                            <div class="col">
                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-pdf-box"></i></a>
                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                            </div>
                            @elseif($attchment->file_type == 'xls')
                            <div class="col">
                                <a target="_blank" href="{{ $attchment->file_url }}" style="font-size: 100px"><i class="mdi mdi-file-excel"></i></a>
                                <p style="margin-left: 27px">{{ $attchment->orignal_file_name }}</p>
                            </div>
                            @endif
                            @empty
                            <div class="col">
                                <p style="font-weight: bolder">N/A</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection