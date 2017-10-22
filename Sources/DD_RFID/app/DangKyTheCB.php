<?php
// Lớp định nghĩa model tham chiếu đến bảng DangKyTheCB.
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CanBo;

class DangKyTheCB extends Model
{
    // Hàm lấy thông tin cán bộ đã đăng ký từ mã thẻ.
    public static function LayThongTinCanBo($mathe)
    {
        // Truy xuất mã số cán bộ.
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

    // Lấy thông tin thẻ từ mã số chủ thẻ
    public static function LayThongTinThe($machuthe)
    {
        // Truy xuất mã thẻ của mã chủ thẻ.
        $mathe = \DB::select('select MATHE from dangkythecb where MSCB_THE = ?', [$machuthe]);
        // Nếu mã thẻ có tồn tại.
        if ($mathe) {
            return true;
        }
        return false;
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

    // Cập nhật thông tin thẻ đã lưu.
    public static function UpdateThe($machuthe, $mathe)
    {
        // Trả về kết quả của việc thực thi lệnh sql. 
        //(true hoạc false - thành công hoặc thất bại)
        return \DB::statement(
            "UPDATE dangkythecb SET MATHE=? WHERE MSCB_THE = ?",
            [$mathe, $machuthe]
        );
    }

    // Xóa thẻ đã đăng ký.
    public static function DeleteThe($machuthe)
    {
        // Truy xuất mã thẻ đã có từ mã cán bộ.
        $mathe = \DB::select('select MATHE from dangkythecb where MSCB_THE = ?', [$machuthe]);

        // Nếu chủ thẻ chưa có mã thẻ nào
        if (!$mathe) {
            // Xem như đã xóa thành công.
            return true;
        }
        // Ngược lại thực hiện xóa thẻ.
        try {
            \DB::delete('DELETE FROM dangkythecb WHERE MSCB_THE = '.$machuthe);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
