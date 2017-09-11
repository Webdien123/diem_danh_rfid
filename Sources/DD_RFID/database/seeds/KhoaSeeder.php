<?php

use Illuminate\Database\Seeder;

class KhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into khoa (TENKHOA) values (?)', ['Công nghệ thông tin và truyền thông']);        
    }
}
