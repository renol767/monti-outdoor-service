@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Verify Email - Monti Outdoor Service')

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Verify Email Card -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="{{ asset('images/logo/Untitled-4.png') }}" alt="Monti Outdoor" style="height: 60px;">
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Verify your email ✉️</h4>
          <p class="mb-6 text-muted">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
          </p>

          @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success mb-4 text-center" role="alert">
              {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
          @endif

          <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-primary d-grid w-100">
              {{ __('Resend Verification Email') }}
            </button>
          </form>

          <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="btn btn-link text-danger">
              <i class="ti tabler-logout me-1"></i> {{ __('Log Out') }}
            </button>
          </form>
        </div>
      </div>
      <!-- /Verify Email Card -->
    </div>
  </div>
</div>
@endsection
