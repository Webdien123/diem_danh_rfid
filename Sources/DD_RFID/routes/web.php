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
Route::get('/', "GetViewController@Home")->name('home');

// Dẫn vào trang đăng nhập.
Route::get('login', "GetViewController@Login");

// Xử lý đăng nhập.
Route::post('login_processing', "LoginController@LoginProcess")->name('login');

// Đăng xuất.
Route::get('logout', "LoginController@LogOut")->name('logout');

// Dẫn vào trang điều khiển của admin.
Route::get('admin', "GetViewController@Admin")->name('admin');

// Dẫn vào trang thống kê điểm danh.
Route::get('chart', "GetViewController@ThongKe")->name('chart');

// Dẫn vào trang Quản Lý sự kiện.
Route::get('event', "EventController@GetPageSK")->name('event');

// Dẫn vào trang Quản Lý sinh viên.
Route::get('student', "SinhVienController@GetPageSV")->name('student');

// Dẫn vào trang Quản Lý cán bộ.
Route::get('staff', "CanBoController@GetPageCB")->name('staff');

// API lấy danh sách bộ môn khi có tên khoa.
Route::get('getBoMon/{tenkhoa}', "CanBoController@GetBoMon");

// API lấy danh sách chuyên ngành khi có tên khoa.
Route::get('getChNganh/{tenkhoa}', "SinhVienController@GetChNganh");

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

// Thêm cán bộ.
Route::post('themSinhVien/', "SinhVienController@ThemSinhVien")->name("AddSV");

// Lấy trang chỉnh sửa sinh viên.
Route::get('student_info/{mssv}', "SinhVienController@CapNhatSinhVien")->name("SV_Info");

// Chỉnh sửa sinh viên.
Route::post('capnhatSinhVien', "SinhVienController@XuLyCapNhat")->name("UpdateSV");

// Xóa sinh viên.
Route::get('xoaSinhVien/{mssv}', "SinhVienController@XoaSinhVien")->name("DeleteSV");

// Tìm kiếm sinh viên.
Route::get('timkiemSinhVien', "SinhVienController@TimSinhVien")->name("FindSV");

// Thêm sự kiện.
Route::post('themSuKien/', "EventController@ThemSuKien")->name("AddSK");

// Lấy trang chỉnh sửa sự kiện.
Route::get('event_info/{mssk}', "EventController@CapNhatSuKien")->name("SV_Info");

// Chỉnh sửa sự kiện.
Route::post('capnhatSuKien', "EventController@XuLyCapNhat")->name("UpdateSK");

// Xóa sự kiện.
Route::get('xoaSuKien/{mssk}', "EventController@XoaSuKien")->name("DeleteSK");

// Tìm kiếm sự kiện.
Route::get('timkiemSuKien', "EventController@TimSuKien")->name("FindSK");

// Import file excel vào CSDL.
Route::post('import_file', "ExcelController@ImportFile")->name("import_file");

// Download file mẫu import.
Route::post('download_file', "ExcelController@DownLoadFile")->name("download_file");

// Dẫn vào trang đang ký thẻ.
Route::get('card', "GetViewController@Card")->name('card');

// Kiểm tra mã thẻ đã quét.
Route::post('test_card', 'CardController@KiemTraDangKy')->name('test_card');

// Lấy trang đăng ký thẻ mới.
Route::post('dangkythemoi', 'CardController@DangKyTheMoi')->name('new_card');

// Cập nhật thẻ cũ.
Route::post('dangkythecu', 'CardController@DangKyTheCu')->name('old_card');

// Trang thông báo lỗi.
Route::get('Error/{mes}/{re}', 'ErrorController@Error')->name('Error');
/*
|--------------------------------------------------------------------------
| Test route
|--------------------------------------------------------------------------
|
| Phần này định nghĩa các route phụ dùng để test thử giao diện
| trong quá trình phát triển phần mềm
|
*/
// Route thử nghiệm
Route::get('abc', function () {
    return view('orther_views.codelab');
});
