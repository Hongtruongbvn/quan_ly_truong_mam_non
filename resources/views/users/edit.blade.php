<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sửa thông tin người dùng</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #ffe4e1 0%, #fef5f9 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .edit-container {
            max-width: 900px;
            margin: 40px auto;
        }

        .edit-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 35px rgba(236, 83, 208, 0.12);
            overflow: hidden;
            padding: 30px 35px;
        }

        .edit-title {
            color: #c2185b;
            text-align: center;
            font-weight: 800;
            font-size: 28px;
            margin-bottom: 30px;
            position: relative;
        }

        .edit-title:after {
            content: '';
            width: 60px;
            height: 3px;
            background: #ec53d0;
            display: block;
            margin: 12px auto 0;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            font-weight: 600;
            color: #c2185b;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .form-control-custom {
            border: 1.5px solid #f0b3df;
            border-radius: 14px;
            padding: 12px 16px;
            width: 100%;
            transition: all 0.25s;
            background: #fffef7;
            font-size: 15px;
        }

        .form-control-custom:focus {
            border-color: #ec53d0;
            box-shadow: 0 0 0 4px rgba(236, 83, 208, 0.15);
            outline: none;
        }

        .btn-update {
            background: linear-gradient(95deg, #ec53d0, #ff80bf);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.25s;
            width: 100%;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(236, 83, 208, 0.4);
            background: linear-gradient(95deg, #e141c2, #ff6eb3);
        }

        .error-alert {
            background: #fff0f0;
            border-left: 5px solid #e91e63;
            padding: 15px 20px;
            border-radius: 18px;
            margin-bottom: 25px;
        }

        .error-alert ul {
            margin: 0;
            padding-left: 22px;
        }

        .error-alert li {
            color: #c2185b;
            font-size: 14px;
        }

        .current-image {
            margin: 10px 0;
            text-align: center;
        }

        .current-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 60px;
            border: 3px solid #ec53d0;
        }
    </style>
</head>
<body>
    @extends('layouts.dashboard')

    @section('content')
    <div class="edit-container">
        <div class="edit-card">
            <h2 class="edit-title">✏️ Sửa thông tin người dùng</h2>

            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">📧 Email</label>
                    <input type="email" name="email" class="form-control-custom" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label class="form-label">👤 Họ tên</label>
                    <input type="text" 
                           name="name" 
                           class="form-control-custom @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name ?? '') }}"
                           onkeypress="return /[a-zA-Z\s]/i.test(event.key)"
                           required>
                    @error('name')
                        <span style="color:#d81b60; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">🆔 Số căn cước</label>
                    <input type="text" 
                           name="id_number" 
                           class="form-control-custom @error('id_number') is-invalid @enderror"
                           value="{{ old('id_number', $user->id_number ?? '') }}"
                           onkeypress="return /[0-9]/i.test(event.key)"
                           required>
                    @error('id_number')
                        <span style="color:#d81b60; font-size:12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">🏠 Địa chỉ</label>
                    <input type="text" name="address" class="form-control-custom" value="{{ $user->address }}">
                </div>

                <div class="form-group">
                    <label class="form-label">📌 Vai trò</label>
                    <select name="role" class="form-control-custom bg-white">
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>👩‍🏫 Giáo viên</option>
                        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>👪 Phụ huynh</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">📊 Trạng thái</label>
                    <input type="number" name="status" class="form-control-custom" value="{{ $user->status }}">
                </div>

                <div class="form-group">
                    <label class="form-label">⚥ Giới tính</label>
                    <select name="gender" class="form-control-custom bg-white">
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>🧑 Nam</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>👩 Nữ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">📞 Số điện thoại</label>
                    <input type="tel" 
                           name="phone" 
                           class="form-control-custom @error('phone') is-invalid @enderror" 
                           value="{{ old('phone', $user->phone) }}" 
                           pattern="[0-9]{10,11}"
                           onkeypress="return /[0-9]/i.test(event.key)"
                           maxlength="11"
                           required>
                    @error('phone')
                        <div style="color:#d81b60; font-size:12px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">🖼️ Ảnh hiện tại</label>
                    <div class="current-image">
                        @if($user->img)
                            <img src="{{ $user->img }}" alt="Ảnh đại diện">
                        @else
                            <span style="color:#aaa;">Chưa có ảnh</span>
                        @endif
                    </div>
                    <input type="file" name="img" class="form-control-custom bg-white mt-2" style="padding: 10px;">
                    <span style="font-size:12px; color:#c2185b;">Chọn ảnh mới nếu muốn đổi</span>
                </div>

                <button type="submit" class="btn-update">💾 Cập nhật người dùng</button>
            </form>
        </div>
    </div>
    @endsection
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('input[name="name"]');
        if (nameInput) {
            nameInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
        }
    
        const idNumberInput = document.querySelector('input[name="id_number"]');
        if (idNumberInput) {
            idNumberInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }
    });
</script>    
</html>