@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="signup-image">
                    <!-- <img src="{{ url('vendor/images/bg/signup.svg') }}" alt="signup image" class="img-fluid"> -->
                    <h2>No Worries ! Here we're
                        Storak Help Center </h2>
                    <img src="{{ asset('/vendor/images/resetPassword/forgot.svg') }}" alt=""
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
                    @if (Session::has('error'))
                        <div class="card bg-danger" id="alertBox">
                            <div class="card-header bg-danger text-white">
                                <strong>Errors - Please Resolve These FIrst</strong>
                                <a href="#" id="alertCloseBtn" class="float-right text-white alert-close-btn">X</a>
                            </div>
                            <div class="card-body p-0">
                                <ul>
                                    <li class="text-white">{{ Session::get('error') }}</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="card-body login-form-body">
                        <div class="login-heading-top">
                            <h4 class="card-title mb-4 mt-1 text-center"><b>Reset Password</b></h4>
                        </div>
                        <form action="{{ route('password.email') }}" method="POST" class="login-form">
                            @csrf
                            {{-- email --}}
                            <div class="form-group">
                                <div class="input-group">

                                    <i class="far fa-envelope"></i>

                                    <input type="email" class="form-control shadow-none" name="email" id="email"
                                        placeholder="Email" required autofocus>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    {{-- send Otp button --}}
                                    <div class="form-group">
                                        <button type="submit" class="login-btn" id="registerBtn">
                                            {{ __('Send Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="sign-up-btn">
                                        <p>Enter your verified number please</p>
                                        <a href="{{ url('vendor/login') }}">Back</a>
                                        <a href="{{ url('password/reset/mobile') }}" class="float-right">Via Phone</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
