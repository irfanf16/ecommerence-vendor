@extends('layouts.app')
@section('content')

    {{-- Its for mobile number field to remove the arrow from the number input field --}}
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
    <div class="login-background">
        <div class="login-inner-part">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="signup-image">
                            <img src="{{ asset('/vendor/images/resetPassword/otp1.svg') }}" alt="signup image"
                                style="height:600px; width: 600px">
                        </div>
                    </div>

                    <div class="col-md-4 pt-5 mt-5">
                        <div class="card mt-5 border-0">
                            {{-- success message --}}
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            {{-- error message --}}
                            @if ($message = Session::get('error'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            <div class="card-body login-form-body">
                                <div class="login-heading-top ">
                                    <h4 class="card-title mb-4 mt-1 text-center"><b>Confirm OTP</b></h4>
                                </div>
                                <form action="{{ URL::to('/mobile/verify') }}" method="POST">
                                    @csrf
                                    {{-- mobile --}}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="string" class="form-control shadow-none" id="mobile" name="mobile"
                                                value="{{ session('mobile') }}" readonly required>
                                        </div>
                                    </div>

                                    {{-- otp --}}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" class="form-control shadow-none" id="mobile_otp"
                                                name="mobile_otp" placeholder="6-digit code" maxlength="6" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="login-btn">
                                                    {{ __('Verify Otp') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="sign-up-btn">
                                                <p>Enter your 6-digit OTP number</p>
                                                <a href="{{ url('vendor/login') }}">Back</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
