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
                    <div class="col-md-8 pt-5">
                        <div class="forgot-password pt-5">
                            <!-- <img src="{{ url('vendor/images/bg/signup.svg') }}" alt="signup image" class="img-fluid"> -->
                            <img src="{{ asset('/vendor/images/resetPassword/reset.svg') }}" alt="otp image"
                                style="height:400px; width: 400px">
                        </div>
                    </div>

                    <div class="col-md-4 pt-5">
                        <div class="card mt-5 border-0">
                            <div class="card-body login-form-body">
                                <div class="login-heading-top">
                                    <h4 class="card-title mb-4 mt-1 text-center"><b>Reset Password</b></h4>
                                </div>
                                <form action="{{ url('/password/reset/mobile/update-password') }}" method="POST"
                                    id="resetForm">
                                    @csrf
                                    <input type="hidden" name="mobile" value="{{ $mobile }}">

                                    {{-- password --}}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control shadow-none" id="password"
                                                name="password" placeholder="Password" required>
                                        </div>
                                        <small class="text-danger d-none" id="pwdError">The password must contain atleast 1
                                            uppercase, 1 lowercase, once special character and its minimum length should be
                                            atleast 8 characters.</small>
                                    </div>

                                    {{-- password_confirmation --}}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control shadow-none"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="Confirm Password" required>
                                        </div>
                                        <span id='message'></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            {{-- Reset Password --}}
                                            <div class="form-group">
                                                <button type="submit" class="login-btn" id="registerBtn">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </div>
                                </form>

                                <div class="form-group pl-5">
                                    <input class="form-check-input" type="checkbox" onclick="showPassword()"
                                        id="show_password"><label class="form-check-label"></label>Show
                                </div>
                                <div class="col-md-12">
                                    <div class="sign-up-btn">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // CONFIRM PASSWORD
            $('#password, #password_confirmation').on('keyup', function() {

                if ($('#password').val() == $('#password_confirmation').val()) {
                    $('#message').html('Password Matched').css('color', 'green');
                    $('#registerBtn').prop('disabled', false);
                } else {
                    $('#message').html('Password Not Match').css('color', 'red');
                    $('#registerBtn').prop('disabled', true);
                }
            });
        });

        // View password
        function showPassword() {
            var x = document.getElementById("password");
            var y = document.getElementById("password_confirmation");
            // var y = $('#password').html();
            // alert(x);
            if (x.type == 'password' &&
                y.type == 'password') {
                x.type = 'text';
                y.type = 'text';
            } else {
                x.type = 'password';
                y.type = 'password';
            }
        }

        // SUBMIT FORM
        $('#resetForm').submit(function(e) {
            e.preventDefault();
            // VALIDATE PASSWORD
            var password = $('#password').val();
            console.log(password);
            var regexPattern = new RegExp(
                "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

            var result = regexPattern.test(password);

            if (!result) {
                $('#pwdError').removeClass('d-none');
                return;
            } else {
                $('#pwdError').addClass('d-none');
            }
            e.currentTarget.submit();
        });
    </script>
@endsection
