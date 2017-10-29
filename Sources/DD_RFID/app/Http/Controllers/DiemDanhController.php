<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;
use App\DangKyTheCB;
use App\DangKyTheSV;
use App\DiemDanhCB;
use App\DiemDanhSV;

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
                        'thongdiep' => 'Điểm danh thành công',
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }   
                else {
                    $ketqua = array(
                        'ms_ketqua' => 2,
                        'thongdiep' => 'Có lỗi khi xử lý. Vui lòng thử lại',
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }
            }
            if ($loaids == 3) {
                $ketqua = array(
                    'ms_ketqua' => 3,
                    'thongdiep' => 'Trùng kết quả',
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }
        }
        // Chủ thẻ chưa đăng ký sự kiện.
        else {
            $ketqua = array(
                'ms_ketqua' => 4,
                'thongdiep' => 'Thẻ chưa được đăng ký',
                'loaichuthe' => $loaichuthe,
                'hoten' => $hotenchuthe
            );
        }

        return $ketqua;
    }
}
