@extends('layouts.app')
@section('user-active-class', 'active')
@section('content')
<style>
.header-title{
    margin: 0 !important;
}
</style>
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Create User</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div id="user_detail">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title">User Detail</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select name="employee_type" id="employee_type" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Regular"
                                                        {{ old('employee_type') == 'Regular' ? 'selected' : '' }}>Regular
                                                    </option>
                                                    <option value="Temporary"
                                                        {{ old('employee_type') == 'Temporary' ? 'selected' : '' }}>
                                                        Temporary</option>
                                                    <option value="Contract"
                                                        {{ old('employee_type') == 'Contract' ? 'selected' : '' }}>Contract
                                                    </option>
                                                </select>
                                                @error('employee_type')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select name="employee_sub_type" id="employee_sub_type"
                                                    class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Diplomates"
                                                        {{ old('employee_sub_type') == 'Diplomates' ? 'selected' : '' }}>
                                                        Diplomates</option>
                                                    <option value="Foreigners"
                                                        {{ old('employee_sub_type') == 'Foreigners' ? 'selected' : '' }}>
                                                        Foreigners</option>
                                                    <option value="Locals"
                                                        {{ old('employee_sub_type') == 'Locals' ? 'selected' : '' }}>Locals
                                                    </option>
                                                </select>
                                                @error('employee_sub_type')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>First Name</label> --}}
                                            <input type="text" name="first_name" class="form-control"
                                                value="{{ old('first_name') }}" placeholder="first name" />
                                            @error('first_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Last Name</label> --}}
                                            <input type="text" name="last_name" class="form-control"
                                                value="{{ old('last_name') }}" placeholder="last name" />
                                            @error('last_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Date of Birth</label> --}}
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ old('dob') }}" placeholder="last name" />
                                            @error('dob')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Select Designation</label> --}}
                                            <select name="designation_id" id="designation_id" class="form-control">
                                                <option value="">Select Designation</option>
                                                @foreach ($designations as $designation)
                                                    <option
                                                        {{ $designation->id == old('designation_id') ? 'selected' : '' }}
                                                        value="{{ $designation->id }}">{{ $designation->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('designation_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Select Department</label> --}}
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($departments as $department)
                                                    <option {{ old('department_id') == $department->id ? 'selected' : '' }}
                                                        value="{{ $department->id }}">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Select Location</label> --}}
                                            <select name="location_id" id="location_id" class="form-control">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $location)
                                                    <option {{ old('location_id') == $location->id ? 'selected' : '' }}
                                                        value="{{ $location->id }}">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="cr-styled">
                                                <input {{ old('is_activity_assignment') == '1' ? 'checked' : '' }}
                                                    type="checkbox" name="is_activity_assignment" value="1">
                                                <i class="fa"></i>
                                                Activity Assignment
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <hr>
                            </div>
                            <div id="leave_detail">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title">Leave Detail</h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="number" value="{{ old('leaves') }}" name="leaves"
                                                id="leaves" class="form-control" placeholder="Leave Qouta">
                                            @error('leaves')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div id="wages_detail">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title">Wages Detail</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select name="wages_type" id="wages_type" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Salary"
                                                        {{ old('wages_type') == 'Salary' ? 'selected' : '' }}>Salary
                                                    </option>
                                                    <option value="Daily"
                                                        {{ old('wages_type') == 'Daily' ? 'selected' : '' }}>Daily</option>
                                                    <option value="Other"
                                                        {{ old('wages_type') == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('wages_type')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="number" name="wages_type_value" class="form-control"
                                                value="{{ old('wages_type_value') }}" placeholder="enter value" />
                                            @error('wages_type_value')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="cost_center" id="cost_center" class="form-control">
                                                <option value="">Cost Center</option>
                                                @foreach ($costCenters as $costCenter)
                                                    <option value="{{ $costCenter->id }}"
                                                        {{ old('cost_center') == $costCenter->id ? 'selected' : '' }}>
                                                        {{ $costCenter->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('cost_center')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

    
                                <hr>
                            </div>

                            <div id="contact_detail">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title">Contact Detail</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Contact Number</label> --}}
                                            <input type="text" name="contact_number" class="form-control"
                                                value="{{ old('contact_number') }}" placeholder="Contact Number" />
                                            @error('contact_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Whats App Number</label> --}}
                                            <input type="text" name="whats_app_number" class="form-control"
                                                value="{{ old('whats_app_number') }}" placeholder="Whats App Number" />
                                            @error('whats_app_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Email</label> --}}
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Email" />
                                            @error('email')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Password</label> --}}
                                            <input type="password" name="password" class="form-control"
                                                value="{{ old('password') }}" placeholder="Password" />
                                            @error('password')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Select Country</label> --}}
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option {{ $country->id == old('country_id') ? 'selected' : '' }}
                                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Select Province</label> --}}
                                            <select name="province_id" id="province_id" class="form-control">
                                                <option value="">Select Province</option>
                                                @foreach ($provinces as $province)
                                                    <option {{ old('province_id') == $province->id ? 'selected' : '' }}
                                                        value="{{ $province->id }}">
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label>Select City</label> --}}
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option {{ old('city_id') == $city->id ? 'selected' : '' }}
                                                        value="{{ $city->id }}">
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
                                    <div class="col-md-3">
                                        {{-- <label for="">Profile Picture</label> --}}
                                        {{-- <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" name="profile_pic" class="custom-file-input"
                                                    id="profile_pic" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="profile_pic">Choose
                                                    file</label>
                                            </div>
                                        </div> --}}
                                        <div class="input-group mb-3 choseFileInputs">
                                            <input type="file" class="form-control chooser" name="profile_pic" id="profile_pic">
                                            <label class="input-group-text bg-danger text-white" for="profile_pic">Browse</label>
                                            </div>
                                           
                                        @error('profile_pic')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Address</label>
                                        <textarea name="address" placeholder="Address" id="address" cols="30" rows="2" class="form-control">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Notes</label>
                                        <textarea name="notes" placeholder="Notes" id="notes" cols="30" rows="2" class="form-control">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group mb-0 mt-1 d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn save-btn">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
