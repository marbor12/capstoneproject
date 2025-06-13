<div class="col-lg-4 col-md-6 mb-4">
    <div class="review-card h-100">
        <div class="d-flex align-items-center mb-3">
            <img src="/placeholder.svg?height=50&width=50" class="rounded-circle me-3" width="50" height="50" alt="{{ $review->user_name }}">
            <div>
                <h6 class="mb-0 fw-semibold">{{ $review->user_name }}</h6>
                <small class="text-muted">{{ $review->review_date->diffForHumans() }}</small>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="text-primary mb-0 fw-semibold">{{ $review->destination->name }}</h6>
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
        <p class="text-muted mb-3">"{{ Str::limit($review->review_text, 150) }}"</p>
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-sm btn-outline-primary fw-medium" onclick="likeReview({{ $review->id }})">
                <i class="bi bi-hand-thumbs-up me-1"></i> Helpful ({{ $review->helpful_count }})
            </button>
            <span class="badge bg-light text-dark">{{ ucfirst($review->travel_type) }}</span>
        </div>
    </div>
</div>

