@extends('layouts.auth')

@section('meta')
    <title>Log in | Mortgage Auditor</title>
    <meta name="description" content="Workday Log in">
@endsection

@section('auth')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-6 auth-box">
            <div class="card-body text-center">
                <div class="logo text-center pt-4">
                    <h5 class="custom-text-primary font-weight-bolder">Mortgage Auditor</h5>
                </div> 
                <h6 class="mb-4 pt-2">{{ __("Please login to continue..") }}</h6>
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate accept-charset="utf-8">
                    @csrf
                    
                    <div class="form-group text-left">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="" autofocus required>

                         @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group text-left">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" style="background: #242E4C" class="btn btn-primary btn-block shadow-sm mb-4"> {{ __('Login') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
