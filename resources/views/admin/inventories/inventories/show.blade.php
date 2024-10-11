@extends('layouts.app')
@section('inventory-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">
        <div class=" ml-1 bg-info text-white mb-3 row" style="padding: 15px">
            <div class="col-md-6">
                <h3>{{ $inventory->inventory_type == 0 ? 'Inventory' : 'Asset' }}</h3>
            </div>

            <div class="text-right col-md-6">
                <!-- Button trigger modal -->
                @if (Auth::user()->can('Edit Inventories'))
                    <button type="button" class="btn save-btn px-4" id="editInventoryButton"> Edit </button> |
                @endif
                @if (Auth::user()->can('Delete Inventories'))
                    <a href="{{ route('inventories.delete', ['id' => $inventory->id]) }}" class="btn save-btn"
                        onclick="return confirm('Are you sure?')"> Delete</a>
                @endif
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
        <div class="row d-flex">
            <div class="col-12 col-md-5">
                <img src="{{ $inventory->image_url }}" alt="" width="60%">
            </div>

            <div class="col-12 col-md-7 d-flex align-items-center">
                <div class="row">
                    <div class="col-12 pb-5">
                        <h3>{{ $inventory->item_name }}</h3>
                        <h4>{{ optional($inventory->category)->name }}</h4>
                        <h5>{{ optional($inventory->make)->name }}</h5>
                    </div>
                    <hr>
                    <div class="col-12 d-flex justify-content-between pt-4">
                        <div>
                            <h5>Total Consumed</h5>
                            <h1>232</h1>
                        </div>
                        <div>
                            <h5>Currrent Stock</h5>
                            <h1>{{ $inventory->qty }}</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="bg-info py-2 text-white text-center">
                    <h3>Item Details</h3>
                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        <h5>Inventory Type:</h5>
                        <hr class="my-0">
                        <h5>Property:</h5>
                        <hr class="my-0">
                        <h5>Room Number:</h5>
                        <hr class="my-0">
                        <h5>Type:</h5>
                        <hr class="my-0">
                        <h5>Category:</h5>
                        <hr class="my-0">
                        <h5>Unit Type:</h5>
                        <hr class="my-0">
                        <h5>Unit Cost:</h5>
                        <hr class="my-0">
                        <h5>Barcode #:</h5>
                        <hr class="my-0">
                        <h5>BIN:</h5>
                        <hr class="my-0">
                        <h5>Warehouse:</h5>
                        <hr class="my-0">
                        <h5>Location:</h5>
                        <hr class="my-0">
                        <h5>Notes:</h5>
                        <hr class="my-0">
                        <h5>Is Expiry:</h5>
                        <hr class="my-0">
                        <h5>Is Warranty:</h5>
                        <hr class="my-0">
                        <h5>Fuel Type:</h5>
                    </div>
                    <div class="col-8">
                        <h5>
                            @if ($inventory->inventroy_type == 0)
                                INVENTORY
                            @elseif ($inventory->inventroy_type == 1)
                                ASSET
                            @else
                                Fuel
                            @endif
                        </h5>
                        <hr class="my-0">
                        <h5>{{ optional($inventory->property)->property_name ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ $inventory->room_number ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ optional($inventory->type)->name ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ optional($inventory->category)->name ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ optional($inventory->unitType)->name ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ number_format($inventory->unit_cost, 2) ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ $inventory->barcode ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ $inventory->bin ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ optional($inventory->warehouse)->name ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ optional($inventory->location)->name ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ $inventory->notes ?: 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ $inventory->is_expiry_available ? $inventory->expiry_date : 'N/A' }}</h5>
                        <hr class="my-0">
                        <h5>{{ $inventory->is_warranty_available ? 'Warranty: ' . $inventory->warranty_date . ' Notes: ' . $inventory->notes : 'N/A' }}
                        </h5>
                        <hr class="my-0">
                        <h5>{{ optional($inventory->fuelType)->name ?: 'N/A' }}
                        </h5>

                    </div>
                </div>
                <hr>
                <div class="py-3">
                    <div class="bg-info text-white py-2 text-center d-flex justify-content-around">
                        @if (Auth::user()->can('Upload Attachment Inventories'))

                        <h4 class="text-white">Attachments</h4>
                        <button type="button" class="btn btn-white bg-white" data-toggle="modal" data-target="#attach">
                            <strong>Upload File</strong>
                        </button>
                        @endif

                    </div>

                    @foreach ($inventory->attachments as $attachment)
                        <div class="row d-flex justify-content-between align-items-center pt-2">
                            <div class="col-6 col-md-6">
                                {{ $attachment->file_name }} <br>
                                {{ Carbon\Carbon::parse($attachment->created_at)->format('Y-m-d H:i:s') }}
                            </div>
                            <div class="col-6 col-md-6 text-center">
                                <a href="{{ $attachment->file_url }}" target="_blank"><i
                                        class="fa fa-paperclip fa-xl"></i></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="bg-info py-2 text-center text-white">
                    <h3>Inventory Timeline</h3>
                </div>

                <div class="mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Activity Name</th>
                                <th scope="col">User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timelineData as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data['date'] ?: 'N/A' }}</td>
                                    <td>{{ $data['description'] ?: 'N/A' }}</td>
                                    <td>{{ $data['user'] ?: 'N/A' }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Edit Modal -->
        @include('admin.inventories.inventories._models._edit', [
            'itemTypes' => $itemTypes,
            'itemMakes' => $itemMakes,
            'itemCategories' => $itemCategories,
            'UnitTypes' => $UnitTypes,
            'locations' => $locations,
            'warehouses' => $warehouses,
            'propertise' => $propertise,
        ])





        <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i
                class="fa fa-chevron-up"></i></a>
    </div>
    <!-- Attachment Modal -->
    @include('admin.inventories.inventories._models._attachment', [
        'inventory' => $inventory,
    ])
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });
        });

        $(document).ready(function() {
            $("#inventory_attachment_form").validate({
                rules: {
                    file_name: "required",
                    file: "required",
                },
                messages: {
                    vehicle_number: "Please enter file name",
                    file: "Please Select attachment",
                }
            });
        })

        $(document).ready(function() {
            $('#submitAttachmentFormButton').click(function() {
                var formElement = document.getElementById(
                    'inventory_attachment_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    var fileInput = $('#attachment_file')[0];
                    var file = fileInput.files[0];

                    formData.append('image', file);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('inventories.store.attachment') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload();
                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        });


        $('#editInventoryButton').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{ route('inventories.edit') }}",
                data: {
                    'id': '{{ $inventory->id }}'
                },
                success: function(response) {
                    var inventory = response.inventory;
                    $('#item_number').val(inventory.item_number);
                    $('#inventory_id').val(inventory.id);
                    $('#inventory_type').val(inventory.inventroy_type).trigger(
                        'change'); // Assuming you want to select the appropriate option
                    if (inventory.inventroy_type == 0) {
                        $('.proeprty_container').addClass('d-none');
                    } else {
                        $('.proeprty_container').removeClass('d-none');
                        $('#property_id').val(inventory.property_id).trigger(
                            'change'); // Assuming you want to select the appropriate option
                        $('#room_number').val(inventory.room_number).trigger(
                            'change');
                    }

                    if (inventory.inventroy_type == 2) {
                        $('.other_field').hide();
                        $('.proeprty_container').addClass('d-none');
                        $('.fuel_container').removeClass('d-none');

                    } else {
                        $('.other_field').show();
                        $('.fuel_container').addClass('d-none');

                    }

                    $('#item_name').val(inventory.item_name);
                    $('#description').val(inventory.description);
                    $('#item_type_id').val(inventory.item_type_id).trigger('change');
                    $('#fuel_type_id').val(inventory.fuel_type_id).trigger('change');
                    $('#item_make_id').val(inventory.make_id).trigger('change');
                    $('#item_category_id').val(inventory.category_id).trigger('change');
                    $('#unit_type_id').val(inventory.unit_type_id).trigger('change');
                    $('#upc').val(inventory.upc);
                    $('#unit').val(inventory.unit_cost);
                    $('#qty').val(inventory.qty);
                    $('#bin').val(inventory.bin);
                    $('#barcode').val(inventory.barcode);
                    $('#warehouse_id').val(inventory.warehouse_id).trigger('change');
                    $('#location_id').val(inventory.location_id).trigger('change');
                    $('#is_expiry_available').prop('checked', inventory.is_expiry_available);
                    $('#is_warranty_available').prop('checked', inventory.is_warranty_available);

                    if (inventory.is_expiry_available) {
                        $('.expiry_date_container').removeClass('d-none');
                        $('#expiry').val(inventory.expiry_date);
                    } else {
                        $('.expiry_date_container').addClass('d-none');
                    }

                    if (inventory.is_warranty_available) {
                        $('.warranty_container').removeClass('d-none');
                        $('#warranty').val(inventory.warranty_date);
                        $('#warranty_notes').val(inventory.warranty_notes);
                    } else {
                        $('.warranty_container').addClass('d-none');
                    }

                    $('#notes').val(inventory.notes);
                    $('.inventory_image').attr('src', inventory.image_url);
                    $('#editInventory').modal('show');

                }
            });
        });

        $(document).ready(function() {
            $('.inventory_image').click(function(e) {
                $('#inventory_image_input').trigger('click');
                console.log($('#inventory_image_input'));
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(document).ready(function() {
            $("#inventory_update_form").validate({
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
                var formElement = document.getElementById('inventory_update_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('inventories.update') }}",
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
                                location.reload();
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

            $('#inventory_type').change(function() {
                if ($(this).val() == '1') {
                    // If checked, show the proeprty_container
                    $('.proeprty_container').removeClass('d-none');
                } else {
                    // If unchecked, hide the proeprty_container
                    $('.proeprty_container').addClass('d-none');
                }
            });
        });
    </script>
@endsection
