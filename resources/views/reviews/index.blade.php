@extends('layouts.app')

@section('title', 'Review Wisata - Eksora')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">Review Traveler</h1>
                <p class="lead mb-0">Baca pengalaman nyata dari para traveler yang telah mengunjungi destinasi di Bali</p>
            </div>
            <div class="col-lg-4 text-end">
                <div class="h4 mb-0">{{ number_format($stats['total_reviews']) }}+ Review</div>
                <small>Dari traveler verified</small>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="bg-white p-4 rounded-3 shadow-sm">
            <form method="GET" action="{{ route('reviews.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Destinasi</label>
                        <select class="form-select" name="destination">
                            <option value="">Semua Destinasi</option>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest->id }}" {{ request('destination') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Rating</label>
                        <select class="form-select" name="rating">
                            <option value="">Semua Rating</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 ⭐</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 ⭐</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 ⭐</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 ⭐</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 ⭐</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Urutkan</label>
                        <select class="form-select" name="sort">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="helpful" {{ request('sort') == 'helpful' ? 'selected' : '' }}>Paling Membantu</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Cari Review</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Kata kunci..." name="search" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-4">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <div class="h4 fw-bold text-warning mb-1">{{ $stats['average_rating'] }}</div>
                    <small class="text-muted">Rating Rata-rata</small>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <div class="h4 fw-bold text-success mb-1">{{ $stats['positive_percentage'] }}%</div>
                    <small class="text-muted">Review Positif</small>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <div class="h4 fw-bold text-info mb-1">{{ $stats['monthly_reviews'] }}</div>
                    <small class="text-muted">Review Bulan Ini</small>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <div class="h4 fw-bold text-primary mb-1">{{ $stats['total_reviews'] }}</div>
                    <small class="text-muted">Total Review</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Grid -->
<section class="py-5">
    <div class="container">
        <div class="row" id="reviewsGrid">
            @forelse($reviews as $review)
                @include('partials.review-card', ['review' => $review])
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-chat-dots text-muted" style="font-size: 3rem;"></i>
                    <h5 class="text-muted mt-3">Tidak ada review ditemukan</h5>
                    <p class="text-muted">Coba ubah filter pencarian Anda</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $reviews->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
