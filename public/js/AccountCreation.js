document.getElementById('profileImage').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '140px'; // Đặt chiều rộng ảnh
            img.style.height = '187px'; // Đặt chiều cao ảnh theo tỉ lệ 3:4
            img.style.objectFit = 'cover'; // Giữ tỉ lệ ảnh mà không bị méo
            
            const uploadArea = document.querySelector('.upload-area');
            uploadArea.innerHTML = ''; // Xóa nội dung cũ trong khung
            uploadArea.appendChild(img); // Thêm ảnh vào khung
        };
        reader.readAsDataURL(file);
    }
});
