@extends('auth.master')
@section('title', 'Reset')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-lg-5">
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

                {{-- card --}}
                <div class="card">
                    <div class="card-header light">Reset Password</div>
                    <div class="card-body">
                        <form action="{{ url('verify-otp') }}" method="POST">
                            @csrf

                            {{-- mobile --}}
                            <div class="form-group row">
                                <label for="mobile"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="string"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ $phone_number }}" readonly>

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- otp --}}
                            <div class="form-group row">
                                <label for="otp"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mobile OTP ') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile_otp" type="string"
                                        class="form-control @error('mobile_otp') is-invalid @enderror" name="mobile_otp"
                                        required autofocus>

                                    @error('mobile_otp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm OTP') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    $("#alertCloseBtn").click(function(e) {
        e.preventDefault();
        $("#alertBox").hide();
    });
</script>
