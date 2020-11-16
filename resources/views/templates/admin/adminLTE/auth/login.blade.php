@extends('Admin::adminLTE.auth.layout')


@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="/">{{config('app.name')}}</a>
    </div>
    <!-- /.login-logo -->
    <div class="card" style="border-radius: 9px">
        <div class="card-body login-card-body" style="border-radius: 9px !important">
        <p class="login-box-msg">{{__('Sign in to start your session')}}</p>

        <form action="{{ route('login') }}" method="post">

            @csrf

            <div class="input-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mb-3"></div>
            <div class="input-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="mb-3"></div>

            <div class="form-group">

                @if (config('recaptcha.status'))
                    <div class="g-recaptcha" data-sitekey="{{config('recaptcha.site_key')}}"></div>
                    @error('g-recaptcha-response')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                @endif

            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">
                        {{__('Remember Me')}}
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">{{__('Sign In')}}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        {{-- <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="{{route('auth.provider', ['provider' => 'facebook'])}}" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="{{route('auth.provider', ['provider' => 'google'])}}" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
        </div> --}}
        <!-- /.social-auth-links -->

        {{-- <p class="mb-1">
            <a href="{{ route('password.request') }}">{{__('I forgot my password')}}</a>
        </p>
        @if (Route::has('register'))
            <p class="mb-0">
                <a href="{{url('register')}}" class="text-center">{{__('Register a new membership')}}</a>
            </p>
        @endif --}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection