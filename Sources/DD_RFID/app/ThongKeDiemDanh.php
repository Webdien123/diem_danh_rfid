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
                'SELECT * FROM sukien 
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
}
