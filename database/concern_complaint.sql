-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 04:54 PM
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
-- Database: `concern_complaint`
--

-- --------------------------------------------------------

--
-- Table structure for table `blotter`
--

CREATE TABLE `blotter` (
  `blotter_Id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `c_firstname` varchar(50) DEFAULT NULL,
  `c_middlename` varchar(50) DEFAULT NULL,
  `c_lastname` varchar(50) DEFAULT NULL,
  `c_suffix` varchar(10) DEFAULT NULL,
  `c_contact` varchar(15) DEFAULT NULL,
  `c_address` varchar(255) DEFAULT NULL,
  `incidentDate` date DEFAULT NULL,
  `incidentTime` time DEFAULT NULL,
  `incidentNature` varchar(100) DEFAULT NULL,
  `incidentAddress` varchar(255) DEFAULT NULL,
  `acc_firstname` varchar(50) DEFAULT NULL,
  `acc_middlename` varchar(50) DEFAULT NULL,
  `acc_lastname` varchar(50) DEFAULT NULL,
  `acc_suffix` varchar(10) DEFAULT NULL,
  `acc_address` varchar(255) DEFAULT NULL,
  `witnesses` text DEFAULT NULL,
  `incidentDescription` text DEFAULT NULL,
  `actionTaken` text DEFAULT NULL,
  `attachments` varchar(255) DEFAULT NULL,
  `blotter_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Open, 1=Closed, 2=Under Investigation',
  `is_read` int(11) NOT NULL DEFAULT 0 COMMENT '0=False, 1=True',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blotter`
--

INSERT INTO `blotter` (`blotter_Id`, `added_by`, `c_firstname`, `c_middlename`, `c_lastname`, `c_suffix`, `c_contact`, `c_address`, `incidentDate`, `incidentTime`, `incidentNature`, `incidentAddress`, `acc_firstname`, `acc_middlename`, `acc_lastname`, `acc_suffix`, `acc_address`, `witnesses`, `incidentDescription`, `actionTaken`, `attachments`, `blotter_status`, `is_read`, `date_added`) VALUES
(12, 66, 'dsadsa', 'dadas', 'dasd', 'asdasda', '9123456789', 'dsadasda', '2024-03-26', '23:47:00', 'dsa', 'dsadsadad', 'asdas', 'dsad', 'sadas', 'da', 'dsadsa', 'dsadsadas', 'asdasdasd', 'Adas', '3.jpg', 0, 0, '2024-03-11 23:44:24'),
(13, 90, 'dsads', 'adadadsa', 'dsada', 'dasd', '9123456789', 'Adadadsa', '1992-07-08', '03:02:00', 'Adadadsa', 'Adadadsa', 'Adadadsa', 'AdadadsaAdadadsa', 'Adadadsa', 'Adadadsa', 'dsada', 'dsadada', 'dadasda', 'Dsada', '1.jpg', 0, 1, '2024-03-12 03:59:22'),
(15, 66, 'dsa', 'dsada', 'dsadsa', 'dadas', '9123456322', 'dsadas', '2024-03-13', '21:01:00', 'dsada', 'dasda', 'adas', 'dsad', 'adsad', 'asdasdas', 'das', 'dsada', 'dsadsad', 'asdasdasd', '2.jpg', 0, 0, '2024-03-21 21:58:19'),
(16, 90, 'dasdsas', 'dsad', 'asdasd', 'asdada', '9509972084', 'fdsfsd', '2024-03-06', '22:04:00', 'fdsfsf', 'dsfsdfsf', 'sdfsdf', 'sfsd', 'fsdfsd', 'fsfsfsf', 'sfs', 'fdsfs', 'fsfs', 'Fsdfdsfds', 'pexels-photo-769772.jpeg', 1, 0, '2024-03-21 22:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_ID` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `complaint_nature` varchar(255) NOT NULL,
  `incident_location` varchar(255) NOT NULL,
  `date_happened` date NOT NULL,
  `time_happened` varchar(50) NOT NULL,
  `witness` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `attachments` varchar(255) NOT NULL,
  `preferred_solution` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Verified, 2=Rejected, 3=Solved',
  `date_confirmed` datetime NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0 COMMENT '0=False, 1=True',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_ID`, `added_by`, `complaint_nature`, `incident_location`, `date_happened`, `time_happened`, `witness`, `details`, `attachments`, `preferred_solution`, `status`, `date_confirmed`, `is_read`, `date_added`) VALUES
(6, 66, 'dsadasd', 'dsadasda', '2024-03-07', '13:44', 'dsadsa', 'dsada', '2.jpg', 'dsadsadas', 3, '0000-00-00 00:00:00', 0, '2024-02-28 12:39:48'),
(7, 90, 'dsadsadads', 'dadasdadsa\r\n', '2024-03-19', '06:10', 'dsadadsa', 'Sample2', '1.jpg,2.jpg,3.jpg', 'dsadasd', 0, '0000-00-00 00:00:00', 1, '2024-03-11 20:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `login_datetime` datetime NOT NULL,
  `logout_datetime` datetime NOT NULL,
  `logout_remarks` int(11) NOT NULL DEFAULT 0 COMMENT '0=Logged out successfully, 1=Unable to logout last login'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `log_history`
--

INSERT INTO `log_history` (`log_Id`, `user_Id`, `login_datetime`, `logout_datetime`, `logout_remarks`) VALUES
(131, 66, '2024-02-28 20:39:21', '2024-02-28 20:42:29', 0),
(132, 66, '2024-03-11 22:35:34', '2024-03-11 23:20:38', 0),
(133, 66, '2024-03-11 23:20:45', '2024-03-11 23:54:24', 0),
(134, 66, '2024-03-11 23:54:34', '2024-03-12 00:04:37', 0),
(135, 66, '2024-03-12 01:27:01', '2024-03-12 01:37:02', 1),
(136, 66, '2024-03-12 01:28:08', '0000-00-00 00:00:00', 1),
(137, 66, '2024-03-12 01:34:03', '2024-03-12 01:34:21', 0),
(138, 66, '2024-03-12 01:50:54', '0000-00-00 00:00:00', 0),
(139, 66, '2024-03-12 01:54:29', '2024-03-12 01:54:49', 0),
(140, 66, '2024-03-12 01:59:44', '0000-00-00 00:00:00', 0),
(141, 66, '2024-03-12 02:01:05', '2024-03-12 02:01:14', 0),
(142, 66, '2024-03-12 02:03:17', '2024-03-12 02:03:34', 0),
(143, 66, '2024-03-12 02:03:39', '2024-03-12 02:13:58', 0),
(144, 66, '2024-03-12 02:04:04', '0000-00-00 00:00:00', 0),
(145, 90, '2024-03-12 03:32:04', '2024-03-12 03:58:22', 0),
(146, 90, '2024-03-12 03:51:05', '0000-00-00 00:00:00', 1),
(147, 90, '2024-03-12 03:58:42', '0000-00-00 00:00:00', 0),
(148, 90, '2024-03-12 17:09:54', '2024-03-12 17:11:32', 0),
(149, 66, '2024-03-12 17:12:58', '2024-03-12 17:28:56', 0),
(150, 66, '2024-03-12 17:32:37', '0000-00-00 00:00:00', 0),
(151, 66, '2024-03-12 17:54:58', '2024-03-12 19:17:56', 0),
(152, 66, '2024-03-12 19:27:22', '2024-03-12 19:41:46', 0),
(153, 66, '2024-03-12 19:42:37', '2024-03-12 20:54:56', 0),
(154, 96, '2024-03-14 20:26:59', '2024-03-14 20:27:15', 0),
(155, 96, '2024-03-14 20:27:29', '2024-03-14 20:29:39', 0),
(156, 66, '2024-03-14 20:30:01', '2024-03-14 20:31:50', 0),
(157, 66, '2024-03-14 20:33:01', '2024-03-14 20:42:19', 0),
(158, 66, '2024-03-14 20:46:05', '0000-00-00 00:00:00', 0),
(159, 66, '2024-03-21 21:34:58', '2024-03-21 21:47:54', 0),
(160, 90, '2024-03-21 21:48:29', '2024-03-21 21:49:57', 0),
(161, 66, '2024-03-21 21:54:06', '2024-03-21 22:00:20', 0),
(162, 90, '2024-03-21 22:00:25', '2024-03-21 22:06:43', 0),
(163, 66, '2024-03-21 22:06:48', '2024-03-21 22:27:44', 0),
(164, 90, '2024-03-21 22:27:50', '2024-03-21 22:27:59', 0),
(165, 66, '2024-03-21 22:28:05', '2024-03-21 22:39:58', 0),
(166, 90, '2024-03-21 22:40:05', '2024-03-21 22:40:13', 0),
(167, 66, '2024-03-21 22:40:17', '2024-03-21 22:46:12', 0),
(168, 66, '2024-03-21 22:59:06', '2024-03-21 22:59:10', 0),
(169, 90, '2024-03-21 22:59:44', '2024-03-21 22:59:48', 0),
(170, 66, '2024-03-21 23:04:17', '2024-03-21 23:04:22', 0),
(171, 101, '2024-03-21 23:50:16', '2024-03-21 23:50:23', 0),
(172, 101, '2024-03-21 23:52:08', '0000-00-00 00:00:00', 1),
(173, 101, '2024-03-21 23:53:36', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `suffix` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT 'User',
  `verification_code` int(11) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Verified',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `gender`, `email`, `contact`, `address`, `image`, `password`, `user_type`, `verification_code`, `is_verified`, `created_at`) VALUES
(66, 'AdminKoss', 'AdminKos', 'AdminKoss', 'AdminKos', '1979-02-28', 45, 'Male', 'admin@gmail.com', '9509972084', 'AdminKo', '4.jpg', '0192023a7bbd73250516f069df18b500', 'Admin', NULL, 1, '2022-11-24 16:00:00'),
(90, 'Kanids', 'Kani', 'Kani', 'Kani', '1994-10-11', 29, 'Female', 'residents@gmail.com', '9509972085', 'ResidentKani', '2.jpg', '0192023a7bbd73250516f069df18b500', 'User', NULL, 1, '2024-02-10 18:50:35'),
(101, 'Hahay', 'Hahay', 'Hahay', 'Hahay', '1995-01-30', 29, 'Male', NULL, '9912084626', 'Hahay', 'testimonials-5.jpg', '5bb3fd0bd3e6c36990367456eee83314', 'User', NULL, 1, '2024-03-21 15:49:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blotter`
--
ALTER TABLE `blotter`
  ADD PRIMARY KEY (`blotter_Id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_ID`);

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
  ADD PRIMARY KEY (`log_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blotter`
--
ALTER TABLE `blotter`
  MODIFY `blotter_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log_history`
--
ALTER TABLE `log_history`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
