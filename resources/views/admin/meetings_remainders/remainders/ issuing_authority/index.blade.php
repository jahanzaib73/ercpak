@extends('layouts.app')
@section('issuing-authority-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Issuing Authority</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">



            <div class="col-lg-12 col-sm-12">
                @if (Auth::user()->can('Add Issuing Authority'))
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">
                                @if (isset($data['issuingAuthorit']))
                                    Update Authority
                                @else
                                    Add New Authority
                                @endif
                            </h5>

                            <form role="form" method="POST" enctype="multipart/form-data"
                                action="{{ isset($data['issuingAuthorit']) ? route('issuing-authorities.update', ['id' => $data['issuingAuthorit']->id]) : route('issuing-authorities.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name_of_issuing_authorities">Name</label>
                                            <input type="text"
                                                value="{{ old('name_of_issuing_authorities', isset($data['issuingAuthorit']) ? $data['issuingAuthorit']->name_of_issuing_authorities : '') }}"
                                                class="form-control" name="name_of_issuing_authorities"
                                                id="name_of_issuing_authorities" placeholder="Enter name">
                                            @error('name_of_issuing_authorities')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="contact_person_name">Name of Contact Person</label>
                                            <input type="text"
                                                value="{{ old('contact_person_name', isset($data['issuingAuthorit']) ? $data['issuingAuthorit']->contact_person_name : '') }}"
                                                class="form-control" name="contact_person_name" id="contact_person_name"
                                                placeholder="Enter Name of Contact Person">
                                            @error('contact_person_name')
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
                                                    {{ isset($data['issuingAuthorit']) && $data['issuingAuthorit']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['issuingAuthorit']) && $data['issuingAuthorit']->status == 0 ? 'selected' : '' }}>
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
                                            <label for="contact_person_number">Contact Person Number</label>
                                            <input type="text"
                                                value="{{ old('contact_person_number', isset($data['issuingAuthorit']) ? $data['issuingAuthorit']->contact_person_number : '') }}"
                                                class="form-control" name="contact_person_number" id="contact_person_number"
                                                placeholder="Enter Contact Person Number">
                                            @error('contact_person_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">

                                                </div>
                                                {{-- <div class="custom-file">
                                                    <input type="file" name="logo" multiple=""
                                                        class="custom-file-input" id="logo"
                                                        aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="logo">Choose
                                                        file</label>
                                                </div> --}}
                                                <div class="input-group mb-3 choseFileInputs">
                                                    <input type="file" class="form-control chooser" name="logo" id="logo">
                                                    <label class="input-group-text bg-danger text-white" for="logo">Browse</label>
                                                    </div>
                                            </div>
                                            @error('logo')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div id="logo_container"></div>
                                    </div>
                                    <div class="col-md-4 mt-4 text-right">
                                        <button type="submit" class="btn save-btn text-dark ml-2">Submit</button>

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
                        <h5 class="header-title pb-3">Issuing Authority List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Logo</th>
                                                <th>Issuing Authority Name</th>
                                                <th>Contact Person Name</th>
                                                <th>Contact Person Number</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['issuingAuthorits'] as $type)
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
                                                    <td>{{ $type->name_of_issuing_authorities }}</td>
                                                    <td>{{ $type->contact_person_name }}</td>
                                                    <td>{{ $type->contact_person_number }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Issuing Authority'))
                                                            <a class="btn bg-info text-light btn-sm"
                                                                href="{{ route('issuing-authorities.index', ['id' => $type->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Issuing Authority'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('issuing-authorities.delete', ['id' => $type->id]) }}"><i
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

            $('#logo').change(function() {
                renderFiles(this.files, 'logo_container')
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
