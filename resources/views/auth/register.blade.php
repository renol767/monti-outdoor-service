@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Register - Monti Outdoor Service')

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
    
    // Password toggle functionality
    console.log('[Register] Setting up password toggles');
    const passwordToggles = document.querySelectorAll('.form-password-toggle');
    console.log('[Register] Found password toggles:', passwordToggles.length);
    
    passwordToggles.forEach((toggle, index) => {
        const input = toggle.querySelector('input');
        const icon = toggle.querySelector('.input-group-text');
        
        console.log(`[Register] Toggle ${index}:`, {
            hasInput: !!input,
            hasIcon: !!icon,
            iconHTML: icon ? icon.innerHTML : 'null'
        });
        
        if (!input || !icon) {
            console.error(`[Register] Toggle ${index} is missing input or icon!`);
            return;
        }
        
        icon.addEventListener('click', function() {
            console.log(`[Register] Icon ${index} clicked, current type:`, input.type);
            if (input.type === 'password') {
                input.type = 'text';
                const iconEl = icon.querySelector('i');
                console.log(`[Register] Toggle ${index} - Changing to visible, icon element:`, iconEl);
                console.log(`[Register] Toggle ${index} - Icon classes before:`, iconEl ? iconEl.className : 'null');
                iconEl.classList.remove('tabler-eye-off');
                iconEl.classList.add('tabler-eye');
                console.log(`[Register] Toggle ${index} - Icon classes after:`, iconEl ? iconEl.className : 'null');
            } else {
                input.type = 'password';
                const iconEl = icon.querySelector('i');
                console.log(`[Register] Toggle ${index} - Changing to hidden, icon element:`, iconEl);
                console.log(`[Register] Toggle ${index} - Icon classes before:`, iconEl ? iconEl.className : 'null');
                iconEl.classList.remove('tabler-eye');
                iconEl.classList.add('tabler-eye-off');
                console.log(`[Register] Toggle ${index} - Icon classes after:`, iconEl ? iconEl.className : 'null');
            }
        });
    });
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;
        
        // Clear previous errors
        errorDiv.innerHTML = '';
        errorDiv.style.display = 'none';
        
        try {
            const response = await fetch('/api/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ name, email, password, password_confirmation })
            });
            
            const data = await response.json();
            
            if (response.ok) {
                // Store token and user data
                localStorage.setItem('token', data.access_token);
                localStorage.setItem('user', JSON.stringify(data.user));
                localStorage.setItem('role', data.role);
                
                // Redirect to user dashboard (always user for registration)
                window.location.href = '/user/dashboard';
            } else {
                // Display validation errors
                if (data.email) {
                    errorDiv.innerHTML = data.email.join('<br>');
                } else if (data.password) {
                    errorDiv.innerHTML = data.password.join('<br>');
                } else {
                    errorDiv.textContent = 'Registration failed. Please check your details.';
                }
                errorDiv.style.display = 'block';
            }
        } catch (error) {
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
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-6">
            <a href="{{ url('/') }}" class="app-brand-link">
              <img src="{{ asset('images/logo/Untitled-4.png') }}" alt="Monti Outdoor" style="height: 60px;">
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-1">Adventure starts here 🚀</h4>
          <p class="mb-6">Join Monti Outdoor and start your journey!</p>

          <div id="error-message" class="alert alert-danger" style="display: none;" role="alert"></div>

          <form id="formAuthentication" class="mb-4">
            @csrf
            <div class="mb-6 form-control-validation">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name"
                placeholder="Enter your name" autofocus required />
            </div>
            <div class="mb-6 form-control-validation">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email"
                placeholder="Enter your email" required />
            </div>
            <div class="mb-6 form-password-toggle form-control-validation">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" required />
                <span class="input-group-text cursor-pointer user-select-none" style="cursor: pointer;"><i class="ti tabler-eye-off" style="font-size: 1.25rem;"></i></span>
              </div>
            </div>
            <div class="mb-6 form-password-toggle form-control-validation">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password_confirmation" required />
                <span class="input-group-text cursor-pointer user-select-none" style="cursor: pointer;"><i class="ti tabler-eye-off" style="font-size: 1.25rem;"></i></span>
              </div>
            </div>
            <div class="mb-6">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
            </div>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>
@endsection
