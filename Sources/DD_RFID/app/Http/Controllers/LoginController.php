<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\MessageBag;
use App\User;

class LoginController extends Controller
{
    // Xử lý đăng nhập.
    public function LoginProcess(Request $user)
    {
        // Lấy email và mật khẩu đã nhập.
        $email = $user->input('email');
        $password = $user->input('pass');

        // Nếu thông tin được xác thực đúng.
        if( Auth::attempt(['email' => $email, 'password' =>$password])) {

            // Truy vấn tên người đã đăng nhập lưu vào session.
            $name = \DB::select('SELECT name FROM users WHERE email = ?', [$email]);
            $name = $name[0]->name;
            \Session::put('uname', $name);

            // Reset giá trị các session khác.
            \Session::put('ketqua_up_cb', 2);
            \Session::put('ketqua_up_sv', 2);
            \Session::put('ketqua_dangkythe', 2);
            \Session::put('ketqua_capnhatthe', 2);

            // Chuyển về trang quản trị.
            return redirect()->route('admin');
        } 
        // Ngược lại lưu giá trị lỗi vào session để quay về trang đăng nhập
        // hiển thị cảnh báo cho người dùng.
        else {
            \Session::put('err', '1');
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    // Xử lý đăng xuất.
    public function LogOut(Request $request)
    {
        // Thoát phiên làm việc.
        Auth::logout();

        // Xóa các session của người đăng nhập.
        \Session::forget('uname');
        \Session::forget('err');
        \Session::forget('ketqua_up_cb');
        \Session::forget('ketqua_up_sv');        
        \Session::forget('ketqua_dangkythe');
        
        // Về trang chủ.
        return redirect()->route('home');
    }
}
