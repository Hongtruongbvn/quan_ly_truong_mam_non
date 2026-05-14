@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/TimetableT.css') }}">

<div class="container py-3">
    <!-- Nút trở về nguyên tác -->
    <div class="d-flex justify-content-start mb-4">
        <button id="back-button" class="btn px-4 py-2 shadow-sm rounded-pill fw-bold text-white d-flex align-items-center gap-2" style="background-color: #6c757d; border:none;">
            <i class="bi bi-arrow-left fs-5"></i> Quay về
        </button>
    </div>

    <main class="card shadow border-0 rounded-4 w-100 mb-5 overflow-hidden mx-auto" style="background-color: #fff9fc; max-width: 1100px;">
        <div class="card-header bg-white text-center py-4 border-bottom border-light">
            <h1 class="page-title fw-bold m-0" style="color: #ec53d0;">Xem thời khóa biểu</h1>
        </div>
        
        <div class="card-body p-4 p-md-5 text-center">
            
            <div class="form-group d-flex justify-content-center align-items-center gap-2 mb-4">
                <label for="semester-select" class="fw-bold mb-0 text-dark">Chọn học kỳ: </label>
                <div class="shadow-sm rounded-2 bg-white">
                     <form method="GET" action="{{ route('timetable.view') }}" class="m-0">
                        <select id="semester-select" name="semester" class="form-select border-0 px-3 py-2 fw-medium text-dark" style="background-color: #f8f9fa;" onchange="this.form.submit()">
                            @foreach($semesters as $semester)
                                <option value="{{ $semester }}" {{ $selectedSemester == $semester ? 'selected' : '' }}>
                                    {{ $semester }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            @if($schedule)
                <!-- Lưới thời khóa biểu  -->
                <div class="table-responsive bg-white rounded-3 shadow-sm border border-light mt-3">
                    <table class="table table-bordered align-middle text-center m-0">
                        <thead style="background-color: #ffe4e1;">
                            <tr class="text-dark" style="border-bottom: 2px solid #ff69b4;">
                                <th class="py-3">Tiết</th>
                                <th class="py-3">Thời gian</th>
                                <th class="py-3">Thứ 2</th>
                                <th class="py-3">Thứ 3</th>
                                <th class="py-3">Thứ 4</th>
                                <th class="py-3">Thứ 5</th>
                                <th class="py-3">Thứ 6</th>
                                <th class="py-3">Thứ 7</th>
                            </tr>
                        </thead>
                       <tbody>
                        @php
                            $times =[
                                '1' => '7:30 - 8:05',
                                '2' => '8:15 - 8:50',
                                'break_1' => '9:00 - 9:35 Giờ ra chơi buổi sáng',
                                '3' => '9:45 - 10:15',
                                '4' => '10:30 - 11:15',
                                'break_2' => 'Nghỉ nửa buổi', 
                                '5' => '13:30 - 14:05',
                                '6' => '14:15 - 14:50',
                                'break_3' => '15:00 - 15:35 Giờ ra chơi buổi chiều',
                                '7' => '15:45 - 16:20',
                                '8' => '16:30 - 17:05'
                            ];
                        @endphp

                        @foreach($times as $period => $time)
                            @if(str_contains($period, 'break'))
                                <tr class="break-row bg-light" style="background-color: #f8f9fa !important;">
                                    <td colspan="8" class="text-center fw-bold py-2 text-muted">{{ $time }}</td> 
                                </tr>
                            @else
                                <tr>
                                    <th class="fw-bold" style="color: #6c757d;">Tiết {{ is_numeric($period) ? $period : '' }}</th>
                                    <td class="fw-medium text-danger">{{ $time }}</td>
                                    @for($day = 2; $day <= 7; $day++)
                                        <td class="px-2 py-3 text-dark">
                                            {{ $schedule["t$day"]["p$period"] ?? '' }}
                                        </td>
                                    @endfor
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('timetable.exportPDF', ['semester' => $selectedSemester]) }}" class="btn text-white px-4 py-2 fw-bold rounded-3 shadow-sm" style="background-color: #007bff;">Xuất PDF</a>
                </div>
            @else
                <p class="text-muted fst-italic mt-4">Không có dữ liệu thời khóa biểu cho học kỳ này.</p>
            @endif
        </div>
    </main>
</div>

<script>
    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>
@endsection