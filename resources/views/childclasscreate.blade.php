@extends('layouts.dashboard')

@section('title', 'Phân Lớp Cho Học Sinh Mới')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ChildClass.css') }}">

<div class="container py-3 max-w-75 mx-auto" style="max-width: 700px;">
    <!-- Nút trở về -->
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-inline-flex align-items-center gap-2" style="background-color: #ff69b4;">
            <i class="bi bi-arrow-left-circle fs-5"></i> Bảng quản trị Admin
        </a>
    </div>

    <div class="card border-0 shadow-lg rounded-4" style="background-color: #fff9fc;">
        <div class="card-header bg-transparent text-center border-bottom pt-4 pb-3">
            <h3 class="fw-bold mb-0 text-uppercase" style="color: #ec53d0;"><i class="bi bi-person-plus-fill text-info me-2"></i> Thêm bé vào nhóm lớp</h3>
        </div>

        <div class="card-body p-4 p-md-5">
            <!-- Khu Alert Gữi Gốc Logic Của Framework-->
            @if(session('success'))
                <div class="alert alert-success fs-6 shadow-sm border-0 d-flex align-items-center mb-4 rounded-3"><i class="bi bi-check2-circle fs-4 me-2"></i>{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger fs-6 shadow-sm border-0 d-flex align-items-center mb-4 rounded-3"><i class="bi bi-x-octagon-fill fs-5 me-2"></i>{{ session('error') }}</div>
            @endif

            <form action="{{ route('childclass.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="child_id" class="form-label fw-bold text-uppercase small" style="color: #ff69b4;">1. Lựa Chọn Bé / Trẻ Đang Thụt Tịch</label>
                    <select name="child_id" id="child_id" class="form-select border shadow-sm px-3 py-2 fw-medium" style="border-color:#ffe4e1;" required>
                        <option value="">-- Vui lòng click tìm Trẻ cần nhập xếp --</option>
                        @foreach($children as $child)
                            <option value="{{ $child->id }}">ID#{{ $child->id }} - {{ $child->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="classroom_id" class="form-label fw-bold text-uppercase small" style="color: #ff69b4;">2. Xếp phòng lớp quy đổi chuẩn</label>
                    <select name="classroom_id" id="classroom_id" class="form-select border shadow-sm px-3 py-2 fw-medium" style="border-color:#ffe4e1;" required>
                        <option value="">-- Chọn danh phòng nhóm phù hợp tuổi --</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="d-flex flex-wrap gap-3 mt-5 pt-3 border-top justify-content-center">
                    <button type="submit" class="btn text-white fw-bold shadow-sm px-4 py-2 rounded-pill w-100 w-sm-auto" style="background-color: #ec53d0;"><i class="bi bi-folder-plus"></i> Đóng Nhóm Lớp Lại</button>
                    <a href="{{ route('childclass.index') }}" class="btn text-primary bg-white border border-primary-subtle fw-bold shadow-sm px-4 py-2 rounded-pill w-100 w-sm-auto"><i class="bi bi-search"></i> Truy Vết Tra Sách Gắn Xếp</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection