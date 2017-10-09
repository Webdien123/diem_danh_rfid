<?php
// Lớp định nghĩa model tham chiếu đến bảng CanBo.
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \Symfony\Component\Console\Input\Input;
use \App\Http\Controllers\CanBoController;

class CanBo extends Model
{
    // Tên bảng tham chiếu.
    protected $table = 'CanBo';
    
    // Tên cột khóa chính.
    protected $primaryKey = 'MSCB';

    // Tên kiểu khóa chính.
    protected $keyType = 'string';

    // Cho phép khóa chính tự tăng hay không.
    public $incrementing = false;

    // Danh sách các cột cố thể điền dữ liệu.
    protected $fillable = ["MSCB", "TENBOMON", "TENKHOA", "EMAIL", "HOTEN"];

    // Có tự động thêm 2 cột thời gian tạo và 
    // cập nhật gần nhất cho mỗi mẫu tin hay không?
    public $timestamps = false;

    // Lấy thông tin tất cả cán bộ.
    public static function GetCanBo()
    {
        // Lấy dữ liệu kết hợp phân trang.
        // $canbos = \DB::select('SELECT * FROM canbo LEFT OUTER JOIN dangkythecb on canbo.MSCB = dangkythecb.MSCB_THE');
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
        $canbo = \DB::select('select * from canbo where MSCB = ?', [$mscb]);
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
            \DB::delete('DELETE FROM canbo WHERE MSCB = '.$mscb);
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
