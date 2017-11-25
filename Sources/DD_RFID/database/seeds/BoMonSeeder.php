<?php

use Illuminate\Database\Seeder;

class BoMonSeeder extends Seeder
{
    /**
     * Tạo dữ liệu bảng Tổ Bộ Môn
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['--', '--']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Công nghệ thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Hệ thống thông tin', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Khoa học máy tính', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Tin học ứng dụng', 'Công nghệ thông tin và truyền thông']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Văn phòng khoa', 'Công nghệ thông tin và truyền thông']);

        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['PPDH Tiếng Anh', 'Ngoại ngữ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['PPDH Tiếng Pháp', 'Ngoại ngữ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['NN và VH Pháp', 'Ngoại ngữ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['NN và VH Anh', 'Ngoại ngữ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['TIẾNG ANH CB VÀ CN', 'Ngoại ngữ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Văn phòng khoa', 'Ngoại ngữ']);       

        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Kỹ thuật xây dựng', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Kỹ thuật cơ khí', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Quản lý công nghiệp', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Kỹ thuật điện', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Công nghệ hoá học', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Điện tử viễn thông', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Tự động hoá', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['TT Kiểm định & Tư vấn xây dựng', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['TT Nghiên cứu & ƯD Công nghệ', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['T Điện - Điện tử', 'Công nghệ']);
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Văn phòng khoa', 'Công nghệ']);

        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Toán học', 'Khoa học tự nhiên']);       
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Vật lý', 'Khoa học tự nhiên']);       
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Hóa học', 'Khoa học tự nhiên']);       
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Sinh học', 'Khoa học tự nhiên']);       
        DB::insert('insert into to_bomon (TENBOMON, TENKHOA) values (?, ?)', ['Văn phòng khoa', 'Khoa học tự nhiên']);       

    }
}
