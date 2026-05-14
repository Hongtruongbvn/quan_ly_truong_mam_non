@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ChildrenCreation.css') }}">

<div style="background: #fff; max-width: 700px; margin: 30px auto; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
    <div class="back-button" style="margin-bottom: 20px;">
        <button onclick="window.history.back()" class="btn btn-primary" style="background-color: #ff69b4; border: none; border-radius: 8px;">
            <i class="fas fa-arrow-left"></i> Quay lại
        </button>
    </div>
    
    <h2 style="color: #ec53d0; font-weight: bold; text-align: center; margin-bottom: 25px;">Khai Báo Trẻ Em Vào Trường</h2>

    <form action="{{ route('admin.children.store') }}" method="POST" enctype="multipart/form-data" id="childForm">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Họ và tên đúng mặt chữ:</label>
            <input type="text" name="name" class="form-control" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px;" value="{{ old('name') }}" placeholder="Bạn vui lòng nhập bằng các kí hiệu chữ trong dòng kẻ trắng nha." required pattern="^[\p{L}\s]+$" oninput="validateName(this)">
            <span class="error-message text-danger" style="display: none; font-size:13px; margin-top:5px;">Ôi bạn bỏ dấu lố rồi: Tên đâu dùng được chấm, chữ cái đặc biệt là số! Đổi nha nha!</span>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Cục cưng bé ngày nào ra đời ?:</label>
            <input type="date" class="form-control" name="birthDate" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px;" value="{{ old('birthDate') }}" max="{{ date('Y-m-d') }}" required>
            @error('birthDate')
                <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Dự đón một hoàng tử nam (nam)  hay công chúa nữ thế nhỉ ? :</label>
            <select class="form-control" name="gender" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px;" required>
                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Con trai </option>
                <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Bé nhà Gái (Nữ nhi)</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Tên tài khoản quý bạn làm thủ tục ghi chép :</label>
            <select class="form-control" name="user_id" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px;" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $child->user_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>                    
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Hiện trường trạng học đường ?:</label>
            <select class="form-control" name="status" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px;" required>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}> Bé theo lớp tại sân (Tiến đang)</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Báo đóng kho / Rời trường bé chưa quay lai đâu . </option>
            </select>
        </div>

        <div style="margin-bottom: 30px; border: 1px dashed #ffd6e7; padding: 15px; border-radius: 8px; background: #fffafc;">
            <label style="font-weight: bold; color: #555;">Tấm Cạc Chứng Thẻ Học Vị:</label>
            <br>
            @if(isset($user) && $user->img)
                <div style="margin: 10px 0; text-align: center;">
                    <img src="{{ asset('storage/' . $user->img) }}" alt="Ảnh xinh ghê" style="width: 150px; height: 150px; border-radius: 12px; object-fit: cover;">
                </div>
            @endif
            <input class="form-control mt-2" type="file" name="img" accept="image/jpeg,image/png,image/jpg" style="border:none;">
            <small style="color: #aaa;"> Chọn những tệp vuông nhỏ nhắn nét đuôi đuôi.Png/ JPG ( Ảnh tươi  chọn liền nhé) nha  !!.</small>
        </div>        

        <button type="submit" class="btn w-100" style="background-color: #ff69b4; color: #fff; border-radius: 8px; padding: 12px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 10px rgba(255, 105, 180, 0.4); transition:all 0.3s;">Nhận Bản Gửi Hệ Mầm!</button>
    </form>
</div>

<script>
    function validateName(input) {
        const pattern = /^[\p{L}\s]+$/u; 
        const errorMessage = input.nextElementSibling;
        if (!pattern.test(input.value)) {
            errorMessage.style.display = 'block'; 
            input.setCustomValidity('Thông báo từ Tương Lai gửi nhé: Tên ở khu tráng trường không bao chứa những chướng ngại vật đâu ^^.');
        } else {
            errorMessage.style.display = 'none'; 
            input.setCustomValidity(''); 
        }
    }
</script>
@endsection