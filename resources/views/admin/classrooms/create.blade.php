@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ClassroomsCreation.css') }}">
<div class="classroom-create-page" style="background: #fff; max-width: 800px; margin: auto; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
    
    <div class="back-button" style="margin-bottom: 20px;">
        <button id="back-button" class="btn btn-primary" style="background-color: #ff69b4; border: none; border-radius: 8px;">
            <i class="fas fa-arrow-left"></i> Quay lại
        </button>
    </div>

    <h2 style="color: #ec53d0; font-weight: bold; text-align: center; margin-bottom: 25px;">Thêm Lớp Học Mới</h2>
    
    @if($errors->any())
        <div class="alert alert-danger" style="border-radius: 8px; font-size: 14px;">
            <ul style="margin: 0; padding-left: 15px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('classrooms.store') }}" method="POST">
        @csrf
        
        <div class="form-group" style="margin-bottom: 15px;">
            <label style="font-weight: bold; color: #555;">Tên lớp học:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ví dụ: Lớp Mầm 1" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px; width:100%;" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label style="font-weight: bold; color: #555;">Giáo viên phụ trách:</label>
            <select id="user_id" name="user_id" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px; width:100%;" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('user_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
                @foreach($allTeachers as $teacher)
                    @if($teacher->classroom)
                        <option value="{{ $teacher->id }}" disabled style="color: gray; background:#f9f9f9;">
                            {{ $teacher->name }} (Đã được xếp dạy lớp khác)
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Tình trạng lớp:</label>
            <select id="status" name="status" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px; width:100%;" required>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Đang hoạt động</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Đóng cửa (Tạm nghỉ)</option>
            </select>
        </div>

        <div id="facility-details" style="background: #fff0f5; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <h5 style="color: #ec53d0; margin-bottom: 15px; font-weight:bold;">Đồ dùng chuẩn bị cấp cho lớp:</h5>
            <ul id="facility-list" style="color:#555; padding-left:0; list-style:none;"></ul>
        </div>

        <div class="form-group">
            <label style="font-weight: bold; color: #555;">Mượn thêm đồ dùng cho lớp từ kho:</label>
            <div style="display: flex; gap: 10px; align-items: center;">
             <select id="add-facility-select" class="form-control" style="border-radius: 8px; border: 1px solid #ffd6e7; flex-grow:1;" >
                 <option value="">-- Vui lòng chọn một loại đồ dùng --</option>
                   @foreach($totalFacilities as $totalFacility)
                        <optgroup label="{{$totalFacility->name}}">
                           @foreach($totalFacility->dentail as $dentail)
                               <option value="{{$dentail->id}}" data-quantity="{{$dentail->quantity}}">
                                   {{$dentail->name}} (Trong kho còn: {{$dentail->quantity}})
                                </option>
                           @endforeach
                       </optgroup>
                   @endforeach
                </select>
               <input type="number" name="quantity_add" id="quantity-add" class="form-control" value="1" min="1" style="width: 100px; border-radius: 8px; border: 1px solid #ffd6e7; text-align: center;">
              <button type="button" id="add-facility" class="btn btn-secondary" style="border-radius: 8px; background: #6a5acd; border: none; color: #fff; padding: 10px 15px;">Thêm</button>
           </div>
        </div>

        <hr style="border-top: 1px dashed #ffd6e7; margin: 25px 0;">

        <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 8px; background-color: #ff69b4; font-size: 18px; padding: 12px; border:none; box-shadow: 0 4px 10px rgba(255, 105, 180, 0.4);">
             Lưu Thông Tin Và Tạo Lớp 
        </button>
    </form>
</div>

<script>
    // Logic của bảng Mượn Đồ/Cơ sở vật chất 
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-facility')) {
            const facilityQuantity = e.target.getAttribute('data-quantity');
            const dentail_id = e.target.getAttribute('data-dentail_id');
            document.querySelectorAll('#add-facility-select option').forEach(option => {
                if (option.value == dentail_id) {
                    option.dataset.quantity = parseInt(option.dataset.quantity) + parseInt(facilityQuantity);
                    // Ghép chữ mượt lại lúc trừ
                    let namePart = option.text.split(' (Trong kho còn:')[0];
                    option.text = `${namePart} (Trong kho còn: ${option.dataset.quantity})`;
                }
            });
            e.target.parentElement.remove();
        }
    });

    document.getElementById('add-facility').addEventListener('click', function() {
        const dentailId = document.getElementById('add-facility-select').value;
        const quantity = parseInt(document.getElementById('quantity-add').value);
        const dentailSelect = document.getElementById('add-facility-select');
        const dentailOption = dentailSelect.selectedOptions[0];

        if (dentailId && quantity > 0) {
            let availableQuantity = parseInt(dentailOption.dataset.quantity);
            const facilityDetails = document.getElementById('facility-details');
            let existingFacility = facilityDetails.querySelector(`li[data-dentail-id="${dentailId}"]`);

            if (existingFacility) {
                let currentQuantity = parseInt(existingFacility.querySelector('.quantity').textContent);
                let newQuantity = currentQuantity + quantity;

                if (newQuantity > availableQuantity + currentQuantity) {
                    alert('Bạn lấy quá nhiều! Số lượng ở kho không còn đủ nữa nhé.');
                    return;
                }
                existingFacility.querySelector('.quantity').textContent = newQuantity;
                existingFacility.querySelector('input[name^="facility_details"]').value = newQuantity;
                existingFacility.querySelector('button').dataset.quantity = newQuantity;
                existingFacility.querySelectorAll('input[type="hidden"]').forEach(input => {
                    if (input.name.endsWith('[quantity]')) {
                         input.value = newQuantity;
                    }
                });
            } else {
                if (quantity > availableQuantity) {
                    alert('Bạn lấy quá nhiều! Số lượng ở kho không còn đủ nữa nhé.');
                    return;
                }
                let namePart = dentailOption.text.split(' (Trong kho còn:')[0];
                const newDetail = `
                    <li data-dentail-id="${dentailId}" style="margin-bottom:10px; display:flex; justify-content:space-between; align-items:center; background:#fff; padding:10px; border-radius:5px; border:1px solid #ffd6e7;">
                         <span style="font-size: 15px;">Đồ dùng: <b>${namePart}</b> - Nhận phân về lớp: <b class="quantity" style="color: #d6336c;">${quantity}</b> món</span>
                         <button type="button" class="btn btn-sm btn-danger remove-facility" data-dentail_id="${dentailId}" data-quantity="${quantity}" style="border-radius:6px; background:#fa3966; color:white; border:none; padding:5px 10px;">Hủy xóa</button>
                         <input type="hidden" name="facility_details[${dentailId}][dentail_id]" value="${dentailId}">
                         <input type="hidden" name="facility_details[${dentailId}][quantity]" value="${quantity}">
                     </li>
                `;
                facilityDetails.querySelector('ul').insertAdjacentHTML('beforeend', newDetail);
            }
            // Hạ số lượng trên Option xuống sau khi phân bổ
            dentailOption.dataset.quantity = availableQuantity - quantity;
            let namePart = dentailOption.text.split(' (Trong kho còn:')[0];
            dentailOption.text = `${namePart} (Trong kho còn: ${dentailOption.dataset.quantity})`;
        }
    });

    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>
@endsection