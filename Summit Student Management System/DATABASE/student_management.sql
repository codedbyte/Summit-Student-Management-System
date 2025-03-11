-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 11:25 AM
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
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

CREATE TABLE `academics` (
  `id` int(11) NOT NULL,
  `form` varchar(10) NOT NULL,
  `admission_number` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `term` enum('Term 1','Term 2','Term 3') NOT NULL,
  `exam` enum('Exam 1','Exam 2','Exam 3') NOT NULL,
  `grade` enum('A','B','C','D','E') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academics`
--

INSERT INTO `academics` (`id`, `form`, `admission_number`, `first_name`, `last_name`, `year`, `term`, `exam`, `grade`, `created_at`) VALUES
(1, 'form2', '802', '', '', 2024, 'Term 2', 'Exam 1', 'B', '2024-08-14 23:14:31'),
(2, 'form2', '802', '', '', 2024, 'Term 2', 'Exam 1', 'B', '2024-08-14 23:16:49'),
(3, 'form1', '1003', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-14 23:19:10'),
(4, 'form3', '601', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-14 23:29:35'),
(5, 'form2', '801', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-15 11:46:37'),
(6, 'form2', '802', '', '', 2024, 'Term 1', 'Exam 1', 'B', '2024-08-15 11:46:44'),
(7, 'form2', '803', '', '', 2024, 'Term 1', 'Exam 1', 'C', '2024-08-15 11:46:50'),
(8, 'form2', '804', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-15 11:46:56'),
(9, 'form2', '805', '', '', 2024, 'Term 1', 'Exam 1', 'C', '2024-08-15 11:47:02'),
(10, 'form2', '806', '', '', 2024, 'Term 1', 'Exam 1', 'D', '2024-08-15 11:47:08'),
(11, 'form1', '1003', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-15 11:47:53'),
(12, 'form1', '1004', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-15 11:47:58'),
(13, 'form1', '1005', '', '', 2024, 'Term 1', 'Exam 1', 'B', '2024-08-15 11:48:03'),
(14, 'form1', '1007', '', '', 2024, 'Term 1', 'Exam 1', 'B', '2024-08-15 11:48:08'),
(15, 'form1', '1008', '', '', 2024, 'Term 1', 'Exam 1', 'C', '2024-08-15 11:48:13'),
(16, 'form1', '1009', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-15 11:48:18'),
(17, 'form4', '401', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-15 11:49:12'),
(18, 'form4', '602', '', '', 2024, 'Term 1', 'Exam 1', 'B', '2024-08-15 11:49:19'),
(19, 'form1', '1004', '', '', 2024, 'Term 2', 'Exam 1', 'A', '2024-08-15 23:20:30'),
(20, 'form3', '601', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-18 05:02:44'),
(21, 'form3', '603', '', '', 2024, 'Term 1', 'Exam 1', 'B', '2024-08-18 05:02:49'),
(22, 'form3', '605', '', '', 2024, 'Term 1', 'Exam 1', 'A', '2024-08-18 05:02:53'),
(23, 'form3', '610', '', '', 2024, 'Term 1', 'Exam 1', 'E', '2024-08-18 05:02:58'),
(24, 'form3', '611', '', '', 2024, 'Term 1', 'Exam 1', 'C', '2024-08-18 05:03:02'),
(25, 'form3', '612', '', '', 2024, 'Term 1', 'Exam 1', 'B', '2024-08-18 05:03:06'),
(26, 'form3', '614', '', '', 2024, 'Term 1', 'Exam 1', 'D', '2024-08-18 05:03:11'),
(27, 'form3', '616', '', '', 2024, 'Term 1', 'Exam 1', 'D', '2024-08-18 05:03:14'),
(28, 'form1', '1003', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:15:58'),
(29, 'form1', '1004', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:16:01'),
(30, 'form1', '1005', '', '', 2024, 'Term 3', 'Exam 1', 'B', '2024-08-23 08:16:05'),
(31, 'form1', '1007', '', '', 2024, 'Term 3', 'Exam 1', 'B', '2024-08-23 08:16:09'),
(32, 'form1', '1008', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:16:16'),
(33, 'form2', '801', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:16:24'),
(34, 'form2', '802', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:16:32'),
(35, 'form2', '803', '', '', 2024, 'Term 3', 'Exam 1', 'B', '2024-08-23 08:16:43'),
(36, 'form2', '804', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:16:52'),
(37, 'form2', '805', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:16:57'),
(38, 'form2', '806', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:17:00'),
(39, 'form3', '601', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:17:04'),
(40, 'form3', '603', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:17:07'),
(41, 'form3', '605', '', '', 2024, 'Term 3', 'Exam 1', 'B', '2024-08-23 08:17:12'),
(42, 'form3', '610', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:17'),
(43, 'form3', '611', '', '', 2024, 'Term 3', 'Exam 1', 'A', '2024-08-23 08:17:21'),
(44, 'form3', '612', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:26'),
(45, 'form3', '614', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:29'),
(46, 'form3', '616', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:33'),
(47, 'form4', '401', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:39'),
(48, 'form4', '602', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:44'),
(49, 'form4', '1020', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:47'),
(50, 'form4', '1020', '', '', 2024, 'Term 3', 'Exam 1', 'C', '2024-08-23 08:17:48'),
(51, 'form1', '1004', '', '', 2024, 'Term 1', 'Exam 2', 'D', '2024-09-03 08:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `admission_number` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL,
  `comments` text DEFAULT NULL,
  `form` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `admission_number`, `date`, `status`, `comments`, `form`) VALUES
(2, '1004', '2024-08-15', 'Present', '', 'form1'),
(3, '1005', '2024-08-15', 'Present', '', 'form1'),
(4, '1007', '2024-08-15', 'Present', '', 'form1'),
(5, '1008', '2024-08-15', 'Present', '', 'form1'),
(9, '803', '2024-08-15', 'Present', '', 'form2'),
(10, '804', '2024-08-15', 'Present', '', 'form2'),
(11, '805', '2024-08-15', 'Present', '', 'form2'),
(12, '806', '2024-08-15', 'Present', '', 'form2'),
(14, '603', '2024-08-15', 'Present', '', 'form3'),
(15, '605', '2024-08-15', 'Present', '', 'form3'),
(17, '602', '2024-08-15', 'Present', '', 'form4'),
(19, '1004', '2024-08-15', 'Present', '', 'form1'),
(20, '1005', '2024-08-15', 'Present', '', 'form1'),
(21, '1007', '2024-08-15', 'Present', '', 'form1'),
(22, '1008', '2024-08-15', 'Present', '', 'form1'),
(26, '803', '2024-08-15', 'Present', '', 'form2'),
(27, '804', '2024-08-15', 'Present', '', 'form2'),
(28, '805', '2024-08-15', 'Present', '', 'form2'),
(29, '806', '2024-08-15', 'Present', '', 'form2'),
(31, '603', '2024-08-15', 'Present', '', 'form3'),
(32, '605', '2024-08-15', 'Present', '', 'form3'),
(34, '602', '2024-08-15', 'Present', '', 'form4'),
(36, '1004', '2024-08-15', 'Present', '', 'form1'),
(37, '1005', '2024-08-15', 'Absent', '', 'form1'),
(38, '1007', '2024-08-15', 'Present', '', 'form1'),
(39, '1008', '2024-08-15', 'Present', '', 'form1'),
(43, '803', '2024-08-15', 'Absent', '', 'form2'),
(44, '804', '2024-08-15', 'Present', '', 'form2'),
(45, '805', '2024-08-15', 'Present', '', 'form2'),
(46, '806', '2024-08-15', 'Present', '', 'form2'),
(48, '603', '2024-08-15', 'Present', '', 'form3'),
(49, '605', '2024-08-15', 'Present', '', 'form3'),
(51, '602', '2024-08-15', 'Present', '', 'form4'),
(53, '1004', '2024-08-15', 'Present', '', 'form1'),
(54, '1005', '2024-08-15', 'Present', '', 'form1'),
(55, '1007', '2024-08-15', 'Present', '', 'form1'),
(56, '1008', '2024-08-15', 'Present', '', 'form1'),
(60, '803', '2024-08-15', 'Present', '', 'form2'),
(61, '804', '2024-08-15', 'Present', '', 'form2'),
(62, '805', '2024-08-15', 'Present', '', 'form2'),
(63, '806', '2024-08-15', 'Present', '', 'form2'),
(65, '603', '2024-08-15', 'Present', '', 'form3'),
(66, '605', '2024-08-15', 'Present', '', 'form3'),
(68, '602', '2024-08-15', 'Present', '', 'form4'),
(70, '1004', '2024-08-15', 'Present', '', 'form1'),
(71, '1005', '2024-08-15', 'Present', '', 'form1'),
(72, '1007', '2024-08-15', 'Present', '', 'form1'),
(73, '1008', '2024-08-15', 'Present', '', 'form1'),
(77, '803', '2024-08-15', 'Present', '', 'form2'),
(78, '804', '2024-08-15', 'Present', '', 'form2'),
(79, '805', '2024-08-15', 'Present', '', 'form2'),
(80, '806', '2024-08-15', 'Present', '', 'form2'),
(82, '603', '2024-08-15', 'Present', '', 'form3'),
(83, '605', '2024-08-15', 'Present', '', 'form3'),
(85, '602', '2024-08-15', 'Present', '', 'form4'),
(87, '1004', '2024-08-15', 'Present', '', 'form1'),
(88, '1005', '2024-08-15', 'Present', '', 'form1'),
(89, '1007', '2024-08-15', 'Present', '', 'form1'),
(90, '1008', '2024-08-15', 'Present', '', 'form1'),
(94, '803', '2024-08-15', 'Present', '', 'form2'),
(95, '804', '2024-08-15', 'Present', '', 'form2'),
(96, '805', '2024-08-15', 'Present', '', 'form2'),
(97, '806', '2024-08-15', 'Present', '', 'form2'),
(99, '603', '2024-08-15', 'Present', '', 'form3'),
(100, '605', '2024-08-15', 'Present', '', 'form3'),
(102, '602', '2024-08-15', 'Present', '', 'form4'),
(104, '1004', '2024-08-15', 'Present', '', 'form1'),
(105, '1005', '2024-08-15', 'Present', '', 'form1'),
(106, '1007', '2024-08-15', 'Present', '', 'form1'),
(107, '1008', '2024-08-15', 'Present', '', 'form1'),
(111, '803', '2024-08-15', 'Present', '', 'form2'),
(112, '804', '2024-08-15', 'Present', '', 'form2'),
(113, '805', '2024-08-15', 'Present', '', 'form2'),
(114, '806', '2024-08-15', 'Present', '', 'form2'),
(116, '603', '2024-08-15', 'Present', '', 'form3'),
(117, '605', '2024-08-15', 'Present', '', 'form3'),
(119, '602', '2024-08-15', 'Present', '', 'form4'),
(121, '1004', '2024-08-15', 'Present', '', 'form1'),
(122, '1005', '2024-08-15', 'Present', '', 'form1'),
(123, '1007', '2024-08-15', 'Present', '', 'form1'),
(124, '1008', '2024-08-15', 'Present', '', 'form1'),
(128, '803', '2024-08-15', 'Present', '', 'form2'),
(129, '804', '2024-08-15', 'Present', '', 'form2'),
(130, '805', '2024-08-15', 'Present', '', 'form2'),
(131, '806', '2024-08-15', 'Present', '', 'form2'),
(133, '603', '2024-08-15', 'Present', '', 'form3'),
(134, '605', '2024-08-15', 'Present', '', 'form3'),
(136, '602', '2024-08-15', 'Present', '', 'form4'),
(138, '1004', '2024-08-16', 'Present', '', 'form1'),
(139, '1005', '2024-08-16', 'Absent', '', 'form1'),
(140, '1007', '2024-08-16', 'Present', '', 'form1'),
(141, '1008', '2024-08-16', 'Absent', '', 'form1'),
(145, '803', '2024-08-16', 'Present', '', 'form2'),
(146, '804', '2024-08-16', 'Present', '', 'form2'),
(147, '805', '2024-08-16', 'Absent', '', 'form2'),
(148, '806', '2024-08-16', 'Present', '', 'form2'),
(150, '603', '2024-08-16', 'Present', '', 'form3'),
(151, '605', '2024-08-16', 'Absent', '', 'form3'),
(152, '610', '2024-08-16', 'Present', '', 'form3'),
(153, '611', '2024-08-16', 'Absent', '', 'form3'),
(154, '612', '2024-08-16', 'Present', '', 'form3'),
(156, '602', '2024-08-16', 'Present', '', 'form4'),
(158, '1004', '2024-08-18', 'Present', '', 'form1'),
(159, '1005', '2024-08-18', 'Present', '', 'form1'),
(160, '1007', '2024-08-18', 'Present', '', 'form1'),
(161, '1008', '2024-08-18', 'Present', '', 'form1'),
(165, '803', '2024-08-18', 'Present', '', 'form2'),
(166, '804', '2024-08-18', 'Absent', '', 'form2'),
(167, '805', '2024-08-18', 'Present', '', 'form2'),
(168, '806', '2024-08-18', 'Present', '', 'form2'),
(170, '603', '2024-08-18', 'Present', '', 'form3'),
(171, '605', '2024-08-18', 'Present', '', 'form3'),
(172, '610', '2024-08-18', 'Absent', '', 'form3'),
(173, '611', '2024-08-18', 'Present', '', 'form3'),
(174, '612', '2024-08-18', 'Present', '', 'form3'),
(175, '614', '2024-08-18', 'Present', '', 'form3'),
(176, '616', '2024-08-18', 'Present', '', 'form3'),
(178, '602', '2024-08-18', 'Present', '', 'form4'),
(179, '1020', '2024-08-18', 'Present', '', 'form4'),
(181, '1004', '2024-08-18', 'Present', '', 'form1'),
(182, '1005', '2024-08-18', 'Present', '', 'form1'),
(183, '1007', '2024-08-18', 'Present', '', 'form1'),
(184, '1008', '2024-08-18', 'Present', '', 'form1'),
(188, '803', '2024-08-18', 'Present', '', 'form2'),
(189, '804', '2024-08-18', 'Absent', '', 'form2'),
(190, '805', '2024-08-18', 'Present', '', 'form2'),
(191, '806', '2024-08-18', 'Present', '', 'form2'),
(193, '603', '2024-08-18', 'Present', '', 'form3'),
(194, '605', '2024-08-18', 'Present', '', 'form3'),
(195, '610', '2024-08-18', 'Absent', '', 'form3'),
(196, '611', '2024-08-18', 'Present', '', 'form3'),
(197, '612', '2024-08-18', 'Present', '', 'form3'),
(198, '614', '2024-08-18', 'Present', '', 'form3'),
(199, '616', '2024-08-18', 'Present', '', 'form3'),
(201, '602', '2024-08-18', 'Present', '', 'form4'),
(202, '1020', '2024-08-18', 'Present', '', 'form4'),
(204, '1004', '2024-08-18', 'Present', '', 'form1'),
(205, '1005', '2024-08-18', 'Present', '', 'form1'),
(206, '1007', '2024-08-18', 'Present', '', 'form1'),
(207, '1008', '2024-08-18', 'Present', '', 'form1'),
(211, '803', '2024-08-18', 'Present', '', 'form2'),
(212, '804', '2024-08-18', 'Present', '', 'form2'),
(213, '805', '2024-08-18', 'Present', '', 'form2'),
(214, '806', '2024-08-18', 'Present', '', 'form2'),
(216, '603', '2024-08-18', 'Present', '', 'form3'),
(217, '605', '2024-08-18', 'Present', '', 'form3'),
(218, '610', '2024-08-18', 'Present', '', 'form3'),
(219, '611', '2024-08-18', 'Present', '', 'form3'),
(220, '612', '2024-08-18', 'Present', '', 'form3'),
(221, '614', '2024-08-18', 'Present', '', 'form3'),
(222, '616', '2024-08-18', 'Present', '', 'form3'),
(224, '602', '2024-08-18', 'Present', '', 'form4'),
(225, '1020', '2024-08-18', 'Present', '', 'form4'),
(227, '1004', '2024-08-23', 'Present', '', 'form1'),
(228, '1005', '2024-08-23', 'Present', '', 'form1'),
(229, '1007', '2024-08-23', 'Present', '', 'form1'),
(230, '1008', '2024-08-23', 'Present', '', 'form1'),
(234, '803', '2024-08-23', 'Present', '', 'form2'),
(235, '804', '2024-08-23', 'Present', '', 'form2'),
(236, '805', '2024-08-23', 'Present', '', 'form2'),
(237, '806', '2024-08-23', 'Present', '', 'form2'),
(239, '603', '2024-08-23', 'Present', '', 'form3'),
(240, '605', '2024-08-23', 'Present', '', 'form3'),
(241, '610', '2024-08-23', 'Present', '', 'form3'),
(242, '611', '2024-08-23', 'Present', '', 'form3'),
(243, '612', '2024-08-23', 'Present', '', 'form3'),
(244, '614', '2024-08-23', 'Present', '', 'form3'),
(245, '616', '2024-08-23', 'Present', '', 'form3'),
(247, '602', '2024-08-23', 'Present', '', 'form4'),
(248, '1020', '2024-08-23', 'Present', '', 'form4'),
(249, '1004', '2024-09-03', 'Present', '', 'form1'),
(250, '1005', '2024-09-03', 'Absent', '', 'form1'),
(251, '1007', '2024-09-03', 'Present', '', 'form1'),
(252, '1008', '2024-09-03', 'Present', '', 'form1'),
(253, '1060', '2024-09-03', 'Present', '', 'form1'),
(254, '602', '2024-09-03', 'Present', '', 'form4'),
(255, '1020', '2024-09-03', 'Present', '', 'form4'),
(256, '803', '2024-09-03', 'Present', '', 'form2'),
(257, '804', '2024-09-03', 'Absent', '', 'form2'),
(258, '805', '2024-09-03', 'Present', '', 'form2'),
(259, '806', '2024-09-03', 'Present', '', 'form2'),
(260, '603', '2024-09-03', 'Present', '', 'form3'),
(261, '605', '2024-09-03', 'Present', '', 'form3'),
(262, '610', '2024-09-03', 'Present', '', 'form3'),
(263, '611', '2024-09-03', 'Absent', '', 'form3'),
(264, '612', '2024-09-03', 'Present', '', 'form3'),
(265, '614', '2024-09-03', 'Present', '', 'form3'),
(266, '616', '2024-09-03', 'Present', '', 'form3'),
(267, '1004', '2024-09-03', 'Present', '', 'form1'),
(268, '1005', '2024-09-03', 'Absent', '', 'form1'),
(269, '1007', '2024-09-03', 'Present', '', 'form1'),
(270, '1008', '2024-09-03', 'Present', '', 'form1'),
(271, '1060', '2024-09-03', 'Present', '', 'form1'),
(272, '602', '2024-09-03', 'Present', '', 'form4'),
(273, '1020', '2024-09-03', 'Present', '', 'form4'),
(274, '803', '2024-09-03', 'Present', '', 'form2'),
(275, '804', '2024-09-03', 'Absent', '', 'form2'),
(276, '805', '2024-09-03', 'Present', '', 'form2'),
(277, '806', '2024-09-03', 'Present', '', 'form2'),
(278, '603', '2024-09-03', 'Present', '', 'form3'),
(279, '605', '2024-09-03', 'Present', '', 'form3'),
(280, '610', '2024-09-03', 'Present', '', 'form3'),
(281, '611', '2024-09-03', 'Absent', '', 'form3'),
(282, '612', '2024-09-03', 'Present', '', 'form3'),
(283, '614', '2024-09-03', 'Present', '', 'form3'),
(284, '616', '2024-09-03', 'Present', '', 'form3');

-- --------------------------------------------------------

--
-- Table structure for table `form1`
--

CREATE TABLE `form1` (
  `id` int(11) NOT NULL,
  `admission_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `subject_average` float NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `notify_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `notify_date`, `created_at`) VALUES
(1, 'Upcoming Math Contest', 'Math Contest to be held at Kapsabet High School', '2024-08-31', '2024-08-16 19:54:30'),
(2, 'Drama Event', 'A drama function is to be held at our school', '2024-09-07', '2024-08-16 19:57:06'),
(4, 'Principals Day', 'A day to celebrate our school Principal', '2024-09-13', '2024-08-16 20:18:48'),
(5, 'Closing Day', 'End of Year Closing Day', '2024-10-30', '2024-08-16 20:25:41'),
(6, 'Opening Day 2025', 'Opening Day Term 1 2025', '2025-01-06', '2024-08-16 20:32:06'),
(7, 'Sports Day', 'A day to have sports Hosted at the school', '2024-09-04', '2024-09-03 08:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `admission_number` varchar(50) NOT NULL,
  `form` enum('form1','form2','form3','form4') NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `dob`, `gender`, `email`, `phone`, `address`, `admission_number`, `form`, `comments`, `created_at`) VALUES
(17, 'Travis', 'Scott', '2010-03-01', 'male', 'travisscott@gmail.com', '0765432109', 'P.O BOX 7865 MOMBASA', '1004', 'form1', '', '2024-08-13 23:02:24'),
(18, 'Luis', 'Hamigton', '2005-07-15', 'male', 'luishamington@gmail.com', '0729345678', 'P.O BOX 9082 KISUMU', '602', 'form4', '', '2024-08-15 10:07:36'),
(19, 'Precious', 'Leslie', '2009-06-12', 'female', 'preciousleslie@gmail.com', '0798765792', 'P.O BOX 8976 KITUI', '1005', 'form1', '', '2024-08-15 11:31:00'),
(20, 'James', 'Kibet', '2009-06-08', 'male', 'jameskibet0823@gmail.com', '0710786534', 'P.O BOX 8096', '1007', 'form1', '', '2024-08-15 11:32:08'),
(23, 'Chris', 'Brown', '2009-01-12', 'male', 'chrisbrown75@gmail.com', '0798124577', 'P.O BOX 6789', '1008', 'form1', '', '2024-08-15 11:33:58'),
(25, 'Raila', 'Odinga', '2008-07-15', 'male', 'railaodingajr@gmail.com', '0789765423', 'P.O BOX 1254 NYANZA', '803', 'form2', '', '2024-08-15 11:37:20'),
(26, 'Precious', 'Chala', '2008-05-15', 'female', 'preciouschala096@gmail.com', '0792030853', 'P.O BOX 12378 WAJIR', '804', 'form2', '', '2024-08-15 11:38:43'),
(27, 'Kabaka', 'Chala', '2008-05-15', 'male', 'kabakachala096@gmail.com', '0792030853', 'P.O BOX 12378 WAJIR', '805', 'form2', '', '2024-08-15 11:39:07'),
(28, 'Ester', 'Malala', '2008-05-15', 'female', 'esthermalala6@gmail.com', '07920300212', 'P.O BOX 1237 WESTERN', '806', 'form2', '', '2024-08-15 11:39:47'),
(30, 'Geofreh', 'Lohausie', '2007-06-15', 'male', 'geofrehjeff12@gmail.com', '0789212345', 'P.O BOX 1456 KITALE', '603', 'form3', '', '2024-08-15 11:41:45'),
(31, 'Martha', 'Kwamboka', '2007-06-15', 'male', 'marthakwamboka@gmail.com', '07123243422', 'P.O BOX 1456 KITALE', '605', 'form3', '', '2024-08-15 11:42:26'),
(40, 'Daisy', 'Beckka', '2007-05-04', 'other', 'daisybeckka@gmail.com', '0788923456', 'P.O BOX 7865 KISSI', '610', 'form3', '', '2024-08-16 19:14:27'),
(42, 'Chris', 'Wekesa', '2007-06-16', 'male', 'chriswekesa12@gmail.com', '0789213456', 'P.O BOX 1245 MOMBASA', '611', 'form3', '', '2024-08-16 19:16:00'),
(60, 'Kevin', 'Kibet', '2007-02-16', 'male', 'kevinkibet21@gmail.com', '0719345687', 'P.O BOX 1679 LAIKIPIA', '612', 'form3', '', '2024-08-16 19:18:19'),
(67, 'Kevin', 'Luis', '2009-02-13', 'male', 'kevinluis@gmail.com', '0789721241', 'P.O BOX 8902 LIMURU', '614', 'form3', '', '2024-08-16 19:24:35'),
(79, 'Leah', 'Muthoni', '2006-02-16', 'female', 'leahmuthoni@gmail.com', '0712345679', 'P.O BOX 8912 GILGIL', '616', 'form3', '', '2024-08-16 19:31:05'),
(80, 'Azziad', 'Nasenya', '2006-03-16', 'female', 'azziadnasenya@gmail.com', '0798564234', 'P.O BOX 1243 NAIROBI', '1020', 'form4', '', '2024-08-16 19:37:22'),
(82, 'Lupiter', 'Nyongo', '2005-09-13', 'female', 'lupiternyongo@gmail.com', '0756456789', 'P.O BOX Westlands, Nairobi', '1060', 'form1', '', '2024-09-03 08:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone_number`, `password`, `confirm_password`) VALUES
(2, 'James', 'Robin', 'admin', 'admin@gmail.com', '0729378447', '$2y$10$WYhd0OJWGAb1vx8BpMFB..RmRRVV9iTrl//qIXSTD0tqxNQoqfTza', ''),
(3, 'James', 'Bond', 'james', 'jamesbond@gmail.com', '0789123455', '$2y$10$2Lc77PPPUDlIy45AHCAo/uKLcZ6ut0OM7seFuzgT2VRZ0UJavcj0i', ''),
(4, 'Eric', 'Omondi', 'eric', 'ericomondi@gmail.com', '0710987654', '$2y$10$Hr8W4IBxMvPhazuThQoQG.7MKtiZcwMdxUpbPYXtVFXKolEwD4BMe', ''),
(5, 'James', 'Peter', 'jamespeter', 'jamespeter@gmail.com', '07897654234', '$2y$10$Cm3JrEcJMqDm1A2I9B/qt.typdf8olv2tybnPkStqdzu56VSQyohG', ''),
(6, 'Kevin', 'Peter', 'kevinpeter', 'kevinpeter@gmail.com', '0789654324', '$2y$10$xggGsBLpwAVoXREpVd01Z.HSXceiAC0rOChTQgy/qW0Uxt9RkTsxa', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academics`
--
ALTER TABLE `academics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_number` (`admission_number`);

--
-- Indexes for table `form1`
--
ALTER TABLE `form1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admission_number` (`admission_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academics`
--
ALTER TABLE `academics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT for table `form1`
--
ALTER TABLE `form1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`admission_number`) REFERENCES `students` (`admission_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
