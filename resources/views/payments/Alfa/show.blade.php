@extends('layouts.app')
@section('payments-alfa-active-class', 'active')

@section('content')
    <div class="row">
        <div class="col-12">
            <input id="Key1" name="Key1" type="hidden" value="MQFvQRwpeK62A56J">
            <input id="Key2" name="Key2" type="hidden" value="5867128040108048">

            {{-- <h3>Handshake</h3> --}}
            <form action="https://sandbox.bankalfalah.com/HS/HS/HS" id="HandshakeForm" method="post">
                <input id="HS_RequestHash" name="HS_RequestHash" type="hidden" value="">
                <input id="HS_IsRedirectionRequest" name="HS_IsRedirectionRequest" type="hidden" value="0">
                <input id="HS_ChannelId" name="HS_ChannelId" type="hidden" value="1001">
                <input id="HS_ReturnURL" name="HS_ReturnURL" type="hidden"
                    value="http://127.0.0.1:8000/easypaisa/paymentStatus">
                <input id="HS_MerchantId" name="HS_MerchantId" type="hidden" value="6047">
                <input id="HS_StoreId" name="HS_StoreId" type="hidden" value="015024">
                <input id="HS_MerchantHash" name="HS_MerchantHash" type="hidden"
                    value="zWsOsg0VNuC82S3w1/nOQnVvjvkfYf8XnJOWYKoXaMrzWj9gfvowdyAle/nxFlPD">
                <input id="HS_MerchantUsername" name="HS_MerchantUsername" type="hidden" value="meqine">
                <input id="HS_MerchantPassword" name="HS_MerchantPassword" type="hidden" value="K+01ZMTTSoRvFzk4yqF7CA==">
                <div class="row mb-3">
                    <div class="col-6">
                        <input type="hidden" id="HS_TransactionReferenceNumber" name="HS_TransactionReferenceNumber"
                            autocomplete="off" placeholder="Order ID" value="{{ $transNum }}" class="form-control"
                            readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3>Alfa Product Demo</h3>
            <form action="https://sandbox.bankalfalah.com/SSO/SSO/SSO" id="PageRedirectionForm" method="post"
                novalidate="novalidate">
                <input id="AuthToken" name="AuthToken" type="hidden" value="">
                <input id="RequestHash" name="RequestHash" type="hidden" value="">
                <input id="IsRedirectionRequest" name="HS_IsRedirectionRequest" type="hidden" value="0">
                <input id="ChannelId" name="ChannelId" type="hidden" value="1001">
                <input id="Currency" name="Currency" type="hidden" value="PKR">
                <input id="IsBIN" name="IsBIN" type="hidden" value="0">
                <input id="ReturnURL" name="ReturnURL" type="hidden" value="http://127.0.0.1:8000/easypaisa/paymentStatus">
                <input id="MerchantId" name="MerchantId" type="hidden" value="6047">
                <input id="StoreId" name="StoreId" type="hidden" value="015024">
                <input id="MerchantHash" name="MerchantHash" type="hidden"
                    value="zWsOsg0VNuC82S3w1/nOQnVvjvkfYf8XnJOWYKoXaMrzWj9gfvowdyAle/nxFlPD">
                <input id="MerchantUsername" name="MerchantUsername" type="hidden" value="meqine">
                <input id="MerchantPassword" name="MerchantPassword" type="hidden" value="K+01ZMTTSoRvFzk4yqF7CA==">
                <div class="row mb-3">
                    <div class="col-6">
                        <select autocomplete="off" id="TransactionTypeId" name="TransactionTypeId"
                            class="form-control form-select">
                            <option value="">Select Transaction Type</option>
                            <option value="1">Alfa Wallet</option>
                            <option value="2">Alfalah Bank Account</option>
                            <option value="3">Credit/Debit Card</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="name">Product</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="Premium Product" readonly>
                    </div>
                    <div class="col-6">
                        <label for="TransactionReferenceNumber">Product #</label>
                        <input autocomplete="off" id="TransactionReferenceNumber" name="TransactionReferenceNumber"
                            placeholder="Order ID" type="text" value="{{ $transNum }}" class="form-control"
                            readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" name="quantity" id="quantity" value="1"
                            readonly>
                    </div>
                    <div class="col-6">
                        <label for="TransactionAmount">Amount</label>
                        <input autocomplete="off" id="TransactionAmount" name="TransactionAmount"
                            placeholder="Transaction Amount" type="text" value="100" class="form-control"
                            readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" id="run">PAY</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>

    <script type="text/javascript">
        $(function() {

            window.onload = function() {
                $("#handshake").attr('disabled', 'disabled');
                submitRequest("HandshakeForm");
                var myData = {
                    HS_MerchantId: $("#HS_MerchantId").val(),
                    HS_StoreId: $("#HS_StoreId").val(),
                    HS_MerchantHash: $("#HS_MerchantHash").val(),
                    HS_MerchantUsername: $("#HS_MerchantUsername").val(),
                    HS_MerchantPassword: $("#HS_MerchantPassword").val(),
                    HS_IsRedirectionRequest: $("#HS_IsRedirectionRequest").val(),
                    HS_ReturnURL: $("#HS_ReturnURL").val(),
                    HS_RequestHash: $("#HS_RequestHash").val(),
                    HS_ChannelId: $("#HS_ChannelId").val(),
                    HS_TransactionReferenceNumber: $("#HS_TransactionReferenceNumber").val(),
                }

                console.log(myData);
                $.ajax({
                    type: 'POST',
                    url: 'https://sandbox.bankalfalah.com/HS/HS/HS',
                    contentType: "application/x-www-form-urlencoded",
                    data: myData,
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(r) {
                        console.log(r);
                        if (r != '') {
                            if (r.success == "true") {
                                $("#AuthToken").val(r.AuthToken);
                                $("#ReturnURL").val(r.ReturnURL);
                                alert('Success: Handshake Successful');
                            } else {
                                alert('Error: Handshake Unsuccessful');
                            }
                        } else {
                            alert('Error: Handshake Unsuccessful');
                        }
                    },
                    error: function(error) {
                        alert('Error: An error occurred');
                    },
                    complete: function(data) {
                        $("#handshake").removeAttr('disabled', 'disabled');
                    }
                });

            };

            $("#run").click(function(e) {
                e.preventDefault();
                submitRequest("PageRedirectionForm");
                document.getElementById("PageRedirectionForm").submit();
            });
        });

        function submitRequest(formName) {

            var mapString = '',
                hashName = 'RequestHash';
            if (formName == "HandshakeForm") {
                hashName = 'HS_' + hashName;
            }

            $("#" + formName + " :input").each(function() {
                if ($(this).attr('id') != '') {
                    mapString += $(this).attr('id') + '=' + $(this).val() + '&';
                }
            });

            $("#" + hashName).val(CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(mapString.substr(0, mapString.length - 1)),
                CryptoJS.enc.Utf8.parse("MQFvQRwpeK62A56J"), {
                    keySize: 128 / 8,
                    iv: CryptoJS.enc.Utf8.parse("5867128040108048"),
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7
                }));
        }
    </script>
@endsection
