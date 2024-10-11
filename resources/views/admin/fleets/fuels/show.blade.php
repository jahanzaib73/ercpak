@extends('layouts.app')
@section('fuel-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">

        <hr>
        <!-- ===================VEHICLE TRIP TABLE================== -->
        <div class="d-flex justify-content-between bg-info text-white align-items-center p-2">
            <div class="py-0 pl-3">
                <h3>Fuel Slip # : {{ $fuel->id }}</h3>
            </div>
            <div>
                @if (Auth::user()->can('Edit Fuel Slip'))
                    <button type="button" class="btn  btn-lg save-btn" id="editFuelbtn" data-toggle="modal"
                    data-target="#editFuelLabel"> Edit
                        Slip
                    </button>
                @endif
                @if (Auth::user()->can('Delete Fuel Slip'))
                    <a href="{{ route('fuels.delete', ['id' => $fuel->id]) }}" class="btn save-btn btn-lg"
                        onclick="return confirm('Are you sure?')">
                        Delete
                        Slip
                    </a>
                @endif
                @if (Auth::user()->can('Print Fuel Slip'))
                    <a href="{{ route('fuel.slip.report', ['id' => $fuel->id]) }}" class="btn save-btn btn-lg">Fuel
                        Slip</a>
                @endif

            </div>

        </div>
        <div class="row pt-4">
            <div class="col-12 col-md-6 d-flex">
                <img src="{{ optional($fuel->vehicle)->image_url }}" alt="" width="100%">

            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ optional($fuel->vehicle)->vehicle_number }}</h1>
                        <h3>{{ optional(optional($fuel->vehicle)->model)->name }}</h3>
                    </div>
                </div>
                <hr>
                <div class="row d-flex justify-content-between">
                    <div class="col-6">
                        <div class="d-flex justify-content-around align-items-center pt-3">
                            <img id="blah"
                                src="{{ optional($fuel->driver)->profile_pic_url ?: 'http://placehold.it/180' }}"
                                alt="your image" class="w-25 h-25 rounded-circle" />
                            <div>
                                <p class="my-0">{{ optional($fuel->driver)->full_name }}</p>
                                <p class="my-0">{{ optional(optional($fuel->driver)->designation)->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-around align-items-center pt-3">
                            <img id="blah"
                                src="{{ optional($fuel->official)->profile_pic_url ?: 'http://placehold.it/180' }}"
                                alt="your image" class="w-25 h-25 rounded-circle" />
                            <div>
                                <p class="my-0">{{ optional($fuel->official)->full_name }}</p>
                                <p class="my-0">{{ optional(optional($fuel->official)->designation)->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex">
                    <div class="col-6 col-md-6">
                        <h5>Cost Center</h5>
                        <h4>{{ optional($fuel->costCenter)->title }}</h4>
                    </div>
                    <div class="col-6 col-md-6">
                        <h5>Qty Issued</h5>
                        <h1>{{ $fuel->qty }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-md-6 d-flex">
                <div class="col-6">
                    <h5>Date</h5>
                    <hr class="my-0">
                    <h5>Fuel Type</h5>
                    <hr class="my-0">
                    <h5>Current Mtr</h5>
                </div>
                <div class="col-6">
                    <h5>{{ Carbon\Carbon::parse($fuel->date)->toDateString() }}</h5>
                    <hr class="my-0">
                    <h5>{{ optional($fuel->fuelType)->name }}</h5>
                    <hr class="my-0">
                    <h5>{{ number_format($fuel->vehicle_meter_reading, 1) }}</h5>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex">
                <div class="col-6">
                    <h5>Price</h5>
                    <hr class="my-0">
                    <h5>Total</h5>
                    <hr class="my-0">
                    <h5>Last Refuel Date</h5>
                </div>
                <div class="col-6">
                    <h5>{{ number_format($fuel->price, 2) }}</h5>
                    <hr class="my-0">
                    <h5>{{ number_format($fuel->qty * $fuel->price, 2) }}</h5>
                    <hr class="my-0">
                    <h5>{{ Carbon\Carbon::parse($lastRefuelDate)->toDateString() }}</h5>
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="d-flex justify-content-around align-items-center pt-3">
                    <img id="blah" src="{{ optional($fuel->fuelMan)->profile_pic_url ?: 'http://placehold.it/180' }}"
                        alt="your image" class="w-25 h-25 rounded-circle" />
                    <div>
                        <p class="my-0">{{ optional($fuel->fuelMan)->full_name }}</p>
                        <p class="my-0">{{ optional(optional($fuel->fuelMan)->designation)->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
            @if (Auth::user()->can('View Fuel Attachment'))
                <h5>Attachments</h5>
                <a href="javascript:Void(0)" data-toggle="modal" data-target="#allAttachment"
                    class="btn save-btn btn-sm edit ">See Attachment</a>
            @endif
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="Notes">Notes</label>
                    <textarea name="" id="" cols="10" rows="2" class="form-control" id="notes"
                        placeholder="Please write notes here">{{ $fuel->notes }}</textarea>
                </div>
            </div>
        </div>

        @include('admin.fleets.fuels._models._edit')

        @include('admin.fleets.fuels._models._all_attachments')
    </div>


@endsection

@section('script')
    <script>
        $('#editFuelbtn').click(function(e) {
            e.preventDefault();

            $.ajax({
                type: "GET",
                url: "{{ route('fuels.edit') }}",
                data: {
                    'id': '{{ $fuel->id }}'
                },
                success: function(response) {
                    var fuel = response.fuel;

                    if (fuel.trip_id) {
                        $('#trip_id').val(fuel.trip_id).trigger('change');
                    } else {
                        $('#vehicle_id').val(fuel.vehicle_id).trigger('change');
                    }

                    $('.fuel_vehicle_image').attr('src', fuel.vehicle.image_url);
                    $('#fuel_vehicle_number').text(fuel.vehicle.vehicle_number);
                    $('#fuel_vehicle_model').text(fuel.vehicle.model.name);
                    $('#driver_id').val(fuel.driver_id).trigger('change');
                    $('#driver_name').text(fuel.driver.first_name + ' ' + fuel.driver.last_name);
                    $('#driver_designation').text(fuel.driver.designation.name);
                    $('.driver_image').attr('src', fuel.driver.profile_pic_url);
                    $('#official_id').val(fuel.official_id).trigger('change');
                    $('#official_name').text(fuel.official.first_name + ' ' + fuel.official.last_name);
                    $('#official_designation').text(fuel.official.designation.name);
                    $('.official_image').attr('src', fuel.official.profile_pic_url);

                    $('#cost_center_id').val(fuel.cost_center_id).trigger('change');
                    $('#fuel_tank_id').val(fuel.fuel_tank_id).trigger('change');
                    $('#fuel_type_id').val(fuel.fuel_type_id).trigger('change');
                    $('#exit_datetime').val(fuel.date);
                    $('#fuel_man_id').val(fuel.fuel_man_id).trigger('change');
                    $('#qty').val(fuel.qty);
                    $('#vehicle_meter_reading').val(fuel.vehicle_meter_reading);
                    $('#price').val(fuel.price);
                    $('#notes').val(fuel.notes);

                    $('#editFuelLabel').modal('show');

                }
            });
        });

        $(document).ready(function() {
            $('#fuel_edit_form').validate({
                rules: {
                    trip_id: {
                        required: function(element) {
                            return $('#vehicle_id').val() ===
                                ''; // Require trip_id if vehicle_id is empty
                        }
                    },
                    vehicle_id: {
                        required: function(element) {
                            return $('#trip_id').val() === ''; // Require vehicle_id if trip_id is empty
                        }
                    },
                    driver_id: 'required',
                    official_id: 'required',
                    cost_center_id: 'required',
                    exit_datetime: 'required',
                    fuel_tank_id: {
                        required: function(element) {
                            return $('#notes').val() === ''; // Require vehicle_id if trip_id is empty
                        }
                    },
                    fuel_type_id: 'required',
                    fuel_man_id: 'required',
                    qty: {
                        required: true,
                        digits: true, // Only allow whole numbers
                    },
                    price: {
                        required: true,
                        digits: true, // Only allow whole numbers
                    },
                    vehicle_meter_reading: {
                        required: true,
                        digits: true, // Only allow whole numbers
                    }
                },
                messages: {
                    trip_id: 'Please select a trip.',
                    vehicle_id: 'Please select a vehicle.',
                    driver_id: 'Please select a driver.',
                    official_id: 'Please select an official.',
                    cost_center_id: 'Please select a cost center.',
                    exit_datetime: 'Please select a date and time.',
                    fuel_tank_id: 'If you are not selecting fuel tank please add notes in below notes section',
                    fuel_type_id: 'Please select a fuel type.',
                    fuel_man_id: 'Please select a fuel man.',
                    qty: {
                        required: 'Please enter a quantity.',
                        digits: 'Please enter a valid whole number.',
                    },
                    price: {
                        required: 'Please enter a price.',
                        digits: 'Please enter a valid whole number.',
                    },
                    vehicle_meter_reading: {
                        required: 'Please enter a meter reading.',
                        digits: 'Please enter a valid whole number.',
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
                var formElement = document.getElementById('fuel_edit_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('fuels.update') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response.status);
                            if (!response.status) {
                                $('.alert_content_fuel').removeClass('d-none');
                                $('#alert_content_fuel').text(response.message)
                            }
                            if (response.status) {
                                location.reload()
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
