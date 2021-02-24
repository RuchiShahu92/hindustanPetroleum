-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 09:26 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_detail`
--

CREATE TABLE `company_detail` (
  `id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `phone_no` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `gst_no` varchar(200) NOT NULL,
  `bank_details` text NOT NULL,
  `tax_detail` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_detail`
--

INSERT INTO `company_detail` (`id`, `company_name`, `address`, `pincode`, `phone_no`, `email`, `gst_no`, `bank_details`, `tax_detail`, `status`) VALUES
(1, 'Fsdfsd1', '1 Shaunak Apartments (Bakeri City), Kalapi Marg, Bakeri City, Quresh Nagar Society, Vejalpur, Ahmedabad, Gujarat, India', 180051, '4343211111', 'info1@zamy.in', '3242311', 'a:4:{s:4:\"name\";s:3:\"sbi\";s:6:\"branch\";s:9:\"vastrapur\";s:10:\"account_no\";s:12:\"444444433242\";s:9:\"ifca_code\";s:8:\"35453533\";}', 'a:3:{s:4:\"CGST\";s:3:\"2.5\";s:4:\"SGST\";s:3:\"2.5\";s:4:\"IGST\";s:3:\"2.5\";}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `vender_id` int(11) NOT NULL,
  `gross_total` double NOT NULL,
  `discount` double NOT NULL,
  `sub_total` double NOT NULL,
  `cgst` double NOT NULL,
  `sgst` double NOT NULL,
  `igst` double NOT NULL,
  `net_amount` double NOT NULL,
  `date` date NOT NULL,
  `order_status` enum('success','cancel') NOT NULL DEFAULT 'success'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `itemId` int(11) NOT NULL,
  `itemHeader` varchar(512) NOT NULL COMMENT 'Heading',
  `itemSub` varchar(1021) NOT NULL COMMENT 'sub heading',
  `itemDesc` text DEFAULT NULL COMMENT 'content or description',
  `itemImage` varchar(80) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`itemId`, `itemHeader`, `itemSub`, `itemDesc`, `itemImage`, `isDeleted`, `createdBy`, `createdDtm`, `updatedDtm`, `updatedBy`) VALUES
(1, 'jquery.validation.js', 'Contribution towards jquery.validation.js', 'jquery.validation.js is the client side javascript validation library authored by Jörn Zaefferer hosted on github for us and we are trying to contribute to it. Working on localization now', 'validation.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL),
(2, 'CodeIgniter User Management', 'Demo for user management system', 'This the demo of User Management System (Admin Panel) using CodeIgniter PHP MVC Framework and AdminLTE bootstrap theme. You can download the code from the repository or forked it to contribute. Usage and installation instructions are provided in ReadMe.MD', 'cias.png', 0, 1, '2015-09-02 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@bewithdhanu.in', '$2y$10$SAvFim22ptA9gHVORtIaru1dn9rhgerJlJCPxRNA02MjQaJnkxawq', 'System Administrator', '9890098900', 1, 0, 0, '2015-07-01 18:56:49', 1, '2020-09-18 07:11:58'),
(2, 'manager@bewithdhanu.in', '$2y$10$Gkl9ILEdGNoTIV9w/xpf3.mSKs0LB1jkvvPKK7K0PSYDsQY7GE9JK', 'Manager', '9890098900', 2, 0, 1, '2016-12-09 17:49:56', 1, '2020-09-17 14:51:26'),
(3, 'employee@bewithdhanu.in', '$2y$10$LN4vipS5bOeAoG/0trvwsOb27msBWkQLwY0VYvKpRiXHG0tghzwuG', 'Employee', '9890098900', 3, 0, 1, '2016-12-09 17:50:22', 3, '2020-09-16 08:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `vender`
--

CREATE TABLE `vender` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vender`
--

INSERT INTO `vender` (`id`, `name`, `address`, `pincode`, `phone_no`, `email`, `created_date`, `status`) VALUES
(1, 'Ruchi1', 'Shaunak Apartments (Bakeri City), Kalapi Marg, Bakeri City, Quresh Nagar Society, Vejalpur, Ahmedabad, Gujarat, India 1', 38001, '4343231211', 'info1@zamy.in', '2020-09-17 11:54:05', 1),
(2, 'test', 'Shaunak Apartments (Bakeri City), Kalapi Marg, Bakeri City, Quresh Nagar Society, Vejalpur, Ahmedabad, Gujarat, India 1', 380011, '4343231211', 'test@gmail.com', '2020-09-17 11:54:05', 1),
(3, 'Ruchi', 'Ahmedabad Airport (AMD), Hansol, Ahmedabad, Gujarat, India', 380003, '4343231232', 'lakshmi.mallula@attuneww.com', '2020-09-18 07:44:34', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_detail`
--
ALTER TABLE `company_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `vender`
--
ALTER TABLE `vender`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_detail`
--
ALTER TABLE `company_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vender`
--
ALTER TABLE `vender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
