@extends('layouts.app')
@section('complaint-active-class', 'active')
@section('content')
<div class="container">
    <div class="page-head">
        <h4 class="mt-2 mb-2">Complaints</h4>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="header-title py-3">Generate New Complaint</h5>
                        </div>

                        <div class="col-md-6 text-right">
                            <h5 class="header-title py-3">No. <span>{{ getComplaintNumber() }}</span></h5>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <form class="" method="post" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6><strong>Complaint Date</strong></h6>
                                            <input type="date" name="complaint_date" class="form-control" value="{{ old('complaint_date', date('Y-m-d')) }}" />
                                            @error('complaint_date')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <h6><strong>Complaints Name</strong></h6>
                                                <input type="text" name="complaint_name" class="form-control" value="{{ old('complaint_name') }}" placeholder="Complaints Name" style="width: 100%;"/>
                                    @error('complaint_name')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6><strong>Complaints Name</strong></h6>
                                <select name="complaint_person_id" id="complaint_person_id" class="form-control">
                                    <option value="">Please Select</option>
                                    @foreach ($complaintPersonsData as $person)
                                    <option {{ old('complaint_person_id') == $person['id'] ? 'selected' : '' }} value="{{ $person['id'] }}">{{ $person['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('complaint_person_id')
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
                                <h6><strong>Mobile</strong></h6>
                                <input type="number" name="mobile" min="0" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile" />
                                @error('mobile')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6><strong>Complaint Type</strong></h6>
                                <select name="complaint_type_id" id="complaint_type_id" class="form-control" style="width: 100%;">
                                    <option value="">Please Select</option>
                                    @foreach ($complaintTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('complaint_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('complaint_type_id')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>





                    <hr>
                    <div class="form-group">
                        <h6><strong>Complaint Respondent</strong></h6>
                        <input type="text" name="complaint_against" class="form-control" value="{{ old('complaint_against') }}" placeholder="Type Here" />
                        @error('complaint_against')
                        <span class="error">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <h6><strong>Specific Detail of Complaint</strong></h6>
                        <textarea name="complaint_detail" placeholder="Specific Detail of Complaint" id="complaint_detail" cols="30" rows="3" class="form-control">{{ old('complaint_against') }}</textarea>
                        @error('complaint_detail')
                        <span class="error">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- <div class="form-group">
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
                </div> --}}

                <div class="form-group d-flex justify-content-end mb-0">
                    <div>
                        <button type="submit" class="btn save-btn px-4 py-2">
                            Submit
                        </button>
                    </div>
                </div>
                <hr>
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

                    if (fileType.startsWith('image/')) {
                        fileElement.html('<i  class="mdi mdi-file-document"></i>');
                    } else if (fileType === 'application/pdf') {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    } else if (fileType === 'application/msword' || fileType ===
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        fileElement.html('<i class="mdi mdi-file-document"></i>');
                    } else {
                        fileElement.html('<i  class="mdi mdi-file-document"></i>');
                    }

                    container.append(fileElement);
                };

                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection