@extends('layouts.dashboard')

@section('content')
<style>
    .subjects-wrapper {
        max-width: 750px;
        margin: 30px auto;
        padding: 0 20px;
    }
    .subjects-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 15px 35px rgba(236, 83, 208, 0.1);
        overflow: hidden;
        padding: 30px;
    }
    .subjects-title {
        color: #c2185b;
        font-weight: 800;
        font-size: 28px;
        text-align: center;
        margin-bottom: 25px;
        position: relative;
    }
    .subjects-title:after {
        content: '';
        width: 60px;
        height: 3px;
        background: #ec53d0;
        display: block;
        margin: 12px auto 0;
        border-radius: 10px;
    }
    .alert-success-custom {
        background: #e8f5e9;
        border-left: 5px solid #4caf50;
        padding: 12px 18px;
        border-radius: 16px;
        margin-bottom: 25px;
        color: #2e7d32;
    }
    .add-form {
        display: flex;
        gap: 12px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    .add-form input {
        flex: 1;
        border: 1.5px solid #f0b3df;
        border-radius: 50px;
        padding: 12px 18px;
        font-size: 15px;
        transition: all 0.2s;
    }
    .add-form input:focus {
        border-color: #ec53d0;
        box-shadow: 0 0 0 3px rgba(236, 83, 208, 0.15);
        outline: none;
    }
    .btn-add-subject {
        background: linear-gradient(95deg, #ec53d0, #ff80bf);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 28px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-add-subject:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(236, 83, 208, 0.35);
    }
    .subjects-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .subject-item {
        background: #fff9fc;
        border-radius: 20px;
        padding: 15px 20px;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        border: 1px solid #ffe0f0;
        transition: all 0.2s;
    }
    .subject-item:hover {
        transform: translateX(4px);
        border-color: #ec53d0;
    }
    .subject-name {
        font-weight: 600;
        color: #333;
        font-size: 16px;
    }
    .edit-form {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    .edit-form input {
        border: 1.5px solid #f0b3df;
        border-radius: 40px;
        padding: 8px 16px;
        font-size: 14px;
    }
    .btn-update {
        background: #ffe4e1;
        color: #c2185b;
        border: none;
        border-radius: 40px;
        padding: 8px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-update:hover {
        background: #ec53d0;
        color: white;
    }
    .list-header {
        color: #c2185b;
        font-weight: 700;
        font-size: 20px;
        margin: 25px 0 15px;
    }
</style>

<div class="subjects-wrapper">
    <div class="subjects-card">
        <h1 class="subjects-title">📚 Danh sách môn học</h1>

        @if (session('success'))
            <div class="alert-success-custom">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Form thêm mới -->
        <form action="{{ route('subjects.store') }}" method="POST" class="add-form">
            @csrf
            <input type="text" name="name" placeholder="Tên môn học (Ví dụ: Toán, Tiếng Việt...)" required>
            <button type="submit" class="btn-add-subject">➕ Thêm môn</button>
        </form>

        <div class="list-header">📖 Các môn đang có:</div>
        <ul class="subjects-list">
            @foreach ($subjects as $subject)
                <li class="subject-item">
                    <span class="subject-name">{{ $subject->name }}</span>
                    <form action="{{ route('subjects.update', $subject->id) }}" method="POST" class="edit-form">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" value="{{ $subject->name }}" required>
                        <button type="submit" class="btn-update">✏️ Cập nhật</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection