
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="modal fade" id="tripclose" aria-labelledby="tripLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 150%">
            {{-- <div class="modal-header py-0 " style="border-bottom: none">
                <h2 class="modal-title pt-1" id="tripLabel">Close Trip</h2>
                <button type="button" class="close bg-white modalclose-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <form id="tripCloseFormId">
                <input type="hidden" name="trip_id" id="trip_id">
                <div class="modal-body pb-0">
                    <div class="form-row">
                        <div class="col-12 col-md-4">
                            <h3 class="modal-title pb-1" id="tripLabel">Close Trip</h3>
                            <div class="d-block justify-content-around">
                                <div>
                                    <img id="blah" src="http://placehold.it/180" alt="your image"
                                        class="vehicle_image_close" width="200" height="100" />
                                </div>
                                <div>
                                    <h3 id="vehicle_number_close">AC-1234</h3>
                                    <h6 id="vehicle_model_close">Vehicle Model</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex justify-content-around align-items-center pt-3">
                                        <img id="blah" src="http://placehold.it/180" alt="your image"
                                            class="w-25 h-25 rounded-circle offical_image_close" />
                                        <div>
                                            <p class="my-0" id="offical_name_close">Official Name</p>
                                            <p class="my-0" id="offical_designation_close">Designation</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-around align-items-center pt-3">
                                        <img id="blah" src="http://placehold.it/180" alt="your image"
                                            class="w-25 h-25 rounded-circle driver_image_close" />
                                        <div>
                                            <p class="my-0" id="driver_name_close">Driver Name</p>
                                            <p class="my-0" id="driver_designation_close">Designation</p>
                                        </div>
                                    </div>
                                    <button type="button" class="close bg-white modalclose-btn px-2 py-1" data-dismiss="modal" aria-label="Close" style="bottom:104px; left:30px;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <hr style="margin-block: 2px">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group mb-1">
                                        <h5>POs</h5>
                                        <a target="_blank"
                                href="{{ route('purchase-orders.show', ['id' => $trip->purchase_order_id, 'status' => 'COMPARATIVEAPPROVED']) }}"
                                style="color: #337ab7">PO#: {{ $trip->purchase_order_id }}</a>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-1">
                                        <div>
                                            <h5>WOs</h5>
                                <a target="_blank" href="{{ route('work-orders.show', ['id' => $trip->work_order_id]) }}"
                                    style="color: #337ab7">WO#: {{ $trip->work_order_id }}</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group mb-1">
                                        <h5>Fuel Slips</h5>
                                        <a target="_blank" href="{{ route('fuels.show', ['id' => $trip->fuel_slip_id]) }}"
                                style="color: #337ab7">FS#:
                                {{ $trip->fuel_slip_id }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr style="margin-block: 2px">


                    <div class="form-row">
                        <div class="col-4">
                            <div>
                                <label>Origin</label>
                                <h5 id="origin_close"><small><strong>{{ optional($trip->origin)->name }}</strong></small></h5>
                            </div>
                            <div>
                                <label>Destination</label>
                                <h5 id="destination_close"><small><strong>{{ optional($trip->destination)->name }}</strong></small></h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <label>Date & Time Out</label>
                                <h5 id="exit_datetime_close"><small><strong>{{ Carbon\Carbon::parse($trip->exit_datetime_out)->toDateString() }}</strong></small></h5>
                            </div>

                            <div>
                                <label>Meter Reading</label>
                                <h5 id="exit_meetr_reading_close"><small><strong>{{ $trip->exit_meetr_reading }}</strong></small></h5>

                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <label>Attached Documents</label><br>
                                <i class="fa fa-file fa-xl"></i><i class="fa-regular fa-file fa-xl"></i>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-block: 2px;">
                    <div class="form-group mb-2">
                        <label for="Notes">Notes</label>
                        <textarea name="" id="notes_close" cols="10" rows="2" class="form-control" disabled id="notes"
                            placeholder="Notes are here"></textarea>
                    </div>

                    {{-- <hr style="margin-block: 2px;"> --}}
                    <div class="alert alert-danger d-none alert_content" role="alert">
                        <p id="alert_content"></p>
                    </div>
                    <div class="form-row">
                        <div class="form-group mb-1 col-6 col-md-4">
                            {{-- <label for="return_date_time">Date & Time Out</label> --}}
                            <input type="datetime-local" class="form-control" id="return_date_time"
                                name="return_date_time">
                        </div>

                        <div class="form-group mb-1 col-6 col-md-3">
                            {{-- <label for="return_mtr_reading">Meter Reading</label> --}}
                            <input type="number" class="form-control" name="return_mtr_reading"
                                id="return_mtr_reading" placeholder="{{ $trip->exit_meetr_reading }}" style="height: 40px">
                        </div>
                        <div class="col-12 col-md-5 d-flex justify-content-end">
                            <form>
                                <div class="form-group mb-1">
                                    {{-- <label for="close_attachment">Upload Documents</label> --}}
                                    <input type="file" multiple class="form-control-file form-control chooser" name="attachments[]"
                                        id="close_attachment" style="height: 40px">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="result">Notes</label>
                        <a onclick="startConverting();"><i class="fa fa-microphone btn btn-danger" aria-hidden="true"></i></a>
                        <textarea name="notes" id="result" cols="10" rows="2" class="form-control " id="notes"
                            placeholder="Please write notes here"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mr-3 mb-2">

                    <button type="submit" class="btn cancel-btn mr-2" data-dismiss="modal"
                        aria-label="Close">Cancel</button>

                    <button type="button" class="btn save-btn " id="tripCloseFormBtn">Close</button>

                </div>

            </form>
        </div>
    </div>
</div>

<script>

		var result = document.getElementById('result');
  
  function startConverting () {

  if('webkitSpeechRecognition' in window) {
      var speechRecognizer = new webkitSpeechRecognition();
      speechRecognizer.continuous = true;
      speechRecognizer.interimResults = true;
      speechRecognizer.lang = 'en-US';
      speechRecognizer.start();

      var finalTranscripts = '';

      speechRecognizer.onresult = function(event) {
          var interimTranscripts = '';
          for(var i = event.resultIndex; i < event.results.length; i++){
              var transcript = event.results[i][0].transcript;
              transcript.replace("\n", "<br>");
              if(event.results[i].isFinal) {
                  finalTranscripts += transcript;
              }else{
                  interimTranscripts += transcript;
              }
          }
          result.innerHTML = finalTranscripts + '' + interimTranscripts + '';
      };
      speechRecognizer.onerror = function (event) {

      };
  }else {
      result.innerHTML = 'Your browser is not supported. Please download Google chrome or Update your Google chrome!!';
  }	
  }
</script>