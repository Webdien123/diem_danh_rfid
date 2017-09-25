<?php
// Lớp định nghĩa các hàm xử lý hoặc điều phối trên trang cán bộ.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CanBo;
use App\To_BoMon;
use App\Khoa_Phong;

class CanBoController extends Controller
{
    // Trả về trang các bộ cùng các dữ liệu cần thiết
    public function GetPageCB()
    {
        $canbos = CanBo::GetCanBo();
        $bomons = To_BoMon::GetBoMon();
        // var_dump($canbos);
        return view('sub_views.staff', [
                'canbos' => $canbos, 
                'bomons' => $bomons
        ]);
    }

    // API trả về tên khoa theo bộ môn biết trước
    public function GetKhoa($bomon)
    {
        $tenkhoa = To_BoMon::LayTenKhoa($bomon);
        return json_encode($tenkhoa);
    }

    // Thêm thông tin cán bộ với vào hệ thống
    public function ThemCanBo(Request $canbo)
    {
        CanBo::AddCB($canbo);
        return redirect()->route('staff');
    }
}
