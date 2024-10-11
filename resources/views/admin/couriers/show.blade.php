@extends('layouts.app')
@section('courier-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a href="{{ route('couriers.index') }}">Couriers</a> / Courier Receiving Form Detail</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div id="by_air_container">
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <h5 class="header-title pb-3">Courier Received Detail Form</h5>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{-- <label>Date</label> --}}
                                        <h5>{{ $courier->date_time }}</h5>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>Item Received</label> --}}
                                        <h5>{{ $courier->item_received }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>Item Quantity</label> --}}
                                        <h5>{{ $courier->item_quantity }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {{-- <label>Item Description</label> --}}
                                <h5>{{ $courier->item_description }}</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sender</label>
                                        <h5>
                                            {{ optional($courier->sender)->official_name ? optional($courier->sender)->official_name . ' (Official)' : optional($courier->sender)->notable_name . ' (Notable)' }}

                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Receiver</label>
                                        <h5>{{ optional($courier->receiverUser)->full_name ?: 'N/A' }}</h5>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Received By</label>
                                        <h5>{{ optional($courier->receivedBy)->full_name ?: 'N/A' }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Handover To</label>
                                        <h5>{{ optional($courier->handoverTo)->full_name ?: 'N/A' }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <h5>{{ $courier->remarks }}</h5>
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
