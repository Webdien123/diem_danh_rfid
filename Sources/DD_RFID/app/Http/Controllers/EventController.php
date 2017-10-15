<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuKien;

class EventController extends Controller
{
    // Lưu số dòng phân trang cho trang sinh viên.
    public static $so_dong = 5;

    // Hiện trang sự kiện.
    public function GetPageSK()
    {
        if (\Session::has('uname')) {
            $sukiens = SuKien::GetSuKien();
            return view('sub_views.event', [
                'sukiens' => $sukiens
            ]);
        }
        else{
            return view('login');
        }
    }

    // Thêm thông tin sự kiện mới vào hệ thống.
    public function ThemSuKien(Request $sukien)
    {
        if (\Session::has('uname')) {
            // Thêm sự kiện vào hệ thống
            $ketqua =  SuKien::AddSK($sukien);
            
            // Nếu xử lý thành công thì về trang sự kiện
            // ngược lại báo lỗi do xử lý.
            if ($ketqua)
                return redirect()->route('event');
            else
                return redirect()->route('Error',
                ['mes' => 'Thêm sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
        }
        else{
            return view('login');
        }
    }

    // Tìm thông tin sự kiện cần update và hiển thị lên để chỉnh sửa.
    public function CapNhatSuKien($mssk)
    {
        if (\Session::has('uname')) {
            $sukien = SuKien::GetSK($mssk);
            if ($sukien != null) {
                return view('form_views.thongtin_sukien', [
                    'sukien' => $sukien
                ]);
            } else {
                return redirect()->route('Error',
                ['mes' => 'Lấy thông tin sự kiện thất bại', 'reason' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại. Hãy thử lại sau.']);
            }
        }
        else{
            return view('login');
        }
    }

    // Xử lý cập nhật thông tin sự kiện.
    public function XuLyCapNhat(Request $sukien)
    {
        if (\Session::has('uname')) {
            $ketqua = SinhVien::UpdateSV($sukien);
            $ketqua = ($ketqua) ? 0 : 1 ;
            \Session::put('ketqua_up_sk', $ketqua);
            return redirect('/event_info/' . $sukien->mask);
        }
        else{
            return view('login');
        }
    }
}
