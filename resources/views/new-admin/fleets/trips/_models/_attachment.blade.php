<div class="modal fade" id="attach" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h5 class="modal-title" id="exampleModalLabel">Attach File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="vehicle_attachment_form">
                    <input type="hidden" name="id" value="{{ $vehicle->id }}">

                    <div class="mb-3">
                        <label for="file_name" class="form-label">File Name</label>
                        <input type="text" name="file_name" class="form-control" id="file_name"
                            placeholder="Enter file name">
                    </div>

                    <div class="mb-3">
                        <label for="attachment_file" class="form-label">Choose File</label>
                        <input name="file" type="file" class="form-control" id="attachment_file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="submitAttachmentFormButton" class="btn btn-primary">Upload File</button>
            </div>
        </div>
    </div>
</div>
