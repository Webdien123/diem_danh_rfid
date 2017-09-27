<?php
// Lớp định nghĩa model tham chiếu đến bảng CanBo.
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \Symfony\Component\Console\Input\Input;

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
        // Lấy dữ liệu kết hợp phân trang (3 mẫu tin/trang).
        $canbos = \DB::table('canbo')->Paginate(5);
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
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return; // Kết thúc hàm để CanBoCtrl tiếp tục thực hiện.
    }

    // Lấy thông tin của một cán bộ theo mã cán bộ.
    public static function GetCB($mscb)
    {
        $canbo = \DB::select('select * from canbo where MSCB = ?', [$mscb]);
        return $canbo;
    }

    public static function UpdateCB(Request $canbo)
    {
        echo $canbo->mscb." - ".
        $canbo->bomon." - ".
        $canbo->khoa." - ".
        $canbo->email." - ".
        $canbo->hoten;
        // try{
            // \DB::statement(
            //     'UPDATE canbo SET TENBOMON=?, TENKHOA=?, EMAIL=?, HOTEN=?  WHERE MSCB = ?',
            //     [$canbo->bomon, $canbo->khoa, $canbo->email, $canbo->hoten, $canbo->mscb]
            // );
        // }
        // catch (\Exception $e) {
            
        // }
    }
}
