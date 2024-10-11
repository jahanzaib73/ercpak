<div class="modal fade" id="attach" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attach File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}

            <div class="modal-header bottom-border p-1 ">
                <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Attach File</strong></h3>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>

            <div class="modal-body">
                <form id="vehicle_attachment_form">
                    <input type="hidden" name="id" value="{{ $vehicle->id }}">
                    <div class="form-group">
                        {{-- <label for="attachment">File Name</label> --}}
                        <input type="text" name="file_name" class="form-control" id="attachment"
                            aria-describedby="emailHelp" placeholder="Enter file name">
                    </div>

                    {{-- <div class="form-group">
                        <label for="attachment_file">Choose File</label>
                        <input name="file" type="file" class="form-control-file" id="attachment_file">
                    </div> --}}
                    <div class="input-group mb-3 choseFileInputs">
                        <input type="file" class="form-control chooser" name="attachment_file" id="attachment_file">
                        <label class="input-group-text bg-danger text-white" for="attachment_file">Browse</label>
                        </div>
                </form>
            </div>
            <div class="d-flex justify-content-end mb-3 mr-3"><button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="submit" class="btn save-btn btns-w">Save</button>
                </div>
        </div>
    </div>
</div>
