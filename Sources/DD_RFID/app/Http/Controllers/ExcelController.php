<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use App\CanBo;

class ExcelController extends Controller
{
    public function ImportFile(Request $request)
    {
        if(Input::hasFile('im_file')){
			$path = Input::file('im_file')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
			try{
				if(!empty($data) && $data->count()){
                    $insert = $this->TaoDuLieuCB($data);
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
				}
			}
			catch (\Exception $e) {
				return redirect()->route('Error', 
                ['mes' => 'Import cán bộ thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại']);
			}
		}
    }

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
