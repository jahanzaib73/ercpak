<div class="modal fade" id="editTripLabel" aria-labelledby="editTripLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content" style="width: 150%">
            {{-- <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="editTripLabel"><strong>Update Trip</strong></h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <form id="trip_edit_form" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="{{ $trip->id }}">
                <div class="modal-body mb-0">
                    <div class="row mb-2 align-items-center">
                        <div class="col-4">
                            <h3 class="modal-title" id="editTripLabel"><strong>Update Trip</strong></h3>
                             {{-- <h6 for="vehicle_id_edit" class="light-dark">Vehicle</h6> --}}
                             <select name="vehicle_id" id="vehicle_id_edit"
                             class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                             <option value="">Choose...</option>
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
                                <img id="blah" width="200" height="120" class="vehile_image trip_image"
                                    src="http://placehold.it/180" alt="image not found" />
                            </div>
                        </div>

                        {{-- <div class="col-12 col-md-6 text-right">
                            <div>
                                <img id="blah" width="180" height="180" class="vehile_image trip_image"
                                    src="http://placehold.it/180" alt="your image" />
                                <div>
                                    <h3 id="vehicle_number">XX-XXXX</h3>
                                    <h6 id="vehicle_model">XXXXX</h6>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <hr class="model-hr">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 for="driver_id_edit" class="light-dark">Driver</h6> --}}
                            <select name="driver_id" id="driver_id_edit" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            <div class="d-flex justify-content-around align-items-center pt-3">
                                <img id="blah" src="http://placehold.it/180" alt="your image"
                                    class="w-25 h-25 rounded-circle driver_image" />
                                <div>
                                    <p class="my-0" id="driver_name">Name</p>
                                    <p class="my-0" id="driver_designation">Designation</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark" for="official_id_edit">Official</h6> --}}
                            <select name="official_id" id="official_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Choose...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            <div class="d-flex justify-content-around align-items-center pt-3">
                                <img id="blah" src="http://placehold.it/180" alt="your image"
                                    class="w-25 h-25 rounded-circle official_image" />
                                <div>
                                    <p class="my-0" id="official_name">Official Name</p>
                                    <p class="my-0" id="official_designation">Designation</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark" for="cost_center_id_edit">Cost Center</h6> --}}
                            <select name="cost_center_id" id="cost_center_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Choose...</option>
                                @foreach ($costCenters as $cost)
                                    <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            {{-- <h6 class="light-dark" for="origin_id">Origin</h6> --}}
                            <input type="text" class="form-control autocomplete" name="origin" value="{{ $trip->origin }}" id="origin">
                        </div>
                        <div class="col-md-6">
                            {{-- <h6 class="light-dark" for="distination_id">Destination</h6> --}}
                            <input type="text" class="form-control autocomplete" name="destination" value="{{ $trip->destination }}" id="destination">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark" for="purchase_order_id_edit">Purchase Order</h6> --}}
                            <select name="purchase_order_id" id="purchase_order_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Purchase Order</option>
                                @foreach ($purchaseOrder as $po)
                                    <option value="{{ $po->id }}">{{ $po->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark" for="work_order_id_edit">Work Order</h6> --}}
                            <select name="work_order_id" id="work_order_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Work Order</option>
                                @foreach ($workorders as $wo)
                                    <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark" for="fuel_slip_id_edit">Fuel Slip</h6> --}}
                            <select name="fuel_slip_id" id="fuel_slip_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Fuel Slip</option>
                                @foreach ($fuelSlip as $fs)
                                    <option value="{{ $fs->id }}">{{ $fs->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Date Time Out</h6> --}}
                            <input name="exit_datetime" type="datetime-local" class="form-control"
                                id="exit_datetime_edit">
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Exit Meeter Reading</h6> --}}
                            <input name="exit_meetr_reading" type="text" class="form-control"
                                id="exit_meetr_reading_edit" placeholder="26536">
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Uploads Decument</h6> --}}
                            <input name="atachments[]" type="file" class="form-control chooser" id="atachments_edit"
                                multiple>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label for="notes">Trips Details</label>
                        <textarea name="notes" id="notes_edit" cols="10" rows="3" class="form-control"
                            placeholder="Please write notes here"></textarea>
                    </div>


                </div>

                <div class="d-flex justify-content-end mr-3 mb-2">

                    <button type="button" class="btn cancel-btn mr-2" data-dismiss="modal"
                        aria-label="Close">Cancel</button>

                    <button type="button" id="tripUpdate" class="btn save-btn ">Update</button>

                </div>

            </form>
        </div>

    </div>
</div>
