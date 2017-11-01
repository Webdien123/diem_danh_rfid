<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KyHieuLop extends Model
{
    // API lấy tất cả ký hiệu lớp trong hệ thống.
    public static function LayKyHieuLop()
    {
        $chnganhs = \DB::select(\DB::raw("SELECT * FROM kyhieulop WHERE kyhieulop != '--'"));
        return $chnganhs;
    }
}
