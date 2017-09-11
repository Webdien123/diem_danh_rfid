<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(KyHieuLopSeeder::class);
        $this->call(KhoaHocSeeder::class);
        $this->call(LoaiThongBaoSeeder::class);
        $this->call(ChuyenNganhSeeder::class);
        $this->call(KhoaSeeder::class);        
        $this->call(LoaiDSachSeeder::class);        
        $this->call(BoMonSeeder::class);        
    }
}
