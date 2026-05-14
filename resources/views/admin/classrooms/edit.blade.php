@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ClassroomsCreation.css') }}">
<div class="classroom-create-page" style="background: #fff; max-width: 800px; margin: auto; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
    
    <div class="back-button" style="margin-bottom: 20px;">
        <button id="back-button" class="btn btn-primary" style="background-color: #ff69b4; border: none; border-radius: 8px;">
            <i class="fas fa-arrow-left"></i> Quay lại
        </button>
    </div>

    <h2 style="color: #ec53d0; font-weight: bold; text-align: center; margin-bottom: 25px;">Cập Nhật Và Sửa Thông Tin Lớp Học</h2>
    
    @if($errors->any())
        <div class="alert alert-danger" style="border-radius: 8px; font-size:14px;">
            <ul style="margin: 0; padding-left:15px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('classrooms.update', ['classroom' => $classroom->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group" style="margin-bottom: 15px;">
            <label style="font-weight: bold; color: #555;">Tên lớp học:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $classroom->name) }}" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px; width:100%;" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label style="font-weight: bold; color: #555;">Giáo viên phụ trách:</label>
            <select id="user_id" name="user_id" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px; width:100%;" required>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('user_id', $classroom->user_id) == $teacher->id ? 'selected' : '' }}>
                        Cô: {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label style="font-weight: bold; color: #555;">Tình trạng lớp:</label>
            <select id="status" name="status" style="border-radius: 8px; border: 1px solid #ffd6e7; padding: 10px; width:100%;" required>
                <option value="1" {{ old('status', $classroom->status) == 1 ? 'selected' : '' }}>Đang hoạt động và tiếp đón học sinh</option>
                <option value="0" {{ old('status', $classroom->status) == 0 ? 'selected' : '' }}>Đang Tạm nghỉ hoặc Tạm ngừng mở lớp</option>
            </select>
        </div>

       <div id="facility-details" style="background: #fff0f5; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <h5 style="color: #ec53d0; margin-bottom: 15px; font-weight:bold;">Tài sản hiện tại đang quản lý trong lớp:</h5>
             @if($facilities->isEmpty())
                <p style="color: #888; font-style: italic;">Phòng này chưa mượn đồ dùng hay đồ chơi nào ở kho trường cả.</p>
             @else
                <ul id="facility-list" style="padding-left:0; list-style:none;">
                    @foreach($facilities as $facility)
                        <li data-dentail-id="{{$facility->dentail_id}}" style="margin-bottom:10px; display:flex; justify-content:space-between; align-items:center; background:#fff; padding:10px; border-radius:5px; border:1px solid #ffd6e7;">
                            <span style="font-size: 15px;">Món Đồ dùng: <b>{{ $facility->name ?? 'Vật chưa có Tên' }}</b> | Hiện lớp giữ: <b class="quantity" style="color: #d6336c;">{{ $facility->quantity }}</b> cái</span>
                            <button type="button" class="btn btn-sm btn-danger remove-facility" data-id="{{ $facility->id }}" data-name="{{$facility->name}}" data-dentail_id="{{$facility->dentail_id}}" data-quantity="{{$facility->quantity}}" style="border-radius:6px; background:#fa3966; color:white; border:none; padding:5px 10px;">Thêm vô Trả về Kho</button>
                            <input type="hidden" name="facility_details_old[{{$facility->dentail_id}}][quantity]" value="{{$facility->quantity}}">
                            <input type="hidden" name="facility_details_old[{{$facility->dentail_id}}][dentail_id]" value="{{$facility->dentail_id}}">
                         </li>
                    @endforeach
                </ul>
            @endif
        </div>

         <div class="form-group">
            <label style="font-weight: bold; color: #555;">Kéo chọn cấp thêm vật chất cho lớp từ kho chính:</label>
            <div style="display: flex; gap: 10px; align-items: center;">
             <select id="add-facility-select" class="form-control" style="border-radius: 8px; border: 1px solid #ffd6e7; flex-grow:1;" >
                 <option value="">--- Xin Vui lòng lựa Tên Vật Thể Thiết Bị Cấp Nhé --- </option>
                    @foreach($totalFacilities as $totalFacility)
                        <optgroup label="{{ $totalFacility->name }}">
                            @foreach($totalFacility->dentail as $dentail)
                                <option value="{{$dentail->id}}" data-quantity="{{$dentail->quantity}}">
                                 {{ $dentail->name }} (Trong kho còn: {{$dentail->quantity}})
                                </option>
                           @endforeach
                       </optgroup>
                    @endforeach
                 </select>
                <input type="number" name="quantity_add" id="quantity-add" class="form-control" value="1" min="1" style="max-width: 100px; text-align:center; border-radius: 8px; border: 1px solid #ffd6e7;">
               <button type="button" id="add-facility" class="btn btn-secondary" style="border-radius: 8px; background: #6a5acd; border: none; color: #fff; padding: 10px 15px;">Chọn Cấp Thêm Đồ </button>
             </div>
         </div>

        <input type="hidden" name="deleted_facilities" id="deleted-facilities">

        <hr style="border-top: 1px dashed #ffd6e7; margin: 25px 0;">

        <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 8px; background-color: #ff69b4; font-size: 18px; padding: 12px; border:none; box-shadow: 0 4px 10px rgba(255, 105, 180, 0.4);">
            Lưu Các Thiết Bị và Đăng Kí Này
        </button>
    </form>    
</div>

<script>
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-facility')) {
            const facilityId = e.target.getAttribute('data-id');
            const facilityQuantity = e.target.getAttribute('data-quantity');
            const dentail_id = e.target.getAttribute('data-dentail_id');
            
            if (facilityId) {
                const deletedFacilities = document.getElementById('deleted-facilities');
                let deletedIds = deletedFacilities.value ? deletedFacilities.value.split(',') :[];
                deletedIds.push(facilityId);
                deletedFacilities.value = deletedIds.join(',');
                
                document.querySelectorAll('#add-facility-select option').forEach(option => {
                    if (option.value == dentail_id) {
                        option.dataset.quantity = parseInt(option.dataset.quantity) + parseInt(facilityQuantity);
                        let namePart = option.text.split(' (Trong kho còn:')[0];
                        option.text = `${namePart} (Trong kho còn: ${option.dataset.quantity})`;
                    }
                });
                e.target.parentElement.remove();
            } else {
                 document.querySelectorAll('#add-facility-select option').forEach(option => {
                    if (option.value == dentail_id) {
                        option.dataset.quantity = parseInt(option.dataset.quantity) + parseInt(facilityQuantity);
                        let namePart = option.text.split(' (Trong kho còn:')[0];
                        option.text = `${namePart} (Trong kho còn: ${option.dataset.quantity})`;
                    }
                });
                e.target.parentElement.remove();
            }
        }
    });

    document.getElementById('add-facility').addEventListener('click', function() {
        const dentailId = document.getElementById('add-facility-select').value;
        const quantity = parseInt(document.getElementById('quantity-add').value);
        const dentailSelect = document.getElementById('add-facility-select');
        const dentailOption = dentailSelect.selectedOptions[0];
        const facilityDetails = document.getElementById('facility-details');

        if (dentailId && quantity > 0) {
            let availableQuantity = parseInt(dentailOption.dataset.quantity);
            let existingFacility = facilityDetails.querySelector(`li[data-dentail-id="${dentailId}"]`);
             
            if (existingFacility) {
                let currentQuantity = parseInt(existingFacility.querySelector('.quantity').textContent);
                let newQuantity = currentQuantity + quantity;
                if (newQuantity > availableQuantity + currentQuantity) {
                    alert('Nhanh nhảu nhưng Trong kho báo lại Cạn Thiếu nhé, Quản Lý Cảnh báo Rõ Cho Các Quý Giáo Mầm Bạn Coi Nha  ^^!');
                    return;
                }
                existingFacility.querySelector('.quantity').textContent = newQuantity;
                existingFacility.querySelector('input[name^="facility_details"]').value = newQuantity;
                existingFacility.querySelector('.remove-facility').dataset.quantity = newQuantity;
                existingFacility.querySelectorAll('input[type="hidden"]').forEach(input => {
                    if (input.name.endsWith('[quantity]')) {
                        input.value = newQuantity;
                    }
                });
            } else {
                if (quantity > availableQuantity) {
                    alert('Bạn Vui Lòng Coi Còn Thiếu Cho Gạt Bạn Giằng Xuống Dùng Lớp Nhanh Vác Í ! Tại Ở Vẫn Phải Kẹt Kín Ở Chố Lũ Nhà Nên Bạn Nương Í Lập Kho . Nhìn Thêm Vừa Ổ . Nhé Nha Bạn Kém Ngay Rõ Có Đợ !!');
                    return;
                }
                let namePart = dentailOption.text.split(' (Trong kho còn:')[0];
                const newDetail = `
                    <li data-dentail-id="${dentailId}" style="margin-bottom:10px; display:flex; justify-content:space-between; align-items:center; background:#fff; padding:10px; border-radius:5px; border:1px solid #ffd6e7;">
                        <span style="font-size: 15px;">Vừa Xếp Rước Ròng Gọi Tên Đồ Nè : <b>${namePart}</b> Mượn Thể Xin Lấy Đi Ngài Xài =  <b class="quantity" style="color: #d6336c;">${quantity}</b> 📌 Món . Mẫu Cho Nơi ! </span>
                        <button type="button" class="btn btn-sm btn-danger remove-facility" data-dentail_id="${dentailId}" data-quantity="${quantity}" style="border-radius:6px; background:#e7053e; border:none; padding:5px 10px; color:white;">Rút Vị Sót Ở Rối . Phục </button>
                        <input type="hidden" name="facility_details[${dentailId}][dentail_id]" value="${dentailId}">
                        <input type="hidden" name="facility_details[${dentailId}][quantity]" value="${quantity}">
                    </li>
                `;

                let ul = facilityDetails.querySelector('ul');
                if (!ul) {
                   ul = document.createElement('ul');
                   ul.style.listStyle = 'none';
                   ul.style.paddingLeft = '0';
                   facilityDetails.appendChild(ul);
                }
                ul.insertAdjacentHTML('beforeend', newDetail);
            }
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