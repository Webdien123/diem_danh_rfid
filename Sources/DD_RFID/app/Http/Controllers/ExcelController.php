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
            
            // Lấy dữ liệu trong file.
            $data = Excel::load($path, function($reader) {})->get();

            // Lấy tên bảng.
            $tenbang = $request->tenBang;

			try{
                // Nếu có dữ liệu trong file cần import.
				if(!empty($data) && $data->count()){

                    // Tạo dữ liệu cần insert tùy theo tên bảng.
                    $insert = $this->TaoDuLieu($tenbang , $data);
                    $sodong = 0;
					if(!empty($insert)){
                        foreach ($insert as $item) {
                            $sodong++;
                            $ketqua = CanBo::AddCB_Data(
                                $item['mscb'], 
                                $item['tenbomon'], 
                                $item['tenkhoa'], 
                                $item['email'], 
                                $item['hoten']
                            );
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
    }

    // Hàm tạo dạng dữ liệu có thể lưu trữ vào csdl dựa theo tên bảng và
    // dữ liệu lấy được từ file import.
    public function TaoDuLieu($tenbang, $data)
    {
        if ($tenbang == "canbo") {
            return $this->TaoDuLieuCB($data);
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
    
    
    
    
    
}
