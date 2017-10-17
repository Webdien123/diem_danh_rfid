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

    // Cập nhật thông tin sự kiện.
    public static function UpdateSK(Request $sukien)
    {
        // Trả về kết quả của việc thực thi lệnh sql. 
        //(true hoạc false - thành công hoặc thất bại)
        return \DB::statement(
            'UPDATE sukien SET TENSK = ?, NGTHUCHIEN = ?, DIADIEM = ?, DDVAO = ?, DDRA = ?
            WHERE MASK = ?',
            [
                $sukien->tensk,
                $sukien->ngthuchien,
                $sukien->diadiem,
                $sukien->ddvao,
                $sukien->ddra,
                $sukien->mask                
            ]
        );
    }

    // Xóa sự kiện.
    public static function DeleteSV($mssk)
    {
        try {
            \DB::delete('DELETE FROM sukien WHERE MASK = ?',[$mssk]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    // API Lấy danh sách sự kiện sẳn sàng điểm danh
    public static function GetSuKienSSang()
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $today = date("Y-m-d");
        $time = date("H:i:s");
        $sukiens = \DB::select(\DB::raw("SELECT * FROM sukien WHERE NGTHUCHIEN = :v1
        AND DDVAO >= :v2"),
            array(
            'v1' => $today,
            'v2' => $time
        ));
        return $sukiens;
    }
}
