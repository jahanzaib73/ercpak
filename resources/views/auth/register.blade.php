@extends('layouts.auth')

@section('content')
<section class="bg-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="wrapper-page">
                    <div class="account-pages">
                        <div class="account-box" style="max-width: 612px !important;">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <img src="assets/images/logo_sm_2.png" alt="" class="">
                                        <h5 class="mt-3"><b>Welcome to DMS</b></h5>
                                    </div>
                                    <form class="form mt-5 contact-form" action="index.html">
                                        <div class="form-group ">
                                            <div class="col-sm-12">
                                                <input class="form-control form-control-line" type="text" placeholder="Name" name="name" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-sm-12">
                                                <input class="form-control form-control-line" type="text" placeholder="email" name="email" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-sm-12">
                                                <input class="form-control form-control-line" type="password" name="password" placeholder="Password" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-12">
                                                <label class="cr-styled">
                                                    <input type="checkbox" checked>
                                                    <i class="fa"></i>
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12 mt-4">
                                                <button class="btn save-btn btn-block" type="submit">Log In</button>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12 mt-4 text-center">
                                                <a href="recoverpw.html"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  --}}
@endsection
