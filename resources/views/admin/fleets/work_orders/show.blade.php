@extends('layouts.app')
@section('workorder-active-class', 'active')

<style>
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
    hr{
        margin-block: 5px !important;
    }
</style>
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body pb-0">
                        <h3 class="header-title">Work Order # 2321</h3>
                        <div>
                            <form>
                                <div class="row d-flex justify-content-between">
                                    <div class="form-group col-12 col-md-8">
                                        <div>
                                            <h2>{{ optional(optional($wo->inspection)->vehicle)->vehicle_number }}</h2>
                                            <h5>{{ optional(optional(optional($wo->inspection)->vehicle)->model)->name }}
                                            </h5>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group col-6 col-md-4">
                                                <h5>Meter</h5>
                                                <h4>{{ optional(optional($wo->inspection)->vehicle)->current_meter_reading }}
                                                </h4>
                                            </div>
                                            <div class="form-group col-6 col-md-4">
                                                <h5>Date</h5>
                                                <h4>{{ optional($wo->inspection)->date }}</h4>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <h5>Cost Center</h5>
                                                <h4>{{ optional(optional($wo->inspection)->costCenter)->title }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <img id="blah"
                                            src="{{ optional(optional($wo->inspection)->vehicle)->image_url }}"
                                            alt="your image" width="100%" />

                                    </div>

                                </div>
                                <hr>

                                <h4>Inspection By</h4>
                                <div class="row d-flex justify-content-around">
                                    @foreach (optional($wo->inspection)->inspectionBies as $inspectionBy)
                                        <div class="text-center pt-3 col-3">
                                            <img id="blah" width="20%"
                                                src="{{ optional($inspectionBy->user)->profile_pic_url }}" alt="your image"
                                                class="rounded-circle" />
                                            <div>
                                                <p class="my-0">{{ optional($inspectionBy->user)->full_name }}</p>
                                                <p class="my-0">
                                                    {{ optional(optional($inspectionBy->user)->designation)->name }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h4>Inspection Checklist</h4>
                                        <hr>
                                        <table id="myTable" class=" table">
                                            <thead class="bg-info text-white">
                                                <tr>
                                                    <td><strong>Inspection Item</strong></td>
                                                    <td><strong>Status</strong></td>
                                                    <td><strong>Remarks</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (optional($wo->inspection)->inspectionChecklistItems as $items)
                                                    <tr>
                                                        <td class="col-5">
                                                            <p>{{ optional($items->inspectionItem)->name }}</p>
                                                        </td>
                                                        <td class="col-2">
                                                            @if ($items->status == 'OK')
                                                                <div class="text-success"><i class="fa fa-check"></i>
                                                                </div>
                                                            @else
                                                                <div class="text-danger"><i class="fa fa-close"></i></div>
                                                            @endif
                                                        </td>
                                                        <td class="col-5">
                                                            <p>{{ $items->remarks }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="row">
                                        @foreach (optional($wo->inspection)->attachments as $attachment)
                                            <div class="col-12 col-md-4 mb-2">
                                                <img src="{{ $attachment->file_url }}" alt="" width="30%">
                                            </div>
                                        @endforeach
                                    </div>

                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Technician Notes</h4>
                                <textarea class="form-control col-xs-12" disabled rows="2">{{ optional($wo->inspection)->remarks }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <h4>Assigned Technicians</h4>
                        <div class="row d-flex justify-content-around">
                            @foreach (optional($wo->inspection)->assignedTehnicians as $assigned)
                                <div class="text-center pt-3 col-3">
                                    <img id="blah" width="20%"
                                        src="{{ optional($assigned->user)->profile_pic_url }}" alt="your image"
                                        class="rounded-circle" />
                                    <div>
                                        <p class="my-0">{{ optional($assigned->user)->full_name }}</p>
                                        <p class="my-0">
                                            {{ optional(optional($assigned->user)->designation)->name }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        @if (auth()->user()->hasRole('Super Admin') && $wo->status == 0)
                            <form id="workorder_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Add Items</h4>

                                        <hr>
                                        <table id="myTable" class=" table order-list">
                                            <thead class="bg-info text-white">
                                                <tr>
                                                    <td><strong>Item</strong></td>
                                                    <td><strong>Image</strong></td>
                                                    <td><strong>Unit Type</strong></td>
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
                                                            @foreach ($inventroyItems as $item)
                                                                <option value="{{ $item->id }}" data-original="Yes"
                                                                    data-image="{{ $item->image_url }}"
                                                                    data-unit-type="{{ optional($item->unitType)->name }}"
                                                                    data-remarks="{{ $item->notes }}"
                                                                    data-qty="{{ $item->qty }}">
                                                                    {{ $item->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <p class="text-danger" id="inspection_items.0"></p>
                                                    </td>
                                                    <td class="col-2 text-center">
                                                        <img src="{{ asset('img/pic.png') }}" alt="" width="40"
                                                            id="inventroy_item_image_0">
                                                    </td>
                                                    <td class="col-1">
                                                        <input type="text" readonly name="unit_type[]"
                                                            id="inventroy_unit_type_0" class="form-control" />
                                                    </td>
                                                    <td class="col-1">
                                                        <input type="number" name="qty[]" id="inventroy_qty_0"
                                                            class="form-control">
                                                        <p class="text-danger" id="qty_0"></p>

                                                    </td>
                                                    <td class="col-4">
                                                        <input type="text" id="inventroy_remarks_0" name="remarks_inv[]"
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
                                                        <input type="button" class="btn btn-block save-btn"
                                                            id="addrowInventroyItem" value="Add Row" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                                {{--  <hr>  --}}
                                <input type="hidden" name="workorder_id" value="{{ $wo->id }}">
                                {{--  <hr>  --}}
                                <div class="bg-info text-center text-white py-1">
                                    <h2>Task / Work Section</h2>
                                </div>
                                <p class="text-danger" id="checklist-error"></p>
                                <hr>
                                <table id="myTable" class=" table table-responsive task-list">
                                    <thead>
                                        <tr>
                                            <td><strong>Task Performed</strong></td>
                                            <td><strong>Remarks</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-6 col-md-6">
                                                <select id="tasks" name="tasks[]" class="form-control select2">
                                                    <option value="">Choose...</option>
                                                    @foreach ($tasks as $task)
                                                        <option value="{{ $task->id }}">{{ $task->title }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td class="col-6 col-md-6">
                                                <input type="text" name="remarks[]" class="form-control" />
                                            </td>
                                            <td class="col-sm-2"><a class="deleteRow"></a>

                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="text-align: left;">
                                                <input type="button" class="btn  save-btn" id="addrow"
                                                    value="Add Row" />
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tfoot>
                                </table>

                                <hr>
                                <div class="bg-info text-center text-white py-1">
                                    <h2>Old Tasks</h2>
                                </div>
                                <hr>
                                <table id="myTable" class=" table table-responsive">
                                    <thead>
                                        <tr>
                                            <td><strong>Date</strong></td>
                                            <td><strong>Task Performed</strong></td>
                                            <td><strong>Remarks</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wo->taskPerformed as $taskPerf)
                                            <tr>
                                                <td class="col-6 col-md-6">
                                                    {{ $taskPerf->created_at }}
                                                </td>
                                                <td class="col-6 col-md-6">
                                                    {{ optional($taskPerf->task)->title }}
                                                </td>

                                                <td class="col-6 col-md-6">
                                                    {{ $taskPerf->remarks }}
                                                </td>
                                                <td class="col-sm-2"><a class="deleteRow"></a>

                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="row pt-3">
                                    <div class="col-12 col-md-3">
                                        <h4>Work Photos</h4>
                                        <button type="button" class="btn buttons save-btn  files_upload_btn">Upload
                                            Photos</button>
                                        <input type="file" name="files_upload_input[]" multiple
                                            id="files_upload_input" class="d-none">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    {{--  <div class="row">  --}}
                                    @foreach ($wo->attachments as $attachment)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <img class="card-img-top" style="height: 100px; object-fit: cover;"
                                                    src="{{ $attachment->file_url }}" alt="Card image cap">
                                                <div class="card-body text-center">
                                                    <p><strong>Uplaod Date:</strong> {{ $attachment->created_at }}</p>
                                                    <p><strong>Uplaod By:</strong>
                                                        {{ optional($attachment->user)->full_name }}</p>
                                                </div>

                                                <div class="card-footor text-center mb-2">
                                                    <a href="{{ $attachment->file_url }}" target="_blank"
                                                        class="btn save-btn">Show</a>
                                                </div>
                                            </div>
                                        </div>
                                        {{--  <img src="{{ $attachment->file_url }}" style="width: 10%" alt="">  --}}
                                    @endforeach
                                    {{--  </div>  --}}
                                </div>
                                <div class="row mt-2" id="imagePreviewContainer">

                                </div>
                                <hr>

                                <div class="bg-info text-center text-white py-1">
                                    <h2>Old Items</h2>
                                </div>
                                <hr>
                                <table id="myTable" class=" table table-responsive">
                                    <thead>
                                        <tr>
                                            <td><strong>Date</strong></td>
                                            <td><strong>Image</strong></td>
                                            <td><strong>Item</strong></td>
                                            <td><strong>Qty</strong></td>
                                            <td><strong>Remarks</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wo->items as $woItem)
                                            <tr>
                                                <td class="col-2 col-md-6">
                                                    {{ $woItem->created_at }}
                                                </td>
                                                <td class="col-2     col-md-6">
                                                    <img width="150" src=" {{ optional($woItem->item)->image_url }}"
                                                        alt="">
                                                </td>

                                                <td class="col-2 col-md-6">
                                                    {{ optional($woItem->item)->item_name }}
                                                </td>
                                                <td class="col-2 col-md-6">
                                                    {{ $woItem->qty }}
                                                </td>
                                                <td class="col-4 col-md-6">
                                                    {{ $woItem->remarks }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{-- <div class="row ">
                                    <div class="col-md-12">
                                        <h4>Remark</h4>
                                        <textarea name="close_remark" class="form-control col-xs-12" rows="2">{{ $wo->technicians_notes }}</textarea>
                                    </div>
                                </div> --}}
                                <hr>
                                <div class="row justify-content-end mr-2">

                                    <a href="{{ route('work-orders.index') }}" class="btn cancel-btn">
                                        Cancel
                                    </a>

                                    @if (Auth::user()->can('Close Work Orders'))
                                        <input type="submit" data-type="save" value="Save"
                                            class="btn save-btn px-3 mx-2 workorder-form-btn">
                                    @endif

                                    @if (Auth::user()->can('Close Work Orders'))
                                        <button type="submit" data-type="close"
                                            class="btn cancel-btn btn-sm workorder-form-btn"
                                            onclick="return confirm('Are you sure?')">
                                            Close Work Order 
                                        </button>
                                    @endif
                                </div>
                                {{-- <div class="d-flex justify-content-center">
                                    
                                </div> --}}
                            </form>
                        @else
                            <hr>
                            <div class="bg-info text-center text-white py-1">
                                <h2>Tasks</h2>
                            </div>
                            <hr>
                            <table id="myTable" class=" table table-responsive task-list">
                                <thead>
                                    <tr>
                                        <td><strong>Task Performed</strong></td>
                                        <td><strong>Remarks</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wo->taskPerformed as $taskPerf)
                                        <tr>
                                            <td class="col-6 col-md-6">
                                                {{ optional($taskPerf->task)->title }}
                                            </td>

                                            <td class="col-6 col-md-6">
                                                {{ $taskPerf->remarks }}
                                            </td>
                                            <td class="col-sm-2"><a class="deleteRow"></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="row pt-3">
                                <div class="col-12 col-md-3">
                                    <h4>Work Photos</h4>

                                </div>
                            </div>
                            <hr>
                            <div class="row mt-2">
                                @foreach ($wo->attachments as $attachment)
                                    <img src="{{ $attachment->file_url }}" style="width: 10%" alt="">
                                @endforeach
                            </div>
                            <hr>
                            <div class="bg-info text-center text-white py-1">
                                <h2>Items</h2>
                            </div>
                            <hr>
                            <table id="myTable" class=" table table-responsive">
                                <thead>
                                    <tr>
                                        <td><strong>Date</strong></td>
                                        <td><strong>Image</strong></td>
                                        <td><strong>Item</strong></td>
                                        <td><strong>Qty</strong></td>
                                        <td><strong>Remarks</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wo->items as $woItem)
                                        <tr>
                                            <td class="col-2 col-md-6">
                                                {{ $woItem->created_at }}
                                            </td>
                                            <td class="col-2     col-md-6">
                                                <img width="150" src=" {{ optional($woItem->item)->image_url }}"
                                                    alt="">
                                            </td>

                                            <td class="col-2 col-md-6">
                                                {{ optional($woItem->item)->item_name }}
                                            </td>
                                            <td class="col-2 col-md-6">
                                                {{ $woItem->qty }}
                                            </td>
                                            <td class="col-4 col-md-6">
                                                {{ $woItem->remarks }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <hr>
                            {{-- <div class="row ">
                                <div class="col-md-12">
                                    <h4>Remark</h4>
                                    <textarea name="close_remark" class="form-control col-xs-12" rows="2">{{ $wo->technicians_notes }}</textarea>
                                </div>
                            </div> --}}
                            <hr>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        var tasks = <?php echo json_encode($tasks); ?>;
        var inventroyItems = <?php echo json_encode($inventroyItems); ?>;
    </script>
    <script src="{{ asset('app_js_functions/workorder.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#workorder_form").validate({
                rules: {

                    // close_remark: "required",
                },
                messages: {

                    // close_remark: "Please add remarks",
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
            $('.workorder-form-btn').click(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formElement = document.getElementById('workorder_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form
                formData.append('type', $(this).data('type'));
                if ($(formElement).valid()) { // Check if the form is valid
                    $.ajax({
                        type: "POST",
                        url: "{{ route('work-orders.close') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload();
                            }
                        },
                        error: function(error) {
                            if (error.responseJSON) {
                                var errors = error.responseJSON.errors;
                                console.log(errors);
                                if (containsKeyword(errors, 'tasks') || containsKeyword(errors,
                                        'remarks')) {
                                    $('#checklist-error').text(
                                        'Checklist all items are required')
                                } else {
                                    $('#checklist-error').text('')
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
            var counterInventory = 1;

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
            for (var i = 0; i < inventroyItems.length; i++) {

                selectOptions += '<option value="' + inventroyItems[i].id + '" data-image="' + inventroyItems[i]
                    .image +
                    '" data-unit-type="' + inventroyItems[i].unit_type + '" data-remarks="' + inventroyItems[i]
                    .notes +
                    '" data-qty="' + inventroyItems[i].qty + '" data-orignal="NO">' + inventroyItems[i].item_name +
                    '</option>';
            }
            $("#inspection_items").html('<option value="">Choose...</option>' + selectOptions);

            $("#addrowInventroyItem").on("click", function() {
                var newRow = $("<tr>");
                var cols = "";

                cols += `<td><select class="form-control inspection_items" name="inspection_items[]">
                            <option value="">Choose...</option>
                            ${selectOptions}
                        </select>
                        <p class="text-danger" id="inspection_items.${counterInventory}"></p>
                        </td>`;
                cols +=
                    `<td class="text-center"><img src="" alt="" width="40" id="inventroy_item_image_${counterInventory}" /></td>`;
                cols += `<td><input type="text" readonly name="unit_type[]" id="inventroy_unit_type_${counterInventory}" class="form-control" />
                    <p class="text-danger" id="unit_type.${counterInventory}"></p>
                    </td>`;
                cols +=
                    `<td><input type="number" class="form-control" name="qty[]" id="inventroy_qty_${counterInventory}"/><p class="text-danger" id="qty_${counterInventory}"></p></td>`;
                cols +=
                    `<td><input type="text" class="form-control" name="remarks_inv[]" id="inventroy_remarks_${counterInventory}"/><p class="text-danger" id="remarks_${counterInventory}"></p></td>`;

                cols +=
                    '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counterInventory++;
            });

            $("table.order-list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counterInventory -= 1;
            });

            {{--  $(document).on('change', '.inspection_items', function() {

                var image = $("option:selected", this).attr("data-image");
                var unitType = $("option:selected", this).attr("data-unit-type");
                var remarks = $("option:selected", this).attr("data-remarks");
                var qty = $("option:selected", this).attr("data-qty");
                var original = $("option:selected", this).attr("data-original");


                console.log("Image:", image);
                console.log("Unit Type:", unitType);
                console.log("Remarks:", remarks);
                console.log("QTY:", qty);
                console.log("original:", original);

                var selectedItemId = $(this).val();
                var row = $(this).closest("tr");
                var itemInfoForSelected = itemInfo[selectedItemId];

                $("#inventroy_item_image_" + row.index()).attr("src", itemInfoForSelected.image);
                $("#inventroy_unit_type_" + row.index()).val(itemInfoForSelected.unitType);
                $("#inventroy_qty_" + row.index()).val(itemInfoForSelected.qty); // Set the qty field
                $("#inventroy_remarks_" + row.index()).val(itemInfoForSelected.remarks);

            });  --}}

            $("table.order-list").on("change", '.inspection_items', function() {
                var image = $("option:selected", this).attr("data-image");
                var unitType = $("option:selected", this).attr("data-unit-type");
                var remarks = $("option:selected", this).attr("data-remarks");
                var qty = $("option:selected", this).attr("data-qty");
                var original = $("option:selected", this).attr("data-original");

                var selectedItemId = $(this).val();
                var row = $(this).closest("tr");
                var itemInfoForSelected = itemInfo[selectedItemId];
                console.log(itemInfoForSelected);
                // Update the image, unit type, qty, and remarks fields in the current row.
                $("#inventroy_item_image_" + row.index()).attr("src", itemInfoForSelected.image);
                $("#inventroy_unit_type_" + row.index()).val(itemInfoForSelected.unitType);
                $("#inventroy_qty_" + row.index()).val(itemInfoForSelected.qty);
                $("#inventroy_remarks_" + row.index()).val(itemInfoForSelected.remarks);
            });
        });
    </script>
@endsection
