@extends('layouts/contentLayoutMaster')
@section('content')
<!-- Basic Horizontal form layout section start -->
<section id="basic-horizontal-layouts">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <?php
                    if (isset($users->id) && $users->id != 0) { ?>
                        <h4 class="card-title">Update {{$users->username ?? ''}} details</h4>

                    <?php } else { ?>
                        <h4 class="card-title">Add new user</h4>
                    <?php }
                    ?>

                </div>
                <div class="card-body">
                    <?php
                    if (isset($users->id) && $users->id != 0) {
                        $url = url('/admin/user/add/' . $users->id);
                    } else {
                        $url = url('/admin/user/add');
                    }
                    ?>
                    <form class="form form-horizontal" action="{{ url($url)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-8 offset-2">
                                        <input type="text" class="form-control" name="fullname" value="{{$users->fullname ?? ''}}" placeholder="Enter Fullname" required />
                                        @error('fullname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-8 offset-2 mt-1">
                                        <input type="text" class="form-control" name="username" value="{{$users->username ?? ''}}" placeholder="Enter Username" required />
                                        @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <?php
                                    if (isset($users->id) && $users->id != 0) { ?>

                                    <?php } else { ?>
                                        <div class="col-sm-8 offset-2 mt-1">
                                            <input type="email" class="form-control" name="email" value="{{$users->email ?? ''}}" placeholder="Enter Email" required />
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    <?php }
                                    ?>
                                    <div class="col-sm-8 offset-2 mt-1">
                                        <input type="number" class="form-control" name="contact" value="{{$users->contact ?? ''}}" placeholder="Enter Contact Number" required />
                                        @error('contact')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-8 offset-2 mt-1">
                                        <input type="text" class="form-control" name="country" value="{{$users->country ?? ''}}" placeholder="Enter Country Name" required />
                                        @error('country')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-8 offset-2 mt-1">
                                        <input class="form-control" type="file" id="formFile" name="photo" />
                                    </div>
                                    <div class="col-sm-8 offset-2 mt-1">
                                        <input type="text" class="form-control" name="company" value="{{$users->company ?? ''}}" placeholder="Enter Company Name" required />
                                        @error('company')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <?php
                                    if (isset($users->id) && $users->id != 0) { ?>
                                    <?php } else { ?>
                                        <div class="col-sm-8 offset-2 mt-1">
                                            <input type="text" class="form-control" name="password" value="{{$users->password ?? ''}}" placeholder="Enter Password" required />
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    <?php }
                                    ?>
                                    <div class="col-sm-8 offset-2 mt-1">
                                        <select class="form-select" id="basicSelect" name="role">
                                            @foreach($roles as $data)
                                            <option>{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 offset-sm-5">
                                <?php
                                if (isset($users->id) && $users->id != 0) {?>
                                    <button type="submit" class="btn btn-primary me-1">Update</button>
                              <?php  } else {?>
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                               <?php }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Horizontal form layout section end -->
<!-- Dropzone section start -->
<!-- <section id="dropzone-examples">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button id="clear-dropzone" class="btn btn-outline-primary mb-1">
                        <i data-feather="trash" class="me-25"></i>
                        <span class="align-middle">Clear Dropzone</span>
                    </button>
                    <form action="#" class="dropzone dropzone-area" id="dpz-remove-all-thumb">
                        <div class="dz-message">Drop files here or click to upload.</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Dropzone section end -->
@endsection

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
@endsection