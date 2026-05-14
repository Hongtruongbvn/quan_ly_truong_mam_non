<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chi tiết người dùng</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #ffe4e1 0%, #fef5f9 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .profile-wrapper {
            max-width: 900px;
            margin: 40px auto;
        }

        .profile-card {
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 20px 35px rgba(236, 83, 208, 0.12);
        }

        .profile-header {
            background: linear-gradient(95deg, #ec53d0, #ff80bf);
            padding: 25px;
            text-align: center;
        }

        .profile-header h3 {
            color: white;
            font-weight: 700;
            font-size: 26px;
            margin: 0;
        }

        .profile-body {
            padding: 35px;
        }

        .avatar-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 100px;
            border: 5px solid #ec53d0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            background: #fff9fc;
            padding: 14px 18px;
            border-radius: 20px;
            border-left: 4px solid #ec53d0;
        }

        .info-label {
            font-weight: 700;
            color: #c2185b;
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .info-value {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-edit-profile {
            background: linear-gradient(95deg, #ec53d0, #ff80bf);
            color: white;
            padding: 10px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s;
        }

        .btn-back {
            background: #ffe4e1;
            color: #c2185b;
            padding: 10px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s;
        }

        .btn-edit-profile:hover, .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(236, 83, 208, 0.3);
        }

        @media (max-width: 650px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .profile-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    @extends('layouts.dashboard')

    @section('content')
    <div class="profile-wrapper">
        <div class="profile-card">
            <div class="profile-header">
                <h3>📄 Thông tin chi tiết</h3>
            </div>
            <div class="profile-body">
                <div class="avatar-box">
                    @if($user->img)
                        <img src="{{ asset($user->img) }}" alt="Ảnh đại diện" class="avatar-img">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Ảnh mặc định" class="avatar-img">
                    @endif
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">👤 Họ và tên</span>
                        <span class="info-value">{{ $user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">📧 Email</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">🆔 Căn cước</span>
                        <span class="info-value">{{ $user->id_number }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">📞 Số điện thoại</span>
                        <span class="info-value">{{ $user->phone }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">⚥ Giới tính</span>
                        <span class="info-value">{{ ucfirst($user->gender) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">📌 Vai trò</span>
                        <span class="info-value">{{ $user->role == 1 ? 'Giáo viên' : 'Phụ huynh' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">📊 Trạng thái</span>
                        <span class="info-value">{{ $user->status }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">🏠 Địa chỉ</span>
                        <span class="info-value">{{ $user->address }}</span>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('users.edit', $user) }}" class="btn-edit-profile">✏️ Sửa hồ sơ</a>
                    <a href="{{ route('users.index') }}" class="btn-back">⬅️ Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>