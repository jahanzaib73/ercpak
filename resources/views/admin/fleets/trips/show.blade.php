@extends('layouts.app')
@section('trip-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">

        <hr>
        <div class="d-flex justify-content-between bg-info text-white align-items-center p-2">
            <div class="py-0 pl-3">
                <h3>Trip # : {{ $trip->id }}
                    <span>
                        @if ($trip->status == 0)
                            <span class="badge badge-danger">Trip Open</span>
                        @elseif ($trip->status == 1)
                            <span class="badge badge-danger">Closed</span>
                        @elseif ($trip->status == 2)
                            <span class="badge badge-danger">Canclled</span>
                        @endif
                    </span>
                </h3>
            </div>
            <div>
                @if ($trip->status == 0)
                    @if (Auth::user()->can('Close Trips'))
                        <button type="button" class="btn  btn-lg save-btn" id="tripcloseButton" data-toggle="modal"
                            data-target="#tripclose"> Close Trip
                        </button>
                    @endif
                @endif
                @if (Auth::user()->can('Edit Trips'))
                    <button type="button" class="btn  btn-lg save-btn" id="editTripbtn" data-toggle="modal"
                        data-target="#editTripLabel"> Edit
                        Trip
                    </button>
                @endif

                @if ($trip->status == 0)
                    @if (Auth::user()->can('Cancel Trips'))
                        <button type="button" class="btn  btn-lg save-btn" data-toggle="modal" data-target="#tripCancel">
                            Cancel
                            Trip
                        </button>
                    @endif
                    @if (Auth::user()->can('Delete Trips'))
                        <a href="{{ route('trips.delete', ['id' => $trip->id]) }}" class="btn save-btn btn-lg"
                            onclick="return confirm('Are you sure?')">
                            Delete
                            Trip
                        </a>
                    @endif

                @endif

                @if (Auth::user()->can('Generate Trip Report'))
                    <a href="{{ route('trip.report', ['id' => $trip->id]) }}" class="btn save-btn btn-lg">Generate
                        Report</a>
                @endif

            </div>

        </div>
        @if (session()->has('success'))
            <div class="alert alert-success mt-2" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @php
            Session::forget('success');
        @endphp
        <div class="row pt-4">
            <div class="col-12 col-md-4 d-flex">
                <img src="{{ optional($trip->vehicle)->image_url }}" alt="" width="100%">

            </div>
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ optional($trip->vehicle)->vehicle_number }}</h1>
                        <h3>{{ optional(optional($trip->vehicle)->model)->name }}</h3>
                    </div>
                </div>
                <hr>
                <div class="row d-flex justify-content-between">
                    <div class="col-6">
                        <div class="d-flex justify-content-around pt-3">
                            <img id="blah"
                                src="{{ optional($trip->driver)->profile_pic_url ?: 'http://placehold.it/180' }}"
                                alt="your image" class="w-25 h-25 rounded-circle" />
                            <div>
                                <p class="my-0">{{ optional($trip->driver)->full_name }}</p>
                                <p class="my-0">{{ optional(optional($trip->driver)->designation)->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-around pt-3">
                            <img id="blah"
                                src="{{ optional($trip->official)->profile_pic_url ?: 'http://placehold.it/180' }}"
                                alt="your image" class="w-25 h-25 rounded-circle" />
                            <div>
                                <p class="my-0">{{ optional($trip->official)->full_name }}</p>
                                <p class="my-0">{{ optional(optional($trip->official)->designation)->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row pt-3 d-flex align-items-center">
                    <div class="col-4">
                        <div class="form-group">
                            <h5>POs</h5>
                            <a target="_blank"
                                href="{{ route('purchase-orders.show', ['id' => $trip->purchase_order_id, 'status' => 'COMPARATIVEAPPROVED']) }}"
                                style="color: #337ab7">PO#: {{ $trip->purchase_order_id }}</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <div>
                                <h5>WOs</h5>
                                <a target="_blank" href="{{ route('work-orders.show', ['id' => $trip->work_order_id]) }}"
                                    style="color: #337ab7">WO#: {{ $trip->work_order_id }}</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <h5>Fuel Slips</h5>
                            <a target="_blank" href="{{ route('fuels.show', ['id' => $trip->fuel_slip_id]) }}"
                                style="color: #337ab7">FS#:
                                {{ $trip->fuel_slip_id }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="card col-12 col-md-4">
                <h3 class="card-title pt-2">Trip Start Details</h3>
                <hr>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col-6">
                            <p>Date:</p>
                            <p>Time</p>
                            <p>Meter</p>
                        </div>
                        <div class="col-6">
                            <p><strong>{{ Carbon\Carbon::parse($trip->exit_datetime_out)->toDateString() }}</strong></p>
                            <p><strong>{{ Carbon\Carbon::parse($trip->exit_datetime_out)->format('h:i A') }}</strong></p>
                            <p><strong>{{ $trip->exit_meetr_reading }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-4">
                <h3 class="card-title  pt-2">Trip End Details</h3>
                <hr>
                <div class="card-body">

                    <div class="d-flex">
                        <div class="col-6">
                            <p>Date:</p>
                            <p>Time</p>
                            <p>Meter</p>
                        </div>
                        <div class="col-6">
                            <p><strong>{{ $trip->return_datetime_out ? Carbon\Carbon::parse($trip->return_datetime_out)->toDateString() : 'N/A' }}</strong>
                            </p>
                            <p><strong>{{ $trip->return_datetime_out ? Carbon\Carbon::parse($trip->return_datetime_out)->format('h:i A') : 'N/A' }}</strong>
                            </p>
                            <p><strong>{{ $trip->return_meetr_reading ? $trip->return_meetr_reading : 'N/A' }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-4">
                <h3 class="card-title  pt-2">Travel Details</h3>
                <hr>
                <div class="card-body">

                    <div class="d-flex">
                        <div class="col-6">
                            <p>Origin:</p>
                            <p>Destination</p>
                            <p>Distance</p>
                        </div>
                        <div class="col-6">
                            <p><strong>{{ optional($trip)->origin ? optional($trip)->origin : 'N/A' }}</strong></p>
                            <p><strong>{{ optional($trip)->destination ? optional($trip)->destination : 'N/A' }}</strong></p>
                            <p><strong>{{ $trip->return_meetr_reading ? $trip->return_meetr_reading - $trip->exit_meetr_reading . ' KMs' : 'N/A' }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-6 col-md-3">
                <h5>Cost Center</h5>
                <h4>{{ optional($trip->costCenter)->title }}</h4>
            </div>
            <div class="col-6 col-md-3">
                @if (Auth::user()->can('View Report Attachment'))
                    <h5>Attachments</h5>
                    <a href="javascript:Void(0)" data-toggle="modal" data-target="#allAttachment"
                        class="btn save-btn btn-sm edit">See Attachment</a>
                @endif
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="Notes">Notes</label>
                    <textarea name="notes" id="notes" cols="10" rows="2" class="form-control" disabled readonly
                        id="notes" placeholder="Please write notes here">{{ $trip->notes }}</textarea>
                </div>

            </div>
        </div>
        @if ($trip->status == 2)
            <hr>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="Notes">Cancelled Reason</label>
                        <textarea name="notes" id="notes" cols="10" rows="2" class="form-control" disabled readonly
                            id="notes" placeholder="Please write notes here">{{ $trip->cancelled_reason }}</textarea>
                    </div>
                </div>
            </div>
        @endif

        {{--  Trip Close  --}}
        @include('admin.fleets.trips._models._close')

        @include('admin.fleets.trips._models._all_attachments')

        @include('admin.fleets.trips._models._cancelled')
        {{--  Trip Edit  --}}
        @include('admin.fleets.trips._models._edit', [
            'locations' => $locations,
            'costCenters' => $costCenters,
            'users' => $users,
            'vheicles' => $vheicles,
        ])
    </div>
@endsection

@section('css')
    <style>
        .pac-container {
            z-index: 999999;
        }
    </style>
@endsection

@section('script')
    <script>
        $('#editTripbtn').click(function(e) {
            e.preventDefault();
            console.log('here');
            $.ajax({
                type: "GET",
                url: "{{ route('trips.edit') }}",
                data: {
                    'id': '{{ $trip->id }}'
                },
                success: function(response) {
                    var trip = response.trip;
                    console.log(trip);
                    $('#vehicle_id_edit').val(trip.vehicle_id).trigger('change');
                    $('.trip_image').attr('src', trip.vehicle.image_url);
                    $('#vehicle_number').text(trip.vehicle.vehicle_number);
                    $('#vehicle_model').text(trip.vehicle.model.name);
                    $('#driver_id_edit').val(trip.driver_id).trigger('change');
                    $('#driver_name').text(trip.driver.first_name + ' ' + trip.driver.last_name);
                    $('#driver_designation').text(trip.driver.designation.name);
                    $('.driver_image').attr('src', trip.driver.profile_pic_url);
                    $('#official_id_edit').val(trip.official_id).trigger('change');
                    $('#official_name').text(trip.official.first_name + ' ' + trip.official.last_name);
                    $('#official_designation').text(trip.official.designation.name);
                    $('.official_image').attr('src', trip.official.profile_pic_url);
                    $('#cost_center_id_edit').val(trip.cost_center_id).trigger('change');
                    $('#origin_id_edit').val(trip.origin_id).trigger('change');
                    $('#distination_id_edit').val(trip.destination_id).trigger('change');
                    $('#exit_datetime_edit').val(trip.exit_datetime_out);
                    $('#exit_meetr_reading_edit').val(trip.exit_meetr_reading);
                    $('#notes_edit').val(trip.notes);

                    $('#editTripLabel').modal('show');

                }
            });
        });

        $(document).ready(function() {
            $("#trip_edit_form").validate({
                rules: {
                    vehicle_id: "required",
                    driver_id: "required",
                    official_id: "required",
                    cost_center_id: "required",
                    origin: "required",
                    distination: "required",
                    exit_datetime: "required",
                    exit_meetr_reading: "required",
                    purchase_order_id: "required",
                    work_order_id: "required",
                    fuel_slip_id: "required",
                    purchase_order_id: "required",
                    work_order_id: "required",
                },
                messages: {
                    vehicle_id: "Please Select vehicle",
                    driver_id: "Please Select Driver",
                    official_id: "Please Select Official",
                    cost_center_id: "Please Select Cost Center",
                    origin: "Please enter origin",
                    distination: "Please enter destination",
                    exit_datetime: "Please select exit datetime",
                    exit_meetr_reading: "Please enter exit meeter reading",
                }
            });
        })

        $(document).ready(function() {
            $('#tripUpdate').click(function() {
                var formElement = document.getElementById('trip_edit_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('trips.update') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formData,
                        enctype: 'multipart/form-data',
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

        $('#vehicle_id_edit').change(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('trips.vehicle.by.id.index') }}",
                data: {
                    'id': $(this).val()
                },
                success: function(res) {
                    var vehicle = res.data;
                    $('#vehicle_number').text(vehicle.vehicle_number);
                    $('#vehicle_model').text(vehicle.model.name);
                    $('.vehile_image').attr('src', vehicle.image_url)
                }
            });
        });

        $('#driver_id_edit').change(function() {
            getUserDataAjax($(this).val(), 'driver_image', 'driver_name', 'driver_designation');
        });

        $('#official_id_edit').change(function() {
            getUserDataAjax($(this).val(), 'official_image', 'official_name', 'official_designation');
        });

        function getUserDataAjax(elementId, imagePlaceHolder, namePlacehodler, designationPlaceholder) {
            $.ajax({
                type: "GET",
                url: "{{ route('trips.get.user.index') }}",
                data: {
                    'id': elementId
                },
                success: function(res) {
                    var user = res.data;
                    $(`#${designationPlaceholder}`).text(user.designation.name);
                    $(`#${namePlacehodler}`).text(user.first_name + ' ' + user.first_name);
                    $(`.${imagePlaceHolder}`).attr('src', user.profile_pic_url)
                }
            });
        }

        $('#tripcloseButton').click(function(e) {
            e.preventDefault();

            $.ajax({
                type: "GET",
                url: "{{ route('trips.close.form') }}",
                data: {
                    'id': '{{ $trip->id }}'
                },
                success: function(response) {
                    var trip = response.trip;
                    console.log(trip);
                    $('.vehicle_image_close').attr('src', trip.vehicle.image_url);
                    $('#vehicle_number_close').text(trip.vehicle.vehicle_number);
                    $('#vehicle_model_close').text(trip.vehicle.model.name);
                    $('#driver_name_close').text(trip.driver.first_name + ' ' + trip.driver.last_name);
                    $('#driver_designation_close').text(trip.driver.designation.name);
                    $('.driver_image_close').attr('src', trip.driver.profile_pic_url);
                    $('#offical_name_close').text(trip.official.first_name + ' ' + trip.official
                        .last_name);
                    $('#offical_designation_close').text(trip.official.designation.name);
                    $('.offical_image_close').attr('src', trip.official.profile_pic_url);

                    $('#exit_datetime_close').text(trip.exit_datetime_out);
                    $('#exit_meetr_reading_close').text(trip.exit_meetr_reading);
                    $('#notes_close').text(trip.notes);
                    $('#trip_id').val(trip.id)
                    $('#tripclose').modal('show');

                }
            });
        });


        $(document).ready(function() {
            $("#tripCloseFormId").validate({
                rules: {
                    return_date_time: "required",
                    return_mtr_reading: "required",
                },
                messages: {
                    return_date_time: "Please select return datetime",
                    return_mtr_reading: "Please enter return meeter reading",
                }
            });
        })

        $(document).ready(function() {
            $('#tripCloseFormBtn').click(function() {
                var formElement = document.getElementById('tripCloseFormId'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('trips.close') }}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formData,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (!response.status) {
                                $('.alert_content').removeClass('d-none');
                                $('#alert_content').text(response.message)
                            }

                            if (response.status) {
                                location.reload()
                            }
                        },
                        error: function(error) {

                        }
                    });
                }
            });
        });



        $(document).ready(function() {
            $("#tripCancelFormId").validate({
                rules: {
                    reason: "required",
                },
                messages: {
                    return_date_time: "Please enter reason",
                }
            });
        })

        $(document).ready(function() {
            $('#tripCancelFormBtn').click(function() {
                var formElement = document.getElementById('tripCancelFormId'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('trips.cancel') }}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: formData,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload()
                            }
                        },
                        error: function(error) {

                        }
                    });
                }
            });
        });

        function initAutocomplete() {
            var options = {
                types: ['geocode'],
                componentRestrictions: {
                    country: "pk"
                }
            };

            var input = document.getElementsByClassName('autocomplete');

            for (i = 0; i < input.length; i++) {
                autocomplete = new google.maps.places.Autocomplete(input[i], options);
                console.log(autocomplete);
            }
        };
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&language=en&callback=initAutocomplete&loading=async"
        async defer></script>
@endsection
