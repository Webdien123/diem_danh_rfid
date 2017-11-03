<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiemDanhSV extends Model
{
    // Hàm kiểm tra cán bộ đã đăng ký sự kiện nào đó hay chưa.
    public static function KiemTraDangKy($mssv, $mask)
    {
        // Tìm thử kết quả điểm danh của cán bộ.
        $loaids = \DB::select(
            \DB::raw("SELECT MALOAIDS FROM diemdanhsv WHERE MASK = :v1 AND MSSV = :v2"), 
            array(
                'v1' => $mask,
                'v2' => $mssv
            )
        );

        if ($loaids) {
            return $loaids[0]->MALOAIDS;
        } else {
            return 0;
        }
    }

    // Hàm cập nhật kết quả điểm danh cán bộ sang loại danh sách mới
    //  trong quá trình điểm danh.
    public static function CapNhatDSachDD($mssv, $mask, $loaids_moi)
    {
        try{
            \DB::update('UPDATE diemdanhsv SET MALOAIDS = ? WHERE MASK = ? AND MSSV = ?', 
                [$loaids_moi, $mask, $mssv]
            );
            return 1;
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return 0;
        }
    }

    public static function DangKySuKien($ma_ng_dky, $mask)
    {
        try {
            \DB::insert('insert into diemdanhsv (MSSV, MASK, MALOAIDS) values (?, ?, ?)', [
                $ma_ng_dky,
                $mask,
                2
            ]);
            return true; //Trả kết quả thêm để controller Thẻ tiếp tục thực thi.
        } catch (\Exception $e) {
            return false;
            // dd($e->getMessage());
        }
    }

    // Xóa kết quả điểm danh hoặc đăng ký theo mã số sinh viên
    public static function DeleteDangky_SV($ma_ng_dky)
    {
        // lấy loại danh sách điểm danh từ mã người đăng ký và mã sự kiện.
        $loaids = \DB::select('SELECT MALOAIDS FROM diemdanhsv WHERE MSSV = ?', [
            $ma_ng_dky
        ]);

        // Nếu loại danh sách không tồn tại
        if (!$loaids) {
            // Xem như đã xóa thành công.
            return true;
        }

        // Ngược lại thực hiện xóa kết quả điểm danh.
        try {
            \DB::delete('DELETE FROM diemdanhsv WHERE MSSV = "'.$ma_ng_dky.'"');
            return true;
        } catch (\Exception $e) {
            return false;
            // dd($e->getMessage());
        }
    }

    // Xóa kết quả điểm danh hoặc đăng ký theo mã số sự kiện
    public static function DeleteDangky_SK($mask)
    {
        // lấy loại danh sách điểm danh từ mã sự kiện.
        $loaids = \DB::select('SELECT MALOAIDS FROM diemdanhsv WHERE MASK = ?', [
            $mask
        ]);
        
        // Nếu loại danh sách không tồn tại
        if (!$loaids) {

            // Xem như đã xóa thành công.
            return true;
        }

        // Ngược lại thực hiện xóa kết quả điểm danh.
        try {
            \DB::delete('DELETE FROM diemdanhsv WHERE MASK = "'.$mask.'"');
            return true;
        } catch (\Exception $e) {
            // return false;
            dd($e->getMessage());
        }
    }

    // Truy xuất danh sách điểm danh sinh viên theo mã sự kiện.
    public static function LayDSDiemDanh($mask)
    {
        $ds_ddanh_sv = \DB::select('select * from diemdanhsv where MASK = ?', [$mask]);
        return $ds_ddanh_sv;
    }
}
