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
                            <h5 class="header-title pb-3">Detail Of Complaint</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            @if (Auth::user()->can('Edit Complaint'))
                            | <a class="btn save-btn btn-md pt-2" href="{{ route('complaints.edit', ['complaint' => $complaint->id]) }}"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                            @endif
                            @if (Auth::user()->can('Delete Complaint'))
                            |
                            <a class="btn save-btn btn-md pt-2" onclick="return confirm('Are you sure?')" href="{{ route('complaint.delete', ['id' => $complaint->id]) }}"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>
                            @endif
                            @if (!$complaint->completed_date && Auth::user()->can('Mark Complete Complaint'))
                            | <a class="btn save-btn btn-md pt-2" onclick="return confirm('Are you sure?')" href="{{ route('complaint.mark.completed', ['id' => $complaint->id]) }}" title="Mark As Complete"><i class="fa fa-check-square"></i>&nbsp;Complete?</a>
                            @endif

                            </div>
                        </div>
                        <hr>
                        <section class="">
                            <div class="row">
                                <div class="col-12 col-md-8">

                                    <div class="row py-4 ml-2 mb-3 border">
                                        <div class="col-6 col-md-6">
                                            <label>Complainant’s Name</label>
                                            <h5>
                                                @if ($complaint->complaintName && $complaint->complaintName->official_name)
                                                    {{ optional($complaint->complaintName)->official_name }}
                                                @elseif ($complaint->complaintName && $complaint->complaintName->notable_name)
                                                    {{ optional($complaint->complaintName)->notable_name }}
                                                @else
                                                    {{ optional($complaint->complaintName)->full_name }}
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <label>Mobile</label>
                                            <h5>{{ $complaint->mobile }}</h5>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="row">

                                        <div class="col-5 text-left">
                                            <label>Complaint No.</label>

                                            <h5>{{ $complaint->complaint_number }}</h5>
                                        </div>
                                        <div class="col-7">
                                            <label>Complaint Date</label>
                                            <h5>{{ $complaint->complaint_date }}</h5>
                                        </div>

                                    </div>
                                    <hr>

                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12 col-md-4">
                                    <div class="row d-block">

                                    <div class="col">
                                        <label class="mb-0 pl-2">Complaint Type</label>
                                        <p class="pl-2 py-2 mt-0 bg-danger text-white font-weight-bold">
                                            {{ optional($complaint->complaintType)->name }}
                                        </p>
                                    </div>
                                    <div class="col">
                                        <label class="pl-2 mb-0">Company or Individual to Contact</label>
                                        <p class="pl-2 py-2 mt-0 bg-danger text-white font-weight-bold">
                                            {{ $complaint->complaint_against }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                                <div class="col-12 col-md-7">
                                    <div class="form-group">
                                        <label class="mb-0 pl-2">Specific Detail of Complaint</label>
                                        <div class="border">

                                        <textarea cols="30" rows="2" readonly class="form-control bg-white font-weight-light border-0">{{ old('complaint_detail', $complaint->complaint_detail) }}</textarea>
                                    </div>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">


                                    <hr>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-6 ">
                                                <h4>Attachments</h4>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                @if (Auth::user()->can('All Complaint Attachment'))
                                                <a class="btn save-btn btn-md" title="Complaint Attachments" href="{{ route('complaint-attachments.create', ['id' => $complaint->id]) }}"><i class="fa fa-file"></i>&nbsp;Attach</a>
                                                @endif
                                            </div>

                                            </div>
                                            <hr>
                                            <div class="row d-flex">
                                                @foreach (getComplaintAttachments($complaint->id) as $complaint_document)
                                                    <div class="col-4 col-md-4">
                                                        <a target="_blank" href="{{ $complaint_document->url }}"
                                                            style="font-size: 100px"><i
                                                                class="mdi mdi-file-document"></i></a>

                                                    </div>
                                                    <div class="col-8 col-md-8">
                                                        <p class="my-0">Dcoumnet Number: <span
                                                                style="font-weight: bolder">{{ $complaint_document->complaint_number }}</span>
                                                        </p>
                                                        <p class="my-0">Name: <span
                                                                style="font-weight: bolder">{{ $complaint_document->name }}</span>
                                                        </p>
                                                        <p class="my-0">Upload By: <span
                                                                style="font-weight: bolder">{{ $complaint_document->user->full_name }}</span>
                                                        </p>
                                                        <p class="my-0">Date Time: <span
                                                                style="font-weight: bolder">{{ $complaint_document->created_at }}</span>
                                                        </p>
                                                        <p class="my-0 pb-4">Notes: <span
                                                                style="font-weight: bolder">{{ $complaint_document->notes }}</span>
                                                        </p>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
