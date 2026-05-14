@extends('layouts.dashboard')

@section('content')
<style>
    .payment-wrapper {
        max-width: 650px;
        margin: 0 auto;
        padding: 20px;
    }
    .payment-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 15px 35px rgba(236, 83, 208, 0.1);
        overflow: hidden;
        padding: 30px;
    }
    .payment-title {
        color: #c2185b;
        font-weight: 800;
        font-size: 24px;
        text-align: center;
        margin-bottom: 25px;
        position: relative;
    }
    .payment-title:after {
        content: '';
        width: 60px;
        height: 3px;
        background: #ec53d0;
        display: block;
        margin: 10px auto 0;
        border-radius: 10px;
    }
    .btn-back-payment {
        background: #ffe4e1;
        color: #c2185b;
        padding: 8px 22px;
        border: none;
        border-radius: 40px;
        font-weight: 600;
        margin-bottom: 20px;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-back-payment:hover {
        background: #ec53d0;
        color: white;
        transform: translateY(-2px);
    }
    .form-label-pink {
        color: #c2185b;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    .form-custom-select {
        border: 1.5px solid #f0b3df;
        border-radius: 16px;
        padding: 12px 16px;
        width: 100%;
        background: white;
        transition: all 0.2s;
    }
    .form-custom-select:focus {
        border-color: #ec53d0;
        box-shadow: 0 0 0 3px rgba(236, 83, 208, 0.15);
        outline: none;
    }
    .detail-box {
        background: #fff9fc;
        border-radius: 20px;
        padding: 20px;
        margin-top: 20px;
        border: 1px solid #ffe0f0;
    }
    .detail-title {
        color: #c2185b;
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 18px;
    }
    .list-group-custom {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .list-group-custom li {
        padding: 12px;
        border-bottom: 1px solid #f3e0ec;
        color: #444;
    }
    .list-group-custom li:last-child {
        border-bottom: none;
    }
    .radio-group {
        background: #fff5f9;
        padding: 15px 20px;
        border-radius: 20px;
        margin-top: 10px;
    }
    .radio-group .form-check {
        margin-bottom: 10px;
    }
    .radio-group .form-check:last-child {
        margin-bottom: 0;
    }
    .form-check-input:checked {
        background-color: #ec53d0;
        border-color: #ec53d0;
    }
    .btn-payment {
        background: linear-gradient(95deg, #ec53d0, #ff80bf);
        color: white;
        font-weight: 700;
        padding: 14px;
        border: none;
        border-radius: 50px;
        width: 100%;
        font-size: 18px;
        margin-top: 25px;
        transition: all 0.25s;
    }
    .btn-payment:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(236, 83, 208, 0.35);
    }
    .btn-payment:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<div class="payment-wrapper">
    <div class="payment-card">
        <button id="back-button" class="btn-back-payment">← Quay về</button>
        <h2 class="payment-title">💰 Thanh toán học phí</h2>

        <form action="{{ route('process_payment') }}" method="POST" id="payment_form">
            @csrf
            <link rel="stylesheet" href="{{ asset('css/Payment.css') }}">

            <!-- Chọn trẻ -->
            <div class="mb-4">
                <label class="form-label-pink">👶 Chọn trẻ</label>
                <select class="form-custom-select" id="child_id" name="child_id" required>
                    <option value="">-- Chọn trẻ --</option>
                    @foreach ($children as $child)
                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label-pink">📅 Chọn kỳ học phí</label>
                <select class="form-custom-select" id="tuition_id" name="tuition_id" disabled>
                    <option value="">-- Chọn kỳ học phí --</option>
                </select>
            </div>

            <div class="detail-box" id="tuition_details" style="display: none;">
                <h5 class="detail-title">📋 Chi tiết học phí</h5>
                <ul id="tuition_detail_list" class="list-group-custom"></ul>
            </div>

            <!-- Phương thức thanh toán -->
            <div class="radio-group">
                <h5 class="detail-title" style="margin-top:0;">💳 Chọn cách thanh toán:</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="momo" value="momo" required>
                    <label class="form-check-label" for="momo">
                        Thanh toán qua MoMo
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="stripe" value="stripe" required>
                    <label class="form-check-label" for="stripe">
                        Thanh toán qua thẻ tín dụng (Stripe)
                    </label>
                </div>
            </div>

            <input type="hidden" name="tuition_id" id="selected_tuition_id">
            <button type="submit" class="btn-payment" disabled id="payment_button">💸 Thanh toán ngay</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const childSelect = document.getElementById("child_id");
        const tuitionSelect = document.getElementById("tuition_id");
        const tuitionDetails = document.getElementById("tuition_details");
        const tuitionDetailList = document.getElementById("tuition_detail_list");
        const paymentButton = document.getElementById("payment_button");
        const selectedTuitionIdInput = document.getElementById("selected_tuition_id");
        const tuitions = @json($tuitions);

        childSelect.addEventListener("change", () => {
            const childId = childSelect.value;
            if (childId) {
                const filteredTuitions = tuitions.filter(tuition => tuition.child_id == childId);
                tuitionSelect.innerHTML = `<option value="">-- Chọn kỳ học phí --</option>`;
                filteredTuitions.forEach(tuition => {
                    const option = document.createElement("option");
                    option.value = tuition.id;
                    option.textContent = `Học phí kỳ ${tuition.semester} - ${tuition.tuition_info.reduce((sum, info) => sum + info.price, 0).toLocaleString()} VNĐ`;
                    if (tuition.status === 1) {
                        option.textContent += " (Đã thanh toán)";
                        option.disabled = true; 
                    }
                    tuitionSelect.appendChild(option);
                });
                tuitionSelect.disabled = false;
                tuitionDetails.style.display = "none";
                paymentButton.disabled = true;
            } else {
                tuitionSelect.innerHTML = `<option value="">-- Chọn kỳ học phí --</option>`;
                tuitionSelect.disabled = true;
                tuitionDetails.style.display = "none";
                paymentButton.disabled = true;
            }
        });

        tuitionSelect.addEventListener("change", () => {
            const tuitionId = tuitionSelect.value;
            if (tuitionId) {
                const selectedTuition = tuitions.find(tuition => tuition.id == tuitionId);
                const details = selectedTuition ? selectedTuition.tuition_info : [];
                tuitionDetailList.innerHTML = "";
                details.forEach(detail => {
                    const listItem = document.createElement("li");
                    listItem.textContent = `📌 ${detail.name} - ${detail.price.toLocaleString()} VNĐ`;
                    tuitionDetailList.appendChild(listItem);
                });
                tuitionDetails.style.display = "block";
                paymentButton.disabled = false;
                selectedTuitionIdInput.value = tuitionId;
            } else {
                tuitionDetails.style.display = "none";
                paymentButton.disabled = true;
            }
        });
    });

    // Nút quay về
    document.getElementById('back-button').addEventListener('click', function () {
        window.history.back();
    });
</script>
@endsection