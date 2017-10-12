<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    // API lấy tất cả khóa học trong hệ thống.
    public static function LayKhoaHoc()
    {
        $khoahocs = \DB::select(\DB::raw("SELECT * FROM khoahoc"));
        return $khoahocs;
    }
}
