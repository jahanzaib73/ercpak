<div class="modal fade" id="addVehicle" aria-labelledby="addVehicleLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content" style="width: 150%">
            {{-- <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="addVehicleLabel"><strong>Add Vehicle</strong></h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <form id="vehicle_add_form" enctype="multipart/form-data">
                <div class="modal-body pb-0">
                    <div class="row mb-2 align-items-center">
                        <div class="col-8">
                            <h3 for="vehicle_id" class="light-dark vehicle-heading mb-1">Vehicle</h3>
                            <input type="text" class="form-control" name="vehicle_number" id="vehicle_number"
                                placeholder="ABC-1234">
                        </div>
                        <div class="form-group col-4 text-right">
                            <button type="button" class="close modalclose-btn px-2 py-1" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">�</span>
                            </button>
                            <img width="200" height="120" id="blah" class="pb-1 vehicle_image"
                                src="http://placehold.it/180" alt="your image" />
                            <input id="vehicle_image_input" name="file" type='file' onchange="readURL(this);"
                                style="display: none" />
                        
                                
                            </div>


                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 for="vehicle_make_id" class="light-dark">Make</h6> --}}
                            <select name="vehicle_make_id" id="vehicle_make_id"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Choose Vehicle</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Model</h6> --}}
                            <select name="vehicle_model_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose Model</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Type</h6> --}}
                            <select name="vehicle_type_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Color</h6> --}}
                            <input name="color" type="text" class="form-control" id="color"
                                placeholder="Choose Colour">
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Engine #</h6> --}}
                            <input name="engine_number" type="text" class="form-control" id="engine_number"
                                placeholder="Choose Colour">
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Chassis #</h6> --}}
                            <input name="chassis_number" type="text" class="form-control" id="chassis_number"
                                placeholder="Choose Colour">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Fuel Type</h6> --}}
                            <select name="fuel_type_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose...</option>
                                @foreach ($fuelTypes as $fuel)
                                    <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Year</h6> --}}
                            <input name="year" type="year" class="form-control" id="year#" placeholder="2020">
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Owner</h6> --}}
                            <select name="owner_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                {{-- <option value="">Choose...</option> --}}
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Base Mtr Reading</h6> --}}
                            <input name="base_meter_reading" type="text" class="form-control"
                                id="base_meter_reading" placeholder="123456789">
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Current Mtr Reading</h6> --}}
                            <input name="current_meter_reading" type="text" class="form-control"
                                id="current_meter_reading" placeholder="123456789">
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Department</h6> --}}
                            <select name="department_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose...</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            {{-- <h6 class="light-dark">Location</h6> --}}
                            <select name="location_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Search Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            {{-- <h6 class="light-dark">Status</h6> --}}
                            <select name="status" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Availablity...</option>
                                <option value="{{ App\Models\Vehicle::AVAILABLE }}">AVAILABLE</option>
                                <option value="{{ App\Models\Vehicle::UNAVAILABLE }}">UNAVAILABLE</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h6 class="light-dark">Password</h6>
                            <input name="password" type="password" class="form-control"
                                id="password" placeholder="********">
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="notes">Notes</label>
                        <a onclick="startConverting();"><i class="fa fa-microphone btn"
                            style="background-color:#a80000; color:#fff;" aria-hidden="true"></i></a>
                        <textarea name="notes" id="notes" cols="10" rows="2" class="form-control"
                            placeholder="Please write notes here"></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end mb-3 mr-3">
                    <button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button type="submit" class="btn save-btn btns-w">Save</button>
                </div> --}}

                <div class="row mb-2 align-items-center">
                    <div class="col-9">
                        <div class="form-group">
                            <label for="Notes">Notes</label>
                            <a onclick="startConverting();"><i class="fa fa-microphone btn" style="background-color:#a80000; color:#fff;" aria-hidden="true"></i></a>
                            <textarea name="notes" id="Notes" cols="10" rows="3" class="form-control" placeholder=""></textarea>
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
