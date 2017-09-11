<?php

use Illuminate\Database\Seeder;

class LoaiThongBaoSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Loại Thông Báo.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into loaithongbao (MALOAITBAO, TENLOAITBAO) values (?, ?)', ['001', 'Bo sung SV']);
        DB::insert('insert into loaithongbao (MALOAITBAO, TENLOAITBAO) values (?, ?)', ['002', 'Bo sung CB']);
    }
}
