<?php
// Lớp định nghĩa model tham chiếu đến bảng To_BoMon
namespace App;

use Illuminate\Database\Eloquent\Model;

class To_BoMon extends Model
{
    // Có tự động thêm 2 cột thời gian tạo và 
    // cập nhật gần nhất cho mỗi mẫu tin hay không?
    public $timestamps = false;

    // Lấy tất cả bộ môn hiện có trong hệ thống.
    public static function GetBoMon()
    {
        $bomons = \DB::select('select * from to_bomon');
        return $bomons;
    }
}