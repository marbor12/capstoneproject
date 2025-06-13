<div class="col-lg-4 col-md-6 mb-4">
    <div class="card destination-card h-100">
        <div class="position-relative">
            @if($destination->is_recommended)
                <div class="recommendation-badge">⭐ Popular</div>
            @endif
            <img src="{{ $destination->image }}" class="card-img-top" alt="{{ $destination->name }}" style="height: 250px; object-fit: cover;">
            <div class="price-tag">{{ $destination->price }}</div>
        </div>
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h5 class="card-title mb-0 fw-semibold">{{ $destination->name }}</h5>
                <span class="category-badge">{{ ucfirst($destination->category) }}</span>
            </div>
            <div class="d-flex align-items-center mb-3">
                <div class="rating-stars me-2">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($destination->average_rating))
                            <i class="bi bi-star-fill"></i>
                        @elseif($i - 0.5 <= $destination->average_rating)
                            <i class="bi bi-star-half"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-muted small fw-medium">{{ number_format($destination->average_rating, 1) }} ({{ $destination->review_count }} review)</span>
            </div>
            <p class="card-text text-muted mb-3">{{ Str::limit($destination->description, 100) }}</p>
            <div class="d-flex gap-2">
                <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-primary btn-sm flex-fill fw-medium">
                    <i class="bi bi-eye me-1"></i> Lihat Detail
                </a>
                <button class="btn btn-outline-primary btn-sm" onclick="addToWishlist({{ $destination->id }})" title="Tambah ke Wishlist">
                    <i class="bi bi-heart"></i>
                </button>
            </div>
        </div>
    </div>
</div>
