@extends('layouts.app')
@section('document-control-active-class', 'active')
@section('content')



    <div class="container d-flex justify-content-center">
        <div class="card w-50">
            <img src="https://technoadviser.com/wp-content/uploads/2020/07/Consultancy.gif" class="card-img-top"
                alt="...">
            <div class="card-body d-flex justify-content-end">
                <button type="button" class="btn save-btn px-3" data-toggle="modal" data-target=".bd-example-modal-lg">Add
                    Document</button>
            </div>
        </div>

    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="">
                    <div class="page-head pl-3 py-0">
                        <h3 class="mt-2 mb-2 text-center"><strong>Add New Document</strong></h3>
                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    </div>
                    <form class="" method="post" action="{{ route('documents-control.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row d-flex">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <h6><strong>Select location</strong></h6>
                                                    <div>
                                                        <select name="location_id" id="location_id" class="form-control"
                                                            style="width: 100%;">
                                                            <option value="">Select location</option>
                                                            @foreach ($locations as $location)
                                                                <option value="{{ $location->id }}"
                                                                    {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                                                    {{ $location->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @error('location_id')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="form-group row">
                                                     <h6 class="col-md-12 my-1 control-label"><strong>Choose the type</strong></h6> 
                                                    <div class="col-md-12 mt-1">
                                                        <div class="form-check-inline my-1">
                                                            <label class="cr-styled"
                                                                style="font-weight: bold; font-size: 12px"
                                                                for="example-radio4">
                                                                <input type="radio" id="example-radio4"
                                                                    name="document_type" value="External"
                                                                    {{ old('document_type') == 'External' ? 'checked' : '' }}>
                                                                <i class="fa"></i>
                                                                External
                                                            </label>
                                                        </div>
                                                        <div class="form-check-inline my-1">
                                                            <label class="cr-styled"
                                                                style="font-weight: bold; font-size: 12px"
                                                                for="example-radio5">
                                                                <input type="radio" id="example-radio5"
                                                                    name="document_type" value="Internal"
                                                                    {{ old('document_type') == 'Internal' ? 'checked' : '' }}>
                                                                <i class="fa"></i>
                                                                Internal
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @error('document_type')
                                                        <span class="error">
                                                            <strong style="margin-left: 17px">{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h6><strong>Date</strong></h6>
                                                            <input type="date" name="date" id="date"
                                                                class="form-control"
                                                                value="{{ old('date', date('Y-m-d')) }}" />
                                                            @error('date')
                                                                <span class="error">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h6><strong>Select Document Category</strong></h6>
                                                            <select name="document_category_id" id="document_category_id"
                                                                class="form-control" style="width: 100%;">
                                                                <option value="">Select Document Category</option>
                                                                @foreach ($documentCategory as $type)
                                                                    <option value="{{ $type->id }}"
                                                                        {{ old('document_category_id') == $type->id ? 'selected' : '' }}>
                                                                        {{ $type->name }} - {{ $type->document_number }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('document_category_id')
                                                                <span class="error">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p id="barcode"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">                               
                                            <h4 class="pb-2 text-center"><strong>Document Details</strong></h4>     
                                        </div>                                      
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h6><strong>Subject</strong></h6>
                                                    <input type="text" name="subject" class="form-control"
                                                        value="{{ old('subject') }}" placeholder="subject" />
                                                    @error('subject')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h6><strong>To Department/Ministry</strong></h6>
                                                    <select name="department_id" id="department_id" class="form-control"
                                                        style="width: 100%;">
                                                        <option value="0">To Department/Ministry</option>
                                                        @foreach ($department as $department)
                                                            <option value="{{ $department->id }}"
                                                                {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h6><strong>Bin</strong></h6>
                                                    <input type="text" name="document_bin" class="form-control"
                                                        value="{{ old('document_bin') }}" placeholder="document_bin" />
                                                    @error('document_bin')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h6><strong>Document Expiry</strong></h6>
                                                    <input type="date" name="date_expiary" class="form-control"
                                                        value="{{ old('date_expiary', date('Y-m-d')) }}"
                                                        placeholder="date_expiary" />
                                                    @error('date_expiary')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <h6><strong>Body</strong></h6>
                                            <textarea name="body" placeholder="Body" id="body" cols="30" rows="2" class="form-control">{{ old('body') }}</textarea>
                                            @error('body')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- <div class="row mt-5">
                        <div class="col-md-6">
                            <h5 class="header-title pb-3">Attachments</h5>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-xl-6">
                            <label for=""  style="font-weight: bold; font-size: 17px">Letter Received</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                </div>
                                <div class="custom-file">
                                  <input type="file" name="letter_received[]" multiple class="custom-file-input" id="letter_received" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="letter_received">Choose file</label>
                                </div>
                              </div>
                              @error('letter_received')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <div id="letter_received_fileContainer"></div>

                                </div>

                                <div class="col-xl-6">
                                    <label for="" style="font-weight: bold; font-size: 17px">Issued by Consulte</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="issued_by_consulte[]" multiple class="custom-file-input" id="issued_by_consulte" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="issued_by_consulte">Choose file</label>
                                        </div>
                                    </div>
                                    @error('issued_by_consulte')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <div id="issued_by_consulte_fileContainer"></div>
                                </div>

                            </div> --}}

                                        <div class="form-group mb-0 mt-2 d-flex justify-content-end">
                                            <div class="">
                                                <button type="submit"
                                                    class="btn save-btn ">
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
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#issued_by_consulte').change(function() {
                var files = this.files;
                var container = $('#issued_by_consulte_fileContainer');
                container.empty();

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var fileContent = e.target.result;
                        var fileType = file.type;
                        var fileName = file.name;

                        var fileElement = $('<div class="col-md-4 mb-4" style="font-size: 30px">');

                        {
                            {
                                --
                                if (fileType.startsWith('image/')) {
                                    fileElement.html('<img width="100" height="100" src="' +
                                        fileContent + '" alt="' + fileName + '">');
                                } else if (fileType === 'application/pdf') {
                                    fileElement.html('<iframe width="100" height="100" src="' +
                                        fileContent + '" width="100%" height="200px"></iframe>');
                                } else if (fileType === 'application/msword' || fileType ===
                                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                                ) {
                                    fileElement.html('<iframe width="100" height="100" src="' +
                                        fileContent + '" width="100%" height="200px"></iframe>');
                                } else {
                                    fileElement.html('<p>This file type is not supported.</p>');
                                }--
                            }
                        }

                        if (fileType.startsWith('image/')) {
                            fileElement.html('<i  class="mdi mdi-file-document"></i>');
                        } else if (fileType === 'application/pdf') {
                            fileElement.html('<i class="mdi mdi-file-document"></i>');
                        } else if (fileType === 'application/msword' || fileType ===
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                            fileElement.html('<i class="mdi mdi-file-document"></i>');
                        } else {
                            fileElement.html('<p>This file type is not supported.</p>');
                        }

                        container.append(fileElement);
                    };

                    reader.readAsDataURL(file);
                }
            });


            $('#letter_received').change(function() {
                var files = this.files;
                var container = $('#letter_received_fileContainer');
                container.empty();

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var fileContent = e.target.result;
                        var fileType = file.type;
                        var fileName = file.name;

                        var fileElement = $('<div class="col-md-4 mb-4"  style="font-size: 30px">');

                        {
                            {
                                --
                                if (fileType.startsWith('image/')) {
                                    fileElement.html('<img width="100" height="100" src="' +
                                        fileContent + '" alt="' + fileName + '">');
                                } else if (fileType === 'application/pdf') {
                                    fileElement.html('<iframe width="100" height="100" src="' +
                                        fileContent + '" width="100%" height="200px"></iframe>');
                                } else if (fileType === 'application/msword' || fileType ===
                                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                                ) {
                                    fileElement.html('<iframe width="100" height="100" src="' +
                                        fileContent + '" width="100%" height="200px"></iframe>');
                                } else {
                                    fileElement.html('<p>This file type is not supported.</p>');
                                }--
                            }
                        }

                        if (fileType.startsWith('image/')) {
                            fileElement.html('<i class="mdi mdi-file-document"></i>');
                        } else if (fileType === 'application/pdf') {
                            fileElement.html('<i class="mdi mdi-file-document"></i>');
                        } else if (fileType === 'application/msword' || fileType ===
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                            fileElement.html('<i class="mdi mdi-file-document"></i>');
                        } else {
                            fileElement.html('<p>This file type is not supported.</p>');
                        }

                        container.append(fileElement);
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
