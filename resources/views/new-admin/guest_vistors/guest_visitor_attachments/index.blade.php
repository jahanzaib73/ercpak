@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Attachments')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <style>
        .popup-form {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .preview-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #fff;
            height: 100%;
            overflow-y: auto;
        }

        .preview-photo {
            text-align: center;
            margin-bottom: 15px;
        }

        .preview-photo img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
@endsection
@section('content')

    <div class="row" id="basic-table">
        <div class="col-12 mb-5">
                @if (Auth::user()->can('Add Guest & Visitor Attachment'))
                    <div class="card-header" style="text-align: right">
                        <a href="{{ route('guest-visitor-attachment.create', ['id' => $guestVisitId]) }}"
                            class="btn btn-primary">Add</a>
                    </div>
                @endif
        </div>
        <div class="col-12">
            <div class="card">

                <div class="row">
                    <div class="col-md-6 preview-box">
                        <div class="preview-photo">
                            <img id="previewImage" style="max-width:100%"
                                src="{{ $guestVisitor->image_url ?? 'https://via.placeholder.com/150' }}"
                                alt="Photo Preview">
                        </div>
                        <h5>Preview</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive width-95-per mx-auto">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Attachment</th>
                                        <th>Attachment Job#</th>
                                        <th>Expiary Date</th>
                                        <th>File Name</th>
                                        <th>Created By</th>
                                        <th>Guest/Visitor Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guestVisitorAttachments as $attachment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img class="img-fluid attachment-link" width="40"
                                                    src="{{ $attachment->file_url }}"
                                                    data-image-url="{{ $attachment->file_url }}">
                                            </td>
                                            <td>{{ $attachment->id }}</td>
                                            <td>{{ $attachment->expiary_date }}</td>
                                            <td>{{ ucwords($attachment->file_name) }}</td>
                                            <td>{{ optional($attachment->user)->full_name }}</td>
                                            <td>{{ $attachment->guest_visitor_id }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $attachment->status == 1 ? 'success' : 'info' }}">
                                                    {{ $attachment->status == 1 ? 'Closed' : 'Inprogress' }}</span>
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button"
                                                        class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                        data-bs-toggle="dropdown">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="lucide lucide-menu">
                                                            <line x1="4" x2="20" y1="12"
                                                                y2="12" />
                                                            <line x1="4" x2="20" y1="6"
                                                                y2="6" />
                                                            <line x1="4" x2="20" y1="18"
                                                                y2="18" />
                                                        </svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href="{{ route('guest-visitor-attachment.edit', ['id' => $attachment->id]) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-edit-2">
                                                                <path
                                                                    d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                                </path>
                                                            </svg>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('guest-visitor-attachment.delete', ['id' => $attachment->id]) }}"
                                                            onclick="return confirm(\'Are you sure?\')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                            </svg>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>

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
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            // When the image is clicked
            $('.attachment-link').on('click', function() {
                // Get the image URL from the data attribute
                var imageUrl = $(this).data('image-url');

                // Set the src attribute of the preview image
                $('#previewImage').attr('src', imageUrl);
            });
        });
    </script>
@endsection
