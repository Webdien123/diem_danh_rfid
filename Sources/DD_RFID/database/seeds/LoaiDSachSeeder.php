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
        
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['01', 'Có mặt']);
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['02', 'Vắng mặt']);
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['03', 'Có vào không ra']);
        DB::insert('insert into loaids (MALOAIDS, TENLOAIDS) values (?, ?)', ['04', 'Có ra không vào']);
    }
}
