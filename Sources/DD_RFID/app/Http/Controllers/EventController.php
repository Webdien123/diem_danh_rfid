<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuKien;
use App\Khoa_Phong;
use App\KyHieuLop;
use App\KhoaHoc;
use App\DiemDanhCB;
use App\DiemDanhSV;
use App\ThongKeDiemDanh;

class EventController extends Controller
{
    // Lưu số dòng phân trang cho trang sinh viên.
    public static $so_dong = 10;
    
    // Hiện trang sự kiện.
    public function GetPageSK()
    {
        if (\Session::has('uname')) {
            
            $name = \Session::get('uname');
            WriteLogController::Write_InFo($name." vào trang sự kiện");
            
            $sukiens = SuKien::GetSuKien();

            return view('sub_views.event', [
                'sukiens' => $sukiens
            ]);
        }
        else{
            return view('login');
        }
    }

    // Tính tổng thời gian (phút) của toàn sự kiện tính từ thời điểm hiện tại.
    public static function TinhTongTGianSKien($sukien)
    {
        // Chọn time zone.
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        
        // Lấy ngày hiện tại.
        $today = date("Y-m-d");

        // Lấy giá trị thời gian hiện tại.
        $time = date("H:i:s");

        $time2 = date('H:i:s', strtotime($sukien[0]->DDRA . ' + ' . $sukien[0]->TGIANDDRA . ' minutes'));
    
        $khoang_cach = (strtotime($time2) - strtotime($time));

        return ceil($khoang_cach / 60);        
    }

    public function TaoCKSuKien($mask)
    {
        // Lấy thông tin sự kiện từ mã sự kiện.
        $sukien = SuKien::GetSK($mask);

        $thoigian = self::TinhTongTGianSKien($sukien);

        \Cookie::queue("sukien_diemdanh", $sukien, $thoigian);

        // Tạo trạng thái sự kiện.
        $trangthai = self::KiemTraTrangThai($sukien);

        return redirect('chonSuKien/'.$mask);
    }

    // Chọn sự kiện để điểm danh
    public function ChonSuKien($mask)
    {
        if (\Session::has('xac_thuc_sk')) {
            \Session::forget('ma_so_xac_thuc');

            WriteLogController::Write_Info("Kích hoạt điểm danh sự kiện ".$mask,"suKien[".$mask."]");

            // Lấy thông tin sự kiện từ mã sự kiện.
            $sukien = SuKien::GetSK($mask);

            // Tạo trạng thái sự kiện.
            $trangthai = self::KiemTraTrangThai($sukien);

            // Lưu trạng thái vừa tính vào session
            \Session::put("trangthai_sukien", $trangthai);

            // Chuyển trạng thái sự kiện sang trạng thái 3 nếu trạng thái điểm danh còn <=3
            if ($trangthai < 3) {
                SuKien::ChuyenTrangThai($sukien[0]->MASK, 3);
            }
            
            // Cập nhật giá trị thông báo đăng ký thẻ để ẩn thông báo đi.
            \Session::put('ketqua_dangkythe_dd', 2);

            // Tính lại thời gian còn lại của sự kiện.
            $thoigian = EventController::ThoiGianConLai($sukien);

            $khoas = Khoa_Phong::GetKhoa();
            $lops = KyHieuLop::LayKyHieuLop();
            $khoahocs = KhoaHoc::LayKhoaHoc();

            return view('home', [
                'thoigian' => $thoigian, 
                'khoas' => $khoas,
                'lops' => $lops,
                'khoahocs' => $khoahocs
            ]);
        }
        else{
            if (\Session::has('ma_so_xac_thuc')) {
                return view('xac_thuc', ['mask' => $mask]);
            } else {
                return view('xac_thuc', ['mask' => $mask]);
            }            
        }
    }

    // Cập nhật trạng thái sự kiện để hiển thị lên giao diện điểm danh và giao diện sự kiện.
    public static function CapNhatSuKienDiemDanh()
    {

        if (\Cookie::get('sukien_diemdanh') == null){

            $ma_sk = \Session::get('xac_thuc_sk');

            if ($ma_sk != null) {
                // Lấy thông tin sự kiện từ mã sự kiện.
                $sukien = SuKien::GetSK($ma_sk);
            
                // Tính lại trạng thái sự kiện.
                $trangthai = self::KiemTraTrangThai($sukien);
    
                if(\Session::get("trangthai_sukien") == 3 && $trangthai == 4){
                    \Session::put("trangthai_sukien", $trangthai);
                    WriteLogController::Write_Info("Sự kiện ".$sukien[0]->MASK." kết thúc điểm danh","suKien[".$sukien[0]->MASK."]");
                    SuKien::ChuyenTrangThai($sukien[0]->MASK, 4);
                }
            }            

            $sukiens = SuKien::GetSuKienSSang();
            return view('chon_sukien', ['sukiens' => $sukiens]);
        }

        // Lấy giá trị sự kiện đang cần điểm danh.
        $sukien = \Cookie::get('sukien_diemdanh');

        if (\Session::has('xac_thuc_sk')) {
            \Session::forget('ma_so_xac_thuc');

            // Tính lại trạng thái sự kiện.
            $trangthai = self::KiemTraTrangThai($sukien);

            if ($trangthai == \Session::get("trangthai_sukien")) {
                return redirect("/updateTrangThaiSK");
            } else {
                
                \Session::put("trangthai_sukien", $trangthai);
                
                if ($trangthai < 4) {
                    if ($trangthai == 2) {
                        WriteLogController::Write_Info("Sự kiện ".$sukien[0]->MASK." bắt đầu điểm danh vào","suKien[".$sukien[0]->MASK."]");
                    }
                    if ($trangthai == 3) {
                        WriteLogController::Write_Info("Sự kiện ".$sukien[0]->MASK." bắt đầu điểm danh ra","suKien[".$sukien[0]->MASK."]");
                    }
                    SuKien::ChuyenTrangThai($sukien[0]->MASK, 3);
                }
                else {
                    WriteLogController::Write_Info("Sự kiện ".$sukien[0]->MASK." kết thúc điểm danh","suKien[".$sukien[0]->MASK."]");
                    SuKien::ChuyenTrangThai($sukien[0]->MASK, 4);
                }

                // Tính lại thời gian còn lại của sự kiện.
                $thoigian = EventController::ThoiGianConLai($sukien);

                $khoas = Khoa_Phong::GetKhoa();
                $lops = KyHieuLop::LayKyHieuLop();
                $khoahocs = KhoaHoc::LayKhoaHoc();

                return view('home', [
                    'thoigian' => $thoigian, 
                    'khoas' => $khoas,
                    'lops' => $lops,
                    'khoahocs' => $khoahocs
                ]);
            }            
        }
        else{
            if (\Session::has('ma_so_xac_thuc')) {
                return view('xac_thuc', ['mask' => $sukien[0]->MASK]);
            } else {
                return view('xac_thuc', ['mask' => $sukien[0]->MASK]);
            }            
        }
    }

    // Tính trạng thái điểm danh của sự kiện so với thời điểm hiện tại.
    // 1: nếu chưa đến giờ điểm danh.
    // 2: nếu đang điểm danh vào.
    // 3: nếu đang điểm danh ra.
    // 4: kết thúc điểm danh.
    public static function KiemTraTrangThai($sukien)
    {
        // Chọn time zone.
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        // Lấy giá trị thời gian hiện tại.
        $time = date("H:i:s");

        // Lấy thời điểm điểm danh vào.
        $time2 = date($sukien[0]->DDVAO);

        // Tính khoản thời gian còn lại đến thời gian điểm danh vào.
        $kq = (strtotime($time2) - strtotime($time));

        // Nếu chưa đến giờ điểm danh vào. Trạng thái là 1.
        if ($kq > 0) {
            return 1;
        } else {

            // Lấy thời điểm điểm danh ra.
            $time2 = date($sukien[0]->DDRA);

            // Tính khoản thời gian còn lại đến thời gian điểm danh ra.
            $kq = (strtotime($time2) - strtotime($time));

            // Nếu chưa đến giờ điểm danh ra, đã qua giờ điểm danh vào,
            // trạng thái là 2.
            if ($kq > 0) {
                return 2;
            } 

            // Nếu đã qua giờ điểm danh ra.
            else {
                $endtime = date('H:i:s',strtotime($sukien[0]->DDRA . ' + ' . $sukien[0]->TGIANDDRA . ' minutes'));
                
                $kq = (strtotime($endtime) - strtotime($time));
                
                if ($kq > 0) {
                    return 3;
                } else {
                    return 4;
                }
            }
        }
    }

    // Tính thời gian còn lại của sự kiện tùy vào trạng thái đang có.
    public static function ThoiGianConLai($sukien)
    {
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
                return $today." ".date('H:i:s',strtotime($sukien[0]->DDRA . ' + ' . $sukien[0]->TGIANDDRA . ' minutes'));
            }
        }
    }

    // Thêm thông tin sự kiện mới vào hệ thống.
    public function ThemSuKien(Request $sukien)
    {
        if (\Session::has('uname')) {
            
            // Thêm sự kiện vào hệ thống
            $ketqua =  SuKien::AddSK($sukien);
            $name = \Session::get('uname');
            // Nếu xử lý thành công thì về trang sự kiện
            // ngược lại báo lỗi do xử lý.
            if ($ketqua){

                $id_sk = \DB::select('SELECT * FROM sukien ORDER BY MASK DESC LIMIT 1 ');
                $id_sk = $id_sk[0]->MASK;
                WriteLogController::Write_Debug($name." thêm sự kiện ".$id_sk);
                return redirect()->route('event');
            }
                
            else
                return redirect()->route('Error',
                ['mes' => 'Thêm sự kiện thất bại', 
                'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
        }
        else{
            return view('login');
        }
    }

    // Tìm thông tin sự kiện cần update và hiển thị lên để chỉnh sửa.
    public function CapNhatSuKien($mssk)
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');
            $sukien = SuKien::GetSK($mssk);
            if ($sukien != null) {
                if ($sukien[0]->MATTHAI == 4) {
                    WriteLogController::Write_Debug($name." không thể xem thông tin sự kiện ".$mssk. " vì đã hoàn thành điểm danh");
                    
                    WriteLogController::Write_InFo($name." vào trang sự kiện");
                    
                    $sukiens = SuKien::GetSuKien();
        
                    return view('sub_views.event', [
                        'sukiens' => $sukiens
                    ]);
                } else {
                    WriteLogController::Write_Debug($name." xem thông tin sự kiện ".$mssk);
                    return view('form_views.thongtin_sukien', [
                        'sukien' => $sukien
                    ]);
                }
                
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
            $name = \Session::get('uname');
            $ketqua = ($ketqua) ? 0 : 1 ;
            if ($ketqua == 0) {
                WriteLogController::Write_Debug($name." cập nhật sự kiện ".$sukien->mask);
            } else {
                WriteLogController::Write_Debug($name." cập nhật sự kiện thất bại. Có lỗi khi xử lý");
            }
            \Session::put('ketqua_up_sk', $ketqua);
            return redirect('/event_info/' . $sukien->mask);
        }
        else{
            return view('login');
        }
    }

    // Hiển thị danh sách đăng ký sự kiện.
    public function HienDanhSachDKy($mssk)
    {
        $sukien = SuKien::GetSK($mssk);
        $ds_dki_sv = DiemDanhSV::LayDSDangKy($mssk);
        $ds_dki_cb = DiemDanhCB::LayDSDangKy($mssk);
        return view('sub_views.xemDSDky', [
            'sukien' => $sukien[0],
            'ds_dki_sv' => $ds_dki_sv,
            'ds_dki_cb' => $ds_dki_cb
        ]);
    }

    // Xóa thông tin sự kiện.
    public function XoaSuKien($mssk)
    {
        if (\Session::has('uname')) {

            // Xóa kết quả điểm danh của sự kiện từ sinh viên và cán bộ
            $ketqua_dd_cb = DiemDanhCB::DeleteDangky_SK($mssk);
            $ketqua_dd_sv = DiemDanhSV::DeleteDangky_SK($mssk);
            $ketqua_thke = ThongKeDiemDanh::DeleteThKe($mssk);
            $name = \Session::get('uname');
            $sukien = SuKien::GetSK($mssk);
            if ($sukien[0]->MATTHAI == 3) {
                WriteLogController::Write_Debug($name." không thể xóa sự kiện ".$mssk. " vì đang điểm danh");
                
                WriteLogController::Write_InFo($name." vào trang sự kiện");
                
                $sukiens = SuKien::GetSuKien();
    
                return view('sub_views.event', [
                    'sukiens' => $sukiens
                ]);
            } else {
                // Xóa thông tin sự kiện.
                $ketqua_sk = SuKien::DeleteSK($mssk);

                $ds_sk = \DB::select('select * from sukien');

                if (!$ds_sk) {
                    WriteLogController::Write_Debug("Bảng sự kiện rỗng");
                    $reset = \DB::statement('ALTER TABLE sukien AUTO_INCREMENT = 1');

                    if ($reset) {
                        WriteLogController::Write_Debug("Reset số thứ tự bảng sự kiện thành công");
                    } else {
                        WriteLogController::Write_Debug("Reset số thứ tự bảng sự kiện thất bại");
                    }
                }

                // Tính kết quả tổng hợp.
                $ketqua = ($ketqua_sk && $ketqua_dd_cb && $ketqua_dd_sv && $ketqua_thke) ? true : false;

                if ($ketqua){
                    WriteLogController::Write_Debug($name." xóa sự kiện ".$mssk);
                    return redirect()->route('event');
                }
                else
                    return redirect()->route('Error', 
                    ['mes' => 'Xóa sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
            }
                
        }
        else{
            return view('login');
        }
    }

    // Tìm sự kiện.
    public function TimSuKien(Request $tukhoa)
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');
            try{
                // Lấy từ khóa cần tìm ra khỏi request.
                $TK = $tukhoa->tukhoa;
            
                WriteLogController::Write_Debug($name." tìm sự kiện theo từ khóa '".$TK."'");

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
                WriteLogController::Write_Debug($name." tìm sinh viên thất bại. Có lỗi khi xử lý");
                return redirect()->route('Error', 
                ['mes' => 'Tìm sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
            }
        }
        else{
            return view('login');
        }
    }
}
