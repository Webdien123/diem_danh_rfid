<?php

use Illuminate\Database\Seeder;

class BoMonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into bomon (TENBOMON) values (?)', ['Công nghệ thông tin']);
        DB::insert('insert into bomon (TENBOMON) values (?)', ['Công nghệ phần mềm']);
        DB::insert('insert into bomon (TENBOMON) values (?)', ['Hệ thống thông tin']);
        DB::insert('insert into bomon (TENBOMON) values (?)', ['Mạng máy tính và TT']);
        DB::insert('insert into bomon (TENBOMON) values (?)', ['Khoa học máy tính']);
        DB::insert('insert into bomon (TENBOMON) values (?)', ['Tin học ứng dụng']);
    }
}
