@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Fogotpassword.css') }}">
<style>
    /* Chỉ thêm style mới, không xóa hay đổi biến */
    .reset-box {
        background: #fff9fc;
        border-radius: 28px;
        box-shadow: 0 20px 35px rgba(236, 83, 208, 0.12);
        transition: all 0.2s ease;
    }
    .reset-header-icon {
        background: white;
        padding: 12px;
        border-radius: 60px;
        box-shadow: 0 4px 12px rgba(236, 83, 208, 0.15);
        display: inline-block;
        margin-bottom: 16px;
    }
    .reset-avatar {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 60px;
    }
    .school-name {
        color: #ec53d0;
        font-weight: 800;
        font-size: 22px;
        margin-bottom: 6px;
    }
    .sub-line {
        color: #b85c8a;
        font-size: 13px;
        letter-spacing: 1px;
        border-bottom: 2px solid #ffc0e0;
        display: inline-block;
        padding-bottom: 8px;
    }
    .form-label-custom {
        color: #c2185b;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }
    .input-group-custom {
        border: 1.5px solid #ffb6c1;
        border-radius: 18px;
        background: white;
        overflow: hidden;
        transition: all 0.2s;
    }
    .input-group-custom:focus-within {
        border-color: #ec53d0;
        box-shadow: 0 0 0 3px rgba(236, 83, 208, 0.15);
    }
    .input-inside {
        border: none;
        background: transparent;
        padding: 12px 16px;
        width: 100%;
        font-size: 15px;
    }
    .input-inside:focus {
        outline: none;
    }
    .toggle-eye {
        background: transparent;
        border: none;
        padding: 0 16px;
        cursor: pointer;
        color: #c2185b;
        font-size: 18px;
    }
    .btn-submit-reset {
        background: linear-gradient(95deg, #ec53d0, #ff80bf);
        color: white;
        font-weight: 700;
        font-size: 18px;
        padding: 12px;
        border: none;
        border-radius: 50px;
        width: 100%;
        transition: all 0.25s;
        margin-top: 8px;
    }
    .btn-submit-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(236, 83, 208, 0.35);
        background: linear-gradient(95deg, #e141c2, #ff6eb3);
    }
    .alert-custom {
        background: #e8f5e9;
        border-left: 5px solid #4caf50;
        padding: 12px 18px;
        border-radius: 18px;
        margin-bottom: 24px;
        color: #2e7d32;
        font-size: 14px;
    }
    .error-text {
        color: #e91e63;
        font-size: 12px;
        margin-top: 6px;
        display: block;
    }
</style>

<main class="d-flex justify-content-center align-items-center py-4 w-100" style="min-height: 80vh;">
    <div class="card reset-box w-100" style="max-width: 500px;">
        <div class="card-body p-4 p-md-5 text-start">
            
            <!-- Phần đầu trang -->
            <div class="text-center mb-4">
                <div class="reset-header-icon">
                    <img src="{{ asset('img/Login.png') }}" class="reset-avatar" alt="Ảnh trường">
                </div>
                <h3 class="school-name">🌱 Trường mầm non Nursery</h3>
                <p class="sub-line">✨ Đổi mật khẩu</p>
            </div>

            @if (session('success'))
                <div class="alert-custom">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form class="reset-password-form m-0" method="POST" action="{{ route('reset.password') }}">
                @csrf
                
                <!-- Mật khẩu cũ -->
                <div class="mb-3">
                    <label class="form-label-custom">🔐 Mật khẩu cũ</label>
                    <div class="input-group-custom d-flex align-items-center">
                        <input type="password" id="current_password" name="current_password" class="input-inside" placeholder="Nhập mật khẩu cũ" required>
                        <span class="toggle-eye" onclick="togglePasswordVisibility('current_password')">👁️</span>
                    </div>
                    @error('current_password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label-custom">🔒 Mật khẩu mới</label>
                    <div class="input-group-custom d-flex align-items-center">
                        <input type="password" id="new_password" name="new_password" class="input-inside" placeholder="Tạo mật khẩu mới" required>
                        <span class="toggle-eye" onclick="togglePasswordVisibility('new_password')">👁️</span>
                    </div>
                    @error('new_password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Xác nhận mật khẩu mới -->
                <div class="mb-4">
                    <label class="form-label-custom">📝 Xác nhận lại mật khẩu mới</label>
                    <div class="input-group-custom d-flex align-items-center">
                        <input type="password" id="confirm_password" name="confirm_password" class="input-inside" placeholder="Gõ lại mật khẩu mới" required>
                        <span class="toggle-eye" onclick="togglePasswordVisibility('confirm_password')">👁️</span>
                    </div>
                    @error('confirm_password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-submit-reset">
                    💾 Xác nhận đổi mật khẩu
                </button>
            </form>    
        </div>
    </div>
</main>

<script>
    function togglePasswordVisibility(passwordId) {
        var passwordField = document.getElementById(passwordId);
        var icon = event.currentTarget;
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.innerHTML = "🙈";
        } else {
            passwordField.type = "password";
            icon.innerHTML = "👁️";
        }
    }
</script>
@endsection