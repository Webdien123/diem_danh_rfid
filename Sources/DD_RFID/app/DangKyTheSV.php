<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DangKyTheSV extends Model
{
    // Hàm lấy thông tin sinh viên đã đăng ký từ mã thẻ.
    public static function LayThongTinSinhVien($mathe)
    {
        // Truy xuất mã số sinh viên.
        $mssv = \DB::select('select MSSV_THE from dangkythesv where MATHE = ?', [$mathe]);
        if (!$mssv) {
            $mssv = null;
        }

        // Nếu mã số sinh viên có tồn tại.
        if ($mssv) {

            // Lấy thông tin sinh viên rồi trả về giá trị tương ứng.
            $canbo = SinhVien::GetSV($mssv[0]->MSSV_THE);
            return $canbo;
        }
        // Nếu mã số chưa có trả về giao diện thẻ hợp lệ để sẳn sàng đăng ký.
        return null;
    }

    // Lưu thông tin thẻ đăng ký
    public static function LuuTheMoi($machuthe, $mathe)
    {
        try {
            \DB::insert('insert into dangkythesv (MSSV_THE, MATHE) values (?, ?)', [
                $machuthe,
                $mathe
            ]);
            return true; //Trả kết quả thêm để controller Thẻ tiếp tục thực thi.
        } catch (\Exception $e) {
            return false;
        }
    }

    // Xóa thẻ đã đăng ký.
    public static function DeleteThe($machuthe)
    {
        // Truy xuất mã thẻ đã có từ mã sinh viên.
        $mathe = \DB::select('select MATHE from dangkythesv where MSSV_THE = ?', [$machuthe]);

        // Nếu chủ thẻ chưa có mã thẻ nào
        if (!$mathe) {
            // Xem như đã xóa thành công.
            return true;
        }
        // Ngược lại thực hiện xóa thẻ. 
        try {
            \DB::delete('DELETE FROM dangkythesv WHERE MSSV_THE = '.$machuthe);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
