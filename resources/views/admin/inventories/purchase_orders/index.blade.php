@extends('layouts.app')
@section('purchase-orders-active-class', 'active')
@section('css')
    <style>
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            margin: auto;
            /* Center the image horizontally */
        }

        .card-title {
            margin: 10px 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        @include('admin.inventories.purchase_orders._models._states')
        <hr>
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @php
            Session::forget('success');
        @endphp
        <div class="rounded ml-1 topbar-header rounded text-white mb-3 row" style="padding: 15px">
            <div class="col-md-3">
                <h3 >List of Inventories</h3>
            </div>
            {{--  <div class="col-md-4"></div>  --}}
            <div class="col-md-5">
                <select name="purchase_order_filter" id="purchase_order_filter" class="form-control">
                    <option value="">All</option>
                    <option value="Requisition">Requisition</option>
                    <option value="Comparatives">Comparatives</option>
                    <option value="POs">POs</option>
                </select>
            </div>

            <div class="col-4">
                <div class="d-flex justify-content-end">
                    <div class="">
                        @if (Auth::user()->can('Add Requisition'))
                        <a href="{{ route('purchase-orders.create') }}" 
                            class="btn save-btn "> Add Requisition</a>
                        @endif
        
                    </div>
                    <div class="ml-1">
                        @if (Auth::user()->can('Invoices List'))
                        <a href="{{ route('invoices.index') }}" 
                            class="btn mr-1 save-btn ">Invoices</a>
                        @endif
                    </div>
                </div>
            </div>

          
        </div>

        <div class="table-responsive">
            <table class="table-hover ajax-table" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doc#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Purchaser</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Warehouse</th>
                        <th scope="col">Term</th>
                        <th scope="col">Ship Via</th>
                        <th scope="col">Notes</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="uploadAttachment" tabindex="-1" role="dialog" aria-labelledby="uploadAttachmentLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 160%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadAttachmentLabel">Uplaod Attachments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Uploaded Attachments</h3>
                    <hr>
                    <div class="row attachment-container" id="attachment-row">
                        <!-- Existing columns go here -->
                    </div>
                    <hr>
                    <form action="" method="POST" id="attachmentUploadForm">
                        <input type="hidden" name="purchaseOrderId" id="purchaseOrderId">
                        <input type="hidden" name="purchaseOrderStatus" id="purchaseOrderStatus">
                        <div class="form-group">
                            <label for="files" class="col-form-label">Select Attachments:</label>
                            <input type="file" multiple name="files[]" class="form-control" id="files">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary upload_attachment_btn">Upload</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('purchase-orders.index') }}",
                data: function(data) {
                    data.purchase_order_filter = $('#purchase_order_filter').val();
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'location.name',
                    name: 'location.name'
                },
                {
                    data: 'request_by_id',
                    name: 'request_by_id'
                },
                {
                    data: 'vendor.name',
                    name: 'vendor.name'
                },
                {
                    data: 'warehouse.name',
                    name: 'warehouse.name'
                },
                {
                    data: 'terms',
                    name: 'terms'
                },
                {
                    data: 'ship_via',
                    name: 'ship_via'
                },
                {
                    data: 'notes',
                    name: 'notes'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#purchase_order_filter').change(function() {
            table.draw();
        });

        $(document).on('click', '.upload_attachment', function(e) {
            var poId = $(this).attr('data-id');
            var poStatus = $(this).attr('data-status');

            $.ajax({
                type: "GET",
                url: "{{ route('po.get.attachment') }}",
                data: {
                    'poId': poId,
                    'poStatus': poStatus,
                },
                success: function(data) {
                    var attachments = data.attachments
                    console.log(attachments);
                    attachments.forEach(function(item) {
                        appendCard(item);
                    });
                    $('#purchaseOrderId').val(poId);
                    $('#purchaseOrderStatus').val(poStatus);
                    $('#uploadAttachment').modal('show')
                }
            });

        });

        $(document).ready(function() {
            $("#attachmentUploadForm").validate({
                rules: {
                    'files[]': {
                        required: true,
                    },
                }
            });

            $('.upload_attachment_btn').click(function() {
                var formElement = document.getElementById('attachmentUploadForm'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid

                    $.ajax({
                        type: "POST",
                        url: "{{ route('po.upload.attachment') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#uploadAttachment').modal('hide')
                                location.reload();
                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        })

        // Function to append card elements
        function appendCard(data) {
            var cardHtml = `
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" style="height: 100px; object-fit: cover;" src="${data.file_url}" alt="Card image cap">
                        <div class="card-body">
                            <a href="${data.file_url}" target="_blank" class="btn btn-primary">Show</a>
                        </div>
                    </div>
                </div>
            `;
            $("#attachment-row").append(cardHtml);
        }

        $(document).ready(function() {
            // Function to clear the attachment-row
            function clearAttachmentRow() {
                $("#attachment-row").empty();
            }

            // Event listener for modal close event
            $('#uploadAttachment').on('hidden.bs.modal', function() {
                clearAttachmentRow();
            });
        });
    </script>
@endsection
