@extends('layouts.app')
@section('trip-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">
        @include('admin.fleets._shareable._states', [
            'states' => $states,
        ])
        <hr>
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @php
            Session::forget('success');
        @endphp
        <div class="d-flex justify-content-between topbar-header  text-white p-2 mb-3" style="border-radius: 5px">
            <div class="py-0 pl-3">
                <h3 class="mb-0 pt-1">List of Trips</h3>
            </div>
            @if (Auth::user()->can('Add Trips'))
                <button type="button"  class="btn save-btn mr-2" data-toggle="modal"
                    data-target="#addTripLabel">Trip Entry </button>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table-hover ajax-table" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Vehicle#</th>
                        <th scope="col">Model</th>
                        <th scope="col">Exit Date & Time</th>
                        <th scope="col">Exit Meter</th>
                        <th scope="col">Return Date & Time</th>
                        <th scope="col">Return Meter</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Distance</th>
                        <th scope="col">Cost Center</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Official</th>
                        <th scope="col">Attachments</th>
                        <th scope="col">Trip Status</th>
                        <th scope="col">Vehicle Status</th>
                        <th scope="col">View</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>



        <!-- Add Modal -->
        @include('admin.fleets.trips._models._add', [
            'locations' => $locations,
            'costCenters' => $costCenters,
            'users' => $users,
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
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('trips.index') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'vehicle_number',
                    name: 'vehicle_number'
                },
                {
                    data: 'model',
                    name: 'model'
                },
                {
                    data: 'exit_datetime_out',
                    name: 'exit_datetime_out'
                },
                {
                    data: 'exit_meetr_reading',
                    name: 'exit_meetr_reading'
                },
                {
                    data: 'return_datetime_out',
                    name: 'return_datetime_out'
                },
                {
                    data: 'return_meetr_reading',
                    name: 'return_meetr_reading'
                },
                {
                    data: 'origin',
                    name: 'origin'
                },
                {
                    data: 'destination',
                    name: 'destination'
                },
                {
                    data: 'distance',
                    name: 'distance'
                },
                {
                    data: 'costCenter',
                    name: 'costCenter'
                },
                {
                    data: 'driver',
                    name: 'driver'
                }, {
                    data: 'official',
                    name: 'official'
                },
                {
                    data: 'attachments',
                    name: 'attachments'
                }, {
                    data: 'trip_status',
                    name: 'trip_status'
                }, {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#vehicle_id').change(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('trips.vehicle.by.id.index') }}",
                data: {
                    'id': $(this).val()
                },
                success: function(res) {
                    var vehicle = res.data;
                    console.log(vehicle);
                    $('#vehicle_number').text(vehicle.vehicle_number);
                    $('#vehicle_model').text(vehicle.model.name);
                    $('.vehile_image').attr('src', vehicle.image_url)
                    $('#exit_meetr_reading').val(vehicle.current_meter_reading)
                }
            });
        });

        $('#driver_id').change(function() {
            getUserDataAjax($(this).val(), 'driver_image', 'driver_name', 'driver_designation');
        });

        $('#official_id').change(function() {
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

        $(document).ready(function() {
            $("#trip_add_form").validate({
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
                },
                messages: {
                    vehicle_id: "Please Select vehicle",
                    driver_id: "Please Select Driver",
                    official_id: "Please Select Official",
                    cost_center_id: "Please Select Cost Center",
                    origin: "Please select origin",
                    distination: "Please select destination",
                    exit_datetime: "Please select exit datetime",
                    exit_meetr_reading: "Please enter exit meeter reading",
                }
            });
        })

        $(document).ready(function() {
            $('#submitFormButton').click(function() {
                var formElement = document.getElementById('trip_add_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid



                    $.ajax({
                        type: "POST",
                        url: "{{ route('trips.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
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

        $('#addTripLabel').on('shown.bs.modal', function() {
            $('#vehicle_id').select2({
                search: true
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
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&language=en&callback=initAutocomplete&loading=async"
        async defer></script>
@endsection
