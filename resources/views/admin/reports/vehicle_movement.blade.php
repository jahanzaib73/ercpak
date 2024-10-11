<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Movement Order</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        /* .form-control {
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

        @page {
            size: landscape
        }
    </style>
</head>

<body style="background-color: #fff">

    <div class="container-fluid text-center">
        <button class="btn btn-outline-danger print-preview-button" onclick="window.print()">Print Preview</button>
    </div>

    <div class="container">
        <div class="details head1" style="text-align: center;  align-items: center;">
            <div class="col-l" style="display: flex; justify-content: right; ">
                <img src="{{ asset('favicon.png') }}" alt="">
            </div>
            <div style="text-align: left; padding-left: 20px; margin-top: 13px" class="col-r">
                <p>Consulate General of the <br><strong>United Arab Emirates</strong><br>Karachi</p>
            </div>
        </div>
        <div class="header bg-danger rounded p-2 text-white" style="margin-top: 20px;">
            <h4 class="mt-1 text-white">Vehicle Movement Report</h4>

        </div>
        <div style="display: block; justify-content: space-around; ">
            <form action="{{ route('vehicle.movement.report') }}" method="GET">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Driver</label>
                        <select name="driver_id" id="" class="form-control">
                            <option value="">All</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" @if ($driver->id == request('driver_id')) selected @endif>
                                    {{ $driver->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Vehicles</label>
                        <select name="vehicle_id" id="" class="form-control">
                            <option value="">All</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" @if ($vehicle->id == request('vehicle_id')) selected @endif>
                                    {{ $vehicle->vehicle_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Location/Cost Center</label>
                        <select name="costCenter" id="" class="form-control">
                            <option value="">All</option>
                            @foreach ($costCenter as $cost)
                                <option value="{{ $cost->id }}" @if ($cost->id == request('costCenter')) selected @endif>
                                    {{ $cost->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="from_date">From Date</label>
                        <input type="date" name="from_date" id="from_date" class="form-control"
                            value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="to_date">To Date</label>
                        <input type="date" name="to_date" id="to_date" class="form-control"
                            value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-1 text-right filter-btn" style="margin-top: 32px">
                        <button type="submit" class="btn btn-outline-danger">Search</button>
                    </div>
                    <div class="col-md-1  filter-btn" style="margin-top: 32px">
                        <a href="{{ route('vehicle.movement.report') }}" class="btn btn-outline-danger">Clear</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr style="font-size: x-small;">
                        <th>#</th>
                        <th>Photo</th>
                        <th>Vehicle</th>
                        <th>Official <br> Driver</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Date & Time Out</th>
                        <th>Date & Time In</th>
                        <th>Meter Out</th>
                        <th>Meter In</th>
                        <th>Travel</th>
                        <th>Cost Center</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalDistance = 0;
                    ?>
                    @foreach ($tripReport as $trip)
                        <tr style="font-size: x-small;">
                            <td>{{ $loop->iteration }}</td>
                            <td> <a href="{{ optional($trip->vehicle)->image_url }}" target="_blank"><img
                                        src="{{ optional($trip->vehicle)->image_url }}" alt="Vehicle Photo"
                                        width="100px"></a></td>
                            <td>{{ optional($trip->vehicle)->vehicle_number }} <br>
                                {{ optional(optional($trip->vehicle)->model)->name }}</td>
                            <td>{{ optional($trip->official)->official_name ?: 'N/A' }} <br>
                                {{ optional($trip->driver)->full_name }}</td>
                            <td>{{ optional($trip->origin)->name ?: 'N/A' }}</td>
                            <td>{{ optional($trip->destination)->name ?: 'N/A' }}</td>
                            <td>{{ Carbon\Carbon::parse($trip->exit_datetime_out)->format('Y-m-d') }} <br>
                                {{ Carbon\Carbon::parse($trip->exit_datetime_out)->format('H:i A') }}</td>
                            <td>{{ Carbon\Carbon::parse($trip->return_datetime_out)->format('Y-m-d') }} <br>
                                {{ Carbon\Carbon::parse($trip->return_datetime_out)->format('H:i A') }}</td>
                            <td>{{ number_format($trip->exit_meetr_reading, 2) }} km</td>
                            <td>{{ number_format($trip->return_meetr_reading, 2) }} km</td>
                            <td>{{ number_format($trip->return_meetr_reading - $trip->exit_meetr_reading, 2) }} km</td>
                            <td>{{ optional($trip->costCenter)->title }}</td>
                            <td>{{ $trip->notes }}</td>
                        </tr>
                        <?php
                        $totalDistance = $totalDistance + ($trip->return_meetr_reading - $trip->exit_meetr_reading);
                        ?>
                    @endforeach

                </tbody>
                <tfoot>
                    <td colspan="10" style="text-align: right;"><strong>Total (KMs)</strong></td>
                    <td colspan="3" style="text-align: center;">
                        <strong>{{ number_format($totalDistance, 2) }}</strong>
                    </td>
                </tfoot>
            </table>
        </div>

        <div class="row mt-5" style="justify-content: space-around;">
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
