<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \App\Http\Controllers\SinhVienController;
use \App\Http\Controllers\WriteLogController;

class SinhVien extends Model
{
    // Lấy thông tin tất cả sinh viên.
    public static function GetSinhVien()
    {
        // Lấy dữ liệu kết hợp phân trang.
        $sinhviens = \DB::table('sinhvien')
            ->leftJoin('dangkythesv', 'dangkythesv.mssv_the', '=', 'sinhvien.mssv')
            ->Paginate(SinhVienController::$so_dong);
        return $sinhviens;
    }

    // Thêm thông tin sinh viên mới.
    public static function AddSV(Request $sinhvien)
    {
        try {
            \DB::insert('insert into sinhvien (MSSV, KYHIEULOP, TENCHNGANH, KHOAHOC, TENKHOA, HOTEN) values (?, ?, ?, ?, ?, ?)', [
                ucwords($sinhvien->mssv), 
                $sinhvien->lop,
                $sinhvien->chnganh,
                $sinhvien->khoahoc,
                $sinhvien->khoa,
                ucwords($sinhvien->hoten)
            ]);
            return true; //Trả kết quả thêm để controller sinh viên tiếp tục thực thi.
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;            
        }
    }

    // Thêm thông tin sinh viên mới từ danh sách tham số.
    public static function AddSV_Para($maso, $hoten, $khoa, $chnganh, $lop, $khoahoc)
    {
        try {
            \DB::insert('insert into sinhvien (MSSV, KYHIEULOP, TENCHNGANH, KHOAHOC, TENKHOA, HOTEN) values (?, ?, ?, ?, ?, ?)', [
                ucwords($maso), 
                $lop,
                $chnganh,
                $khoahoc,
                $khoa,
                ucwords($hoten)
            ]);
            return true; //Trả kết quả thêm để controller sinh viên tiếp tục thực thi.
        } catch (\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }

    // Lấy thông tin của một sinh viên theo mã sinh viên.
    public static function GetSV($mssv)
    {
        $sinhvien = \DB::select(\DB::raw("SELECT * FROM sinhvien WHERE MSSV = :v1"), 
            array(
            'v1' => $mssv,
        ));
        if ($sinhvien) {
            return $sinhvien;
        } else {
            return null;
        }
    }

    // Lấy thông tin của tất cả sinh viên kèm theo mã thẻ.
    public static function GetAllSV_RFID()
    {
        $sinhvien = \DB::select(\DB::raw(
            "SELECT MSSV, HOTEN, TENKHOA, TENCHNGANH, KYHIEULOP, KHOAHOC, MATHE 
                FROM sinhvien, dangkythesv 
                WHERE sinhvien.MSSV = dangkythesv.MSSV_THE"));
        if ($sinhvien) {
            return $sinhvien;
        } else {
            return null;
        }
    }

    // Cập nhật thông tin sinh viên.
    public static function UpdateSV(Request $sinhvien)
    {
        // Trả về kết quả của việc thực thi lệnh sql. 
        //(true hoạc false - thành công hoặc thất bại)
        return \DB::statement(
            'UPDATE sinhvien SET KYHIEULOP = ?, TENCHNGANH = ?, KHOAHOC = ?, TENKHOA = ?, HOTEN = ?
            WHERE MSSV = ?',
            [$sinhvien->lop, $sinhvien->chnganh, $sinhvien->khoahoc, $sinhvien->khoa, $sinhvien->hoten, $sinhvien->mssv]
        );
    }

    // Xóa sinh viên.
    public static function DeleteSV($mssv)
    {
        try {
            \DB::delete('DELETE FROM sinhvien WHERE MSSV = "'.$mssv.'"');
            return true;
        } catch (\Exception $e) {
            return false;
            // dd($e->getMessage());
        }
    }
}
