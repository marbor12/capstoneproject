@extends('layouts.app')

@section('title', 'Eksora - Temukan Wisata Terbaik di Bali')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="container hero-content">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-white mb-4">
                    Jelajahi Keindahan <span class="text-white">Bali</span>
                </h1>
                <p class="lead text-white mb-5 opacity-90">
                    Temukan destinasi wisata terbaik di Pulau Dewata dengan rekomendasi AI dan review dari traveler lainnya
                </p>
            </div>
        </div>
        
        <!-- Search Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="search-card">
                    <form action="{{ route('search') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-dark">Destinasi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-geo-alt text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" placeholder="Cari tempat wisata..." name="search">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-dark">Kategori</label>
                                <select class="form-select" name="category">
                                    <option value="">Semua Kategori</option>
                                    <option value="pantai">Pantai</option>
                                    <option value="gunung">Gunung</option>
                                    <option value="budaya">Budaya</option>
                                    <option value="kuliner">Kuliner</option>
                                    <option value="adventure">Adventure</option>
                                    <option value="spa">Spa</option>
                                    <option value="family">Family</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold text-dark">Rating Minimum</label>
                                <select class="form-select" name="rating">
                                    <option value="">Semua Rating</option>
                                    <option value="4.5">4.5+ ⭐</option>
                                    <option value="4.0">4.0+ ⭐</option>
                                    <option value="3.5">3.5+ ⭐</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold text-dark">&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.search-card {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(15px);
    border-radius: 16px;
    box-shadow: 0 25px 50px rgba(37, 99, 235, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 2rem;
}
</style>

<!-- Quick Stats -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="h2 fw-bold text-primary mb-1">{{ $stats['total_destinations'] ?? 0 }}+</div>
                <div class="text-muted">Destinasi Wisata</div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="h2 fw-bold text-primary mb-1">{{ $stats['total_reviews'] ?? 0 }}+</div>
                <div class="text-muted">Review Traveler</div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="h2 fw-bold text-primary mb-1">{{ $stats['average_rating'] ?? 0 }}</div>
                <div class="text-muted">Rating Rata-rata</div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="h2 fw-bold text-primary mb-1">24/7</div>
                <div class="text-muted">Customer Support</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Destinations -->
<section class="py-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Destinasi Populer</h2>
            <p class="section-subtitle">Temukan tempat-tempat menakjubkan yang wajib dikunjungi di Bali</p>
        </div>
        
        <div class="row">
            @forelse($featuredDestinations as $destination)
                @include('partials.destination-card', ['destination' => $destination])
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada destinasi yang tersedia.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('destinations.index') }}" class="btn btn-outline-primary btn-lg">
                Lihat Semua Destinasi <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endsection
