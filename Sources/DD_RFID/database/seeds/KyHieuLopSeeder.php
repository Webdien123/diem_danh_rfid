<?php

use Illuminate\Database\Seeder;

class KyHieuLopSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Ký Hiệu Lớp
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['--']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A1']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A2']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A3']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A4']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A5']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A6']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['F1']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['F2']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['F3']);
    }
    
}
