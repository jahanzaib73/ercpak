<div class="row">

    <div class="card col-12 col-md-6 col-lg-3">
        <div class="card-content">
            <img class="card-img-top" src="{{ asset('img/inventories.gif') }}" alt="Card image cap">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">Total Items</h6>
                    <h4>{{ $totalItems }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card col-12 col-md-6 col-lg-3">
        <div class="card-content">
            <img class="card-img-top" src="{{ asset('img/store1.gif') }}" alt="Card image cap">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">Total Inventory</h6>
                    <h4>{{ $totalInventory }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card col-12 col-md-6 col-lg-3">
        <div class="card-content">
            <img class="card-img-top" src="{{ asset('img/store2.gif') }}" alt="Card image cap">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">Total Warehouse</h6>
                    <h4>{{ $totalWarehouses }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card col-12 col-md-6 col-lg-3">
        <div class="card-content">
            <img class="card-img-top" src="{{ asset('img/assets.gif') }}" alt="Card image cap">
            <hr>
            <div class="card-body py-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="card-title">Total Assets</h6>
                    <h4>{{ $totalAsset }}</h4>
                </div>
            </div>
        </div>
    </div>

</div>
