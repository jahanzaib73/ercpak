<div class="modal fade" id="addFuelLabel" tabindex="-1" aria-labelledby="addFuelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-content">
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1" id="addTripLabel">Add Trip</h1>
                        <p>Please fill in the details below.</p>
                    </div>
                    <form class="row gy-1 pt-75" id="fuel_add_form" enctype="multipart/form-data">
                        <div class="row mb-2 mt-3">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="trip_id" class="form-label">Trip</label>
                                        <select name="trip_id" id="trip_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Trip</option>
                                            @foreach ($trips as $trip)
                                                <option data-type="trip" value="{{ $trip->id }}">{{ $trip->id }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <h6 class="mt-2 light-dark">OR</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="vehicle_id" class="form-label">Vehicle</label>
                                        <select name="vehicle_id" id="vehicle_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Vehicle</option>
                                            @foreach ($vheicles as $vehicle)
                                                <option data-type="vehicle" value="{{ $vehicle->id }}">
                                                    {{ $vehicle->vehicle_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <h6 class="mt-2 light-dark">OR</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="" data-toggle="modal" data-target="#outsource"
                                            class="btn btn-primary btn-sm">Outsource Vehicle</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 pt-2 text-center">
                                <div>
                                    <h3 id="fuel_vehicle_number">XX-XXXX</h3>
                                    <h6 id="fuel_vehicle_model">XXXXX</h6>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-end">
                                    <img id="blah" width="200" height="200" class="vehicle_image img-fluid"
                                        src="http://placehold.it/180" alt="your image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label for="driver_id" class="form-label">Driver</label>
                                        <select name="driver_id" id="driver_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Driver</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="d-flex justify-content-around align-items-center pt-3">
                                            <img id="blah" src="http://placehold.it/180" alt="your image"
                                                class="w-25 h-25 rounded-circle driver_image img-fluid" />
                                            <div>
                                                <p class="my-0" id="driver_name">Name</p>
                                                <p class="my-0" id="driver_designation">Designation</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="official_id" class="form-label">Official</label>
                                        <select name="official_id" id="official_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Official</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="d-flex justify-content-around align-items-center pt-3">
                                            <img id="blah" src="http://placehold.it/180" alt="your image"
                                                class="w-25 h-25 rounded-circle official_image img-fluid" />
                                            <div>
                                                <p class="my-0" id="official_name">Official Name</p>
                                                <p class="my-0" id="official_designation">Designation</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="cost_center_id" class="form-label">Cost Center</label>
                                        <select name="cost_center_id" id="cost_center_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Cost Center</option>
                                            @foreach ($costCenters as $cost)
                                                <option value="{{ $cost->id }}">{{ $cost->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label for="purchase_order_id" class="form-label">Purchase Order</label>
                                        <select name="purchase_order_id" id="purchase_order_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Purchase Order</option>
                                            @foreach ($purchaseOrder as $po)
                                                <option value="{{ $po->id }}">{{ $po->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="work_order_id" class="form-label">Work Order</label>
                                        <select name="work_order_id" id="work_order_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Work Order</option>
                                            @foreach ($workorders as $wo)
                                                <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label for="exit_datetime" class="form-label">Date & Time</label>
                                        <input name="exit_datetime" type="datetime-local" class="form-control"
                                            id="exit_datetime" placeholder="Date & Time">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="fuel_tank_id" class="form-label">Fuel Tank</label>
                                        <select name="fuel_tank_id" id="fuel_tank_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Fuel Tank</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="fuel_type_id" class="form-label">Fuel Type</label>
                                        <select name="fuel_type_id" id="fuel_type_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Fuel Type</option>
                                            @foreach ($fuelTypes as $fuelType)
                                                <option value="{{ $fuelType->id }}">{{ $fuelType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="alert alert-danger d-none alert_content_fuel" role="alert">
                                    <p id="alert_content_fuel"></p>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="price" class="form-label">Price</label>
                                        <input name="price" type="number" class="form-control" id="price"
                                            placeholder="Price">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="atachments" class="form-label">Upload Document</label>
                                        <input name="atachments[]" type="file" class="form-control"
                                            id="atachments" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-2">
                                    <div>
                                        <label for="fuel_man_id" class="form-label">Fuel Man</label>
                                        <select name="fuel_man_id" id="fuel_man_id"
                                            class="form-control select2 mb-3 custom-select"
                                            style="width: 100%; height:36px;">
                                            <option value="">Fuel Man</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="my-3">
                                        <label for="qty" class="form-label">QTY</label>
                                        <input name="qty" type="number" class="form-control" id="qty"
                                            placeholder="QTY">
                                    </div>
                                    <div>
                                        <label for="vehicle_meter_reading" class="form-label">Meter Reading</label>
                                        <input name="vehicle_meter_reading" type="number" class="form-control"
                                            id="vehicle_meter_reading" placeholder="Meter Reading">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3 mt-2 align-items-center">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="notes" class="form-label">Trip Details</label>
                                    <a onclick="startConverting();" class="btn btn-danger"><i
                                            class="fa fa-microphone" aria-hidden="true"></i></a>
                                    <textarea name="notes" id="result" cols="10" rows="3" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="btn-box mt-3">
                                    <button type="submit" id="submitFormButton"
                                        class="btn btn-primary w-100 mb-3">Save</button>
                                    <button type="button" class="btn btn-outline-secondary w-100"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
