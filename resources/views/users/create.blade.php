<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm người dùng mới</title>
    <style>
        .form-label { font-weight: bold; color: #ec53d0; margin-bottom: 5px; display: block;}
        .custom-card { border-radius: 15px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); border: none; background-color: #ffe4e1; }
        .custom-input { border: 1px solid #ffbaf2; border-radius: 8px; padding: 10px; width: 100%; transition: all 0.3s; }
        .custom-input:focus { border-color: #ff69b4; box-shadow: 0 0 8px rgba(255, 105, 180, 0.4); outline: none; }
        .btn-pink { background: linear-gradient(to right, #ec53d0, #ff69b4); color: white; padding: 12px 25px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: transform 0.2s; }
        .btn-pink:hover { transform: translateY(-3px); box-shadow: 0 6px 12px rgba(236, 83, 208, 0.3); color: white;}
    </style>
</head>
<body>
    @extends('layouts.dashboard')

    @section('content')
    <div class="container py-4" style="max-width: 900px;">
        <div class="card custom-card">
            <div class="card-body p-5">
                <h2 style="color: #ec53d0; text-align: center; font-weight: bold; margin-bottom: 30px;">Tờ Thêm Người Dùng Mới</h2>

                @if ($errors->any())
                    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hộp thư mạng (Email)</label>
                            <input type="email" name="email" class="custom-input" value="{{ old('email') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Chữ khóa mở cửa (Mật khẩu)</label>
                            <input type="text" name="password" class="custom-input">
                        </div>            

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên gọi</label>
                            <input type="text" 
                                   name="name" 
                                   class="custom-input @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name ?? '') }}"
                                   onkeypress="return /[a-zA-Z\s]/i.test(event.key)"
                                   required>
                            @error('name')
                                <span style="color: red; font-size: 13px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số thẻ người (Căn cước)</label>
                            <input type="text" 
                                   name="id_number" 
                                   class="custom-input @error('id_number') is-invalid @enderror"
                                   value="{{ old('id_number', $user->id_number ?? '') }}"
                                   onkeypress="return /[0-9]/i.test(event.key)"
                                   required>
                            @error('id_number')
                                <span style="color: red; font-size: 13px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Chỗ ở</label>
                            <input type="text" name="address" class="custom-input" value="{{ old('address') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Việc làm</label>
                            <select name="role" class="custom-input bg-white">
                                <option value="1">Người dạy học</option>
                                <option value="2">Cha mẹ của trẻ</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tình hình (Số)</label>
                            <input type="number" name="status" class="custom-input" value="{{ old('status') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Trai hay Gái</label>
                            <select name="gender" class="custom-input bg-white">
                                <option value="male">Con trai</option>
                                <option value="female">Con gái</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số máy gọi</label>
                            <input type="tel" 
                                   name="phone" 
                                   class="custom-input @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone') }}" 
                                   pattern="[0-9]{10,11}"
                                   onkeypress="return /[0-9]/i.test(event.key)"
                                   maxlength="11"
                                   required>
                            @error('phone')
                                <div style="color: red; font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tấm hình mặt</label>
                            <input type="file" name="img" class="custom-input bg-white" style="padding: 7px;">
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn-pink">Lưu người dùng mới</button>
                    </div>
                </form>
            </div>
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