<!-- Apply Leave Modal -->
<div class="modal fade" id="applyLeaveModal" tabindex="-1" role="dialog" aria-labelledby="applyLeaveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applyLeaveModalLabel">Apply Leave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your leave application form content goes here -->
                <form id="applyLeaveForm" action="{{ route('store.leave') }}" method="POST">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                    </div>
                </form>

                <!-- Bootstrap cards for leaves, applied, and balances -->
                <div class="row mt-4">
                    <!-- Leaves Card -->
                    <div class="col-md-4">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <h5 class="card-title text-white">Leaves</h5>
                                <p class="card-text  text-white">{{ Auth::user()->leaves }} days</p>
                            </div>
                        </div>
                    </div>

                    <!-- Applied Leaves Card -->
                    <div class="col-md-4">
                        <div class="card bg-success">
                            <div class="card-body">
                                <h5 class="card-title  text-white">Applied</h5>
                                <p class="card-text  text-white">{{ Auth::user()->getLeavesCount() }} days</p>
                            </div>
                        </div>
                    </div>

                    <!-- Balances Card -->
                    <div class="col-md-4">
                        <div class="card bg-info">
                            <div class="card-body">
                                <h5 class="card-title  text-white">Balance</h5>
                                <p class="card-text  text-white">{{ Auth::user()->getLeavesBalance() }} days</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="applyLeaveBtn">Apply</button>
            </div>
        </div>
    </div>
</div>
