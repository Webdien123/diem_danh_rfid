<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DangKyTheSV extends Model
{
    // Hàm lấy thông tin sinh viên đã đăng ký từ mã thẻ.
    public static function LayThongTinSinhVien($mathe)
    {
        // Truy xuất mã số sinh viên.
        $mssv = \DB::select(\DB::raw("SELECT MSSV_THE FROM dangkythesv WHERE MATHE = :v1"), 
            array(
            'v1' => $mathe,
        ));
        
        if (!$mssv) {
            $mssv = null;
        }

        // Nếu mã số sinh viên có tồn tại.
        if ($mssv) {

            // Lấy thông tin sinh viên rồi trả về giá trị tương ứng.
            $sv = SinhVien::GetSV($mssv[0]->MSSV_THE);
            return $sv;
        }
    }

    // Lấy thông tin thẻ từ mã số chủ thẻ
    public static function LayThongTinThe($machuthe)
    {
        // Truy xuất mã thẻ của mã chủ thẻ.
        $mathe = \DB::select('select MATHE from dangkythesv where MSSV_THE = ?', [$machuthe]);
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
            \DB::insert('insert into dangkythesv (MSSV_THE, MATHE) values (?, ?)', [
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
            "UPDATE dangkythesv SET MATHE=? WHERE MSSV_THE = ?",
            [$mathe, $machuthe]
        );
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
            \DB::delete('DELETE FROM dangkythesv WHERE MSSV_THE = ?', [$machuthe]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
