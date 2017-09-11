<?php

use Illuminate\Database\Seeder;

class LoaiThongBaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into loaithongbao (MALOAITBAO, TENLOAITBAO) values (?, ?)', ['001', 'Bo sung SV']);
        DB::insert('insert into loaithongbao (MALOAITBAO, TENLOAITBAO) values (?, ?)', ['002', 'Bo sung CB']);
    }
}
