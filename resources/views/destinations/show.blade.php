@extends('layouts.app')

@section('title', $destination->name . ' - Eksora')

@section('content')
<section class="py-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-4">
                    <button class="btn btn-outline-primary mb-3" onclick="history.back()">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                    <img src="{{ $destination->image }}" class="img-fluid rounded-3 w-100" style="height: 400px; object-fit: cover;" alt="{{ $destination->name }}">
                </div>
                
                <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h2 fw-bold mb-2">{{ $destination->name }}</h1>
                            <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> {{ $destination->location }}</p>
                            <div class="d-flex align-items-center">
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
                                <span class="fw-medium">{{ number_format($destination->average_rating, 1) }} ({{ $destination->review_count }} review)</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="h4 fw-bold text-primary mb-2">{{ $destination->price }}</div>
                            <span class="category-badge">{{ ucfirst($destination->category) }}</span>
                        </div>
                    </div>
                    
                    <p class="text-muted mb-4">{{ $destination->description }}</p>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-semibold mb-3">Fasilitas:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($destination->facilities as $facility)
                                    <span class="badge bg-light text-dark border px-3 py-2">{{ $facility }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-semibold mb-3">Informasi:</h6>
                            <p class="mb-1"><strong>Jam Buka:</strong> {{ $destination->open_hours }}</p>
                            <p class="mb-0"><strong>Waktu Terbaik:</strong> {{ $destination->best_time }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3">
                        <button class="btn btn-primary flex-fill" onclick="alert('Fitur booking akan segera tersedia!')">
                            <i class="bi bi-calendar-check me-2"></i>Book Sekarang
                        </button>
                        <button class="btn btn-outline-primary" onclick="addToWishlist({{ $destination->id }})">
                            <i class="bi bi-heart me-2"></i>Wishlist
                        </button>
                        <button class="btn btn-outline-secondary" onclick="shareDestination()">
                            <i class="bi bi-share me-2"></i>Share
                        </button>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div class="bg-white p-4 rounded-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-semibold mb-0">Review ({{ $destination->review_count }})</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reviewModal">
                            <i class="bi bi-plus me-1"></i>Tulis Review
                        </button>
                    </div>
                    
                    @forelse($destination->reviews as $review)
                        <div class="review-card mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3" width="50" height="50" alt="{{ $review->user_name }}">
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ $review->user_name }}</h6>
                                    <small class="text-muted">{{ $review->review_date->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-muted mb-3">"{{ $review->review_text }}"</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-sm btn-outline-primary fw-medium" onclick="likeReview({{ $review->id }})">
                                    <i class="bi bi-hand-thumbs-up me-1"></i> Helpful ({{ $review->helpful_count }})
                                </button>
                                <span class="badge bg-light text-dark">{{ ucfirst($review->travel_type) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-chat-dots text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3">Belum ada review untuk destinasi ini</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                Jadilah yang pertama menulis review
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-white p-4 rounded-3 shadow-sm sticky-top" style="top: 100px;">
                    <h6 class="fw-semibold mb-3">Destinasi Serupa</h6>
                    @foreach($relatedDestinations as $related)
                        <div class="d-flex mb-3 cursor-pointer" onclick="window.location.href='{{ route('destinations.show', $related->slug) }}'">
                            <img src="{{ $related->image }}" class="rounded me-3" width="80" height="60" style="object-fit: cover;" alt="{{ $related->name }}">
                            <div>
                                <h6 class="mb-1 fw-semibold">{{ $related->name }}</h6>
                                <div class="rating-stars small mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($related->average_rating))
                                            <i class="bi bi-star-fill"></i>
                                        @elseif($i - 0.5 <= $related->average_rating)
                                            <i class="bi bi-star-half"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <small class="text-primary fw-semibold">{{ $related->price }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tulis Review untuk {{ $destination->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="user_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select class="form-select" name="rating" required>
                            <option value="">Pilih Rating</option>
                            <option value="5">5 - Sangat Bagus</option>
                            <option value="4">4 - Bagus</option>
                            <option value="3">3 - Cukup</option>
                            <option value="2">2 - Kurang</option>
                            <option value="1">1 - Sangat Kurang</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Perjalanan</label>
                        <select class="form-select" name="travel_type" required>
                            <option value="">Pilih Tipe</option>
                            <option value="solo">Solo</option>
                            <option value="couple">Couple</option>
                            <option value="family">Family</option>
                            <option value="friends">Friends</option>
                            <option value="business">Business</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Review</label>
                        <textarea class="form-control" name="review_text" rows="4" required placeholder="Ceritakan pengalaman Anda..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function addToWishlist(destinationId) {
    alert('Destinasi berhasil ditambahkan ke wishlist!');
}

function shareDestination() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $destination->name }} - Eksora',
            text: '{{ $destination->description }}',
            url: window.location.href,
        });
    } else {
        alert('Bagikan: {{ $destination->name }}\n{{ $destination->description }}');
    }
}

function likeReview(reviewId) {
    fetch(`/reviews/${reviewId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        alert('Review telah di-like!');
        location.reload();
    });
}
</script>
@endpush
