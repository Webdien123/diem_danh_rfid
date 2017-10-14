<?php
// Lớp định nghĩa các hàm xử lý liên quan đến thẻ trong hệ thống.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DangKyTheCB;
use App\Khoa_Phong;
use App\CanBo;
use App\SinhVien;
use App\DangKyTheSV;
use App\KyHieuLop;
use App\KhoaHoc;

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

        // Lấy thông tin sinh viên có mã thẻ tương ứng.
        $sv = DangKyTheSV::LayThongTinSinhVien($mathe->id_the);

        // Nếu tồn tại sinh viên đã đăng ký thẻ này
        // thì chuyển sang giao diện hiển thị thông tin chủ thẻ
        if ($sv) {
            return view('sub_views.sub_2.card_invalid', ['loaithe' => 'Sinh viên', 'chuthe' => $sv]);
        }

        // Ngược lại hiển thị giao diện sản sàng đăng ký thẻ.
        else {
            $khoas = Khoa_Phong::GetKhoa();
            $lops = KyHieuLop::LayKyHieuLop();
            $khoahocs = KhoaHoc::LayKhoaHoc();
            return view('sub_views.sub_2.card_valid', [
                'loaithe' => null, 
                'chuthe' => null, 
                'mathe' => $mathe->id_the,
                'khoas' => $khoas,
                'lops' => $lops,
                'khoahocs' => $khoahocs
            ]);
        }
    }

    //  Hàm đăng ký thẻ mới.
    public function DangKyTheMoi(Request $R)
    {
        // Thêm thông tin chủ thẻ vào hệ thống ghi nhận kết quả xử lý.
        $ketqua_chuthe = $this->ThemChuThe($R);

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
        \Session::put('ketqua_dangkythe', $ketqua);
        return redirect('/card/');   
    }

    public function ThemChuThe(Request $R)
    {
        if ($R->chon_cb_sv == "cán bộ") {
            
            // Nhận kết quả xử lý thêm thông tin chủ thẻ và thêm thông tin thẻ.
            return $this->ThemChuTheCB($R->maso, $R->bomon, $R->khoa, $R->email, $R->hoten);
        }
        if ($R->chon_cb_sv == "sinh viên") {
            return $this->ThemChuTheSV($R->maso, $R->hoten, $R->khoa, $R->chnganh, $R->lop, $R->khoahoc);
        }
    }

    // Thêm thông tin chủ thẻ mới là cán bộ.
    public function ThemChuTheCB($maso, $bomon, $khoa, $email, $hoten)
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
        else{
            return view('login');
        }
    }

    // Thêm thông tin chủ thẻ mới là sinh viên.
    public function ThemChuTheSV($maso, $hoten, $khoa, $chnganh, $lop, $khoahoc)
    {
        if (\Session::has('uname')) {
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
        else{
            return view('login');
        }
    }

    // Kiểm tra xem mã thẻ có thể sử dụng được không.
    public static function CheckThe($mathe)
    {
        // Lấy thông tin cán bộ có mã thẻ tương ứng.
        $canbo = DangKyTheCB::LayThongTinCanBo($mathe);
        
        // Nếu tồn tại cán bộ đã đăng ký thẻ này
        // thì thẻ không thẻ sử dụng.
        if ($canbo) {
            return 1;
        }

        // Lấy thông tin sinh viên có mã thẻ tương ứng.
        $sv = DangKyTheSV::LayThongTinSinhVien($mathe);
        
        // Nếu tồn tại sinh viên đã đăng ký thẻ này
        // thì thẻ không thẻ sử dụng.
        if ($sv) {
            return 2;
        }

        // Ngược lại thì thẻ có thể sử dụng.
        return 0;
    }

    // Hàm cập nhật mã thẻ cũ.
    public function DangKyTheCu(Request $R)
    {
        // ===============================================
        // PHẦN KIỂM TRA MÃ THẺ
        // ===============================================

        // Kiểm tra mã thẻ có thể sử dụng hay không.
        $kiemtra = self::CheckThe($R->mathe);
        
        // Nếu thẻ không thể dùng được vì có cán bộ sở hữu.
        if ($kiemtra == 1) {
            // Lấy thông tin cán bộ có mã thẻ tương ứng.
            $canbo = DangKyTheCB::LayThongTinCanBo($R->mathe);
            return view('sub_views.sub_2.card_invalid', ['loaithe' => 'Cán bộ', 'chuthe' => $canbo]);
        }

        // Nếu thẻ không thể dùng được vì có sinh viên sở hữu.
        if ($kiemtra == 2) {
            // Lấy thông tin sinh viên có mã thẻ tương ứng.
            $sv = DangKyTheCB::LayThongTinCanBo($R->mathe);
            return view('sub_views.sub_2.card_invalid', ['loaithe' => 'Sinh viên', 'chuthe' => $sv]);
        }
        // ==================================================

        // ==================================================
        // PHẦN KIỂM TRA MÃ CHỦ THẺ
        // ==================================================

        // Kiểm tra mã chủ thẻ có thuộc mã cán bộ trong hệ thống?
        $chuthe_cb = CanBo::GetCB($R->machuthe);

        // Kiểm tra mã chủ thẻ có thuộc mã sinh viên trong hệ thống?
        $chuthe_sv = SinhVien::GetSV($R->machuthe);

        // Nếu chủ thẻ là cán bộ hoặc sv đã có thông tin trong hệ thống
        // thì thực hiện cập nhật thẻ.
        if ($chuthe_cb || $chuthe_sv) {
            if ($chuthe_cb) {
                return $this->XuLyTheCu_CB($R->machuthe, $R->mathe, $R->trang);
            } else {
                return $this->XuLyTheCu_SV($R->machuthe, $R->mathe, $R->trang);
            }
            
        }
        // Ngược lại báo lỗi mã chủ thẻ không tồn tại.
        else {
            return redirect()->route('Error', 
            ['mes' => 'Cập nhật thẻ thất bại', 'reason' => 'Mã chủ thẻ không tồn tại']);
        }
        // ==================================================

        
    }

    public function XuLyTheCu_CB($machuthe, $mathe, $trang)
    {
        // Tìm xem chủ thẻ đã có mã thẻ nào chưa.
        $the_cb = DangKyTheCB::LayThongTinThe($machuthe);

        // Lưu kết quả xử lý.
        $ketqua;
        
        // Nếu chủ thẻ là cán bộ và đã có thẻ cũ.
        if ($the_cb) {
            // Cập nhật thẻ cũ cho cán bộ.
            $ketqua = DangKyTheCB::UpdateThe($machuthe, $mathe);
        }
        // Ngược lại thêm mã cán bộ và mã thẻ vào bảng đăng ký.
        else {
            $ketqua = DangKyTheCB::LuuTheMoi($machuthe, $mathe);
        }
        
        // Xử lý thành công.
        if ($ketqua) {
            $ketqua = ($ketqua) ? 0 : 1 ;
            \Session::put('ketqua_capnhatthe', $ketqua);
            if ($trang == "the") {
                return redirect('/card/');  
            }
            if ($trang == "canbo") {
                return redirect('/staff/');
            }
            
        }
        // Xử lý thất bại.
        else {
            return redirect()->route('Error', 
            ['mes' => 'Cập nhật thẻ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
        }
    }

    public function XuLyTheCu_SV($machuthe, $mathe, $trang)
    {
        // Tìm xem chủ thẻ đã có mã thẻ nào chưa.
        $the_sv = DangKyTheSV::LayThongTinThe($machuthe);

        // Lưu kết quả xử lý.
        $ketqua;
        
        // Nếu chủ thẻ là cán bộ và đã có thẻ cũ.
        if ($the_sv) {
            // Cập nhật thẻ cũ cho cán bộ.
            $ketqua = DangKyTheSV::UpdateThe($machuthe, $mathe);
        }
        // Ngược lại thêm mã cán bộ và mã thẻ vào bảng đăng ký.
        else {
            $ketqua = DangKyTheSV::LuuTheMoi($machuthe, $mathe);
        }
        
        // Xử lý thành công.
        if ($ketqua) {
            $ketqua = ($ketqua) ? 0 : 1 ;
            \Session::put('ketqua_capnhatthe', $ketqua);
            if ($trang == "the") {
                return redirect('/card/');  
            }
            if ($trang == "sinhvien") {
                return redirect('/student/');
            }
            
        }
        // Xử lý thất bại.
        else {
            return redirect()->route('Error', 
            ['mes' => 'Cập nhật thẻ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
        }
    }
}
