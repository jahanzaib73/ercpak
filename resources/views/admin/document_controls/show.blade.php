@extends('layouts.app')
@section('document-control-active-class', 'active')
@section('content')

<style>
    .form-group{
        padding: 15px 15px;
    }
</style>
    <div class="container-fluid">
        <div class="page-head d-flex justify-content-between">
            <div>
                <h4 class="mt-2 mb-2">Document Control</h4>
            </div>

            <div>
                @if (Auth::user()->can('Edit Document'))
                    | <a class="btn save-btn bg-transparent btn-md" title="Edit"
                        href="{{ route('documents-control.edit', ['documents_control' => $document->id]) }}"><i
                            class="fa fa-edit"></i>&nbsp;Edit</a>
                @endif
                @if (Auth::user()->can('Delete Document'))
                    |
                    <a class="btn cancel-btn btn-md" title="Delete" onclick="return confirm('Are you sure?')"
                        href="{{ route('document-control.delete', ['id' => $document->id]) }}"><i
                            class="fa fa-trash-o"></i>&nbsp;Delete</a>
                @endif
                {{-- onclick="return confirm('Are you sure?')" href="{{ route('complaint.mark.closed', ['id' => $document->id]) }}" --}}
                @if (!$document->close_date && Auth::user()->can('Mark Close Document'))
                    | <a class="btn save-btn bg-transparent closeBtnInModal btn-md" data-toggle="modal" title="Mark as Close"
                        data-target="#markClose-{{ $document->id }}" title="Mark as Closed"><i
                            class="fa fa-window-close-o">&nbsp;Close</i></a>
                    <div class="modal fade" id="markClose-{{ $document->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {{-- <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Mark as Close</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> --}}
                                <div class="modal-header bottom-border p-1">
                                    <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Mark as Close</strong></h3>
                                    <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">�</span>
                                    </button>
                                </div>
                                <form action="{{ route('complaint.mark.closed', ['id' => $document->id]) }}" method="GET">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Comment</label>
                                            <textarea name="comment" id="comment" class="form-control" cols="30" rows="2" required></textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mb-3 mr-3">
                                        <button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal" aria-label="Close">Cancel</button>
                    
                                        <button type="submit" class="btn save-btn btns-w">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- <h5 class="header-title pb-3">Update Document</h5> -->
                            </div>
                        </div>
                        <hr>
                        <section class="header-z">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-5 d-flex">
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
                                        <div class="col-12 col-md-12 col-lg-7 d-flex">
                                            <div class="row">
                                                <div class="col-12 col-md-4 form-group border w-100">
                                                    <label>Selected Document Category</label>
                                                    <h5>{{ optional($document->documentTpye)->name }}</h5>
                                                </div>
                                                <div class="col-12 col-md-8 form-group border">
                                                    <center>
                                                        <h4 style="font-size: 20px">Allocated Document Numbers</h4>
                                                        <div class="mb-3">{!! DNS1D::getBarcodeHTML("$document->document_number", 'C39') !!}</div>
                                                        <!-- <div class="mb-3">{!! DNS2D::getBarcodeHTML("$document->document_number", 'QRCODE') !!}</div> -->
                                                        <h4 style="font-size: 20px">{{ $document->document_number }}</h4>
                                                    </center>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </section>

                        <hr>
                        <section class="doc-details">

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>To Department/Ministry</label>
                                        <h5>{{ optional($document->department)->name ?: 'N/A' }}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Document Expiary</label>
                                        <h5>{{ $document->date_expiary ?: 'N/A' }}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Bin</label>
                                        <h5>{{ $document->document_bin ?: 'N/A' }}</h5>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <h5>{{ $document->subject ?: 'N/A' }}</h5>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <br>
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-8">
                                        <div class="page-head">
                                            <h4>Body</h4>
                                        </div>
                                        <textarea name="body" placeholder="Body" id="body" readonly cols="30" rows="2" class="form-control">{{ old('body', $document->body) }}</textarea>
                                    </div>
                                    <div class="col-4">
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
                            <div class="page-head d-flex justify-content-between">
                                <div>
                                    <h4>Documents Attached</h4>
                                </div>
                                <div>

                                    @if (Auth::user()->can('Add Document Control Attachment'))
                                        <div class="col-md-6 text-right">
                                            <a href="{{ route('document-control-attachments.create', ['id' => $document->id]) }}"
                                                class="btn save-btn mr-3 btn-md">Upload Attachment</a>
                                        </div>
                                    @endif


                                </div>

                            </div>

                            <div>
                                <div class="row d-flex justify-content-center">

                                    <div class="col-12 col-md-5 border mr-2">
                                        <div>
                                            <h4>Letters Received</h4>
                                            <hr>
                                        </div>
                                        <div class="row d-flex">
                                            @foreach (getDocumentImage('letter_received', $document->id) as $letter_received)
                                                <div class="col-4 col-md-4 d-flex align-items-center">
                                                    <div class=" d-flex">
                                                        <a target="_blank" href="{{ $letter_received->url }}"
                                                            style="font-size: 100px"><i
                                                                class="mdi mdi-file-document"></i></a>
                                                    </div>

                                                </div>
                                                <div class="col-8 col-md-8">
                                                    <p class="my-0">Dcoumnet Number: <span
                                                            style="font-weight: bolder">{{ $letter_received->document_number }}</span>
                                                    </p>
                                                    <p class="my-0">Name: <span
                                                            style="font-weight: bolder">{{ $letter_received->name }}</span>
                                                    </p>
                                                    <p class="my-0">Upload By: <span
                                                            style="font-weight: bolder">{{ $letter_received->user->full_name }}</span>
                                                    </p>
                                                    <p class="my-0">Date Time: <span
                                                            style="font-weight: bolder">{{ $letter_received->created_at }}</span>
                                                    </p>
                                                    <p class="my-0  pb-3">Notes: <span
                                                            style="font-weight: bolder">{{ $letter_received->notes }}</span>
                                                    </p>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="vr" style="height: 20px;"></div>
                                    <div class="col-12 col-md-5 border ml-2">
                                        <div>
                                            <h4>Issued by Consulte</h4>
                                            <hr>
                                        </div>

                                        <div class="row d-flex">
                                            @foreach (getDocumentImage('issued_by_consulte', $document->id) as $issued_by_consulte)
                                                <div class="col-4 col-md-4 d-flex align-items-center">
                                                    <div class="d-flex">
                                                        <a target="_blank" href="{{ $issued_by_consulte->url }}"
                                                            style="font-size: 100px"><i
                                                                class="mdi mdi-file-document"></i></a>
                                                    </div>


                                                </div>
                                                <div>
                                                    <div>
                                                        <p class="my-0">Dcoumnet Number: <span
                                                                style="font-weight: bolder">{{ $issued_by_consulte->document_number }}</span>
                                                        </p>
                                                        <p class="my-0">Name: <span
                                                                style="font-weight: bolder">{{ $issued_by_consulte->name }}</span>
                                                        </p>
                                                        <p class="my-0">Upload By: <span
                                                                style="font-weight: bolder">{{ $issued_by_consulte->user->full_name }}</span>
                                                        </p>
                                                        <p class="my-0">Date Time: <span
                                                                style="font-weight: bolder">{{ $issued_by_consulte->created_at }}</span>
                                                        </p>
                                                        <p class="my-0">Notes: <span
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
    @endsection
