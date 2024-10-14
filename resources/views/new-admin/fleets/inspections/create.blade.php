@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Add Attachements')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <style>
        /* CSS to set a fixed width and height for the displayed images */
        #imagePreviewContainer img {
            width: 200px;
            /* Set your desired width */
            height: 150px;
            /* Set your desired height */
            margin-right: 10px;
            /* Set the desired spacing between images */
        }

        .select2-container {
            width: 100% !important;
        }

        .user-card {
            width: 300px;
            /* Set the desired width for each card */
            margin: 10px;
            /* Add some margin to separate cards */
            border: 1px solid #ccc;
            /* Add a border for visual separation */
            padding: 10px;
            /* Add padding to the card content */
            text-align: center;
            /* Center the content horizontally */
        }

        .user-card img {
            max-width: 30%;
            /* Ensure the image doesn't exceed the card width */
            border-radius: 50%;
            /* Make the image a circle by setting border-radius */
        }

        hr {
            margin-block: 5px !important;
        }
    </style>
@endsection

@section('content')
    <style>
        table {
            counter-reset: section;
        }

        .count:before {
            counter-increment: section;
            content: counter(section);
        }
    </style>
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="col-lg-12 col-sm-12">
                    @if (Auth::user()->can('Add Department'))
                        <div class="card m-b-30">
                            <div class="card-body">
                                <form id="add_inspection_form" class="form form-horizontal">
                                    @csrf
                                    <!-- Inspection Type -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inspection_type">Inspection Type</label>
                                                <select name="inspection_type" class="form-control" id="inspection_type">
                                                    <option value="">Select Inspection Type</option>
                                                    <option value="{{ \App\Models\Inspection::VEHICLE }}">Vehicle</option>
                                                    <option value="{{ \App\Models\Inspection::ASSET }}">Asset</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Vehicle Section (Hidden initially) -->
                                    <div class="row vehcile-section d-none">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vehicle_id">Vehicle #</label>
                                                <select id="vehicle_id" name="vehicle_id" class="form-control select2">
                                                    <option value="">Choose Vehicle...</option>
                                                    @foreach ($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger" id="vehicle_error"></p>
                                                <div class="mt-3">
                                                    <h4 id="vehicle_number">ACB-1234</h4>
                                                    <h5 id="vehicle_model">Model</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                                            <img id="blah" width="200" class="vehicle_image"
                                                src="{{ asset('img/lcb.jpg') }}" alt="your image" />
                                        </div>
                                    </div>

                                    <!-- Property Section (Hidden initially) -->
                                    <div class="row property-section d-none">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="property_id">Property</label>
                                                <select id="property_id" name="property_id" class="form-control select2">
                                                    <option value="">Choose Property...</option>
                                                    @foreach ($properties as $property)
                                                        <option value="{{ $property->id }}">{{ $property->property_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-danger" id="property_error"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Meter Reading, Date, and Cost Center -->
                                    <div class="row">
                                        <div class="col-md-4 inputMtr d-none">
                                            <div class="form-group">
                                                <label for="meter_reading">Meter Reading</label>
                                                <input type="number" name="meter_reading" id="meter_reading"
                                                    class="form-control" placeholder="Meter Reading">
                                                <p class="text-danger" id="meter_reading_erors"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    placeholder="Select Date">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cost_center_id">Cost Center</label>
                                                <select id="cost_center_id" name="cost_center_id"
                                                    class="form-control select2">
                                                    <option value="">Select Cost Center</option>
                                                    @foreach ($costCenters as $cost)
                                                        <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Inspection By Section -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inspection_bies">Inspection By <i class="fa fa-info-circle"
                                                        title="Multiple technicians can be added"></i></label>
                                                <select id="inspection_bies" name="inspection_bies[]"
                                                    class="form-control select2" multiple>
                                                    <option value="">Choose Technicians...</option>
                                                    @foreach ($users as $user)
                                                        <option data-name="{{ $user->full_name }}"
                                                            data-designation="{{ optional($user->designation)->name }}"
                                                            data-image="{{ $user->profile_pic_url }}"
                                                            value="{{ $user->id }}">
                                                            {{ $user->full_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="selected-users d-flex align-items-center">
                                                <!-- Selected users will be displayed here -->
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Inspection Checklist -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Inspection Checklist</h5>
                                            <p class="text-danger" id="checklist-error"></p>
                                            <hr>
                                            <table id="myTable" class="table order-list">
                                                <thead class="bg-danger text-white">
                                                    <tr>
                                                        <th>Inspection Item</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="inspection_items">Inspection Item</label>
                                                                <select id="inspection_items" name="inspection_items[]"
                                                                    class="form-control select2">
                                                                    <option value="">Choose Inspection Item...
                                                                    </option>
                                                                    @foreach ($items as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <p class="text-danger" id="inspection_items.0"></p>
                                                            </div>
                                                        </td>
                                                        <td class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="inspection_items_status">Status</label>
                                                                <select id="inputChkst" name="inspection_items_status[]"
                                                                    class="form-control select2">
                                                                    <option value="">Choose Status...</option>
                                                                    <option value="OK">OK</option>
                                                                    <option value="NOT OK">Not OK</option>
                                                                </select>
                                                                <p class="text-danger" id="inspection_items_status.0"></p>
                                                            </div>
                                                        </td>
                                                        <td class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="remarks">Remarks</label>
                                                                <input type="text" name="remarks[]"
                                                                    class="form-control" placeholder="Enter remarks" />
                                                                <p class="text-danger" id="remarks.0"></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="6">
                                                            <input type="button"
                                                                class="btn btn-primary btn-block save-btn" id="addrow"
                                                                value="Add Row" />
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Inspection Photos -->
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <h5>Inspection Photos</h5>
                                            <a href="javascript:void(0)"
                                                class="btn buttons save-btn files_upload_btn">Upload Photos</a>
                                            <input type="file" class="d-none" name="files[]" id="files_upload_input"
                                                multiple>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row" id="imagePreviewContainer">
                                                <!-- Images will be displayed here -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="notes">Remarks</label>
                                                <textarea class="form-control" rows="2" name="notes"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- Submit and Cancel Buttons -->
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <button type="button" id="add_inspection_btn"
                                                class="btn btn-primary save-btn px-3">Save</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
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
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

@endsection
@section('page-script')
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

    <script>
        var items = @json($items);
    </script>
    <script src="{{ asset('app_js_functions/inspection.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize form validation
            $("#add_inspection_form").validate({
                // Define validation rules for your form fields
                rules: {
                    inspection_type: {
                        required: true
                    },
                    meter_reading: {
                        required: function(element) {
                            return $("#inspection_type").val() ===
                                "{{ \App\Models\Inspection::VEHICLE }}";
                        },
                        number: function(element) {
                            return $("#inspection_type").val() ===
                                "{{ \App\Models\Inspection::VEHICLE }}";
                        }
                    },
                    date: {
                        required: true
                    },
                    cost_center_id: {
                        required: true
                    },
                    "inspection_bies[]": {
                        required: true
                    },
                    // Add validation rules for other form fields as needed

                    // Add more rules for other form fields as needed
                },
                // Define error messages for validation rules
                messages: {
                    inspection_type: {
                        required: "Please select an inspection type."
                    },

                    meter_reading: {
                        required: "Please enter the meter reading.",
                        number: "Please enter a valid number."
                    },
                    date: {
                        required: "Please select a date."
                    },
                    cost_center_id: {
                        required: "Please select a cost center."
                    },
                    "inspection_bies[]": {
                        required: "Please select at least one inspection by technician."
                    },

                },
                // Specify where to display error messages
                errorPlacement: function(error, element) {
                    error.appendTo(element.closest(".form-group"));
                },

            });
        });

        $(document).ready(function() {
            $('#add_inspection_btn').click(function() {
                var formElement = document.getElementById('add_inspection_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('inspections.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (!response.status) {
                                $('#meter_reading_erors').text(response.message)
                            } else {
                                $('#meter_reading_erors').text('')
                            }
                            if (response.status) {
                                window.location.href = response.url;
                            }
                        },
                        error: function(error) {
                            status = error.responseJSON.status;
                            if (status == "false") {
                                // Show the alert
                                var alertDiv = document.getElementById("error-alert");
                                alertDiv.innerHTML =
                                    "<h3>Error:</h3><h5>Something went wrong!</h5>";
                                alertDiv.classList.remove("d-none");

                                // Hide the alert after 20 seconds
                                setTimeout(function() {
                                    alertDiv.classList.add("d-none");
                                }, 20000); // 20000 milliseconds = 20 seconds
                            }
                            if (error.responseJSON) {
                                var errors = error.responseJSON.errors;

                                if (containsKeyword(errors, 'inspection_') || containsKeyword(
                                        errors, 'remarks')) {
                                    $('#checklist-error').text(
                                        'Checklist all items are required')
                                } else {
                                    $('#checklist-error').text('')
                                }

                                if (containsKeyword(errors, 'vehicle_id')) {
                                    $('#vehicle_error').text(
                                        'Please select vehicle')
                                } else {
                                    $('#vehicle_error').text('')
                                }

                                if (containsKeyword(errors, 'property_id')) {
                                    $('#property_error').text(
                                        'Please select property')
                                } else {
                                    $('#property_error').text('')
                                }

                            } else {
                                $('#checklist-error').text('')
                            }
                        }
                    });
                }
            });
        });

        function containsKeyword(obj, keyword) {
            for (var key in obj) {
                if (obj.hasOwnProperty(key) && key.indexOf(keyword) !== -1) {
                    return true;
                }
            }
            return false;
        }

        $('#vehicle_id').change(function() {
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
                    $('#meter_reading').val(vehicle.current_meter_reading)
                }
            });
        });
    </script>
@endsection
