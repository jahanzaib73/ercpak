@extends('layouts.app')
@section('protocol-liaison-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"><a
                    href="{{ route('protocol-liaison-contact-numbers.index', ['id' => $protocolLiaisonId]) }}">Contacts</a>
                / Update Contact</h4>
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
        <form class="" method="post"
            action="{{ route('protocol-liaison-contact-numbers.update', ['id' => $contact->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="protocolLiaisonId" value="{{ $protocolLiaisonId }}">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">

                            <div id="team_container">
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <h5 class="header-title pb-3">Contact Details</h5>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{-- <label>Contact Numebr</label> --}}
                                            <input type="text" name="contact_number" class="form-control"
                                                value="{{ old('contact_number', $contact->contact_numebr) }}"
                                                placeholder="Contact Numebr" />
                                            @error('contact_number')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-5 d-flex justify-content-end">
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
        </form>
    </div>
@endsection
