<img width="2559" height="1389" alt="image" src="https://github.com/user-attachments/assets/36f8ccdf-959a-42fb-be09-f0c10eafbf02" />
<img width="2559" height="1383" alt="image" src="https://github.com/user-attachments/assets/18d1a059-c13b-4952-a459-9613cc996033" />
<img width="2559" height="1528" alt="image" src="https://github.com/user-attachments/assets/ec2bd04d-d2d5-4cc8-97b6-c9f631516e23" />
<img width="2559" height="1403" alt="image" src="https://github.com/user-attachments/assets/2433396b-1cb3-4bbe-a561-a0291c9af97a" />
<img width="2559" height="1390" alt="image" src="https://github.com/user-attachments/assets/b5f16247-51e4-4b3e-9839-e8890504ea6a" />
# Hệ thống Quản lý Trường Mầm non

**Tiếng Việt** | [English](README.en.md)

Hệ thống quản lý trường mầm non xây dựng bằng **Laravel**, giúp nhà trường quản lý hồ sơ trẻ, lớp học, cơ sở vật chất, thời khóa biểu và học phí; giáo viên đánh giá trẻ hằng ngày; phụ huynh theo dõi con, đóng học phí trực tuyến và trao đổi với giáo viên.

Mục tiêu: giảm giấy tờ thủ công, hạn chế các cuộc họp trực tiếp với phụ huynh và nâng cao hiệu quả quản lý.

## Mục lục

- [Demo](#demo)
- [Ảnh minh họa](#ảnh-minh-họa)
- [Tính năng](#tính-năng)
- [Phân quyền](#phân-quyền)
- [Công nghệ](#công-nghệ)
- [Bắt đầu](#bắt-đầu)
- [Biến môi trường](#biến-môi-trường)
- [Triển khai](#triển-khai)
- [Hướng phát triển](#hướng-phát-triển)
- [Phân công](#phân-công)

## Demo

Trang demo: https://quan-ly-truong-mam-non.onrender.com/login

| Vai trò | Tài khoản | Mật khẩu |
| --- | --- | --- |
| Admin | `0987654321` (số điện thoại) | `12345678` |
| Giáo viên | `teacher0@nursery.com` | `12345678` |
| Phụ huynh | `parent0@gmail.com` | `12345678` |

Có thể đăng nhập bằng số điện thoại hoặc email.

## Ảnh minh họa

<!-- Dán các ảnh chụp màn hình từ README cũ vào đây -->

## Tính năng

### Admin
- **Bảng điều khiển:** thống kê theo tháng (số học sinh, học sinh mới, giáo viên mới, phụ huynh mới, số phản hồi).
- **Quản lý tài khoản:** tìm kiếm, lọc theo vai trò, thêm/sửa/xóa, ảnh đại diện, nhập/xuất Excel.
- **Quản lý hồ sơ trẻ:** thêm/sửa, ảnh, nhập/xuất Excel; xếp trẻ vào lớp.
- **Quản lý lớp học:** tạo/sửa lớp, gán giáo viên (mỗi giáo viên phụ trách một lớp), cấp cơ sở vật chất cho lớp. Số lượng trong kho tự động trừ hoặc cộng lại khi cấp hoặc thu hồi, xử lý trong transaction.
- **Quản lý cơ sở vật chất:** nhóm cơ sở vật chất và các hạng mục, theo dõi số lượng, tăng/giảm số lượng.
- **Môn học và thời khóa biểu:** quản lý môn học, lập thời khóa biểu theo học kỳ, xuất PDF.
- **Học phí:** tạo học phí theo lớp và học kỳ với nhiều khoản mục; hệ thống tự tạo khoản học phí cho từng trẻ trong lớp.
- **Phản hồi:** xem và xóa phản hồi từ người dùng.
- **Camera:** thêm/xóa camera (tên và URL luồng).

### Giáo viên
- Xem danh sách học sinh trong lớp mình phụ trách.
- Đánh giá học sinh theo ngày: nhận xét và điểm (0–10), chỉ đánh giá cho ngày hôm nay, không cho phép đánh giá trùng ngày.
- Nhắn tin với phụ huynh của lớp.

### Phụ huynh
- Xem thông tin con và kết quả đánh giá theo ngày.
- Đóng học phí trực tuyến bằng **Stripe** hoặc **MoMo** (môi trường thử nghiệm), nhận hóa đơn qua email.
- Nhắn tin với giáo viên của lớp con.
- Xem camera.

### Chung
- Đăng nhập bằng số điện thoại hoặc email.
- Quên mật khẩu (nhận mã xác nhận qua email) và đổi mật khẩu.
- Gửi phản hồi tới nhà trường.

## Phân quyền

| Vai trò | Giá trị `role` | Quyền chính |
| --- | --- | --- |
| Admin | 0 | Quản trị toàn hệ thống |
| Giáo viên | 1 | Đánh giá học sinh, trao đổi với phụ huynh |
| Phụ huynh | 2 | Theo dõi con, đóng học phí, trao đổi với giáo viên |

## Công nghệ

| Thành phần | Công nghệ |
| --- | --- |
| Backend | Laravel, PHP, MySQL |
| Frontend | Blade, Tailwind CSS, JavaScript, Vite |
| Thanh toán | Stripe Checkout, MoMo (môi trường thử nghiệm) |
| Email | Laravel Mail (SMTP) |
| Excel và PDF | Laravel Excel (Maatwebsite), DomPDF |
| Triển khai | Docker, Render |

## Bắt đầu

### Yêu cầu

- PHP 8.2 trở lên
- Composer
- Node.js và npm
- MySQL

### Cài đặt

```bash
git clone https://github.com/Hongtruongbvn/quan_ly_truong_mam_non.git
cd quan_ly_truong_mam_non

composer install
npm install
```

Tạo file `.env` ở thư mục gốc theo mục [Biến môi trường](#biến-môi-trường), sau đó:

```bash
php artisan key:generate
php artisan migrate
php artisan storage:link   # để hiển thị ảnh tải lên
```

### Chạy dự án

Chạy hai tiến trình trong hai terminal:

```bash
php artisan serve
npm run dev
```

Build tài nguyên cho môi trường production:

```bash
npm run build
```

## Biến môi trường

> Các giá trị dạng `YOUR_...` là ví dụ. Hãy thay bằng giá trị của bạn và **không commit file `.env` lên GitHub**.

```dotenv
APP_NAME="YOUR_APP_NAME"
APP_KEY=
APP_ENV=local                             # production khi triển khai
APP_DEBUG=true                            # false khi triển khai
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USERNAME
DB_PASSWORD=YOUR_DB_PASSWORD

# Email (SMTP)
MAIL_MAILER=smtp
MAIL_HOST=YOUR_MAIL_HOST
MAIL_PORT=587
MAIL_USERNAME=YOUR_MAIL_USERNAME
MAIL_PASSWORD=YOUR_MAIL_PASSWORD
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=YOUR_EMAIL
MAIL_FROM_NAME="${APP_NAME}"

# Stripe
STRIPE_KEY=YOUR_STRIPE_PUBLISHABLE_KEY
STRIPE_SECRET=YOUR_STRIPE_SECRET_KEY
```

## Triển khai

Dự án có sẵn `Dockerfile` và được triển khai trên Render.

## Hướng phát triển

- Ứng dụng di động.
- Chat theo thời gian thực giữa giáo viên và phụ huynh.
- Phân tích học tập bằng AI.
- Điểm danh bằng mã QR.
- Tích hợp học liệu trực tuyến.

## Phân công

**Phạm Hồng Trưởng** (Trưởng nhóm)
- Xây dựng cơ sở dữ liệu, Controllers và Business Logic.
- Hỗ trợ phát triển Frontend.
