@extends('layouts.app')
@section('vehicle-make-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">
        <div class="d-flex align-items-center justify-content-between topbar-header text-white p-2 px-3 mb-3" style="border-radius: 5px">
            <div class="py-0 ">
                <h3 class="mb-0">List of Vehicle Makes</h3>
            </div>

            
            @if (Auth::user()->can('Add Vehicle Make'))
            <button type="button" class="btn text-dark save-btn" data-toggle="modal"
                data-target="#exampleModal"> Add Vehicle Make </button>
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
                    @foreach ($makes as $make)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $make->name }}</td>

                            <td><span class="badge badge-{{ $make->status == 1 ? 'success' : 'danger' }}">
                                    {{ $make->status == 1 ? 'Active' : 'In-active' }}</span></td>
                            </td>
                            <td>
                            @if (Auth::user()->can('Edit Vehicle Make'))
                                <a data-id="{{ $make->id }}" href="javascript:void"
                                    class="btn bg-info btn-sm edit text-white_record"><i class="fa fa-edit text-white"></i></a>
                                |
                            @endif
                            @if (Auth::user()->can('Delete Vehicle Make'))
                                <a href="{{ route('vehicle.make.delete', ['id' => $make->id]) }}"
                                    onclick="return confirm('Are you sure?');" class="btn bg-danger btn-sm"><i
                                        class="fa fa-trash text-white"></i></a>
                            @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <!-- Add Modal -->
        @include('admin.fleets.vehicle_makes._models._add')

        <!-- Edit Modal -->
        @include('admin.fleets.vehicle_makes._models._edit')

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
                        url: "{{ route('vehicle.make.store') }}",
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
                    url: "{{ route('vehicle.make.edit') }}",
                    data: {
                        'id': $(this).attr('data-id')
                    },
                    success: function(response) {
                        var make = response.make;
                        $('#editName').val(make.name)
                        $('#editStatus').val(make.status).trigger('change');
                        $('#makeid').val(make.id);
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
                        url: "{{ route('vehicle.make.update') }}",
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
