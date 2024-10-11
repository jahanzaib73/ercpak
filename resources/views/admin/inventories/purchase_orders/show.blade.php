@extends('layouts.app')
@section('purchase-orders-active-class', 'active')
@section('css')
    <style>
        .header {

            color: rgb(0, 0, 0);
            text-align: center;
            border: gray solid 1px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .card {
            margin: 10px;
            padding: 30px;
            width: 100%
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

            body * {
                visibility: hidden;
            }

            #print-area,
            #print-area * {
                visibility: visible;
            }

        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        @if ($purchaseOrder->status == 0 || $purchaseOrder->status == 1)
            <div id="print-area">
                <div class="ml-1 bg-info text-white mb-3 row" style="padding: 15px">
                    <div class="col-md-6">
                        <h3>Requisition ({{ $purchaseOrder->status == 1 ? 'APPROVED' : 'Not Approved' }})</h3>
                    </div>



                    <div class="text-right col-md-6">
                        <!-- Button trigger modal -->
                        @if (Auth::user()->can('Print Requisition'))
                            <a class="btn save-btn btn-sm print-button"
                                href="{{ route('purchase-orders.report', ['id' => $purchaseOrder->id]) }}"
                                target="_blank">Print
                                Preview</a>
                        @endif
                        @if ($purchaseOrder->status == 0)

                            @if (Auth::user()->can('Comparative Approved'))
                                |
                                <a href="{{ route('purchase-orders.approved', ['id' => $purchaseOrder->id]) }}"
                                    onclick="return confirm('Are you sure?')" class="btn btn-primary btn-sm px-5"
                                    id="approved">
                                    Approved </a>
                            @endif
                        @endif
                        {{--  <a href="{{ route('purchase-orders.delete', ['id' => $purchaseOrder->id]) }}"
                    class="btn btn-danger  btn-sm px-5" onclick="return confirm('Are you sure?')"> Delete</a>  --}}
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @php
                    Session::forget('success');
                @endphp

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
                                    <td><img src="{{ optional($orderItem->item)->image_url }}" alt=""
                                            width="50px">
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
                        <!-- Add content for totals here -->
                    </div>
                </div>

                <!-- Approved By -->
                <div class="row justify-content-between">
                    <div class="col-md-4 mt-5">
                        <hr>
                        <p>Approved By:
                            {{ optional($purchaseOrder->approvedBy)->full_name ? optional($purchaseOrder->approvedBy)->full_name : 'Not Approved Yet' }}
                        </p>
                    </div>
                    <div class="col-md-2 mt-5">
                        <!-- QR code of PO number goes here -->
                        <div class="mb-3">{!! DNS2D::getBarcodeHTML("$purchaseOrder->id", 'DATAMATRIX') !!}</div>
                    </div>
                </div>
            </div>
        @elseif($purchaseOrder->status == 2)
            <div id='printMe'>
                <form id="comparative-form">
                    <div class="card">
                        <h3> Purchase Requisition / Comparative</h3>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @php
                            Session::forget('success');
                        @endphp
                        <div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <h3><i class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i></h3>
                                            <h5>Req.#:<strong>{{ optional($purchaseOrder->parent)->id ?: 'N/A' }}</strong>
                                            </h5>
                                            <h5>Date:<strong>{{ $purchaseOrder->date }}</strong></h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <hr>
                                            <h3><i class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i></h3>
                                            <h5>Comparative #:<strong>{{ $purchaseOrder->id }}</strong></h5>
                                            <h5>Date:</h5> <input type="date" name="date" id="date"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12 col-md-6">
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Location</td>
                                                    <th>{{ optional($purchaseOrder->location)->name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Request By</td>
                                                    <th>{{ optional($purchaseOrder->requestBy)->full_name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Vendor</td>
                                                    <th>{{ optional($purchaseOrder->vendor)->name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Warehouse</td>
                                                    <th>{{ optional($purchaseOrder->warehouse)->name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Terms</td>
                                                    <th>{{ $purchaseOrder->terms }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Ship Via</td>
                                                    <th>{{ $purchaseOrder->ship_via }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Item Detail</h3>
                                </div>
                                <div class="col-md-6">
                                    <label for="vendor_id">Select Vendor</label>
                                    <select name="vendor_id" id="vendor_id" class="form-control" multiple>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table id="tbl" class="table table-responsive">
                                <thead>
                                    <tr id="1">
                                        <th class="col-1">#</th>
                                        <th class="col-2">Photo</th>
                                        <th class="col-3">Items</th>
                                        {{--  <th class="col-3">Items ID</th>  --}}
                                        <th class="col-1">Unit Type</th>
                                        <th class="col-2">Qty</th>
                                        <th class="col-3">Remarks</th>
                                        <!-- Add a new header cell for prices -->
                                        <th class="col-4" id="priceHeader"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (optional($purchaseOrder->parent)->purchaseOrderItems)
                                        @foreach (optional($purchaseOrder->parent)->purchaseOrderItems as $orderItem)
                                            <tr id="{{ $loop->iteration }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $orderItem->item->image_url }}" alt=""
                                                        width="50%">
                                                </td>
                                                <td>{{ $orderItem->item->name }}</td>
                                                {{--  <td>{{ $orderItem->item->id }}</td>  --}}
                                                <td>{{ optional(optional($orderItem->item)->unitType)->name }}</td>
                                                <td>{{ $orderItem->qty }}</td>
                                                <td>{{ $orderItem->remarks }}</td>
                                                <!-- Add a new cell with an editable text box for prices with a unique ID -->
                                                <td class="priceCell" data-item-id="{{ $orderItem->item->id }}"
                                                    id="priceCell_{{ $loop->iteration }}"></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-6 offset-md-6">
                                    <table class="table table-bordered table-hover" id="tab_logic_total">
                                        <tbody>
                                            <!-- Placeholder for dynamic vendor sections -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-between">
                            <button class="btn save-btn btn-lg px-4" type="button" id="submitAttachmentFormButton">Save &
                                Make
                                PO</button>
                        </div>
                </form>
            </div>
            {{--  @elseif($purchaseOrder->status == 4)
            <div id='printMe'>
                <form id="comparative-form">
                    <div class="card">
                        <h3> Purchase Requisition / Comparative</h3>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @php
                            Session::forget('success');
                        @endphp
                        <div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <h3><i class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i></h3>
                                            <h5>Req.#:<strong>{{ optional($purchaseOrder->parent)->id ?: 'N/A' }}</strong>
                                            </h5>
                                            <h5>Date:<strong>{{ $purchaseOrder->date }}</strong></h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <hr>
                                            <h3><i class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i><i
                                                    class="fa-solid fa-barcode fa-lg"></i></h3>
                                            <h5>Comparative #:<strong>{{ $purchaseOrder->id }}</strong></h5>
                                            <h5>Date: <strong>{{ $purchaseOrder->date }}</strong></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12 col-md-6">
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Location</td>
                                                    <th>{{ optional($purchaseOrder->location)->name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Request By</td>
                                                    <th>{{ optional($purchaseOrder->requestBy)->full_name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Vendor</td>
                                                    <th>{{ optional($purchaseOrder->vendor)->name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Warehouse</td>
                                                    <th>{{ optional($purchaseOrder->warehouse)->name }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Terms</td>
                                                    <th>{{ $purchaseOrder->terms }}</th>
                                                </tr>
                                                <tr>
                                                    <td>Ship Via</td>
                                                    <th>{{ $purchaseOrder->ship_via }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Item Detail</h3>
                                </div>
                                <div class="col-md-6">
                                    <label for="vendor_id">Select Vendor</label>
                                    <select name="vendor_id" id="vendor_id" class="form-control" multiple>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}"
                                                {{ in_array($vendor->id, $approvedVednorsIds->toArray()) ? 'selected' : '' }}>
                                                {{ $vendor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table id="tbl" class="table table-responsive">
                                <thead>
                                    <tr id="1">
                                        <th class="col-1">#</th>
                                        <th class="col-2">Photo</th>
                                        <th class="col-3">Items</th>
                                        <th class="col-1">Unit Type</th>
                                        <th class="col-2">Qty</th>
                                        <th class="col-3">Remarks</th>
                                        <!-- Add a new header cell for prices -->
                                        <th class="col-4" id="priceHeader"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (optional(optional($purchaseOrder->parent)->parent)->purchaseOrderItems)
                                        @foreach (optional(optional($purchaseOrder->parent)->parent)->purchaseOrderItems as $orderItem)
                                            <tr id="{{ $loop->iteration }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $orderItem->item->image_url }}" alt=""
                                                        width="50%">
                                                </td>
                                                <td>{{ $orderItem->item->item_name }}</td>
                                                <td>{{ $orderItem->item->unitType->name }}</td>
                                                <td>{{ $orderItem->qty }}</td>
                                                <td>{{ $orderItem->remarks }}</td>
                                                <!-- Add a new cell with an editable text box for prices with a unique ID -->
                                                <td class="priceCell" id="priceCell_{{ $loop->iteration }}"></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-6 offset-md-6">
                                    <table class="table table-bordered table-hover" id="tab_logic_total">
                                        <tbody>
                                            <!-- Placeholder for dynamic vendor sections -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center justify-content-between">
                            <button class="btn save-btn btn-lg px-4" type="button" id="submitAttachmentFormButton">Save
                                &
                                Make
                                PO</button>
                        </div>
                </form> <!-- Dont forget to add the closing </form> tag -->
            </div>  --}}
        @endif
    </div>
    <hr>
    <input type="hidden" id="get_vendor_by_id" value="{{ route('get.vendor.by.id') }}">

@endsection

@section('script')
    <script>
        var purchaseOrderId = {{ $purchaseOrder->id }};
        var status = {{ $purchaseOrder->status }};
    </script>
    <script src="{{ asset('app_js_functions/purchase_order.js') }}"></script>
    <script>
        $(document).ready(function() {
            if (status == 4) {
                $('#vendor_id').trigger('change')
            }
            $("#comparative-form").validate({
                rules: {
                    date: "required",
                    vendor_id: "required"
                },
                messages: {
                    date: "Please Select date",
                    vendor_id: "Please Select Vendor",
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2')) {
                        error.insertAfter(element.next(
                            '.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        })

        $(document).ready(function() {
            $('#submitAttachmentFormButton').click(function() {

                if ($('#comparative-form').valid()) { // Check if the form is valid
                    var checkedVendorId = $('input[name="approve_vendor_"]:checked').data('vendor-id');

                    var uniqueItemIds = [...new Set(itemIDs)];


                    var idMap = {}; // Create a mapping from old item_ids to new item_ids

                    for (var i = 0; i < uniqueItemIds.length; i++) {
                        idMap[i + 1] = uniqueItemIds[i];
                    }

                    for (var j = 0; j < vendorWiseData.length; j++) {
                        var currentItem = vendorWiseData[j];
                        var oldItemId = currentItem.item_id;

                        if (idMap.hasOwnProperty(oldItemId)) {
                            currentItem.item_id = idMap[oldItemId];
                        }
                    }

                    var data = {
                        'approvedVendor': checkedVendorId,
                        'vendorWiseData': vendorWiseData,
                        'purchaseOrderId': purchaseOrderId,
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('store.comparative') }}",
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                window.location.href = response.url;
                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        });
    </script>
@endsection
