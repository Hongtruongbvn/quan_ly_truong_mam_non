<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá học sinh theo ngày</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@extends('layouts.dashboard') 
@section('content')
<style>
    .evaluate-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }
    .evaluate-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 15px 35px rgba(236, 83, 208, 0.1);
        overflow: hidden;
        padding: 30px;
    }
    .evaluate-title {
        color: #c2185b;
        font-weight: 800;
        font-size: 26px;
        text-align: center;
        margin-bottom: 28px;
        position: relative;
    }
    .evaluate-title:after {
        content: '';
        width: 60px;
        height: 3px;
        background: #ec53d0;
        display: block;
        margin: 12px auto 0;
        border-radius: 10px;
    }
    .btn-back-eval {
        background: #ffe4e1;
        color: #c2185b;
        padding: 8px 22px;
        border: none;
        border-radius: 40px;
        font-weight: 600;
        margin-bottom: 20px;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-back-eval:hover {
        background: #ec53d0;
        color: white;
        transform: translateY(-2px);
    }
    .form-label-pink {
        color: #c2185b;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    .custom-input-eval {
        border: 1.5px solid #f0b3df;
        border-radius: 16px;
        padding: 12px 16px;
        width: 100%;
        transition: all 0.2s;
    }
    .custom-input-eval:focus {
        border-color: #ec53d0;
        box-shadow: 0 0 0 3px rgba(236, 83, 208, 0.15);
        outline: none;
    }
    .btn-submit-eval {
        background: linear-gradient(95deg, #ec53d0, #ff80bf);
        color: white;
        font-weight: 700;
        padding: 12px 30px;
        border: none;
        border-radius: 50px;
        margin-top: 15px;
        transition: all 0.25s;
        cursor: pointer;
    }
    .btn-submit-eval:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(236, 83, 208, 0.35);
    }
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        background: #ffe4e1;
        border-radius: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        font-weight: bold;
        color: #c2185b;
        margin: 0 auto;
        border: 3px solid #ec53d0;
    }
    .child-image-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 60px;
        border: 3px solid #ec53d0;
        margin: 0 auto;
    }
    .alert-success-custom {
        background: #e8f5e9;
        border-left: 5px solid #4caf50;
        padding: 12px 18px;
        border-radius: 16px;
        margin-top: 20px;
        color: #2e7d32;
    }
    .alert-danger-custom {
        background: #ffebee;
        border-left: 5px solid #e91e63;
        padding: 12px 18px;
        border-radius: 16px;
        margin-top: 20px;
        color: #c2185b;
    }
</style>

<div class="evaluate-wrapper">
    <button id="back-button" class="btn-back-eval">← Quay về</button>
    
    <div class="evaluate-card">
        <h2 class="evaluate-title">📝 Đánh giá học sinh theo ngày</h2>
        
        <form action="{{ route('evaluate') }}" method="post">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-pink">👧 Chọn học sinh</label>
                    <select name="child_id" id="child_id" class="custom-input-eval" required>
                        <option value="" disabled selected>-- Chọn học sinh --</option>
                        @foreach($children as $child)
                            <option value="{{ $child->id }}" data-img="{{ $child->img ? asset('storage/' . $child->img) : '' }}">
                                {{ $child->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 text-center">
                    <img id="child_image" src="" alt="Ảnh học sinh" class="child-image-preview" style="display: none;">
                    <div id="default_avatar" class="avatar-placeholder" style="display: none;"></div>
                </div>

                <div class="col-md-6">
                    <label class="form-label-pink">📅 Ngày đánh giá</label>
                    <input type="date" name="date" id="date" class="custom-input-eval" required>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label-pink">📝 Nhận xét</label>
                    <textarea name="comment" id="comment" class="custom-input-eval" rows="3" maxlength="255" placeholder="Nhận xét về học sinh hôm nay..."></textarea>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label-pink">⭐ Xếp loại</label>
                    <select name="point" id="point" class="custom-input-eval">
                        <option value="" disabled selected>-- Chọn xếp loại --</option>
                        <option value="10">🌟 Xuất sắc</option>
                        <option value="8">👍 Giỏi</option>
                        <option value="6">👌 Khá</option>
                        <option value="4">📖 Trung bình</option>
                        <option value="2">🌱 Yếu</option>
                    </select>
                </div>
                
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn-submit-eval">💾 Gửi đánh giá</button>
                </div>
            </div>
            
            @if(session('success'))
                <div class="alert-success-custom">✅ {{ session('success') }}</div>
            @endif
            
            @if($errors->any())
                <div class="alert-danger-custom">⚠️ {{ $errors->first() }}</div>
            @endif
        </form>
    </div>
</div>

<!-- Modal quy định -->
<div class="modal fade" id="rulesModal" tabindex="-1" aria-labelledby="rulesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 24px;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title fw-bold" style="color:#c2185b;" id="rulesModalLabel">📌 Quy định khi đánh giá</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul style="padding-left: 20px;">
                    <li>⏰ Chỉ được nhận xét trong vòng <b>24 giờ</b> cùng ngày.</li>
                    <li>📅 Qua <b>24 giờ</b> sẽ tự động bỏ trống.</li>
                    <li>💯 Đánh giá <b>trung thực</b>, không gian dối.</li>
                </ul>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button type="button" class="btn" style="background:#ffe4e1; color:#c2185b; border-radius:40px;" data-bs-dismiss="modal">Đã hiểu</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hiển thị modal
        const rulesModal = new bootstrap.Modal(document.getElementById('rulesModal'));
        rulesModal.show();
        
        const childSelect = document.getElementById('child_id');
        const childImage = document.getElementById('child_image');
        const defaultAvatar = document.getElementById('default_avatar');

        childSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const imgSrc = selectedOption.getAttribute('data-img');
            const nameInitial = selectedOption.textContent.trim().charAt(0).toUpperCase();

            if (imgSrc && imgSrc !== '') {
                childImage.src = imgSrc;
                childImage.style.display = 'block';
                defaultAvatar.style.display = 'none';
            } else {
                childImage.style.display = 'none';
                defaultAvatar.textContent = nameInitial;
                defaultAvatar.style.display = 'flex';
            }
        });

        // Nút quay về
        document.getElementById('back-button').addEventListener('click', function () {
            window.history.back();
        });
    });
</script>
@endsection
</body>
</html>