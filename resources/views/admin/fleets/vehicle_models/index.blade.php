@extends('layouts.app')
@section('vehicle-model-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">
        <div class="d-flex justify-content-between topbar-header text-white p-2 px-3 mb-3" style="border-radius: 5px">
            <div class="py-0">
                <h3 class="mb-0 pt-1">List of Vehicle Models</h3>
            </div>

            @if (Auth::user()->can('Add Vehicle Model'))
            <button type="button" class="btn save-btn text-dark" data-toggle="modal"
                data-target="#exampleModal"> Add
                Vehicle Model </button>
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
                        <th scope="col">name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $model->name }}</td>

                            <td><span class="badge badge-{{ $model->status == 1 ? 'success' : 'danger' }}">
                                    {{ $model->status == 1 ? 'Active' : 'In-active' }}</span></td>
                            </td>
                            <td>
                                @if (Auth::user()->can('Edit Vehicle Model'))
                                <a data-id="{{ $model->id }}" href="javascript:void"
                                    class="btn bg-info btn-sm edit text-white_record"><i class="fa fa-edit text-white"></i></a>
                                |
                                @endif
                                @if (Auth::user()->can('Delete Vehicle Model'))
                                    <a href="{{ route('vehicle.models.delete', ['id' => $model->id]) }}"
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
        @include('admin.fleets.vehicle_models._models._add')

        <!-- Edit Modal -->
        @include('admin.fleets.vehicle_models._models._edit')

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $("#make-form").validate({
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
                        url: "{{ route('vehicle.models.store') }}",
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
                    url: "{{ route('vehicle.models.edit') }}",
                    data: {
                        'id': $(this).attr('data-id')
                    },
                    success: function(response) {
                        var model = response.model;
                        $('#editName').val(model.name)
                        $('#editStatus').val(model.status).trigger('change');
                        $('#makeid').val(model.id);
                        $('#editMake').modal('show');
                    }
                });
            });

            $("#make-form-update").validate({
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
                        url: "{{ route('vehicle.models.update') }}",
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
