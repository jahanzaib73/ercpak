@extends('layouts.app')
@section('purchase-orders-active-class', 'active')
<style>
    .select2-container {
        width: 100% !important;
    }

    .user-card {
        width: 300px;
        /* Set the desired width for each card */
        margin: 10px;
        /* Add some margin to separate cards */
        border: 1px solid #ccc;
        /* Add a border for visual separation */
        padding: 10px;
        /* Add padding to the card content */
        text-align: center;
        /* Center the content horizontally */
    }

    .user-card img {
        max-width: 30%;
        /* Ensure the image doesn't exceed the card width */
        border-radius: 50%;
        /* Make the image a circle by setting border-radius */
    }

    .card {
        margin: 10px;
        padding: 10px;
    }
</style>
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="pb-3">Issue Order</h2>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Order#: 0000</strong>
                            </div>
                        </div>
                        <div class="container">
                            <form action="{{ route('invoices.store') }}" method="POST">
                                @csrf
                                <div class="row mt-1">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <input type="date" value="{{ old('date') }}" name="date"
                                            class="form-control">
                                        @error('date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <label for="request_by">Request By</label>
                                        <select name="request_by" id="request_by" class="form-control">
                                            <option value="">Request By</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('request_by') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('request_by')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-inline col-md-6">
                                        <label class="mr-2" for="is_po">PO# </label>
                                        <input type="checkbox" class="form-control mr-2" name="is_po" id="is_po"
                                            {{ old('is_po') == 'on' ? 'checked' : '' }}>
                                        <div class="col-md-6" id="purchase_order_container" style="display: none;">
                                            <select name="purchase_order_id" id="purchase_order_id" class="form-control">
                                                <option value="">Choose....</option>
                                                @foreach ($po as $p)
                                                    <option value="{{ $p->id }}">{{ $p->id }}</option>
                                                @endforeach
                                            </select>
                                            @error('purchase_order_id')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <label for="issued_by">Issued By</label>
                                        <select name="issued_by" id="issued_by" class="form-control">
                                            <option value="">Issued By</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('issued_by') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->full_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('issued_by')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-inline col-md-6">
                                        <label class="mr-2" for="is_wo">WO# </label>
                                        <input type="checkbox" class="form-control mr-2" name="is_wo" id="is_wo"
                                            {{ old('is_wo') == 'on' ? 'checked' : '' }}>
                                        <div class="col-md-6" style="display: none" id="work_order_container">
                                            <select name="work_order_id" id="work_order_id" class="form-control  mr-2">
                                                <option value="">Choose....</option>
                                                @foreach ($workorders as $wo)
                                                    <option value="{{ $wo->id }}">{{ $wo->id }}</option>
                                                @endforeach
                                            </select>
                                            @error('work_order_id')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-4">
                                        <label for="warehouse_id">Warehouse</label>
                                        <select name="warehouse_id" id="warehouse_id" class="form-control">
                                            <option value="">Choose....</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}"
                                                    {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('warehouse_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="location_id">Location</label>
                                        <select name="location_id" id="location_id" class="form-control">
                                            <option value="">Choose....</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('location_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cost_center_id">Cost Center</label>
                                        <select name="cost_center_id" id="cost_center_id" class="form-control">
                                            <option value="">Choose....</option>
                                            @foreach ($costcenters as $costcenter)
                                                <option value="{{ $costcenter->id }}"
                                                    {{ old('cost_center_id') == $costcenter->id ? 'selected' : '' }}>
                                                    {{ $costcenter->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('cost_center_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-12">
                                        <label for="note">Note</label>
                                        <textarea name="note" id="note" cols="30" rows="2" class="form-control">{{ old('note') }}</textarea>
                                    </div>
                                    @error('note')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn save-btn btns-w btn-md"
                                            id="submitAttachmentFormButton">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var po = "{{ old('is_po') }}";
            var wo = "{{ old('is_wo') }}";
            if (po == 'on') {
                $('#purchase_order_container').show();
                $('#work_order_container').hide();
            } else if (wo == 'on') {
                $('#work_order_container').show();
                $('#purchase_order_container').hide();
            }
            $('#is_po').change(function() {
                if (this.checked) {
                    $('#purchase_order_container').show();
                    $('#is_wo').prop('checked', false); // Deselect the other checkbox
                    $('#work_order_container').hide(); // Hide the other container
                } else {
                    $('#purchase_order_container').hide();
                }
            });

            $('#is_wo').change(function() {
                if (this.checked) {
                    $('#work_order_container').show();
                    $('#is_po').prop('checked', false); // Deselect the other checkbox
                    $('#purchase_order_container').hide(); // Hide the other container
                } else {
                    $('#work_order_container').hide();
                }
            });
        });
    </script>
@endsection
