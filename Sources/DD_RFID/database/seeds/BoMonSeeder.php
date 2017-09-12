<?php

use Illuminate\Database\Seeder;

class BoMonSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Bộ Môn
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into bomon (TENBOMON, TENKHOA) values (?, ?)', ['Công nghệ thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into bomon (TENBOMON, TENKHOA) values (?, ?)', ['Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into bomon (TENBOMON, TENKHOA) values (?, ?)', ['Hệ thống thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into bomon (TENBOMON, TENKHOA) values (?, ?)', ['Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into bomon (TENBOMON, TENKHOA) values (?, ?)', ['Khoa học máy tính', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into bomon (TENBOMON, TENKHOA) values (?, ?)', ['Tin học ứng dụng', 'Công nghệ thông tin và truyền thông']);
    }
}