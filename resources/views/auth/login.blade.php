@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-md-5">
        <div class="card auth-card">
            <div class="auth-header">
                <h4 class="mb-0">{{ __('Welcome Back') }}</h4>
                <small class="text-muted">Log in to your Interview Portal</small>
            </div>

            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label text-muted small uppercase fw-bold">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="name@company.com">
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-muted small uppercase fw-bold">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="••••••••">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="small text-decoration-none" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary btn-auth w-100 mb-3">
                        {{ __('Sign In') }}
                    </button>
                    
                    <p class="text-center small text-muted">
                        Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Create one</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection