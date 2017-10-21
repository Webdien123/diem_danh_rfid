<?php
// Lớp định nghĩa các hàm xử lý việc nhập xuất file excel.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\SuKien;


class ExcelController extends Controller
{
    public static $mask_dangki;

    // Hàm import file excel theo tên bảng vào file dữ liệu cho trước.
    // biến request dùng để nhận tên bảng khi post sang.
    public function ImportFile(Request $request)
    {
        if (\Session::has('uname')) {
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
                                    return redirect()->route('Error',[
                                        'mes' => 'Import thất bại tại dòng dữ liệu thứ '.$sodong, 
                                        'reason' => 
                                            'Vui lòng kiếm tra lại các thông tin sau:<br>
                                            1. Tên các cột so với file import mẫu<br>
                                            2. Mã số các dòng trong file có trùng với nhau hoặc trùng với mã số đã có trong hệ thống.<br>
                                            3. Email các dòng trong file có trùng với nhau hoặc trùng với email đã có trong hệ thống.<br>
                                            4. Dữ liệu ở hàng báo lỗi có hợp lệ chưa.
                                            5. Nếu đang đănh ký sự kiện, kiểm tra xem mã số người đăng ký đã có trong hệ thống hay chưa'
                                    ]);
                                }
                                // Nếu thành công và đang đang ký sự kiện thì thay đổi trang thái sự kiện.
                                else {
                                    if ($tenbang == "sukien") {
                                        $ketqua = SuKien::ChuyenTrangThai(self::$mask_dangki, 2);
                                        if (!$ketqua) {
                                            return redirect()->route('Error', 
                                            ['mes' => 'Import thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
                                        }
                                    }
                                }
                            }
                        }
                        // Nếu lấy dữ liệu insert thất bại.
                        else {
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
            // Lấy phần dữ liệu 
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

                if ($item['mathe']) {
                    // Insert dòng dữ liệu vào bảng đăng ký thẻ cán bộ theo giá trị trong mảng item.
                    \DB::insert('insert into dangkythecb (MSCB_THE, MATHE) values (?, ?)', [
                        $item['mscb'],
                        $item['mathe']
                    ]);
                }
                return true; //Trả kết quả import về cho hàm ImportDuLieu.
            } catch (\Exception $e) {
                return false;
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
                if ($item['mathe']) {
                    // Insert dòng dữ liệu vào bảng đăng ký thẻ sv theo giá trị trong mảng item.
                    \DB::insert('insert into dangkythesv (MSSV_THE, MATHE) values (?, ?)', [
                        $item['mssv'],
                        $item['mathe']
                    ]);
                }
                return true; //Trả kết quả import về cho hàm ImportDuLieu.
            } catch (\Exception $e) {
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

                // Nếu số cột là 7 thì tách dữ liệu thêm cho sinh viên đăng ký.
                if ($columns == 7) {

                    // Chèn dữ liệu vào bảng diemdanhsv.
                    foreach ($item as $key => $value) {

                        \DB::insert('insert into diemdanhsv (MSSV, MASK, MALOAIDS) values (?, ?, ?)', [
                            $value['mssv'],
                            self::$mask_dangki,
                            '2'
                        ]);
                    }
                }

                // Nếu số cột là 6 thì tách dữ liệu thêm cho cán bộ đăng ký.
                if ($columns == 6) {

                    // Chèn dữ liệu vào bảng diemdanhcb.
                    foreach ($item as $key => $value) {
                        // dd(var_dump($value['mscb']));
                        \DB::insert('insert into diemdanhcb (MASK, MSCB, MALOAIDS) values (?, ?, ?)', [
                            self::$mask_dangki,
                            $value['mscb'],
                            '2'
                        ]);
                    }
                }
                
                return true;
            }
            catch (\Exception $e){
                return false;
            }
        }
        else{
            return view('login');
        }
    }
    
}
