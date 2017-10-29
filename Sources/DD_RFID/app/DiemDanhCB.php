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
    public static function CapNhatDSachDDVao($mscb, $mask, $loaids_moi)
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
}
