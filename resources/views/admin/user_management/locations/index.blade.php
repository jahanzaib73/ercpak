@extends('layouts.app')
@section('location-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Locations</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">


            @if (Auth::user()->can('Add Location'))
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">
                                @if (isset($data['location']))
                                    Update Location
                                @else
                                    Add New Location
                                @endif
                            </h5>

                            <form role="form" method="POST"
                                action="{{ isset($data['location']) ? route('locations.update', ['id' => $data['location']->id]) : route('locations.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sr-only" for="location">Location</label>
                                            <input type="text"
                                                value="{{ old('name', isset($data['location']) ? $data['location']->name : '') }}"
                                                class="form-control autocomplete" name="name" id="complaint_type"
                                                placeholder="Enter location">
                                            @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sr-only" for="country">Select Country</label>
                                            <select name="country_id" id="country_id" class="form-control ml-2">
                                                <option value="">Select Country</option>
                                                @foreach ($data['countries'] as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ old('country_id', isset($data['location']) ? $data['location']->country_id : '') == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sr-only" for="province">Select Province</label>
                                            <select name="province_id" id="province_id" class="form-control ml-2">
                                                <option value="">Select Province</option>
                                                @foreach ($data['provinces'] as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ old('province_id', isset($data['location']) ? $data['location']->province_id : '') == $province->id ? 'selected' : '' }}>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sr-only" for="city">Select City</label>
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">Select City</option>
                                                @foreach ($data['cities'] as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ old('city_id', isset($data['location']) ? $data['location']->city_id : '') == $city->id ? 'selected' : '' }}>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sr-only" for="complaint_type">Select Status</label>
                                            <select name="status" id="status" class="form-control ml-2">
                                                <option value="1"
                                                    {{ isset($data['location']) && $data['location']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['location']) && $data['location']->status == 0 ? 'selected' : '' }}>
                                                    In-active</option>
                                            </select>
                                            @error('status')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn save-btn text-dark ml-2">Submit</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">Locations List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Name</th>
                                                <th>Country</th>
                                                <th>Province</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['locations'] as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($type->user)->full_name }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td>{{ optional($type->country)->name }}</td>
                                                    <td>{{ optional($type->province)->name }}</td>
                                                    <td>{{ optional($type->city)->name }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Location'))
                                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                                href="{{ route('locations.index', ['id' => $type->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Location'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('locations.delete', ['id' => $type->id]) }}"><i
                                                                    class="fa fa-trash-o"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&language=en&callback=initAutocomplete"
        async defer></script>
@endsection
