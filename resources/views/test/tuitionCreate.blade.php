@extends('layouts.dashboard')

@section('content')
<style>
    .tuition-create-wrapper {
        max-width: 750px;
        margin: 30px auto;
        padding: 0 20px;
    }
    .tuition-create-card {
        background: white;
        border-radius: 32px;
        box-shadow: 0 18px 35px rgba(236, 83, 208, 0.1);
        overflow: hidden;
        padding: 30px 35px;
    }
    .tuition-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }
    .tuition-header h1 {
        color: #c2185b;
        font-weight: 800;
        font-size: 26px;
        margin: 0;
    }
    .btn-back-tuition {
        background: #ffe4e1;
        color: #c2185b;
        padding: 8px 22px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-back-tuition:hover {
        background: #ec53d0;
        color: white;
        transform: translateY(-2px);
    }
    .form-group-custom {
        margin-bottom: 22px;
    }
    .form-label-custom {
        color: #c2185b;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    .form-control-custom {
        border: 1.5px solid #f0b3df;
        border-radius: 16px;
        padding: 12px 16px;
        width: 100%;
        transition: all 0.2s;
    }
    .form-control-custom:focus {
        border-color: #ec53d0;
        box-shadow: 0 0 0 3px rgba(236, 83, 208, 0.15);
        outline: none;
    }
    .detail-section {
        background: #fff9fc;
        border-radius: 24px;
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #ffe0f0;
    }
    .detail-section h5 {
        color: #c2185b;
        font-weight: 700;
        margin-bottom: 18px;
        font-size: 18px;
    }
    .tuition-detail-item {
        background: white;
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 18px;
        border: 1px solid #f3e0ec;
    }
    .btn-add {
        background: #ffe4e1;
        color: #c2185b;
        padding: 10px 24px;
        border: none;
        border-radius: 40px;
        font-weight: 600;
        margin-right: 12px;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-add:hover {
        background: #ec53d0;
        color: white;
        transform: translateY(-2px);
    }
    .btn-submit {
        background: linear-gradient(95deg, #ec53d0, #ff80bf);
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.25s;
        cursor: pointer;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(236, 83, 208, 0.35);
    }
    .alert-success-custom {
        background: #e8f5e9;
        border-left: 5px solid #4caf50;
        padding: 14px 20px;
        border-radius: 18px;
        margin-bottom: 25px;
        color: #2e7d32;
    }
    @media (max-width: 650px) {
        .tuition-create-card {
            padding: 20px;
        }
        .tuition-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>

<div class="tuition-create-wrapper">
    <div class="tuition-create-card">
        <div class="tuition-header">
            <h1>📝 Tạo học phí</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn-back-tuition">← Quay về</a>
        </div>

        @if(session('success'))
            <div class="alert-success-custom">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tuition.store') }}" method="POST">
            @csrf

            <!-- Chọn lớp -->
            <div class="form-group-custom">
                <label class="form-label-custom">🏫 Lớp học</label>
                <select name="classroom_id" id="classroom_id" class="form-control-custom" required>
                    <option value="">-- Chọn lớp học --</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group-custom">
                <label class="form-label-custom">📆 Tháng / Học kỳ</label>
                <input type="text" name="semester" id="semester" class="form-control-custom" placeholder="Ví dụ: Tháng 9 - 2025" required>
            </div>

            <div class="detail-section" id="tuition-details">
                <h5>📋 Chi tiết các khoản thu</h5>
                <div class="tuition-detail-item">
                    <div class="form-group-custom">
                        <label class="form-label-custom">📌 Tên khoản thu</label>
                        <input type="text" name="tuition_details[0][name]" class="form-control-custom" placeholder="Tiền ăn, tiền học..." required>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom">💰 Số tiền (VNĐ)</label>
                        <input type="number" name="tuition_details[0][price]" class="form-control-custom" placeholder="Ví dụ: 500000" required max="2000000">
                    </div>
                </div>
            </div>

            <button type="button" id="add-detail" class="btn-add">➕ Thêm khoản thu khác</button>
            <button type="submit" class="btn-submit">💾 Lưu học phí</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-detail').addEventListener('click', function () {
        const tuitionDetails = document.getElementById('tuition-details');
        const index = tuitionDetails.getElementsByClassName('tuition-detail-item').length;
        const newDetail = `
            <div class="tuition-detail-item">
                <div class="form-group-custom">
                    <label class="form-label-custom">📌 Tên khoản thu</label>
                    <input type="text" name="tuition_details[${index}][name]" class="form-control-custom" placeholder="Tiền ăn, tiền học..." required>
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom">💰 Số tiền (VNĐ)</label>
                    <input type="number" name="tuition_details[${index}][price]" class="form-control-custom" placeholder="Ví dụ: 500000" required max="2000000">
                </div>
            </div>
        `;
        tuitionDetails.insertAdjacentHTML('beforeend', newDetail);
    });
</script>
@endsection