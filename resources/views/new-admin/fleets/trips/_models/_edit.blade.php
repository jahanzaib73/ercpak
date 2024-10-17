<div class="modal fade" id="editTripLabel" tabindex="-1" aria-labelledby="editTripLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1" id="editTripLabel">Update Trip</h1>
                    <p>Please update the details below.</p>
                </div>
                <form id="trip_edit_form" class="row gy-1 pt-75" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="{{ $trip->id }}">

                    <!-- Vehicle Selection Row -->
                    <div class="row mb-2 align-items-center">
                        <div class="col-md-4">
                            <label for="vehicle_id_edit" class="form-label">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id_edit" class="form-control select2 custom-select">
                                <option value="">Choose...</option>
                                @foreach ($vheicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="text-right">
                                <h4 class="mb-1" id="vehicle_number">XX-XXXX</h4>
                                <h6 class="mb-0" id="vehicle_model">XXXXX</h6>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="d-flex justify-content-end">
                                <img id="blah" width="200" height="120" class="vehile_image img-fluid"
                                    src="http://placehold.it/180" alt="image not found" />
                            </div>
                        </div>
                    </div>

                    <hr class="model-hr">

                    <!-- Driver, Official, and Cost Center Selection -->
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="driver_id_edit" class="form-label">Driver</label>
                            <select name="driver_id" id="driver_id_edit" class="form-control select2 custom-select">
                                <option value="">Choose...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            <div class="d-flex align-items-center pt-3">
                                <img src="http://placehold.it/180" alt="driver image"
                                    class="w-25 h-25 rounded-circle driver_image" />
                                <div class="ml-2">
                                    <p class="my-0" id="driver_name">Name</p>
                                    <p class="my-0" id="driver_designation">Designation</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="official_id_edit" class="form-label">Official</label>
                            <select name="official_id" id="official_id_edit" class="form-control select2 custom-select">
                                <option value="">Choose...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            <div class="d-flex align-items-center pt-3">
                                <img src="http://placehold.it/180" alt="official image"
                                    class="w-25 h-25 rounded-circle official_image" />
                                <div class="ml-2">
                                    <p class="my-0" id="official_name">Official Name</p>
                                    <p class="my-0" id="official_designation">Designation</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="cost_center_id_edit" class="form-label">Cost Center</label>
                            <select name="cost_center_id" id="cost_center_id_edit"
                                class="form-control select2 custom-select">
                                <option value="">Choose...</option>
                                @foreach ($costCenters as $cost)
                                    <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Origin and Destination Inputs -->
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="origin" class="form-label">Origin</label>
                            <input type="text" class="form-control" name="origin" value="{{ $trip->origin }}"
                                id="origin">
                        </div>
                        <div class="col-md-6">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control" name="destination"
                                value="{{ $trip->destination }}" id="destination">
                        </div>
                    </div>

                    <!-- Purchase Order, Work Order, and Fuel Slip Selection -->
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="purchase_order_id_edit" class="form-label">Purchase Order</label>
                            <select name="purchase_order_id" id="purchase_order_id_edit"
                                class="form-control select2 custom-select">
                                <option value="">Purchase Order</option>
                                @foreach ($purchaseOrder as $po)
                                    <option value="{{ $po->id }}">{{ $po->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="work_order_id_edit" class="form-label">Work Order</label>
                            <select name="work_order_id" id="work_order_id_edit"
                                class="form-control select2 custom-select">
                                <option value="">Work Order</option>
                                @foreach ($workorders as $wo)
                                    <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="fuel_slip_id_edit" class="form-label">Fuel Slip</label>
                            <select name="fuel_slip_id" id="fuel_slip_id_edit"
                                class="form-control select2 custom-select">
                                <option value="">Fuel Slip</option>
                                @foreach ($fuelSlip as $fs)
                                    <option value="{{ $fs->id }}">{{ $fs->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Date Time Out, Meter Reading, and File Upload -->
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="exit_datetime_edit" class="form-label">Date & Time Out</label>
                            <input name="exit_datetime" type="datetime-local" class="form-control"
                                id="exit_datetime_edit">
                        </div>
                        <div class="col-md-4">
                            <label for="exit_meetr_reading_edit" class="form-label">Exit Meter Reading</label>
                            <input name="exit_meetr_reading" type="text" class="form-control"
                                id="exit_meetr_reading_edit" placeholder="26536">
                        </div>
                        <div class="col-md-4">
                            <label for="atachments_edit" class="form-label">Upload Documents</label>
                            <input name="atachments[]" type="file" class="form-control chooser"
                                id="atachments_edit" multiple>
                        </div>
                    </div>

                    <!-- Trip Details Textarea -->
                    <div class="form-group mb-0">
                        <label for="notes_edit">Trip Details</label>
                        <textarea name="notes" id="notes_edit" cols="10" rows="3" class="form-control"
                            placeholder="Please write notes here"></textarea>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" id="tripUpdate" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
