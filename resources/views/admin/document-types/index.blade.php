@extends('layouts.app')
@section('document-type-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">DOCUMENT TYPES</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">



            @if (Auth::user()->can('Add Document Type'))
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">
                                @if (isset($data['documentType']))
                                    Update Document Type
                                @else
                                    Add New Document Type
                                @endif
                            </h5>

                            <form role="form" method="POST"
                                action="{{ isset($data['documentType']) ? route('document-types.update', ['id' => $data['documentType']->id]) : route('document-types.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only" for="document_number">Document Number</label>
                                            <input type="text"
                                                value="{{ old('document_number', isset($data['documentType']) ? $data['documentType']->document_number : '') }}"
                                                class="form-control ml-2" name="document_number" id="document_number"
                                                placeholder="Enter document number Format 1/7/6">
                                            @error('document_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="sr-only" for="complaint_type">Document Type</label>
                                            <input type="text"
                                                value="{{ old('name', isset($data['documentType']) ? $data['documentType']->name : '') }}"
                                                class="form-control ml-2" name="name" id="complaint_type"
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
                                            <label class="sr-only" for="complaint_type">Select Status</label>
                                            <select name="status" id="status" class="form-control ml-2">
                                                <option value="1"
                                                    {{ isset($data['documentType']) && $data['documentType']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['documentType']) && $data['documentType']->status == 0 ? 'selected' : '' }}>
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
                        <h5 class="header-title pb-3">Document Types List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Document Number</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['documentTypes'] as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($type->user)->full_name }}</td>
                                                    <td>{{ $type->document_number }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Document Type'))
                                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                                href="{{ route('document-types.index', ['id' => $type->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (Auth::user()->can('Delete Document Type'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('document-types.delete', ['id' => $type->id]) }}"><i
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
