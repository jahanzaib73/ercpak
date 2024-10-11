@extends('layouts.app')

@section('protocol-liaison-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a
                    href="{{ route('protocol-and-liaisons.index', ['module_name' => App\Models\ProtocolLiaison::PROJECT]) }}">Protocol
                    & Liaisons</a> / Protocol &
                Liaisons
                Attachments</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Attachment Listing</h5>
                            </div>
                            @if (Auth::user()->can('Add Complaint Attachment'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('project-attachments.create', ['id' => $project_id]) }}"
                                        class="btn save-btn mr-3 btn-sm">Upload Attachment</a>
                                </div>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Attachment</th>
                                                <th>File Name</th>
                                                <th>Uploaded By</th>
                                                <th>Date Time</th>
                                                <th>Notes</th>
                                                <th>Lat</th>
                                                <th>Lng</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($complaintAttachments as $attachment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="{{ $attachment->url }}" target="_blank">
                                                            <i class="fa fa-file" style="font-size: 40px"></i>
                                                        </a></td>
                                                    </td>
                                                    <td>{{ ucwords($attachment->file_name) }}</td>
                                                    <td>{{ optional($attachment->user)->full_name }}</td>
                                                    <td>{{ $attachment->created_at }}</td>
                                                    <td>{{ $attachment->notes }}</td>
                                                    <td>{{ $attachment->lat }}</td>
                                                    <td>{{ $attachment->lng }}</td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Complaint Attachment'))
                                                            <a class="btn bg-info btn-sm edit text-white"
                                                                href="{{ route('project-attachments.edit', ['id' => $attachment->id, 'project_id' => $project_id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Complaint Attachment'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('project-attachments.delete', ['id' => $attachment->id, 'project_id' => $project_id]) }}"><i
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
