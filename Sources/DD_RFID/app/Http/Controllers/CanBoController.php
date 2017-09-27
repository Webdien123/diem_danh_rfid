<?php
// Lớp định nghĩa các hàm xử lý hoặc điều phối trên trang cán bộ.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CanBo;
use App\Khoa_Phong;

class CanBoController extends Controller
{
    // Lưu trữ danh sách khoa trong hệ thống.
    private $khoas;

    public function __construct() {
        $this->khoas = Khoa_Phong::GetKhoa();
    }

    // Trả về trang các bộ cùng các dữ liệu cần thiết.
    public function GetPageCB()
    {
        $canbos = CanBo::GetCanBo();
        return view('sub_views.staff', [
                'canbos' => $canbos, 
                'khoas' => $this->khoas
        ]);
    }

    // API trả về tên các bộ môn theo bộ môn biết trước.
    public function GetBoMon($tenkhoa)
    {
        $bomons = Khoa_Phong::LayBoMon($tenkhoa);
        return json_encode($bomons);
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
            'khoas' => $this->khoas
        ]);
    }

    // Xử lý cập nhật thông tin các bộ.
    public function XuLyCapNhat(Request $canbo)
    {
        $canbo = CanBo::UpdateCB($canbo);
    }
}
