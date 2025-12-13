@extends('layouts/layoutMaster')

@section('title', 'User Dashboard - Monti Outdoor Service')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">
            <i class="ti ti-mountain me-2"></i>My Dashboard
          </h4>
          <div class="alert alert-success" role="alert">
            <h5 class="alert-heading mb-2">Welcome, {{ auth()->user()->name }}!</h5>
            <p class="mb-0">Ready for your next adventure?</p>
          </div>
          
          <div class="row g-4 mt-3">
            <div class="col-md-4">
              <div class="card bg-label-primary">
                <div class="card-body text-center">
                  <div class="avatar avatar-xl mx-auto mb-3">
                    <span class="avatar-initial rounded-circle bg-label-primary">
                      <i class="ti ti-ticket ti-xl"></i>
                    </span>
                  </div>
                  <h5 class="mb-1">My Bookings</h5>
                  <p class="mb-0 small">View  your upcoming trips</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="card bg-label-success">
                <div class="card-body text-center">
                  <div class="avatar avatar-xl mx-auto mb-3">
                    <span class="avatar-initial rounded-circle bg-label-success">
                      <i class="ti ti-calendar ti-xl"></i>
                    </span>
                  </div>
                  <h5 class="mb-1">Book a Trip</h5>
                  <p class="mb-0 small">Explore new adventures</p>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="card bg-label-warning">
                <div class="card-body text-center">
                  <div class="avatar avatar-xl mx-auto mb-3">
                    <span class="avatar-initial rounded-circle bg-label-warning">
                      <i class="ti ti-user ti-xl"></i>
                    </span>
                  </div>
                  <h5 class="mb-1">My Profile</h5>
                  <p class="mb-0 small">Update your information</p>
                </div>
              </div>
            </div>
          </div>

          <div class="card mt-6">
            <div class="card-body">
              <h5 class="card-title mb-3">Recent Activity</h5>
              <div class="text-center text-muted py-4">
                <i class="ti ti-inbox ti-xl mb-3"></i>
                <p>No recent activity</p>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <button onclick="logout()" class="btn btn-outline-danger">
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
