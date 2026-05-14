@extends('layouts.dashboard')
<link rel="stylesheet" href="{{ asset('css/ChildrenManagement.css') }}">
@section('content')

<div class="children-container" style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom:20px;">
    
    <!-- Nút quay lại -->
    <div class="back-button" style="margin-bottom: 20px;">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="background-color: #ff69b4; border: none; border-radius: 8px;">
            <i class="fas fa-arrow-left"></i> Về bảng điều khiển
        </a>
    </div>

    <!-- Tiêu Đề và Nút Menu -->
    <div class="header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ffe4e1; padding-bottom: 15px; flex-wrap:wrap; gap:15px;">
        <h1 style="color: #ec53d0; font-weight: bold; font-size: 24px; margin:0;">Danh Sách Các Bé</h1>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 8px; background-color:#ff69b4; border:none;">
                    + Ghi danh bé mới
                </button>
                <ul class="dropdown-menu" style="border-radius: 10px; border:1px solid #ffd6e7;">
                    <li><a class="dropdown-item" href="{{ route('admin.children.create') }}">Nhập một bé bằng tay</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importChildModal">Tải tệp danh sách Excel lên</a></li>
                </ul>
            </div>
            
            <a href="{{ route('childclass.create') }}" class="btn btn-info text-white" style="border-radius: 8px; background-color:#48d1cc; border:none;">Xếp bé vào lớp</a>
            <a href="{{ route('admin.children.export') }}" class="btn btn-success" style="border-radius: 8px;">Tải Excel về máy</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="border-radius: 8px; font-weight: bold; text-align: center; margin-top: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Thẻ Hồ Sơ Trẻ Em -->
    <div class="children-grid" style="margin-top: 30px;">
        @foreach($children as $child)
            <div class="child-card" style="border: 1px solid #ffe4e1; border-radius: 12px; background: #fffafc; overflow: hidden; text-align: center; transition: all 0.3s ease;">
                <div class="child-image" style="background-color: #ffd6e7; padding: 20px;">
                    @if($child->img)
                        <img src="{{ asset('storage/' . $child->img) }}" alt="Hình thẻ" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid #fff;">
                    @else
                        <div class="default-avatar" style="width: 100px; height: 100px; line-height: 100px; background-color: #ff69b4; color: white; font-size: 30px; font-weight: bold; border-radius: 50%; margin: 0 auto; border: 4px solid #fff;">
                            {{ strtoupper(substr($child->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="child-info" style="padding: 15px;">
                    <h3 style="color: #ec53d0; font-size: 18px; font-weight: bold; margin-bottom: 10px;">{{ $child->name }}</h3>
                    <p style="margin: 5px 0; color:#555; font-size:14px;"><strong>Ngày sinh:</strong> {{ \Carbon\Carbon::parse($child->birthDate)->format('d/m/Y') }}</p>
                    <p style="margin: 5px 0; color:#555; font-size:14px;"><strong>Giới tính:</strong> {{ $child->gender == 1 ? 'Bé Trai' : 'Bé Gái' }}</p>
                    <p style="margin: 5px 0; color:#555; font-size:14px;"><strong>Gia đình:</strong> {{ $child->user ? $child->user->name : 'Đang chờ điền' }}</p>
                </div>
                <div class="child-actions" style="background-color: #fce4ec; padding: 12px;">
                    <a href="{{ route('admin.children.edit', $child->id) }}" class="btn-edit" style="color: #ff69b4; font-weight: bold; text-decoration: none; background: #fff; padding: 5px 15px; border-radius: 6px;">Sửa hồ sơ</a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Thanh Lật Trang Xinh Xắn Của Bạn Ở Đây -->
    <div class="d-flex justify-content-center" style="margin-top: 30px;">
        {{ $children->links('vendor.pagination.default') }}
    </div>

</div>

<!-- Modal: Đưa File Excel Vào Máy -->
<div class="modal fade" id="importChildModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px; border:none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="background: #ffe4e1; border-bottom: none; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title" style="color: #ff69b4; font-weight: bold;">Tải tệp danh sách vào phần mềm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <form action="{{ route('admin.children.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label" style="font-weight: bold; color: #555;">Xin bấm nút phía dưới để tìm tệp nhé (.xlsx)</label>
                        <input type="file" class="form-control" name="file" accept=".xlsx, .xls" style="border-radius: 8px;" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 8px; background-color: #ff69b4; border:none; padding:10px 0; font-size:16px;">Tiến Hành</button>
                </form>
                @if(session('import_errors'))
                    <div class="alert alert-danger mt-3" style="border-radius: 8px;">
                        <ul style="margin: 0;">
                            @foreach(session('import_errors') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal: Mẹo Nhỏ Cần Nhớ Khởi Tạo Form -->
<div class="modal fade" id="rulesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px; border:none;">
            <div class="modal-header" style="background: #ffe4e1; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title fw-bold" style="color: #ff69b4;">Đôi lời nhắn gửi khi tạo mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="color: #444; line-height: 1.6;">
                <p><strong style="color:#d6336c;">1. Cách thêm qua tệp tiện lợi:</strong> Nếu bạn đẩy dữ liệu danh sách nguyên cái file Excel vào máy là vô cùng thuận lợi! Bạn sẽ điền danh sách chung rồi phần ảnh sẽ dễ dàng gắn thêm trên nút <b>'Sửa Hồ Sơ'</b> lát nữa nhé.</p>
                <p><strong style="color:#d6336c;">2. Góc dặn nhỏ bức ảnh chân dung bé:</strong> Cố gắng là thẻ nền tươi hoặc thẻ thẻ đứng dáng nhìn rõ để web tải mặt mượt lên ngắm yêu lắm nghen.</p>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button type="button" class="btn btn-secondary" style="border-radius: 8px;" data-bs-dismiss="modal">Đã nắm kĩ thông tin</button>
            </div>
        </div>
    </div>
</div>

<style>
    .modal.fade .modal-dialog { transition: transform 0.3s ease, opacity 0.3s ease; transform: translateY(-50px); opacity: 0; }
    .modal.show .modal-dialog { transform: translateY(0); opacity: 1; }
    .child-card:hover { transform: translateY(-5px) !important; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    
    /* Thiết Kế Thanh Lật Trang Bong Bóng Siêu Cute Đã Được Góp Vui Cho File  */
    .pagination { display: flex; flex-wrap: wrap; gap: 8px; margin: 0; padding: 0;}
    .page-item .page-link {
        color: #ff69b4; background-color: #fff; border: 2px solid #ffe4e1; border-radius: 50% !important; 
        width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;
        font-weight: bold; font-size: 15px; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .page-link:hover {
        background-color: #ff69b4; color: #fff; border-color: #ff69b4;
        transform: translateY(-4px); box-shadow: 0 6px 12px rgba(255, 105, 180, 0.4);
    }
    .page-item.active .page-link {
        background-color: #ec53d0; border-color: #ec53d0; color: #fff;
        transform: scale(1.1); box-shadow: 0 5px 15px rgba(236, 83, 208, 0.5); pointer-events: none;
    }
    .page-item.disabled .page-link {
        color: #bbb; background-color: #fafafa; border-color: #f1f1f1; box-shadow: none; pointer-events: none;
    }
    .page-link:focus { box-shadow: none; outline: none; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rulesModal = new bootstrap.Modal(document.getElementById('rulesModal'));
        rulesModal.show();
    });
</script>
@endsection