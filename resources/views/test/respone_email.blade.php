<!-- resources/views/emails/tuition_payment.blade.php -->

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn thanh toán học phí</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background: #fef5f9;
            padding: 30px 20px;
        }
        .invoice-container {
            max-width: 650px;
            margin: 0 auto;
            background: white;
            border-radius: 28px;
            box-shadow: 0 20px 35px rgba(236, 83, 208, 0.12);
            overflow: hidden;
        }
        .invoice-header {
            background: linear-gradient(95deg, #ec53d0, #ff80bf);
            color: white;
            padding: 25px 20px;
            text-align: center;
        }
        .invoice-header h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.3px;
        }
        .invoice-header p {
            margin: 8px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .invoice-body {
            padding: 30px;
        }
        .info-row {
            background: #fff9fc;
            border-radius: 20px;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-left: 4px solid #ec53d0;
        }
        .info-item {
            margin-bottom: 12px;
            display: flex;
            flex-wrap: wrap;
        }
        .info-item:last-child {
            margin-bottom: 0;
        }
        .info-label {
            font-weight: 700;
            color: #c2185b;
            width: 130px;
        }
        .info-value {
            color: #333;
            font-weight: 500;
        }
        .detail-title {
            color: #c2185b;
            font-weight: 700;
            font-size: 18px;
            margin: 25px 0 15px;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .payment-table th {
            background: #ffe4e1;
            color: #c2185b;
            padding: 12px;
            text-align: left;
            font-weight: 700;
        }
        .payment-table td {
            padding: 12px;
            border-bottom: 1px solid #f3e0ec;
            color: #444;
        }
        .payment-table tr:last-child td {
            border-bottom: none;
        }
        .status-badge {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 6px 16px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
        }
        .invoice-footer {
            background: #fff5f9;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #ffe0f0;
        }
        .invoice-footer p {
            margin: 5px 0;
            color: #888;
            font-size: 13px;
        }
        .invoice-footer .thanks {
            color: #c2185b;
            font-weight: 600;
            margin-bottom: 8px;
        }
        hr {
            border: none;
            border-top: 2px dashed #ffe0f0;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>🧾 Hóa đơn học phí</h2>
            <p>Cảm ơn quý phụ huynh đã thanh toán</p>
        </div>

        <div class="invoice-body">
            <div class="info-row">
                <div class="info-item">
                    <span class="info-label">📌 Mã giao dịch:</span>
                    <span class="info-value">{{ $orderId }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">📆 Học kỳ / Tháng:</span>
                    <span class="info-value">{{ $semester }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">💰 Tổng tiền:</span>
                    <span class="info-value" style="color:#ec53d0; font-size:18px;">{{ number_format($amount, 0, ',', '.') }} VNĐ</span>
                </div>
            </div>

            <div class="detail-title">📋 Chi tiết các khoản đã đóng</div>
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Tên khoản thu</th>
                        <th>Số tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $key)
                    <tr>
                        <td>{{ $key->name }}</td>
                        <td>{{ number_format($key->price, 0, ',', '.') }} VNĐ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>

            <div class="info-item" style="justify-content: space-between;">
                <span class="info-label">✅ Trạng thái:</span>
                <span class="status-badge">Đã thanh toán thành công</span>
            </div>
            <div class="info-item" style="margin-top: 12px;">
                <span class="info-label">⏰ Thời gian giao dịch:</span>
                <span class="info-value">{{ $transactionTime }}</span>
            </div>
        </div>

        <div class="invoice-footer">
            <p class="thanks">🌸 Trân trọng cảm ơn quý phụ huynh</p>
            <p>Mọi thắc mắc xin liên hệ nhà trường</p>
            <p>🌱 Trường mầm non Nursery</p>
        </div>
    </div>
</body>
</html>