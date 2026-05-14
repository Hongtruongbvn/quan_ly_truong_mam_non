@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Timetable.css') }}">
<div class="d-flex justify-content-start mb-4">
    <button id="back-button" class="btn btn-secondary px-3 py-2 shadow-sm rounded-pill fw-bold text-white d-flex align-items-center gap-2" style="background-color: #ff69b4; border:none;">
        <i class="bi bi-arrow-left-circle fs-5"></i> Trở về
    </button>
</div>

<main class="card shadow border-0 rounded-4 w-100 mb-5 overflow-hidden mx-auto" style="background-color: #fff9fc; max-width: 1100px;">
    <div class="card-header bg-white text-center py-4 border-bottom border-light">
        <h3 class="fw-bold m-0 text-uppercase d-flex align-items-center justify-content-center" style="color: #ec53d0;">
            <i class="bi bi-calendar3-range text-warning me-3"></i> Tùy Chỉnh Thời Khóa Biểu
        </h3>
        <p class="text-muted small mt-2 mb-0">Hệ thống phân rã khung giờ hỗ trợ gõ nhanh môn học</p>
    </div>

    <div class="card-body p-4 p-md-5">
        @if (session('message'))
            <div class="alert alert-success fs-6 shadow-sm border-0 d-flex align-items-center mb-4 rounded-3">
                 <i class="bi bi-check2-circle fs-4 me-2"></i> {{ session('message') }}
            </div>
        @endif

        <form id="timetable-form" action="{{ route('timetable.save') }}" method="POST" onsubmit="return validateForm()">
            @csrf
            
            <!-- Ô Nhập Khóa / Học kỳ -->
            <div class="mb-4 text-center">
                <label for="semester" class="fw-bold d-block mb-2 fs-5" style="color: #ff69b4;"><i class="bi bi-award-fill"></i> Thiết lập Khóa/Học kỳ mới:</label>
                <div class="input-group w-100 mx-auto" style="max-width: 600px;">
                    <span class="input-group-text bg-light border-end-0" style="border-color:#ffe4e1;"><i class="bi bi-pen"></i></span>
                    <input type="text" id="semester" name="semester" class="form-control border-start-0 py-2 fw-medium shadow-none" placeholder="VD: Học kỳ 1 (13/12/2024 - 13/4/2025)" style="border-color:#ffe4e1;" required>
                </div>
            </div>

            <!-- Khung Lưới Bảng Cấp Quyền Render Bằng Vòng For Lặp Gốc -->
            <div class="table-responsive bg-white rounded-3 shadow-sm border border-light">
                <table class="table table-bordered table-hover align-middle text-center m-0" style="min-width: 800px;">
                    <thead style="background-color: #ffe4e1;">
                        <tr class="text-muted" style="border-bottom: 2px solid #ff69b4;">
                            <th scope="col" class="py-3" style="color: #ec53d0;"><i class="bi bi-list-ol"></i> Tiết</th>
                            <th scope="col" class="py-3" style="color: #ec53d0;"><i class="bi bi-clock-history"></i> Thời Gian</th>
                            <th scope="col" class="py-3">Thứ 2</th>
                            <th scope="col" class="py-3">Thứ 3</th>
                            <th scope="col" class="py-3">Thứ 4</th>
                            <th scope="col" class="py-3">Thứ 5</th>
                            <th scope="col" class="py-3">Thứ 6</th>
                            <th scope="col" class="py-3">Thứ 7</th>
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
                            <!-- Trạng thái Giải Lao / Giờ Chơi Phủ Trọn Row Nhạt Đi Để Người Dùng Có Sự Nghỉ ngơi trong mắt -->
                            <tr class="break-row bg-light" style="background-color: #f8f9fa !important;">
                                <td colspan="8" class="text-center fw-bold py-2" style="color: #fca5c5;"><i class="bi bi-cup-hot-fill me-2 text-warning"></i> {{ $time }} <i class="bi bi-cup-hot-fill ms-2 text-warning"></i></td>
                            </tr>
                        @else
                            <tr>
                                <th class="fw-bold" style="color: #6c757d;">Tiết {{ is_numeric($period) ? $period : '' }}</th>
                                <td class="fw-medium text-danger"><span class="badge rounded-pill" style="background-color: #ffe4e1; color:#ff69b4;">{{ $time }}</span></td>
                                
                                @for($day = 2; $day <= 7; $day++)
                                    <td class="p-2">
                                        <input 
                                            type="text" 
                                            class="form-control text-center shadow-none border t{{ $day }} p{{ $period }}" 
                                            name="schedule[t{{ $day }}][p{{ $period }}]" 
                                            placeholder="Gõ môn..." 
                                            style="font-size: 0.9rem;"
                                            required>
                                    </td>
                                @endfor
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Button Điều Hướng -->
            <div class="mt-4 text-center d-flex flex-wrap gap-3 justify-content-center">
                <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #ff69b4;"><i class="bi bi-floppy"></i> Lưu thời khóa biểu</button>
                <a href="{{ route('timetable.view') }}" class="btn fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #ffe4e1; color: #ec53d0;"><i class="bi bi-eye"></i> Xem Lịch Học Ngay</a>
                <a href="{{ route('timetable.manage') }}" class="btn fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #fff0f5; border:1px solid #ff69b4; color:#ff69b4;"><i class="bi bi-archive"></i> Quản Lý Ký Học / Block</a>
            </div>
        </form>
    </div>
</main>

<script>
    function validateForm() {
        const inputs = document.querySelectorAll('#timetable-form input[type="text"]');
        for (let input of inputs) {
            if (!input.value.trim()) {
                alert('Có Thể Bạn Đã Quên? Vui lòng bổ túc thêm các khung Giờ trống còn lại nha!');
                input.focus();
                return false;
            }
        }
        return true;
    }

    // Sự Kiện Cho Button Nổi Lên Góc Trái Cùng Này (Khôi Phục UI Đỉnh Hơn)
    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>
@endsection