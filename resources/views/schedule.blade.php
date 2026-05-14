@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/NurserySchedule.css') }}">

<div class="container py-4">
    <!-- Nút trở về -->
    <div class="d-flex justify-content-start mb-4">
        <a href="javascript:history.back();" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-flex align-items-center gap-2" style="background-color: #ff69b4; border:none;">
            <i class="bi bi-arrow-left-circle fs-5"></i> Quay Về
        </a>
    </div>

    <!-- Nội dung bảng -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5 mx-auto" style="background-color: #fff9fc; max-width: 900px; border: 1px solid #ffd1dc !important;">
        <div class="card-header border-0 text-center py-4 bg-white border-bottom border-light">
            <h3 class="fw-bold mb-0" style="color: #ec53d0;"><i class="bi bi-calendar2-check text-warning me-2"></i> Lịch Trình Nursery</h3>
        </div>

        <div class="card-body p-4 p-md-5 text-center">
            <div class="table-responsive bg-white rounded-3 shadow-sm border border-light">
                <table class="table table-bordered table-hover align-middle m-0 text-center">
                    <thead style="background-color: #ffebf0;">
                        <tr>
                            <th class="py-3" style="color: #d6336c;">Thời gian</th>
                            <th class="py-3" style="color: #d6336c;">Hoạt động</th>
                            <th class="py-3" style="color: #d6336c;">Giáo viên</th>
                            <th class="py-3" style="color: #d6336c;">Ghi chú</th>
                            <th class="py-3" style="color: #d6336c;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-semibold">08:00 - 09:00</td>
                            <td class="fw-bold">Đón trẻ</td>
                            <td class="text-primary">Cô A</td>
                            <td class="text-muted">-</td>
                            <td>
                                <button class="btn btn-warning btn-sm text-dark px-3 fw-semibold shadow-sm rounded-pill me-1"><i class="bi bi-pencil-square"></i> Chỉnh sửa</button>
                                <button class="btn btn-danger btn-sm px-3 fw-semibold shadow-sm rounded-pill text-white"><i class="bi bi-trash"></i> Xóa</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">09:00 - 10:00</td>
                            <td class="fw-bold">Học tập nhóm</td>
                            <td class="text-primary">Cô B</td>
                            <td class="text-muted">-</td>
                            <td>
                                <button class="btn btn-warning btn-sm text-dark px-3 fw-semibold shadow-sm rounded-pill me-1"><i class="bi bi-pencil-square"></i> Chỉnh sửa</button>
                                <button class="btn btn-danger btn-sm px-3 fw-semibold shadow-sm rounded-pill text-white"><i class="bi bi-trash"></i> Xóa</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="text-center mt-4">
                <button class="btn px-4 py-2 fw-bold text-white shadow-sm rounded-pill" style="background-color: #ff69b4;">
                    <i class="bi bi-plus-lg me-1"></i> Thêm Lịch Trình
                </button>
            </div>
        </div>
    </div>
</div>
@endsection