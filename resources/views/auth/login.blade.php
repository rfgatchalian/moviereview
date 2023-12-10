@extends('layouts.app')
@section('styles')
<style>
    /* For log in buttons */
    .login-buttons-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    .google-login-button,
    .facebook-login-button {
        width: 40px;
        height: 40px;
        margin: 5px;
        cursor: pointer;
    }

    /* Google Login Button Styles */
    .google-login-button {
        background: url('https://www.salesforceben.com/wp-content/uploads/2021/03/google-logo-icon-PNG-Transparent-Background-2048x2048.png') no-repeat center center;
        background-size: contain;
        /* Ensure the entire image is visible within the button */
    }

    /* Facebook Login Button Styles */
    .facebook-login-button {
        background: url('https://logodownload.org/wp-content/uploads/2014/09/facebook-logo-1-2.png') no-repeat center center;
        background-size: contain;
        /* Ensure the entire image is visible within the button */
        border: none;
    }

    /* Optionally, add hover styles */
    .google-login-button:hover,
    .facebook-login-button:hover {
        opacity: 0.8;
    }
</style>
<link rel="stylesheet" href="{{ asset('users/assets/css/login.css')}}">
@endsection
@section('content')
<div class="main-container px-5" style="margin-top: 110px; margin-bottom: 100px">
    <div class="container form-container">
        <h2 class="mb-0">Welcome!</h2>
        <p class="login-here mt-0">Don't have an account yet? <a class="hove" href="{{route('register')}}">Create account here</a></p>
        <form method="post" action="#">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required="" value="">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required="" value="">
                </div>
            <button type="submit" name="login" class="custom-btn">Log In</button>
        </form>
        <p style="font-size: 0.9rem; font-family: system-ui; font-weight: 100; color: #ffffff; text-align: center"><br>OR<br>Log In with<br></p>
        <div class="login-buttons-container">
            <a href="{{route('login.google')}}" class="google-login-button"></a>;
            <a href="{{route('login.facebook')}}" class="facebook-login-button"></a>
        </div>
    </div>
</div>
{{-- <div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="{{ route('admin.home') }}">
                {{ trans('panel.site_title') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                {{ trans('global.login') }}
            </p>

            @if(session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            @if(Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">
                        {{ trans('global.forgot_password') }}
                    </a>
                </p>
            @endif
            <p class="mb-1">
                <a class="text-center" href="{{ route('register') }}">
                    {{ trans('global.register') }}
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div> --}}
@endsection
