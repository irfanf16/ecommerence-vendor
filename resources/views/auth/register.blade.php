@extends('layouts.app')
@section('title', 'Create a new account')

@section('content')

    {{-- JUST PLACE THESE FOR MOBILE NUMBER FIELD --}}
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
                    <div class="col-md-8 signup-bg-color">
                        <div class="signup-image">
                            <!-- <img src="{{ url('vendor/images/bg/signup.svg') }}" alt="signup image" class="img-fluid"> -->
                            <h2>Welcome to Storak Seller Center </h2>
                            <img src="{{ asset('/assets/images/log-in-image.svg') }}" alt="signup image"
                                class="img-fluid">
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
                            {{-- error message --}}
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            {{-- Error Messages - Custom Validation Errors Code --}}
                            {{-- @php $errors = Session::get('errors'); @endphp
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    @foreach ($errors as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif --}}

                            <div class="card-body login-form-body">
                                {{-- sign In --}}
                                <!-- <a href="{{ url('vendor/login') }}" class="float-right btn btn-outline-primary">Sign In</a> -->

                                <div class="login-heading-top">
                                    <h4 class="card-title mb-4 mt-1 text-center"><b>Create Account</b></h4>
                                </div>
                                <form method="POST" action="{{ route('registerVendor') }}" id="regForm" autocomplete="off"
                                    class="login-form">
                                    @csrf

                                    {{-- name --}}
                                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <i class="far fa-user"></i>
                                            <input type="text" class="form-control shadow-none" name="name" id="name"
                                                placeholder="Full Name" autofocus required>
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

                                    {{-- mobile no --}}
                                    <div class="form-group number-with-country" id="mobileError">
                                        <div class="input-group">
                                            <select name="country_code" id="countryCode">
                                                <option data-countryCode="QR" value="+974" Selected>QAR (+974)</option>
                                                {{-- <option data-countryCode="PK" value="+92">PAK (+92)</option> --}}
                                            </select>

                                            <input type="number" class="form-control shadow-none" name="mobile" id="mobile"
                                                placeholder="XXXXXXXX" min="0" maxlength="8"
                                                oninput="this.value=this.value.slice(0,this.maxLength)" required>
                                        </div>

                                        <small class="text-danger d-none" id="mobError">Please provide a valid phone
                                            number</small>
                                    </div>

                                    {{-- password --}}
                                    <div class="form-group d-inline">
                                        <div class="input-group">
                                            <i class="fas fa-unlock-alt"></i>
                                            <input type="password" class="form-control shadow-none" id="password"
                                                name="password" placeholder="Password" required>
                                        </div>
                                        <small class="text-danger d-none" id="pwdError">The password must contain at least 1
                                            uppercase, 1 lowercase, once special character and its minimum length should be
                                            at least 8 characters.</small>
                                    </div>

                                    {{-- Show password --}}
                                    <div class="form-group pl-4">
                                        <input class="form-check-input" type="checkbox" onclick="showPassword()"
                                            id="show_password"><label class="form-check-label"></label>Show
                                    </div>

                                    {{-- remember me --}}
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    {{-- register button --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="login-btn" id="registerBtn">
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

                                        {{-- forgot password --}}
                                        {{-- <div class="col-md-12">
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
        </div>

    </div>
    <script>
        // VIEW PASSWORD
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type == 'password') {
                x.type = 'text';
            } else {
                x.type = 'password';
            }
        }
    </script>
@endsection

@section('customScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // COUNTRY-CODE VALIDATION
            $("#countryCode").change(function(e) {
                e.preventDefault();
                var countryCode = $(this).val();
                if (countryCode == "+974") {
                    $(this).next().val('');
                    $(this).next().attr('maxlength', 8, 'minlength', 8);
                    $(this).next().attr('placeholder', '22334455');
                } else {
                    $(this).next().val('');
                    $(this).next().attr('maxlength', 10, 'minlength', 10);
                    $(this).next().attr('placeholder', '3002233444');

                }

            });

            // VALIDATE EMAIL-ADDRESS FOR UNIQUNESS
            $("#email").keyup(function(e) {
                var email = $('#email').val();

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: "/vendor/validate-unique-email",
                    data: {
                        email: email,
                    },
                    success: function(response) {

                        // console.log(response);

                        var alreadyUsed = response.isAlreadyUsed;

                        if (alreadyUsed) {
                            $(".emailError").hide();
                            $("#emailError").append(
                                `<small class="text-danger emailError">The Email has already been used.</small>`
                            );
                            $("#registerBtn").attr("disabled", true);

                        } else {
                            $(".emailError").hide();
                            $("#registerBtn").attr("disabled", false);
                        }
                    },
                });

            });


            // VALIDATE MOBILE-NO FOR UNIQUNESS
            $("#mobile").keyup(function(e) {
                var mobile = $('#mobile').val();
                var countryCode = $('#countryCode').val();

                var mobileNo = countryCode + mobile;

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: "/vendor/validate-unique-mobile",
                    data: {
                        mobile_no: mobileNo,
                    },
                    success: function(response) {

                        console.log(response);

                        var alreadyUsed = response.isAlreadyUsed;

                        if (alreadyUsed) {
                            $(".mobileError").hide();
                            $("#mobileError").append(
                                `<small class="text-danger mobileError">The Mobile No has already been used.</small>`
                            );
                            $("#registerBtn").attr("disabled", true);

                        } else {
                            $(".mobileError").hide();
                            $("#registerBtn").attr("disabled", false);
                        }
                    },
                });

            });

            // MOBILE-NO LENGTH AND FORMAT VALIDATION
            $("#mobile").blur(function(e) {
                e.preventDefault();

                var mobile = $(this).val();
                var maxLength = $(this).attr('maxlength');

                var regexPattern = new RegExp(/^[0-9]+$/);
                var result = regexPattern.test(mobile);

                if (!result || mobile.length != maxLength) {
                    $('#mobError').removeClass('d-none');
                } else {
                    $('#mobError').addClass('d-none');
                }

            });

            // SUBMIT FORM
            $('#regForm').submit(function(e) {
                e.preventDefault();

                // VALIDATE PASSWORD
                var password = $('#password').val();
                var regexPattern = new RegExp(
                    "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!\"@#\$%\^&\*])(?=.{8,})");

                var result = regexPattern.test(password);

                if (!result) {
                    $('#pwdError').removeClass('d-none');
                    return;
                } else {
                    $('#pwdError').addClass('d-none');
                }

                e.currentTarget.submit();
            });

        });
    </script>
@endsection
