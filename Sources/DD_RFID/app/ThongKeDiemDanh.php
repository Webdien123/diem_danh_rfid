<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThongKeDiemDanh extends Model
{
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
}
