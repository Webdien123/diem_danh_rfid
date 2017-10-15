<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \App\Http\Controllers\EventController;

class SuKien extends Model
{
    // Lấy thông tin tất cả sự kiện và phân trang.
    public static function GetSuKien()
    {
        // Lấy dữ liệu kết hợp phân trang.
        $sukiens = \DB::table('sukien')
        ->Paginate(EventController::$so_dong);
        return $sukiens;
    }

    // Thêm thông tin sự kiện mới.
    public static function AddSK(Request $sukien)
    {
        try {
            \DB::insert('insert into sukien (TENSK, NGTHUCHIEN, DIADIEM, DDVAO, DDRA) values (?, ?, ?, ?, ?)', [
                $sukien->tensk,
                $sukien->ngthuchien,
                $sukien->diadiem,
                $sukien->ddvao,
                $sukien->ddra
            ]);
            return true; //Trả kết quả thêm để controller sự kiện tiếp tục thực thi.
        } catch (\Exception $e) {
            return false;
        }
    }

    // Lấy thông tin của một sự kiện theo mã sự kiện.
    public static function GetSK($mssk)
    {
        $sukien = \DB::select('select * from sukien where MASK = ?', [$mssk]);
        if ($sukien) {
            return $sukien;
        } else {
            return null;
        }
    }
}
