@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Home.css') }}">
<div class="content-section">
    <!-- Hero Section -->
    <section class="py-5 mb-5 rounded-4 shadow-sm" style="background-color: #fff9fc; border: 1px solid #ffe4e1;">
        <div class="container px-4">
            <div class="row align-items-center g-5">
                <div class="col-md-6 order-2 order-md-1">
                    <h2 class="fw-bold mb-4" style="color: #ff69b4; font-size: 32px;"><i class="bi bi-magic me-2" style="color: #ec53d0;"></i>Giới Thiệu Về Trường</h2>
                    <p class="fs-5 mb-4 text-muted" style="line-height: 1.8;">
                        Ngôi trường được xây dựng như ngôi nhà thứ hai của học sinh, mang lại môi trường học tập an toàn và phát triển toàn diện mọi kỹ năng quan trọng ở độ tuổi của các bé.
                    </p>
                    <a href="#" class="btn shadow-sm px-4 py-2 rounded-pill fw-bold" style="background-color: #ff69b4; color: white;" data-bs-toggle="modal" data-bs-target="#schoolInfoModal">
                        <i class="bi bi-info-circle me-1"></i> Xem thông tin chi tiết trường
                    </a>

                    <!-- Modal Làm Lại Đẹp -->
                    <div class="modal fade" id="schoolInfoModal" tabindex="-1" aria-labelledby="schoolInfoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="border: 2px solid #ff69b4; border-radius: 15px;">
                                <div class="modal-header" style="background-color: #ffe4e1; border-radius: 12px 12px 0 0;">
                                    <h5 class="modal-title fw-bold" style="color: #ec53d0;" id="schoolInfoModalLabel">THÔNG TIN TRƯỜNG HỌC</h5>
                                </div>
                                <div class="modal-body p-4 text-muted">
                                    <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">Tầm nhìn & Sứ mệnh</h5>
                                    <p>Trường được thành lập với mục tiêu tạo ra một môi trường giáo dục toàn diện, nơi học sinh được phát triển cả về kiến thức và kỹ năng sống.</p>
                                    <ul class="list-unstyled mt-3 mb-0">
                                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2" style="color:#ec53d0"></i> <strong>Địa chỉ:</strong> The Emporium Tower, 184 Đ. Lê Đại Hành, P15, Q11, TP. HCM</li>
                                        <li class="mb-2"><i class="bi bi-star-fill me-2" style="color:#ec53d0"></i> <strong>Năm thành lập:</strong> 2010</li>
                                        <li class="mb-2"><i class="bi bi-book-half me-2" style="color:#ec53d0"></i> <strong>Chương trình:</strong> Hệ thống giáo dục chuẩn quốc tế.</li>
                                        <li class="mb-0"><i class="bi bi-house-heart-fill me-2" style="color:#ec53d0"></i> <strong>Cơ sở vật chất:</strong> Hiện đại, khang trang, đáp ứng đầy đủ nhu cầu.</li>
                                    </ul>
                                </div>
                                <div class="modal-footer" style="background-color: #fff9fc; border-radius: 0 0 12px 12px;">
                                    <button type="button" class="btn px-4 rounded-pill" style="background-color: #ff69b4; color:white;" data-bs-dismiss="modal">Đóng cửa sổ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-1 order-md-2 text-center">
                    <!-- Ảnh có đổ bóng để thêm phần nổi bật -->
                    <img src="{{ asset('img/backtoschool.png') }}" class="img-fluid rounded-4 shadow-lg border border-3 border-white" alt="Importance of Pre-School Education">
                </div>
            </div>
        </div>
    </section>

    <!-- Thẻ Môn Mục - Bố Cục Thẻ Làm Lại Sạch Đẹp Bằng Boostrap Grid -->
    <section class="py-5 bg-white rounded-4 shadow-sm border" style="border-color: #ffe4e1 !important;">
        <div class="container px-4">
            <div class="row g-4 text-center justify-content-center">
                <!-- Thẻ đội ngũ giảng dạy -->
                <div class="col-md-5">
                    <a href="{{ route('teachers') }}" class="text-decoration-none d-block h-100 hover-teachers">
                        <div class="card h-100 p-4 border-0 rounded-4 shadow-sm" style="background-color: #f1d1e1; transition: 0.3s;">
                            <div class="d-flex justify-content-center align-items-center rounded-circle mx-auto mb-3 shadow" style="background-color:#ffffff; width:90px; height:90px;">
                                <img src="{{ asset('img/family.png') }}" class="img-fluid" style="max-width: 50px;" alt="Teacher Icon">
                            </div>
                            <h3 class="fw-bold mt-2" style="color: #ec53d0;">Đội Ngũ Giảng Dạy</h3>
                            <p class="text-muted mt-2">Bao gồm các giáo viên có chuyên môn nghiệp vụ và đặc biệt luôn tận tâm, yêu thương trẻ em.</p>
                        </div>
                    </a>
                </div>
                <!-- Thẻ Mục tiêu -->
                <div class="col-md-5">
                    <a href="{{ route('link-to-goals') }}" class="text-decoration-none d-block h-100 hover-goals">
                        <div class="card h-100 p-4 border-0 rounded-4 shadow-sm" style="background-color: #ffe4e1; transition: 0.3s;">
                            <div class="d-flex justify-content-center align-items-center rounded-circle mx-auto mb-3 shadow" style="background-color:#ffffff; width:90px; height:90px;">
                                <img src="{{ asset('img/tam.png') }}" class="img-fluid" style="max-width: 50px;" alt="Goal Icon">
                            </div>
                            <h3 class="fw-bold mt-2" style="color: #ec53d0;">Mục Tiêu Phát Triển</h3>
                            <p class="text-muted mt-2">Nỗ lực mỗi ngày để mang đến cho các em một môi trường học tập và rèn luyện tốt nhất hiện nay.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Đổ hiệu ứng hover chỉ riêng đoạn link card này giữ được nền không thay màu mà phồng to*/
.hover-teachers:hover .card, .hover-goals:hover .card { transform: translateY(-10px) !important; box-shadow: 0 10px 20px rgba(255, 105, 180, 0.3) !important; }
</style>
@endsection