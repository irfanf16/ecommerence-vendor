@extends('layouts.app')
@section('title', 'Reset Your Password')
@section('content')
    <div class="login-background">
        <div class="login-inner-part">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="signup-image">
                            <img src="{{ asset('/vendor/images/resetPassword/forgot-email.svg') }}" alt=""
                                style="height:400px; width: 400px">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mt-5 border-0">

                            {{-- success message --}}
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            {{-- Error Messages - Custom Validation Errors Code --}}
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            <div class="card-body login-form-body">
                                <div class="login-heading-top">
                                    <h4 class="card-title mb-4 mt-1 text-center"><b>Forgot Password</b></h4>
                                </div>
                                <form action="{{ url('/password/reset/email/send-link') }}" method="POST"
                                    class="login-form">
                                    @csrf
                                    {{-- email --}}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <i class="far fa-envelope"></i>
                                            <input type="email" class="form-control shadow-none" name="email" id="email"
                                                placeholder="Email" required autofocus>
                                            <p class="text-muted">You will receive a password reset link on your registered email address.</p>

                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- button --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="login-btn" id="registerBtn">
                                                    {{ __('Send Reset Link') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="sign-up-btn">
                                                <p>Enter your verified Email</p>
                                                <a href="{{ url('vendor/login') }}" class="float-right">Back</a>
                                                {{-- <a href="{{ url('password/reset/mobile') }}" class="float-right">Via
                                                    Phone</a> --}}
                                            </div>
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
@endsection
