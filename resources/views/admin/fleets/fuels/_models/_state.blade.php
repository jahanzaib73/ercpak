<div style="width: 100%; height: 300px; font-size: 16px;" id="fuelTankChart"></div>
<hr>
<h2 class="topbar-header rounded text-white text-center py-2">Annual Fuel Summary</h2>
<div>
    <div>

        <div class="row">
            <div class="col-12 px-0">
                <div class="table-responsive">
                    <table id="business_ratio"
                        class="table table-condensed table-bordered table-striped table-hover table-charts">
                        <thead>
                            <tr>
                                <th>Fuel Type</th>
                                <th class="text-center">Jan.</th>
                                <th class="text-center">Feb.</th>
                                <th class="text-center">Mar.</th>
                                <th class="text-center">Apr.</th>
                                <th class="text-center">May</th>
                                <th class="text-center">June</th>
                                <th class="text-center">July</th>
                                <th class="text-center">Aug.</th>
                                <th class="text-center">Sept.</th>
                                <th class="text-center">Oct.</th>
                                <th class="text-center">Nov.</th>
                                <th class="text-center">Dec.</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modChart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="width: 117%">
                <div class="modal-header bg-info  text-white">
                    <h4 class="modal-title" id="exampleModalLabel">Linechart</h4>
                    <button type="button" class="close text-info border bg-white rounded-xl" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>

                </div>
                <div class="modal-body">
                    <canvas id="canvas" width="568" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
