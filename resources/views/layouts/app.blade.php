<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eksora - Temukan Wisata Terbaik di Bali')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #3b82f6;
            --light-blue: #dbeafe;
            --dark-blue: #1e40af;
            --navy-blue: #1e3a8a;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: var(--gray-50);
            color: var(--gray-800);
            line-height: 1.6;
        }
        
        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-blue) !important;
        }
        
        .nav-link {
            color: var(--gray-600) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-blue) !important;
            background-color: var(--light-blue);
        }
        
        /* Main Content */
        .main-content {
            padding-top: 80px;
            min-height: 100vh;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--primary-blue);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Cards */
        .destination-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            background: white;
        }
        
        .destination-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
        }
        
        .review-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
            padding: 1.5rem;
        }
        
        .review-card:hover {
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.1);
            transform: translateY(-4px);
            border-color: var(--light-blue);
        }
        
        /* Rating Stars */
        .rating-stars {
            color: #fbbf24;
        }
        
        /* Badges */
        .category-badge {
            background: var(--light-blue);
            color: var(--primary-blue);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .recommendation-badge {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 2;
        }
        
        .price-tag {
            background: rgba(15, 23, 42, 0.9);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        /* Form Controls */
        .form-control,
        .form-select {
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.1);
        }
        
        /* Footer */
        .footer {
            background: var(--gray-900);
            color: white;
            padding: 3rem 0 2rem;
        }
        
        .footer h5,
        .footer h6 {
            color: white;
        }
        
        .footer .text-muted {
            color: var(--gray-400) !important;
        }
        
        .footer a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer a:hover {
            color: var(--light-blue);
        }
        
        /* Spacing */
        .py-section {
            padding: 5rem 0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding-top: 70px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-compass"></i> Eksora
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('destinations.*') ? 'active' : '' }}" href="{{ route('destinations.index') }}">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reviews.*') ? 'active' : '' }}" href="{{ route('reviews.index') }}">Review</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('recommendations.*') ? 'active' : '' }}" href="{{ route('recommendations.index') }}">Rekomendasi</a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="bi bi-compass"></i> Eksora</h5>
                    <p class="text-muted">Platform terpercaya untuk menemukan destinasi wisata terbaik di Bali dengan teknologi AI dan review komunitas.</p>
                    <div class="mt-3">
                        <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <h6>Navigasi</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('destinations.index') }}">Destinasi</a></li>
                        <li class="mb-2"><a href="{{ route('reviews.index') }}">Review</a></li>
                        <li class="mb-2"><a href="{{ route('recommendations.index') }}">Rekomendasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6>Kategori</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('destinations.index', ['category' => 'pantai']) }}">Pantai</a></li>
                        <li class="mb-2"><a href="{{ route('destinations.index', ['category' => 'gunung']) }}">Gunung</a></li>
                        <li class="mb-2"><a href="{{ route('destinations.index', ['category' => 'budaya']) }}">Budaya</a></li>
                        <li class="mb-2"><a href="{{ route('destinations.index', ['category' => 'kuliner']) }}">Kuliner</a></li>
                        <li class="mb-2"><a href="{{ route('destinations.index', ['category' => 'adventure']) }}">Adventure</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h6>Kontak</h6>
                    <p class="text-muted mb-2"><i class="bi bi-envelope me-2"></i> info@eksora.com</p>
                    <p class="text-muted mb-2"><i class="bi bi-phone me-2"></i> +62 361 123456</p>
                    <p class="text-muted mb-2"><i class="bi bi-geo-alt me-2"></i> Denpasar, Bali</p>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center">
                <p class="text-muted mb-0">&copy; 2024 Eksora. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
