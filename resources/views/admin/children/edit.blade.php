@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ChildrenEdit.css') }}">
<div style="background: #fff; max-width: 700px; margin: 30px auto; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
    <div class="back-button" style="margin-bottom: 20px;">
        <button onclick="window.history.back()" class="btn btn-primary" style="background-color: #ff69b4; border: none; border-radius: 8px;">
            <i class="fas fa-arrow-left"></i> Ngược ra đằng cửa danh sách nha !
        </button>
    </div>
    
    <h2 style="color: #ec53d0; font-weight: bold; text-align: center; margin-bottom: 25px;"> Bổ Sang Nhật Bổ Bé Học .</h2>

    <form action="{{ route('admin.children.update', $child->id) }}" method="POST" enctype="multipart/form-data" id="childForm">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Kéo sửa tên cho nét mặt bé chút na`:</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" style="border-radius: 8px; border: 1px solid #ffd6e7; padding:10px;" value="{{ old('name', $child->name ?? '') }}" required>
            <span class="invalid-feedback text-danger" id="name-error" style="font-size:13px; margin-top:5px;"></span>
            @error('name')
                <span class="text-danger" style="font-size:13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Kỉ ngày đón sinh trào ở quả tim thế nào nả?</label>
            <input type="date" class="form-control" name="birthDate" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px;" value="{{ old('birthDate', $child->birthDate ? (is_string($child->birthDate) ? $child->birthDate : $child->birthDate->format('Y-m-d')) : '') }}" max="{{ date('Y-m-d') }}" required>
            @error('birthDate')
                <span class="text-danger" style="font-size:13px;">{{ $message }}</span>
            @enderror
        </div>        

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Thanh Nữ bé Hay Sức mạn Lực cậu thế cậu Trai</label>
            <select class="form-control" name="gender" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px;" required>
                <option value="1" {{ old('gender', $child->gender) == 1 ? 'selected' : '' }}>Thanh  Gã </option>
                <option value="2" {{ old('gender', $child->gender) == 2 ? 'selected' : '' }}>Nhài Trà Công</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Kể ai mà phụ đạo đón đứa con mình  trung tay rui ?? :</label>
            <select class="form-control" name="user_id" style="border-radius: 8px; border: 1px solid #ffd6e7; padding:10px;" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $child->user_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>                      
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Tranh Vừa Dữ Nhành Lứa Cập Hành Kêu Chào hay đang Bị Khóa rồi à  ?</label>
            <select class="form-control" name="status" style="border-radius: 8px; border: 1px solid #ffd6e7; padding:10px;" required>
                <option value="1" {{ old('status', $child->status) == 1 ? 'selected' : '' }}>Hoạt Hú Kêu Răng  Hàng Hiện Ngày 🌞</option>
                <option value="0" {{ old('status', $child->status) == 0 ? 'selected' : '' }}> Đứa Gió Vút Mặc . Buột ngủ ! Không có gì rôm cả..</option>
            </select>
        </div>

        <div style="margin-bottom: 30px; border: 1px dashed #ffd6e7; padding: 15px; border-radius: 8px; background: #fffafc;">
            <label style="font-weight: bold; color: #555;">Cạc 📸 Trọng Khoảnh bé Hàng Kí Sự Cập Chợ này.</label>
            <br>
            @if(isset($child) && $child->img)
                 <div style="text-align: center; margin-bottom:10px;">
                     <img src="{{ asset('storage/' . $child->img) }}" alt="Bằng Lưng Quen Nhỉ ^^" style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; box-shadow:0 3px 6px rgba(0,0,0,0.1);">
                 </div>
            @endif
            <input class="form-control" type="file" name="img" accept="image/*" style="border:none;">
            <small style="color: #aaa;">Gác một miếng đẹp hơn đi qua đừng sửa lụy  giấu nhaaa, để mặc nhiên tẹt.</small>
        </div>

        <button type="submit" class="btn w-100" style="background-color: #ec53d0; color: #fff; border-radius: 8px; padding: 12px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 10px rgba(236, 83, 208, 0.4);">Lên Kẹp File Phất ! Lưu  Ngáy .</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const nameError = document.getElementById('name-error');

        nameInput.addEventListener('input', function() {
            const namePattern = /^[\p{L}\s]+$/u;
            if (!namePattern.test(this.value)) {
                nameError.textContent = 'Ấy.. Bắt Trống Kí Từ Ngoặc Lòng Lả Rùi nha !!! Chỉ Sứ Sửa Nghe chưa ^^?';
                this.classList.add('is-invalid');
                this.style.borderColor = "red";
            } else {
                nameError.textContent = '';
                this.classList.remove('is-invalid');
                this.style.borderColor = "#ffd6e7";
            }
        });
    })
</script>
@endsection