-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 26, 2024 lúc 06:04 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dulich3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `datkhachsan`
--
create database dbdulich;
use dbdulich;
CREATE TABLE `datkhachsan` (
  `madatkhachsan` int(11) NOT NULL,
  `makhachsan` int(11) NOT NULL,
  `tentaikhoan` varchar(50) NOT NULL,
  `ngaynhanphong` date NOT NULL,
  `giaphong` int(11) NOT NULL,
  `tenkhachsan` varchar(100) NOT NULL,
  `sophong` int(11) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `diachi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `datkhachsan`
--

INSERT INTO `datkhachsan` (`madatkhachsan`, `makhachsan`, `tentaikhoan`, `ngaynhanphong`, `giaphong`, `tenkhachsan`, `sophong`, `sodienthoai`, `diachi`) VALUES
(124, 1, 'user', '2024-06-27', 3000000, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 1, '0332', 'Ghềnh Ráng, Quy Nhơn, Bình Định');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dattour`
--

CREATE TABLE `dattour` (
  `madattour` int(11) NOT NULL,
  `matour` varchar(20) NOT NULL,
  `tentour` varchar(100) NOT NULL,
  `diadiem` varchar(100) NOT NULL,
  `thoigian` varchar(50) NOT NULL,
  `soluongnguoi` int(11) NOT NULL,
  `tentaikhoan` varchar(50) NOT NULL,
  `ngaybatdau` date NOT NULL,
  `giave` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dattour`
--

INSERT INTO `dattour` (`madattour`, `matour`, `tentour`, `diadiem`, `thoigian`, `soluongnguoi`, `tentaikhoan`, `ngaybatdau`, `giave`) VALUES
(8, '002', ' Ghềnh Ráng Tiên Sa 2 ngày 1 đêm', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 7, 'user', '2024-06-27', 8400000),
(9, '002', ' Ghềnh Ráng Tiên Sa 2 ngày 1 đêm', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 3, 'phudo2', '2024-06-27', 3600000),
(10, '001', 'Bãi tắm Quy Nhơn 3 ngày 2 đêm', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 7, 'phudo2', '2024-06-14', 10500000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachsan`
--

CREATE TABLE `khachsan` (
  `makhachsan` int(11) NOT NULL,
  `tenkhachsan` varchar(100) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `sophong` int(11) NOT NULL,
  `giaphong` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `loaiphong` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachsan`
--

INSERT INTO `khachsan` (`makhachsan`, `tenkhachsan`, `diachi`, `sophong`, `giaphong`, `hinhanh`, `loaiphong`) VALUES
(1, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 'Ghềnh Ráng, Quy Nhơn, Bình Định', 200, 3000000, '1.jpg', 'Đơn'),
(2, 'Khách sạn FLC Luxury Hotel Quy Nhơn', 'Ghềnh Ráng, Quy Nhơn, Bình Định', 350, 3500000, '2.jpg', 'Đơn'),
(3, 'Khách sạn Saigon Quy Nhơn Hotel', '24 Lý Thường Kiệt, Quy Nhơn, Bình Định', 150, 500000, '3.jpg', 'Đôi'),
(4, 'Khách sạn Seagull Hotel Quy Nhơn', '489 An Dương Vương, Quy Nhơn, Bình Định', 180, 2500000, '4.jpg', 'Đơn'),
(5, 'Khách sạn ABC', 'Địa chỉ ABC, Quy Nhơn, Bình Định', 100, 2000000, '5.jpg', 'Đơn'),
(6, 'Khách sạn XYZ', 'Địa chỉ XYZ, Quy Nhơn, Bình Định', 150, 2500000, '6.jpg', 'Đôi'),
(7, 'Khách sạn QWERTY', 'Địa chỉ QWERTY, Quy Nhơn, Bình Định', 120, 1800000, '7.jpg', 'Đơn'),
(8, 'Khách sạn 123', 'Địa chỉ 123, Quy Nhơn, Bình Định', 200, 3000000, '8.jpg', 'Đôi'),
(9, 'Khách sạn Sunshine', 'Địa chỉ Sunshine, Quy Nhơn, Bình Định', 80, 2200000, '9.jpg', 'Đơn'),
(10, 'Khách sạn Sea View', 'Địa chỉ Sea View, Quy Nhơn, Bình Định', 250, 2800000, '10.jpg', 'Đôi'),
(11, 'Khách sạn Blue Ocean', 'Địa chỉ Blue Ocean, Quy Nhơn, Bình Định', 180, 2600000, '11.jpg', 'Đơn'),
(12, 'Khách sạn Diamond', 'Địa chỉ Diamond, Quy Nhơn, Bình Định', 300, 3200000, '12.jpg', 'Đôi'),
(13, 'Khách sạn Green Forest', 'Địa chỉ Green Forest, Quy Nhơn, Bình Định', 130, 1900000, '13.jpg', 'Đơn'),
(14, 'Khách sạn Happy Days', 'Địa chỉ Happy Days, Quy Nhơn, Bình Định', 170, 2400000, '14.jpg', 'Đôi'),
(15, 'Khách sạn ABC 2', 'Địa chỉ ABC 2, Quy Nhơn, Bình Định', 100, 2000000, '1.jpg', 'Đơn'),
(16, 'Khách sạn XYZ 2', 'Địa chỉ XYZ 2, Quy Nhơn, Bình Định', 150, 2500000, '2.jpg', 'Đôi'),
(17, 'Khách sạn QWERTY 2', 'Địa chỉ QWERTY 2, Quy Nhơn, Bình Định', 120, 1800000, '3.jpg', 'Đơn'),
(18, 'Khách sạn 123 2', 'Địa chỉ 123 2, Quy Nhơn, Bình Định', 200, 3000000, '4.jpg', 'Đôi'),
(19, 'Khách sạn Sunshine 2', 'Địa chỉ Sunshine 2, Quy Nhơn, Bình Định', 80, 2200000, '5.jpg', 'Đơn'),
(20, 'Khách sạn Sea View 2', 'Địa chỉ Sea View 2, Quy Nhơn, Bình Định', 250, 2800000, '6.jpg', 'Đôi'),
(21, 'Khách sạn Blue Ocean 2', 'Địa chỉ Blue Ocean 2, Quy Nhơn, Bình Định', 180, 2600000, '7.jpg', 'Đơn'),
(22, 'Khách sạn Diamond 2', 'Địa chỉ Diamond 2, Quy Nhơn, Bình Định', 300, 3200000, '8.jpg', 'Đôi'),
(23, 'Khách sạn Green Forest 2', 'Địa chỉ Green Forest 2, Quy Nhơn, Bình Định', 130, 1900000, '9.jpg', 'Đơn'),
(24, 'Khách sạn Happy Days 2', 'Địa chỉ Happy Days 2, Quy Nhơn, Bình Định', 170, 2400000, '10.jpg', 'Đôi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tentaikhoan` varchar(50) NOT NULL,
  `matkhau` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `diachi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`tentaikhoan`, `matkhau`, `email`, `sdt`, `diachi`) VALUES
('admin', 'admin', 'admin@gmail.com', '0123456789', 'Hà Nội'),
('phu987', '789456123', 'phudo@gmail.com', '077525', 'binhdinh'),
('phudo2', 'phudo2', 'sindhu@gmail.com', '777', '777'),
('user', 'user', 'user@gmail.com', '0987654321', 'Hồ Chí Minh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `matour` varchar(20) NOT NULL,
  `tentour` varchar(100) NOT NULL,
  `diadiem` varchar(100) NOT NULL,
  `thoigian` varchar(50) NOT NULL,
  `giave` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`matour`, `tentour`, `diadiem`, `thoigian`, `giave`, `hinhanh`) VALUES
('001', 'Bãi tắm Quy Nhơn 3 ngày 2 đêm', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 1500000, '1.jpg'),
('002', ' Ghềnh Ráng Tiên Sa 2 ngày 1 đêm', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 1200000, '2.jpg'),
('003', 'Eo Gió 4 ngày 3 đêm', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 2000000, '3.jpg'),
('004', 'Tour ABC', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 3000000, '4.jpg'),
('005', 'Tour XYZ', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2500000, '5.jpg'),
('006', 'Tour QWERTY', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3500000, '6.jpg'),
('007', 'Tour Sunshine', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2200000, '7.jpg'),
('008', 'Tour 123', 'Quy Nhơn, Bình Định', '5 ngày 4 đêm', 4000000, '8.jpg'),
('009', 'Tour Sea View', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2800000, '9.jpg'),
('010', 'Tour Blue Ocean', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3200000, '1.jpg'),
('011', 'Tour Diamond', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2600000, '2.jpg'),
('012', 'Tour Green Forest', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2900000, '3.jpg'),
('013', 'Tour Happy Days', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3300000, '4.jpg'),
('014', 'Tour ABC 2', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 3000000, '5.jpg'),
('015', 'Tour XYZ 2', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2500000, '6.jpg'),
('016', 'Tour QWERTY 2', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3500000, '7.jpg'),
('017', 'Tour 123 2', 'Quy Nhơn, Bình Định', '5 ngày 4 đêm', 4000000, '8.jpg'),
('018', 'Tour Sunshine 2', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2200000, '9.jpg'),
('019', 'Tour Sea View 2', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2800000, '1.jpg'),
('020', 'Tour Blue Ocean 2', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3200000, '2.jpg'),
('021', 'Tour Diamond 2', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2600000, '3.jpg'),
('022', 'Tour Green Forest 2', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2900000, '4.jpg'),
('023', 'Tour Happy Days 2', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3300000, '5.jpg'),
('050', 'Biển Quy Nhơn 1 ngày', 'Quy Nhơn, Bình Định', '1 ngày', 2500, '6.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `datkhachsan`
--
ALTER TABLE `datkhachsan`
  ADD PRIMARY KEY (`madatkhachsan`);

--
-- Chỉ mục cho bảng `dattour`
--
ALTER TABLE `dattour`
  ADD PRIMARY KEY (`madattour`),
  ADD KEY `matour` (`matour`),
  ADD KEY `tentaikhoan` (`tentaikhoan`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`tentaikhoan`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`matour`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `datkhachsan`
--
ALTER TABLE `datkhachsan`
  MODIFY `madatkhachsan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT cho bảng `dattour`
--
ALTER TABLE `dattour`
  MODIFY `madattour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
