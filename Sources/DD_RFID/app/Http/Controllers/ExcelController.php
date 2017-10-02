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
            
            // Lấy dữ liệu trong file mẫu tại sheet 'dscanbo'.
            $data = Excel::selectSheets('dscanbo')->load($path, function($reader) {})->get();

            // Lấy tên bảng.
            $tenbang = $request->tenBang;

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
                                        2. Id dữ liệu so với id đã có trong hệ thống.<br>
                                        3. Dữ liệu ở hàng báo lỗi có hợp lệ chưa.'
                                ]);
                            }
                        }
                    }
                    // Nếu lấy dữ liệu insert thất bại.
                    else {
                        return redirect()->route('Error', 
                        ['mes' => 'Import cán bộ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
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
    	$headers = ['Content-Type: application/xlsx'];
    	$newName = 'cde-'.'.xlsx';

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
    }

    // Hàm import dòng dữ liệu item vào tên bảng tương ứng.
    public function ImportDuLieu($tenbang, $item)
    {
        if ($tenbang == "canbo") {
            return $this->ImportCanBo($item);
        }
    }

    // Hàm hiển thị lại trang chứa dữ liệu cần import tương ứng
    // với tên bảng dữ liệu.
    public function HienThiKetQua($tenbang)
    {
        if ($tenbang == "canbo") {
            return redirect()->route('staff');
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
                'email' => $value->email
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
            return true; //Trả kết quả import về cho hàm ImportDuLieu.
        } catch (\Exception $e) {
            return false;
        }
    }
    
}
