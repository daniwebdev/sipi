@extends('templates.admin.adminLTE.auth.layout')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>{{env('APP_NAME')}}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{__('You forgot your password?')}}</p>

            <form action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">{{__('Request new password')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{url('login')}}">{{__('Login')}}</a>
            </p>
            @if (Route::has('register'))
                <p class="mb-0">
                    <a href="{{url('register')}}" class="text-center">{{__('Register a new membership')}}</a>
                </p>
            @endif
        </div>
        <!-- /.login-card-body -->
    </div>
</div>    
@endsection