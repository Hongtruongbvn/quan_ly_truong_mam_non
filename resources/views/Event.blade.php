@extends('layouts.dashboard')

@section('content')
<!-- Lib CSS gốc đã link sẵn -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="{{ asset('css/Event.css') }}">

<div class="content-section bg-white p-4 rounded-4 shadow-sm border border-light">
    <section class="event-section py-4">
        <div class="container">
            
            <div class="section-header text-center mb-5 animate__animated animate__fadeInDown">
                <h2 class="fw-bold mb-2" style="color: #ec53d0;"><i class="bi bi-stars text-warning me-2"></i>Sự Kiện Hằng Năm</h2>
                <div class="mx-auto mt-2 rounded" style="width: 80px; height: 3px; background-color:#ff69b4;"></div>
            </div>

            <div class="events-timeline max-w-75 mx-auto">
                <!-- Event Card 1: Teacher's Day -->
                <div class="event-card animate__animated animate__fadeInUp rounded-4 shadow-lg border-0 overflow-hidden mb-5">
                    <div class="event-header position-relative bg-light">
                        <div class="swiper swiper1 h-100">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset('img/event11.jpg') }}" alt="Teacher's Day"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event12.jpg') }}" alt="Teacher's Day 2"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event13.jpg') }}" alt="Teacher's Day 3"></div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                    <div class="event-content p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center mb-2" style="color: #ff69b4; font-weight: 600;">
                            <i class="bi bi-calendar-check-fill me-2 fs-5"></i>
                            <span>20/11 hằng năm</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Ngày Nhà Giáo Việt Nam</h3>
                        <p class="event-description text-muted m-0" style="font-size: 1.05rem;">
                            Ngày Nhà Giáo Việt Nam (20/11) là một dịp đặc biệt để học sinh và toàn xã hội tri ân, tôn vinh những người thầy, người cô đã cống hiến cho sự nghiệp giáo dục. Đây là ngày để ghi nhận những nỗ lực và tâm huyết của các nhà giáo trong việc dạy dỗ.
                        </p>
                    </div>
                </div>

                <!-- Event Card 2: Vietnamese Women's Day -->
                <div class="event-card animate__animated animate__fadeInUp rounded-4 shadow-lg border-0 overflow-hidden mb-5">
                    <div class="event-header position-relative bg-light">
                        <div class="swiper swiper2 h-100">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset('img/event21.jpg') }}" alt="Vietnamese Women's Day"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event22.jpg') }}" alt="Vietnamese Women's Day 2"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event23.jpg') }}" alt="Vietnamese Women's Day 3"></div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                    <div class="event-content p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center mb-2" style="color: #ec53d0; font-weight: 600;">
                            <i class="bi bi-calendar-check-fill me-2 fs-5"></i>
                            <span>20/10 hằng năm</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Ngày Phụ Nữ Việt Nam</h3>
                        <p class="event-description text-muted m-0" style="font-size: 1.05rem;">
                            Ngày Phụ Nữ Việt Nam (20/10) là dịp để tôn vinh những đóng góp và vai trò quan trọng của phụ nữ trong gia đình và xã hội. Nỗ lực, sự hy sinh và cống hiến của mẹ, của bà và các cô giáo mầm non.
                        </p>
                    </div>
                </div>

                <!-- Các thẻ sự kiện 3,4,5 tương tự để gọn code nhưng không thiếu mục nào! -->
                <div class="event-card animate__animated animate__fadeInUp rounded-4 shadow-lg border-0 overflow-hidden mb-5">
                    <div class="event-header position-relative bg-light">
                        <div class="swiper swiper3 h-100">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset('img/event31.jpg') }}" alt="New Year"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event32.jpg') }}" alt="New Year"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event33.jpg') }}" alt="New Year"></div>
                            </div>
                            <div class="swiper-pagination"></div><div class="swiper-button-next"></div><div class="swiper-button-prev"></div>
                        </div>
                    </div>
                    <div class="event-content p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center mb-2 text-danger fw-semibold">
                            <i class="bi bi-calendar-check-fill me-2 fs-5"></i><span>01/01 hằng năm</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Tết Dương Lịch & Nguyên Đán</h3>
                        <p class="event-description text-muted m-0 fs-6">Đón năm mới và gìn giữ văn hóa qua hoạt động thú vị như cô giáo hướng dẫn gói bánh chưng cho các bé ngày đầu năm, để rèn thêm truyền thống quý báu.</p>
                    </div>
                </div>

                <!-- Mid-Autumn Festival -->
                <div class="event-card animate__animated animate__fadeInUp rounded-4 shadow-lg border-0 overflow-hidden mb-5">
                    <div class="event-header">
                        <div class="swiper swiper4 h-100">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset('img/event41.jpg') }}" alt="Autumn"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event42.jpg') }}" alt="Autumn 2"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/event43.jpg') }}" alt="Autumn 3"></div>
                            </div>
                            <div class="swiper-pagination"></div><div class="swiper-button-next"></div><div class="swiper-button-prev"></div>
                        </div>
                    </div>
                    <div class="event-content p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center mb-2 text-warning fw-semibold">
                            <i class="bi bi-moon-stars-fill me-2 fs-5"></i><span>15/08 Âm Lịch hằng năm</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Tết Trung Thu</h3>
                        <p class="event-description text-muted m-0 fs-6">Dịp Tết Thiếu nhi, hay còn gọi là Tết Trông Trăng, học múa lân, tham gia tự trải nghiệm thực tiễn học sinh mầm non tự làm và làm nặn bánh Trung Thu thật đặc biệt!</p>
                    </div>
                </div>

                <!-- Children Day Sport -->
                <div class="event-card animate__animated animate__fadeInUp rounded-4 shadow-lg border-0 overflow-hidden mb-5">
                    <div class="event-header">
                        <div class="swiper swiper5 h-100">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset('img/sport.jpg') }}" alt="Sports Day"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/sport2.jpg') }}" alt="Sports Day"></div>
                                <div class="swiper-slide"><img src="{{ asset('img/sport3.jpg') }}" alt="Sports Day"></div>
                            </div>
                            <div class="swiper-pagination"></div><div class="swiper-button-next"></div><div class="swiper-button-prev"></div>
                        </div>
                    </div>
                    <div class="event-content p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center mb-2 text-primary fw-semibold">
                            <i class="bi bi-bicycle me-2 fs-5"></i><span>27/03 hằng năm</span>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Ngày Thể Thao Việt Nam</h3>
                        <p class="event-description text-muted m-0 fs-6">Sự kiện các bé cùng cô chú thi sức bền nhún nhịp, chơi với thảm trải vui vẻ. Vận động kết bè thể chất giúp tư duy nhảy vọt tạo tinh thần tích cực mạnh mẻ dẻo giai !</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- Kéo JS thư viện SWIPER -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const commonSwiperConfig = {
        autoplay: { delay: 3500, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        loop: true
    };
    new Swiper('.swiper1', commonSwiperConfig);
    new Swiper('.swiper2', commonSwiperConfig);
    new Swiper('.swiper3', commonSwiperConfig);
    new Swiper('.swiper4', commonSwiperConfig);
    new Swiper('.swiper5', commonSwiperConfig);
</script>
@endsection