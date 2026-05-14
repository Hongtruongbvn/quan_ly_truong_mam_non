@extends('layouts.dashboard')

@section('title', 'Hòm thư ý kiến')

@section('content')
<link rel="stylesheet" href="{{ asset('css/FeedbackList.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container py-4 animate__animated animate__fadeIn">
    <!-- Khu vực tiêu đề và nút quay lại -->
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h3 class="fw-bold mb-0" style="color: #ff69b4;"><i class="fas fa-envelope-open-text me-2"></i> Hòm thư góp ý</h3>
        <a href="{{ route('admin.dashboard') }}" id="back-button" class="btn text-white fw-bold rounded-pill shadow-sm" style="background-color: #ff5c8d;">
            <i class="fas fa-arrow-left me-1"></i> Trở về
        </a>
    </div>

    <!-- Cảnh báo trạng thái thành công -->
    @if(session('success'))
        <div class="alert alert-success border-start border-4 border-success shadow-sm mb-4">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    @if($feedbacks->isEmpty())
        <div class="text-center bg-white p-5 rounded-4 shadow-sm" style="border: 1px dashed #ffbaf2;">
            <i class="fas fa-box-open fa-4x text-muted mb-3 opacity-50"></i>
            <h5 class="text-muted fw-bold">Hiện chưa có tin nhắn nào trong hòm thư!</h5>
        </div>
    @else
        <!-- Bảng danh sách phản hồi hiện đại -->
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="table-responsive bg-white">
                <table class="table table-hover align-middle mb-0 text-secondary">
                    <thead class="text-white" style="background-color: #ff69b4;">
                        <tr>
                            <th scope="col" class="py-3 text-center">STT</th>
                            <th scope="col">Tên người gửi</th>
                            <th scope="col">Email liên lạc</th>
                            <th scope="col" style="width: 35%">Nội dung góp ý</th>
                            <th scope="col"><i class="far fa-clock"></i> Ngày nhận</th>
                            <th scope="col" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px;">
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                <td class="text-dark fw-bold"><i class="fas fa-user-circle text-pink me-1"></i> {{ $feedback->name }}</td>
                                <td>{{ $feedback->email }}</td>
                                <td>
                                    <div class="p-2 rounded" style="background-color: #fff5f7; border-left: 3px solid #ff69b4;">
                                        {{ $feedback->content }}
                                    </div>
                                </td>
                                <td class="text-muted">{{ $feedback->created_at->format('d/m/Y - H:i') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm fw-bold shadow-sm rounded-3" onclick="return confirm('Bạn có chắc muốn xoá thư này khỏi hệ thống không?')">
                                            <i class="fas fa-trash-alt me-1"></i> Xoá
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection