@extends('layouts.app')
@section('complaint-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Complaints</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Update Complaint</h5>
                            </div>

                            <div class="col-md-6 text-right">
                                <h5 class="header-title pb-3">No. <span>{{ $complaint->complaint_number }}</span></h5>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <form class="" method="post"
                                    action="{{ route('complaints.update', ['complaint' => $complaint->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="form-group col-3">
                                            {{-- <label>Complaint Date</label> --}}
                                            <input type="date" name="complaint_date" class="form-control"
                                                value="{{ old('complaint_date', $complaint->complaint_date) }}" />
                                            @error('complaint_date')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
    
                                        </div>
    
                                        {{--  <div class="form-group">
                                            <label>Complaints Name</label>
                                            <input type="text" name="complaint_name" class="form-control"
                                                value="{{ old('complaint_name', $complaint->complaint_name) }}"
                                                placeholder="Complaints Name" />
                                            @error('complaint_name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>  --}}
                                        {{--  <div class="col-md-6">  --}}
    
                                        <div class="form-group col-3">
                                            {{-- <label>Complaints Name</label> --}}
                                            <select name="complaint_person_id" id="complaint_person_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($complaintPersonsData as $person)
                                                    <option
                                                        {{ $complaint->complaint_person_type == $person['type'] && $complaint->complaint_person_id == $person['type_id'] ? 'selected' : '' }}
                                                        value="{{ $person['id'] }}">{{ $person['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('complaint_person_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{--  </div>  --}}
    
                                        <div class="form-group col-3">
                                            {{-- <label>Mobile</label> --}}
                                            <input type="number" name="mobile" min="0" class="form-control"
                                                value="{{ old('mobile', $complaint->mobile) }}" placeholder="Mobile" />
                                            @error('mobile')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-3">
                                            {{-- <label>Complaint Type</label> --}}
                                            <select name="complaint_type_id" id="complaint_type_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($complaintTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                        {{ old('complaint_type_id', $complaint->complaint_type_id) == $type->id ? 'selected' : '' }}>
                                                        {{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('complaint_type_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                    <hr>
                                    <div class="form-group">
                                        <label>Name of the Company/Person against which/whome the complaint is filed</label>
                                        <input type="text" name="complaint_against" class="form-control"
                                            value="{{ old('complaint_against', $complaint->complaint_against) }}"
                                            placeholder="Type Here" />
                                        @error('complaint_against')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Specific Detail of Complaint</label>
                                        <textarea name="complaint_detail" placeholder="Specific Detail of Complaint" id="complaint_detail" cols="30"
                                            rows="2" class="form-control">{{ old('complaint_detail', $complaint->complaint_detail) }}</textarea>
                                        @error('complaint_detail')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    {{--  <div class="form-group">
                                        <label for="" style="font-weight: bold; font-size: 17px">Attachments</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="Complaint_files[]" multiple
                                                    class="custom-file-input" id="files"
                                                    aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="files">Choose file</label>
                                            </div>
                                        </div>
                                        @error('files')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div id="files_Container"></div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h4>Attachments</h4>
                                                <div class="row">
                                                    @foreach (getDocumentImage('complaint_document', $complaint->id) as $complaint_document)
                                                        <div class="col-md-4">
                                                            <a target="_blank" href="{{ $complaint_document->url }}"
                                                                style="font-size: 100px"><i
                                                                    class="mdi mdi-file-document"></i></a>
                                                            <p style="margin-left: 27px">
                                                                {{ $complaint_document->original_name }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>  --}}
                                    <div class="form-group mb-0 d-flex justify-content-end">
                                        <div>
                                            <button type="submit" class="btn save-btn ">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
            $('#files').change(function() {
                var files = this.files;
                var container = $('#files_Container');
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
        });
    </script>
@endsection
