<div class="modal fade" id="editMake" aria-labelledby="editMakeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bottom-border p-1">
                <h3 class="modal-title ml-2 modal-heading text-dark" id="editMakeLabel"><strong>Update Vehicle Make</strong></h3>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="make-form-update">
                <input type="hidden" name="id" id="makeid">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{-- <label for="name">Make</label> --}}
                            <input type="text" class="form-control" name="editName" id="editName"
                                placeholder="Enter Make">
                        </div>
                    </div>

                    {{-- <label for="name">Status</label> --}}
                    <select name="editStatus" id="editStatus" class="select2 form-control mb-3 custom-select"
                        style="width: 100%; height:36px;">
                        <option value="0">In-active</option>
                        <option value="1">Active</option>
                    </select>

                </div>

                <div class="d-flex justify-content-end mb-3 mr-3">
                    <button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal"
                        aria-label="Close">Cancel</button>

                    <button type="submit" class="btn save-btn btns-w">Update</button>
                </div>
            </form>
        </div>

    </div>
</div>
