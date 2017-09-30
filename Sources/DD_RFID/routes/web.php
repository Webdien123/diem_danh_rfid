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

// Dẫn vào trang chủ.
Route::get('/', function () {
    return view('home');
})->name('home');

// Dẫn vào trang đăng nhập.
Route::get('login', "LoginController@GetLogin");

// Xử lý đăng nhập.
Route::post('login_processing', "LoginController@LoginProcess")->name('login');

// Đăng xuất.
Route::get('logout', "LoginController@LogOut")->name('logout');

// Dẫn vào trang điều khiển của admin.
Route::get('admin', function() {
    return view('admin');
})->name('admin');

// Dẫn vào trang thống kê điểm danh.
Route::get('chart', function() {
    return view('sub_views.chart');
})->name('chart');

// Dẫn vào trang Quản Lý sự kiện.
Route::get('event', function() {
    return view('sub_views.event');
})->name('event');

// Dẫn vào trang Quản Lý sinh viên.
Route::get('student', function() {
    return view('sub_views.student');
})->name('student');

// Dẫn vào trang Quản Lý cán bộ.
Route::get('staff', "CanBoController@GetPageCB")->name('staff');

// API lấy danh sách bộ môn khi có tên khoa.
Route::get('getBoMon/{tenkhoa}', "CanBoController@GetBoMon");

// Thêm cán bộ.
Route::post('themCanBo/', "CanBoController@ThemCanBo")->name("AddCB");

// Lấy trang chỉnh sửa cán bộ.
Route::get('staff_info/{mscb}', "CanBoController@CapNhatCanBo")->name("CB_Info");

// Chỉnh sửa cán bộ.
Route::post('capnhatCanBo', "CanBoController@XuLyCapNhat")->name("UpdateCB");

// Xóa cán bộ.
Route::get('xoaCanbo/{mscb}', "CanBoController@XoaCanBo")->name("DeleteCB");

// Tìm kiếm cán bộ.
Route::get('timkiemCanBo', "CanBoController@TimCanBo")->name("FindCB");

// Trang thông báo lỗi.
Route::get('Error/{mes}/{re}', 'ErrorController@Error')->name('Error');

// Dẫn vào trang đang ký thẻ.
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

use App\CanBo;

// Route thử nghiệm
Route::get('abc', function () {
    $canbo = CanBo::GetCB_Email("abcs@gmail.com");
    var_dump($canbo);
});
