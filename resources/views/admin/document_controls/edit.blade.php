@extends('layouts.app')
@section('document-control-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Document Control</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post"
            action="{{ route('documents-control.update', ['documents_control' => $document->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="header-title">Update Document</h5>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- <label>Selected Location:</label> --}}
                                                <h5>{{ optional($document->location)->name }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- <label>Selected Type:</label> --}}
                                                <h5>{{ $document->document_type }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- <label>Selected Date</label> --}}
                                                <h5>{{ $document->date }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{-- <label>Selected Document Category</label> --}}
                                                <h5>{{ optional($document->documentTpye)->name }}</h5>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <h4 style="font-size: 20px">Allocated Document Number</h4>
                                                <div class="mb-3">{!! DNS1D::getBarcodeHTML("$document->document_number", 'C39') !!}</div>
                                                <h4 style="font-size: 20px">{{ $document->document_number }}</h4>
                                            </center>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="header-title">Decument Details</h5>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>Subject</label> --}}
                                        <input type="text" name="subject" class="form-control"
                                            value="{{ old('subject', $document->subject) }}" placeholder="subject" />
                                        @error('subject')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>To Department/Ministry</label> --}}
                                        <select name="department_id" id="department_id" class="form-control">
                                            <option value="0">To Department/Ministry</option>
                                            @foreach ($department as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $document->department_id == $department->id ? 'selected' : '' }}>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>Bin</label> --}}
                                        <input type="text" name="document_bin" class="form-control"
                                            value="{{ old('document_bin', $document->document_bin) }}"
                                            placeholder="document_bin" />
                                        @error('document_bin')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>Document Expiry</label> --}}
                                        <input type="date" name="date_expiary" class="form-control"
                                            value="{{ old('date_expiary', $document->date_expiary) }}"
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
                                <label>Body</label>
                                <textarea name="body" placeholder="Body" id="body" cols="30" rows="2" class="form-control">{{ old('body', $document->body) }}</textarea>
                                @error('body')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>

                            {{--  <div class="row">
                        <div class="col-md-6">
                            <h5 class="header-title">Attachments</h5>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-xl-6">
                            <label for=""  style="font-weight: bold; font-size: 17px">Letter Received</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
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
                            <label for=""  style="font-weight: bold; font-size: 17px">Issued by Consulte</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
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

                    </div>
                    <hr>  --}}

                            {{--  <div class="row">
                        <div class="col-xl-12">
                            <h4>Letter Received</h4>
                            <div class="row">
                                @foreach (getDocumentImage('letter_received', $document->id) as $letter_received)
                                    <div class="col-md-4">
                                        <a target="_blank" href="{{ $letter_received->url }}" style="font-size: 100px"><i class="mdi mdi-file-document"></i></a>
                                        <p style="margin-left: 27px">{{ $letter_received->original_name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-12">
                            <h4>Issued by Consulte</h4>
                            <div class="row">
                                @foreach (getDocumentImage('issued_by_consulte', $document->id) as $issued_by_consulte)
                                    <div class="col-md-4">
                                        <a target="_blank" href="{{ $issued_by_consulte->url }}" style="font-size: 100px"><i class="mdi mdi-file-document"></i></a>
                                        <p style="margin-left: 27px">{{ $issued_by_consulte->original_name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>  --}}


                            <div class="form-group d-flex justify-content-end mb-0">
                                <div>
                                    <button type="submit" class="btn save-btn">
                                        Update
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

                        {{--  if (fileType.startsWith('image/')) {
                fileElement.html('<img width="100" height="100" src="' + fileContent + '" alt="' + fileName + '">');
              } else if (fileType === 'application/pdf') {
                fileElement.html('<iframe width="100" height="100" src="' + fileContent + '" width="100%" height="200px"></iframe>');
              } else if (fileType === 'application/msword' || fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                fileElement.html('<iframe width="100" height="100" src="' + fileContent + '" width="100%" height="200px"></iframe>');
              } else {
                fileElement.html('<p>This file type is not supported.</p>');
              }  --}}

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

                        {{--  if (fileType.startsWith('image/')) {
                  fileElement.html('<img width="100" height="100" src="' + fileContent + '" alt="' + fileName + '">');
                } else if (fileType === 'application/pdf') {
                  fileElement.html('<iframe width="100" height="100" src="' + fileContent + '" width="100%" height="200px"></iframe>');
                } else if (fileType === 'application/msword' || fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                  fileElement.html('<iframe width="100" height="100" src="' + fileContent + '" width="100%" height="200px"></iframe>');
                } else {
                  fileElement.html('<p>This file type is not supported.</p>');
                }  --}}

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
