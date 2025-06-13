@extends('layouts.app')

@section('title', 'Destinasi Wisata - Eksora')

@section('content')
<!-- Hero Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">Jelajahi Destinasi Bali</h1>
                <p class="lead mb-0">Temukan tempat-tempat menakjubkan di Pulau Dewata</p>
            </div>
            <div class="col-lg-4 text-end">
                <div class="h4 mb-0">{{ $destinations->total() }}+ Destinasi</div>
                <small>Siap untuk dijelajahi</small>
            </div>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="bg-white p-4 rounded-3 shadow-sm">
            <form method="GET" action="{{ route('destinations.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Cari Destinasi</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Nama tempat..." name="search" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" name="category">
                            <option value="">Semua</option>
                            @foreach($categories as $key => $name)
                                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Rating</label>
                        <select class="form-select" name="rating">
                            <option value="">Semua</option>
                            <option value="4.5" {{ request('rating') == '4.5' ? 'selected' : '' }}>4.5+ ⭐</option>
                            <option value="4.0" {{ request('rating') == '4.0' ? 'selected' : '' }}>4.0+ ⭐</option>
                            <option value="3.5" {{ request('rating') == '3.5' ? 'selected' : '' }}>3.5+ ⭐</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Budget</label>
                        <select class="form-select" name="budget">
                            <option value="">Semua</option>
                            <option value="free" {{ request('budget') == 'free' ? 'selected' : '' }}>Gratis</option>
                            <option value="low" {{ request('budget') == 'low' ? 'selected' : '' }}>< 100K</option>
                            <option value="medium" {{ request('budget') == 'medium' ? 'selected' : '' }}>100K - 500K</option>
                            <option value="high" {{ request('budget') == 'high' ? 'selected' : '' }}>> 500K</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Urutkan</label>
                        <select class="form-select" name="sort">
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populer</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Results Info -->
<section class="py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted mb-0">Menampilkan {{ $destinations->count() }} dari {{ $destinations->total() }} destinasi</p>
            @if(request()->hasAny(['search', 'category', 'rating', 'budget']))
                <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-x-circle me-1"></i>Reset Filter
                </a>
            @endif
        </div>
    </div>
</section>

<!-- Destinations Grid -->
<section class="py-5">
    <div class="container">
        <div class="row" id="destinationsGrid">
            @forelse($destinations as $destination)
                @include('partials.destination-card', ['destination' => $destination])
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                    <h5 class="text-muted mt-3">Tidak ada destinasi ditemukan</h5>
                    <p class="text-muted">Coba ubah filter pencarian Anda</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($destinations->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $destinations->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
function addToWishlist(destinationId) {
    alert('Destinasi berhasil ditambahkan ke wishlist!');
}
</script>
@endpush
