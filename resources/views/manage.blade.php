@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Timetable.css') }}">
<div class="d-flex justify-content-start mb-4">
    <a href="{{ route('admin.dashboard')}}" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-flex align-items-center gap-2" style="background-color: #007bff; border:none;">
        <i class="bi bi-arrow-left"></i> Quay về
    </a>
</div>

<main class="card shadow-sm border-0 rounded-4 mx-auto w-100 mb-5" style="max-width: 800px; border: 1px solid #ffd1dc !important;">
    <div class="card-header bg-white text-center py-4 border-0 border-bottom border-light">
        <h1 class="page-title fw-bold m-0" style="color: #ec53d0;">
            Quản Lý Học Kỳ
        </h1>
    </div>
    
    <div class="card-body p-4 p-md-5">
        
        @if(session('success'))
            <div class="alert alert-success fs-6 px-3 py-2 border-0 shadow-sm">
                 {{ session('success') }}
            </div>
        @endif

        <div class="semester-list mt-3">
            <h2 class="fw-bold mb-3 fs-4 border-bottom pb-2 text-dark">Danh Sách Học Kỳ</h2>
            
            @if(count($semesters) > 0)
                <ul class="list-group list-group-flush rounded-3 border overflow-hidden">
                    @foreach($semesters as $semester)
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-white p-3">
                            <span class="fw-medium text-dark">
                                {{ $semester }}
                            </span>
                            
                            <div class="actions">
                                <form action="{{ route('timetable.deleteSemester', ['semester' => $semester]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded shadow-sm fw-bold px-3 py-1" onclick="return confirm('Bạn có chắc muốn xóa học kỳ này?')">
                                        Xóa
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Chưa có học kỳ nào được tạo.</p>
            @endif
        </div>
    </div>
</main>
@endsection