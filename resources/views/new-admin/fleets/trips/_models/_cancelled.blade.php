<div class="modal fade" id="tripCancel"  aria-labelledby="tripLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 150%">
            <div class="modal-header">
                <h2 class="modal-title" id="tripLabel">Cancel Trip</h2>
                <button type="button" class="close modalclose-btn rounded-xl py-1 px-2" data-dismiss="modal" aria-label="Close" style="bottom:16px; left:14px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tripCancelFormId">

                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" cols="10" rows="2" class="form-control" id="reason"
                            placeholder="Please write reason here"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mr-3 mb-2">

                    <button type="submit" class="btn cancel-btn mr-2" data-dismiss="modal"
                        aria-label="Cancel">Cancel</button>

                    <button type="button" class="btn save-btn " id="tripCancelFormBtn">Submit</button>

                </div>

            </form>
        </div>
    </div>
</div>
