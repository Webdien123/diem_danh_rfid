<?php
// Lớp định nghĩa các hàm xử lý việc nhập xuất file excel.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use App\CanBo;

class ExcelController extends Controller
{
    // Hàm import file excel theo tên bảng vào file dữ liệu cho trước.
    // biến request dùng để nhận tên bảng khi post sang.
    public function ImportFile(Request $request)
    {
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

                        dd($insert);

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
                                        3. Dữ liệu ở hàng báo lỗi có hợp lệ chưa.'
                                ]);
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

    // Hàm download file đã lưu trữ.
    // sử dụng để download file import mẫu.
    public function DownLoadFile(Request $R)
    {
        // Lấy đường dẫn file, cấu hình header cho response và tên file đích.
        $myFile = $R->down_file;
        $headers = ['Content-Type: application/xls'];
        if (strpos ($myFile, 'canbo'))
            $newName = 'Mẫu import cán bộ'.'.xls';
        if (strpos ($myFile, 'sinhvien'))
            $newName = 'Mẫu import sinh viên'.'.xls';
        // Trả về cửa sổ download tương ứng.
    	return response()->download($myFile, $newName, $headers);
    }

    // Hàm tạo dạng dữ liệu có thể lưu trữ vào csdl dựa theo tên bảng và
    // dữ liệu lấy được từ file import.
    public function TaoDuLieu($tenbang, $data)
    {
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

    // Hàm import dòng dữ liệu item vào tên bảng tương ứng.
    public function ImportDuLieu($tenbang, $item)
    {
        if ($tenbang == "canbo") {
            return $this->ImportCanBo($item);
        }
        if ($tenbang == "sinhvien") {
            return $this->ImportSinhVien($item);
        }
    }

    // Hàm hiển thị lại trang chứa dữ liệu cần import tương ứng
    // với tên bảng dữ liệu.
    public function HienThiKetQua($tenbang)
    {
        if ($tenbang == "canbo") {
            return redirect()->route('staff');
        }
        if ($tenbang == "sinhvien") {
            return redirect()->route('student');
        }
    }

    // Hàm tạo dữ liệu cho bảng cán bộ.
    public function TaoDuLieuCB($data)
    {
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

    // Hàm tạo dữ liệu cho bảng sinh viên.
    public function TaoDuLieuSV($data)
    {
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

    // Hàm tạo dữ liệu đăng ký sự kiện.
    public function TaoDuLieuSK($data)
    {
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

    // Hàm import dòng dữ liệu item vào bảng cán bộ.
    public function ImportCanBo($item)
    {
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

    // Hàm import dòng dữ liệu item vào bảng sinh viên.
    public function ImportSinhVien($item)
    {
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
    
}
