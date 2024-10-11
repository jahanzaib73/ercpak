@extends('layouts.app')
@section('guest-vistor-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Update Guest & Customers</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post"
            action="{{ route('guest-and-visitors.update', ['guest_and_visitor' => $guest_visitor->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="type" value="{{ $guest_visitor->type }}">
            <input type="hidden" name="id" value="{{ $guest_visitor->id }}">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">



                            <div id="guest_container">
                                @if ($guest_visitor->type == App\Models\GuestVistor::GUEST)
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <h5 class="header-title pb-3">GUEST Details</h5>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Guest <a target="_blank"
                                                        href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::OFFICIAL]) }}"><i
                                                            class="fa fa-plus"></i></a></label>
                                                <select name="guest_id" id="guest_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach ($guests as $guest)
                                                        <option value="{{ $guest->id }}"
                                                            {{ $guest->id == old('guest_id', $guest_visitor->guest_id) ? 'selected' : '' }}>
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

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Purpose of Visit</label>
                                                <input type="text" name="purpose_of_visit" class="form-control"
                                                    value="{{ old('purpose_of_visit', $guest_visitor->purpose_of_visit) }}"
                                                    placeholder="Purpose of Visit" />
                                                @error('purpose_of_visit')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                @else
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <h5 class="header-title pb-3">Customer Details</h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <input type="text" name="vistor_name" class="form-control"
                                                    value="{{ old('vistor_name', $guest_visitor->vistor_name) }}"
                                                    placeholder="Customer Name" />
                                                @error('vistor_name')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Email</label>
                                                <input type="email" name="vistor_email" class="form-control"
                                                    value="{{ old('vistor_email', $guest_visitor->vistor_email) }}"
                                                    placeholder="Customer Email" />
                                                @error('vistor_email')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Customer Contact</label>
                                                <input type="number" name="vistor_contact" class="form-control"
                                                    value="{{ old('vistor_contact', $guest_visitor->vistor_contact) }}"
                                                    placeholder="Customer Contact" />
                                                @error('vistor_contact')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{--  <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Purpose of Visit</label>
                                                <input type="text" name="purpose_of_visit" class="form-control"
                                                    value="{{ old('purpose_of_visit', $guest_visitor->purpose_of_visit) }}"
                                                    placeholder="Purpose of Visit" />
                                                @error('purpose_of_visit')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>  --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Province</label>
                                                <select name="province_id" id="province_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->id }}"
                                                            {{ old('province_id', $guest_visitor->province_id) == $province->id ? 'selected' : '' }}>
                                                            {{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('province_id')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select name="city_id" id="city_id" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ old('city_id', $guest_visitor->city_id) == $city->id ? 'selected' : '' }}>
                                                            {{ $city->name }}</option>
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Customer Address</label>
                                                <textarea class="form-control" name="address" id="address" cols="30" rows="2">{{ old('address', $guest_visitor->address) }}</textarea>
                                                @error('address')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label for="" style="font-weight: bold; font-size: 17px">Select
                                                Photo</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="visitor_photo" class="custom-file-input"
                                                        id="visitor_photo" aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="visitor_photo">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                            @error('visitor_photo')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row" id="visitor_photo_fileContainer"></div>
                                    <hr>
                                @endif
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Visit Details</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Purpose of Visit</label>
                                            <select name="purpose_of_visit_id" id="purpose_of_visit_id"
                                                class="form-control">
                                                <option>Please Select</option>
                                                @foreach ($purposeOfVisitors as $purpose)
                                                    <option
                                                        {{ $guest_visitor->purpose_of_visit_id == $purpose->id ? 'selected' : '' }}
                                                        value="{{ $purpose->id }}">
                                                        {{ $purpose->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('purpose_of_visit_id')
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
                                            <label>Enter CNIC</label>
                                            <input type="text" name="cnic" class="form-control"
                                                value="{{ old('cnic', $guest_visitor->cnic) }}" placeholder="CNIC" />
                                            @error('cnic')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Enter Passport Number</label>
                                            <input type="text" name="passport_number" class="form-control"
                                                value="{{ old('passport_number', $guest_visitor->passport_number) }}"
                                                placeholder="passport number" />
                                            @error('passport_number')
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
                                            <label>Select Currency</label>
                                            <select name="currency" id="currency" class="form-control">
                                                <option value="">Please Select</option>
                                                <option {{ $guest_visitor->currency == 'USD' ? 'selected' : '' }}
                                                    value="USD">USD</option>
                                                <option {{ $guest_visitor->currency == 'AED' ? 'selected' : '' }}
                                                    value="AED">AED</option>
                                                <option {{ $guest_visitor->currency == 'PKR' ? 'selected' : '' }}
                                                    value="PKR">PKR</option>
                                            </select>
                                            @error('currency')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Enter Fee</label>
                                            <input type="number" name="fee" class="form-control"
                                                value="{{ $guest_visitor->fee }}" placeholder="Fee" />
                                            @error('fee')
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
                                            <label>Department</label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id', $guest_visitor->department_id) == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select name="location_id" id="location_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}"
                                                        {{ old('location_id', $guest_visitor->location_id) == $location->id ? 'selected' : '' }}>
                                                        {{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('location_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Host</label>
                                            <select name="host_id" id="host_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($hosts as $host)
                                                    <option value="{{ $host->id }}"
                                                        {{ old('host_id', $guest_visitor->host_id) == $host->id ? 'selected' : '' }}>
                                                        {{ $host->full_name }}</option>
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
                                                value="{{ old('lat', $guest_visitor->lat) }}"
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
                                                value="{{ old('lng', $guest_visitor->lng) }}"
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time In</label>
                                            <input type="datetime-local" name="time_in" class="form-control"
                                                value="{{ old('time_in', $guest_visitor->time_in) }}" />
                                            @error('time_in')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time Out</label>
                                            <input type="datetime-local" name="time_out" class="form-control"
                                                value="{{ old('time_out', $guest_visitor->time_out) }}" />
                                            @error('time_out')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>  --}}

                                <div class="form-group">
                                    <label>Visit Details</label>
                                    <textarea name="notes" placeholder="Visit Details" id="notes" cols="30" rows="2"
                                        class="form-control">{{ old('notes', $guest_visitor->notes) }}</textarea>
                                    @error('notes')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <hr>
                            </div>

                            <div class="form-group mb-0 mt-5">
                                <div>
                                    <button type="submit" class="btn save-btn waves-effect waves-light">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#visitor_photo').change(function() {
                renderFiles(this.files, 'visitor_photo_fileContainer')
            });

        });


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
    </script>
@endsection
