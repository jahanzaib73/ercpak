<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


    {{--  <link rel="stylesheet" href="style.css">  --}}
    <title>Comparative</title>

    <style>
        @page {
            size: landscape
        }

        .save-btn {
            color: #AD974F;
            background-color: white;
            border: 2px solid #AD974F;
        }

        .save-btn:hover {
            background: #AD974F;
            color: #fff !important;
            border: 2px solid #d4d4d4;
        }
    </style>
</head>

<body>
    <!-- NAVBAR===================== -->
    <div class="container">

        <div class="container mx-2">

            <div id='printMe'>
                <div class="text-center">
                    <img src="{{ asset('assets/images/LH-header.png') }}" alt="image not found" class="img-fluid w-75">
                </div>
                <h3 class="text-center"> Purchase Requisition / Comparative</h3>
                <div class="row justify-content-center">
                    <div>
                        <hr>
                        <div class="row ">
                            <div class="col-12 col-md-6">
                                <div class="col-12 col-md-6">

                                    <div class="mb-3">{!! DNS1D::getBarcodeHTML(optional($purchaseOrder->parent)->id, 'C93') !!}</div>

                                    <h5>Req.#:<strong>{{ optional($purchaseOrder->parent)->id }}</strong></h5>
                                    <h5>Date:<strong>{{ optional($purchaseOrder->parent)->date }}</strong></h5>
                                </div>

                                <div class="col-12 col-md-6">
            
                                    <div class="mb-3">{!! DNS1D::getBarcodeHTML($purchaseOrder->id, 'C93') !!}</div>
                                    <h5>Comparative #:<strong>{{ $purchaseOrder->id }}</strong></h5>
                                    <h5>Date: {{ $purchaseOrder->date }}
                                </div>
                            </div>

                            <div class="col-12 col-md-3 p-0">
                                <table class="table table-bordered table-hover" style="text-wrap:nowrap;">
                                    <tbody>
                                        <tr>
                                            <td>Location</td>
                                            <th>{{ optional($purchaseOrder->location)->name }}</th>
                                            <td>Warehouse</td>
                                            <th>{{ optional($purchaseOrder->warehouse)->name }}</th>
                                        </tr>
                                        <tr>
                                            <td>Request By</td>
                                            <th>{{ optional($purchaseOrder->requestBy)->full_name }}</th>
                                            <td>Terms</td>
                                            <th>{{ $purchaseOrder->terms ?: 'N/A' }}</th>
                                        </tr>
                                        <tr>
                                            <td>Vendor</td>
                                            <th>{{ optional($purchaseOrder->vendor)->name }}</th>
                                            <td>Ship Via</td>
                                            <th>{{ $purchaseOrder->ship_via }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="col-12 col-md-3 p-0">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Warehouse</td>
                                            <th>{{ optional($purchaseOrder->warehouse)->name }}</th>
                                        </tr>
                                        <tr>
                                            <td>Terms</td>
                                            <th>{{ $purchaseOrder->terms ?: 'N/A' }}</th>
                                        </tr>
                                        <tr>
                                            <td>Ship Via</td>
                                            <th>{{ $purchaseOrder->ship_via }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>

                        <table id="tbl" class="table table-responsive">

                            <thead>
                                <tr id="1">
                                    <th class="col-1">#</th>
                                    <th class="col-2">Photo</th>
                                    <th class="col-3">Items</th>
                                    {{--  <th class="col-2">Vendor</th>  --}}
                                    {{--  <th class="col-2">Price</th>  --}}
                                    <th class="col-1">Unit Type</th>
                                    <th class="col-2">Qty</th>
                                    @foreach ($columnName as $name)
                                        <th class="2">{{ $name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subTotal = 0;
                                ?>
                                @foreach ($comparatives as $comparative)
                                    <tr id="2">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $comparative['item_data']->item->image_url }}" alt=""
                                                width="100%"></td>
                                        <td>{{ $comparative['item_data']->item->item_name }}</td>
                                        {{--  <td>{{ $comparative['item_data']->vendor->name }}</td>  --}}
                                        {{--  <td>{{ $comparative['item_data']->item_price }}</td>  --}}
                                        <td>{{ optional(optional($comparative['item_data']->item)->unitType)->name }}
                                        </td>
                                        <td>{{ $comparative['item_data']->qty }}</td>
                                        @for ($i = 0; $i < count($columnName); $i++)
                                            <th class="2">{{ $comparative[$i]['price'] }}</th>
                                        @endfor
                                    </tr>

                                    <?php
                                    $subTotal += $comparative['item_data']->sub_total;
                                    ?>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="totals">
                                    <table style="width: 100%; border-collapse: collapse; text-wrap:nowrap;" >
                                        <tr>
                                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Total</td>
                                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                                {{ $subTotal }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Tax</td>
                                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                                {{ $matchingComparatives->cgst }}</td>
                                        </tr> --}}
                                        <tr>
                                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Tax Amount
                                            </td>
                                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                                {{ $matchingComparatives->cgst_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Grand
                                                Total</td>
                                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                                {{ $matchingComparatives->total_amount }}</td>
                                        </tr>
                                    </table>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row d-flex align-items-center justify-content-between">
                <button class="btn save-btn btn-lg pull-right" onclick="printDiv('printMe')">Print</button>
            </div>

        </div>
    </div>



    <script src="https://kit.fontawesome.com/f186debb04.js" crossorigin="anonymous"></script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>

</body>

</html>
