@extends('layouts.app')
@section('government-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Governemt</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">



            <div class="col-lg-12 col-sm-12">
                @if (Auth::user()->can('Add Government'))
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">
                                @if (isset($data['government']))
                                    Update Government
                                @else
                                    Add New Government
                                @endif
                            </h5>

                            <form role="form" method="POST"
                                action="{{ isset($data['government']) ? route('government.update', ['id' => $data['government']->id]) : route('government.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only" for="name">Document Type</label>
                                            <input type="text"
                                                value="{{ old('name', isset($data['government']) ? $data['government']->name : '') }}"
                                                class="form-control ml-2" name="name" id="name"
                                                placeholder="Enter type">
                                            @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only" for="status">Select Status</label>
                                            <select name="status" id="status" class="form-control ml-2">
                                                <option value="1"
                                                    {{ isset($data['government']) && $data['government']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['government']) && $data['government']->status == 0 ? 'selected' : '' }}>
                                                    In-active</option>
                                            </select>
                                            @error('status')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn save-btn text-dark  ml-2">Submit</button>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">Document Types List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['governments'] as $government)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($government->user)->full_name }}</td>
                                                    <td>{{ $government->name }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $government->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $government->status == 1 ? 'Active' : 'In-active' }}</span>
                                                    </td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Government'))
                                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                                href="{{ route('government.index', ['id' => $government->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Government'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('government.delete', ['id' => $government->id]) }}"><i
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
