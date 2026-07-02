-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2026 at 05:39 AM
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
-- Database: `psa-sec`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` date NOT NULL,
  `time_in` timestamp NULL DEFAULT NULL,
  `time_out` timestamp NULL DEFAULT NULL,
  `total_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `overtime_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('Pending','Present','Absent','Late','Half Day - VL','Half Day - SL','Vacation Leave','Sick Leave','Regular Holiday','Special Non-Working Holiday') NOT NULL DEFAULT 'Pending',
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `attendance_date`, `time_in`, `time_out`, `total_hours`, `overtime_hours`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-06-01', '2026-06-01 01:00:00', '2026-06-01 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(2, 2, '2026-06-01', '2026-06-01 01:00:00', '2026-06-01 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(3, 3, '2026-06-01', '2026-06-01 01:00:00', '2026-06-01 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(4, 4, '2026-06-01', '2026-06-01 01:00:00', '2026-06-01 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(5, 5, '2026-06-01', '2026-06-01 01:00:00', '2026-06-01 16:00:00', 15.00, 7.00, 'Regular Holiday', '', '2026-06-10 02:08:55', '2026-06-10 02:09:28'),
(6, 6, '2026-06-01', '2026-06-01 01:00:00', '2026-06-01 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(7, 1, '2026-06-02', '2026-06-02 01:00:00', '2026-06-02 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(8, 2, '2026-06-02', '2026-06-02 01:00:00', '2026-06-02 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(9, 3, '2026-06-02', '2026-06-02 01:00:00', '2026-06-02 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(10, 4, '2026-06-02', '2026-06-02 01:00:00', '2026-06-02 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(11, 5, '2026-06-02', '2026-06-02 01:00:00', '2026-06-02 15:00:00', 14.00, 6.00, 'Present', '', '2026-06-10 02:08:55', '2026-06-10 02:09:35'),
(12, 6, '2026-06-02', '2026-06-02 01:00:00', '2026-06-02 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(13, 1, '2026-06-03', '2026-06-03 01:00:00', '2026-06-03 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(14, 2, '2026-06-03', '2026-06-03 01:00:00', '2026-06-03 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(15, 3, '2026-06-03', '2026-06-03 01:00:00', '2026-06-03 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(16, 4, '2026-06-03', '2026-06-03 01:00:00', '2026-06-03 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(17, 5, '2026-06-03', '2026-06-03 01:00:00', '2026-06-03 14:30:00', 13.50, 5.50, 'Special Non-Working Holiday', '', '2026-06-10 02:08:55', '2026-06-10 02:09:47'),
(18, 6, '2026-06-03', '2026-06-03 01:00:00', '2026-06-03 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(19, 1, '2026-06-04', '2026-06-04 01:00:00', '2026-06-04 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(20, 2, '2026-06-04', '2026-06-04 01:00:00', '2026-06-04 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(21, 3, '2026-06-04', '2026-06-04 01:00:00', '2026-06-04 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(22, 4, '2026-06-04', '2026-06-04 01:00:00', '2026-06-04 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(23, 5, '2026-06-04', '2026-06-04 01:00:00', '2026-06-04 09:00:00', 8.00, 0.00, 'Vacation Leave', '', '2026-06-10 02:08:55', '2026-06-10 02:10:52'),
(24, 6, '2026-06-04', '2026-06-04 01:00:00', '2026-06-04 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(25, 1, '2026-06-05', '2026-06-05 01:00:00', '2026-06-05 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(26, 2, '2026-06-05', '2026-06-05 01:00:00', '2026-06-05 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(27, 3, '2026-06-05', '2026-06-05 01:00:00', '2026-06-05 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(28, 4, '2026-06-05', '2026-06-05 01:00:00', '2026-06-05 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(29, 5, '2026-06-05', '2026-06-05 01:00:00', '2026-06-05 09:00:00', 8.00, 0.00, 'Sick Leave', '', '2026-06-10 02:08:55', '2026-06-10 02:10:55'),
(30, 6, '2026-06-05', '2026-06-05 01:00:00', '2026-06-05 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(31, 1, '2026-06-08', '2026-06-08 01:00:00', '2026-06-08 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(32, 2, '2026-06-08', '2026-06-08 01:00:00', '2026-06-08 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(33, 3, '2026-06-08', '2026-06-08 01:00:00', '2026-06-08 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(34, 4, '2026-06-08', '2026-06-08 01:00:00', '2026-06-08 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(35, 5, '2026-06-08', '2026-06-08 01:00:00', '2026-06-08 09:00:00', 8.00, 0.00, 'Vacation Leave', '', '2026-06-10 02:08:55', '2026-06-10 02:11:01'),
(36, 6, '2026-06-08', '2026-06-08 01:00:00', '2026-06-08 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(37, 1, '2026-06-09', '2026-06-09 01:00:00', '2026-06-09 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(38, 2, '2026-06-09', '2026-06-09 01:00:00', '2026-06-09 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(39, 3, '2026-06-09', '2026-06-09 01:00:00', '2026-06-09 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(40, 4, '2026-06-09', '2026-06-09 01:00:00', '2026-06-09 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(41, 5, '2026-06-09', '2026-06-09 01:00:00', '2026-06-09 09:00:00', 8.00, 0.00, 'Half Day - VL', '', '2026-06-10 02:08:55', '2026-06-10 02:21:32'),
(42, 6, '2026-06-09', '2026-06-09 01:00:00', '2026-06-09 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(49, 1, '2026-06-11', '2026-06-11 01:00:00', '2026-06-11 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(50, 2, '2026-06-11', '2026-06-11 01:00:00', '2026-06-11 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(51, 3, '2026-06-11', '2026-06-11 01:00:00', '2026-06-11 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(52, 4, '2026-06-11', '2026-06-11 01:00:00', '2026-06-11 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(53, 5, '2026-06-11', '2026-06-11 01:00:00', '2026-06-11 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(54, 6, '2026-06-11', '2026-06-11 01:00:00', '2026-06-11 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(55, 1, '2026-06-12', '2026-06-12 01:00:00', '2026-06-12 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(56, 2, '2026-06-12', '2026-06-12 01:00:00', '2026-06-12 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(57, 3, '2026-06-12', '2026-06-12 01:00:00', '2026-06-12 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(58, 4, '2026-06-12', '2026-06-12 01:00:00', '2026-06-12 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(59, 5, '2026-06-12', '2026-06-12 01:00:00', '2026-06-12 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(60, 6, '2026-06-12', '2026-06-12 01:00:00', '2026-06-12 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(61, 1, '2026-06-15', '2026-06-15 01:00:00', '2026-06-15 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(62, 2, '2026-06-15', '2026-06-15 01:00:00', '2026-06-15 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(63, 3, '2026-06-15', '2026-06-15 01:00:00', '2026-06-15 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(64, 4, '2026-06-15', '2026-06-15 01:00:00', '2026-06-15 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(65, 5, '2026-06-15', '2026-06-15 01:00:00', '2026-06-15 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(66, 6, '2026-06-15', '2026-06-15 01:00:00', '2026-06-15 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(67, 1, '2026-06-16', '2026-06-16 01:00:00', '2026-06-16 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(68, 2, '2026-06-16', '2026-06-16 01:00:00', '2026-06-16 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(69, 3, '2026-06-16', '2026-06-16 01:00:00', '2026-06-16 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(70, 4, '2026-06-16', '2026-06-16 01:00:00', '2026-06-16 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(71, 5, '2026-06-16', '2026-06-16 01:00:00', '2026-06-16 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(72, 6, '2026-06-16', '2026-06-16 01:00:00', '2026-06-16 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(73, 1, '2026-06-17', '2026-06-17 01:00:00', '2026-06-17 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(74, 2, '2026-06-17', '2026-06-17 01:00:00', '2026-06-17 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(75, 3, '2026-06-17', '2026-06-17 01:00:00', '2026-06-17 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(76, 4, '2026-06-17', '2026-06-17 01:00:00', '2026-06-17 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(77, 5, '2026-06-17', '2026-06-17 01:00:00', '2026-06-17 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(78, 6, '2026-06-17', '2026-06-17 01:00:00', '2026-06-17 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(79, 1, '2026-06-18', '2026-06-18 01:00:00', '2026-06-18 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(80, 2, '2026-06-18', '2026-06-18 01:00:00', '2026-06-18 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(81, 3, '2026-06-18', '2026-06-18 01:00:00', '2026-06-18 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(82, 4, '2026-06-18', '2026-06-18 01:00:00', '2026-06-18 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(83, 5, '2026-06-18', '2026-06-18 01:00:00', '2026-06-18 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(84, 6, '2026-06-18', '2026-06-18 01:00:00', '2026-06-18 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(85, 1, '2026-06-19', '2026-06-19 01:00:00', '2026-06-19 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(86, 2, '2026-06-19', '2026-06-19 01:00:00', '2026-06-19 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(87, 3, '2026-06-19', '2026-06-19 01:00:00', '2026-06-19 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(88, 4, '2026-06-19', '2026-06-19 01:00:00', '2026-06-19 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(89, 5, '2026-06-19', '2026-06-19 01:00:00', '2026-06-19 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(90, 6, '2026-06-19', '2026-06-19 01:00:00', '2026-06-19 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(91, 1, '2026-06-22', '2026-06-22 01:00:00', '2026-06-22 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(92, 2, '2026-06-22', '2026-06-22 01:00:00', '2026-06-22 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(93, 3, '2026-06-22', '2026-06-22 01:00:00', '2026-06-22 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(94, 4, '2026-06-22', '2026-06-22 01:00:00', '2026-06-22 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(95, 5, '2026-06-22', '2026-06-22 01:00:00', '2026-06-22 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(96, 6, '2026-06-22', '2026-06-22 01:00:00', '2026-06-22 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(97, 1, '2026-06-23', '2026-06-23 01:00:00', '2026-06-23 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(98, 2, '2026-06-23', '2026-06-23 01:00:00', '2026-06-23 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(99, 3, '2026-06-23', '2026-06-23 01:00:00', '2026-06-23 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(100, 4, '2026-06-23', '2026-06-23 01:00:00', '2026-06-23 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(101, 5, '2026-06-23', '2026-06-23 01:00:00', '2026-06-23 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(102, 6, '2026-06-23', '2026-06-23 01:00:00', '2026-06-23 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(103, 1, '2026-06-24', '2026-06-24 01:00:00', '2026-06-24 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(104, 2, '2026-06-24', '2026-06-24 01:00:00', '2026-06-24 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(105, 3, '2026-06-24', '2026-06-24 01:00:00', '2026-06-24 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(106, 4, '2026-06-24', '2026-06-24 01:00:00', '2026-06-24 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(107, 5, '2026-06-24', '2026-06-24 01:00:00', '2026-06-24 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(108, 6, '2026-06-24', '2026-06-24 01:00:00', '2026-06-24 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(109, 1, '2026-06-25', '2026-06-25 01:00:00', '2026-06-25 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(110, 2, '2026-06-25', '2026-06-25 01:00:00', '2026-06-25 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(111, 3, '2026-06-25', '2026-06-25 01:00:00', '2026-06-25 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(112, 4, '2026-06-25', '2026-06-25 01:00:00', '2026-06-25 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(113, 5, '2026-06-25', '2026-06-25 01:00:00', '2026-06-25 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(114, 6, '2026-06-25', '2026-06-25 01:00:00', '2026-06-25 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(115, 1, '2026-06-26', '2026-06-26 01:00:00', '2026-06-26 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(116, 2, '2026-06-26', '2026-06-26 01:00:00', '2026-06-26 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(117, 3, '2026-06-26', '2026-06-26 01:00:00', '2026-06-26 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(118, 4, '2026-06-26', '2026-06-26 01:00:00', '2026-06-26 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(119, 5, '2026-06-26', '2026-06-26 01:00:00', '2026-06-26 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(120, 6, '2026-06-26', '2026-06-26 01:00:00', '2026-06-26 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(121, 1, '2026-06-29', '2026-06-29 01:00:00', '2026-06-29 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(122, 2, '2026-06-29', '2026-06-29 01:00:00', '2026-06-29 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(123, 3, '2026-06-29', '2026-06-29 01:00:00', '2026-06-29 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(124, 4, '2026-06-29', '2026-06-29 01:00:00', '2026-06-29 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(125, 5, '2026-06-29', '2026-06-29 01:00:00', '2026-06-29 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(126, 6, '2026-06-29', '2026-06-29 01:00:00', '2026-06-29 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(127, 1, '2026-06-30', '2026-06-30 01:00:00', '2026-06-30 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(128, 2, '2026-06-30', '2026-06-30 01:00:00', '2026-06-30 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(129, 3, '2026-06-30', '2026-06-30 01:00:00', '2026-06-30 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(130, 4, '2026-06-30', '2026-06-30 01:00:00', '2026-06-30 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(131, 5, '2026-06-30', '2026-06-30 01:00:00', '2026-06-30 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(132, 6, '2026-06-30', '2026-06-30 01:00:00', '2026-06-30 09:00:00', 8.00, 0.00, 'Present', NULL, '2026-06-10 02:08:55', '2026-06-10 02:08:55'),
(133, 1, '2026-06-10', '2026-06-10 03:37:16', '2026-06-10 03:37:44', 0.01, 0.00, 'Present', NULL, '2026-06-10 03:37:07', '2026-06-10 03:37:44'),
(134, 2, '2026-06-10', '2026-06-10 03:37:21', '2026-06-10 03:37:25', 0.00, 0.00, 'Present', NULL, '2026-06-10 03:37:07', '2026-06-10 03:37:25'),
(135, 3, '2026-06-10', NULL, NULL, 0.00, 0.00, 'Pending', NULL, '2026-06-10 03:37:07', '2026-06-10 03:37:07'),
(136, 4, '2026-06-10', NULL, NULL, 0.00, 0.00, 'Pending', NULL, '2026-06-10 03:37:07', '2026-06-10 03:37:07'),
(137, 5, '2026-06-10', NULL, NULL, 0.00, 0.00, 'Pending', NULL, '2026-06-10 03:37:07', '2026-06-10 03:37:07'),
(138, 6, '2026-06-10', NULL, NULL, 0.00, 0.00, 'Pending', NULL, '2026-06-10 03:37:07', '2026-06-10 03:37:07'),
(139, 1, '2026-07-01', NULL, NULL, 0.00, 0.00, 'Sick Leave', 'LBM', '2026-07-01 01:50:28', '2026-07-01 06:10:22'),
(140, 2, '2026-07-01', '2026-07-01 00:42:00', '2026-07-01 11:07:00', 10.42, 2.42, 'Present', '', '2026-07-01 01:50:28', '2026-07-02 02:48:42'),
(141, 3, '2026-07-01', '2026-07-01 00:38:00', '2026-07-01 09:04:00', 8.43, 0.00, 'Present', '', '2026-07-01 01:50:28', '2026-07-02 02:48:36'),
(142, 4, '2026-07-01', '2026-07-01 00:43:00', '2026-07-01 10:50:00', 10.12, 2.12, 'Present', '', '2026-07-01 01:50:28', '2026-07-02 02:48:31'),
(143, 5, '2026-07-01', '2026-07-01 00:38:00', '2026-07-01 09:11:00', 8.55, 0.00, 'Present', '', '2026-07-01 01:50:28', '2026-07-02 02:48:26'),
(144, 6, '2026-07-01', '2026-07-01 00:38:00', '2026-07-01 09:03:00', 8.42, 0.00, 'Present', '', '2026-07-01 01:50:28', '2026-07-02 02:48:21'),
(145, 9, '2026-07-01', '2026-07-01 00:35:00', '2026-07-01 09:06:00', 8.52, 0.00, 'Present', '', NULL, '2026-07-02 02:48:09'),
(146, 10, '0000-00-00', NULL, NULL, 0.00, 0.00, 'Pending', NULL, '2026-07-01 06:00:51', '2026-07-01 06:00:51'),
(147, 10, '2026-07-01', '2026-07-01 00:45:00', '2026-07-01 09:06:00', 8.35, 0.00, 'Present', '', NULL, '2026-07-02 02:48:15'),
(148, 5, '2026-07-02', '2026-07-02 00:30:00', NULL, 0.00, 0.00, 'Present', NULL, '2026-07-02 00:30:00', '2026-07-02 00:30:00'),
(149, 3, '2026-07-02', '2026-07-02 00:33:47', NULL, 0.00, 0.00, 'Present', NULL, '2026-07-02 00:33:47', '2026-07-02 00:33:47'),
(150, 10, '2026-07-02', '2026-07-02 00:44:19', NULL, 0.00, 0.00, 'Present', NULL, '2026-07-02 00:44:19', '2026-07-02 00:44:19'),
(151, 6, '2026-07-02', '2026-07-02 00:51:11', NULL, 0.00, 0.00, 'Present', NULL, '2026-07-02 00:51:11', '2026-07-02 00:51:11'),
(152, 1, '2026-07-02', '2026-07-02 00:06:00', NULL, 0.00, 0.00, 'Present', '', '2026-07-02 00:51:50', '2026-07-02 02:47:48'),
(153, 2, '2026-07-02', '2026-07-02 00:53:03', NULL, 0.00, 0.00, 'Present', NULL, '2026-07-02 00:51:50', '2026-07-02 00:53:03'),
(154, 4, '2026-07-02', '2026-07-02 00:53:13', NULL, 0.00, 0.00, 'Present', NULL, '2026-07-02 00:51:50', '2026-07-02 00:53:13'),
(155, 9, '2026-07-02', '2026-07-02 00:16:00', NULL, 0.00, 0.00, 'Present', '', '2026-07-02 00:51:50', '2026-07-02 02:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-setting_grace_period_time', 's:5:\"08:15\";', 2098249631),
('laravel-cache-setting_night_diff_rate', 's:4:\"0.10\";', 2098249631),
('laravel-cache-setting_night_diff_start', 's:5:\"22:00\";', 2098249631),
('laravel-cache-setting_non_working_holiday_rate', 's:3:\"130\";', 2098249631),
('laravel-cache-setting_official_time_in', 's:5:\"08:00\";', 2098249631),
('laravel-cache-setting_official_time_out', 's:5:\"18:00\";', 2098249631),
('laravel-cache-setting_reg_holiday_rate', 's:3:\"200\";', 2098249631),
('laravel-cache-setting_sick_leaves', 's:2:\"15\";', 2098249631),
('laravel-cache-setting_vacation_leaves', 's:2:\"15\";', 2098249631),
('laravel-cache-setting_weekday_ot_rate', 's:3:\"125\";', 2098249631),
('laravel-cache-setting_weekend_ot_rate', 's:3:\"130\";', 2098249631),
('laravel-cache-setting_working_hours_per_day', 's:1:\"8\";', 2098249631);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `monthly_salary` decimal(10,2) NOT NULL,
  `hiring_date` date NOT NULL,
  `sss_no` varchar(255) DEFAULT NULL,
  `philhealth_no` varchar(255) DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `pagibig_no` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive','Resigned','Terminated') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_code`, `name`, `email`, `phone_number`, `department`, `position`, `monthly_salary`, `hiring_date`, `sss_no`, `philhealth_no`, `tin_no`, `pagibig_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'EMP-0001', 'Mariale Princess C. Unabia', 'mariale@example.com', '09171234567', 'Secretary', 'Executive Secretary', 34466.18, '2026-05-01', '000000000-0', '000000000-0', '000000000-0', '000000000-0', 'Active', '2026-06-09 03:05:29', '2026-07-01 06:19:33'),
(2, 'EMP-0002', 'Marsha Moreno', 'marsha@example.com', '09181234567', 'Secretary', 'Membership Secretary', 30078.12, '2026-05-01', '000000000-0', '000000000-0', '000000000-0', '000000000-0', 'Active', '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(3, 'EMP-0003', 'Abigail Alto', 'abigail@example.com', '09991234567', 'Secretary', 'CME Secretary', 19793.30, '2026-05-01', '000000000-0', '000000000-0', '000000000-0', '000000000-0', 'Active', '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(4, 'EMP-0004', 'Christine H. Catalla', 'catalla100777@gmail.com', '09178881046', 'Secretary', 'Publication Secretary', 21035.00, '2026-05-01', '33-5412517-5', '19-050571730-2', '202665687000', '1090-0480-9348', 'Active', '2026-06-09 03:05:29', '2026-07-01 06:22:52'),
(5, 'EMP-0005', 'Abe Gabrillo', 'abe@example.com', '09178889999', 'Liaison', 'Liaison Officer', 24615.18, '2026-05-01', '000000000-0', '000000000-0', '000000000-0', '000000000-0', 'Active', '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(6, 'EMP-0006', 'Paul Reyes', 'paul@example.com', '09178889999', 'Information Technology', 'IT Specialist', 23793.30, '2026-05-01', '000000000-0', '000000000-0', '000000000-0', '000000000-0', 'Active', '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(9, 'EMP-2026-0009', 'Joshua Goggs', 'josh@gmail.com', '123', 'Information Technology', 'IT Graphic Designer', 18000.00, '2026-07-01', '123', '123', '123', '123', 'Active', '2026-07-01 05:57:43', '2026-07-01 05:57:43'),
(10, 'EMP-2026-0010', 'Christian Vacaro', 'christian@gmail.com', '1234', 'Information Technology', 'IT Specialst', 18000.00, '2026-07-01', '123', '123124', '123', '123', 'Active', '2026-07-01 05:58:32', '2026-07-01 07:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `employee_allowances`
--

CREATE TABLE `employee_allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `type` enum('Allowance','Additional') NOT NULL DEFAULT 'Allowance',
  `is_taxable` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_allowances`
--

INSERT INTO `employee_allowances` (`id`, `employee_id`, `name`, `amount`, `type`, `is_taxable`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 5, 'Transportation', 2500.00, 'Allowance', 0, 1, '2026-06-10 04:02:19', '2026-06-10 04:02:19'),
(2, 5, 'Rice', 500.00, 'Allowance', 0, 1, '2026-06-10 04:02:19', '2026-06-10 04:02:19'),
(10, 4, 'asdad', 12312.00, 'Allowance', 0, 1, '2026-07-01 06:22:52', '2026-07-01 06:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `employee_deductions`
--

CREATE TABLE `employee_deductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `type` enum('Government','Loan','Penalty','Other') NOT NULL DEFAULT 'Other',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_deductions`
--

INSERT INTO `employee_deductions` (`id`, `employee_id`, `name`, `amount`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 5, 'SSS', 2500.00, 'Other', 1, '2026-06-10 04:02:19', '2026-06-10 04:02:19'),
(2, 5, 'Pag-Ibig', 200.00, 'Other', 1, '2026-06-10 04:02:19', '2026-06-10 04:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_28_030014_create_employees_table', 1),
(8, '2026_05_28_071632_create_employee_allowances_table', 1),
(9, '2026_05_28_092253_create_employee_deductions_table', 1),
(10, '2026_06_01_062125_create_tax_brackets_table', 1),
(12, '2026_06_02_025626_create_settings_table', 1),
(19, '2026_05_28_030106_create_attendances_table', 2),
(22, '2026_05_28_061302_create_payrolls_table', 3),
(23, '2026_05_28_061326_create_payroll_items_table', 3),
(24, '2026_06_10_114856_create_payroll_item_allowances_table', 3),
(25, '2026_06_10_114935_create_payroll_item_deductions_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payroll_code` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `cutoff` enum('1','2') NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('Draft','Processed','Released') NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_items`
--

CREATE TABLE `payroll_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payroll_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `payroll_code` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `cutoff` tinyint(4) NOT NULL,
  `daily_rate` decimal(12,2) NOT NULL DEFAULT 0.00,
  `hourly_rate` decimal(12,2) NOT NULL DEFAULT 0.00,
  `basic_pay` decimal(12,2) NOT NULL DEFAULT 0.00,
  `overtime_pay` decimal(12,2) NOT NULL DEFAULT 0.00,
  `allowances` decimal(12,2) NOT NULL DEFAULT 0.00,
  `late_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `other_deductions` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tax_deduction` decimal(12,2) NOT NULL DEFAULT 0.00,
  `gross_pay` decimal(12,2) NOT NULL DEFAULT 0.00,
  `net_pay` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('Draft','Finalized','Paid') NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payroll_items`
--

INSERT INTO `payroll_items` (`id`, `payroll_id`, `employee_id`, `payroll_code`, `month`, `cutoff`, `daily_rate`, `hourly_rate`, `basic_pay`, `overtime_pay`, `allowances`, `late_deduction`, `other_deductions`, `tax_deduction`, `gross_pay`, `net_pay`, `status`, `created_at`, `updated_at`) VALUES
(7, NULL, 5, '2026-06-C1', '2026-06', 1, 1136.09, 142.01, 12307.59, 5073.23, 1500.00, 0.00, 0.00, 639.57, 18880.82, 15541.25, 'Draft', '2026-06-10 04:04:17', '2026-06-10 04:04:17'),
(8, NULL, 3, '2026-06-C1', '2026-06', 1, 913.54, 114.19, 9896.65, 0.00, 0.00, 0.00, 0.00, 0.00, 9896.65, 9896.65, 'Draft', '2026-06-10 04:04:39', '2026-06-10 04:04:39'),
(9, NULL, 4, '2026-06-C1', '2026-06', 1, 970.85, 121.36, 10517.50, 0.00, 6156.00, 0.00, 0.00, 15.08, 16673.50, 16658.42, 'Draft', '2026-06-10 04:05:17', '2026-06-10 04:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_item_allowances`
--

CREATE TABLE `payroll_item_allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payroll_item_id` bigint(20) UNSIGNED NOT NULL,
  `allowance_name` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payroll_item_allowances`
--

INSERT INTO `payroll_item_allowances` (`id`, `payroll_item_id`, `allowance_name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 7, 'Transportation', 1250.00, '2026-06-10 04:04:17', '2026-06-10 04:04:17'),
(2, 7, 'Rice', 250.00, '2026-06-10 04:04:17', '2026-06-10 04:04:17'),
(3, 9, 'asdad', 6156.00, '2026-06-10 04:05:17', '2026-06-10 04:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_item_deductions`
--

CREATE TABLE `payroll_item_deductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payroll_item_id` bigint(20) UNSIGNED NOT NULL,
  `deduction_name` varchar(255) NOT NULL,
  `deduction_type` varchar(255) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payroll_item_deductions`
--

INSERT INTO `payroll_item_deductions` (`id`, `payroll_item_id`, `deduction_name`, `deduction_type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 7, 'SSS', 'Other', 2500.00, '2026-06-10 04:04:17', '2026-06-10 04:04:17'),
(2, 7, 'Pag-Ibig', 'Other', 200.00, '2026-06-10 04:04:17', '2026-06-10 04:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Rl65HPu9Ge2NsPlKujP1bCqZ83h9iOuJEgK4U6Eq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ6ZldTM2o5STBsUldYT3VVajVCbkxleWMxNzI1MmI2MnJ2VFROTWlEIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjUwNTIxXC9kYXNoYm9hcmQifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo2MzUyOCIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6WyJzdWNjZXNzIl0sIm5ldyI6W119fQ==', 1782904057),
('UpEA3qq08OPQRtvXHgokj6SCD4Wophmrl4WVVafK', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIyYUxvbWVjQUZzNFo5N2VmQm1aYXliOWZZd2h0NFplT20xcmNJck1GIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjQ5Njg5XC9hdHRlbmRhbmNlIiwicm91dGUiOiJhdHRlbmRhbmNlIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1782962292);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'official_time_in', '08:00', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(2, 'grace_period_time', '08:15', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(3, 'official_time_out', '18:00', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(4, 'night_diff_start', '22:00', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(5, 'weekday_ot_rate', '125', '2026-06-09 03:15:50', '2026-06-10 01:52:55'),
(6, 'weekend_ot_rate', '130', '2026-06-09 03:15:50', '2026-06-10 01:52:55'),
(7, 'night_diff_rate', '0.10', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(8, 'working_hours_per_day', '8', '2026-06-09 03:15:50', '2026-06-10 01:53:01'),
(9, 'vacation_leaves', '15', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(10, 'sick_leaves', '15', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(11, 'reg_holiday_rate', '200', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(12, 'non_working_holiday_rate', '130', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(13, 'weekend_rate', '130', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(14, 'reg_holiday_ot_rate', '260', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(15, 'non_working_holiday_ot_rate', '169', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(16, 'weekday_nd_rate', '137.5', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(17, 'weekend_nd_rate', '185.9', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(18, 'special_holiday_nd_rate', '185.9', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(19, 'special_restday_nd_rate', '214.5', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(20, 'reg_holiday_nd_rate', '286', '2026-06-09 03:15:50', '2026-06-09 03:15:50'),
(21, 'reg_holiday_restday_nd_rate', '371.8', '2026-06-09 03:15:50', '2026-06-09 03:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `tax_brackets`
--

CREATE TABLE `tax_brackets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_amount` decimal(12,2) NOT NULL,
  `max_amount` decimal(12,2) DEFAULT NULL,
  `base_tax` decimal(12,2) NOT NULL DEFAULT 0.00,
  `percentage` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_brackets`
--

INSERT INTO `tax_brackets` (`id`, `min_amount`, `max_amount`, `base_tax`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 0.00, 10417.00, 0.00, 0.00, '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(2, 10417.00, 16666.00, 0.00, 15.00, '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(3, 16667.00, 33332.00, 937.50, 20.00, '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(4, 33333.00, 83333.00, 4270.70, 25.00, '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(5, 83333.01, 166667.00, 17541.80, 30.00, '2026-06-09 03:05:29', '2026-06-09 03:05:29'),
(6, 166667.01, NULL, 183541.80, 35.00, '2026-06-09 03:05:29', '2026-06-09 03:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Paul Reyes', 'pcreyes09@gmail.com', NULL, '$2y$12$9VBgq4wRbOwCyHr0MNdRg.ituhCqhK.c2KR2MG0boJIjdnmrYtGIq', 'SNGOMRRzRp8EJ8dSYGRDHqpGFC50k8Op2qRWuc8iY683gA5LE3Np8xCHGFVT', '2026-06-09 03:07:19', '2026-06-09 03:07:19'),
(2, 'Tintin', 'catalla100777@gmail.com', NULL, '$2y$12$0aze4fbkho5AidbwCSXnvOeTzIc6X/2hjUzEIrqkHV41mdGfGbfim', '6ipqxNGVan8QlgjBLK98ZAkA9qZZ9imYRyOaFcoYCr4KqH6D9uFqePoKkhIB', '2026-07-02 02:16:20', '2026-07-02 02:16:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_employee_id_attendance_date_unique` (`employee_id`,`attendance_date`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_employee_code_unique` (`employee_code`);

--
-- Indexes for table `employee_allowances`
--
ALTER TABLE `employee_allowances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_allowances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_deductions`
--
ALTER TABLE `employee_deductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_deductions_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payrolls_payroll_code_unique` (`payroll_code`);

--
-- Indexes for table `payroll_items`
--
ALTER TABLE `payroll_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_items_payroll_id_foreign` (`payroll_id`),
  ADD KEY `payroll_items_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `payroll_item_allowances`
--
ALTER TABLE `payroll_item_allowances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_item_allowances_payroll_item_id_foreign` (`payroll_item_id`);

--
-- Indexes for table `payroll_item_deductions`
--
ALTER TABLE `payroll_item_deductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_item_deductions_payroll_item_id_foreign` (`payroll_item_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `tax_brackets`
--
ALTER TABLE `tax_brackets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee_allowances`
--
ALTER TABLE `employee_allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee_deductions`
--
ALTER TABLE `employee_deductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_items`
--
ALTER TABLE `payroll_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payroll_item_allowances`
--
ALTER TABLE `payroll_item_allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payroll_item_deductions`
--
ALTER TABLE `payroll_item_deductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tax_brackets`
--
ALTER TABLE `tax_brackets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_allowances`
--
ALTER TABLE `employee_allowances`
  ADD CONSTRAINT `employee_allowances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_deductions`
--
ALTER TABLE `employee_deductions`
  ADD CONSTRAINT `employee_deductions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_items`
--
ALTER TABLE `payroll_items`
  ADD CONSTRAINT `payroll_items_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payroll_items_payroll_id_foreign` FOREIGN KEY (`payroll_id`) REFERENCES `payrolls` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payroll_item_allowances`
--
ALTER TABLE `payroll_item_allowances`
  ADD CONSTRAINT `payroll_item_allowances_payroll_item_id_foreign` FOREIGN KEY (`payroll_item_id`) REFERENCES `payroll_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payroll_item_deductions`
--
ALTER TABLE `payroll_item_deductions`
  ADD CONSTRAINT `payroll_item_deductions_payroll_item_id_foreign` FOREIGN KEY (`payroll_item_id`) REFERENCES `payroll_items` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
