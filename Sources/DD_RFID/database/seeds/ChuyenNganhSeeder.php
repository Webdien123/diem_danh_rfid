<?php

use Illuminate\Database\Seeder;

class ChuyenNganhSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Chuyên Ngành.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into chuyennganh (TENCHNGANH) values (?)', ['Công nghệ thông tin']);
        DB::insert('insert into chuyennganh (TENCHNGANH) values (?)', ['Công nghệ phần mềm']);
        DB::insert('insert into chuyennganh (TENCHNGANH) values (?)', ['Hệ thống thông tin']);
        DB::insert('insert into chuyennganh (TENCHNGANH) values (?)', ['Mạng máy tính và TT']);
        DB::insert('insert into chuyennganh (TENCHNGANH) values (?)', ['Khoa học máy tính']);
        DB::insert('insert into chuyennganh (TENCHNGANH) values (?)', ['Tin học ứng dụng']);
    }
}