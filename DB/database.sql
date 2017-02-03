-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2017 at 05:53 AM
-- Server version: 5.6.24-log
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel_acl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cron_logs`
--

CREATE TABLE IF NOT EXISTS `cron_logs` (
  `id` int(10) unsigned NOT NULL,
  `type` int(3) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL,
  `execution_time` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

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
(36, 'log/cron', 'GET');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

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
(37, 3, 23),
(38, 3, 32),
(39, 3, 33),
(40, 2, 23),
(41, 2, 27),
(42, 2, 28),
(43, 2, 29),
(44, 2, 31),
(45, 2, 32),
(46, 2, 33),
(47, 2, 35),
(48, 2, 36);

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
(1, 1, 'Admin', '', 'admin@gmail.com', '$2y$10$9YKvMn2xfP7wt8rIoWHiPOvWxtG.q6I4LvbO2mYjBU3/mADVYudHW', 'z4tEFSD48CBhF2oyFD3ZRNOd0KUMTmoQmytfHA5BLhryrgq3n7AKPHSPVG2U', 1, '2017-02-02 05:44:58', NULL, '2017-02-02 11:48:59', 1, NULL, NULL),
(2, 2, 'sub', 'admin', 'sub-admin@gmail.com', '$2y$10$TlWFFIGbKa36vDYOfixNyeQIrVoNJeairJ/3rKyERcmHgceFJRsdS', 'ywWmvHNmOBcIXaplxnZTsPZqvX9rrR3UZZ31jx5QbJZyxYzsOXkrhNbq9liz', 1, '2017-02-02 08:06:54', 1, '2017-02-03 04:15:11', 2, NULL, NULL),
(3, 3, 'staff', '', 'staff@gmail.com', '$2y$10$LEmoKfqHoO./pOg8HR8q/OY/hhMyGtQCcuc4QaIYhN4hh9XVflcEu', 'p4TGwXAbBGNI6vADgccKDrmM7bmfvyfQsJS5uVpdwPFP6Iy9WB7CS79vLwVi', 1, '2017-02-02 12:06:09', 1, '2017-02-03 04:38:54', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_service_logs`
--

CREATE TABLE IF NOT EXISTS `web_service_logs` (
  `id` int(10) unsigned NOT NULL,
  `type` int(3) NOT NULL,
  `request` text NOT NULL,
  `response` text,
  `status` tinyint(1) NOT NULL,
  `execution_time` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_service_logs`
--

INSERT INTO `web_service_logs` (`id`, `type`, `request`, `response`, `status`, `execution_time`, `created_at`, `updated_at`) VALUES
(98, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"","status":1,"data":{"api_token":"d43b9816fd9b91131ca89ebf94d9b3f0ea95b5fad43b9816fd9b91131ca8"}}', 1, 0.486, '2017-01-30 09:44:35', '2017-01-30 09:44:35'),
(140, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''contain'' at line 1","status":0}', 0, 0.377, '2017-01-30 12:54:53', '2017-01-30 12:54:54'),
(141, 1, '{"username":"vssakthivel","password":"abtit123"}', NULL, 0, 0, '2017-01-30 12:55:37', '0000-00-00 00:00:00'),
(142, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"","status":1,"data":{"api_token":"d43b9816fd9b91131ca89ebf94d9b3f0ea95b5fad43b9816fd9b91131ca8"}}', 1, 0.181, '2017-01-30 12:55:53', '2017-01-30 12:55:53'),
(143, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"","status":1,"data":{"api_token":"d43b9816fd9b91131ca89ebf94d9b3f0ea95b5fad43b9816fd9b91131ca8","group_id":"3","plant_id":"7"}}', 1, 0.172, '2017-01-30 12:57:36', '2017-01-30 12:57:36'),
(144, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"","status":1,"data":{"api_token":"d43b9816fd9b91131ca89ebf94d9b3f0ea95b5fad43b9816fd9b91131ca8","group_id":"3","plant_id":"7"}}', 1, 0.177, '2017-01-30 14:51:38', '2017-01-30 14:51:38'),
(145, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"","status":1,"data":{"api_token":"d43b9816fd9b91131ca89ebf94d9b3f0ea95b5fad43b9816fd9b91131ca8","group_id":"3","plant_id":"7"}}', 1, 1.137, '2017-01-30 16:29:13', '2017-01-30 16:29:14'),
(146, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"","status":1,"data":{"api_token":"d43b9816fd9b91131ca89ebf94d9b3f0ea95b5fad43b9816fd9b91131ca8","group_id":"3","plant_id":"7"}}', 1, 0.255, '2017-01-30 17:28:39', '2017-01-30 17:28:40'),
(151, 1, '{"username":"vssakthivel","password":"abtit123"}', '{"msg":"","status":1,"data":{"api_token":"d43b9816fd9b91131ca89ebf94d9b3f0ea95b5fad43b9816fd9b91131ca8","group_id":"3","plant_id":"7"}}', 1, 0.234, '2017-01-31 11:21:04', '2017-01-31 11:21:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cron_logs`
--
ALTER TABLE `cron_logs`
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
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `web_service_logs`
--
ALTER TABLE `web_service_logs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=152;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
