<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - @yield('title', 'Nursery PreSchool')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
</head>
<body style="background-color: #fcfcfc;">
    <!-- Header Section - Thu nhỏ với padding (py-1) và giảm Font Size (fs-6) -->
    <header class="bg-white py-1 shadow-sm sticky-top border-bottom" style="border-color: #ffe4e1 !important;">
        <div class="container">
            <nav class="navbar navbar-expand-lg py-1">
                <a class="navbar-brand title fw-bold mb-0 text-uppercase d-flex align-items-center" href="{{ route('index') }}" style="color: #ec53d0; font-size: 1.15rem;">
                    <i class="bi bi-balloon-heart-fill me-2 fs-3"></i> NURSERY PRESCHOOL
                </a>
                
                <button class="navbar-toggler border-0 px-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="color: #ff69b4;">
                    <i class="bi bi-list fs-3"></i>
                </button>
                
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav align-items-lg-center">
                        <li class="nav-item border-0 shadow-none m-0 me-1">
                            <a class="nav-link fs-6 fw-semibold px-3 py-2 rounded-pill" href="{{ route('index') }}"><i class="bi bi-house"></i> Trang chủ</a>
                        </li>
                        <li class="nav-item border-0 shadow-none m-0 me-1">
                            <a class="nav-link fs-6 fw-semibold px-3 py-2 rounded-pill" href="{{ route('event')}}"><i class="bi bi-calendar-event"></i> Sự kiện</a>
                        </li>
                        <li class="nav-item border-0 shadow-none m-0 me-1">
                            <a class="nav-link fs-6 fw-semibold px-3 py-2 rounded-pill" href="{{ route('education')}}"><i class="bi bi-journal-bookmark"></i> Giáo dục</a>
                        </li>
                        <li class="nav-item border-0 shadow-none m-0 me-1">
                            <a class="nav-link fs-6 fw-semibold px-3 py-2 rounded-pill" href="{{ route('rules')}}"><i class="bi bi-shield-check"></i> Nội quy</a>
                        </li>
                        <li class="nav-item border-0 shadow-none m-0 me-1">
                            <a class="nav-link fs-6 fw-semibold px-3 py-2 rounded-pill" href="{{ route('feedback')}}"><i class="bi bi-chat-text"></i> Phản hồi</a>
                        </li>
                        
                        <li class="nav-item border-0 shadow-none m-0 ms-lg-2 mt-2 mt-lg-0">
                            @if(Auth::check())
                                <!-- Đăng Xuất Form -->
                                <a class="nav-link btn px-4 py-2 rounded-pill fw-bold text-white" 
                                   style="background-color: #ec53d0; font-size: 0.95rem; border-radius: 20px;" 
                                   href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Đăng xuất <i class="bi bi-box-arrow-right ms-1"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <!-- Đăng Nhập Link -->
                                <a class="nav-link btn px-4 py-2 rounded-pill fw-bold text-white shadow-sm" 
                                   style="background-color: #ff69b4; font-size: 0.95rem;" 
                                   href="{{ route('login') }}">
                                   <i class="bi bi-person-circle"></i> Đăng nhập
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mt-4 mb-5 pb-5">
        @yield('content')
    </main>

    <!-- Bootstrap JS (Required for navbar-toggler) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>