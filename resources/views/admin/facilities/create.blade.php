@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/FacilitiesCreation.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container py-4 d-flex justify-content-center">
    <!-- Khung bọc giới hạn size form và tạo bóng mượt -->
    <div class="card border-0 shadow-lg rounded-4 w-100" style="max-width: 750px;">
        <div class="card-body p-5 bg-white">
            
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h3 class="fw-bold m-0" style="color: #ff69b4;"><i class="fas fa-boxes me-2"></i> Khai báo Mảng thiết bị mới</h3>
                <button type="button" id="back-button" class="btn fw-bold text-white shadow-sm rounded-pill px-4" style="background-color: #ff5c8d;">
                    <i class="fas fa-arrow-left me-1"></i> Đóng
                </button>
            </div>

            <form action="{{ route('facility_management.store') }}" method="POST">
                @csrf
                
                <div class="form-group p-3 bg-light rounded-3 mb-4 border">
                    <label for="name" class="fw-bold text-dark fs-6"><i class="fas fa-tags text-primary me-2"></i> Ghi tên tổng loại kho / đồ dùng (VD: Đồ điện tử, bàn ghế...):</label>
                    <input type="text" id="name" name="name" class="form-control form-control-lg border-secondary shadow-sm rounded-3 mt-2" placeholder="Ghi tên mục to tổng quản..." required>
                </div>

                <div class="mt-4 p-4 border rounded-3 bg-white" style="border-top: 4px solid #ffbaf2 !important;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold m-0 text-pink"><i class="fas fa-list-ul me-2 text-warning"></i> Điền các mặt hàng nhỏ gọn gộp vào kho trên:</h5>
                        <button type="button" id="add-dentail" class="btn btn-outline-success btn-sm shadow-sm fw-bold rounded-pill">
                            <i class="fas fa-plus"></i> Cho vào 1 món mới
                        </button>
                    </div>

                    <!-- DIV CHÍNH HÚT DATA JAVASCRIPT GÁN MÃ VÀO -->
                    <div id="dentail-details">
                        <!-- Component sẽ mọc vào trong ô rỗng này bằng js! -->
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary fw-bold text-white fs-5 w-50 shadow-sm py-2 rounded-pill" style="background-color: #ff69b4; border:none">
                        <i class="fas fa-check-circle me-1"></i> Lưu và Lập sổ sách
                    </button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script>
    // Logic của bạn KHÔNG TĂNG CHẠM TÊN NAME NẾU KO TRÚNG DATABASE !!! - Tôi CHỈ NHÉT HTML Bootrap VÀO LÕI THÔI. 
    document.getElementById('add-dentail').addEventListener('click', function () {
        const dentailDetails = document.getElementById('dentail-details');
        const index = dentailDetails.getElementsByClassName('dentail-detail').length;
        const newDetail = `
            <div class="dentail-detail row g-2 mb-3 bg-light p-3 rounded-3 shadow-sm border align-items-end animate__animated animate__fadeIn">
                <div class="col-md-7">
                    <label for="dentail[${index}][name]" class="fw-semibold text-secondary"> Tên loại mặt hàng <small>(Ví dụ: Đồ chơi A, Quạt Trần)</small></label>
                    <input type="text" name="dentail[${index}][name]" class="form-control mt-1 shadow-none" placeholder="Tên sản phẩm con..." required>
                </div>
                <div class="col-md-5">
                    <label for="dentail[${index}][quantity]" class="fw-semibold text-secondary"> Số lượng nhập ban đầu</label>
                    <div class="input-group mt-1">
                        <span class="input-group-text bg-white"><i class="fas fa-hashtag text-pink"></i></span>
                        <input type="number" name="dentail[${index}][quantity]" class="form-control shadow-none" placeholder="VD: 5" required>
                    </div>
                </div>
            </div>
        `;
        dentailDetails.insertAdjacentHTML('beforeend', newDetail);
    });
    
    // Nút quay về dùng Window JS vì Button Nằm Xuyên DOM.
    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>
<style>
    .text-pink { color: #ff69b4;}
</style>
@endsection