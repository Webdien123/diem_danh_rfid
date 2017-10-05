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
        
        // DB::insert('insert into thongbao (MALOAITBAO, TIEUDE, NOIDUNG) values (?, ?, ?)', [1, 'Bổ sung cán bộ', '']);   
        
        // DB::insert('insert into dangthongbao (MATBAO, TENNGDANG, SDTNGDANG, EMAILNGDANG) values (?, ?, ?, ?)', [1, 'Nguyễn Văn Heo', '0123456789', 'abc@gmail.com']);
    }
}
