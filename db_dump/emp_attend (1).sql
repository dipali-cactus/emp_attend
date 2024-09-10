-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 07:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp_attend`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `username` char(6) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL,
  `shift_id` int(1) NOT NULL,
  `location_id` int(1) NOT NULL,
  `in_time` int(11) NOT NULL,
  `notes` varchar(120) NOT NULL,
  `image` varchar(50) NOT NULL,
  `lack_of` varchar(11) NOT NULL,
  `in_status` varchar(15) NOT NULL,
  `out_time` int(11) NOT NULL,
  `out_status` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `username`, `employee_id`, `department_id`, `shift_id`, `location_id`, `in_time`, `notes`, `image`, `lack_of`, `in_status`, `out_time`, `out_status`, `created_at`, `updated_at`) VALUES
(45, 'ADM011', 011, 'ADM', 1, 1, 1589178316, 'sdf', 'item-200511-8f5d7be1a1.jpg', 'None', 'Late', 1589178477, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(48, 'ADM011', 011, 'ADM', 1, 1, 1589381121, '', 'item-200513-ad6953a07e.jpg', 'Notes', 'Late', 1589381127, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(49, 'PCD010', 010, 'PCD', 2, 1, 1589384432, 'asdasd', '', 'None,image', 'Late', 1589384514, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(50, 'ADM011', 011, 'ADM', 1, 1, 1589391038, '', '', 'Notes,image', 'On Time', 1589391056, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(51, 'PCD010', 010, 'PCD', 3, 1, 1622553388, 'testing', 'item-210601-3946bb00df.png', 'None', 'Late', 1622553470, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(52, 'PCD010', 010, 'PCD', 3, 2, 1631893356, 'none', '', 'None,image', 'Late', 1631893413, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(53, 'STD026', 026, 'STD', 1, 1, 1631894335, 'none', '', 'None,image', 'Late', 1631894403, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(54, 'ADM011', 011, 'ADM', 1, 2, 1631894692, 'demo', '', 'None,image', 'Late', 1631894696, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(55, 'QCD027', 027, 'QCD', 6, 2, 1631499386, 'none..', '', 'None,image', 'Late', 1631529057, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(56, 'QCD027', 027, 'QCD', 6, 2, 1631583036, 'none', '', 'None,image', 'Late', 1631611849, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(58, 'QCD027', 027, 'QCD', 6, 1, 1631733350, 'none', '', 'None,image', 'Late', 1631797356, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(59, 'QCD027', 027, 'QCD', 6, 4, 1631863331, 'none', '', 'None,image', 'Late', 1631896539, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(60, 'QCD027', 027, 'QCD', 6, 1, 1631214919, 'none', '', 'None,image', 'Late', 1631250936, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(61, 'STD026', 026, 'STD', 1, 2, 1631493955, 'none', '', 'None,image', 'On Time', 1631523613, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(62, 'ADM011', 011, 'ADM', 1, 1, 1631584873, 'none', '', 'None,image', 'Late', 1631621603, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(63, 'QCD027', 027, 'QCD', 6, 2, 1632109417, 'this is a demo note!', '', 'None,image', 'Late', 1632109437, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(64, 'ACD002', 002, 'ACD', 2, 3, 1632109840, 'demo demo', '', 'None,image', 'On Time', 1632109845, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(65, 'STD026', 026, 'STD', 1, 2, 1632109903, 'test', '', 'None,image', 'Late', 1632109905, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(66, 'ITD028', 028, 'ITD', 7, 7, 1654738570, 'Sample Time-In', 'item-220609-6dc7d7e8fe.png', 'None', 'On Time', 1654738629, 'Early', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(71, 'HRD030', 030, 'HRD', 7, 7, 1654756719, 'Sample Note only', 'item-220609-496d1ceffe.png', 'None', 'Late', 1654758719, 'Early', '2024-09-04 06:34:08', '2024-09-04 07:06:30'),
(72, 'HRD030', 030, 'HRD', 7, 2, 1723468300, '', '', 'Notes,image', 'Late', 1723468347, 'Over Time', '2024-09-04 06:34:08', '2024-09-04 06:34:08'),
(73, 'DWJ032', 032, 'DWJ', 1, 1, 1725275900, '', '', 'Notes,image', 'Late', 1725279742, 'Early', '2024-09-04 06:34:08', '2024-09-04 07:06:32'),
(74, 'DWJ032', 032, 'DWJ', 1, 1, 1725275900, '', '', 'Notes,image', 'Late', 1725279742, 'Early', '2024-09-04 06:34:08', '2024-09-04 07:06:35'),
(75, 'HRD031', 031, 'HRD', 7, 2, 1725282901, 'nighttttt', '', 'None,image', 'Late', 0, 'Working', '2024-09-04 06:34:08', '2024-09-04 07:06:42'),
(76, 'DWJ032', 032, 'DWJ', 1, 2, 1725341450, 'i am in office', '', 'None,image', 'On Time', 0, 'Working', '2024-09-04 06:34:08', '2024-09-04 07:06:44'),
(77, 'HRD001', 001, 'HRD', 7, 2, 1725344071, 'office timeeeee', '', 'None,image', 'Late', 0, 'Working', '2024-09-04 06:34:08', '2024-09-04 07:08:36'),
(78, 'DWJ032', 032, 'DWJ', 1, 2, 1725428558, 'my test', '', 'None,image', 'On Time', 0, 'Working', '2024-09-04 06:34:08', '2024-09-04 07:08:30'),
(79, 'DWJ032', 032, 'DWJ', 1, 1, 1725517534, 'fgdfgdfgdfgdfg', '1725517534_31a81857f66aa4a4db03.jpg', 'None', 'Late', 0, '', '2024-09-05 06:25:34', '2024-09-05 06:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` char(3) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
('ACD', 'Accounting Department'),
('ADM', 'Admin Department'),
('DWJ', 'dsfsdfdf ABAB'),
('HRD', 'Human Resource Department'),
('ITD', 'Information Technology Department - Updated'),
('PCD', 'Production Controller Department'),
('PLD', 'Planner Department'),
('QCD', 'Quality Control Department'),
('SCD', 'Security Department'),
('STD', 'Store Department');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gender` char(1) NOT NULL,
  `image` varchar(128) NOT NULL,
  `birth_date` date NOT NULL,
  `hire_date` date NOT NULL,
  `shift_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `gender`, `image`, `birth_date`, `hire_date`, `shift_id`) VALUES
(001, 'John Smith', 'jsmith@mail.com', 'M', 'default.png', '1996-07-15', '2020-03-05', 7),
(025, 'Admin ', 'admin@admin.com', 'M', 'default.png', '0000-00-00', '0000-00-00', 0),
(028, 'Mark Cooper', 'mcooper@mail.com', 'M', '1725516033_777c7abe7444e3509934.png', '1997-06-23', '2021-04-20', 7),
(031, 'Dipali Vidja Patel', 'dipali@cactuscreatives.com', 'F', '1725515749_602ac9c395ff1b4bdced.jpg', '1992-08-13', '2024-05-01', 7),
(032, 'my test', 'info@alliedinds.com', 'M', '1725454718_62bda9d2ff3f6d9fcd66.jpg', '2000-07-05', '2024-07-01', 1),
(039, 'Claire Blake 21', 'sdfdf$$21@ere.com', 'M', '1725454718_62bda9d2ff3f6d9fcd66.jpg', '2001-12-30', '2024-09-02', 1),
(040, 'Claire Blake 31', '31sdfdf@ere.com', 'M', '1725516432_a7c9adcc52a7c7fdc767.jpg', '2001-12-30', '2024-09-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(3) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `department_id` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `employee_id`, `department_id`) VALUES
(1, 001, 'HRD'),
(2, 002, 'ACD'),
(3, 003, 'QCD'),
(4, 004, 'SCD'),
(5, 005, 'STD'),
(6, 006, 'ACD'),
(7, 007, 'PLD'),
(8, 008, 'STD'),
(9, 009, 'STD'),
(10, 010, 'PCD'),
(21, 011, 'ADM'),
(25, 024, 'HRD'),
(26, 026, 'STD'),
(27, 027, 'QCD'),
(28, 028, 'ITD'),
(30, 030, 'HRD'),
(31, 031, 'HRD'),
(32, 032, 'DWJ'),
(33, 033, 'DWJ'),
(34, 034, 'ACD'),
(35, 035, 'HRD'),
(36, 036, 'DWJ'),
(37, 037, 'DWJ'),
(38, 038, 'ACD'),
(39, 039, 'ACD'),
(40, 040, 'ACD');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(1) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Home'),
(2, 'Office'),
(3, 'Store'),
(4, 'Site'),
(6, 'Field'),
(7, 'XYZ Client Office'),
(10, 'fieldsss qwert');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(1) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `start`, `end`) VALUES
(1, '08:00:00', '16:00:00'),
(2, '13:00:00', '21:00:00'),
(3, '18:00:00', '02:00:00'),
(4, '03:15:02', '02:05:05'),
(5, '07:00:00', '18:25:00'),
(6, '01:00:00', '12:00:00'),
(7, '09:30:00', '18:30:00'),
(8, '23:23:23', '23:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(6) NOT NULL,
  `password` varchar(128) NOT NULL,
  `employee_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `employee_id`, `role_id`) VALUES
('ACD002', '$2y$10$5nv5ehyMVdljfKJ6izsOqOimsbv.cbzU.XLB9ji9zbA.eICdSrNvO', 002, 2),
('ACD039', '$2y$10$/bcsTFhwFWK3toraZlo1Z.O5haAy9Mbw7c.1ZeRbFE7B/Q1UZE4se', 039, 2),
('ACD040', '$2y$10$fRl0CN1tTuOLpN9rg5Ryd.xy8yk7gcRE7TldEdJIRbYB3ZEXCT2DS', 040, 2),
('ADM011', '$2y$10$BKpQcs4XKavCcYdFWujzx.Xqb7r9eNkDrOYss2VNXrMJUUpm1agUC', 011, 2),
('admin', '$2y$10$tG8hnh7w.yiJL7fjlRCmkuHBwi0QI6DHFXmc1s6X3cAFuw5pRfO/O', 025, 1),
('DWJ032', '$2y$10$wLK94qrk6Uxvjdi9AGkbL.fg.JaHclUv5tygXgGnMyrs3o3e2UjyW', 032, 2),
('HRD001', '$2y$10$5Phc8AiaO3V7vx9L7xqaVelKUdqoOk2mvgXN6ynb0miRX.SWcYRoW', 001, 2),
('HRD030', '$2y$10$cHGjI9Y.92T0bOadg/HLNexK9uXQXqNwHQzhHzBVnTo.AsnfR7qna', 030, 2),
('HRD031', '$2y$10$afZeWNMJeWolPMeSEBpsQ.2zo9bWx2k5aL4rVidOIdYraWV3DePx6', 031, 2),
('ITD028', '$2y$10$vQQ80W50S/rsXThp2YkQ5uH3XKej4bZE68L7Cfz9.MVcQ0EiJo.Hy', 028, 2),
('PCD010', '$2y$10$BKpQcs4XKavCcYdFWujzx.Xqb7r9eNkDrOYss2VNXrMJUUpm1agUC', 010, 2),
('QCD027', '$2y$10$peALJo.JKZyD6uMBd41UfuHGQSJe7ExOfDhPITvDbSRRXeWUGY9xy', 027, 2),
('STD005', '$2y$10$hr35h1fIySFYCSRVL2jRD.RuYa9WtJCEJkkqvQfPboYK7VwURpLim', 005, 2),
('STD008', '$2y$10$8PGnFaiZPYtcIGrwzMmVZuNKbUb/A88f0NZOA9QVgHaUIJ6ddg.Si', 008, 2),
('STD026', '$2y$10$8WNMvEEgNPWyRuSeeLDE1uXwnBkYNJE/heLT1zWbsUfYb/wKFyYIy', 026, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(2) NOT NULL,
  `role_id` int(1) NOT NULL,
  `menu_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(2) NOT NULL,
  `menu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Master'),
(3, 'Attendance'),
(4, 'Profile'),
(5, 'Report');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(1) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `user_submenu`
--

CREATE TABLE `user_submenu` (
  `id` int(2) NOT NULL,
  `menu_id` int(2) NOT NULL,
  `title` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_submenu`
--

INSERT INTO `user_submenu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Department', 'master', 'fas fa-fw fa-building', 1),
(3, 2, 'Shift', 'master/shift', 'fas fa-fw fa-exchange-alt', 1),
(4, 2, 'Employee', 'master/employee', 'fas fa-fw fa-id-badge', 1),
(5, 2, 'Location', 'master/location', 'fas fa-fw fa-map-marker-alt', 1),
(6, 3, 'Attendance Form', 'attendance', 'fas fa-fw fa-clipboard-list', 1),
(7, 3, 'Statistics', 'attendance/stats', 'fas fa-fw fa-chart-pie', 0),
(8, 4, 'My Profile', 'profile', 'fas fa-fw fa-id-card', 1),
(9, 2, 'Users', 'master/users', 'fas fa-fw fa-users', 1),
(11, 5, 'Print Report', 'report', 'fas fa-fw fa-paste', 1),
(12, 3, 'History', 'attendance/history', 'fas fa-fw fa-th-list', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `shift_id` (`shift_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shift_id_fk_e` (`shift_id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_department_ibfk_1` (`employee_id`),
  ADD KEY `employee_department_ibfk_2` (`department_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_submenu`
--
ALTER TABLE `user_submenu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_access`
--
ALTER TABLE `user_access`
  ADD CONSTRAINT `user_access_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_access_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_submenu`
--
ALTER TABLE `user_submenu`
  ADD CONSTRAINT `user_submenu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
