<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuKien;

class GetViewController extends Controller
{
    public function XacThucMayTram()
    {
        return view("xac_thuc");
    }

    // Hiện trang chủ.
    public function Home()
    {
        // Nếu có session tên sự kiện được chọn.
        if (\Session::get('sukien_diemdanh') !== null){
            return EventController::CapNhatSuKienDiemDanh();
        }
        // Nếu không có sự kiện nào được lưu vào cookie
        // thì chuyển sang trang chọn sự kiện để điểm danh.
        else {
            $sukiens = SuKien::GetSuKienSSang();
            return view('chon_sukien', ['sukiens' => $sukiens]);
        }
    }

    // Hiện trang đăng nhập.
    public function Login()
    {
        if (\Session::has('uname')) {
            return redirect()->route('chart');
        }
        else{
            return view('login');
        }
    }

    // Hiện trang đăng ký thẻ.
    public function Card()
    {
        if (\Session::has('uname')) {
            return view('sub_views.card', ['loaithe' => null, 'chuthe' => null]);
        }
        else{
            return view('login');
        }
    }
}
