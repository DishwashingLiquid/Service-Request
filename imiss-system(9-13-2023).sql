-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2023 at 06:55 AM
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
-- Database: `imiss-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin-list`
--

CREATE TABLE `admin-list` (
  `id_name` varchar(100) NOT NULL DEFAULT 'IMISS-',
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `admin_fname` varchar(100) NOT NULL,
  `admin_mname` varchar(100) NOT NULL,
  `admin_lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin-list`
--

INSERT INTO `admin-list` (`id_name`, `id`, `admin_fname`, `admin_mname`, `admin_lname`, `username`, `password`, `updated_by`) VALUES
('IMISS-', 0001, 'First', 'Middle', 'Imiss', 'imiss1', 'imiss1', 'Super Admin Name'),
('IMISS-', 0002, 'Second', 'Middle', 'Imiss', 'imiss2', 'imiss2', 'First Name Reception'),
('IMISS-', 0003, 'Third', 'Middle', 'Imiss', 'imiss3', 'imiss3', 'First Name Reception');

-- --------------------------------------------------------

--
-- Table structure for table `end-user-list`
--

CREATE TABLE `end-user-list` (
  `id_name` varchar(100) NOT NULL DEFAULT 'USER-',
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `division` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `end_user_fname` varchar(100) NOT NULL,
  `end_user_mname` varchar(100) NOT NULL,
  `end_user_lname` varchar(100) NOT NULL,
  `contact_no` bigint(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_approved` varchar(100) DEFAULT 'false',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `end-user-list`
--

INSERT INTO `end-user-list` (`id_name`, `id`, `division`, `area`, `end_user_fname`, `end_user_mname`, `end_user_lname`, `contact_no`, `email`, `username`, `password`, `is_approved`, `updated_by`) VALUES
('USER-', 0001, 'Division 1', '', 'First', 'Middle', 'User', 9546879258, 'asd@gmail.com', 'user1', 'user1', 'true', 'Super Admin Name'),
('USER-', 0002, 'Division', '', 'Second', 'Middle', 'User', 9215452156, 'qwe@gmail.com', 'user2', 'user2', 'true', 'First Name Reception'),
('USER-', 0003, 'Division 4', '', 'First 4', 'Middle 4', 'User', 9456789123, 'arawagdenissejoy03@gmail.com', 'user4', 'user4', 'true', 'First Name Reception'),
('USER-', 0004, 'Division 1', 'Area Section Unit 1', 'one', 'two', 'three', 9456789152, 'asd@gmail.com', 'user6', 'user6', 'true', 'First Name Reception');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-desktop`
--

CREATE TABLE `equipment-list-desktop` (
  `id_name` varchar(100) NOT NULL DEFAULT 'PC',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `ms_office` varchar(100) NOT NULL,
  `ups` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-desktop`
--

INSERT INTO `equipment-list-desktop` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `ms_office`, `ups`, `os`, `status`, `updated_by`) VALUES
('PC', '2023', 0001, 'one', 'one', 'one', 'one', 'one', 'one', 'Active', 'First Middle Imiss'),
('PC', '2023', 0002, 'two', 'two', 'two', 'two', 'two', 'two', 'Active', 'First Middle Imiss'),
('PC', '2023', 0003, 'area 3', 'brand 3', 'model 3', 'ms 3', 'ups 3', 'os 3', 'Inactive', 'First Middle Imiss'),
('PC', '2023', 0004, 'area 4', 'brand 4', 'model 4', 'ms 4', 'ups 4', 'os 4', 'Active', 'First Middle Imiss'),
('PC', '2023', 0005, 'area 5', 'brand 5', 'model 5', 'ms 5', 'ups 5', 'os 5', 'Inactive', 'First Middle Imiss'),
('PC', '2023', 0006, 'area 6', 'brand 6', 'model 6', 'ms 6', 'ups 6', 'os 6', 'Inactive', 'First Middle Imiss'),
('PC', '2023', 0007, 'area 7', 'brand 7', 'model 7', 'ms 7', 'ups 7', 'os 7', 'Inactive', 'First Middle Imiss'),
('PC', '2023', 0008, 'area 8', 'brand 8', 'model 8', 'ms 8', 'ups 8', 'os 8', 'Active', 'First Middle Imiss'),
('PC', '2023', 0009, 'area 9', 'brand 9', 'model 9', 'ms 9', 'ups 9', 'os 9', 'Inactive', 'First Middle Imiss'),
('PC', '2023', 0010, 'area 10', 'brand 10', 'model 10', 'ms 10', 'ups 10', 'os 10', 'Active', 'First Middle Imiss'),
('PC', '2023', 0011, 'area 11', 'brand 11', 'model 11', 'ms 11', 'ups 11', 'os 11', 'Active', 'First Middle Imiss');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-kiosk`
--

CREATE TABLE `equipment-list-kiosk` (
  `id_name` varchar(100) NOT NULL DEFAULT 'KIO',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-kiosk`
--

INSERT INTO `equipment-list-kiosk` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `os`, `status`, `updated_by`) VALUES
('KIO', '2023', 0001, 'one', 'one', 'one', 'one', 'Inactive', 'First Middle Imiss'),
('KIO', '2023', 0002, 'area 2', 'brand 2', '', 'os 2', 'Active', 'First Name Reception'),
('KIO', '2023', 0003, 'area 3', 'brand 3', 'model 3', 'os 3', 'Inactive', 'Super Admin Name');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-laptop`
--

CREATE TABLE `equipment-list-laptop` (
  `id_name` varchar(100) NOT NULL DEFAULT 'LTP',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `ms_office` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-laptop`
--

INSERT INTO `equipment-list-laptop` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `ms_office`, `os`, `status`, `updated_by`) VALUES
('LTP', '2023', 0001, 'one', 'one', 'one', 'one', 'one', 'Inactive', 'First Middle Imiss'),
('LTP', '2023', 0002, '', 'brand 1', '', 'ms 1', 'os 1', 'Inactive', 'First Middle Imiss'),
('LTP', '2023', 0003, 'area 3', 'brand 3', 'model 3', 'ms 3', 'os 3', 'Inactive', 'Super Admin Name'),
('LTP', '2023', 0004, 'area 4', 'brand 4', 'model 4', 'ms 4', 'os 4', 'Active', 'First Middle Imiss');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-printer`
--

CREATE TABLE `equipment-list-printer` (
  `id_name` varchar(100) NOT NULL DEFAULT 'PRT',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `ink_type` varchar(100) NOT NULL,
  `ink_code` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-printer`
--

INSERT INTO `equipment-list-printer` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `type`, `ink_type`, `ink_code`, `status`, `updated_by`) VALUES
('PRT', '2023', 0001, 'one', 'one', 'one', 'Multifunction', 'CIS', 'one', 'Inactive', 'First Middle Imiss'),
('PRT', '2023', 0002, 'area 2', '', '', 'Multifunction', 'Cartridge', 'ink 2', 'Active', 'First Name Reception'),
('PRT', '2023', 0003, 'area 3', '', '', 'Printer Only', 'Ribbon', 'ink 4', 'Active', 'First Middle Imiss'),
('PRT', '2023', 0004, 'area 4', 'brand 4', 'model 4', 'Multifunction', 'Toner', 'ink 4', 'Inactive', 'Super Admin Name'),
('PRT', '2023', 0005, 'area 5', 'brand 5', 'model 5', 'Printer Only', 'Toner', 'ink 5', 'Active', 'Super Admin Name');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-router`
--

CREATE TABLE `equipment-list-router` (
  `id_name` varchar(100) NOT NULL DEFAULT 'RTR',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `mac_address` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-router`
--

INSERT INTO `equipment-list-router` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `mac_address`, `status`, `updated_by`) VALUES
('RTR', '2023', 0001, 'one', 'one', 'one', 'one', 'Inactive', 'First Middle Imiss'),
('RTR', '2023', 0002, 'area 2', 'brand 2', 'model 2', 'mac 2', 'Inactive', 'Super Admin Name'),
('RTR', '2023', 0003, 'area 3', 'brand 3', 'model 3', 'mac 3', 'Active', 'Super Admin Name'),
('RTR', '2023', 0004, 'area 4', 'brand 4', 'model 4', 'mac 4', 'Active', 'First Middle Imiss');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-scanner`
--

CREATE TABLE `equipment-list-scanner` (
  `id_name` varchar(100) NOT NULL DEFAULT 'SCN',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-scanner`
--

INSERT INTO `equipment-list-scanner` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `type`, `status`, `updated_by`) VALUES
('SCN', '2023', 0001, 'one', 'one', 'one', 'one', 'Active', 'First Middle Imiss'),
('SCN', '2023', 0002, 'area 2', 'brand 2', 'model 2', 'type 2', 'Active', 'Super Admin Name');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-server`
--

CREATE TABLE `equipment-list-server` (
  `id_name` varchar(100) NOT NULL DEFAULT 'SRV',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `application` varchar(100) NOT NULL,
  `specification` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-server`
--

INSERT INTO `equipment-list-server` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `application`, `specification`, `status`, `updated_by`) VALUES
('SRV', '2023', 0001, 'one', 'one', 'one', 'one', 'one', 'Inactive', 'First Middle Imiss'),
('SRV', '2023', 0002, '', 'brand 2', '', 'application 2', 'specification 2', 'Active', 'First Name Reception'),
('SRV', '2023', 0003, 'area 3', 'brand 3', 'model 3', 'application 3', 'specification 3', 'Inactive', 'Super Admin Name'),
('SRV', '2023', 0004, 'area 4', 'brand 4', 'model 4', 'application 4', 'specification 4', 'Active', 'Super Admin Name');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-switch`
--

CREATE TABLE `equipment-list-switch` (
  `id_name` varchar(100) NOT NULL DEFAULT 'SWT',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `no_of_ports` int(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-switch`
--

INSERT INTO `equipment-list-switch` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `no_of_ports`, `status`, `updated_by`) VALUES
('SWT', '2023', 0001, 'one', 'one', 'one', 1, 'Inactive', 'First Middle Imiss'),
('SWT', '2023', 0002, 'area 2', 'brand 2', 'model 2', 2, 'Active', 'First Name Reception');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-tv`
--

CREATE TABLE `equipment-list-tv` (
  `id_name` varchar(100) NOT NULL DEFAULT 'TV',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `specification` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-tv`
--

INSERT INTO `equipment-list-tv` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `specification`, `status`, `updated_by`) VALUES
('TV', '2023', 0001, 'one', 'one', 'one', 'specification one', 'Inactive', 'First Middle Imiss'),
('TV', '2023', 0002, 'area 2', 'brand 2', 'model 2', 'specification 2', 'Inactive', 'Super Admin Name'),
('TV', '2023', 0003, 'area 3', 'brand 3', 'model 3', 'specification 3', 'Active', 'Super Admin Name');

-- --------------------------------------------------------

--
-- Table structure for table `equipment-list-ups`
--

CREATE TABLE `equipment-list-ups` (
  `id_name` varchar(100) NOT NULL DEFAULT 'UPS',
  `id_year` year(4) NOT NULL DEFAULT current_timestamp(),
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `area` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `no_of_kva` int(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment-list-ups`
--

INSERT INTO `equipment-list-ups` (`id_name`, `id_year`, `id`, `area`, `brand`, `model`, `type`, `no_of_kva`, `status`, `updated_by`) VALUES
('UPS', '2023', 0001, 'area 1', 'brand 1', '', 'type 1', 1, 'Inactive', 'Super Admin Name'),
('UPS', '2023', 0002, 'area 2', 'brand 2', 'model 2', 'type 2', 2, 'Inactive', 'Super Admin Name'),
('UPS', '2023', 0003, 'area 3', 'brand 3', 'model 3', 'type 3', 3, 'Inactive', 'First Middle Imiss');

-- --------------------------------------------------------

--
-- Table structure for table `reception-list`
--

CREATE TABLE `reception-list` (
  `id_name` varchar(100) NOT NULL DEFAULT 'REC-',
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `reception_fname` varchar(100) NOT NULL,
  `reception_mname` varchar(100) NOT NULL,
  `reception_lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reception-list`
--

INSERT INTO `reception-list` (`id_name`, `id`, `reception_fname`, `reception_mname`, `reception_lname`, `username`, `password`, `updated_by`) VALUES
('REC-', 0001, 'First', 'Name', 'Reception', 'reception1', 'reception1', 'Super Admin Name');

-- --------------------------------------------------------

--
-- Table structure for table `request-list`
--

CREATE TABLE `request-list` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `date_requested` date NOT NULL DEFAULT current_timestamp(),
  `time_requested` time NOT NULL DEFAULT current_timestamp(),
  `end_user_id` int(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  `ict_equipment_code` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type_of_service` varchar(100) NOT NULL,
  `ict_component` varchar(100) NOT NULL,
  `ict_component_spec` varchar(500) NOT NULL,
  `assessment` varchar(255) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `service_rendered` varchar(255) NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'On-going',
  `date_pending` date NOT NULL,
  `time_pending` time NOT NULL,
  `date_resolved` date NOT NULL,
  `time_resolved` time NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request-list`
--

INSERT INTO `request-list` (`id`, `date_requested`, `time_requested`, `end_user_id`, `area`, `ict_equipment_code`, `description`, `type_of_service`, `ict_component`, `ict_component_spec`, `assessment`, `remarks`, `service_rendered`, `admin_id`, `status`, `date_pending`, `time_pending`, `date_resolved`, `time_resolved`, `updated_by`) VALUES
(0001, '2023-09-12', '15:09:09', 1, '', 'PC-2023-0003', 'Ticket 1', 'Remote', 'Software', 'DMS<br>HIS', 'assessed', 'Completed', 'Network connectivity', '0001', 'Resolved', '0000-00-00', '00:00:00', '2023-09-12', '15:12:57', 'First Middle Imiss'),
(0002, '2023-09-12', '15:09:15', 1, '', 'PC-2023-0005', 'Ticket 2', 'Physical', 'Hardware', 'Output Device Troubleshooting<br>Internet, Network & Cable Management', 'assessed', 'Pending', 'ICT hardware with repair', '0001', 'Pending', '2023-09-12', '15:18:26', '0000-00-00', '00:00:00', 'First Middle Imiss'),
(0003, '2023-09-12', '15:09:26', 1, '', 'LTP-2023-0001', 'Ticket 3', 'Remote', 'Software', 'DMAS<br>HRIS<br>others', 'assesed', 'Pending', 'Network connectivity', '0001', 'Pending', '2023-09-12', '15:21:37', '0000-00-00', '00:00:00', 'First Middle Imiss'),
(0004, '2023-09-12', '15:09:31', 1, '', 'LTP-2023-0002', 'Ticket 4', '', '', '', '', '', '', '0001', 'On-going', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 'First Middle Imiss'),
(0005, '2023-09-12', '15:17:57', 0, '', 'PRT-2023-0001', 'Ticket 6', 'Remote', 'Hardware', 'Input Device Troubleshooting', 'assessed', 'Pending', 'ICT hardware without repair', '0001', 'Pending', '2023-09-12', '16:32:25', '0000-00-00', '00:00:00', 'First Middle Imiss'),
(0006, '2023-09-12', '16:34:06', 1, '', 'LTP-2023-0002', 'Ticket 20', 'Remote', 'Hardware', 'Storage Device Troubleshooting', 'sdasda', 'Pending', 'End-Users training', '0001', 'Pending', '2023-09-12', '16:34:32', '0000-00-00', '00:00:00', 'First Middle Imiss');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin-list`
--

CREATE TABLE `superadmin-list` (
  `id_name` varchar(100) NOT NULL DEFAULT 'SUPER-',
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `superadmin_fname` varchar(100) NOT NULL,
  `superadmin_mname` varchar(100) NOT NULL,
  `superadmin_lname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin-list`
--

INSERT INTO `superadmin-list` (`id_name`, `id`, `superadmin_fname`, `superadmin_mname`, `superadmin_lname`, `username`, `password`) VALUES
('SUPER-', 0001, 'Super', 'Admin', 'Name', 'super1', 'super1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin-list`
--
ALTER TABLE `admin-list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `end-user-list`
--
ALTER TABLE `end-user-list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-desktop`
--
ALTER TABLE `equipment-list-desktop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-kiosk`
--
ALTER TABLE `equipment-list-kiosk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-laptop`
--
ALTER TABLE `equipment-list-laptop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-printer`
--
ALTER TABLE `equipment-list-printer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-router`
--
ALTER TABLE `equipment-list-router`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-scanner`
--
ALTER TABLE `equipment-list-scanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-server`
--
ALTER TABLE `equipment-list-server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-switch`
--
ALTER TABLE `equipment-list-switch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-tv`
--
ALTER TABLE `equipment-list-tv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment-list-ups`
--
ALTER TABLE `equipment-list-ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reception-list`
--
ALTER TABLE `reception-list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request-list`
--
ALTER TABLE `request-list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin-list`
--
ALTER TABLE `superadmin-list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin-list`
--
ALTER TABLE `admin-list`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `end-user-list`
--
ALTER TABLE `end-user-list`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment-list-desktop`
--
ALTER TABLE `equipment-list-desktop`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `equipment-list-kiosk`
--
ALTER TABLE `equipment-list-kiosk`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipment-list-laptop`
--
ALTER TABLE `equipment-list-laptop`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment-list-printer`
--
ALTER TABLE `equipment-list-printer`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `equipment-list-router`
--
ALTER TABLE `equipment-list-router`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment-list-scanner`
--
ALTER TABLE `equipment-list-scanner`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipment-list-server`
--
ALTER TABLE `equipment-list-server`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment-list-switch`
--
ALTER TABLE `equipment-list-switch`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipment-list-tv`
--
ALTER TABLE `equipment-list-tv`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipment-list-ups`
--
ALTER TABLE `equipment-list-ups`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reception-list`
--
ALTER TABLE `reception-list`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request-list`
--
ALTER TABLE `request-list`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `superadmin-list`
--
ALTER TABLE `superadmin-list`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
