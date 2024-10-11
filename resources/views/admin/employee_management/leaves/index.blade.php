@extends('layouts.app')
@section('leave-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Leaves</h4>
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
                        <h5 class="header-title pb-3">Leaves List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Reason</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Total Days</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leaves as $leave)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($leave->user)->full_name }}</td>
                                                    <td>{{ $leave->reason }}</td>
                                                    <td>{{ $leave->start_date }}</td>
                                                    <td>{{ $leave->end_date }}</td>
                                                    <td>{{ $leave->total_days }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $leave->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $leave->status == 1 ? 'Approved' : 'Pending' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Complaint Type') && $leave->status == 0)
                                                            <a class="btn bg-info btn-sm edit text-white"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('leaves.approve', ['id' => $leave->id]) }}">Approved</a>
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
