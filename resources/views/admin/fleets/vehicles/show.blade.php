@extends('layouts.app')
@section('vehicle-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">

        <div class=" ml-1 bg-danger rounded  text-white mb-3 row" style="padding: 15px">
            <div class="col-md-6">
                <h3 class="pt-1">VEHICLE DETAILS</h3>
            </div>

            <div class="text-right col-md-6">
                <!-- Button trigger modal -->
                @if (Auth::user()->can('Edit Vehicles'))
                    <button type="button" class="btn save-btn btn-md px-3" id="editVehicleButton"> Edit </button> |
                @endif
                @if (Auth::user()->can('Delete Vehicles'))
                    <a href="{{ route('vehicles.delete', ['id' => $vehicle->id]) }}" class="btn save-btn  btn-md px-3"
                        onclick="return confirm('Are you sure?')"> Delete</a>
                @endif

            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @php
            Session::forget('success');
        @endphp
        <div class="row d-flex">
            <div class="col-12 col-md-7">
                <img src="{{ $vehicle->image_url }}" alt="" width="100%">
            </div>
            <div class="col-12 col-md-5">
                <h3>{{ $vehicle->vehicle_number }}</h3>
                <h4>{{ optional($vehicle->type)->name }}</h4>
                <h5>{{ optional($vehicle->make)->name }}</h5>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Distance Travlled</h5>
                        <h2>{{ number_format($vehicle->current_meter_reading - $vehicle->base_meter_reading) }}</h2>
                    </div>
                    <div>
                        <h5>Current Meter</h5>
                        <h2>{{ number_format($vehicle->current_meter_reading) }}</h2>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-md-4 control-label"><strong>Password</strong></label>
                    <div class="col-md-6">
                        <input id="password-field" type="password" class="form-control" name="password" value="{{ decrypt($vehicle->password) }}" readonly>
                        <span toggle="#password-field" class="fa fa-fw fa-eye vehicle-password-icon toggle-password"></span>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="bg-danger rounded py-2 text-white text-center mb-3">
                    <h3 class="pt-2">Vehicle Details</h3>
                </div>
                <div class="row align-items-center">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Vehicle Type:</th>
                                <td><strong>{{ optional($vehicle->type)->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Color:</th>
                                <td><strong>{{ $vehicle->color }}</strong></td>
                            </tr>
                            <tr>
                                <th>Engine #:</th>
                                <td><strong>{{ $vehicle->engine_number }}</strong></td>
                            </tr>
                            <tr>
                                <th>Chassis #:</th>
                                <td><strong>{{ $vehicle->chassis_number }}</strong></td>
                            </tr>
                            <tr>
                                <th>Fuel Type:</th>
                                <td><strong>{{ optional($vehicle->fuelType)->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Year:</th>
                                <td><strong>{{ $vehicle->year }}</strong></td>
                            </tr>
                            <tr>
                                <th>Owner Name:</th>
                                <td><strong>{{ optional($vehicle->owner)->full_name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td><strong>{{ optional($vehicle->department)->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Location:</th>
                                <td><strong>{{ optional($vehicle->location)->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Base Meter:</th>
                                <td><strong>{{ number_format($vehicle->base_meter_reading) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Current Meter:</th>
                                <td><strong>{{ number_format($vehicle->current_meter_reading) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td> <?php
                                if ($vehicle->status == 0) {
                                    echo '<span class="badge badge-danger">Out Of Service</span>';
                                } elseif ($vehicle->status == 1) {
                                    echo '<span class=""badge badge-danger">AVAILABLE</span>';
                                } elseif ($vehicle->status == 2) {
                                    echo '<span class="badge badge-info">Un Available</span>';
                                } elseif ($vehicle->status == 3) {
                                    echo '<span class="badge badge-info">On Move</span>';
                                } elseif ($vehicle->status == 4) {
                                    echo '<span class="badge badge-info">On Workshop</span>';
                                }
                                ?></td>
                            </tr>
                            <tr>
                                <th>Notes:</th>
                                <td><strong>{{ $vehicle->notes }}</strong></td>
                            </tr>
                        </tbody>

                    </table>


                </div>
                <hr>
                <div class="py-3">
                    @if (Auth::user()->can('Upload File Vehicles'))
                        <div class="bg-danger rounded  text-white py-2 text-center d-flex justify-content-around">
                            <h4 class="text-white pt-2">Attachments</h4>
                            <button type="button" class="btn save-btn" data-toggle="modal" data-target="#attach">
                                <strong>Upload File</strong>
                            </button>

                        </div>
                    @endif
                    @foreach ($vehicle->attachments as $atatchment)
                        <div class="row d-flex justify-content-between align-items-center pt-2">
                            <div class="col-6 col-md-6">
                                <a href="{{ $atatchment->file_url }}" target="_blank"> {{ $atatchment->file_name }}</a>
                                <br>
                                {{ $atatchment->created_at }}
                            </div>
                            <div class="col-6 col-md-6 text-center">
                                <a href="{{ $atatchment->file_url }}" target="_blank"><i
                                        style="font-size: 18px !important;" class="fa fa-paperclip fa-xl"></i></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="bg-danger rounded py-2 text-center text-white mb-3">
                    <h3 class="pt-2">Vehicle Timeline</h3>
                </div>

                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Activity Name</th>
                                {{--  <th scope="col">User</th>
                            <th scope="col">View</th>  --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timelineData as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data['date'] ?: 'N/A' }}</td>
                                    <td>{{ $data['description'] ?: 'N/A' }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Edit Modal -->
        @include('admin.fleets.vehicles._models._edit', [
            'makes' => $makes,
            'models' => $models,
            'types' => $types,
            'fuelTypes' => $fuelTypes,
            'locations' => $locations,
            'departments' => $departments,
            'users' => $users,
        ])


        <!-- Attachment Modal -->
        @include('admin.fleets.vehicles._models._attachment', [
            'vehicle' => $vehicle,
        ])


        <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
                class="fa fa-chevron-up"></i></a>
    </div>
@endsection

@section('script')
    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });
        });

        $(document).ready(function() {
            $("#vehicle_attachment_form").validate({
                rules: {
                    file_name: "required",
                    file: "required",
                },
                messages: {
                    vehicle_number: "Please enter file name",
                    file: "Please Select attachment",
                }
            });
        })

        $(document).ready(function() {
            $('#submitAttachmentFormButton').click(function() {
                var formElement = document.getElementById(
                    'vehicle_attachment_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    var fileInput = $('#attachment_file')[0];
                    var file = fileInput.files[0];

                    formData.append('image', file);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('vehicles.store.attachment') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload();
                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        });


        $('#editVehicleButton').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{ route('vehicles.edit') }}",
                data: {
                    'id': '{{ $vehicle->id }}'
                },
                success: function(response) {
                    var vehicle = response.vehicle;
                    $('#vehicle_number_edit').val(vehicle.vehicle_number);
                    $('#vehicle_make_id_edit').val(vehicle.vehicle_make_id).trigger('change');
                    $('#vehicle_model_id_edit').val(vehicle.vehicle_model_id).trigger('change');
                    $('#type_edit').val(vehicle.vehicle_type_id).trigger('change');
                    $('#color_edit').val(vehicle.color);
                    $('#engine_edit').val(vehicle.engine_number);
                    $('#chassis_edit').val(vehicle.chassis_number);
                    $('#fuel_type_id_edit').val(vehicle.fuel_type_id).trigger('change');
                    $('#owner_id_edit').val(vehicle.owner_id).trigger('change');
                    $('#year_edit').val(vehicle.year);
                    $('#meter_reading_edit').val(vehicle.current_meter_reading);
                    $('#department_id_edit').val(vehicle.department_id).trigger('change');
                    $('#location_id_edit').val(vehicle.location_id).trigger('change');
                    $('#status_edit').val(vehicle.status).trigger('change');
                    $('#notes_edit').val(vehicle.notes);
                    $('.image_edit').attr('src', vehicle.image_url);
                    $('#editVehicle').modal('show');
                }
            });
        });

        $(document).ready(function() {
            $('.vehicle_image').click(function(e) {
                $('#vehicle_image_input').trigger('click');
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(document).ready(function() {
            $("#vehicle_edit_form").validate({
                rules: {
                    vehicle_number: "required",
                    vehicle_make_id: "required",
                    vehicle_model_id: "required",
                    vehicle_type_id: "required",
                    color: "required",
                    engine_number: "required",
                    chassis_number: "required",
                    fuel_type_id: "required",
                    year: "required",
                    owner_id: "required",
                    current_meter_reading: "required",
                    department_id: "required",
                    location_id: "required",
                    status: "required",
                },
                messages: {
                    vehicle_number: "Please enter your vehicle number",
                    vehicle_make_id: "Please Select vehicle make",
                    vehicle_model_id: "Please Select vehicle model",
                    vehicle_type_id: "Please Select vehicle type",
                    color: "Please enter color",
                    engine_number: "Please enter engine number",
                    chassis_number: "Please enter chassis number",
                    fuel_type_id: "Please Select fuel type",
                    year: "Please enter year ",
                    owner_id: "Please Select owner",
                    current_meter_reading: "Please enter current meter reading",
                    department_id: "Please Select department",
                    location_id: "Please Select location",
                    status: "Please Select status",
                }
            });
        })

        $(document).ready(function() {
            $('#vehicleEditButton').click(function() {
                var formElement = document.getElementById('vehicle_edit_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    var fileInput = $('#vehicle_image_input')[0];
                    var file = fileInput.files[0];

                    formData.append('image', file);

                    // Check FormData contents in console
                    console.log(formData);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('vehicles.update') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload()
                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        });
    </script>
@endsection
