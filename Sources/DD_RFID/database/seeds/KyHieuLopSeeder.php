<?php

use Illuminate\Database\Seeder;

class KyHieuLopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A1']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A2']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A3']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A4']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A5']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A6']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A7']);
        DB::insert('insert into kyhieulop (KYHIEULOP) values (?)', ['A8']);
    }
    
}
