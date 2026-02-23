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
<!-- intl-tel-input CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/css/intlTelInput.css">
<style>
  .iti { width: 100%; display: block; }
</style>
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
<!-- intl-tel-input JS -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/intlTelInput.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // intl-tel-input initialization
    const phoneInput = document.querySelector("#phone");
    if (phoneInput) {
        // Initialize intlTelInput
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "id", // Default to Indonesia
            nationalMode: false,
            autoInsertDialCode: true,
            strictMode: true,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/utils.js",
        });

        let currentDialCode = '';

        const updateDialCode = () => {
            currentDialCode = '+' + iti.getSelectedCountryData().dialCode;
            if (!phoneInput.value.startsWith(currentDialCode)) {
                phoneInput.value = currentDialCode;
            }
        };

        // Ensure dial code is pre-filled on load
        updateDialCode();

        // Keep dial code synced when country changes
        phoneInput.addEventListener('countrychange', updateDialCode);

        // Prevent user from deleting the dial code
        phoneInput.addEventListener('keydown', function(e) {
            // Allow selecting and copying
            if (e.ctrlKey || e.metaKey) return;
            
            const cursorPosition = phoneInput.selectionStart;
            // Block backspace or left arrow if cursor is at the end of the dial code
            if ((e.key === 'Backspace' || e.key === 'ArrowLeft') && cursorPosition <= currentDialCode.length) {
                e.preventDefault();
            }
        });

        // Fallback in case they highlight the whole text and delete or paste over it
        phoneInput.addEventListener('input', function() {
            if (!phoneInput.value.startsWith(currentDialCode)) {
                const digits = phoneInput.value.replace(/\D/g, '');
                const prefixDigits = currentDialCode.replace(/\D/g, '');
                
                if (digits.startsWith(prefixDigits)) {
                     phoneInput.value = currentDialCode + digits.substring(prefixDigits.length);
                } else {
                     phoneInput.value = currentDialCode;
                }
            }
        });

        // Before submitting the form, ensure the full number format is '628XXXXXXXX' without '+' sign
        const form = document.getElementById('formAuthentication');
        if (form) {
            form.addEventListener('submit', function() {
                if (phoneInput.value.trim() !== currentDialCode) {
                    let fullNumber = iti.getNumber();
                    // Strip the + sign prefix to store in DB
                    phoneInput.value = fullNumber.replace('+', '');
                } else {
                    phoneInput.value = ''; // empty if no number entered
                }
            });
        }
    }
});
</script>
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6">
      <!-- Register Card -->
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
          <p class="mb-6">Make your trip management easy and fun!</p>

          <form id="formAuthentication" class="mb-6" action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3 form-control-validation">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your full name"
                value="{{ old('name') }}" required autofocus autocomplete="name" />
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 form-control-validation">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                value="{{ old('phone') }}" required autocomplete="tel" />
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 form-control-validation">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" 
                value="{{ old('email') }}" required autocomplete="username" />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle form-control-validation">
              <label class="form-label" for="password">Password</label>
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

            <div class="mb-3 form-password-toggle form-control-validation">
              <label class="form-label" for="password_confirmation">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password_confirmation" required autocomplete="new-password" />
                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off" style="font-size: 1.25rem;"></i></span>
              </div>
            </div>

            <div class="my-6 form-control-validation">
              <div class="form-check mb-0 ms-2">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal">privacy policy & terms</a>
                </label>
              </div>
            </div>

            <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
          </form>

          <p class="text-center mt-4">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>

<!-- Privacy Policy & Terms Modal -->
<div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="privacyPolicyModalTitle">Privacy Policy & Terms</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>1. Introduction</h6>
        <p>Welcome to Monti Outdoor Service. By registering an account, you agree to comply with and be bound by the following terms and conditions of use.</p>
        
        <h6>2. Data Collection & Privacy</h6>
        <p>We respect your privacy. All personal information collected during registration (including but not limited to your name, email, and phone number) will be used solely for account management, trip bookings, and improving our services.</p>

        <h6>3. Account Security</h6>
        <p>You are responsible for maintaining the confidentiality of your account credentials. Monti Outdoor Service will not be liable for any loss or damage arising from your failure to protect your password.</p>

        <h6>4. Cancellations & Refunds</h6>
        <p>Trip cancellations and refunds are subject to our specific policy outlined on the individual trip booking pages.</p>
        
        <h6>5. Modifications</h6>
        <p>Monti Outdoor Service reserves the right to modify these terms at any time. Continued use of the platform constitutes your acceptance of the revised terms.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
      </div>
    </div>
  </div>
</div>

@endsection
