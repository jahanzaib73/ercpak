@extends('layouts.app')
@section('purchase-orders-active-class', 'active')
<style>
    /* CSS to set a fixed width and height for the displayed images */
    #imagePreviewContainer img {
        width: 200px;
        /* Set your desired width */
        height: 150px;
        /* Set your desired height */
        margin-right: 10px;
        /* Set the desired spacing between images */
    }

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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="header-title pb-3">Delivery Note</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>DN#: {{ $DnNumber }}</strong>
                            </div>
                        </div>
                        <form id="add_purchase_order_form">
                            @csrf

                            <hr>
                            <div class="row">
                                <!-- Left-side card with customer details -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <p>Employee Name: {{ optional($purchaseOrder->requestBy)->full_name }}</p>
                                        <p>Vendor Name: {{ optional($matchingComparatives->vendor)->name }}</p>

                                    </div>
                                </div>


                                <!-- Right-side card with PO details -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <p>Warehouse: {{ optional($purchaseOrder->warehouse)->name }}</p>
                                                <p>Location: {{ optional($purchaseOrder->location)->name }}</p>
                                            </div>
                                        </div>

                                        <!-- Add more PO details as needed -->
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <tr>
                                            <div class="col-md-12">
                                                <input type="date" value="{{ optional($deliveryNote)->date }}"
                                                    name="date" id="date" class="form-control">
                                            </div>
                                        </tr>
                                        <hr>
                                        <tr>
                                            <div class="col-md-12 text-right">
                                                PR#: {{ $purchaseOrder->parent->parent->id }}
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="col-md-12 text-right">
                                                PO#: {{ $purchaseOrder->id }}
                                                <input type="hidden" value="{{ $purchaseOrder->id }}" name="po_id"
                                                    id="po_id">
                                            </div>
                                        </tr>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Note</h5>
                                    {{ $purchaseOrder->notes }}
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
                                                    <th class="col-2">Received Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($comparatives as $comparative)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><img src="{{ $comparative->item->image_url }}" alt=""
                                                                width="100%"></td>
                                                        <td>{{ $comparative->item->item_name }}</td>
                                                        <td>{{ $comparative->item_price }}</td>
                                                        <td>{{ $comparative->qty }}</td>
                                                        <td>
                                                            <input value="{{ $comparative->delivery_note_qty }}"
                                                                class="form-control received-quantity" type="number"
                                                                data-item-id="{{ $comparative->item->id }}"
                                                                name="item_{{ $comparative->item_id }}" />
                                                            <input type="hidden" value="{{ $comparative->qty }}"
                                                                class="old-quantity" />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <h4>Special Notes</h4>
                            <textarea class="form-control col-xs-12" rows="2" name="notes_for_company"></textarea>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Dispatched By</h5>
                                    <select name="dispatched_by" id="dispatched_by" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ optional($deliveryNote)->dispatched_by == $user->id ? 'selected' : '' }}>
                                                {{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h5>Checked By</h5>
                                    <select name="checked_by" id="checked_by" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ optional($deliveryNote)->checked_by == $user->id ? 'selected' : '' }}>
                                                {{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h5>Received By</h5>
                                    <select name="received_by" id="received_by" class="form-control">
                                        <option value="">Choose...</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ optional($deliveryNote)->received_by == $user->id ? 'selected' : '' }}>
                                                {{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <hr>
                            <div class="d-flex justify-content-end py-5">

                                <button type="button" class="btn save-btn ">Cancel</button>

                                <button type="button" id="add_inspection_btn" class="btn save-btn ml-2">Save</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var items = '';
        {{--  var items = <?php echo json_encode($items); ?>;  --}}
    </script>
    <script>
        $(document).ready(function() {
            // Initialize the form validation
            $("#add_purchase_order_form").validate({
                ignore: [],
                rules: {
                    date: "required",
                    dispatched_by: "required",
                    checked_by: "required",
                    received_by: "required",
                    'item_\\d+': "required", // Use regular expression to match item_* fields
                },
                {{--  messages: {
                    date: "Please select a date",
                    'item_\\d+': "Please select an item", // Use regular expression to match item_* fields
                },  --}}
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
                    'add_purchase_order_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form
                if ($(formElement).valid()) { // Check if the form is valid
                    $.ajax({
                        type: "POST",
                        url: "{{ route('purchase-orders.delivery.note.store') }}",
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
                                {{--  window.location.href = response.url;  --}}

                                location.reload();
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

        function containsKeyword(obj, keyword) {
            for (var key in obj) {
                if (obj.hasOwnProperty(key) && key.indexOf(keyword) !== -1) {
                    return true;
                }
            }
            return false;
        }
        $(document).ready(function() {
            var counter = 1;

            // Define a dictionary to store additional item information based on item ID.
            var itemInfo = {};

            // Populate the itemInfo dictionary with data attributes from the HTML.
            $("#inspection_items option").each(function() {
                var itemId = $(this).val();
                var image = $(this).data("image");
                var unitType = $(this).data("unit-type");
                var remarks = $(this).data("remarks");
                var qty = $(this).data("qty"); // Add qty data attribute

                itemInfo[itemId] = {
                    image: image,
                    unitType: unitType,
                    remarks: remarks,
                    qty: qty // Store qty in the dictionary
                };
            });

            // Populate the item select dropdown with values from the 'items' variable.
            var selectOptions = '';
            for (var i = 0; i < items.length; i++) {

                selectOptions += '<option value="' + items[i].id + '" data-image="' + items[i].image +
                    '" data-unit-type="' + items[i].unit_type + '" data-remarks="' + items[i].notes +
                    '" data-qty="' + items[i].qty + '" data-orignal="NO">' + items[i].item_name + '</option>';
            }
            $("#inspection_items").html('<option value="">Choose...</option>' + selectOptions);

            $("#addrow").on("click", function() {
                var newRow = $("<tr>");
                var cols = "";

                cols += `<td><select class="form-control inspection_items" name="inspection_items[]">
                            <option value="">Choose...</option>
                            ${selectOptions}
                        </select>
                        <p class="text-danger" id="inspection_items.${counter}"></p>
                        </td>`;
                cols +=
                    `<td class="text-center"><img src="" alt="" width="40" id="item_image_${counter}" /></td>`;
                cols += `<td><input type="text" readonly name="unit_type" id="unit_type_${counter}" class="form-control" />
                    <p class="text-danger" id="unit_type.${counter}"></p>
                    </td>`;
                cols +=
                    `<td><input type="number" class="form-control" name="qty[]" id="qty_${counter}"/><p class="text-danger" id="qty_${counter}"></p></td>`;
                cols +=
                    `<td><input type="text" class="form-control" name="remarks[]" id="remarks_${counter}"/><p class="text-danger" id="remarks_${counter}"></p></td>`;

                cols +=
                    '<td><input type="button" class="ibtnDel btn btn-md save-btn "  value="Delete"></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });

            $("table.order-list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1;
            });

            // Use event delegation for dynamically added elements.
            $(document).on('change', '.inspection_items', function() {

                var image = $("option:selected", this).attr("data-image");
                var unitType = $("option:selected", this).attr("data-unit-type");
                var remarks = $("option:selected", this).attr("data-remarks");
                var qty = $("option:selected", this).attr("data-qty");
                var original = $("option:selected", this).attr("data-original");

                // Debugging: Check if you are getting the correct values

                console.log("Image:", image);
                console.log("Unit Type:", unitType);
                console.log("Remarks:", remarks);
                console.log("QTY:", qty);
                console.log("original:", original);

                var selectedItemId = $(this).val();
                var row = $(this).closest("tr");
                var itemInfoForSelected = itemInfo[selectedItemId];

                // Update the image, unit type, qty, and remarks fields in the current row.
                $("#item_image_" + row.index()).attr("src", itemInfoForSelected.image);
                $("#unit_type_" + row.index()).val(itemInfoForSelected.unitType);
                $("#qty_" + row.index()).val(itemInfoForSelected.qty); // Set the qty field
                $("#remarks_" + row.index()).val(itemInfoForSelected.remarks);


                // You may update the remarks field as well if needed.
            });
        });
    </script>
@endsection
