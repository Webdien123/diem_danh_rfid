<?php
// Lớp định nghĩa model tham chiếu đến bảng CanBo.
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \App\Http\Controllers\CanBoController;

class CanBo extends Model
{
    // Lấy thông tin tất cả cán bộ.
    public static function GetCanBo()
    {
        // Lấy dữ liệu kết hợp phân trang.
        $canbos = \DB::table('canbo')
            ->leftJoin('dangkythecb', 'dangkythecb.mscb_the', '=', 'canbo.mscb')
            ->Paginate(CanBoController::$so_dong);
        return $canbos;
    }

    // Thêm thông tin cán bộ mới.
    public static function AddCB(Request $canbo)
    {
        try {
            \DB::insert('insert into canbo (MSCB, TENBOMON, TENKHOA, EMAIL, HOTEN) values (?, ?, ?, ?, ?)', [
                $canbo->mscb, 
                $canbo->bomon,
                $canbo->khoa,
                $canbo->email,
                $canbo->hoten
            ]);
            return true; //Trả kết quả thêm để controller Cán bộ tiếp tục thực thi.
        } catch (\Exception $e) {
            return false;
        }
    }

    // Thêm thông tin cán bộ từ danh sách tham số.
    public static function AddCB_Para($maso, $bomon, $khoa, $email, $hoten)
    {
        try {
            \DB::insert('insert into canbo (MSCB, TENBOMON, TENKHOA, EMAIL, HOTEN) values (?, ?, ?, ?, ?)', [
                $maso, 
                $bomon,
                $khoa,
                $email,
                $hoten
            ]);
            return true; //Trả kết quả thêm để controller tiếp tục thực thi.
        } catch (\Exception $e) {
            return false;
        }
    }

    // Lấy thông tin của một cán bộ theo mã cán bộ.
    public static function GetCB($mscb)
    {
        $canbo = \DB::select(\DB::raw("SELECT * FROM canbo WHERE MSCB = :v1"), 
            array(
            'v1' => $mscb,
        ));
        if ($canbo) {
            return $canbo;
        } else {
            return null;
        }
    }

    // Lấy thông tin của một cán bộ theo email.
    public static function GetCB_Email($email)
    {
        $canbo = \DB::select('select * from canbo where EMAIL = ?', [$email]);
        if ($canbo) {
            return $canbo;
        } else {
            return null;
        }
    }

    // Cập nhật thông tin cán bộ.
    public static function UpdateCB(Request $canbo)
    {
        // Trả về kết quả của việc thực thi lệnh sql. 
        //(true hoạc false - thành công hoặc thất bại)
        return \DB::statement(
            'UPDATE canbo SET TENBOMON=?, TENKHOA=?, EMAIL=?, HOTEN=?  WHERE MSCB = ?',
            [$canbo->bomon, $canbo->khoa, $canbo->email, $canbo->hoten, $canbo->mscb]
        );
    }

    // Xóa cán bộ.
    public static function DeleteCB($mscb)
    {
        try {
            \DB::delete('DELETE FROM canbo WHERE MSCB = "'.$mscb.'"');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
