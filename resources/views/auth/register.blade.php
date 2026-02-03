@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-md-6">
        <div class="card auth-card">
            <div class="auth-header">
                <h4 class="mb-0">{{ __('Create Account') }}</h4>
                <small class="text-muted">Join the Interview Management System</small>
            </div>

            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label text-muted small fw-bold">{{ __('Full Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="John Doe">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label text-muted small fw-bold">{{ __('Email Address') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="john@example.com">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small fw-bold">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label text-muted small fw-bold">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-auth w-100 mb-3">
                        {{ __('Register Now') }}
                    </button>

                    <p class="text-center small text-muted">
                        Already registered? <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Log in here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection