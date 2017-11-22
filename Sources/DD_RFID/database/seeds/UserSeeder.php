<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['Trần Quản Trị', 'vanb1305056@student.ctu.edu.vn', bcrypt('123456')]);
    }
}
