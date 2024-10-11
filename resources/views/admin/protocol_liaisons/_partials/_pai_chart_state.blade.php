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
                        <h5 class="header-title pb-3">{{ App\Models\ProtocolLiaison::OFFICIAL }}</h5>
                        <div class="flot-container">
                            <div id="offical_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">{{ App\Models\ProtocolLiaison::NOTABLE }}</h5>
                        <div class="flot-container">
                            <div id="notable_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-sm-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">{{ App\Models\ProtocolLiaison::COMPANY }}</h5>
                        <div class="flot-container">
                            <div id="company_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">{{ App\Models\ProtocolLiaison::PROJECT }}</h5>
                        <div class="flot-container">
                            <div id="project_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">{{ App\Models\ProtocolLiaison::PROPERTY }}</h5>
                        <div class="flot-container">
                            <div id="property_state_pai_chart" style="height: 150px;"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
