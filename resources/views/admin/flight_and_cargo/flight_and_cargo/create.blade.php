@extends('layouts.app')
@section('flight_and_cargo-active-class', 'active')
@section('content')
    <div class="container">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Flight & Cargo</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('flight-and-cargos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="text-center">
                                    <h3 class=""><strong>Flight Details</strong></h3>
                                </div>
                                <div class="row d-flex justify-content-around">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            @foreach ($flightCargoType as $index => $type)
                                                <div class="form-check-inline my-1">
                                                    <label class="cr-styled" style="font-weight: bold; font-size: 12px"
                                                        for="flight_cargo_type_id-{{ $type->id }}">
                                                        <input data-name="{{ $type->name }}" class="flight_cargo_type"
                                                            type="radio" id="flight_cargo_type_id-{{ $type->id }}"
                                                            name="flight_cargo_type_id" value="{{ $type->id }}"
                                                            {{ old('flight_cargo_type_id', $module) == $type->id ? 'checked' : ($index == 0 ? 'checked' : '') }}>
                                                        <i class="fa"></i>
                                                        {{ $type->name }}
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>
                                        @error('flight_cargo_type_id')
                                            <span class="error">
                                                <strong style="margin-left: 17px">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            
                            <hr>
                            <div id="by_air_container">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <h6><strong>Flight #</strong></h6>
                                            <input type="text" name="flight_number" class="form-control w-100"
                                                value="{{ old('flight_number') }}" placeholder="Flight Number" />
                                            @error('flight_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <h6><strong>Flight Type</strong></h6>
                                            <select name="flight_type_id" id="flight_type_id" class="form-control w-100">
                                                <option value="">Please Select</option>
                                                @foreach ($flightTypes as $flightType)
                                                    <option value="{{ $flightType->id }}"
                                                        {{ old('flight_type_id') == $flightType->id ? 'selected' : '' }}>
                                                        {{ $flightType->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('flight_type_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <h6><strong>Aircraft</strong></h6>
                                            <select name="aircraft_vessel_id" id="aircraft_vessel_id" class="form-control w-100">
                                                <option value="">Please Select</option>
                                                @foreach ($aircrafts as $aircraft)
                                                    <option value="{{ $aircraft->id }}"
                                                        {{ old('aircraft_vessel_id') == $aircraft->id ? 'selected' : '' }}>
                                                        {{ $aircraft->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('aircraft_vessel_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <h6><strong>Flight Belongs To</strong></h6>
                                            <input type="text" name="flight_belongs_to" class="form-control w-100"
                                                value="{{ old('flight_belongs_to') }}" placeholder="Flight Belongs To" />
                                            @error('flight_belongs_to')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    

                                </div>

                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="flight_notes" placeholder="Notes" id="flight_notes" cols="30" rows="2" class="form-control">{{ old('flight_notes') }}</textarea>
                                    @error('flight_notes')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">Arrival</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Origin</label>
                                            <input type="text" name="arrival_flight_origin" class="form-control"
                                                value="{{ old('arrival_flight_origin') }}" placeholder="Origin" />
                                            @error('arrival_flight_origin')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date Time</label>
                                            <input type="datetime-local" name="arrival_flight_date_time"
                                                class="form-control" value="{{ old('arrival_flight_date_time' , date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('arrival_flight_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Destination</label>
                                            <input type="text" name="arrival_flight_destination" class="form-control"
                                                value="{{ old('arrival_flight_destination') }}"
                                                placeholder="Destination" />
                                            @error('arrival_flight_destination')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date Time</label>   
                                            <input type="datetime-local" name="arrival_flight_destination_date_time"
                                                class="form-control"
                                                value="{{ old('arrival_flight_destination_date_time' , date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('arrival_flight_destination_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title">Arriving Cargo Details</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="arrival_is_flight_passengers"
                                                            {{ old('arrival_is_flight_passengers') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Passengers
                                                    </label>

                                                </div>
                                                @error('arrival_is_flight_passengers')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="number" name="arrival_number_of_passengers"
                                                        class="form-control"
                                                        value="{{ old('arrival_number_of_passengers') }}"
                                                        placeholder="Number of Passengers" />
                                                    @error('arrival_number_of_passengers')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{--  <label for="" style="font-weight: bold; font-size: 17px">Letter
                                                    Received</label>  --}}
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="arrival_vehicle_attachment[]" multiple
                                                            class="custom-file-input" id="arrival_vehicle_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="arrival_vehicle_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="arrival_vehicle_attachment" id="arrival_vehicle_attachment">
                                                        <label class="input-group-text bg-danger text-white" for="arrival_vehicle_attachment">Browse</label>
                                                      </div>
                                                </div>
                                                @error('arrival_vehicle_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="arrival_vehicle_attachment_fileContainer"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="arrival_is_flight_cargo"
                                                            {{ old('arrival_is_flight_cargo') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Cargo
                                                    </label>

                                                </div>
                                                @error('arrival_is_flight_cargo')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="number" name="arrival_weight_of_flight_cargo"
                                                        class="form-control"
                                                        value="{{ old('arrival_weight_of_flight_cargo') }}"
                                                        placeholder="Weight of Cargo" />
                                                    @error('arrival_weight_of_flight_cargo')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{--  <label for="" style="font-weight: bold; font-size: 17px">Letter
                                                    Received</label>  --}}
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="arrival_flight_cargo_attachment[]"
                                                            multiple class="custom-file-input"
                                                            id="arrival_flight_cargo_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="arrival_flight_cargo_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="arrival_flight_cargo_attachment[]" id="arrival_flight_cargo_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="arrival_flight_cargo_attachment[]">Browse</label>
                                                      </div>
                                                </div>
                                                @error('arrival_flight_cargo_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="arrival_flight_cargo_attachment_fileContainer"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="arrival_is_flight_faicons"
                                                            {{ old('arrival_is_flight_faicons') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Falcons
                                                    </label>
                                                </div>
                                                @error('arrival_is_flight_faicons')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="arrival_number_of_faicons"
                                                        class="form-control"
                                                        value="{{ old('arrival_number_of_faicons') }}"
                                                        placeholder="Number of Falcons" />
                                                    @error('arrival_number_of_faicons')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{--  <label for="" style="font-weight: bold; font-size: 17px">Letter
                                                    Received</label>  --}}
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="arrival_faicon_attachment[]" multiple
                                                            class="custom-file-input" id="arrival_faicon_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="arrival_faicon_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="arrival_faicon_attachment[]" id="arrival_faicon_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="arrival_faicon_attachment[]">Browse</label>
                                                      </div>
                                                </div>
                                                @error('arrival_faicon_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="row" id="arrival_faicon_attachment_fileContainer"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="arrival_is_flight_vehicles"
                                                            {{ old('arrival_is_flight_vehicles') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Vehicles
                                                    </label>
                                                </div>
                                                @error('arrival_is_flight_vehicles')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="arrival_number_of_flight_vehicle"
                                                        class="form-control"
                                                        value="{{ old('arrival_number_of_flight_vehicle') }}"
                                                        placeholder="Number of Vehicle" />
                                                    @error('arrival_number_of_flight_vehicle')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{--  <label for="" style="font-weight: bold; font-size: 17px">Letter
                                                    Received</label>  --}}
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="arrival_flight_vehicle_attachment[]"
                                                            multiple class="custom-file-input"
                                                            id="arrival_flight_vehicle_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="arrival_flight_vehicle_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="arrival_flight_vehicle_attachment[]" id="arrival_flight_vehicle_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="arrival_flight_vehicle_attachment[]">Browse</label>
                                                      </div>
                                                </div>
                                                @error('arrival_flight_vehicle_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="arrival_flight_vehicle_attachment_fileContainer"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="arrival_flight_notes" placeholder="Notes" id="arrival_flight_notes" cols="30" rows="2"
                                        class="form-control">{{ old('arrival_flight_notes') }}</textarea>
                                    @error('arrival_flight_notes')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                            </div>

                            <!-- ===================BY SEA SHIP=================== -->

                            <div id="by_sea_container" class="d-none">
                                <div class="row d-flex mt-1">
                                    <div class="col-6 col-md-6">
                                        <h5 class="header-title pb-1">By Sea</h5>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <h5 class="header-title pb-1">Ship Details</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label>Vessel Number</label> --}}
                                            <input type="text" name="sea_vessel_number" class="form-control"
                                                value="{{ old('sea_vessel_number') }}" placeholder="Vessel Number" />
                                            @error('sea_vessel_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label>Vessel Type</label> --}}
                                            <input type="text" name="sea_vessel_type" class="form-control"
                                                value="{{ old('sea_vessel_type') }}" placeholder="Vessel Type" />
                                            @error('sea_vessel_type')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="sea_notes" placeholder="Notes" id="sea_notes" cols="30" rows="2" class="form-control">{{ old('sea_notes') }}</textarea>
                                    @error('sea_notes')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">Arrival</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Origin</label> --}}
                                            <input type="text" name="sea_arrival_origin" class="form-control"
                                                value="{{ old('sea_arrival_origin') }}" placeholder="Origin" />
                                            @error('sea_arrival_origin')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Date Time</label> --}}
                                            <input type="datetime-local" name="sea_arrival_date_time"
                                                class="form-control" value="{{ old('sea_arrival_date_time' , date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('sea_arrival_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Destination</label> --}}
                                            <input type="text" name="sea_destination" class="form-control"
                                                value="{{ old('sea_destination') }}" placeholder="Destination" />
                                            @error('sea_destination')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Date Time</label> --}}
                                            <input type="datetime-local" name="sea_destination_date_time"
                                                class="form-control" value="{{ old('sea_destination_date_time' , date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('sea_destination_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{-- <label>Cargo Belongs To</label> --}}
                                            <input type="text" name="cargo_belongs_to" class="form-control"
                                                value="{{ old('cargo_belongs_to') }}" placeholder="Cargo Belongs To" />
                                            @error('cargo_belongs_to')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="cargo_notes" placeholder="Notes" id="cargo_notes" cols="30" rows="2"
                                        class="form-control">{{ old('cargo_notes') }}</textarea>
                                    @error('cargo_notes')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">Arriving Cargo Details</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="is_sea_cargo_vehicles"
                                                            {{ old('is_sea_cargo_vehicles') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Vehicles
                                                    </label>

                                                </div>
                                                @error('is_sea_cargo_vehicles')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="number" name="number_of_vehicle" class="form-control"
                                                        value="{{ old('number_of_vehicle') }}"
                                                        placeholder="Number of Vehicle" />
                                                    @error('number_of_vehicle')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{--  <label for="" style="font-weight: bold; font-size: 17px">Letter
                                                    Received</label>  --}}
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="sea_vehicle_attachment[]" multiple
                                                            class="custom-file-input" id="sea_vehicle_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="sea_vehicle_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="sea_vehicle_attachment[]" id="sea_vehicle_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="sea_vehicle_attachment[]">Browse</label>
                                                      </div>
                                                </div>
                                                @error('sea_vehicle_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="sea_vehicle_attachment_fileContainer"></div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="is_sea_cargo"
                                                            {{ old('is_sea_cargo') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Cargo
                                                    </label>

                                                </div>
                                                @error('is_sea_cargo')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="number" name="weight_of_cargo" class="form-control"
                                                        value="{{ old('weight_of_cargo') }}"
                                                        placeholder="Weight of Cargo" />
                                                    @error('weight_of_cargo')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{--  <label for="" style="font-weight: bold; font-size: 17px">Letter
                                                    Received</label>  --}}
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="sea_cargo_attachment[]" multiple
                                                            class="custom-file-input" id="sea_cargo_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="sea_cargo_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="sea_cargo_attachment[]" id="sea_cargo_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="sea_cargo_attachment[]">Browse</label>
                                                      </div>
                                                </div>
                                                @error('sea_cargo_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row" id="sea_cargo_attachment_fileContainer"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="is_sea_cargo_other"
                                                            {{ old('is_sea_cargo_other') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Other
                                                    </label>
                                                </div>
                                                @error('is_sea_cargo_other')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="sea_cargo_other_details"
                                                        class="form-control" value="{{ old('sea_cargo_other_details') }}"
                                                        placeholder="Detail" />
                                                    @error('sea_cargo_other_details')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="sea_cargo_other_attachment[]" multiple
                                                            class="custom-file-input" id="sea_cargo_other_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="sea_cargo_other_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="sea_cargo_other_attachment[]" id="sea_cargo_other_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="sea_cargo_other_attachment[]">Browse</label>
                                                      </div>
                                                </div>
                                                @error('sea_cargo_other_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="row" id="sea_cargo_other_attachment_fileContainer"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">Photos of Cargo</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="sea_cargo_photos[]" multiple
                                                    class="custom-file-input" id="sea_cargo_photos"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="sea_cargo_photos">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-1 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="sea_cargo_photos[]" id="sea_cargo_photos[]">
                                                <label class="input-group-text bg-danger text-white" for="sea_cargo_photos[]">Browse</label>
                                              </div>
                                        </div>
                                        @error('sea_cargo_photos')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                </div>
                            </div>
                            <div class="row" id="sea_cargo_photos_fileContainer"></div>

                            <div id="by_road_container" class="d-none">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">By Road</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Origin</label> --}}
                                            <input type="text" name="road_arrival_origin" class="form-control"
                                                value="{{ old('road_arrival_origin') }}" placeholder="Origin" />
                                            @error('road_arrival_origin')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Date Time</label> --}}
                                            <input type="datetime-local" name="road_arrival_date_time"
                                                class="form-control" value="{{ old('road_arrival_date_time' , date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('road_arrival_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Destination</label> --}}
                                            <input type="text" name="road_destination" class="form-control"
                                                value="{{ old('road_destination') }}" placeholder="Destination" />
                                            @error('road_destination')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Date Time</label> --}}
                                            <input type="datetime-local" name="road_destination_date_time"
                                                class="form-control" value="{{ old('road_destination_date_time' , date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('road_destination_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{-- <label>Cargo Belongs To</label> --}}
                                            <input type="text" name="road_cargo_belongs_to" class="form-control"
                                                value="{{ old('road_cargo_belongs_to') }}" placeholder="Belongs To" />
                                            @error('road_cargo_belongs_to')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="road_notes" placeholder="Notes" id="road_notes" cols="30" rows="2"
                                        class="form-control">{{ old('road_notes') }}</textarea>
                                    @error('road_notes')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">Arriving Cargo Details</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="road_type_of_cargo" class="form-control"
                                                        value="{{ old('road_type_of_cargo') }}"
                                                        placeholder="Type of Cargo" />
                                                    @error('road_type_of_cargo')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="road_list_of_cargo" class="form-control"
                                                        value="{{ old('road_list_of_cargo') }}"
                                                        placeholder="List of Cargo" />
                                                    @error('road_list_of_cargo')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col">
                                                {{--  <label for="" style="font-weight: bold; font-size: 17px">Letter
                                                    Received</label>  --}}
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="road_cargo_list_attachments[]"
                                                            multiple class="custom-file-input"
                                                            id="road_cargo_list_attachments"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="road_cargo_list_attachments">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-1 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="road_cargo_list_attachments[]" id="road_cargo_list_attachments[]">
                                                        <label class="input-group-text bg-danger text-white" for="road_cargo_list_attachments[]">Browse</label>
                                                      </div>
                                                </div>
                                                @error('road_cargo_list_attachments')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror


                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" id="road_cargo_list_attachments_fileContainer"></div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">Driver Details</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Driver Name</label> --}}
                                            <input type="text" name="road_driver_name" class="form-control"
                                                value="{{ old('road_driver_name') }}" placeholder="Driver Name" />
                                            @error('road_driver_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Driver Number</label> --}}
                                            <input type="text" name="road_driver_number" class="form-control"
                                                value="{{ old('road_driver_number') }}" placeholder="Driver Number" />
                                            @error('road_driver_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Vehicle Number & Type</label> --}}
                                            <input type="text" name="road_vehicle_number_type" class="form-control"
                                                value="{{ old('road_vehicle_number_type') }}"
                                                placeholder="Vehicle Number & Type" />
                                            @error('road_vehicle_number_type')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-1">Photos of Cargo</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="by_road_cargo_photos[]" multiple
                                                    class="custom-file-input" id="by_road_cargo_photos"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="by_road_cargo_photos">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-1 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="by_road_cargo_photos[]" id="by_road_cargo_photos[]">
                                                <label class="input-group-text bg-danger text-white" for="by_road_cargo_photos[]">Browse</label>
                                              </div>
                                        </div>
                                        @error('by_road_cargo_photos')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror



                                    </div>

                                </div>
                            </div>
                            <div class="row" id="by_road_cargo_photos_fileContainer"></div>
                            <div class="form-group d-flex justify-content-end mb-0 mt-1">
                                <div>
                                    <button type="submit" class="btn save-btn">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.flight_cargo_type').change(function() {
                var flightCargoName = $(this).attr('data-name');
                enableFlightCargoForms(flightCargoName);
            });

            $('#road_cargo_list_attachments').change(function() {
                renderFiles(this.files, 'road_cargo_list_attachments_fileContainer')
            });

            $('#by_road_cargo_photos').change(function() {
                renderFiles(this.files, 'by_road_cargo_photos_fileContainer')
            });

            $('#sea_cargo_photos').change(function() {
                renderFiles(this.files, 'sea_cargo_photos_fileContainer')
            });

            $('#sea_cargo_other_attachment').change(function() {
                renderFiles(this.files, 'sea_cargo_other_attachment_fileContainer')
            });

            $('#sea_cargo_attachment').change(function() {
                renderFiles(this.files, 'sea_cargo_attachment_fileContainer')
            });

            $('#sea_vehicle_attachment').change(function() {
                renderFiles(this.files, 'sea_vehicle_attachment_fileContainer')
            });

            $('#arrival_flight_vehicle_attachment').change(function() {
                renderFiles(this.files, 'arrival_flight_vehicle_attachment_fileContainer')
            });

            $('#arrival_faicon_attachment').change(function() {
                renderFiles(this.files, 'arrival_faicon_attachment_fileContainer')
            });

            $('#arrival_flight_cargo_attachment').change(function() {
                renderFiles(this.files, 'arrival_flight_cargo_attachment_fileContainer')
            });

            $('#arrival_vehicle_attachment').change(function() {
                renderFiles(this.files, 'arrival_vehicle_attachment_fileContainer')
            });
        });

        function enableFlightCargoForms(flightCargoName) {

            if (flightCargoName == 'By Air') {
                $('#by_air_container').removeClass('d-none');
                $('#by_sea_container').addClass('d-none');
                $('#by_road_container').addClass('d-none');
            } else if (flightCargoName == 'By Sea') {
                $('#by_sea_container').removeClass('d-none');
                $('#by_air_container').addClass('d-none');
                $('#by_road_container').addClass('d-none');
            } else if (flightCargoName == 'By Road') {
                $('#by_road_container').removeClass('d-none');
                $('#by_sea_container').addClass('d-none');
                $('#by_air_container').addClass('d-none');
            }
        }
        enableFlightCargoForms($('.flight_cargo_type:checked').attr('data-name'));

        function renderFiles(files, container) {
            var files = files;
            var container = $('#' + container);
            container.empty();

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var fileContent = e.target.result;
                    var fileType = file.type;
                    var fileName = file.name;

                    var fileElement = $('<div class="col-md-2 mr-2 mb-4" style="font-size: 100px">');

                    if (fileType.startsWith('image/')) {
                        fileElement.html('<i  class="mdi mdi-file-document"></i>');
                    } else if (fileType === 'application/pdf') {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    } else if (fileType === 'application/msword' || fileType ===
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    } else {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    }

                    container.append(fileElement);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
