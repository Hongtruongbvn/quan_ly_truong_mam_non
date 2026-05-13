<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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
        
        // Tạo 10 lớp học (Lá 1-3, Chồi 1-3, Mầm 1-4)
        $classrooms = $this->createClassrooms($teachers);
        
        // Tạo 100 học sinh (60 nữ, 40 nam) - chia đều vào 10 lớp
        $children = $this->createChildren($parents, $classrooms);
        
        // Thêm học sinh vào lớp (ChildClass)
        $this->assignChildrenToClasses($children, $classrooms);
        
        // Tạo điểm danh (attendant) cho học sinh
        $this->createAttendants($children);
        
        // Tạo đánh giá tuần (weekevaluate) cho học sinh
        $this->createWeekEvaluates($children);
        
        // Tạo học phí (tuition) cho học sinh
        $this->createTuitions($children);
        
        // Tạo chi tiết học phí (tuition_info)
        $this->createTuitionInfos();
        
        // Tạo cơ sở vật chất cho lớp học (facilities)
        $this->createClassroomFacilities($classrooms, $dentailFacilities);
        
        // Tạo môn học (subject)
        $subjects = $this->createSubjects();
        
        // Tạo thời khóa biểu (schedule)
        $schedules = $this->createSchedules($classrooms);
        
        // Tạo chi tiết thời khóa biểu (schedule_info)
        $this->createScheduleInfos($schedules, $subjects);
        
        // Tạo camera (cam)
        $this->createCameras();
        
        // Tạo phản hồi (feedback)
        $this->createFeedbacks($parents);
        
        // Tạo tin nhắn (message)
        $this->createMessages($teachers, $parents);
        
        $this->command->info('Seed dữ liệu thành công!');
    }
    
    /**
     * Xóa dữ liệu cũ
     */
    private function clearExistingData(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        DB::table('users')->truncate();
        DB::table('children')->truncate();
        DB::table('classrooms')->truncate();
        DB::table('childclasses')->truncate();
        DB::table('attendants')->truncate();
        DB::table('weekevaluates')->truncate();
        DB::table('tuitions')->truncate();
        DB::table('tuition_infos')->truncate();
        DB::table('total_facilities')->truncate();
        DB::table('dentail_facilities')->truncate();
        DB::table('facilities')->truncate();
        DB::table('subjects')->truncate();
        DB::table('schedules')->truncate();
        DB::table('schedule_infos')->truncate();
        DB::table('cams')->truncate();
        DB::table('feedbacks')->truncate();
        DB::table('messages')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
    
    /**
     * Tạo tài khoản admin
     */
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
        
        $this->command->info("Đã tạo admin: Quản trị viên");
        return $adminId;
    }
    
    /**
     * Tạo 10 giáo viên (5 nam, 5 nữ)
     */
    private function createTeachers(): array
    {
        $teachers = [];
        $genders = ['male', 'female'];
        $maleCount = 0;
        $femaleCount = 0;
        
        $teacherNames = [
            'Nguyễn Văn An', 'Trần Thị Bích', 'Lê Văn Cường', 'Phạm Thị Dung', 'Hoàng Văn Em',
            'Đặng Thị Phượng', 'Võ Văn Giàu', 'Ngô Thị Hạnh', 'Bùi Văn In', 'Đỗ Thị Kim'
        ];
        
        $teacherPhones = [
            '0912345670', '0912345671', '0912345672', '0912345673', '0912345674',
            '0912345675', '0912345676', '0912345677', '0912345678', '0912345679'
        ];
        
        for ($i = 0; $i < 10; $i++) {
            $gender = $i < 5 ? 'male' : 'female';
            if ($gender == 'male') $maleCount++;
            else $femaleCount++;
            
            $teacherId = DB::table('users')->insertGetId([
                'name' => $teacherNames[$i],
                'email' => "teacher{$i}@nursery.com",
                'password' => Hash::make('12345678'),
                'phone' => $teacherPhones[$i],
                'id_number' => 'GV' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'address' => 'Số ' . ($i + 1) . ', Đường Giáo viên, Quận ' . ($i % 5 + 1) . ', TP.HCM',
                'role' => 1,
                'status' => 1,
                'gender' => $gender,
                'img' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            
            $teachers[] = $teacherId;
        }
        
        $this->command->info("Đã tạo 10 giáo viên (5 nam, 5 nữ)");
        return $teachers;
    }
    
    /**
     * Tạo 100 phụ huynh
     */
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
        
        // Mở rộng lên 100 tên
        for ($i = 0; $i < 100; $i++) {
            $nameIndex = $i % 25;
            $gender = $i % 2 == 0 ? 'male' : 'female';
            
            $parentId = DB::table('users')->insertGetId([
                'name' => $parentNames[$nameIndex] . ($i < 25 ? '' : ' ' . (floor($i / 25) + 1)),
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
        
        $this->command->info("Đã tạo 100 phụ huynh");
        return $parents;
    }
    
    /**
     * Tạo danh mục cơ sở vật chất tổng hợp
     */
    private function createTotalFacilities(): array
    {
        $totalFacilities = [];
        
        $facilityCategories = [
            'Bàn ghế',
            'Đồ chơi',
            'Thiết bị học tập',
            'Thiết bị vệ sinh',
            'Đồ dùng nhà bếp',
            'Thiết bị y tế',
            'Đồ dùng thể thao',
            'Thiết bị điện tử',
            'Đồ dùng văn phòng',
            'Thiết bị an ninh'
        ];
        
        foreach ($facilityCategories as $index => $category) {
            $totalId = DB::table('total_facilities')->insertGetId([
                'name' => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $totalFacilities[] = $totalId;
        }
        
        $this->command->info("Đã tạo 10 danh mục cơ sở vật chất tổng hợp");
        return $totalFacilities;
    }
    
    /**
     * Tạo chi tiết cơ sở vật chất
     */
    private function createDentailFacilities(array $totalFacilities): array
    {
        $dentailFacilities = [];
        
        $dentailDetails = [
            1 => [['name' => 'Bàn học sinh', 'quantity' => 100], ['name' => 'Ghế học sinh', 'quantity' => 100], ['name' => 'Bàn giáo viên', 'quantity' => 15], ['name' => 'Ghế giáo viên', 'quantity' => 15]],
            2 => [['name' => 'Bộ đồ chơi xếp hình', 'quantity' => 20], ['name' => 'Bóng nhựa', 'quantity' => 50], ['name' => 'Thú nhồi bông', 'quantity' => 30], ['name' => 'Xe đồ chơi', 'quantity' => 25]],
            3 => [['name' => 'Bảng trắng', 'quantity' => 15], ['name' => 'Bút lông', 'quantity' => 100], ['name' => 'Giấy vẽ', 'quantity' => 200], ['name' => 'Màu sáp', 'quantity' => 50]],
            4 => [['name' => 'Bồn rửa tay', 'quantity' => 20], ['name' => 'Nhà vệ sinh', 'quantity' => 15], ['name' => 'Khăn mặt', 'quantity' => 100], ['name' => 'Xà phòng', 'quantity' => 50]],
            5 => [['name' => 'Bếp gas', 'quantity' => 5], ['name' => 'Tủ lạnh', 'quantity' => 5], ['name' => 'Bộ xoong nồi', 'quantity' => 10], ['name' => 'Bát đĩa', 'quantity' => 100]],
            6 => [['name' => 'Tủ thuốc', 'quantity' => 5], ['name' => 'Nhiệt kế', 'quantity' => 10], ['name' => 'Băng gạc', 'quantity' => 50], ['name' => 'Thuốc sát trùng', 'quantity' => 30]],
            7 => [['name' => 'Bóng đá', 'quantity' => 15], ['name' => 'Dây nhảy', 'quantity' => 30], ['name' => 'Cầu lông', 'quantity' => 20], ['name' => 'Lưới bóng rổ', 'quantity' => 5]],
            8 => [['name' => 'Tivi', 'quantity' => 10], ['name' => 'Máy tính', 'quantity' => 10], ['name' => 'Máy chiếu', 'quantity' => 5], ['name' => 'Loa', 'quantity' => 10]],
            9 => [['name' => 'Bàn làm việc', 'quantity' => 10], ['name' => 'Ghế văn phòng', 'quantity' => 10], ['name' => 'Máy in', 'quantity' => 3], ['name' => 'Giấy A4', 'quantity' => 50]],
            10 => [['name' => 'Camera giám sát', 'quantity' => 20], ['name' => 'Chuông báo động', 'quantity' => 5], ['name' => 'Bình chữa cháy', 'quantity' => 15], ['name' => 'Đèn chiếu sáng', 'quantity' => 30]],
        ];
        
        foreach ($totalFacilities as $index => $totalId) {
            $details = $dentailDetails[$index + 1] ?? [];
            foreach ($details as $detail) {
                $dentailId = DB::table('dentail_facilities')->insertGetId([
                    'name' => $detail['name'],
                    'total_id' => $totalId,
                    'quantity' => $detail['quantity'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $dentailFacilities[] = $dentailId;
            }
        }
        
        $this->command->info("Đã tạo " . count($dentailFacilities) . " chi tiết cơ sở vật chất");
        return $dentailFacilities;
    }
    
    /**
     * Tạo 10 lớp học
     */
    private function createClassrooms(array $teachers): array
    {
        $classrooms = [];
        
        $classNames = [
            'Lá 1', 'Lá 2', 'Lá 3',
            'Chồi 1', 'Chồi 2', 'Chồi 3',
            'Mầm 1', 'Mầm 2', 'Mầm 3', 'Mầm 4'
        ];
        
        for ($i = 0; $i < 10; $i++) {
            $classroomId = DB::table('classrooms')->insertGetId([
                'name' => $classNames[$i],
                'user_id' => $teachers[$i],
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $classrooms[] = $classroomId;
        }
        
        $this->command->info("Đã tạo 10 lớp học");
        return $classrooms;
    }
    
    /**
     * Tạo 100 học sinh (60 nữ, 40 nam)
     */
    private function createChildren(array $parents, array $classrooms): array
    {
        $children = [];
        
        $firstNamesMale = ['An', 'Bình', 'Cường', 'Duy', 'Đạt', 'Hải', 'Hoàng', 'Hùng', 'Khải', 'Lâm', 'Minh', 'Nam', 'Phúc', 'Quân', 'Sơn', 'Tài', 'Thắng', 'Thành', 'Tuấn', 'Vinh'];
        $firstNamesFemale = ['Anh', 'Bích', 'Cúc', 'Diễm', 'Hà', 'Hằng', 'Hiền', 'Hoa', 'Hương', 'Lan', 'Linh', 'Mai', 'Ngọc', 'Phương', 'Quỳnh', 'Thảo', 'Thu', 'Trang', 'Trúc', 'Vy'];
        
        // 40 nam, 60 nữ
        for ($i = 0; $i < 100; $i++) {
            $gender = $i < 40 ? 'male' : 'female';
            $firstName = $gender == 'male' ? $firstNamesMale[$i % 20] : $firstNamesFemale[$i % 20];
            $lastName = $gender == 'male' ? 'Bé' : 'Bé';
            
            $birthDate = Carbon::now()->subYears(rand(2, 5))->subDays(rand(0, 365));
            
            $childId = DB::table('children')->insertGetId([
                'name' => $lastName . ' ' . $firstName,
                'birthDate' => $birthDate,
                'gender' => $gender,
                'user_id' => $parents[$i % 100],
                'img' => null,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            
            $children[] = $childId;
        }
        
        $this->command->info("Đã tạo 100 học sinh (40 nam, 60 nữ)");
        return $children;
    }
    
    /**
     * Thêm học sinh vào lớp (mỗi lớp 10 học sinh)
     */
    private function assignChildrenToClasses(array $children, array $classrooms): void
    {
        $childIndex = 0;
        
        foreach ($classrooms as $classroomId) {
            for ($j = 0; $j < 10; $j++) {
                if ($childIndex >= count($children)) break;
                
                DB::table('childclasses')->insert([
                    'child_id' => $children[$childIndex],
                    'classroom_id' => $classroomId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $childIndex++;
            }
        }
        
        $this->command->info("Đã phân 100 học sinh vào 10 lớp (mỗi lớp 10 học sinh)");
    }
    
    /**
     * Tạo điểm danh cho học sinh (15 ngày gần đây)
     */
    private function createAttendants(array $children): void
    {
        $statuses = ['present', 'absent', 'late'];
        
        for ($day = 1; $day <= 15; $day++) {
            $date = Carbon::now()->subDays(15 - $day);
            
            foreach ($children as $childId) {
                // 80% đi học, 10% đi muộn, 10% nghỉ
                $rand = rand(1, 100);
                if ($rand <= 80) {
                    $status = 'present';
                } elseif ($rand <= 90) {
                    $status = 'late';
                } else {
                    $status = 'absent';
                }
                
                DB::table('attendants')->insert([
                    'date' => $date->format('Y-m-d'),
                    'child_id' => $childId,
                    'status' => $status,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        
        $this->command->info("Đã tạo điểm danh cho 100 học sinh trong 15 ngày");
    }
    
    /**
     * Tạo đánh giá tuần cho học sinh
     */
    private function createWeekEvaluates(array $children): void
    {
        $comments = [
            'Học sinh ngoan ngoãn, chăm chỉ học tập',
            'Có tiến bộ trong học tập',
            'Còn nhút nhát trong giờ học',
            'Tích cực tham gia các hoạt động',
            'Hòa đồng với bạn bè',
            'Cần cố gắng hơn trong học tập',
            'Rất sáng dạ, tiếp thu bài nhanh',
            'Còn nghịch ngợm trong giờ học'
        ];
        
        for ($week = 1; $week <= 4; $week++) {
            $date = Carbon::now()->subWeeks(5 - $week);
            
            foreach ($children as $childId) {
                if (rand(1, 10) <= 8) { // 80% có đánh giá
                    $point = rand(5, 10);
                    
                    DB::table('weekevaluates')->insert([
                        'comment' => $comments[array_rand($comments)],
                        'point' => $point,
                        'date' => $date->format('Y-m-d'),
                        'child_id' => $childId,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
        
        $this->command->info("Đã tạo đánh giá tuần cho học sinh");
    }
    
    /**
     * Tạo học phí cho học sinh
     */
    private function createTuitions(array $children): void
    {
        $semesters = ['Học kỳ 1 - 2024', 'Học kỳ 2 - 2024'];
        
        foreach ($children as $childId) {
            foreach ($semesters as $semester) {
                $status = rand(0, 1); // 0: chưa thanh toán, 1: đã thanh toán
                
                $tuitionId = DB::table('tuitions')->insertGetId([
                    'semester' => $semester,
                    'child_id' => $childId,
                    'status' => $status,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                
                // Thêm chi tiết học phí (sẽ được xử lý trong hàm riêng)
                $this->createTuitionInfoForTuition($tuitionId);
            }
        }
        
        $this->command->info("Đã tạo học phí cho 100 học sinh (2 học kỳ mỗi học sinh)");
    }
    
    /**
     * Tạo chi tiết học phí
     */
    private function createTuitionInfos(): void
    {
        // Function được gọi trong createTuitions
    }
    
    /**
     * Tạo chi tiết học phí cho 1 tuition
     */
    private function createTuitionInfoForTuition(int $tuitionId): void
    {
        $feeNames = ['Học phí', 'Tiền ăn', 'Tiền học năng khiếu', 'Bảo hiểm', 'Đồng phục', 'Sách vở'];
        $feePrices = [1500000, 500000, 300000, 200000, 500000, 300000];
        
        // Random 3-5 khoản phí
        $numFees = rand(3, 5);
        $selectedIndices = array_rand(range(1, count($feeNames)), $numFees);
        if (!is_array($selectedIndices)) $selectedIndices = [$selectedIndices];
        
        foreach ($selectedIndices as $index) {
            DB::table('tuition_infos')->insert([
                'name' => $feeNames[$index],
                'price' => $feePrices[$index],
                'tuition_id' => $tuitionId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
    
    /**
     * Tạo cơ sở vật chất cho lớp học
     */
    private function createClassroomFacilities(array $classrooms, array $dentailFacilities): void
    {
        $facilityNames = ['Bàn ghế', 'Bảng trắng', 'Đồ chơi', 'Tủ đựng đồ', 'Thảm trải sàn', 'Quạt trần', 'Đèn chiếu sáng', 'Rèm cửa'];
        
        foreach ($classrooms as $classroomId) {
            // Mỗi lớp có 5-8 loại cơ sở vật chất
            $numFacilities = rand(5, 8);
            for ($i = 0; $i < $numFacilities; $i++) {
                $dentailId = $dentailFacilities[array_rand($dentailFacilities)];
                
                DB::table('facilities')->insert([
                    'name' => $facilityNames[array_rand($facilityNames)],
                    'classroom_id' => $classroomId,
                    'quantity' => rand(2, 10),
                    'dentail_id' => $dentailId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        
        $this->command->info("Đã tạo cơ sở vật chất cho 10 lớp học");
    }
    
    /**
     * Tạo môn học
     */
    private function createSubjects(): array
    {
        $subjects = [];
        $subjectNames = ['Toán', 'Tiếng Việt', 'Tiếng Anh', 'Âm nhạc', 'Mỹ thuật', 'Thể dục', 'Kỹ năng sống', 'Khoa học'];
        
        foreach ($subjectNames as $name) {
            $subjectId = DB::table('subjects')->insertGetId([
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $subjects[] = $subjectId;
        }
        
        $this->command->info("Đã tạo 8 môn học");
        return $subjects;
    }
    
    /**
     * Tạo thời khóa biểu cho các lớp
     */
    private function createSchedules(array $classrooms): array
    {
        $schedules = [];
        $dates = [];
        
        // Tạo lịch từ thứ 2 đến thứ 6 trong 2 tuần
        $startDate = Carbon::now()->startOfWeek();
        for ($i = 0; $i < 10; $i++) {
            $date = $startDate->copy()->addDays($i);
            if ($date->dayOfWeek != 0 && $date->dayOfWeek != 6) { // Không có thứ 7, CN
                $dates[] = $date->format('Y-m-d');
            }
        }
        
        foreach ($classrooms as $classroomId) {
            foreach ($dates as $date) {
                $scheduleId = DB::table('schedules')->insertGetId([
                    'date' => $date,
                    'classroom_id' => $classroomId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $schedules[] = $scheduleId;
            }
        }
        
        $this->command->info("Đã tạo thời khóa biểu cho 10 lớp");
        return $schedules;
    }
    
    /**
     * Tạo chi tiết thời khóa biểu
     */
    private function createScheduleInfos(array $schedules, array $subjects): void
    {
        $slots = [1, 2, 3, 4, 5, 6, 7, 8]; // 8 tiết mỗi ngày
        
        foreach ($schedules as $scheduleId) {
            // Mỗi ngày học 4-6 tiết
            $numSlots = rand(4, 6);
            $selectedSlots = array_rand(array_flip($slots), $numSlots);
            if (!is_array($selectedSlots)) $selectedSlots = [$selectedSlots];
            
            foreach ($selectedSlots as $slot) {
                $subjectId = $subjects[array_rand($subjects)];
                
                DB::table('schedule_infos')->insert([
                    'name' => 'Tiết ' . $slot,
                    'schedule_id' => $scheduleId,
                    'subject_id' => $subjectId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        
        $this->command->info("Đã tạo chi tiết thời khóa biểu");
    }
    
    /**
     * Tạo camera
     */
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
        
        $this->command->info("Đã tạo 5 camera");
    }
    
    /**
     * Tạo phản hồi
     */
    private function createFeedbacks(array $parents): void
    {
        $adminId = 1;
        $contents = [
            'Trường học rất tốt, giáo viên nhiệt tình',
            'Cơ sở vật chất khang trang, sạch sẽ',
            'Chương trình học phù hợp với trẻ',
            'Con tôi rất thích đi học',
            'Mong muốn nhà trường tổ chức nhiều hoạt động ngoại khóa hơn',
            'Chất lượng bữa ăn cần cải thiện',
            'Giáo viên quan tâm đến từng học sinh',
            'Rất hài lòng về dịch vụ của trường',
            'Có thể thêm các lớp năng khiếu',
            'Ban giám hiệu thân thiện, nhiệt tình'
        ];
        
        foreach ($parents as $index => $parentId) {
            if ($index % 5 == 0) { // 20% phụ huynh gửi phản hồi
                DB::table('feedbacks')->insert([
                    'name' => DB::table('users')->where('id', $parentId)->value('name'),
                    'email' => DB::table('users')->where('id', $parentId)->value('email'),
                    'content' => $contents[array_rand($contents)],
                    'user_id' => $adminId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        
        $this->command->info("Đã tạo phản hồi từ phụ huynh");
    }
    
    /**
     * Tạo tin nhắn giữa giáo viên và phụ huynh
     */
    private function createMessages(array $teachers, array $parents): void
    {
        $messageTemplates = [
            'Chào phụ huynh, hôm nay bé học rất tốt ạ!',
            'Con có tiến bộ trong tuần này, cô khen nhiều lắm ạ.',
            'Phụ huynh có thể đón con sớm hơn 30 phút hôm nay không ạ?',
            'Bé nhà mình hôm qua có bị ốm không ạ? Hôm nay con hơi mệt.',
            'Tuần tới nhà trường tổ chức họp phụ huynh, mong phụ huynh sắp xếp thời gian ạ.',
            'Cảm ơn phụ huynh đã quan tâm đến việc học của con.',
            'Bé nhà mình được chọn tham gia văn nghệ cuối năm ạ.',
            'Phụ huynh có thể đóng học phí đúng hạn giúp cô nhé.',
            'Hôm nay con có bài tập về nhà, nhờ phụ huynh kèm con thêm ạ.',
            'Chúc phụ huynh và gia đình cuối tuần vui vẻ!'
        ];
        
        // Tạo 100-200 tin nhắn ngẫu nhiên
        $numMessages = rand(100, 200);
        for ($i = 0; $i < $numMessages; $i++) {
            $sender = $teachers[array_rand($teachers)];
            $receiver = $parents[array_rand($parents)];
            
            DB::table('messages')->insert([
                'sender_id' => $sender,
                'receiver_id' => $receiver,
                'message' => $messageTemplates[array_rand($messageTemplates)] . ' (tin nhắn ' . ($i + 1) . ')',
                'created_at' => Carbon::now()->subHours(rand(1, 720)),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        $this->command->info("Đã tạo " . $numMessages . " tin nhắn giữa giáo viên và phụ huynh");
    }
}