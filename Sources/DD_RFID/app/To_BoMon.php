<?php
// Lớp định nghĩa model tham chiếu đến bảng To_BoMon
namespace App;

use Illuminate\Database\Eloquent\Model;

class To_BoMon extends Model
{
    // Tên bảng tham chiếu.
    protected $table = 'to_bomon';

    // Tên cột khóa chính.
    protected $primaryKey = 'tenbomon';

    // Tên kiểu khóa chính
    protected $keyType = 'string';

    // Cho phép khóa chính tự tăng hay không.
    public $incrementing = false;

    // Danh sách các cột cố thể điền dữ liệu.
    protected $fillable = ['tenbomon', 'tenkhoa'];

    // Có tự động thêm 2 cột thời gian tạo và 
    // cập nhật gần nhất cho mỗi mẫu tin hay không?
    public $timestamps = false;

    public static function GetBoMon()
    {
        $bomons = \DB::select('select * from to_bomon');
        return $bomons;
    }
}