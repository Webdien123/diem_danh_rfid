-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 19, 2017 lúc 11:38 AM
-- Phiên bản máy phục vụ: 10.1.24-MariaDB
-- Phiên bản PHP: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dd_rfid`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `canbo`
--

CREATE TABLE `canbo` (
  `MSCB` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENBOMON` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `HOTEN` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyennganh`
--

CREATE TABLE `chuyennganh` (
  `TENCHNGANH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chuyennganh`
--

INSERT INTO `chuyennganh` (`TENCHNGANH`, `TENKHOA`) VALUES
('Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông'),
('Công nghệ thông tin', 'Công nghệ thông tin và truyền thông'),
('Hệ thống thông tin', 'Công nghệ thông tin và truyền thông'),
('Khoa học máy tính', 'Công nghệ thông tin và truyền thông'),
('Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông'),
('Tin học ứng dụng', 'Công nghệ thông tin và truyền thông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangkythecb`
--

CREATE TABLE `dangkythecb` (
  `MSCB_THE` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MATHE` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangkythesv`
--

CREATE TABLE `dangkythesv` (
  `MSSV_THE` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MATHE` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangthongbao`
--

CREATE TABLE `dangthongbao` (
  `MATBAO` int(11) NOT NULL,
  `THOIGIANDANG` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `HOTEN` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `SDT` varchar(11) COLLATE utf8_vietnamese_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diemdanhcb`
--

CREATE TABLE `diemdanhcb` (
  `MASK` int(11) NOT NULL,
  `MSCB` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MALOAIDS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diemdanhsv`
--

CREATE TABLE `diemdanhsv` (
  `MSSV` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `MASK` int(11) NOT NULL,
  `MALOAIDS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoahoc`
--

CREATE TABLE `khoahoc` (
  `KHOAHOC` char(3) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khoahoc`
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
-- Cấu trúc bảng cho bảng `khoa_phong`
--

CREATE TABLE `khoa_phong` (
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa_phong`
--

INSERT INTO `khoa_phong` (`TENKHOA`) VALUES
('Công nghệ thông tin và truyền thông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kyhieulop`
--

CREATE TABLE `kyhieulop` (
  `KYHIEULOP` char(2) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `kyhieulop`
--

INSERT INTO `kyhieulop` (`KYHIEULOP`) VALUES
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
-- Cấu trúc bảng cho bảng `loaids`
--

CREATE TABLE `loaids` (
  `MALOAIDS` int(11) NOT NULL,
  `TENLOAIDS` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `loaids`
--

INSERT INTO `loaids` (`MALOAIDS`, `TENLOAIDS`) VALUES
(1, 'Có mặt'),
(2, 'Vắng mặt'),
(3, 'Có vào không ra'),
(4, 'Có ra không vào');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaithongbao`
--

CREATE TABLE `loaithongbao` (
  `MALOAITBAO` int(11) NOT NULL,
  `TENLOAITBAO` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `loaithongbao`
--

INSERT INTO `loaithongbao` (`MALOAITBAO`, `TENLOAITBAO`) VALUES
(1, 'Bo sung SV'),
(2, 'Bo sung CB');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MSSV` char(8) COLLATE utf8_vietnamese_ci NOT NULL,
  `KYHIEULOP` char(2) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENCHNGANH` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `KHOAHOC` char(3) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `HOTEN` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sukien`
--

CREATE TABLE `sukien` (
  `MASK` int(11) NOT NULL,
  `MATTHAI` int(11) NOT NULL DEFAULT '1',
  `TENSK` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `NGTHUCHIEN` date NOT NULL,
  `DIADIEM` varchar(150) COLLATE utf8_vietnamese_ci NOT NULL,
  `DDVAO` time NOT NULL,
  `DDRA` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `MATBAO` int(11) NOT NULL,
  `MALOAITBAO` int(11) NOT NULL,
  `TIEUDE` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `NOIDUNG` varchar(1000) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `DAXULY` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongkediemdanh`
--

CREATE TABLE `thongkediemdanh` (
  `MALOAIDS` int(11) NOT NULL,
  `MASK` int(11) NOT NULL,
  `SOLUONGSV` int(11) DEFAULT '0',
  `SOLUONGCB` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `to_bomon`
--

CREATE TABLE `to_bomon` (
  `TENBOMON` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `TENKHOA` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `to_bomon`
--

INSERT INTO `to_bomon` (`TENBOMON`, `TENKHOA`) VALUES
('Công nghệ phần mềm', 'Công nghệ thông tin và truyền thông'),
('Công nghệ thông tin', 'Công nghệ thông tin và truyền thông'),
('Hệ thống thông tin', 'Công nghệ thông tin và truyền thông'),
('Khoa học máy tính', 'Công nghệ thông tin và truyền thông'),
('Mạng máy tính và TT', 'Công nghệ thông tin và truyền thông'),
('Tin học ứng dụng', 'Công nghệ thông tin và truyền thông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trangthaisk`
--

CREATE TABLE `trangthaisk` (
  `MATTHAI` int(11) NOT NULL,
  `GHICHU` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `trangthaisk`
--

INSERT INTO `trangthaisk` (`MATTHAI`, `GHICHU`) VALUES
(1, 'Đã tạo, chưa đăng ký'),
(2, 'Đang chờ điểm danh'),
(3, 'Đang điểm danh'),
(4, 'Hoàn thành điểm danh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
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
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trần Quản Trị', 'abc@gmail.com', '$2y$10$og7Lfo64ktnN8H4s.mVV5Or6TQRXrFgNf13FX1mkgTE9c.wA0e8zK', NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `canbo`
--
ALTER TABLE `canbo`
  ADD PRIMARY KEY (`MSCB`),
  ADD KEY `FK_BOMONCB` (`TENBOMON`),
  ADD KEY `FK_KHOACB` (`TENKHOA`);

--
-- Chỉ mục cho bảng `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD PRIMARY KEY (`TENCHNGANH`),
  ADD KEY `FK_KHOACHNGANH` (`TENKHOA`);

--
-- Chỉ mục cho bảng `dangkythecb`
--
ALTER TABLE `dangkythecb`
  ADD PRIMARY KEY (`MSCB_THE`);

--
-- Chỉ mục cho bảng `dangkythesv`
--
ALTER TABLE `dangkythesv`
  ADD PRIMARY KEY (`MSSV_THE`);

--
-- Chỉ mục cho bảng `dangthongbao`
--
ALTER TABLE `dangthongbao`
  ADD PRIMARY KEY (`MATBAO`);

--
-- Chỉ mục cho bảng `diemdanhcb`
--
ALTER TABLE `diemdanhcb`
  ADD PRIMARY KEY (`MASK`,`MSCB`),
  ADD KEY `FK_DIEMDANHCB` (`MSCB`),
  ADD KEY `FK_LOAIDS_DSCB` (`MALOAIDS`);

--
-- Chỉ mục cho bảng `diemdanhsv`
--
ALTER TABLE `diemdanhsv`
  ADD PRIMARY KEY (`MSSV`,`MASK`),
  ADD KEY `FK_LOAIDS_DSSV` (`MALOAIDS`),
  ADD KEY `FK_SKIENDDSV` (`MASK`);

--
-- Chỉ mục cho bảng `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`KHOAHOC`);

--
-- Chỉ mục cho bảng `khoa_phong`
--
ALTER TABLE `khoa_phong`
  ADD PRIMARY KEY (`TENKHOA`);

--
-- Chỉ mục cho bảng `kyhieulop`
--
ALTER TABLE `kyhieulop`
  ADD PRIMARY KEY (`KYHIEULOP`);

--
-- Chỉ mục cho bảng `loaids`
--
ALTER TABLE `loaids`
  ADD PRIMARY KEY (`MALOAIDS`);

--
-- Chỉ mục cho bảng `loaithongbao`
--
ALTER TABLE `loaithongbao`
  ADD PRIMARY KEY (`MALOAITBAO`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MSSV`),
  ADD KEY `FK_KHOAHOCSV` (`KHOAHOC`),
  ADD KEY `FK_KHOASV` (`TENKHOA`),
  ADD KEY `FK_LOPSV` (`KYHIEULOP`),
  ADD KEY `FK_NGANHSV` (`TENCHNGANH`);

--
-- Chỉ mục cho bảng `sukien`
--
ALTER TABLE `sukien`
  ADD PRIMARY KEY (`MASK`),
  ADD KEY `FK_TTHAISK` (`MATTHAI`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`MATBAO`),
  ADD KEY `FK_LOAITB_TBAO` (`MALOAITBAO`);

--
-- Chỉ mục cho bảng `thongkediemdanh`
--
ALTER TABLE `thongkediemdanh`
  ADD PRIMARY KEY (`MALOAIDS`,`MASK`),
  ADD KEY `FK_THONGKESK` (`MASK`);

--
-- Chỉ mục cho bảng `to_bomon`
--
ALTER TABLE `to_bomon`
  ADD PRIMARY KEY (`TENBOMON`),
  ADD KEY `FK_KHOABOMON` (`TENKHOA`);

--
-- Chỉ mục cho bảng `trangthaisk`
--
ALTER TABLE `trangthaisk`
  ADD PRIMARY KEY (`MATTHAI`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `loaids`
--
ALTER TABLE `loaids`
  MODIFY `MALOAIDS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `loaithongbao`
--
ALTER TABLE `loaithongbao`
  MODIFY `MALOAITBAO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `sukien`
--
ALTER TABLE `sukien`
  MODIFY `MASK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  MODIFY `MATBAO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `canbo`
--
ALTER TABLE `canbo`
  ADD CONSTRAINT `FK_BOMONCB` FOREIGN KEY (`TENBOMON`) REFERENCES `to_bomon` (`TENBOMON`),
  ADD CONSTRAINT `FK_KHOACB` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`);

--
-- Các ràng buộc cho bảng `chuyennganh`
--
ALTER TABLE `chuyennganh`
  ADD CONSTRAINT `FK_KHOACHNGANH` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`);

--
-- Các ràng buộc cho bảng `dangkythecb`
--
ALTER TABLE `dangkythecb`
  ADD CONSTRAINT `FK_DANGKYTHECB` FOREIGN KEY (`MSCB_THE`) REFERENCES `canbo` (`MSCB`);

--
-- Các ràng buộc cho bảng `dangkythesv`
--
ALTER TABLE `dangkythesv`
  ADD CONSTRAINT `FK_DANGKYTHESV` FOREIGN KEY (`MSSV_THE`) REFERENCES `sinhvien` (`MSSV`);

--
-- Các ràng buộc cho bảng `dangthongbao`
--
ALTER TABLE `dangthongbao`
  ADD CONSTRAINT `FK_DANGTBAO` FOREIGN KEY (`MATBAO`) REFERENCES `thongbao` (`MATBAO`);

--
-- Các ràng buộc cho bảng `diemdanhcb`
--
ALTER TABLE `diemdanhcb`
  ADD CONSTRAINT `FK_DIEMDANHCB` FOREIGN KEY (`MSCB`) REFERENCES `canbo` (`MSCB`),
  ADD CONSTRAINT `FK_LOAIDS_DSCB` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_SKIENDDCB` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Các ràng buộc cho bảng `diemdanhsv`
--
ALTER TABLE `diemdanhsv`
  ADD CONSTRAINT `FK_DIEMDANHSV` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`),
  ADD CONSTRAINT `FK_LOAIDS_DSSV` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_SKIENDDSV` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `FK_KHOAHOCSV` FOREIGN KEY (`KHOAHOC`) REFERENCES `khoahoc` (`KHOAHOC`),
  ADD CONSTRAINT `FK_KHOASV` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`),
  ADD CONSTRAINT `FK_LOPSV` FOREIGN KEY (`KYHIEULOP`) REFERENCES `kyhieulop` (`KYHIEULOP`),
  ADD CONSTRAINT `FK_NGANHSV` FOREIGN KEY (`TENCHNGANH`) REFERENCES `chuyennganh` (`TENCHNGANH`);

--
-- Các ràng buộc cho bảng `sukien`
--
ALTER TABLE `sukien`
  ADD CONSTRAINT `FK_TTHAISK` FOREIGN KEY (`MATTHAI`) REFERENCES `trangthaisk` (`MATTHAI`);

--
-- Các ràng buộc cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD CONSTRAINT `FK_LOAITB_TBAO` FOREIGN KEY (`MALOAITBAO`) REFERENCES `loaithongbao` (`MALOAITBAO`);

--
-- Các ràng buộc cho bảng `thongkediemdanh`
--
ALTER TABLE `thongkediemdanh`
  ADD CONSTRAINT `FK_THONGKELOAIDS` FOREIGN KEY (`MALOAIDS`) REFERENCES `loaids` (`MALOAIDS`),
  ADD CONSTRAINT `FK_THONGKESK` FOREIGN KEY (`MASK`) REFERENCES `sukien` (`MASK`);

--
-- Các ràng buộc cho bảng `to_bomon`
--
ALTER TABLE `to_bomon`
  ADD CONSTRAINT `FK_KHOABOMON` FOREIGN KEY (`TENKHOA`) REFERENCES `khoa_phong` (`TENKHOA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
