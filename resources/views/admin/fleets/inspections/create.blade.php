@extends('layouts.app')
@section('inspection-active-class', 'active')
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
@section('content')
    <div class="container-fluid mt-5">
        <div class="alert bg-info text-light d-none" role="alert" id="error-alert">
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body pb-0">
                        <h3 class="header-title">Add Inspection</h3>
                        <form id="add_inspection_form">
                            @csrf
                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group mb- col-4">
                                    {{-- <label for="inspection_type">Type</label> --}}
                                    <select name="inspection_type" class="form-control" id="inspection_type">
                                        <option value="">Select</option>
                                        <option value="{{ \App\Models\Inspection::VEHICLE }}">Vehicle</option>
                                        <option value="{{ \App\Models\Inspection::ASSET }}">Asset</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row vehcile-section d-none">
                                <div class="col-md-6">
                                    <h5 for="vehicle_id">Vehicle #</h5>
                                    <select id="vehicle_id" name="vehicle_id" class="form-control select2">
                                        <option value="">Choose...</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger" id="vehicle_error"></p>
                                    <div class="mt-3">
                                        <h4 id="vehicle_number">ACB-1234</h4>
                                        <h5 id="vehicle_model">Model</h5>
                                    </div>
                                </div>
                                <div>
                                    <img id="blah" width="200" class="vehile_image" src="{{ asset('img/lcb.jpg') }}"
                                        alt="your image" />
                                </div>

                            </div>

                            <div class="form-row property-section d-none">
                                <div class="col-md-6">
                                    <h5 for="property_id">Property</h5>
                                    <select id="property_id" name="property_id" class="form-control select2">
                                        <option value="">Choose...</option>
                                        @foreach ($properties as $property)
                                            <option value="{{ $property->id }}">{{ $property->property_name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger" id="property_error"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group mb-0 col-6 col-md-4 inputMtr d-none">
                                    {{-- <label for="meter_reading">Meter</label> --}}
                                    <input type="number" name="meter_reading" id="meter_reading" class="form-control"
                                        id="color" placeholder="1,234.0">
                                    <p class="text-danger" id="meter_reading_erors"></p>
                                </div>
                                <div class="form-group col-6 col-md-4">
                                    {{-- <label for="date">Date</label> --}}
                                    <input type="date" name="date" class="form-control" id="date">
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    {{-- <label for="cost_center_id">Cost Center</label> --}}
                                    <select id="cost_center_id" name="cost_center_id" class="form-control select2">
                                        <option value="">Cost Center</option>
                                        @foreach ($costCenters as $cost)
                                            <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group mb-0 col-12 col-md-6">
                                    <label class="mb-0" for="inspection_bies">Inspection By <i
                                            title="Multiple technicians can be added" class="fa fa-info-circle"></i>
                                    </label>
                                    <select id="inspection_bies" name="inspection_bies[]" class="form-control select2"
                                        multiple>
                                        <option value="">Choose...</option>
                                        @foreach ($users as $user)
                                            <option data-name="{{ $user->full_name }}"
                                                data-designation="{{ optional($user->designation)->name }}"
                                                data-image="{{ $user->profile_pic_url }}" value="{{ $user->id }}">
                                                {{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 d-flex align-items-center">
                                    <h6></h6>
                                </div>
                                <div class="selected-users  d-flex">
                                    <!-- Selected users will be displayed here -->
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Inspection Checklist</h5>
                                    <p class="text-danger" id="checklist-error"></p>
                                    <hr>
                                    <table id="myTable" class=" table order-list">
                                        <thead class="bg-danger text-white">
                                            <tr>
                                                <td><strong>Inspection Item</strong></td>
                                                <td><strong>Status</strong></td>
                                                <td><strong>Remarks</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-5">
                                                    <select id="inspection_items" name="inspection_items[]"
                                                        class="form-control select2">
                                                        <option value="">Choose...</option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger" id="inspection_items.0"></p>
                                                </td>
                                                <td class="col-2">
                                                    <select id="inputChkst" name="inspection_items_status[]"
                                                        class="form-control select2">
                                                        <option value="">Choose...</option>
                                                        <option value="OK">OK</option>
                                                        <option value="NOT OK">Not Ok</option>
                                                    </select>
                                                    <p class="text-danger" id="inspection_items_status.0"></p>
                                                </td>
                                                <td class="col-5">
                                                    <input type="text" name="remarks[]" class="form-control" />
                                                    <p class="text-danger" id="remarks.0"></p>
                                                </td>
                                                <td class="col-sm-2"><a class="deleteRow"></a>

                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block save-btn"
                                                        id="addrow" value="Add Row" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-3">
                                    <h5>Inspection Photos</h5>
                                    <a href="javascript:void(0)" class="btn buttons save-btn files_upload_btn">Upload
                                        Photos</a>
                                    <input type="file" class="d-none" name="files[]" id="files_upload_input"
                                        multiple>
                                </div>
                                <div class="col-md-9">
                                    <div class="row" id="imagePreviewContainer">
                                        <!-- Images will be displayed here -->
                                    </div>
                                </div>
                            </div>
                            <h5>Remarks</h5>
                            <textarea class="form-control col-xs-12" rows="2" name="notes"></textarea>
                            <hr>
                            <div class="d-flex justify-content-end w-100">

                                <button type="button" class="btn save-btn mr-3">Cancel</button>

                                <button type="button" id="add_inspection_btn" class="btn save-btn px-3">Save</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var items = <?php echo json_encode($items); ?>;
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
                                alertDiv.innerHTML = "<h3>Error:</h3><h5>Something went wrong!</h5>";
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
