@extends('layouts.app')
@section('flight_and_cargo-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Flight & Cargo</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('flight-and-cargos.flightclosed.store') }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ encrypt($id) }}">
            <input type="hidden" name="type" value="{{ encrypt($type) }}">

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div id="by_air_container">
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Departure</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Origin</label> --}}
                                            <input type="text" name="departure_flight_origin" class="form-control"
                                                value="{{ old('departure_flight_origin') }}" placeholder="Origin" />
                                            @error('departure_flight_origin')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Date Time</label> --}}
                                            <input type="datetime-local" name="departure_flight_date_time"
                                                class="form-control" value="{{ old('departure_flight_date_time', date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('departure_flight_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Destination</label> --}}
                                            <input type="text" name="departure_flight_destination" class="form-control"
                                                value="{{ old('departure_flight_destination') }}"
                                                placeholder="Destination" />
                                            @error('departure_flight_destination')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Date Time</label> --}}
                                            <input type="datetime-local" name="departure_flight_destination_date_time"
                                                class="form-control"
                                                value="{{ old('departure_flight_destination_date_time', date("Y-m-d H:i:s")) }}"
                                                placeholder="Date Time" />
                                            @error('departure_flight_destination_date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Arriving Cargo Details</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="departure_is_flight_passengers"
                                                            {{ old('departure_is_flight_passengers') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Passengers
                                                    </label>

                                                </div>
                                                @error('departure_is_flight_passengers')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="number" name="departure_number_of_passengers"
                                                        class="form-control"
                                                        value="{{ old('departure_number_of_passengers') }}"
                                                        placeholder="Number of Passengers" />
                                                    @error('departure_number_of_passengers')
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
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="departure_attachment[]" multiple
                                                            class="custom-file-input" id="departure_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="departure_attachment">Choose
                                                            file</label>
                                                    </div> --}}

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">                                                       
                                                        </div>
                                                        <div class="input-group mb-3 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="departure_attachment[]" id="departure_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="departure_attachment[]">Browse</label>
                                                         </div>
                                                          </div>
                                                </div>
                                                @error('departure_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="departure_attachment_fileContainer"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="departure_is_flight_cargo"
                                                            {{ old('departure_is_flight_cargo') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Cargo
                                                    </label>

                                                </div>
                                                @error('departure_is_flight_cargo')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="number" name="departure_weight_of_flight_cargo"
                                                        class="form-control"
                                                        value="{{ old('departure_weight_of_flight_cargo') }}"
                                                        placeholder="Weight of Cargo" />
                                                    @error('departure_weight_of_flight_cargo')
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
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="departure_cargo_attachment[]" multiple
                                                            class="custom-file-input" id="departure_cargo_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="departure_cargo_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">                                                       
                                                        </div>
                                                        <div class="input-group mb-3 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="departure_cargo_attachment[]" id="departure_cargo_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="departure_cargo_attachment[]">Browse</label>
                                                         </div>
                                                          </div>
                                                </div>
                                                @error('departure_cargo_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="departure_cargo_attachment_fileContainer"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="departure_is_flight_faicons"
                                                            {{ old('departure_is_flight_faicons') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Falcons
                                                    </label>
                                                </div>
                                                @error('departure_is_flight_faicons')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="departure_number_of_faicons"
                                                        class="form-control"
                                                        value="{{ old('departure_number_of_faicons') }}"
                                                        placeholder="Number of Falcons" />
                                                    @error('departure_number_of_faicons')
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
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="departure_faicon_attachment[]"
                                                            multiple class="custom-file-input"
                                                            id="departure_faicon_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="departure_faicon_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">                                                       
                                                        </div>
                                                        <div class="input-group mb-3 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="departure_faicon_attachment[]" id="departure_faicon_attachment[]">
                                                        <label class="input-group-text bg-danger text-white" for="departure_faicon_attachment[]">Browse</label>
                                                         </div>
                                                          </div>
                                                </div>
                                                @error('departure_faicon_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="departure_faicon_attachment_fileContainer"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="checkbox my-2">
                                                    <label class="cr-styled">
                                                        <input type="checkbox" name="departure_is_flight_vehicles"
                                                            {{ old('departure_is_flight_vehicles') ? 'checked' : '' }}>
                                                        <i class="fa"></i>
                                                        Vehicles
                                                    </label>
                                                </div>
                                                @error('departure_is_flight_vehicles')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" name="departure_number_of_flight_vehicle"
                                                        class="form-control"
                                                        value="{{ old('departure_number_of_flight_vehicle') }}"
                                                        placeholder="Number of Vehicle" />
                                                    @error('departure_number_of_flight_vehicle')
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
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                    </div>
                                                    {{-- <div class="custom-file">
                                                        <input type="file" name="departure_flight_vehicle_attachment[]"
                                                            multiple class="custom-file-input"
                                                            id="departure_flight_vehicle_attachment"
                                                            aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label"
                                                            for="departure_flight_vehicle_attachment">Choose
                                                            file</label>
                                                    </div> --}}
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">                                                       
                                                        </div>
                                                        <div class="input-group mb-3 choseFileInputs">
                                                        <input type="file" class="form-control chooser" name="departure_flight_vehicle_attachment" id="departure_flight_vehicle_attachment">
                                                        <label class="input-group-text bg-danger text-white" for="departure_flight_vehicle_attachment">Browse</label>
                                                         </div>
                                                          </div>
                                                </div>
                                                @error('departure_flight_vehicle_attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                        </div>
                                        <div class="row" id="departure_flight_vehicle_attachment_fileContainer"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="departure_flight_notes" placeholder="Notes" id="departure_flight_notes" cols="30"
                                        rows="3" class="form-control">{{ old('departure_flight_notes') }}</textarea>
                                    @error('departure_flight_notes')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Photos of Flight</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="departure_flight_photos[]" multiple
                                                    class="custom-file-input" id="departure_flight_photos"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="departure_flight_photos">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">                                                       
                                                </div>
                                                <div class="input-group mb-3 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="departure_flight_photos[]" id="departure_flight_photos[]">
                                                <label class="input-group-text bg-danger text-white" for="departure_flight_photos[]">Browse</label>
                                                 </div>
                                                  </div>
                                        </div>
                                        @error('departure_flight_photos')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror



                                    </div>

                                </div>
                                <div class="row" id="departure_flight_photos_attachment_fileContainer"></div>
                            </div>
                            <div class="form-group mb-0 mt-5 d-flex justify-content-end">
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

            $('#departure_attachment').change(function() {
                renderFiles(this.files, 'departure_attachment_fileContainer')
            });

            $('#departure_cargo_attachment').change(function() {
                renderFiles(this.files, 'departure_cargo_attachment_fileContainer')
            });

            $('#departure_faicon_attachment').change(function() {
                renderFiles(this.files, 'departure_faicon_attachment_fileContainer')
            });

            $('#departure_flight_vehicle_attachment').change(function() {
                renderFiles(this.files, 'departure_flight_vehicle_attachment_fileContainer')
            });

            $('#departure_flight_photos').change(function() {
                renderFiles(this.files, 'departure_flight_photos_attachment_fileContainer')
            });
        });

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
