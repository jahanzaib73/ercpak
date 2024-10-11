@extends('layouts.app')
@section('courier-active-class', 'active')
@section('content')
<div class="container">
    <div class="page-head">
        <h4 class="mt-2 mb-2"><a href="{{ route('couriers.index') }}">Couriers</a> / Courier Receiving Form</h4>
        @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
    </div>
    <form class="" method="post" action="{{ route('couriers.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card  m-b-30 ">
                    <div class="card-body bg-white">
                        <div id="by_air_container">
                            <div class="row mt-3">

                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Courier Received Detail Form</h5>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label><strong>Date</strong></label>
                                        <input type="datetime-local" name="date_time" class="form-control" value="{{ old('date_time', date("Y-m-d H:i:s")) }}" placeholder="Date" />
                                        @error('date_time')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label><strong>Item Received</strong></label>
                                        <input type="text" name="item_received" class="form-control" value="{{ old('item_received') }}" placeholder="Enter name of item(s)" />
                                        @error('item_received')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label><strong>Item Quantity</strong></label>
                                        <input type="number" name="item_quantity" class="form-control" value="{{ old('item_quantity') }}" placeholder="Enter Qty" />
                                        @error('item_quantity')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label class="mb-0"><strong>Select Sender</strong> <span><button type="button" class="btn save-btn btn-sm rounded-circle" data-toggle="modal" data-target="#exampleModalform">
                                                    <i class="fa fa-plus"></i>
                                                </button></span></label>
                                        <select name="sender_id" id="sender_id" class="form-control">
                                            <option value="">Please Select</option>
                                            @foreach ($senders as $sender)
                                            <option value="{{ $sender->id }}" {{ $sender->id == old('sender_id', isset($guestVisitors) ? $guestVisitors->guest_id : '') ? 'selected' : '' }}>
                                                @if ($sender->official_name)
                                                {{ $sender->official_name . ' (' . optional($sender->protocolLiaisonType)->name . ')' }}
                                                @elseif ($sender->notable_name)
                                                {{ $sender->notable_name . ' (' . optional($sender->protocolLiaisonType)->name . ')' }}
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('sender_id')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label><strong>Receiver</strong></label>
                                        <select name="receiver" id="receiver" class="form-control">
                                            <option value="">Please Select</option>
                                            @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('receiver', isset($guestVisitors) ? $guestVisitors->receiver : '') == $user->id ? 'selected' : '' }}>
                                                {{ $user->full_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('receiver')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label><strong>Received By</strong></label>
                                            <select name="received_by" id="received_by" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                {{ old('received_by', isset($guestVisitors) ? $guestVisitors->received_by : '') == $user->id ? 'selected' : '' }}>
                                {{ $user->full_name }}</option>
                                @endforeach
                                </select>
                                @error('received_by')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label><strong>Handover To</strong></label>
                                <select name="handover_to" id="handover_to" class="form-control">
                                    <option value="">Please Select</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('handover_to', isset($guestVisitors) ? $guestVisitors->handover_to : '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->full_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('handover_to')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label><strong>Remarks</strong></label>
                            <textarea name="remarks" placeholder="remarks" id="remarks" rows="2"  class="form-control">{{ old('remarks') }}</textarea>
                            @error('remarks')
                            <span class="error">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label><strong>Item Description</strong></label>
                            <textarea name="item_description" placeholder="Write description" id="item_description" rows="2" class="form-control">{{ old('item_description') }}</textarea>
                            @error('item_description')
                            <span class="error">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-md save-btn px-3">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</form>

</div>
<div class="modal fade" id="exampleModalform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelform" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel"><strong>Add Sender</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{ route('couriers.protocol.add') }}" id="addProtocolForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="type" class="control-label">Type</label>
                                <select required id="type" name="type" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                    <option value="">Please Select</option>
                                    <option value="OFFICIAL">Official</option>
                                    <option value="NOTABLE">Notable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Name" class="control-label">Name</label>
                                <input type="text" required class="form-control" name="name" id="name" placeholder="Name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="phone_number" class="control-label">Mobile Number</label>
                                <input type="text" required class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="department_id" class="control-label">Department</label>
                                <select required id="department_id" name="department_id" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;">
                                    <option value="">Please Select</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    $(document).ready(function() {
        $('#addProtocolForm').parsley();
    });
</script>
@endsection