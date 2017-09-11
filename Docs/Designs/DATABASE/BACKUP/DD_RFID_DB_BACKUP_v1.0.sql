-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2017 at 05:31 PM
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
-- Table structure for table `bomon`
--

CREATE TABLE `bomon` (
  `TENBOMON` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `bomon`
--

INSERT INTO `bomon` (`TENBOMON`) VALUES
('Công nghệ phần mềm'),
('Công nghệ thông tin'),
('Hệ thống thông tin'),
('Khoa học máy tính'),
('Mạng máy tính và TT'),
('Tin học ứng dụng');

-- --------------------------------------------------------

--
-- Table structure for table `canbo`
--

CREATE TABLE `canbo` (
  `MSCB` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENBOMON` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `EMAILCB` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `HOTENCB` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `TENCHNGANH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `chuyennganh`
--

INSERT INTO `chuyennganh` (`TENCHNGANH`) VALUES
('Công nghệ phần mềm'),
('Công nghệ thông tin'),
('Hệ thống thông tin'),
('Khoa học máy tính'),
('Mạng máy tính và TT'),
('Tin học ứng dụng');

-- --------------------------------------------------------

--
-- Table structure for table `dangkythecb`
--

CREATE TABLE `dangkythecb` (
  `MSCB` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MATHECB` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dangkythesv`
--

CREATE TABLE `dangkythesv` (
  `MSSV` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MATHESV` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dangthongbao`
--

CREATE TABLE `dangthongbao` (
  `MATBAO` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `NGAYDANG` date DEFAULT NULL,
  `GIODANG` time DEFAULT NULL,
  `TENNGDANG` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `SDTNGDANG` varchar(11) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `EMAILNGDANG` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dsdiemdanhcb`
--

CREATE TABLE `dsdiemdanhcb` (
  `MALOAIDS` char(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `MASK` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `MSCB` char(8) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dsdiemdanhsv`
--

CREATE TABLE `dsdiemdanhsv` (
  `MSSV` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MALOAIDS` char(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `MASK` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`TENKHOA`) VALUES
('Công nghệ thông tin và truyền thông');

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
-- Table structure for table `kyhieulop`
--

CREATE TABLE `kyhieulop` (
  `KYHIEULOP` char(2) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `kyhieulop`
--

INSERT INTO `kyhieulop` (`KYHIEULOP`) VALUES
('A1'),
('A2'),
('A3'),
('A4'),
('A5'),
('A6'),
('A7'),
('A8');

-- --------------------------------------------------------

--
-- Table structure for table `loaids`
--

CREATE TABLE `loaids` (
  `MALOAIDS` char(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENLOAIDS` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `loaids`
--

INSERT INTO `loaids` (`MALOAIDS`, `TENLOAIDS`) VALUES
('01', 'Có mặt'),
('02', 'Vắng mặt'),
('03', 'Có vào không ra'),
('04', 'Có ra không vào');

-- --------------------------------------------------------

--
-- Table structure for table `loaithongbao`
--

CREATE TABLE `loaithongbao` (
  `MALOAITBAO` char(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENLOAITBAO` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `loaithongbao`
--

INSERT INTO `loaithongbao` (`MALOAITBAO`, `TENLOAITBAO`) VALUES
('001', 'Bo sung SV'),
('002', 'Bo sung CB');

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
  `KYHIEULOP` char(2) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENCHNGANH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `KHOAHOC` char(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `HOTENSV` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sukien`
--

CREATE TABLE `sukien` (
  `MASK` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENSK` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `NGTHUCHIEN` date DEFAULT NULL,
  `DIADIEM` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `DDVAO` time DEFAULT NULL,
  `DDRA` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thongbao`
--

CREATE TABLE `thongbao` (
  `MATBAO` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MALOAITBAO` char(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `TIEUDE` varchar(40) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `NOIDUNG` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `bomon`
--
ALTER TABLE `bomon`
  ADD PRIMARY KEY (`TENBOMON`);

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
  ADD PRIMARY KEY (`TENCHNGANH`);

--
-- Indexes for table `dangkythecb`
--
ALTER TABLE `dangkythecb`
  ADD PRIMARY KEY (`MSCB`);

--
-- Indexes for table `dangkythesv`
--
ALTER TABLE `dangkythesv`
  ADD PRIMARY KEY (`MSSV`);

--
-- Indexes for table `dangthongbao`
--
ALTER TABLE `dangthongbao`
  ADD PRIMARY KEY (`MATBAO`);

--
-- Indexes for table `dsdiemdanhcb`
--
ALTER TABLE `dsdiemdanhcb`
  ADD PRIMARY KEY (`MALOAIDS`,`MASK`,`MSCB`),
  ADD KEY `FK_DIEMDANHCB` (`MSCB`),
  ADD KEY `FK_SKIENDDCB` (`MASK`);

--
-- Indexes for table `dsdiemdanhsv`
--
ALTER TABLE `dsdiemdanhsv`
  ADD PRIMARY KEY (`MSSV`,`MALOAIDS`,`MASK`),
  ADD KEY `FK_LOAIDS_DSSV` (`MALOAIDS`),
  ADD KEY `FK_SKIENDDSV` (`MASK`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`TENKHOA`);

--
-- Indexes for table `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`KHOAHOC`);

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
-- Indexes for table `loaithongbao`
--
ALTER TABLE `loaithongbao`
  ADD PRIMARY KEY (`MALOAITBAO`);

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
  ADD PRIMARY KEY (`MASK`);

--
-- Indexes for table `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`MATBAO`),
  ADD KEY `FK_LOAITB_TBAO` (`MALOAITBAO`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `canbo`
--
ALTER TABLE `canbo`
  ADD CONSTRAINT `FK_BOMONCB` FOREIGN KEY (`TENBOMON`) REFERENCES `bomon` (`TENBOMON`),
  ADD CONSTRAINT `FK_KHOACB` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa` (`TENKHOA`);

--
-- Constraints for table `dangkythecb`
--
ALTER TABLE `dangkythecb`
  ADD CONSTRAINT `FK_DANGKYTHECB` FOREIGN KEY (`MSCB`) REFERENCES `canbo` (`MSCB`);

--
-- Constraints for table `dangkythesv`
--
ALTER TABLE `dangkythesv`
  ADD CONSTRAINT `FK_DANGKYTHESV` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`);

--
-- Constraints for table `dangthongbao`
--
ALTER TABLE `dangthongbao`
  ADD CONSTRAINT `FK_DANGTBAO` FOREIGN KEY (`MATBAO`) REFERENCES `thongbao` (`MATBAO`);

--
-- Constraints for table `dsdiemdanhcb`
--
ALTER TABLE `dsdiemdanhcb`
  ADD CONSTRAINT `FK_DIEMDANHCB` FOREIGN KEY (`MSCB`) REFERENCES `canbo` (`MSCB`),
  ADD CONSTRAINT `FK_LOAIDS_DSCB` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_SKIENDDCB` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Constraints for table `dsdiemdanhsv`
--
ALTER TABLE `dsdiemdanhsv`
  ADD CONSTRAINT `FK_DIEMDANHSV` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`),
  ADD CONSTRAINT `FK_LOAIDS_DSSV` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_SKIENDDSV` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `FK_KHOAHOCSV` FOREIGN KEY (`KHOAHOC`) REFERENCES `khoahoc` (`KHOAHOC`),
  ADD CONSTRAINT `FK_KHOASV` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa` (`TENKHOA`),
  ADD CONSTRAINT `FK_LOPSV` FOREIGN KEY (`KYHIEULOP`) REFERENCES `kyhieulop` (`KYHIEULOP`),
  ADD CONSTRAINT `FK_NGANHSV` FOREIGN KEY (`TENCHNGANH`) REFERENCES `chuyennganh` (`TENCHNGANH`);

--
-- Constraints for table `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `FK_LOAITB_TBAO` FOREIGN KEY (`MALOAITBAO`) REFERENCES `loaithongbao` (`MALOAITBAO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
