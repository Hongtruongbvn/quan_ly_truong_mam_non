@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/TuitionManagement.css') }}">
<div class="container py-3">
    
    <div class="d-flex justify-content-start mb-4">
        <button id="back-button" class="btn btn-secondary px-3 py-2 shadow-sm rounded-pill fw-bold text-white d-flex align-items-center gap-2" style="background-color: #007bff; border:none;">
            <i class="bi bi-arrow-left"></i> Quay về
        </button>
    </div>

    <div class="card shadow-sm border-0 rounded-4 w-100 mx-auto overflow-hidden p-4 p-md-5" style="max-width: 900px; background-color: #fff5f7;">
        
        <h1 class="fw-bold text-center m-0 mb-4" style="color: #ff5c8d;">Quản lý học phí</h1>
        
        <div class="actions mb-4 text-end">
            <a href="{{ route('tuition.create') }}" class="btn px-4 py-2 rounded-3 text-white fw-bold shadow-sm" style="background-color: #ff69b4;">Tạo học phí</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success fs-6 shadow-sm border-0 mb-4 rounded-3">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('tuition.index') }}" class="row g-4 mb-4">
            <div class="col-md-6 form-group mb-0">
                <label for="classroom_id" class="form-label fw-bold text-dark mb-1">Chọn Lớp</label>
                <select name="classroom_id" id="classroom_id" class="form-control shadow-none" onchange="this.form.submit()">
                    <option value="">-- Chọn lớp --</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ request('classroom_id') == $classroom->id ? 'selected' : '' }}>
                            {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 form-group mb-0">
                <label for="children_id" class="form-label fw-bold text-dark mb-1">Chọn học sinh</label>
                <select name="children_id" id="children_id" class="form-control shadow-none" onchange="this.form.submit()">
                    <option value="">-- Chọn học sinh --</option>
                    @foreach($children as $child)
                        <option value="{{ $child->id }}" {{ request('children_id') == $child->id ? 'selected' : '' }}>
                            {{ $child->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if($selectedChild)
            <div class="child-info mb-4 bg-white p-4 rounded-4 shadow-sm border">
                <h3 class="mb-3" style="color: #ff5c8d;">Thông tin trẻ</h3>
                <p class="mb-1 text-dark"><strong>Tên phụ huynh:</strong> {{ $selectedChild->user->name }}</p>
                <p class="mb-1 text-dark"><strong>Ngày sinh:</strong> {{ $selectedChild->birthDate }}</p>
                <p class="mb-0 text-dark"><strong>Giới tính:</strong> {{ $selectedChild->gender == 1 ? 'Nam' : 'Nữ' }}</p>
            </div>

            <div class="table-responsive bg-white rounded-3 shadow-sm border">
                <table class="table tuition-table table-hover align-middle text-center mb-0">
                    <thead style="background-color: #ff5c8d; color: white;">
                        <tr>
                            <th class="py-3">Kỳ học</th>
                            <th class="py-3">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($selectedChild->tuition as $tuition)
                            <tr>
                                <td class="fw-bold py-3 text-dark">{{ $tuition->semester }}</td>
                                <td>
                                    {{ $tuition->status ? 'Đã đóng' : 'Chưa đóng' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>
@endsection