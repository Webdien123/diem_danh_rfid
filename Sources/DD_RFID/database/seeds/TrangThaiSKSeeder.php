<?php

use Illuminate\Database\Seeder;

class TrangThaiSKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into trangthaisk (MATTHAI, GHICHU) values (?, ?)', [1, 'Đã tạo, chưa đăng ký']);
        DB::insert('insert into trangthaisk (MATTHAI, GHICHU) values (?, ?)', [2, 'Đang chờ điểm danh']);
        DB::insert('insert into trangthaisk (MATTHAI, GHICHU) values (?, ?)', [3, 'Đang điểm danh']);
        DB::insert('insert into trangthaisk (MATTHAI, GHICHU) values (?, ?)', [4, 'Hoàn thành điểm danh']);
    }
}
