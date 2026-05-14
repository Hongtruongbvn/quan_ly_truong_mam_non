@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<!-- Liên kết vẫn file của bạn -->
<link rel="stylesheet" href="{{ asset('css/Rules.css') }}">

<div class="py-5 bg-white rounded-4 shadow-sm" style="border: 2px dashed #ffe4e1;">
    <div class="container px-md-5">
        
        <!-- Headers Section -->
        <div class="section-header text-center mb-5 pb-3">
            <h2 class="fw-bold animate__animated animate__fadeInDown" style="color: #ec53d0; font-size: 2.2rem;">
               <i class="bi bi-bookmark-star-fill text-warning"></i> Sổ Tay Kỷ Luật & Nội Quy
            </h2>
            <p class="text-muted fs-6 animate__animated animate__fadeIn mt-2">Nội dung này là cẩm nang chính thức nhằm giúp học sinh, giáo viên, phụ huynh cùng xây dựng nếp sinh hoạt chuẩn tại nhà trường.</p>
        </div>
        
        <!-- Layout Khối 5 Điều Bác Hồ  (Mặc dù rule CSS của bạn thiết kế hơi cam đỏ, ta override nhẹ để hồng)-->
        <div class="row justify-content-center mb-5 animate__animated animate__fadeInUp">
            <div class="col-lg-8">
                <div class="card border-0 shadow rounded-4 overflow-hidden" style="background-color: #ffe4e1;">
                    <div class="card-body p-4 p-md-5 text-center">
                         <h4 class="fw-bold mb-4" style="color: #ff69b4; text-transform: uppercase;">
                            <img src="{{ asset('img/tam.png') }}" alt="" style="width: 30px;" class="me-2"> 5 Điều Bác Hồ Dạy Mầm Non
                         </h4>
                         
                         <!-- Group Mới -->
                         <div class="list-group list-group-flush list-group-numbered fs-5 fw-medium bg-white rounded-3 shadow-sm text-start" style="color: #38383a; font-family: serif;">
                             <li class="list-group-item bg-transparent border-bottom" style="padding: 15px 20px;"><i class="bi bi-arrow-right-short text-danger"></i> Yêu Tổ quốc, yêu đồng bào.</li>
                             <li class="list-group-item bg-transparent border-bottom" style="padding: 15px 20px;"><i class="bi bi-arrow-right-short text-danger"></i> Học tập tốt, lao động tốt.</li>
                             <li class="list-group-item bg-transparent border-bottom" style="padding: 15px 20px;"><i class="bi bi-arrow-right-short text-danger"></i> Đoàn kết tốt, kỷ luật tốt.</li>
                             <li class="list-group-item bg-transparent border-bottom" style="padding: 15px 20px;"><i class="bi bi-arrow-right-short text-danger"></i> Giữ gìn vệ sinh thật tốt.</li>
                             <li class="list-group-item bg-transparent" style="padding: 15px 20px;"><i class="bi bi-arrow-right-short text-danger"></i> Khiêm tốn, thật thà, dũng cảm.</li>
                         </div>
                    </div>
                </div>
            </div>
        </div>

        <hr style="color:#f1d1e1;" class="my-5">

        <!-- Lưới Hiển thị Rule Bằng Card Bootsrtrap Tự Canh -->
        <div class="row g-4 align-items-stretch">
            
            <!-- Quy tắc 1 -->
            <div class="col-md-6 col-lg-4 animate__animated animate__fadeInLeft">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="background-color: #fffafc; transition: 0.3s;" onmouseover="this.style.transform='translateY(-10px)';" onmouseout="this.style.transform='translateY(0)';">
                    <h5 class="fw-bold" style="color: #ff69b4;"><i class="bi bi-1-square-fill text-info me-2"></i>Quy định thời gian</h5>
                    <p class="mt-3 text-muted" style="line-height:1.7;">
                        - Có mặt tại trường vào trước <strong>7h30 sáng</strong> và ba mẹ rước trước <strong>16h00 chiều</strong>.<br>
                        - PH vui lòng điện cho hotline hoặc nộp qua thư báo sớm để điều phối nếu muộn giờ rước.
                    </p>
                </div>
            </div>

            <!-- Quy tắc 2 -->
            <div class="col-md-6 col-lg-4 animate__animated animate__fadeInUp">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="background-color: #fffafc; transition: 0.3s;" onmouseover="this.style.transform='translateY(-10px)';" onmouseout="this.style.transform='translateY(0)';">
                    <h5 class="fw-bold" style="color: #ec53d0;"><i class="bi bi-2-square-fill text-success me-2"></i>Quy định đồng phục</h5>
                    <p class="mt-3 text-muted" style="line-height:1.7;">
                        - Học sinh yêu cầu thay mặc đồng phục sạch sẽ để duy trì kỷ luật nề nếp.<br>
                        - Quý thầy cô kiểm tra đảm bảo trang phục sạch, thoáng theo tiêu chí hoạt động mỗi tuần.
                    </p>
                </div>
            </div>

            <!-- Quy tắc 3 -->
            <div class="col-md-6 col-lg-4 animate__animated animate__fadeInRight">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="background-color: #fffafc; transition: 0.3s;" onmouseover="this.style.transform='translateY(-10px)';" onmouseout="this.style.transform='translateY(0)';">
                    <h5 class="fw-bold" style="color: #ff69b4;"><i class="bi bi-3-square-fill text-warning me-2"></i>Quy định an toàn</h5>
                    <p class="mt-3 text-muted" style="line-height:1.7;">
                        - Cấm đùa giỡn vị trí hành lang ướt hay xô đẩy mép cầu thang tầng lầu.<br>
                        - Yêu cầu GV cảnh báo tới BQL tòa nếu nhìn thấy thiết bị không ổn.
                    </p>
                </div>
            </div>

            <!-- Quy tắc 4 -->
            <div class="col-md-6 col-lg-6 animate__animated animate__fadeInLeft" style="animation-delay: 0.3s;">
                <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="background-color: #ffe4e1; transition: 0.3s;" onmouseover="this.style.transform='translateY(-10px)';" onmouseout="this.style.transform='translateY(0)';">
                    <h5 class="fw-bold text-dark"><i class="bi bi-4-square-fill text-danger me-2"></i>Không Gian Vệ Sinh Tập Thể</h5>
                    <p class="mt-3 text-muted" style="line-height:1.7;">
                        Dọn dẹp lại vỏ thực phẩm ngay khi sử dụng xong (phân vùng tái chế & hủy riêng ở trạm trường), xả gạt bồn rửa sau thời gian cá nhân và đặc biệt tự giác để ủng hộ hệ "Sạch, Rộng, Xanh"
                    </p>
                </div>
            </div>

            <!-- Quy tắc 5 -->
            <div class="col-md-12 col-lg-6 animate__animated animate__fadeInRight" style="animation-delay: 0.3s;">
                 <div class="card h-100 border-0 shadow-sm p-4 rounded-4" style="background-color: #f1d1e1; transition: 0.3s;" onmouseover="this.style.transform='translateY(-10px)';" onmouseout="this.style.transform='translateY(0)';">
                    <h5 class="fw-bold text-dark"><i class="bi bi-5-square-fill text-primary me-2"></i>Thái độ với mọi người</h5>
                    <p class="mt-3 text-muted" style="line-height:1.7;">
                        Nhân văn phải từ con người: Học mỉm cười và chào bác lao công mỗi buổi bước qua. Xưng bằng câu thân thuộc tôn kính các giáo phụ, xưng hô lễ với các đồng sinh bạn bé.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection