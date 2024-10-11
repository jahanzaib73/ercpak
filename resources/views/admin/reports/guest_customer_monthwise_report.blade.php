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
            <div style="text-align: left; padding-left: 20px;  margin-top: 13px" class="col-r">
                <p>Consulate General of the <br><strong>United Arab Emirates</strong><br>Karachi</p>
            </div>
        </div>
        <div class="header d-flex bg-danger text-white rounded p-2 justify-content-between" style="margin-top: 20px;">
            <h4 class="mt-1 text-white">Customers Report</h4>
            <h4 class="arabic mt-1">تقرير العملاء</h4>

        </div>
        <div style="display: block; justify-content: space-around; ">
            <form action="{{ route('guest.customer.monthwise.report') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Type</label>
                        <select name="customer_id" id="" class="form-control">
                            <option value="">All</option>
                            @foreach ($purposeOfVisits as $visit)
                                <option value="{{ $visit->id }}" @if ($visit->id == request('customer_id')) selected @endif>
                                    {{ $visit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="from_date">From Date</label>
                        <input type="date" name="from_date" id="from_date" class="form-control"
                            value="{{ request('from_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="to_date">To Date</label>
                        <input type="date" name="to_date" id="to_date" class="form-control"
                            value="{{ request('to_date') }}">
                    </div>
                    <div class="col-md-1 text-right filter-btn" style="margin-top: 32px">
                        <button type="submit" class="btn btn-outline-danger">Search</button>
                    </div>
                    <div class="col-md-1  filter-btn" style="margin-top: 32px">
                        <a href="{{ route('guest.customer.monthwise.report') }}"
                            class="btn btn-outline-danger">Clear</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-container">
            <table class="table" style="border: 1px solid #d4d4d4;">
                <thead>
                    <tr style="background-color: #e2e1e1;">
                        <th class="text-center small">
                            <div class="d-flex justify-content-center"> &nbsp; <p class="arabic ">رقم تسلسل</p>
                            </div>S.No.
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic "> الدخول بواسطة</p>
                            </div>Entry By
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">رقم العميل-الضيف</p>
                            </div>Guest-Customer #
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">التاريخ والوقت</p>
                            </div>Date & Time
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">اسم الضيف-العميل</p>
                            </div>Guest-Customer Name
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">قسم-</p>
                            </div>Department
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">اتصال </p>
                            </div>Contact #
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">بريد إلكتروني</p>
                            </div>Email
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">رقم بطاقة الهوية</p>
                            </div>CNIC
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">جواز سفر</p>
                            </div>Passport #
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">غرض الزيارة</p>
                            </div>Purpose of Visit
                        </th>
                        <th class="text-center small">
                            <div class="d-flex justify-content-center "> &nbsp; <p class="arabic ">مصاريف</p>
                            </div>Fee
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalFee = 0;
                    ?>
                    @foreach ($guestVisitorsData as $data)
                        <tr>
                            <td class="text-center small">{{ $loop->iteration }}</td>
                            <td class="text-center small">{{ optional($data->user)->full_name }}</td>
                            <td class="text-center small"> {{ $data->id }}</td>
                            <td class="text-center small">
                                {{ Carbon\Carbon::parse($data->created_at)->format('Y-m-d h:i A') }}</td>
                            <td class="text-center small">
                                @if ($data->type == 'VISTORS')
                                    {{ $data->vistor_name ?: 'N/A' }}
                                @else
                                    @if (isset($data->guest) && $data->guest->official_name)
                                        {{ $data->guest->official_name ?: 'N/A' }}
                                    @elseif(isset($data->guest) && $data->guest->notable_name)
                                        {{ $data->guest->notable_name ?: 'N/A' }}
                                    @endif
                                @endif
                            </td>
                            <td class="text-center small">{{ optional($data->department)->name }}</td>
                            <td class="text-center small">
                                @if ($data->type == 'VISTORS')
                                    {{ $data->vistor_contact ?: 'N/A' }}
                                @else
                                    {{ optional($data->guest)->phone ?: 'N/A' }}
                                @endif
                            </td>
                            <td class="text-center small">
                                @if ($data->type == 'VISTORS')
                                    {{ $data->vistor_email ?: 'N/A' }}
                                @else
                                    @if (isset($data->guest) && $data->guest->official_email)
                                        {{ $data->guest->official_email ?: 'N/A' }}
                                    @elseif(isset($data->guest) && $data->guest->notable_email)
                                        {{ $data->guest->notable_email ?: 'N/A' }}
                                    @endif
                                @endif
                            </td>
                            <td class="text-center small">{{ $data->cnic }}</td>
                            <td class="text-center small">{{ $data->passport_number }}</td>
                            <td class="text-center small">{{ optional($data->pyrposeOfVisit)->name }}</td>
                            <td class="text-center small">{{ number_format($data->fee, 2) }}</td>

                        </tr>
                        <?php
                        $totalFee += $data->fee;
                        ?>
                    @endforeach

                </tbody>
                <tfoot>
                    <td colspan="9" style="text-align: right;"><strong>Total</strong> &nbsp; <strong
                            class="arabic">المجموع</strong></td>
                    <td colspan="2" class="text-center"><strong>{{ number_format($totalFee, 2) }}</strong></td>
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
