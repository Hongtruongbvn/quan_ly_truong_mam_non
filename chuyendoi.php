<?php

// File: chuyendoi.php
// Mục đích: Chuyển toàn bộ file .blade.php và .css thành file txt/md để Google AI Studio đọc
// Đường dẫn CSS: C:\Users\hongt\Downloads\Project2\public\css

// Cấu hình
$projectRoot = __DIR__; // Thư mục gốc dự án (nơi đặt file này)
$bladeSourceDir = $projectRoot . '/resources/views';   // Thư mục chứa các file blade
$cssSourceDir = $projectRoot . '/public/css';          // Thư mục chứa file CSS
$outputDir = $projectRoot . '/converted_for_ai';       // Thư mục đầu ra

// Kiểm tra và tạo thư mục đầu ra
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
}

// Hàm đệ quy quét và xử lý file blade
function convertBladeFiles($dir, $outputDir, $baseDir) {
    $items = scandir($dir);
    $count = 0;

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;

        $path = $dir . DIRECTORY_SEPARATOR . $item;
        $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $path);

        if (is_dir($path)) {
            // Tạo thư mục tương ứng trong output
            $newOutputDir = $outputDir . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $relativePath;
            if (!is_dir($newOutputDir)) {
                mkdir($newOutputDir, 0777, true);
            }
            $count += convertBladeFiles($path, $outputDir, $baseDir);
        } 
        elseif (is_file($path) && preg_match('/\.blade\.php$/', $item)) {
            // Xử lý file .blade.php
            $content = file_get_contents($path);
            
            // Thêm header thông tin file
            $header = "================================================================================\n";
            $header .= "FILE: " . $relativePath . "\n";
            $header .= "TYPE: Laravel Blade Template\n";
            $header .= "================================================================================\n\n";
            
            $fullContent = $header . $content;
            
            // Chuyển tên file (bỏ .blade.php, thay bằng .txt)
            $outputPath = $outputDir . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $relativePath;
            $outputPath = preg_replace('/\.blade\.php$/', '.txt', $outputPath);
            
            // Đảm bảo thư mục tồn tại
            $outputDirName = dirname($outputPath);
            if (!is_dir($outputDirName)) {
                mkdir($outputDirName, 0777, true);
            }
            
            // Ghi nội dung vào file mới
            file_put_contents($outputPath, $fullContent);
            echo "✅ [BLADE] Đã chuyển: $relativePath\n";
            $count++;
        }
    }
    
    return $count;
}

// Hàm xử lý file CSS
function convertCssFiles($cssDir, $outputDir) {
    if (!is_dir($cssDir)) {
        echo "⚠️ Thư mục CSS không tồn tại: $cssDir\n";
        return 0;
    }
    
    $count = 0;
    $items = scandir($cssDir);
    
    // Tạo thư mục css trong output
    $cssOutputDir = $outputDir . '/css';
    if (!is_dir($cssOutputDir)) {
        mkdir($cssOutputDir, 0777, true);
    }
    
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $path = $cssDir . DIRECTORY_SEPARATOR . $item;
        
        if (is_dir($path)) {
            // Xử lý thư mục con trong css
            $subCount = convertCssFilesRecursive($path, $cssOutputDir, $item);
            $count += $subCount;
        }
        elseif (is_file($path) && preg_match('/\.css$/', $item)) {
            // Xử lý file .css
            $content = file_get_contents($path);
            
            // Thêm header thông tin file CSS
            $header = "================================================================================\n";
            $header .= "FILE: css/" . $item . "\n";
            $header .= "TYPE: CSS Stylesheet\n";
            $header .= "PATH: " . $path . "\n";
            $header .= "================================================================================\n\n";
            
            $fullContent = $header . $content;
            
            // Đường dẫn output
            $outputPath = $cssOutputDir . '/' . preg_replace('/\.css$/', '.txt', $item);
            
            file_put_contents($outputPath, $fullContent);
            echo "✅ [CSS] Đã chuyển: css/$item\n";
            $count++;
        }
    }
    
    return $count;
}

// Hàm đệ quy xử lý thư mục con trong CSS
function convertCssFilesRecursive($dir, $baseOutputDir, $subPath = '') {
    $count = 0;
    $items = scandir($dir);
    
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        $currentSubPath = $subPath ? $subPath . '/' . $item : $item;
        
        if (is_dir($path)) {
            // Tạo thư mục con trong output
            $newOutputDir = $baseOutputDir . '/' . $currentSubPath;
            if (!is_dir($newOutputDir)) {
                mkdir($newOutputDir, 0777, true);
            }
            $count += convertCssFilesRecursive($path, $baseOutputDir, $currentSubPath);
        }
        elseif (is_file($path) && preg_match('/\.css$/', $item)) {
            $content = file_get_contents($path);
            
            $header = "================================================================================\n";
            $header .= "FILE: css/" . $currentSubPath . "\n";
            $header .= "TYPE: CSS Stylesheet\n";
            $header .= "PATH: " . $path . "\n";
            $header .= "================================================================================\n\n";
            
            $fullContent = $header . $content;
            
            $outputPath = $baseOutputDir . '/' . preg_replace('/\.css$/', '.txt', $currentSubPath);
            
            // Đảm bảo thư mục tồn tại
            $outputDirName = dirname($outputPath);
            if (!is_dir($outputDirName)) {
                mkdir($outputDirName, 0777, true);
            }
            
            file_put_contents($outputPath, $fullContent);
            echo "✅ [CSS] Đã chuyển: css/$currentSubPath\n";
            $count++;
        }
    }
    
    return $count;
}

// Hàm tạo file tổng hợp
function createCombinedFile($outputDir) {
    $combinedContent = "";
    $combinedFilePath = $outputDir . '/ALL_CONTENT_COMBINED.txt';
    
    // Duyệt tất cả file .txt đã chuyển đổi
    $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($outputDir));
    
    foreach ($allFiles as $file) {
        if ($file->isFile() && $file->getExtension() === 'txt' && $file->getFilename() !== 'ALL_CONTENT_COMBINED.txt') {
            $relativePath = str_replace($outputDir . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $combinedContent .= file_get_contents($file->getPathname()) . "\n\n\n";
        }
    }
    
    file_put_contents($combinedFilePath, $combinedContent);
    echo "📄 Đã tạo file tổng hợp: " . $combinedFilePath . "\n";
    
    return $combinedFilePath;
}

// Hàm tạo file Markdown cho dễ đọc
function createMarkdownFile($outputDir) {
    $markdownContent = "# Tổng hợp mã nguồn dự án\n\n";
    $markdownContent .= "## Thông tin\n";
    $markdownContent .= "- Ngày tạo: " . date('Y-m-d H:i:s') . "\n";
    $markdownContent .= "- Số lượng file: (xem bên dưới)\n\n";
    $markdownContent .= "## Mục lục\n\n";
    
    $filesList = [];
    $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($outputDir));
    
    foreach ($allFiles as $file) {
        if ($file->isFile() && $file->getExtension() === 'txt' && $file->getFilename() !== 'ALL_CONTENT_COMBINED.txt') {
            $relativePath = str_replace($outputDir . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $filesList[] = $relativePath;
            $markdownContent .= "- [" . $relativePath . "](#" . str_replace(['/', '.', ' '], ['', '', ''], $relativePath) . ")\n";
        }
    }
    
    $markdownContent .= "\n---\n\n";
    
    foreach ($allFiles as $file) {
        if ($file->isFile() && $file->getExtension() === 'txt' && $file->getFilename() !== 'ALL_CONTENT_COMBINED.txt') {
            $relativePath = str_replace($outputDir . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $markdownContent .= "## " . $relativePath . "\n\n";
            $markdownContent .= "```\n";
            $markdownContent .= file_get_contents($file->getPathname());
            $markdownContent .= "\n```\n\n---\n\n";
        }
    }
    
    $mdFilePath = $outputDir . '/ALL_CONTENT_SUMMARY.md';
    file_put_contents($mdFilePath, $markdownContent);
    echo "📝 Đã tạo file Markdown: " . $mdFilePath . "\n";
    
    return $mdFilePath;
}

// Bắt đầu chuyển đổi
echo "========================================\n";
echo "🔄 BẮT ĐẦU CHUYỂN ĐỔI FILE CHO GOOGLE AI STUDIO\n";
echo "========================================\n\n";

// 1. Chuyển đổi Blade files
echo "📁 Đang xử lý thư mục Blade: $bladeSourceDir\n";
$bladeCount = 0;
if (is_dir($bladeSourceDir)) {
    $bladeCount = convertBladeFiles($bladeSourceDir, $outputDir, $bladeSourceDir);
    echo "\n✅ Hoàn thành chuyển đổi $bladeCount file Blade\n\n";
} else {
    echo "❌ Thư mục Blade không tồn tại: $bladeSourceDir\n\n";
}

// 2. Chuyển đổi CSS files
echo "📁 Đang xử lý thư mục CSS: $cssSourceDir\n";
$cssCount = convertCssFiles($cssSourceDir, $outputDir);
echo "\n✅ Hoàn thành chuyển đổi $cssCount file CSS\n\n";

// 3. Tạo file tổng hợp
echo "📦 Đang tạo file tổng hợp...\n";
$combinedFile = createCombinedFile($outputDir);
$markdownFile = createMarkdownFile($outputDir);

// 4. Tạo file thông tin
$infoFile = $outputDir . '/README.txt';
$infoContent = "=== THÔNG TIN DỰ ÁN ===\n\n";
$infoContent .= "Dự án: Laravel Project\n";
$infoContent .= "Ngày chuyển đổi: " . date('Y-m-d H:i:s') . "\n";
$infoContent .= "Số lượng file Blade: $bladeCount\n";
$infoContent .= "Số lượng file CSS: $cssCount\n\n";
$infoContent .= "=== CẤU TRÚC THƯ MỤC ===\n\n";
$infoContent .= "- views/: Chứa các file Blade templates đã chuyển đổi\n";
$infoContent .= "- css/: Chứa các file CSS đã chuyển đổi\n";
$infoContent .= "- ALL_CONTENT_COMBINED.txt: Tất cả nội dung gộp vào 1 file\n";
$infoContent .= "- ALL_CONTENT_SUMMARY.md: Phiên bản Markdown dễ đọc hơn\n\n";
$infoContent .= "=== CÁCH SỬ DỤNG VỚI GOOGLE AI STUDIO ===\n\n";
$infoContent .= "1. Upload file ALL_CONTENT_COMBINED.txt lên Google AI Studio\n";
$infoContent .= "2. Hoặc nén toàn bộ thư mục converted_for_ai thành file .zip và upload\n";
$infoContent .= "3. Bạn cũng có thể copy từng phần nội dung từ file Markdown\n";

file_put_contents($infoFile, $infoContent);

echo "\n========================================\n";
echo "🎉 HOÀN THÀNH!\n";
echo "========================================\n";
echo "📁 Thư mục đầu ra: $outputDir\n";
echo "📄 File tổng hợp TXT: $combinedFile\n";
echo "📝 File Markdown: $markdownFile\n";
echo "ℹ️ File thông tin: $infoFile\n";
echo "\n📊 Thống kê:\n";
echo "   - Blade files: $bladeCount\n";
echo "   - CSS files: $cssCount\n";
echo "   - Tổng số: " . ($bladeCount + $cssCount) . " files\n";
echo "\n💡 Hướng dẫn sử dụng với Google AI Studio:\n";
echo "   1. Mở thư mục: $outputDir\n";
echo "   2. Upload file ALL_CONTENT_COMBINED.txt lên Google AI Studio\n";
echo "   3. Hoặc nén toàn bộ thư mục thành file .zip để upload\n";
echo "========================================\n";