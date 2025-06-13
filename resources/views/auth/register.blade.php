@extends('layouts.app')

@section('title', 'Daftar - Eksora')

@section('content')
<section class="py-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="bg-white p-5 rounded-3 shadow">
                    <div class="text-center mb-4">
                        <div class="feature-icon mx-auto mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h2 class="section-title mb-2">Daftar</h2>
                        <p class="text-muted">Buat akun baru untuk memulai petualangan Anda</p>
                    </div>
                    
                    <form onsubmit="handleRegister(event)">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Masukkan nama lengkap" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" class="form-control" placeholder="nama@email.com" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Minimal 8 karakter" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Ulangi password" required>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                Saya setuju dengan <a href="#" class="text-primary">syarat dan ketentuan</a> serta <a href="#" class="text-primary">kebijakan privasi</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <p class="text-muted">Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">Masuk di sini</a>
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
function handleRegister(event) {
    event.preventDefault();
    alert('Registrasi berhasil! Silakan login untuk melanjutkan.');
    window.location.href = '{{ route('login') }}';
}
</script>
@endsection
