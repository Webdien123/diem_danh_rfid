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
        DB::insert('insert into loaithongbao (MALOAITBAO, TENLOAITBAO) values (?, ?)', ['1', 'Bo sung SV']);
        DB::insert('insert into loaithongbao (MALOAITBAO, TENLOAITBAO) values (?, ?)', ['2', 'Bo sung CB']);
    }
}
