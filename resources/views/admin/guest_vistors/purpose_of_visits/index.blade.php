@extends('layouts.app')
@section('purpose-visit-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Purpose of Visits</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">


            @if (Auth::user()->can('Add Purpose of Visit'))
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">
                                @if (isset($data['purposeOfVisit']))
                                    Update Purpose of Visits
                                @else
                                    Add New Purpose of Visits
                                @endif
                            </h5>

                            <form role="form" method="POST"
                                action="{{ isset($data['purposeOfVisit']) ? route('purpose-of-visits.update', ['id' => $data['purposeOfVisit']->id]) : route('purpose-of-visits.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only" for="purposeOfVisit">Purpose of Visit</label>
                                            <input type="text"
                                                value="{{ old('name', isset($data['purposeOfVisit']) ? $data['purposeOfVisit']->name : '') }}"
                                                class="form-control ml-2" name="name" id="complaint_type"
                                                placeholder="Enter purpose of visit">
                                            @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only" for="type">Select Type</label>
                                            <select name="type" id="type" class="form-control ml-2">
                                                <option value="">Please select Type</option>
                                                <option value="VISA"
                                                    {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->type == 'VISA' ? 'selected' : '' }}>
                                                    VISA</option>
                                                <option value="ATTESTATION"
                                                    {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->type == 'ATTESTATION' ? 'selected' : '' }}>
                                                    ATTESTATION</option>
                                            </select>
                                            @error('type')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only" for="complaint_type">Select Status</label>
                                            <select name="status" id="status" class="form-control ml-2">
                                                <option value="1"
                                                    {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->status == 0 ? 'selected' : '' }}>
                                                    In-active</option>
                                            </select>
                                            @error('status')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn save-btn text-dark ml-2">Submit</button>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">Purpose of Visits List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['purposeOfVisits'] as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($type->user)->full_name }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td>{{ $type->type }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Purpose of Visit'))
                                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                                href="{{ route('purpose-of-visits.index', ['id' => $type->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Purpose of Visit'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('purpose-of-visits.delete', ['id' => $type->id]) }}"><i
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
