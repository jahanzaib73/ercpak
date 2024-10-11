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
        @include('admin.complaints/_partials/_complaint_pai_chart_data')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Complaints Listing</h5>
                            </div>
                            @if (Auth::user()->can('Add Complaint'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('complaints.create') }}" class="btn save-btn btn-md mr-3">Generate New
                                        Complaint</a>
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
                                                <th>Created By</th>
                                                <th>Date</th>
                                                <th>Completed</th>
                                                <th>Complaint No</th>
                                                <th>Complaint Type</th>
                                                <th>Complaints Name</th>
                                                <th>Complaint Against</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($complaints as $complaint)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($complaint->user)->full_name }}</td>
                                                    <td>{{ $complaint->complaint_date }}</td>
                                                    <td>{{ $complaint->completed_date ?: 'N/A' }}</td>
                                                    <td>{{ $complaint->complaint_number }}</td>
                                                    <td>{{ ucfirst(optional($complaint->complaintType)->name) }}</td>
                                                    <td>
                                                        {{--  @dump($complaint->complaintName)  --}}
                                                        @if ($complaint->complaintName && $complaint->complaintName->official_name)
                                                            {{ $complaint->complaintName->official_name }}
                                                        @elseif ($complaint->complaintName && $complaint->complaintName->notable_name)
                                                            {{ $complaint->complaintName->notable_name }}
                                                        @else
                                                            {{ optional($complaint->complaintName)->full_name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ ucfirst($complaint->complaint_against) }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $complaint->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $complaint->status == 1 ? 'Completed' : 'Pending' }}</span>
                                                    </td>
                                                    <td>
                                                        @if (Auth::user()->can('View Complaint'))
                                                            <a class="btn save-btn btn-sm"
                                                                href="{{ route('complaints.show', ['complaint' => $complaint->id]) }}"><i
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
        plotGroph('all_state_complaint_pai_chart', "{{ $totalComplaints }}", "{{ $todayRecords }}");
        plotGroph('completed_state_pai_chart', "{{ $totalCompletedComplaints }}", "{{ $todayCompletedComplaints }}");
        plotGroph('pendding_state_pai_chart', "{{ $totalPendingComplaints }}", "{{ $todayPendingComplaints }}");
    </script>
@endsection
