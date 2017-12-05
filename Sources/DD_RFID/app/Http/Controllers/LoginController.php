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

        // Lấy thông tin tài khoản theo email
        $taikhoan = User::LayThongTinTK($email);

        // Nếu tài khoản không tồn tại
        if ($taikhoan == null) {
            WriteLogController::Write_Alert("Đăng nhập sai email", "Admin");
            \Session::put('err', '1');
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        
        // Nếu xác thực mật khẩu đúng
        if (User::KiemTraTaiKhoan($password, $taikhoan[0]->password)) {

            $name = $taikhoan[0]->name;
            \Session::put('uname', $name);

            // Reset giá trị các session khác.
            \Session::put('ketqua_up_cb', 2);
            \Session::put('ketqua_up_sv', 2);
            \Session::put('ketqua_up_sk', 2);
            \Session::put('ketqua_dangkythe', 2);
            \Session::put('ketqua_dangkythe_dd', 2);
            \Session::put('ketqua_capnhatthe', 2);

            WriteLogController::Write_InFo("Quản trị viên ".$name." đăng nhập vào hệ thống", "Admin");
            
            // Chuyển về trang quản trị.
            return redirect()->route('admin');        
        } else {
            WriteLogController::Write_Alert("Đăng nhập sai mật khẩu", "Admin");
            \Session::put('err', '1');
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    // Xử lý đăng xuất.
    public function LogOut(Request $request)
    {
        $name = \Session::get('uname');
        WriteLogController::Write_InFo($name." đăng xuất khỏi hệ thống");

        // Xóa các session của người đăng nhập.
        \Session::forget('uname');
        \Session::forget('err');
        \Session::forget('ketqua_up_cb');
        \Session::forget('ketqua_up_sv');        
        \Session::forget('ketqua_up_sk');        
        \Session::forget('ketqua_dangkythe');
        
        // Về trang chủ.
        return redirect()->route('home');
    }
}
