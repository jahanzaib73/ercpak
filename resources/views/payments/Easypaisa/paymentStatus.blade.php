@extends('layouts.app')
@section('payments-easypaisa-active-class', 'active')

@section('content')
    <div class="container">
        <div class="status">

            @if (array_key_exists('message', $response))
                <h1>Payment Status</h1>
                <h4>Payment Information</h4>
                <p><b>Reference Number:</b> {{ $response['orderRefNumber'] }}</p>
                <p><b>Transaction ID:</b> {{ $response['transactionRefNumber'] }}</p>
                <p><b>Amount:</b> {{ $response['amount'] }}</p>
                <p><b>Message:</b> {{ $response['message'] }}</p>
            @elseif (array_key_exists('RC', $response))
                <h1>Payment Status</h1>
                <h4>Payment Information</h4>
                <p><b>Reference Number:</b> {{ $response['O'] }}</p>
                <p><b>Payment Status:</b> {{ $response['TS'] == "P" ? "Paid" : "Unpaid" }}</p>
            @else
                <h1>Payment Status</h1>
                <p><b>Message: </b>Unknown payment status</p>
            @endif
            <!-- --------------------------------------------------------------------------- -->


        </div>
    </div>

@stop
