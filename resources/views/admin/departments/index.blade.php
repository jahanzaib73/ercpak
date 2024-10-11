@extends('layouts.app')
@section('department-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">DEPARTMENTS</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">



            <div class="col-lg-12 col-sm-12">
                @if (Auth::user()->can('Add Department'))
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">
                                @if (isset($data['department']))
                                    Update Department
                                @else
                                    Add New Department
                                @endif
                            </h5>

                            <form role="form" method="POST" enctype="multipart/form-data"
                                action="{{ isset($data['department']) ? route('departments.update', ['id' => $data['department']->id]) : route('departments.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="complaint_type">Department Name</label>
                                            <input type="text"
                                                value="{{ old('name', isset($data['department']) ? $data['department']->name : '') }}"
                                                class="form-control" name="name" id="complaint_type"
                                                placeholder="Enter name">
                                            @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="complaint_type">Select Government</label>
                                            <select name="government_id" id="government_id" class="form-control">
                                                <option value="">Select Government</option>
                                                @foreach ($data['goverments'] as $government)
                                                    <option value="{{ $government->id }}"
                                                        {{ isset($data['department']) && $data['department']->government_id == $government->id ? 'selected' : '' }}>
                                                        {{ $government->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('government_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="complaint_type">Select Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1"
                                                    {{ isset($data['department']) && $data['department']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['department']) && $data['department']->status == 0 ? 'selected' : '' }}>
                                                    In-active</option>
                                            </select>
                                            @error('status')
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
                                            <label for="department_logo">Department Logo</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">

                                                </div>
                                                {{-- <div class="custom-file">
                                                    <input type="file" name="department_logo" multiple=""
                                                        class="custom-file-input" id="department_logo"
                                                        aria-describedby="inputGroupFileAddon01">

                                                    <label class="custom-file-label" for="department_logo">Choose
                                                        files</label>
                                                </div> --}}
                                                <div class="input-group mb-3 choseFileInputs">
                                                    <input type="file" class="form-control chooser" name="department_logo" id="department_logo">
                                                    <label class="input-group-text bg-danger text-white" for="department_logo">Browse</label>
                                                  </div>
                                            </div>
                                            {{-- <input name="atachments[]" type="file" placeholder="" class="form-control chooser" style="height: 38px" id="atachments" multiple=""> --}}
                                            @error('department_logo')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div id="department_logo_container"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="office_picture">Office Picture</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">

                                                </div>
                                                {{-- <div class="custom-file">
                                                    <input type="file" name="office_picture" multiple=""
                                                        class="custom-file-input" id="office_picture"
                                                        aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="office_picture">Choose
                                                        file</label>
                                                </div> --}}
                                                <div class="input-group mb-3 choseFileInputs">
                                                    <input type="file" class="form-control chooser" name="office_picture" id="office_picture">
                                                    <label class="input-group-text bg-danger text-white" for="office_picture">Browse</label>
                                                  </div>
                                            </div>
                                            @error('office_picture')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div id="office_picture_container"></div>
                                    </div>
                                    <div class="col-md-4 mt-4 text-right">
                                        <button type="submit" class="btn save-btn  ml-2">Submit</button>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">Departments List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Department Logo</th>
                                                <th>Office Picture</th>
                                                <th>Name</th>
                                                <th>Government</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['departments'] as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($type->user)->full_name }}</td>
                                                    <td>
                                                        @if ($type->logo_url)
                                                            <a href="{{ $type->logo_url }}" target="_blank">
                                                                <img src="{{ $type->logo_url }}" width="50"
                                                                    alt="logo_url">
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($type->office_picture_url)
                                                            <a href="{{ $type->office_picture_url }}" target="_blank">
                                                                <img src="{{ $type->office_picture_url }}" width="50"
                                                                    alt="office_picture_url">
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>{{ $type->name }}</td>
                                                    <td>{{ optional($type->government)->name ?: 'N/A' }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Department'))
                                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                                href="{{ route('departments.index', ['id' => $type->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Department'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('departments.delete', ['id' => $type->id]) }}"><i
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
        $(document).ready(function() {

            $('#department_logo').change(function() {
                renderFiles(this.files, 'department_logo_container')
            });

            $('#office_picture').change(function() {
                renderFiles(this.files, 'office_picture_container')
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
