@extends('layouts.app')
@section('purchase-orders-active-class', 'active')
<style>
    .select2-container {
        width: 100% !important;
    }

    .user-card {
        width: 300px;
        /* Set the desired width for each card */
        margin: 10px;
        /* Add some margin to separate cards */
        border: 1px solid #ccc;
        /* Add a border for visual separation */
        padding: 10px;
        /* Add padding to the card content */
        text-align: center;
        /* Center the content horizontally */
    }

    .user-card img {
        max-width: 30%;
        /* Ensure the image doesn't exceed the card width */
        border-radius: 50%;
        /* Make the image a circle by setting border-radius */
    }

    .card {
        margin: 10px;
        padding: 10px;
    }
</style>
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <form id="add_work_order_form">
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        <input type="hidden" name="wo_id" value="{{ $invoice->work_order_id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="pb-3">Purchase Order Invoice</h2>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong>Invoice#: {{ $invoice->id }}</strong>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Left-side card with customer details -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <p>Request By: {{ optional($invoice->requestBy)->full_name }} </p>
                                        <p>Issue By: {{ optional($invoice->issueBy)->full_name }}</p>
                                        <p>Date: {{ $invoice->date }}</p>

                                    </div>
                                </div>


                                <!-- Right-side card with PO details -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <p>Warehouse: {{ optional($invoice->warehouse)->name }}</p>
                                                <p>Location: {{ optional($invoice->location)->name }}</p>
                                                <p>Cost Center: {{ optional($invoice->costCenter)->title }}</p>
                                            </div>
                                        </div>

                                        <!-- Add more PO details as needed -->
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <tr>
                                            <div class="col-md-12 text-right">
                                                WO#: {{ optional($invoice->Workorder)->id }}
                                            </div>
                                        </tr>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="special_notes">Notes</label>
                                    {{--  <textarea class="form-control" name="special_notes" id="special_notes" cols="30" rows="2">{{ $invoice->notes }}</textarea>  --}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Add Items</h3>
                                    <p class="text-danger" id="checklist-error"></p>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr id="1">
                                                    <th class="col-1">#</th>
                                                    <th class="col-2">Photo</th>
                                                    <th class="col-3">Items</th>
                                                    <th class="col-2">Price</th>
                                                    <th class="col-2">Qty</th>
                                                    <th class="col-2">Issued Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $woitem)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><img src="{{ $woitem->item->image_url }}" alt=""
                                                                width="100%"></td>
                                                        <td>{{ $woitem->item->item_name }}</td>
                                                        <td>{{ $woitem->item->unit_cost }}</td>
                                                        <td>{{ $woitem->item->qty }}</td>
                                                        <td>

                                                            <?php
                                                            $issueOrder = App\Models\IssueOrder::where('invoice_id', $invoice->id)
                                                                ->where('wo_id', $invoice->work_order_id)
                                                                ->where('item_id', $woitem->item->id)
                                                                ->first();
                                                            ?>

                                                            <input value="{{ optional($issueOrder)->issued_qty ?: 0 }}"
                                                                class="form-control received-quantity" type="number"
                                                                data-item-id="{{ $woitem->item->id }}"
                                                                name="item_{{ $woitem->item->id }}" />
                                                            <input type="hidden" value="{{ $woitem->qty }}"
                                                                class="old-quantity" />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <?php
                            $InvoiceItem = App\Models\IssueOrder::where('invoice_id', $invoice->id)->first();
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="special_notes">Special Notes</label>
                                    {{--  <textarea class="form-control" name="special_notes" id="special_notes" cols="30" rows="2">{{ optional($InvoiceItem)->special_notes }}</textarea>  --}}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="recommended_by">Recommanded By</label>
                                    <select name="recommended_by" id="recommended_by" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == optional($InvoiceItem)->recommanded_by ? 'selected' : '' }}>
                                                {{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="approved_by">Approved By</label>
                                    <select name="approved_by" id="approved_by" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == optional($InvoiceItem)->approved_by ? 'selected' : '' }}>
                                                {{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    {{--  <a href="" class="btn btn-lg btn-primary">Submit For Approval</a>  --}}
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-lg btn-danger">Cancel</a>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" id="add_inspection_btn"
                                        class="btn btn-lg btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize the form validation
            $("#add_work_order_form").validate({
                ignore: [],
                rules: {
                    recommended_by: "required",
                    approved_by: "required",
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
        });


        $(document).ready(function() {
            $('#add_inspection_btn').click(function() {
                var formElement = document.getElementById(
                    'add_work_order_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form
                if ($(formElement).valid()) { // Check if the form is valid
                    $.ajax({
                        type: "POST",
                        url: "{{ route('issueOrderWoStore') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (!response.status) {
                                $('#meter_reading_erors').text(response.message)
                            } else {
                                $('#meter_reading_erors').text('')
                            }
                            if (response.status) {
                                window.location.href = response.url;
                            }
                        },
                        error: function(error) {
                            if (error.responseJSON) {
                                var errors = error.responseJSON.errors;

                                if (containsKeyword(errors, 'inspection_') || containsKeyword(
                                        errors, 'remarks')) {
                                    $('#checklist-error').text(
                                        'Checklist all items are required')
                                } else {
                                    $('#checklist-error').text('')
                                }

                                if (containsKeyword(errors, 'vehicle_id')) {
                                    $('#vehicle_error').text(
                                        'Please select vehicle')
                                } else {
                                    $('#vehicle_error').text('')
                                }

                                if (containsKeyword(errors, 'property_id')) {
                                    $('#property_error').text(
                                        'Please select property')
                                } else {
                                    $('#property_error').text('')
                                }

                                if (containsKeyword(errors, 'workorder_ids')) {
                                    $('#work_order_id').text(
                                        'Please select Work Order')
                                } else {
                                    $('#work_order_id').text('')
                                }

                            } else {
                                $('#checklist-error').text('')
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
