@extends('layouts.app')
@section('vendor-active-class', 'active')

@section('content')
    <div class="container-fluid mt-5">
        <div class="d-flex justify-content-between topbar-header  text-white p-2 mb-3" style="border-radius: 5px">
            <div class="py-0 pl-3">
                <h3 class="mb-0 pt-1">List of Vendors</h3>
            </div>

            @if (Auth::user()->can('Add Vendors'))
            <button type="button"  class="btn save-btn mr-2" data-toggle="modal"
                data-target="#exampleModal"> Add Vendor </button>
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
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ $type->image_link }}" alt="" width="100"></td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->phone }}</td>

                            <td><span class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                    {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                            </td>
                            <td>
                                @if (Auth::user()->can('Edit Vendors'))

                                <a data-id="{{ $type->id }}" href="javascript:void"
                                    class="btn bg-info btn-sm edit text-white_record text-white"><i class="fa fa-edit"></i></a>
                                |

                                @endif
                                @if (Auth::user()->can('Delete Vendors'))
                                    <a href="{{ route('vendors.delete', ['id' => $type->id]) }}"
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
        @include('admin.fleets.vendors._models._add')

        <!-- Edit Modal -->
        @include('admin.fleets.vendors._models._edit')

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $("#vendor-form").validate({
                rules: {
                    name: "required",
                    phone: "required",
                    status: "required",
                },
                messages: {
                    name: "Please enter your name",
                    phone: "Please enter your phone",
                    status: "Please select status",
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('vendors.store') }}",
                        data: formData,
                        processData: false, // Prevent jQuery from processing the data
                        contentType: false, // Prevent jQuery from setting the content type
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        enctype: 'multipart/form-data',
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
                    url: "{{ route('vendors.edit') }}",
                    data: {
                        'id': $(this).attr('data-id')
                    },
                    success: function(response) {
                        var type = response.type;

                        $('#editName').val(type.name)
                        $('#editStatus').val(type.status).trigger('change');
                        $('#editPhone').val(type.phone);
                        $('#vendor_id').val(type.id)
                        $('#editMake').modal('show');
                    }
                });
            });

            $("#checklist-form-update").validate({
                rules: {
                    name: "required",
                    phone: "required",
                    status: "required",
                },
                messages: {
                    name: "Please enter your name",
                    phone: "Please enter your phone",
                    status: "Please select status",
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('vendors.update') }}",
                        data: formData,
                        processData: false, // Prevent jQuery from processing the data
                        contentType: false, // Prevent jQuery from setting the content type
                        enctype: 'multipart/form-data',
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
