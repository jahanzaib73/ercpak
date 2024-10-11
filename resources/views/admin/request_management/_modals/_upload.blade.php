<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="uploadModalLabel">Add Request &nbsp; / &nbsp;</h5>
                <h5 class="modal-title text-white arabic" id="uploadModalLabel">إضافة طلب </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bottom-border p-1 ">
                <h5 class="modal-title text-white" id="uploadModalLabel">Add Request &nbsp; / &nbsp;</h5>
                <h5 class="modal-title text-white arabic" id="uploadModalLabel">إضافة طلب </h5>
                <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
            <div class="modal-body">
                <form id="uploadForm" action="{{ route('request.managemant.upload.requests.attachment') }}"
                    method="POST">
                    <input type="hidden" name="id" id="request_id">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="d-flex justify-content-between">
                                <label for="title">Title</label> <label for="" class="arabic red">رقم
                                    الطلب</label>
                            </div>

                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group col-md-12">
                            <div class="d-flex justify-content-between">
                                <label for="notes">Notes</label> <label for="" class="arabic red">رقم
                                    الطلب</label>
                            </div>

                            <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="d-flex justify-content-between">
                                <label for="file">Featured Image</label> <label for=""
                                    class="arabic red">صورة مميزة</label>
                            </div>

                            <div class="form-group px-0 col-12">

                                {{-- <input type="file" class="custom-file-input" id="file" name="file"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="file">Choose file</label> --}}
                                <div class="input-group mb-3 choseFileInputs">
                                    <input type="file" class="form-control chooser" name="file" id="file">
                                    <label class="input-group-text bg-danger text-white" for="file">Browse</label>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
           
<div class="d-flex justify-content-end mb-3 mr-3"><button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal" aria-label="Close">Cancel</button>
    <button type="submit" class="btn save-btn btns-w">Save</button>
    </div>
        </div>
    </div>
</div>
