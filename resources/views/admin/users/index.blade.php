@extends('layouts.dashboard')

@section('title', 'Quản Lý Tài Khoản Mầm Non')

@section('content')
<link rel="stylesheet" href="{{ asset('css/AccountManagement.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container account-management bg-white shadow-lg rounded-4 p-4 border-0 animate__animated animate__fadeIn mt-4">
    
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h2 class="text-pink fw-bold m-0">
            <i class="fas fa-users-cog me-2"></i>
            Quản Lý Tài Khoản Hệ Thống
        </h2>

        <div class="back-button mb-0">
            <a href="{{ route('admin.dashboard')}}" 
               class="btn shadow-sm text-white rounded-pill px-4"
               style="background-color: #ff69b4;">
                <i class="fas fa-arrow-left"></i>
                Trang Chính
            </a>
        </div>
    </div>

    <!-- Thanh công cụ -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3 bg-light p-3 rounded-3 shadow-sm border">
        
        <!-- Tìm kiếm -->
        <div class="d-flex flex-wrap align-items-center gap-3 w-50" style="min-width: 300px;">

            <form action="{{ route('admin.users.index') }}"
                  method="GET"
                  class="search-form m-0 flex-grow-1 w-100">

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0 rounded-start-pill text-pink">
                        <i class="fas fa-search"></i>
                    </span>

                    <input type="text"
                           name="search"
                           class="form-control border-start-0 ps-0 shadow-none m-0"
                           style="border-radius:0 !important; border-top-right-radius: 0!important; border-bottom-right-radius: 0!important;"
                           placeholder="Nhập tên, số điện thoại hoặc CCCD..."
                           value="{{ request('search') }}">

                    <button type="submit"
                            class="btn text-white rounded-end-pill px-4 shadow-none border-0"
                            style="background-color: #ff69b4; border-top-right-radius: 50rem!important; border-bottom-right-radius: 50rem!important; font-size:14px; margin: 0; height: 100%; border-radius:0px;">

                        Tìm kiếm
                    </button>
                </div>
            </form>
        </div>

        <!-- Nút chức năng -->
        <div class="actions m-0 d-flex gap-2 align-items-center">

            <!-- Lọc -->
            <form action="{{ route('admin.users.index') }}"
                  method="GET"
                  class="m-0 d-inline-block shadow-none border-0 bg-transparent text-end me-3">

                <label for="role-filter" class="form-label d-none">
                    Lọc Vai Trò
                </label>

                <select name="role"
                        id="role-filter"
                        class="form-select form-select-sm border-pink rounded-pill shadow-sm py-2 px-3 fw-bold text-secondary"
                        style="min-width: 140px; border-color:#ff69b4; outline:none"
                        onchange="this.form.submit()">

                    <option value="" {{ request('role') === null ? 'selected' : '' }}>
                        -- Tất cả vai trò --
                    </option>

                    <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>
                        👩‍🏫 Giáo viên
                    </option>

                    <option value="2" {{ request('role') == '2' ? 'selected' : '' }}>
                        👨‍👩‍👧 Phụ huynh
                    </option>
                </select>
            </form>

            <!-- Thêm mới -->
            <div class="btn-group shadow-sm">

                <button type="button"
                        class="btn text-white fw-bold rounded-start dropdown-toggle"
                        style="background-color:#007bff; border:none"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    <i class="fas fa-user-plus me-1"></i>
                    Thêm tài khoản
                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a class="dropdown-item py-2 fw-semibold"
                           href="{{ route('admin.users.create') }}">

                            <i class="fas fa-user-edit text-primary me-2"></i>
                            Thêm thủ công
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item py-2 fw-semibold"
                           href="#"
                           data-bs-toggle="modal"
                           data-bs-target="#importModal">

                            <i class="fas fa-file-excel text-success me-2"></i>
                            Import từ Excel
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Export -->
            <a href="{{ route('admin.users.export') }}"
               class="btn fw-bold text-white shadow-sm"
               style="background-color:#198754; border:none; padding:8px 12px; font-size:14px">

                <i class="fas fa-cloud-download-alt me-1"></i>
                Xuất Excel
            </a>
            
            <!-- Xóa tất cả -->
            <form action="{{ route('admin.users.deleteAll') }}"
                  method="POST"
                  class="d-inline m-0 shadow-none border-0"
                  id="delete-all-form">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger fw-bold shadow-sm"
                        style="padding:8px 12px; font-size:14px"
                        onclick="return confirm('Bạn có chắc muốn xóa toàn bộ dữ liệu người dùng không?')">

                    <i class="fas fa-trash-alt me-1"></i>
                    Xóa tất cả
                </button>
            </form>
        </div>
    </div>
    
    <!-- Thông báo -->
    @if(session('success'))
        <div class="alert alert-success mt-3 shadow-sm rounded border-0 fw-bold border-start border-success border-4">
            <i class="fas fa-check-circle me-2 text-success"></i>
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Bảng dữ liệu -->
    <div class="table-responsive rounded shadow-sm border border-pink" style="border-color:#ffebf0 !important">

        <table class="account-table table table-hover align-middle mb-0 w-100 bg-white">

            <thead class="text-white fw-bold"
                   style="background-color: #ff5c8d; border-color:#ff5c8d">

                <tr class="text-center text-nowrap">

                    <th scope="col" class="py-3">STT</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col">CCCD</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col" style="min-width: 130px;">
                        Thao tác
                    </th>
                </tr>
            </thead>

            <tbody>

                @forelse ($accounts as $account)

                    @if ($account->role != 0)

                        <tr class="text-center shadow-hover transition-all text-secondary"
                            style="font-size:15px;">

                            <td class="fw-bold">
                                {{ ($accounts->currentPage() - 1) * $accounts->perPage() + $loop->iteration }}
                            </td>

                            <td class="text-start fw-bold text-dark text-nowrap">
                                <i class="fas fa-user-circle me-1" style="color:#d94472"></i>
                                {{ $account->name }}
                            </td>

                            <td>{{ $account->email }}</td>

                            <td>
                                @if($account->role == 1)

                                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                                        <i class="fas fa-chalkboard-teacher me-1"></i>
                                        Giáo viên
                                    </span>

                                @else

                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        <i class="fas fa-hands-helping me-1"></i>
                                        Phụ huynh
                                    </span>

                                @endif
                            </td>

                            <td class="font-monospace text-muted">
                                {{ $account->id_number ?? 'Chưa cập nhật' }}
                            </td>

                            <td class="fw-semibold text-pink">

                                <a href="tel:{{ $account->phone }}"
                                   class="text-decoration-none"
                                   style="color: #d94472">

                                    <i class="fas fa-phone-alt fa-xs me-1 text-pink"></i>
                                    {{ $account->phone }}
                                </a>
                            </td>

                            <td class="d-flex justify-content-center gap-2 m-0 mt-1 pb-2 shadow-none border-0 text-center">

                                <a href="{{ route('admin.users.edit', $account->id) }}"
                                   class="btn btn-sm shadow-sm fw-semibold rounded"
                                   style="background-color: #0d6efd; border:none; color: white">

                                    <i class="fas fa-edit me-1"></i>
                                    Chỉnh sửa
                                </a>

                                <form action="{{ route('admin.users.delete', $account->id) }}"
                                      method="POST"
                                      class="d-inline m-0 shadow-none bg-transparent border-0 p-0 text-center text-nowrap w-100">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger shadow-sm fw-semibold rounded"
                                            onclick="return confirm('Bạn có chắc muốn xóa tài khoản này không?')">

                                        <i class="fas fa-eraser me-1"></i>
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @endif

                @empty

                    <tr>
                        <td colspan="7"
                            class="text-center text-muted fw-bold py-5">

                            <i class="fas fa-inbox fa-3x mb-3 text-light d-block"></i>
                            Không có dữ liệu phù hợp.
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <div class="mt-4 pt-2 border-top">
        {{ $accounts->links('vendor.pagination.default') }}
    </div>
</div>

<!-- Modal Import Excel -->
<div class="modal fade"
     id="importModal"
     tabindex="-1"
     aria-labelledby="importModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered border-0">

        <div class="modal-content shadow-lg border-0 rounded-4"
             style="background-color:#fff5f7">

            <div class="modal-header border-bottom border-light">

                <h5 class="modal-title text-pink fw-bold"
                    id="importModalLabel">

                    <i class="fas fa-upload me-2 text-primary"></i>
                    Import dữ liệu từ Excel
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body py-4 bg-white">

                <form action="{{ route('admin.users.import') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="mb-4">

                        <label for="file"
                               class="form-label fw-bold text-dark">

                            <i class="far fa-folder-open text-warning me-2"></i>
                            Chọn file Excel (.xlsx hoặc .xls)
                        </label>

                        <input class="form-control form-control-lg border-primary rounded-3 shadow-sm bg-light"
                               type="file"
                               id="file"
                               name="file"
                               accept=".xlsx, .xls"
                               required>
                    </div>

                    <button type="submit"
                            class="btn w-100 text-white fw-bold py-3 fs-5 shadow rounded-pill"
                            style="background-color: #ff5c8d; border:none; transition: .2s all">

                        🚀 Bắt đầu import dữ liệu
                    </button>
                </form>

                @if ($errors->any())

                    <div class="alert alert-danger mt-3 mb-0 rounded border-start border-danger border-4">

                        <ul class="mb-0 fw-semibold text-start text-dark">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>

                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Hướng dẫn -->
<div class="modal fade"
     id="rulesModal"
     tabindex="-1"
     aria-labelledby="rulesModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-scrollable border-0 shadow">

        <div class="modal-content rounded-4 border-0">

            <div class="modal-header"
                 style="background-color: #ffecf5">

                <h4 class="modal-title fw-bold text-pink"
                    id="rulesModalLabel">

                    <i class="fas fa-book-open text-primary me-2"></i>
                    Hướng Dẫn Sử Dụng
                </h4>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body p-4 bg-white"
                 style="line-height:1.8;">

                <div class="card bg-light border-0 p-4 rounded mb-4">

                    <h6 class="text-pink fw-bold mb-3 pb-2 border-bottom"
                        style="font-size: 16px">

                        <i class="far fa-id-badge text-warning fa-lg me-2"></i>
                        1. Ảnh đại diện tài khoản
                    </h6>

                    <ul class="text-secondary fw-semibold">
                        <li>
                            Khi tạo tài khoản thủ công, nên sử dụng ảnh chân dung rõ mặt.
                        </li>

                        <li>
                            Ảnh nên có nền sáng hoặc đơn giản để hệ thống dễ nhận diện hơn.
                        </li>
                    </ul>
                </div>
                
                <div class="card bg-light border-0 p-4 rounded mb-4">

                    <h6 class="text-pink fw-bold mb-3 pb-2 border-bottom"
                        style="font-size: 16px">

                        <i class="fas fa-cloud-upload-alt text-primary fa-lg me-2"></i>
                        2. Import dữ liệu từ Excel
                    </h6>

                    <ul class="text-secondary fw-semibold">

                        <li>
                            Khi import Excel, hệ thống sẽ không tự thêm ảnh đại diện.
                        </li>

                        <li>
                            Bạn có thể chỉnh sửa lại tài khoản sau khi import để bổ sung hình ảnh.
                        </li>
                    </ul>
                </div>
                 
                <div class="card bg-light border-0 p-4 rounded">

                    <h6 class="text-pink fw-bold mb-3 pb-2 border-bottom"
                        style="font-size: 16px">

                        <i class="fas fa-magic text-success fa-lg me-2"></i>
                        3. Lưu ý khi cập nhật dữ liệu
                    </h6>

                    <ul class="text-secondary fw-semibold">

                        <li>
                            Hãy kiểm tra kỹ thông tin trước khi lưu để tránh sai sót dữ liệu.
                        </li>

                        <li>
                            Việc giữ dữ liệu gọn gàng sẽ giúp hệ thống hoạt động ổn định hơn.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="modal-footer"
                 style="background-color:#fef8fc; border-top:1px dashed #ffd5e6">

                <button type="button"
                        class="btn text-white fw-bold px-4 rounded-pill shadow-sm"
                        style="background-color:#d94472"
                        data-bs-dismiss="modal">

                    Đã hiểu
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rulesModal = new bootstrap.Modal(document.getElementById('rulesModal'));
        rulesModal.show();
    });
</script>

@endsection