-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2025 at 03:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vpnboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `vpns_china`
--

CREATE TABLE `vpns_china` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_china`
--

INSERT INTO `vpns_china` (`vpn_id`, `speed_mbps`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 0, NULL, NULL),
(2, 560, 1, NULL, NULL),
(3, 520, 0, NULL, NULL),
(6, 888, 0, '', 56.00),
(14, 22, 0, '', 21.00),
(16, 53543, 0, '', 55.00),
(18, 342, 0, '', 456.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vpns_china`
--
ALTER TABLE `vpns_china`
  ADD PRIMARY KEY (`vpn_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vpns_china`
--
ALTER TABLE `vpns_china`
  ADD CONSTRAINT `fk_vpns_china_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
