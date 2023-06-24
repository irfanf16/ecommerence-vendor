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
                <img src="{{ url('vendor/images/bg/signup.svg') }}" alt="signup image" class="img-fluid">
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

                    <div class="card-body">
                        {{-- sign In --}}
                        <a href="{{ url('vendor/login') }}" class="float-right btn btn-outline-primary">Sign In</a>
                        <h4 class="card-title mb-4 mt-1"><b>Sign Up</b></h4>

                        <hr>
                        <form method="POST" action="{{ route('registerVendor') }}" id="regForm">
                            @csrf

                            {{-- name --}}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-red fa-user"></i> </span>
                                    </div>
                                    <input type="text" class="form-control shadow-none" name="name" id="name"
                                        placeholder="name" value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>
                                </div>
                            </div>

                            {{-- email --}}
                            <div class="form-group" id="emailError">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    </div>
                                    <input type="email" class="form-control shadow-none" name="email" id="email"
                                        placeholder="Email" required autofocus>
                                </div>
                            </div>

                            {{-- mobile --}}
                            <div class="form-group" id="mobError">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-red fa-phone"></i> </span>
                                    </div>
                                    <input type="text" class="form-control shadow-none" name="mobile" id="mobile"
                                        placeholder="Mobile number " value="{{ old('mobile') }}" required
                                        autocomplete="mobile" autofocus>
                                </div>
                            </div>

                            {{-- password --}}
                            <div class="form-group" id="pwdError">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input id="password" type="password" class="form-control shadow-none" name="password"
                                        required autocomplete="current-password" placeholder="password">
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
                                <div class="col-md-6">

                                    {{-- login button --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="registerBtn">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>

                                {{-- forgot password
                                <div class="col-md-6 ">
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
            $("#email").blur(function(e) {
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
