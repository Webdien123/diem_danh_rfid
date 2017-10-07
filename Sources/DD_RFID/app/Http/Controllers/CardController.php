<?php
// Lớp định nghĩa các hàm xử lý liên quan đến thẻ trong hệ thống.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DangKyTheCB;

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
            return view('sub_views.sub_2.card_valid', [
                'loaithe' => null, 
                'chuthe' => null, 
                'mathe' => $mathe->id_the
            ]);
        }
    }

    //  Hàm đăng ký thẻ mới.
    public function DangKyTheMoi(Request $R)
    {
        echo "Giá trị radio: ".var_dump($R->chon_cb_sv)."</br>";
    }
}
