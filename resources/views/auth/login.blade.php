@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Login - Monti Outdoor Service')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
<!-- Tabler Icons for password toggle -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Login -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="{{ asset('images/logo/Untitled-4.png') }}" alt="Monti Outdoor" style="height: 60px;">
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Welcome to Monti Outdoor! 👋</h4>
          <p class="mb-6">Please sign-in to your account and start your adventure</p>

          @if(session('status'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('status') }}
            </div>
          @endif

          <form id="formAuthentication" class="mb-4" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-6 form-control-validation">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder="Enter your email" value="{{ old('email') }}" autofocus required autocomplete="username" />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-6 form-password-toggle form-control-validation">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" required autocomplete="current-password" />
                <span id="togglePassword" class="input-group-text cursor-pointer user-select-none" style="cursor: pointer;">
                  <i class="ti tabler-eye-off" style="font-size: 1.25rem;"></i>
                </span>
                @error('password')
                  <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="my-8">
              <div class="d-flex justify-content-between">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember_me" name="remember" />
                  <label class="form-check-label" for="remember_me"> Remember Me </label>
                </div>
                @if (\Illuminate\Support\Facades\Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                    <p class="mb-0">Forgot Password?</p>
                  </a>
                @endif
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
            </div>
          </form>

          <p class="text-center">
            <span>New to Monti Outdoor?</span>
            <a href="{{ route('register') }}">
              <span>Create an account</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>
</div>
@endsection
