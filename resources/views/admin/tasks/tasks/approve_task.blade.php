@extends('layouts.app')
@section('task-active-class', 'active')
@section('content')
    <div class="container">
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

                        <h5 class=" mt-5header-title pb-3"><strong>Task Detail</strong></h5>

                        <div class="general-label">
                            <div class="form-group row">
                                <label for="date_applied" class="col-12 col-md-4 col-lg-4 col-form-label"><strong>Date Applied</strong></label>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" value="{{ $task->date }}" readonly
                                        id="date_applied">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="request_for" class="col-12 col-md-4 col-lg-4 col-form-label"><strong>Request For</strong></label>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input class="form-control" type="text" id="request_for"
                                        value="{{ ucfirst(optional($task->taskCategory)->name) }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="requested_by" class="col-12 col-md-4 col-lg-4 col-form-label"><strong>Requested By</strong></label>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <input class="form-control" type="text" id="requested_by"
                                        value="{{ optional($task->taskOwner)->full_name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-12 col-md-4 col-lg-4 col-form-label"><strong>Description</strong></label>
                                <div class="col-12 col-md-8 col-lg-8">
                                    <textarea class="form-control" readonly id="description" rows="2">{{ $task->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class=" mt-5header-title pb-3"><strong>Assign Employee</strong></h5>
                        <div class="form-group row">
                            <label for="description" class="col-12 col-md-8 col-lg-8 col-form-label"><span style="font-weight: 900;">Assign
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
                                <label for="employees" class="col-12 col-md-7 col-lg-8 col-form-label"><strong>Select Employees</strong></label>
                                <div class="col-12">
                                    <select name="employees[]" id="employees" class="form-control" multiple>

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="employees" class="col-7 col-form-label"></label>
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
