<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thời khóa biểu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            background: white;
            padding: 30px;
        }
        
        /* Tiêu đề chính */
        .pdf-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #d63384;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #ff69b4;
        }
        
        /* Bảng */
        .timetable-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .timetable-table th {
            background: #ff69b4;
            color: white;
            padding: 12px 8px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            border: 1px solid #e05297;
        }
        
        .timetable-table td {
            border: 1px solid #ddd;
            padding: 10px 6px;
            text-align: center;
            font-size: 13px;
            vertical-align: middle;
        }
        
        /* Hàng nghỉ giải lao */
        .break-row td {
            background-color: #ffe4e1;
            font-style: italic;
            font-weight: bold;
            color: #d63384;
            text-align: center;
        }
        
        /* Hàng tiêu đề cột đầu */
        .timetable-table td:first-child {
            background: #fff0f5;
            font-weight: bold;
            color: #d63384;
        }
        
        /* Footer */
        .pdf-footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <h1 class="pdf-title">Thời khóa biểu - Học kỳ {{ $selectedSemester }}</h1>
    
    <table class="timetable-table">
        <thead>
            <tr>
                <th>Tiết</th>
                <th>Thời gian</th>
                <th>Thứ 2</th>
                <th>Thứ 3</th>
                <th>Thứ 4</th>
                <th>Thứ 5</th>
                <th>Thứ 6</th>
                <th>Thứ 7</th>
            </tr>
        </thead>
        <tbody>
            @foreach($times as $period => $time)
                @if(str_contains($period, 'break'))
                    <tr class="break-row">
                        <td colspan="8">{{ $time }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Tiết {{ is_numeric($period) ? $period : '' }}</td>
                        <td>{{ $time }}</td>
                        @for($day = 2; $day <= 7; $day++)
                            <td>{{ $schedule["t$day"]["p$period"] ?? '—' }}</td>
                        @endfor
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    
    <div class="pdf-footer">
        Trường mầm non - Lịch học chính thức
    </div>
</body>
</html>