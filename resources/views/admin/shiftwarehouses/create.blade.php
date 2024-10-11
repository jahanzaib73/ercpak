@extends('layouts.app')
@section('shiftwarehouse-active-class', 'active')
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

    .select2-container {
        width: 100% !important;
    }
</style>
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form id="shift_warehouse_form">
                            <div class="row">
                                <div class="col-md-9">
                                    <h2 class="pb-3">Shiftwarehouse</h2>
                                </div>
                                <div class="col-md-3 text-right">

                                    <input type="date" name="date" class="form-control" id="date">
                                </div>
                            </div>
                            <hr>
                            {{--  <div class="container">  --}}
                            <div class="row">
                                <!-- Left-side card with customer details -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h3>Main Warehouse</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="main_warehouse_id">Warehouse</label>
                                                    <select name="main_warehouse_id" class="select2" id="main_warehouse_id">
                                                        <option value="">Warehouse</option>
                                                        @foreach ($warehouses as $warehosue)
                                                            <option value="{{ $warehosue->id }}">{{ $warehosue->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="main_location_id">Location</label>
                                                    <select name="main_location_id" class="select2" id="main_location_id">
                                                        <option value="">Location</option>
                                                        @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}">{{ $location->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h3>New Warehouse</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="sub_warehouse_id">Warehouse</label>
                                                    <select name="sub_warehouse_id" class="select2" id="sub_warehouse_id">
                                                        <option value="">Warehouse</option>
                                                        @foreach ($warehouses as $warehosue)
                                                            <option value="{{ $warehosue->id }}">{{ $warehosue->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_location_id">Location</label>
                                                    <select name="sub_location_id" class="select2" id="sub_location_id">
                                                        <option value="">Location</option>
                                                        @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}">{{ $location->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

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
                                                <td><strong>Unit Type</strong></td>
                                                <td><strong>Store QTY</strong></td>
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
                                                <td class="col-2">
                                                    <input type="text" readonly name="unit_type" id="unit_type_0"
                                                        class="form-control" />
                                                </td>
                                                <td class="col-2">
                                                    <input type="number" readonly name="qty[]" id="qty_0"
                                                        class="form-control">
                                                    <p class="text-danger" id="qty_0"></p>

                                                </td>
                                                <td class="col-2">
                                                    <input type="number" name="store_qty[]" id="store_qty_0"
                                                        class="form-control">
                                                    <p class="text-danger" id="store_qty_0"></p>

                                                </td>
                                                <td class="col-3">
                                                    <input type="text" id="remarks_0" name="remarks[]"
                                                        class="form-control" />
                                                    <p class="text-danger" id="remarks_0"></p>
                                                </td>
                                                <td class="col-sm-1"><a class="deleteRow"></a>

                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block save-btn"
                                                        id="addrow" value="Add Row" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" name="notes" id="notes" cols="30" rows="2"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="recommanded_by">Recommanded BY</label>
                                        <select name="recommanded_by" class="select2" id="recommanded_by">
                                            <option value="">Recommanded BY</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="approved_by">Approved By</label>
                                        <select name="approved_by" class="select2" id="approved_by">
                                            <option value="">Approved By</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                         <a href="" class="btn btn-md save-btn">Submit for Approval</a> 
                                    </div>
                                </div>
                                <div class="col-8 ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end">
                                                <div class="d-flex text-right">
                                                    <div class="form-group">
                                                        <a href="" class="btn btn-md save-btn">Cancel</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="shift_warehouse_btn"
                                                            class="btn btn-md save-btn ml-2">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            {{--  </div>  --}}
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
                    `<td><input type="number" readonly class="form-control" name="qty[]" id="qty_${counter}"/><p class="text-danger" id="qty_${counter}"></p></td>`;

                cols +=
                    `<td><input type="number" class="form-control" name="store_qty[]" id="store_qty_${counter}"/><p class="text-danger" id="store_qty_${counter}"></p></td>`;
                cols +=
                    `<td><input type="text" class="form-control" name="remarks[]" id="remarks_${counter}"/><p class="text-danger" id="remarks_${counter}"></p></td>`;

                cols +=
                    '<td><input type="button" class="ibtnDel btn btn-md save-btn"  value="Delete"></td>';
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

        $(document).ready(function() {
            // Initialize the form validation
            $("#shift_warehouse_form").validate({
                rules: {
                    date: "required",
                    main_warehouse_id: "required",
                    main_location_id: "required",
                    sub_warehouse_id: "required",
                    sub_location_id: "required",
                    recommanded_by: "required",
                    approved_by: "required",
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    console.log(element);
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
            $('#shift_warehouse_btn').click(function() {
                var formElement = document.getElementById(
                    'shift_warehouse_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form
                if ($(formElement).valid()) { // Check if the form is valid
                    $.ajax({
                        type: "POST",
                        url: "{{ route('shift.warehosue.store') }}",
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
                                        errors, 'remarks') || containsKeyword(
                                        errors, 'store_qty')) {
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

                                if (containsKeyword(errors, ' ')) {
                                    $('#work_order_id').text(
                                        'Please select Store QTY')
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
    </script>
@endsection
