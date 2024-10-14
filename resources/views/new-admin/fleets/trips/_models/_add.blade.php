<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="modal fade" id="addTripLabel" tabindex="-1" aria-labelledby="addTripLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1" id="addTripLabel">Add Trip</h1>
                    <p>Please fill in the details below.</p>
                </div>
                <form id="trip_add_form" class="row gy-1 pt-75" enctype="multipart/form-data">
                    <!-- Vehicle Selection Row -->
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-4">
                            <label for="vehicle_id" class="form-label">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control select2 custom-select">
                                <option value="">Vehicle...</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="item-title text-right">
                                <h4 class="mb-1" id="vehicle_number">XX-XXXX</h4>
                                <h6 class="mb-0" id="vehicle_model">XXXXX</h6>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="d-flex justify-content-end">
                                <img id="blah" width="200" height="100" class="vehile_image img-fluid"
                                    src="http://placehold.it/180" alt="your image" />
                            </div>
                        </div>
                    </div>

                    <hr class="model-hr">

                    <!-- Driver, Official, and Cost Center Selection -->
                    <div class="row mb-2">
                        <div class="col-md-9">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="driver_id" class="form-label">Driver</label>
                                    <select name="driver_id" id="driver_id" class="form-control select2 custom-select">
                                        <option value="">Driver...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="official_id" class="form-label">Official</label>
                                    <select name="official_id" id="official_id"
                                        class="form-control select2 custom-select">
                                        <option value="">Official...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="cost_center_id" class="form-label">Cost Center</label>
                                    <select name="cost_center_id" id="cost_center_id"
                                        class="form-control select2 custom-select">
                                        <option value="">Cost Center...</option>
                                        @foreach ($costCenters as $cost)
                                            <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <img id="blah" src="http://placehold.it/180" alt="driver image"
                                            class="w-25 h-25 rounded-circle driver_image img-fluid" />
                                        <div class="ml-2">
                                            <p class="my-0" id="driver_name">Driver Name</p>
                                            <p class="my-0" id="driver_designation">Designation</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center">
                                        <img id="blah" src="http://placehold.it/180" alt="official image"
                                            class="w-25 h-25 rounded-circle official_image img-fluid" />
                                        <div class="ml-2">
                                            <p class="my-0" id="official_name">Official Name</p>
                                            <p class="my-0" id="official_designation">Designation</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- PO, WO, Fuel Slip -->
                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="purchase_order_id" class="form-label">PO#</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" name="po_checkbox" onclick="toggleInput(this)"
                                                class="form-check-input">
                                        </div>
                                        <div class="col-md-6">
                                            <select name="purchase_order_id" id="purchase_order_id"
                                                class="form-control select2 custom-select" disabled>
                                                <option value=""></option>
                                                @foreach ($purchaseOrder as $po)
                                                    <option value="{{ $po->id }}">{{ $po->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="work_order_id" class="form-label">WO#</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" name="wo_checkbox" onclick="toggleInput(this)"
                                                class="form-check-input">
                                        </div>
                                        <div class="col-md-6">
                                            <select name="work_order_id" id="work_order_id"
                                                class="form-control select2 custom-select" disabled>
                                                <option value=""></option>
                                                @foreach ($workorders as $wo)
                                                    <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row align-items-center mb-2">
                                        <div class="col-md-4">
                                            <label for="fuel_slip_id" class="form-label">Fuel Slip#</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" name="fuel_checkbox" onclick="toggleInput(this)"
                                                class="form-check-input">
                                        </div>
                                        <div class="col-md-6">
                                            <select name="fuel_slip_id" id="fuel_slip_id"
                                                class="form-control select2 custom-select" disabled>
                                                <option value=""></option>
                                                @foreach ($fuelSlip as $fs)
                                                    <option value="{{ $fs->id }}">{{ $fs->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Origin and Destination -->
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="origin" class="form-label">Origin</label>
                                    <input type="text" class="form-control autocomplete" name="origin"
                                        id="origin" required>
                                </div>

                                <div class="col-md-7">
                                    <label for="destination" class="form-label">Destination</label>
                                    <input type="text" class="form-control autocomplete" name="destination"
                                        id="destination" required>
                                </div>
                            </div>
                        </div>

                        <!-- Start Date, Meter Reading, and Uploads -->
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="exit_datetime" class="form-label">Start Date & Time</label>
                                <input name="exit_datetime" type="datetime-local" class="form-control"
                                    id="exit_datetime" required>
                            </div>

                            <div class="mb-2">
                                <label for="exit_meetr_reading" class="form-label">Exit Meter Reading</label>
                                <input name="exit_meetr_reading" type="text" class="form-control"
                                    id="exit_meetr_reading" placeholder="Meter Out" required>
                            </div>

                            <div class="mb-2">
                                <label for="atachments" class="form-label">Upload Documents</label>
                                <input name="atachments[]" type="file" class="form-control chooser"
                                    id="atachments" multiple>
                            </div>
                        </div>
                    </div>

                    <hr class="model-hr">

                    <!-- Trip Details and Buttons -->
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="notes" class="form-label">Trip Details</label>
                                <a onclick="startConverting();" class="btn btn-danger btn-sm"><i
                                        class="fa fa-microphone" aria-hidden="true"></i></a>
                                <textarea name="notes" id="notes" cols="10" rows="4" class="form-control"
                                    placeholder="Enter trip details"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="btn-box mt-3">
                                <div class="my-2 text-right d-none">
                                    <label for="print_on_save" class="mb-0 mr-3">Print on Save</label>
                                    <input type="checkbox" name="print_on_save" id="print_on_save"
                                        class="form-check-input ">
                                </div>
                                <button type="submit" id="submitFormButton"
                                    class="btn btn-primary float-end">Save</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    var result = document.getElementById('result');

    function startConverting() {

        if ('webkitSpeechRecognition' in window) {
            var speechRecognizer = new webkitSpeechRecognition();
            speechRecognizer.continuous = true;
            speechRecognizer.interimResults = true;
            speechRecognizer.lang = 'en-US';
            speechRecognizer.start();

            var finalTranscripts = '';

            speechRecognizer.onresult = function(event) {
                var interimTranscripts = '';
                for (var i = event.resultIndex; i < event.results.length; i++) {
                    var transcript = event.results[i][0].transcript;
                    transcript.replace("\n", "<br>");
                    if (event.results[i].isFinal) {
                        finalTranscripts += transcript;
                    } else {
                        interimTranscripts += transcript;
                    }
                }
                result.innerHTML = finalTranscripts + '' + interimTranscripts + '';
            };
            speechRecognizer.onerror = function(event) {

            };
        } else {
            result.innerHTML =
                'Your browser is not supported. Please download Google chrome or Update your Google chrome!!';
        }
    }


    function toggleInput(checkbox) {
        var selectElement = checkbox.parentElement.nextElementSibling.querySelector('select');
        selectElement.disabled = !checkbox.checked;

        if (checkbox.checked) {
            selectElement.disabled = false; // Enable the select element
            // Choose a default option here
        } else {
            selectElement.disabled = true; // Disable the select element
        }
    }
</script>
