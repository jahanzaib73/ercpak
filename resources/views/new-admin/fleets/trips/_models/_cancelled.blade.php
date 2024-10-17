<div class="modal fade" id="tripCancel" tabindex="-1" aria-labelledby="tripLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h2 class="modal-title" id="tripLabel">Cancel Trip</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tripCancelFormId" class="px-sm-5 pt-50 pb-5">
                <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Please write reason here"
                            required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="tripCancelFormBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
