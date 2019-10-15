-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 05:31 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyberclo_tracking_talents`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(22) NOT NULL,
  `state_id` int(22) NOT NULL,
  `names` varchar(200) NOT NULL,
  `status` int(22) NOT NULL,
  `user_id` int(22) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `names`, `status`, `user_id`, `modified`) VALUES
(20, 3, 'Los Angeles', 1, 1, '2019-02-05 09:57:27'),
(22, 3, 'San Diego', 1, 1, '2019-02-05 09:57:47'),
(23, 4, 'Jacksonville', 1, 1, '2019-02-05 10:01:16'),
(24, 3, 'San Francisco', 1, 1, '2019-02-05 09:58:13'),
(25, 4, 'Miami', 1, 1, '2019-02-05 10:01:50'),
(26, 4, 'Tampa', 1, 1, '2019-02-05 10:02:13'),
(27, 4, 'Orlando', 1, 1, '2019-02-05 10:03:12'),
(28, 5, 'Montgomery', 1, 1, '2019-02-15 13:27:00'),
(29, 4, 'Charlote', 1, 1, '2019-02-06 00:00:00'),
(30, 4, 'Kissimmee', 1, 1, '2019-02-10 09:10:16'),
(31, 4, 'Maimi North', 1, 1, '2019-02-19 00:00:00'),
(32, 4, 'Richmond', 1, 1, '2019-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `companyname` varchar(222) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `companyname`, `status`, `user_id`, `modified`) VALUES
(5, 'Flexbux', 1, 1, '2019-02-04 18:44:11'),
(6, 'Tampa Bus', 1, 1, '2019-02-04 18:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `activity`, `note`, `modified`) VALUES
(1, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-10 14:32:44'),
(2, 1, 'Super Admin Logout', 'The user   logged out', '2019-01-10 14:35:41'),
(3, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-10 14:36:31'),
(4, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-10 14:38:30'),
(5, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-10 14:47:03'),
(6, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-10 14:47:27'),
(7, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-10 14:49:18'),
(9, 1, 'User Added', 'Saif Afridi added a user with the role of Admin', '2019-01-10 15:46:07'),
(10, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-10 15:47:34'),
(11, 3, 'Admin Login', 'The user Abid Khan logged in', '2019-01-10 15:48:11'),
(12, 3, 'Admin Login', 'The user Abid Khan logged in', '2019-01-10 16:14:27'),
(13, 3, 'Admin Logout', 'The user Abid Khan logged out', '2019-01-10 16:16:19'),
(14, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-10 16:18:03'),
(15, 1, 'User Profile Updated', 'Saif Afridi updated the user profile of Super Admin', '2019-01-10 17:00:45'),
(16, 1, 'User Profile Updated', 'Saif Afridi updated the user profile of Super Admin', '2019-01-10 17:02:24'),
(17, 1, 'User Profile Updated', 'Saif Afridi updated the user profile of Admin', '2019-01-10 17:07:35'),
(18, 1, 'User Profile Updated', 'Saif Afridi updated the user profile of Admin(Abid Khan)', '2019-01-10 17:08:26'),
(19, 1, 'User Deleted', 'Saif Afridi delete the (Abid  Khan)', '2019-01-10 17:40:37'),
(20, 1, 'User Added', 'Saif Afridi added a user with the role of Admin', '2019-01-10 17:42:35'),
(21, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-10 17:57:28'),
(22, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-10 17:57:39'),
(23, 4, 'Admin Logout', 'The user Abid Khan logged out', '2019-01-10 18:03:36'),
(24, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-10 18:03:44'),
(25, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-10 18:09:44'),
(26, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-10 18:09:53'),
(27, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-10 18:12:40'),
(28, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-10 18:22:28'),
(29, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-10 18:23:31'),
(30, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-11 09:45:56'),
(31, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-11 09:46:37'),
(32, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-11 09:48:05'),
(33, 4, 'Admin Logout', 'The user Abid Khan logged out', '2019-01-11 09:48:14'),
(34, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-11 09:50:06'),
(35, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-11 10:07:51'),
(36, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-11 10:08:00'),
(37, 4, 'User Profile Updated', 'Abid Khan updated the user profile of Admin(Abid Khan)', '2019-01-11 10:18:22'),
(38, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-11 10:18:48'),
(39, 4, 'Admin Logout', 'The user Abid Khan logged out', '2019-01-11 10:41:11'),
(40, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-11 10:41:29'),
(41, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-11 10:42:43'),
(42, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-11 10:43:01'),
(43, 1, 'New City Added', 'Super Admin added a new city (Peshawar)', '2019-01-11 11:06:20'),
(44, 1, 'New City Added', 'Super Admin added a new city (Islamabad)', '2019-01-11 11:07:58'),
(45, 1, 'City Deleted', 'Super Admin deleted the city (Islamabad)', '2019-01-11 11:50:30'),
(46, 1, 'City Deleted', 'Super Admin deleted the city (Peshawar)', '2019-01-11 11:51:22'),
(47, 1, 'New City Added', 'Super Admin added a new city (Peshawar)', '2019-01-11 11:52:41'),
(48, 1, 'New City Added', 'Super Admin added a new city (Islamabad)', '2019-01-11 11:52:57'),
(49, 1, 'New City Added', 'Super Admin added a new city (Karachi)', '2019-01-11 13:25:16'),
(50, 1, 'City Updated', 'Super Admin updated the city (Peshawar)', '2019-01-11 13:42:48'),
(51, 1, 'City Deleted', 'Super Admin deleted the city (Karachi)', '2019-01-11 13:57:44'),
(52, 1, 'Bus Added', 'Bilal Caoch bus number (pew 1234) added by Super Admin', '2019-01-11 14:12:47'),
(53, 1, 'Bus Updated', 'Bilal Caoch bus number (pew 1234) updated by Super Admin', '2019-01-11 15:00:15'),
(54, 1, 'Bus Deleted', 'Bilal Caoch bus number (pew 1234) deleted by Super Admin', '2019-01-11 15:06:28'),
(55, 1, 'Bus Added', 'Bilal Caoch bus number (pew 1234) added by Super Admin', '2019-01-11 15:11:05'),
(56, 1, 'Bus Added', 'Bilal Caoch bus number (lha 1430) added by Super Admin', '2019-01-11 15:17:32'),
(57, 1, 'Seat Number Added', 'Seat number (Seat 1) added by Super Admin', '2019-01-11 16:03:32'),
(58, 1, 'Seat Number Updated', 'Seat number (Seat 1) updated by Super Admin', '2019-01-11 16:31:19'),
(59, 1, 'Seat Deleted', 'Seat number (Seat 1) deleted by Super Admin', '2019-01-11 16:35:55'),
(60, 1, 'Seat Number Added', 'Seat number (Seat 1) added by Super Admin', '2019-01-11 16:38:37'),
(61, 1, 'Seat Number Added', 'Seat number (Seat 2) added by Super Admin', '2019-01-11 16:38:57'),
(62, 1, 'Seat Number Added', 'Seat number (Seat 3) added by Super Admin', '2019-01-11 16:39:21'),
(63, 1, 'Payment Type Added', 'Payment Type (PAYPAL) stored by Super Admin', '2019-01-11 17:13:14'),
(64, 1, 'Payment Type Added', 'Payment Type (CREDIT CARD) stored by Super Admin', '2019-01-11 17:15:00'),
(65, 1, 'Payment Type Updated', 'Payment type (PAYPAL) updated by Super Admin', '2019-01-11 17:39:20'),
(66, 1, 'Payment Type Deleted', 'Payment type () deleted by Super Admin', '2019-01-11 17:53:06'),
(67, 1, 'Payment Type Deleted', 'Payment type (CREDIT CARD) deleted by Super Admin', '2019-01-11 17:54:45'),
(68, 1, 'Payment Type Added', 'Payment Type (CREDIT CARD) stored by Super Admin', '2019-01-11 17:55:54'),
(69, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-12 09:51:15'),
(70, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-12 11:20:27'),
(71, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-12 11:25:26'),
(72, 1, 'Terminal Added', 'The terminal name ({\n    \"name\": \"Haji Camp\",\n    \"user_id\": 1,\n    \"status\": 1,\n    \"created\": \"2019-01-12T15:23:20+00:00\",\n    \"modified\": \"2019-01-12T15:23:20+00:00\",\n    \"id\": 1\n}) added by Super Admin', '2019-01-12 15:23:20'),
(73, 1, 'Terminal Added', 'The terminal name ({\n    \"name\": \"Faiz Abad\",\n    \"user_id\": 1,\n    \"status\": 1,\n    \"created\": \"2019-01-12T15:27:36+00:00\",\n    \"modified\": \"2019-01-12T15:27:36+00:00\",\n    \"id\": 2\n}) added by Super Admin', '2019-01-12 15:27:36'),
(74, 1, 'Terminal Added', 'The terminal name ({\n    \"name\": \"Kohat Road\",\n    \"user_id\": 1,\n    \"status\": 1,\n    \"created\": \"2019-01-12T15:31:25+00:00\",\n    \"modified\": \"2019-01-12T15:31:25+00:00\",\n    \"id\": 3\n}) added by Super Admin', '2019-01-12 15:31:25'),
(75, 1, 'Terminal Added', 'The terminal name (Hayat Abad) added by Super Admin', '2019-01-12 15:32:55'),
(76, 1, 'Terminal Updated', 'The terminal name (Haji Camp) updated by Super Admin', '2019-01-12 16:01:54'),
(77, 1, 'Terminal Updated', 'The terminal name (Haji Camp) updated by Super Admin', '2019-01-12 16:02:28'),
(78, 1, 'Terminal Deleted', 'The terminal name (Haji Camp) updated by Super Admin', '2019-01-12 16:07:20'),
(79, 1, 'Terminal Added', 'The terminal name (Haji Camp) added by Super Admin', '2019-01-12 16:10:00'),
(80, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-12 16:12:51'),
(81, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-12 16:13:04'),
(82, 4, 'Admin Logout', 'The user Abid Khan logged out', '2019-01-12 16:18:01'),
(83, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-12 16:18:30'),
(84, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-13 09:52:31'),
(85, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-13 10:19:50'),
(86, 4, 'Admin Login', 'The user Abid Khan logged in', '2019-01-13 10:19:59'),
(87, 4, 'Bus Seat Assign', 'Seat number (Seat 1) assigned to bus number () by Admin', '2019-01-13 10:48:52'),
(88, 4, 'Bus Seat Assign', 'Seat number (Seat 2) assigned to bus number (pew 1234) by Admin', '2019-01-13 10:51:41'),
(89, 4, 'Bus Assigned Seat Updated', 'Assigned Seat number (Seat 2) to bus number (pew 1234) updated by Admin', '2019-01-13 11:17:31'),
(90, 4, 'Bus Assigned Seat Updated', 'Assigned Seat number (Seat 1) to bus number (pew 1234) updated by Admin', '2019-01-13 11:18:19'),
(91, 4, 'Bus Assigned Seat Updated', 'Assigned Seat number (Seat 3) to bus number (pew 1234) updated by Admin', '2019-01-13 11:36:46'),
(92, 4, 'Bus Assigned Seat Updated', 'Assigned Seat number (Seat 2) to bus number (pew 1234) updated by Admin', '2019-01-13 11:37:07'),
(93, 4, 'Bus Seat Assign', 'Seat number (Seat 3) assigned to bus number (pew 1234) by Admin', '2019-01-13 11:43:55'),
(94, 4, 'Bus Assign Seat Deleted', 'Seat number (Seat 3) assigned to bus number (pew 1234) by Admin', '2019-01-13 11:57:58'),
(95, 4, 'Bus Assign Seat Deleted', 'Assigned seat number (Seat 2) to bus number (pew 1234) deleted by Admin', '2019-01-13 11:59:02'),
(96, 4, 'Admin Logout', 'The user Abid Khan logged out', '2019-01-13 14:37:34'),
(97, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-13 14:37:50'),
(98, 1, 'User Added', 'Saif Afridi added a user with the role of Admin', '2019-01-13 15:03:47'),
(99, 1, 'New City Added', 'Super Admin added a new city (Peshawar)', '2019-01-13 15:08:39'),
(100, 1, 'City Deleted', 'Super Admin deleted the city (Peshawar)', '2019-01-13 15:08:47'),
(101, 1, 'New City Added', 'Super Admin added a new city (Karachi)', '2019-01-13 15:21:10'),
(102, 1, 'Payment Type Added', 'Payment Type (CREDIT CARD) stored by Super Admin', '2019-01-13 15:27:59'),
(103, 1, 'Payment Type Deleted', 'Payment type (CREDIT CARD) deleted by Super Admin', '2019-01-13 15:28:04'),
(104, 1, 'Payment Type Added', 'Payment Type (DEBIT CARD) stored by Super Admin', '2019-01-13 15:34:41'),
(105, 1, 'Payment Type Updated', 'Payment type (DEBIT CARD) updated by Super Admin', '2019-01-13 15:35:12'),
(106, 1, 'Seat Number Added', 'Seat number (Seat 1) added by Super Admin', '2019-01-13 15:46:31'),
(107, 1, 'Seat Deleted', 'Seat number (Seat 1) deleted by Super Admin', '2019-01-13 15:46:43'),
(108, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-14 10:17:46'),
(109, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-14 10:50:33'),
(110, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-15 12:38:17'),
(111, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-16 10:42:32'),
(112, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-16 14:08:03'),
(113, 1, 'City Deleted', 'Super Admin deleted the city (Karachi)', '2019-01-16 14:08:59'),
(114, 1, 'City Deleted', 'Super Admin deleted the city (Islamabad)', '2019-01-16 14:09:18'),
(115, 1, 'New City Added', 'Super Admin added a new city (Kohat)', '2019-01-16 14:10:11'),
(116, 1, 'New City Added', 'Super Admin added a new city (Mardan)', '2019-01-16 14:10:26'),
(117, 1, 'New City Added', 'Super Admin added a new city (Charsada)', '2019-01-16 14:10:56'),
(118, 1, 'New City Added', 'Super Admin added a new city (Noshehra)', '2019-01-16 14:11:12'),
(119, 1, 'Terminal Deleted', 'The terminal name (Faiz Abad) updated by Super Admin', '2019-01-16 14:11:42'),
(120, 1, 'Terminal Deleted', 'The terminal name (Hayat Abad) updated by Super Admin', '2019-01-16 14:11:51'),
(121, 1, 'Terminal Updated', 'The terminal name (Kohat Adda) updated by Super Admin', '2019-01-16 14:12:05'),
(122, 1, 'Terminal Added', 'The terminal name (Azam Chock) added by Super Admin', '2019-01-16 14:12:45'),
(123, 1, 'Terminal Added', 'The terminal name (Sher Ghar) added by Super Admin', '2019-01-16 14:13:10'),
(124, 1, 'Terminal Added', 'The terminal name (Noshehra City) added by Super Admin', '2019-01-16 14:13:34'),
(125, 1, 'Terminal Added', 'The terminal name (Kohat Uni) added by Super Admin', '2019-01-16 14:14:44'),
(126, 1, 'Seat Number Added', 'Seat number (Seat 4) added by Super Admin', '2019-01-16 14:15:25'),
(127, 1, 'Seat Number Added', 'Seat number (Seat 6) added by Super Admin', '2019-01-16 14:15:42'),
(128, 1, 'Seat Number Added', 'Seat number (Seat 7) added by Super Admin', '2019-01-16 14:15:58'),
(129, 1, 'Seat Number Added', 'Seat number (Seat 8) added by Super Admin', '2019-01-16 14:16:14'),
(130, 1, 'Seat Number Added', 'Seat number (Seat 10) added by Super Admin', '2019-01-16 14:16:35'),
(131, 1, 'Bus Updated', 'Bilal Caoch bus number (Bus1) updated by Super Admin', '2019-01-16 14:20:06'),
(132, 1, 'Bus Updated', 'Bilal Caoch bus number (Bus 1) updated by Super Admin', '2019-01-16 14:20:18'),
(133, 1, 'Bus Updated', 'Bilal Caoch bus number (Bus 2) updated by Super Admin', '2019-01-16 14:20:34'),
(134, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 3) added by Super Admin', '2019-01-16 14:20:55'),
(135, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 4) added by Super Admin', '2019-01-16 14:21:21'),
(136, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 5) added by Super Admin', '2019-01-16 14:21:42'),
(137, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 6) added by Super Admin', '2019-01-16 14:21:59'),
(138, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 7) added by Super Admin', '2019-01-16 14:22:33'),
(139, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 8) added by Super Admin', '2019-01-16 14:22:53'),
(140, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 10) added by Super Admin', '2019-01-16 14:23:57'),
(141, 1, 'Bus Added', 'Bilal Caoch bus number (Bus 9) added by Super Admin', '2019-01-16 14:24:24'),
(142, 1, 'Bus Updated', 'Bilal Caoch bus number (Bus 11) updated by Super Admin', '2019-01-16 14:24:44'),
(143, 1, 'Bus Updated', 'Bilal Caoch bus number (Bus 10) updated by Super Admin', '2019-01-16 14:25:11'),
(144, 1, 'Bus Updated', 'Bilal Caoch bus number (Bus 9) updated by Super Admin', '2019-01-16 14:25:21'),
(145, 1, 'Bus Seat Assign', 'Seat number (Seat 2) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 14:32:55'),
(146, 1, 'Bus Seat Assign', 'Seat number (Seat 3) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 14:33:08'),
(147, 1, 'Bus Seat Assign', 'Seat number (Seat 4) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 14:33:19'),
(148, 1, 'Seat Number Added', 'Seat number (Seat 5) added by Super Admin', '2019-01-16 14:34:21'),
(149, 1, 'Seat Number Added', 'Seat number (Seat 9) added by Super Admin', '2019-01-16 14:34:42'),
(150, 1, 'Bus Seat Assign', 'Seat number (Seat 5) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 15:24:16'),
(151, 1, 'Bus Seat Assign', 'Seat number (Seat 6) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 15:24:34'),
(152, 1, 'Bus Seat Assign', 'Seat number (Seat 7) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 15:24:51'),
(153, 1, 'Bus Seat Assign', 'Seat number (Seat 8) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 15:25:11'),
(154, 1, 'Bus Seat Assign', 'Seat number (Seat 9) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 15:25:27'),
(155, 1, 'Bus Seat Assign', 'Seat number (Seat 10) assigned to bus number (Bus 1) by Super Admin', '2019-01-16 15:25:48'),
(156, 1, 'Bus Seat Assign', 'Seat number (Seat 1) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:28:41'),
(157, 1, 'Bus Seat Assign', 'Seat number (Seat 2) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:28:57'),
(158, 1, 'Bus Seat Assign', 'Seat number (Seat 3) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:29:14'),
(159, 1, 'Bus Seat Assign', 'Seat number (Seat 4) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:29:27'),
(160, 1, 'Bus Seat Assign', 'Seat number (Seat 5) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:29:54'),
(161, 1, 'Bus Seat Assign', 'Seat number (Seat 6) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:31:10'),
(162, 1, 'Bus Seat Assign', 'Seat number (Seat 7) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:31:33'),
(163, 1, 'Bus Seat Assign', 'Seat number (Seat 8) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:32:22'),
(164, 1, 'Bus Seat Assign', 'Seat number (Seat 9) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:33:04'),
(165, 1, 'Bus Seat Assign', 'Seat number (Seat 10) assigned to bus number (Bus 2) by Super Admin', '2019-01-16 15:33:24'),
(166, 1, 'Bus Seat Assign', 'Seat number (Seat 1) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:34:47'),
(167, 1, 'Bus Seat Assign', 'Seat number (Seat 2) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:35:19'),
(168, 1, 'Bus Seat Assign', 'Seat number (Seat 3) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:35:51'),
(169, 1, 'Bus Seat Assign', 'Seat number (Seat 4) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:36:39'),
(170, 1, 'Bus Seat Assign', 'Seat number (Seat 5) assigned to bus number (Bus 4) by Super Admin', '2019-01-16 15:36:55'),
(171, 1, 'Bus Seat Assign', 'Seat number (Seat 5) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:37:17'),
(172, 1, 'Bus Seat Assign', 'Seat number (Seat 6) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:37:37'),
(173, 1, 'Bus Seat Assign', 'Seat number (Seat 7) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:37:53'),
(174, 1, 'Bus Seat Assign', 'Seat number (Seat 8) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:38:35'),
(175, 1, 'Bus Seat Assign', 'Seat number (Seat 9) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:38:49'),
(176, 1, 'Bus Seat Assign', 'Seat number (Seat 10) assigned to bus number (Bus 3) by Super Admin', '2019-01-16 15:39:07'),
(177, 1, 'Bus Assign Seat Deleted', 'Assigned seat number (Seat 5) to bus number (Bus 4) deleted by Super Admin', '2019-01-16 15:40:00'),
(178, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-16 18:44:04'),
(179, 0, 'User Added', 'Sajid Khan is registered as a customer. The user name is sajid', '2019-01-16 19:31:59'),
(180, 1, 'Customer Self Registration', 'Nazeer Khan is registered as a customer. The user name is nazeer', '2019-01-16 19:35:49'),
(181, 8, 'Customer Self Registration', 'Sohail Khan is registered as a customer. The user name is sohail', '2019-01-16 19:37:54'),
(182, 6, 'Customer Profile Updation', 'Sajid Khan update his /  her profile . The user name is sajid', '2019-01-17 09:39:19'),
(183, 6, 'Customer Profile Updation', 'M Sajid Khan update his /  her profile . The user name is sajid', '2019-01-17 09:40:16'),
(184, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-17 10:41:01'),
(185, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-17 10:41:37'),
(186, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-17 10:48:12'),
(187, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-17 10:53:26'),
(188, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-17 11:10:41'),
(189, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-17 12:06:49'),
(190, 1, 'Super Admin Logout', 'The user Saif Afridi logged out', '2019-01-17 12:06:54'),
(191, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-17 12:37:11'),
(192, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-17 18:58:58'),
(193, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-17 18:59:33'),
(194, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-18 07:21:52'),
(195, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-18 14:58:00'),
(196, 1, 'Terminal Updated', 'The terminal name (Mattani) updated by Super Admin', '2019-01-18 14:59:07'),
(197, 1, 'Terminal Updated', 'The terminal name (Dara Adam Khel) updated by Super Admin', '2019-01-18 14:59:33'),
(198, 1, 'Terminal Added', 'The terminal name (Pabbi) added by Super Admin', '2019-01-18 15:00:42'),
(199, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-18 15:03:08'),
(200, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-19 12:35:01'),
(201, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-19 12:35:22'),
(202, 1, 'Super Admin Login', 'The user Saif Afridi logged in', '2019-01-20 16:35:38'),
(203, 1, 'Super Admin Login', 'The user muneeb1 muneeb2 logged in', '2019-01-22 10:00:02'),
(204, 1, 'Super Admin Login', 'The user muneeb1 muneeb2 logged in', '2019-01-22 15:38:30'),
(205, 1, 'User Profile Updated', 'Saif Afridi updated the user profile of Super Admin(muneeb1 muneeb2)', '2019-01-23 11:16:58'),
(206, 1, 'User Profile Updated', 'Saif Afridi updated the user profile of Super Admin(Cyber Clouds)', '2019-01-23 11:19:10'),
(207, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-23 11:20:00'),
(208, 1, 'User Added', 'Cyber Clouds added a user with the role of Admin', '2019-01-23 15:57:44'),
(209, 1, 'User Profile Updated', 'Cyber Clouds updated the user profile of Admin(Clouts Admin)', '2019-01-23 16:00:03'),
(210, 1, 'User Profile Updated', 'Cyber Clouds updated the user profile of Admin(Clouts Admin)', '2019-01-23 16:02:20'),
(211, 1, 'User Profile Updated', 'Cyber Clouds updated the user profile of Super Admin(Cyber Clouds)', '2019-01-23 16:35:22'),
(212, 1, 'Terminal Added', 'The terminal name (Kohat Adda) added by Super Admin', '2019-01-23 17:42:03'),
(213, 1, 'Terminal Added', 'The terminal name (Haji Camp) added by Super Admin', '2019-01-23 17:42:25'),
(214, 1, 'Terminal Added', 'The terminal name (Kohat Uni) added by Super Admin', '2019-01-23 17:42:54'),
(215, 1, 'Terminal Added', 'The terminal name (Dara) added by Super Admin', '2019-01-23 17:43:38'),
(216, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-24 09:34:26'),
(217, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 5) to the route from Peshawar to Kohat (12:00 PM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-24 20:57:16'),
(218, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-25 04:39:31'),
(219, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 5) to the route from Kohat to Peshawar (12:00 PM to 01:00 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 04:40:42'),
(220, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-25 09:43:24'),
(221, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Kohat to Peshawar (12:00 PM to 01:15 AM), the departure terminal is Kohat Uni and arrival terminal is Kohat Adda', '2019-01-25 09:48:37'),
(222, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 PM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 09:56:17'),
(223, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:15 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 10:24:56'),
(224, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Peshawar to Kohat (12:30 AM to 01:30 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 11:34:46'),
(225, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:30 AM to 01:30 AM), the departure terminal is Kohat Adda and arrival terminal is Dara', '2019-01-25 12:14:21'),
(226, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 13:45:32'),
(227, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 13:50:18'),
(228, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 13:54:59'),
(229, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Kohat to Peshawar (12:00 AM to 01:15 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 13:56:28'),
(230, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Kohat to Peshawar (12:00 AM to 01:15 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 13:57:18'),
(231, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 13:58:51'),
(232, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 14:01:42'),
(233, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 14:22:59'),
(234, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 14:24:12'),
(235, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 14:37:31'),
(236, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 14:40:29'),
(237, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 15:55:06'),
(238, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Peshawar to Kohat (12:30 AM to 01:45 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 16:04:48'),
(239, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 4) to the route from Peshawar to Kohat (12:45 AM to 02:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 16:10:29'),
(240, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 6) to the route from Peshawar to Kohat (01:00 AM to 02:30 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 16:19:17'),
(241, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 7) to the route from Peshawar to Kohat (06:00 AM to 08:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 16:23:24'),
(242, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 8) to the route from Kohat to Peshawar (12:15 AM to 01:00 AM), the departure terminal is Kohat Uni and arrival terminal is Kohat Adda', '2019-01-25 16:37:24'),
(243, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 9) to the route from Kohat to Peshawar (12:45 AM to 01:15 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 16:40:18'),
(244, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 6) to the route from Peshawar to Peshawar (12:30 AM to 12:45 AM), the departure terminal is Kohat Adda and arrival terminal is Haji Camp', '2019-01-25 16:42:54'),
(245, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 16:47:50'),
(246, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Peshawar to Kohat (12:15 AM to 01:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 16:49:54'),
(247, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 4) to the route from Kohat to Peshawar (12:45 AM to 01:15 AM), the departure terminal is Dara and arrival terminal is Haji Camp', '2019-01-25 16:54:03'),
(248, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 10) to the route from Kohat to Peshawar (07:30 AM to 08:45 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 17:22:36'),
(249, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 7) to the route from Peshawar to Kohat (01:45 AM to 03:15 AM), the departure terminal is Kohat Adda and arrival terminal is Dara', '2019-01-25 17:28:46'),
(250, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Kohat to Peshawar (12:00 AM to 01:00 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 17:42:29'),
(251, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 17:46:15'),
(252, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 6) to the route from Kohat to Peshawar (12:45 AM to 01:15 AM), the departure terminal is Kohat Uni and arrival terminal is Kohat Adda', '2019-01-25 17:52:57'),
(253, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 7) to the route from Kohat to Peshawar (09:15 AM to 01:00 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 17:57:19'),
(254, 1, 'Route Updated', 'Cyber Clouds assigned the bus (Bus 8) to the route from Kohat to Peshawar (09:15 AM to 01:00 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 17:57:31'),
(255, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 7) to the route from Peshawar to Kohat (09:45 AM to 12:30 AM), the departure terminal is Kohat Adda and arrival terminal is Dara', '2019-01-25 17:59:54'),
(256, 1, 'Route Updated', 'Cyber Clouds assigned the bus (Bus 7) to the route from Peshawar to Kohat (12:00 AM to 01:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 18:01:24'),
(257, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Peshawar to Kohat (12:00 AM to 12:30 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 18:12:05'),
(258, 1, 'Route Updated', 'Cyber Clouds updated the route information. The bus (Bus 1) is assigned to the route from Peshawar to Kohat (12:15 AM to 12:45 AM), the departure terminal is Kohat Adda and arrival terminal is Dara', '2019-01-25 18:13:24'),
(259, 1, 'Route Updated', 'Cyber Clouds updated the route information. The bus (Bus 1) is assigned to the route from Kohat to Peshawar (12:00 AM to 01:00 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 18:14:49'),
(260, 1, 'Route Updated', 'Cyber Clouds updated the route information. The bus (Bus 1) is assigned to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 18:24:58'),
(261, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 18:50:39'),
(262, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Kohat to Peshawar (12:30 AM to 12:45 AM), the departure terminal is Dara and arrival terminal is Haji Camp', '2019-01-25 19:00:47'),
(263, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 7) to the route from Peshawar to Kohat (01:00 AM to 02:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 19:24:59'),
(264, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 10) to the route from Kohat to Peshawar (02:15 AM to 03:45 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 19:35:11'),
(265, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 19:37:31'),
(266, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 6) to the route from Peshawar to Kohat (12:30 AM to 01:45 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 19:52:20'),
(267, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 19:54:11'),
(268, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 19:56:58'),
(269, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 4) to the route from Kohat to Peshawar (01:00 AM to 02:30 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-25 20:00:09'),
(270, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-25 20:08:54'),
(271, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-26 09:47:39'),
(272, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 09:49:27'),
(273, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Peshawar to Kohat (12:15 AM to 01:30 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 10:05:07'),
(274, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 10:50:00'),
(275, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 11:05:39'),
(276, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 4) to the route from Peshawar to Kohat (12:45 AM to 01:00 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 11:39:35'),
(277, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 9) to the route from Kohat to Peshawar (12:00 AM to 02:00 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-26 11:46:53'),
(278, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 12:08:47'),
(279, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 13:36:42'),
(280, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 13:38:59'),
(281, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Kohat to Peshawar (12:15 AM to 01:30 AM), the departure terminal is Kohat Uni and arrival terminal is Haji Camp', '2019-01-26 13:55:24'),
(282, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 13:57:36'),
(283, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:02:54'),
(284, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:03:56'),
(285, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:05:44'),
(286, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:08:01'),
(287, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:10:27'),
(288, 1, 'Route Updated', 'Cyber Clouds updated the route information. The bus (Bus 1) is assigned to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:12:11'),
(289, 1, 'Route Updated', 'Cyber Clouds updated the route information. The bus (Bus 1) is assigned to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:12:30'),
(290, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:19:56'),
(291, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:40:10'),
(292, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:46:19'),
(293, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:49:58'),
(294, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:55:06'),
(295, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 14:57:07'),
(296, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 15:23:22'),
(297, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 15:25:24'),
(298, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 15:39:04'),
(299, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 15:42:37'),
(300, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 15:54:42'),
(301, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-26 16:21:40'),
(302, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 16:38:57'),
(303, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Peshawar to Kohat (12:00 AM to 01:15 AM), the departure terminal is Haji Camp and arrival terminal is Kohat Uni', '2019-01-26 17:05:46'),
(304, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Haji Camp and arrival terminal is Kohat Adda. The departure Tims is(12:00 AM and arrival time is 12:15 AM)', '2019-01-26 17:28:59'),
(305, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Haji Camp and arrival terminal is Dara. The departure Tims is(12:00 AM and arrival time is 12:45 AM)', '2019-01-26 17:28:59'),
(306, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Haji Camp and arrival terminal is Kohat Uni. The departure Tims is(12:00 AM and arrival time is 01:15 AM)', '2019-01-26 17:28:59'),
(307, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Kohat Adda and arrival terminal is Dara. The departure Tims is(12:30 AM and arrival time is 12:45 AM)', '2019-01-26 17:28:59'),
(308, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Kohat Adda and arrival terminal is Kohat Uni. The departure Tims is(12:30 AM and arrival time is 01:15 AM)', '2019-01-26 17:28:59'),
(309, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Dara and arrival terminal is Kohat Uni. The departure Tims is(01:00 AM and arrival time is 01:15 AM)', '2019-01-26 17:28:59'),
(310, 1, 'City Updated', 'Super Admin updated the city (Maimi)', '2019-01-26 17:59:41'),
(311, 1, 'City Updated', 'Super Admin updated the city (Orlando)', '2019-01-26 18:00:20'),
(312, 1, 'City Updated', 'Super Admin updated the city (Sunrise)', '2019-01-26 18:02:25'),
(313, 1, 'Terminal Updated', 'The terminal name (Holloywood) updated by Super Admin', '2019-01-26 18:03:04'),
(314, 1, 'Terminal Updated', 'The terminal name (Holloywood) updated by Super Admin', '2019-01-26 18:04:37'),
(315, 1, 'Terminal Updated', 'The terminal name (Maimi North) updated by Super Admin', '2019-01-26 18:08:05'),
(316, 1, 'City Updated', 'Super Admin updated the city (Maimi North)', '2019-01-26 18:15:01'),
(317, 1, 'City Updated', 'Super Admin updated the city (West Palm Beach)', '2019-01-26 18:15:26'),
(318, 1, 'City Updated', 'Super Admin updated the city (Ft Pierce)', '2019-01-26 18:15:57'),
(319, 1, 'New City Added', 'Super Admin added a new city (Kissimmee)', '2019-01-26 18:16:23'),
(320, 1, 'Terminal Updated', 'The terminal name (3801 N W 21st Street) updated by Super Admin', '2019-01-26 18:17:48'),
(321, 1, 'Terminal Added', 'The terminal name (15821 Nw 7th st) added by Super Admin', '2019-01-26 18:20:03'),
(322, 1, 'Terminal Added', 'The terminal name (205 S Tamarind Ave) added by Super Admin', '2019-01-26 18:22:30'),
(323, 1, 'Terminal Added', 'The terminal name (7150 Okeechobee Rd) added by Super Admin', '2019-01-26 18:24:49'),
(324, 1, 'Terminal Added', 'The terminal name (103 E Dakin Ave) added by Super Admin', '2019-01-26 18:25:31'),
(325, 1, 'Terminal Updated', 'The terminal name (555 N John Young Pkwy) updated by Super Admin', '2019-01-26 18:26:39'),
(326, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Maimi to Orlando (05:00 AM to 10:45 AM), the departure terminal is 3801 N W 21st Street and arrival terminal is 555 N John Young Pkwy', '2019-01-26 18:28:37'),
(327, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 3801 N W 21st Street and arrival terminal is 15821 Nw 7th st. The departure Time is(05:00 AM and arrival time is 05:15 AM).', '2019-01-26 18:42:48'),
(328, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 3801 N W 21st Street and arrival terminal is 205 S Tamarind Ave. The departure Time is(05:00 AM and arrival time is 06:45 AM).', '2019-01-26 18:42:48'),
(329, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 3801 N W 21st Street and arrival terminal is 7150 Okeechobee Rd. The departure Time is(05:00 AM and arrival time is 08:00 AM).', '2019-01-26 18:42:48'),
(330, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 3801 N W 21st Street and arrival terminal is 103 E Dakin Ave. The departure Time is(05:00 AM and arrival time is 10:00 AM).', '2019-01-26 18:42:48'),
(331, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 3801 N W 21st Street and arrival terminal is 555 N John Young Pkwy. The departure Time is(05:00 AM and arrival time is 10:45 AM).', '2019-01-26 18:42:48'),
(332, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is 205 S Tamarind Ave. The departure Time is(05:15 AM and arrival time is 06:45 AM).', '2019-01-26 18:42:48'),
(333, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is 7150 Okeechobee Rd. The departure Time is(05:15 AM and arrival time is 08:00 AM).', '2019-01-26 18:42:48'),
(334, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is 103 E Dakin Ave. The departure Time is(05:15 AM and arrival time is 10:00 AM).', '2019-01-26 18:42:48'),
(335, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is 555 N John Young Pkwy. The departure Time is(05:15 AM and arrival time is 10:45 AM).', '2019-01-26 18:42:48'),
(336, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 205 S Tamarind Ave and arrival terminal is 7150 Okeechobee Rd. The departure Time is(07:00 AM and arrival time is 08:00 AM).', '2019-01-26 18:42:48'),
(337, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 205 S Tamarind Ave and arrival terminal is 103 E Dakin Ave. The departure Time is(07:00 AM and arrival time is 10:00 AM).', '2019-01-26 18:42:48'),
(338, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 205 S Tamarind Ave and arrival terminal is 555 N John Young Pkwy. The departure Time is(07:00 AM and arrival time is 10:45 AM).', '2019-01-26 18:42:48'),
(339, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 7150 Okeechobee Rd and arrival terminal is 103 E Dakin Ave. The departure Time is(08:15 AM and arrival time is 10:00 AM).', '2019-01-26 18:42:48'),
(340, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 7150 Okeechobee Rd and arrival terminal is 555 N John Young Pkwy. The departure Time is(08:15 AM and arrival time is 10:45 AM).', '2019-01-26 18:42:48'),
(341, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 103 E Dakin Ave and arrival terminal is 555 N John Young Pkwy. The departure Time is(10:00 AM and arrival time is 10:45 AM).', '2019-01-26 18:42:48'),
(342, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 09:37:13'),
(343, 1, 'New City Added', 'Super Admin added a new city (Sunrise)', '2019-01-27 09:37:46'),
(344, 1, 'Terminal Added', 'The terminal name (my terminal) added by Super Admin', '2019-01-27 10:09:59'),
(345, 1, 'Terminal Updated', 'The terminal name (testing terminal 1) updated by Super Admin', '2019-01-27 10:11:24'),
(346, 1, 'Terminal Updated', 'The terminal name (my terminal1) updated by Super Admin', '2019-01-27 10:11:55'),
(347, 1, 'City Deleted', 'Super Admin deleted the city (Sunrise)', '2019-01-27 10:12:49'),
(348, 1, 'Terminal Deleted', 'The terminal name (testing terminal 1) updated by Super Admin', '2019-01-27 10:13:20'),
(349, 1, 'Terminal Deleted', 'The terminal name (my terminal1) updated by Super Admin', '2019-01-27 10:16:16'),
(350, 1, 'Terminal Added', 'The terminal name (test) added by Super Admin', '2019-01-27 10:17:12'),
(351, 1, 'Terminal Updated', 'The terminal name (test 1) updated by Super Admin', '2019-01-27 10:23:19'),
(352, 1, 'Terminal Updated', 'The terminal name (test 1 2) updated by Super Admin', '2019-01-27 10:24:25'),
(353, 1, 'Terminal Deleted', 'The terminal name (test 1 2) updated by Super Admin', '2019-01-27 10:24:36'),
(354, 1, 'Terminal Added', 'The terminal name (tesing) added by Super Admin', '2019-01-27 10:24:53'),
(355, 1, 'Terminal Deleted', 'The terminal name (tesing) updated by Super Admin', '2019-01-27 10:25:01'),
(356, 1, 'Module Added', 'Users bus number (http://localhost/bus/bustickets/users) added by Super Admin', '2019-01-27 10:45:56'),
(357, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 10:46:48'),
(358, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 10:47:02'),
(359, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 10:49:12'),
(360, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 10:49:21'),
(361, 1, 'Module Added', 'Permission List bus number (http://localhost/bus/bustickets/rights/index) added by Super Admin', '2019-01-27 10:57:19'),
(362, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 10:58:00'),
(363, 1, 'Module Added', 'user list bus number (http://localhost/bus/bustickets/users/user_list) added by Super Admin', '2019-01-27 11:03:05'),
(364, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 11:03:44');
INSERT INTO `logs` (`id`, `user_id`, `activity`, `note`, `modified`) VALUES
(365, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 11:05:00'),
(366, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 11:05:11'),
(367, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 11:05:37'),
(368, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 11:12:51'),
(369, 1, 'Module Added', 'Cities List bus number (http://localhost/bus/bustickets/Cities/index) added by Super Admin', '2019-01-27 11:15:05'),
(370, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 11:17:42'),
(371, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 12:03:41'),
(372, 2, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 12:05:15'),
(373, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 12:05:56'),
(374, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 12:22:42'),
(375, 1, 'Module Added', 'Permission List bus number (http://localhost/bus/bustickets/rights/index) added by Super Admin', '2019-01-27 12:33:24'),
(376, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 12:33:51'),
(377, 1, 'Module Added', 'Users List bus number (http://localhost/bus/users/userslist) added by Super Admin', '2019-01-27 12:36:50'),
(378, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 12:37:09'),
(379, 1, 'Module Added', 'Add User bus number (http://localhost/bus/users/addadmin) added by Super Admin', '2019-01-27 12:39:01'),
(380, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 12:39:24'),
(381, 1, 'Module Added', 'Admin Profile bus number (http://localhost/bus/bustickets/users/personalProfile) added by Super Admin', '2019-01-27 12:51:19'),
(382, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 12:51:49'),
(383, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 12:52:40'),
(384, 2, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 12:52:51'),
(385, 2, 'Admin Logout', 'The user Clouds Admin logged out', '2019-01-27 12:53:17'),
(386, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 12:53:27'),
(387, 1, 'Module Added', 'View bus number (http://localhost/bus/bustickets/users/viewprofile) added by Super Admin', '2019-01-27 12:56:00'),
(388, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 12:56:22'),
(389, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 12:57:14'),
(390, 2, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 12:57:25'),
(391, 2, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 12:57:58'),
(392, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 12:59:11'),
(393, 1, 'Module Added', 'Edit User bus number (http://localhost/bus/bustickets/users/edituser) added by Super Admin', '2019-01-27 13:01:13'),
(394, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 13:01:35'),
(395, 1, 'Module Added', 'Delete User bus number (http://localhost/bus/users/delete) added by Super Admin', '2019-01-27 13:13:17'),
(396, 1, 'Permission Added', 'Permission stored by Super Admin', '2019-01-27 13:13:38'),
(397, 1, 'Module Added', 'Super Admin updated the module (Add Permission 12) with the link (http://localhost/bus/bustickets/rights/add).', '2019-01-27 13:43:11'),
(398, 1, 'Module Updated', 'Super Admin updated the module (Add Permission) with the link (http://localhost/bus/bustickets/rights/add).', '2019-01-27 13:43:49'),
(399, 1, 'Module Added', 'Super Admin added the module (abc) with the link (http://localhost/bus/bustickets/rights/index).', '2019-01-27 13:53:56'),
(400, 1, 'Module Deleted', 'Cyber Clouds delete the module (abc).', '2019-01-27 13:54:04'),
(401, 1, 'Module Added', 'Super Admin added the module (modulendnd) with the link (http://localhost/bus/bustickets/rights/index).', '2019-01-27 13:55:42'),
(402, 1, 'Module Deleted', 'Cyber Clouds delete the module (modulendnd).', '2019-01-27 14:14:23'),
(403, 1, 'Module Added', 'Super Admin added the module (Add City) with the link (http://localhost/bus/bustickets/cities/add).', '2019-01-27 14:17:21'),
(404, 1, 'Permission Added', 'Super Admin assigned the module (Add City) Permission to cyber', '2019-01-27 14:38:09'),
(405, 1, 'Permission Added', 'Super Admin assigned the module (Add City) Permission to user (cyber).', '2019-01-27 14:42:06'),
(406, 1, 'Module Added', 'Super Admin added the module (Edit Permission) with the link (http://localhost/bus/bustickets/rights/edit).', '2019-01-27 14:54:16'),
(407, 1, 'Module Added', 'Super Admin added the module (Edit Permission) with the link (http://localhost/bus/bustickets/rights/edit).', '2019-01-27 14:54:16'),
(408, 1, 'Permission Assigned', 'Super Admin assigned the module (Edit Permission) Permission to user (cyber).', '2019-01-27 14:54:48'),
(409, 1, 'Permission Updated', 'Super Admin change the Permission from (Edit Permission to Edit Permission). The old user was cyber and new user is cyber', '2019-01-27 15:04:43'),
(410, 1, 'Permission Updated', 'Super Admin change the Permission from (Add User to Add User). The old user was cyber and new user is cyber', '2019-01-27 15:12:44'),
(411, 1, 'Module Added', 'Super Admin added the module (Delete Permission) with the link (http://localhost/bus/bustickets/rights/delete).', '2019-01-27 15:46:48'),
(412, 1, 'Permission Assigned', 'Super Admin assigned the module (Delete Permission) Permission to user (cyber).', '2019-01-27 15:47:13'),
(413, 1, 'Module Added', 'Super Admin added the module (delelrf) with the link (fjkasd).', '2019-01-27 15:52:13'),
(414, 1, 'Module Deleted', 'Cyber Clouds delete the module (delelrf).', '2019-01-27 15:52:43'),
(415, 1, 'Permission Assigned', 'Super Admin assigned the module (Add Permission) Permission to user (clouds).', '2019-01-27 15:53:09'),
(416, 1, 'Permission Deleted', 'Add Permission Permission deleted by Super Admin, which was assinged to clouds', '2019-01-27 15:53:25'),
(417, 1, 'User Deleted', 'Cyber Clouds delete the Admin(Clouds  Admin)', '2019-01-27 16:00:23'),
(418, 1, 'User Added', 'Cyber Clouds added a user with the role of Admin', '2019-01-27 16:04:18'),
(419, 1, 'Module Deleted', 'Cyber Clouds delete the module (Edit Permission).', '2019-01-27 16:12:08'),
(420, 1, 'Module Added', 'Super Admin added the module (Admin Profile) with the link (http://localhost/bus/bustickets/users/personalProfile).', '2019-01-27 16:15:47'),
(421, 1, 'Permission Assigned', 'Super Admin assigned the module (Admin Profile) Permission to user (cloud).', '2019-01-27 16:17:00'),
(422, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 16:17:18'),
(423, 3, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 16:17:27'),
(424, 3, 'Admin Logout', 'The user Clouds Admin logged out', '2019-01-27 16:22:09'),
(425, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 16:22:20'),
(426, 1, 'Permission Assigned', 'Super Admin assigned the module (Users List) Permission to user (cloud).', '2019-01-27 16:22:44'),
(427, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 16:22:54'),
(428, 3, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 16:23:03'),
(429, 3, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 16:25:01'),
(430, 3, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-27 16:25:57'),
(431, 3, 'Admin Logout', 'The user Clouds Admin logged out', '2019-01-27 16:41:56'),
(432, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 16:42:12'),
(433, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-27 16:53:02'),
(434, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-27 16:53:12'),
(435, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-28 09:13:58'),
(436, 1, 'Role Added With Permissions', 'Super Admin added the Role (sbv) and (Read) access has been given of (USERS).', '2019-01-28 09:34:58'),
(437, 1, 'Role Added With Permissions', 'Super Admin added the Role (sbv) and (Write) access has been given of (CITIES).', '2019-01-28 09:34:58'),
(438, 1, 'Bus Deleted', 'D bus number (SD) deleted by Super Admin', '2019-01-28 12:19:10'),
(439, 1, 'New City Added', 'Super Admin added a new city (Atlanta)', '2019-01-28 12:29:02'),
(440, 1, 'New City Added', 'Super Admin added a new city (Charlote)', '2019-01-28 12:29:17'),
(441, 1, 'New City Added', 'Super Admin added a new city (Mebani Exit 15)', '2019-01-28 12:29:36'),
(442, 1, 'New City Added', 'Super Admin added a new city (Richmond)', '2019-01-28 12:29:51'),
(443, 1, 'New City Added', 'Super Admin added a new city (Delware House MM5)', '2019-01-28 12:30:10'),
(444, 1, 'Terminal Added', 'The terminal name (232 Forsyth St, GA 30303) added by Super Admin', '2019-01-28 12:32:00'),
(445, 1, 'Terminal Added', 'The terminal name (601 W Trade st  NC28202) added by Super Admin', '2019-01-28 12:32:25'),
(446, 1, 'Terminal Added', 'The terminal name (Exit 152 NC 27302) added by Super Admin', '2019-01-28 12:32:48'),
(447, 1, 'Terminal Added', 'The terminal name (2910 N Blvd VA 2323) added by Super Admin', '2019-01-28 12:33:10'),
(448, 1, 'Terminal Added', 'The terminal name (530 John F Kennady) added by Super Admin', '2019-01-28 12:33:35'),
(449, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Atlanta to Delware House MM5 (10:50 PM to 02:15 PM), the departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 530 John F Kennady', '2019-01-28 12:38:03'),
(450, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 601 W Trade st  NC28202. The departure Time is(10:50 PM and arrival time is 03:00 AM).', '2019-01-28 12:41:46'),
(451, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is Exit 152 NC 27302. The departure Time is(10:50 PM and arrival time is 06:00 AM).', '2019-01-28 12:41:46'),
(452, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 2910 N Blvd VA 2323. The departure Time is(10:50 PM and arrival time is 09:30 AM).', '2019-01-28 12:41:46'),
(453, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 530 John F Kennady. The departure Time is(10:50 PM and arrival time is 02:15 PM).', '2019-01-28 12:41:46'),
(454, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is Exit 152 NC 27302. The departure Time is(04:00 AM and arrival time is 06:00 AM).', '2019-01-28 12:41:46'),
(455, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is 2910 N Blvd VA 2323. The departure Time is(04:00 AM and arrival time is 09:30 AM).', '2019-01-28 12:41:46'),
(456, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is 530 John F Kennady. The departure Time is(04:00 AM and arrival time is 02:15 PM).', '2019-01-28 12:41:46'),
(457, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Exit 152 NC 27302 and arrival terminal is 2910 N Blvd VA 2323. The departure Time is(06:15 AM and arrival time is 09:30 AM).', '2019-01-28 12:41:46'),
(458, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Exit 152 NC 27302 and arrival terminal is 530 John F Kennady. The departure Time is(06:15 AM and arrival time is 02:15 PM).', '2019-01-28 12:41:46'),
(459, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 2910 N Blvd VA 2323 and arrival terminal is 530 John F Kennady. The departure Time is(10:30 AM and arrival time is 02:15 PM).', '2019-01-28 12:41:46'),
(460, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Atlanta to Mebani Exit 15 (10:00 PM to 06:00 AM), the departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is Exit 152 NC 27302', '2019-01-28 13:29:09'),
(461, 1, 'Bus Added', 'Bilal Caoch bus number (us 1234) added by Super Admin', '2019-01-28 14:22:21'),
(462, 1, 'Bus Updated', 'Bilal Caoch bus number (us 1234) updated by Super Admin', '2019-01-28 14:40:54'),
(463, 1, 'Bus Deleted', 'Bilal Caoch bus number (Bus 10) deleted by Super Admin', '2019-01-28 14:43:57'),
(464, 1, 'Bus Updated', 'Bilal Caoch bus number (us 1234) updated by Super Admin', '2019-01-28 15:56:52'),
(465, 1, 'Role Added With Permissions', 'Super Admin added the Role (SUBADMIN) and (Read) access has been given of (USERS).', '2019-01-28 16:38:51'),
(466, 1, 'Role Added With Permissions', 'Super Admin added the Role (SUBADMIN) and (Write) access has been given of (CITIES).', '2019-01-28 16:38:51'),
(467, 1, 'Role Added With Permissions', 'Super Admin added the Role (SUBADMIN) and (Write) access has been given of (BUSES).', '2019-01-28 16:38:51'),
(468, 1, 'Role Added With Permissions', 'Super Admin added the Role (SUBADMIN) and (Read) access has been given of (ROUTES).', '2019-01-28 16:38:51'),
(469, 1, 'Role Added With Permissions', 'Super Admin added the Role (SUBADMIN) and (Write) access has been given of (TOURS).', '2019-01-28 16:38:51'),
(470, 1, 'Role Added With Permissions', 'Super Admin added the Role (SUBADMIN) and (Write) access has been given of (SIGHTSEEINGS).', '2019-01-28 16:38:51'),
(471, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 2) to the route from Atlanta to Ft Pierce (12:00 AM to 02:35 AM), the departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 7150 Okeechobee Rd', '2019-01-28 17:21:50'),
(472, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 601 W Trade st  NC28202. The departure Time is(12:00 AM and arrival time is 12:20 AM).', '2019-01-28 17:33:28'),
(473, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 530 John F Kennady. The departure Time is(12:00 AM and arrival time is 01:20 AM).', '2019-01-28 17:33:28'),
(474, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 7150 Okeechobee Rd. The departure Time is(12:00 AM and arrival time is 02:35 AM).', '2019-01-28 17:33:28'),
(475, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is 530 John F Kennady. The departure Time is(12:25 AM and arrival time is 01:20 AM).', '2019-01-28 17:33:28'),
(476, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is 7150 Okeechobee Rd. The departure Time is(12:25 AM and arrival time is 02:35 AM).', '2019-01-28 17:33:28'),
(477, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 530 John F Kennady and arrival terminal is 7150 Okeechobee Rd. The departure Time is(01:30 AM and arrival time is 02:35 AM).', '2019-01-28 17:33:28'),
(478, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 7) to the route from Kissimmee to Maimi North (12:00 AM to 12:20 AM), the departure terminal is 103 E Dakin Ave and arrival terminal is 15821 Nw 7th st', '2019-01-28 17:36:21'),
(479, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 5) to the route from Atlanta to Delware House MM5 (12:00 AM to 02:10 AM), the departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 530 John F Kennady', '2019-01-28 17:38:51'),
(480, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 1) to the route from Charlote to Ft Pierce (12:00 AM to 01:45 AM), the departure terminal is 601 W Trade st  NC28202 and arrival terminal is 7150 Okeechobee Rd', '2019-01-28 17:47:08'),
(481, 1, 'Route Added', 'Cyber Clouds assigned the bus (Bus 6) to the route from Maimi North to Orlando (12:00 AM to 01:50 AM), the departure terminal is 15821 Nw 7th st and arrival terminal is 555 N John Young Pkwy', '2019-01-28 17:48:06'),
(482, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is Exit 152 NC 27302. The departure Time is(12:00 AM and arrival time is 12:15 AM).', '2019-01-28 17:54:42'),
(483, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is 555 N John Young Pkwy. The departure Time is(12:00 AM and arrival time is 01:50 AM).', '2019-01-28 17:54:42'),
(484, 1, 'Route Terminals Added', 'Cyber Clouds added the route terminals. The departure terminal is Exit 152 NC 27302 and arrival terminal is 555 N John Young Pkwy. The departure Time is(12:20 AM and arrival time is 01:50 AM).', '2019-01-28 17:54:42'),
(485, 1, 'Role Added With Permissions', 'Super Admin added the Role (ADMIN) and (Read) access has been given of (USERS).', '2019-01-28 18:16:27'),
(486, 1, 'Role Added With Permissions', 'Super Admin added the Role (ADMIN) and (Read) access has been given of (CITIES).', '2019-01-28 18:16:27'),
(487, 1, 'Role Added With Permissions', 'Super Admin added the Role (ADMIN) and (Write) access has been given of (BUSES).', '2019-01-28 18:16:27'),
(488, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (USERS).', '2019-01-28 18:18:23'),
(489, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (CITIES).', '2019-01-28 18:18:23'),
(490, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Write) access has been given of (BUSES).', '2019-01-28 18:18:23'),
(491, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Write) access has been given of (ROUTES).', '2019-01-28 18:18:23'),
(492, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (TOURS).', '2019-01-28 18:18:23'),
(493, 1, 'Role Updated With Permissions', 'SUBADMIN has been deleted by Super Admin', '2019-01-28 18:35:31'),
(494, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (SUPERADMIN) and (Write) access has been given of (USERS).', '2019-01-28 18:37:01'),
(495, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (SUPERADMIN) and (Write) access has been given of (CITIES).', '2019-01-28 18:37:01'),
(496, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (SUPERADMIN) and (Write) access has been given of (BUSES).', '2019-01-28 18:37:01'),
(497, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (SUPERADMIN) and (Write) access has been given of (ROUTES).', '2019-01-28 18:37:01'),
(498, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (SUPERADMIN) and (Write) access has been given of (TOURS).', '2019-01-28 18:37:01'),
(499, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (SUPERADMIN) and (Write) access has been given of (SIGHTSEEINGS).', '2019-01-28 18:37:01'),
(500, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (SUPERADMIN) and (Write) access has been given of (ROLES).', '2019-01-28 18:37:01'),
(501, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (USERS).', '2019-01-28 18:38:51'),
(502, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (CITIES).', '2019-01-28 18:38:51'),
(503, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (BUSES).', '2019-01-28 18:38:51'),
(504, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (ROUTES).', '2019-01-28 18:38:51'),
(505, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (TOURS).', '2019-01-28 18:38:51'),
(506, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (SIGHTSEEINGS).', '2019-01-28 18:38:51'),
(507, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ADMIN) and (Read) access has been given of (ROLES).', '2019-01-28 18:38:51'),
(508, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-28 21:07:37'),
(509, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-28 21:08:22'),
(510, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-28 21:08:47'),
(511, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 06:13:21'),
(512, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 09:18:29'),
(513, 1, 'Bus Updated', 'Flix Bus bus number (Bus 1) updated by Super Admin', '2019-01-29 09:23:33'),
(514, 1, 'Bus Updated', 'Flix Bus bus number (Bus 2) updated by Super Admin', '2019-01-29 09:24:06'),
(515, 1, 'Bus Updated', 'Flix Bus bus number (Bus 3) updated by Super Admin', '2019-01-29 09:25:15'),
(516, 1, 'Bus Updated', 'Bilal Caoch bus number (Bus 4) updated by Super Admin', '2019-01-29 09:25:37'),
(517, 1, 'Bus Updated', 'Bus bus number (Bus 5) updated by Super Admin', '2019-01-29 09:26:12'),
(518, 1, 'Bus Updated', 'Flix Bus bus number (Bus 6) updated by Super Admin', '2019-01-29 09:27:43'),
(519, 1, 'Bus Updated', 'Flix Bus bus number (Bus 7) updated by Super Admin', '2019-01-29 09:31:31'),
(520, 1, 'Bus Updated', 'Flix Bus bus number (Bus 8) updated by Super Admin', '2019-01-29 09:31:54'),
(521, 1, 'Bus Updated', 'Flix Bus bus number (Bus 9) updated by Super Admin', '2019-01-29 09:32:17'),
(522, 1, 'Bus Updated', 'Flix Bus bus number (us 1234) updated by Super Admin', '2019-01-29 09:32:38'),
(523, 1, 'City Deleted', 'Super Admin deleted the city (Ft Pierce)', '2019-01-29 09:38:24'),
(524, 1, 'City Deleted', 'Super Admin deleted the city (West Palm Beach)', '2019-01-29 09:38:43'),
(525, 1, 'City Deleted', 'Super Admin deleted the city (Mebani Exit 15)', '2019-01-29 09:38:58'),
(526, 1, 'City Deleted', 'Super Admin deleted the city (Delware House MM5)', '2019-01-29 09:39:13'),
(527, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-29 09:41:16'),
(528, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 09:42:08'),
(529, 1, 'Role Added With Permissions', 'Super Admin added the Role (ROUTES) and (Read) access has been given of (ROUTES).', '2019-01-29 09:59:53'),
(530, 1, 'New City Added', 'Super Admin added a new city (Sunrise)', '2019-01-29 10:03:32'),
(531, 1, 'Terminal Added', 'The terminal name (sunrise terminal 1) added by Super Admin', '2019-01-29 10:06:15'),
(532, 1, 'Terminal Updated', 'The terminal name (sunrise terminal 2) updated by Super Admin', '2019-01-29 10:07:37'),
(533, 1, 'Terminal Deleted', 'The terminal name (sunrise terminal 2) updated by Super Admin', '2019-01-29 10:07:56'),
(534, 1, 'Terminal Added', 'The terminal name (sunrise terminal 1) added by Super Admin', '2019-01-29 10:08:31'),
(535, 1, 'Bus Added', 'Flix Bus bus number (Bus20) added by Super Admin', '2019-01-29 10:26:30'),
(536, 1, 'Bus Deleted', 'Flix Bus bus number (Bus20) deleted by Super Admin', '2019-01-29 10:27:07'),
(537, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 9) to the route from Orlando to Maimi (12:00 AM to 12:00 PM), the departure terminal is 555 N John Young Pkwy and arrival terminal is 3801 N W 21st Street', '2019-01-29 10:34:15'),
(538, 1, 'Route Updated', 'cyber clouds updated the route information. The bus (Bus 6) is assigned to the route from Orlando to Maimi (12:00 AM to 12:00 PM), the departure terminal is 555 N John Young Pkwy and arrival terminal is 3801 N W 21st Street', '2019-01-29 10:35:03'),
(539, 1, 'Route Updated', 'cyber clouds updated the route information. The bus (Bus 1) is assigned to the route from Orlando to Maimi (12:00 AM to 12:00 PM), the departure terminal is 555 N John Young Pkwy and arrival terminal is 3801 N W 21st Street', '2019-01-29 10:35:12'),
(540, 1, 'Route Updated', 'cyber clouds updated the route information. The bus (Bus 9) is assigned to the route from Richmond to Maimi (12:00 AM to 12:00 PM), the departure terminal is 2910 N Blvd VA 2323 and arrival terminal is 3801 N W 21st Street', '2019-01-29 10:36:46'),
(541, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 2910 N Blvd VA 2323 and arrival terminal is 555 N John Young Pkwy. The departure Time is(12:00 AM and arrival time is 12:10 AM).', '2019-01-29 10:47:13'),
(542, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 2910 N Blvd VA 2323 and arrival terminal is 103 E Dakin Ave. The departure Time is(12:00 AM and arrival time is 03:40 AM).', '2019-01-29 10:47:13'),
(543, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 2910 N Blvd VA 2323 and arrival terminal is 3801 N W 21st Street. The departure Time is(12:00 AM and arrival time is 12:00 PM).', '2019-01-29 10:47:13'),
(544, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 555 N John Young Pkwy and arrival terminal is 103 E Dakin Ave. The departure Time is(12:20 AM and arrival time is 03:40 AM).', '2019-01-29 10:47:13'),
(545, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 555 N John Young Pkwy and arrival terminal is 3801 N W 21st Street. The departure Time is(12:20 AM and arrival time is 12:00 PM).', '2019-01-29 10:47:13'),
(546, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 103 E Dakin Ave and arrival terminal is 3801 N W 21st Street. The departure Time is(04:40 AM and arrival time is 12:00 PM).', '2019-01-29 10:47:13'),
(547, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 11:42:56'),
(548, 1, 'New City Added', 'Super Admin added a new city (peshawar)', '2019-01-29 12:21:50'),
(549, 1, 'New City Added', 'Super Admin added a new city (isla)', '2019-01-29 12:23:33'),
(550, 1, 'City Updated', 'Super Admin updated the city (peshawar)', '2019-01-29 12:27:45'),
(551, 1, 'City Updated', 'Super Admin updated the city (peshawar)', '2019-01-29 12:29:17'),
(552, 1, 'User Added', 'cyber clouds added a user with the role of Admin', '2019-01-29 12:36:32'),
(553, 1, 'User Deleted', 'cyber clouds delete the Admin(Test User  To Delete)', '2019-01-29 12:37:05'),
(554, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-29 12:47:13'),
(555, 3, 'Admin Login', 'The user Clouds Admin logged in', '2019-01-29 12:47:47'),
(556, 3, 'Admin Logout', 'The user Clouds Admin logged out', '2019-01-29 12:49:15'),
(557, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 12:49:25'),
(558, 1, 'City Deleted', 'Super Admin deleted the city (Peshawar)', '2019-01-29 12:52:58'),
(559, 1, 'City Deleted', 'Super Admin deleted the city (Isla)', '2019-01-29 12:53:13'),
(560, 1, 'Role Added With Permissions', 'Super Admin added the Role (hello) and (Read) access has been given of (USERS).', '2019-01-29 13:26:29'),
(561, 1, 'Role Added With Permissions', 'Super Admin added the Role (HELLO) and (Read) access has been given of (USERS).', '2019-01-29 13:31:29'),
(562, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 1) to the route from Maimi North to Sunrise (12:00 AM to 12:20 AM), the departure terminal is 15821 Nw 7th st and arrival terminal is sunrise terminal 1', '2019-01-29 13:45:25'),
(563, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 6) to the route from Maimi North to Sunrise (12:05 AM to 12:20 AM), the departure terminal is 15821 Nw 7th st and arrival terminal is sunrise terminal 1', '2019-01-29 13:47:13'),
(564, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is 601 W Trade st  NC28202. The departure Time is(12:05 AM and arrival time is 12:05 AM).', '2019-01-29 13:47:38'),
(565, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 15821 Nw 7th st and arrival terminal is sunrise terminal 1. The departure Time is(12:05 AM and arrival time is 12:20 AM).', '2019-01-29 13:47:38'),
(566, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is sunrise terminal 1. The departure Time is(12:10 AM and arrival time is 12:20 AM).', '2019-01-29 13:47:38'),
(567, 1, 'Role Added With Permissions', 'Super Admin added the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-01-29 14:03:47'),
(568, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-01-29 14:04:37'),
(569, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-29 14:13:32'),
(570, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 14:14:13'),
(571, 1, 'User Profile Updated', 'cyber clouds updated the user profile of (Clouds Admin)', '2019-01-29 14:15:00'),
(572, 1, 'User Profile Updated', 'cyber clouds updated the user profile of (Clouds Admin)', '2019-01-29 14:15:35'),
(573, 1, 'User Profile Updated', 'cyber clouds updated the user profile of (Clouds Admin)', '2019-01-29 14:16:33'),
(574, 1, 'User Profile Updated', 'cyber clouds updated the user profile of (Clouds Admin)', '2019-01-29 14:16:59'),
(575, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-29 14:17:11'),
(576, 3, 'Role Updated With Permissions', ' updated the Role (ROUTES) and (Read) access has been given of (ROUTES).', '2019-01-29 15:07:29'),
(577, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 15:20:54'),
(578, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 1) to the route from Sunrise to Orlando (12:05 AM to 12:20 AM), the departure terminal is sunrise terminal 1 and arrival terminal is 555 N John Young Pkwy', '2019-01-29 15:26:34'),
(579, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 1) to the route from Richmond to Maimi North (12:10 AM to 12:20 AM), the departure terminal is 2910 N Blvd VA 2323 and arrival terminal is 15821 Nw 7th st', '2019-01-29 15:27:54'),
(580, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 8) to the route from Orlando to Richmond (12:05 AM to 12:20 AM), the departure terminal is 555 N John Young Pkwy and arrival terminal is 2910 N Blvd VA 2323', '2019-01-29 15:30:59'),
(581, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 6) to the route from Maimi North to Orlando (12:15 AM to 12:20 AM), the departure terminal is 15821 Nw 7th st and arrival terminal is 555 N John Young Pkwy', '2019-01-29 15:31:51'),
(582, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 5) to the route from Kissimmee to Richmond (12:10 AM to 12:20 AM), the departure terminal is 103 E Dakin Ave and arrival terminal is 2910 N Blvd VA 2323', '2019-01-29 15:36:33'),
(583, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-29 16:08:58'),
(584, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 17:28:14'),
(585, 1, 'Bus Added', 'Flix Bus bus number (us 109) added by Super Admin', '2019-01-29 17:29:28'),
(586, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-29 17:42:42'),
(587, 1, 'User Added', 'cyber clouds added a user with the role of Admin', '2019-01-29 17:56:22'),
(588, 1, 'User Deleted', 'cyber clouds delete the Admin(Dfas  Dfsadf)', '2019-01-29 17:57:18'),
(589, 1, 'User Added', 'cyber clouds added a user with the role of Super Admin', '2019-01-29 17:58:34'),
(590, 1, 'User Profile Updated', 'cyber clouds updated the user profile of Super Admin(Abid jdh Admin)', '2019-01-29 18:05:02'),
(591, 1, 'User Added', 'cyber clouds added a user with the role of Super Admin', '2019-01-29 18:12:13'),
(592, 1, 'User Added', 'cyber clouds added a user with the role of ', '2019-01-29 18:13:32'),
(593, 1, 'Bus Status Added', ' Bus Status    Added by Super Admin', '2019-01-29 19:29:02'),
(594, 1, 'Role Added With Permissions', 'Super Admin added the Role (TEST) and (Read) access has been given of (USERS).', '2019-01-29 19:30:32'),
(595, 1, 'Role Added With Permissions', 'Super Admin added the Role (TEST) and (Read) access has been given of (CITIES).', '2019-01-29 19:30:32'),
(596, 1, 'Role Added With Permissions', 'Super Admin added the Role (TEST) and (Write) access has been given of (BUSES).', '2019-01-29 19:30:32'),
(597, 1, 'Role Added With Permissions', 'Super Admin added the Role (TEST) and (Read) access has been given of (ROUTES).', '2019-01-29 19:30:32'),
(598, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-30 08:48:38'),
(599, 1, 'Bus Added', 'Flix Bus bus number (Bus 1045) added by Super Admin', '2019-01-30 09:13:12'),
(600, 1, 'Bus Added', 'Flix Bus bus number (us 101) added by Super Admin', '2019-01-30 09:15:03'),
(601, 1, 'Bus Added', 'Flix Bus bus number (us 1012) added by Super Admin', '2019-01-30 09:15:12'),
(602, 1, 'Bus Updated', 'Flix Bus bus number (us 101) updated by Super Admin', '2019-01-30 09:38:46'),
(603, 1, 'Bus Added', 'Flix Bus bus number (us 478) added by Super Admin', '2019-01-30 09:40:46'),
(604, 1, 'Bus Updated', 'Flix Bus bus number (Bus 1) updated by Super Admin', '2019-01-30 09:49:35'),
(605, 1, 'Bus Updated', 'Flix Bus bus number (Bus 1) updated by Super Admin', '2019-01-30 09:52:13'),
(606, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 9) to the route from Kissimmee to Richmond (12:00 AM to 12:15 AM), the departure terminal is 103 E Dakin Ave and arrival terminal is 2910 N Blvd VA 2323', '2019-01-30 09:57:43'),
(607, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-30 10:46:20'),
(608, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 7) to the route from Charlote to Maimi North (12:00 AM to 12:50 AM), the departure terminal is 601 W Trade st  NC28202 and arrival terminal is 15821 Nw 7th st', '2019-01-30 10:53:07'),
(609, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is 103 E Dakin Ave. The departure Time is(12:00 AM and arrival time is 12:15 AM).', '2019-01-30 11:04:56'),
(610, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is 15821 Nw 7th st. The departure Time is(12:00 AM and arrival time is 12:50 AM).', '2019-01-30 11:04:56'),
(611, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is 103 E Dakin Ave and arrival terminal is 15821 Nw 7th st. The departure Time is(12:25 AM and arrival time is 12:50 AM).', '2019-01-30 11:04:56'),
(612, 1, 'Route Added', 'cyber clouds assigned the bus (us 1234) to the route from Atlanta to Kissimmee (12:10 AM to 12:20 AM), the departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 103 E Dakin Ave', '2019-01-30 11:06:34'),
(613, 1, 'Route Updated', 'cyber clouds updated the route information. The bus (us 1234) is assigned to the route from Atlanta to Kissimmee (12:10 AM to 12:20 AM), the departure terminal is 232 Forsyth St, GA 30303 and arrival terminal is 103 E Dakin Ave', '2019-01-30 11:08:55'),
(614, 1, 'Terminal Updated', 'The terminal name (Omni Terminal) updated by Super Admin', '2019-01-30 12:52:48'),
(615, 1, 'Terminal Updated', 'The terminal name (Lynx Kissimmee) updated by Super Admin', '2019-01-30 12:54:01'),
(616, 1, 'Terminal Updated', 'The terminal name (Lynx Central Station) updated by Super Admin', '2019-01-30 12:54:48'),
(617, 1, 'Terminal Added', 'The terminal name (N Garland Ave) added by Super Admin', '2019-01-30 12:55:18'),
(618, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-30 12:55:43'),
(619, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-30 12:57:10'),
(620, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-30 13:53:36'),
(621, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-30 13:53:46'),
(622, 1, 'Role Updated With Permissions', 'Super Admin updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-01-30 13:55:39'),
(623, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-30 13:57:54'),
(624, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-30 14:10:35'),
(625, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-30 14:14:10'),
(626, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-30 14:17:37'),
(627, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-30 16:20:27'),
(628, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 1) to the route from Maimi to Kissimmee (12:00 AM to 03:00 AM), the departure terminal is Omni Terminal and arrival terminal is Lynx Kissimmee', '2019-01-30 16:25:46'),
(629, 1, 'Route Updated', 'cyber clouds updated the route information. The bus (Bus 1) is assigned to the route from Maimi to Kissimmee (12:00 AM to 03:00 AM), the departure terminal is Omni Terminal and arrival terminal is Lynx Kissimmee', '2019-01-30 16:26:09'),
(630, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is Lynx Central Station. The departure Time is(12:00 AM and arrival time is 12:15 AM).', '2019-01-30 16:39:45'),
(631, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is N Garland Ave. The departure Time is(12:00 AM and arrival time is 12:55 AM).', '2019-01-30 16:39:45'),
(632, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is Lynx Kissimmee. The departure Time is(12:00 AM and arrival time is 03:00 AM).', '2019-01-30 16:39:45'),
(633, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Lynx Central Station and arrival terminal is N Garland Ave. The departure Time is(12:20 AM and arrival time is 12:55 AM).', '2019-01-30 16:39:45'),
(634, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Lynx Central Station and arrival terminal is Lynx Kissimmee. The departure Time is(12:20 AM and arrival time is 03:00 AM).', '2019-01-30 16:39:45'),
(635, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is N Garland Ave and arrival terminal is Lynx Kissimmee. The departure Time is(01:00 AM and arrival time is 03:00 AM).', '2019-01-30 16:39:45'),
(636, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 1) to the route from Maimi to Kissimmee (12:00 AM to 01:40 AM), the departure terminal is Omni Terminal and arrival terminal is Lynx Kissimmee', '2019-01-30 16:41:10'),
(637, 1, 'Route Updated', 'cyber clouds updated the route information. The bus (Bus 1) is assigned to the route from Maimi to Kissimmee (12:00 AM to 03:00 AM), the departure terminal is Omni Terminal and arrival terminal is Lynx Kissimmee', '2019-01-30 16:41:29'),
(638, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 1) to the route from Maimi to Orlando (12:00 AM to 12:25 AM), the departure terminal is Omni Terminal and arrival terminal is Lynx Central Station', '2019-01-30 17:16:52'),
(639, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is Lynx Kissimmee. The departure Time is(12:00 AM and arrival time is 12:20 AM).', '2019-01-30 17:17:26'),
(640, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is Lynx Central Station. The departure Time is(12:00 AM and arrival time is 12:25 AM).', '2019-01-30 17:17:26'),
(641, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Lynx Kissimmee and arrival terminal is Lynx Central Station. The departure Time is(12:25 AM and arrival time is 12:25 AM).', '2019-01-30 17:17:26'),
(642, 1, 'Route Added', 'cyber clouds assigned the bus (Bus 2) to the route from Maimi to Sunrise (01:00 AM to 04:00 AM), the departure terminal is Omni Terminal and arrival terminal is sunrise terminal 1', '2019-01-30 17:18:15'),
(643, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is Lynx Central Station. The departure Time is(01:00 AM and arrival time is 02:20 AM).', '2019-01-30 17:19:54'),
(644, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is N Garland Ave. The departure Time is(01:00 AM and arrival time is 03:00 AM).', '2019-01-30 17:19:54'),
(645, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Omni Terminal and arrival terminal is sunrise terminal 1. The departure Time is(01:00 AM and arrival time is 04:00 AM).', '2019-01-30 17:19:54'),
(646, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Lynx Central Station and arrival terminal is N Garland Ave. The departure Time is(02:30 AM and arrival time is 03:00 AM).', '2019-01-30 17:19:54'),
(647, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is Lynx Central Station and arrival terminal is sunrise terminal 1. The departure Time is(02:30 AM and arrival time is 04:00 AM).', '2019-01-30 17:19:54'),
(648, 1, 'Route Terminals Added', 'cyber clouds added the route terminals. The departure terminal is N Garland Ave and arrival terminal is sunrise terminal 1. The departure Time is(03:15 AM and arrival time is 04:00 AM).', '2019-01-30 17:19:54'),
(649, 1, 'Route Deleted', 'SUPERADMIN delete the route. The origin city was (Maimi), origin stop (Omni Terminal) and the destination city was (Sunrise), destination stop (sunrise terminal 1).', '2019-01-30 18:57:20'),
(650, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-31 07:51:41'),
(651, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 07:52:54'),
(652, 1, 'Super Admin Login', 'The user cyber clouds logged in', '2019-01-31 08:46:59'),
(653, 1, 'User Profile Updated', 'cyber clouds updated the user profile of Super Admin(cyber clouds)', '2019-01-31 08:47:35'),
(654, 1, 'Super Admin Logout', 'The user cyber clouds logged out', '2019-01-31 08:47:45'),
(655, 1, 'Super Admin Login', 'The user Cyber Clouds logged in', '2019-01-31 08:47:57'),
(656, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 08:51:51'),
(657, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 09:00:50'),
(658, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 09:03:53'),
(659, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 09:06:59'),
(660, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 09:25:02'),
(661, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 09:25:21'),
(662, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 09:29:42'),
(663, 1, 'Super Admin Logout', 'The user Cyber Clouds logged out', '2019-01-31 10:03:45'),
(664, 1, 'SUPERADMIN Login', 'User loggged in with the role of SUPERADMIN', '2019-01-31 10:04:00'),
(665, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-01-31 10:06:35'),
(666, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-01-31 10:08:13'),
(667, 1, 'Route CSV uploaded', ' Route  CSV  Uploaded by Super Admin', '2019-01-31 10:09:15'),
(668, 1, 'User Deleted', 'SUPERADMIN deleted the user (Clouds  Admin)', '2019-01-31 10:18:49'),
(669, 1, 'User Added', 'SUPERADMIN added a user abc', '2019-01-31 10:23:33'),
(670, 1, 'User Profile Updated', 'SUPERADMIN updated the user profile of (Route Access)', '2019-01-31 10:26:50'),
(671, 1, 'User Profile Updated', 'SUPERADMIN updated the user profile of (Sohail Khan)', '2019-01-31 10:29:43'),
(672, 10, 'Customer Registration', 'SUPERADMIN registered as a customer. The customer user name is customer', '2019-01-31 10:36:17'),
(673, 1, 'User Profile Updated', 'SUPERADMIN updated the user profile of (customer khan)', '2019-01-31 10:44:53'),
(674, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-01-31 14:39:01'),
(675, 1, 'New City Added', 'SUPERADMIN added a new city (Ft Pierce)', '2019-01-31 14:44:17'),
(676, 1, 'City Updated', 'SUPERADMIN updated the city (Ft Pierce 123)', '2019-01-31 14:46:56'),
(677, 1, 'City Deleted', 'SUPERADMIN deleted the city (Ft Pierce 123)', '2019-01-31 14:49:11'),
(678, 1, 'Terminal Added', 'The terminal (Test) added to the city (Maimi) by ', '2019-01-31 14:59:45'),
(679, 1, 'Terminal Added', 'The terminal (Abc) added to the city (Maimi) by SUPERADMIN', '2019-01-31 15:00:27'),
(680, 1, 'Terminal Updated', 'The terminal (Test Dfjsjkdfj) update by the SUPERADMIN to the city (Maimi).', '2019-01-31 15:07:05'),
(681, 1, 'Terminal Updated', 'The terminal (Abc Jj) update by the SUPERADMIN. The update terminal belong to (Maimi).', '2019-01-31 15:10:50'),
(682, 1, 'Terminal Updated', 'The terminal (Abc Jj) update by the SUPERADMIN. The update terminal belong to (Maimi) city.', '2019-01-31 15:12:14'),
(683, 1, 'Terminal Updated', 'The terminal (Abc Jj) update by the SUPERADMIN. The updated terminal belong to (Maimi) city.', '2019-01-31 15:12:39'),
(684, 1, 'Terminal Deleted', 'The terminal (Test Dfjsjkdfj) deleted by . The deleted terminal belong to Maimi', '2019-01-31 15:16:07'),
(685, 1, 'Terminal Deleted', 'The terminal (Abc Jj) deleted by SUPERADMIN. The deleted terminal belong to Maimi', '2019-01-31 15:16:37'),
(686, 1, 'Bus Added', 'Flix Bus (us 10145) bus added by SUPERADMIN', '2019-01-31 15:30:50'),
(687, 1, 'Bus Updated', 'Flix Bus (us 10145) bus updated by SUPERADMIN', '2019-01-31 15:34:06'),
(688, 1, 'Bus Deleted', 'Flix Bus (us 10145) bus deleted by SUPERADMIN', '2019-01-31 15:35:38'),
(689, 1, 'Bus Status Added', 'The bus Status changed to Arrived by SUPERADMIN', '2019-01-31 15:46:20'),
(690, 1, 'Bus Status Added', 'The bus Status changed to (Delayed) by SUPERADMIN', '2019-01-31 15:47:35'),
(691, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Delayed', '2019-01-31 15:51:44'),
(692, 1, 'The Delayed status of Bus number (us 109) has been', ' Bus Status Updated by ', '2019-01-31 15:59:13'),
(693, 1, 'Bus Status Deleted', 'The Delayed status of Bus number (Bus 1045) has been deleted by SUPERADMIN', '2019-01-31 16:01:42'),
(694, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Arrived', '2019-01-31 16:02:37'),
(695, 1, 'Bus Status Deleted', 'The Delayed status of Bus number (Bus 4) has been deleted by SUPERADMIN', '2019-01-31 16:02:51'),
(696, 1, 'Bus Status Added', 'The bus Status changed to (Arrived) by SUPERADMIN', '2019-01-31 16:04:25'),
(697, 1, 'Bus Status Deleted', 'The Arrived status of Bus number (Bus 2) has been deleted by SUPERADMIN', '2019-01-31 16:04:46'),
(698, 1, 'Route Added', 'SUPERADMIN assigned the bus (us 1012) to the route from Charlote to Richmond (12:00 AM to 12:15 AM), the departure terminal is 601 W Trade st  NC28202 and arrival terminal is 2910 N Blvd VA 2323', '2019-01-31 16:18:14'),
(699, 1, 'Route Updated', 'SUPERADMIN updated the route information. The bus (us 1012) is assigned to the route from Charlote to Richmond (12:00 AM to 12:15 AM), the departure terminal is 601 W Trade st  NC28202 and arrival terminal is 2910 N Blvd VA 2323', '2019-01-31 16:18:58'),
(700, 1, 'Route Terminals Added', 'SUPERADMIN added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is Lynx Kissimmee. The departure Time is(12:00 AM and arrival time is 12:05 AM).', '2019-01-31 16:21:59'),
(701, 1, 'Route Terminals Added', 'SUPERADMIN added the route terminals. The departure terminal is 601 W Trade st  NC28202 and arrival terminal is 2910 N Blvd VA 2323. The departure Time is(12:00 AM and arrival time is 12:15 AM).', '2019-01-31 16:21:59'),
(702, 1, 'Route Terminals Added', 'SUPERADMIN added the route terminals. The departure terminal is Lynx Kissimmee and arrival terminal is 2910 N Blvd VA 2323. The departure Time is(12:10 AM and arrival time is 12:15 AM).', '2019-01-31 16:21:59'),
(703, 1, 'Role Added With Permissions', 'SUPERADMIN added the Role (ABC) and (Read) access has been given of (TOURS).', '2019-01-31 16:30:30'),
(704, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ABC) and (Read) access has been given of (BUSES).', '2019-01-31 16:37:03'),
(705, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ABC) and (Write) access has been given of (ROUTES).', '2019-01-31 16:37:03'),
(706, 1, 'Role Updated With Permissions', 'ABC role has been deleted by SUPERADMIN', '2019-01-31 16:39:12'),
(707, 1, 'Sightseeing Added', 'Bush Garden added by SUPERADMIN', '2019-01-31 16:47:32'),
(708, 1, 'Sightseeing Updated', 'Sight seeing Bush Garden updated by SUPERADMIN', '2019-01-31 16:50:04'),
(709, 1, 'Sightseeing Deleted', 'Sight seeing  deleted by SUPERADMIN', '2019-01-31 16:52:16'),
(710, 1, 'Sightseeing Deleted', 'Sight seeing Bush Garden deleted by SUPERADMIN', '2019-01-31 16:53:43'),
(711, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-01 00:18:16'),
(712, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-01 00:35:28'),
(713, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-01 00:35:38'),
(714, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-01 01:16:08'),
(715, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-01 01:26:20');
INSERT INTO `logs` (`id`, `user_id`, `activity`, `note`, `modified`) VALUES
(716, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-01 01:41:31'),
(717, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-01 06:18:16'),
(718, 1, 'Route Updated', 'SUPERADMIN update the route of bus (Bus 2) from Charlote (Array)  to Kissimmee(Lynx Kissimmee). The new time is 05:00 AM to 11:00 AM', '2019-02-01 08:43:03'),
(719, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-01 15:00:17'),
(720, 1, 'Route Stop Deleted', 'SUPERADMIN delete the route stop / terminal. The origin city was (Charlote), origin stop (601 W Trade st  NC28202) and the destination city was (Richmond), destination stop (2910 N Blvd VA 2323).', '2019-02-01 15:10:50'),
(721, 1, 'Route Stop Deleted', 'SUPERADMIN delete the route stop / terminal. The origin city was (Sunrise), origin stop (Lynx Kissimmee) and the destination city was (Richmond), destination stop (2910 N Blvd VA 2323).', '2019-02-01 15:12:59'),
(722, 1, 'Route Stop Updated', 'SUPERADMIN update the route stop. The origin city is  ()  and destination city is (). The new time is (12:00 AM to 12:05 AM).', '2019-02-01 16:07:03'),
(723, 1, 'Route Stop Updated', 'SUPERADMIN update the route stop. The origin city is Charlote (601 W Trade st  NC28202)  and destination city is Sunrise(sunrise terminal 1). The new time is (12:00 AM to 12:05 AM).', '2019-02-01 16:08:59'),
(724, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-02 00:24:02'),
(725, 1, 'Route Stop Added', 'SUPERADMIN add the route stop. The origin city is Kissimmee (Lynx Kissimmee)  and destination city is Maimi(testing terminal). The origin time is (12:05 AM and destination 12:10 AM).', '2019-02-02 01:13:04'),
(726, 1, 'Route Stop Added', 'SUPERADMIN add the route stop. The origin city is Charlote (601 W Trade st  NC28202)  and destination city is Maimi(Omni Terminal). The origin time is (12:10 AM and destination 12:05 AM).', '2019-02-02 01:15:56'),
(727, 1, 'Bus Status Added', 'The bus Status changed to (Arrived) by SUPERADMIN', '2019-02-02 03:54:26'),
(728, 1, 'Bus Status Deleted', 'The Arrived status of Bus number (Bus 1) has been deleted by SUPERADMIN', '2019-02-02 03:54:38'),
(729, 1, 'Bus Status Added', 'The bus Status changed to (Delayed) by SUPERADMIN', '2019-02-02 05:02:55'),
(730, 1, 'Bus Status Added', 'The bus Status changed to (Delayed) by SUPERADMIN', '2019-02-02 05:16:48'),
(731, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-02 16:16:38'),
(732, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 09:12:43'),
(733, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 10:47:48'),
(734, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 10:47:56'),
(735, 1, 'Company Added', 'SUPERADMIN added the comapny (Abc)', '2019-02-04 11:10:19'),
(736, 1, 'Bus Added', 'Flixbus (bus 555) bus added by SUPERADMIN', '2019-02-04 11:11:02'),
(737, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 12:42:17'),
(738, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 12:42:46'),
(739, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 12:53:53'),
(740, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 12:54:23'),
(741, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 12:56:33'),
(742, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-04 12:57:05'),
(743, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 12:57:11'),
(744, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 13:02:31'),
(745, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:02:38'),
(746, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:04:50'),
(747, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:05:20'),
(748, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:10:37'),
(749, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:12:25'),
(750, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:14:45'),
(751, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:15:15'),
(752, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-04 13:23:07'),
(753, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 13:23:13'),
(754, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 13:25:47'),
(755, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 13:25:54'),
(756, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (USERS).', '2019-02-04 13:34:02'),
(757, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (USERS).', '2019-02-04 13:34:25'),
(758, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-02-04 13:34:25'),
(759, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-04 13:35:16'),
(760, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 14:01:55'),
(761, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-02-04 14:02:34'),
(762, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 14:02:47'),
(763, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 14:02:55'),
(764, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Read) access has been given of (USERS).', '2019-02-04 14:04:58'),
(765, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-02-04 14:04:58'),
(766, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (USERS).', '2019-02-04 14:07:47'),
(767, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-02-04 14:07:47'),
(768, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Read) access has been given of (USERS).', '2019-02-04 14:11:39'),
(769, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-02-04 14:11:39'),
(770, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (USERS).', '2019-02-04 14:26:15'),
(771, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-02-04 14:26:15'),
(772, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and () access has been given of (USERS).', '2019-02-04 14:31:17'),
(773, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and () access has been given of (CITIES).', '2019-02-04 14:31:17'),
(774, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and () access has been given of (BUSES).', '2019-02-04 14:31:17'),
(775, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and () access has been given of (ROUTES).', '2019-02-04 14:31:17'),
(776, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and () access has been given of (TOURS).', '2019-02-04 14:31:17'),
(777, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and () access has been given of (SIGHTSEEINGS).', '2019-02-04 14:31:17'),
(778, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and () access has been given of (ROLES).', '2019-02-04 14:31:17'),
(779, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and (Write) access has been given of (USERS).', '2019-02-04 14:33:44'),
(780, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and (Write) access has been given of (CITIES).', '2019-02-04 14:33:44'),
(781, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and (Write) access has been given of (BUSES).', '2019-02-04 14:33:44'),
(782, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and (Write) access has been given of (ROUTES).', '2019-02-04 14:33:44'),
(783, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and (Write) access has been given of (TOURS).', '2019-02-04 14:33:44'),
(784, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and (Write) access has been given of (SIGHTSEEINGS).', '2019-02-04 14:33:44'),
(785, 8, 'Role Updated With Permissions', 'ROUTES updated the Role (SUPERADMIN) and (Write) access has been given of (ROLES).', '2019-02-04 14:33:44'),
(786, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-04 14:42:41'),
(787, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 14:43:00'),
(788, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 14:51:23'),
(789, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 14:51:30'),
(790, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-04 15:09:14'),
(791, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 15:09:21'),
(792, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 15:15:12'),
(793, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 15:15:19'),
(794, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-04 15:15:45'),
(795, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 15:15:52'),
(796, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (USERS).', '2019-02-04 15:16:45'),
(797, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (CITIES).', '2019-02-04 15:16:45'),
(798, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (BUSES).', '2019-02-04 15:16:45'),
(799, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Write) access has been given of (ROUTES).', '2019-02-04 15:16:45'),
(800, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (TOURS).', '2019-02-04 15:16:45'),
(801, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (SIGHTSEEINGS).', '2019-02-04 15:16:45'),
(802, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (ROLES).', '2019-02-04 15:16:45'),
(803, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 15:17:02'),
(804, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-04 15:17:08'),
(805, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-04 15:33:39'),
(806, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 15:33:45'),
(807, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 15:50:52'),
(808, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 15:51:32'),
(809, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 15:52:07'),
(810, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 15:52:44'),
(811, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-04 15:56:38'),
(812, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-04 15:57:00'),
(813, 1, 'Company Added', 'SUPERADMIN added the comapny (FlexBux)', '2019-02-04 18:44:11'),
(814, 1, 'Company Added', 'SUPERADMIN added the comapny (Tampa Bus)', '2019-02-04 18:44:33'),
(815, 1, 'Bus Added', 'Flexbux (bus 1) bus added by SUPERADMIN', '2019-02-04 18:54:02'),
(816, 1, 'Bus Updated', 'Flexbux (bus 1) bus updated by SUPERADMIN', '2019-02-04 18:54:37'),
(817, 1, 'Bus Status Added', 'The bus Status changed to (Delayed) by SUPERADMIN', '2019-02-04 19:14:00'),
(818, 1, 'Bus Added', 'Flexbux (bus 2) bus added by SUPERADMIN', '2019-02-04 19:15:11'),
(819, 1, 'Bus Status Added', 'The bus Status changed to (Arrived) by SUPERADMIN', '2019-02-04 19:17:30'),
(820, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Delayed', '2019-02-04 19:39:40'),
(821, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 08:38:29'),
(822, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 08:39:40'),
(823, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 08:40:12'),
(824, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Delayed', '2019-02-05 09:17:48'),
(825, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Delayed', '2019-02-05 09:18:21'),
(826, 1, 'Bus Status Added', 'The bus Status changed to (Delayed) by SUPERADMIN', '2019-02-05 09:19:03'),
(827, 1, 'Bus Status Added', 'The bus Status changed to (Arrived) by SUPERADMIN', '2019-02-05 09:19:16'),
(828, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Arrived', '2019-02-05 09:20:02'),
(829, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Arrived', '2019-02-05 09:27:04'),
(830, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-05 09:31:00'),
(831, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 09:31:44'),
(832, 1, 'Bus Updated', 'Flexbux (bus 1) bus updated by SUPERADMIN', '2019-02-05 09:43:56'),
(833, 1, 'Bus Updated', 'Flexbux (bus 2) bus updated by SUPERADMIN', '2019-02-05 09:44:05'),
(834, 1, 'State Deleted', 'SUPERADMIN deleted the state (Ss)', '2019-02-05 09:50:00'),
(835, 1, 'State Updated', 'SUPERADMIN updated the state (New York)', '2019-02-05 09:50:32'),
(836, 1, 'City Updated', 'SUPERADMIN updated the city (Los Angeles)', '2019-02-05 09:57:27'),
(837, 1, 'City Updated', 'SUPERADMIN updated the city (San Diego)', '2019-02-05 09:57:47'),
(838, 1, 'New City Added', 'SUPERADMIN added a new city (San Francisco)', '2019-02-05 09:58:13'),
(839, 1, 'State Updated', 'SUPERADMIN updated the state (Florida)', '2019-02-05 10:00:50'),
(840, 1, 'City Updated', 'SUPERADMIN updated the city (Jacksonville)', '2019-02-05 10:01:16'),
(841, 1, 'New City Added', 'SUPERADMIN added a new city (Miami)', '2019-02-05 10:01:50'),
(842, 1, 'New City Added', 'SUPERADMIN added a new city (Tampa)', '2019-02-05 10:02:13'),
(843, 1, 'New City Added', 'SUPERADMIN added a new city (Orlando)', '2019-02-05 10:03:12'),
(844, 1, 'Role Deleted With Permissions', 'TEST role has been deleted by SUPERADMIN', '2019-02-05 10:10:46'),
(845, 1, 'Role Deleted With Permissions', 'CUSTOMER role has been deleted by SUPERADMIN', '2019-02-05 10:10:56'),
(846, 1, 'Role Deleted With Permissions', 'ADMIN role has been deleted by SUPERADMIN', '2019-02-05 10:11:03'),
(847, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (USERS).', '2019-02-05 10:11:36'),
(848, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (CITIES).', '2019-02-05 10:11:36'),
(849, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (BUSES).', '2019-02-05 10:11:36'),
(850, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (ROUTES).', '2019-02-05 10:11:36'),
(851, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (TOURS).', '2019-02-05 10:11:36'),
(852, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (STATES).', '2019-02-05 10:11:37'),
(853, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (ROLES).', '2019-02-05 10:11:37'),
(854, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (COMPANIES).', '2019-02-05 10:11:37'),
(855, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (TERMINALS).', '2019-02-05 10:11:37'),
(856, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (SUPERADMIN) and (Write) access has been given of (BUSSTATUS).', '2019-02-05 10:11:37'),
(857, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-05 10:28:10'),
(858, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-05 10:28:21'),
(859, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-05 10:28:55'),
(860, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 10:29:01'),
(861, 1, 'Terminal Added', 'The terminal (G Shuttle Stop) added to the city (Los Angeles) by SUPERADMIN', '2019-02-05 11:14:26'),
(862, 1, 'Terminal Added', 'The terminal (Union Station) added to the city (Los Angeles) by SUPERADMIN', '2019-02-05 11:15:05'),
(863, 1, 'Terminal Added', 'The terminal (Greyhound) added to the city (San Diego) by SUPERADMIN', '2019-02-05 11:16:35'),
(864, 1, 'Terminal Added', 'The terminal (San Ysidro) added to the city (San Diego) by SUPERADMIN', '2019-02-05 11:17:38'),
(865, 1, 'Terminal Added', 'The terminal (Civic Center Bus Stop) added to the city (San Francisco) by SUPERADMIN', '2019-02-05 11:18:35'),
(866, 1, 'Terminal Added', 'The terminal (Salesforce Transit Center) added to the city (San Francisco) by SUPERADMIN', '2019-02-05 11:18:58'),
(867, 1, 'Terminal Added', 'The terminal (City College Terminal) added to the city (San Francisco) by SUPERADMIN', '2019-02-05 11:19:21'),
(868, 1, 'Terminal Added', 'The terminal (Rosa Parks Station) added to the city (Jacksonville) by SUPERADMIN', '2019-02-05 11:32:07'),
(869, 1, 'Terminal Added', 'The terminal (J.i.a) added to the city (Jacksonville) by SUPERADMIN', '2019-02-05 11:32:40'),
(870, 1, 'Terminal Added', 'The terminal (Omni Terminal) added to the city (Miami) by SUPERADMIN', '2019-02-05 11:34:52'),
(871, 1, 'Terminal Added', 'The terminal (Miami Port Terminal B-j) added to the city (Miami) by SUPERADMIN', '2019-02-05 11:35:08'),
(872, 1, 'Terminal Added', 'The terminal (Marion Transit Center) added to the city (Tampa) by SUPERADMIN', '2019-02-05 11:36:44'),
(873, 1, 'Terminal Added', 'The terminal (Tampa Usf) added to the city (Tampa) by SUPERADMIN', '2019-02-05 11:37:30'),
(874, 1, 'Terminal Added', 'The terminal (Lynx Central Station) added to the city (Orlando) by SUPERADMIN', '2019-02-05 11:39:56'),
(875, 1, 'Terminal Added', 'The terminal (Orlando Station) added to the city (Orlando) by SUPERADMIN', '2019-02-05 11:40:20'),
(876, 1, 'Terminal Added', 'The terminal (N Garland Ave) added to the city (Orlando) by SUPERADMIN', '2019-02-05 11:41:39'),
(877, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-05 13:10:43'),
(878, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-05 13:10:50'),
(879, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-05 13:11:10'),
(880, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 13:11:48'),
(881, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-05 13:17:43'),
(882, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-05 13:17:52'),
(883, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-05 13:19:29'),
(884, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 13:40:12'),
(885, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-05 13:50:53'),
(886, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-05 13:50:59'),
(887, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-05 14:02:27'),
(888, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 14:02:34'),
(889, 1, 'Role Added With Permissions', 'SUPERADMIN added the Role (ADMIN) and (Write) access has been given of (BUSES).', '2019-02-05 14:04:48'),
(890, 1, 'Role Added With Permissions', 'SUPERADMIN added the Role (ADMIN) and (Write) access has been given of (ROUTES).', '2019-02-05 14:04:48'),
(891, 1, 'Role Added With Permissions', 'SUPERADMIN added the Role (ADMIN) and (Write) access has been given of (TOURS).', '2019-02-05 14:04:48'),
(892, 1, 'Role Added With Permissions', 'SUPERADMIN added the Role (ADMIN) and (Read) access has been given of (COMPANIES).', '2019-02-05 14:04:48'),
(893, 1, 'Role Added With Permissions', 'SUPERADMIN added the Role (ADMIN) and (Write) access has been given of (BUSSTATUS).', '2019-02-05 14:04:48'),
(894, 1, 'Role Added With Permissions', 'SUPERADMIN added the Role (ADMIN) and (Write) access has been given of (ROUTETERMINALS).', '2019-02-05 14:04:48'),
(895, 1, 'User Profile Updated', 'SUPERADMIN updated the user profile of (Abid Admin)', '2019-02-05 14:06:16'),
(896, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-05 14:07:06'),
(897, 6, 'ADMIN Login', 'User logged in with the role of ADMIN', '2019-02-05 14:07:15'),
(898, 6, 'ADMIN Logout', 'User logged out with the role of ADMIN', '2019-02-05 14:10:51'),
(899, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 14:11:03'),
(900, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-05 14:15:59'),
(901, 6, 'ADMIN Login', 'User logged in with the role of ADMIN', '2019-02-05 14:16:08'),
(902, 6, 'ADMIN Logout', 'User logged out with the role of ADMIN', '2019-02-05 14:17:28'),
(903, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 14:17:34'),
(904, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-05 18:39:42'),
(905, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-09 09:42:47'),
(906, 1, 'Sightseeing Added', 'Sight seeing garden added by SUPERADMIN', '2019-02-09 11:04:32'),
(907, 1, 'Sightseeing Updated', 'Sight seeing garden updated by SUPERADMIN', '2019-02-09 12:01:12'),
(908, 1, 'Sightseeing Updated', 'Sight seeing garden updated by SUPERADMIN', '2019-02-09 13:38:49'),
(909, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-09 15:40:34'),
(910, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-09 15:40:48'),
(911, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus 1) to the route from San Diego to Los Angeles (12:00 AM to 12:10 AM), the departure terminal is Greyhound and arrival terminal is Union Station', '2019-02-09 16:26:32'),
(912, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus 1) to the route from San Diego to San Francisco (12:00 AM to 12:05 AM), the departure terminal is Greyhound and arrival terminal is Salesforce Transit Center', '2019-02-09 16:57:16'),
(913, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus 1) to the route from Los Angeles to Miami (12:05 AM to 12:15 AM), the departure terminal is Union Station and arrival terminal is Miami Port Terminal B-j', '2019-02-09 17:03:23'),
(914, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus 1) to the route from Tampa to Miami (12:10 AM to 12:30 AM), the departure terminal is Marion Transit Center and arrival terminal is Miami Port Terminal B-j', '2019-02-09 17:20:44'),
(915, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus 1) to the route from San Diego to San Francisco (12:05 AM to 12:20 AM), the departure terminal is Greyhound and arrival terminal is Salesforce Transit Center', '2019-02-09 17:41:59'),
(916, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Greyhound and arrival terminal is San Ysidro. The departure Time is(12:05 AM and arrival time is 12:05 AM).', '2019-02-09 17:43:24'),
(917, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Greyhound and arrival terminal is Salesforce Transit Center. The departure Time is(12:05 AM and arrival time is 12:20 AM).', '2019-02-09 17:43:24'),
(918, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is San Ysidro and arrival terminal is Salesforce Transit Center. The departure Time is(12:25 AM and arrival time is 12:20 AM).', '2019-02-09 17:43:24'),
(919, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-09 17:53:27'),
(920, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-09 17:53:39'),
(921, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-09 17:57:24'),
(922, 8, 'ROUTES Login', 'User logged in with the role of ROUTES', '2019-02-09 17:57:36'),
(923, 8, 'ROUTES Logout', 'User logged out with the role of ROUTES', '2019-02-09 19:41:05'),
(924, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-09 19:41:33'),
(925, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-10 08:48:56'),
(926, 1, 'Route Stop Added', 'SUPERADMIN add the route stop. The origin city is Los Angeles (G Shuttle Stop)  and destination city is San Francisco(Salesforce Transit Center). The origin time is (12:10 AM and destination is 12:15 AM).', '2019-02-10 11:05:41'),
(927, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (USERS).', '2019-02-10 12:36:08'),
(928, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (CITIES).', '2019-02-10 12:36:08'),
(929, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSES).', '2019-02-10 12:36:09'),
(930, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTES).', '2019-02-10 12:36:09'),
(931, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (TOURS).', '2019-02-10 12:36:09'),
(932, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (STATES).', '2019-02-10 12:36:09'),
(933, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROLES).', '2019-02-10 12:36:09'),
(934, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Read) access has been given of (COMPANIES).', '2019-02-10 12:36:09'),
(935, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSSTATUS).', '2019-02-10 12:36:09'),
(936, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTETERMINALS).', '2019-02-10 12:36:09'),
(937, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (USERS).', '2019-02-10 12:37:55'),
(938, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (CITIES).', '2019-02-10 12:37:55'),
(939, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSES).', '2019-02-10 12:37:55'),
(940, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTES).', '2019-02-10 12:37:55'),
(941, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (TOURS).', '2019-02-10 12:37:55'),
(942, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (STATES).', '2019-02-10 12:37:55'),
(943, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROLES).', '2019-02-10 12:37:55'),
(944, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Read) access has been given of (COMPANIES).', '2019-02-10 12:37:56'),
(945, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSSTATUS).', '2019-02-10 12:37:56'),
(946, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTETERMINALS).', '2019-02-10 12:37:56'),
(947, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (USERS).', '2019-02-10 12:38:35'),
(948, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (CITIES).', '2019-02-10 12:38:35'),
(949, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSES).', '2019-02-10 12:38:35'),
(950, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTES).', '2019-02-10 12:38:35'),
(951, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (TOURS).', '2019-02-10 12:38:35'),
(952, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (STATES).', '2019-02-10 12:38:36'),
(953, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROLES).', '2019-02-10 12:38:36'),
(954, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Read) access has been given of (COMPANIES).', '2019-02-10 12:38:36'),
(955, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Read) access has been given of (TERMINALS).', '2019-02-10 12:38:36'),
(956, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSSTATUS).', '2019-02-10 12:38:36'),
(957, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTETERMINALS).', '2019-02-10 12:38:36'),
(958, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-12 11:07:54'),
(959, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (CITIES).', '2019-02-12 11:09:58'),
(960, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (BUSES).', '2019-02-12 11:09:58'),
(961, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (ROUTES).', '2019-02-12 11:09:58'),
(962, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-12 11:10:19'),
(963, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (CITIES).', '2019-02-12 11:10:19'),
(964, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (BUSES).', '2019-02-12 11:10:20'),
(965, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (ROUTES).', '2019-02-12 11:10:20'),
(966, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-12 12:03:59'),
(967, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-12 12:06:17'),
(968, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (CITIES).', '2019-02-12 12:06:17'),
(969, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (BUSES).', '2019-02-12 12:06:17'),
(970, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (ROUTES).', '2019-02-12 12:06:17'),
(971, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TOURS).', '2019-02-12 12:06:17'),
(972, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (STATES).', '2019-02-12 12:06:17'),
(973, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-12 12:08:15'),
(974, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (CITIES).', '2019-02-12 12:08:15'),
(975, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (BUSES).', '2019-02-12 12:08:16'),
(976, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (ROUTES).', '2019-02-12 12:08:16'),
(977, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TOURS).', '2019-02-12 12:08:16'),
(978, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (STATES).', '2019-02-12 12:08:16'),
(979, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (COMPANIES).', '2019-02-12 12:08:16'),
(980, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-12 12:10:01'),
(981, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (CITIES).', '2019-02-12 12:10:01'),
(982, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (BUSES).', '2019-02-12 12:10:01'),
(983, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (ROUTES).', '2019-02-12 12:10:01'),
(984, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TOURS).', '2019-02-12 12:10:01'),
(985, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (STATES).', '2019-02-12 12:10:01'),
(986, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (COMPANIES).', '2019-02-12 12:10:01'),
(987, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TERMINALS).', '2019-02-12 12:10:01'),
(988, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-12 12:14:44'),
(989, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-12 17:13:18'),
(990, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (CITIES).', '2019-02-12 17:13:18'),
(991, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-12 17:13:18'),
(992, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-12 17:20:41'),
(993, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-13 08:00:30'),
(994, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-13 08:00:30'),
(995, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-13 08:00:31'),
(996, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-13 08:00:31'),
(997, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-13 09:23:51'),
(998, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-13 09:23:51'),
(999, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-13 10:20:28'),
(1000, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-13 10:20:28'),
(1001, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Write) access has been given of (USERS).', '2019-02-13 10:21:16'),
(1002, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (CITIES).', '2019-02-13 10:21:17'),
(1003, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ROUTES) and (Read) access has been given of (BUSES).', '2019-02-13 10:21:17'),
(1004, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus 2) to the route from Los Angeles to San Diego (12:05 AM to 12:15 AM), the departure terminal is G Shuttle Stop and arrival terminal is San Ysidro', '2019-02-13 10:24:37'),
(1005, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-13 11:57:50'),
(1006, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-13 11:58:10'),
(1007, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-13 13:37:42'),
(1008, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-13 13:37:42'),
(1009, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TOURS).', '2019-02-13 13:37:42'),
(1010, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (STATES).', '2019-02-13 13:37:42'),
(1011, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-13 17:48:00'),
(1012, 11, 'Customer Registration', 'SUPERADMIN registered a customer. The customer user name is (cyber1).', '2019-02-14 09:30:39'),
(1013, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-14 16:27:25'),
(1014, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (BUSES).', '2019-02-14 16:27:25'),
(1015, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TOURS).', '2019-02-14 16:27:25'),
(1016, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (STATES).', '2019-02-14 16:27:25'),
(1017, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-14 16:27:51'),
(1018, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-14 16:27:51'),
(1019, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TOURS).', '2019-02-14 16:27:51'),
(1020, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (STATES).', '2019-02-14 16:27:51'),
(1021, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-14 16:44:13'),
(1022, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-14 16:47:24'),
(1023, 6, 'BARCODESCANNER Logout', 'User logged out with the role of BARCODESCANNER', '2019-02-14 16:47:35'),
(1024, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-14 16:48:00'),
(1025, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-14 16:58:18'),
(1026, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-14 21:23:06'),
(1027, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-14 21:23:34'),
(1028, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-15 12:57:44'),
(1029, 1, 'New State Added', 'SUPERADMIN added a new state (Alabama)', '2019-02-15 13:24:38'),
(1030, 1, 'State Updated', 'SUPERADMIN updated the state (Alabama)', '2019-02-15 13:24:56'),
(1031, 1, 'State Updated', 'SUPERADMIN updated the state (Alabama)', '2019-02-15 13:25:12'),
(1032, 1, 'New City Added', 'SUPERADMIN added a new city (Montgomery)', '2019-02-15 13:26:13'),
(1033, 1, 'City Updated', 'SUPERADMIN updated the city (Montgomery)', '2019-02-15 13:26:41'),
(1034, 1, 'City Updated', 'SUPERADMIN updated the city (Montgomery)', '2019-02-15 13:27:00'),
(1035, 1, 'Terminal Added', 'The terminal (Montgomery Zoo) added to the city (Montgomery) by SUPERADMIN', '2019-02-15 13:32:26'),
(1036, 1, 'Terminal Updated', 'The terminal (Montgomery Zoo) update by the SUPERADMIN. The updated terminal belong to (Montgomery) city.', '2019-02-15 13:32:40'),
(1037, 1, 'Terminal Updated', 'The terminal (Montgomery Zoo) update by the SUPERADMIN. The updated terminal belong to (Montgomery) city.', '2019-02-15 13:32:55'),
(1038, 1, 'Bus Added', 'Flexbux (bus1167877) bus added by SUPERADMIN', '2019-02-15 13:37:44'),
(1039, 1, 'Bus Updated', 'Flexbux (bus1167877) bus updated by SUPERADMIN', '2019-02-15 13:38:34'),
(1040, 1, 'Bus Status Added', 'The bus Status changed to (Arrived) by SUPERADMIN', '2019-02-15 13:39:46'),
(1041, 1, 'Bus Status Updated', ' Bus Status Updated by SUPERADMIN. The current status of bus is Delayed', '2019-02-15 13:40:31'),
(1042, 1, 'Terminal Added', 'The terminal (Williams Museum) added to the city (Montgomery) by SUPERADMIN', '2019-02-15 13:43:00'),
(1043, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus1167877) to the route from Montgomery to Montgomery (12:05 AM to 12:15 AM), the departure terminal is Montgomery Zoo and arrival terminal is Williams Museum', '2019-02-15 13:43:44'),
(1044, 1, 'State Updated', 'SUPERADMIN updated the state (Alabama)', '2019-02-15 13:59:00'),
(1045, 1, 'City Updated', 'SUPERADMIN updated the city (San Francisco)', '2019-02-15 13:59:49'),
(1046, 1, 'City Updated', 'SUPERADMIN updated the city (Montgomery)', '2019-02-15 14:01:17'),
(1047, 1, 'Terminal Updated', 'The terminal (San Ysidro) update by the SUPERADMIN. The updated terminal belong to (San Diego) city.', '2019-02-15 14:32:22'),
(1048, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus1167877) to the route from Los Angeles to Miami (12:05 AM to 12:20 AM), the departure terminal is Union Station and arrival terminal is Omni Terminal', '2019-02-15 15:12:51'),
(1049, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-15 16:18:53'),
(1050, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-15 16:19:06'),
(1051, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-15 16:28:41'),
(1052, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-15 16:28:54'),
(1053, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-15 16:32:35'),
(1054, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-15 16:32:45'),
(1055, 1, 'Sightseeing Updated', 'Sight seeing garden updated by SUPERADMIN', '2019-02-15 18:42:11'),
(1056, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-15 19:59:44'),
(1057, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-15 20:00:35'),
(1058, 6, 'BARCODESCANNER Logout', 'User logged out with the role of BARCODESCANNER', '2019-02-15 20:00:50'),
(1059, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-15 20:01:00'),
(1060, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (USERS).', '2019-02-15 20:03:08'),
(1061, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (CITIES).', '2019-02-15 20:03:08'),
(1062, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSES).', '2019-02-15 20:03:08'),
(1063, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTES).', '2019-02-15 20:03:08'),
(1064, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (TOURS).', '2019-02-15 20:03:08'),
(1065, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (STATES).', '2019-02-15 20:03:08'),
(1066, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROLES).', '2019-02-15 20:03:08'),
(1067, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Read) access has been given of (COMPANIES).', '2019-02-15 20:03:09'),
(1068, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Read) access has been given of (TERMINALS).', '2019-02-15 20:03:09'),
(1069, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BUSSTATUS).', '2019-02-15 20:03:09'),
(1070, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (ROUTETERMINALS).', '2019-02-15 20:03:09'),
(1071, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (ADMIN) and (Write) access has been given of (BOOKINGS).', '2019-02-15 20:03:09'),
(1072, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-15 20:03:22'),
(1073, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-15 20:03:36'),
(1074, 6, 'BARCODESCANNER Logout', 'User logged out with the role of BARCODESCANNER', '2019-02-15 20:03:45'),
(1075, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-15 20:03:59'),
(1076, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (USERS).', '2019-02-15 20:04:42'),
(1077, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BUSES).', '2019-02-15 20:04:42'),
(1078, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (TOURS).', '2019-02-15 20:04:42'),
(1079, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Read) access has been given of (STATES).', '2019-02-15 20:04:43'),
(1080, 1, 'Role Updated With Permissions', 'SUPERADMIN updated the Role (BARCODESCANNER) and (Write) access has been given of (BOOKINGS).', '2019-02-15 20:04:43'),
(1081, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-15 20:04:53'),
(1082, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-15 20:05:08'),
(1083, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-15 20:05:18'),
(1084, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-15 20:05:27'),
(1085, 6, 'BARCODESCANNER Logout', 'User logged out with the role of BARCODESCANNER', '2019-02-15 20:05:58'),
(1086, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-16 10:23:37'),
(1087, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-16 10:26:12'),
(1088, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-16 10:26:25'),
(1089, 1, 'Terminal Added', 'The terminal (Rosa Parks Library) added to the city (Montgomery) by SUPERADMIN', '2019-02-16 10:29:23'),
(1090, 1, 'Terminal Added', 'The terminal (Hank Williams Museum) added to the city (Montgomery) by SUPERADMIN', '2019-02-16 10:29:56'),
(1091, 1, 'Bus Added', 'Tampa Bus (bus 34) bus added by SUPERADMIN', '2019-02-16 10:32:14'),
(1092, 1, 'Route Added', 'SUPERADMIN assigned the bus (bus 34) to the route from Montgomery to Montgomery (12:00 AM to 12:15 AM), the departure terminal is Montgomery Zoo and arrival terminal is Williams Museum', '2019-02-16 10:33:12'),
(1093, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Montgomery Zoo and arrival terminal is Rosa Parks Library. The departure Time is(12:00 AM and arrival time is 12:00 AM).', '2019-02-16 10:34:20'),
(1094, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Montgomery Zoo and arrival terminal is Hank Williams Museum. The departure Time is(12:00 AM and arrival time is 12:15 AM).', '2019-02-16 10:34:20'),
(1095, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Montgomery Zoo and arrival terminal is Williams Museum. The departure Time is(12:00 AM and arrival time is 12:15 AM).', '2019-02-16 10:34:20'),
(1096, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Rosa Parks Library and arrival terminal is Hank Williams Museum. The departure Time is(12:10 AM and arrival time is 12:15 AM).', '2019-02-16 10:34:20');
INSERT INTO `logs` (`id`, `user_id`, `activity`, `note`, `modified`) VALUES
(1097, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Rosa Parks Library and arrival terminal is Williams Museum. The departure Time is(12:10 AM and arrival time is 12:15 AM).', '2019-02-16 10:34:20'),
(1098, 1, 'Route Stops Added', 'SUPERADMIN added the route terminals. The departure terminal is Hank Williams Museum and arrival terminal is Williams Museum. The departure Time is(12:20 AM and arrival time is 12:15 AM).', '2019-02-16 10:34:20'),
(1099, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-16 10:38:17'),
(1100, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-16 10:38:31'),
(1101, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-16 12:34:33'),
(1102, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-16 12:34:47'),
(1103, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-16 12:51:34'),
(1104, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-16 13:25:39'),
(1105, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-16 13:26:02'),
(1106, 6, 'BARCODESCANNER Login', 'User logged in with the role of BARCODESCANNER', '2019-02-16 13:30:43'),
(1107, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-18 10:47:38'),
(1108, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-18 11:07:12'),
(1109, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-18 20:33:06'),
(1110, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-21 10:06:16'),
(1111, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-21 10:06:31'),
(1112, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-21 12:39:35'),
(1113, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-22 14:10:02'),
(1114, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-22 16:13:53'),
(1115, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-22 16:20:57'),
(1116, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-22 16:21:59'),
(1117, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-22 16:23:29'),
(1118, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-22 16:24:05'),
(1119, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-22 16:24:10'),
(1120, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-25 10:41:32'),
(1121, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-25 10:42:16'),
(1122, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-25 10:42:42'),
(1123, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-25 10:43:09'),
(1124, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-25 12:10:56'),
(1125, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-25 12:14:32'),
(1126, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-25 12:14:40'),
(1127, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-25 12:15:30'),
(1128, 1, 'User Added', 'SUPERADMIN added a user (asdasda).', '2019-02-25 12:34:45'),
(1129, 1, 'SUPERADMIN Login', 'User logged in with the role of SUPERADMIN', '2019-02-25 19:08:28'),
(1130, 1, 'SUPERADMIN Logout', 'User logged out with the role of SUPERADMIN', '2019-02-25 19:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `controller` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `controller`) VALUES
(21, 'USERS'),
(22, 'CITIES'),
(23, 'BUSES'),
(24, 'ROUTES'),
(27, 'TOURS'),
(28, 'STATES'),
(29, 'ROLES'),
(30, 'COMPANIES'),
(31, 'TERMINALS'),
(32, 'BUSSTATUS'),
(33, 'ROUTETERMINALS'),
(34, 'BOOKINGS'),
(35, 'SLIDERS');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `payment_type` varchar(222) NOT NULL,
  `status` int(22) NOT NULL,
  `user_id` int(11) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_type`, `status`, `user_id`, `modified`) VALUES
(3, 'CREDIT CARD', 1, 1, '2019-01-11 17:55:54'),
(5, 'DEBIT CARD', 1, 1, '2019-01-13 15:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `id` int(22) NOT NULL,
  `role_id` int(22) NOT NULL,
  `module_id` int(22) NOT NULL,
  `per_type` int(1) NOT NULL,
  `user_id` int(22) NOT NULL,
  `status` int(22) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`id`, `role_id`, `module_id`, `per_type`, `user_id`, `status`, `modified`) VALUES
(190, 1, 21, 2, 1, 1, '2019-02-05 10:11:36'),
(191, 1, 22, 2, 1, 1, '2019-02-05 10:11:36'),
(192, 1, 23, 2, 1, 1, '2019-02-05 10:11:36'),
(193, 1, 24, 2, 1, 1, '2019-02-05 10:11:36'),
(194, 1, 27, 2, 1, 1, '2019-02-05 10:11:36'),
(195, 1, 28, 2, 1, 1, '2019-02-05 10:11:37'),
(196, 1, 29, 2, 1, 1, '2019-02-05 10:11:37'),
(197, 1, 30, 2, 1, 1, '2019-02-05 10:11:37'),
(198, 1, 31, 2, 1, 1, '2019-02-05 10:11:37'),
(199, 1, 32, 2, 1, 1, '2019-02-05 10:11:37'),
(206, 1, 24, 1, 1, 1, '2019-02-05 10:11:36'),
(278, 1, 35, 2, 1, 1, '2019-02-13 10:21:16'),
(279, 8, 22, 1, 1, 1, '2019-02-13 10:21:16'),
(280, 8, 23, 1, 1, 1, '2019-02-13 10:21:17'),
(293, 10, 21, 2, 1, 1, '2019-02-15 20:03:08'),
(294, 10, 22, 2, 1, 1, '2019-02-15 20:03:08'),
(295, 10, 23, 2, 1, 1, '2019-02-15 20:03:08'),
(296, 10, 24, 2, 1, 1, '2019-02-15 20:03:08'),
(297, 10, 27, 2, 1, 1, '2019-02-15 20:03:08'),
(298, 10, 28, 2, 1, 1, '2019-02-15 20:03:08'),
(299, 10, 29, 2, 1, 1, '2019-02-15 20:03:08'),
(300, 10, 30, 1, 1, 1, '2019-02-15 20:03:08'),
(301, 10, 31, 1, 1, 1, '2019-02-15 20:03:09'),
(302, 10, 32, 2, 1, 1, '2019-02-15 20:03:09'),
(303, 10, 33, 2, 1, 1, '2019-02-15 20:03:09'),
(304, 1, 34, 2, 1, 1, '2019-02-15 20:03:09'),
(305, 5, 21, 1, 1, 1, '2019-02-15 20:04:42'),
(306, 5, 23, 2, 1, 1, '2019-02-15 20:04:42'),
(307, 5, 27, 1, 1, 1, '2019-02-15 20:04:42'),
(308, 5, 28, 1, 1, 1, '2019-02-15 20:04:43'),
(309, 5, 34, 2, 1, 1, '2019-02-15 20:04:43'),
(319, 1, 33, 2, 1, 1, '2019-02-05 10:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(10, 'ADMIN'),
(5, 'BARCODESCANNER'),
(8, 'ROUTES'),
(1, 'SUPERADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_alt` varchar(180) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `link` varchar(120) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ordinal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image_alt`, `image`, `modified`, `status`, `link`, `user_id`, `ordinal`) VALUES
(111, 'London', 'London', 'London1549729740.jpg', '2019-02-21 10:24:16', 0, 'http://localhost/bus/bustickets/sliders/add', 1, 3),
(112, 'slider1', 'slider1', 'slider11550744710.jpg', '2019-02-21 10:25:10', 1, 'http://localhost/rahul/pages/gallery', 1, 4),
(113, 'slider2', 'slider2', 'slider21550744752.jpg', '2019-02-21 10:25:52', 1, 'http://localhost/rahul/pages/gallery', 1, 5),
(114, 'slider3', 'slider3', 'slider31550744784.jpg', '2019-02-21 10:26:24', 1, 'http://localhost/rahul/pages/gallery', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `statename` varchar(222) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `statename`, `status`, `user_id`, `modified`) VALUES
(3, 'California', 1, 1, '2019-01-31 16:39:03'),
(4, 'Florida', 1, 1, '2019-02-05 10:00:50'),
(5, 'Alabama', 1, 1, '2019-02-15 13:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `usercompanies`
--

CREATE TABLE `usercompanies` (
  `id` int(22) NOT NULL,
  `user_id` int(22) NOT NULL,
  `company_id` int(22) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usercompanies`
--

INSERT INTO `usercompanies` (`id`, `user_id`, `company_id`, `modified`) VALUES
(2, 8, 1, '2019-02-02 08:52:44'),
(3, 11, 0, '2019-02-25 12:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(22) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `address1` text,
  `address2` text,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` int(20) NOT NULL,
  `profile_image` varchar(120) NOT NULL,
  `phone2` varchar(222) DEFAULT NULL,
  `gender` varchar(22) NOT NULL,
  `user_name` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `status` int(22) NOT NULL,
  `password_reset_token` varchar(222) DEFAULT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `phone1`, `address1`, `address2`, `city`, `state`, `zip`, `profile_image`, `phone2`, `gender`, `user_name`, `password`, `email`, `status`, `password_reset_token`, `modified`) VALUES
(1, 1, 'Cyber', 'Clouds', '813-843-7479', 'tampa, fl, usa', '', 'Tempa', 'FL', 32000, 'muneeb11548242218.png', '111-111-1111', 'MALE', 'cyber', '$2y$10$T7yzXXk7yJXiEr08oKmjnOYjCv0zyYv2OtaG4CxW0wBcLcJrvtytm', 'cybertest@gmail.com', 1, NULL, '2019-01-31 08:47:35'),
(6, 5, 'Abid', 'Admin', '813-843-7479', 'fjksfjd', '', 'Peshawar', 'FL', 12457, 'Abid jdh1548785102.png', '111-111-1111', 'MALE', 'admin', '$2y$10$9SX5TwFVsGXYp4vV4CFfB.oos7faiQjsgz5KHJ8/a6/ZBr7FpeeIG', 'daif@gmail.com', 1, NULL, '2019-02-05 14:06:16'),
(7, 1, 'Sohail', 'Khan', '111-111-1111', 'djfskf', 'jfdsdf', 'Tempa', 'FL', 12457, 'Sohail1548785533.png', '124-748-4578', 'MALE', 'cyberdas', '$2y$10$7PJixf.kgQsXo90iC9/DTu8ZsRqRU7w0uYAKpzTqEhecb3b9NR1OS', 'cyberclouds@gmail.com', 1, NULL, '2019-01-31 10:29:43'),
(8, 8, 'Route', 'Access', '813-843-7479', 'dfjdskjfsa', 'peshaw', 'Peshawar', 'FL', 25000, 'route1548785612.png', '', 'MALE', 'route', '$2y$10$9SX5TwFVsGXYp4vV4CFfB.oos7faiQjsgz5KHJ8/a6/ZBr7FpeeIG', 'saif@gmail.com', 1, NULL, '2019-01-31 10:26:50'),
(9, 2, 'John One', 'Admin', '111-111-1111', 'pesh', 'pesha', 'Peshawar', 'AK', 12457, 'John one1548930213.png', '111-111-1111', 'MALE', 'abc', '$2y$10$vO.VJlXaXPKNxEawOEofbOjeXlBzy7djrWF5xydUiOnwKVie0PF7W', 'abc@gmail.com', 1, NULL, '2019-01-31 10:23:33'),
(10, 3, 'Customer', 'Khan', '813-843-7479', 'jfdskjf', 'sdfjskajk', 'Peshawar', 'AR', 25000, 'customer1548930977.png', '111-111-1111', 'MALE', 'customer', '$2y$10$5bQ50O4SomEvJaj6aIH7tuzZZ84MMQGwmbp4gtdl5wRx/Rg69zYnK', 'customer@gmail.com', 1, NULL, '2019-01-31 10:44:53'),
(11, 5, 'Msds', 'Asdas', '111-111-1111', 'kakasdddddkask', '', 'Rawalpindi', 'DE', 25000, 'msds1551098084.jpg', '', 'MALE', 'asdasda', '$2y$10$Ze11PrKhVBjYW/h8aEls3eEKth4xmR8LPnEt3nX0sLGWwYtUalxRy', 'asd@fddf.dfd', 1, NULL, '2019-02-25 12:34:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `names` (`names`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_logs_user_id` (`user_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_type` (`payment_type`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_slider_user_id` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usercompanies`
--
ALTER TABLE `usercompanies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1131;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usercompanies`
--
ALTER TABLE `usercompanies`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
