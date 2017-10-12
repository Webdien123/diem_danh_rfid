<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \App\Http\Controllers\SinhVienController;

class SinhVien extends Model
{
    // Tên bảng tham chiếu.
    protected $table = 'sinhvien';
    
    // Tên cột khóa chính.
    protected $primaryKey = 'MSSV';

    // Tên kiểu khóa chính.
    protected $keyType = 'string';

    // Cho phép khóa chính tự tăng hay không.
    public $incrementing = false;

    // Danh sách các cột cố thể điền dữ liệu.
    protected $fillable = ["MSSV", "KYHIEULOP", "TENCHNGANH", "KHOAHOC", "TENKHOA", "HOTEN"];

    // Có tự động thêm 2 cột thời gian tạo và 
    // cập nhật gần nhất cho mỗi mẫu tin hay không?
    public $timestamps = false;

    // Lấy thông tin tất cả cán bộ.
    public static function GetSinhVien()
    {
        // Lấy dữ liệu kết hợp phân trang.
        $canbos = \DB::table('sinhvien')
            ->leftJoin('dangkythesv', 'dangkythesv.mssv_the', '=', 'sinhvien.mssv')
            ->Paginate(SinhVienController::$so_dong);
        return $canbos;
    }
}
