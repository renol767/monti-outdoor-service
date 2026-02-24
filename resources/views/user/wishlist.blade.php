@extends('layouts/layoutMaster')

@section('title', 'My Wishlist - Monti Outdoor Service')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">User /</span> My Wishlist</h4>

<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header border-bottom">Trip Impian Anda</h5>
            <div class="card-body mt-4">

                @if($wishlists->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="ti tabler-heart text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="mb-2">Belum ada trip impian</h5>
                        <p class="text-muted mb-4">Anda belum menambahkan trip apapun ke daftar keinginan Anda.</p>
                        <a href="{{ route('open-trip') }}" class="btn btn-primary">Eksplorasi Trip</a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($wishlists as $wishlist)
                            @php
                                $trip = $wishlist->tripTemplate;
                                // Need to fetch next departure for price/date info if available
                                $nextDeparture = $trip->departures()
                                    ->whereIn('status', ['available', 'limited'])
                                    ->where('start_date', '>=', now()->toDateString())
                                    ->orderBy('start_date')
                                    ->first();
                                    
                                $fromPrice = $trip->from_price; // Assuming we use getFromPriceAttribute() from TripTemplate, wait, it requires $this->next_departure. The accessor in TripTemplate handles it.
                                $priceDisplay = $fromPrice ? 'IDR ' . number_format($fromPrice, 0, ',', '.') : 'Contact us';
                                $durationDisplay = $trip->duration_days . 'D' . $trip->duration_nights . 'N';
                            @endphp
                            
                            <!-- Wishlist Card (Styled similarly to frontend open-trip) -->
                            <div class="col-12 col-md-6 col-lg-4 wishlist-item" id="wishlist-item-{{ $trip->id }}">
                                <div class="card h-100 shadow-sm border-0" style="overflow: hidden; border-radius: 12px; transition: transform 0.3s ease;">
                                    <div class="position-relative">
                                        <a href="{{ route('trip.detail', $trip->slug) }}">
                                            <img src="{{ asset($trip->thumbnail) }}" class="card-img-top object-fit-cover" alt="{{ $trip->title }}" style="height: 250px;">
                                        </a>
                                        <!-- Remove Heart Button -->
                                        <button class="btn btn-icon btn-danger rounded-circle position-absolute top-0 end-0 m-3 shadow remove-wishlist-btn" 
                                                data-trip-id="{{ $trip->id }}" 
                                                title="Hapus dari Wishlist">
                                            <i class="ti tabler-heart-broken"></i>
                                        </button>
                                        <div class="position-absolute bottom-0 start-0 m-3 px-2 py-1 bg-dark bg-opacity-75 text-white rounded small">
                                            {{ $durationDisplay }}
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <h5 class="card-title mb-1 text-truncate" title="{{ $trip->title }}">
                                            <a href="{{ route('trip.detail', $trip->slug) }}" class="text-body fw-bold">
                                                {{ $trip->title }}
                                            </a>
                                        </h5>
                                        <p class="card-text small text-muted mb-3"><i class="ti tabler-map-pin me-1"></i>{{ $trip->destination }}</p>
                                        
                                        <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3">
                                            <div>
                                                <small class="text-muted d-block">From</small>
                                                <span class="text-primary fw-bold">{{ $priceDisplay }}</span>
                                            </div>
                                            <a href="{{ route('trip.detail', $trip->slug) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const removeBtns = document.querySelectorAll('.remove-wishlist-btn');

    removeBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const tripId = this.getAttribute('data-trip-id');
            const itemElement = document.getElementById('wishlist-item-' + tripId);
            
            // Disable button during req
            this.disabled = true;

            // Send AJAX
            fetch('{{ route("user.wishlist.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    trip_template_id: tripId
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'removed') {
                    // Remove from DOM
                    itemElement.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    itemElement.style.opacity = '0';
                    itemElement.style.transform = 'scale(0.9)';
                    
                    setTimeout(() => {
                        itemElement.remove();
                        // Check if list is empty now
                        const remainingItems = document.querySelectorAll('.wishlist-item');
                        if(remainingItems.length === 0) {
                            location.reload(); // Reload to show empty state
                        }
                    }, 300);
                    
                    // Show toast (if toaster available in layout layer)
                    if(typeof toastr !== 'undefined') {
                         toastr.success('Trip dihapus dari wishlist');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.disabled = false;
            });
        });
    });
});
</script>
@endsection
