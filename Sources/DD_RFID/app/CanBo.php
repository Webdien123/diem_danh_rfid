<?php
// Lớp định nghĩa model tham chiếu đến bảng CanBo
namespace App;

use Illuminate\Database\Eloquent\Model;

class CanBo extends Model
{
    // Tên bảng tham chiếu.
    protected $table = 'CanBo';
    
    // Tên cột khóa chính.
    protected $primaryKey = 'MSCB';

    // Tên kiểu khóa chính
    protected $keyType = 'string';

    // Cho phép khóa chính tự tăng hay không.
    public $incrementing = false;

    // Danh sách các cột cố thể điền dữ liệu.
    protected $fillable = ["MSCB", "TENBOMON", "TENKHOA", "EMAIL", "HOTEN"];

    // Có tự động thêm 2 cột thời gian tạo và 
    // cập nhật gần nhất cho mỗi mẫu tin hay không?
    public $timestamps = false;

    public static function GetCanBo()
    {
        $canbos = \DB::select('select * from canbo');
        return $canbos;
    }
}
