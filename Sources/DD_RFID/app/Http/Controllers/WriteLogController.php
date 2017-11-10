<?php
// Lớp định nghĩa các hàm xử lý việc ghi log.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class WriteLogController extends Controller
{
    // Biến lưu trữ ngày hiện tại, dùng kèm theo tên file log.
    public static $date;

    // Khởi tạo thời gian cho log file.
    public function __construct(Type $var = null) {

        // Chọn time zone.
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        // Khởi tạo ngày hiện tại.
        $date = date("d-m-Y");
    }

    // Ghi log thông tin
    public static function Write_InFo($content, $log_type = "Admin")
    {        
        $date = date("d-m-Y");

        Log::useFiles(base_path() . '/logs/'.$log_type.'_'. $date .'.log', 'info');
        
        Log::info($content.PHP_EOL);
    }

    // Ghi log cảnh báo
    public static function Write_Alert($content, $log_type = "Admin")
    {        
        $date = date("d-m-Y");

        Log::useFiles(base_path() . '/logs/'.$log_type.'_'. $date .'.log', 'alert');
        
        Log::alert($content.PHP_EOL);        
    }

    // Ghi log Debug
    public static function Write_Debug($content, $log_type = "Admin")
    {        
        $date = date("d-m-Y");

        Log::useFiles(base_path() . '/logs/'.$log_type.'_'. $date .'.log', 'debug');
        
        Log::debug($content.PHP_EOL);        
    }

    // Ghi log báo lỗi
    public static function Write_Error($content, $log_type = "Admin")
    {        
        $date = date("d-m-Y");

        Log::useFiles(base_path() . '/logs/'.$log_type.'_'. $date .'.log', 'error');
        
        Log::error($content.PHP_EOL);
    }
}
