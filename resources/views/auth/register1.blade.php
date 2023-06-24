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
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="signup-image">
                    <!-- <img src="{{ url('vendor/images/bg/signup.svg') }}" alt="signup image" class="img-fluid"> -->
                    <h2>Welcome to Storak Seller Center </h2>
                    <img src="{{asset('/assets/images/log-in-image.svg')}}" alt="signup image" class="img-fluid">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card mt-5 border-0">

                    {{-- Error Messages - Custom Validation Errors Code --}}
                    @if (count($errors) > 0)
                        @php $errors = Session::get('errors'); @endphp
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach ($errors as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <div class="card-body login-form-body">
                        {{-- sign In --}}
                        <!-- <a href="{{ url('vendor/login') }}" class="float-right btn btn-outline-primary">Sign In</a> -->
                        
                        <div class="login-heading-top">
                            <h4 class="card-title mb-4 mt-1 text-center"><b>Create Account</b></h4>
                        </div>
                        <form method="POST" action="{{ route('registerVendor') }}" id="regForm" autocomplete="off" class="login-form">
                            @csrf

                            {{-- name --}}
                            <input autocomplete="false" name="hidden" type="text" style="display:none;">
                            <div class="form-group">
                                <div class="input-group">
                                    <i class="far fa-user"></i>
                                    <input type="text" class="form-control shadow-none" name="name" id="name"
                                        placeholder="Full Name" value="{{ old('name') }}" autofocus required>
                                </div>
                            </div>

                            {{-- email --}}
                            <div class="form-group" id="emailError">
                                <div class="input-group">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" class="form-control shadow-none" name="email" id="email"
                                        placeholder="Email" required>
                                </div>
                            </div>

                            {{-- mobile --}}
                            <div class="form-group number-with-country" id="mobError">
                                <div class="input-group">
                                <select name="countryCode" id="">
                                    <option data-countryCode="QR" value="974" Selected>QAR (+974)</option>
                                    <option data-countryCode="PK" value="92">PAK (+92)</option>
                                </select>
                                    
                                    <input type="text" class="form-control shadow-none" name="mobile" id="mobile"
                                        placeholder="Mobile Number " value="{{ old('mobile') }}" required>
                                </div>
                            </div>

                            {{-- password --}}
                            <div class="form-group" id="pwdError">
                                <div class="input-group">
                                    <i class="fas fa-unlock-alt"></i>
                                    <input id="password" type="password" class="form-control shadow-none" name="password"
                                        placeholder="Password" required>
                                </div>
                            </div>

                            {{-- remember me --}}
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    {{-- login button --}}
                                    <div class="form-group">
                                        <button type="submit"  class="login-btn" id="registerBtn">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="sign-up-btn">
                                        <p>If you have an account please login</p>
                                        <a href="{{ url('vendor/login') }}">Login</a>
                                    </div>
                                </div>

                                {{-- forgot password
                                <div class="col-md-12">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                                </div> --}}
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('customScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#regForm').submit(function(e) {
                e.preventDefault();

                // VALIDATE MOBILE NUMBER
                var mobile = $("#mobile").val();
                var regexPattern = new RegExp(/^[0-9-+]+$/);
                var result = regexPattern.test(mobile);

                if (!result || mobile.length > 13 || mobile.length < 11) {
                    $('.mobError').hide();
                    $("#mobError").append(
                        `<small class="text-danger mobError">Please provide a valid phone number</small>`
                    );
                    return;
                }

                // VALIDATE PASSWORD LENGTH
                if ($("#password").val().length < 8) {
                    $('.pwdError').hide();
                    $("#pwdError").append(
                        `<small class="text-danger pwdError">The password must be at least 8 characters.</small>`
                    );
                    return;
                }

                e.currentTarget.submit();
            });


            // VALIDATE EMAIL
            $("#email").keyup(function(e) {
                e.preventDefault();

                var email = $('#email').val();

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: "/vendor/verify-email",
                    data: {
                        email: email,
                    },
                    success: function(response) {

                        var alreadyUsed = response.isAlreadyUsed;

                        if (alreadyUsed) {
                            $('.emailError').hide();
                            $("#emailError").append(
                                `<small class="text-danger emailError">The Email has already been used.</small>`
                            );

                        } else {
                            $('.emailError').hide();
                        }
                    },
                });

            });
        });
    </script>
@endsection
