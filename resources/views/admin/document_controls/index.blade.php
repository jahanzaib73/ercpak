@extends('layouts.app')
@section('document-control-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Documents</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.document_controls/_partials/_pai_chart_document_control')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">
                            Filter Documents
                        </h5>

                        <form role="form" method="GET" action="{{ route('documents-control.index') }}">

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date"
                                            value="{{ app('request')->input('start_date', date('Y-m-d')) }}"
                                            class="form-control" name="start_date" id="start_date"
                                            placeholder="Enter document number ">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="end_date">End Date</label>
                                        <input type="date" value="{{ app('request')->input('end_date', date('Y-m-d')) }}"
                                            class="form-control" name="end_date" id="end_date"
                                            placeholder="Enter end_date ">
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top: 27px">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-3">
                                            <button type="submit" class="btn save-btn  ml-2">Filter</button>
                                        </div>
                                        <div class="col-md-4 col-sm-3">
                                            <a href="{{ route('documents-control.index') }}"
                                                class="btn save-btn  ml-3">Reset</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Documents Listing</h5>
                            </div>
                            @if (Auth::user()->can('Add Document'))
                                <!-- =========== Modal Form START========== -->

                                <div class="col-md-6 text-right">
                                    <a href="{{ route('documents-control.create') }}" class="btn save-btn mr-3 btn-md">Add Document</a>      
                                </div>
                                <!-- =========== Modal Form END========== -->
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Date</th>
                                                <th>Document No</th>
                                                <th>Category</th>
                                                <th>Location</th>
                                                <th>Subject</th>
                                                {{--  <th>Department/Ministry</th>  --}}
                                                <th class="text-center">Attachments</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $document)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($document->user)->full_name }}</td>
                                                    <td>{{ $document->date }}</td>
                                                    <td>{{ $document->document_number }}</td>
                                                    <td>{{ $document->document_type }}</td>
                                                    <td>{{ ucfirst(optional($document->location)->name) }}</td>
                                                    <td>{{ ucfirst($document->subject) }}</td>
                                                    {{--  <td>{{ ucfirst(optional($document->department)->name) }}</td>  --}}
                                                    <td class="text-center">
                                                        {{ count(getDocumentImage('letter_received', $document->id)) }} |
                                                        {{ count(getDocumentImage('issued_by_consulte', $document->id)) }}
                                                    </td>
                                                    <td><span
                                                            class="badge badge-{{ $document->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $document->status == 1 ? 'Closed' : 'Pending' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('View Document'))
                                                            <a class="btn save-btn btn-sm" title="Show"
                                                                href="{{ route('documents-control.show', ['documents_control' => $document->id]) }}"><i
                                                                    class="fa fa-eye"></i></a>
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

@section('script')
    <script>
        plotGroph('all_document_state_pai_chart', "{{ $all }}", "{{ $todayDocuments }}");
        plotGroph('external_state_pai_chart', "{{ $allExternal }}", "{{ $todayExternal }}");
        plotGroph('internal_state_pai_chart', "{{ $allInternal }}", "{{ $todayInternal }}");
    </script>
@endsection
