<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="modal fade" id="addTripLabel" aria-labelledby="addTripLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content" style="width: 150%">
            {{-- <div class="modal-header p-1 rounded-0" style="background-color: #707070">
                <h4 class="modal-title text-white pl-1" id="addTripLabel"><strong>Add Trip</strong></h4>
                <button type="button" class="close rounded-xl p-1 px-2 mr-0 mt-0" data-dismiss="modal"
                    aria-label="Close" style="background-color:#d4d4d4">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <form id="trip_add_form" enctype="multipart/form-data">
                <div class="modal-body pb-0">
                    <div class="row mb-2 align-items-center">
                        <div class="col-4">
                            <h3 for="vehicle_id" class="light-dark vehicle-heading mb-1">Vehicle</h3>
                            <select name="vehicle_id" id="vehicle_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Vehicle...</option>
                                @foreach ($vheicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-3">
                            <div class="item-title text-right">
                                <h4 class="mb-1" id="vehicle_number">XX-XXXX</h4>
                                <h6 class="mb-0" id="vehicle_model">XXXXX</h6>
                            </div>
                        </div>
                        <div class="col-5 pr-0">
                            <button type="button" class="close modalclose-btn px-2 py-1" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="d-flex justify-content-end">
                                <img id="blah" width="200" height="100" class="vehile_image"
                                    src="http://placehold.it/180" alt="your image" />
                            </div>
                        </div>
                    </div>
                    <hr class="model-hr">
                    <div class="row mb-2">
                        <div class="col-9">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    {{-- <h6 for="driver_id" class="light-dark mb-1">Driver</h6> --}}
                                    <select name="driver_id" id="driver_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Driver...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    {{-- <h6 class="light-dark mb-1" for="official_id">Official</h6> --}}
                                    <select name="official_id" id="official_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Official...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    {{-- <h6 class="light-dark mb-1" for="cost_center_id">Cost Center</h6> --}}
                                    <select name="cost_center_id" id="cost_center_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Cost Center...</option>
                                        @foreach ($costCenters as $cost)
                                            <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <img id="blah" src="http://placehold.it/180" alt="your image"
                                            class="w-25 h-25 rounded-circle driver_image" />
                                        <div>
                                            <p class="my-0" id="driver_name">Name</p>
                                            <p class="my-0" id="driver_designation">Designation</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <img id="blah" src="http://placehold.it/180" alt="your image"
                                            class="w-25 h-25 rounded-circle official_image" />
                                        <div>
                                            <p class="my-0" id="official_name">Official Name</p>
                                            <p class="my-0" id="official_designation">Designation</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row align-items-center mb-2">
                                        <div class="col-2">
                                            <label for="" style="margin-bottom: 0;">PO#</label>
                                        </div>
                                        <div class="col-2">
                                            {{-- <input type="checkbox" name="" id=""
                                                class="selecter-checkbox"> --}}
                                            <input type="checkbox" name="" onclick="toggleInput(this)"
                                                class="selecter-checkbox">
                                        </div>
                                        <div class="col-8 change">
                                            {{-- <h6 class="light-dark mb-1" for="purchase_order_id">Purchase Order</h6> --}}
                                            <select name="purchase_order_id" id="purchase_order_id"
                                                class="change-input select2 form-control custom-select medium-select"
                                                disabled style="width: 100%; height:36px;">
                                                <option value=""></option>
                                                @foreach ($purchaseOrder as $po)
                                                    <option value="{{ $po->id }}">{{ $po->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-2">
                                            {{-- <h6 class="light-dark mb-1" for="work_order_id">Work Order</h6> --}}
                                            <label for="" style="margin-bottom: 0;">WO#</label>
                                        </div>
                                        <div class="col-2">
                                            <input type="checkbox" name="" id="" onclick="toggleInput(this)"
                                                class="selecter-checkbox">
                                        </div>
                                        <div class="col-8 ">
                                            <select name="work_order_id" id="work_order_id"
                                                class=" select2 form-control custom-select"
                                                style="width: 100%; height:36px;" disabled>
                                                <option value=""></option>
                                                @foreach ($workorders as $wo)
                                                    <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-2">
                                            {{-- <h6 class="light-dark mb-1" for="fuel_slip_id">Fuel Slip</h6> --}}
                                            <label for="" style="margin-bottom: 0;">Fuel slip#</label>
                                        </div>
                                        <div class="col-2">
                                            <input type="checkbox" name="" id="" onclick="toggleInput(this)"
                                                class="selecter-checkbox">
                                        </div>
                                        <div class="col-8">
                                            <select name="fuel_slip_id" id="fuel_slip_id"
                                                class="select2 form-control custom-select"
                                                style="width: 100%; height:36px;" disabled>
                                                <option value=""></option>
                                                @foreach ($fuelSlip as $fs)
                                                    <option value="{{ $fs->id }}">{{ $fs->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    {{-- <h6 class="light-dark mb-1" for="origin_id">Origin</h6> --}}
                                    <input type="text" class="form-control autocomplete" name="origin"
                                        id="origin">
                                </div>
                                <div class="col-md-7">
                                    {{-- <h6 class="light-dark mb-1" for="distination_id">Destination</h6> --}}
                                    <input type="text" class="form-control autocomplete" name="destination"
                                        id="destination">
                                </div>
                            </div>

                        </div>
                        <div class="col-3">
                            <div class="mb-2">
                                <h6 class="light-dark mb-1">Start Date&Time</h6>
                                <input name="exit_datetime" type="datetime-local" class="form-control datetime-input"
                                    id="exit_datetime" style="height: 38px">
                            </div>
                            <div class="mb-2">
                                {{-- <h6 class="light-dark mb-1">Exit Meeter Reading</h6> --}}

                                <input name="exit_meetr_reading" type="text" class="form-control"
                                    id="exit_meetr_reading" placeholder="Meter Out">
                            </div>
                            <div class="mb-2">
                                {{-- <h6 class="light-dark mb-1">Uploads Decument</h6> --}}
                                <input name="atachments[]" type="file" placeholder=""
                                    class="form-control chooser" style="height: 38px" id="atachments" multiple>
                            </div>

                        </div>
                    </div>
                    <hr class="model-hr">
                    <div class="row mb-2 align-items-center">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="result">Trip Details</label>
                                <a onclick="startConverting();"><i class="fa fa-microphone btn"
                                        style="background-color:#a80000; color:#fff;" aria-hidden="true"></i></a>
                                <textarea name="notes" id="result" cols="10" rows="4" class="form-control" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="btn-box mt-3">
                                <div>
                                    <button type="button" id="submitFormButton"
                                        class="btn save-btn w-100">Save</button>
                                </div>
                                <div class="my-2 text-center">
                                    <label for="" class="mb-0 mr-3">Print on save</label>
                                    <input type="checkbox" name="" id="">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm cancel-btn w-100" data-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
