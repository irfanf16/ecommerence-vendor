@extends('auth.master')
@section('title', 'login')

@section('content')
    <!-- Login Header -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <img src="{{ URL::to('/assets/images/storaklogo/logo.PNG') }}" alt="ArrOw" class="h-25 w-25">
                        <strong>Storak</strong> <span>Digital</span>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" action="{{ URL::to('/') }}" method="POST">
                                @csrf
                                {{-- user name --}}
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" name="email"
                                        value="vendor@gmail.com" placeholder="Email">
                                </div>

                                {{-- store name --}}
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="form-control" id="signin-email" name="email"
                                        value="vendor@gmail.com" placeholder="Email">
                                </div>

                                {{-- password --}}
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" name="password"
                                        placeholder="Password">
                                </div>

                                {{-- pssword --}}
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control" id="signin-password" name="password"
                                        placeholder="Password">
                                </div>

                                {{-- login button --}}
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                <div class="bottom">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a
                                            href="auth-forgot-password.html">Forgot password?</a></span>
                                    <span>Don't have an account? <a href="{{ URL::to('/register') }}">Register</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Login Block -->
@endsection
