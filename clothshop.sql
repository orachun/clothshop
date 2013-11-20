-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2013 at 06:04 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clothshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `product_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`product_cat_id`, `name`) VALUES
(1, 'ชุด dress'),
(2, 'เสื้อ'),
(3, 'กางเกง'),
(4, 'กระโปรง'),
(5, 'กระเป๋า');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf32_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf32_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf32_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('7fb171b545112c42099ed34f8eb0e9eb', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.65 Safari/537.36', 1384941655, 'a:2:{s:9:"USER_DATA";O:8:"stdClass":8:{s:11:"customer_id";s:1:"2";s:8:"fullname";s:11:"orachun udo";s:4:"addr";s:18:"123kow daaozzzzzaa";s:3:"tel";s:10:"1234567890";s:5:"email";s:22:"orachun.chun@gmail.com";s:15:"registered_date";s:10:"2013-08-25";s:14:"receive_update";N;s:4:"pass";s:32:"81dc9bdb52d04dc20036dbd8313ed055";}s:12:"IS_LOGGED_IN";b:1;}'),
('ad7ba366950cfae9d7e806f5a1c45661', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.65 Safari/537.36', 1384934574, '');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `color_en` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `color_th` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`color_en`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_en`, `color_th`) VALUES
('black', 'ดำ'),
('blue', 'นำ้เงิน'),
('brown', 'น้ำตาล'),
('gold', 'ทอง'),
('gray', 'เทา'),
('green', 'เขียว'),
('lightblue', 'ฟ้า'),
('pink', 'ชมพู'),
('purple', 'ม่วง'),
('red', 'แดง'),
('white', 'ขาว'),
('yellow', 'เหลือง');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `addr` mediumtext COLLATE utf32_unicode_ci,
  `tel` varchar(15) COLLATE utf32_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `registered_date` date DEFAULT NULL,
  `receive_update` tinyint(1) DEFAULT NULL COMMENT '1=Y, 0=N',
  `pass` varchar(35) COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `fullname`, `addr`, `tel`, `email`, `registered_date`, `receive_update`, `pass`) VALUES
(2, 'orachun udo', '123kow daaozzzzzaa', '1234567890', 'orachun.chun@gmail.com', '2013-08-25', NULL, '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `customer_coupon`
--

CREATE TABLE IF NOT EXISTS `customer_coupon` (
  `customer_coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `received_amount` int(11) DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  PRIMARY KEY (`customer_coupon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer_coupon`
--

INSERT INTO `customer_coupon` (`customer_coupon_id`, `customer_id`, `coupon_id`, `received_amount`, `received_date`, `expired_date`) VALUES
(1, 2, 1, 5, '2013-08-25', '2013-09-24'),
(2, 2, 2, 4, '2013-08-25', '2013-08-28'),
(3, 2, 1, 5, '2013-09-03', '2013-10-03'),
(4, 2, 2, 5, '2013-09-03', '2013-10-03'),
(5, 2, 1, 5, '2013-11-20', '2056-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE IF NOT EXISTS `customer_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `display_id` varchar(32) COLLATE utf32_unicode_ci NOT NULL DEFAULT '0',
  `customer_id` int(11) DEFAULT NULL,
  `store_order_id` int(11) DEFAULT NULL,
  `customer_coupon_id` int(11) DEFAULT NULL,
  `net_total` decimal(10,2) DEFAULT NULL,
  `receiver_name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `delivery_addr` mediumtext COLLATE utf32_unicode_ci,
  `ordered_datetime` datetime DEFAULT NULL,
  `delivery_type` tinyint(4) DEFAULT NULL,
  `status` char(1) COLLATE utf32_unicode_ci DEFAULT NULL COMMENT '''W'' = wait for payment, ''P'' = payment is informed, ''C'' = payment is checked, ''D''=delivered',
  `remark` mediumtext COLLATE utf32_unicode_ci,
  `delivered_date` date DEFAULT NULL,
  `tracking_no` varchar(32) COLLATE utf32_unicode_ci DEFAULT NULL,
  `customer_note` text COLLATE utf32_unicode_ci,
  `store_note` text COLLATE utf32_unicode_ci,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `display_id`, `customer_id`, `store_order_id`, `customer_coupon_id`, `net_total`, `receiver_name`, `delivery_addr`, `ordered_datetime`, `delivery_type`, `status`, `remark`, `delivered_date`, `tracking_no`, `customer_note`, `store_note`) VALUES
(1, 'D130906-00001-002', 2, 8, -1, 2700.00, 'orachun udo', '123kow daaozzzzzaa', '2013-09-06 12:42:25', 1, 'W', NULL, NULL, NULL, NULL, NULL),
(2, 'D131108-00002-002', 2, 8, -1, 718.00, 'orachun udo', '123kow daaozzzzzaa', '2013-11-08 16:42:34', 1, 'C', NULL, NULL, NULL, NULL, NULL),
(3, 'D131108-00003-002', 2, 8, -1, 128.00, 'orachun udo', '123kow daaozzzzzaa', '2013-11-08 17:27:52', 1, 'C', NULL, NULL, NULL, NULL, NULL),
(4, 'D131108-00004-002', 2, 8, -1, 6708.00, 'orachun udo', '123kow daaozzzzzaa\naaa\nddd\nbbb', '2013-11-08 17:34:36', 1, 'C', NULL, '2013-11-20', 'aaa12345', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

CREATE TABLE IF NOT EXISTS `delivery_type` (
  `delivery_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf32_unicode_ci DEFAULT NULL,
  `unit_cost` decimal(10,0) DEFAULT NULL,
  `free_threshold` decimal(10,0) DEFAULT NULL COMMENT 'no delivering cost if exceed this value',
  `is_discarded` char(1) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`delivery_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `delivery_type`
--

INSERT INTO `delivery_type` (`delivery_type_id`, `name`, `unit_cost`, `free_threshold`, `is_discarded`) VALUES
(1, 'พัสดุลงทะเบียน', 20, 5, 'N'),
(2, 'EMS', 50, 2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupon`
--

CREATE TABLE IF NOT EXISTS `discount_coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `discount_type` char(1) COLLATE utf32_unicode_ci DEFAULT NULL COMMENT '''P'' = percent discount, ''F'' = fixed discount',
  `coupon_type` char(1) COLLATE utf32_unicode_ci DEFAULT NULL COMMENT '(REMOVED) ''U'' = User coupon, ''S''= Store coupon',
  `amount` decimal(10,2) DEFAULT NULL,
  `amount_threshold` decimal(10,2) DEFAULT NULL,
  `valid_day` tinyint(4) DEFAULT NULL COMMENT 'number of days before expired',
  `status` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '''A''=active, ''I''=inactive',
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `discount_coupon`
--

INSERT INTO `discount_coupon` (`coupon_id`, `name`, `desc`, `discount_type`, `coupon_type`, `amount`, `amount_threshold`, `valid_day`, `status`) VALUES
(1, 'คูปองสมาชิกใหม่', 'สมาชิกใหม่ สั่งซื้อสินค้าวันนี้ รับส่วนลดทันที 5%', 'P', 'U', 0.05, 0.00, 30, 'A'),
(2, 'คูปองสมาชิกใหม่', 'สมาชิกใหม่ สั่งซื้อสินค้าวันนี้ 500 บาทขึ้นไป รับส่วนลดทันที 10%', 'P', 'U', 0.10, 500.00, 30, 'A'),
(3, 'คูปองเปิดร้านใหม่', 'สมาชิกใหม่ สั่งซื้อสินค้าวันนี้ 500 บาทขึ้นไป รับส่วนลดทันที 10%', 'P', 'S', 0.10, 500.00, 30, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `size` varchar(3) COLLATE utf32_unicode_ci DEFAULT NULL COMMENT 's,m,l,xl',
  `color` varchar(15) COLLATE utf32_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `product_id`, `order_id`, `size`, `color`, `amount`, `unit_price`) VALUES
(2, 35, 9, 'XL', 'blue', 2, 900.00),
(3, 35, 10, 'M', 'blue', 1, 900.00),
(4, 35, 10, 'L', 'blue', 2, 900.00),
(5, 35, 11, 'L', 'blue', 2, 900.00),
(6, 35, 12, 'L', 'blue', 2, 900.00),
(7, 35, 13, 'M', 'blue', 2, 900.00),
(8, 35, 14, 'M', 'blue', 2, 900.00),
(9, 35, 15, 'L', 'blue', 10, 900.00),
(10, 35, 16, 'XL', 'blue', 2, 900.00),
(11, 4, 1, 'S', 'white', 3, 880.00),
(12, 20, 2, 'L', 'gold', 1, 12.00),
(13, 13, 2, '0', 'gray', 1, 666.00),
(14, 20, 3, 'L', 'gray', 4, 12.00),
(15, 11, 4, 'XL', 'green', 1, 444.00),
(16, 11, 4, 'XL', 'green', 2, 444.00),
(17, 11, 4, 'XL', 'green', 3, 444.00),
(18, 11, 4, 'XL', 'green', 4, 444.00),
(19, 11, 4, 'XL', 'green', 5, 444.00),
(20, 20, 4, 'M', 'gold', 1, 12.00),
(21, 20, 4, 'L', 'gold', 1, 12.00),
(22, 20, 4, 'L', 'gold', 2, 12.00);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `edited_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_name` (`link_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `link_name`, `name`, `content`, `edited_datetime`) VALUES
(3, 'conditions', 'ข้อตกลงและเงื่อนไขการสั่งซื้อสินค้า', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p style="text-align: left;">ขอความกรุณาลูกค้าอ่านเพื่อทำความเข้าใจกข้อตกลงและเงื่อนไขการสั่งซื้อสินค้านะคะ เพื่อไม่ให้เกิดปัญหาขึ้นภายหลังค่ะ</p>\n<p>1. สินค้า Pre-order สามารถสั่งซื้อได้ตั้งแต่ 1 ตัวค่ะ ไม่มีขั้นต่ำ สั่งซื้อกี่ชิ้นก็ได้</p>\n<p>2. ทางร้านเป็นตัวกลางในการสั่งเท่านั้นนะคะ ไม่เคยได้เห็นและสัมผัสจริง จึงไม่สามารถตรวจสอบสินค้าให้ก่อนได้ ทางร้านทำได้แค่เพียงสั่งสินค้าตามที่ลูกค้าสั่งมาก&nbsp;ดังนั้นเราไม่รับเปลี่ยนหรือคืนสินค้าทุกกรณีนะคะ ยกเว้นกรณีเป็นความผิดพลาดจากร้าน เนื่องจาก&nbsp;ผิดขนาด ผิดสีโดยสิ้นเชิง (ยกเว้นสีเพี้ยน) สามารถเปลี่ยนหรือขอคืนเงินได้ค่ะ โดยสินค้าต้องคงสภาพเดิม ไม่แกะป้ายออก</p>\n<p>3.ราคาสินค้าที่แสดงไม่รวมค่าจัดส่งในประเทศนะคะ ค่าจัดส่งจะแสดงอีกครั้งขณะทำการส่งคำสั่งซื้อสินค้าค่ะ</p>\n<p>4.ทางร้านไม่สามารถยืนยันได้ว่าจะได้สินค้าครบทุกชิ้นหรือไม่ เพราะบางครั้งทาง Supplier&nbsp;ในต่างประเทศไม่ได้ Update Stock ทำให้ร้านค้าคิดว่าสินค้ายังมีอยู่จริง พอได้รับสินค้าจึงไม่ได้ครบตามที่สั่ง ลูกค้าที่ได้รับสินค้าไม่ครบ ทางร้านค้าจะคืนเงินให้ทันทีค่ะ</p>\n<p>5. ทางร้านขอรับเฉพาะลูกค้าที่สามารถรอได้นะคะ เพราะระยะเวลาที่สินค้าจะถึงลูกค้าคือ 20- 25 วัน หรืออาจเร็วกว่านั้น เพราะขอต้องส่งจากต่างประเทศมาทางเรือ ทำให้อาจมีช้าบ้าง ต้องขออภัยไว้ด้วยนะคะ และขอความร่วมมือก่อนสั่งสินค้าควรตัดสินใจให้ดีรอบคอบ ก่อนตัดสินใจสั่งซื้อนะคะ</p>\n<p>6. กำหนดการส่งของที่แจ้งล่วงหน้าไว้ อาจมีการเปลี่ยนแปลง เนื่องจากการสั่งสินค้าจากต่างประเทศ อาจะมีความคลาดเคลื่อนในเรื่องของระยะเวลา ด้วยสาเหตุที่อยู่เหนือการควบคุม ดังนั้นทางร้านจะขอรับเฉพาะลูกค้าที่สามารถยอมรับกับข้อตกลงเหล่านี้ได้</p>\n<p>&nbsp;</p>\n</body>\n</html>', '0000-00-00 00:00:00'),
(4, 'order_info', 'วิธีการสั่งซื้อและชำระเงิน', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p style="text-align: left;">1. เลือกชมสินค้า เลือกขนาด สี จำนวน แล้วคลิกปุ่ม "ซื้อ" ระบบจะแจ้งว่าได้เพิ่มรายการสินค้าแล้ว</p>\n<p>2. หากเลือกซื้อสินค้าครบทุกชิ้นแล้ว ให้คลิกที่เมนู Order ด้านขวา</p>\n<p>3. ในส่วนนี้หากต้องการแก้ไขจำนวนสินค้าที่ซื้อ ให้พิมพ์ตัวเลขลงในกล่องข้อความข้างรูปสินค้าที่เลือก แล้วคลิกปุ่มแก้ไขจำนวน(รูปดินสอ) หากต้องการลบสินค้าที่เลือก คลิกที่ปุ่มลบ(รูปกากบาท)</p>\n<p>4. คลิกที่ปุ่ม "ส่งคำสั่งซื้อสินค้า"</p>\n<p>5. ตรวจสอบรายการสินค้า แล้วคลิกปุ่ม "ต่อไป"</p>\n<p>6. เลือกคูปองส่วนลดที่ต้องการใช้ (ถ้ามี) หรือทำการลงชื่อเข้าใช้เพื่อเลือกใช้คูปอง&nbsp;หลังจากนั้น เลือกวิธีการจัดส่งสินค้า แล้วคลิกปุ่ม "ต่อไป"</p>\n<p><span style="line-height: 1.6em;">7. กรอกรายละเอียดผู้รับสินค้า ตรวจสอบให้ถูกต้องและคลิกปุ่ม "ต่อไป"</span></p>\n<p>8. ตรวจสอบรายละเอียดให้ถูกต้อง หากไม่ถูกต้องให้คลิกปุ่ม "กลับ" เพื่อกลับไปแก้ไข หากถูกต้องแล้ว ให้คลิก "ยอมรับเงื่อนไขและยืนยันคำสั่งซื้อสินค้า"</p>\n<p>9. ระบบจะแสดงใบสั่งซื้อสินค้า และส่งอีเมล์ไปยังอีเมล์แอดเดรสที่ใส่ไว้ในขั้นตอนที่ 7.</p>\n<p>10. โอนเงินชำระค่าสินค้า รายละเอียดการชำระเงินดูได้ที่&nbsp;<a href="../others/page/payment_method">รายละเอียดการชำระเงิน</a>&nbsp;</p>\n<p>11. เมื่อโอนเงินชำระค่าสินค้าแล้ว ให้คลิกที่เมนู Payment ด้านขวา กรอกรายละเอียดการชำระเงินและไฟล์หลักฐานการโอนเงิน แล้วคลิกปุ่ม "แจ้งชำระเงิน" เป็นอันเสร็จสิ้น</p>\n<p>12. หลังจากทางร้านได้รับสินค้า จะทำการจัดส่งให้ตามที่อยู่ที่กรอกไว้ให้เร็วที่สุด</p>\n</body>\n</html>', '0000-00-00 00:00:00'),
(5, 'payment_method', 'รายละเอียดการชำระเงิน', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p style="text-align: center;"><span style="font-size: large;"><strong><span style="text-decoration: underline;">&nbsp;</span></strong></span></p>\n<p>......</p>\n</body>\n</html>', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_inform`
--

CREATE TABLE IF NOT EXISTS `payment_inform` (
  `order_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `inform_date` datetime DEFAULT NULL,
  `paid_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `payment_inform`
--

INSERT INTO `payment_inform` (`order_id`, `amount`, `inform_date`, `paid_date`) VALUES
(4, 0.00, '2013-11-08 17:39:50', '2013-11-08 17:35:00'),
(12, 0.00, '2013-08-29 18:15:50', '2013-08-29 18:12:00'),
(13, 0.00, '2013-09-03 16:54:11', '2013-09-03 16:00:00'),
(14, 12.00, '2013-09-03 17:01:01', '2013-09-03 17:00:00'),
(15, 0.00, '2013-09-03 16:54:26', '2013-09-03 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT '0',
  `display_id` varchar(32) COLLATE utf32_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(256) COLLATE utf32_unicode_ci DEFAULT NULL,
  `desc` mediumtext COLLATE utf32_unicode_ci,
  `cost` decimal(10,2) DEFAULT '0.00' COMMENT 'ราคาทุน',
  `unit_price` decimal(10,2) DEFAULT NULL,
  `price_before_sale` decimal(10,2) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supplier_product_code` varchar(32) COLLATE utf32_unicode_ci DEFAULT 'NULL',
  `supplier_product_url` varchar(256) COLLATE utf32_unicode_ci DEFAULT '',
  `views` int(11) DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `cat_id`, `display_id`, `name`, `desc`, `cost`, `unit_price`, `price_before_sale`, `added_date`, `supplier_id`, `supplier_product_code`, `supplier_product_url`, `views`) VALUES
(3, 1, 'P130914-0003', 'Modal models big yards loose summer thin section was thin harem pants casual pants yoga', 'Spike Notification:\n\n2013 popular chiffon shirt!\n\nSuper wild! Do not pick the body, do not pick the age!\n\nAdded was berserk 7000!\n\nBaby was so popular, was invited to spike] [discount 800 exclusive events!\n\nUsually discount 69 yuan! Activities as long as 49 yuan price now!\n\nOnly one day, long sleeve optional!\n\nAs tight inventories, within 30 minutes of non-payment to close the transaction!\n\nQuickly grab it! ! ! !\n\n \n\nLoss 49 yuan! European and American big fashion chiffon shirt!\n\nLong sleeve optional!\n\n Send shipping insurance ! 7 days no reason returned!\n\nThe event is purely deficit Costly , limited number of baby, early morning to buy affordable, pro Come and buy!\n\n(Because of a loss, the baby will be shipped within 3 days! Finally one day, come buy.)', 100.00, 200.00, -1.00, '2013-09-14', 0, 'aaa', '', 1),
(4, 1, 'P130914-0004', 'aaaaa', 'aaaaa', 0.00, 0.00, -1.00, '2013-09-14', 0, '', '', 8),
(5, 1, 'P130914-0005', 'bbb', 'bbb', 1.00, 1.00, -1.00, '2013-09-14', 0, '', '', 3),
(6, 1, 'P130914-0006', '123', '123', 123.00, 123.00, -1.00, '2013-09-14', 0, '', '', 4),
(7, 1, 'P130914-0007', 'aaa', '123', 123.00, 123.00, -1.00, '2013-09-14', 0, '', '', 4),
(8, 1, 'P130914-0008', 'zzz', 'zzz', 33.00, 33.00, -1.00, '2013-09-14', 0, '', '', 4),
(9, 1, 'P130914-0009', '333', '333', 333.00, 333.00, -1.00, '2013-09-14', 0, '', '', 0),
(10, 1, 'P130914-0010', 'aaa', 'aaa', 999.00, 999.00, -1.00, '2013-09-14', 0, '', '', 1),
(11, 1, 'P130914-0011', 'qqq', 'qqq', 444.00, 444.00, -1.00, '2013-09-14', 0, '', '', 110),
(12, 1, 'P130914-0012', '555', '555', 55.00, 555.00, -1.00, '2013-09-14', 0, '', '', 14),
(13, 1, 'P130914-0013', '666', '', 666.00, 666.00, -1.00, '2013-09-14', 0, '', '', 176),
(14, 1, 'P131108-0014', '2013秋装连衣裙女新款韩版大码修身显瘦百搭 包臀紧身长袖打底裙', '主图来源: 其他分销图货号: 8228风格: 通勤组合形式: 单件裙长: 短裙(76-90厘米)款式: 其他款式袖长: 长袖领型: 圆领袖型: 常规袖腰型: 中腰衣门襟: 套头裙型: A字裙图案: 纯色流行元素/工艺: 抽褶品牌: 纤依缘材质: 织锦主成份含量: 95%以上主材质: 聚酯纤维年份季节: 2013秋季颜色分类: 黑色 玫红色 湖蓝色 橘色 宝蓝色 红色 牛仔蓝 皮粉色 杏色 姜黄尺码: S（高贵气质） M（独家质量） L（', 180.00, 250.00, -1.00, '2013-11-08', 0, 'http://item.taobao.com/item.htm?', '', 2),
(15, 1, 'P131108-0015', '2013秋装连衣裙女新款韩版大码修身显瘦百搭 包臀紧身长袖打底裙', '主图来源: 其他分销图货号: 8228风格: 通勤组合形式: 单件裙长: 短裙(76-90厘米)款式: 其他款式袖长: 长袖领型: 圆领袖型: 常规袖腰型: 中腰衣门襟: 套头裙型: A字裙图案: 纯色流行元素/工艺: 抽褶品牌: 纤依缘材质: 织锦主成份含量: 95%以上主材质: 聚酯纤维年份季节: 2013秋季颜色分类: 黑色 玫红色 湖蓝色 橘色 宝蓝色 红色 牛仔蓝 皮粉色 杏色 姜黄尺码: S（高贵气质） M（独家质量） L（', 180.00, 250.00, -1.00, '2013-11-08', 0, 'http://item.taobao.com/item.htm?', '', 2),
(16, 1, 'P131108-16', 'aa', 'aa', 11.00, 111.00, -1.00, '2013-11-08', 0, '', '', 2),
(17, 1, 'P131108-17', 'aaa', 'aaa', 123.00, 321.00, -1.00, '2013-11-08', 0, '', '', 1),
(18, 1, 'P131108-18', '1', '1', 1.00, 1.00, -1.00, '2013-11-08', 0, '', '', 1),
(19, 1, 'P131108-19', '1', '1', 1.00, 1.00, -1.00, '2013-11-08', 0, '', '', 0),
(20, 1, 'P131108-20', 'aaa', 'aaa', 12.00, 12.00, -1.00, '2013-11-08', 0, '', '', 9),
(21, 1, 'P131108-21', '', '', 0.00, 0.00, -1.00, '2013-11-08', 0, '', '', 0),
(22, 1, 'P131108-22', '', '', 0.00, 0.00, -1.00, '2013-11-08', 0, '', '', 0),
(23, 1, 'P1118-23', '2013 fall and winter clothes woolen jacket coat female Korean Long Slim was thin ladies cash', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p><strong>Tips, OUR default STO mainland rhyme delivery</strong><strong>&nbsp;postal packets sent within its own message. need other express, please leave a message or contact the service&nbsp;</strong><strong>,</strong></p>\n<p><a title="tpro_116831"><strong><span style="font-family: simhei; font-size: x-large;"><strong>Super Special!&nbsp;Limited number of grab while stock lasts!&nbsp;Only for the red popularity, you grab is earned!&nbsp;First come first shipment!</strong></span></strong></a><strong>Our commitment to the clothes you have any reason not satisfied, you can 7 days no reason to return, allowing you to buy the rest assured to wear comfortable, no worries&nbsp;,</strong></p>\n</body>\n</html>', 500.00, 700.00, -1.00, '2013-11-18', NULL, NULL, '', 2),
(24, 1, 'P1118-24', '', '', 0.00, 0.00, -1.00, '2013-11-18', NULL, 'NULL', '', 0),
(25, 1, 'P1118-25', '', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n\n</body>\n</html>', 0.00, 0.00, -1.00, '2013-11-18', NULL, 'NULL', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE IF NOT EXISTS `product_cat` (
  `product_id` int(11) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`product_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`product_id`, `product_cat_id`) VALUES
(1, 1),
(9, 1),
(10, 4),
(11, 1),
(11, 3),
(12, 1),
(12, 2),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_property`
--

CREATE TABLE IF NOT EXISTS `product_property` (
  `prop_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`prop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=87 ;

--
-- Dumping data for table `product_property`
--

INSERT INTO `product_property` (`prop_id`, `product_id`, `key`, `value`, `value2`, `value3`) VALUES
(1, 3, 'size', 'R', NULL, NULL),
(2, 3, 'size', 'S', NULL, NULL),
(3, 3, 'color', 'blue', NULL, NULL),
(4, 3, 'color', 'brown', NULL, NULL),
(5, 3, 'color', 'gray', NULL, NULL),
(6, 4, 'size', 'S', NULL, NULL),
(7, 4, 'size', 'M', NULL, NULL),
(8, 4, 'color', 'brown', NULL, NULL),
(9, 4, 'color', 'gold', NULL, NULL),
(10, 5, 'size', 'R', NULL, NULL),
(11, 5, 'size', 'S', NULL, NULL),
(12, 5, 'color', 'blue', NULL, NULL),
(13, 5, 'color', 'gray', NULL, NULL),
(14, 6, 'color', 'gray', 'เทา', NULL),
(15, 6, 'color', 'green', 'เขียว', NULL),
(16, 7, 'size', 'L', NULL, NULL),
(17, 7, 'size', 'XL', NULL, NULL),
(18, 7, 'size', 'XXL', NULL, NULL),
(19, 7, 'color', 'gray', 'เทา', NULL),
(20, 7, 'color', 'green', 'เขียว', NULL),
(21, 7, 'color', 'pink', 'ชมพู', NULL),
(22, 8, 'size', 'XL', NULL, NULL),
(23, 8, 'size', 'XXL', NULL, NULL),
(24, 8, 'color', 'gold', 'ทอง', NULL),
(25, 8, 'color', 'green', 'เขียว', NULL),
(26, 9, 'size', 'XL', NULL, NULL),
(27, 9, 'size', 'XXL', NULL, NULL),
(28, 9, 'color', 'gold', 'ทอง', NULL),
(29, 9, 'color', 'gray', 'เทา', NULL),
(30, 10, 'size', 'XL', NULL, NULL),
(31, 10, 'size', 'XXL', NULL, NULL),
(32, 10, 'color', 'gold', 'ทอง', NULL),
(33, 10, 'color', 'green', 'เขียว', NULL),
(34, 11, 'size', 'XL', NULL, NULL),
(35, 11, 'size', 'XXL', NULL, NULL),
(36, 11, 'color', 'green', 'เขียว', NULL),
(37, 11, 'color', 'lightblue', 'ฟ้า', NULL),
(38, 12, 'size', 'XL', NULL, NULL),
(39, 12, 'size', 'XXL', NULL, NULL),
(40, 12, 'color', 'gray', 'เทา', NULL),
(41, 12, 'color', 'green', 'เขียว', NULL),
(42, 12, 'color', 'pink', 'ชมพู', NULL),
(43, 13, 'color', 'gray', 'เทา', NULL),
(44, 13, 'color', 'green', 'เขียว', NULL),
(45, 13, 'color', 'lightblue', 'ฟ้า', NULL),
(46, 14, 'size', 'R', NULL, NULL),
(47, 14, 'color', 'blue', 'นำ้เงิน', NULL),
(48, 14, 'color', 'brown', 'น้ำตาล', NULL),
(49, 14, 'color', 'green', 'เขียว', NULL),
(50, 14, 'color', 'pink', 'ชมพู', NULL),
(51, 14, 'color', 'red', 'แดง', NULL),
(52, 15, 'size', 'R', NULL, NULL),
(53, 15, 'color', 'blue', 'นำ้เงิน', NULL),
(54, 15, 'color', 'brown', 'น้ำตาล', NULL),
(55, 15, 'color', 'green', 'เขียว', NULL),
(56, 15, 'color', 'pink', 'ชมพู', NULL),
(57, 15, 'color', 'red', 'แดง', NULL),
(58, 16, 'size', 'R', NULL, NULL),
(59, 16, 'size', 'S', NULL, NULL),
(60, 16, 'size', 'M', NULL, NULL),
(61, 16, 'color', 'black', 'ดำ', NULL),
(62, 16, 'color', 'blue', 'นำ้เงิน', NULL),
(63, 16, 'color', 'brown', 'น้ำตาล', NULL),
(64, 17, 'size', 'S', NULL, NULL),
(65, 17, 'size', 'M', NULL, NULL),
(66, 17, 'size', 'L', NULL, NULL),
(67, 17, 'color', 'brown', 'น้ำตาล', NULL),
(68, 17, 'color', 'gold', 'ทอง', NULL),
(69, 17, 'color', 'gray', 'เทา', NULL),
(70, 18, 'size', 'M', NULL, NULL),
(71, 18, 'color', 'brown', 'น้ำตาล', NULL),
(72, 19, 'size', 'M', NULL, NULL),
(73, 19, 'size', 'L', NULL, NULL),
(74, 19, 'color', 'blue', 'นำ้เงิน', NULL),
(75, 19, 'color', 'gold', 'ทอง', NULL),
(76, 20, 'size', 'M', NULL, NULL),
(77, 20, 'size', 'L', NULL, NULL),
(78, 20, 'color', 'gold', 'ทอง', NULL),
(79, 20, 'color', 'gray', 'เทา', NULL),
(80, 23, 'size', 'S', NULL, NULL),
(81, 23, 'size', 'M', NULL, NULL),
(82, 23, 'size', 'L', NULL, NULL),
(83, 23, 'color', 'blue', 'นำ้เงิน', NULL),
(84, 23, 'color', 'brown', 'น้ำตาล', NULL),
(85, 23, 'color', 'lightblue', 'ฟ้า', NULL),
(86, 23, 'color', 'pink', 'ชมพู', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE IF NOT EXISTS `product_tag` (
  `product_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `tag` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci COMMENT='sale, featured, etc.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`slide_id`, `img`, `link`) VALUES
(5, 'uploads/slides/521f72be7d70c96205114x4z]9(s[c0mHulutech-Banner-Application.jpg', 'index.html'),
(6, 'uploads/slides/521f72d9d64cd61131795x4z]9(s[c0mJob_Fair_banner_by_javachipdoodle.jpg', 'index.php/product/detail/37');

-- --------------------------------------------------------

--
-- Table structure for table `store_order`
--

CREATE TABLE IF NOT EXISTS `store_order` (
  `store_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `close_date` date DEFAULT NULL COMMENT 'วันที่ปิดรับ order',
  `status` char(1) COLLATE utf32_unicode_ci DEFAULT NULL COMMENT '''C''=ปิดรับ order,  ''O''= เปิดรับอยู่, ''D''=ส่งของแล้ว',
  PRIMARY KEY (`store_order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `store_order`
--

INSERT INTO `store_order` (`store_order_id`, `close_date`, `status`) VALUES
(8, '2013-08-08', 'C'),
(9, '2013-09-09', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf32_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `url`) VALUES
(15, 'Wholesale Kingdom', 'http://www.wholesalekingdom.net/'),
(16, 'http://tianshidejiayi.taobao.com', 'http://tianshidejiayi.taobao.com/');

-- --------------------------------------------------------

--
-- Table structure for table `view_sql`
--

CREATE TABLE IF NOT EXISTS `view_sql` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `sql` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `view_sql`
--

INSERT INTO `view_sql` (`id`, `name`, `sql`) VALUES
(1, '_product_info', 'SELECT p.product_id, display_id, p.name,  `desc` , unit_price, price_before_sale, added_date, views, p.cat_id, c.name AS category\nFROM product p\nJOIN category c ON c.product_cat_id = p.cat_id'),
(2, '_coupon_usage', 'SELECT cc.customer_id, cc.customer_coupon_id, cc.coupon_id, cc.received_amount AS received, COUNT( co.order_id ) AS used, cc.received_amount - COUNT( co.order_id ) AS remain, received_date, expired_date\nFROM customer_order co\nRIGHT JOIN customer_coupon cc ON co.customer_coupon_id = cc.customer_coupon_id\nGROUP BY cc.customer_coupon_id'),
(3, '_customer_coupon_info', 'SELECT cc.customer_coupon_id, cc.customer_id, dc.coupon_id, dc.discount_type, coupon_type, amount, amount_threshold\nFROM customer_coupon cc\nJOIN discount_coupon dc ON cc.coupon_id = dc.coupon_id'),
(4, '_customer_coupon_display', 'SELECT customer_id,\r\ncustomer_coupon_id,\r\ndc.coupon_id,\r\nreceived,\r\nused,\r\nremain,\r\nreceived_date,\r\nexpired_date,\r\nname,\r\n`desc`,\r\ndiscount_type,\r\ncoupon_type,\r\namount,\r\namount_threshold\r\n\r\nFROM `_coupon_usage` cu join discount_coupon dc on cu.coupon_id = dc.coupon_id'),
(5, '_customer_ordered_item', 'SELECT p.display_id, p.name, i . * \r\nFROM product p\r\nJOIN  `order_item` i ON p.product_id = i.product_id'),
(6, '_sold_product', 'SELECT p . * , IFNULL( SUM( amount ) , 0 ) AS bought\r\nFROM order_item oi\r\nRIGHT JOIN product p ON oi.product_id = p.product_id\r\nGROUP BY p.product_id'),
(7, '_customer_order', 'SELECT co . * , pi.paid_date\r\nFROM  `customer_order` co\r\nLEFT JOIN payment_inform pi ON co.order_id = pi.order_id'),
(8, '_store_order', 'select o.product_id, o.size, o.color, o.amount, p.supplier_product_url from\n(\nSELECT product_id, size, color, sum(oi.amount) as amount\nFROM customer_order co \njoin order_item oi on co.order_id = oi.order_id\nwhere co.status = ''C''\ngroup by oi.product_id, oi.size, oi.color\n) o\njoin product p on o.product_id = p.product_id');

-- --------------------------------------------------------

--
-- Stand-in structure for view `_coupon_usage`
--
CREATE TABLE IF NOT EXISTS `_coupon_usage` (
`customer_id` int(11)
,`customer_coupon_id` int(11)
,`coupon_id` int(11)
,`received` int(11)
,`used` bigint(21)
,`remain` bigint(22)
,`received_date` date
,`expired_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_coupon_display`
--
CREATE TABLE IF NOT EXISTS `_customer_coupon_display` (
`customer_id` int(11)
,`customer_coupon_id` int(11)
,`coupon_id` int(11)
,`received` int(11)
,`used` bigint(21)
,`remain` bigint(22)
,`received_date` date
,`expired_date` date
,`name` varchar(255)
,`desc` varchar(255)
,`discount_type` char(1)
,`coupon_type` char(1)
,`amount` decimal(10,2)
,`amount_threshold` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_coupon_info`
--
CREATE TABLE IF NOT EXISTS `_customer_coupon_info` (
`customer_coupon_id` int(11)
,`customer_id` int(11)
,`coupon_id` int(11)
,`discount_type` char(1)
,`coupon_type` char(1)
,`amount` decimal(10,2)
,`amount_threshold` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_order`
--
CREATE TABLE IF NOT EXISTS `_customer_order` (
`order_id` int(11)
,`display_id` varchar(32)
,`customer_id` int(11)
,`store_order_id` int(11)
,`customer_coupon_id` int(11)
,`net_total` decimal(10,2)
,`receiver_name` varchar(255)
,`delivery_addr` mediumtext
,`ordered_datetime` datetime
,`delivery_type` tinyint(4)
,`status` char(1)
,`remark` mediumtext
,`delivered_date` date
,`tracking_no` varchar(32)
,`paid_date` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_ordered_item`
--
CREATE TABLE IF NOT EXISTS `_customer_ordered_item` (
`display_id` varchar(32)
,`name` varchar(256)
,`order_item_id` int(11)
,`product_id` int(11)
,`order_id` int(11)
,`size` varchar(3)
,`color` varchar(15)
,`amount` int(11)
,`unit_price` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_product_info`
--
CREATE TABLE IF NOT EXISTS `_product_info` (
`product_id` int(11)
,`display_id` varchar(32)
,`name` varchar(256)
,`desc` mediumtext
,`unit_price` decimal(10,2)
,`price_before_sale` decimal(10,2)
,`added_date` date
,`views` int(11)
,`cat_id` int(11)
,`category` varchar(255)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_sold_product`
--
CREATE TABLE IF NOT EXISTS `_sold_product` (
`product_id` int(11)
,`cat_id` int(11)
,`display_id` varchar(32)
,`name` varchar(256)
,`desc` mediumtext
,`cost` decimal(10,2)
,`unit_price` decimal(10,2)
,`price_before_sale` decimal(10,2)
,`added_date` date
,`supplier_id` int(11)
,`supplier_product_code` varchar(32)
,`views` int(11)
,`bought` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Structure for view `_coupon_usage`
--
DROP TABLE IF EXISTS `_coupon_usage`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_coupon_usage` AS select `cc`.`customer_id` AS `customer_id`,`cc`.`customer_coupon_id` AS `customer_coupon_id`,`cc`.`coupon_id` AS `coupon_id`,`cc`.`received_amount` AS `received`,count(`co`.`order_id`) AS `used`,(`cc`.`received_amount` - count(`co`.`order_id`)) AS `remain`,`cc`.`received_date` AS `received_date`,`cc`.`expired_date` AS `expired_date` from (`customer_coupon` `cc` left join `customer_order` `co` on((`co`.`customer_coupon_id` = `cc`.`customer_coupon_id`))) group by `cc`.`customer_coupon_id`;

-- --------------------------------------------------------

--
-- Structure for view `_customer_coupon_display`
--
DROP TABLE IF EXISTS `_customer_coupon_display`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_customer_coupon_display` AS select `cu`.`customer_id` AS `customer_id`,`cu`.`customer_coupon_id` AS `customer_coupon_id`,`dc`.`coupon_id` AS `coupon_id`,`cu`.`received` AS `received`,`cu`.`used` AS `used`,`cu`.`remain` AS `remain`,`cu`.`received_date` AS `received_date`,`cu`.`expired_date` AS `expired_date`,`dc`.`name` AS `name`,`dc`.`desc` AS `desc`,`dc`.`discount_type` AS `discount_type`,`dc`.`coupon_type` AS `coupon_type`,`dc`.`amount` AS `amount`,`dc`.`amount_threshold` AS `amount_threshold` from (`_coupon_usage` `cu` join `discount_coupon` `dc` on((`cu`.`coupon_id` = `dc`.`coupon_id`)));

-- --------------------------------------------------------

--
-- Structure for view `_customer_coupon_info`
--
DROP TABLE IF EXISTS `_customer_coupon_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_customer_coupon_info` AS select `cc`.`customer_coupon_id` AS `customer_coupon_id`,`cc`.`customer_id` AS `customer_id`,`dc`.`coupon_id` AS `coupon_id`,`dc`.`discount_type` AS `discount_type`,`dc`.`coupon_type` AS `coupon_type`,`dc`.`amount` AS `amount`,`dc`.`amount_threshold` AS `amount_threshold` from (`customer_coupon` `cc` join `discount_coupon` `dc` on((`cc`.`coupon_id` = `dc`.`coupon_id`)));

-- --------------------------------------------------------

--
-- Structure for view `_customer_order`
--
DROP TABLE IF EXISTS `_customer_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_customer_order` AS select `co`.`order_id` AS `order_id`,`co`.`display_id` AS `display_id`,`co`.`customer_id` AS `customer_id`,`co`.`store_order_id` AS `store_order_id`,`co`.`customer_coupon_id` AS `customer_coupon_id`,`co`.`net_total` AS `net_total`,`co`.`receiver_name` AS `receiver_name`,`co`.`delivery_addr` AS `delivery_addr`,`co`.`ordered_datetime` AS `ordered_datetime`,`co`.`delivery_type` AS `delivery_type`,`co`.`status` AS `status`,`co`.`remark` AS `remark`,`co`.`delivered_date` AS `delivered_date`,`co`.`tracking_no` AS `tracking_no`,`pi`.`paid_date` AS `paid_date` from (`customer_order` `co` left join `payment_inform` `pi` on((`co`.`order_id` = `pi`.`order_id`)));

-- --------------------------------------------------------

--
-- Structure for view `_customer_ordered_item`
--
DROP TABLE IF EXISTS `_customer_ordered_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_customer_ordered_item` AS select `p`.`display_id` AS `display_id`,`p`.`name` AS `name`,`i`.`order_item_id` AS `order_item_id`,`i`.`product_id` AS `product_id`,`i`.`order_id` AS `order_id`,`i`.`size` AS `size`,`i`.`color` AS `color`,`i`.`amount` AS `amount`,`i`.`unit_price` AS `unit_price` from (`product` `p` join `order_item` `i` on((`p`.`product_id` = `i`.`product_id`))) where 1;

-- --------------------------------------------------------

--
-- Structure for view `_product_info`
--
DROP TABLE IF EXISTS `_product_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_product_info` AS select `p`.`product_id` AS `product_id`,`p`.`display_id` AS `display_id`,`p`.`name` AS `name`,`p`.`desc` AS `desc`,`p`.`unit_price` AS `unit_price`,`p`.`price_before_sale` AS `price_before_sale`,`p`.`added_date` AS `added_date`,`p`.`views` AS `views`,`p`.`cat_id` AS `cat_id`,`c`.`name` AS `category` from (`product` `p` join `category` `c` on((`c`.`product_cat_id` = `p`.`cat_id`)));

-- --------------------------------------------------------

--
-- Structure for view `_sold_product`
--
DROP TABLE IF EXISTS `_sold_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_sold_product` AS select `p`.`product_id` AS `product_id`,`p`.`cat_id` AS `cat_id`,`p`.`display_id` AS `display_id`,`p`.`name` AS `name`,`p`.`desc` AS `desc`,`p`.`cost` AS `cost`,`p`.`unit_price` AS `unit_price`,`p`.`price_before_sale` AS `price_before_sale`,`p`.`added_date` AS `added_date`,`p`.`supplier_id` AS `supplier_id`,`p`.`supplier_product_code` AS `supplier_product_code`,`p`.`views` AS `views`,ifnull(sum(`oi`.`amount`),0) AS `bought` from (`product` `p` left join `order_item` `oi` on((`oi`.`product_id` = `p`.`product_id`))) group by `p`.`product_id`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
