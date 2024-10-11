@extends('layouts.app')
@section('task-active-class', 'active')
@section('content')
    <div class="container">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('tasks.index') }}">Tasks</a> / Update Task</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div id="by_air_container">
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Task Detail</h5>
                                    </div>
                                </div>
                                <hr>
                                @if ($task->status != App\Models\Task::CANCELED)
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="cr-styled">
                                                    <input type="checkbox" name="status">
                                                    <i class="fa"></i>
                                                    Mark as Completed
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                @endif
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Chose Category</label> --}}
                                            <select name="task_category_id" id="task_category_id" class="form-control">
                                                <option value="">Chose Category</option>
                                                @foreach ($taskCategories as $category)
                                                    <option {{ $task->task_category_id == $category->id ? 'selected' : '' }}
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
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Date</label> --}}
                                            <input type="date" name="date" class="form-control"
                                                value="{{ $task->date }}" placeholder="date" />
                                            @error('date')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Select Department</label> --}}
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option {{ $task->department_id == $department->id ? 'selected' : '' }}
                                                        value="{{ $department->id }}">{{ $department->name }}</option>
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

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" placeholder="Description" id="description" cols="30" rows="2"
                                        class="form-control">{{ $task->description }}</textarea>
                                    @error('description')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group mb-0 mt-1 d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn save-btn">
                                            Save
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
