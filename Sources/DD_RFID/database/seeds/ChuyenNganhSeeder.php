<?php

use Illuminate\Database\Seeder;

class ChuyenNganhSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Chuyên Ngành
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['--', '--']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Công nghệ thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Hệ thống thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Khoa học máy tính', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Tin học ứng dụng', 'Công nghệ thông tin và truyền thông']);
    }
}