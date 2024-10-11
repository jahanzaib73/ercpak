<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title pb-3">
                    Filter By Government
                </h5>

                <form id="government_filter_form">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="sr-only" for="complaint_type">Select Status</label>
                                <select name="government_id" id="government_id" class="form-control ml-2">
                                    <option value="">Please Select</option>
                                    @foreach ($governments as $government)
                                        <option value="{{ $government->id }}">{{ $government->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn save-btn ml-2 btn-srch-table">Filter</button>
                            <button type="reset" name="button"
                                onclick="resetSearchForm()"class="btn save-btn ml-2">Reset</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
