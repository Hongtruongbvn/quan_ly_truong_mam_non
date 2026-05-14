@extends('layouts.dashboard')

@section('title', 'Mục Tiêu Giáo Dục')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Goals.css') }}">

<div class="container goals-page bg-white p-4 p-md-5 rounded-4 shadow-sm border border-light" style="max-width: 900px; margin-top: 20px; margin-bottom: 40px;">

    <!-- Thanh quay về -->
    <div class="d-flex justify-content-start mb-4">
        <button id="back-button" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-flex align-items-center gap-2" style="background-color: #ff69b4; border:none;">
            <i class="bi bi-arrow-left-circle fs-5"></i> Quay về
        </button>
    </div>

    <!-- Header Thông tin -->
    <div class="text-center mb-5 border-bottom pb-4">
        <h2 class="fw-bold mb-3" style="color: #ec53d0;"><i class="bi bi-star-fill text-warning me-2"></i> Liên Kết Đến Mục Tiêu</h2>
        <p class="text-muted" style="font-size: 1.05rem;">
            Dưới đây là các mục tiêu chính mà chúng tôi hướng đến. Nhấn vào từng mục tiêu để xem chi tiết!
        </p>
    </div>

    <!-- Danh sách 11 mục tiêu dùng Code Text nguyên gốc của bạn -->
    <div class="accordion custom-accordion shadow-sm rounded-4 overflow-hidden" id="goalsAccordion" style="border: 1px solid #ffe4e1;">
        
        <!-- Mục tiêu 1 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading1">
                <button class="accordion-button fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true">
                    Mục Tiêu 1: Phát triển thể chất
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3" style="line-height: 1.8;">
                    <ul class="mb-0 ps-3">
                        <li>Khuyến khích các hoạt động vận động giúp trẻ khỏe mạnh, nhanh nhẹn, và dẻo dai.</li>
                        <li>Rèn luyện kỹ năng vận động cơ bản như chạy, nhảy, leo trèo, và kỹ năng vận động tinh như cầm nắm, viết, và vẽ.</li>
                        <li>Hình thành thói quen vệ sinh cá nhân và bảo vệ sức khỏe.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 2 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading2">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false">
                    Mục Tiêu 2: Phát triển nhận thức
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Khơi dậy sự tò mò, khám phá thế giới xung quanh.</li>
                        <li>Dạy trẻ nhận biết và phân biệt các màu sắc, hình dạng, con số, chữ cái.</li>
                        <li>Phát triển kỹ năng giải quyết vấn đề và tư duy logic thông qua các trò chơi và hoạt động học tập.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 3 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading3">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                    Mục Tiêu 3: Phát triển ngôn ngữ
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Khuyến khích trẻ giao tiếp, diễn đạt ý tưởng và cảm xúc bằng lời nói.</li>
                        <li>Mở rộng vốn từ vựng thông qua kể chuyện, hát, và các hoạt động học tập.</li>
                        <li>Giúp trẻ làm quen với việc đọc và viết ở mức độ cơ bản.</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Mục tiêu 4 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading4">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                    Mục Tiêu 4: Phát triển tình cảm và xã hội
                </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Hướng dẫn trẻ cách chia sẻ, hợp tác, và làm việc nhóm với bạn bè.</li>
                        <li>Giúp trẻ phát triển cảm xúc tích cực, biết yêu thương, tôn trọng, và đồng cảm với người khác.</li>
                        <li>Hình thành sự tự tin, tự lập và khả năng quản lý cảm xúc.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 5 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading5">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                    Mục Tiêu 5: Phát triển thẩm mỹ
                </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Nuôi dưỡng sự sáng tạo và cảm nhận nghệ thuật qua các hoạt động như vẽ, múa, hát, và làm đồ thủ công.</li>
                        <li>Khuyến khích trẻ thể hiện bản thân và cảm nhận cái đẹp từ thiên nhiên và cuộc sống.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 6 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading6">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6">
                    Mục Tiêu 6: Giáo dục đạo đức
                </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Hình thành các giá trị đạo đức cơ bản như lễ phép, trung thực, tôn trọng, và giúp đỡ người khác.</li>
                        <li>Hướng dẫn trẻ biết giữ gìn và bảo vệ môi trường xung quanh.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 7 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading7">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7">
                    Mục Tiêu 7: Phát triển kỹ năng sống
                </button>
            </h2>
            <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Rèn luyện kỹ năng tự phục vụ như tự ăn, tự mặc, và chăm sóc bản thân.</li>
                        <li>Giúp trẻ học cách ra quyết định và xử lý các tình huống đơn giản trong cuộc sống.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 8 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading8">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8">
                    Mục Tiêu 8: Kích thích tư duy sáng tạo
                </button>
            </h2>
            <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Khuyến khích trẻ đặt câu hỏi, suy nghĩ độc lập và tìm ra những cách mới để giải quyết vấn đề.</li>
                        <li>Tạo điều kiện cho trẻ tham gia các hoạt động sáng tạo như xây dựng mô hình, kể chuyện sáng tạo, và các trò chơi tưởng tượng.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 9 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading9">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9">
                    Mục Tiêu 9: Khám phá và bảo vệ môi trường
                </button>
            </h2>
            <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Hướng dẫn trẻ giữ gìn và bảo vệ môi trường xung quanh.</li>
                        <li>Thực hiện các hoạt động như trồng cây, phân loại rác, và tiết kiệm tài nguyên.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mục tiêu 10 -->
        <div class="accordion-item border-0 border-bottom border-light">
            <h2 class="accordion-header" id="heading10">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10">
                    Mục Tiêu 10: Chuẩn bị hành trang vào tiểu học
                </button>
            </h2>
            <div id="collapse10" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Giúp trẻ làm quen với môi trường học tập và các quy tắc lớp học.</li>
                        <li>Phát triển kỹ năng tập trung, làm việc độc lập và tự tin trước khi vào lớp 1.</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Mục tiêu 11 -->
        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="heading11">
                <button class="accordion-button collapsed fw-bold py-3 px-4 fs-6" style="background-color: #fff9fc; color: #ff69b4;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11">
                    Mục Tiêu 11: Môi trường yêu thương, tôn trọng
                </button>
            </h2>
            <div id="collapse11" class="accordion-collapse collapse" data-bs-parent="#goalsAccordion">
                <div class="accordion-body bg-light text-muted px-4 py-3">
                    <ul class="mb-0 ps-3">
                        <li>Hình thành các giá trị đạo đức cơ bản như lễ phép, trung thực, tôn trọng, và giúp đỡ người khác.</li>
                        <li>Giúp trẻ biết yêu thương và đồng cảm với mọi người xung quanh.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>

<style>
/* Ẩn box shadow màu xanh mặc định Bootstrap */
.accordion-button:not(.collapsed) { background-color: #ffe4e1 !important; color: #d6336c !important; box-shadow: none !important;}
.accordion-button:focus { box-shadow: none; border-color: #ffe4e1; }
</style>
@endsection