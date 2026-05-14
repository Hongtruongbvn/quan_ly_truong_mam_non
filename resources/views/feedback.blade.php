@extends('layouts.dashboard')

@section('title', 'Feedback')

@section('content')
<div class="feedback-page bg-white p-4 p-md-5 rounded-4 shadow-sm border border-light">
    <!-- Khai CSS của bạn -->
    <link rel="stylesheet" href="{{ asset('css/Feedback.css') }}">
    
    <div class="row align-items-stretch">
        
        <!-- Bảng Form Điền -->
        <div class="col-lg-6 mb-4 mb-lg-0 order-2 order-lg-1">
            <div class="bg-light p-4 rounded-4 border-0 h-100" style="background-color: #fffafc !important;">
                <h3 class="fw-bold mb-2" style="color: #ec53d0;"><i class="bi bi-envelope-open me-2 text-warning"></i>Gửi phản hồi mới</h3>
                <p class="text-muted small mb-4">Để lại suy nghĩ góp ý xây dựng đến cơ sở trường học !</p>
                
                <!-- Code Backend thông báo Session báo -->
                @if($errors->any())
                    <div class="alert alert-danger shadow-sm border-0 px-3 py-2 fs-6">
                        <i class="bi bi-x-octagon-fill"></i> {{ $errors->first() }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success shadow-sm border-0 px-3 py-2 fs-6">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{route('feedbackSend')}}" method="POST">
                    @csrf 
                    <div class="form-group mb-3">
                        <label for="name" class="fw-bold mb-2" style="color: #ff69b4;">Họ & Tên của bạn</label>
                        <input type="text" id="name" name="name" class="form-control px-3 shadow-sm" placeholder="Nguyễn Văn A" style="border: 1px solid #ffd1dc;" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="fw-bold mb-2" style="color: #ff69b4;">Email Liên hệ phản hồi</label>
                        <input type="email" id="email" name="email" class="form-control px-3 shadow-sm" placeholder="email@vi-du.com" style="border: 1px solid #ffd1dc;" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="message" class="fw-bold mb-2" style="color: #ff69b4;">Trình Nội Dung</label>
                        <textarea id="message" name="message" rows="5" class="form-control px-3 shadow-sm" style="resize:none; border: 1px solid #ffd1dc;" placeholder="Bạn chia sẻ thêm cảm nhận và lời khuyên tới cơ sở mầm non ..." required></textarea>
                    </div>
                    <button type="submit" class="btn text-white fw-bold px-5 py-2 w-100 rounded-pill shadow-sm" style="background-color: #ff69b4; border:none; transition:0.3s;" onmouseover="this.style.backgroundColor='#ec53d0'" onmouseout="this.style.backgroundColor='#ff69b4'">
                       GỬI THÔNG ĐIỆP CHỜ XỬ LÍ
                    </button>
                </form>
            </div>
        </div>

        <!-- Banner + Thông Tin Liên Lạc (Khuấy đều bằng thông tin logo sang bên Right)-->
        <div class="col-lg-6 d-flex flex-column order-1 order-lg-2">
            <div class="logo text-center py-4 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-center align-items-center" style="background: linear-gradient(135deg, #ffe4e1 0%, #fff9fc 100%);">
                <img src="{{ asset('img/Login.png') }}" alt="Nursery PreSchool" class="logo-image shadow mb-4 rounded-circle border border-4 border-white" style="width: 140px; height: 140px; object-fit: cover;">
                <h3 class="fw-bold mb-3" style="color: #ec53d0;">Thông Tin Tòa Góp Ý</h3>
                <div class="text-start d-inline-block text-muted px-4 px-md-5 w-100" style="font-size: 0.95rem;">
                    <div class="d-flex align-items-start gap-3 mb-3 border-bottom pb-3">
                        <div class="mt-1"><i class="bi bi-building fs-4" style="color: #ff69b4;"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-1">NURSERY MẦM NON PRESCHOOL:</strong>
                            Tòa VinaTown, Tòa 184 Lê Đại Hành, Quận 11, TP HCM
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3 mb-3 border-bottom pb-3">
                         <div class="mt-1"><i class="bi bi-headset fs-4 text-primary"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-1">TRẠM GIAO THỨC TRẢ LỜI CÁ VỊ</strong>
                            Email Support: <a href="mailto:truongtruongbvn@gmail.com" class="text-decoration-none">truong@nurseryschool.vn</a> <br>
                            Tel Nóng Trực Gọi Lớp: +84 02334863
                        </div>
                    </div>
                     <div class="d-flex align-items-start gap-3">
                        <div class="mt-1"><i class="bi bi-clock fs-4 text-warning"></i></div>
                        <div>
                            <strong class="text-dark d-block mb-1">Giờ Thu Thập Báo Quản</strong>
                            Chạy Tối Ưu Báo Khứ - Mon T6  [ 6:00S => 17:00H]
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="mt-5 rounded-4 overflow-hidden border border-light">
    <div class="container-fluid" style="background-color: #f8f9fa;">
        <div class="row px-md-4 py-4 pt-5 align-items-center justify-content-between text-muted fs-6" style="border-top:3px solid #ff69b4;">
             <!-- Logo và Câu Bản Quyền footer làm kiểu chuyên nghiệp  -->
             <div class="col-12 col-md-auto text-center text-md-start mb-3 mb-md-0 d-flex flex-column gap-1">
                 <strong style="color: #ff69b4; font-size: 1.1rem;"><i class="bi bi-snow2"></i> PRE MẦM TRÍ ĐIỆN VỊ CHÚ.</strong>
                 <span>Môi trường sinh thân hiếu kính lành mạch cho tiểu đỗ học viện sinh!</span>
                 <div class="small">© Bản quyền sở hữu web trí NurserySchool2024. Cấm Lấp Khẩu Web</div>
             </div>
             
             <!-- List các icon mang hình thái MXH-->
             <div class="col-12 col-md-auto text-center">
                 <a href="#" class="btn btn-outline-primary border-0 rounded-circle"><i class="bi bi-facebook fs-4"></i></a>
                 <a href="#" class="btn border-0 rounded-circle" style="color: #E1306C;"><i class="bi bi-instagram fs-4"></i></a>
                 <a href="#" class="btn btn-outline-danger border-0 rounded-circle"><i class="bi bi-youtube fs-4"></i></a>
                 <a href="#" class="btn border-0 rounded-circle text-dark"><i class="bi bi-tiktok fs-4"></i></a>
             </div>
        </div>
    </div>
</footer>
@endsection