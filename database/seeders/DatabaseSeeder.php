<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ
        $this->clearExistingData();
        
        // Tạo tài khoản admin
        $adminId = $this->createAdmin();
        
        // Tạo 10 giáo viên (5 nam, 5 nữ)
        $teachers = $this->createTeachers();
        
        // Tạo 100 phụ huynh
        $parents = $this->createParents();
        
        // Tạo danh mục cơ sở vật chất tổng hợp
        $totalFacilities = $this->createTotalFacilities();
        
        // Tạo chi tiết cơ sở vật chất
        $dentailFacilities = $this->createDentailFacilities($totalFacilities);
        
        // Tạo 10 lớp học
        $classrooms = $this->createClassrooms($teachers);
        
        // Tạo 100 học sinh (40 nam, 60 nữ)
        $children = $this->createChildren($parents);
        
        // Thêm học sinh vào lớp (ChildClass)
        $this->assignChildrenToClasses($children, $classrooms);
        
        // Tạo học phí (tuition)
        $this->createTuitions($children);
        
        // Tạo chi tiết học phí (tuition_info)
        $this->createTuitionInfos();
        
        // Tạo cơ sở vật chất cho lớp học (facilities)
        $this->createClassroomFacilities($classrooms, $dentailFacilities);
        
        // Tạo camera (cam)
        $this->createCameras();
        
        // Tạo phản hồi (feedback)
        $this->createFeedbacks($parents, $adminId);
        
        // Tạo tin nhắn (message)
        $this->createMessages($teachers, $parents);
        
        $this->command->info('=====================================');
        $this->command->info('✅ SEED DỮ LIỆU THÀNH CÔNG!');
        $this->command->info('=====================================');
    }
    
    private function clearExistingData(): void
    {
        $this->command->info('Đang xóa dữ liệu cũ...');
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        DB::table('messages')->truncate();
        DB::table('feedback')->truncate();
        DB::table('cams')->truncate();
        DB::table('facilities')->truncate();
        DB::table('dentail_facilities')->truncate();
        DB::table('total_facilities')->truncate();
        DB::table('tuition_infos')->truncate();
        DB::table('tuitions')->truncate();
        DB::table('weekevaluates')->truncate();
        DB::table('childclasses')->truncate();
        DB::table('classrooms')->truncate();
        DB::table('children')->truncate();
        DB::table('users')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->command->info('✅ Xóa dữ liệu cũ hoàn tất!');
    }
    
    private function createAdmin(): int
    {
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Quản trị viên',
            'email' => 'admin@nursery.com',
            'password' => Hash::make('12345678'),
            'phone' => '0987654321',
            'id_number' => 'ADMIN001',
            'address' => 'Số 1, Đường Quản trị, Quận 1, TP.HCM',
            'role' => 0,
            'status' => 1,
            'gender' => 'male',
            'img' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        $this->command->info("✅ Đã tạo admin: Quản trị viên");
        return $adminId;
    }
    
    private function createTeachers(): array
    {
        $teachers = [];
        
        $teacherData = [
            ['name' => 'Nguyễn Văn An', 'gender' => 'male', 'phone' => '0912345670', 'email' => 'teacher0@nursery.com', 'id_number' => 'GV001'],
            ['name' => 'Trần Thị Bích', 'gender' => 'female', 'phone' => '0912345671', 'email' => 'teacher1@nursery.com', 'id_number' => 'GV002'],
            ['name' => 'Lê Văn Cường', 'gender' => 'male', 'phone' => '0912345672', 'email' => 'teacher2@nursery.com', 'id_number' => 'GV003'],
            ['name' => 'Phạm Thị Dung', 'gender' => 'female', 'phone' => '0912345673', 'email' => 'teacher3@nursery.com', 'id_number' => 'GV004'],
            ['name' => 'Hoàng Văn Em', 'gender' => 'male', 'phone' => '0912345674', 'email' => 'teacher4@nursery.com', 'id_number' => 'GV005'],
            ['name' => 'Đặng Thị Phượng', 'gender' => 'female', 'phone' => '0912345675', 'email' => 'teacher5@nursery.com', 'id_number' => 'GV006'],
            ['name' => 'Võ Văn Giàu', 'gender' => 'male', 'phone' => '0912345676', 'email' => 'teacher6@nursery.com', 'id_number' => 'GV007'],
            ['name' => 'Ngô Thị Hạnh', 'gender' => 'female', 'phone' => '0912345677', 'email' => 'teacher7@nursery.com', 'id_number' => 'GV008'],
            ['name' => 'Bùi Văn In', 'gender' => 'male', 'phone' => '0912345678', 'email' => 'teacher8@nursery.com', 'id_number' => 'GV009'],
            ['name' => 'Đỗ Thị Kim', 'gender' => 'female', 'phone' => '0912345679', 'email' => 'teacher9@nursery.com', 'id_number' => 'GV010'],
        ];
        
        foreach ($teacherData as $data) {
            $teacherId = DB::table('users')->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('12345678'),
                'phone' => $data['phone'],
                'id_number' => $data['id_number'],
                'address' => 'Số ' . rand(1, 50) . ', Đường Giáo viên, Quận ' . rand(1, 12) . ', TP.HCM',
                'role' => 1,
                'status' => 1,
                'gender' => $data['gender'],
                'img' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $teachers[] = $teacherId;
        }
        
        $this->command->info("✅ Đã tạo 10 giáo viên (5 nam, 5 nữ)");
        return $teachers;
    }
    
    private function createParents(): array
    {
        $parents = [];
        $parentNames = [
            'Trần Văn Nam', 'Lê Thị Hoa', 'Phạm Văn Hùng', 'Nguyễn Thị Lan', 'Hoàng Văn Tài',
            'Vũ Thị Ngọc', 'Đặng Văn Lực', 'Bùi Thị Hương', 'Đỗ Văn Thành', 'Ngô Thị Mai',
            'Lương Văn Quân', 'Trịnh Thị Thu', 'Dương Văn Khánh', 'Lý Thị Hằng', 'Mai Văn Đức',
            'Chu Thị Nga', 'Tạ Văn Phúc', 'Hà Thị Vân', 'Phan Văn Thịnh', 'Nguyễn Thị Ánh',
            'Trần Văn Quang', 'Lê Thị Dung', 'Phạm Văn Trung', 'Hoàng Thị Thảo', 'Vũ Văn Minh'
        ];
        
        for ($i = 0; $i < 100; $i++) {
            $nameIndex = $i % 25;
            $gender = $i % 2 == 0 ? 'male' : 'female';
            $suffix = floor($i / 25);
            $name = $parentNames[$nameIndex];
            if ($suffix > 0) {
                $name .= ' ' . ($suffix + 1);
            }
            
            $parentId = DB::table('users')->insertGetId([
                'name' => $name,
                'email' => "parent{$i}@gmail.com",
                'password' => Hash::make('12345678'),
                'phone' => '09' . str_pad($i + 100000000, 8, '0', STR_PAD_LEFT),
                'id_number' => 'PH' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'address' => 'Số ' . ($i + 1) . ', Đường Phụ huynh, Quận ' . ($i % 12 + 1) . ', TP.HCM',
                'role' => 2,
                'status' => 1,
                'gender' => $gender,
                'img' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $parents[] = $parentId;
        }
        
        $this->command->info("✅ Đã tạo 100 phụ huynh");
        return $parents;
    }
    
    private function createTotalFacilities(): array
    {
        $totalFacilities = [];
        $categories = ['Bàn ghế', 'Đồ chơi', 'Thiết bị học tập', 'Thiết bị vệ sinh', 'Đồ dùng nhà bếp'];
        
        foreach ($categories as $category) {
            $totalId = DB::table('total_facilities')->insertGetId([
                'name' => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $totalFacilities[] = $totalId;
        }
        
        $this->command->info("✅ Đã tạo " . count($totalFacilities) . " danh mục cơ sở vật chất");
        return $totalFacilities;
    }
    
    private function createDentailFacilities(array $totalFacilities): array
    {
        $dentailFacilities = [];
        $details = [
            ['Bàn học sinh', 100], ['Ghế học sinh', 100], ['Bảng trắng', 15], ['Tủ đồ', 10],
            ['Bộ đồ chơi', 20], ['Bóng', 50], ['Sách truyện', 200], ['Bút màu', 100],
            ['Giấy vẽ', 300], ['Đất nặn', 50], ['Bồn rửa', 10], ['Khăn mặt', 100],
            ['Bếp gas', 3], ['Tủ lạnh', 3], ['Máy lọc nước', 3], ['Bát đĩa', 50]
        ];
        
        foreach ($totalFacilities as $totalId) {
            for ($i = 0; $i < 3; $i++) {
                $detail = $details[array_rand($details)];
                $dentailId = DB::table('dentail_facilities')->insertGetId([
                    'name' => $detail[0],
                    'quantity' => $detail[1],
                    'total_id' => $totalId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $dentailFacilities[] = $dentailId;
            }
        }
        
        $this->command->info("✅ Đã tạo " . count($dentailFacilities) . " chi tiết cơ sở vật chất");
        return $dentailFacilities;
    }
    
    private function createClassrooms(array $teachers): array
    {
        $classrooms = [];
        $classNames = ['Lá 1', 'Lá 2', 'Lá 3', 'Chồi 1', 'Chồi 2', 'Chồi 3', 'Mầm 1', 'Mầm 2', 'Mầm 3', 'Mầm 4'];
        
        foreach ($classNames as $index => $className) {
            $classroomId = DB::table('classrooms')->insertGetId([
                'name' => $className,
                'user_id' => $teachers[$index],
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $classrooms[] = $classroomId;
        }
        
        $this->command->info("✅ Đã tạo 10 lớp học");
        return $classrooms;
    }
    
    private function createChildren(array $parents): array
    {
        $children = [];
        $maleNames = ['An', 'Bình', 'Cường', 'Duy', 'Hải', 'Hoàng', 'Minh', 'Nam', 'Phúc', 'Tuấn'];
        $femaleNames = ['Anh', 'Bích', 'Hà', 'Hoa', 'Lan', 'Linh', 'Mai', 'Ngọc', 'Phương', 'Trang'];
        
        for ($i = 0; $i < 100; $i++) {
            $gender = $i < 40 ? 1 : 0;
            $nameList = $gender == 1 ? $maleNames : $femaleNames;
            $name = 'Bé ' . $nameList[$i % 10];
            if ($i >= 10) $name .= ' ' . (floor($i / 10) + 1);
            
            $birthDate = Carbon::now()->subYears(rand(2, 5))->subDays(rand(0, 365));
            
            $childId = DB::table('children')->insertGetId([
                'name' => $name,
                'img' => null,
                'birthDate' => $birthDate,
                'status' => 1,
                'gender' => $gender,
                'user_id' => $parents[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $children[] = $childId;
        }
        
        $this->command->info("✅ Đã tạo 100 học sinh (40 nam, 60 nữ)");
        return $children;
    }
    
    private function assignChildrenToClasses(array $children, array $classrooms): void
    {
        $childIndex = 0;
        foreach ($classrooms as $classroomId) {
            for ($j = 0; $j < 10; $j++) {
                DB::table('childclasses')->insert([
                    'child_id' => $children[$childIndex],
                    'classroom_id' => $classroomId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $childIndex++;
            }
        }
        $this->command->info("✅ Đã phân 100 học sinh vào 10 lớp (mỗi lớp 10 học sinh)");
    }
    
    private function createTuitions(array $children): void
    {
        $semesters = ['Học kỳ 1 - 2024', 'Học kỳ 2 - 2024'];
        
        foreach ($children as $childId) {
            foreach ($semesters as $semester) {
                $tuitionId = DB::table('tuitions')->insertGetId([
                    'semester' => $semester,
                    'status' => rand(0, 1),
                    'child_id' => $childId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $this->createTuitionInfoForTuition($tuitionId);
            }
        }
        $this->command->info("✅ Đã tạo học phí cho 100 học sinh");
    }
    
    private function createTuitionInfos(): void
    {
        // Đã xử lý trong createTuitionInfoForTuition
    }
    
    private function createTuitionInfoForTuition(int $tuitionId): void
    {
        $fees = [
            ['name' => 'Học phí', 'price' => 1500000],
            ['name' => 'Tiền ăn', 'price' => 500000],
            ['name' => 'Tiền học năng khiếu', 'price' => 300000],
            ['name' => 'Bảo hiểm', 'price' => 200000],
        ];
        
        $selected = array_rand($fees, rand(2, 3));
        if (!is_array($selected)) $selected = [$selected];
        
        foreach ($selected as $index) {
            DB::table('tuition_infos')->insert([
                'name' => $fees[$index]['name'],
                'price' => $fees[$index]['price'],
                'tuition_id' => $tuitionId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
    
    private function createClassroomFacilities(array $classrooms, array $dentailFacilities): void
    {
        foreach ($classrooms as $classroomId) {
            for ($i = 0; $i < rand(5, 8); $i++) {
                DB::table('facilities')->insert([
                    'name' => 'Thiết bị ' . ($i + 1),
                    'quantity' => rand(2, 10),
                    'dentail_id' => $dentailFacilities[array_rand($dentailFacilities)],
                    'classroom_id' => $classroomId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        $this->command->info("✅ Đã tạo cơ sở vật chất cho 10 lớp học");
    }
    
    private function createCameras(): void
    {
        $cameras = [
            ['name' => 'Camera Sảnh chính', 'stream_url' => 'rtsp://camera1.local/stream'],
            ['name' => 'Camera Sân chơi', 'stream_url' => 'rtsp://camera2.local/stream'],
            ['name' => 'Camera Lớp Lá 1', 'stream_url' => 'rtsp://camera3.local/stream'],
            ['name' => 'Camera Lớp Mầm 1', 'stream_url' => 'rtsp://camera4.local/stream'],
            ['name' => 'Camera Hành lang', 'stream_url' => 'rtsp://camera5.local/stream'],
        ];
        
        foreach ($cameras as $camera) {
            DB::table('cams')->insert([
                'name' => $camera['name'],
                'stream_url' => $camera['stream_url'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        $this->command->info("✅ Đã tạo 5 camera");
    }
    
    private function createFeedbacks(array $parents, int $adminId): void
    {
        $contents = [
            'Trường học rất tốt, giáo viên nhiệt tình',
            'Cơ sở vật chất khang trang, sạch sẽ',
            'Con tôi rất thích đi học',
            'Rất hài lòng về dịch vụ của trường'
        ];
        
        foreach ($parents as $index => $parentId) {
            if ($index % 5 == 0) {
                $parent = DB::table('users')->where('id', $parentId)->first();
                DB::table('feedback')->insert([
                    'name' => $parent->name,
                    'email' => $parent->email,
                    'content' => $contents[array_rand($contents)],
                    'user_id' => $adminId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        $this->command->info("✅ Đã tạo phản hồi từ phụ huynh");
    }
    
    private function createMessages(array $teachers, array $parents): void
    {
        $messageTemplates = [
            'Chào phụ huynh, hôm nay bé học rất tốt ạ!',
            'Con có tiến bộ trong tuần này, cô khen nhiều lắm ạ.',
            'Tuần tới nhà trường tổ chức họp phụ huynh ạ.',
            'Bé nhà mình được chọn tham gia văn nghệ ạ.',
            'Chúc phụ huynh và gia đình cuối tuần vui vẻ!'
        ];
        
        for ($i = 0; $i < 150; $i++) {
            DB::table('messages')->insert([
                'sender_id' => $teachers[array_rand($teachers)],
                'receiver_id' => $parents[array_rand($parents)],
                'message' => $messageTemplates[array_rand($messageTemplates)],
                'created_at' => Carbon::now()->subHours(rand(1, 720)),
                'updated_at' => Carbon::now(),
            ]);
        }
        $this->command->info("✅ Đã tạo 150 tin nhắn giữa giáo viên và phụ huynh");
    }
}