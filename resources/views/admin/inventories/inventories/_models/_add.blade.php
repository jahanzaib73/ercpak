<div class="modal fade" id="addInventory" aria-labelledby="addInventoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content" style="width: 150%">
            {{-- <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="addInventoryLabel"><strong>Add Inventory</strong></h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add Inventory</strong></h3>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="inventory_add_form" enctype="multipart/form-data">
                <div class="modal-body">




                    <div class="form-row mb-2">
                        <div class="form-group col-md-8">
                            {{-- <label for="item_number">Item #</label> --}}
                            <input type="text" class="form-control" name="item_number" id="item_number"
                                placeholder="Item Number">
                        </div>
                        <div class="form-group col-md-4 text-right">
                            <img width="180" height="100" id="blah" class="pb-1 vehicle_image"
                                src="http://placehold.it/180" alt="your image" />
                            <input id="vehicle_image_input" name="file" type='file'
                                style="display: none" />
                        </div>

                    </div>
                    {{--  <div class="form-row text-center" style="margin-bottom: 50px;">
                        <div class="col-md-6">
                            <input type="hidden" name="captured_image" id="captured_image" value="">
                            <div id="upload-demo" style="width:300px;"></div>
                            <input type="file" style="margin-left: 24px;" id="upload" name="file">

                        </div>
                        <div class="col-md-6">
                            <div id="upload-demo-i" style="width: 400px; height: 400px; border: 1px solid #ccc; margin-bottom: 5px; background-color: #7f7f7f;"></div>
                            <button type="button" class="btn btn-success upload-result">View Photo</button>
                            <button type="button" class="btn btn-danger clear-result" style="display:none;">Clear
                                Photo
                            </button>
                        </div>
                    </div>  --}}
                    <div class="form-row mb-2">
                        <div class="form-group col-md-4">
                            {{-- <label for="inventory_type">Select Inventory Type</label> --}}
                            <select name="inventory_type" id="inventory_type"
                                class="select2 form-control mb-3 custom-select inventory_type_select"
                                style="width: 100%; height:36px;">
                                <option value="0">Inventoy</option>
                                <option value="1">ASSET</option>
                                <option value="2">Fuel</option>

                            </select>
                        </div>
                        <div class="form-group col-md-4 fuel_container  d-none">
                            {{-- <label for="fuel_type_id">Select Fuel Type</label> --}}
                            <select name="fuel_type_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose....</option>
                                @foreach ($fuelTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-md-4 proeprty_container d-none">
                            {{-- <label for="property_id">Select Property</label> --}}
                            <select name="property_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose....</option>
                                @foreach ($propertise as $property)
                                    <option value="{{ $property->id }}">{{ $property->property_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col-md-4 proeprty_container d-none">
                            {{-- <label for="room_number">Select Room</label> --}}
                            <select name="room_number" id="room_number" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Choose....</option>
                                @for ($i = 1; $i <= 100; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor

                            </select>
                        </div>
                    </div>
                    <div class="row mb-2 other_field">
                        <div class="col-md-4">
                            {{-- <h6 for="item_name" class="light-dark">Item Name</h6> --}}
                            <input type="text" class="form-control" name="item_name" id="item_name"
                                placeholder="Item Name">
                        </div>
                        <div class="col-md-4">
                            {{-- <h6 for="description" class="light-dark">Description</h6> --}}
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="Description">
                        </div>

                        <div class="col-md-4">
                            {{-- <h6 class="light-dark">Type</h6> --}}
                            <select name="item_type_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Type</option>
                                @foreach ($itemTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2 other_field">
                        <div class="col-md-3">
                            {{-- <h6 class="light-dark">Make</h6> --}}
                            <select name="item_make_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Make</option>
                                @foreach ($itemMakes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            {{-- <h6 class="light-dark">Category</h6> --}}
                            <select name="item_category_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Category</option>
                                @foreach ($itemCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            {{-- <h6 class="light-dark">Unit</h6> --}}
                            <select name="unit_type_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Unit</option>
                                @foreach ($UnitTypes as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            {{-- <h6 class="light-dark">UPC</h6> --}}
                            <input type="text" class="form-control" name="upc" id="upc"
                                placeholder="upc">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">
                            {{-- <h6 class="light-dark">Unit Cost</h6> --}}
                            <input name="unit" type="number" class="form-control" id="unit"
                                placeholder="unit cost">
                        </div>
                        <div class="col-md-3">
                            {{-- <h6 class="light-dark">Qty</h6> --}}
                            <input name="qty" type="number" class="form-control" id="qty"
                                placeholder="qty">
                        </div>
                        <div class="col-md-3 location_container d-none">
                            {{-- <h6 class="light-dark">Location</h6> --}}
                            <select name="location_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 other_field">
                            {{-- <h6 class="light-dark">BIN</h6> --}}
                            <input name="bin" type="text" class="form-control" id="bin"
                                placeholder="Bin">
                        </div>
                        <div class="col-md-3 other_field">
                            {{-- <h6 class="light-dark">Barcode</h6> --}}
                            <input name="barcode" type="text" class="form-control" id="barcode"
                                placeholder="2020">
                        </div>


                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 other_field">
                            {{-- <h6 class="light-dark">Warehouse</h6> --}}
                            <select name="warehouse_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Warehouse</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 other_field">
                            {{-- <h6 class="light-dark">Location</h6> --}}
                            <select name="location_id" class="select2 form-control mb-3 custom-select"
                                style="width: 100%; height:36px;">
                                <option value="">Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 other_field">
                            <h6 class="light-dark">Is Expiry?</h6>
                            <input type="checkbox" name="is_expiry_available" id="is_expiry_available"
                                value="1">
                        </div>

                        <div class="col-md-3 other_field">
                            <h6 class="light-dark">Is Warranty?</h6>
                            <input type="checkbox" name="is_warranty_available" id="is_warranty_available"
                                value="1">
                        </div>

                    </div>

                    <div class="row mb-2 other_field">
                        <div class="col-md-4 expiry_date_container d-none">
                            {{-- <h6 class="light-dark">Expiry</h6> --}}
                            <input type="date" name="expiry" id="expiry" class="form-control">
                        </div>
 
                        <div class="col-md-4 warranty_container d-none">
                            {{-- <h6 class="light-dark">Warranty</h6> --}}
                            <input type="date" name="warranty" id="warranty" class="form-control">
                        </div>

                        <div class="col-md-4 warranty_container d-none">
                            {{-- <h6 class="light-dark">Warranty Notes</h6> --}}
                            <input type="text" placeholder="Warranty Notes" name="warranty_notes"
                                id="warranty_notes" class="form-control">
                        </div>

                    </div>

                    {{-- <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" id="notes" cols="10" rows="2" class="form-control"
                            placeholder="Please write notes here"></textarea>
                    </div>


                    <div class="d-flex justify-content-around">

                        <button type="button" class="btn btn-warning w-100" data-dismiss="modal"
                            aria-label="Close">Cancel</button>

                        <button type="button" id="submitFormButton" class="btn save-btn w-100">Save</button>

                    </div>
                    <div class="d-flex justify-content-end mb-3 mr-3">

                        <button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal" aria-label="Close">Cancel</button>
    
                        <button type="submit" class="btn save-btn btns-w">Save</button>
                    </div> --}}

                    <div class="row px-3 mt-2 align-items-center">
                        <div class="col-9">
                            <div class="form-group">
                                <label for="result">Notes</label>
                                <a onclick="startConverting();"><i class="fa fa-microphone btn" style="background-color:#a80000; color:#fff;" aria-hidden="true"></i></a>
                                <textarea name="notes" id="result" cols="10" rows="3" class="form-control" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="btn-box mt-3">
                                <div>
                                    <button type="button" id="submitFormButton" class="btn save-btn w-100 mb-3">Save</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm cancel-btn w-100" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

            </form>
        </div>

    </div>
</div>
