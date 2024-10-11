<div class="modal fade" id="editVehicle" aria-labelledby="editVehicleLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 150%">
            <div class="modal-header bottom-border p-1">
                <h3 class="modal-title ml-2 text-dark" id="editVehicleLabel"><strong>Update Vehicle</strong></h3>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="vehicle_edit_form">
                <input type="hidden" name="id" value="{{ $vehicle->id }}">
                <div class="modal-body">
                    <div class="form-row mb-2">
                        <div class="form-group col-md-8">
                            {{-- <label for="vehicle_number">Vehicle #</label> --}}
                            <input type="text" class="form-control" name="vehicle_number" id="vehicle_number_edit"
                                placeholder="ABC-1234">
                        </div>
                        <div class="form-group col-md-4 text-right">
                            <img width="180" height="120" id="blah" class="pb-1 vehicle_image image_edit"
                                src="http://placehold.it/180" alt="your image" />
                            <input id="vehicle_image_input" type='file' onchange="readURL(this);"
                                style="display: none" />
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 for="vehicle_make_id_edit" class="light-dark">Make</h6> --}}
                            <select name="vehicle_make_id" id="vehicle_make_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Make</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Model</h6> --}}
                            <select name="vehicle_model_id" id="vehicle_model_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Model</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Type</h6> --}}
                            <select name="vehicle_type_id" id="type_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Color</h6> --}}
                            <input name="color" type="text" class="form-control" id="color_edit"
                                placeholder="White">
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Engine #</h6> --}}
                            <input name="engine_number" type="text" class="form-control" id="engine_edit"
                                placeholder="engine number">
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Chassis #</h6> --}}
                            <input name="chassis_number" type="text" class="form-control" id="chassis_edit"
                                placeholder="chassis number">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Fuel Type</h6> --}}
                            <select name="fuel_type_id" id="fuel_type_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Fuel Type</option>
                                @foreach ($fuelTypes as $fuel)
                                    <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Year</h6> --}}
                            <input name="year" type="date" class="form-control" id="year_edit"
                                placeholder="2020">
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Owner</h6> --}}
                            <select name="owner_id" id="owner_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Owner</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Current Mtr</h6> --}}
                            <input name="current_meter_reading" type="text" class="form-control"
                                id="meter_reading_edit" placeholder="2020">
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Department</h6> --}}
                            <select name="department_id" id="department_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Location</h6> --}}
                            <select name="location_id" id="location_id_edit"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">

                        <div class="col-md-12">
                            {{-- <h6 class="light-dark">Status</h6> --}}
                            <select name="status" id="status_edit" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option selected>Status</option>
                                <option value="{{ App\Models\Vehicle::AVAILABLE }}">AVAILABLE</option>
                                <option value="{{ App\Models\Vehicle::UNAVAILABLE }}">UNAVAILABLE</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-2 align-items-center">
                        <div class="col-9"><grammarly-extension data-grammarly-shadow-root="true" class="dnXmp" style="position: absolute; top: 0px; left: 0px; pointer-events: none;"></grammarly-extension><grammarly-extension data-grammarly-shadow-root="true" class="dnXmp" style="position: absolute; top: 0px; left: 0px; pointer-events: none;"></grammarly-extension>
                            <div class="form-group">
                                <label for="Notes">Notes</label>
                                <a onclick="startConverting();"><i class="fa fa-microphone btn" style="background-color:#a80000; color:#fff;" aria-hidden="true"></i></a>
                                <textarea name="notes" id="Notes" cols="10" rows="3" class="form-control" placeholder="" spellcheck="false"></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="btn-box mt-3">
                                <div>
                                    <button type="button" id="submitFormButton" class="btn save-btn w-100">Save</button>
                                </div>
    
                                <div>
                                    <button type="button" class="btn btn-sm cancel-btn mt-3 w-100" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

            </form>
        </div>

    </div>
</div>
