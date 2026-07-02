-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2026 at 05:19 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_employee_code_unique` (`employee_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
