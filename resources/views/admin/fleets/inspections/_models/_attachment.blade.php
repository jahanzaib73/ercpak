<div class="modal fade" id="attach" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attach File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="vehicle_attachment_form">
                    <input type="hidden" name="id" value="{{ $vehicle->id }}">
                    <div class="form-group">
                        <label for="attachment">File Name</label>
                        <input type="text" name="file_name" class="form-control" id="attachment"
                            aria-describedby="emailHelp" placeholder="Enter file name">
                    </div>

                    <div class="form-group">
                        <label for="attachment_file">Choose File</label>
                        <input name="file" type="file" class="form-control-file" id="attachment_file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="submitAttachmentFormButton" class="btn btn-primary">Upload File</button>
            </div>
        </div>
    </div>
</div>
