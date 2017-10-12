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

    // Hiện trang sinh viên.
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

    // Thêm thông tin sinh viên với vào hệ thống.
    public function ThemSinhVien(Request $sinhvien)
    {
        if (\Session::has('uname')) {
            // Tìm xem có sinh viên nào đã có mã số này chưa.
            $maso = SinhVien::GetSV($sinhvien->mssv);

            // Nếu mã số chưa có.
            if ($maso == null) {

                // Thêm sinh viên vào hệ thống
                $ketqua =  SinhVien::AddSV($sinhvien);

                // Nếu xử lý thành công thì về trang sinh viên
                // ngược lại báo lỗi do xử lý.
                if ($ketqua)
                    return redirect()->route('student');
                else
                    return redirect()->route('Error',
                    ['mes' => 'Thêm sinh viên thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
            }
            // Nếu mã số hoặc email đã bị trùng.
            else {
                // Báo lỗi trùng cả email và mã số.
                if ($maso != null) {
                    return redirect()->route('Error',
                    ['mes' => 'Thêm sinh viên thất bại', 'reason' => 'Mã số sinh viên đã tồn tại']);
                }
            }
        }
        else{
            return view('login');
        }
    }

    // Tìm thông tin sinhviên cần update và hiển thị lên để chỉnh sửa.
    public function CapNhatSinhVien($mssv)
    {
        if (\Session::has('uname')) {
            $sv = SinhVien::GetSV($mssv);
            if ($sv != null) {
                return view('form_views.thongtin_sv', [
                    'sv' => $sv, 
                    'khoas' => self::$khoas,
                    'lops' => self::$lops,
                    'khoahocs' => self::$khoahocs
                ]);
            } else {
                return redirect()->route('Error',
                ['mes' => 'Lấy thông tin sinhviên thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
            }
        }
        else{
            return view('login');
        }
    }
}
