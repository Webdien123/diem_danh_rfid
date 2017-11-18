<?php
// Lớp định nghĩa các hàm xử lý việc nhập xuất file excel.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\SuKien;
use App\ThongKeDiemDanh;
use App\SinhVien;
use App\CanBo;

class ExcelController extends Controller
{
    public static $mask_dangki;

    // Hàm import file excel theo tên bảng vào file dữ liệu cho trước.
    // biến request dùng để nhận tên bảng khi post sang.
    public function ImportFile(Request $request)
    {
        if (\Session::has('uname')) {

            $name = \Session::get('uname');

            // Nếu phần file đã được chọn.
            if(Input::hasFile('im_file')){
                
                // Lấy đường dẫn của file.
                $path = Input::file('im_file')->getRealPath();
                
                // Lấy tên bảng.
                $tenbang = $request->tenBang;            

                if ($tenbang == "sinhvien") {

                    // Lấy dữ liệu trong file mẫu tại sheet 'dssinhvien'.
                    $data = Excel::selectSheets('dssinhvien')->load($path, function($reader) {})->get();
                }
                if ($tenbang == "canbo") {
                    // Lấy dữ liệu trong file mẫu tại sheet 'dscanbo'.
                    $data = Excel::selectSheets('dscanbo')->load($path, function($reader) {})->get();
                }
                if ($tenbang == "sukien") {

                    // Lấy giá trị của mã sự kiện cần đăng ký.
                    self::$mask_dangki = $request->mask_dangki;

                    // Lấy dữ liệu trong file mẫu tại sheet 'dssinhvien', 'dscanbo'.
                    $data = Excel::selectSheets('dssinhvien', 'dscanbo')->load($path, function($reader) {})->get();
                }
                
                try{
                    // Nếu có dữ liệu trong file cần import.
                    if(!empty($data) && $data->count()){

                        // Tạo dữ liệu cần insert tùy theo tên bảng.
                        $insert = $this->TaoDuLieu($tenbang , $data);                    

                        // Tính số thứ tự dòng đang import
                        $sodong = 0;

                        // Nếu dữ liệu cần insert được tạo thành công.
                        if(!empty($insert)){

                            // Với mỗi dòng dữ liệu cần insert.
                            foreach ($insert as $item) {

                                // Đếm lại số thứ tự dòng.
                                $sodong++;

                                // Insert dòng dữ liệu vào bảng tương ứng.
                                $ketqua = $this->ImportDuLieu($tenbang , $item);

                                // Nếu thực thi không thành công thì hiển thị trang báo lỗi
                                // để người dùng xem lại dữ liệu trong file.
                                if (!$ketqua) {
                                    if ($tenbang == "sukien") {
                                        WriteLogController::Write_Debug("Có lỗi khi import sự kiện ".self::$mask_dangki." ở sheet thứ ".$sodong);
                                        return redirect()->route('Error',[
                                            'mes' => 'Import thất bại tại sheet thứ '.$sodong, 
                                            'reason' => 
                                                'Vui lòng kiếm tra lại các thông tin sau:<br>
                                                1. Tên các cột so với file import mẫu<br>
                                                2. Mã số các dòng trong file có trùng với nhau hoặc trùng với mã số đã có trong hệ thống.<br>
                                                3. Email các dòng trong file có trùng với nhau hoặc trùng với email đã có trong hệ thống.<br>
                                                4. Dữ liệu ở hàng báo lỗi có hợp lệ chưa.<br>
                                                5. Kiểm tra xem mã số người đăng ký đã có trong hệ thống hay chưa'
                                        ]);
                                    }
                                    if ($tenbang == "sinhvien") {
                                        WriteLogController::Write_Debug("Có lỗi khi import sinh viên ".self::$mask_dangki." ở dòng thứ ".$sodong);
                                    }
                                    if ($tenbang == "canbo") {
                                        WriteLogController::Write_Debug("Có lỗi khi import cán bộ ".self::$mask_dangki." ở dòng thứ ".$sodong);
                                    }
                                    return redirect()->route('Error',[
                                        'mes' => 'Import thất bại tại dòng dữ liệu thứ '.$sodong, 
                                        'reason' => 
                                            'Vui lòng kiếm tra lại các thông tin sau:<br>
                                            1. Tên các cột so với file import mẫu<br>
                                            2. Mã số các dòng trong file có trùng với nhau hoặc trùng với mã số đã có trong hệ thống.<br>
                                            3. Email các dòng trong file có trùng với nhau hoặc trùng với email đã có trong hệ thống.<br>
                                            4. Dữ liệu ở hàng báo lỗi có hợp lệ chưa.<br>'                                            
                                    ]);
                                }
                                // Nếu thành công và đang đang ký sự kiện thì thay đổi trang thái sự kiện.
                                else {
                                    if ($tenbang == "sukien") {
                                        $ketqua = SuKien::ChuyenTrangThai(self::$mask_dangki, 2);
                                        if (!$ketqua) {
                                            WriteLogController::Write_Debug("Có lỗi khi chuyển trạng thái sự kiện ".self::$mask_dangki." sau khi đăng ký");
                                            return redirect()->route('Error', 
                                            ['mes' => 'Import thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
                                        }
                                    }
                                }
                            }
                        }
                        // Nếu lấy dữ liệu insert thất bại.
                        else {
                            WriteLogController::Write_Debug("Có lỗi khi đang tạo dữ liệu insert");
                            return redirect()->route('Error', 
                            ['mes' => 'Import thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
                        }
                    }
                }
                catch (\Exception $e) {
                    return redirect()->route('Error', 
                    ['mes' => 'Import cán bộ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
                }
            }
            // Hiển thị về trang kết quả chứa dữ liệu cần import.
            return $this->HienThiKetQua($tenbang);
        }
        else{
            return view('login');
        }
    }

    // Hàm export dữ liệu bảng cán bộ hoặc sinh viên dùng đê backup dữ liệu.
    public function ExportTable($tenbang, $type)
    {
        $ten_sheet;
        if (\Session::has('uname')) {
            $name = \Session::get('uname');

            if ($tenbang == "sv") {
                
                $sinhvien = SinhVien::GetAllSV_RFID();
                if ($sinhvien) {
                    $tenfile = "Danh sách sinh viên";
                    $data = self::ChuyenVeArray($sinhvien);

                    WriteLogController::Write_InFo($name." export danh sách sinh viên");

                    return Excel::create($tenfile, function($excel) use ($data) {
                        $excel->sheet("dssinhvien", function($sheet) use ($data)
                        {
                            $sheet->fromArray($data);
                        });
                    })->download("xls");
                } else {
                    WriteLogController::Write_InFo($name." export danh sách sinh viên thất bại, không có dữ liệu xuất ra");

                    return redirect()->route('Error', 
                    ['mes' => 'Export thất bại', 'reason' => 'Không có dữ liệu để xuất ra']);
                }
            }
            if ($tenbang == "cb") {
                $canbo = CanBo::GetAllCB_RFID(); 
                if ($canbo) {
                    $ten_sheet = "dscanbo";
                    $tenfile = "Danh sách cán bộ";
                    $data = self::ChuyenVeArray($canbo);

                    WriteLogController::Write_InFo($name." export danh sách cán bộ");

                    return Excel::create($tenfile, function($excel) use ($data) {
                        $excel->sheet("dscanbo", function($sheet) use ($data)
                        {
                            $sheet->fromArray($data);
                        });
                    })->download("xls");
                } else {
                    WriteLogController::Write_InFo($name." export danh sách cán bộ thất bại, không có dữ liệu xuất ra");

                    return redirect()->route('Error', 
                    ['mes' => 'Export thất bại', 'reason' => 'Không có dữ liệu để xuất ra']);
                }
            }
            return redirect()->route('Error', 
            ['mes' => 'Export thất bại', 'reason' => 'Có lỗi trong quá trình xử lý']);
        }
        else{
            return view('login');
        }
    }

    // Hàm export dữ liệu danh sách điểm danh.
    public function ExportDSach($mask, $tends, $type)
    {
        if (\Session::has('uname')) {
            $name = \Session::get('uname');

            // Lấy loại chủ danh sách là cán bộ hay sinh viên
            $loai_chu_ds = substr($tends, 0, 2);

            // Tính lại tên ngắn gọn cho tên danh sách và
            // Tính lại tên danh sách tương ứng ở modal thống kê
            $tends = substr($tends, 3);
            $tends = trim($tends, " ");

            WriteLogController::Write_InFo($name." export danh sách $loai_chu_ds $tends cho sự kiện $mask");

            // Tính tên file cần chuyển.
            $tenfile = self::TinhTenFileDS($loai_chu_ds, $tends, $mask);

            // Tinh tên danh sách cần chuyển.
            $tends = self::TinhTenLoaiDS($tends);

            // Lấy danh sách điểm danh tương ứng với loại chủ danh sách,
            // mã sự kiện và tên danh sách.
            if ($loai_chu_ds == "cb") {
                $data = ThongKeDiemDanh::LayDS_CB($mask, $tends);
            }
            if ($loai_chu_ds == "sv") {
                $data = ThongKeDiemDanh::LayDS_SV($mask, $tends);
            }

            if ($data) {
                $data = self::ChuyenVeArray($data);

                return Excel::create($tenfile, function($excel) use ($data) {
                    $excel->sheet('diemdanh', function($sheet) use ($data)
                    {
                        $sheet->fromArray($data);
                    });
                })->download("xls");
            } else {
                return redirect()->route('Error', 
                ['mes' => 'Export thất bại', 'reason' => 'Không có dữ liệu để xuất ra']);
            }
        }
        else{
            return view('login');
        } 
    }

    // Hàm tính toán lại tên loại danh sách để khớp với hàm Lấy danh sách của
    // modal thống kê điểm danh.
    public static function TinhTenLoaiDS($ten_ban_dau)
    {
        if (\Session::has('uname')) {
            if ($ten_ban_dau == "vang_mat") {
                return "vangmat";
            }
            if ($ten_ban_dau == "co_mat") {
                return "comat";
            }
            if ($ten_ban_dau == "co_v_k_ra") {
                return "covaokra";
            }
            if ($ten_ban_dau == "co_ra_k_v") {
                return "corakvao";
            }
            if ($ten_ban_dau == "chua_co_ttin") {
                return "chuattin";
            }
        }
        else{
            return view('login');
        } 
    }

    // Hàm tính toán lại tên file danh sách xuất ra theo chủ loại danh sách 
    // và danh sách điểm danh.
    public static function TinhTenFileDS($loai_chu_ds, $ten_ds, $mask)
    {
        if (\Session::has('uname')) {
            if ($loai_chu_ds == "cb") {
                $ten_chu = "cán bộ";
            }
            if ($loai_chu_ds == "sv") {
                $ten_chu = "sinh viên";
            }

            if ($ten_ds == "vang_mat") {
                $ten_dsach = "vắng mặt";
            }
            if ($ten_ds == "co_mat") {
                $ten_dsach = "có mặt";
            }
            if ($ten_ds == "co_v_k_ra") {
                $ten_dsach = "chỉ điểm danh vào";
            }
            if ($ten_ds == "co_ra_k_v") {
                $ten_dsach = "chỉ điểm danh ra";
            }
            if ($ten_ds == "chua_co_ttin") {
                $ten_dsach = "chưa đủ thông tin";
            }

            return $ten_chu . " " . $ten_dsach . " sự kiện " . $mask;
        }
        else{
            return view('login');
        } 
    }

    // Hàm chuyển mảng data về mảng 2 chiều và xóa đi các cột không cần thiết.
    public static function ChuyenVeArray($data)
    {
        if (\Session::has('uname')) {
            $data_array;

            // Chuyển sang mảng hai chiều và xóa cột Mã sự kiện, mã loại danh sách
            for ($i = 0; $i < count($data); $i++) { 
                $data_array[] = (array) $data[$i];
                unset($data_array[$i]["MASK"]);
                unset($data_array[$i]["MALOAIDS"]);
                
            }
            return $data_array;
        }
        else{
            return view('login');
        } 
    }

    // Hàm tạo dạng dữ liệu có thể lưu trữ vào csdl dựa theo tên bảng và
    // dữ liệu lấy được từ file import.
    public function TaoDuLieu($tenbang, $data)
    {
        if (\Session::has('uname')) {
            if ($tenbang == "canbo") {
                return $this->TaoDuLieuCB($data);
            }
            if ($tenbang == "sinhvien") {
                return $this->TaoDuLieuSV($data);
            }
            if ($tenbang == "sukien") {
                return $this->TaoDuLieuSK($data);
            }
        }
        else{
            return view('login');
        }   
    }

    // Hàm import dòng dữ liệu item vào tên bảng tương ứng.
    public function ImportDuLieu($tenbang, $item)
    {
        if (\Session::has('uname')) {
            if ($tenbang == "canbo") {
                return $this->ImportCanBo($item);
            }
            if ($tenbang == "sinhvien") {
                return $this->ImportSinhVien($item);
            }
            if ($tenbang == "sukien") {
                return $this->ImportSuKien($item);
            }
        }
        else{
            return view('login');
        }
    }

    // Hàm hiển thị lại trang chứa dữ liệu cần import tương ứng
    // với tên bảng dữ liệu.
    public function HienThiKetQua($tenbang)
    {
        if (\Session::has('uname')) {
            if ($tenbang == "canbo") {
                return redirect()->route('staff');
            }
            if ($tenbang == "sinhvien") {
                return redirect()->route('student');
            }
            if ($tenbang == "sukien") {
                return redirect()->route('event');
            }
        }
        else{
            return view('login');
        }
    }

    // Hàm tạo dữ liệu cho bảng cán bộ.
    public function TaoDuLieuCB($data)
    {
        if (\Session::has('uname')) {
            foreach ($data as $key => $value) {
                $insert[] = [
                    'mscb' => $value->mscb, 
                    'hoten' => $value->hoten,
                    'tenbomon' => $value->tenbomon,
                    'tenkhoa' => $value->tenkhoa,
                    'email' => $value->email,
                    'mathe' => $value->mathe
                ];
            }
            return $insert;
        }
        else{
            return view('login');
        }
    }

    // Hàm tạo dữ liệu cho bảng sinh viên.
    public function TaoDuLieuSV($data)
    {
        if (\Session::has('uname')) {
            foreach ($data as $key => $value) {
                $insert[] = [
                    'mssv' => $value->mssv,
                    'lop' => $value->kyhieulop,
                    'chnganh' => $value->tenchnganh,
                    'khoahoc' => $value->khoahoc,
                    'khoa' => $value->tenkhoa,
                    'hoten' => $value->hoten,
                    'mathe' => $value->mathe
                ];
            }
            return $insert;
        }
        else{
            return view('login');
        }
    }

    // Hàm tạo dữ liệu đăng ký sự kiện.
    public function TaoDuLieuSK($data)
    {
        if (\Session::has('uname')) {
            // Lấy phần dữ liệu sheet sinh viên
            foreach ($data[0] as $key => $value) {
                $insert[0][] = [
                    'mssv' => $value->mssv,
                    'lop' => $value->kyhieulop,
                    'chnganh' => $value->tenchnganh,
                    'khoahoc' => $value->khoahoc,
                    'khoa' => $value->tenkhoa,
                    'hoten' => $value->hoten,
                    'mathe' => $value->mathe
                ];
            }

            // Lấy phần dữ liệu sheet cán bộ
            foreach ($data[1] as $key => $value) {
                $insert[1][] = [
                    'mscb' => $value->mscb, 
                    'hoten' => $value->hoten,
                    'tenbomon' => $value->tenbomon,
                    'tenkhoa' => $value->tenkhoa,
                    'email' => $value->email,
                    'mathe' => $value->mathe
                ];
            }
            return $insert;
        }
        else{
            return view('login');
        }
    }

    // Hàm import dòng dữ liệu item vào bảng cán bộ.
    public function ImportCanBo($item)
    {
        if (\Session::has('uname')) {
            try {
                // Insert dòng dữ liệu vào bảng cán bộ theo giá trị trong mảng item.
                \DB::insert('insert into canbo (MSCB, TENBOMON, TENKHOA, EMAIL, HOTEN) values (?, ?, ?, ?, ?)', [
                    $item['mscb'], 
                    $item['tenbomon'], 
                    $item['tenkhoa'], 
                    $item['email'], 
                    $item['hoten']
                ]);

                WriteLogController::Write_Debug("Đã import cán bộ ".$item['mscb'], "Admin_Debug");

                if ($item['mathe'] != null) {
                    // Insert dòng dữ liệu vào bảng đăng ký thẻ cán bộ theo giá trị trong mảng item.
                    \DB::insert('insert into dangkythecb (MSCB_THE, MATHE) values (?, ?)', [
                        $item['mscb'],
                        $item['mathe']
                    ]);

                    WriteLogController::Write_Debug("Đã import thẻ ". $item['mathe'] ." cho cán bộ ".$item['mscb'], "Admin_Debug");
                }
                return true; //Trả kết quả import về cho hàm ImportDuLieu.
            } catch (\Exception $e) {
                WriteLogController::Write_Debug("Import cán bộ ".$item['mscb']." thất bại", "Admin_Debug");
                return false;
                // dd($e->getMessage());
            }
        }
        else{
            return view('login');
        }
    }

    // Hàm import dòng dữ liệu item vào bảng sinh viên.
    public function ImportSinhVien($item)
    {
        if (\Session::has('uname')) {
            try {
                // Insert dòng dữ liệu vào bảng sinh viên theo giá trị trong mảng item.
                \DB::insert('insert into sinhvien (MSSV, KYHIEULOP, TENCHNGANH, KHOAHOC, TENKHOA, HOTEN) values (?, ?, ?, ?, ?, ?)', [
                    $item['mssv'], 
                    $item['lop'],
                    $item['chnganh'],
                    $item['khoahoc'],
                    $item['khoa'],
                    $item['hoten']
                ]);

                WriteLogController::Write_Debug("Đã import sinh viên ".$item['mssv'], "Admin_Debug");

                if ($item['mathe']) {
                    // Insert dòng dữ liệu vào bảng đăng ký thẻ sv theo giá trị trong mảng item.
                    \DB::insert('insert into dangkythesv (MSSV_THE, MATHE) values (?, ?)', [
                        $item['mssv'],
                        $item['mathe']
                    ]);

                    WriteLogController::Write_Debug("Đã import thẻ ". $item['mathe'] ." cho sinh viên ".$item['mssv'], "Admin_Debug");
                }
                return true; //Trả kết quả import về cho hàm ImportDuLieu.
            } catch (\Exception $e) {
                WriteLogController::Write_Debug("Import sinh viên ".$item['mssv']." thất bại", "Admin_Debug");
                return false;
            }
        }
        else{
            return view('login');
        }
    }

    // Hàm import dữ liệu đăng ký sự kiện.
    public function ImportSuKien($item)
    {
        if (\Session::has('uname')) {
            try{
                $columns = count(current($item));

                $key = array_keys($item[0]);

                // Nếu số cột đầu tiên tên là mssv thì thêm cho sinh viên đăng ký.
                if ($key[0] == "mssv") {

                    // Chèn dữ liệu vào bảng diemdanhsv.
                    foreach ($item as $key => $value) {
                        \DB::insert('insert into diemdanhsv (MSSV, MASK, MALOAIDS) values (?, ?, ?)', [
                            $value['mssv'],
                            self::$mask_dangki,
                            '2'
                        ]);

                        WriteLogController::Write_Debug("Đã đăng kí sự kiện cho sinh viên ".$value['mssv'], "Admin_Debug");
                        
                    }
                }

                // Nếu số cột đầu tiên tên là mscb thì thêm cho sinh viên đăng ký.
                if ($key[0] == "mscb") {

                    // Chèn dữ liệu vào bảng diemdanhcb.
                    foreach ($item as $key => $value) {
                        \DB::insert('insert into diemdanhcb (MASK, MSCB, MALOAIDS) values (?, ?, ?)', [
                            self::$mask_dangki,
                            $value['mscb'],
                            '2'
                        ]);

                        WriteLogController::Write_Debug("Đã đăng kí sự kiện cho cán bộ ".$value['mscb'], "Admin_Debug");
                    }
                }
                return true;
            }
            catch (\Exception $e){
                WriteLogController::Write_Debug("Đã đăng kí sự kiện ". self::$mask_dangki ." thất bại", "Admin_Debug");
                return false;
                // dd($e->getMessage());
            }
        }
        else{
            return view('login');
        }
    }
    
}
