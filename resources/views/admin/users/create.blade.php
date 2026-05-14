@extends('layouts.dashboard')

@section('title', 'Tạo tài khoản mới')

@section('content')
<div class="container py-4">
    
    <div class="card shadow-sm border-0 rounded-4 mx-auto" style="max-width: 900px; background-color: #fffafc;">
        <div class="card-body p-4 p-md-5">
            <!-- Tiêu đề trang & Nút Quay lại -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 border-bottom pb-3">
                 <h3 class="fw-bold m-0" style="color: #ff69b4;">
                    <i class="fas fa-user-plus me-2 text-pink"></i> Thêm người dùng mới
                 </h3>
                 <a href="{{ route('admin.dashboard') }}" class="btn text-white fw-bold px-4 rounded-pill shadow-sm mt-3 mt-md-0" style="background-color: #ff69b4;">
                    <i class="fas fa-arrow-left me-1"></i> Quay lại
                 </a>
            </div>

            <!-- Khởi tạo form Thêm Mới -->
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Cột: Tải Ảnh Đại Diện -->
                <div class="bg-white p-4 rounded-3 border shadow-sm mb-4 border-start border-4" style="border-left-color: #ff69b4 !important;">
                    <h6 class="fw-bold text-dark mb-3">
                        <i class="fas fa-camera text-primary me-2"></i> Ảnh đại diện (3x4)
                    </h6>
                    <div class="form-group mb-0">
                         @if(isset($user) && $user->img)
                            <div class="mb-3 d-inline-block p-1 border shadow-sm rounded-3">
                                <img src="{{ asset('storage/' . $user->img) }}" alt="Hình thẻ" class="rounded" style="max-height: 120px;">
                            </div>
                         @endif
                         <input type="file" id="profileImage" name="img" accept="image/png, image/jpeg, image/jpg" class="form-control border-secondary shadow-none">
                         <small class="text-muted d-block mt-2"><i class="fas fa-info-circle me-1"></i> Hỗ trợ tệp có định dạng đuôi <strong>.jpg, .png, .jpeg</strong></small>
                    </div>
                </div>

                <!-- Cột: Thông tin khai báo cơ bản --> 
                <div class="row g-4 bg-white p-4 rounded-3 shadow-sm border m-0 border-start border-4" style="border-left-color: #ff69b4 !important;">
                    <h6 class="fw-bold text-dark mb-0 col-12 border-bottom pb-3"><i class="fas fa-file-signature text-success me-2"></i> Khai báo lý lịch cơ bản</h6>

                    <!-- Tên đầy đủ -->
                    <div class="col-md-6 form-group">
                        <label for="name" class="fw-bold text-secondary mb-1">Họ và tên người dùng <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control bg-light shadow-none @error('name') is-invalid @enderror" value="{{ old('name', $user->name ?? '') }}" placeholder="Nhập đủ họ và tên..." required>
                        <span class="invalid-feedback fw-bold mt-1" id="name-error" style="font-size:13px"></span>
                        @error('name') <span class="invalid-feedback fw-bold mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Giới tính -->
                    <div class="col-md-6 form-group">
                        <label for="gender" class="fw-bold text-secondary mb-1">Giới tính <span class="text-danger">*</span></label>
                        <select id="gender" name="gender" class="form-select bg-light shadow-none fw-semibold" required>
                            <option value="" disabled selected>-- Chọn giới tính --</option>
                            <option value="male" class="text-primary">Nam</option>
                            <option value="female" class="text-pink">Nữ</option>
                            <option value="other" class="text-secondary">Khác</option>
                        </select>
                    </div>

                    <!-- CMND/CCCD -->
                    <div class="col-md-6 form-group">
                         <label for="id_number" class="fw-bold text-secondary mb-1">Số Căn cước (CCCD) <span class="text-danger">*</span></label>
                         <input type="text" id="id_number" name="id_number" class="form-control bg-light shadow-none @error('id_number') is-invalid @enderror" value="{{ old('id_number', $user->id_number ?? '') }}" maxlength="12" placeholder="Ví dụ: 0123456789..." required>
                         <span class="invalid-feedback fw-bold mt-1" id="id-number-error" style="font-size:13px"></span>
                         @error('id_number') <span class="invalid-feedback fw-bold mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- Số điện thoại -->
                    <div class="col-md-6 form-group">
                        <label for="phone" class="fw-bold text-secondary mb-1">Số Điện Thoại <span class="text-danger">*</span></label>
                        <input type="text" id="phone" name="phone" class="form-control bg-light shadow-none @error('phone') is-invalid @enderror" value="{{ old('phone') }}" maxlength="11" placeholder="Nhập sđt 10 số liên hệ..." required>
                        <span class="invalid-feedback fw-bold mt-1" id="phone-error" style="font-size:13px"></span>
                        @error('phone') <span class="invalid-feedback fw-bold mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Nơi ở / Địa chỉ -->
                    <div class="col-12 form-group">
                        <label for="address" class="fw-bold text-secondary mb-1">Địa chỉ Nơi cư trú <span class="text-danger">*</span></label>
                        <input type="text" id="address" name="address" class="form-control bg-light shadow-none" value="{{ old('address') }}" placeholder="Nhập đầy đủ số nhà, Phố/thôn/xóm..." required>
                        @error('address') <span class="text-danger fw-bold mt-1 d-block" style="font-size: 13px;">{{ $message }}</span> @enderror
                    </div>

                    <!-- Divider -->
                    <h6 class="fw-bold text-dark mt-5 mb-0 col-12 border-bottom pb-3"><i class="fas fa-cogs text-warning me-2"></i> Khởi tạo Đăng Nhập & Phân Quyền</h6>

                    <!-- Tài khoản thư Email -->
                    <div class="col-md-6 form-group">
                        <label for="email" class="fw-bold text-secondary mb-1">Tài khoản Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="form-control bg-light shadow-none" value="{{ old('email') }}" placeholder="Ex: tendangnhap@domain.com..." required>
                        <span class="invalid-feedback fw-bold mt-1" id="email-error" style="font-size:13px"></span>
                        @error('email') <span class="invalid-feedback fw-bold mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Mật khẩu truy cập -->
                    <div class="col-md-6 form-group">
                         <label for="password" class="fw-bold text-secondary mb-1">Chìa khóa Mật khẩu <span class="text-danger">*</span></label>
                         <div class="position-relative">
                             <input type="password" id="password" name="password" class="form-control bg-light shadow-none pe-5" placeholder="Ghi tối thiểu 6-8 ký tự tùy ý..." required>
                             <!-- Nút Bật/Tắt chế độ nhìn mật khẩu (Biểu tượng con Mắt) -->
                             <span id="toggle-password" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color:gray;" class="fs-5" title="Xem / Giấu Mật khẩu">👁️</span>
                         </div>
                         @error('password') <span class="text-danger fw-bold d-block mt-2" style="font-size: 13px">{{ $message }}</span> @enderror
                    </div>

                    <!-- Loại người dùng -->
                    <div class="col-md-6 form-group">
                         <label for="role" class="fw-bold text-secondary mb-1">Trao chức danh phân quyền <span class="text-danger">*</span></label>
                          <select id="role" name="role" class="form-select bg-light shadow-none" required>
                               <option value="" disabled selected>-- Bạn thuộc chức vụ nào --</option>
                               <option value="1" class="fw-semibold text-primary">👨‍🏫 Nhân viên / Giáo viên mầm non</option>
                               <option value="2" class="fw-semibold text-success">👪 Cá nhân Khách / Phụ huynh của Bé</option>
                          </select>
                     </div>

                    <!-- Tình trạng Block / Unlock Tài Khoản -->
                    <div class="col-md-6 form-group">
                         <label for="status" class="fw-bold text-secondary mb-1">Chấp thuận hoạt động ngay <span class="text-danger">*</span></label>
                         <select id="status" name="status" class="form-select bg-light shadow-none" required>
                             <option value="1" class="text-success fw-bold" selected>✔️ Mở (Tài khoản được đăng nhập luôn)</option>
                             <option value="0" class="text-danger fw-bold">❌ Đóng Khóa (Khóa lại chưa dùng vội)</option>
                         </select>
                    </div>

                </div>

                <!-- Footer chứa lệnh Hành Động Save Account Về Server Cuối Bảng  -->
                 <div class="text-center mt-5 mb-3 border-top pt-4">
                      <button type="submit" class="btn text-white fw-bold shadow-sm rounded-pill px-5 py-3 fs-6 w-auto" style="background-color: #ff5c8d;">
                           <i class="fas fa-check-circle me-1"></i> Bấm để Đăng ký & Mở sổ Lưu trữ
                      </button>
                 </div>
                 
            </form>

        </div>
    </div>
</div>

<script>
    // JS Hỗ Trợ hiển thị ngay thông báo trên khung hình lúc phụ huynh đánh chữ Sai Quy Định (Thay Cho Check Dài Của Bạn Lúc Trước Gửi).
    document.addEventListener('DOMContentLoaded', function() {
        // Validation General Outline UI Effect On Red Colors  
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (!this.validity.valid) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });

        // 1. Dõi định dạng Tên Gõ vào Box.
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('name-error');

        nameInput.addEventListener('input', function() {
            // Biểu thức xét xem chỉ chữ L Vài Khung không số/không kỹ tự đặc biệt.
            const namePattern = /^[\p{L}\s]+$/u;
            if (!namePattern.test(this.value) && this.value !== '') {
                nameError.textContent = '❌ Có gì đó lạ! Xin điền đúng chữ cái và để dấu cách thay vì số hoặc chấm mút.';
                this.classList.add('is-invalid');
            } else {
                nameError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });

        // 2. Email Address Test Dò Cú pháp "@.xxx" Cân Xứng Mail Ràng Server Mãi Web! 
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');

        emailInput.addEventListener('input', function() {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(this.value) && this.value !== '') {
                emailError.textContent = '❌ Lỗi rồi! Địa chỉ chưa chuẩn kiểu tên hộp thư (@ và .com...). Ghi kĩ để gửi liên lạc trúng đích nha.';
                this.classList.add('is-invalid');
            } else {
                emailError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });

        // 3. Form Input Xét Mã Số Cầm Trẻ Người Cước ID CCCD
        const idNumberInput = document.getElementById('id_number');
        const idNumberError = document.getElementById('id-number-error');

        idNumberInput.addEventListener('input', function() {
            // Không Số Gì Chạy Vượt Quyền Giám Kích Length 12 Ở Numeric.  
            const idNumberPattern = /^[0-9]{1,12}$/;
            if (!idNumberPattern.test(this.value) && this.value !== '') {
                idNumberError.textContent = '❌ CMND/CCCD Nhập Không Chín Đỉnh Thật Ròi, Số Lùi Sai Luật! Chuyên Cho chữ số tối Đa Tầng 12 nhé. Lẫn Không Mực Bào chữ.';
                this.classList.add('is-invalid');
            } else {
                idNumberError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });

        // 4. Form Gọi Xét Hướng Num Mobile Tell Tầng Ngọt Nhắc Regex Error 
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');

        phoneInput.addEventListener('input', function() {
            const phonePattern = /^[0-9]{10,11}$/;
            if (!phonePattern.test(this.value) && this.value !== '') {
                phoneError.textContent = '❌ Di Động có dấu ngấm bị nhầm rọi hoặc Quá Số Lệ/Dính Rỗng. Dịch Mềm Form Thành Mức Khẩu Gửi Kế Num: Chỉ cần Viết Liền Nhau Tròn (Từ Gắn Khoảng 10-11 Dãy Đóng Khóa Máy Vô Tool Mới Tính).';
                this.classList.add('is-invalid');
            } else {
                phoneError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });
    });

    // Mắt tắt tắt xem Cắt Ảo Pass Type Input DOM Bịt Code Bày  JS - Form Lấy Text Component Xếp Lỗ 
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            // Mạch Đong Gắt Nọc Eye Mềm. 
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Kẹp Tool JS Giấu Eye Hình Vào Render Type Drop  Đựng Text Eye Thay Icon Mèo Hít ! :
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    });
</script>   
<style>
    .text-pink { color: #ff69b4; }
</style>
@endsection