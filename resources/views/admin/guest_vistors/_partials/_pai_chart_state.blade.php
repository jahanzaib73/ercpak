<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">All</h5>
                        <div class="flot-container">
                            <div id="all_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">{{ App\Models\GuestVistor::GUEST }}</h5>
                        <div class="flot-container">
                            <div id="guest_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">{{ App\Models\GuestVistor::VISTORS }}</h5>
                        <div class="flot-container">
                            <div id="visitor_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
