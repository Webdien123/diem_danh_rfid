<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dẫn vào trang chủ
Route::get('/', function () {
    return view('home');
})->name('home');

// Dẫn vào trang đăng nhập
Route::get('login', function() {
    return view('login');
})->name('login');

// Dẫn vào trang điều khiển của admin
Route::get('admin', function() {
    return view('admin');
})->name('admin');

// Dẫn vào trang thống kê điểm danh
Route::get('chart', function() {
    return view('sub_views.chart');
})->name('chart');

// Dẫn vào trang Quản Lý sự kiện
Route::get('event', function() {
    return view('sub_views.event');
})->name('event');

// Dẫn vào trang Quản Lý sinh viên
Route::get('student', function() {
    return view('sub_views.student');
})->name('student');

// Dẫn vào trang Quản Lý cán bộ
Route::get('staff', function() {
    return view('sub_views.staff');
})->name('staff');


Route::get('card', function() {
    return view('sub_views.card');
})->name('card');

/*
|--------------------------------------------------------------------------
| Test route
|--------------------------------------------------------------------------
|
| Phần này định nghĩa các route phụ dùng để test thử giao diện
| trong quá trình phát triển phần mềm
|
*/

// Thử blade template
Route::get('blade', function () {
    return view('orther_views.s');
});

// Thử giao diện đa tab
Route::get('tabs', function() {
    return view('orther_views.tabs');
});

// Thử menu thông báo
Route::get('no_menu', function() {
    return view('orther_views.notification_menu');
});

// Thử giao diện text autosize
Route::get('text', function() {
    return view('orther_views.responsive_text');
});