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
        $canbo = DangKyTheCB::LayThongTinCanBo($mathe->id_the);
        if ($canbo) {
            return view('sub_views.card', ['loaithe' => 'cán bộ', 'chuthe' => $canbo]);
        }
        else {
            return view('sub_views.card', ['loaithe' => null, 'chuthe' => null]);
        }
    }
}
