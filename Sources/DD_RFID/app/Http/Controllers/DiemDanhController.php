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
        $mask = $R->mask;
        WriteLogController::Write_Info("Nhận mã thẻ ".$mathe,"suKien[".$mask."]");

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

    // Kiểm tra mã số của người điểm danh không đăng ký
    // đã có trong hệ thống hay chưa và điểm danh nếu các mã số hợp lệ.
    public function DDanhKhongDangKy(Request $R)
    {
        // Lấy các giá trị trong request.
        $mask = $R->mask;
        $machuthe = $R->machuthe;
        $loaichuthe = $R->chon_cb_sv;
        $mathe = $R->mathe;
        $tthai_dd = $R->tthai_dd;

        // Kiểm tra mã chủ thẻ có bị trùng hay chưa dựa vào loại chủ thẻ.
        if ($loaichuthe == "cán bộ") {
            $chuthe = CanBo::GetCB($machuthe);
        } 
        if ($loaichuthe == "sinh viên") {
            $chuthe = SinhVien::GetSV($machuthe);
        }

        // Nếu chủ thẻ đã tồn tại.
        if ($chuthe) {
            WriteLogController::Write_Info("Điểm danh nặc danh thất bại, ".$loaichuthe." ".$machuthe." đã tồn tại", "suKien[".$mask."]");
            $ketqua = array(
                'mask' => $mask,
                'machuthe' => $machuthe,
                'loaichuthe' => $loaichuthe,
                'ketqua' => 0,
                'noidung' => "Mã số chủ thẻ đã tồn tại"
            );
        } else {

            // Thêm thông tin chủ thẻ vào hệ thống ghi nhận kết quả xử lý.
            if ($loaichuthe == "cán bộ") {
                $ketqua_chuthe = CanBo::AddCB_Para($machuthe, "--", "--", "--", "--");
            }
            if ($loaichuthe == "sinh viên") {
                $ketqua_chuthe = SinhVien::AddSV_Para($machuthe, "--", "--", "--", "--", "--");
            }

            if ($ketqua_chuthe) {
                WriteLogController::Write_Debug("Thêm thông tin nặc danh ".$loaichuthe." ".$machuthe." thành công", "suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Thêm thông tin nặc danh ".$loaichuthe." ".$machuthe." thất bại", "suKien[".$mask."]_Debug");
            }
            
            // Thêm thông tin thẻ vào hệ thống, ghi nhận kết quả xử lý.
            if ($R->chon_cb_sv == "cán bộ") {
                $ketqua_the = DangKyTheCB::LuuTheMoi($machuthe, $mathe);
            }
            if ($R->chon_cb_sv == "sinh viên") {
                $ketqua_the = DangKyTheSV::LuuTheMoi($machuthe, $mathe);
            }

            if ($ketqua_the) {
                WriteLogController::Write_Debug("Đăng ký thẻ nặc danh cho ".$loaichuthe." ".$machuthe." thành công","suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Đăng ký thẻ nặc danh cho ".$loaichuthe." ".$machuthe." thất bại","suKien[".$mask."]_Debug");
            }

            // Đăng ký sự kiện cho người vừa tạo thẻ.
            if ($R->chon_cb_sv == "cán bộ") {
                $ketqua_dky = DiemDanhCB::DangKySuKien($machuthe, $mask);
            }
            if ($R->chon_cb_sv == "sinh viên") {
                $ketqua_dky = DiemDanhSV::DangKySuKien($machuthe, $mask);
            }

            if ($ketqua_dky) {
                WriteLogController::Write_Debug("Đăng ký sự kiện nặc danh cho ".$loaichuthe." ".$machuthe." thành công","suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Đăng ký sự kiện nặc danh cho ".$loaichuthe." ".$machuthe." thất bại","suKien[".$mask."]_Debug");
            }

            // Điểm danh cho chủ thẻ
            if ($loaichuthe == "cán bộ") {
                if ($tthai_dd == 2) {
                    $ketqua_ddanh = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 5);
                }
                if ($tthai_dd == 3) {
                    $ketqua_ddanh = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 6);
                }
            }
            if ($loaichuthe == "sinh viên") {
                if ($tthai_dd == 2) {
                    $ketqua_ddanh = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 5);
                }
                if ($tthai_dd == 3) {
                    $ketqua_ddanh = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 6);
                }
            }

            $ten_dd = ($tthai_dd == 2) ? "vào" : "ra";
            if ($ketqua_ddanh) {
                WriteLogController::Write_Debug("Điểm danh ".$ten_dd." nặc danh cho ".$loaichuthe." ".$machuthe." thành công","suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Điểm danh ".$ten_dd." nặc danh cho ".$loaichuthe." ".$machuthe." thất bại","suKien[".$mask."]_Debug");
            }

            // Tính kết quả tổng hợp
            $kq = ($ketqua_chuthe && $ketqua_the && $ketqua_dky && $ketqua_ddanh) ? 1 : 2 ;

            if ($kq == 1) {
                WriteLogController::Write_Info($mathe." của ".$loaichuthe." ".$machuthe." điểm danh nặc danh thành công","suKien[".$mask."]");
                $ketqua = array(
                    '$ketqua_chuthe' => $ketqua_chuthe,
                    '$ketqua_the' => $ketqua_the,
                    '$ketqua_dky' => $ketqua_dky,
                    '$ketqua_ddanh' => $ketqua_ddanh,
                    'ketqua' => $kq,
                    'noidung' => "Điểm danh thành công"
                );
            } else {
                WriteLogController::Write_Info($mathe." của ".$loaichuthe." ".$machuthe." điểm danh nặc danh thất bại","suKien[".$mask."]");
                $ketqua = array(
                    '$ketqua_chuthe' => $ketqua_chuthe,
                    '$ketqua_the' => $ketqua_the,
                    'ketqua' => $kq,
                    'noidung' => "Có lỗi trong quá trình xử lý, Vui lòng thử lại"
                );
            }            
        }
        return $ketqua;
    }

    // Xử lý điểm danh vào cho một lần quét thẻ.
    public function DiemDanhVao(Request $R)
    {
        // Lấy các giá trị trong request.
        $mathe = $R->mathe;
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
                    $update = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 3);
                }
                if ($loaichuthe == "sinh viên") {
                    $update = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 3);
                }
                if ($update == 1) {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh vào.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 1,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }   
                else {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh vào thất bại.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 2,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }
            }
            if ($loaids == 3 || $loaids == 5) {
                WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh vào nhiều lần.","SuKien[".$mask."]");
                $ketqua = array(
                    'ms_ketqua' => 3,
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }
        }
        // Chủ thẻ chưa đăng ký sự kiện.
        else {
            // Đăng ký sự kiện cho người vừa quét thẻ.
            if ($loaichuthe == "cán bộ") {
                $ketqua_dky = DiemDanhCB::DangKySuKien($machuthe, $mask);
            }
            if ($loaichuthe == "sinh viên") {
                $ketqua_dky = DiemDanhSV::DangKySuKien($machuthe, $mask);
            }

            if ($ketqua_dky) {
                WriteLogController::Write_Debug("Đăng ký sự kiện (chưa đăng ký) cho ".$loaichuthe." ".$machuthe." thành công","suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Đăng ký sự kiện (chưa đăng ký) cho ".$loaichuthe." ".$machuthe." thất bại","suKien[".$mask."]_Debug");
            }

            // Điểm danh cho chủ thẻ
            if ($loaichuthe == "cán bộ") {
                $ketqua_ddanh = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 3); 
            }
            if ($loaichuthe == "sinh viên") {
                $ketqua_ddanh = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 3);
            }

            if ($ketqua_ddanh) {
                WriteLogController::Write_Debug("Điểm danh vào (chưa đăng ký sự kiện) cho ".$loaichuthe." ".$machuthe." thành công","suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Điểm danh vào (chưa đăng ký sự kiện) cho ".$loaichuthe." ".$machuthe." thất bại","suKien[".$mask."]_Debug");
            }

            // Tính kết quả tổng hợp
            $kq = ($ketqua_dky && $ketqua_ddanh) ? 1 : 0 ;

            if ($kq == 1) {
                WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh vào.","SuKien[".$mask."]");
                $ketqua = array(
                    'ms_ketqua' => 1,
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }   
            else {
                WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh vào thất bại.","SuKien[".$mask."]");
                $ketqua = array(
                    'ms_ketqua' => 2,
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }
        }

        return $ketqua;
    }

    // Xử lý điểm danh vào cho một lần quét thẻ.
    public function DiemDanhRa(Request $R)
    {
        // Lấy các giá trị trong request.
        $mathe = $R->mathe;
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
                    $update = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 4);
                }
                if ($loaichuthe == "sinh viên") {
                    $update = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 4);
                }
                if ($update == 1) {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 1,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }   
                else {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra thất bại.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 2,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }
            }

            if ($loaids == 3) {
                if ($loaichuthe == "cán bộ") {
                    $update = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 1);
                }
                if ($loaichuthe == "sinh viên") {
                    $update = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 1);
                }
                if ($update == 1) {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 1,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }   
                else {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra thất bại.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 2,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }
            }

            if ($loaids == 5) {
                if ($loaichuthe == "cán bộ") {
                    $update = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 7);
                }
                if ($loaichuthe == "sinh viên") {
                    $update = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 7);
                }
                if ($update == 1) {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 1,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }   
                else {
                    WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra thất bại.","SuKien[".$mask."]");
                    $ketqua = array(
                        'ms_ketqua' => 2,
                        'loaichuthe' => $loaichuthe,
                        'hoten' => $hotenchuthe
                    );
                }
            }
            if ($loaids == 1 || $loaids == 4 || $loaids == 7 || $loaids == 6) {
                WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra nhiều lần.","SuKien[".$mask."]");
                $ketqua = array(
                    'ms_ketqua' => 3,
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }
        }
        // Chủ thẻ chưa đăng ký sự kiện.
        else {
            // Đăng ký sự kiện cho người vừa tạo thẻ.
            if ($loaichuthe == "cán bộ") {
                $ketqua_dky = DiemDanhCB::DangKySuKien($machuthe, $mask);
            }
            if ($loaichuthe == "sinh viên") {
                $ketqua_dky = DiemDanhSV::DangKySuKien($machuthe, $mask);
            }

            if ($ketqua_dky) {
                WriteLogController::Write_Debug("Đăng ký sự kiện (chưa đăng ký) cho ".$loaichuthe." ".$machuthe." thành công","suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Đăng ký sự kiện (chưa đăng ký) cho ".$loaichuthe." ".$machuthe." thất bại","suKien[".$mask."]_Debug");
            }

            // Điểm danh cho chủ thẻ
            if ($loaichuthe == "cán bộ") {
                $ketqua_ddanh = DiemDanhCB::CapNhatDSachDD($machuthe, $mask, 4); 
            }
            if ($loaichuthe == "sinh viên") {
                $ketqua_ddanh = DiemDanhSV::CapNhatDSachDD($machuthe, $mask, 4);
            }

            if ($ketqua_ddanh) {
                WriteLogController::Write_Debug("Điểm danh vào khi (chưa đăng ký sự kiện trước) cho ".$loaichuthe." ".$machuthe." thành công","suKien[".$mask."]_Debug");
            } else {
                WriteLogController::Write_Debug("Điểm danh vào khi (chưa đăng ký sự kiện trước) cho ".$loaichuthe." ".$machuthe." thất bại","suKien[".$mask."]_Debug");
            }

            // Tính kết quả tổng hợp
            $kq = ($ketqua_dky && $ketqua_ddanh) ? 1 : 0 ;

            if ($kq == 1) {
                WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra.","SuKien[".$mask."]");
                $ketqua = array(
                    'ms_ketqua' => 1,
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }   
            else {
                WriteLogController::Write_Info($mathe. " - chủ thẻ ". $machuthe ." điểm danh ra thất bại.","SuKien[".$mask."]");
                $ketqua = array(
                    'ms_ketqua' => 2,
                    'loaichuthe' => $loaichuthe,
                    'hoten' => $hotenchuthe
                );
            }
        }

        return $ketqua;
    }

    //  Hàm đăng ký thẻ mới trên giao diện điểm danh.
    public function DangKyTheMoi_DDanh(Request $R)
    {
        // Thêm thông tin chủ thẻ vào hệ thống ghi nhận kết quả xử lý.
        $ketqua_chuthe = $this->ThemChuTheDD($R);

        if ($ketqua_chuthe) {
            WriteLogController::Write_Debug("Thêm thông tin ".$R->chon_cb_sv." ".$R->maso." thành công","suKien[".$R->mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Thêm thông tin ".$R->chon_cb_sv." ".$R->maso." thất bại","suKien[".$R->mask."]_Debug");
        }

        // Thêm thông tin thẻ vào hệ thống, ghi nhận kết quả xử lý.
        if ($R->chon_cb_sv == "cán bộ") {
            $ketqua_the = DangKyTheCB::LuuTheMoi($R->maso, $R->mathe);
        }
        if ($R->chon_cb_sv == "sinh viên") {
            $ketqua_the = DangKyTheSV::LuuTheMoi($R->maso, $R->mathe);
        }

        if ($ketqua_the) {
            WriteLogController::Write_Debug("Đăng ký thẻ mới cho ".$R->chon_cb_sv." ".$R->maso." thành công","suKien[".$R->mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Đăng ký thẻ mới cho ".$R->chon_cb_sv." ".$R->maso." thất bại","suKien[".$R->mask."]_Debug");
        }

        // Đăng ký sự kiện cho người vừa tạo thẻ.
        if ($R->chon_cb_sv == "cán bộ") {
            $ketqua_dky = DiemDanhCB::DangKySuKien($R->maso, $R->mask);
        }
        if ($R->chon_cb_sv == "sinh viên") {
            $ketqua_dky = DiemDanhSV::DangKySuKien($R->maso, $R->mask);
        }

        if ($ketqua_dky) {
            WriteLogController::Write_Debug("Đăng ký sự kiện cho ".$R->chon_cb_sv." ".$R->maso." vừa thêm mới vào hệ thống thành công","suKien[".$R->mask."]_Debug");
        } else {
            WriteLogController::Write_Debug("Đăng ký sự kiện cho ".$R->chon_cb_sv." ".$R->maso." vừa thêm mới vào hệ thống thất bại","suKien[".$R->mask."]_Debug");
        }

        // Tính kết quả tổng hợp.
        $ketqua = ($ketqua_chuthe && $ketqua_the && $ketqua_dky) ? 0 : 1 ;

        if ($ketqua == 0) {
            WriteLogController::Write_Info("Đăng ký thẻ ".$R->mathe." và thông tin mới cho ". $R->chon_cb_sv." ".$R->maso." thành công.","SuKien[".$R->mask."]");
        } else {
            WriteLogController::Write_Info("Đăng ký thẻ ".$R->mathe." và thông tin mới cho ". $R->chon_cb_sv." ".$R->maso." thất bại.","SuKien[".$R->mask."]");
        }

        // Nếu kết quả đều thành công hiện thị lại giao diện đăng ký thẻ
        // kèm theo thông báo thành công.
        \Session::put('ketqua_dangkythe_dd', $ketqua);
        return redirect('/');
    }

    public function ThemChuTheDD(Request $R)
    {
        if ($R->chon_cb_sv == "cán bộ") {
            // Nhận kết quả xử lý thêm thông tin chủ thẻ và thêm thông tin thẻ.
            $kq = $this->ThemChuTheCB_DD($R->maso, $R->bomon, $R->khoa, $R->email, $R->hoten, $R->mask);
        }
        if ($R->chon_cb_sv == "sinh viên") {
            $kq = $this->ThemChuTheSV_DD($R->maso, $R->hoten, $R->khoa, $R->chnganh, $R->lop, $R->khoahoc, $R->mask);
        }

        return $kq;
    }

    // Thêm thông tin chủ thẻ mới là cán bộ.
    public function ThemChuTheCB_DD($maso, $bomon, $khoa, $email, $hoten, $mask)
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
            if ($ketqua){
                return true;
            }
                
            else{                
                return false;
            }
        }
        // Nếu mã số hoặc email đã bị trùng.
        else {
            // Báo lỗi trùng cả email và mã số.
            if ($maso != null && $email != null) {
                WriteLogController::Write_Debug("Thêm cán bộ ".$maso." để điểm danh thất bại. Trùng mã số cán bộ và email đã có", "suKien[".$mask."]_Debug");
                return false;
            }
            else
                // Báo lỗi trùng email
                if ($maso == null) {
                    WriteLogController::Write_Debug("Thêm cán bộ ".$maso." để điểm danh thất bại. Trùng email đã có", "suKien[".$mask."]_Debug");
                    return false;
                }
                // Báo lỗi trùng mã số.
                else {
                    WriteLogController::Write_Debug("Thêm cán bộ ".$maso." để điểm danh thất bại. Trùng mã số cán bộ đã có", "suKien[".$mask."]_Debug");
                    return false;
                }
        }
    }

    // Thêm thông tin chủ thẻ mới là sinh viên.
    public function ThemChuTheSV_DD($maso, $hoten, $khoa, $chnganh, $lop, $khoahoc, $mask)
    {
        // Tìm xem có sinh viên nào đã có mã số này chưa.
        $maso_tim = SinhVien::GetSV($maso);

        // Nếu mã số chưa có.
        if ($maso_tim == null) {

            // Thêm sinh viên vào hệ thống
            $ketqua =  SinhVien::AddSV_Para($maso, $hoten, $khoa, $chnganh, $lop, $khoahoc);              

            // Nếu xử lý thành công thì trả về true để xử lý tiếp.
            // ngược lại báo lỗi do xử lý.
            if ($ketqua){
                return true;
            }
            else{
                return false;
            }
        }
        // Nếu mã số đã bị trùng.
        else {
            WriteLogController::Write_Debug("Thêm sinh viên ".$maso." để điểm danh thất bại. Trùng mã số sinh viên đã có", "suKien[".$mask."]_Debug");
            return false;
        }
    }
}