<?php
// Lớp định nghĩa các hàm xử lý việc thống kê số lượng và lập danh sách sau khi điểm danh.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\DiemDanhCB;
use App\DiemDanhSV;
use App\ThongKeDiemDanh;
use App\SuKien;

class ThongKeController extends Controller
{
    // Hàm tổng hợp số liệu điểm danh khi sự kiện kết thúc.
    public static function ThongKeSoLieu($mask)
    {
        // Truy xuất danh sách điểm danh của cán bộ và sinh viên.
        $ds_ddanh_cb = DiemDanhCB::LayDSDiemDanh($mask);
        $ds_ddanh_sv = DiemDanhSV::LayDSDiemDanh($mask);

        // Đặt lại các giá trị thống kê.
        $cb_co_mat = 0;
        $cb_vang_mat = 0;
        $cb_co_vao_k_ra = 0;
        $cb_co_ra_k_vao = 0;
        $cb_k_co_ttin = 0;

        // Nếu danh sách điểm danh cán bộ có dữ liệu
        if ($ds_ddanh_cb) {

            foreach ($ds_ddanh_cb as $key => $value) {

                // Đếm số lượng cán bộ có mặt.
                if ($value->MALOAIDS == 1 || $value->MALOAIDS == 7) {
                    $cb_co_mat++;
                }
                // Đếm số lượng cán bộ vắng mặt.
                if ($value->MALOAIDS == 2 || $value->MALOAIDS == 8) {
                    $cb_vang_mat++;
                }
                // Đếm số lượng cán bộ có vào không ra.
                if ($value->MALOAIDS == 3 || $value->MALOAIDS == 5) {
                    $cb_co_vao_k_ra++;
                }
                // Đếm số lượng cán bộ có ra không vào.
                if ($value->MALOAIDS == 4 || $value->MALOAIDS == 6) {
                    $cb_co_ra_k_vao++;
                }
                // Đếm số lượng cán bộ điểm danh nhưng chưa bổ sung thông tin.
                if ($value->MALOAIDS == 5 || $value->MALOAIDS == 6 
                    || $value->MALOAIDS == 7 || $value->MALOAIDS == 8) {
                    $cb_k_co_ttin++;
                }
            }
        }

        // Đặt lại các giá trị thống kê.
        $sv_co_mat = 0;
        $sv_vang_mat = 0;
        $sv_co_vao_k_ra = 0;
        $sv_co_ra_k_vao = 0;
        $sv_k_co_ttin = 0;

        // Nếu danh sách điểm danh sinh viên có dữ liệu
        if ($ds_ddanh_sv) {
            
            foreach ($ds_ddanh_sv as $key => $value) {

                // Đếm số lượng sinh viên có mặt.
                if ($value->MALOAIDS == 1 || $value->MALOAIDS == 7) {
                    $sv_co_mat++;
                }
                // Đếm số lượng sinh viên vắng mặt.
                if ($value->MALOAIDS == 2) {
                    $sv_vang_mat++;
                }
                // Đếm số lượng sinh viên có vào không ra.
                if ($value->MALOAIDS == 3 || $value->MALOAIDS == 5) {
                    $sv_co_vao_k_ra++;
                }
                // Đếm số lượng sinh viên có ra không vào.
                if ($value->MALOAIDS == 4 || $value->MALOAIDS == 6) {
                    $sv_co_ra_k_vao++;
                }
                // Đếm số lượng sinh viên điểm danh nhưng chưa bổ sung thông tin.
                if ($value->MALOAIDS == 5 || $value->MALOAIDS == 6 || $value->MALOAIDS == 7) {
                    $sv_k_co_ttin++;
                }
            }
        }

        // Thêm kết quả thống kê cho mỗi loại danh sách và số liệu tương ứng,
        // lưu kết quả xử lý sau mỗi lần hoàn thành.
        $insert1 = ThongKeDiemDanh::NhapDS(1, $mask, $sv_co_mat, $cb_co_mat);
        $insert2 = ThongKeDiemDanh::NhapDS(2, $mask, $sv_vang_mat, $cb_vang_mat);
        $insert3 = ThongKeDiemDanh::NhapDS(3, $mask, $sv_co_vao_k_ra, $cb_co_vao_k_ra);
        $insert4 = ThongKeDiemDanh::NhapDS(4, $mask, $sv_co_ra_k_vao, $cb_co_ra_k_vao);
        $insert7 = ThongKeDiemDanh::NhapDS(7, $mask, $sv_k_co_ttin, $cb_k_co_ttin);

        if ($insert1) {
            WriteLogController::Write_Debug("Thêm số liệu thành công loại ds 1 của sự kiên ".$mask,"suKien[".$mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Thêm số liệu loại ds 1 của sự kiên ".$mask." thất bại","suKien[".$mask."]_Debug");
        }

        if ($insert2) {
            WriteLogController::Write_Debug("Thêm số liệu thành công loại ds 2 của sự kiên ".$mask,"suKien[".$mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Thêm số liệu loại ds 2 của sự kiên ".$mask." thất bại","suKien[".$mask."]_Debug");
        }

        if ($insert3) {
            WriteLogController::Write_Debug("Thêm số liệu thành công loại ds 3 của sự kiên ".$mask,"suKien[".$mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Thêm số liệu loại ds 3 của sự kiên ".$mask." thất bại","suKien[".$mask."]_Debug");
        }

        if ($insert4) {
            WriteLogController::Write_Debug("Thêm số liệu thành công loại ds 4 của sự kiên ".$mask,"suKien[".$mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Thêm số liệu loại ds 4 của sự kiên ".$mask." thất bại","suKien[".$mask."]_Debug");
        }

        if ($insert7) {
            WriteLogController::Write_Debug("Thêm số liệu thành công loại ds 7 của sự kiên ".$mask,"suKien[".$mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Thêm số liệu loại ds 7 của sự kiên ".$mask." thất bại","suKien[".$mask."]_Debug");
        }
        

        // Nếu tất cả kết quả đều thành công, tính kết quả tổng hợp.
        $ketqua_insert = $insert1 * $insert2 * $insert3 * $insert4 * $insert7;

        // Nếu mọi thứ đều hoàn thành chính xác, trả về 'thanhcong'
        if ($ketqua_insert == 1) {
            WriteLogController::Write_Info("Thống kê sự kiên ".$mask." thành công","suKien[".$mask."]");
            return "thanhcong";
            // return dd($ketqua_insert);
        } else {
            WriteLogController::Write_Info("Thống kê sự kiên ".$mask." thất bại","suKien[".$mask."]");
            return "thatbai";
            // return dd($ketqua_insert);
        }
    }

    // Hàm lấy trang thống kê theo sự kiện điểm danh gần nhất.
    public function GetPageThongKe()
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');

            // Lấy sự kiện đã điểm danh gần nhất.
            $sukien_gannhat = ThongKeDiemDanh::LaySK_GanNhat();

            if ($sukien_gannhat != null) {
                $sukien_gannhat = $sukien_gannhat[0];

                // Lấy danh sách 10 sự kiện cũ đã điểm danh gần đây.
                $sukien_old = ThongKeDiemDanh::LaySuKienDaDD();

                // Lấy mã sự kiện.
                $mask = $sukien_gannhat->MASK;

                // Xóa kết quả thống kê cũ.
                \DB::delete('delete from thongkediemdanh where MASK = ?', [$mask]);

                // Tính toán lại kết quả mới.
                self::ThongKeSoLieu($mask);
                
                // Lấy kết quả điểm danh của sự kiện.
                $ketqua_thke = ThongKeDiemDanh::LayKetQuaThKe($mask);
                

                // Lấy danh sách sinh viên vắng mặt. 
                $ds_sv_vang_mat = ThongKeDiemDanh::LayDS_SV($mask, "vangmat");

                // Lấy danh sách sinh viên có mặt. 
                $ds_sv_co_mat = ThongKeDiemDanh::LayDS_SV($mask, "comat");

                // Lấy danh sách sinh viên có vào không ra. 
                $ds_sv_co_vao_k_ra = ThongKeDiemDanh::LayDS_SV($mask, "covaokra");

                // Lấy danh sách sinh viên có ra không vào. 
                $ds_sv_co_ra_k_vao = ThongKeDiemDanh::LayDS_SV($mask, "corakvao");

                // Lấy danh sách sinh viên chưa bổ sung thông tin.
                $ds_sv_chua_co_ttin = ThongKeDiemDanh::LayDS_SV($mask, "chuattin");

                // Lấy danh sách cán bộ vắng mặt. 
                $ds_cb_vang_mat = ThongKeDiemDanh::LayDS_CB($mask, "vangmat");

                // Lấy danh sách cán bộ có mặt. 
                $ds_cb_co_mat = ThongKeDiemDanh::LayDS_CB($mask, "comat");

                // Lấy danh sách cán bộ có vào không ra. 
                $ds_cb_co_vao_k_ra = ThongKeDiemDanh::LayDS_CB($mask, "covaokra");
                
                // Lấy danh sách cán bộ có ra không vào. 
                $ds_cb_co_ra_k_vao = ThongKeDiemDanh::LayDS_CB($mask, "corakvao");

                // Lấy danh sách cán bộ chưa bổ sung thông tin.
                $ds_cb_chua_co_ttin = ThongKeDiemDanh::LayDS_CB($mask, "chuattin");

                WriteLogController::Write_InFo($name." xem kết quả thống kê sự kiện ".$mask);

                return view("sub_views.chart", [
                    'sukien' => $sukien_gannhat,
                    'sukien_old' => $sukien_old,
                    'kq_thke' => $ketqua_thke,
                    'ds_sv_vang_mat' => $ds_sv_vang_mat,
                    'ds_sv_co_mat' => $ds_sv_co_mat,
                    'ds_sv_co_vao_k_ra' => $ds_sv_co_vao_k_ra,
                    'ds_sv_co_ra_k_vao' => $ds_sv_co_ra_k_vao,
                    'ds_sv_chua_co_ttin' => $ds_sv_chua_co_ttin,
                    'ds_cb_vang_mat' => $ds_cb_vang_mat,
                    'ds_cb_co_mat' => $ds_cb_co_mat,
                    'ds_cb_co_vao_k_ra' => $ds_cb_co_vao_k_ra,
                    'ds_cb_co_ra_k_vao' => $ds_cb_co_ra_k_vao,
                    'ds_cb_chua_co_ttin' => $ds_cb_chua_co_ttin
                ]);
            }
            else {
                WriteLogController::Write_InFo("Hiển thị trang thống kê rỗng");

                return view("sub_views.chart", [
                    'sukien' => null
                ]);
            }
        }
        else{
            return view('login');
        }
    }

    // Hàm lấy trang thống kê theo sự kiện cũ đã điểm danh.
    public function GetPageThongKe_Old(Request $R){
        if (\Session::has('uname')) {
            $name = \Session::get('uname');

            // Lấy mã sự kiện.
            $mask = $R->op_sk;

            // Lấy sự kiện đã điểm danh gần nhất.
            $sukien_gannhat = SuKien::GetSK($mask);
            
            if ($sukien_gannhat != null) {
                
                $sukien_gannhat = $sukien_gannhat[0];

                // Lấy danh sách 10 sự kiện cũ đã điểm danh gần đây.
                $sukien_old = ThongKeDiemDanh::LaySuKienDaDD();

                // Lấy mã sự kiện.
                $mask = $sukien_gannhat->MASK;
                
                // Xóa kết quả thống kê cũ.
                \DB::delete('delete from thongkediemdanh where MASK = ?', [$mask]);
                
                // Tính toán lại kết quả mới.
                self::ThongKeSoLieu($mask);
                                
                // Lấy kết quả điểm danh của sự kiện.
                $ketqua_thke = ThongKeDiemDanh::LayKetQuaThKe($mask);
                
                // Lấy mã sự kiện.
                $mask = $sukien_gannhat->MASK;

                // Lấy danh sách sinh viên vắng mặt. 
                $ds_sv_vang_mat = ThongKeDiemDanh::LayDS_SV($mask, "vangmat");

                // Lấy danh sách sinh viên có mặt. 
                $ds_sv_co_mat = ThongKeDiemDanh::LayDS_SV($mask, "comat");

                // Lấy danh sách sinh viên có vào không ra. 
                $ds_sv_co_vao_k_ra = ThongKeDiemDanh::LayDS_SV($mask, "covaokra");

                // Lấy danh sách sinh viên có ra không vào. 
                $ds_sv_co_ra_k_vao = ThongKeDiemDanh::LayDS_SV($mask, "corakvao");

                // Lấy danh sách sinh viên chưa bổ sung thông tin.
                $ds_sv_chua_co_ttin = ThongKeDiemDanh::LayDS_SV($mask, "chuattin");

                // Lấy danh sách cán bộ vắng mặt. 
                $ds_cb_vang_mat = ThongKeDiemDanh::LayDS_CB($mask, "vangmat");

                // Lấy danh sách cán bộ có mặt. 
                $ds_cb_co_mat = ThongKeDiemDanh::LayDS_CB($mask, "comat");

                // Lấy danh sách cán bộ có vào không ra. 
                $ds_cb_co_vao_k_ra = ThongKeDiemDanh::LayDS_CB($mask, "covaokra");
                
                // Lấy danh sách cán bộ có ra không vào. 
                $ds_cb_co_ra_k_vao = ThongKeDiemDanh::LayDS_CB($mask, "corakvao");

                // Lấy danh sách cán bộ chưa bổ sung thông tin.
                $ds_cb_chua_co_ttin = ThongKeDiemDanh::LayDS_CB($mask, "chuattin");

                WriteLogController::Write_InFo($name." xem kết quả thống kê sự kiện ".$mask);

                return view("sub_views.chart", [
                    'sukien' => $sukien_gannhat,
                    'sukien_old' => $sukien_old,
                    'kq_thke' => $ketqua_thke,
                    'ds_sv_vang_mat' => $ds_sv_vang_mat,
                    'ds_sv_co_mat' => $ds_sv_co_mat,
                    'ds_sv_co_vao_k_ra' => $ds_sv_co_vao_k_ra,
                    'ds_sv_co_ra_k_vao' => $ds_sv_co_ra_k_vao,
                    'ds_sv_chua_co_ttin' => $ds_sv_chua_co_ttin,
                    'ds_cb_vang_mat' => $ds_cb_vang_mat,
                    'ds_cb_co_mat' => $ds_cb_co_mat,
                    'ds_cb_co_vao_k_ra' => $ds_cb_co_vao_k_ra,
                    'ds_cb_co_ra_k_vao' => $ds_cb_co_ra_k_vao,
                    'ds_cb_chua_co_ttin' => $ds_cb_chua_co_ttin
                ]);
            }
            else {
                WriteLogController::Write_InFo("Hiển thị trang thống kê rỗng");
                return view("sub_views.chart", [
                    'sukien' => null
                ]);
            }
        }
        else{
            return view('login');
        }
    }

    public function GetPageThongKe_Old_GET($mask)
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');

            // Lấy sự kiện đã điểm danh gần nhất.
            $sukien_gannhat = SuKien::GetSK($mask);
            
            if ($sukien_gannhat != null) {
                
                $sukien_gannhat = $sukien_gannhat[0];

                // Lấy danh sách 10 sự kiện cũ đã điểm danh gần đây.
                $sukien_old = ThongKeDiemDanh::LaySuKienDaDD();

                // Lấy mã sự kiện.
                $mask = $sukien_gannhat->MASK;
                
                // Xóa kết quả thống kê cũ.
                \DB::delete('delete from thongkediemdanh where MASK = ?', [$mask]);
                
                // Tính toán lại kết quả mới.
                self::ThongKeSoLieu($mask);
                                
                // Lấy kết quả điểm danh của sự kiện.
                $ketqua_thke = ThongKeDiemDanh::LayKetQuaThKe($mask);
                
                // Lấy mã sự kiện.
                $mask = $sukien_gannhat->MASK;

                // Lấy danh sách sinh viên vắng mặt. 
                $ds_sv_vang_mat = ThongKeDiemDanh::LayDS_SV($mask, "vangmat");

                // Lấy danh sách sinh viên có mặt. 
                $ds_sv_co_mat = ThongKeDiemDanh::LayDS_SV($mask, "comat");

                // Lấy danh sách sinh viên có vào không ra. 
                $ds_sv_co_vao_k_ra = ThongKeDiemDanh::LayDS_SV($mask, "covaokra");

                // Lấy danh sách sinh viên có ra không vào. 
                $ds_sv_co_ra_k_vao = ThongKeDiemDanh::LayDS_SV($mask, "corakvao");

                // Lấy danh sách sinh viên chưa bổ sung thông tin.
                $ds_sv_chua_co_ttin = ThongKeDiemDanh::LayDS_SV($mask, "chuattin");

                // Lấy danh sách cán bộ vắng mặt. 
                $ds_cb_vang_mat = ThongKeDiemDanh::LayDS_CB($mask, "vangmat");

                // Lấy danh sách cán bộ có mặt. 
                $ds_cb_co_mat = ThongKeDiemDanh::LayDS_CB($mask, "comat");

                // Lấy danh sách cán bộ có vào không ra. 
                $ds_cb_co_vao_k_ra = ThongKeDiemDanh::LayDS_CB($mask, "covaokra");
                
                // Lấy danh sách cán bộ có ra không vào. 
                $ds_cb_co_ra_k_vao = ThongKeDiemDanh::LayDS_CB($mask, "corakvao");

                // Lấy danh sách cán bộ chưa bổ sung thông tin.
                $ds_cb_chua_co_ttin = ThongKeDiemDanh::LayDS_CB($mask, "chuattin");

                WriteLogController::Write_InFo($name." xem kết quả thống kê sự kiện ".$mask);

                return view("sub_views.chart", [
                    'sukien' => $sukien_gannhat,
                    'sukien_old' => $sukien_old,
                    'kq_thke' => $ketqua_thke,
                    'ds_sv_vang_mat' => $ds_sv_vang_mat,
                    'ds_sv_co_mat' => $ds_sv_co_mat,
                    'ds_sv_co_vao_k_ra' => $ds_sv_co_vao_k_ra,
                    'ds_sv_co_ra_k_vao' => $ds_sv_co_ra_k_vao,
                    'ds_sv_chua_co_ttin' => $ds_sv_chua_co_ttin,
                    'ds_cb_vang_mat' => $ds_cb_vang_mat,
                    'ds_cb_co_mat' => $ds_cb_co_mat,
                    'ds_cb_co_vao_k_ra' => $ds_cb_co_vao_k_ra,
                    'ds_cb_co_ra_k_vao' => $ds_cb_co_ra_k_vao,
                    'ds_cb_chua_co_ttin' => $ds_cb_chua_co_ttin
                ]);
            }
            else {
                WriteLogController::Write_InFo("Hiển thị trang thống kê rỗng");
                return view("sub_views.chart", [
                    'sukien' => null
                ]);
            }
        }
        else{
            return view('login');
        }
    }

    // Lấy danh sách 10 sự kiện đã điểm danh gần đây.
    public static function LaySuKienDaDD()
    {  
        if (\Session::has('uname')) {
            try{
                $ds_sukien = \DB::select('SELECT MASK, TENSK, NGTHUCHIEN, DIADIEM FROM sukien WHERE MATTHAI = 4 LIMIT 10');
                WriteLogController::Write_Debug("Lấy danh sách sự kiện đã điểm danh thành công.");                                
            }
            catch(\Exception $e){
                WriteLogController::Write_Debug("Lấy danh sách sự kiện đã điểm danh thất bại.");
                return null;
            }
        }
        else{
            return view('login');
        }
    }

    // Đổi danh sách điểm danh sang danh sách cần thiết.
    public function ChuyenDanhSach(Request $R)
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');

            // Nhận các giá trị trong request
            $ds_chuyen = Input::get("optradio");
            $mask = $R->mask;
            $ma_ng_chuyen = $R->ma_ng_chuyen;
            $ds_hien_tai = $R->ds_hien_tai;
            $loai_ng_chuyen = $R->loai_ng_chuyen;
            
            // Tính danh sách điểm danh cần chuyển.
            $ds_can_chuyen = ThongKeDiemDanh::TinhDS_Can_Chuyen($ds_chuyen, $ds_hien_tai);

            if ($ds_can_chuyen == 0) {
                WriteLogController::Write_Debug("Tính loại ds cần chuyển cho ".$ma_ng_chuyen." thất bại");
            }
            else {
                WriteLogController::Write_Debug("Tính loại ds cần chuyển cho ".$ma_ng_chuyen." thành công");
            }

            // Xử lý chuyển danh sách và lưu kết quả xử lý.
            $ketqua_ds = ThongKeDiemDanh::DoiDS($mask, $ma_ng_chuyen, $ds_can_chuyen, $ds_hien_tai, $loai_ng_chuyen);

            if ($ketqua_ds == 0) {
                WriteLogController::Write_Debug("Chuyển danh sách cho ".$ma_ng_chuyen." thất bại");
            }
            else {
                WriteLogController::Write_Debug("Chuyển danh sách cho ".$ma_ng_chuyen." thành công");
            }

            // // Tính danh sách thống kê cần chuyển
            // $ds_can_chuyen = ThongKeDiemDanh::TinhDS_TKe_Can_Chuyen($ds_can_chuyen);
            // $ds_hien_tai = ThongKeDiemDanh::TinhDS_TKe_Can_Chuyen($ds_hien_tai);

            // // Xử lý cập nhật số liệu thống kê và lưu kết quả xử lý.
            // $ketqua_solieu = ThongKeDiemDanh::CapNhatKetQuaThKe($loai_ng_chuyen, $mask, $ds_can_chuyen, $ds_hien_tai);

            // if ($ketqua_solieu == 0) {
            //     WriteLogController::Write_Debug("Cập nhật số liệu thống kê cho ".$ma_ng_chuyen." thất bại");
            // }
            // else {
            //     WriteLogController::Write_Debug("Cập nhật số liệu thống kê cho ".$ma_ng_chuyen." thành công");
            // }

            // $ketqua = $ketqua_ds * $ketqua_solieu;

            if ($ketqua_ds == 1) {
                WriteLogController::Write_InFo($name." chuyển danh sách cho "
                    .$loai_ng_chuyen." ".$ma_ng_chuyen." từ ".$ds_hien_tai." sang ".$ds_can_chuyen." thành công");
                return \Redirect::route('chart_old_get', $mask);
            } else {
                WriteLogController::Write_InFo($name." chuyển danh sách cho "
                .$loai_ng_chuyen." ".$ma_ng_chuyen." từ ".$ds_hien_tai." sang ".$ds_can_chuyen." thất bại");
                return redirect()->route('Error',
                ['mes' => 'Sửa kết quả điểm danh thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
            }
        
        }
        else{
            return view('login');
        }
    }
}
