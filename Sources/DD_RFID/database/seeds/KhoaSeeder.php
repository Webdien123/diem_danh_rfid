<?php

use Illuminate\Database\Seeder;

class KhoaSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Khoa Phòng
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into khoa_phong (TENKHOA) values (?)', ['--']);
        DB::insert('insert into khoa_phong (TENKHOA) values (?)', ['Công nghệ thông tin và truyền thông']);
        DB::insert('insert into khoa_phong (TENKHOA) values (?)', ['Ngoại ngữ']);
        DB::insert('insert into khoa_phong (TENKHOA) values (?)', ['Khoa học tự nhiên']);
    }
}
