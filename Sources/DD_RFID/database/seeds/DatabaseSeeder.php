<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Tạo dữ liệu cho tất cả các bảng có kể tên trong hàm run
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LoaiThongBaoSeeder::class);
        $this->call(KyHieuLopSeeder::class);
        $this->call(KhoaHocSeeder::class);
        $this->call(KhoaSeeder::class);      
        $this->call(ChuyenNganhSeeder::class);
        $this->call(BoMonSeeder::class);   
        $this->call(LoaiDSachSeeder::class);
        $this->call(DangKyTheCBSeeder::class);
    }
}
