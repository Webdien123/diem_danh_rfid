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
        
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['1', 'Có mặt']);
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['2', 'Vắng mặt']);
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['3', 'Có vào không ra']);
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['4', 'Có ra không vào']);
    }
}
