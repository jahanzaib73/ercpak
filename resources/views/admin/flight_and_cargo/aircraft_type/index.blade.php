@extends('layouts.app')
@section('aircraft-type-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Aircraft Type</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">



            <div class="col-lg-12 col-sm-12">
                @if (Auth::user()->can('Add Aircraft Type'))
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">
                                @if (isset($data['airCraftType']))
                                    Update Aircraft Type
                                @else
                                    Add New Aircraft Type
                                @endif
                            </h5>

                            <form role="form" method="POST"
                                action="{{ isset($data['airCraftType']) ? route('aircraft-type.update', ['id' => $data['airCraftType']->id]) : route('aircraft-type.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="sr-only" for="aircraft">Aircraft Type</label>
                                            <input type="text"
                                                value="{{ old('name', isset($data['airCraftType']) ? $data['airCraftType']->name : '') }}"
                                                class="form-control ml-2" name="name" id="aircraft"
                                                placeholder="Enter name">
                                            @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="sr-only" for="complaint_type">Select Status</label>
                                            <select name="status" id="status" class="form-control ml-2">
                                                <option value="1"
                                                    {{ isset($data['airCraftType']) && $data['airCraftType']->status == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ isset($data['airCraftType']) && $data['airCraftType']->status == 0 ? 'selected' : '' }}>
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
                        <h5 class="header-title pb-3">Aircraft List</h5>
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
                                            @foreach ($data['airCraftTypes'] as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($type->user)->full_name }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td>
                                                        @if (Auth::user()->can('Edit Aircraft Type'))
                                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                                href="{{ route('aircraft-type.index', ['id' => $type->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                            @endif @if (Auth::user()->can('Delete Aircraft Type'))
                                                                |
                                                                <a class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure?')"
                                                                    href="{{ route('aircraft-type.delete', ['id' => $type->id]) }}"><i
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
