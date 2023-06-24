@extends('auth.master')
@section('title', 'Reset')
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

        <div class="row justify-content-center">
            <div class="col-md-8 mt-lg-5">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block" id="SuccessAlertMessage">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header light">Reset Password</div>
                    <div class="card-body">
                        <form action="{{ url('sendMessageOtp') }}" method="POST">
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Mobile OTP ') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#alertCloseBtn").click(function(e) {
            e.preventDefault();
            $("#alertBox").hide();
        });
    </script>
@endsection
