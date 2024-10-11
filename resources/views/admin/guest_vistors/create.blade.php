@extends('layouts.app')
@section('guest-vistor-active-class', 'active')
@section('content')
    <div class="container">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Add Guest & Customers</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('guest-and-visitors.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" id="type" value="{{ $module }}">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">


                            <div class="row d-flex align-items-center">
                                <div class="col-4 col-md-5 col-lg-5">
                                    <div class="form-group">
                                        <label><strong>Find Guest by CNIC</strong></label>
                                        <input type="number" name="cnic" id="cnic" class="form-control"
                                            value="{{ old('cnic', isset($guestVisitors) ? $guestVisitors->cnic : '') }}"
                                            placeholder="CNIC" />
                                        <div id="cnic-suggestions" class="list-group"></div>
                                        @error('cnic')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label><strong>Find Guest by CNIC</strong> <span
                                                title="Check if record already exist"><a id="oldRecordCnic"
                                                    href="javascript:void(0)"><i
                                                        class="mdi mdi-refresh text-white bg-info p-2 rounded-circle"></i></a></span>&nbsp;&nbsp;(Fetch
                                            Data)</label>
                                        <input type="number" name="cnic" id="cnic" class="form-control"
                                            value="{{ old('cnic', isset($guestVisitors) ? $guestVisitors->cnic : '') }}"
                                            placeholder="CNIC" />
                                        @error('cnic')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                </div>
                                @if ($module == App\Models\GuestVistor::VISTORS)
                                    <div class="col-4 col-md-5 col-lg-5">
                                        <div class="form-group">
                                            <label><strong>Date & Time</strong></label>
                                            <input type="datetime-local" name="date_time" id="date_time"
                                                class="form-control"
                                                value="{{ old('date_time', isset($guestVisitors) ? $guestVisitors->date_time : now()->format('Y-m-d\TH:i')) }}"
                                                placeholder="date_time" />
                                            @error('date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                @if ($module == App\Models\GuestVistor::GUEST)
                                    <div class="col-4 col-md-1 col-lg-1">
                                        <label for=""></label>
                                        <h6 class="text-center">OR</h6>
                                    </div>
                                    <div class="col-4 col-md-5 col-lg-5">
                                        <label><strong>Select Guest</strong> </label>
                                        <div class="row ">
                                            <div class="col-8 col-md-7 col-lg-8">
                                                <div class="form-group">
                                                    <select name="guest_id" id="guest_id" class="form-control">
                                                        <option value="">Select Guest</option>
                                                        @foreach ($guests as $guest)
                                                            <option value="{{ $guest->id }}"
                                                                {{ $guest->id == old('guest_id', isset($guestVisitors) ? $guestVisitors->guest_id : '') ? 'selected' : '' }}>
                                                                @if ($guest->official_name)
                                                                    {{ $guest->official_name . ' (' . optional($guest->protocolLiaisonType)->name . ')' }}
                                                                @elseif ($guest->notable_name)
                                                                    {{ $guest->notable_name . ' (' . optional($guest->protocolLiaisonType)->name . ')' }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('guest_id')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-4 col-md-5 col-lg-4">
                                                <label class="mt-1"><strong></strong> <span><button type="button"
                                                            class="btn save-btn btn-sm rounded-circle" data-toggle="modal"
                                                            data-target="#exampleModalform">
                                                            <i class="fa fa-plus pt-1"></i>
                                                        </button></span></label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-4 col-md-5 col-lg-5">
                                        <div class="form-group">
                                            <label><strong>Date & Time</strong></label>
                                            <input type="datetime-local" name="date_time" id="date_time"
                                                class="form-control"
                                                value="{{ old('date_time', isset($guestVisitors) ? $guestVisitors->date_time : now()->format('Y-m-d\TH:i')) }}"
                                                placeholder="date_time" />
                                            @error('date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label><strong>Address</strong></label>
                                            <input type="text" name="address" class="form-control autocomplete"
                                                value="{{ old('address', isset($guestVisitors) ? $guestVisitors->address : '') }}" />
                                            @error('address')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                        @else
                            <!--============== VISITOR SECTION START =============-->

                            <div class="container-fluid">

                                <div class="row topbar-header rounded d-flex justify-content-center">
                                    <h5 class="py-2 pt-3 text-white "><strong>Visitor Details</strong></h5>
                                </div>
                                <div class="row pt-3">
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Visitor Name</strong></label>
                                            <input type="text" name="vistor_name" class="form-control"
                                                value="{{ old('vistor_name', isset($guestVisitors) ? $guestVisitors->vistor_name : '') }}"
                                                placeholder="Visitor Name" />
                                            @error('vistor_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Visitor Email</strong></label>
                                            <input type="email" name="vistor_email" class="form-control"
                                                value="{{ old('vistor_email', isset($guestVisitors) ? $guestVisitors->vistor_email : '') }}"
                                                placeholder="Visitor Email" />
                                            @error('vistor_email')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Visitor Contact</strong></label>
                                            <input type="number" name="vistor_contact" class="form-control"
                                                value="{{ old('vistor_contact', isset($guestVisitors) ? $guestVisitors->vistor_contact : '') }}"
                                                placeholder="Visitor Contact" />
                                            @error('vistor_contact')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Province</strong></label>
                                            <select name="province_id" id="province_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ old('province_id', isset($guestVisitors) ? $guestVisitors->province_id : '') == $province->id ? 'selected' : '' }}>
                                                        {{ $province->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('province_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>City</strong></label>
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ old('city_id', isset($guestVisitors) ? $guestVisitors->city_id : '') == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('city_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label><strong>Visitor Address</strong></label>
                                            <input class="form-control autocomplete" name="address" id="address"
                                                value="{{ old('address', isset($guestVisitors) ? $guestVisitors->address : '') }}">
                                            @error('address')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 pl-0 col-lg-3">
                                    {{-- <label for="" style="font-weight: bold; font-size: 17px">Select
                                        Photo</label> --}}
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                        </div>
                                        {{-- <div class="custom-file">
                                            <input type="file" name="visitor_photo" class="custom-file-input"
                                                id="visitor_photo" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="visitor_photo">Choose
                                                file</label>
                                        </div> --}}

                                        <div class="input-group mb-3 choseFileInputs">
                                            <input type="file" class="form-control chooser" name="visitor_photo"
                                                id="visitor_photo">
                                            <label class="input-group-text bg-danger text-white"
                                                for="visitor_photo">Browse</label>
                                        </div>
                                    </div>
                                    @error('visitor_photo')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="row" id="visitor_photo_fileContainer"></div>
                                </div>
                            </div>
                            <!--============== VISITOR SECTION END =============-->
                            @endif
                            <section class="container-fluid">
                                <div class="row topbar-header rounded d-flex justify-content-center">
                                    <h5 class="py-2 text-white pt-3"><strong>Customer/Visitor Details</strong></h5>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Select Purpose of Visit</strong></label>
                                            <select name="purpose_of_visit_id" id="purpose_of_visit_id"
                                                class="form-control">
                                                <option value="">Select Purpose of Visit</option>
                                                @foreach ($purposeOfVisitors as $purpose)
                                                    <option
                                                        {{ old('purpose_of_visit_id', isset($guestVisitors) ? $guestVisitors->purpose_of_visit_id : '') == $purpose->id ? 'selected' : '' }}
                                                        value="{{ $purpose->id }}">
                                                        {{ $purpose->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('purpose_of_visit_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Enter Passport Number</strong></label>
                                            <input type="text" name="passport_number" class="form-control"
                                                value="{{ old('passport_number', isset($guestVisitors) ? $guestVisitors->passport_number : '') }}"
                                                placeholder="passport number" />
                                            @error('passport_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Select Currency</strong></label>
                                            <select name="currency" id="currency" class="form-control">
                                                <option>Select Currency</option>
                                                <option
                                                    {{ old('currency', isset($guestVisitors) ? $guestVisitors->currency : '') == 'USD' ? 'selected' : '' }}
                                                    value="USD">
                                                    USD</option>
                                                <option
                                                    {{ old('currency', isset($guestVisitors) ? $guestVisitors->currency : '') == 'AED' ? 'selected' : '' }}
                                                    value="AED">
                                                    AED</option>
                                                <option
                                                    {{ old('currency', isset($guestVisitors) ? $guestVisitors->currency : '') == 'PKR' ? 'selected' : '' }}
                                                    value="PKR">
                                                    PKR</option>
                                            </select>
                                            @error('currency')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Enter Fee</strong></label>
                                            <input type="number" name="fee" class="form-control text-right"
                                                value="{{ old('fee', isset($guestVisitors) ? $guestVisitors->fee : '') }}"
                                                placeholder="0.00" />
                                            @error('fee')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Department</strong></label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id', isset($guestVisitors) ? $guestVisitors->department_id : '') == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Location</strong></label>
                                            <select name="location_id" id="location_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}"
                                                        {{ old('location_id', isset($guestVisitors) ? $guestVisitors->location_id : '') == $location->id ? 'selected' : '' }}>
                                                        {{ $location->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('location_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Host</strong></label>
                                            <select name="host_id" id="host_id" class="form-control">
                                                <option value="">Host</option>
                                                @foreach ($hosts as $host)
                                                    <option value="{{ $host->id }}"
                                                        {{ old('host_id', isset($guestVisitors) ? $guestVisitors->host_id : '') == $host->id ? 'selected' : '' }}>
                                                        {{ $host->full_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('host_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="number" name="lat" class="form-control"
                                                value="{{ old('lat', isset($guestVisitors) ? $guestVisitors->lat : '') }}"
                                                placeholder="Google Map Latitude" step=".0000000000000001" />
                                            @error('lat')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="number" name="lng" class="form-control"
                                                value="{{ old('lng', isset($guestVisitors) ? $guestVisitors->lng : '') }}"
                                                placeholder="Google Map Longitude" step=".0000000000000001" />
                                            @error('lng')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{--  <div class="row">
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Time In</strong></label>
                                            <input type="datetime-local" name="time_in" class="form-control"
                                                value="{{ old('time_in', isset($guestVisitors) ? $guestVisitors->time_in : '') }}" />
                                            @error('time_in')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Time Out</strong></label>
                                            <input type="datetime-local" name="time_out" class="form-control"
                                                value="{{ old('time_out', isset($guestVisitors) ? $guestVisitors->time_out : '') }}" />
                                            @error('time_out')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>  --}}
                                <div class="row">
                                    <div class="form-group col-12 col-md-6 col-lg-6">
                                        <label><strong>Visit Details</strong></label>
                                        <textarea name="notes" placeholder="Visit Details" id="notes" width="100%" rows="2"
                                            class="form-control">{{ old('notes', isset($guestVisitors) ? $guestVisitors->notes : '') }}</textarea>
                                        @error('notes')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- </div> -->
                                <div class="form-group mb-0 mt-3">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn save-btn px-3">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="exampleModalform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Add Guest/Visitor</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div> --}}
                <div class="modal-header bottom-border p-1">
                    <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Add
                            Guest/Visitor</strong></h3>
                    <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{ route('couriers.protocol.add') }}" id="addProtocolForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type" class="control-label"><strong>Select Type</strong></label>
                                    <select required id="type" name="type"
                                        class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                        <option value="">Please Select</option>
                                        <option value="OFFICIAL">Official</option>
                                        <option value="NOTABLE">Notable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{-- <label for="Name" class="control-label"><Strong>Name</Strong></label> --}}
                                    <input type="text" required class="form-control" name="name" id="name"
                                        placeholder="Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    {{-- <label for="phone_number" class="control-label"><Strong>Mobile Number</Strong></label> --}}
                                    <input type="text" required class="form-control" name="phone_number"
                                        id="phone_number" placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{-- <label for="department_id" class="control-label"><Strong>Department</Strong></label> --}}
                                    <select required id="department_id" name="department_id"
                                        class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                        <option value="">Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3 mr-3">
                        <button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal"
                            aria-label="Close">Cancel</button>

                        <button type="submit" class="btn save-btn btns-w">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#addProtocolForm').parsley();
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#cnic').on('input', function() {
                var cnic = $(this).val();
                var type = $('#type').val();
                if (cnic.length > 2) { // Start searching after 3 characters
                    // debugger;
                    $.ajax({
                        url: "{{ route('guest-and-visitors.searchSuggestion') }}",
                        method: 'GET',
                        data: {
                            cnic: cnic,
                            type: type
                        },
                        success: function(response) {
                            var suggestions = $('#cnic-suggestions');
                            suggestions.empty();
                            if (response.length > 0) {
                                response.forEach(function(visitor) {
                                    suggestions.append(
                                        '<a href="#" class="list-group-item list-group-item-action" data-cnic="' +
                                        visitor.cnic + '">' + visitor.cnic + '</a>');
                                });
                            } else {
                                suggestions.append(
                                    '<div class="list-group-item">No matches found</div>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#cnic-suggestions').empty();
                }
            });

            $(document).on('click', '#cnic-suggestions .list-group-item', function() {
                var cnic = $(this).data('cnic');
                $('#cnic').val(cnic);
                $('#cnic-suggestions').empty();

                var type = $('#type').val();
                let url =
                    "{{ route('guest-and-visitors.create', ['module' => ':module', 'oldRecordCnic' => ':oldRecordCnic']) }}"
                    .replace(':module', type).replace(':oldRecordCnic', cnic);
                window.location.href = url;
            });
        });


        // $(document).ready(function() {

        //     $('#oldRecordCnic').click(function(e) {
        //         var cnic = $('#cnic').val();
        //         var module = $('#type').val()
        //         if (cnic) {
        //             let url =
        //                 "{{ route('guest-and-visitors.create', ['module' => ':module', 'oldRecordCnic' => ':oldRecordCnic']) }}"
        //                 .replace(':module', module).replace(':oldRecordCnic', cnic);
        //             window.location.href = url;

        //         } else {
        //             alert('Please enter CNIC first')
        //         }

        //     });

        //     $('#visitor_photo').change(function() {
        //         renderFiles(this.files, 'visitor_photo_fileContainer')
        //     });

        // });


        function renderFiles(files, container) {
            var files = files;
            var container = $('#' + container);
            container.empty();

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var fileContent = e.target.result;
                    var fileType = file.type;
                    var fileName = file.name;

                    var fileElement = $('<div class="col-md-2 mr-2 mb-4" style="font-size: 100px">');

                    if (fileType.startsWith('image/')) {
                        fileElement.html('<i  class="mdi mdi-file-document"></i>');
                    } else if (fileType === 'application/pdf') {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    } else if (fileType === 'application/msword' || fileType ===
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    } else {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    }

                    container.append(fileElement);
                };

                reader.readAsDataURL(file);
            }
        }

        function initAutocomplete() {
            var options = {
                types: ['geocode'],
                componentRestrictions: {
                    country: "pk"
                }
            };

            var input = document.getElementsByClassName('autocomplete');

            for (i = 0; i < input.length; i++) {
                autocomplete = new google.maps.places.Autocomplete(input[i], options);
            }
        };
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&language=en&callback=initAutocomplete&loading=async"
        async defer></script>
@endsection
