@extends('layouts.app')
@section('guest-vistor-active-class', 'active')
@section('content')
<div class="container">
    <div class="page-head">
        <h4 class="mt-2 mb-2">Add Guest & Customers (Bulk Upload)</h4>
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('guest-visitors.bulk-upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <a href="{{ route('guest-visitors.download-sample') }}" class="btn btn-info mb-2">Download Sample CSV</a>
                </div>

                <div class="form-group">
                    <label for="file">Upload Filled CSV File</label>
                    <input type="file" name="file" class="form-control">
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

