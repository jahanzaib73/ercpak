<div class="modal fade" id="editMake" aria-labelledby="editMakeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {{-- <div class="modal-header bg-info">
                <h2 class="modal-title text-white" id="editMakeLabel"><strong>Update Item Type</strong></h2>
                <button type="button" class="close bg-white rounded-xl" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1">
                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Update Item Type</strong></h3>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="make-form-update">
                <input type="hidden" name="id" id="makeid">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{-- <label for="name">Type</label> --}}
                            <input type="text" class="form-control" name="editName" id="editName"
                                placeholder="Enter Type">
                        </div>
                    </div>

                    {{-- <label for="name">Status</label> --}}
                    <select name="editStatus" id="editStatus" class="select2 form-control mb-3 custom-select"
                        style="width: 100%; height:36px;">
                        <option value="0">In-active</option>
                        <option value="1">Active</option>
                    </select>

                </div>

                {{-- <div class="d-flex justify-content-around">

                    <button type="button" class="btn btn-warning w-100" data-dismiss="modal"
                        aria-label="Close">Cancel</button>

                    <button type="submit" class="btn save-btn w-100">Update</button>

                </div> --}}
                <div class="d-flex justify-content-end mb-3 mr-3">

                    <button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal" aria-label="Close">Cancel</button>

                    <button type="submit" class="btn save-btn btns-w">Save</button>
                </div>

            </form>
        </div>

    </div>
</div>
