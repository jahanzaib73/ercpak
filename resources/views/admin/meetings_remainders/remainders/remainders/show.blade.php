@extends('layouts.app')
@section('remainder-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Remainder Detail</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post" action="{{ route('remainders.update', ['id' => $remainder->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div id="by_air_container">
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Remainder Detail</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <h5>{{ $remainder->title }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Remainder Type</label>
                                            <h5>{{ optional($remainder->remainderType)->name }}</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Employee</label>
                                            <h5>{{ optional($remainder->employee)->name }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Issuing Authority</label>
                                            <h5>{{ optional($remainder->issuingAuthority)->name_of_issuing_authorities }}
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiray Date</label>
                                            <h5>{{ $remainder->is_expairy_date ? 'Yes' : 'No' }}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-6 expiary_date_container">
                                        <div class="form-group">
                                            <label>Select Expairy Date</label>
                                            <h5>{{ $remainder->expairy_date ?? 'N/A' }}</h5>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Remainder Detail</label>
                                    <p>{{ $remainder->detail ?? 'N/A' }}</p>
                                </div>
                                <hr>
                                <div class="form-group mb-0 mt-1 d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn save-btn">
                                            Submit
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
@endsection
