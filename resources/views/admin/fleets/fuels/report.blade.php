<!DOCTYPE html>
<html>

<head>
    <title>Fuel Slip</title>
    <style>
        /* Inline CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        p {
            font-size: 10px;
        }

        th {
            font-size: 10px;
        }

        td {
            font-size: 10px;
        }

        .container {
            max-width: 200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-top: 20px;
        }

        .logo {
            display: block;
            margin: 0 auto;
            max-width: 100%;
        }

        .company-name {
            text-align: center;
            margin-top: 10px;
        }

        .title {
            /* background-color: lightgrey; */
            text-align: center;
            font-weight: bold;
            padding: 1px;
            display: flex;
            justify-content: space-between;

        }

        .barcode {
            text-align: center;
            margin-top: 0px;
        }

        .print-button {
            text-align: center;
            margin-top: 20px;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-top: 0px;
        }

        .details img {
            max-width: 65%;
            height: auto;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
        }

        .details th,
        .details td {
            padding: 5px;
            border: 1px solid #000;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .col-l {
            width: 35%;
        }

        .col-r {
            width: 65%;
            text-align: right;
            padding-right: 10px;
        }

        .head1 {
            align-items: center;
        }

        button {
            width: 150px;
            height: 40px;
        }

        /* Hide print button in print preview */
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="print-button">
            <button onclick="window.print()">Print</button>
        </div>
        <div class="header">
            <div class="details head1" style="text-align: center;">
                <div class="col-12">
                    <img src="{{ asset('conslo.png') }}" alt="" width="100%">
                </div>
                {{--  <div style="text-align: left;" class="col-r">
                    <p>Consulate General of the <br><strong>United Arab Emirates</strong><br>Karachi</p>
                </div>  --}}
            </div>

        </div>
        <div class="title">
            <div class="col-8">
                <h4>Fuel Slip</h4>
            </div>
            <div class="col-8">
                <h4>#{{ $fuel->id }}</h4>
            </div>
        </div>

        <div class="details">
            <div style="text-align: center;">
                <img src="{{ optional($fuel->vehicle)->image_url }}" alt="Vehicle Photo">
                <p><strong>{{ optional($fuel->vehicle)->vehicle_number }}</strong><br>{{ optional(optional($fuel->vehicle)->model)->name }}
                </p>
            </div>
        </div>
        <div class="details" style="text-align: center;">
            <div>
                <img width="200" src="{{ optional($fuel->official)->profile_pic_url }}" alt="Official Photo">
                <p><strong>Official:</strong><br>{{ optional($fuel->official)->full_name }}
                    <br>{{ optional(optional($fuel->official)->designation)->name }}
                </p>
            </div>
            <div>
                <img width="200" src="{{ optional($fuel->driver)->profile_pic_url }}" alt="Driver Photo">
                <p><strong>Driver:</strong><br>{{ optional($fuel->driver)->full_name }}
                    <br>{{ optional(optional($fuel->driver)->designation)->name }}
                </p>
            </div>
        </div>
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <p>
                <label for="myCheckbox">Tank Full</label>
                <input type="checkbox" id="myCheckbox" name="myCheckbox">
            <p>Or Enter Qty here</p>
            <textarea name="" id="" cols="6" rows="1"></textarea>
        </div>
        <div class="details">

            <table>
                <tr>
                    <th>Fuel Qty (Ltrs)</th>
                    <td> {{ number_format($fuel->qty, 2) }}</td>
                </tr>
                <tr>
                    <th>Fuel Price</th>
                    <td>{{ $fuel->price }}/Ltr</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>{{ $fuel->price * $fuel->qty }}</td>
                </tr>
                <tr>
                    <th>Last Fuel Date</th>
                    <td>{{ Carbon\Carbon::parse($lastRefuelDate)->toDateString() }}</td>
                </tr>
                <tr>
                    <th>Last Fuel Qty (Ltrs)</th>
                    <td>{{ $lastRefuelqty }}</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td>{{ $fuel->notes }}</td>
                </tr>
            </table>

        </div>
        <div class="details" style="text-align: center;">
            <div>
                <img width="200" src="{{ optional($fuel->fuelMan)->profile_pic_url }}" alt="Fuelman Photo">
                <p><strong>Fuelman:</strong><br>{{ optional($fuel->fuelMan)->full_name }}
                    <br>{{ optional(optional($fuel->fuelMan)->designation)->name }}
                </p>
            </div>
            <div>
                <div style="margin-left: 23px; margin-top: 8px">
                    <center>
                        <div class="mb-3">{!! DNS2D::getBarcodeHTML((string) $fuel->id, 'QRCODE',4,4) !!}
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <div style="text-align: center;">
            <p>Printed By: {{ Auth::user()->full_name }} @ {{ now() }}</p>
        </div>
    </div>
</body>

</html>
