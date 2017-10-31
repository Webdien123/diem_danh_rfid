<?php

use Illuminate\Database\Seeder;

class KhoaHocSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Khóa Học
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['--']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K35']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K36']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K37']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K38']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K39']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K40']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K41']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K42']);
        DB::insert('insert into khoahoc (KHOAHOC) values (?)', ['K43']);
    }
}
