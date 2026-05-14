@extends('layouts.dashboard')

@section('title', 'Bảng Tổng Quan')

@section('content')
<div class="container-fluid py-4">
    <!-- Tiêu đề trang -->
    <div class="d-flex align-items-center mb-4">
        <h3 class="fw-bold" style="color: #ff69b4;"><i class="fas fa-home me-2"></i> Bảng Tổng Quan Trang Quản Trị</h3>
    </div>

    <!-- Khối thẻ Menu thông tin chính -->
    <div class="row g-4 mb-4">
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm text-center border-0" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);">
                <div class="card-body text-dark py-4">
                    <i class="fas fa-user-friends fa-3x mb-3 text-white"></i>
                    <h5 class="fw-bold">Quản lý Tài khoản</h5>
                    <p class="text-dark small mb-3">Thông tin đăng nhập giáo viên & phụ huynh.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light rounded-pill shadow-sm fw-bold w-75" style="color: #ff69b4;">Vào xem</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm text-center border-0" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);">
                <div class="card-body text-dark py-4">
                    <i class="fas fa-child fa-3x mb-3 text-white"></i>
                    <h5 class="fw-bold">Hồ sơ Học sinh</h5>
                    <p class="text-dark small mb-3">Danh sách thông tin cá nhân của các bé.</p>
                    <a href="{{ route('admin.children.index') }}" class="btn btn-light rounded-pill shadow-sm fw-bold w-75" style="color: #ff69b4;">Vào xem</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm text-center border-0" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);">
                <div class="card-body text-dark py-4">
                    <i class="fas fa-school fa-3x mb-3 text-white"></i>
                    <h5 class="fw-bold">Thông tin Lớp học</h5>
                    <p class="text-dark small mb-3">Tạo lớp mới và phân công giáo viên đứng lớp.</p>
                    <a href="{{ route('admin.classrooms.index') }}" class="btn btn-light rounded-pill shadow-sm fw-bold w-75" style="color: #ff69b4;">Vào xem</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm text-center border-0" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);">
                <div class="card-body text-dark py-4">
                    <i class="fas fa-calendar-alt fa-3x mb-3 text-white"></i>
                    <h5 class="fw-bold">Quản lý Lịch học</h5>
                    <p class="text-dark small mb-3">Kiểm tra và sắp xếp thời khóa biểu hàng ngày.</p>
                    <a href="{{ route('timetable') }}" class="btn btn-light rounded-pill shadow-sm fw-bold w-75" style="color: #ff69b4;">Vào xem</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 mt-4">
            <div class="card h-100 shadow-sm text-center border-0" style="background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);">
                <div class="card-body text-dark py-4">
                    <i class="fas fa-file-invoice-dollar fa-3x mb-3 text-white"></i>
                    <h5 class="fw-bold">Cổng Học phí</h5>
                    <p class="text-dark small mb-3">Danh sách thu tiền và tình trạng học phí.</p>
                    <a href="{{ route('tuitionmanagement') }}" class="btn btn-light rounded-pill shadow-sm fw-bold px-4" style="color: #9d80d3;">Quản lý</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 mt-4">
            <div class="card h-100 shadow-sm text-center border-0" style="background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);">
                <div class="card-body text-dark py-4">
                    <i class="fas fa-envelope-open-text fa-3x mb-3 text-white"></i>
                    <h5 class="fw-bold">Đọc Hòm Thư góp ý</h5>
                    <p class="text-dark small mb-3">Tiếp nhận lời nhắn, đóng góp từ phụ huynh.</p>
                    <a href="{{ route('feedback.index') }}" class="btn btn-light rounded-pill shadow-sm fw-bold px-4" style="color: #9d80d3;">Đọc thư</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 mt-4">
            <div class="card h-100 shadow-sm text-center border-0" style="background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);">
                <div class="card-body text-dark py-4">
                    <i class="fas fa-video fa-3x mb-3 text-white"></i>
                    <h5 class="fw-bold">Hệ thống Camera</h5>
                    <p class="text-dark small mb-3">Liên kết mã máy quay với trang theo dõi trẻ.</p>
                    <a href="{{ route('camcreate') }}" class="btn btn-light rounded-pill shadow-sm fw-bold px-4" style="color: #9d80d3;">Kiểm tra</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Khối lọc theo tháng và hiển thị thống kê -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                    <h5 class="fw-bold m-0" style="color: #ff69b4;"><i class="fas fa-chart-line me-2"></i> Tình hình trường theo thời gian</h5>
                    
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex align-items-center mt-2 mt-md-0 m-0 w-auto">
                        <label for="month" class="fw-bold text-muted me-2 text-nowrap">Theo dõi tháng:</label>
                        <select name="month" id="month" class="form-select form-select-sm fw-bold rounded-start-pill text-pink shadow-none" style="border-color: #ffbaf2;">
                            <option value="">Lịch năm nay</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                            @endfor
                        </select>
                        <button type="submit" class="btn btn-sm text-white fw-bold px-4 rounded-end-pill shadow-none" style="background-color: #ff69b4; border: 1px solid #ff69b4;">Duyệt</button>
                    </form>
                </div>
                
                <div class="card-body bg-light rounded-bottom-4">
                    <div style="height: 450px; position:relative; width: 100%;">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_column($statistics->toArray(), 'month')).map(m => "Tháng " + m),
            datasets:[
                {
                    label: 'Số lượng bé',
                    data: @json(array_column($statistics->toArray(), 'total_students')),
                    backgroundColor: 'rgba(255, 105, 180, 0.75)',
                    borderColor: 'rgba(255, 105, 180, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Bé nhập học mới',
                    data: @json(array_column($newStudents->toArray(), 'new_students')),
                    backgroundColor: 'rgba(54, 162, 235, 0.75)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Thêm giáo viên mới',
                    data: @json(array_column($newTeachers->toArray(), 'new_teachers')),
                    backgroundColor: 'rgba(75, 192, 192, 0.75)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Thêm hồ sơ phụ huynh mới',
                    data: @json(array_column($newParents->toArray(), 'new_parents')),
                    backgroundColor: 'rgba(153, 102, 255, 0.75)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Số thư góp ý đã nhận',
                    data: @json(array_column($feedbacks->toArray(), 'total_feedbacks')),
                    backgroundColor: 'rgba(255, 159, 64, 0.75)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<style>
    .text-pink { color: #ff69b4; }
</style>
@endsection