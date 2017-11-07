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
    public function ThongKeSoLieu($mask)
    {
        // Truy xuất danh sách điểm danh của cán bộ và sinh viên.
        $ds_ddanh_cb = DiemDanhCB::LayDSDiemDanh($mask);
        $ds_ddanh_sv = DiemDanhSV::LayDSDiemDanh($mask);

        // Nếu danh sách điểm danh cán bộ có dữ liệu
        if ($ds_ddanh_cb) {

            // Đặt lại các giá trị thống kê.
            $cb_co_mat = 0;
            $cb_vang_mat = 0;
            $cb_co_vao_k_ra = 0;
            $cb_co_ra_k_vao = 0;
            $cb_k_co_ttin = 0;

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

        // Nếu danh sách điểm danh sinh viên có dữ liệu
        if ($ds_ddanh_sv) {
            
            // Đặt lại các giá trị thống kê.
            $sv_co_mat = 0;
            $sv_vang_mat = 0;
            $sv_co_vao_k_ra = 0;
            $sv_co_ra_k_vao = 0;
            $sv_k_co_ttin = 0;

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

        // Nếu tất cả kết quả đều thành công, tính kết quả tổng hợp.
        $ketqua_insert = $insert1 * $insert2 * $insert3 * $insert4 * $insert7;

        // Nếu mọi thứ đều hoàn thành chính xác, trả về 'thanhcong'
        if ($ketqua_insert == 1) {
            return "thanhcong";
            // return dd($ketqua_insert);
        } else {
            return "thatbai";
            // return dd($ketqua_insert);
        }
    }

    // Hàm lấy trang thống kê theo sự kiện điểm danh gần nhất.
    public function GetPageThongKe()
    {
        // Lấy sự kiện đã điểm danh gần nhất.
        $sukien_gannhat = ThongKeDiemDanh::LaySK_GanNhat();

        if ($sukien_gannhat != null) {
            $sukien_gannhat = $sukien_gannhat[0];

            // Lấy danh sách 10 sự kiện cũ đã điểm danh gần đây.
            $sukien_old = ThongKeDiemDanh::LaySuKienDaDD();

            // Lấy kết quả điểm danh của sự kiện.
            $ketqua_thke = ThongKeDiemDanh::LayKetQuaThKe($sukien_gannhat->MASK);
            
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
            return view("sub_views.chart", [
                'sukien' => null
            ]);
        }
        
    }

    // Hàm lấy trang thống kê theo sự kiện cũ đã điểm danh.
    public function GetPageThongKe_Old(Request $R){
        // Lấy mã sự kiện.
        $mask = $R->op_sk;

        // Lấy sự kiện đã điểm danh gần nhất.
        $sukien_gannhat = SuKien::GetSK($mask);
        
        if ($sukien_gannhat != null) {
            
            $sukien_gannhat = $sukien_gannhat[0];

            // Lấy danh sách 10 sự kiện cũ đã điểm danh gần đây.
            $sukien_old = ThongKeDiemDanh::LaySuKienDaDD();

            // Lấy kết quả điểm danh của sự kiện.
            $ketqua_thke = ThongKeDiemDanh::LayKetQuaThKe($sukien_gannhat->MASK);
            
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
            return view("sub_views.chart", [
                'sukien' => null
            ]);
        }
    }

    public function GetPageThongKe_Old_GET($mask)
    {
        // Lấy sự kiện đã điểm danh gần nhất.
        $sukien_gannhat = SuKien::GetSK($mask);
        
        if ($sukien_gannhat != null) {
            
            $sukien_gannhat = $sukien_gannhat[0];

            // Lấy danh sách 10 sự kiện cũ đã điểm danh gần đây.
            $sukien_old = ThongKeDiemDanh::LaySuKienDaDD();

            // Lấy kết quả điểm danh của sự kiện.
            $ketqua_thke = ThongKeDiemDanh::LayKetQuaThKe($sukien_gannhat->MASK);
            
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
            return view("sub_views.chart", [
                'sukien' => null
            ]);
        }
    }

    // Lấy danh sách 10 sự kiện đã điểm danh gần đây.
    public static function LaySuKienDaDD()
    {   
        try{
            $ds_sukien = \DB::select('SELECT MASK, TENSK, NGTHUCHIEN, DIADIEM FROM sukien WHERE MATTHAI = 4 LIMIT 10');
            return dd($ds_sukien);
        }
        catch(\Exception $e){
            return null;
        }
    }

    // Đổi danh sách điểm danh sang danh sách cần thiết.
    public function ChuyenDanhSach(Request $R)
    {
        // Nhận các giá trị trong request
        $ds_chuyen = Input::get("optradio");
        $mask = $R->mask;
        $ma_ng_chuyen = $R->ma_ng_chuyen;
        $ds_hien_tai = $R->ds_hien_tai;
        $loai_ng_chuyen = $R->loai_ng_chuyen;
        
        // Tính danh sách điểm danh cần chuyển.
        $ds_can_chuyen = ThongKeDiemDanh::TinhDS_Can_Chuyen($ds_chuyen, $ds_hien_tai);

        // Xử lý chuyển danh sách và lưu kết quả xử lý.
        $ketqua_ds = ThongKeDiemDanh::DoiDS($mask, $ma_ng_chuyen, $ds_can_chuyen, $ds_hien_tai, $loai_ng_chuyen);

        // Tính danh sách thống kê cần chuyển
        $ds_can_chuyen = ThongKeDiemDanh::TinhDS_TKe_Can_Chuyen($ds_can_chuyen);
        $ds_hien_tai = ThongKeDiemDanh::TinhDS_TKe_Can_Chuyen($ds_hien_tai);    

        // Xử lý cập nhật số liệu thống kê và lưu kết quả xử lý.
        $ketqua_solieu = ThongKeDiemDanh::CapNhatKetQuaThKe($loai_ng_chuyen, $mask, $ds_can_chuyen, $ds_hien_tai);

        $ketqua = $ketqua_ds * $ketqua_solieu;

        if ($ketqua == 1) {
            return \Redirect::route('chart_old_get', $mask);
        } else {
            return redirect()->route('Error',
            ['mes' => 'Sửa kết quả điểm danh thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
        }
        
    }
    

    // Lấy danh sách sinh viên theo loại danh sách điểm danh và mã sự kiện.
    public static function LayDS_SV($mask, $ten_loaids)
    {
        // Lấy danh sách sinh viên vắng mặt. 
        if ($ten_loaids == "comat") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhsv, sinhvien 
                WHERE diemdanhsv.MSSV = sinhvien.MSSV 
                AND MASK = ?
                AND (MALOAIDS = 1 OR MALOAIDS = 7)',
                [$mask]
            );
        }

        // Lấy danh sách sinh viên có mặt. 
        if ($ten_loaids == "vangmat") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhsv, sinhvien 
                WHERE diemdanhsv.MSSV = sinhvien.MSSV 
                AND MASK = ?
                AND (MALOAIDS = 2 OR MALOAIDS = 8)',
                [$mask]
            );
        }

        // Lấy danh sách sinh viên có vào không ra. 
        if ($ten_loaids == "covaokra") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhsv, sinhvien 
                WHERE diemdanhsv.MSSV = sinhvien.MSSV 
                AND MASK = ?
                AND (MALOAIDS = 3 OR MALOAIDS = 5)',
                [$mask]
            );
        }

        // Lấy danh sách sinh viên có ra không vào. 
        if ($ten_loaids == "corakvao") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhsv, sinhvien 
                WHERE diemdanhsv.MSSV = sinhvien.MSSV 
                AND MASK = ?
                AND (MALOAIDS = 4 OR MALOAIDS = 6)',
                [$mask]
            );
        }

        // Lấy danh sách sinh viên chưa bổ sung thông tin.
        if ($ten_loaids == "chuattin") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhsv, sinhvien 
                WHERE diemdanhsv.MSSV = sinhvien.MSSV 
                AND MASK = ?
                AND (MALOAIDS = 5 OR MALOAIDS = 6 OR MALOAIDS = 7 OR MALOAIDS = 8)',
                [$mask]
            );
        }
        
        return $dsach;
        
    }

    // Lấy danh sách cán bộ theo loại danh sách điểm danh và mã sự kiện.
    public static function LayDS_CB($mask, $ten_loaids)
    {
        // Lấy danh sách cán bộ vắng mặt. 
        if ($ten_loaids == "comat") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhcb, canbo 
                WHERE diemdanhcb.MSCB = canbo.MSCB 
                AND MASK = ?
                AND (MALOAIDS = 1 OR MALOAIDS = 7)',
                [$mask]
            );
        }

        // Lấy danh sách cán bộ có mặt. 
        if ($ten_loaids == "vangmat") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhcb, canbo 
                WHERE diemdanhcb.MSCB = canbo.MSCB 
                AND MASK = ?
                AND (MALOAIDS = 2 OR MALOAIDS = 8)',
                [$mask]
            );
        }

        // Lấy danh sách cán bộ có vào không ra. 
        if ($ten_loaids == "covaokra") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhcb, canbo 
                WHERE diemdanhcb.MSCB = canbo.MSCB 
                AND MASK = ?
                AND (MALOAIDS = 3 OR MALOAIDS = 5)',
                [$mask]
            );
        }

        // Lấy danh sách cán bộ có ra không vào. 
        if ($ten_loaids == "corakvao") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhcb, canbo 
                WHERE diemdanhcb.MSCB = canbo.MSCB 
                AND MASK = ?
                AND (MALOAIDS = 4 OR MALOAIDS = 6)',
                [$mask]
            );
        }

        // Lấy danh sách cán bộ chưa bổ sung thông tin.
        if ($ten_loaids == "chuattin") {
            $dsach = \DB::select(
                'SELECT * FROM diemdanhcb, canbo 
                WHERE diemdanhcb.MSCB = canbo.MSCB 
                AND MASK = ?
                AND (MALOAIDS = 5 OR MALOAIDS = 6 OR MALOAIDS = 7 OR MALOAIDS = 8)',
                [$mask]
            );
        }
        
        return $dsach;
        
    }
}
