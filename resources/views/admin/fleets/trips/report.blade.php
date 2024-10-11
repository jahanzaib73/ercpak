<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Movement Order</title>
    <style>
        /* Inline CSS styles */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 300px;
            margin: 0 auto;
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

        .header {
            text-align: center;
            font-weight: bold;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .head1 {
            align-items: center;
        }

        .details img {
            max-width: 45%;
            height: auto;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .details th,
        .details td {
            padding: 5px;
            border: 1px solid #000;
            font-size: 10px;
        }

        .qr-code {
            text-align: center;
            margin-top: 20px;
        }

        .print-button {
            text-align: center;
            margin-top: 20px;
        }

        button {
            width: 150px;
            height: 40px;
        }

        .t-col {
            display: flex;
            align-items: center;
        }

        .col-left {
            width: 40%;
            display: flex;
            justify-content: center;
        }

        .col-right {
            width: 60%;
            display: block;
            padding-left: 20px;
            padding-block: 0;
            margin-block: 0;
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
                {{--  <div style="text-align: left;" class="col-right">
                    <p>Consulate General of the <br><strong>United Arab Emirates</strong><br>Karachi</p>
                </div>  --}}
            </div>

        </div>
        <div class="header">
            <h4 style="margin-bottom: 0;">Vehicle Movement Order</h4>
            <p style="text-align: center; margin-top: 0;">Slip #: {{ $trip->id }}</p>
        </div>
        <div class="t-col">
            <div class="col-left">
                <td><img src="{{ optional($trip->vehicle)->image_url }}" alt="Vehicle Photo" height="70px"></td>
            </div>
            <div class="col-right">
                <td style="width: 60%;">
                    <p><strong>{{ optional($trip->vehicle)->vehicle_number }}</strong></p>
                    <p>{{ optional(optional($trip->vehicle)->model)->name }}</p> </BR>
                </td>
            </div>
        </div>
        <div class="t-col mt-5">
            <div class="col-left">
                <td><img src="{{ optional($trip->driver)->profile_pic_url }}" alt="Driver Photo" height="50px"></td>
            </div>
            <div class="col-right">
                <p><strong>{{ optional($trip->driver)->full_name }}</strong></p>
                <p>{{ optional(optional($trip->driver)->designation)->name }}</p></BR>
            </div>
        </div>
        <div class="t-col">
            <div class="col-left">
                <td><img src="{{ optional($trip->official)->profile_pic_url }}" alt="Official Photo" height="50px">
                </td>
            </div>
            <div class="col-right">
                <td style="width: 60%;">
                    <p><strong>{{ optional($trip->official)->full_name }}</strong></p>
                    <p>{{ optional(optional($trip->official)->designation)->name }}</p> </BR>
                </td>
            </div>
        </div>
        <div class="details">

            <table>
                <tr>
                    <th>Date and Time Out</th>
                    <td>{{ $trip->exit_datetime_out }}</td>
                </tr>
                <tr>
                    <th>Meter Out</th>
                    <td>{{ $trip->exit_meetr_reading }}</td>
                </tr>
                <tr>
                    <th>Origin</th>
                    <td>{{ optional($trip)->origin }}</td>
                </tr>
                <tr>
                    <th>Destination</th>
                    <td>{{ optional($trip)->destination }}</td>
                </tr>
                 <tr>
                 <tr>
                    <th>Cost Center</th>
                    <td>{{ optional($trip->costCenter)->title }}</td>
                </tr>
                    <th>Purpose of Trip</th>
                    <td>{{ $trip->notes }}</td>
                </tr> 
                {{--  <tr>
                    <th>Requisite By</th>
                    <td>John Manager</td>
                </tr>
                <tr>
                    <th>Approved By</th>
                    <td></td>
                </tr>  --}}
            </table>
        </div>
        <div class="qr-code">
            <center>
                <div class="mb-3">{!! DNS2D::getBarcodeHTML((string) $trip->id, 'QRCODE',4,4) !!}
                </div>
            </center>
        </div>
        <div style="text-align: center;">
            <p>Printed By: {{ Auth::user()->full_name }} @ {{ now() }}</p>
        </div>
    </div>
</body>

</html>
