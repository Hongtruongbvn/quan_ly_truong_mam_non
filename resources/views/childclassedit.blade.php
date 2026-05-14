@extends('layouts.dashboard')

@section('title', 'Cập Nhật - Sang Bảng Chỉnh Bé Qua Tổ')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ChildClass.css') }}">

<div class="container py-3 max-w-75 mx-auto" style="max-width: 700px;">
    
    <div class="mb-4">
        <a href="javascript:history.back()" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-inline-flex align-items-center gap-2" style="background-color: #ff69b4;">
            <i class="bi bi-arrow-return-left fs-5"></i> Rút Nút Quành Form Cũ 
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4" style="background-color: #fff9fc; border:1px solid #ffd1dc !important;">
        <div class="card-header text-center border-0 py-4" style="background: linear-gradient(135deg, #ffe4e1 0%, #fff9fc 100%);">
            <h3 class="fw-bold mb-0 text-uppercase" style="color: #ec53d0;"><i class="bi bi-gear-fill text-muted me-2"></i> Điều Hành Dịch Tổ Sáng Phòng Chuyển Bé</h3>
            <p class="text-muted m-0 small mt-1">Tính năng Cập Nhật Bản Khóa Gắn Định Kỳ Môn Lên Nhóm Sinh Mới</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <!-- Thụ Tin Trả Log Của Server Cắt -->
            @if(session('success')) <div class="alert alert-success fs-6 py-2 px-3"><i class="bi bi-check-circle"></i> {{ session('success') }}</div> @endif
            @if(session('error')) <div class="alert alert-danger fs-6 py-2 px-3"><i class="bi bi-x-octagon"></i> {{ session('error') }}</div> @endif
            @if(session('info')) <div class="alert alert-info fs-6 py-2 px-3"><i class="bi bi-info-circle"></i> {{ session('info') }}</div> @endif

            <form action="{{ route('childclass.update', ['child_id' => $childclass->child_id, 'classroom_id' => $childclass->classroom_id]) }}" method="POST">
                @csrf
                
                <div class="mb-4 p-3 bg-light rounded-3" style="border-left: 4px solid #ff69b4;">
                    <label for="child_id" class="form-label fw-bold" style="color: #d6336c;">Sự Vụ Học Đồng / Nắm Thông ( Đóng / Cập nhật Chặn Cải Thay)</label>
                    <!-- Read-only select state is sometimes helpful during EDIt forms - We will render what UI says-->
                    <select name="child_id" id="child_id" class="form-select border-0 shadow-sm fw-bold bg-white text-muted">
                        @foreach($children as $child)
                            <option value="{{ $child->id }}" {{ $childclass->child_id == $child->id ? 'selected' : '' }}>
                                MÃ BÉ#{{ $child->id }} • {{ $child->name }} 
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="classroom_id" class="form-label fw-bold text-uppercase small" style="color: #ec53d0;">Phòng Chuyên Mới Ấn Định Tổ Vãng : </label>
                    <select name="classroom_id" id="classroom_id" class="form-select border shadow-sm px-3 py-2 fw-medium" style="border-color:#ffb6c1;" required>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ $childclass->classroom_id == $classroom->id ? 'selected' : '' }}>
                                Tổ Hiện Chạy Bề Tên => Khóa/Nhóm  {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center mt-5">
                    <button type="submit" class="btn text-white fw-bold px-5 py-2 rounded-pill shadow" style="background-color: #ff69b4; letter-spacing:0.5px;">
                        <i class="bi bi-pencil-square me-1"></i> NHẬP DUYỆT TÍNH ĐỘI NHÓM ( Update Save )
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection