<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Movement Order</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-secondary.css') }}"> --}}

    @php
        $layoutSettings = App\Models\LayoutSettings::where('user_id', Auth::id())->first();
        $response = null;
        if ($layoutSettings) {
            $response = json_decode($layoutSettings->settings);
        }
    @endphp
    @if ($response && $response->settings == '2')
        <link id="css-link" href="{{ asset('assets/css/style-secondary.css') }}" rel="stylesheet">
    @else
        <link id="css-link" href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @endif
    <style>
        /* Custom styles go here */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .two-columns {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .column {
            width: 48%;
            /* Adjust as needed */
        }

        .column img {
            max-width: 100%;
        }

        .table-container {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .qr-code {
            float: left;
            margin-top: 20px;
        }

        .approval-signature {
            float: right;
            margin-top: 20px;
        }

        .print-preview-button {
            margin-top: 20px;
        }

        .col-l {
            width: 45%;
        }

        .col-r {
            width: 55%;
            text-align: right;
            padding-right: 10px;
        }

        .head1 {
            align-items: center;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .details img {
            max-width: 15%;
            height: auto;
        }

        /* .form-control{
    border: 1px solid #a80000 !important;
        } */

        .btn.focus,
        .btn:focus {
            outline: 0;
            box-shadow: none !important;
        }

        @media print {

            /* Custom print styles go here */
            body * {
                visibility: hidden;
            }

            .container,
            .container * {
                visibility: visible;
            }

            .container {
                position: absolute;
                top: 0;
                left: 0;
            }

            .th .td {
                font-size: 9px;
            }

            .filter-btn {
                display: none;
            }
        }
    </style>
</head>

<body style="background-color: #fff;">
    <div class="container-fluid text-center">
        <button class="btn btn-outline-danger print-preview-button" onclick="window.print()">Print Preview</button>
    </div>

    <div class="container">
        <div class="details head1" style="text-align: center;  align-items: center;">
            <div class="col-l" style="display: flex; justify-content: right; ">
                <img src="{{ asset('favicon.png') }}" alt="">
            </div>
            <div style="text-align: left; padding-left: 20px; margin-top: 13px" class="col-r ">
                <p>Consulate General of the <br><strong>United Arab Emirates</strong><br>Karachi</p>
            </div>
        </div>
        <div class="header bg-danger rounded p-2 " style="margin-top: 20px;">
            <h4 class="mt-1 text-white">Fuel Summary</h4>

        </div>
        <form action="{{ route('fuel.summary.report') }}" method="GET">
            <div class="row align-items-end">
                <div class="col-md-2">
                    <label for="" class="">Fuel Type</label>
                    <select name="fuelType" id="" class="form-control">
                        <option value="">All</option>
                        @foreach ($fuelTypes as $type)
                            <option value="{{ $type->id }}" @if ($type->id == request('fuelType')) selected @endif>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="" class="">Vehicles</label>
                    <select name="vehicle_id" id="" class="form-control">
                        <option value="">All</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" @if ($vehicle->id == request('vehicle_id')) selected @endif>
                                {{ $vehicle->vehicle_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="" class="">Location/Cost Center</label>
                    <select name="costCenter" id="" class="form-control">
                        <option value="">All</option>
                        @foreach ($costCenter as $cost)
                            <option value="{{ $cost->id }}" @if ($cost->id == request('costCenter')) selected @endif>
                                {{ $cost->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="from_date" class="">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control"
                        value="{{ request('from_date') }}">
                </div>
                <div class="col-md-2">
                    <label for="to_date" class="">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control"
                        value="{{ request('to_date') }}">
                </div>
                <div class="col-md-1 text-right filter-btn">
                    <button type="submit" class="btn btn-outline-danger">Search</button>
                </div>
                <div class="col-md-1  filter-btn">
                    <a href="{{ route('fuel.summary.report') }}" class="btn btn-outline-danger">Clear</a>
                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="table ">
                <thead>
                    <tr style="font-size: x-small;">
                        <th>#</th>
                        <th>Slip#</th>
                        <th>Photo</th>
                        <th>Vehicle</th>
                        <th>Date & Time</th>
                        <th>Meter</th>
                        <th>Fuel Type</th>
                        <th>Qty (Ltrs)</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Cost Center</th>
                        <th>Fuelman</th>
                        <th>Driver</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fuelSummaryReport as $summary)
                        <tr style="font-size: x-small; align-items: center;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $summary->id }}</td>
                            <td> <a href="{{ optional($summary->vehicle)->image_url }}" target="_blank"><img
                                        src="{{ optional($summary->vehicle)->image_url }}" alt="Vehicle Photo"
                                        width="100px"></a></td>
                            <td>{{ optional($summary->vehicle)->vehicle_number }}
                                <br>{{ optional(optional($summary->vehicle)->model)->name }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($summary->date)->format('Y-m-d') }} <br>
                                {{ Carbon\Carbon::parse($summary->date)->format('H:i A') }}</td>
                            <td>{{ $summary->vehicle_meter_reading ?: 0.0 }} km</td>
                            <td>{{ optional($summary->fuelType)->name }}</td>
                            <td>{{ number_format($summary->qty, 2) ?: 0.0 }}</td>
                            <td>{{ number_format($summary->price, 2) ?: 0.0 }}</td>
                            <td>{{ number_format($summary->qty * $summary->price, 2) }}</td>
                            <td>{{ optional($summary->costCenter)->title }}</td>
                            <td>{{ optional($summary->fuelMan)->full_name }}</td>
                            <td>{{ optional($summary->driver)->full_name }}</td>
                            <td>{{ $summary->notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="7" style="text-align: right;"><strong>Total</strong></td>
                    <td style="text-align: center;"><strong>{{ number_format($total['totalQty'], 2) }}</strong></td>
                    <td colspan="2" style="text-align: center;">
                        <strong>{{ number_format($total['totalPrice'], 2) }}</strong>
                    </td>
                    <td colspan="5" style="text-align: center;"><strong></strong></td>
                </tfoot>
            </table>
        </div>

        <div class="row  mt-5" style="justify-content: space-around;">
            <div class="">
                <hr>
                <!-- Include your prepared by signature here -->
                <p>Prepared By</p>
            </div>
            <div class="">
                <hr>
                <!-- Include your Checked by signature here -->
                <p>Checked By</p>
            </div>
        </div>

    </div>
</body>

</html>
