<?php
// Lớp định nghĩa các hàm xử lý hoặc điều phối trên trang cán bộ.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CanBo;
use App\To_BoMon;

class CanBoController extends Controller
{
    public $bomons;

    public function __construct() {
        $this->bomons = To_BoMon::GetBoMon();
    }

    // Trả về trang các bộ cùng các dữ liệu cần thiết.
    public function GetPageCB()
    {
        $canbos = CanBo::GetCanBo();
        return view('sub_views.staff', [
                'canbos' => $canbos, 
                'bomons' => $this->bomons
        ]);
    }

    // API trả về tên khoa theo bộ môn biết trước.
    public function GetKhoa($bomon)
    {
        $tenkhoa = To_BoMon::LayTenKhoa($bomon);
        return json_encode($tenkhoa);
    }

    // Thêm thông tin cán bộ với vào hệ thống.
    public function ThemCanBo(Request $canbo)
    {
        CanBo::AddCB($canbo);
        return redirect()->route('staff');
    }

    // Tìm thông tin cán bộ cần update và hiển thị lên để chỉnh sửa.
    public function CapNhatCanBo($mscb)
    {
        $canbo = CanBo::GetCB($mscb);
        return view('form_views.thongtin_canbo', [
            'canbo' => $canbo, 
            'bomons' => $this->bomons
        ]);
    }
}
