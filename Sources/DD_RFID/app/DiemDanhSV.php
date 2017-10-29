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
    public static function CapNhatDSachDDVao($mssv, $mask, $loaids_moi)
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
}
