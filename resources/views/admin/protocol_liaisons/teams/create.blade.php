@extends('layouts.app')
@section('protocol-liaison-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('protocol-liaison-teams.index', ['id' => $protocolLiaisonId]) }}">Members</a>
                / Create New Team Member</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('protocol-liaison-teams.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="protocolLiaisonId" value="{{ $protocolLiaisonId }}">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <div id="team_container">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Team Details</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Name</label> --}}
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="Name" />
                                            @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Designation</label> --}}
                                            <input type="text" name="Designation" class="form-control"
                                                value="{{ old('Designation') }}" placeholder="Designation" />
                                            @error('Designation')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                </div>


                                
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Photo</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <label for="" style="font-weight: bold; font-size: 17px">Select
                                            Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                {{--  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>  --}}
                                            </div>
                                            {{-- <div class="custom-file">
                                                <input type="file" name="team_memberphoto" class="custom-file-input"
                                                    id="team_memberphoto" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="team_memberphoto">Choose
                                                    file</label>
                                            </div> --}}

                                            <div class="input-group mb-3 choseFileInputs">
                                                <input type="file" class="form-control chooser" name="team_memberphoto" id="team_memberphoto">
                                                <label class="input-group-text bg-danger text-white" for="team_memberphoto">Browse</label>
                                                </div>
                                        </div>
                                        @error('team_memberphoto')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="team_memberphoto_fileContainer"></div>

                                <hr>
                            </div>

                            <div class="form-group mb-0 mt-1 d-flex justify-content-end">
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

            $('#team_memberphoto').change(function() {
                renderFiles(this.files, 'team_memberphoto_fileContainer')
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
