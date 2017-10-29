<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;
use App\DangKyTheCB;
use App\DangKyTheSV;
use App\DiemDanhCB;

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

        // Kiểm tra chủ thẻ đã đăng ký sự kiện hay chưa dựa vào loại chủ thẻ.
        if ($loaichuthe == "canbo") {
            $loaids = DiemDanhCB::KiemTraDangKy($machuthe, $mask);
        } 
        if ($loaichuthe == "sv") {
            // return DiemDanhSV::KiemTraDangKy($machuthe, $mask);
            ;
        }

        // Nếu chủ thẻ đã đăng ký sự kiện.
        if ($loaids != 0) {
            if ($loaids == 2) {

                if ($loaichuthe == "canbo") {
                    $update = DiemDanhCB::CapNhatDSachDDVao($machuthe, $mask, 3); 
                }
                if ($loaichuthe == "sv") {
                    // return DiemDanhSV::CapNhatDSachDDVao($machuthe, $, 3);
                    ;
                }
                if ($update == 1) {
                    $ketqua = array(
                        'mã sự kiện' => $mask,
                        'mã chủ thẻ' => "Cập nhật thành công",
                        'loại chủ thẻ' => "Rỗng"
                    );
                }   
                else {
                    $ketqua = array(
                        'mã sự kiện' => $mask,
                        'mã chủ thẻ' => "Có lỗi trong xử lý",
                        'loại chủ thẻ' => "Rỗng"
                    );
                }
            }
            if ($loaids == 3) {
                $ketqua = array(
                    'mã sự kiện' => $mask,
                    'mã chủ thẻ' => "Điểm danh bị trùng",
                    'loại chủ thẻ' => "Rỗng"
                );
            }
        }
        // Chủ thẻ chưa đăng ký sự kiện.
        else {
            $ketqua = array(
                'mã sự kiện' => $mask,
                'mã chủ thẻ' => "Chủ thẻ chưa đăng ký sự kiện",
                'loại chủ thẻ' => "Rỗng"
            );
        }

        return $ketqua;
    }
}
