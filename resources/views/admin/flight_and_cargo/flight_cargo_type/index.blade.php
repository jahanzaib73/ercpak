@extends('layouts.app')
@section('flight_cargo_type-active-class', 'active')

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Flight Cargo Type</h4>
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
                        <h5 class="header-title pb-3">
                            @if (isset($data['flightCargoType']))
                                Update Flight & Cargo Type
                            @else
                                Add New Flight & Cargo Type
                            @endif
                        </h5>

                        <form role="form" method="POST"
                            action="{{ isset($data['flightCargoType']) ? route('flight-cargo-type.update', ['id' => $data['flightCargoType']->id]) : route('flight-cargo-type.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="sr-only" for="flight_cargo_type">Flight Cargo Type Name</label>
                                        <input type="text"
                                            value="{{ old('name', isset($data['flightCargoType']) ? $data['flightCargoType']->name : '') }}"
                                            class="form-control ml-2" name="name" id="flight_cargo_type"
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
                                                {{ isset($data['flightCargoType']) && $data['flightCargoType']->status == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0"
                                                {{ isset($data['flightCargoType']) && $data['flightCargoType']->status == 0 ? 'selected' : '' }}>
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
                                    <button type="submit" class="btn btn-success ml-2">Submit</button>

                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3">Flight And Cargo Type List</h5>
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
                                            @foreach ($data['flightCargoTypes'] as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($type->user)->full_name }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td>
                                                        <a class="btn bg-info btn-sm edit text-white"
                                                            href="{{ route('flight-cargo-type.index', ['id' => $type->id]) }}"><i
                                                                class="fa fa-edit"></i></a> |
                                                        <a class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')"
                                                            href="{{ route('flight-cargo-type.delete', ['id' => $type->id]) }}"><i
                                                                class="fa fa-trash-o"></i></a>
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
