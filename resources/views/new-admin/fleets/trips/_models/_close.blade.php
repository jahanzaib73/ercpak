<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="modal fade" id="tripclose" tabindex="-1" aria-labelledby="tripLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1" id="tripLabel">Close Trip</h1>
                    <p>Please review and close the trip details below.</p>
                </div>
                <form id="tripCloseFormId" class="row gy-1 pt-75" enctype="multipart/form-data">
                    <!-- Vehicle Information -->
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-4">
                            <div>
                                <img id="blah" src="http://placehold.it/180" alt="vehicle image"
                                    class="vehicle_image_close img-fluid" width="200" height="100" />
                                <h4 class="mt-2" id="vehicle_number_close">AC-1234</h4>
                                <h6 id="vehicle_model_close">Vehicle Model</h6>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <img id="blah" src="http://placehold.it/180" alt="official image"
                                            class="w-25 h-25 rounded-circle offical_image_close" />
                                        <div class="ml-2">
                                            <p class="my-0" id="offical_name_close">Official Name</p>
                                            <p class="my-0" id="offical_designation_close">Designation</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <img id="blah" src="http://placehold.it/180" alt="driver image"
                                            class="w-25 h-25 rounded-circle driver_image_close" />
                                        <div class="ml-2">
                                            <p class="my-0" id="driver_name_close">Driver Name</p>
                                            <p class="my-0" id="driver_designation_close">Designation</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="model-hr">

                            <!-- Purchase Order, Work Order, and Fuel Slip Links -->
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <h5>PO#</h5>
                                    <a target="_blank"
                                        href="{{ route('purchase-orders.show', ['id' => $trip->purchase_order_id, 'status' => 'COMPARATIVEAPPROVED']) }}"
                                        style="color: #337ab7">PO#: {{ $trip->purchase_order_id }}</a>
                                </div>
                                <div class="col-md-4">
                                    <h5>WO#</h5>
                                    <a target="_blank"
                                        href="{{ route('work-orders.show', ['id' => $trip->work_order_id]) }}"
                                        style="color: #337ab7">WO#: {{ $trip->work_order_id }}</a>
                                </div>
                                <div class="col-md-4">
                                    <h5>Fuel Slip#</h5>
                                    <a target="_blank" href="{{ route('fuels.show', ['id' => $trip->fuel_slip_id]) }}"
                                        style="color: #337ab7">FS#: {{ $trip->fuel_slip_id }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="model-hr">

                    <!-- Trip Details: Origin, Destination, Date, and Meter Reading -->
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label>Origin</label>
                            <h5 id="origin_close"><small><strong>{{ optional($trip->origin)->name }}</strong></small>
                            </h5>
                            <label>Destination</label>
                            <h5 id="destination_close">
                                <small><strong>{{ optional($trip->destination)->name }}</strong></small></h5>
                        </div>
                        <div class="col-md-4">
                            <label>Date & Time Out</label>
                            <h5 id="exit_datetime_close">
                                <small><strong>{{ Carbon\Carbon::parse($trip->exit_datetime_out)->toDateString() }}</strong></small>
                            </h5>
                            <label>Meter Reading</label>
                            <h5 id="exit_meetr_reading_close">
                                <small><strong>{{ $trip->exit_meetr_reading }}</strong></small></h5>
                        </div>
                        <div class="col-md-4">
                            <label>Attached Documents</label><br>
                            <i class="fa fa-file fa-xl"></i><i class="fa-regular fa-file fa-xl"></i>
                        </div>
                    </div>

                    <hr class="model-hr">

                    <!-- Notes and Additional Information -->
                    <div class="form-group mb-2">
                        <label for="Notes">Notes</label>
                        <textarea name="" id="notes_close" cols="10" rows="2" class="form-control" disabled
                            placeholder="Notes are here"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <input type="datetime-local" class="form-control" id="return_date_time"
                                name="return_date_time" placeholder="Return Date & Time">
                        </div>

                        <div class="col-md-4">
                            <input type="number" class="form-control" name="return_mtr_reading"
                                id="return_mtr_reading" placeholder="Return Meter Reading">
                        </div>

                        <div class="col-md-4">
                            <input type="file" multiple class="form-control-file form-control chooser"
                                name="attachments[]" id="close_attachment">
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="result">Additional Notes</label>
                        <a onclick="startConverting();" class="btn btn-danger btn-sm"><i class="fa fa-microphone"
                                aria-hidden="true"></i></a>
                        <textarea name="notes" id="result" cols="10" rows="2" class="form-control"
                            placeholder="Please write notes here"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="tripCloseFormBtn">Close</button>
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
</script>
