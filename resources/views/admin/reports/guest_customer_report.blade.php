<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Report</title>
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
        @font-face {
            font-family: "GE SS Two Light";
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot");
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot?#iefix")format("embedded-opentype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff2")format("woff2"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff")format("woff"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.ttf")format("truetype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.svg#GE SS Two Light")format("svg");
        }

        .arabic {
            font-family: "GE SS Two Light";
        }

        .red {
            color: red;
        }

        /* Custom styles go here */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-top: 5px;
            padding-left: 5px;
            padding-right: 5px;
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
            size: portrait
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
            <div style="text-align: left; padding-left: 20px;  margin-top: 13px" class="col-r">
                <p>Consulate General of the <br><strong>United Arab Emirates</strong><br>Karachi</p>
            </div>
        </div>
        <div class="header d-flex bg-danger rounded p-2 text-white justify-content-between" style="margin-top: 20px">
            <h4 class="mt-1 text-white">Customers Report</h4>
            <h4 class="arabic mt-1">تقرير العملاء</h4>

        </div>
        <div style="display: block; justify-content: space-around; ">
            <form action="{{ route('guest.customer.report') }}" method="GET">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Type</label>
                        <select name="visit" id="" class="form-control">
                            <option value="">All</option>
                            @foreach ($purposOfVisits as $visit)
                                <option value="{{ $visit->id }}" @if ($visit->id == request('visit')) selected @endif>
                                    {{ $visit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Filter</label>
                        <select name="filter" id="" class="form-control">
                            <option value="">Select</option>
                            <option value="Today" @if ('Today' == request('filter')) selected @endif>Today</option>
                            <option value="YesterDay" @if ('YesterDay' == request('filter')) selected @endif>YesterDay
                            </option>
                            <option value="ThisWeek" @if ('ThisWeek' == request('filter')) selected @endif>This Week
                            </option>
                            <option value="LastWeek" @if ('LastWeek' == request('filter')) selected @endif>Last Week
                            </option>
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
                    <div class="col-md-2 text-right filter-btn" style="margin-top: 32px">
                        <button type="submit" class="btn btn-outline-danger">Search</button>
                    </div>
                    <div class="col-md-2  filter-btn" style="margin-top: 32px">
                        <a href="{{ route('guest.customer.report') }}" class="btn btn-outline-danger">Clear</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">
                            <p class="arabic  m-0 ">أنواع العملاء</p> &nbsp; Customer Types
                        </th>
                        <th class="text-center">
                            <div class="d-flex justify-content-center ">Customers /&nbsp; <p class="arabic ">عملاء</p>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="d-flex justify-content-center ">Fee (AED) /&nbsp; <p class="arabic ">الرسوم
                                    (درهم)</p>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalCustomers = 0;
                    $totalFee = 0;
                    ?>
                    @foreach ($purposeOfVisitRecords as $visit)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ optional($visit->pyrposeOfVisit)->name }}</td>
                            <td class="text-center"> {{ $visit->total_visitors }}</td>
                            <td class="text-center">{{ number_format($visit->total_fee, 2) }}</td>
                        </tr>
                        <?php
                        $totalCustomers += $visit->total_visitors;
                        $totalFee += $visit->total_fee;
                        ?>
                    @endforeach

                </tbody>
                <tfoot>
                    <td colspan="2" style="text-align: right;"><strong>Total</strong> &nbsp; <strong
                            class="arabic">المجموع</strong></td>
                    <td class="text-center"><strong>{{ $totalCustomers }}</strong></td>
                    <td class="text-center"><strong>{{ number_format($totalFee, 2) }}</strong></td>

                </tfoot>
            </table>
        </div>

        <div class="row mt-5" style="justify-content: space-around;">
            <div class="">
                <hr>
                <!-- Include your prepared by signature here -->
                <p class="arabic mb-0">أُعدت بواسطة</p>
                <p>Prepared By</p>
            </div>
            <div class="">
                <hr>
                <!-- Include your Checked by signature here -->
                <p class="arabic mb-0">فحص بواسطة </p>
                <p>Checked By</p>
            </div>
        </div>


    </div>

</body>

</html>
