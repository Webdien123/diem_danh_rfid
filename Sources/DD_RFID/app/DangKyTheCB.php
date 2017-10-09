<?php
// Lớp định nghĩa model tham chiếu đến bảng DangKyTheCB.
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CanBo;

class DangKyTheCB extends Model
{
    // Tên bảng tham chiếu.
    protected $table = 'dangkythecb';
    
    // Tên cột khóa chính.
    protected $primaryKey = ['MSCB', 'MATHE'];

    // Tên kiểu khóa chính.
    protected $keyType = 'string';

    // Cho phép khóa chính tự tăng hay không.
    public $incrementing = false;

    // Danh sách các cột cố thể điền dữ liệu.
    protected $fillable = ['MSCB_THE', 'MATHE'];

    // Có tự động thêm 2 cột thời gian tạo và 
    // cập nhật gần nhất cho mỗi mẫu tin hay không?
    public $timestamps = false;

    // Hàm lấy thông tin cán bộ đã đăng ký từ mã thẻ.
    public static function LayThongTinCanBo($mathe)
    {
        // Truy xuất mã thẻ cần tìm để lấy mã số cán bộ.
        $mscb = \DB::select('select MSCB_THE from dangkythecb where MATHE = ?', [$mathe]);
        if (!$mscb) {
            $mscb = null;
        }
        // Nếu mã số cán bộ có tồn tại.
        if ($mscb) {

            // Lấy thông tin cán bộ rồi trả về giá trị tương ứng.
            $canbo = CanBo::GetCB($mscb[0]->MSCB_THE);
            return $canbo;
        }

        // Nếu mã số chưa có trả về giao diện thẻ hợp lệ để sẳn sàng đăng ký.
        return null;
    }

    // Lưu thông tin thẻ đăng ký
    public static function LuuTheMoi($machuthe, $mathe)
    {
        try {
            \DB::insert('insert into dangkythecb (MSCB_THE, MATHE) values (?, ?)', [
                $machuthe,
                $mathe
            ]);
            return true; //Trả kết quả thêm để controller Thẻ tiếp tục thực thi.
        } catch (\Exception $e) {
            return false;
        }
    }

    public function LayMaThe(Type $var = null)
    {
        # code...
    }
}
