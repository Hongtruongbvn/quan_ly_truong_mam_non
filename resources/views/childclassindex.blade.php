@extends('layouts.dashboard')

@section('title', 'Quản Lý Lớp & Học Sinh')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ChildClass.css') }}">

<div class="container py-3">
    <!-- Nút trở về -->
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-inline-flex align-items-center gap-2" style="background-color: #ff69b4;">
            <i class="bi bi-arrow-left-circle fs-5"></i> Trở về Bảng Điều Khiển
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4" style="background-color: #fff9fc;">
        <div class="card-header bg-white py-4 border-bottom border-light text-center">
            <h3 class="fw-bold mb-1 text-uppercase" style="color: #ec53d0;"><i class="bi bi-person-lines-fill text-warning me-2"></i> Danh Sách Học Sinh Trong Lớp</h3>
            <p class="text-muted small m-0">Tra cứu thông tin theo phòng, sửa phân công nhóm lớp cho các bé.</p>
        </div>

        <div class="card-body p-4 p-md-5">
            <!-- Filter Search form -->
            <form action="{{ route('childclass.index') }}" method="GET" class="d-flex flex-wrap gap-2 align-items-end justify-content-center mb-5 bg-light p-3 rounded-4" style="border: 1px dashed #ffd1dc;">
                <div class="form-group mb-0 flex-grow-1" style="max-width: 400px;">
                    <label for="classroom_id" class="fw-bold mb-2 small text-uppercase" style="color: #ff69b4;">Trích lọc danh sách phòng lớp</label>
                    <div class="input-group shadow-sm rounded-3 overflow-hidden">
                        <span class="input-group-text bg-white border-0"><i class="bi bi-building"></i></span>
                        <select name="classroom_id" id="classroom_id" class="form-select border-0 px-3 bg-white text-dark fw-medium">
                            <option value="">-- Tra Tất cả Lớp/Phòng --</option>
                            @foreach($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" {{ request('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                    Nhóm lớp: {{ $classroom->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn text-white fw-bold shadow-sm px-4" style="background-color: #ff69b4; height: 38px;">Lọc <i class="bi bi-funnel ms-1"></i></button>
            </form>

            <!-- Table Data List -->
            <div class="table-responsive bg-white rounded-3 shadow-sm border border-light">
                <table class="table table-hover align-middle text-center mb-0">
                    <thead style="background-color: #ffe4e1;">
                        <tr>
                            <th class="py-3" style="color: #d6336c;"><i class="bi bi-person"></i> Tên Bé / Học Sinh</th>
                            <th class="py-3" style="color: #d6336c;"><i class="bi bi-houses"></i> Xếp Lớp</th>
                            <th class="py-3" style="color: #d6336c;"><i class="bi bi-calendar-check"></i> Ngày thêm vào</th>
                            <th class="py-3" style="color: #d6336c;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($childclasses as $childclass)
                            <tr>
                                <td class="fw-bold py-3 text-dark">{{ $childclass->child->name }}</td>
                                <td class="fw-semibold text-primary"><span class="badge bg-light text-primary border border-primary-subtle px-3 py-2 rounded-pill">{{ $childclass->classroom->name }}</span></td>
                                <td class="text-muted small fw-medium">{{ $childclass->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('childclass.edit', ['child_id' => $childclass->child_id, 'classroom_id' => $childclass->classroom_id]) }}" class="btn btn-warning btn-sm fw-bold px-3 shadow-sm rounded-pill">
                                        <i class="bi bi-pencil-square"></i> Cập nhật
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 bg-light text-muted fst-italic">
                                    Không tìm thấy dữ liệu học sinh nào trong phòng này.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endsection