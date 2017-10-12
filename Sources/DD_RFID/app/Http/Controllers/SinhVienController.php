<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SinhVien;
use App\Khoa_Phong;
use App\KyHieuLop;
use App\KhoaHoc;

class SinhVienController extends Controller
{
    // Lưu trữ danh sách khoa trong hệ thống.
    public static $khoas;
    
    // Lưu trữ danh sách ký hiệu lớp.
    public static $lops;

    // Lưu trữ danh sách khóa học.
    public static $khoahocs;

    public static $so_dong = 5;

    public function __construct() {
        self::$khoas = Khoa_Phong::GetKhoa();
        self::$lops = KyHieuLop::LayKyHieuLop();
        self::$khoahocs = KhoaHoc::LayKhoaHoc();
    }

    // Hiện trang sinh viene.
    public function GetPageSV()
    {
        if (\Session::has('uname')) {
            $sinhviens = SinhVien::GetSinhVien();
            return view('sub_views.student', [
                'sinhviens' => $sinhviens, 
                'khoas' => self::$khoas,
                'lops' => self::$lops,
                'khoahocs' => self::$khoahocs
            ]);
        }
        else{
            return view('login');
        }
    }

    // API trả về tên các chuyên ngành theo khoa biết trước.
    public function GetChNganh($tenkhoa)
    {
        $chnganhs = Khoa_Phong::LayChNganh($tenkhoa);
        return json_encode($chnganhs);
    }
}
