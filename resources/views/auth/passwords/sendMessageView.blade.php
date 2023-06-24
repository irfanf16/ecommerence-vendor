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
                    <div class="col-md-8">
                        <div class="signup-image">
                            <!-- <img src="{{ url('vendor/images/bg/signup.svg') }}" alt="signup image" class="img-fluid"> -->
                            <img src="{{ asset('/vendor/images/resetPassword/forgot-otp.svg') }}" alt="signup image"
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
                            {{-- error message --}}
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="card-body login-form-body">
                                <div class="login-heading-top">
                                    <h4 class="card-title mb-4 mt-1 text-center"><b>Reset Password</b></h4>
                                </div>
                                <form action="{{ url('password/reset/mobile') }}" method="POST" class="login-form">
                                    @csrf
                                    {{-- mobile --}}
                                    <div class="form-group number-with-country">
                                        <div class="input-group">
                                            <select name="countryCode" id="countryCode">
                                                <option data-countryCode="QR" value="+974" Selected>QAR (+974)</option>
                                                <option data-countryCode="PK" value="+92">PAK (+92)</option>
                                            </select>

                                            <input type="number" class="form-control shadow-none" name="mobile" id="mobile"
                                                placeholder="Mobile Number" maxlength="8"
                                                oninput="this.value=this.value.slice(0,this.maxLength)" required>

                                        </div>
                                        <small class="text-danger d-none" id="mobError">Please provide a valid phone
                                            number</small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">

                                            {{-- login button --}}
                                            <div class="form-group">
                                                <button type="submit" class="login-btn" id="registerBtn">
                                                    {{ __('Send Otp') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="sign-up-btn">
                                                <p>Enter your verified number please</p>
                                                <a href="{{ url('vendor/login') }}">Back</a>
                                                <a href="{{ url('/password/reset/email') }}" class="float-right">Via
                                                    Email</a>
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
            } else {
                $(this).next().val('');
                $(this).next().attr('maxlength', 10, 'minlength', 10);
            }

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


    });
</script>
