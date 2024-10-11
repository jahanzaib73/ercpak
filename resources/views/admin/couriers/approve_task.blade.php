@extends('layouts.app')
@section('task-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('tasks.index') }}">Tasks</a> / Approve Task</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                        <h5 class=" mt-5header-title pb-3">Task Detail</h5>

                        <div class="general-label">
                            <div class="form-group row">
                                <label for="date_applied" class="col-2 col-form-label">Date Applied</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" value="{{ $task->date }}" readonly
                                        id="date_applied">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="request_for" class="col-2 col-form-label">Request For</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="request_for"
                                        value="{{ ucfirst(optional($task->taskCategory)->name) }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="requested_by" class="col-2 col-form-label">Requested By</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="requested_by"
                                        value="{{ optional($task->taskOwner)->full_name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-2 col-form-label">Description</label>
                                <div class="col-10">
                                    <textarea class="form-control" readonly id="description" cols="30" rows="2">{{ $task->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class=" mt-5header-title pb-3">Assign Employee</h5>
                        <div class="form-group row">
                            <label for="description" class="col-8 col-form-label"><span style="font-weight: 900;">Assign
                                    Employee</span> - Assign multiple employee to
                                create a Team</label>
                            <div class="col-4">
                                <input type="text" class="form-control" readonly value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('tasks.approve') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <div class="form-group row">
                                <label for="employees" class="col-12 col-form-label">Select Employees</label>
                                <div class="col-12">
                                    <select name="employees[]" id="employees" class="form-control" multiple>

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="employees" class="col-5 col-form-label"></label>
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn save-btn text-dark">Approve</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
