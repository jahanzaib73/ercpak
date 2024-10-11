@extends('layouts.app')
@section('user-active-class', 'active')


@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">User Allowances</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">


            @if (Auth::user()->can('Add Country'))
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">

                                Add Allowance

                            </h5>

                            <form role="form" method="POST" action="{{ route('user-allowances.store') }}">
                                @csrf

                                <input type="hidden" name="allowance_owner_id" value="{{ $data['allowance_owner_id'] }}">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="sr-only" for="country">country</label>
                                            <select name="name" id="name" class="form-control">
                                                <option value="">Please Select</option>
                                                <option value="Food" {{ old('name') == 'Food' ? 'selected' : '' }}>Food
                                                </option>
                                                <option value="Medical" {{ old('name') == 'Medical' ? 'selected' : '' }}>
                                                    Medical
                                                </option>
                                                <option value="Transport"
                                                    {{ old('name') == 'Transport' ? 'selected' : '' }}>
                                                    Transport
                                                </option>
                                                <option value="Other" {{ old('name') == 'Other' ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                            @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="sr-only" for="amount">Select Status</label>
                                            <input type="number" name="amount" class="form-control"
                                                value="{{ old('amount') }}" placeholder="Enter amount" />
                                            @error('amount')
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
                        <h5 class="header-title pb-3">Countries List</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Name</th>
                                                <th>amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['allowances'] as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($type->user)->full_name }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td>{{ number_format($type->amount, 2) }}</td>
                                                    <td>

                                                        @if (Auth::user()->can('Delete Country'))
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('user-allowances.delete', ['id' => $type->id]) }}"><i
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
