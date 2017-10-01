<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetViewController extends Controller
{
    // Hiện trang chủ.
    public function Home()
    {
        return view('home');
    }

    // Hiện trang đăng nhập.
    public function Login()
    {
        if (\Session::has('uname')) {
            return view('login');
        }
        else{
            return view('login');
        }
    }

    // Hiện trang quản trị.
    public function Admin()
    {
        if (\Session::has('uname')) {
            return view('admin');
        }
        else{
            return view('login');
        }
    }

    // Hiện trang thống kê.
    public function ThongKe()
    {
        if (\Session::has('uname')) {
            return view('sub_views.chart');
        }
        else{
            return view('login');
        }
    }

    // Hiện trang sự kiện.
    public function SuKien()
    {
        if (\Session::has('uname')) {
            return view('sub_views.event');
        }
        else{
            return view('login');
        }
    }

    // Hiện trang sinh viên.
    public function SinhVien()
    {
        if (\Session::has('uname')) {
            return view('sub_views.student');
        }
        else{
            return view('login');
        }
    }

    // Hiện trang đăng ký thẻ.
    public function Card()
    {
        if (\Session::has('uname')) {
            return view('sub_views.card');
        }
        else{
            return view('login');
        }
    }
}