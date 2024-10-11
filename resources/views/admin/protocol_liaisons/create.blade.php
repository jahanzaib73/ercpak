@extends('layouts.app')
@section('protocol-liaison-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Protocol & Liaisons</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('protocol-and-liaisons.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="protocol_liaisontype_id" value="{{ $module }}">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">



                            <div id="official_container" class="@if ($module != 1) d-none @endif">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">OFFICIAL Details</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Official Name</label>
                                            <input type="text" name="official_name" class="form-control"
                                                value="{{ old('official_name') }}" placeholder="Official Name" />
                                            @error('official_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Official Designation</label>
                                            <input type="text" name="official_designation" class="form-control"
                                                value="{{ old('official_designation') }}"
                                                placeholder="Official Designation" />
                                            @error('official_designation')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Department</label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($department as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
                                </div>

                                <div class="row">                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Official Email</label>
                                            <input type="email" name="official_email" class="form-control"
                                                value="{{ old('official_email') }}" placeholder="Official Email" />
                                            @error('official_email')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="number" name="official_google_map_lat" class="form-control"
                                                value="{{ old('official_google_map_lat') }}"
                                                placeholder="Google Map Latitude" step=".0000000000000001" />
                                            @error('official_google_map_lat')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="number" name="official_google_map_lng" class="form-control"
                                                value="{{ old('official_google_map_lng') }}"
                                                placeholder="Google Map Longitude" step=".0000000000000001" />
                                            @error('official_google_map_lng')
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
                                            <label>City</label>
                                            <select name="official_city_id" id="official_city_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('official_city_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="number" name="official_phone" class="form-control"
                                                value="{{ old('official_phone') }}" placeholder="Phone" />
                                            @error('official_phone')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Official Address</label>
                                            <input type="text" name="official_address" class="form-control autocomplete"
                                                value="{{ old('official_address') }}" />
                                            @error('official_address')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Official Biography</label>
                                    <textarea name="official_biography" placeholder="Official Biography" id="official_biography" cols="30"
                                        rows="2" class="form-control">{{ old('official_biography') }}</textarea>
                                    @error('official_biography')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <hr>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Official Photo</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="official_photo" class="custom-file-input"
                                                    id="official_photo" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="official_photo">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-3 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="official_photo" id="official_photo">
                                                <label class="input-group-text bg-danger text-white" for="official_photo">Browse</label>
                                                </div>
                                        </div>
                                        @error('official_photo')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="official_photo_fileContainer"></div>
                            </div>
                            <div id="notable_container" class="@if ($module != 2) d-none @endif">

                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Notable Details</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Notable Name</label>
                                            <input type="text" name="notable_name" class="form-control"
                                                value="{{ old('notable_name') }}" placeholder="Notable Name" />
                                            @error('notable_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Notable Email</label>
                                            <input type="email" name="notable_email" class="form-control"
                                                value="{{ old('notable_email') }}" placeholder="Notable Email" />
                                            @error('notable_email')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="number" name="notable_phone" class="form-control"
                                                value="{{ old('notable_phone') }}" placeholder="Phone" />
                                            @error('notable_phone')
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
                                            <label>City</label>
                                            <select name="notable_city_id" id="notable_city_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('notable_city_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="number" name="notable_google_map_lat" class="form-control"
                                                value="{{ old('notable_google_map_lat') }}" placeholder="Latitude"
                                                step=".0000000000000001" />
                                            @error('notable_google_map_lat')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="number" name="notable_google_map_lng" class="form-control"
                                                value="{{ old('notable_google_map_lng') }}" placeholder="Longitude"
                                                step=".0000000000000001" />
                                            @error('notable_google_map_lng')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Notable Biography</label>
                                    <textarea name="notable_biography" placeholder="Notable Biography" id="notable_biography" cols="30"
                                        rows="2" class="form-control">{{ old('notable_biography') }}</textarea>
                                    @error('notable_biography')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Notable Address</label>
                                    <textarea name="notable_address" placeholder="Notable Address" id="notable_address" cols="30" rows="2"
                                        class="form-control">{{ old('notable_address') }}</textarea>
                                    @error('notable_address')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Notable Photo</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="notable_photo" class="custom-file-input"
                                                    id="notable_photo" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="notable_photo">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-3 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="notable_photo" id="notable_photo">
                                                <label class="input-group-text bg-danger text-white" for="notable_photo">Browse</label>
                                                </div>
                                        </div>
                                        @error('notable_photo')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                </div>
                                <div class="row" id="notable_photo_fileContainer"></div>
                            </div>



                            <div id="company_container" class="@if ($module != 3) d-none @endif">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Company Details</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company_name" class="form-control"
                                                value="{{ old('company_name') }}" placeholder="Company Name" />
                                            @error('company_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company City/Town</label>
                                            <input type="text" name="company_city" class="form-control"
                                                value="{{ old('company_city') }}" placeholder="Company City/Town" />
                                            @error('company_city')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="email" name="company_email" class="form-control"
                                                value="{{ old('company_email') }}" placeholder="Company Email" />
                                            @error('company_email')
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
                                            <label>Latitude</label>
                                            <input type="number" name="company_google_map_lat" class="form-control"
                                                value="{{ old('company_google_map_lat') }}" placeholder="Latitude"
                                                step=".0000000000000001" />
                                            @error('company_google_map_lat')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="number" name="company_google_map_lng" class="form-control"
                                                value="{{ old('company_google_map_lng') }}" placeholder="Longitude"
                                                step=".0000000000000001" />
                                            @error('company_google_map_lng')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Webiste URL</label>
                                            <input type="text" name="company_website" class="form-control"
                                                value="{{ old('company_website') }}" placeholder="Company Webiste URL" />
                                            @error('company_website')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>About Company</label>
                                    <textarea name="company_about" placeholder="About Company" id="company_about" cols="30" rows="2"
                                        class="form-control">{{ old('company_about') }}</textarea>
                                    @error('company_about')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Company Address</label>
                                    <textarea name="company_address" placeholder="Company Address" id="company_address" cols="30" rows="2"
                                        class="form-control">{{ old('company_address') }}</textarea>
                                    @error('company_address')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Company Photo</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="company_photos[]" multiple
                                                    class="custom-file-input" id="company_photos"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="company_photos">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-3 choseFileInputs">
<input type="file" class="form-control chooser" name="company_photos[]" id="company_photos[]">
<label class="input-group-text bg-danger text-white" for="company_photos[]">Browse</label>
</div>
                                        </div>
                                        @error('company_photos')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                </div>
                            </div>
                            <div class="row" id="company_photos_fileContainer"></div>





                            <div id="project_container" class="@if ($module != 4) d-none @endif">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Project Details</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <input type="text" name="project_name" class="form-control"
                                                value="{{ old('project_name') }}" placeholder="Project Name" />
                                            @error('project_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    {{--  <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Project City/Town</label>
                                            <input type="text" name="project_city" class="form-control"
                                                value="{{ old('project_city') }}" placeholder="Project City/Town" />
                                            @error('project_city')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>  --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Project Email</label>
                                            <input type="email" name="project_email" class="form-control"
                                                value="{{ old('project_email') }}" placeholder="Project Email" />
                                            @error('project_email')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ old('city_id') == $city->id ? 'selected' : '' }}>
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
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select name="location_id" id="location_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}"
                                                        {{ old('location_id') == $location->id ? 'selected' : '' }}>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="number" name="project_google_map_lat" class="form-control"
                                                value="{{ old('project_google_map_lat') }}" placeholder="Latitude"
                                                step=".0000000000000001" />
                                            @error('project_google_map_lat')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="number" name="project_google_map_lng" class="form-control"
                                                value="{{ old('project_google_map_lng') }}" placeholder="Longitude"
                                                step=".0000000000000001" />
                                            @error('project_google_map_lng')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Project Webiste URL</label>
                                            <input type="text" name="project_website" class="form-control"
                                                value="{{ old('project_website') }}" placeholder="Project Webiste URL" />
                                            @error('project_website')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    
                                </div>

                                <div class="form-group">
                                    <label>About Project</label>
                                    <textarea name="project_company_about" placeholder="About Project" id="project_company_about" cols="30"
                                        rows="2" class="form-control">{{ old('project_company_about') }}</textarea>
                                    @error('project_company_about')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Project Address</label>
                                    <textarea name="project_address" placeholder="Project Address" id="project_address" cols="30" rows="2"
                                        class="form-control">{{ old('project_address') }}</textarea>
                                    @error('project_address')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Project Description</label>
                                    <textarea name="project_description" placeholder="Project Description" id="project_description" cols="30"
                                        rows="2" class="form-control">{{ old('project_description') }}</textarea>
                                    @error('project_description')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Project Feature Photo</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="project_feture_photo" multiple
                                                    class="custom-file-input" id="project_feture_photo"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="project_feture_photo">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-3 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="project_feture_photo" id="project_feture_photo">
                                                <label class="input-group-text bg-danger text-white" for="project_feture_photo">Browse</label>
                                                </div>
                                        </div>
                                        @error('project_feture_photo')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                </div>
                                <div class="row" id="project_feture_photo_fileContainer"></div>
                                <hr>

                                {{--  <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Project Photo</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="project_photos[]" multiple
                                                    class="custom-file-input" id="project_photos"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="project_photos">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        @error('project_photos')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                </div>
                                <div class="row" id="project_photos_fileContainer"></div>  --}}
                            </div>

                            <div id="property_container" class="@if ($module != 5) d-none @endif">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Property Details</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Property Name</label>
                                            <input type="text" name="property_name" class="form-control"
                                                value="{{ old('property_name') }}" placeholder="Property Name" />
                                            @error('property_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Property City/Town</label>
                                            <input type="text" name="property_city" class="form-control"
                                                value="{{ old('property_city') }}" placeholder="Property City/Town" />
                                            @error('property_city')
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
                                            <input type="number" name="property_google_map_lat" class="form-control"
                                                value="{{ old('property_google_map_lat') }}" placeholder="Latitude"
                                                step=".0000000000000001" />
                                            @error('property_google_map_lat')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="number" name="property_google_map_lng" class="form-control"
                                                value="{{ old('property_google_map_lng') }}" placeholder="Longitude"
                                                step=".0000000000000001" />
                                            @error('property_google_map_lng')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>About Property</label>
                                    <textarea name="property_company_about" placeholder="About Company" id="property_company_about" cols="30"
                                        rows="2" class="form-control">{{ old('property_company_about') }}</textarea>
                                    @error('property_company_about')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Property Address</label>
                                    <textarea name="property_address" placeholder="Property Address" id="property_address" cols="30"
                                        rows="2" class="form-control">{{ old('property_address') }}</textarea>
                                    @error('property_address')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Property Description</label>
                                    <textarea name="property_description" placeholder="Property Description" id="property_description" cols="30"
                                        rows="2" class="form-control">{{ old('property_description') }}</textarea>
                                    @error('property_description')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <h5 class="header-title ">Property Photo</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photos</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="property_photos[]" multiple
                                                    class="custom-file-input" id="property_photos"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="property_photos">Choose
                                                    file</label>
                                            </div> --}}
                                            <div class="input-group mb-3 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="property_photos[]" id="property_photos[]">
                                                <label class="input-group-text bg-danger text-white" for="property_photos[]">Browse</label>
                                                </div>
                                        </div>
                                        @error('property_photos')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror


                                    </div>

                                </div>
                                <div class="row" id="property_photos_fileContainer"></div>
                            </div>
                            <div class="form-group mb-0  d-flex justify-content-end">
                                <div>
                                    <button type="submit" class="btn save-btn">
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

            $('#official_photo').change(function() {
                renderFiles(this.files, 'official_photo_fileContainer')
            });

            $('#notable_photo').change(function() {
                renderFiles(this.files, 'notable_photo_fileContainer')
            });

            $('#company_photos').change(function() {
                renderFiles(this.files, 'company_photos_fileContainer')
            });

            $('#project_photos').change(function() {
                renderFiles(this.files, 'project_photos_fileContainer')
            });

            $('#project_feture_photo').change(function() {
                renderFiles(this.files, 'project_feture_photo_fileContainer')
            });

            $('#property_photos').change(function() {
                renderFiles(this.files, 'property_photos_fileContainer')
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
        async defer>
    </script>
@endsection
