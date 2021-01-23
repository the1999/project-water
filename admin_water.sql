-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 14, 2020 at 12:24 PM
-- Server version: 10.3.11-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_water`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(5) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_import_detail`
--

CREATE TABLE `tbl_import_detail` (
  `import_detail_id` int(10) NOT NULL,
  `import_id` int(10) NOT NULL,
  `product_id` int(5) NOT NULL,
  `list_order` int(3) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_import_detail`
--

INSERT INTO `tbl_import_detail` (`import_detail_id`, `import_id`, `product_id`, `list_order`, `quantity`) VALUES
(9, 4, 1, 1, 10),
(10, 4, 2, 2, 20),
(11, 5, 1, 3, 10),
(12, 5, 2, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_import_head`
--

CREATE TABLE `tbl_import_head` (
  `import_id` int(11) NOT NULL,
  `import_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IM2011xxxx	',
  `import_date` date DEFAULT NULL,
  `import_user_id` int(5) DEFAULT NULL,
  `create_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_import_head`
--

INSERT INTO `tbl_import_head` (`import_id`, `import_no`, `import_date`, `import_user_id`, `create_datetime`) VALUES
(4, 'IM20110001', '2020-11-11', 1, '2020-11-11 07:43:27'),
(5, 'IM20120001', '2020-12-14', 1, '2020-12-14 05:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `member_id` int(5) NOT NULL,
  `username` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'md5 เฉยๆ',
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`member_id`, `username`, `password`, `phone`, `address`) VALUES
(1, 'smile', '81dc9bdb52d04dc20036dbd8313ed055', '0972981604', '222 ม.1 8 คลองหก'),
(8, 'Toey', '81dc9bdb52d04dc20036dbd8313ed055', '0623084875', '123/4'),
(9, 'bigsara', '81dc9bdb52d04dc20036dbd8313ed055', '0955032848', '108 รังสิต-นครนายก 63');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `list_order` int(3) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `unit_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`order_id`, `product_id`, `list_order`, `quantity`, `unit_price`) VALUES
(49, 1, 1, 5, 15),
(49, 2, 2, 10, 30),
(56, 1, 3, 5, 15),
(57, 2, 4, 5, 30),
(58, 1, 5, 1, 15),
(58, 2, 6, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_head`
--

CREATE TABLE `tbl_order_head` (
  `order_id` int(10) NOT NULL,
  `order_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '2007xxxx',
  `member_id` int(10) NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '0 =  รอชำระเงิน , 1 =  ชำระเงินแล้ว, 2 = ชำระเงินปลายทาง , 3 = กำลังจัดส่ง, 4 = จัดส่งแล้ว, 5 = ยกเลิก, 6 = รออนุมัติการชำระเงิน',
  `order_date` datetime DEFAULT NULL,
  `payment_slip` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_amont` double DEFAULT NULL,
  `approve_payment_date` datetime DEFAULT NULL,
  `delivery_status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0 = รอดำเนินการ , 1 = จัดส่งแล้ว ยืนยันแล้ว , 2 = ',
  `read_datetime` datetime DEFAULT NULL COMMENT 'ดูรายการที่ยกเลิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order_head`
--

INSERT INTO `tbl_order_head` (`order_id`, `order_no`, `member_id`, `status`, `order_date`, `payment_slip`, `payment_amont`, `approve_payment_date`, `delivery_status`, `read_datetime`) VALUES
(49, '20120001', 1, '5', '2020-12-08 14:00:54', NULL, 375, NULL, '0', '2020-12-14 12:19:03'),
(56, '20120002', 1, '5', '2020-12-08 14:50:58', 'fcb6a9e48203c3d68bf82bb9be09b042.png', 75, '2020-12-08 15:57:57', '0', '2020-12-09 18:29:46'),
(57, '20120003', 1, '5', '2020-12-09 17:35:40', NULL, 150, NULL, '0', '2020-12-09 18:29:46'),
(58, '20120004', 1, '2', '2020-12-14 12:20:26', NULL, 45, NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_problem`
--

CREATE TABLE `tbl_problem` (
  `problem_id` int(10) NOT NULL,
  `problem_date` datetime DEFAULT NULL,
  `member_id` int(5) NOT NULL,
  `problem_text` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_problem`
--

INSERT INTO `tbl_problem` (`problem_id`, `problem_date`, `member_id`, `problem_text`) VALUES
(1, '2020-07-28 17:11:58', 1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_image` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'no-image.jpg',
  `product_size` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_image`, `product_size`, `price`) VALUES
(1, 'แบบถัง', 'num1.jpg', '20', 15),
(2, 'แบบลัง', 'num2.jpg', 'ปริมาณ 950 CC 1 ลัง มี20ขวด ', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_import_detail`
--
ALTER TABLE `tbl_import_detail`
  ADD PRIMARY KEY (`import_detail_id`);

--
-- Indexes for table `tbl_import_head`
--
ALTER TABLE `tbl_import_head`
  ADD PRIMARY KEY (`import_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Indexes for table `tbl_order_head`
--
ALTER TABLE `tbl_order_head`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_problem`
--
ALTER TABLE `tbl_problem`
  ADD PRIMARY KEY (`problem_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_import_detail`
--
ALTER TABLE `tbl_import_detail`
  MODIFY `import_detail_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_import_head`
--
ALTER TABLE `tbl_import_head`
  MODIFY `import_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `member_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_order_head`
--
ALTER TABLE `tbl_order_head`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_problem`
--
ALTER TABLE `tbl_problem`
  MODIFY `problem_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
