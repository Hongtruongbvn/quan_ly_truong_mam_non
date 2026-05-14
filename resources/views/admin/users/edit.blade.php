@extends('layouts.dashboard')

@section('content')
<div style="background: #fff; max-width: 700px; margin: 30px auto; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
    
    <link rel="stylesheet" href="{{ asset('css/AccountEdit.css') }}">
    
    <!-- Nút quay lại -->
    <div class="back-button" style="margin-bottom: 20px;">
        <button id="back-button" class="btn" style="background-color: #ff69b4; color: #fff; border: none; border-radius: 8px; padding: 8px 16px;">
            <i class="fas fa-arrow-left"></i> Quay lại
        </button>
    </div>

    <h2 style="color: #ec53d0; font-weight: bold; text-align: center; margin-bottom: 25px;">Sửa Thông Tin Tài Khoản</h2>
    
    <!-- Hiện bảng thông báo nếu nhập sai -->
    @if($errors->any())
        <div class="alert alert-danger" style="background: #fff0f2; border:1px solid #ffa3b4; border-radius:8px; color:red; padding:15px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left:15px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Báo lỗi nếu người này không được phép sửa (vai trò = 0) -->
    @if($user->role == 0)
        <div style="text-align: center; padding: 40px; background: #fff0f2; border-radius:12px; border:2px solid red;">
            <h4 style="color: red; margin:0;">Xin lỗi! Bạn không có quyền truy cập để xem trang này (Lỗi 403).</h4>
        </div>
    @else

    <!-- Mẫu form điền thông tin -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="userForm">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Họ và tên:</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" style="border-radius:8px; border:1px solid #ffd6e7;" required>
            <span class="invalid-feedback text-danger" id="name-error" style="font-size:13px;"></span>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Địa chỉ Email (Thư điện tử):</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" style="border-radius:8px; border:1px solid #ffd6e7;" required>
            <span class="invalid-feedback text-danger" id="email-error" style="font-size:13px;"></span>
        </div>

        <div style="margin-bottom: 20px; position: relative;">
            <label style="font-weight: bold; color: #555;">Mật khẩu mới (Nếu bạn muốn đổi):</label>
            <input type="password" id="password" name="password" class="form-control" style="border-radius:8px; border:1px solid #ffd6e7; padding-right: 35px;">
            <small style="color: #888;">(Bạn cứ để trống ô này nếu không muốn đổi mật khẩu nhé).</small>
            <span id="toggle-password" style="position: absolute; top: 40%; right: 10px; transform: translateY(-50%); cursor: pointer; font-size:18px;">
                👁️
            </span>
        </div>        

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Số thẻ Căn cước (CCCD):</label>
            <input type="text" id="id_number" name="id_number" class="form-control @error('id_number') is-invalid @enderror" value="{{ old('id_number', $user->id_number) }}" maxlength="12" style="border-radius:8px; border:1px solid #ffd6e7;" required>
            <span class="invalid-feedback text-danger" id="id-number-error" style="font-size:13px;"></span>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Địa chỉ chỗ ở:</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $user->address) }}" style="border-radius:8px; border:1px solid #ffd6e7;" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Số điện thoại:</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" maxlength="11" style="border-radius:8px; border:1px solid #ffd6e7;" required>
            <span class="invalid-feedback text-danger" id="phone-error" style="font-size:13px;"></span>
        </div>       

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Nhiệm vụ trong trường:</label>
            <select id="role" name="role" class="form-control" style="border-radius:8px; border:1px solid #ffd6e7;" required>
                <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Cô giáo / Thầy giáo</option>
                <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Phụ huynh của bé</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Giới tính:</label>
            <select id="gender" name="gender" class="form-control" style="border-radius:8px; border:1px solid #ffd6e7;" required>
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Giới tính khác</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Trạng thái tài khoản:</label>
            <select id="status" name="status" class="form-control" style="border-radius:8px; border:1px solid #ffd6e7;" required>
                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Đang mở (Hoạt động bình thường)</option>
                <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Đang khóa (Tài khoản bị đóng)</option>
            </select>
        </div>

        <div style="margin-bottom: 30px; background:#fef9fc; border:1px dashed #ffd6e7; padding:15px; border-radius:12px;">
            <label style="font-weight: bold; color: #555;">Ảnh đại diện (Ảnh chân dung):</label>
            @if(isset($user) && $user->img)
                <div style="margin: 10px 0;">
                    <img src="{{ asset('storage/' . $user->img) }}" alt="Ảnh của bạn" style="width: 130px; height: 130px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                </div>
            @endif
            <input class="form-control" type="file" name="img" accept="image/jpeg,image/png,image/jpg" style="border:none;">
            <small style="color: #6a5acd; font-style:italic;">Nếu bạn thấy ảnh hiện tại đẹp rồi thì cứ để trống ô này nhé.</small>
        </div>   

        <button type="submit" class="btn" style="width:100%; border-radius:8px; padding:12px; font-weight:bold; font-size:16px; background-color: #ff69b4; color:#fff; border:none; box-shadow: 0 4px 10px rgba(255, 105, 180, 0.3);">
            Lưu lại thông tin
        </button>
    </form>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // 1. Kiểm tra Lỗi Tên Người dùng
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('name-error');

        nameInput.addEventListener('input', function() {
            const namePattern = /^[\p{L}\s]+$/u;
            if (!namePattern.test(this.value)) {
                nameError.textContent = 'Bạn ơi, họ tên chỉ được dùng chữ cái và khoảng cách thôi nha.';
                this.classList.add('is-invalid');
            } else {
                nameError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });

        // 2. Kiểm tra lỗi nhập sai Email
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');

        emailInput.addEventListener('input', function() {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(this.value)) {
                emailError.textContent = 'Mẫu email chưa đúng, bạn viết đầy đủ như ví dụ nhé: tên@gmail.com';
                this.classList.add('is-invalid');
            } else {
                emailError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });

        // 3. Kiểm tra số căn cước
        const idNumberInput = document.getElementById('id_number');
        const idNumberError = document.getElementById('id-number-error');

        idNumberInput.addEventListener('input', function() {
            const idNumberPattern = /^[0-9]{1,12}$/;
            if (!idNumberPattern.test(this.value)) {
                idNumberError.textContent = 'Căn cước chỉ có số thôi bạn nhé, không dùng chữ và dài tối đa 12 số.';
                this.classList.add('is-invalid');
            } else {
                idNumberError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });

        // 4. Kiểm tra số điện thoại
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');

        phoneInput.addEventListener('input', function() {
            const phonePattern = /^[0-9]{1,11}$/;
            if (!phonePattern.test(this.value)) {
                phoneError.textContent = 'Số điện thoại viết sai mất rồi, bạn xóa chữ đi chỉ dùng số nhé (dài nhất là 11 số).';
                this.classList.add('is-invalid');
            } else {
                phoneError.textContent = '';
                this.classList.remove('is-invalid');
            }
        });

        // Nút ấn đổi chế độ ẩn/hiện xem mật khẩu
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        if(togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.textContent = type === 'password' ? '👁️' : '🙈';
            });
        }
    });

    document.getElementById('back-button').addEventListener('click', function (e) {
        e.preventDefault();
        window.history.back();
    });
</script>   
@endsection