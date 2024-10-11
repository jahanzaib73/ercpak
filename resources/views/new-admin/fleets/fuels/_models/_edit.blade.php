<div class="modal fade" id="editFuelLabel" aria-labelledby="editFuelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content" style="width: 150%">
            {{-- <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="editFuelLabel"><strong>Fuel Entry</strong></h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <form id="fuel_edit_form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{ $fuel->id }}">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <h3 class="modal-title" id="editFuelLabel"><strong>Fuel Entry</strong></h3>
                            <div>
                                {{-- <h6 for="trip_id" class="light-dark">Trip</h6> --}}
                                <select name="trip_id" id="trip_id"
                                    class="select2 form-control mb-3 custom-select trip_id"
                                    style="width: 100%; height:36px;">
                                    <option value="">Trip...</option>
                                    @foreach ($trips as $trip)
                                        <option data-type="trip" value="{{ $trip->id }}">{{ $trip->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <h6 class="mt-2 light-dark">OR</h6>
                            <div>
                                {{-- <h6 for="vehicle_id" class="light-dark">Vehicle</h6> --}}
                                <select name="vehicle_id" id="vehicle_id"
                                    class="select2 form-control mb-3 custom-select vehicle_id"
                                    style="width: 100%; height:36px;">
                                    <option value="">Vehicle...</option>
                                    @foreach ($vheicles as $vehicle)
                                        <option data-type="vehicle" value="{{ $vehicle->id }}">
                                            {{ $vehicle->vehicle_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <h6 class="mt-2 light-dark">OR</h6>
                            <div>
                                <a href="" data-toggle="modal" data-target="#outsource"
                                    class="btn save-btn btn-sm">Outsource Vehicle</a>
                            </div>

                        </div>
                        <div class="col-md-3 text-center">
                            <div class="pt-2">
                                <h3 id="fuel_vehicle_number">XX-XXXX</h3>
                                <h6 id="fuel_vehicle_model">XXXXX</h6>
                            </div>
                        </div>
                        <div class="col-md-5 pr-0">
                            <button type="button" class="close modalclose-btn rounded-xl px-2 py-1"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="d-flex justify-content-end">
                                <img id="blah" width="180" height="180" class="fuel_vehicle_image"
                                    src="http://placehold.it/180" alt="your image" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-9">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    {{-- <h6 for="driver_id" class="light-dark">Driver</h6> --}}
                                    <select name="driver_id" id="driver_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Driver...</option>
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
                                    {{-- <h6 class="light-dark" for="official_id">Official</h6> --}}
                                    <select name="official_id" id="official_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Official...</option>
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
                                    {{-- <h6 class="light-dark" for="cost_center_id">Cost Center</h6> --}}
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
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    {{-- <h6 class="light-dark" for="purchase_order_id">Purchase Order</h6> --}}
                                    <select name="purchase_order_id" id="purchase_order_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Purchase Order...</option>
                                        @foreach ($purchaseOrder as $po)
                                            <option value="{{ $po->id }}">{{ $po->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    {{-- <h6 class="light-dark" for="work_order_id">Work Order</h6> --}}
                                    <select name="work_order_id" id="work_order_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Work Order...</option>
                                        @foreach ($workorders as $wo)
                                            <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    {{-- <h6 class="light-dark">Date Time</h6> --}}
                                    <input name="exit_datetime" type="datetime-local" placeholder="Date Time"
                                        class="form-control" id="exit_datetime">
                                </div>
                                <div class="col-md-4">
                                    {{-- <h6 class="light-dark" for="fuel_tank_id">Fuel Tank</h6> --}}
                                    <select name="fuel_tank_id" id="fuel_tank_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Fuel Tank...</option>

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    {{-- <h6 class="light-dark" for="fuel_type_id">Fuel Type</h6> --}}
                                    <select name="fuel_type_id" id="fuel_type_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Fuel Type...</option>
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
                                <div class="col-md-4">
                                    {{-- <h6 class="light-dark">Price</h6> --}}
                                    <input name="price" type="number" placeholder="Price" class="form-control"
                                        id="price">
                                </div>
                                <div class="col-md-6">
                                    {{-- <h6 class="light-dark">Uploads Decument</h6> --}}
                                    <input name="atachments[]" type="file" placeholder="Uploads Decument"
                                        class="form-control chooser" id="atachments" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-2">
                                <div>
                                    {{-- <h6 class="light-dark" for="fuel_man_id">Fuel Man</h6> --}}
                                    <select name="fuel_man_id" id="fuel_man_id"
                                        class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Fuel Man...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-3">
                                    {{-- <h6 class="light-dark">QTY</h6> --}}
                                    <input name="qty" type="number" placeholder="QTY" class="form-control"
                                        id="qty">
                                </div>
                                <div>
                                    {{-- <h6 class="light-dark">Meter Reading</h6> --}}
                                    <input name="vehicle_meter_reading" type="number" placeholder="Meter Reading"
                                        class="form-control" id="vehicle_meter_reading">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 align-items-center">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="notes">Trip Details</label>
                                <textarea name="notes" id="notes" cols="10" rows="3" class="form-control"
                                    placeholder="Please write notes here"></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="btn-box mt-3">
                                <div>
                                    <button type="button" id="submitFormButton"
                                        class="btn save-btn w-100 mb-3">Save</button>
                                </div>
                                <div>
                                    <button type="button" class="btn cancel-btn w-100 btn-sm" data-dismiss="modal"
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
