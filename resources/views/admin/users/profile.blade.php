@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/AccountProfile.css') }}">

<div class="profile-page" style="background: #fff; max-width: 900px; margin: 30px auto; padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.05);">
    
    <!-- Nút Quay lại -->
    <div class="back-button" style="margin-bottom: 25px;">
        <button onclick="window.history.back()" class="btn" style="background-color: #ff69b4; color: #fff; border: none; border-radius: 8px; padding: 8px 16px; transition: 0.3s;">
            <i class="fas fa-arrow-left"></i> Quay về trước
        </button>
    </div>

    <!-- Phía Trên: Ảnh & Chức Danh -->
    <div class="profile-header" style="display: flex; gap: 20px; align-items: center; background: #fffafc; padding: 20px; border-radius: 12px; border: 1px solid #ffe4e1; margin-bottom: 25px;">
        <div class="profile-image">
            @if($user->img)
                <img src="{{ asset('storage/' . $user->img) }}" alt="Hình thẻ" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; border: 4px solid #ffd6e7;">
            @else
                <div class="default-avatar" style="width: 140px; height: 140px; background-color: #ff69b4; color: white; display: flex; align-items: center; justify-content: center; font-size: 50px; font-weight: bold; border-radius: 50%; border: 4px solid #ffd6e7;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif
        </div>        
        <div class="profile-basic-info">
            <h1 style="color: #ec53d0; font-weight: bold; margin: 0 0 10px 0;">{{ $user->name }}</h1>
            <span style="display: inline-block; padding: 5px 15px; border-radius: 20px; background-color: {{ $user->role == 1 ? '#0dcaf0' : '#28a745' }}; color: #fff; font-weight: bold; font-size: 14px; margin-right: 10px;">
                {{ $user->role == 1 ? 'Thầy/Cô Giáo' : 'Phụ huynh bé' }}
            </span>
            <span style="display: inline-block; padding: 5px 15px; border-radius: 20px; background-color: {{ $user->status == 1 ? '#d4edda' : '#f8d7da' }}; color: {{ $user->status == 1 ? '#155724' : '#721c24' }}; font-weight: bold; font-size: 14px;">
                {{ $user->status == 1 ? 'Nick đang mở' : 'Nick bị khóa' }}
            </span>
        </div>
    </div>

    <div class="profile-content">
        <!-- Khung 1: Tin Tức Về Bản Thân -->
        <div class="info-section" style="margin-bottom: 30px;">
            <h2 style="color: #ff69b4; font-size: 20px; border-bottom: 2px dashed #ffe4e1; padding-bottom: 10px; margin-bottom: 20px;">Giới Thiệu Bản Thân</h2>
            <div class="info-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                
                <div style="background: #f9f9f9; padding: 15px; border-radius: 8px;">
                    <b style="color: #6a5acd; display: block; margin-bottom: 5px;">Hòm Thư Email:</b>
                    <span style="color: #333;">{{ $user->email }}</span>
                </div>
                
                <div style="background: #f9f9f9; padding: 15px; border-radius: 8px;">
                    <b style="color: #6a5acd; display: block; margin-bottom: 5px;">Cục Gạch (Phone):</b>
                    <span style="color: #333;">{{ $user->phone }}</span>
                </div>

                <div style="background: #f9f9f9; padding: 15px; border-radius: 8px;">
                    <b style="color: #6a5acd; display: block; margin-bottom: 5px;">Số CCCD:</b>
                    <span style="color: #333;">{{ $user->id_number }}</span>
                </div>

                <div style="background: #f9f9f9; padding: 15px; border-radius: 8px;">
                    <b style="color: #6a5acd; display: block; margin-bottom: 5px;">Là Nam hay Nữ?:</b>
                    <span style="color: #333;">
                        @switch($user->gender)
                            @case('male')
                                Chú/Anh Nam
                                @break
                            @case('female')
                                Cô/Chị Nữ
                                @break
                            @default
                                Khác
                        @endswitch
                    </span>
                </div>

                <div style="background: #f9f9f9; padding: 15px; border-radius: 8px; grid-column: 1 / -1;">
                    <b style="color: #6a5acd; display: block; margin-bottom: 5px;">Đang Ở Đâu?:</b>
                    <span style="color: #333;">{{ $user->address }}</span>
                </div>
            </div>
        </div>

        <!-- MÀN HÌNH NẾU LÀ GIÁO VIÊN -->
        @if($user->role == 1)
            <div class="info-section">
                <h2 style="color: #ff69b4; font-size: 20px; border-bottom: 2px dashed #ffe4e1; padding-bottom: 10px; margin-bottom: 20px;">Đang Dạy Các Lớp Này</h2>
                
                @if($classrooms->isEmpty())
                    <p style="color: #888;">Chưa thấy giao dạy lớp nào cả.</p>
                @else
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px;">
                        @foreach($classrooms as $classroom)
                            <div style="border: 1px solid #ffd6e7; padding: 20px; border-radius: 12px; background: #fffafc;">
                                <h3 style="color: #ec53d0; margin-top: 0;">Lớp: {{ $classroom->name }}</h3>
                                <p style="margin: 5px 0;"><strong>Trông bao nhiêu bé?:</strong> <b style="color:#d6336c">{{ $classroom->children->count() }}</b> bé</p>
                                <p style="margin: 5px 0; margin-bottom: 15px;"><strong>Còn học không?:</strong> {{ $classroom->status ? 'Đang học ngon ầm ầm' : 'Tạm nghỉ mở cửa' }}</p>
                                
                                <a href="{{ route('classrooms.show', $classroom->id) }}" class="btn" style="display:block; text-align:center; background:#ff69b4; color:#fff; padding:8px; border-radius:6px; text-decoration:none;">
                                    Ghé Coi Lớp Này
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        <!-- MÀN HÌNH NẾU LÀ PHỤ HUYNH -->
        @else
            <div class="info-section">
                <h2 style="color: #ff69b4; font-size: 20px; border-bottom: 2px dashed #ffe4e1; padding-bottom: 10px; margin-bottom: 20px;">Bé Nhà Đang Theo Học</h2>
                
                @if($children->isEmpty())
                    <p style="color: #888;">Trường chưa có tên của cục cưng nào trong hệ thống nhà mình.</p>
                @else
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                        @foreach($children as $child)
                            <div style="border: 1px solid #ffe4e1; padding: 15px; border-radius: 12px; background: #fffafc; display: flex; gap: 15px; align-items: center;">
                                
                                <!-- Ảnh con -->
                                <div>
                                    @if($child->img)
                                        <img src="{{ asset('storage/' . $child->img) }}" alt="Tên bé" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid #ff69b4;">
                                    @else
                                        <div style="width: 80px; height: 80px; display:flex; justify-content:center; align-items:center; background: #ff69b4; color:#fff; border-radius:50%; font-size:24px; font-weight:bold;">
                                            {{ strtoupper(substr($child->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Dữ liệu con -->
                                <div>
                                    <h3 style="color: #ec53d0; margin: 0 0 5px 0; font-size:18px;">{{ $child->name }}</h3>
                                    <p style="margin:0; font-size:14px; color:#555;"><b>Sanh nhật:</b> {{ \Carbon\Carbon::parse($child->birthDate)->format('d/m/Y') }}</p>
                                    <p style="margin:0; font-size:14px; color:#555;"><b>Con:</b> {{ $child->gender == 1 ? 'Trai ngoan' : 'Gái rượu' }}</p>
                                    @if($child->classroom->first())
                                        <p style="margin:0; font-size:14px; color:#555;"><b>Học Phòng:</b> <span style="color:#d6336c; font-weight:bold;">{{ $child->classroom->first()->name }}</span></p>
                                    @endif
                                    
                                    <a href="{{ route('children.show', $child->id) }}" style="display:inline-block; margin-top:8px; background:#48d1cc; color:#fff; font-size:13px; padding:4px 10px; border-radius:4px; text-decoration:none;">Xem Kĩ Bảng Lớp Bé</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
button:hover { opacity: 0.8; transform: translateY(-2px); }
</style>
@endsection