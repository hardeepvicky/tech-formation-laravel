-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2017 at 06:43 AM
-- Server version: 5.6.24-log
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tech_formation_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cron_logs`
--

CREATE TABLE IF NOT EXISTS `cron_logs` (
  `id` int(10) unsigned NOT NULL,
  `type` int(3) NOT NULL DEFAULT '0',
  `description` text,
  `status` tinyint(1) NOT NULL,
  `execution_time` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE IF NOT EXISTS `email_logs` (
  `id` int(11) NOT NULL,
  `from_email` varchar(100) NOT NULL,
  `to_email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `from_email`, `to_email`, `subject`, `body`, `created_at`) VALUES
(1, 'hardeepvicky1@gmail.com', 'hardeep.singh417@gmail.com', 'Welcome', '<h1> Hi, [User.name] </h1>\r\n<p>\r\n<b>Username : </b> [User.email]\r\n<b>Password : </b> 1245678\r\n</p>', '2017-02-09 07:56:37'),
(2, 'hardeepvicky1@gmail.com', 'hardeep.singh417@gmail.com', 'Welcome', '<h1>Hi, Hardeep</h1>\r\n\r\n<p><strong>Username : </strong> hardeepvicky1@gmail.com <strong>Password : </strong> 1245678</p>\r\n', '2017-02-09 12:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `email_placeholders`
--

CREATE TABLE IF NOT EXISTS `email_placeholders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_placeholders`
--

INSERT INTO `email_placeholders` (`id`, `name`) VALUES
(3, 'Company.name'),
(1, 'User.email'),
(2, 'User.name'),
(4, 'User.password');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `placeholder_ids` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `code`, `subject`, `body`, `placeholder_ids`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'A001', 'Welcome', '<h1>Hi, [User.name]</h1>\r\n\r\n<p><strong>Username : </strong> [User.email] <strong>Password : </strong> [User.password]</p>\r\n', '1,2,4', '2017-02-09 06:00:54', 1, '2017-02-09 12:07:58', 1),
(3, 'A002', 'Welcome', '<h1> Hi, [User.name] </h1>\r\n<p>\r\n<b>Username : </b> [User.email]\r\n<b>Password : </b> [User.password]\r\n</p>', '4', '2017-02-09 06:00:54', 1, '2017-02-09 06:00:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `type`) VALUES
(1, 'api/user', 'GET'),
(2, '/', 'GET'),
(3, 'login', 'GET'),
(4, 'login/attempt', 'POST'),
(5, 'logout', 'GET'),
(6, 'role', 'GET'),
(7, 'role/create', 'GET'),
(8, 'role', 'POST'),
(9, 'role/{role}', 'GET'),
(10, 'role/{role}/edit', 'GET'),
(11, 'role/{role}', 'PUT'),
(12, 'role/{role}', 'PATCH'),
(13, 'role/{role}', 'DELETE'),
(14, 'permission', 'GET'),
(15, 'permission/create', 'GET'),
(16, 'permission', 'POST'),
(17, 'permission/{permission}', 'GET'),
(18, 'permission/{permission}/edit', 'GET'),
(19, 'permission/{permission}', 'PUT'),
(20, 'permission/{permission}', 'PATCH'),
(21, 'permission/{permission}', 'DELETE'),
(22, 'permission/refresh/{All_delete}', 'GET'),
(23, 'user', 'GET'),
(24, 'user/create', 'GET'),
(25, 'user', 'POST'),
(26, 'user/{user}', 'GET'),
(27, 'user/{user}/edit', 'GET'),
(28, 'user/{user}', 'PUT'),
(29, 'user/{user}', 'PATCH'),
(30, 'user/{user}', 'DELETE'),
(31, 'user/{ID}/active/toggle/{v}', 'GET'),
(32, 'user/password/change', 'GET'),
(33, 'user/password/update', 'PUT'),
(34, 'web-service/login', 'POST'),
(35, 'log/web-service', 'GET'),
(36, 'log/cron', 'GET'),
(37, 'email-placeholder', 'GET'),
(38, 'email-placeholder/create', 'GET'),
(39, 'email-placeholder', 'POST'),
(40, 'email-placeholder/{email_placeholder}', 'GET'),
(41, 'email-placeholder/{email_placeholder}/edit', 'GET'),
(42, 'email-placeholder/{email_placeholder}', 'PUT'),
(43, 'email-placeholder/{email_placeholder}', 'PATCH'),
(44, 'email-placeholder/{email_placeholder}', 'DELETE'),
(45, 'email-template', 'GET'),
(46, 'email-template/create', 'GET'),
(47, 'email-template', 'POST'),
(48, 'email-template/{email_template}', 'GET'),
(49, 'email-template/{email_template}/edit', 'GET'),
(50, 'email-template/{email_template}', 'PUT'),
(51, 'email-template/{email_template}', 'PATCH'),
(52, 'email-template/{email_template}', 'DELETE'),
(53, 'email-log', 'GET'),
(54, 'log/email', 'GET'),
(55, 'test_send_email', 'GET');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2017-02-01 09:18:50', '2017-02-01 09:31:23'),
(2, 'Sub-Admin', '2017-02-01 09:31:32', '2017-02-01 09:32:13'),
(3, 'Staff', '2017-02-01 09:32:26', '2017-02-01 09:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30),
(31, 1, 31),
(32, 1, 32),
(33, 1, 33),
(34, 1, 34),
(35, 1, 35),
(36, 1, 36),
(37, 1, 37),
(38, 1, 38),
(39, 1, 39),
(40, 1, 40),
(41, 1, 41),
(42, 1, 42),
(43, 1, 43),
(44, 1, 44),
(45, 1, 45),
(46, 1, 46),
(47, 1, 47),
(48, 1, 48),
(49, 1, 49),
(50, 1, 50),
(51, 1, 51),
(52, 1, 52),
(53, 1, 53),
(54, 1, 54),
(55, 1, 55),
(56, 2, 23),
(57, 2, 27),
(58, 2, 28),
(59, 2, 29),
(60, 2, 31),
(61, 2, 32),
(62, 2, 33),
(63, 2, 35),
(64, 2, 36),
(65, 3, 23),
(66, 3, 32),
(67, 3, 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'Admin', '', 'admin@gmail.com', '$2y$10$9YKvMn2xfP7wt8rIoWHiPOvWxtG.q6I4LvbO2mYjBU3/mADVYudHW', 'PJeJTD5LarCBHBCo7EGXt1oTGK1ojJjnfz4HOgl61qY14bKM4jXbYFespInd', 1, '2017-02-02 05:44:58', NULL, '2017-02-10 03:57:26', 1, NULL, NULL),
(2, 2, 'sub', 'admin', 'sub-admin@gmail.com', '$2y$10$TlWFFIGbKa36vDYOfixNyeQIrVoNJeairJ/3rKyERcmHgceFJRsdS', 'ywWmvHNmOBcIXaplxnZTsPZqvX9rrR3UZZ31jx5QbJZyxYzsOXkrhNbq9liz', 1, '2017-02-02 08:06:54', 1, '2017-02-03 04:15:11', 2, NULL, NULL),
(3, 3, 'staff', '', 'staff@gmail.com', '$2y$10$LEmoKfqHoO./pOg8HR8q/OY/hhMyGtQCcuc4QaIYhN4hh9XVflcEu', 'p4TGwXAbBGNI6vADgccKDrmM7bmfvyfQsJS5uVpdwPFP6Iy9WB7CS79vLwVi', 1, '2017-02-02 12:06:09', 1, '2017-02-03 04:38:54', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_service_logs`
--

CREATE TABLE IF NOT EXISTS `web_service_logs` (
  `id` int(10) unsigned NOT NULL,
  `type` int(3) NOT NULL DEFAULT '0',
  `request` text NOT NULL,
  `response` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `execution_time` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_service_logs`
--

INSERT INTO `web_service_logs` (`id`, `type`, `request`, `response`, `status`, `execution_time`, `created_at`) VALUES
(1, 1, '{"email":"admin@gmail.com","password":"admin","service":"login"}', '{"msg":"Success","status":1,"data":{"role_id":1,"first_name":"Admin","last_name":"","email":"admin@gmail.com","remember_token":"PJeJTD5LarCBHBCo7EGXt1oTGK1ojJjnfz4HOgl61qY14bKM4jXbYFespInd"}}', 1, 0.169, '2017-02-10 05:03:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cron_logs`
--
ALTER TABLE `cron_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_placeholders`
--
ALTER TABLE `email_placeholders`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_service_logs`
--
ALTER TABLE `web_service_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cron_logs`
--
ALTER TABLE `cron_logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `email_placeholders`
--
ALTER TABLE `email_placeholders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `web_service_logs`
--
ALTER TABLE `web_service_logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
