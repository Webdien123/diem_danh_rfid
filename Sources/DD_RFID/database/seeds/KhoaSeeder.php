<?php

use Illuminate\Database\Seeder;

class KhoaSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Khoa
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into khoa (TENKHOA) values (?)', ['Công nghệ thông tin và truyền thông']);        
    }
}
