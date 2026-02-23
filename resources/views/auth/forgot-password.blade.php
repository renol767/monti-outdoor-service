@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Forgot Password - Monti Outdoor Service')

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Forgot Password Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="{{ asset('images/logo/Untitled-4.png') }}" alt="Monti Outdoor" style="height: 60px;">
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Forgot Password? 🔒</h4>
          <p class="mb-6 text-muted">
            Enter your email and we'll send you instructions to reset your password
          </p>

          <!-- Session Status -->
          @if (session('status'))
            <div class="alert alert-success mb-4" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form id="formAuthentication" class="mb-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" autofocus required value="{{ old('email') }}" />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button class="btn btn-primary d-grid w-100" type="submit">
              Send Reset Link
            </button>
          </form>

          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
              <i class="ti tabler-chevron-left scaleX-n1-rtl me-1-5"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password Card -->
    </div>
  </div>
</div>
@endsection
