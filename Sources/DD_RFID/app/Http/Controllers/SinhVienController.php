<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SinhVien;
use App\Khoa_Phong;
use App\KyHieuLop;
use App\KhoaHoc;
use App\DangKyTheSV;
use App\DiemDanhSV;
use App\ThongKeDiemDanh;

class SinhVienController extends Controller
{
    // Lưu trữ danh sách khoa trong hệ thống.
    public static $khoas;
    
    // Lưu trữ danh sách ký hiệu lớp.
    public static $lops;

    // Lưu trữ danh sách khóa học.
    public static $khoahocs;

    // Lưu số dòng phân trang cho trang sinh viên.
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
            $name = \Session::get('uname');
            WriteLogController::Write_InFo($name." vào trang sinh viên");

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

    // Thêm thông tin sinh viên mới vào hệ thống.
    public function ThemSinhVien(Request $sinhvien)
    {
        if (\Session::has('uname')) {
            // Tìm xem có sinh viên nào đã có mã số này chưa.
            $maso = SinhVien::GetSV($sinhvien->mssv);
            $name = \Session::get('uname');
            // Nếu mã số chưa có.
            if ($maso == null) {

                // Thêm sinh viên vào hệ thống
                $ketqua =  SinhVien::AddSV($sinhvien);

                // Nếu xử lý thành công thì về trang sinh viên
                // ngược lại báo lỗi do xử lý.
                if ($ketqua){
                    WriteLogController::Write_Debug($name." thêm sinh viên ".$sinhvien->mssv);
                    return redirect()->route('student');
                }
                else{
                    return redirect()->route('Error',
                    ['mes' => 'Thêm sinh viên thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
                }
            }
            // Nếu mã số hoặc email đã bị trùng.
            else {
                // Báo lỗi trùng cả email và mã số.
                if ($maso != null) {
                    WriteLogController::Write_Debug($name." thêm sinh viên thất bại. Trùng mã số sinh viên đã có");
                    return redirect()->route('Error',
                    ['mes' => 'Thêm sinh viên thất bại', 'reason' => 'Mã số sinh viên đã tồn tại']);
                }
            }
        }
        else{
            return view('login');
        }
    }

    // Tìm thông tin sinh viên cần update và hiển thị lên để chỉnh sửa.
    public function CapNhatSinhVien($mssv)
    {
        if (\Session::has('uname')) {
            $sv = SinhVien::GetSV($mssv);
            $name = \Session::get('uname');
            if ($sv != null) {
                WriteLogController::Write_Debug($name." xem thông tin sinh viên ".$mssv);

                return view('form_views.thongtin_sv', [
                    'sv' => $sv, 
                    'khoas' => self::$khoas,
                    'lops' => self::$lops,
                    'khoahocs' => self::$khoahocs
                ]);
            } else {
                WriteLogController::Write_Debug($name." xem thông tin sinh viên thất bại. Có lỗi khi xử lý");
                return redirect()->route('Error',
                ['mes' => 'Lấy thông tin sinh viên thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
            }
        }
        else{
            return view('login');
        }
    }

    // Xử lý cập nhật thông tin sinh viên.
    public function XuLyCapNhat(Request $sinhvien)
    {
        if (\Session::has('uname')) {
            $ketqua = SinhVien::UpdateSV($sinhvien);
            $ketqua = ($ketqua) ? 0 : 1 ;
            $name = \Session::get('uname');
            if ($ketqua == 0) {
                WriteLogController::Write_Debug($name." cập nhật sinh viên ".$sinhvien->mssv);
            } else {
                WriteLogController::Write_Debug($name." cập nhật sinh viên thất bại. Có lỗi khi xử lý");
            }

            \Session::put('ketqua_up_sv', $ketqua);
            return redirect('/student_info/' . $sinhvien->mssv);       
        }
        else{
            return view('login');
        }
    }

    // Xóa thông tin sinh viên.
    public function XoaSinhVien($mssv)
    {
        if (\Session::has('uname')) {
            $ketqua_the = DangKyTheSV::DeleteThe($mssv);
            $ketqua_dangky = DiemDanhSV::DeleteDangky_SV($mssv);
            $ketqua_sv = SinhVien::DeleteSV($mssv);
            
            $name = \Session::get('uname');
            
            if ($ketqua_the == true) {
                WriteLogController::Write_Debug($name." xóa thẻ sinh viên ".$mssv." thành công", "Admin_Debug");
            } else {
                WriteLogController::Write_Debug($name." xóa thẻ sinh viên ".$mssv." thất bại", "Admin_Debug");
            }

            if ($ketqua_dangky == true) {
                WriteLogController::Write_Debug($name." xóa đăng ký sự kiện sinh viên ".$mssv." thành công", "Admin_Debug");
            } else {
                WriteLogController::Write_Debug($name." xóa đăng ký sự kiện sinh viên ".$mssv." thất bại", "Admin_Debug");
            }

            if ($ketqua_sv == true) {
                WriteLogController::Write_Debug($name." xóa thông tin sinh viên ".$mssv." thành công", "Admin_Debug");
            } else {
                WriteLogController::Write_Debug($name." xóa thông tin sinh viên ".$mssv." thất bại", "Admin_Debug");
            }

            // Tính kết quả tổng hợp
            $ketqua = ($ketqua_sv && $ketqua_the && $ketqua_dangky) ? true : false;

            if ($ketqua){
                WriteLogController::Write_Debug($name." xóa sinh viên ".$mssv);
                return redirect()->route('student');
            }
            else{
                return redirect()->route('Error', 
                ['mes' => 'Xóa sinh viên thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
            }
        }
        else{
            return view('login');
        }

    }

    // Tìm sinh viên.
    public function TimSinhVien(Request $tukhoa)
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');
            try{
                // Lấy từ khóa cần tìm ra khỏi request.
                $TK = $tukhoa->tukhoa;
            
                // Tìm kiếm sinh viên đồng thời phân trang kết quả.
                $sinhviens = \DB::table('sinhvien')
                    ->leftJoin('dangkythesv', 'dangkythesv.mssv_the', '=', 'sinhvien.mssv')
                    ->where('MSSV', 'like', "%$TK%")
                    ->orWhere('KYHIEULOP', 'like', "%$TK%")
                    ->orWhere('TENCHNGANH', 'like', "%$TK%")
                    ->orWhere('KHOAHOC', 'like', "%$TK%")
                    ->orWhere('TENKHOA', 'like', "%$TK%")
                    ->orWhere('HOTEN', 'like', "%$TK%")
                    ->orWhere('MATHE', 'like', "%$TK%")
                    ->paginate(self::$so_dong)->appends(['tukhoa' => $TK]);

                WriteLogController::Write_Debug($name." tìm sinh viên theo từ khóa '".$TK."'");

                return view('sub_views.timsinhvien', ['sinhviens' => $sinhviens, 'tukhoa' => $TK]);
            }
            catch (\Exception $e) {
                WriteLogController::Write_Debug($name." tìm cán bộ thất bại");
                return redirect()->route('Error', 
                ['mes' => 'Tìm sinh viên thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
            }
        }
        else{
            return view('login');
        }
    }
}
