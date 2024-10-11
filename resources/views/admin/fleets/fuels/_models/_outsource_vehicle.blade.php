<!-- Modal -->
<div class="modal fade" id="outsource" aria-labelledby="outsourceLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 150%; margin-left: -8px;">
            {{-- <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="outsourceLabel">Outsource Vehicle Entry</h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                <h2 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Outsource Vehicle Entry</strong></h2>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="outsourceVehicleForm">
                <input type="hidden" name="is_outsource" value="1">

                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            {{-- <label for="vehicle_number">Vehicle #</label> --}}
                            <input type="text" class="form-control" name="vehicle_number" id="vehicle_number"
                                placeholder="ABC-1234">
                        </div>
                        <div class="col-md-6 text-right">
                            <input name="file" id="vehicle_image_input" class="d-none" type='file'
                                onchange="readURL(this);" />
                            <img id="blah" width="180" height="100" class="vehicle_image" src="http://placehold.it/180"
                                alt="your image" />
                        </div>

                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            {{-- <h6 for="vehicle_make_id" class="light-dark">Make</h6> --}}
                            <select name="vehicle_make_id" id="vehicle_make_id"
                                class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                <option value="">Make</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Model</h6> --}}
                            <select name="vehicle_model_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Model</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Type</h6> --}}
                            <select name="vehicle_type_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            {{-- <h6 class="light-dark">Fuel Type</h6> --}}
                            <select name="fuel_type_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Fuel Type</option>
                                @foreach ($fuelTypes as $fuel)
                                    <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            {{-- <h6 class="light-dark">Owner</h6> --}}
                            <select name="owner_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Owner.</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn cancel-btn" data-dismiss="modal">Close</button>
                    <button type="button" id="outsourceVehiclebtn" value="Submit" class="btn save-btn">Save
                        changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
