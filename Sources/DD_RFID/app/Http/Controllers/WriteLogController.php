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
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date = date("d-m-Y");

        Log::useFiles('./logs/'.$log_type.'_'. $date .'.log', 'info');
        
        Log::info($content.PHP_EOL);
    }

    // Ghi log cảnh báo
    public static function Write_Alert($content, $log_type = "Admin")
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date = date("d-m-Y");

        Log::useFiles('./logs/'.$log_type.'_'. $date .'.log', 'alert');
        
        Log::alert($content.PHP_EOL); 
    }

    // Ghi log Debug
    public static function Write_Debug($content, $log_type = "Admin")
    {        
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date = date("d-m-Y");

        Log::useFiles('./logs/'.$log_type.'_'. $date .'.log', 'debug');
        
        Log::debug($content.PHP_EOL);        
    }

    // Ghi log báo lỗi
    public static function Write_Error($content, $log_type = "Admin")
    {        
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $date = date("d-m-Y");

        Log::useFiles('./logs/'.$log_type.'_'. $date .'.log', 'error');
        
        Log::error($content.PHP_EOL);
    }

    // public function getDownload($file_path, $file_name)
    // {
    //     //PDF file is stored under project/public/download/info.pdf
    //     //$file= public_path(). "/download/info.pdf";
    //     $file = $file_path.$file_name;

    //     $headers = array(
    //             'Content-Type: application/log',
    //             );

    //     return Response::download($file, $tenfile, $headers);
    // }
}
