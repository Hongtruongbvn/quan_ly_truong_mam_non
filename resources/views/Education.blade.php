@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Education.css') }}">
<div class="content-section bg-white rounded-4 shadow-sm p-4 mb-4">
    <!-- Banner Education -->
    <section class="education-section pb-5 pt-3">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <img src="{{ asset('img/education.png') }}" class="img-fluid rounded-4 shadow" alt="Preschool Education">
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <h2 class="text-primary fw-bold mb-3">Chương Trình Giáo Dục</h2>
                    <p class="fs-5 text-muted">Tại trường chúng tôi, chương trình giáo dục được thiết kế để phát triển toàn diện các kỹ năng cần thiết cho sự phát triển của trẻ, bao gồm:</p>
                    <ul class="text-start ms-md-4 text-muted fs-6">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Phát triển ngôn ngữ và giao tiếp</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Kỹ năng tư duy và giải quyết vấn đề</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Kỹ năng vận động và thể chất</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Sự hiểu biết về thế giới xung quanh</li>
                    </ul>
                    <button class="btn btn-primary rounded-pill px-4 mt-3 fw-bold shadow-sm" onclick="toggleDetails()">Tìm hiểu thêm <i class="bi bi-arrow-down-circle ms-1"></i></button>
                </div>
            </div>

            <!-- Expandable Content -->
            <div id="additional-details" class="mt-5 collapse-container">
                <div class="row">
                    <div class="col-12">
                        <div class="school-details p-4 bg-light rounded-4 shadow-sm border border-light">
                            <h3 class="text-primary text-center fw-bold mb-4 border-bottom pb-3"><i class="bi bi-list-stars text-warning me-2"></i>Thông Tin Chi Tiết Về Trường</h3>
                            
                            <div class="detail-section mb-5">
                                <h4 class="text-secondary fw-bold mb-4">Chương Trình Học Chi Tiết</h4>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="info-card h-100 rounded-4 border-0">
                                            <h5><i class="bi bi-balloon-heart text-danger"></i> Lớp Mầm (3-4 tuổi)</h5>
                                            <div class="program-content">
                                                <h6>Phát triển thể chất</h6>
                                                <ul>
                                                    <li>Rèn luyện vận động thô: chạy, nhảy, leo trèo an toàn</li>
                                                    <li>Phát triển vận động tinh: tô màu, xếp hình, nặn đất sét</li>
                                                    <li>Các bài tập thể dục nhịp điệu vui nhộn</li>
                                                </ul>
                                                <h6>Phát triển ngôn ngữ</h6>
                                                <ul>
                                                    <li>Học từ vựng qua trò chơi và bài hát</li>
                                                    <li>Kể chuyện theo tranh</li>
                                                    <li>Làm quen với chữ cái và số</li>
                                                </ul>
                                                <h6>Kỹ năng xã hội</h6>
                                                <ul>
                                                    <li>Học cách chia sẻ và làm việc nhóm</li>
                                                    <li>Rèn luyện thói quen sinh hoạt cơ bản</li>
                                                    <li>Phát triển kỹ năng giao tiếp</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card h-100 rounded-4 border-0">
                                            <h5><i class="bi bi-puzzle text-primary"></i> Lớp Chồi (4-5 tuổi)</h5>
                                            <div class="program-content">
                                                <h6>Phát triển tư duy</h6>
                                                <ul>
                                                    <li>Làm quen với các khái niệm toán học cơ bản</li>
                                                    <li>Phát triển tư duy logic qua trò chơi</li>
                                                    <li>Khám phá khoa học tự nhiên</li>
                                                </ul>
                                                <h6>Nghệ thuật sáng tạo</h6>
                                                <ul>
                                                    <li>Học vẽ và tô màu nâng cao</li>
                                                    <li>Làm đồ thủ công từ vật liệu tái chế</li>
                                                    <li>Học hát và múa theo nhạc</li>
                                                </ul>
                                                <h6>Kỹ năng sống</h6>
                                                <ul>
                                                    <li>Rèn luyện tính tự lập</li>
                                                    <li>Phát triển kỹ năng giải quyết vấn đề</li>
                                                    <li>Học cách bảo vệ bản thân</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card h-100 rounded-4 border-0">
                                            <h5><i class="bi bi-book-half text-success"></i> Lớp Lá (5-6 tuổi)</h5>
                                            <div class="program-content">
                                                <h6>Chuẩn bị vào lớp 1</h6>
                                                <ul>
                                                    <li>Làm quen với chữ viết và số học</li>
                                                    <li>Rèn luyện kỹ năng đọc hiểu</li>
                                                    <li>Phát triển tư duy toán học</li>
                                                </ul>
                                                <h6>Phát triển ngôn ngữ nâng cao</h6>
                                                <ul>
                                                    <li>Học tiếng Anh cơ bản</li>
                                                    <li>Kỹ năng kể chuyện và thuyết trình</li>
                                                    <li>Phát triển vốn từ vựng phong phú</li>
                                                </ul>
                                                <h6>Kỹ năng xã hội nâng cao</h6>
                                                <ul>
                                                    <li>Làm việc nhóm hiệu quả</li>
                                                    <li>Rèn luyện tính kỷ luật</li>
                                                    <li>Phát triển sự tự tin</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-card h-100 rounded-4 border-0">
                                            <h5><i class="bi bi-bicycle text-info"></i> Chương Trình Ngoại Khóa</h5>
                                            <div class="program-content">
                                                <h6>Hoạt động thể thao</h6>
                                                <ul>
                                                    <li>Lớp bơi cơ bản (4-6 tuổi)</li>
                                                    <li>Yoga cho bé</li>
                                                    <li>Thể dục nhịp điệu</li>
                                                </ul>
                                                <h6>Nghệ thuật</h6>
                                                <ul>
                                                    <li>Lớp vẽ nâng cao</li>
                                                    <li>Đàn piano cơ bản</li>
                                                    <li>Múa ballet thiếu nhi</li>
                                                </ul>
                                                <h6>Hoạt động trải nghiệm</h6>
                                                <ul>
                                                    <li>Tham quan bảo tàng</li>
                                                    <li>Dã ngoại theo chủ đề</li>
                                                    <li>Trải nghiệm nghề nghiệp mini</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="detail-section">
                                <h4 class="text-secondary fw-bold mb-3"><i class="bi bi-clock-history me-2"></i>Thời Gian Biểu Hàng Ngày</h4>
                                <div class="schedule-info rounded-4 border-0 shadow-sm p-4">
                                    <div class="daily-schedule">
                                        <p><strong><i class="bi bi-sunrise text-warning"></i> 07:30 - 08:05</strong> Đón trẻ và điểm tâm sáng</p>
                                        <p><strong><i class="bi bi-journal-text text-primary"></i> 08:15 - 08:50</strong> Hoạt động học tập theo chủ đề</p>
                                        <p><strong><i class="bi bi-cup-hot text-danger"></i> 09:00 - 09:35</strong> Giờ ăn nhẹ và ra chơi</p>
                                        <p><strong><i class="bi bi-sun text-success"></i> 09:45 - 10:15</strong> Hoạt động ngoài trời</p>
                                        <p><strong><i class="bi bi-egg-fried text-warning"></i> 10:30 - 11:15</strong> Ăn trưa</p>
                                        <p><strong><i class="bi bi-moon-stars text-primary"></i> 11:45 - 13:00</strong> Ngủ trưa</p>
                                        <p><strong><i class="bi bi-palette text-info"></i> 13:30 - 14:05</strong> Hoạt động chiều</p>
                                        <p><strong><i class="bi bi-basket text-danger"></i> 14:15 - 14:50</strong> Ăn xế</p>
                                        <p><strong><i class="bi bi-house text-secondary"></i> 15:30 - 16:30</strong> Hoạt động tự do và trả trẻ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cơ Sở Vật Chất Section -->
    <section class="facilities-section py-5 rounded-4 shadow-sm" style="background-color: #fcf4f9;">
        <div class="container">
            <h2 class="text-primary fw-bold text-center mb-5"><i class="bi bi-houses me-2"></i>Cơ Sở Vật Chất</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-card">
                        <img src="{{ asset('img/classroom.png') }}" class="card-img-top object-fit-cover" height="200" alt="Classroom">
                        <div class="card-body text-center p-4">
                            <h4 class="card-title fw-bold text-primary mb-3">Phòng Học</h4>
                            <p class="card-text text-muted">Các phòng học được thiết kế thoáng mát, sạch sẽ, đảm bảo đầy đủ thiết bị và ánh sáng tự nhiên cho sự phát triển của bé.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-card">
                        <img src="{{ asset('img/playground.png') }}" class="card-img-top object-fit-cover" height="200" alt="Playground">
                        <div class="card-body text-center p-4">
                            <h4 class="card-title fw-bold text-primary mb-3">Sân Chơi</h4>
                            <p class="card-text text-muted">Khuôn viên ngoài trời rộng rãi, thảm cỏ êm ái cùng hệ thống cầu trượt an toàn, phù hợp để bé chạy nhảy, vận động hằng ngày.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden hover-card">
                        <img src="{{ asset('img/library.png') }}" class="card-img-top object-fit-cover" height="200" alt="Library">
                        <div class="card-body text-center p-4">
                            <h4 class="card-title fw-bold text-primary mb-3">Thư Viện</h4>
                            <p class="card-text text-muted">Không gian yên tĩnh trưng bày phong phú sách truyện, các khu đọc với thảm bông mềm nuôi dưỡng thói quen đọc sách cho bé ngay từ nhỏ.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function toggleDetails() {
    const details = document.getElementById('additional-details');
    const button = event.target.closest('button');
    
    if (!details.classList.contains('expanded')) {
        details.classList.add('expanded');
        button.innerHTML = 'Thu Gọn <i class="bi bi-arrow-up-circle ms-1"></i>';
    } else {
        details.classList.remove('expanded');
        button.innerHTML = 'Tìm Hiểu Thêm <i class="bi bi-arrow-down-circle ms-1"></i>';
    }
    details.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>

<style>
/* Cải thiện hover Card bên phần cơ sở vật chất mượt mà hơn */
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 20px rgba(255, 105, 180, 0.15) !important;
}
</style>
@endsection