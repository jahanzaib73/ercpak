@extends('layouts.app')
@section('payments-easypaisa-active-class', 'active')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Easypaisa Product Demo</h3>
            </div>
            <hr>
            <div class="card-body">
                <form action="{{ route('easypaisa.DoCheckout') }}" method="POST">
                    @csrf
                    <label for="name">Product</label>
                    <input type="text" class="form-control mb-2" name="name" id="name" value="Premium Package"
                        readonly>
                    <div class="row">
                        <div class="col-6">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control mb-2" name="quantity" id="quantity" value="1"
                            readonly>
                        </div>
                        <div class="col-6">
                        <label for="price">Price</label>
                        <input type="text" class="form-control mb-2" name="price" id="price" value="10.00"
                            readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <label for="number">Phone Number</label>
                        <input type="text" class="form-control mb-2" name="number" id="number">
                        </div>
                        <div class="col-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-2" name="email" id="email">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-danger" type="submit">PAY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
