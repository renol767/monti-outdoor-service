@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Reset Password - Monti Outdoor Service')

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
<!-- Tabler Icons for password toggle -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
@endsection

@section('page-script')
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Reset Password Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="{{ asset('images/logo/Untitled-4.png') }}" alt="Monti Outdoor" style="height: 60px;">
            </a>
          </div>
@php
            $isInvalidTokenPost = $errors->has('email') && \Illuminate\Support\Str::contains(strtolower($errors->first('email')), 'token');
            $showInvalidState = (isset($isValidToken) && !$isValidToken) || $isInvalidTokenPost;
          @endphp

          @if($showInvalidState)
            <div class="text-center mb-6">
              <div class="mb-4">
                <i class="ti tabler-alert-triangle text-danger" style="font-size: 4rem;"></i>
              </div>
              <h4 class="mb-2">Invalid or Expired Link</h4>
              <p class="mb-4 text-muted">
                {{ $errors->has('email') ? $errors->first('email') : 'This password reset token is invalid or has already been used.' }}
              </p>
              <a href="{{ route('password.request') }}" class="btn btn-primary d-grid w-100 mb-3">
                Request New Reset Link
              </a>
              <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="ti tabler-chevron-left scaleX-n1-rtl me-1-5"></i>
                Back to login
              </a>
            </div>
          @else
            <h4 class="mb-1">Reset Password 🔒</h4>
            <p class="mb-6 text-muted">
              Enter your new password below.
            </p>

            <form id="formAuthentication" class="mb-6" action="{{ route('password.store') }}" method="POST">
              @csrf

              <!-- Password Reset Token -->
              <input type="hidden" name="token" value="{{ $request->route('token') }}">

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" readonly />
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">New Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" required autocomplete="new-password" />
                  <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off" style="font-size: 1.25rem;"></i></span>
                  @error('password')
                    <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password_confirmation" required autocomplete="new-password" />
                  <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off" style="font-size: 1.25rem;"></i></span>
                </div>
              </div>

              <button class="btn btn-primary d-grid w-100" type="submit">
                Reset Password
              </button>
            </form>
          @endif
        </div>
      </div>
      <!-- /Reset Password Card -->
    </div>
  </div>
</div>
@endsection
