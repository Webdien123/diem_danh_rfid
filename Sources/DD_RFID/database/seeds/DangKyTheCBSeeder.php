<?php

use Illuminate\Database\Seeder;

class DangKyTheCBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into dangkythecb (MSCB_THE, MATHE) values (?, ?)', ['00123464', '123']);   
    }
}
