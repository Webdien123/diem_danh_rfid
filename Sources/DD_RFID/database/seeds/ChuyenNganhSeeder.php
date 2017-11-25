<?php

use Illuminate\Database\Seeder;

class ChuyenNganhSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Chuyên Ngành
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['--', '--']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Công nghệ thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Hệ thống thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Khoa học máy tính', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Tin học ứng dụng', 'Công nghệ thông tin và truyền thông']);

        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Sư phạm Tiếng Anh', 'Ngoại ngữ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Sư phạm Tiếng Pháp', 'Ngoại ngữ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Ngôn ngữ Anh', 'Ngoại ngữ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Biên dịch- Phiên dịch tiếng Anh', 'Ngoại ngữ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Ngôn ngữ Pháp', 'Ngoại ngữ']);

        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Xây dựng dân dụng', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Xây dựng công trình thuỷ', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Xây dựng cầu đường', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Cơ khí chế tạo máy', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Cơ khí giao thông', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Cơ khí chế biến', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Quản lý công nghiệp', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Kỹ thuật điện', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Công nghệ hoá học', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Kỹ thuật máy tính', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Điện tử viễn thông', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Kỹ thuật cơ điện tử', 'Công nghệ']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Kỹ thuật điều khiển', 'Công nghệ']);

        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Hóa dược', 'Khoa học tự nhiên']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Hóa học', 'Khoa học tự nhiên']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Hóa học (hóa dược)', 'Khoa học tự nhiên']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Sinh học', 'Khoa học tự nhiên']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Toán ứng dụng', 'Khoa học tự nhiên']);
        DB::insert('insert into chuyennganh (TENCHNGANH, TENKHOA) values (?, ?)', ['Vật lý kỹ thuật', 'Khoa học tự nhiên']);
        
    }
}