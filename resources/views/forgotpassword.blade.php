@extends('layouts.dashboard')

@section('title', 'Quên Mật Khẩu')

@section('content')
<main class="d-flex align-items-center justify-content-center py-4 w-100" style="min-height: 80vh;">
    <!-- Import File CSS nguyên gốc -->
    <link rel="stylesheet" href="{{ asset('css/Fogotpassword.css') }}">
    
    <div class="card shadow-lg border-0 rounded-4 w-100 mx-auto" style="background-color: #fff9fc; max-width: 480px;">
        <div class="card-body p-4 p-md-5">
            <!-- Icon Logo -->
            <div class="text-center mb-4">
                <div class="d-inline-block bg-white border border-light p-1 rounded-circle shadow-sm mb-3">
                    <img src="{{ asset('img/Login.png') }}" class="rounded-circle" alt="Quên mật khẩu" style="width: 80px; height: 80px; object-fit: cover;">
                </div>
                <h4 class="fw-bold mb-1" style="color: #ff69b4;">NURSERY PRESCHOOL</h4>
            </div>

            <!-- Các thẻ Error -->
            @if($errors->any())
                <div class="alert alert-danger px-3 py-2 fs-6 shadow-sm border-0 d-flex align-items-center"><i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>{{ $errors->first() }}</div>
            @endif

            @if(session('message'))
                <div class="alert alert-success px-3 py-2 fs-6 shadow-sm border-0 d-flex align-items-center mt-3"><i class="bi bi-check-circle-fill me-2 fs-5"></i>{{ session('message') }}</div>
            @endif

            <!-- Phần 1: Gửi Mã -->
            <form action="{{ route('otp') }}" method="get" class="send-otp-form mb-4 bg-white p-4 rounded-4 shadow-sm border" style="border-color:#ffe4e1 !important;">
                @csrf
                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold mb-2" style="color: #333; font-size:14px;">Số điện thoại:</label>
                    <div class="input-group">
                        <input type="text" id="phone" name="phone" class="form-control px-3 shadow-none bg-light border-0" placeholder="Nhập số điện thoại" required>
                        <button type="submit" class="btn text-white fw-bold shadow-sm" style="background-color: #007bff;">Gửi mã xác nhận</button>
                    </div>
                </div>
            </form>
            
            <!-- Phần 2: Điền MK Mới -->
            <div class="bg-white p-4 rounded-4 shadow-sm border" style="border-color:#ffe4e1 !important;">
                <form action="{{ route('forgotpassword') }}" method="post" class="reset-password-form">
                    @csrf
                    <!-- Field Lưu Session SĐT-->
                    <input type="hidden" name="phone" id="phone" value="{{ session('phone') }}">
                    
                    <div class="mb-3">
                        <label for="otp" class="form-label fw-bold mb-2" style="color: #333; font-size:13px;">Mã xác nhận</label>
                        <input type="text" id="otp" name="otp" class="form-control shadow-none bg-light border-0 px-3 py-2" placeholder="Nhập mã xác nhận" required>
                        @error('otp') <span class="text-danger d-block mt-1 small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-bold mb-2" style="color: #333; font-size:13px;">Mật khẩu mới</label>
                        <input type="password" id="new_password" name="new_password" class="form-control px-3 py-2 shadow-none bg-light border-0" placeholder="Nhập mật khẩu mới" required>
                    </div>

                    <div class="mb-4">
                        <label for="confirm_password" class="form-label fw-bold mb-2" style="color: #333; font-size:13px;">Nhập lại Mật khẩu mới</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control px-3 py-2 shadow-none bg-light border-0" placeholder="Nhập lại mật khẩu mới" required>
                    </div>
                  
                    <button type="submit" class="btn w-100 text-white fw-bold shadow mt-2" style="background-color: #ff69b4; font-size:15px; border-radius: 8px;">
                       Đặt lại mật khẩu
                    </button>
                    <div id="resetMessage" class="mt-2 text-center text-muted small"></div>
                </form>
            </div>
            
        </div>
    </div>
</main>
@endsection