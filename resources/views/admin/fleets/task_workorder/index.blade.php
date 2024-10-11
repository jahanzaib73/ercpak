@extends('layouts.app')
@section('task-workorder-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">
        <div class="d-flex justify-content-between topbar-header  text-white p-2 mb-3" style="border-radius: 5px">
            <div class="py-0 pl-3">
                <h3 class="mb-0 pt-1">List of Tasks</h3>
            </div>

            @if (Auth::user()->can('Add Task Workorders'))
            <button type="button"  class="btn save-btn mr-2" data-toggle="modal"
                data-target="#exampleModal"> Add Task</button>
            @endif
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $type->title }}</td>

                            <td><span class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                    {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                            </td>
                            <td>
                                @if (Auth::user()->can('Edit Task Workorders'))

                                <a data-id="{{ $type->id }}" href="javascript:void"
                                    class="btn bg-info btn-sm edit text-white_record text-white"><i class="fa fa-edit"></i></a>
                                |
                                @endif
                                @if (Auth::user()->can('Delete Task Workorders'))
                                    <a href="{{ route('task-workorders.delete', ['id' => $type->id]) }}"
                                        onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm"><i
                                            class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <!-- Add Modal -->
        @include('admin.fleets.task_workorder._models._add')

        <!-- Edit Modal -->
        @include('admin.fleets.task_workorder._models._edit')

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $("#checklist-form").validate({
                rules: {
                    name: "required",
                    status: "required",
                },
                messages: {
                    name: "Please enter your name",
                    status: "Please select status",
                },
                submitHandler: function(form) {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('task-workorders.store') }}",
                        data: $(form).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload();
                            }
                        },
                        error: function(error) {

                        }
                    });

                }
            });

            $('.edit_record').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "{{ route('task-workorders.edit') }}",
                    data: {
                        'id': $(this).attr('data-id')
                    },
                    success: function(response) {
                        var type = response.type;
                        $('#editName').val(type.title)
                        $('#editStatus').val(type.status).trigger('change');
                        $('#makeid').val(type.id);
                        $('#editMake').modal('show');
                    }
                });
            });

            $("#checklist-form-update").validate({
                rules: {
                    editName: "required",
                    editStatus: "required",
                },
                messages: {
                    editName: "Please enter your name",
                    editStatus: "Please select status",
                },
                submitHandler: function(form) {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('task-workorders.update') }}",
                        data: $(form).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload();
                            }
                        },
                        error: function(error) {

                        }
                    });

                }
            });

        });
    </script>
@endsection
