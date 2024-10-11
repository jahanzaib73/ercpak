@extends('layouts.app')
@section('inspection-active-class', 'active')

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
</style>
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3 class="header-title pb-3">Inspection # 2321</h3>
                        <div>
                            <form>
                                <div class="row d-flex justify-content-between">
                                    <div class="form-group col-12 col-md-8">
                                        <div>
                                            <h2>{{ optional($inspection->vehicle)->vehicle_number }}</h2>
                                            <h4>{{ optional(optional($inspection->vehicle)->model)->name }}</h4>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group col-6 col-md-4">
                                                <h5>Meter</h5>
                                                <h4>{{ optional($inspection->vehicle)->current_meter_reading }}</h4>
                                            </div>
                                            <div class="form-group col-6 col-md-4">
                                                <h5>Date</h5>
                                                <h4>{{ $inspection->date }}</h4>
                                            </div>
                                            <div class="form-group col-12 col-md-4">
                                                <h5>Cost Center</h5>
                                                <h4>{{ optional($inspection->costCenter)->title }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <img id="blah" src="{{ optional($inspection->vehicle)->image_url }}"
                                            alt="your image" width="100%" />

                                    </div>

                                </div>
                                <hr>

                                <h3>Inspection By</h3>
                                <div class="row d-flex justify-content-around">
                                    @foreach ($inspection->inspectionBies as $inspectionBy)
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
                                        <h3>Inspection Checklist</h3>
                                        <hr>
                                        <table id="myTable" class=" table order-list">
                                            <thead class="bg-info text-white">
                                                <tr>
                                                    <td><strong>Inspection Item</strong></td>
                                                    <td><strong>Status</strong></td>
                                                    <td><strong>Remarks</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inspection->inspectionChecklistItems as $items)
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
                                        @foreach ($inspection->attachments as $attachment)
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
                                <textarea class="form-control col-xs-12" disabled rows="2">{{ $inspection->remarks }}</textarea>
                            </div>
                        </div>
                        {{-- @if (auth()->user()->hasRole('Super Admin') && $inspection->status == 0)
                            <hr>
                            <div class="bg-info text-center text-white py-1">
                                <h2>ADMIN APPROVAL SECTION</h2>
                            </div>
                            <hr>
                            <form id="admin_approve_form">
                                <input type="hidden" name="inspectionId" value="{{ $inspection->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="technicians_ids"><strong>Assign Technicians</strong></label>
                                        <select id="technicians_ids" name="technicians_ids[]" class="form-control select2"
                                            multiple>

                                            @foreach ($users as $user)
                                                <option data-name="{{ $user->full_name }}"
                                                    data-designation="{{ optional($user->designation)->name }}"
                                                    data-image="{{ $user->profile_pic_url }}" value="{{ $user->id }}">
                                                    {{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vendor_id"><strong>Vendor</strong></label>
                                        <select id="vendor_id" name="vendor_id" class="form-control select2">
                                            <option value="">Choose Vendor...</option>
                                            @foreach ($venderos as $vendor)
                                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="selected-users  d-flex">

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Admin Remarks</h4>
                                        <textarea name="admin_remarks" class="form-control col-xs-12" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="row mt-3 text-right">
                                    <div class="col-md-12">
                                        <a href="{{ route('inspections.index') }}" class="btn cancel-btn mr-2">
                                            Cancel
                                        </a>

                                        @if (Auth::user()->can('Approve Inspection'))
                                            <button type="button" id="admin_approve_btn"
                                                class="btn save-btn">
                                                Approve & Start Work
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#technicians_ids').change(function() {
                console.log('sadas');
                $('.selected-users').empty();

                // Get all selected options
                var selectedOptions = $('#technicians_ids option:selected');

                // Loop through selected options and append their details
                selectedOptions.each(function() {
                    var selectedOption = $(this);
                    var userImage = selectedOption.data('image');
                    var userName = selectedOption.data('name');
                    var userDesignation = selectedOption.data('designation');

                    // Append user details to the target div
                    $('.selected-users').append(`
                        <div class="user-card text-center">
                            <img id="blah" src="${userImage}" alt="your image"
                                class="rounded-circle" />
                            <div>
                                <p id="user-name">${userName}</p>
                                <p id="user-designation">${userDesignation}</p>
                            </div>
                        </div>
                    `);
                });
            });
        });

        $(document).ready(function() {
            $("#admin_approve_form").validate({
                rules: {
                    // 'technicians_ids[]': "required",
                    vendor_id: "required",
                    // admin_remarks: "required",
                },
                messages: {
                    // 'technicians_ids[]': "Please Select technicians",
                    vendor_id: "Please Select Vendor",
                    // admin_remarks: "Please add remarks",
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
    </script>
@endsection
