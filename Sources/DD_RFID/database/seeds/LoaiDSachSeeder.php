<?php

use Illuminate\Database\Seeder;

class LoaiDSachSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Loại Danh Sách
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into loaids (TENLOAIDS) values (?)', ['Có mặt']);
        DB::insert('insert into loaids (TENLOAIDS) values (?)', ['Vắng mặt']);
        DB::insert('insert into loaids (TENLOAIDS) values (?)', ['Có vào không ra']);
        DB::insert('insert into loaids (TENLOAIDS) values (?)', ['Có ra không vào']);
        DB::insert('insert into loaids (TENLOAIDS) values (?)', ['--']);
    }
}
