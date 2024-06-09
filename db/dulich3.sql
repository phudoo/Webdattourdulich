-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 01:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dulich3`
--

-- --------------------------------------------------------

--
-- Table structure for table `datkhachsan`
--

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
-- Dumping data for table `datkhachsan`
--

INSERT INTO `datkhachsan` (`madatkhachsan`, `makhachsan`, `tentaikhoan`, `ngaynhanphong`, `giaphong`, `tenkhachsan`, `sophong`, `sodienthoai`, `diachi`) VALUES
(111, 1, 'admin', '2024-06-05', 3000000, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 1, '0123456789', 'Ghềnh Ráng, Quy Nhơn, Bình Định'),
(112, 2, 'user', '2024-07-10', 3500000, 'Khách sạn FLC Luxury Hotel Quy Nhơn', 2, '0987654321', 'Ghềnh Ráng, Quy Nhơn, Bình Định'),
(113, 1, 'admin', '2024-06-03', 0, '', 1, '0123456789', 'Ghềnh Ráng, Quy Nhơn, Bình Định'),
(114, 1, 'admin', '2024-06-03', 0, '', 1, '0123456789', 'Ghềnh Ráng, Quy Nhơn, Bình Định'),
(115, 1, 'user', '2024-06-03', 3000000, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 1, '0333', 'Ghềnh Ráng, Quy Nhơn, Bình Định'),
(116, 4, 'user', '2024-06-05', 2500000, 'Khách sạn Seagull Hotel Quy Nhơn', 1, '77987', '489 An Dương Vương, Quy Nhơn, Bình Định'),
(117, 1, 'user', '2024-06-05', 3000000, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 1, '3', 'Ghềnh Ráng, Quy Nhơn, Bình Định'),
(118, 1, 'user', '2024-06-05', 3000000, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 1, '281829371', 'Ghềnh Ráng, Quy Nhơn, Bình Định'),
(121, 1, 'user', '2024-06-05', 3000000, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 1, '77777777', 'Ghềnh Ráng, Quy Nhơn, Bình Định');

-- --------------------------------------------------------

--
-- Table structure for table `dattour`
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
-- Dumping data for table `dattour`
--

INSERT INTO `dattour` (`madattour`, `matour`, `tentour`, `diadiem`, `thoigian`, `soluongnguoi`, `tentaikhoan`, `ngaybatdau`, `giave`) VALUES
(1, '001', 'Bãi tắm Quy Nhơn 3 ngày 2 đêm', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2, 'user', '2024-06-05', 3000000),
(2, '001', 'Bãi tắm Quy Nhơn 3 ngày 2 đêm', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 3, 'user', '2024-06-05', 4500000),
(3, '002', ' Ghềnh Ráng Tiên Sa 2 ngày 1 đêm', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 8, 'user', '2024-06-04', 9600000),
(4, '002', ' Ghềnh Ráng Tiên Sa 2 ngày 1 đêm', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 5, 'user', '2024-06-05', 6000000),
(5, '001', 'Bãi tắm Quy Nhơn 3 ngày 2 đêm', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 12, 'admin', '2024-05-26', 18000000);

-- --------------------------------------------------------

--
-- Table structure for table `khachsan`
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
-- Dumping data for table `khachsan`
--

INSERT INTO `khachsan` (`makhachsan`, `tenkhachsan`, `diachi`, `sophong`, `giaphong`, `hinhanh`, `loaiphong`) VALUES
(1, 'Khách sạn AVANI Quy Nhơn Resort & Spa', 'Ghềnh Ráng, Quy Nhơn, Bình Định', 200, 3000000, '1', 'Đôi'),
(2, 'Khách sạn FLC Luxury Hotel Quy Nhơn', 'Ghềnh Ráng, Quy Nhơn, Bình Định', 350, 3500000, '0', 'Đôi'),
(3, 'Khách sạn Saigon Quy Nhơn Hotel', '24 Lý Thường Kiệt, Quy Nhơn, Bình Định', 150, 500000, '3', 'Đôi'),
(4, 'Khách sạn Seagull Hotel Quy Nhơn', '489 An Dương Vương, Quy Nhơn, Bình Định', 180, 2500000, '4', 'Đơn'),
(5, 'Khách sạn ABC', 'Địa chỉ ABC, Quy Nhơn, Bình Định', 100, 2000000, '0', 'Đơn'),
(7, 'Khách sạn QWERTY', 'Địa chỉ QWERTY, Quy Nhơn, Bình Định', 120, 1800000, 'link_anh3.jpg', 'Đơn'),
(8, 'Khách sạn 123', 'Địa chỉ 123, Quy Nhơn, Bình Định', 200, 3000000, 'link_anh4.jpg', 'Đôi'),
(9, 'Khách sạn Sunshine', 'Địa chỉ Sunshine, Quy Nhơn, Bình Định', 80, 2200000, 'link_anh5.jpg', 'Đơn'),
(10, 'Khách sạn Sea View', 'Địa chỉ Sea View, Quy Nhơn, Bình Định', 250, 2800000, '0', 'Đôi'),
(11, 'Khách sạn Blue Ocean', 'Địa chỉ Blue Ocean, Quy Nhơn, Bình Định', 180, 2600000, 'link_anh7.jpg', 'Đơn'),
(12, 'Khách sạn Diamond', 'Địa chỉ Diamond, Quy Nhơn, Bình Định', 300, 3200000, '0', 'Đôi'),
(13, 'Khách sạn Green Forest', 'Địa chỉ Green Forest, Quy Nhơn, Bình Định', 130, 1900000, '0', 'Đơn'),
(14, 'Khách sạn Happy Days', 'Địa chỉ Happy Days, Quy Nhơn, Bình Định', 170, 2400000, 'link_anh10.jpg', 'Đôi'),
(15, 'Khách sạn ABC 2', 'Địa chỉ ABC 2, Quy Nhơn, Bình Định', 100, 2000000, '0', 'Đơn'),
(16, 'Khách sạn XYZ 2', 'Địa chỉ XYZ 2, Quy Nhơn, Bình Định', 150, 2500000, 'link_anh12.jpg', 'Đôi'),
(17, 'Khách sạn QWERTY 2', 'Địa chỉ QWERTY 2, Quy Nhơn, Bình Định', 120, 1800000, '0', 'Đơn'),
(19, 'Khách sạn Sunshine 2', 'Địa chỉ Sunshine 2, Quy Nhơn, Bình Định', 80, 2200000, '0', 'Đơn'),
(20, 'Khách sạn Sea View 2', 'Địa chỉ Sea View 2, Quy Nhơn, Bình Định', 250, 2800000, 'link_anh16.jpg', 'Đôi'),
(21, 'Khách sạn Blue Ocean 2', 'Địa chỉ Blue Ocean 2, Quy Nhơn, Bình Định', 180, 2600000, '21', 'Đơn'),
(22, 'Khách sạn Diamond 2', 'Địa chỉ Diamond 2, Quy Nhơn, Bình Định', 300, 3200000, '22', 'Đôi'),
(23, 'Khách sạn Green Forest 2', 'Địa chỉ Green Forest 2, Quy Nhơn, Bình Định', 130, 1900000, '23', 'Đơn'),
(24, 'Khách sạn Happy Days 2', 'Địa chỉ Happy Days 2, Quy Nhơn, Bình Định', 170, 2400000, '24', 'Đôi'),
(51, 'siuuuuu', '1', 1, 1, '', 'Đơn');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tentaikhoan` varchar(50) NOT NULL,
  `matkhau` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sdt` varchar(20) NOT NULL,
  `diachi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`tentaikhoan`, `matkhau`, `email`, `sdt`, `diachi`) VALUES
('admin', 'admin', 'admin@gmail.com', '0123456789', 'Hà Nội'),
('phu987', '789456123', 'phudo@gmail.com', '077525', 'binhdinh'),
('user', 'user', 'user@gmail.com', '0987654321', 'Hồ Chí Minh');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `matour` int(20) NOT NULL,
  `tentour` varchar(100) NOT NULL,
  `diadiem` varchar(100) NOT NULL,
  `thoigian` varchar(50) NOT NULL,
  `giave` int(11) NOT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`matour`, `tentour`, `diadiem`, `thoigian`, `giave`, `hinhanh`) VALUES
(1, 'Bãi tắm Quy Nhơn 3 ngày 2 đêm', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 1500000, 'https://ik.imagekit.io/tvlk/blog/2022/02/dia-diem-du-lich-binh-dinh-3-819x1024.jpg?tr=dpr-2,w-675'),
(2, ' Ghềnh Ráng Tiên Sa 2 ngày 1 đêm', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 1200000, 'https://ik.imagekit.io/tvlk/blog/2022/02/dia-diem-du-lich-binh-dinh-5-1024x1024.jpg?tr=dpr-2,w-675'),
(3, 'Eo Gió 4 ngày 3 đêm', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 200000078, 'https://ik.imagekit.io/tvlk/blog/2022/02/dia-diem-du-lich-binh-dinh-8-819x1024.jpg?tr=dpr-2,w-675'),
(4, 'Tour ABC', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 3000000, 'link_anh1.jpg'),
(5, 'Tour XYZ', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2500000, 'link_anh2.jpg'),
(6, 'Tour QWERTY', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3500000, 'link_anh3.jpg'),
(7, 'Tour Sunshine', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2200000, 'link_anh5.jpg'),
(8, 'Tour 123', 'Quy Nhơn, Bình Định', '5 ngày 4 đêm', 4000000, 'link_anh4.jpg'),
(9, 'Tour Sea View', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2800000, 'link_anh6.jpg'),
(10, 'Tour Blue Ocean', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3200000, 'link_anh7.jpg'),
(11, 'Tour Diamond', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2600000, 'link_anh8.jpg'),
(12, 'Tour Green Forest', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2900000, 'link_anh9.jpg'),
(13, 'Tour Happy Days', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3300000, 'link_anh10.jpg'),
(14, 'Tour ABC 2', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 3000000, 'link_anh11.jpg'),
(15, 'Tour XYZ 2', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2500000, 'link_anh12.jpg'),
(16, 'Tour QWERTY 2', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3500000, 'link_anh13.jpg'),
(17, 'Tour 123 2', 'Quy Nhơn, Bình Định', '5 ngày 4 đêm', 4000000, 'link_anh14.jpg'),
(18, 'Tour Sunshine 2', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2200000, 'link_anh15.jpg'),
(19, 'Tour Sea View 2', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2800000, 'link_anh16.jpg'),
(20, 'Tour Blue Ocean 2', 'Quy Nhơn, Bình Định', '4 ngày 3 đêm', 3200000, 'link_anh17.jpg'),
(21, 'Tour Diamond 2', 'Quy Nhơn, Bình Định', '2 ngày 1 đêm', 2600000, 'link_anh18.jpg'),
(22, 'Tour Green Forest 2', 'Quy Nhơn, Bình Định', '3 ngày 2 đêm', 2900000, '22'),
(25, '1', '1', '1', 1, '25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datkhachsan`
--
ALTER TABLE `datkhachsan`
  ADD PRIMARY KEY (`madatkhachsan`);

--
-- Indexes for table `dattour`
--
ALTER TABLE `dattour`
  ADD PRIMARY KEY (`madattour`),
  ADD KEY `matour` (`matour`),
  ADD KEY `tentaikhoan` (`tentaikhoan`);

--
-- Indexes for table `khachsan`
--
ALTER TABLE `khachsan`
  ADD PRIMARY KEY (`makhachsan`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`tentaikhoan`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`matour`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datkhachsan`
--
ALTER TABLE `datkhachsan`
  MODIFY `madatkhachsan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `dattour`
--
ALTER TABLE `dattour`
  MODIFY `madattour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `khachsan`
--
ALTER TABLE `khachsan`
  MODIFY `makhachsan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `matour` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
