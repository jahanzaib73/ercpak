@extends('layouts.app')
{{--  @section('aircraft-type-active-class', 'active')  --}}

@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Permissions</h4>
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
                                Add Permission
                @endif
                </h5>

                <form role="form" method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="sr-only" for="aircraft">Permission</label>
                                <input type="text" value="{{ old('name') }}" class="form-control ml-2" name="name"
                                    id="aircraft" placeholder="Enter Permission">
                                @error('name')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="sr-only" for="aircraft">Module Name</label>
                                <input type="text" value="{{ old('moudle_name') }}" class="form-control ml-2"
                                    name="moudle_name" id="aircraft" placeholder="Enter Module Name">
                                @error('moudle_name')
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
                <h5 class="header-title pb-3">Aircraft List</h5>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Module Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $type)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $type->name }}</td>
                                            <td>{{ $type->module_name }}</td>
                                            <td>
                                                <a href="{{ route('permissions.delete', ['id' => $type->id]) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</a>
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
