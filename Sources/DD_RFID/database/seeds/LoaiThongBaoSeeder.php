<?php

use Illuminate\Database\Seeder;

class LoaiThongBaoSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Loại Thông Báo
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into loaithongbao (TENLOAITBAO) values (?)', ['Bo sung SV']);
        DB::insert('insert into loaithongbao (TENLOAITBAO) values (?)', ['Bo sung CB']);
    }
}
