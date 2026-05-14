@extends('layouts.dashboard')

@section('title', 'Bảng giáo viên')

@section('content')
<style>
    .teacher-wrapper {
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
    }
    .teacher-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(236, 83, 208, 0.08);
        overflow: hidden;
        margin-bottom: 25px;
        transition: all 0.2s;
    }
    .teacher-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(236, 83, 208, 0.12);
    }
    .card-header-pink {
        background: linear-gradient(95deg, #ec53d0, #ff80bf);
        color: white;
        font-weight: 700;
        padding: 16px 22px;
        font-size: 18px;
    }
    .card-header-blue {
        background: linear-gradient(95deg, #2196f3, #6ec8ff);
        color: white;
        font-weight: 700;
        padding: 16px 22px;
        font-size: 18px;
    }
    .card-header-warning {
        background: linear-gradient(95deg, #f9a825, #ffb74d);
        color: #2c2c2c;
        font-weight: 700;
        padding: 14px 20px;
        font-size: 16px;
    }
    .avatar-circle {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 60px;
        border: 4px solid #ffb7e4;
        margin-bottom: 16px;
    }
    .info-row {
        padding: 8px 0;
        border-bottom: 1px solid #f3e0ec;
        display: flex;
        flex-wrap: wrap;
    }
    .info-label {
        font-weight: 700;
        color: #c2185b;
        width: 140px;
    }
    .btn-soft {
        background: #ffeef7;
        color: #c2185b;
        border-radius: 40px;
        padding: 8px 20px;
        margin: 5px;
        font-weight: 500;
        transition: 0.2s;
        display: inline-block;
        text-decoration: none;
        font-size: 14px;
    }
    .btn-soft:hover {
        background: #ec53d0;
        color: white;
        transform: translateY(-2px);
    }
    .action-group {
        background: #fff9fc;
        border-radius: 20px;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #ffe0f0;
    }
    .action-group label {
        font-weight: 700;
        color: #c2185b;
        margin-bottom: 12px;
        display: block;
    }
    .student-table {
        width: 100%;
        border-collapse: collapse;
    }
    .student-table th {
        background: #ffe4e1;
        color: #c2185b;
        padding: 12px;
        font-weight: 700;
    }
    .student-table td {
        padding: 10px 12px;
        border-bottom: 1px solid #f3e0ec;
    }
    .student-table tr:hover {
        background: #fff5f9;
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

<div class="teacher-wrapper">
    <div class="row g-4">
        <!-- Cột trái: Thông tin cá nhân -->
        <div class="col-md-6">
            <div class="teacher-card">
                <div class="card-header-pink">
                    🧑 Thông tin của tôi
                </div>
                <div class="card-body text-center text-md-start p-4">
                    @if(Auth::check())
                        <div class="text-center">
                            <img src="{{ Auth::user()->img ? asset('storage/' . Auth::user()->img) : asset('img/default_avatar.png') }}" 
                                 alt="Ảnh đại diện" 
                                 class="avatar-circle">
                        </div>
                        <div class="info-row"><span class="info-label">Tên:</span> {{ Auth::user()->name }}</div>
                        <div class="info-row"><span class="info-label">Email:</span> {{ Auth::user()->email }}</div>
                        <div class="info-row"><span class="info-label">Số điện thoại:</span> {{ Auth::user()->phone }}</div>
                        <div class="info-row"><span class="info-label">Địa chỉ:</span> {{ Auth::user()->address }}</div>
                        <div class="info-row"><span class="info-label">Căn cước:</span> {{ Auth::user()->id_number }}</div>
                        <div class="info-row"><span class="info-label">Giới tính:</span> 
                            {{ Auth::user()->gender == 'male' ? 'Nam' : (Auth::user()->gender == 'female' ? 'Nữ' : 'Chưa rõ') }}
                        </div>                        
                        <div class="info-row"><span class="info-label">Lớp dạy:</span> {{ Auth::user()->classroom->name ?? 'Chưa có lớp' }}</div>
                    @else
                        <p>Không có thông tin người dùng.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Cột phải: Các nút chức năng -->
        <div class="col-md-6">
            <div class="teacher-card">
                <div class="card-header-blue">
                    ⚙️ Quản lý hoạt động
                </div>
                <div class="card-body p-4">
                    <div class="action-group">
                        <label>💰 Thanh toán & Đánh giá</label>
                        <div>
                            <a href="{{ route('momo') }}" class="btn-soft">Thanh toán học phí</a>
                            <a href="{{ route('evaluate') }}" class="btn-soft">Đánh giá học sinh</a>
                        </div>
                    </div>

                    <div class="action-group">
                        <label>💬 Tiện ích hàng ngày</label>
                        <div>
                            <a href="{{ route('teacher.chat') }}" class="btn-soft">Trò chuyện</a>
                            <a href="{{ route('timetable.view') }}" class="btn-soft">Xem lịch học</a>
                            <a href="{{ route('reset.password.form') }}" class="btn-soft">Đổi mật khẩu</a>
                        </div>
                    </div>

                    <div class="action-group">
                        <label>📷 Quản lý camera</label>
                        <div>
                            <a href="{{ route('camcreate') }}" class="btn-soft">Thêm camera</a>
                            <a href="{{ route('cameras.index') }}" class="btn-soft">Xem camera</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách lớp học -->
    <div class="teacher-card">
        <div class="card-header-warning">
            📋 Danh sách học sinh trong lớp
        </div>
        <div class="card-body p-4">
            @if($students->isEmpty())
                <p class="text-center text-muted">Không có học sinh nào trong lớp.</p>
            @else
                <div style="overflow-x: auto;">
                    <table class="student-table">
                        <thead>
                            <tr>
                                <th>👧 Tên học sinh</th>
                                <th>🎂 Ngày sinh</th>
                                <th>⚥ Giới tính</th>
                                <th>👪 Phụ huynh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->birthDate }}</td>
                                    <td>{{ ($student->gender) === 1 ? 'Nam' : 'Nữ' }}</td>
                                    <td>{{ $student->user->name ?? 'Không có' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Đánh giá học lực và chi tiết học sinh -->
    <div class="row g-4 mt-2">
        <!-- Bên trái: Chọn ngày và học lực -->
        <div class="col-md-6">
            <div class="teacher-card">
                <div class="card-header-warning">
                    📅 Đánh giá học lực theo ngày
                </div>
                <div class="card-body p-4">
                    <form id="evaluation-form">
                        <div class="mb-3">
                            <label class="fw-bold" style="color:#c2185b;">Ngày:</label>
                            <input type="date" id="date" name="date" class="custom-input" required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold" style="color:#c2185b;">Xếp loại:</label>
                            <input type="text" id="point" name="point" class="custom-input" style="background:#fef2f8;" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold" style="color:#c2185b;">Nhận xét:</label>
                            <textarea disabled id="hocLuc" class="custom-input" rows="3" placeholder="Nhận xét học lực..."></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bên phải: Chọn học sinh và chi tiết -->
        <div class="col-md-6">
            <div class="teacher-card">
                <div class="card-header-blue">
                    👶 Chọn học sinh
                </div>
                <div class="card-body p-4">
                    <select name="child_id" id="child_id" class="custom-input" required>
                        <option value="" disabled selected>-- Chọn học sinh --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="teacher-card">
                <div class="card-header-blue">
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
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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