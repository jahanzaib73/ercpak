@extends('layouts.app')
@section('task-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('tasks.index') }}">Tasks</a> / Create Task</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <form class="" method="post" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div id="by_air_container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="header-title">Task Detail</h5>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Chose Category</label>
                                                    <select name="task_category_id" id="task_category_id"
                                                        class="form-control">
                                                        <option value="">Please Select</option>
                                                        @foreach ($taskCategories as $category)
                                                            <option
                                                                {{ old('task_category_id') == $category->id ? 'selected' : '' }}
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('task_category_id')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <input type="date" name="date" class="form-control"
                                                        value="{{ old('date', date('Y-m-d')) }}" placeholder="date" />
                                                    @error('date')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Select Department</label>
                                                    <select name="department_id" id="department_id" class="form-control">
                                                        <option value="">Select Department</option>
                                                        @foreach ($departments as $department)
                                                            <option
                                                                {{ old('department_id') == $department->id ? 'selected' : '' }}
                                                                value="{{ $department->id }}">{{ $department->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('department_id')
                                                        <span class="error">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group col-12 px-0 ">
                                        <label>Description</label>
                                        <textarea name="description" placeholder="Description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <div class="form-group mb-0">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn save-btn px-3">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
