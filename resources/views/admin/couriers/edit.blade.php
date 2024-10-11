@extends('layouts.app')
@section('courier-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('couriers.index') }}">Couriers</a> / Update Courier Receiving Form</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('couriers.update', ['id' => $courier->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div id="by_air_container">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Update Courier Received Detail Form</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Date</label> --}}
                                            <input type="datetime-local" name="date_time" class="form-control"
                                                value="{{ $courier->date_time }}" placeholder="item received" />
                                            @error('date_time')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Item Received</label> --}}
                                            <input type="text" name="item_received" class="form-control"
                                                value="{{ $courier->item_received }}" placeholder="item received" />
                                            @error('item_received')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Item Quantity</label> --}}
                                            <input type="text" name="item_quantity" class="form-control"
                                                value="{{ $courier->item_quantity }}" placeholder="item quantity" />
                                            @error('item_quantity')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Item Description</label>
                                    <textarea name="item_description" placeholder="item description" id="item_description" cols="30" rows="2"
                                        class="form-control">{{ $courier->item_description }}</textarea>
                                    @error('item_description')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Select Sender</label> --}}
                                            <select name="sender_id" id="sender_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($senders as $sender)
                                                    <option value="{{ $sender->id }}"
                                                        {{ $sender->id == old('sender_id', isset($courier) ? $courier->sender_id : '') ? 'selected' : '' }}>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Receiver</label> --}}
                                            <select name="receiver" id="receiver" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('receiver', isset($courier) ? $courier->receiver : '') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->full_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('receiver')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <label>Handover To</label> --}}
                                            <select name="handover_to" id="handover_to" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('handover_to', isset($courier) ? $courier->handover_to : '') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->full_name }}</option>
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
                                    {{--  <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Received By</label>
                                            <select name="received_by" id="received_by" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('received_by', isset($courier) ? $courier->received_by : '') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->full_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('received_by')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>  --}}
                                  
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea name="remarks" placeholder="remarks" id="remarks" cols="30" rows="2" class="form-control">{{ $courier->remarks }}</textarea>
                                    @error('remarks')
                                        <span class="error">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group mb-0 mt-1 d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn save-btn">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
