<div class="container">
    <div class="row">
        <div class="card col-12 col-md-6 col-lg-3">
            <img class="card-img-top pt-2" src="{{ asset('img/01.avif') }}" alt="Card image cap" width="100%">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">All Vehicles</h6>
                    <h4>{{ $states['allVehicle'] }}</h4>
                </div>

            </div>
        </div>

        <div class="card col-12 col-md-6 col-lg-3">
            <img class="card-img-top  pt-2" src="{{ asset('img/02.gif') }}" alt="Card image cap" width="100%"
                height="50%">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">Vehicles on Move</h6>
                    <h4>{{ $states['onMove'] }}</h4>
                </div>

            </div>
        </div>

        <div class="card col-12 col-md-6 col-lg-3">
            <img class="card-img-top  pt-2" src="{{ asset('img/03.gif') }}" alt="Card image cap" width="100%"
                height="50%">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">Vehicles in Workshop</h6>
                    <h4>{{ $states['onWorkshop'] }}</h4>
                </div>
            </div>
        </div>

        <div class="card col-12 col-md-6 col-lg-3">
            <img class="card-img-top  pt-2" src="{{ asset('img/04.webp') }}" alt="Card image cap" width="100%">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">Vehicles Out of Services</h6>
                    <h4>{{ $states['outOfService'] }}</h4>
                </div>

            </div>
        </div>

    </div>
</div>
