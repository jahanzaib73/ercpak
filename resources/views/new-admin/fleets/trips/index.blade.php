@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'List of Trips')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <style>
        table {
            counter-reset: section;
        }

        .count:before {
            counter-increment: section;
            content: counter(section);
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem
        }

        .pac-container {
            z-index: 999999;
        }

        .text-right {
            text-align: right
        }
    </style>
@endsection

@section('content')

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            @include('new-admin.fleets._shareable._states', [
                'states' => $states,
            ])
            <hr>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Trips</h4>
                    @if (Auth::user()->can('Add Trips'))
                        <button type="button" class="btn btn-primary save-btn mr-2" data-bs-toggle="modal"
                            data-bs-target="#addTripLabel">Trip Entry </button>
                    @endif
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @php
                    Session::forget('success');
                @endphp
                <div class="table-responsive width-95-per mx-auto">
                    <table class="table ajax-table">
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
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
    <!-- Add Modal -->
    @include('new-admin.fleets.trips._models._add', [
        'locations' => $locations,
        'costCenters' => $costCenters,
        'users' => $users,
    ])
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection
@section('page-script')

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
