@extends('layouts.app')
@section('document-control-active-class', 'active')
@section('content')

<style>
    table td{
        padding: 0.75rem 0.5rem !important;
    }
</style>
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('documents-control.index') }}">Documents</a> / Documents Attachments</h4>
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
                            <div class="col-md-8">
                                <h5 class="header-title pb-3">Attachment Listing</h5>
                            </div>
                            <div class="col-md-4 d-flex justify-content-end">
                                <div>
                                @if (Auth::user()->can('View Document'))
                                                            <a class="btn save-btn btn-md" title="Show"
                                                                href="{{ route('documents-control.show', ['documents_control' => $document_id]) }}"><i class="fa-solid fa-arrow-rotate-left"></i>&nbsp;Back</a>
                                                        @endif
                                </div>
                                @if (Auth::user()->can('Add Document Control Attachment'))
                                <div class="col-md-6 mr-3 text-right">
                                    <a href="{{ route('document-control-attachments.create', ['id' => $document_id]) }}"
                                        class="btn save-btn btn-md">Upload Attachment</a>
                                </div>
                            @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Attachment</th>
                                                <th>Attachment Type</th>
                                                <th>Document #</th>
                                                <th>File Name</th>
                                                <th>Uploaded By</th>
                                                <th>Date Time</th>
                                                <th>Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documentAttachments as $attachment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="{{ $attachment->url }}" target="_blank">
                                                            <i class="fa fa-file" style="font-size: 40px"></i>
                                                        </a></td>
                                                    </td>
                                                    <td>{{ ucwords(str_replace('_', ' ', $attachment->certificate_name)) }}
                                                    </td>
                                                    <td>{{ $attachment->document_number }}</td>
                                                    <td>{{ ucwords($attachment->name) }}</td>
                                                    <td>{{ optional($attachment->user)->full_name }}</td>
                                                    <td>{{ $attachment->created_at }}</td>
                                                    <td>{{ $attachment->notes }}</td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Document Control Attachment'))
                                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                                href="{{ route('document-control-attachments.edit', ['id' => $attachment->id, 'document_id' => $document_id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Document Control Attachment'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('document-control-attachments.delete', ['id' => $attachment->id, 'document_id' => $document_id]) }}"><i
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
