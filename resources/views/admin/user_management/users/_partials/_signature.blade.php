<!-- Modal -->
<div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="signatureModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 160%">
            <div class="modal-header bg-danger">
                <div class="d-flex">
                    <h5 class="modal-title text-white" id="signatureModalLabel">Signature</h5>
                </div>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="signatureAddForm" action="{{ route('users.signature') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="d-flex justify-content-between">
                            <label for="files">Upload Image</label>
                        </div>
                        <div class="form-group col-12">
                            <input type="file" class="custom-file-input" id="file" name="file"
                                aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn save-btn d-flex" data-dismiss="modal">
                        <p class="m-0">Close &nbsp;/&nbsp;</p>
                        <p class="m-0">يغلق</p>
                    </button>
                    <button type="submit" class="btn save-btn d-flex" id="signatureAddBtn">
                        <p class="m-0">Save &nbsp;/&nbsp;</p>
                        <p class="m-0">يحفظ</p>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
