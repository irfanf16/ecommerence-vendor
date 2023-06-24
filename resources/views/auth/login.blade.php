@extends('layouts.app')
@section('title', 'Login To Your Account')

@section('content')
    <div class="login-background">
        <div class="login-inner-part">
            <div class="container">
                <div class="row">

                    {{-- image div --}}
                    <div class="col-md-8">
                        <div class="login-image">
                            <img src="{{ url('/vendor/images/bg/login1.svg') }}" alt="login image">
                        </div>

                    </div>

                    {{-- Form div --}}
                    <div class="col-md-4 ">
                        <div class="card mt-5 border-0">

                            {{-- Error Messages - Alerts --}}
                            @if (Session::has('error'))
                                @php $error = Session::get('error'); @endphp
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $error }}
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block" id="SuccessAlertMessage">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            <div class="card-body login-form-body">
                                {{-- sign-up --}}

                                <div class="login-heading-top">
                                    <h4 class="card-title mb-4 mt-1 text-center">Login</h4>
                                    <p>To Keep connected with us please login with your personal info</p>
                                </div>

                                <form method="POST" action="{{ url('/vendor/login') }}" class="login-form">

                                    @csrf

                                    {{-- email --}}
                                    <div class="form-group">
                                        <div class="input-group">

                                            <i class="far fa-envelope"></i>

                                            <input type="email" class="form-control shadow-none" name="email" id="email"
                                                placeholder="Email" required autofocus>
                                        </div>
                                    </div>

                                    {{-- password --}}
                                    <div class="form-group">
                                        <div class="input-group">

                                            <i class="fas fa-unlock-alt"></i>

                                            <input id="password" type="password" class="form-control shadow-none"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Password">
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


                                    {{-- login button --}}
                                    <div class="form-group mb-0">
                                        <button type="submit" class="login-btn">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- forgot password --}}
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link float-right margin-0"
                                                    href="{{ url('password/reset/email') }}">
                                                    {{ __('Forgot Password') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="sign-up-btn">
                                                <p>Create your account easy with less information</p>
                                                <a href="{{ url('vendor/register') }}">Sign up</a>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                {{-- <p> --}}
                                {{-- <hr> --}}
                                {{-- google --}}
                                {{-- <a href="{{ route('social.oauth', 'google') }}" class="btn btn-block btn-outline-danger"> <i
                                            class="fab fa-google"></i>   Login via
                                        Google</a> --}}

                                {{-- facebook --}}
                                {{-- <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-block btn-outline-primary">
                                        <i class="fab fa-facebook-f"></i>   Login
                                        via facebook</a> --}}
                                {{-- </p> --}}
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
