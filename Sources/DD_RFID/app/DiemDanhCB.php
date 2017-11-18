<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiemDanhCB extends Model
{
    // Hàm kiểm tra cán bộ đã đăng ký sự kiện nào đó hay chưa.
    public static function KiemTraDangKy($mscb, $mask)
    {
        // Tìm thử kết quả điểm danh của cán bộ.
        $loaids = \DB::select(
            \DB::raw("SELECT MALOAIDS FROM diemdanhcb WHERE MASK = :v1 AND MSCB = :v2"), 
            array(
                'v1' => $mask,
                'v2' => $mscb
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
    public static function CapNhatDSachDD($mscb, $mask, $loaids_moi)
    {
        try{
            \DB::update('UPDATE diemdanhcb SET MALOAIDS = ? WHERE MASK = ? AND MSCB = ?', 
                [$loaids_moi, $mask, $mscb]
            );
            return 1;
        }
        catch (\Exception $e) {
            // return $e->getMessage();
            return 0;
        }
    }

    // Đăng ký sự kiện cho mã số người đăng ký và mã sự kiện cho trước.
    public static function DangKySuKien($ma_ng_dky, $mask)
    {
        try {
            \DB::insert('insert into diemdanhcb (MSCB, MASK, MALOAIDS) values (?, ?, ?)', [
                $ma_ng_dky,
                $mask,
                2
            ]);
            return true; //Trả kết quả thêm để controller Thẻ tiếp tục thực thi.
        } catch (\Exception $e) {
            return false;
        }
    }    

    // Xóa kết quả điểm danh hoặc đăng ký theo mã số cán bộ
    public static function DeleteDangky_CB($ma_ng_dky)
    {
        // lấy loại danh sách điểm danh từ mã người đăng ký.
        $loaids = \DB::select('SELECT MALOAIDS FROM diemdanhcb WHERE MSCB = ?', [
            $ma_ng_dky
        ]);

        // Nếu loại danh sách không tồn tại
        if (!$loaids) {

            // Xem như đã xóa thành công.
            return true;
        }

        // Ngược lại thực hiện xóa kết quả điểm danh.
        try {
            \DB::delete('DELETE FROM diemdanhcb WHERE MSCB = "'.$ma_ng_dky.'"');

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    // Xóa kết quả điểm danh hoặc đăng ký theo mã số sự kiện
    public static function DeleteDangky_SK($mask)
    {
        // lấy loại danh sách điểm danh từ mã sự kiện.
        $loaids = \DB::select('SELECT MALOAIDS FROM diemdanhcb WHERE MASK = ?', [
            $mask
        ]);
        
        // Nếu loại danh sách không tồn tại
        if (!$loaids) {

            // Xem như đã xóa thành công.
            return true;
        }

        // Ngược lại thực hiện xóa kết quả điểm danh.
        try {
            \DB::delete('DELETE FROM diemdanhcb WHERE MASK = "'.$mask.'"');
            return true;
        } catch (\Exception $e) {
            return false;
            // dd($e->getMessage());
        }
    }

    // Truy xuất danh sách điểm danh cán bộ theo mã sự kiện.
    public static function LayDSDiemDanh($mask)
    {
        $ds_ddanh_cb = \DB::select('select * from diemdanhcb where MASK = ?', [$mask]);
        return $ds_ddanh_cb;
    }
}
