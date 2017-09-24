<?php
// Lớp định nghĩa model tham chiếu đến bảng Khoa_Phong
namespace App;

use Illuminate\Database\Eloquent\Model;

class Khoa_Phong extends Model
{
    // Tên bảng tham chiếu.
    protected $table = 'khoa_phong';

    // Tên cột khóa chính.
    protected $primaryKey = 'tenkhoa';

    // Tên kiểu khóa chính
    protected $keyType = 'string';

    // Cho phép khóa chính tự tăng hay không.
    public $incrementing = false;

    // Danh sách các cột cố thể điền dữ liệu.
    protected $fillable = ['tenkhoa'];

    // Có tự động thêm 2 cột thời gian tạo và 
    // cập nhật gần nhất cho mỗi mẫu tin hay không?
    public $timestamps = false;

    public static function GetKhoa()
    {
        $khoas = \DB::select('select * from khoa_phong');
        return $khoas;
    }
}
