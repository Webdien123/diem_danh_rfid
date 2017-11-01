<?php
// Lớp định nghĩa model tham chiếu đến bảng Khoa_Phong
namespace App;

use Illuminate\Database\Eloquent\Model;

class Khoa_Phong extends Model
{
    // Lấy tất các tên khoa có trong hệ thống.
    public static function GetKhoa()
    {
        // $khoas = \DB::select('select * from khoa_phong');
        $khoas = \DB::select(\DB::raw("SELECT * FROM khoa_phong WHERE TENKHOA != '--'"));
        return $khoas;
    }

    // API lấy tất cả bộ môn thuộc khoa cho trước.
    public static function LayBoMon($tenkhoa)
    {
        $bomons = \DB::select(\DB::raw("SELECT * FROM to_bomon WHERE TENKHOA = :v1"), 
            array(
            'v1' => $tenkhoa,
        ));
        return $bomons;
    }

    // API lấy tất cả chuyên ngành thuộc khoa cho trước.
    public static function LayChNganh($tenkhoa)
    {
        $chnganhs = \DB::select(\DB::raw("SELECT * FROM chuyennganh WHERE TENKHOA = :v1"), 
            array(
            'v1' => $tenkhoa,
        ));
        return $chnganhs;
    }
}
