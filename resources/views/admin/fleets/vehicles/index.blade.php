@extends('layouts.app')
@section('vehicle-active-class', 'active')

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
        <div class="d-flex align-items-center justify-content-between topbar-header text-white p-2 px-3 mb-3" style="border-radius: 5px">
            <div class="py-0">
                <h3 class="text-white mb-0">List of Vehicles</h3>
            </div>

            @if (Auth::user()->can('Add Vehicles'))
                <button type="button"  class="btn save-btn add-btn" data-toggle="modal"
                    data-target="#addVehicle"> Add Vehicle </button>
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
                        <th scope="col">Make</th>
                        <th scope="col">Type</th>
                        <th scope="col">Color</th>
                        <th scope="col">Engine #</th>
                        <th scope="col">Chassis #</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Year</th>
                        <th scope="col">Owner</th>
                        {{--  <th scope="col">Department</th>  --}}
                        <th scope="col">Base Mtr</th>
                        <th scope="col">Current Mtr</th>
                        <th scope="col">Is Outsource</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>



        <!-- Add Modal -->
        @include('admin.fleets.vehicles._models._add', [
            'makes' => $makes,
            'models' => $models,
            'types' => $types,
            'fuelTypes' => $fuelTypes,
            'locations' => $locations,
            'departments' => $departments,
            'users' => $users,
        ])
    </div>
@endsection

@section('script')

    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('vehicles.index') }}",
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
                    data: 'vehicle_model',
                    name: 'vehicle_model'
                },
                {
                    data: 'vehicle_make',
                    name: 'vehicle_make'
                },
                {
                    data: 'vehicle_type',
                    name: 'vehicle_type'
                },
                {
                    data: 'color',
                    name: 'color'
                },
                {
                    data: 'engine_number',
                    name: 'engine_number'
                },
                {
                    data: 'chassis_number',
                    name: 'chassis_number'
                },
                {
                    data: 'fuel_type',
                    name: 'fuel_type'
                },
                {
                    data: 'year',
                    name: 'year'
                },
                {
                    data: 'owner',
                    name: 'owner'
                },
                {{--  {
                    data: 'department',
                    name: 'department'
                },  --}} {
                    data: 'base_meter_reading',
                    name: 'base_meter_reading'
                }, {
                    data: 'current_meter_reading',
                    name: 'current_meter_reading'
                }, {
                    data: 'is_outsource',
                    name: 'is_outsource'
                },
                {
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




        $(document).ready(function() {
            $('.vehicle_image').click(function(e) {
                $('#vehicle_image_input').trigger('click');
                console.log($('#vehicle_image_input'));
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
            $("#vehicle_add_form").validate({
                errorPlacement: function(error, element) {
                    if (element.is('select')) {
                        error.insertAfter(element); // Place error message below select
                    } else {
                        error.insertAfter(element); // Default placement for other fields
                    }
                },
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
                    password: "required",
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
                    password: "Please enter password",
                }
            });
        })

        $(document).ready(function() {
            $('#submitFormButton').click(function() {
                var formElement = document.getElementById('vehicle_add_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    var fileInput = $('#vehicle_image_input')[0];
                    var file = fileInput.files[0];

                    formData.append('image', file);

                    // Check FormData contents in console
                    console.log(formData);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('vehicles.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                $('.ajax-table').DataTable().ajax.reload();

                                // Clear input values
                                $('#addVehicle input, #addVehicle select, #addVehicle textarea')
                                    .val('');

                                // Clear image preview if applicable
                                $('#blah').attr('src', 'http://placehold.it/180');
                                $('#addVehicle').modal('hide');
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
