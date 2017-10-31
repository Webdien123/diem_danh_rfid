<?php
// Lớp định nghĩa các hàm xử lý việc điểm danh: điểm danh vào, ra, đăng ký thẻ mới.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;
use App\DangKyTheCB;
use App\DangKyTheSV;
use App\DiemDanhCB;
use App\DiemDanhSV;
use App\SinhVien;
use App\CanBo;

class DiemDanhController extends Controller
{
    // Hàm kiểm tra thẻ điểm danh.
    public function KiemTraTheDD(Request $R)
    {
        // Lấy mã thẻ.
        $mathe = $R->id_the;

        // Lấy thông tin cán bộ có mã thẻ tương ứng.
        $canbo = DangKyTheCB::LayThongTinCanBo($mathe);
        
        // Nếu tồn tại cán bộ đã đăng ký thẻ này
        // thì trả về thông tin cán bộ
        if ($canbo) {
            return json_encode($canbo);
        }
        else {

            // Lấy thông tin sinh viên có mã thẻ tương ứng.
            $sv = DangKyTheSV::LayThongTinSinhVien($mathe);
        
            // Nếu tồn tại sinh viên đã đăng ký thẻ này
            // thì trả về thông tin sinh viên
            if ($sv) {
                return json_encode($sv);
            }
    
            // Ngược lại trả về chủ thẻ là null.
            return json_encode(null);
        }
    }

    // Xử lý điểm danh vào cho một lần quét thẻ.
    public function DiemDanhVao(Request $R)
    {
        // Lấy các giá trị trong request.
        $machuthe = $R->machuthe;
        $mask = $R->masukien;
        $loaichuthe = $R->loaichuthe;
        $hotenchuthe = $R->hotenchuthe;

        // Kiểm tra chủ thẻ đã đăng ký sự kiện hay chưa dựa vào loại chủ thẻ.
        if ($loaichuthe == "cán bộ") {
            $loaids = DiemDanhCB::KiemTraDangKy($machuthe, $mask);
        } 
        if ($loaichuthe == "sinh viên") {
            $loaids = DiemDanhSV::KiemTraDangKy($machuthe, $mask);
        }

        // Nếu chủ thẻ đã đăng ký sự kiện.
        if ($loaids != 0) {
            if ($loaids == 2) {

                if ($loaichuthe == "cán bộ") {
                    $update = DiemDanhCB::CapNhatDSachDDVao($machuthe, $mask, 3); 
                }
                if ($loaichuthe == "sinh viên") {
                    $update = DiemDanhSV::CapNhatDSachDDVao($machuthe, $mask, 3);
                }
                if ($update == 1) {
                    $ketqua = array(
                        'ms_ketqua' => 1,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }   
                else {
                    $ketqua = array(
                        'ms_ketqua' => 2,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }
            }
            if ($loaids == 3) {
                $ketqua = array(
                    'ms_ketqua' => 3,
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }
        }
        // Chủ thẻ chưa đăng ký sự kiện.
        else {
            $ketqua = array(
                'ms_ketqua' => 4,
                'loaichuthe' => $loaichuthe,
                'hoten' => $hotenchuthe
            );
        }

        return $ketqua;
    }

    //  Hàm đăng ký thẻ mới trên giao diện điểm danh.
    public function DangKyTheMoi_DDanh(Request $R)
    {
        // Thêm thông tin chủ thẻ vào hệ thống ghi nhận kết quả xử lý.
        $ketqua_chuthe = $this->ThemChuTheDD($R);

        // Thêm thông tin thẻ vào hệ thống, ghi nhận kết quả xử lý.
        if ($R->chon_cb_sv == "cán bộ") {
            $ketqua_the = DangKyTheCB::LuuTheMoi($R->maso, $R->mathe);
        }
        if ($R->chon_cb_sv == "sinh viên") {
            $ketqua_the = DangKyTheSV::LuuTheMoi($R->maso, $R->mathe);
        }

        // Tính kết quả tổng hợp
        $ketqua = ($ketqua_chuthe && $ketqua_the) ? 0 : 1 ;

        // Nếu kết quả đều thành công hiện thị lại giao diện đăng ký thẻ
        // kèm theo thông báo thành công.
        \Session::put('ketqua_dangkythe_dd', $ketqua);
        return redirect('/'); 
    }

    public function ThemChuTheDD(Request $R)
    {
        if ($R->chon_cb_sv == "cán bộ") {
            
            // Nhận kết quả xử lý thêm thông tin chủ thẻ và thêm thông tin thẻ.
            return $this->ThemChuTheCB_DD($R->maso, $R->bomon, $R->khoa, $R->email, $R->hoten);
        }
        if ($R->chon_cb_sv == "sinh viên") {
            return $this->ThemChuTheSV_DD($R->maso, $R->hoten, $R->khoa, $R->chnganh, $R->lop, $R->khoahoc);
        }
    }

    // Thêm thông tin chủ thẻ mới là cán bộ.
    public function ThemChuTheCB_DD($maso, $bomon, $khoa, $email, $hoten)
    {
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
                ['mes' => 'Đang ký thẻ thất bại', 'reason' => 'Mã số cán bộ và email đã tồn tại']);
            }
            else
                // Báo lỗi trùng email
                if ($maso == null) {
                    return redirect()->route('Error',
                    ['mes' => 'Đang ký thẻ thất bại', 'reason' => 'Email đã tồn tại']);
                }
                // Báo lỗi trùng mã số.
                else {
                    return redirect()->route('Error',
                    ['mes' => 'Đang ký thẻ thất bại', 'reason' => 'Mã số cán bộ đã tồn tại']);
                }
        }
    }

    // Thêm thông tin chủ thẻ mới là sinh viên.
    public function ThemChuTheSV_DD($maso, $hoten, $khoa, $chnganh, $lop, $khoahoc)
    {
        // Tìm xem có sinh viên nào đã có mã số này chưa.
        $maso_tim = SinhVien::GetSV($maso);

        // Nếu mã số chưa có.
        if ($maso_tim == null) {

            // Thêm sinh viên vào hệ thống
            $ketqua =  SinhVien::AddSV_Para($maso, $hoten, $khoa, $chnganh, $lop, $khoahoc);              

            // Nếu xử lý thành công thì trả về true để xử lý tiếp.
            // ngược lại báo lỗi do xử lý.
            if ($ketqua)
                return true;
            else
                return false;
        }
        // Nếu mã số đã bị trùng.
        else {
            // Báo lỗi trùng mã số
            return redirect()->route('Error',
            ['mes' => 'Đang ký thẻ thất bại', 'reason' => 'Mã số sinh viên đã tồn tại']);
        }
    }
}
