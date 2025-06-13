@extends('layouts.app')

@section('title', 'Rekomendasi AI - Eksora')

@section('content')
<section class="py-section">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title">Rekomendasi AI</h1>
            <p class="section-subtitle">Destinasi yang dipersonalisasi berdasarkan preferensi dan riwayat Anda</p>
        </div>
        
        <!-- AI Features -->
        <div class="row mb-5">
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="feature-icon">
                        <i class="bi bi-robot"></i>
                    </div>
                    <h5 class="fw-semibold">AI-Powered</h5>
                    <p class="text-muted">Algoritma machine learning yang menganalisis preferensi dan memberikan rekomendasi personal</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="feature-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h5 class="fw-semibold">Personalisasi</h5>
                    <p class="text-muted">Rekomendasi berdasarkan riwayat pencarian, rating, dan aktivitas favorit Anda</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h5 class="fw-semibold">Real-time Update</h5>
                    <p class="text-muted">Data yang selalu terbaru dari review dan rating terkini dari komunitas traveler</p>
                </div>
            </div>
        </div>

        <!-- Preference Settings -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="bg-white p-5 rounded-3 shadow-sm">
                    <h5 class="fw-semibold mb-4 text-center">
                        <i class="bi bi-sliders me-2"></i>Sesuaikan Preferensi Anda
                    </h5>
                    <form action="{{ route('recommendations.preferences.update') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <!-- Tipe Perjalanan -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-people me-2"></i>Tipe Perjalanan
                                </label>
                                <div class="d-flex flex-wrap gap-2">
                                    <input type="radio" class="btn-check" name="travel_type" id="travel-solo" value="solo" {{ ($preferences['travel_type'] ?? '') == 'solo' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="travel-solo">
                                        <i class="bi bi-person me-1"></i>Solo Travel
                                    </label>
                                    
                                    <input type="radio" class="btn-check" name="travel_type" id="travel-couple" value="couple" {{ ($preferences['travel_type'] ?? '') == 'couple' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="travel-couple">
                                        <i class="bi bi-heart me-1"></i>Couple
                                    </label>
                                    
                                    <input type="radio" class="btn-check" name="travel_type" id="travel-family" value="family" {{ ($preferences['travel_type'] ?? '') == 'family' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="travel-family">
                                        <i class="bi bi-house me-1"></i>Family
                                    </label>
                                    
                                    <input type="radio" class="btn-check" name="travel_type" id="travel-friends" value="friends" {{ ($preferences['travel_type'] ?? '') == 'friends' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="travel-friends">
                                        <i class="bi bi-people-fill me-1"></i>Friends
                                    </label>
                                </div>
                            </div>

                            <!-- Bulan Kunjungan -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-calendar me-2"></i>Bulan Kunjungan
                                </label>
                                <select class="form-select" name="visit_month">
                                    <option value="">Pilih Bulan</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ ($preferences['visit_month'] ?? '') == $i ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Kategori Favorit -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-star me-2"></i>Kategori Favorit
                                </label>
                                <div class="d-flex flex-wrap gap-2">
                                    @php
                                        $categories = ['pantai' => 'Pantai', 'gunung' => 'Gunung', 'budaya' => 'Budaya', 'kuliner' => 'Kuliner', 'adventure' => 'Adventure', 'spa' => 'Spa', 'family' => 'Family'];
                                    @endphp
                                    @foreach($categories as $key => $name)
                                        <input type="checkbox" class="btn-check" name="categories[]" id="pref-{{ $key }}" value="{{ $key }}" {{ in_array($key, $preferences['categories'] ?? []) ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary btn-sm" for="pref-{{ $key }}">{{ $name }}</label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Budget Range -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-wallet me-2"></i>Budget Range
                                </label>
                                <select class="form-select" name="budget">
                                    <option value="">Semua Budget</option>
                                    <option value="free" {{ ($preferences['budget'] ?? '') == 'free' ? 'selected' : '' }}>Gratis</option>
                                    <option value="low" {{ ($preferences['budget'] ?? '') == 'low' ? 'selected' : '' }}>< Rp 100.000</option>
                                    <option value="medium" {{ ($preferences['budget'] ?? '') == 'medium' ? 'selected' : '' }}>Rp 100.000 - 500.000</option>
                                    <option value="high" {{ ($preferences['budget'] ?? '') == 'high' ? 'selected' : '' }}>> Rp 500.000</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-magic me-2"></i>Update Rekomendasi AI
                                </button>
                                <a href="{{ route('recommendations.preferences.reset') }}" class="btn btn-outline-secondary btn-lg px-4 ms-3" onclick="event.preventDefault(); document.getElementById('reset-form').submit();">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>
                    
                    <form id="reset-form" action="{{ route('recommendations.preferences.reset') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        
        <!-- AI Recommendations -->
        <div class="row">
            @if(!empty($preferences))
                <div class="col-12 mb-5">
                    <div class="alert alert-primary border-0 shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-robot me-3 fs-4"></i>
                            <div>
                                <h6 class="alert-heading mb-1">Rekomendasi Personal untuk Anda</h6>
                                <p class="mb-0">Berdasarkan preferensi Anda, berikut adalah destinasi yang mungkin Anda sukai</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @forelse($recommendations as $destination)
                @include('partials.destination-card', ['destination' => $destination])
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-robot text-muted" style="font-size: 3rem;"></i>
                    <h5 class="text-muted mt-3">Belum ada rekomendasi</h5>
                    <p class="text-muted">Atur preferensi Anda untuk mendapatkan rekomendasi personal</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    margin: 0 auto 1.5rem;
}
</style>
@endsection
