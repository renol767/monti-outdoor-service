@extends('layouts/layoutMaster')

@section('title', 'Admin Dashboard - Monti Outdoor Service')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">
            <i class="ti ti-user-shield me-2"></i>Admin Dashboard
          </h4>
          <div class="alert alert-primary" role="alert">
            <h5 class="alert-heading mb-2">Welcome, {{ auth()->user()->name }}!</h5>
            <p class="mb-0">You are logged in as an <strong>Administrator</strong>.</p>
          </div>
          
          <div class="row g-4 mt-3">
            <div class="col-md-4">
              <div class="card bg-label-primary">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="avatar me-3">
                      <span class="avatar-initial rounded bg-label-primary">
                        <i class="ti tabler-users icon-lg"></i>
                      </span>
                    </div>
                    <div>
                      <h5 class="mb-0">User Management</h5>
                      <small>Manage all users</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="card bg-label-success">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="avatar me-3">
                      <span class="avatar-initial rounded bg-label-success">
                        <i class="ti tabler-ticket icon-lg"></i>
                      </span>
                    </div>
                    <div>
                      <h5 class="mb-0">Bookings</h5>
                      <small>View all bookings</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="card bg-label-warning">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="avatar me-3">
                      <span class="avatar-initial rounded bg-label-warning">
                        <i class="ti tabler-settings icon-lg"></i>
                      </span>
                    </div>
                    <div>
                      <h5 class="mb-0">Settings</h5>
                      <small>System configuration</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-6">
            <button onclick="logout()" class="btn btn-danger">
              <i class="ti ti-logout me-2"></i>Logout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
async function logout() {
    const token = localStorage.getItem('token');
    
    try {
        // Logout JWT session
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
    
    // Clear localStorage
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    localStorage.removeItem('role');
    
    // Logout web session
    window.location.href = '/logout-session';
}
</script>
@endsection
