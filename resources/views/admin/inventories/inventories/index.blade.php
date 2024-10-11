@extends('layouts.app')
@section('inventory-active-class', 'active')
@section('css')
    <style>
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            margin: auto;
            /* Center the image horizontally */
        }

        .card-title {
            margin: 10px 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        @include('admin.inventories._sharebale._states', [
            'totalItems' => $totalItems,
            'totalInventory' => $totalInventory,
            'totalAsset' => $totalAsset,
            'totalWarehouses' => $totalWarehouses,
        ])
        <hr>
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @php
            Session::forget('success');
        @endphp
        <div class=" ml-1 topbar-header rounded text-white mb-3 rounded row" style="padding: 15px">
            <div class="col-md-2">
                <h3>List of Inventories</h3>
            </div>
            <div class="col-md-8">
                <div class="form-row">
                    <div class="col">
                        <select name="inventory_type" id="inventory_type" class="form-control">
                            <option value="">Select Inventory Type</option>
                            <option value="inventory">Inventory</option>
                            <option value="asset">Asset</option>
                        </select>
                    </div>
                    <div class="col">
                        <select name="warehouse_id" id="warehouse_id" class="form-control">
                            <option value="">Select Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="location_id" id="location_id" class="form-control">
                            <option value="">Select Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <a href="javascript:void" id="clearFiltersBtn" class="btn save-btn btn-sm mt-1">Clear Filter</a>
                    </div>
                </div>

            </div>
            <div class="text-right col-md-2">

            @if (Auth::user()->can('Add Inventories'))
                <button type="button"  class="btn mr-1 save-btn"
                    data-toggle="modal" data-target="#addInventory"> Add Inventory</button>
            @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-hover ajax-table" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Inventory Type</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Item Number#</th>
                        <th scope="col">Item Code</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Make</th>
                        <th scope="col">Category</th>
                        <th scope="col">Unit Type</th>
                        <th scope="col">Unit Cost</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Barcode #</th>
                        <th scope="col">BIN</th>
                        <th scope="col">Warehouse</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>



        <!-- Add Modal -->
        @include('admin.inventories.inventories._models._add', [
            'itemTypes' => $itemTypes,
            'itemMakes' => $itemMakes,
            'itemCategories' => $itemCategories,
            'UnitTypes' => $UnitTypes,
            'locations' => $locations,
            'warehouses' => $warehouses,
            'propertise' => $propertise,
        ])
    </div>
@endsection

@section('script')

    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('inventories.index') }}",
                data: function(data) {
                    data.inventory_type = $('#inventory_type').val();
                    data.warehouse_id = $('#warehouse_id').val();
                    data.location_id = $('#location_id').val();
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'inventory_type',
                    name: 'inventory_type',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'fuel_type',
                    name: 'fuel_type',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'created_by',
                    name: 'created_by',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'item_number',
                    name: 'item_number',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'item_code',
                    name: 'item_code',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'item_name',
                    name: 'item_name',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'type.name',
                    name: 'type.name',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'make.name',
                    name: 'make.name',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'category.name',
                    name: 'category.name',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'unitType',
                    name: 'unitType',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'unit_cost',
                    name: 'unit_cost',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'qty',
                    name: 'qty',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'barcode',
                    name: 'barcode',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'bin',
                    name: 'bin',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                }, {
                    data: 'warehouse.name',
                    name: 'warehouse.name',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                }, {
                    data: 'location.name',
                    name: 'location.name',
                    render: function(data, type, full, meta) {
                        // Check if data is null or undefined
                        if (data === null || typeof data === 'undefined') {
                            // Return an optional message or placeholder value
                            return 'N/A';
                        }
                        return data; // Display the actual value if it exists
                    }
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Add event listeners for the filter elements
        $('#inventory_type, #warehouse_id, #location_id').on('change', function() {
            // Trigger DataTables to reload data with new filters
            table.draw();
        });

        // Add event listener for the "Clear Filters" button
        $('#clearFiltersBtn').on('click', function() {
            // Reset the select elements to their default values
            $('#inventory_type, #warehouse_id, #location_id').val(null).trigger('change');

            // Trigger DataTables to reload data with cleared filters
            table.draw();
        });


        $(document).ready(function() {
            $('.vehicle_image').click(function(e) {
                $('#vehicle_image_input').trigger('click');
                console.log($('#vehicle_image_input'));
            });
        });
        {{--
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }  --}}




        document.getElementById('vehicle_image_input').addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const maxWidth = 500;
                    const maxHeight = 500;

                    let width = img.width;
                    let height = img.height;

                    if (width > maxWidth || height > maxHeight) {
                        const ratio = Math.min(maxWidth / width, maxHeight / height);
                        width *= ratio;
                        height *= ratio;
                    }

                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);

                    const resizedDataUrl = canvas.toDataURL(file.type);
                    document.getElementById('blah').src = resizedDataUrl;
                };
            };

            reader.readAsDataURL(file);
        });



        $(document).ready(function() {
            $("#inventory_add_form").validate({
                rules: {
                    item_number: {
                        required: true,
                        minlength: 1 // Change this to your desired minimum length
                    },
                    item_name: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    item_type_id: {
                        required: true
                    },
                    item_make_id: {
                        required: true
                    },
                    item_category_id: {
                        required: true
                    },
                    unit_type_id: {
                        required: true
                    },
                    upc: {
                        required: true
                    },
                    unit: {
                        required: true,
                        number: true // Ensures it's a number
                    },
                    qty: {
                        required: true,
                        digits: true // Ensures it's a positive integer
                    },
                    bin: {
                        required: true
                    },
                    warehouse_id: {
                        required: true
                    },
                    location_id: {
                        required: true
                    },
                    expiry: {
                        required: function() {
                            return $("#is_expiry_available").is(":checked");
                        }
                    },
                    warranty: {
                        required: function() {
                            return $("#is_warranty_available").is(":checked");
                        }
                    },
                    warranty_notes: {
                        required: function() {
                            return $("#is_warranty_available").is(":checked");
                        }
                    },
                    inventory_type: "required",
                    property_id: {
                        required: function(element) {
                            // Check if inventory_type is equal to 1 (ASSET)
                            return $("#inventory_type").val() === "1";
                        }
                    },
                    room_number: {
                        required: function(element) {
                            // Check if inventory_type is equal to 1 (ASSET)
                            return $("#inventory_type").val() === "1";
                        }
                    }
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
            $('#submitFormButton').click(function() {
                var formElement = document.getElementById('inventory_add_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('inventories.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                $('.ajax-table').DataTable().ajax.reload();

                                // Clear input values
                                $('#addInventory input, #addInventory select, #addInventory textarea')
                                    .val('');

                                // Clear image preview if applicable
                                $('#blah').attr('src', 'http://placehold.it/180');
                                $('#addInventory').modal('hide');
                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        });

        $(document).ready(function() {

            // When the page is ready

            // Attach an event listener to the is_expiry_available checkbox
            $('#is_expiry_available').change(function() {
                if (this.checked) {
                    // If checked, show the expiry_date_container
                    $('.expiry_date_container').removeClass('d-none');
                } else {
                    // If unchecked, hide the expiry_date_container
                    $('.expiry_date_container').addClass('d-none');
                }
            });

            // Attach an event listener to the is_warranty_available checkbox
            $('#is_warranty_available').change(function() {
                if (this.checked) {
                    // If checked, show the warranty_container
                    $('.warranty_container').removeClass('d-none');
                } else {
                    // If unchecked, hide the warranty_container
                    $('.warranty_container').addClass('d-none');
                }
            });

            $('.inventory_type_select').change(function() {
                if ($(this).val() == '1') {
                    // If checked, show the proeprty_container
                    $('.proeprty_container').removeClass('d-none');
                } else {
                    // If unchecked, hide the proeprty_container
                    $('.proeprty_container').addClass('d-none');
                }

                if ($(this).val() == '2') {
                    // If checked, show the proeprty_container
                    $('.fuel_container').removeClass('d-none');
                    $('.location_container').removeClass('d-none');
                    $('.other_field').hide()
                } else {
                    // If unchecked, hide the fuel_container
                    $('.fuel_container').addClass('d-none');
                    $('.location_container').addClass('d-none');
                    $('.other_field').show()
                }
            });
        });


        {{--  var $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 350,
                height: 350,
                type: 'square'
            },
            boundary: {
                width: 400,
                height: 400
            }
        });
        $('#upload').on('change', function() {
            var ext = this.value.match(/\.(.+)$/)[1];
            var str = ext.toString();
            var pieces = str.split(/[\s.]+/);
            ext = pieces[pieces.length - 1];

            switch (ext) {
                case 'jpg':
                case 'png':
                case 'gif':
                    break;
                default:
                    alert('This is not an allowed file type.');
                    this.value = '';
                    return false;
            }


            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                    $(".upload-result").show();
                });

            }
            reader.readAsDataURL(this.files[0]);
        });
        $('.upload-result').on('click', function(ev) {

            var val = $("#upload").val().toLowerCase();
            var extension = val.substr(val.lastIndexOf('.') + 1).toLowerCase();
            var allowedExtensions = ['jpg', 'png', 'gif', 'pdf'];
            if (val.length > 0) {
                if (allowedExtensions.indexOf(extension) === -1) {

                    $("#upload").val("");
                    return false;
                }
            }

            if ($('#upload').val() == "") {

            } else {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {
                    $("#captured_image").val(resp);
                    html = '<img style="margin:27px;border: 2px solid #fff;" src="' + resp + '" />';
                    $("#upload-demo-i").html(html);
                });
            }
            $('.clear-result').show();
        });
        $('.clear-result').on('click', function(ev) {
            html = '';
            $("#upload-demo-i").html(html);
            $('.clear-result').hide();
        });  --}}
    </script>
@endsection
