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
Route::get('login', function() {
    return view('login');
})->name('login');

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
Route::get('staff_info/{mscb}', "CanBoController@CapNhatCanBo");

// Chỉnh sửa cán bộ.
Route::post('capnhatCanBo', "CanBoController@XuLyCapNhat")->name("UpdateCB");



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

// Thử hàm lấy tất cả dữ liệu

use App\CanBo;

Route::get('bomon', function() {
    $bm = CanBo::GetCanBo();
    var_dump($bm);
});
