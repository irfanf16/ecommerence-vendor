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

                {{-- error message --}}
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif


                {{-- card --}}
                <div class="card">
                    <div class="card-header light">Reset Password</div>
                    <div class="card-body">
                        <form action="{{ url('/updatePassword') }}" method="POST">
                            @csrf

                            <input type="hidden" name="mobile" value="{{ $mobile }}">
                            {{-- password --}}
                            <div class="form-group">
                                <div class="input-group">
                                    <i class="fas fa-unlock-alt"></i>
                                    <input type="password" class="form-control shadow-none" id="password" name="password"
                                        placeholder="Password" required>
                                </div>
                                <small class="text-danger d-none" id="pwdError">The password must contain atleast 1
                                    uppercase, 1 lowercase, once special character and its minimum length should be
                                    atleast 8 characters.</small>
                            </div>
                            {{-- confirm password --}}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-check"></i> </span>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control shadow-none"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="password confirmation">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Set Password') }}
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
