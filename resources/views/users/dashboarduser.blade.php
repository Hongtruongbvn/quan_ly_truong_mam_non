@extends('layouts.dashboard')

@section('title', 'Bảng điều khiển phụ huynh')

@section('content')
<style>
    .dash-card {
        border-radius: 24px;
        border: none;
        background: white;
        box-shadow: 0 10px 25px rgba(236, 83, 208, 0.08);
        overflow: hidden;
        margin-bottom: 25px;
        transition: all 0.2s;
    }
    .dash-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(236, 83, 208, 0.12);
    }
    .dash-header {
        background: linear-gradient(95deg, #ec53d0, #ff80bf);
        color: white;
        font-weight: 700;
        padding: 16px 22px;
        font-size: 18px;
    }
    .dash-header.bg-primary {
        background: linear-gradient(95deg, #c2185b, #ec53d0);
    }
    .dash-header.bg-warning {
        background: linear-gradient(95deg, #f9a825, #ffb74d);
        color: #2c2c2c;
    }
    .info-row {
        padding: 12px 0;
        border-bottom: 1px solid #f3e0ec;
        display: flex;
        flex-wrap: wrap;
    }
    .info-label {
        font-weight: 700;
        color: #c2185b;
        width: 130px;
    }
    .avatar-dash {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 60px;
        border: 4px solid #ffb7e4;
        margin-bottom: 16px;
    }
    .btn-soft-dash {
        background: #ffeef7;
        color: #c2185b;
        border-radius: 40px;
        padding: 6px 18px;
        margin: 5px;
        font-weight: 500;
        transition: 0.2s;
        display: inline-block;
        text-decoration: none;
    }
    .btn-soft-dash:hover {
        background: #ec53d0;
        color: white;
        transform: translateY(-2px);
    }
    .custom-input {
        border: 1.5px solid #f0b3df;
        border-radius: 14px;
        padding: 10px 14px;
        width: 100%;
        transition: all 0.2s;
    }
    .custom-input:focus {
        border-color: #ec53d0;
        box-shadow: 0 0 0 3px rgba(236, 83, 208, 0.15);
        outline: none;
    }
</style>

<div class="container mt-4">
    <link rel="stylesheet" href="{{ asset('css/UserDashboard.css') }}">
    
    <div class="row g-4">
        <!-- Cột trái: Thông tin cá nhân -->
        <div class="col-md-6">
            <div class="dash-card">
                <div class="dash-header">
                    🧑 Thông tin của tôi
                </div>
                <div class="card-body text-center text-md-start p-4">
                    @if(Auth::check())
                        <div class="text-center">
                            @if(Auth::user()->img)
                                <img src="{{ url('storage/' . Auth::user()->img) }}" alt="Ảnh đại diện" class="avatar-dash">
                            @else
                                <img src="{{ asset('img/default_avatar.png') }}" alt="Ảnh mặc định" class="avatar-dash">
                            @endif
                        </div>
                        <div class="info-row"><span class="info-label">Tên:</span> {{ Auth::user()->name }}</div>
                        <div class="info-row"><span class="info-label">Email:</span> {{ Auth::user()->email }}</div>
                        <div class="info-row"><span class="info-label">Số điện thoại:</span> {{ Auth::user()->phone }}</div>
                        <div class="info-row"><span class="info-label">Địa chỉ:</span> {{ Auth::user()->address }}</div>
                        <div class="info-row"><span class="info-label">Căn cước:</span> {{ Auth::user()->id_number }}</div>
                        <div class="info-row"><span class="info-label">Giới tính:</span> 
                            {{ Auth::user()->gender == 'male' ? 'Nam' : (Auth::user()->gender == 'female' ? 'Nữ' : 'Chưa rõ') }}
                        </div>                        
                    @else
                        <p>Không có thông tin người dùng.</p>
                    @endif
                    <div class="mt-4 d-flex flex-wrap justify-content-center justify-content-md-start">
                        <a href="{{ route('momo') }}" class="btn-soft-dash">💰 Thanh toán học phí</a>
                        <a href="{{ route('reset.password.form') }}" class="btn-soft-dash">🔑 Đổi mật khẩu</a>
                        <a href="{{ route('timetable.view') }}" class="btn-soft-dash">📅 Xem lịch học</a>
                        <a href="{{ route('parent.chat') }}" class="btn-soft-dash">💬 Trò chuyện</a>
                        <a href="{{ route('cameras.indexUser') }}" class="btn-soft-dash">📷 Xem camera</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột phải: Chọn học sinh + Chi tiết -->
        <div class="col-md-6">
            <div class="dash-card">
                <div class="dash-header bg-primary">
                    👶 Chọn học sinh
                </div>
                <div class="card-body p-4">
                    <div class="form-group">
                        <label for="child_id" class="fw-bold mb-2" style="color:#c2185b;">Học sinh:</label>
                        <select name="child_id" id="child_id" class="custom-input bg-white" required>
                            <option value="" disabled selected>-- Chọn học sinh --</option>
                            @foreach($children as $child)
                                <option value="{{ $child->id }}">{{ $child->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="dash-card">
                <div class="dash-header bg-primary">
                    📋 Chi tiết học sinh
                </div>
                <div class="card-body p-4" style="background:#fff9fd;">
                    <div class="info-row"><span class="info-label">Tên:</span> <span id="student-name" class="fw-bold">---</span></div>
                    <div class="info-row"><span class="info-label">Ngày sinh:</span> <span id="student-birth">---</span></div>
                    <div class="info-row"><span class="info-label">Giới tính:</span> <span id="student-gender">---</span></div>
                    <div class="info-row"><span class="info-label">Lớp:</span> <span id="student-class">---</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hàng dưới: Đánh giá học lực -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="dash-card">
                <div class="dash-header bg-warning">
                    📖 Đánh giá học lực theo ngày
                </div>
                <div class="card-body p-4">
                    <form id="evaluation-form">
                        <div class="form-group mb-3">
                            <label for="date" class="fw-bold" style="color:#c2185b;">Ngày:</label>
                            <input type="date" id="date" name="date" class="custom-input" style="border-radius: 40px;" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="point" class="fw-bold" style="color:#c2185b;">Xếp loại:</label>
                            <input type="text" id="point" name="point" class="custom-input" style="background:#fef2f8;" disabled>
                        </div>
                        <div class="form-group">
                            <label for="hocLuc" class="fw-bold" style="color:#c2185b;">Nhận xét:</label>
                            <textarea disabled id="hocLuc" class="custom-input" rows="3" style="border-radius: 20px;" placeholder="Nhận xét học lực..."></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const studentSelect = document.getElementById('child_id');
    const dateInput = document.getElementById('date');
    const pointInput = document.getElementById('point');
    const studentName = document.getElementById('student-name');
    const studentBirth = document.getElementById('student-birth');
    const studentGender = document.getElementById('student-gender');
    const studentClass = document.getElementById('student-class');
    const hocLuc = document.getElementById('hocLuc');
    
    studentSelect.addEventListener('change', fetchStudentDetails);
    dateInput.addEventListener('change', fetchStudentDetails);

    function fetchStudentDetails() {
        const childId = studentSelect.value;
        const date = dateInput.value;

        if (childId && date) {
           fetch(`/api/student/details?child_id=${childId}&date=${date}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        studentName.textContent = data.student.name;
                        studentBirth.textContent = data.student.birthDate;
                        studentGender.textContent = data.student.gender === 1 ? 'Nam' : 'Nữ';
                        studentClass.textContent = data.student.className || 'Chưa xác định';
                        
                        if (data.evaluation) {
                            hocLuc.value = data.evaluation.comment || 'Chưa có dữ liệu học lực';
                            const point = data.evaluation.point;
                            let rate;
                            if (point == 10) {
                                rate = 'Xuất sắc';
                            } else if (point == 8) {
                                rate = 'Giỏi';
                            } else if (point == 6) {
                                rate = 'Khá';
                            } else if (point == 4) {
                                rate = 'Trung bình';
                            } else if (point == 2) {
                                rate = 'Yếu';
                            } else {
                                rate = 'Chưa có dữ liệu điểm';
                            }
                            pointInput.value = rate;
                        } else {
                            hocLuc.value = 'Chưa có dữ liệu học lực';
                            pointInput.value = 'Chưa có dữ liệu điểm';
                        }
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            hocLuc.value = 'Chưa có dữ liệu học lực';
            pointInput.value = 'Chưa có dữ liệu điểm';
        }
    }
});
</script>
@endsection