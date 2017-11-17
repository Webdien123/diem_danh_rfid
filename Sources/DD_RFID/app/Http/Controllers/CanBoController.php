<?php
// Lớp định nghĩa các hàm xử lý hoặc điều phối trên trang cán bộ.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CanBo;
use App\Khoa_Phong;
use App\DangKyTheCB;
use App\DiemDanhCB;

class CanBoController extends Controller
{
    // Lưu trữ danh sách khoa trong hệ thống.
    public static $khoas;

    // Lưu số dòng phân trang cho trang cán bộ.
    public static $so_dong = 5;

    public function __construct() {
        self::$khoas = Khoa_Phong::GetKhoa();
    }

    // Hiện trang cán bộ.
    public function GetPageCB()
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');
            WriteLogController::Write_InFo($name." vào trang cán bộ");

            $canbos = CanBo::GetCanBo();
            return view('sub_views.staff', [
                'canbos' => $canbos, 
                'khoas' => self::$khoas
            ]);            
        }
        else{
            return view('login');
        }
    }

    // API trả về tên các bộ môn theo bộ môn biết trước.
    public function GetBoMon($tenkhoa)
    {
        $bomons = Khoa_Phong::LayBoMon($tenkhoa);
        return json_encode($bomons);
    }

    // Thêm thông tin cán bộ mới vào hệ thống.
    public function ThemCanBo(Request $canbo)
    {
        if (\Session::has('uname')) {

            // Tìm xem có cán bộ nào đã có mã số này chưa.
            $maso = CanBo::GetCB($canbo->mscb);

            // Tìm xem có cán bộ nào đã có email này chưa.
            $email = CanBo::GetCB_Email($canbo->email);
            $name = \Session::get('uname');
            // Nếu mã số và email đều chưa có.
            if ($maso == null && $email == null) {

                // Thêm cán bộ vào hệ thống
                $ketqua =  CanBo::AddCB($canbo);

                // Nếu xử lý thành công thì về trang cán bộ
                // ngược lại báo lỗi do xử lý.
                if ($ketqua){
                    WriteLogController::Write_Debug($name." thêm cán bộ ".$canbo->mscb);
                    return redirect()->route('staff');
                }                    
                else{
                    return redirect()->route('Error',
                    ['mes' => 'Thêm cán bộ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
                }
            }
            // Nếu mã số hoặc email đã bị trùng.
            else {
                // Báo lỗi trùng cả email và mã số.
                if ($maso != null && $email != null) {
                    WriteLogController::Write_Debug($name." thêm cán bộ thất bại. Trùng mã số cán bộ và email đã có");
                    return redirect()->route('Error',
                    ['mes' => 'Thêm cán bộ thất bại', 'reason' => 'Mã số cán bộ và email đã tồn tại']);
                }
                else
                    // Báo lỗi trùng email
                    if ($maso == null) {
                        WriteLogController::Write_Debug($name." thêm cán bộ thất bại. Trùng email đã có");
                        return redirect()->route('Error',
                        ['mes' => 'Thêm cán bộ thất bại', 'reason' => 'Email đã tồn tại']);
                    }
                    // Báo lỗi trùng mã số.
                    else {
                        WriteLogController::Write_Debug($name." thêm cán bộ thất bại. Trùng mã số cán bộ đã có");
                        return redirect()->route('Error',
                        ['mes' => 'Thêm cán bộ thất bại', 'reason' => 'Mã số cán bộ đã tồn tại']);
                    }
            }
        }
        else{
            return view('login');
        }
    }

    // Tìm thông tin cán bộ cần update và hiển thị lên để chỉnh sửa.
    public function CapNhatCanBo($mscb)
    {
        if (\Session::has('uname')) {
            $canbo = CanBo::GetCB($mscb);
            $name = \Session::get('uname');
            if ($canbo != null) {
                WriteLogController::Write_Debug($name." xem thông tin cán bộ ".$mscb);

                return view('form_views.thongtin_canbo', [
                    'canbo' => $canbo, 
                    'khoas' => self::$khoas
                ]);
            } else {
                WriteLogController::Write_Debug($name." xem thông tin cán bộ thất bại. Có lỗi khi xử lý");
                return redirect()->route('Error',
                ['mes' => 'Lấy thông tin cán bộ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
            }
        }
        else{
            return view('login');
        }
    }

    // Xử lý cập nhật thông tin các bộ.
    public function XuLyCapNhat(Request $canbo)
    {
        if (\Session::has('uname')) {
            $ketqua = CanBo::UpdateCB($canbo);
            $ketqua = ($ketqua) ? 0 : 1 ;
            $name = \Session::get('uname');
            if ($ketqua == 0) {
                WriteLogController::Write_Debug($name." cập nhật cán bộ ".$canbo->mscb);
            } else {
                WriteLogController::Write_Debug($name." cập nhật cán bộ thất bại. Có lỗi khi xử lý");
            }
            
            \Session::put('ketqua_up_cb', $ketqua);
            return redirect('/staff_info/' . $canbo->mscb);
        }
        else{
            return view('login');
        }            
    }

    // Xóa thông tin cán bộ.
    public function XoaCanBo($mscb)
    {
        if (\Session::has('uname')) {
            $ketqua_the = DangKyTheCB::DeleteThe($mscb);
            $ketqua_dangky = DiemDanhCB::DeleteDangky_CB($mscb);
            $ketqua_cb = CanBo::DeleteCB($mscb);

            $name = \Session::get('uname');

            if ($ketqua_the == true) {
                WriteLogController::Write_Debug($name." xóa thẻ cán bộ ".$mscb." thành công", "Admin_Debug");
            } else {
                WriteLogController::Write_Debug($name." xóa thẻ cán bộ ".$mscb." thất bại", "Admin_Debug");
            }

            if ($ketqua_dangky == true) {
                WriteLogController::Write_Debug($name." xóa đăng ký sự kiện cán bộ ".$mscb." thành công", "Admin_Debug");
            } else {
                WriteLogController::Write_Debug($name." xóa đăng ký sự kiện cán bộ ".$mscb." thất bại", "Admin_Debug");
            }

            if ($ketqua_cb == true) {
                WriteLogController::Write_Debug($name." xóa thông tin cán bộ ".$mscb." thành công", "Admin_Debug");
            } else {
                WriteLogController::Write_Debug($name." xóa thông tin cán bộ ".$mscb." thất bại", "Admin_Debug");
            }

            // Tính kết quả tổng hợp
            $ketqua = ($ketqua_cb && $ketqua_the && $ketqua_dangky) ? true : false;

            if ($ketqua){
                WriteLogController::Write_Debug($name." xóa cán bộ ".$mscb);
                return redirect()->route('staff');
            }   
            else{
                return redirect()->route('Error', 
                ['mes' => 'Xóa cán bộ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
            }
        }
        else{
            return view('login');
        }
    }

    // Tìm cán bộ.
    public function TimCanBo(Request $tukhoa)
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');
            try{
                // Lấy từ khóa cần tìm ra khỏi request.
                $TK = $tukhoa->tukhoa;
            
                // Tìm kiếm cán bộ đồng thời phân trang kết quả.
                $canbos = \DB::table('canbo')
                    ->leftJoin('dangkythecb', 'dangkythecb.mscb_the', '=', 'canbo.mscb')
                    ->where('MSCB', 'like', "%$TK%")
                    ->orWhere('TENBOMON', 'like', "%$TK%")
                    ->orWhere('TENKHOA', 'like', "%$TK%")
                    ->orWhere('EMAIL', 'like', "%$TK%")
                    ->orWhere('HOTEN', 'like', "%$TK%")
                    ->orWhere('MATHE', 'like', "%$TK%")
                    ->paginate(self::$so_dong)->appends(['tukhoa' => $TK]);

                WriteLogController::Write_Debug($name." tìm cán bộ theo từ khóa '".$TK."'");
        
                return view('sub_views.timcanbo', ['canbos' => $canbos, 'tukhoa' => $TK]);
            }
            catch (\Exception $e) {
                WriteLogController::Write_Debug($name." tìm cán bộ thất bại");
                return redirect()->route('Error', 
                ['mes' => 'Tìm cán bộ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
            }
        }
        else{
            return view('login');
        }
    }
}
