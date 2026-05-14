<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý người dùng</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #fef5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .user-manager {
            background: white;
            border-radius: 28px;
            padding: 30px;
            box-shadow: 0 15px 30px rgba(236, 83, 208, 0.08);
            margin: 30px auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 28px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ffe0f0;
        }

        .page-title {
            color: #c2185b;
            font-weight: 800;
            font-size: 26px;
            margin: 0;
        }

        .btn-add {
            background: linear-gradient(95deg, #ec53d0, #ff80bf);
            color: white;
            padding: 10px 24px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s;
            display: inline-block;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(236, 83, 208, 0.35);
            color: white;
        }

        .role-group {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
        }

        .role-btn {
            padding: 8px 22px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
            background: #ffe4e1;
            color: #c2185b;
        }

        .role-btn.active {
            background: #ec53d0;
            color: white;
        }

        .role-btn:hover {
            transform: translateY(-2px);
            background: #ec53d0;
            color: white;
        }

        .alert-success {
            background: #e8f5e9;
            border-left: 5px solid #4caf50;
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 25px;
            color: #2e7d32;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 20px;
        }

        .user-table th {
            background: linear-gradient(95deg, #ec53d0, #ff80bf);
            color: white;
            padding: 14px 12px;
            text-align: left;
            font-weight: 600;
        }

        .user-table td {
            padding: 12px;
            border-bottom: 1px solid #f3e0ec;
            color: #444;
        }

        .user-table tr:hover {
            background: #fff5f9;
        }

        .btn-view {
            background: #ffb3d9;
            color: #c2185b;
            padding: 6px 16px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            margin-right: 8px;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-view:hover {
            background: #ec53d0;
            color: white;
        }

        .btn-edit {
            background: #ffe0e8;
            color: #c2185b;
            padding: 6px 16px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            background: #ec53d0;
            color: white;
        }

        @media (max-width: 768px) {
            .user-manager {
                padding: 20px;
                margin: 15px;
            }
            .user-table th, .user-table td {
                font-size: 13px;
                padding: 8px;
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    @extends('layouts.dashboard')

    @section('content')
    <div class="container py-4">
        <div class="user-manager">
            <div class="page-header">
                <h2 class="page-title">👥 Quản lý người dùng</h2>
                <a href="{{ route('users.create') }}" class="btn-add">➕ Thêm người dùng mới</a>
            </div>
            
            <div class="role-group">
                <a href="{{ route('users.index', ['role' => 1]) }}" 
                   class="role-btn {{ $role == 1 ? 'active' : '' }}">👩‍🏫 Giáo viên</a>
                <a href="{{ route('users.index', ['role' => 2]) }}" 
                   class="role-btn {{ $role == 2 ? 'active' : '' }}">👪 Phụ huynh</a>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div style="overflow-x: auto;">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <a href="{{ route('users.show', $user) }}" class="btn-view">👁️ Xem</a>
                                <a href="{{ route('users.edit', $user) }}" class="btn-edit">✏️ Sửa</a>
                             </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>