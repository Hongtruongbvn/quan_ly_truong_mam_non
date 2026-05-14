@extends('layouts.dashboard')

@section('content')
<main class="d-flex align-items-center justify-content-center w-100" style="min-height: 80vh;">
    <!-- Nạp File CSS -->
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    
    <div class="card shadow-lg border-0 rounded-4" style="background-color: #fffafc; max-width: 420px; width: 100%;">
        <div class="card-body p-5">
            <!-- Header (Logo) Của Form -->
            <div class="text-center mb-4">
                <div class="d-inline-block p-1 bg-white rounded-circle shadow-sm mb-3">
                    <img src="{{ asset('img/Login.png') }}" alt="Nursery PreSchool" class="rounded-circle" style="width: 90px; height: 90px; object-fit: cover;">
                </div>
                <h3 class="fw-bold" style="color: #ec53d0;">Nursery PreSchool</h3>
                <p class="text-muted small">Cổng Đăng Nhập Điện Tử</p>
            </div>
            
            <!-- Hiện báo lỗi không thay đổi -->
            @if(session('error'))
                <div class="alert alert-danger shadow-sm rounded border-0" style="font-size: 14px;">
                    <i class="bi bi-x-octagon-fill"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Form Chính Giữ y nguyên Code -->
            <form action="{{ route('login') }}" method="post">
                @csrf
                
                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold" style="color: #ff69b4; font-size:14px;"><i class="bi bi-person me-1"></i>Tài khoản (Email hoặc SĐT)</label>
                    <input type="text" id="phone" name="phone" class="form-control px-3 py-2 shadow-sm border-0" placeholder="VD: 0901234567..." style="background-color:#ffe4e1;" required>
                </div>
                
                <div class="mb-2">
                    <label for="password" class="form-label fw-bold" style="color: #ff69b4; font-size:14px;"><i class="bi bi-shield-lock me-1"></i>Mật khẩu</label>
                    <input type="password" id="password" name="password" class="form-control px-3 py-2 shadow-sm border-0" placeholder="••••••••" style="background-color:#ffe4e1;" required>
                </div>
                
                @error('password')
                    <div class="text-danger mt-1 small">
                        <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                    </div>
                @enderror
                
                <!-- Helper form-->
                <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                    <a href="{{ route('showfogot') }}" class="text-decoration-none fw-semibold" style="color: #ec53d0; font-size:13px;">Quên Mật Khẩu?</a>
                </div>

                <!-- Submit Bttn -->
                <button type="submit" class="btn w-100 text-white fw-bold py-2 rounded-3 shadow" style="background-color: #ff69b4; font-size: 16px; border:none; transition:0.3s;" onmouseover="this.style.backgroundColor='#ec53d0';" onmouseout="this.style.backgroundColor='#ff69b4';">
                   <i class="bi bi-box-arrow-in-right"></i> Đăng nhập hệ thống
                </button>

                @if (session('message'))
                    <div class="alert alert-success mt-3 shadow-sm rounded border-0" style="font-size: 14px;">
                       <i class="bi bi-check-circle"></i> {{ session('message') }}
                    </div>
                @endif
            </form>
        </div>

        <div class="card-footer bg-transparent border-0 text-center pb-4 pt-0">
            <p class="text-muted small mb-0"><i class="bi bi-exclamation-circle text-danger"></i> <i>Chỉ sử dụng tài khoản do nhà trường cấp.</i></p>
        </div>
    </div>
</main>
@endsection