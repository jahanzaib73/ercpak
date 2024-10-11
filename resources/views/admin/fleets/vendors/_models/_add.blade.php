<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {{-- <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="exampleModalLabel"><strong>Add Vendor</strong></h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add Vendor</strong></h3>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="vendor-form">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{-- <label for="name">Name</label> --}}
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{-- <label for="phone">Phone</label> --}}
                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="Enter phone">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{-- <label for="file">Profile Pic</label> --}}
                            {{-- <input type="file" class="form-control" name="file" id="file"> --}}
                            <input name="atachments[]" type="file" placeholder="" class="form-control chooser" style="height: 38px" id="file" multiple="">
                        </div>
                    </div>
                    {{-- <label for="name">Status</label> --}}
                    <select name="status" class="select2 form-control mb-3 custom-select"
                        style="width: 100%; height:36px;">
                        <option value="0">In-active</option>
                        <option value="1">Active</option>
                    </select>

                </div>

                <div class="d-flex justify-content-end mb-3 mr-3">

                    <button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal" aria-label="Close">Cancel</button>

                    <button type="submit" class="btn save-btn btns-w">Save</button>
                </div>

            </form>
        </div>

    </div>
</div>
