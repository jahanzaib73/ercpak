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
</style>
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3 class="header-title pb-3">Add Requisition</h3>
                        <form id="add_purchase_order_form">
                            @csrf
                            <h5>Basic Information</h5>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <h6 for="date" class="light-dark">Date</h6>
                                    <input type="date" class="form-control" name="date" id="date"
                                        placeholder="Date">
                                </div>
                                <div class="col-md-4">
                                    <h6 class="light-dark">Location</h6>
                                    <select name="location_id" class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="light-dark">Request By</h6>
                                    <select name="user_id" class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Request By</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <h6 class="light-dark">Vendor</h6>
                                    <select name="vendor_id" class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="light-dark">WOs (Multi Select)</h6>
                                    <select name="workorder_ids[]" multiple class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">WOs (Multi Select)</option>
                                        @foreach ($workOrders as $wo)
                                            <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger" id="work_order_id"></p>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="light-dark">Warehouse</h6>
                                    <select name="warehouse_id" class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <h6 class="light-dark">Terms</h6>
                                    <input type="text" name="term" id="term" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <h6 class="light-dark">Ship Via</h6>
                                    <select name="ship_via" class="select2 form-control mb-3 custom-select"
                                        style="width: 100%; height:36px;">
                                        <option value="">Ship Via</option>
                                        <option value="BY ROAD">By Road</option>
                                        <option value="BY AIR">By Air</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" cols="10" rows="2" class="form-control"
                                    placeholder="Please write notes here"></textarea>
                            </div>
                            <hr>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Add Items</h3>
                                    <p class="text-danger" id="checklist-error"></p>
                                    <hr>
                                    <table id="myTable" class=" table order-list">
                                        <thead class="bg-danger text-white">
                                            <tr>
                                                <td><strong>Item</strong></td>
                                                <td><strong>Image</strong></td>
                                                <td class="text-nowrap"><strong>Unit Type</strong></td>
                                                <td><strong>QTY</strong></td>
                                                <td><strong>Remarks</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-4">
                                                    <select id="inspection_items" name="inspection_items[]"
                                                        class="form-control select2 inspection_items">
                                                        <option value="">Choose...</option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}" data-original="Yes"
                                                                data-image="{{ $item->image_url }}"
                                                                data-unit-type="{{ optional($item->unitType)->name }}"
                                                                data-remarks="{{ $item->notes }}"
                                                                data-qty="{{ $item->qty }}">
                                                                {{ $item->item_name }}</option>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger" id="inspection_items.0"></p>
                                                </td>
                                                <td class="col-2 text-center">
                                                    <img src="{{ asset('img/pic.png') }}" alt="" width="40"
                                                        id="item_image_0">
                                                </td>
                                                <td class="col-1">
                                                    <input type="text" readonly name="unit_type" id="unit_type_0"
                                                        class="form-control" />
                                                </td>
                                                <td class="col-1">
                                                    <input type="number" name="qty[]" id="qty_0"
                                                        class="form-control">
                                                    <p class="text-danger" id="qty_0"></p>

                                                </td>
                                                <td class="col-4">
                                                    <input type="text" id="remarks_0" name="remarks[]"
                                                        class="form-control" />
                                                    <p class="text-danger" id="remarks_0"></p>
                                                </td>
                                                <td class="col-sm-2"><a class="deleteRow"></a>

                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block text-dark save-btn"
                                                        id="addrow" value="Add Row" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>

                            <div class="row px-3 mt-2 align-items-center">
                                <div class="col-9">
                                    <div class="form-group">
                                        <label for="result">Notes For Company</label>
                                        <a onclick="startConverting();"><i class="fa fa-microphone btn"
                                                style="background-color:#a80000; color:#fff;" aria-hidden="true"></i></a>
                                        <textarea name="notes" id="result" cols="10" rows="3" class="form-control" placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="btn-box mt-3">
                                        <div>
                                            <button type="button" id="add_inspection_btn"
                                                class="btn save-btn w-100 mb-3">Save</button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-sm cancel-btn w-100"
                                                data-dismiss="modal" aria-label="Close">Cancel</button>
                                        </div>
                                    </div>
                                </div>
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
        var items = <?php echo json_encode($items); ?>;
    </script>
    <script>
        $(document).ready(function() {
            // Initialize the form validation
            $("#add_purchase_order_form").validate({
                ignore: [],
                rules: {
                    date: "required",
                    location_id: "required",
                    user_id: "required",
                    vendor_id: "required",
                    warehouse_id: "required",
                    {{--  term: "required",  --}}
                    ship_via: "required",
                    {{--  notes: "required",  --}}
                    notes_for_company: "required",

                    // New rule for dynamically added rows
                    {{--  "qty[]": {
                        required: function(element) {
                            // Check if the item select in the same row is empty
                            return $(element).closest("tr").find(".inspection_items").val() === "";
                        },
                        digits: true, // Optional: Require the value to be a number
                    },
                    "remarks[]": {
                        required: function(element) {
                            // Check if the item select in the same row is empty
                            return $(element).closest("tr").find(".inspection_items").val() === "";
                        },
                    },  --}}
                    // Add more rules for other form fields as needed
                },
                messages: {
                    date: "Please select a date",
                    location_id: "Please select a location",
                    user_id: "Please select a user",
                    vendor_id: "Please select a vendor",
                    warehouse_id: "Please select a warehouse",
                    {{--  term: "Please enter terms",  --}}
                    ship_via: "Please select a shipping method",
                    {{--  notes: "Please enter notes",  --}}
                    notes_for_company: "Please enter notes for the company",

                    {{--  // Messages for dynamically added rows
                    "qty[]": {
                        required: "Qty is required when an item is not selected",
                        digits: "Qty must be a number", // Optional
                    },
                    "remarks[]": {
                        required: "Remarks are required when an item is not selected",
                    },
                    // Add custom error messages for other fields as needed  --}}
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
                    'add_purchase_order_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form
                if ($(formElement).valid()) { // Check if the form is valid
                    $.ajax({
                        type: "POST",
                        url: "{{ route('purchase-orders.store') }}",
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
