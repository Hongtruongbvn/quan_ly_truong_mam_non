@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/FacilitiesIndex.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container py-4 animate__animated animate__fadeIn">
    <!-- Khu vực đầu trang -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h3 class="fw-bold mb-0 text-pink"><i class="fas fa-couch me-2"></i> Quản lý Đồ đạc - Cơ sở vật chất</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn fw-bold text-white shadow-sm rounded-pill px-4" style="background-color: #ff69b4;" id="back-button">
            <i class="fas fa-arrow-left me-1"></i> Trở về trang trước
        </a>
    </div>

    <!-- Nút thêm đồ dùng bự dễ thấy -->
    <div class="mb-4 text-center text-sm-start">
        <a href="{{ route('facility_management.create') }}" class="btn btn-success fw-bold px-4 py-2 shadow-sm rounded-pill">
            <i class="fas fa-plus-circle me-1"></i> Khai báo nhóm đồ dùng mới
        </a>
    </div>

    <!-- Danh sách theo dạng khung lưới -->
    <div class="row g-4">
        @foreach($totals as $total)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" style="border-top: 4px solid #0d6efd !important;">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold m-0" style="color: #0d6efd;">
                            <i class="fas fa-layer-group me-1 opacity-75"></i> {{ $total->name }}
                        </h4>
                    </div>
                    
                    <div class="card-body mt-2 p-4 pt-2">
                        <div class="p-3 bg-light rounded-3 border mb-4">
                            <h6 class="fw-bold text-secondary mb-3"><i class="fas fa-boxes me-1 text-warning"></i> Chi tiết đồ dùng trong kho:</h6>
                            <ul class="list-group list-group-flush rounded bg-white">
                                @forelse($total->dentail as $dentail)
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-bottom text-dark py-2">
                                        <span class="fw-semibold">{{ $dentail->name }}</span>
                                        <span class="badge bg-secondary rounded-pill" style="font-size:13px">Còn: {{ $dentail->quantity }} cái</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted py-2 fst-italic">Trống (Không có đồ đạc nào)</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Phần khu thao tác đẩy dưới đít khối thẻ -->
                    <div class="card-footer bg-white border-top text-center py-3">
                        <a href="{{ route('facility_management.edit', ['total' => $total->id]) }}" class="btn btn-outline-primary btn-sm rounded-pill fw-bold w-100 shadow-sm">
                            <i class="fas fa-pen me-1"></i> Vào thêm số lượng / Sửa đổi
                        </a>
                        <!-- Form xóa bị ẩn bằng code HTML của bạn lúc trước. Nếu muốn có thể dùng form bên dưới 
                        <form action="{{ route('facility_management.destroy', ['total' => $total->id]) }}" method="POST" style="display:inline;">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-outline-danger btn-sm w-100 mt-2">Xóa bỏ cụm đồ này</button>
                        </form> -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

<style>
    .text-pink { color: #ff69b4; }
</style>
<script>
    // Giữ nút quay lại js thuần cho trang.
    document.getElementById('back-button').addEventListener('click', function (e) {
        if(window.history.length > 1) {
             e.preventDefault();
             window.history.back();
        }
    });
</script>
@endsection