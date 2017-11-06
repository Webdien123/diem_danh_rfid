<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThongKeDiemDanh extends Model
{
    // Nhập số liệu thống kê tùy từng loại danh sách.
    // Hàm này được kích hoạt sau khi sự kiện kết thúc.
    public static function NhapDS($maloaids, $mask, $so_luong_sv, $so_luong_cb)
    {
        try{
            \DB::insert('insert into thongkediemdanh (MALOAIDS, MASK, SOLUONGSV, SOLUONGCB) values (?, ?, ?, ?)', [
                $maloaids, 
                $mask,
                $so_luong_sv,
                $so_luong_cb
            ]);
            return 1;
        }
        catch(\Exception $e){
            return 0;
        }
    }

    // Truy xuất sự kiện đã điểm danh gần đây nhất.
    public static function LaySK_GanNhat()
    {
        try{
            $sukien_gannhat = \DB::select(
                'SELECT MASK, MATTHAI, TENSK, NGTHUCHIEN
                , DIADIEM, DDVAO, DDRA, TGIANDDRA
                FROM sukien 
                WHERE MATTHAI = 4 
                ORDER BY NGTHUCHIEN DESC, 
                DDRA DESC, 
                TGIANDDRA DESC, 
                MASK DESC LIMIT 1'
            );
            return $sukien_gannhat;
        }
        catch(\Exception $e){
            return null;
        }
    }

    // hàm lấy kết quả thống kê theo mã sự kiện
    public static function LayKetQuaThKe($mask)
    {
        try{
            $kqua_thke = \DB::select(
                'SELECT * FROM thongkediemdanh 
                WHERE MASK = ?',[
                    $mask
                ]
            );
            return $kqua_thke;
        }
        catch(\Exception $e){
            return null;
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
                AND MALOAIDS = 2',
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
                AND (MALOAIDS = 5 OR MALOAIDS = 6 OR MALOAIDS = 7)',
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
                AND MALOAIDS = 2',
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
                AND (MALOAIDS = 5 OR MALOAIDS = 6 OR MALOAIDS = 7)',
                [$mask]
            );
        }
        
        return $dsach;
        
    }

    // Lấy danh sách 10 sự kiện đã điểm danh gần đây.
    public static function LaySuKienDaDD()
    {   
        try{
            $ds_sukien = \DB::select('SELECT MASK, TENSK, DATE_FORMAT(NGTHUCHIEN, "%m/%d/%Y") AS NGTHUCHIEN , DIADIEM FROM sukien WHERE MATTHAI = 4 LIMIT 10');
            return $ds_sukien;
        }
        catch(\Exception $e){
            return null;
        }
    }

    // Đổi danh sách điểm danh sang danh sách cần thiết.
    public static function DoiDS($mask, $ma_ng_chuyen, $ds_can_chuyen, $ds_hien_tai, $loai_ng_chuyen)
    {        
        if ($loai_ng_chuyen == "sv") {
            $kq = DiemDanhSV::CapNhatDSachDD($ma_ng_chuyen, $mask, $ds_can_chuyen);
        }
        if ($loai_ng_chuyen == "cb") {
            $kq = DiemDanhCB::CapNhatDSachDD($ma_ng_chuyen, $mask, $ds_can_chuyen);
        }
        return $kq;
    }

    public static function CapNhatKetQuaThKe($loai_ng_chuyen, $mask, $ds_can_chuyen, $ds_hien_tai)
    {
        if ($loai_ng_chuyen == "sv") {
            try {
                \DB::update(
                    'UPDATE thongkediemdanh SET SOLUONGSV = SOLUONGSV - 1 
                    WHERE MASK = ? AND MALOAIDS = ?', [$mask, $ds_hien_tai]);
            
                \DB::update(
                    'UPDATE thongkediemdanh SET SOLUONGSV = SOLUONGSV + 1 
                    WHERE MASK = ? AND MALOAIDS = ?', [$mask, $ds_can_chuyen]);
                
                return 1;
            }
            catch (\Exception $e){
                return 0;
            }
        }
        if ($loai_ng_chuyen == "cb") {
            try {
                \DB::update(
                    'UPDATE thongkediemdanh SET SOLUONGCB = SOLUONGCB - 1 
                    WHERE MASK = ? AND MALOAIDS = ?', [$mask, $ds_hien_tai]);
            
                \DB::update(
                    'UPDATE thongkediemdanh SET SOLUONGCB = SOLUONGCB + 1 
                    WHERE MASK = ? AND MALOAIDS = ?', [$mask, $ds_can_chuyen]);
                
                return 1;
            }
            catch (\Exception $e){
                return 0;
            }
        }
    }

    // Tính mã số cụ thể cho danh sách cần chuyển từ
    // ds cần chuyển và ds hiện tại
    public static function TinhDS_Can_Chuyen($ds_chuyen, $ds_hien_tai)
    {
        if ($ds_chuyen == "co_mat") {
            if ($ds_hien_tai <= 4) {
                return 1;
            } else {
                return 7;
            }
        }
        if ($ds_chuyen == "vang_mat") {
            if ($ds_hien_tai <= 4) {
                return 2;
            } else {
                return 8;
            }
        }
        if ($ds_chuyen == "co_v_k_r") {
            if ($ds_hien_tai <= 4) {
                return 3;
            } else {
                return 5;
            }
        }
        if ($ds_chuyen == "co_r_k_v") {
            if ($ds_hien_tai <= 4) {
                return 4;
            } else {
                return 6;
            }
        }
    }

    // Tính mã số cụ thể cho danh sách thống kê tương ứng với
    // ds cần tính ở bảng điểm danh
    public static function TinhDS_TKe_Can_Chuyen($ds_can_tinh)
    {
        if ($ds_can_tinh == 1 || $ds_can_tinh == 7) {
            return 1;
        }
        if ($ds_can_tinh == 2 || $ds_can_tinh == 8) {
            return 2;
        }
        if ($ds_can_tinh == 3 || $ds_can_tinh == 5) {
            return 3;
        }
        if ($ds_can_tinh == 4 || $ds_can_tinh == 6) {
            return 4;
        }
        if ($ds_can_tinh == 5 || $ds_can_tinh == 6 || $ds_can_tinh == 7 || $ds_can_tinh == 8) {
            return 7;
        }
    }

    // Xóa kết quả thống kê sự kiện.
    public static function DeleteThKe($mssk)
    {
        try {
            \DB::delete('DELETE FROM thongkediemdanh WHERE MASK = "'.$mssk.'"');
            return true;
        } catch (\Exception $e) {
            return false;
            // dd($e->getMessage());
        }
    }
}
