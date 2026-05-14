@extends('layouts.dashboard')
@section('content')
<div class="schedule-create-container">
    <link rel="stylesheet" href="{{ asset('css/ScheduleIndex.css') }}">
    
    <div class="form-card">
        <h1 class="form-title">Tạo lịch học</h1>
        
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
         
        <form action="{{ route('schedule.store') }}" method="POST" class="schedule-form">
            @csrf
            
            <div class="form-group">
                <label for="classroom_id">Lớp học</label>
                <select name="classroom_id" id="classroom_id" class="form-control" required>
                    <option value="">-- Chọn lớp học --</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="subject_id">Môn học</label>
                <select name="subject_id" id="subject_id" class="form-control" required>
                    <option value="">-- Chọn môn học --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="date">Ngày học</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="lesson">Tiết học</label>
                <select name="lesson" id="lesson" class="form-control" required>
                    <option value="">-- Chọn tiết học --</option>
                    <option value="Tiết 1 (7h30 - 8h05)">Tiết 1 (7h30 - 8h05)</option>
                    <option value="Tiết 2 (8h15 - 8h50)">Tiết 2 (8h15 - 8h50)</option>
                    <option value="Tiết 3 (9h00 - 9h35)">Tiết 3 (9h00 - 9h35)</option>
                    <option value="Tiết 4 (9h45 - 10h15)">Tiết 4 (9h45 - 10h20)</option>
                    <option value="Tiết 5 (10h30 - 11h15)">Tiết 5 (10h30 - 11h15)</option>
                    <option value="Tiết 6 (13h30 - 14h05)">Tiết 6 (13h30 - 14h05)</option>
                    <option value="Tiết 7 (14h15 - 14h50)">Tiết 7 (14h15 - 14h50)</option>
                    <option value="Tiết 8 (15h00 - 15h35)">Tiết 8 (15h00 - 15h35)</option>
                    <option value="Tiết 9 (15h45 - 16h20)">Tiết 9 (15h45 - 16h20)</option>
                    <option value="Tiết 10 (16h30 - 17h05)">Tiết 10 (16h30 - 17h05)</option>
                </select>
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn-primary">Tạo lịch học</button>
                <a href="{{ route('subjects.index') }}" class="btn-glow">Thêm môn học</a>
                <a href="{{ route('schedule.show') }}" class="btn-glow">Xem lịch học</a>
            </div>
        </form>
       
        @if($errors->any())
            <div class="alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</div>

<style>
/* Container chính */
.schedule-create-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #ffe4e1 0%, #fff0f5 100%);
    padding: 40px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Thẻ form */
.form-card {
    max-width: 650px;
    width: 100%;
    margin: 0 auto;
    background: white;
    border-radius: 32px;
    padding: 36px 32px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Tiêu đề */
.form-title {
    font-size: 28px;
    font-weight: bold;
    color: #d63384;
    text-align: center;
    margin-bottom: 28px;
    position: relative;
}

.form-title::after {
    content: '';
    width: 60px;
    height: 3px;
    background: #ff69b4;
    display: block;
    margin: 12px auto 0;
    border-radius: 10px;
}

/* Nhóm form */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: bold;
    color: #555;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #ffe0f0;
    border-radius: 16px;
    font-size: 15px;
    transition: all 0.2s;
    background: #fef9fc;
}

.form-control:focus {
    outline: none;
    border-color: #ff69b4;
    box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
}

/* Nhóm nút */
.button-group {
    display: flex;
    gap: 12px;
    margin-top: 28px;
    flex-wrap: wrap;
}

.btn-primary {
    flex: 1;
    background: #ff69b4;
    color: white;
    border: none;
    padding: 14px 20px;
    border-radius: 40px;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
}

.btn-primary:hover {
    background: #e05297;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(255, 105, 180, 0.3);
}

.btn-glow {
    flex: 1;
    background: #6c5ce7;
    color: white;
    text-decoration: none;
    padding: 14px 20px;
    border-radius: 40px;
    font-weight: bold;
    font-size: 16px;
    text-align: center;
    transition: all 0.2s;
}

.btn-glow:hover {
    background: #5b4bc4;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(108, 92, 231, 0.3);
    color: white;
    text-decoration: none;
}

/* Thông báo */
.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 14px 18px;
    border-radius: 16px;
    margin-bottom: 24px;
    border-left: 5px solid #28a745;
    font-size: 14px;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    padding: 14px 18px;
    border-radius: 16px;
    margin-top: 20px;
    border-left: 5px solid #dc3545;
    font-size: 14px;
}

/* Responsive */
@media (max-width: 550px) {
    .form-card {
        padding: 24px 20px;
    }
    .form-title {
        font-size: 24px;
    }
    .button-group {
        flex-direction: column;
    }
    .btn-primary, .btn-glow {
        width: 100%;
    }
}
</style>
@endsection