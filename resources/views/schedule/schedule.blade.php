@extends('layouts.dashboard')

@section('title', 'Lịch học nhà trẻ')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/NurserySchedule.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="schedule-page-wrapper">
    <div class="schedule-card">
        <h2 class="schedule-main-title">📅 Lịch học nhà trẻ</h2>
        
        <div class="filter-row">
            <div class="filter-box">
                <label class="filter-label">Lớp học</label>
                <select name="classroom_id" id="classroom_id" class="filter-select" required>
                    <option value="">-- Chọn lớp học --</option>
                    @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-box">
                <label class="filter-label">Ngày học</label>
                <input type="date" name="date" id="date" class="filter-input" required>
            </div>
        </div>
        
        <div class="schedule-detail-box">
            <h3 class="detail-subtitle">📖 Chi tiết lịch học</h3>
            <div class="table-responsive-custom">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Tiết học</th>
                            <th>Môn học</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="schedule-details-body">
                        <tr>
                            <td colspan="3" class="empty-message">Chọn lớp và ngày học để xem lịch</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
.schedule-page-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #fff0f5 0%, #ffe4e1 100%);
    padding: 40px 24px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.schedule-card {
    max-width: 900px;
    width: 100%;
    margin: 0 auto;
    background: white;
    border-radius: 32px;
    padding: 32px 28px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.schedule-main-title {
    font-size: 28px;
    font-weight: bold;
    color: #d63384;
    text-align: center;
    margin-bottom: 28px;
    position: relative;
}

.schedule-main-title::after {
    content: '';
    width: 60px;
    height: 3px;
    background: #ff69b4;
    display: block;
    margin: 12px auto 0;
    border-radius: 10px;
}

.filter-row {
    display: flex;
    gap: 24px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.filter-box {
    flex: 1;
    min-width: 200px;
}

.filter-label {
    display: block;
    font-weight: bold;
    color: #555;
    margin-bottom: 8px;
    font-size: 14px;
}

.filter-select, .filter-input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #ffe0f0;
    border-radius: 20px;
    font-size: 15px;
    background: #fef9fc;
    transition: all 0.2s;
}

.filter-select:focus, .filter-input:focus {
    outline: none;
    border-color: #ff69b4;
    box-shadow: 0 0 0 3px rgba(255,105,180,0.1);
}

.schedule-detail-box {
    background: #fef9fc;
    border-radius: 24px;
    padding: 20px;
}

.detail-subtitle {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ffc0e0;
}

.table-responsive-custom {
    overflow-x: auto;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
}

.custom-table th {
    background: #ff69b4;
    color: white;
    padding: 12px;
    text-align: center;
    font-weight: bold;
    font-size: 14px;
}

.custom-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ffe0f0;
    font-size: 14px;
}

.custom-table tr:hover td {
    background: #fff0f5;
}

.empty-message {
    text-align: center;
    color: #999;
    padding: 40px;
}

.btn-delete-custom {
    background: #dc3545;
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-delete-custom:hover {
    background: #c82333;
    transform: scale(1.02);
}

@media (max-width: 650px) {
    .schedule-card {
        padding: 24px 20px;
    }
    .schedule-main-title {
        font-size: 24px;
    }
    .filter-row {
        flex-direction: column;
        gap: 16px;
    }
    .custom-table th, .custom-table td {
        padding: 8px;
        font-size: 12px;
    }
}
</style>

<script>
    document.getElementById('classroom_id').addEventListener('change', loadSchedule);
    document.getElementById('date').addEventListener('change', loadSchedule);

    function loadSchedule() {
        const classroomId = document.getElementById('classroom_id').value;
        const date = document.getElementById('date').value;

        if (classroomId && date) {
            fetch(`/api/schedule/details?classroom_id=${classroomId}&date=${date}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('schedule-details-body');
                    tableBody.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(item => {
                            tableBody.innerHTML += `
                                <tr>
                                    <td>${item.name}</td>
                                    <td>${item.subject_name}</td>
                                    <td class="text-center">
                                        <button class="btn-delete-custom" onclick="deleteSchedule(${item.schedule_id}, ${item.id})">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </button>
                                    </td>
                                </tr>`;
                        });
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="3" class="empty-message">Không có dữ liệu</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                });
        }
    }
    
    function deleteSchedule(scheduleId, infoId) {
        if (confirm('Bạn có chắc chắn muốn xóa?')) {
            fetch(`/schedule/delete?schedule_id=${scheduleId}&id=${infoId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Xóa thành công!');
                    loadSchedule();
                } else {
                    alert('Có lỗi xảy ra!');
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
            });
        }
    }
</script>
@endsection