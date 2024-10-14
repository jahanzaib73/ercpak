<!-- Modal -->
<div class="modal fade" id="outsource" aria-labelledby="outsourceLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1" id="addTripLabel">Outsource Vehicle
                        Entry</h1>
                    <p>Please fill in the details below.</p>
                </div>
                <form id="outsourceVehicleForm">
                    <input type="hidden" name="is_outsource" value="1">
                    <div class="modal-body">
                        <!-- Vehicle Number and Image Upload -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="vehicle_number" class="form-label">Vehicle #</label>
                                <input type="text" class="form-control" name="vehicle_number" id="vehicle_number"
                                    placeholder="ABC-1234">
                            </div>
                            <div class="col-md-6 text-right">
                                <input name="file" id="vehicle_image_input" class="d-none" type='file'
                                    onchange="readURL(this);" />
                                <img id="blah" width="180" height="100" class="vehicle_image"
                                    src="http://placehold.it/180" alt="your image" />
                            </div>
                        </div>

                        <!-- Vehicle Make, Model, and Type -->
                        <div class="row">
                            <div class="col-md-4">
                                <label for="vehicle_make_id" class="form-label">Make</label>
                                <select name="vehicle_make_id" id="vehicle_make_id"
                                    class="select2 form-control custom-select">
                                    <option value="">Select Make</option>
                                    @foreach ($makes as $make)
                                        <option value="{{ $make->id }}">{{ $make->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="vehicle_model_id" class="form-label">Model</label>
                                <select name="vehicle_model_id" id="vehicle_model_id"
                                    class="select2 form-control custom-select">
                                    <option value="">Select Model</option>
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="vehicle_type_id" class="form-label">Type</label>
                                <select name="vehicle_type_id" id="vehicle_type_id"
                                    class="select2 form-control custom-select">
                                    <option value="">Select Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Fuel Type and Owner Selection -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fuel_type_id" class="form-label">Fuel Type</label>
                                <select name="fuel_type_id" id="fuel_type_id"
                                    class="select2 form-control custom-select">
                                    <option value="">Select Fuel Type</option>
                                    @foreach ($fuelTypes as $fuel)
                                        <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="owner_id" class="form-label">Owner</label>
                                <select name="owner_id" id="owner_id" class="select2 form-control custom-select">
                                    <option value="">Select Owner</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer with Action Buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="outsourceVehiclebtn" value="Submit" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
