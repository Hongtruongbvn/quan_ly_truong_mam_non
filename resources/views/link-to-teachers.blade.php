@extends('layouts.dashboard')

@section('title', 'Đội Ngũ Giảng Dạy')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Teachers.css') }}"> 

<div class="container py-4 mb-5">
    <div class="d-flex justify-content-start mb-4">
        <button id="back-button" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-flex align-items-center gap-2" style="background-color: #ff69b4; border:none;">
            <i class="bi bi-arrow-left-circle fs-5"></i><span> Quay về</span>
        </button>
    </div>

    <!-- Lời ngỏ ngắn gọn -->
    <div class="text-center mb-5 pb-2">
        <h2 class="fw-bold text-uppercase mb-3" style="color: #ec53d0;">
            <i class="bi bi-people-fill text-warning me-2"></i> Đội Ngũ Giáo Viên Của Bé
        </h2>
        <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.05rem;">
            Những người thầy, người cô giàu kinh nghiệm, chuyên nghiệp và đầy tình yêu thương. Trách nhiệm của chúng tôi là cùng ba mẹ nuôi dưỡng trẻ trưởng thành khỏe mạnh và hạnh phúc.
        </p>
        <div class="mx-auto mt-3 rounded-pill shadow-sm" style="width: 80px; height: 3px; background-color: #ff69b4;"></div>
    </div>

    <!-- Giáo viên Nam -->
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm mb-5" style="border: 1px solid #ffe4e1;">
        <h4 class="fw-bold mb-4 border-start border-4 ps-3" style="color: #ff69b4; border-color: #ff69b4 !important;">Giáo Viên Nam</h4>
        
        <div class="row g-4 justify-content-center">
            @forelse ($maleTeachers as $teacher)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center overflow-hidden hover-card">
                        <div class="pt-4 pb-5" style="background-color: #f1d1e1;">
                            @if ($teacher->img)
                                <img src="{{ asset('storage/' . $teacher->img) }}" class="rounded-circle border border-4 border-white shadow-sm object-fit-cover bg-white" style="width: 120px; height: 120px;" alt="{{ $teacher->name }}">
                            @else
                                <div class="rounded-circle border border-4 border-white shadow-sm mx-auto d-flex align-items-center justify-content-center bg-white" style="width: 120px; height: 120px; color: #ff69b4; font-size: 2.5rem;">
                                     <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body bg-white rounded-top-4 mt-n4 z-1 position-relative p-4" style="box-shadow: 0 -8px 10px rgba(0,0,0,0.02);">
                            <h5 class="fw-bold mb-2" style="color: #ec53d0;">{{ $teacher->name }}</h5>
                            <span class="badge bg-light text-muted border rounded-pill px-3 py-2 mb-3">Thể chất & Kỹ năng</span>
                            <p class="small text-muted mb-0"><i class="bi bi-envelope text-primary me-1"></i> {{ $teacher->email }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p class="mb-0 fst-italic">Hiện tại chưa có dữ liệu giáo viên.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Giáo viên Nữ -->
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm" style="border: 1px solid #ffe4e1;">
        <h4 class="fw-bold mb-4 border-start border-4 ps-3" style="color: #ec53d0; border-color: #ec53d0 !important;">Giáo Viên Nữ</h4>
        
        <div class="row g-4 justify-content-center">
            @forelse ($femaleTeachers as $teacher)
                 <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center overflow-hidden hover-card">
                        <div class="pt-4 pb-5" style="background-color: #ffe4e1;">
                            @if ($teacher->img)
                                <img src="{{ asset('storage/' . $teacher->img) }}" class="rounded-circle border border-4 border-white shadow-sm object-fit-cover bg-white" style="width: 120px; height: 120px;" alt="{{ $teacher->name }}">
                            @else
                                <div class="rounded-circle border border-4 border-white shadow-sm mx-auto d-flex align-items-center justify-content-center bg-white" style="width: 120px; height: 120px; color: #ec53d0; font-size: 2.5rem;">
                                     <i class="bi bi-person-heart"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body bg-white rounded-top-4 mt-n4 z-1 position-relative p-4" style="box-shadow: 0 -8px 10px rgba(0,0,0,0.02);">
                            <h5 class="fw-bold mb-2" style="color: #ff69b4;">Cô {{ $teacher->name }}</h5>
                            <span class="badge bg-light text-muted border rounded-pill px-3 py-2 mb-3">Tận tâm & Yêu thương</span>
                            <p class="small text-muted mb-0"><i class="bi bi-envelope text-primary me-1"></i> {{ $teacher->email }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p class="mb-0 fst-italic">Hiện tại chưa có dữ liệu giáo viên.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.hover-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.hover-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(255, 105, 180, 0.1) !important; }
.mt-n4 { margin-top: -1.5rem !important; }
</style>

<script>
    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>
@endsection