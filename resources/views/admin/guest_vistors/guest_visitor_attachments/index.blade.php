@extends('layouts.app')

@section('guest-vistor-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a
                    href="{{ route('guest-and-visitors.index', ['module_name' => App\Models\GuestVistor::GUEST]) }}">Guest &
                    Visitors</a> / Attachment List
            </h4>
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
                                <h5 class="header-title pb-3">Attachments Listing</h5>
                            </div>
                            @if (Auth::user()->can('Add Guest & Visitor Attachment'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('guest-visitor-attachment.create', ['id' => $guestVisitId]) }}"
                                        class="btn bg-info btn-sm edit text-white">Add</a>
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
                                                <th>Attachment Job#</th>
                                                <th>Expiary Date</th>
                                                <th>File Name</th>
                                                <th>Created By</th>
                                                <th>Guest/Visitor Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($guestVisitorAttachments as $attachment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><a href="{{ $attachment->file_url }}" target="_blank">
                                                            <i class="fa fa-file" style="font-size: 40px"></i>
                                                        </a>
                                                    </td>

                                                    <td>{{ $attachment->id }}</td>
                                                    <td>{{ $attachment->expiary_date }}</td>
                                                    <td>{{ ucwords($attachment->file_name) }}</td>
                                                    <td>{{ optional($attachment->user)->full_name }}</td>
                                                    <td>{{ $attachment->guest_visitor_id }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $attachment->status == 1 ? 'success' : 'info' }}">
                                                            {{ $attachment->status == 1 ? 'Closed' : 'Inprogress' }}</span>
                                                    </td>

                                                    <td>
                                                        @if (Auth::user()->can('Edit Guest & Visitor Attachment'))
                                                            <a class="btn bg-info btn-sm edit text-white"
                                                                href="{{ route('guest-visitor-attachment.edit', ['id' => $attachment->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Guest & Visitor Attachment'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('guest-visitor-attachment.delete', ['id' => $attachment->id]) }}"><i
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
