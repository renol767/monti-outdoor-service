@extends('layouts/layoutMaster')

@section('title', 'Profil Pengguna - Monti Outdoor Service')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Akun /</span> Profil Pengguna
</h4>

@if (session('status') === 'profile-updated')
    <div class="alert alert-success mt-2">
        Data profil berhasil diperbarui!
    </div>
@endif

@if (session('status') === 'password-updated')
    <div class="alert alert-success mt-2">
        Kata sandi berhasil diperbarui!
    </div>
@endif

<div class="row">
    <!-- Informasi Profil -->
    <div class="col-xl-8 col-lg-7 col-md-7 border-end">
        <div class="card mb-4">
            <h5 class="card-header">Detail Profil</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                        @else
                            <div class="avatar avatar-xl">
                                <span class="avatar-initial rounded bg-label-primary fs-3">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </span>
                            </div>
                        @endif
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                <span class="d-none d-sm-block">Unggah Foto Baru</span>
                                <i class="ti tabler-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image/png, image/jpeg">
                            </label>
                            <div class="text-muted">Format yang diizinkan JPG, GIF, atau PNG. Ukuran maksimal 2MB.</div>
                            @error('avatar')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-2 g-4">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" autofocus required>
                            @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Nomor Telepon / WhatsApp</label>
                            <input class="form-control" type="text" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="+62 8xx xxx xxx">
                            @error('phone')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap Anda">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <h6 class="mt-4 mb-3 border-bottom pb-2">Kontak Darurat (Opsional)</h6>
                    <div class="row g-4 mb-3">
                        <div class="col-md-4 mb-3">
                            <label for="emergency_name" class="form-label">Nama Kontak Darurat</label>
                            <input class="form-control" type="text" id="emergency_name" name="emergency_name" value="{{ old('emergency_name', auth()->user()->emergency_name) }}">
                            @error('emergency_name')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="emergency_phone" class="form-label">No. Telepon Darurat</label>
                            <input class="form-control" type="text" id="emergency_phone" name="emergency_phone" value="{{ old('emergency_phone', auth()->user()->emergency_phone) }}">
                            @error('emergency_phone')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="emergency_relation" class="form-label">Hubungan</label>
                            <input class="form-control" type="text" id="emergency_relation" name="emergency_relation" value="{{ old('emergency_relation', auth()->user()->emergency_relation) }}" placeholder="cth: Istri, Anak, Kakak">
                            @error('emergency_relation')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ubah Kata Sandi -->
    <div class="col-xl-4 col-lg-5 col-md-5">
        <div class="card mb-4">
            <h5 class="card-header">Ubah Kata Sandi</h5>
            <div class="card-body">
                <form id="formAccountSettings" method="POST" action="{{ route('user.password.update') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 mb-2 form-password-toggle">
                            <label class="form-label" for="currentPassword">Kata Sandi Saat Ini</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" name="current_password" id="currentPassword" placeholder="············" />
                                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
                            </div>
                            @error('current_password', 'updatePassword')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2 form-password-toggle">
                            <label class="form-label" for="newPassword">Kata Sandi Baru</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" id="newPassword" name="password" placeholder="············" />
                                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
                            </div>
                            @error('password', 'updatePassword')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3 form-password-toggle">
                            <label class="form-label" for="confirmPassword">Konfirmasi Kata Sandi Baru</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" name="password_confirmation" id="confirmPassword" placeholder="············" />
                                <span class="input-group-text cursor-pointer"><i class="ti tabler-eye-off"></i></span>
                            </div>
                        </div>

                        <div class="col-12 mt-1">
                            <button type="submit" class="btn btn-primary w-100">Perbarui Kata Sandi</button>
                        </div>
                        
                        <div class="col-12 mt-3 text-center border-top pt-4">
                            <button onclick="logout()" type="button" class="btn btn-danger w-100">
                                <i class="ti tabler-logout me-2"></i>Keluar Akun
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
async function logout() {
    const token = localStorage.getItem('token');
    
    try {
        if (token) {
            await fetch('/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });
        }
    } catch (error) {
        console.error('JWT Logout error:', error);
    }
    
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('role');
    
    window.location.href = '/logout-session';
}

// Live avatar preview on file select
document.getElementById('upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        // If there's an existing <img#uploadedAvatar>, update it
        let img = document.getElementById('uploadedAvatar');
        if (img) {
            img.src = ev.target.result;
        } else {
            // Replace the initials avatar div with an img
            const avatarDiv = document.querySelector('.avatar.avatar-xl');
            if (avatarDiv) {
                const newImg = document.createElement('img');
                newImg.id = 'uploadedAvatar';
                newImg.src = ev.target.result;
                newImg.alt = 'user-avatar';
                newImg.className = 'd-block w-px-100 h-px-100 rounded';
                avatarDiv.replaceWith(newImg);
            }
        }
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
