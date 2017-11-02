-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2017 at 10:43 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dd_rfid`
--

-- --------------------------------------------------------

--
-- Table structure for table `canbo`
--

CREATE TABLE `canbo` (
  `MSCB` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENBOMON` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--',
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--',
  `EMAIL` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--',
  `HOTEN` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `canbo`
--

INSERT INTO `canbo` (`MSCB`, `TENBOMON`, `TENKHOA`, `EMAIL`, `HOTEN`) VALUES
('00123456', 'Hệ thống thông tin', 'Công nghệ thông tin và truyền thông', 'vana@gmail.com', 'Nguyễn Ân Hiên'),
('00123457', 'Công nghệ thông tin', 'Công nghệ thông tin và truyền thông', 'vanb@gmail.com', 'Trần Văn Bình'),
('00123458', 'Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông', 'pchuy@gmail.com', 'Phan Công Huy'),
('00123459', 'Khoa học máy tính', 'Công nghệ thông tin và truyền thông', 'hau@hotmail.com', 'Lê Thị Hậu'),
('00123460', 'Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông', 'chin@email.com', 'Nguyễn Chín'),
('00123461', 'Công nghệ thông tin', 'Công nghệ thông tin và truyền thông', 'cong@outlook.com', 'Lê Thành Công'),
('00123462', 'Tin học ứng dụng', 'Công nghệ thông tin và truyền thông', 'Ptin@gmail.com.vn', 'Phương Tín'),
('00123463', 'Tin học ứng dụng', 'Công nghệ thông tin và truyền thông', 'ldcuong@gmail.com', 'Lâm Định Cương'),
('00123464', 'Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông', 'nguyenmaiat@gmail.com', 'Mai Ất Nguyên'),
('00123465', 'Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông', 'thangthang@gmail.com.vn', 'Phạm Thắng'),
('00123466', 'Hệ thống thông tin', 'Công nghệ thông tin và truyền thông', 'tkien@yahoo.com.vn', 'Trương Tuấn Kiên'),
('00123467', 'Hệ thống thông tin', 'Công nghệ thông tin và truyền thông', 'phungquan@gmail.com.vn', 'Đinh Phùng Quân');

-- --------------------------------------------------------

--
-- Table structure for table `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `TENCHNGANH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`TENCHNGANH`, `TENKHOA`) VALUES
('--', '--'),
('Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông'),
('Công nghệ thông tin', 'Công nghệ thông tin và truyền thông'),
('Hệ thống thông tin', 'Công nghệ thông tin và truyền thông'),
('Khoa học máy tính', 'Công nghệ thông tin và truyền thông'),
('Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông'),
('Tin học ứng dụng', 'Công nghệ thông tin và truyền thông');

-- --------------------------------------------------------

--
-- Table structure for table `dangkythecb`
--

CREATE TABLE `dangkythecb` (
  `MSCB_THE` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MATHE` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `dangkythecb`
--

INSERT INTO `dangkythecb` (`MSCB_THE`, `MATHE`) VALUES
('00123456', '0005706269');

-- --------------------------------------------------------

--
-- Table structure for table `dangkythesv`
--

CREATE TABLE `dangkythesv` (
  `MSSV_THE` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MATHE` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `dangkythesv`
--

INSERT INTO `dangkythesv` (`MSSV_THE`, `MATHE`) VALUES
('B1500003', '0001352398'),
('B1700001', '0000958866'),
('B1700002', '0000958819');

-- --------------------------------------------------------

--
-- Table structure for table `diemdanhcb`
--

CREATE TABLE `diemdanhcb` (
  `MASK` int(11) NOT NULL,
  `MSCB` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MALOAIDS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diemdanhsv`
--

CREATE TABLE `diemdanhsv` (
  `MSSV` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MASK` int(11) NOT NULL,
  `MALOAIDS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoahoc`
--

CREATE TABLE `khoahoc` (
  `KHOAHOC` char(3) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khoahoc`
--

INSERT INTO `khoahoc` (`KHOAHOC`) VALUES
('--'),
('K35'),
('K36'),
('K37'),
('K38'),
('K39'),
('K40'),
('K41'),
('K42'),
('K43');

-- --------------------------------------------------------

--
-- Table structure for table `khoa_phong`
--

CREATE TABLE `khoa_phong` (
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khoa_phong`
--

INSERT INTO `khoa_phong` (`TENKHOA`) VALUES
('--'),
('Công nghệ thông tin và truyền thông');

-- --------------------------------------------------------

--
-- Table structure for table `kyhieulop`
--

CREATE TABLE `kyhieulop` (
  `KYHIEULOP` char(2) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `kyhieulop`
--

INSERT INTO `kyhieulop` (`KYHIEULOP`) VALUES
('--'),
('A1'),
('A2'),
('A3'),
('A4'),
('A5'),
('A6'),
('F1'),
('F2'),
('F3');

-- --------------------------------------------------------

--
-- Table structure for table `loaids`
--

CREATE TABLE `loaids` (
  `MALOAIDS` int(11) NOT NULL,
  `TENLOAIDS` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `loaids`
--

INSERT INTO `loaids` (`MALOAIDS`, `TENLOAIDS`) VALUES
(1, 'Có mặt'),
(2, 'Vắng mặt'),
(3, 'Có vào không ra'),
(4, 'Có ra không vào'),
(5, 'Chưa có thông tin');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MSSV` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `KYHIEULOP` char(2) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--',
  `TENCHNGANH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--',
  `KHOAHOC` char(3) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--',
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--',
  `HOTEN` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '--'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`MSSV`, `KYHIEULOP`, `TENCHNGANH`, `KHOAHOC`, `TENKHOA`, `HOTEN`) VALUES
('B1500003', 'A3', 'Hệ thống thông tin', 'K41', 'Công nghệ thông tin và truyền thông', 'Phạm Đình Thiên'),
('B1700001', 'A1', 'Mạng máy tính và TT', 'K43', 'Công nghệ thông tin và truyền thông', 'Nguyễn Thị Linh'),
('B1700002', 'A1', 'Khoa học máy tính', 'K43', 'Công nghệ thông tin và truyền thông', 'Phạm Tiễn');

-- --------------------------------------------------------

--
-- Table structure for table `sukien`
--

CREATE TABLE `sukien` (
  `MASK` int(11) NOT NULL,
  `MATTHAI` int(11) NOT NULL DEFAULT '1',
  `TENSK` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `NGTHUCHIEN` date NOT NULL,
  `DIADIEM` varchar(150) COLLATE utf8_vietnamese_ci NOT NULL,
  `DDVAO` time NOT NULL,
  `DDRA` time NOT NULL,
  `TGIANDDRA` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `sukien`
--

INSERT INTO `sukien` (`MASK`, `MATTHAI`, `TENSK`, `NGTHUCHIEN`, `DIADIEM`, `DDVAO`, `DDRA`, `TGIANDDRA`) VALUES
(1, 1, 'Sự kiện ăn uống hàn quốc', '2017-11-02', 'Lào', '16:43:00', '16:44:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `thongkediemdanh`
--

CREATE TABLE `thongkediemdanh` (
  `MALOAIDS` int(11) NOT NULL,
  `MASK` int(11) NOT NULL,
  `SOLUONGSV` int(11) DEFAULT '0',
  `SOLUONGCB` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `to_bomon`
--

CREATE TABLE `to_bomon` (
  `TENBOMON` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `to_bomon`
--

INSERT INTO `to_bomon` (`TENBOMON`, `TENKHOA`) VALUES
('--', '--'),
('Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông'),
('Công nghệ thông tin', 'Công nghệ thông tin và truyền thông'),
('Hệ thống thông tin', 'Công nghệ thông tin và truyền thông'),
('Khoa học máy tính', 'Công nghệ thông tin và truyền thông'),
('Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông'),
('Tin học ứng dụng', 'Công nghệ thông tin và truyền thông');

-- --------------------------------------------------------

--
-- Table structure for table `trangthaisk`
--

CREATE TABLE `trangthaisk` (
  `MATTHAI` int(11) NOT NULL,
  `GHICHU` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `trangthaisk`
--

INSERT INTO `trangthaisk` (`MATTHAI`, `GHICHU`) VALUES
(1, 'Đã tạo, chưa đăng ký'),
(2, 'Đang chờ điểm danh'),
(3, 'Đang điểm danh'),
(4, 'Hoàn thành điểm danh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trần Quản Trị', 'abc@gmail.com', '$2y$10$/e6.ldxQqjZJnfpnRH3/v.jOmhM8BQJzLmkEPPzIdYUIDwU0dlvZe', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canbo`
--
ALTER TABLE `canbo`
  ADD PRIMARY KEY (`MSCB`),
  ADD KEY `FK_BOMONCB` (`TENBOMON`),
  ADD KEY `FK_KHOACB` (`TENKHOA`);

--
-- Indexes for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD PRIMARY KEY (`TENCHNGANH`),
  ADD KEY `FK_KHOACHNGANH` (`TENKHOA`);

--
-- Indexes for table `dangkythecb`
--
ALTER TABLE `dangkythecb`
  ADD PRIMARY KEY (`MSCB_THE`);

--
-- Indexes for table `dangkythesv`
--
ALTER TABLE `dangkythesv`
  ADD PRIMARY KEY (`MSSV_THE`);

--
-- Indexes for table `diemdanhcb`
--
ALTER TABLE `diemdanhcb`
  ADD PRIMARY KEY (`MASK`,`MSCB`),
  ADD KEY `FK_DIEMDANHCB` (`MSCB`),
  ADD KEY `FK_LOAIDS_DSCB` (`MALOAIDS`);

--
-- Indexes for table `diemdanhsv`
--
ALTER TABLE `diemdanhsv`
  ADD PRIMARY KEY (`MSSV`,`MASK`),
  ADD KEY `FK_LOAIDS_DSSV` (`MALOAIDS`),
  ADD KEY `FK_SKIENDDSV` (`MASK`);

--
-- Indexes for table `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`KHOAHOC`);

--
-- Indexes for table `khoa_phong`
--
ALTER TABLE `khoa_phong`
  ADD PRIMARY KEY (`TENKHOA`);

--
-- Indexes for table `kyhieulop`
--
ALTER TABLE `kyhieulop`
  ADD PRIMARY KEY (`KYHIEULOP`);

--
-- Indexes for table `loaids`
--
ALTER TABLE `loaids`
  ADD PRIMARY KEY (`MALOAIDS`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MSSV`),
  ADD KEY `FK_KHOAHOCSV` (`KHOAHOC`),
  ADD KEY `FK_KHOASV` (`TENKHOA`),
  ADD KEY `FK_LOPSV` (`KYHIEULOP`),
  ADD KEY `FK_NGANHSV` (`TENCHNGANH`);

--
-- Indexes for table `sukien`
--
ALTER TABLE `sukien`
  ADD PRIMARY KEY (`MASK`),
  ADD KEY `FK_TTHAISK` (`MATTHAI`);

--
-- Indexes for table `thongkediemdanh`
--
ALTER TABLE `thongkediemdanh`
  ADD PRIMARY KEY (`MALOAIDS`,`MASK`),
  ADD KEY `FK_THONGKESK` (`MASK`);

--
-- Indexes for table `to_bomon`
--
ALTER TABLE `to_bomon`
  ADD PRIMARY KEY (`TENBOMON`),
  ADD KEY `FK_KHOABOMON` (`TENKHOA`);

--
-- Indexes for table `trangthaisk`
--
ALTER TABLE `trangthaisk`
  ADD PRIMARY KEY (`MATTHAI`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loaids`
--
ALTER TABLE `loaids`
  MODIFY `MALOAIDS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sukien`
--
ALTER TABLE `sukien`
  MODIFY `MASK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `canbo`
--
ALTER TABLE `canbo`
  ADD CONSTRAINT `FK_BOMONCB` FOREIGN KEY (`TENBOMON`) REFERENCES `to_bomon` (`TENBOMON`),
  ADD CONSTRAINT `FK_KHOACB` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`);

--
-- Constraints for table `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD CONSTRAINT `FK_KHOACHNGANH` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`);

--
-- Constraints for table `dangkythecb`
--
ALTER TABLE `dangkythecb`
  ADD CONSTRAINT `FK_DANGKYTHECB` FOREIGN KEY (`MSCB_THE`) REFERENCES `canbo` (`MSCB`);

--
-- Constraints for table `dangkythesv`
--
ALTER TABLE `dangkythesv`
  ADD CONSTRAINT `FK_DANGKYTHESV` FOREIGN KEY (`MSSV_THE`) REFERENCES `sinhvien` (`MSSV`);

--
-- Constraints for table `diemdanhcb`
--
ALTER TABLE `diemdanhcb`
  ADD CONSTRAINT `FK_DIEMDANHCB` FOREIGN KEY (`MSCB`) REFERENCES `canbo` (`MSCB`),
  ADD CONSTRAINT `FK_LOAIDS_DSCB` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_SKIENDDCB` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Constraints for table `diemdanhsv`
--
ALTER TABLE `diemdanhsv`
  ADD CONSTRAINT `FK_DIEMDANHSV` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`),
  ADD CONSTRAINT `FK_LOAIDS_DSSV` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_SKIENDDSV` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `FK_KHOAHOCSV` FOREIGN KEY (`KHOAHOC`) REFERENCES `khoahoc` (`KHOAHOC`),
  ADD CONSTRAINT `FK_KHOASV` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`),
  ADD CONSTRAINT `FK_LOPSV` FOREIGN KEY (`KYHIEULOP`) REFERENCES `kyhieulop` (`KYHIEULOP`),
  ADD CONSTRAINT `FK_NGANHSV` FOREIGN KEY (`TENCHNGANH`) REFERENCES `chuyennganh` (`TENCHNGANH`);

--
-- Constraints for table `sukien`
--
ALTER TABLE `sukien`
  ADD CONSTRAINT `FK_TTHAISK` FOREIGN KEY (`MATTHAI`) REFERENCES `trangthaisk` (`MATTHAI`);

--
-- Constraints for table `thongkediemdanh`
--
ALTER TABLE `thongkediemdanh`
  ADD CONSTRAINT `FK_THONGKELOAIDS` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_THONGKESK` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Constraints for table `to_bomon`
--
ALTER TABLE `to_bomon`
  ADD CONSTRAINT `FK_KHOABOMON` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;