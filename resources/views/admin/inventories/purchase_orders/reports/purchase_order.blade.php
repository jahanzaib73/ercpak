<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Requisition</title>

    <!-- Bootstrap CSS -->
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
        /* @page  { size: landscape; } */
        /* Custom CSS */
        .header {

            color: rgb(0, 0, 0);
            text-align: center;
            border: gray solid 1px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .card {
            margin: 10px;
            padding: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .footer {
            margin-top: 20px;
        }

        .totals {
            font-weight: bold;
        }

        /* Hide print preview button on print */
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body style="background-color: #fff;">
    <div class="container mt-5">
        <div class="text-center">
            <img src="{{ asset('assets/images/LH-header.png') }}" alt="image not found" class="img-fluid w-75">
        </div>
        <!-- Print Preview Button -->
        <div class="d-flex justify-content-center pb-4">
            <button class="btn save-btn print-button" onclick="window.print()">Print Preview</button>
        </div>

        <div class="text-center pt-2">
            <h1>Purchase Requisition</h1>
        </div>
        <div class="row">
            <!-- Left-side card with customer details -->
            <div class="col-md-6">
                <div class="card">
                    <p>Request By: {{ optional($purchaseOrder->requestBy)->full_name }}</p>
                    <p>Location: {{ optional($purchaseOrder->location)->name }}</p>
                    <!-- Add more customer details as needed -->
                </div>
            </div>
            <!-- Right-side card with PO details -->
            <div class="col-md-6">
                <div class="card">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p>Req #: {{ $purchaseOrder->id }}</p>
                            <p>Date: {{ $purchaseOrder->date }}</p>
                        </div>

                    </div>

                    <!-- Add more PO details as needed -->
                </div>
            </div>
        </div>
        <hr>
        <div>
            <h2 class="text-center">Items Details</h2>
        </div>
        <!-- Table for purchase order items -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Item Photo</th>
                        <th>Item Code</th>
                        <th>Item Description</th>
                        <th>Unit Type</th>
                        <th>Qty</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseOrder->purchaseOrderItems as $orderItem)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ optional($orderItem->item)->image_url }}" alt="" width="50px">
                            </td>
                            <td>{{ optional($orderItem->item)->item_code }}</td>
                            <td>{{ optional($orderItem->item)->description }}</td>
                            <td>{{ optional(optional($orderItem->item)->unitType)->name }}</td>
                            <td>{{ number_format($orderItem->qty, 2) }}</td>
                            <td>{{ $orderItem->remarks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Table for totals -->
        <div class="row">
            <div class="col-md-8">

            </div>

        </div>

        <!-- Approved By -->
        <div class="justify-content-end row">
            <div class="col-md-4 mt-5 text-right">
                <hr>
                <div class="align-items-center">
                    <span>Approved By:
                        {{-- {{ optional($purchaseOrder->approvedBy)->full_name ? optional($purchaseOrder->approvedBy)->full_name : 'Not Approved Yet' }} --}}
                    </span>
                    @if (optional($purchaseOrder->approvedBy->signature)->file_url)
                        <img src="{{ $purchaseOrder->approvedBy->signature->file_url }}" width="175" alt=""
                            class="img-fluid">
                    @else
                        <span>Not Approved Yet</span>
                    @endif
                </div>
            </div>
            <div class="col-md-2">
                <!-- QR code of PO number goes here -->
                <div class="mb-3">{!! DNS2D::getBarcodeHTML("$purchaseOrder->id", 'DATAMATRIX') !!}</div>

                {{--  <div class="mb-3" style="width: 50px">{!! DNS2D::getBarcodeHTML("$purchaseOrder->id", 'QRCODE') !!}</div>  --}}
            </div>
            {{--  <div class="col-md-2"></div>  --}}
        </div>
        <!-- <div class="footer"> -->
        <!-- Footer content goes here (company address) -->
        <!-- <p>Company Address: 456 Business St, City</p>
        </div> -->
    </div>


    <!-- Bootstrap and JavaScript links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
