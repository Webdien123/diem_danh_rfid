<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\MessageBag;
use App\User;

class LoginController extends Controller
{
    // Lấy trang đăng nhập.
    public function GetLogin()
    {
        return view('login');
    }

    // Xử lý đăng nhập
    public function LoginProcess(Request $user)
    {
        $email = $user->input('email');
        $password = $user->input('pass');

        if( Auth::attempt(['email' => $email, 'password' =>$password])) {
            $name = \DB::select('SELECT name FROM users WHERE email = ?', [$email]);
            $name = $name[0]->name;
            \Session::put('uname', $name);
            return redirect()->route('admin');
        } else {
            \Session::put('err', '1');
            $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function LogOut(Request $request)
    {
        Auth::logout();
        \Session::forget('uname');
        \Session::forget('err');
        return redirect()->route('home');
    }
}
