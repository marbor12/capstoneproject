@extends('layouts.app')

@section('title', 'Masuk - Eksora')

@section('content')
<section class="py-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="bg-white p-5 rounded-3 shadow">
                    <div class="text-center mb-4">
                        <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h2 class="section-title mb-2">Masuk</h2>
                        <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
                    </div>
                    
                    <form onsubmit="handleLogin(event)">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" class="form-control" placeholder="nama@email.com" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Ingat saya
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <p class="text-muted mb-2">
                            <a href="#" class="text-primary text-decoration-none">Lupa password?</a>
                        </p>
                        <p class="text-muted">Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Daftar di sini</a>
                        </p>
                    </div>
                </div>
            </div>
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

<script>
function handleLogin(event) {
    event.preventDefault();
    alert('Login berhasil! Selamat datang di Eksora.');
    window.location.href = '{{ route('home') }}';
}
</script>
@endsection
