<?php
// Lớp định nghĩa các hàm xử lý liên quan đến thẻ trong hệ thống.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DangKyTheCB;
use App\Khoa_Phong;
use App\CanBo;

class CardController extends Controller
{
    // Hàm kiểm tra mã thẻ đã đang ký hay chưa.
    // nếu chưa trả về null, nếu có trả về thông tin chủ thẻ tương ứng.
    public function KiemTraDangKy(Request $mathe)
    {
        // Lấy thông tin cán bộ có mã thẻ tương ứng.
        $canbo = DangKyTheCB::LayThongTinCanBo($mathe->id_the);
        
        // Nếu tồn tại cán bộ đã đăng ký thẻ này
        // thì chuyển sang giao diện hiển thị thông tin chủ thẻ
        if ($canbo) {
            return view('sub_views.sub_2.card_invalid', ['loaithe' => 'Cán bộ', 'chuthe' => $canbo]);
        }
        // Ngược lại hiển thị giao diện sảng sàng đăng ký thẻ.
        else {
            $khoas = Khoa_Phong::GetKhoa();
            return view('sub_views.sub_2.card_valid', [
                'loaithe' => null, 
                'chuthe' => null, 
                'mathe' => $mathe->id_the,
                'khoas' => $khoas
            ]);
        }
    }

    //  Hàm đăng ký thẻ mới.
    public function DangKyTheMoi(Request $R)
    {
        // Nhận kết quả xử lý thêm thông tin chủ thẻ và thêm thông tin thẻ.
        $ketqua_cb = $this->ThemChuThe($R->maso, $R->bomon, $R->khoa, $R->email, $R->hoten);
        $ketqua_the = DangKyTheCB::LuuTheMoi($R->maso, $R->mathe);

        // Tính kết quả tổng hợp
        $ketqua = ($ketqua_cb && $ketqua_the) ? 0 : 1 ;

        // Nếu kết quả đều thành công hiện thị lại giao diện đăng ký thẻ
        // kèm theo thông báo thành công.
        \Session::put('ketqua_dangkythe', $ketqua);
        return redirect('/card/');        
    }

    public function ThemChuThe($maso, $bomon, $khoa, $email, $hoten)
    {
        if (\Session::has('uname')) {
            // Tìm xem có các bộ nào đã có mã số này chưa.
            $maso_tim = CanBo::GetCB($maso);

            // Tìm xem có các bộ nào đã có email này chưa.
            $email_tim = CanBo::GetCB_Email($email);

            // Nếu mã số và email đều chưa có.
            if ($maso_tim == null && $email_tim == null) {

                // Thêm cán bộ vào hệ thống
                $ketqua =  CanBo::AddCB_Para($maso, $bomon, $khoa, $email, $hoten);                

                // Nếu xử lý thành công thì trả về true để xử lý tiếp.
                // ngược lại báo lỗi do xử lý.
                if ($ketqua)
                    return true;
                else
                    return false;
            }
            // Nếu mã số hoặc email đã bị trùng.
            else {
                // Báo lỗi trùng cả email và mã số.
                if ($maso != null && $email != null) {
                    return redirect()->route('Error',
                    ['mes' => 'Thêm cán bộ thất bại', 'reason' => 'Mã số cán bộ và email đã tồn tại']);
                }
                else
                    // Báo lỗi trùng email
                    if ($maso == null) {
                        return redirect()->route('Error',
                        ['mes' => 'Thêm cán bộ thất bại', 'reason' => 'Email đã tồn tại']);
                    }
                    // Báo lỗi trùng mã số.
                    else {
                        return redirect()->route('Error',
                        ['mes' => 'Thêm cán bộ thất bại', 'reason' => 'Mã số cán bộ đã tồn tại']);
                    }
            }
        }
        else{
            return view('login');
        }
    }
}
