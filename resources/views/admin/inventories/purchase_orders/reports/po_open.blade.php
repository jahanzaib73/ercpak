<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order Report</title>

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
        /* Custom CSS */
        .header {
            height: 1.5in;
            /* background-color: #007bff; */
            color: white;
            text-align: center;
            padding-top: 20px;
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

        .header {
            display: flex;
            justify-content: center;
            /* Horizontally center the content */
            align-items: center;
            /* Vertically center the content */
            {{--  height: 100vh;  --}}
            /* Optional: Set a specific height to center within the viewport */
        }

        h1 {
            text-align: center;
            /* Optional: Center the text horizontally within the h1 element */
        }
    </style>
</head>

<body style="background-color: #fff">
    <div class="container mt-3">
        <div class="text-center">
            <img src="{{ asset('assets/images/LH-header.png') }}" alt="image not found" class="img-fluid w-75">
        </div>
        <!-- Print Preview Button -->
        <div class="d-flex justify-content-center pb-4">
            @if (Auth::user()->can('Purchase Order Print'))
                <button class="btn save-btn print-button" onclick="window.print()">Print Preview</button> &nbsp;
            @endif

            @if ($purchaseOrder->status == 4)
                @if (Auth::user()->can('Purchase Order Close PO'))
                    <a class="btn save-btn print-button" data-toggle="modal" data-target="#exampleModal">Close PO</a>
                @endif
            @endif
        </div>

        <div class="header purchaseOrder-header">
            <h1 class="text-dark">Purchase Order</h1>
        </div>
        <div class="row">
            <!-- Left-side card with customer details -->
            <div class="col-md-6">
                <div class="card">
                    <h3 >Vendor Details</h3>
                    <hr>
                    <p>Vendor Name: {{ optional($matchingComparatives->vendor)->name }}</p>
                    <p>Address: {{ optional($matchingComparatives->vendor)->address ?: 'N/A' }}</p>
                    <!-- Add more customer details as needed -->
                </div>
            </div>
            <!-- Right-side card with PO details -->
            <div class="col-md-6">
                <div class="card">
                    <h3>PO Details</h3>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p>PO #: {{ $purchaseOrder->id }}</p>
                            <p>PO Date: {{ $purchaseOrder->date }}</p>
                        </div>
                        <div class="col-md-6">
                            <img src="img/barcode.png" alt="" width="100%">
                        </div>
                    </div>

                    <!-- Add more PO details as needed -->
                </div>
            </div>
        </div>
        <div class="row">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 10%; border: 1px solid #898989; padding: 10px;">Purchaser</td>
                    <td style="width: 10%; border: 1px solid #898989; padding: 10px;">Warehouse</td>
                    <td style="width: 10%; border: 1px solid #898989; padding: 10px;">Ship To</td>
                    <td style="width: 20%; border: 1px solid #898989; padding: 10px;">Location Name</td>
                </tr>
                <tr>
                    <td style="width: 10%; border: 1px solid #898989; padding: 10px;">
                        {{ optional($purchaseOrder->requestBy)->full_name }}</td>
                    <td style="width: 10%; border: 1px solid #898989; padding: 10px;">
                        {{ optional($purchaseOrder->warehouse)->name }}</td>
                    <td style="width: 10%; border: 1px solid #898989; padding: 10px;">{{ $purchaseOrder->ship_via }}
                    </td>
                    <td style="width: 20%; border: 1px solid #898989; padding: 10px;">
                        {{ optional($purchaseOrder->location)->name }}</td>
                </tr>
            </table>
        </div>
        <hr>
        <div>
            <h2 class="text-center">Items Details</h2>
        </div>
        <!-- Table for purchase order items -->
        <div class="table-responsive">
            <table id="tbl" class="table table-responsive">

                <thead>
                    <tr id="1">
                        <th class="col-1">#</th>
                        <th class="col-2">Photo</th>
                        <th class="col-3">Items</th>
                        {{--  <th class="col-2">Vendor</th>  --}}
                        <th class="col-2">Price</th>
                        <th class="col-1">Unit Type</th>
                        <th class="col-2">Qty</th>
                        <th class="col-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subTotal = 0;
                    ?>
                    @foreach ($comparatives as $comparative)
                        <tr id="2">
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ $comparative->item->image_url }}" alt="" width="100%"></td>
                            <td>{{ $comparative->item->item_name }}</td>
                            {{--  <td>{{ $comparative->vendor->name }}</td>  --}}
                            <td>{{ $comparative->item_price }}</td>
                            <td>{{ optional(optional($comparative->item)->unitType)->name }}</td>
                            <td>{{ number_format($comparative->qty, 2) }}</td>
                            <td>{{ number_format($comparative->qty * $comparative->item_price, 2) }}</td>
                        </tr>
                        <?php
                        $subTotal += $comparative->sub_total;
                        ?>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- Table for totals -->
        <div class="row">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
                <div class="totals">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Total</td>
                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                {{ $subTotal }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Tax</td>
                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                {{ $matchingComparatives->cgst }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Tax AMount</td>
                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                {{ $matchingComparatives->cgst_amount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 40%; border: 1px solid #898989; padding: 10px;">Grand Total</td>
                            <td style="width: 60%; border: 1px solid #898989; padding: 10px;">Rs.
                                {{ $matchingComparatives->total_amount }}</td>
                        </tr>
                    </table>
                    <hr>
                </div>
            </div>
        </div>

        <!-- Approved By -->
        <div class="row justify-content-between">
            <div class="col-md-4 text-right">
                {{-- <hr>
                <p>Approved By: {{ optional($purchaseOrder->approvedBy)->full_name }}</p> --}}
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
            </div>
        </div>
        <!-- <div class="footer"> -->
        <!-- Footer content goes here (company address) -->
        <!-- <p>Company Address: 456 Business St, City</p>
        </div> -->
    </div>
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 146%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Close PO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="po_close_form">
                        <div class="row">
                            <!-- Left-side card with customer details -->
                            <div class="col-md-5">
                                <div class="card">
                                    <h3>Vendor Details</h3>
                                    <hr>
                                    <p>Vendor Name: {{ optional($matchingComparatives->vendor)->name }}</p>
                                    <p>Address: {{ optional($matchingComparatives->vendor)->address ?: 'N/A' }}</p>
                                    <!-- Add more customer details as needed -->
                                </div>
                            </div>
                            <!-- Right-side card with PO details -->
                            <div class="col-md-7">
                                <div class="card">
                                    <h3>PO Details</h3>
                                    <hr>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <p>PO #: {{ $purchaseOrder->id }}</p>
                                            <p>PO Date: {{ $purchaseOrder->date }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="img/barcode.png" alt="" width="100%">
                                        </div>
                                    </div>

                                    <!-- Add more PO details as needed -->
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr id="1">
                                        <th class="col-1">#</th>
                                        <th class="col-2">Photo</th>
                                        <th class="col-3">Items</th>
                                        <th class="col-2">Price</th>
                                        <th class="col-2">Qty</th>
                                        <th class="col-2">Received Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comparatives as $comparative)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ $comparative->item->image_url }}" alt=""
                                                    width="100%"></td>
                                            <td>{{ optional($comparative->item)->item_name }}</td>
                                            <td>{{ $comparative->item_price }}</td>
                                            <td>{{ $comparative->qty }}</td>
                                            <td>
                                                <input value="{{ $comparative->received_qty }}"
                                                    class="form-control received-quantity" type="number"
                                                    data-item-id="{{ $comparative->item->id }}" />
                                                <input type="hidden" value="{{ $comparative->qty }}"
                                                    class="old-quantity" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update-quantities">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and JavaScript links -->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#update-quantities').on('click', function() {
                var quantities = [];
                $('.received-quantity').each(function() {
                    var itemId = $(this).data('item-id');
                    var receivedQuantity = parseInt($(this).val());
                    var oldQuantity = parseInt($(this).siblings('.old-quantity').val());
                    quantities.push({
                        itemId: itemId,
                        receivedQuantity: receivedQuantity,
                        oldQuantity: oldQuantity
                    });
                });

                // Get the purchaseOrder ID from wherever it is available in your page or script
                var purchaseParentOrderId =
                    '{{ $parent->id }}'; // Replace with the actual purchaseOrder ID
                var purchaseOrderId =
                    '{{ $purchaseOrder->id }}'; // Replace with the actual purchaseOrder ID

                $.ajax({
                    type: 'POST',
                    url: "{{ route('po.closed') }}", // Create a route for this
                    data: {
                        purchaseOrderId: purchaseOrderId, // Include purchaseOrder ID
                        purchaseParentOrderId: purchaseParentOrderId, // Include purchaseOrder ID
                        quantities: quantities,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        // Handle error, if needed
                    }
                });
            });
        });
    </script>
</body>

</html>
