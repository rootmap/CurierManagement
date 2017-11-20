-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2017 at 03:01 AM
-- Server version: 5.5.58-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spxce_quriar`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorize_user`
--

CREATE TABLE `authorize_user` (
  `id` int(20) NOT NULL,
  `pc_name` text,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorize_user`
--

INSERT INTO `authorize_user` (`id`, `pc_name`, `date`, `status`) VALUES
(1, 'SUL-LABPC-11', '2015-09-15', 1),
(2, 'fahad-PC', NULL, NULL),
(4, 'Khairul-PC', NULL, NULL),
(5, 'SUL-Soft-PC', '2015-11-25', 1),
(7, 'USER-PC-Monira', '2015-12-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cash_on_delivery`
--

CREATE TABLE `cash_on_delivery` (
  `id` int(20) NOT NULL,
  `division_id` int(20) DEFAULT NULL,
  `district_id` int(20) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cash_on_delivery`
--

INSERT INTO `cash_on_delivery` (`id`, `division_id`, `district_id`, `price`, `date`, `status`) VALUES
(1, 1, 1, '100', '2017-11-07', 1),
(2, 1, 2, '150', '2017-11-07', 1),
(3, 1, 3, '150', '2017-11-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `date`, `status`) VALUES
(1, 'General', '2017-11-07', 1),
(2, 'courier', '2017-11-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `custom_table_field`
--

CREATE TABLE `custom_table_field` (
  `id` int(20) NOT NULL,
  `table_id` int(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_table_field`
--

INSERT INTO `custom_table_field` (`id`, `table_id`, `name`, `date`, `status`) VALUES
(203, 58, 'namess', '2017-09-29', 1),
(274, 28, 'name', '2017-11-07', 1),
(275, 29, 'category_id', '2017-11-07', 1),
(276, 29, 'name', '2017-11-07', 1),
(277, 30, 'name', '2017-11-07', 1),
(278, 31, 'unit_id', '2017-11-07', 1),
(279, 31, 'name', '2017-11-07', 1),
(280, 32, 'name', '2017-11-07', 1),
(281, 33, 'category_id', '2017-11-07', 1),
(282, 33, 'sub_category_id', '2017-11-07', 1),
(283, 33, 'unit_id', '2017-11-07', 1),
(284, 33, 'size_id', '2017-11-07', 1),
(285, 33, 'product_type_id', '2017-11-07', 1),
(286, 33, 'price', '2017-11-07', 1),
(287, 34, 'name', '2017-11-07', 1),
(288, 35, 'division_id', '2017-11-07', 1),
(289, 35, 'name', '2017-11-07', 1),
(290, 36, 'division_id', '2017-11-07', 1),
(291, 36, 'district_id', '2017-11-07', 1),
(292, 36, 'price', '2017-11-07', 1),
(294, 38, 'name', '2017-11-08', 1),
(295, 39, 'name', '2017-11-08', 1),
(296, 39, 'is_price_active', '2017-11-08', 1),
(308, 41, 'tracking_no', '2017-11-08', 1),
(309, 41, 'category_id', '2017-11-08', 1),
(310, 41, 'sub_category_id', '2017-11-08', 1),
(311, 41, 'unit_id', '2017-11-08', 1),
(312, 41, 'size_id', '2017-11-08', 1),
(313, 41, 'product_type_id', '2017-11-08', 1),
(314, 41, 'quriar_receive_type_id', '2017-11-08', 1),
(315, 41, 'delivery_type_id', '2017-11-08', 1),
(316, 41, 'delivery_area', '2017-11-08', 1),
(317, 41, 'price', '2017-11-08', 1),
(318, 41, 'quriar_detail', '2017-11-08', 1),
(319, 41, 'special_remarks', '2017-11-08', 1),
(320, 41, 'quriar_status', '2017-11-08', 1),
(323, 43, 'tracking_no', '2017-11-10', 1),
(324, 43, 'send_from', '2017-11-10', 1),
(325, 43, 'receive_from', '2017-11-10', 1),
(326, 44, 'tracking_no', '2017-11-11', 1),
(327, 44, 'quriar_status', '2017-11-11', 1),
(328, 45, 'site_name', '2017-11-11', 1),
(329, 45, 'site_title', '2017-11-11', 1),
(330, 45, 'contact_number', '2017-11-11', 1),
(331, 45, 'facebook', '2017-11-11', 1),
(332, 45, 'twitter', '2017-11-11', 1),
(333, 45, 'google_plus', '2017-11-11', 1),
(334, 45, 'site_logo', '2017-11-11', 1),
(340, 48, 'name', '2017-11-11', 1),
(341, 48, 'detail', '2017-11-11', 1),
(342, 48, 'page_status', '2017-11-11', 1),
(343, 49, 'tracking_no', '2017-11-13', 1),
(344, 49, 'division_id', '2017-11-13', 1),
(345, 49, 'district_id', '2017-11-13', 1),
(346, 50, 'tracking_no', '2017-11-13', 1),
(347, 50, 'division_id', '2017-11-13', 1),
(348, 50, 'district_id', '2017-11-13', 1),
(349, 51, 'name', '2017-11-13', 1),
(352, 53, 'user_type_id', '2017-11-13', 1),
(353, 53, 'page_name', '2017-11-13', 1),
(354, 53, 'page_link_file_name', '2017-11-13', 1),
(355, 54, 'user_type_id', '2017-11-13', 1),
(356, 54, 'user_id', '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_product_detail`
--

CREATE TABLE `delivery_product_detail` (
  `id` int(20) NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division_id` int(20) DEFAULT NULL,
  `district_id` int(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_product_detail`
--

INSERT INTO `delivery_product_detail` (`id`, `tracking_no`, `division_id`, `district_id`, `date`, `status`) VALUES
(1, 'Q1510583578', 1, 1, '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

CREATE TABLE `delivery_type` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_price_active` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery_type`
--

INSERT INTO `delivery_type` (`id`, `name`, `is_price_active`, `date`, `status`) VALUES
(1, 'Pick From Service Centre', 'Inactive', '2017-11-08', 1),
(2, 'Drop At Home', 'Active', '2017-11-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(20) NOT NULL,
  `division_id` int(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `division_id`, `name`, `date`, `status`) VALUES
(1, 1, 'Dhaka', '2017-11-07', 1),
(2, 1, 'Shariatpur', '2017-11-07', 1),
(3, 1, 'Faridpur', '2017-11-07', 1),
(4, 2, 'Chittagong', '2017-11-07', 1),
(5, 2, 'Comilla', '2017-11-07', 1),
(6, 2, 'Noakhali', '2017-11-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `division_or_state`
--

CREATE TABLE `division_or_state` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `division_or_state`
--

INSERT INTO `division_or_state` (`id`, `name`, `date`, `status`) VALUES
(1, 'Dhaka', '2017-11-07', 1),
(2, 'Chittagong', '2017-11-07', 1),
(3, 'Khulna', '2017-11-14', 1),
(4, 'Sylhet', '2017-11-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `blood_group` varchar(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `contactnumber` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `gender`, `blood_group`, `dob`, `contactnumber`, `address`, `username`, `password`, `date`, `status`) VALUES
(3, 'CMS Admin', '1', '1', '2015-12-09', '01927608261', 'asdS', 'cms', '7e8a32176a113a7ba3d2b1f85834e828', '2015-09-13', 1),
(6, 'Fakhrul', '1', '1', '2017-10-10', '01860748020', 'sadsadasd', 'fakhrul', '7e8a32176a113a7ba3d2b1f85834e828', '2017-11-13', 1),
(7, 'Moni', '1', '1', '2017-10-10', '01860748020', 'asadsad', 'moni', '7e8a32176a113a7ba3d2b1f85834e828', '2017-11-13', 1),
(8, 'kazi Al-Amin', 'Male', 'B+', '0000-00-00', '01789876546', 'Faridpur', 'alamin11', '7e8a32176a113a7ba3d2b1f85834e828', '2017-11-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(20) NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(20) DEFAULT NULL,
  `sub_category_id` int(20) DEFAULT NULL,
  `unit_id` int(20) DEFAULT NULL,
  `size_id` int(20) DEFAULT NULL,
  `product_type_id` int(20) DEFAULT NULL,
  `quriar_receive_type_id` int(20) DEFAULT NULL,
  `quriar_receive_type_price` float(10,2) NOT NULL,
  `delivery_type_id` int(20) DEFAULT NULL,
  `delivery_type_price` float(10,2) NOT NULL,
  `delivery_area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quriar_detail` text COLLATE utf8_unicode_ci,
  `special_remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quriar_status` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `tracking_no`, `category_id`, `sub_category_id`, `unit_id`, `size_id`, `product_type_id`, `quriar_receive_type_id`, `quriar_receive_type_price`, `delivery_type_id`, `delivery_type_price`, `delivery_area`, `price`, `quriar_detail`, `special_remarks`, `quriar_status`, `date`, `status`) VALUES
(7, 'Q1510583578', 1, 1, 1, 1, 4, 2, 100.00, 2, 100.00, '', '100', '&lt;p&gt;Name : Md Mahamudur Zaman Bhuyian&lt;/p&gt;&lt;p&gt;Phone : 01860748020&lt;/p&gt;&lt;p&gt;Email : fahad@systechunima.co&lt;/p&gt;', 'None', 'Created By User', '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `login`
-- (See below for the actual view)
--
CREATE TABLE `login` (
`id` int(20)
,`name` varchar(255)
,`username` varchar(255)
,`password` varchar(255)
,`status` int(2)
);

-- --------------------------------------------------------

--
-- Table structure for table `other_pages`
--

CREATE TABLE `other_pages` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `page_status` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `other_pages`
--

INSERT INTO `other_pages` (`id`, `name`, `detail`, `page_status`, `date`, `status`) VALUES
(2, 'Our Services', '&lt;h2 style=\"box-sizing:border-box;margin:0px;padding:0px;border:0px;font-variant-numeric:inherit;font-weight:500;font-size:50px;line-height:1.28;font-family:\'Maven Pro\', sans-serif;vertical-align:top;color:#555555;text-align:center;\"&gt;Services&lt;/h2&gt;&lt;p style=\"box-sizing:border-box;margin-top:14px;margin-bottom:0px;padding-right:0px;padding-left:0px;border:0px;font-variant-numeric:inherit;font-size:20px;line-height:inherit;font-family:\'Maven Pro\', sans-serif;vertical-align:top;color:#555555;text-align:center;\"&gt;DeliveryCo.is America&amp;rsquo;s leading same-day transport and logistics services company. Our dedicated courier service includes point-to-point delivery, fleet outsourcing, facilities management and custom transportation solutions.&lt;/p&gt;', 'Active', '2017-11-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_info`
--

CREATE TABLE `page_info` (
  `id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_name_view` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `status` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_info`
--

INSERT INTO `page_info` (`id`, `name`, `page_name`, `page_name_view`, `menu_name`, `date`, `status`) VALUES
(28, 'category', 'category.php', '', 'Category', '2017-11-07', 1),
(29, 'sub_category', 'sub_category.php', '', 'Sub Category', '2017-11-07', 1),
(30, 'unit', 'unit.php', '', 'Unit', '2017-11-07', 1),
(31, 'size', 'size.php', '', 'Size', '2017-11-07', 1),
(32, 'product_type', 'product_type.php', '', 'Product Type', '2017-11-07', 1),
(33, 'product_price', 'product_price.php', '', 'Product Price', '2017-11-07', 1),
(34, 'division_or_state', 'division_or_state.php', '', 'Division Or State', '2017-11-07', 1),
(35, 'district', 'district.php', '', 'District', '2017-11-07', 1),
(36, 'cash_on_delivery', 'cash_on_delivery.php', '', 'Cash On Delivery', '2017-11-07', 1),
(38, 'quriar_receive_type', 'quriar_receive_type.php', '', 'Quriar Receive Type', '2017-11-08', 1),
(39, 'delivery_type', 'delivery_type.php', '', 'Delivery Type', '2017-11-08', 1),
(41, 'invoice', 'invoice.php', '', 'Invoice', '2017-11-08', 1),
(43, 'quriar_send_and_receive', 'quriar_send_and_receive.php', '', 'Quriar Send And Receive', '2017-11-10', 1),
(44, 'quriar_status', 'quriar_status.php', '', 'Quriar Status', '2017-11-11', 1),
(45, 'site_settings', 'site_settings.php', '', 'Site Settings', '2017-11-11', 1),
(48, 'other_pages', 'other_pages.php', '', 'Other Pages', '2017-11-11', 1),
(49, 'receive_product_detail', 'receive_product_detail.php', '', 'Receive Product Detail', '2017-11-13', 1),
(50, 'delivery_product_detail', 'delivery_product_detail.php', '', 'Delivery Product Detail', '2017-11-13', 1),
(51, 'user_type', 'user_type.php', '', 'User Type', '2017-11-13', 1),
(53, 'user_page_access_mapping', 'user_page_access_mapping.php', '', 'User Page Access Mapping', '2017-11-13', 1),
(54, 'user_access_role', 'user_access_role.php', '', 'User Access Role', '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(20) NOT NULL,
  `category_id` int(20) DEFAULT NULL,
  `sub_category_id` int(20) DEFAULT NULL,
  `unit_id` int(20) DEFAULT NULL,
  `size_id` int(20) DEFAULT NULL,
  `product_type_id` int(20) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `category_id`, `sub_category_id`, `unit_id`, `size_id`, `product_type_id`, `price`, `date`, `status`) VALUES
(1, 1, 1, 1, 1, 4, '100', '2017-11-07', 1),
(2, 1, 1, 1, 2, 1, '120', '2017-11-07', 1),
(3, 1, 1, 1, 1, 3, '100', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `date`, `status`) VALUES
(1, 'Diplomatic Documents', '2017-11-07', 1),
(2, 'Diplomatic Goods', '2017-11-07', 1),
(3, 'Sensitive Goods ', '2017-11-07', 1),
(4, 'General Goods', '2017-11-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quriar_receive_type`
--

CREATE TABLE `quriar_receive_type` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quriar_receive_type`
--

INSERT INTO `quriar_receive_type` (`id`, `name`, `date`, `status`) VALUES
(1, 'Service Centre', '2017-11-08', 1),
(2, 'Pick From Place By Serviceman', '2017-11-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quriar_send_and_receive`
--

CREATE TABLE `quriar_send_and_receive` (
  `id` int(20) NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receive_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quriar_send_and_receive`
--

INSERT INTO `quriar_send_and_receive` (`id`, `tracking_no`, `send_from`, `receive_from`, `date`, `status`) VALUES
(1, 'Q1510342371', 'Mohammodpur, Dhaka', 'Lakhsham, Comilla', '2017-11-10', 1),
(2, 'Q1510381956', 'Mohammodpur, Dhaka', 'Comilla Sadar Dokhshin, Comilla', '2017-11-11', 1),
(3, 'Q1510420776', '&lt;p&gt;Name : Md Mahamudur Zaman&lt;/p&gt;&lt;p&gt;Phone : 01860777777&lt;/p&gt;&lt;p&gt;Email : f.bhuyian@gmail.com&lt;/p&gt;', '&lt;p&gt;Name : Md Mahamudur Zaman&lt;/p&gt;&lt;p&gt;Phone : 01860777777&lt;/p&gt;&lt;p&gt;Email : f.bhuyian@gmail.com&lt;/p&gt;', '2017-11-11', 1),
(4, 'Q1510421524', '&lt;p style=\"box-sizing:border-box;margin-bottom:10px;color:#686868;font-family:\'Open Sans\', sans-serif;font-size:11px;background-color:#f5f5f5;outline:none !important;\"&gt;Name : Md Mahamudur Zaman&lt;/p&gt;&lt;p style=\"box-sizing:border-box;margin-botto', '&lt;p style=\"box-sizing:border-box;margin-bottom:10px;color:#686868;font-family:\'Open Sans\', sans-serif;font-size:11px;background-color:#f5f5f5;outline:none !important;\"&gt;Name : Md Mahamudur Zaman&lt;/p&gt;&lt;p style=\"box-sizing:border-box;margin-botto', '2017-11-11', 1),
(5, 'Q1510583176', '&lt;p&gt;Name : Md Mahamudur Zaman Bhuyian&lt;/p&gt;&lt;p&gt;Phone : 01860748020&lt;/p&gt;&lt;p&gt;Email : fahad@systechunima.com&lt;/p&gt;', '&lt;p style=\"font-size:12px;\"&gt;Name : Md Mahamudur Zaman Bhuyian&lt;/p&gt;&lt;p style=\"font-size:12px;\"&gt;Phone : 01860748020&lt;/p&gt;&lt;p style=\"font-size:12px;\"&gt;Email : fahad@systechunima.com&lt;/p&gt;', '2017-11-13', 1),
(6, 'Q1510583578', '&lt;p&gt;Name : Md Mahamudur Zaman Bhuyian&lt;/p&gt;&lt;p&gt;Phone : 01860748020&lt;/p&gt;&lt;p&gt;Email : fahad@systechunima.co&lt;/p&gt;', '&lt;p&gt;Name : Md Mahamudur Zaman Bhuyian&lt;/p&gt;&lt;p&gt;Phone : 01860748020&lt;/p&gt;&lt;p&gt;Email : fahad@systechunima.co&lt;/p&gt;', '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quriar_status`
--

CREATE TABLE `quriar_status` (
  `id` int(20) NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quriar_status` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quriar_status`
--

INSERT INTO `quriar_status` (`id`, `tracking_no`, `quriar_status`, `date`, `status`) VALUES
(1, 'Q1510421524', 'Received At Service Point', '2017-11-11', 1),
(2, 'Q1510421524', 'Loaded For Transport', '2017-11-11', 1),
(3, 'Q1510583176', 'Created By User', '2017-11-13', 1),
(4, 'Q1510583578', 'Created By User', '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receive_product_detail`
--

CREATE TABLE `receive_product_detail` (
  `id` int(20) NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division_id` int(20) DEFAULT NULL,
  `district_id` int(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receive_product_detail`
--

INSERT INTO `receive_product_detail` (`id`, `tracking_no`, `division_id`, `district_id`, `date`, `status`) VALUES
(1, 'Q1510583578', 1, 1, '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(20) NOT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_logo` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_title`, `contact_number`, `facebook`, `twitter`, `google_plus`, `site_logo`, `date`, `status`) VALUES
(1, 'Quriar', 'Send and Receive', '017 00 000000', 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.googleplus.com', 'site_logo_upload__1510427893_1510427893.png', '2017-11-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(20) NOT NULL,
  `unit_id` int(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `unit_id`, `name`, `date`, `status`) VALUES
(1, 1, 'A4', '2017-11-07', 1),
(2, 1, 'Legal', '2017-11-07', 1),
(3, 3, '1', '2017-11-07', 1),
(4, 3, '2', '2017-11-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(20) NOT NULL,
  `category_id` int(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `name`, `date`, `status`) VALUES
(1, 1, 'Paper Goods', '2017-11-07', 1),
(2, 1, 'Foods', '2017-11-07', 1),
(3, 1, 'Gift Item', '2017-11-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `date`, `status`) VALUES
(1, 'Paper', '2017-11-07', 1),
(2, 'Litter', '2017-11-07', 1),
(3, 'Kilo Gram (KG)', '2017-11-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_role`
--

CREATE TABLE `user_access_role` (
  `id` int(20) NOT NULL,
  `user_type_id` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_access_role`
--

INSERT INTO `user_access_role` (`id`, `user_type_id`, `user_id`, `date`, `status`) VALUES
(1, 1, 3, '2017-11-13', 1),
(2, 2, 6, '2017-11-13', 1),
(3, 2, 8, '2017-11-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_page_access_mapping`
--

CREATE TABLE `user_page_access_mapping` (
  `id` int(20) NOT NULL,
  `user_type_id` int(20) DEFAULT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_link_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_page_access_mapping`
--

INSERT INTO `user_page_access_mapping` (`id`, `user_type_id`, `page_name`, `page_link_file_name`, `date`, `status`) VALUES
(1, 1, 'New Category', 'category.php', '2017-11-13', 1),
(2, 1, 'Category List', 'category_data.php', '2017-11-13', 1),
(3, 1, 'New Sub Category', 'sub_category.php', '2017-11-13', 1),
(4, 1, 'Sub Category List', 'sub_category_data.php', '2017-11-13', 1),
(5, 1, 'New Unit', 'unit.php', '2017-11-13', 1),
(6, 1, 'Unit List', 'unit_data.php', '2017-11-13', 1),
(7, 1, 'New Size', 'size.php', '2017-11-13', 1),
(8, 1, 'Size List', 'size_data.php', '2017-11-13', 1),
(9, 1, 'New Product Type', 'product_type.php', '2017-11-13', 1),
(10, 1, 'Product Type List', 'product_type_data.php', '2017-11-13', 1),
(11, 1, 'New Product Price', 'product_price.php', '2017-11-13', 1),
(12, 1, 'Product Price List', 'product_price_data.php', '2017-11-13', 1),
(13, 1, 'New Division Or State', 'division_or_state.php', '2017-11-13', 1),
(14, 1, 'Division Or State List', 'division_or_state_data.php', '2017-11-13', 1),
(15, 1, 'New District', 'district.php', '2017-11-13', 1),
(16, 1, 'District List', 'district_data.php', '2017-11-13', 1),
(17, 1, 'New Cash On Delivery', 'cash_on_delivery.php', '2017-11-13', 1),
(18, 1, 'Cash On Delivery List', 'cash_on_delivery_data.php', '2017-11-13', 1),
(19, 1, 'New Quriar Receive Type', 'quriar_receive_type.php', '2017-11-13', 1),
(20, 1, 'Quriar Receive Type List', 'quriar_receive_type_data.php', '2017-11-13', 1),
(21, 1, 'New Delivery Type', 'delivery_type.php', '2017-11-13', 1),
(22, 1, 'Delivery Type List', 'delivery_type_data.php', '2017-11-13', 1),
(23, 1, 'New Invoice', 'invoice.php', '2017-11-13', 1),
(24, 1, 'Invoice List', 'invoice_data.php', '2017-11-13', 1),
(25, 1, 'New Quriar Send And Receive', 'quriar_send_and_receive.php', '2017-11-13', 1),
(26, 1, 'Quriar Send And Receive List', 'quriar_send_and_receive_data.php', '2017-11-13', 1),
(27, 1, 'New Quriar Status', 'quriar_status.php', '2017-11-13', 1),
(28, 1, 'Quriar Status List', 'quriar_status_data.php', '2017-11-13', 1),
(29, 1, 'New Site Settings', 'site_settings.php', '2017-11-13', 1),
(30, 1, 'Site Settings List', 'site_settings_data.php', '2017-11-13', 1),
(31, 1, 'New Other Pages', 'other_pages.php', '2017-11-13', 1),
(32, 1, 'Other Pages List', 'other_pages_data.php', '2017-11-13', 1),
(33, 1, 'New Receive Product Detail', 'receive_product_detail.php', '2017-11-13', 1),
(34, 1, 'Receive Product Detail List', 'receive_product_detail_data.php', '2017-11-13', 1),
(35, 1, 'New Delivery Product Detail', 'delivery_product_detail.php', '2017-11-13', 1),
(36, 1, 'Delivery Product Detail List', 'delivery_product_detail_data.php', '2017-11-13', 1),
(37, 1, 'New User Type', 'user_type.php', '2017-11-13', 1),
(38, 1, 'User Type List', 'user_type_data.php', '2017-11-13', 1),
(39, 1, 'New User Page Access Mapping', 'user_page_access_mapping.php', '2017-11-13', 1),
(40, 1, 'User Page Access Mapping List', 'user_page_access_mapping_data.php', '2017-11-13', 1),
(41, 1, 'New User Access Role', 'user_access_role.php', '2017-11-13', 1),
(42, 1, 'User Access Role List', 'user_access_role_data.php', '2017-11-13', 1),
(51, 2, 'New Product Price', 'product_price.php', '2017-11-13', 1),
(52, 2, 'Product Price List', 'product_price_data.php', '2017-11-13', 1),
(53, 2, 'New Invoice', 'invoice.php', '2017-11-13', 1),
(54, 2, 'Invoice List', 'invoice_data.php', '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `date`, `status`) VALUES
(1, 'Super Admin', '2017-11-13', 1),
(2, 'Service Point Manager', '2017-11-13', 1);

-- --------------------------------------------------------

--
-- Structure for view `login`
--
DROP TABLE IF EXISTS `login`;

CREATE VIEW `login`  AS  select `employee`.`id` AS `id`,`employee`.`name` AS `name`,`employee`.`username` AS `username`,`employee`.`password` AS `password`,`employee`.`status` AS `status` from `employee` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorize_user`
--
ALTER TABLE `authorize_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_on_delivery`
--
ALTER TABLE `cash_on_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_table_field`
--
ALTER TABLE `custom_table_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_product_detail`
--
ALTER TABLE `delivery_product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_type`
--
ALTER TABLE `delivery_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `division_or_state`
--
ALTER TABLE `division_or_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_pages`
--
ALTER TABLE `other_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_info`
--
ALTER TABLE `page_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quriar_receive_type`
--
ALTER TABLE `quriar_receive_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quriar_send_and_receive`
--
ALTER TABLE `quriar_send_and_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quriar_status`
--
ALTER TABLE `quriar_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_product_detail`
--
ALTER TABLE `receive_product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_role`
--
ALTER TABLE `user_access_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_page_access_mapping`
--
ALTER TABLE `user_page_access_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authorize_user`
--
ALTER TABLE `authorize_user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cash_on_delivery`
--
ALTER TABLE `cash_on_delivery`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `custom_table_field`
--
ALTER TABLE `custom_table_field`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;
--
-- AUTO_INCREMENT for table `delivery_product_detail`
--
ALTER TABLE `delivery_product_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `delivery_type`
--
ALTER TABLE `delivery_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `division_or_state`
--
ALTER TABLE `division_or_state`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `other_pages`
--
ALTER TABLE `other_pages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `page_info`
--
ALTER TABLE `page_info`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `quriar_receive_type`
--
ALTER TABLE `quriar_receive_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `quriar_send_and_receive`
--
ALTER TABLE `quriar_send_and_receive`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `quriar_status`
--
ALTER TABLE `quriar_status`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `receive_product_detail`
--
ALTER TABLE `receive_product_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_access_role`
--
ALTER TABLE `user_access_role`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_page_access_mapping`
--
ALTER TABLE `user_page_access_mapping`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
