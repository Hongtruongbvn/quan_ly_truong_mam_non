@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/ClassroomsIndex.css') }}">

<div class="classes-container" style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
    
    <div class="back-button" style="margin-bottom: 20px;">
        <button id="back-button" class="btn btn-primary" style="background-color: #ff69b4; border: none; border-radius: 8px; transition: transform 0.3s;">
            <i class="fas fa-arrow-left"></i> Quay lại Trang Quản Trị
        </button>
    </div>

    <div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #ffe4e1; padding-bottom: 15px; flex-wrap:wrap; gap:15px;">
        <h1 style="color: #ec53d0; font-weight: bold; margin: 0; font-size: 24px;">Danh Sách Lớp Học Tại Trường</h1>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('facility_management.index') }}" class="btn btn-secondary" style="border-radius: 8px; border:none; padding:8px 15px; color:#fff; background-color:#6a5acd; text-decoration:none;">Quản lý Đồ dùng của Trường</a>
            <a href="{{ route('classrooms.create') }}" class="btn-add" style="background-color: #ff69b4; color: #fff; border-radius: 8px; text-decoration: none; padding: 8px 15px; box-shadow: 0 4px 6px rgba(255, 105, 180, 0.3);">+ Thêm Lớp học mới</a>
        </div>
    </div>

    <!-- Ô Bảng Tổng Quát (Giao diện Khung Hiển thị cho nhiều dòng lặp Foreach) -->
    <div class="classes-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        @foreach($classrooms as $class)
            <div class="class-card" style="background-color: #fef9fc; border: 1px solid #ffe4e1; border-radius: 12px; padding: 20px; transition: transform 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                
                <div class="class-info">
                    <h3 style="color: #ff69b4; font-size: 20px; font-weight: bold;">Lớp: {{ $class->name }}</h3>
                    <p style="color: #555; margin-bottom: 6px; font-size:15px;">
                        <strong>Cô Giáo Chủ Nhiệm:</strong> {{ $class->user ? $class->user->name : 'Vẫn Chưa Sắp Lịch Ai Giữ Trẻ.' }}
                    </p>
                    <p style="color: #555; margin-bottom: 12px; font-size:15px;">
                        <strong>Hiện Tình Trạng Lớp:</strong> 
                        <span style="background-color: {{ $class->status == 1 ? '#d4edda' : '#f8d7da' }}; color: {{ $class->status == 1 ? '#155724' : '#721c24' }}; padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight:bold;">
                            {{ $class->status == 1 ? 'Lớp Đang Đón Nhận Bé Chăm Học' : 'Xin Tạm Tạm Cắt Khóa (Phòng Trống)' }}
                        </span>
                    </p>
                    
                    <hr style="border-top: 1px dashed #ffd6e7;">
                    <h5 style="color: #d6336c; font-size: 16px; font-weight:bold;">Cơ Sở Các Thiết Bị Mang Xuống Lớp:</h5>
                    
                    @if($class->facilities->isEmpty())
                        <p style="color: #888; font-style: italic; font-size:14px; background:#fff; border-radius:5px; padding:8px;">Trời, Bức Thư Lạ Không ! Góc Này Lớp Học Mãi  Phải Sớm Sắp Trang Chứ Bạn!</p>
                    @else
                        <ul style="padding-left: 20px; color: #555; font-size:14px;">
                            @foreach($class->facilities as $facility)
                                <li style="margin-bottom:5px;"> Món Tên Là : <b style="color: #ff69b4;">{{ $facility->name ?? 'Thiết Vật Sạc Gọn Có Kêu Trống?' }}</b> (Số Gộp Tổng: <b>{{ $facility->quantity }}</b> cái mượn tay).</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                
                <div class="class-actions" style="margin-top: 20px; text-align: center;">
                    <a href="{{ route('classrooms.edit', $class->id) }}" class="btn-edit" style="display: block; width: 100%; border-radius: 8px; background-color: #ec53d0; box-shadow: 0 4px 8px rgba(236, 83, 208, 0.4); color:#fff; text-decoration:none; padding:10px; font-size: 15px; font-weight:bold; transition:all 0.2s;">
                        Mở Quyền Điều Phân Thiết Thiết Các Phối Gọn Cho Cột Cô Vị 🔧 
                    </a>
                </div>

            </div>
        @endforeach
    </div>

</div>

<script>
document.getElementById('back-button').addEventListener('click', function () {
    window.history.back();
});
</script>

<style>
/* Bạn nhịp đưa chuột lên ô Khung Chữ để có nãy bật rất xịn Sò đây ^^*/
.class-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; border-color:#ff69b4 !important;}
.btn-edit:hover { background-color: #d63384 !important; transform: scale(1.02); }
#back-button:hover { transform: scale(1.05); }
</style>

@endsection