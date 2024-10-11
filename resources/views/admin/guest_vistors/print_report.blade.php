<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 0;
            padding: 0;
            size: A4 portrait;

            height: 100vh;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                size: A4 portrait;
                margin-left: 80px;
                margin-right: 50px;
                background-image: url("{{ asset('assets/images/lh.png') }}");
                height: 100vh;
            }

            header,
            footer {
                text-align: left;
                padding: 10px;
                position: absolute;
                /* position: fixed; */
                width: 100%;
            }

            header {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            footer {
                margin-bottom: 40;
                display: none;
            }

            .container {
                display: flex;
                justify-content: space-between;
                padding: 10px 20px;
                z-index: -1
            }

            .left-column {
                width: 49%;
                padding: 10px;
                box-sizing: border-box;
            }

            .right-column {
                width: 49%;
                text-align: right;
                padding: 10px;
                box-sizing: border-box;
            }

            .table-container {
                margin-top: 0px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }

            #printButton {
                display: block;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
            }

            #printButton:hover {
                background-color: #0056b3;
            }

            .left-column-1 {
                width: 20%;
                padding: 10px;
                box-sizing: border-box;
                margin-right: 20px;
            }

            .report-cont {
                margin-top: 30px;
            }

        }

        @media screen {
            body {
                size: A4 portrait;
                margin-left: 350px;
                margin-right: 350px;
            }

            header,
            footer {
                text-align: left;
                padding: 10px;
                /* position: fixed; */
                width: 100%;
            }

            header {
                top: 0;
            }

            footer {
                bottom: 0;
            }

            .container {
                display: flex;
                justify-content: space-between;
                padding: 80px 20px;
            }

            .left-column-1 {
                width: 20%;
                padding: 10px;
                box-sizing: border-box;
                margin-right: 10px;
            }

            .left-column-2 {
                width: 28%;
                padding: 10px;
                box-sizing: border-box;
            }

            .right-column {
                width: 49%;
                text-align: right;
                padding: 10px;
                box-sizing: border-box;
            }

            .table-container {
                margin-top: 10px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }

            #printButton {
                display: block;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
            }

            #printButton:hover {
                background-color: #0056b3;
            }
        }
    </style>
</head>

<body>
    <header>

    </header>
    <h1 style="text-align: right; margin-top: 120px"></h1><br>
    <div class="container report-cont">
        <div class="left-column-1">
            <img src="{{ $guest_visitor->type == 'GUEST' ? (optional($guest_visitor->guest)->official_name ? optional(optional($guest_visitor->guest)->officialImage)->file_url : optional(optional($guest_visitor->guest)->officialImage)->file_url) : $guest_visitor->image_url }}"
                alt="Customer Photo" width="100">

        </div>

        <div class="left-column-2">
            <label style="padding-bottom: 50px;"><strong>Name:</strong>
                {{ $guest_visitor->type == 'GUEST' ? (optional($guest_visitor->guest)->official_name ? optional($guest_visitor->guest)->official_name : optional($guest_visitor->guest)->notable_name) : $guest_visitor->vistor_name }}</label><br>
            <hr>
            <label style="padding-block: 15px;"><strong>Passport #:</strong>
                {{ $guest_visitor->passport_number }}</label><br>
            <hr>
            <label style="padding-block: 15px;"><strong>Email:</strong>
                {{ $guest_visitor->type == 'GUEST' ? (optional($guest_visitor->guest)->official_email ? optional($guest_visitor->guest)->official_email : optional($guest_visitor->guest)->notable_email) : $guest_visitor->vistor_email }}</label><br>
            <hr>
            <label style="padding-block: 15px;"><strong>Phone:</strong>
                {{ $guest_visitor->vistor_contact ? $guest_visitor->vistor_contact : 'N/A' }}</label><br>
        </div>

        <div class="right-column">
            <div style="display: inline-flex;">
                <p><strong>Barcode:</strong>
                <div style="margin-left: 23px; margin-top: 8px">
                    <center>
                        <div class="mb-3">{!! DNS1D::getBarcodeHTML("$guest_visitor->id", 'C39') !!}</div>
                    </center>
                </div>
                </p>
            </div>
            <p><strong>Invoice Number:</strong>
                <span style="margin-left: 47px">{{ $guest_visitor->id }}</span>
            </p>
            <p><strong>Invoice Date:</strong> {{ Carbon\Carbon::parse($guest_visitor->time_in)->toDateString() }}</p>
        </div>
    </div>

    <div class="table-container">
        <table>
            <tr style="background-color: gainsboro;">
                <th>Type</th>
                <th>Details</th>
                <th style="text-align: right;">Amount</th>
            </tr>

            <tr>
                <td>{{ optional($guest_visitor->pyrposeOfVisit)->name }}</td>
                <td>{{ $guest_visitor->notes }}</td>
                <td style="text-align: right;">{{ $guest_visitor->currency }}
                    {{ number_format($guest_visitor->fee, 2) }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h5>Note:</h5>
        <label for="">1. Non Refundable.</label><br>
        <label for="">2. Rules & Regulations will be applied as per UAE Government Law.</label><br>
        <label for="">3. Please bring original receipt at the time of collection.</label><br>
        <label for="">4. Please collect your passport within 14 days after the consulate general will never
            responsible.</label><br>
        <label for="">5. This receipt for office record only</label><br>

        <p>Printed by: {{ Auth::user()->full_name }} @ {{ Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>

    </div>


    <div style="width: 100%; display: flex; justify-content: flex-end;">
        <table style="width: 50%; margin-top: 10px; margin-right: 0%; ">
            <thead style="border: 1px solid;">
                <th style="background-color: gainsboro; padding-top: 15px; padding-bottom: 20px;"></th>
                <th style="background-color: gainsboro; padding-top: 20px; padding-bottom: 20px;">
                    Acknowledged By</th>
            </thead>
            <tbody>
                <tr style="border: 1px solid;">
                    <td style="width:40%; border: 1px solid; padding-bottom: 15px; padding-top: 30px;">
                        Accounts</td>
                    <td style="width:60%; border: 1px solid; padding-bottom: 15px; padding-top: 30px;">
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="border: 1px solid; padding-top: 15px; padding-bottom: 15px; width:40%;">
                        DDV
                    </td>
                    <td style="border: 1px solid; padding-bottom: 15px; width:60%; padding-top: 30px;">
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="width:40%; border: 1px solid; padding-top: 15px; padding-bottom: 30px;">
                        Biometric</td>
                    <td style="width:60%; border: 1px solid; padding-bottom: 15px; padding-top: 30px;">
                    </td>
                </tr>
                <tr style="border: 1px solid;">
                    <td style="width:40%; border: 1px solid; padding-top: 15px; padding-bottom: 30px;">
                        Interview</td>
                    <td style="width:60%; border: 1px solid; padding-bottom: 15px; padding-top: 30px;">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer>
        <button id="printButton" onclick="printWithBackground()">Print Report</button>
    </footer>
</body>
<script>
    // Preload background image
    var backgroundImage = new Image();
    backgroundImage.src = "{{ asset('assets/images/lh.png') }}";

    // Function to print after image is loaded
    function printWithBackground() {
        window.print();
    }
</script>

</html>
