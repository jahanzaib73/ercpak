@extends('layouts.app')
@section('task-active-class', 'active')
@section('content')
<style>
    .header-title{
        margin: 0 !important;
    }
</style>
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('tasks.index') }}">Tasks</a> / Task Detail</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
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
                        <div id="by_air_container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="header-title">Task Detail</h5>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Task Category</label>
                                        <h5>{{ optional($task->taskCategory)->name }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <h5>{{ $task->date }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <h5>{{ optional($task->department)->name }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <h5>{{ $task->description }}</h5>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div id="by_air_container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="header-title">Task Members</h5>
                                </div>
                                @if ($document)
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('document-control-attachments.index', ['id' => $document->id]) }}"
                                            class="btn save-btn"><strong>Attachment</strong></a>
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <table class="table table-responsive-lg table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        {{--  <th>Action</th>  --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($task->taskMembersIds as $team)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($team->user)->full_name }}</td>
                                            <td>{{ optional($team->user)->email }}</td>
                                            <td>{{ optional($team->user)->contact_number }}</td>
                                            {{--  <td>
                                                <a target="_blank" class="btn save-btn btn-sm"
                                                    href="{{ route('users.show', optional($team->user)->id) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>  --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($document)
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- <h5 class="header-title">Document Detail</h5> -->
                                </div>
                            </div>
                            <hr>
                            <section class="header-z">
                                        <div class="row ">
                                            <div class="col-12 col-md-5 col-lg-5 d-flex">
                                                <div class="col-4 form-group border">
                                                    <label>Location:</label>
                                                    <h5>{{ optional($document->location)->name }}</h5>
                                                </div>
                                                <div class="col-4 form-group border">
                                                    <label>Type:</label>
                                                    <h5>{{ $document->document_type }}</h5>
                                                </div>
                                                <div class="col-4 form-group border">
                                                    <label>Date</label>
                                                    <h5>{{ $document->date }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-7 col-lg-7 d-flex">
                                            <div class="row">
                                                <div class="col-12 col-md-6 form-group border">
                                                    <label>Selected Document Category</label>
                                                    <h5>{{ optional($document->documentTpye)->name }}</h5>
                                                </div>
                                                <div class="col-12 col-md-6 form-group border">
                                                    <center>
                                                        <h5>Allocated Document Number</h5>
                                                        <div class="mb-3">{!! DNS1D::getBarcodeHTML("$document->document_number", 'C39') !!}</div>
                                                        <!-- <div class="mb-3">{!! DNS2D::getBarcodeHTML("$document->document_number", 'QRCODE') !!}</div> -->
                                                        <h4 style="font-size: 20px">{{ $document->document_number }}</h4>
                                                    </center>
                                                </div>
                                            </div>
                                </div>
                                </div>
                            </section>

                            <hr>
                            <section class="doc-details">

                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>To Department/Ministry</label>
                                            <h5>{{ optional($document->department)->name ?: 'N/A' }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-group">
                                            <label>Document Expiary</label>
                                            <h5>{{ $document->date_expiary ?: 'N/A' }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-group">
                                            <label>Bin</label>
                                            <h5>{{ $document->document_bin ?: 'N/A' }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <h5>{{ $document->subject ?: 'N/A' }}</h5>
                                        </div>
                                    </div>

                                </div>
                        
                                <br>
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-12 col-md-8">
                                            <div class="page-head">
                                                <h4>Body</h4>
                                            </div>
                                            <textarea name="body" placeholder="Body" id="body" readonly cols="30" rows="2" class="form-control">{{ old('body', $document->body) }}</textarea>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="page-head">
                                                <h4>Comments</h4>
                                            </div>

                                            <textarea name="body" placeholder="Body" id="body" readonly cols="30" rows="2" class="form-control">{{ old('body', $document->comment) }}</textarea>
                                        </div>

                                    </div>
                                </div>


                            </section>

                            <!-- Attachments Section ================================-->

                            <section class="attachment-s">
                                <div class="page-head">
                                    <h4>Documents Attached</h4>
                                </div>

                                <div>
                                    <div class="row d-flex justify-content-center">

                                        <div class="col-5 border mr-2">
                                            <div>
                                                <h4>Letters Received</h4>
                                            </div>
                                            <div class="row d-block">
                                                @foreach (getDocumentImage('letter_received', $document->id) as $letter_received)
                                                    <div class="col-md-4 d-flex align-items-center">
                                                        <div class=" d-flex">
                                                            <a target="_blank" href="{{ $letter_received->url }}"
                                                                style="font-size: 100px"><i
                                                                    class="mdi mdi-file-document"></i></a>
                                                        </div>

                                                    </div>
                                                    <div>
                                                        <p>Dcoumnet Number: <span
                                                                style="font-weight: bolder">{{ $letter_received->document_number }}</span>
                                                        </p>
                                                        <p>Name: <span
                                                                style="font-weight: bolder">{{ $letter_received->name }}</span>
                                                        </p>
                                                        <p>Upload By: <span
                                                                style="font-weight: bolder">{{ $letter_received->user->full_name }}</span>
                                                        </p>
                                                        <p>Date Time: <span
                                                                style="font-weight: bolder">{{ $letter_received->created_at }}</span>
                                                        </p>
                                                        <p>Notes: <span
                                                                style="font-weight: bolder">{{ $letter_received->notes }}</span>
                                                        </p>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="vr" style="height: 20px;"></div>
                                        <div class="col-5 border ml-2">
                                            <div>
                                                <h4>Issued by Consulte</h4>
                                            </div>

                                            <div class="row">
                                                @foreach (getDocumentImage('issued_by_consulte', $document->id) as $issued_by_consulte)
                                                    <div class="col-md-12">
                                                        <a target="_blank" href="{{ $issued_by_consulte->url }}"
                                                            style="font-size: 100px"><i
                                                                class="mdi mdi-file-document"></i></a>

                                                    </div>
                                                    <div>
                                                        <div>
                                                            <p>Dcoumnet Number: <span
                                                                    style="font-weight: bolder">{{ $issued_by_consulte->document_number }}</span>
                                                            </p>
                                                            <p>Name: <span
                                                                    style="font-weight: bolder">{{ $issued_by_consulte->name }}</span>
                                                            </p>
                                                            <p>Upload By: <span
                                                                    style="font-weight: bolder">{{ $issued_by_consulte->user->full_name }}</span>
                                                            </p>
                                                            <p>Date Time: <span
                                                                    style="font-weight: bolder">{{ $issued_by_consulte->created_at }}</span>
                                                            </p>
                                                            <p>Notes: <span
                                                                    style="font-weight: bolder">{{ $issued_by_consulte->notes }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>

                        </div>

                    </div>

                </div>

            </div>
        @endif
    </div>
@endsection
