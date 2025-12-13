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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formAuthentication');
    const errorDiv = document.getElementById('error-message');
    
    const passwordToggles = document.querySelectorAll('.form-password-toggle');
    
    passwordToggles.forEach((toggle, index) => {
        const input = toggle.querySelector('#password');
        const icon = toggle.querySelector('togglePassword');

        if (!input || !icon) return;

        icon.addEventListener('click', () => {
          const iconEl = icon.querySelector('i');

          if (input.type === 'password') {
            input.type = 'text';
            iconEl.classList.remove('tabler-eye-off');
            iconEl.classList.add('tabler-eye');
          } else {
            input.type = 'password';
            iconEl.classList.remove('tabler-eye');
            iconEl.classList.add('tabler-eye-off');
          }
        });
    });
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        errorDiv.style.display = 'none';
        errorDiv.textContent = '';
        
        try {
            const response = await fetch('/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                credentials: 'same-origin',
                body: JSON.stringify({ email, password })
            });
            
            const data = await response.json();
            
            if (response.ok) {
                // Store token and user data for API calls
                localStorage.setItem('token', data.access_token);
                localStorage.setItem('user', JSON.stringify(data.user));
                localStorage.setItem('role', data.role);
                
                // Now login for session (web auth)
                const sessionResponse = await fetch('/login-session', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ email, password })
                });
                
                if (sessionResponse.ok) {
                    // Redirect based on role
                    if (data.role === 'admin') {
                        window.location.href = '/admin/dashboard';
                    } else {
                        window.location.href = '/user/dashboard';
                    }
                } else {
                    errorDiv.textContent = 'Session creation failed';
                    errorDiv.style.display = 'block';
                }
            } else {
                errorDiv.textContent = data.error || 'Invalid credentials';
                errorDiv.style.display = 'block';
            }
        } catch (error) {
            console.error('Login error:', error);
            errorDiv.textContent = 'An error occurred. Please try again.';
            errorDiv.style.display = 'block';
        }
    });
});
</script>
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

          <div id="error-message" class="alert alert-danger" style="display: none;" role="alert"></div>

          <form id="formAuthentication" class="mb-4">
            @csrf
            <div class="mb-6 form-control-validation">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email"
                placeholder="Enter your email" autofocus required />
            </div>
            <div class="mb-6 form-password-toggle form-control-validation">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" required />
                <span id="togglePassword" class="input-group-text cursor-pointer user-select-none" style="cursor: pointer;">
                  <i class="ti tabler-eye-off" style="font-size: 1.25rem;"></i>
                </span>
              </div>
            </div>
            <div class="my-8">
              <div class="d-flex justify-content-between">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
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
