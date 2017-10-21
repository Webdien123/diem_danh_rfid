<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuKien;

class EventController extends Controller
{
    // Lưu số dòng phân trang cho trang sinh viên.
    public static $so_dong = 5;
    
    // Hiện trang sự kiện.
    public function GetPageSK()
    {
        if (\Session::has('uname')) {
            $sukiens = SuKien::GetSuKien();
            return view('sub_views.event', [
                'sukiens' => $sukiens
            ]);
        }
        else{
            return view('login');
        }
    }

    // Chọn sự kiện để điểm danh
    public function ChonSuKien($mask)
    {
        if (\Session::has('uname')) {
            // Lấy thông tin sự kiện từ mã sự kiện.
            $sukien = SuKien::GetSK($mask);

            // TẠO Session chứa sự kiện đang điểm danh.
            \Session::put('sukien_diemdanh', $sukien);

            // Tạo trạng thái sự kiện.
            $trangthai = self::KiemTraTrangThai($sukien);
            \Session::put('trangthai_sukien', $trangthai);

            // Tính lại thời gian còn lại của sự kiện.
            $thoigian = EventController::ThoiGianConLai($sukien);

            return view('home', ['thoigian' => $thoigian]);
        }
        else{
            return view('login');
        }
    }

    public static function CapNhatSuKienDiemDanh()
    {
        if (\Session::has('uname')) {
            if (\Session::get('sukien_diemdanh') == null){
                $sukiens = SuKien::GetSuKienSSang();
                return view('chon_sukien', ['sukiens' => $sukiens]);
            }
            // Lấy giá trị sự kiện đang cần điểm danh.
            $sukien = \Session::get('sukien_diemdanh');

            // Tính lại trạng thái sự kiện.
            $trangthai = self::KiemTraTrangThai($sukien);
            \Session::put('trangthai_sukien', $trangthai);

            // Tính lại thời gian còn lại của sự kiện.
            $thoigian = EventController::ThoiGianConLai($sukien);

            return view('home', ['thoigian' => $thoigian]);
        }
        else{
            return view('login');
        }
    }

    // Tính trạng thái của sự kiện so với thời điểm hiện tại.
    // 1: nếu chưa đến giờ điểm danh.
    // 2: nếu đang điểm danh vào.
    // 3: nếu đang điểm danh ra.
    // 4: kết thúc điểm danh.
    public static function KiemTraTrangThai($sukien)
    {
        if (\Session::has('uname')) {
            // Chọn time zone.
            date_default_timezone_set("Asia/Ho_Chi_Minh");

            // Lấy giá trị thời gian hiện tại.
            $time = date("H:i:s");

            // Lấy thời điểm điểm danh vào.
            $time2 = date($sukien[0]->DDVAO);

            // Tính khoản thời gian còn lại đến thời gian điểm danh vào.
            $kq = (strtotime($time2) - strtotime($time));

            if ($kq > 0) {
                return 1;
            } else {
                // Lấy thời điểm điểm danh ra.
                $time2 = date($sukien[0]->DDRA);

                // Tính khoản thời gian còn lại đến thời gian điểm danh ra.
                $kq = (strtotime($time2) - strtotime($time));

                if ($kq > 0) {
                    return 2;
                } else {
                    $endtime = date('H:i:s',strtotime($sukien[0]->DDRA . ' +1 minutes'));
                    $kq = (strtotime($endtime) - strtotime($time));
                    if ($kq > 0) {
                        return 3;
                    } else {
                        return 4;
                    }
                }
            }
        }
        else{
            return view('login');
        }
    }

    // Tính thời gian còn lại của sự kiện tùy vào trạng thái đang có.
    public static function ThoiGianConLai($sukien)
    {
        if (\Session::has('uname')) {
            // Chọn time zone.
            date_default_timezone_set("Asia/Ho_Chi_Minh");

            // Lấy ngày hiện tại.
            $today = date("Y-m-d");

            // Lấy giá trị thời gian hiện tại.
            $time = date("H:i:s");

            // Lấy thời điểm điểm danh vào.
            $time2 = date($sukien[0]->DDVAO);

            // Tính khoản thời gian còn lại đến thời gian điểm danh vào.
            $time2 = (strtotime($time2) - strtotime($time));

            

            if ($time2 > 0) {
                return $today." ".$sukien[0]->DDVAO;
            } else {
                // Lấy thời điểm điểm danh ra.
                $time2 = date($sukien[0]->DDRA);

                // Tính khoản thời gian còn lại đến thời gian điểm danh ra.
                $time2 = (strtotime($time2) - strtotime($time));

                if ($time2 > 0) {
                    return $today." ".$sukien[0]->DDRA;
                } else {
                    return $today." ".date('H:i:s',strtotime($sukien[0]->DDRA . ' +1 minutes'));
                }
            }
        }
        else{
            return view('login');
        }
    }

    // Thêm thông tin sự kiện mới vào hệ thống.
    public function ThemSuKien(Request $sukien)
    {
        if (\Session::has('uname')) {
            // Thêm sự kiện vào hệ thống
            $ketqua =  SuKien::AddSK($sukien);
            
            // Nếu xử lý thành công thì về trang sự kiện
            // ngược lại báo lỗi do xử lý.
            if ($ketqua)
                return redirect()->route('event');
            else
                return redirect()->route('Error',
                ['mes' => 'Thêm sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
        }
        else{
            return view('login');
        }
    }

    // Tìm thông tin sự kiện cần update và hiển thị lên để chỉnh sửa.
    public function CapNhatSuKien($mssk)
    {
        if (\Session::has('uname')) {
            $sukien = SuKien::GetSK($mssk);
            if ($sukien != null) {
                return view('form_views.thongtin_sukien', [
                    'sukien' => $sukien
                ]);
            } else {
                return redirect()->route('Error',
                ['mes' => 'Lấy thông tin sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
            }
        }
        else{
            return view('login');
        }
    }

    // Xử lý cập nhật thông tin sự kiện.
    public function XuLyCapNhat(Request $sukien)
    {
        if (\Session::has('uname')) {
            $ketqua = SuKien::UpdateSK($sukien);
            $ketqua = ($ketqua) ? 0 : 1 ;
            \Session::put('ketqua_up_sk', $ketqua);
            return redirect('/event_info/' . $sukien->mask);
        }
        else{
            return view('login');
        }
    }

    // Xóa thông tin sự kiện.
    public function XoaSuKien($mssk)
    {
        if (\Session::has('uname')) {
            $ketqua_sk = SuKien::DeleteSV($mssk);

            // Tính kết quả tổng hợp
            $ketqua = ($ketqua_sk) ? true : false;

            if ($ketqua)
                return redirect()->route('event');
            else
                return redirect()->route('Error', 
                ['mes' => 'Xóa sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
        }
        else{
            return view('login');
        }
    }

    // Tìm sự kiện.
    public function TimSuKien(Request $tukhoa)
    {
        if (\Session::has('uname')) {
            try{
                // Lấy từ khóa cần tìm ra khỏi request.
                $TK = $tukhoa->tukhoa;
            
                // Tìm kiếm sự kiện đồng thời phân trang kết quả.
                $sukiens = \DB::table('sukien')
                    ->where('MASK', 'like', "%$TK%")
                    ->orWhere('TENSK', 'like', "%$TK%")
                    ->orWhere('NGTHUCHIEN', 'like', "%$TK%")
                    ->orWhere('DIADIEM', 'like', "%$TK%")
                    ->orWhere('DDVAO', 'like', "%$TK%")
                    ->orWhere('DDRA', 'like', "%$TK%")
                    ->paginate(self::$so_dong)->appends(['tukhoa' => $TK]);
                return view('sub_views.timsukien', ['sukiens' => $sukiens, 'tukhoa' => $TK]);
            }
            catch (\Exception $e) {
                return redirect()->route('Error', 
                ['mes' => 'Tìm sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
            }
        }
        else{
            return view('login');
        }
    }
}
