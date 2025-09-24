-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2025 at 09:32 PM
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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `votes_china`
--

CREATE TABLE `votes_china` (
  `id` bigint(20) NOT NULL,
  `vpn_id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `vote` enum('up','down') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_china`
--

INSERT INTO `votes_china` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`) VALUES
(1, 3, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `votes_global`
--

CREATE TABLE `votes_global` (
  `id` bigint(20) NOT NULL,
  `vpn_id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `vote` enum('up','down') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_global`
--

INSERT INTO `votes_global` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`) VALUES
(16, 3, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:06:35'),
(20, 14, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-22 09:15:55'),
(21, 2, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-22 09:15:58'),
(22, 10, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-22 09:16:00'),
(23, 20, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-23 07:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `votes_india`
--

CREATE TABLE `votes_india` (
  `id` bigint(20) NOT NULL,
  `vpn_id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `vote` enum('up','down') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_india`
--

INSERT INTO `votes_india` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`) VALUES
(1, 1, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 03:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `votes_us`
--

CREATE TABLE `votes_us` (
  `id` bigint(20) NOT NULL,
  `vpn_id` int(11) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `vote` enum('up','down') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_us`
--

INSERT INTO `votes_us` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`) VALUES
(1, 3, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:07:14');

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
(3, 520, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_global`
--

CREATE TABLE `vpns_global` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_global`
--

INSERT INTO `vpns_global` (`vpn_id`, `speed_mbps`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 0, 'https://www.expressvpn.com/?srsltid=AfmBOorK8GTDgq751xnsKqdndaGTpXjZKPfOhLaOQWfhBj3QOxbBI0bk', 5.00),
(2, 560, 0, '', 0.00),
(3, 520, 1, '', 0.00),
(6, 490, 0, '', 0.00),
(10, 410, 0, NULL, NULL),
(14, 360, 0, '', 0.00),
(20, 100, 0, '', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_india`
--

CREATE TABLE `vpns_india` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_india`
--

INSERT INTO `vpns_india` (`vpn_id`, `speed_mbps`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 0, NULL, NULL),
(2, 560, 1, NULL, NULL),
(3, 520, 0, '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_us`
--

CREATE TABLE `vpns_us` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_us`
--

INSERT INTO `vpns_us` (`vpn_id`, `speed_mbps`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 0, NULL, NULL),
(2, 560, 0, NULL, NULL),
(3, 520, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vpn_master_table`
--

CREATE TABLE `vpn_master_table` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `server_count` int(11) DEFAULT NULL,
  `device_limit` int(11) DEFAULT NULL,
  `protocols_supported` varchar(255) DEFAULT NULL,
  `logging_policy` varchar(255) DEFAULT NULL,
  `based_in` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpn_master_table`
--

INSERT INTO `vpn_master_table` (`id`, `name`, `website_url`, `logo_path`, `created_at`, `suitable_for`, `supported_countries`, `features`, `server_count`, `device_limit`, `protocols_supported`, `logging_policy`, `based_in`) VALUES
(1, 'ExpressVPN', 'https://www.expressvpn.com', 'assets/expressvpn.png', '2025-09-16 05:33:48', 'Gaming', 11, 'fast, free-trial', 3200, 7, 'OpenVPN, IKEv2, WireGuard', 'Strict no-logs policy', 'Panama'),
(2, 'NordVPN', 'https://nordvpn.com', 'assets\\nordvpn.png', '2025-09-16 05:33:48', 'Office Work', 89, '0 Latency, No Buffering', 5500, 5, 'OpenVPN, IKEv2, L2TP/IPsec', 'No-logs policy', 'British Virgin Islands'),
(3, 'Surfshark', 'https://surfshark.com', 'assets\\surfsharkvpn.png', '2025-09-16 05:33:48', 'Office Work', 4, '0 Latency, No Buffering', 9700, 10, 'OpenVPN, WireGuard, SSTP', 'Keeps connection logs', 'USA'),
(6, 'Proton VPN', 'https://protonvpn.com', 'assets\\protonvpn.png', '2025-09-16 05:33:48', 'Gaming', 23, 'Privacy Umbrella, Blazing Fast', 3000, 6, 'OpenVPN, IKEv2, WireGuard', 'Strict no-logs policy', 'Switzerland'),
(10, 'TunnelBear', 'https://www.tunnelbear.com', 'assets\\tunnelbearvpn.png', '2025-09-16 05:33:48', 'Editing', 34, 'fast, free-trial', 6500, 10, 'WireGuard, OpenVPN, IKEv2', 'No-logs policy', 'Netherlands'),
(14, 'Hide.me', 'https://hide.me', 'assets\\hidemevpn.png', '2025-09-16 05:33:48', 'Editing', 4, '0 Latency, No Buffering', 2900, 5, 'OpenVPN, L2TP/IPsec, PPTP', 'Keeps some logs', 'USA'),
(16, 'CyberGhost', 'https://www.cyberghostvpn.com', 'assets/cyberghostvpn.png', '2025-09-16 10:00:26', 'Office Work', 56, '0 Latency, No Buffering', 750, 10, 'OpenVPN, IKEv2', 'No-logs policy', 'Malaysia'),
(17, 'Atlas VPN', 'https://atlasvpn.com', 'assets/atlasvpn.png', '2025-09-16 10:00:26', 'Gaming', 23, '0 Latency, No Buffering', 2000, 8, 'WireGuard, OpenVPN', 'Strict no-logs policy', 'Romania'),
(18, 'PureVPN', 'https://purevpn.com', 'assets\\purevpn.png', '2025-09-16 10:00:26', 'Editing', 32, 'fast, free-trial', 1600, 7, 'OpenVPN, IKEv2, WireGuard', 'No-logs policy', 'Canada'),
(19, 'Avast SecureLine VPN', 'https://www.avast.com/secureline-vpn', 'assets/tunnelbearvpn.png', '2025-09-16 10:00:26', 'Editing', 45, 'Privacy Umbrella, Blazing Fast', 800, 5, 'OpenVPN, IKEv2', 'No-logs policy', 'Sweden'),
(20, 'Windscribe', 'https://windscribe.com/', 'assets\\windscribevpn.png', '2025-09-23 07:38:27', 'Office Work', 12, 'Privacy Umbrella, Blazing Fast', 1800, 10, 'OpenVPN, IKEv2, WireGuard', 'Strict no-logs policy', 'Germany'),
(21, 'PrivateVPN', 'http://privatevpn.com/', 'assets\\privatevpn.png', '2025-09-23 07:44:30', 'Gaming', 34, 'fast, free-trial', 500, 10, 'WireGuard, OpenVPN', 'No-logs policy', 'Switzerland');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes_china`
--
ALTER TABLE `votes_china`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_votes_china_vpn` (`vpn_id`);

--
-- Indexes for table `votes_global`
--
ALTER TABLE `votes_global`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_vpn_user` (`vpn_id`,`user_id`),
  ADD UNIQUE KEY `uniq_vpn_ip` (`vpn_id`,`ip_address`);

--
-- Indexes for table `votes_india`
--
ALTER TABLE `votes_india`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_votes_india_vpn` (`vpn_id`);

--
-- Indexes for table `votes_us`
--
ALTER TABLE `votes_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_votes_us_vpn` (`vpn_id`);

--
-- Indexes for table `vpns_china`
--
ALTER TABLE `vpns_china`
  ADD PRIMARY KEY (`vpn_id`);

--
-- Indexes for table `vpns_global`
--
ALTER TABLE `vpns_global`
  ADD PRIMARY KEY (`vpn_id`);

--
-- Indexes for table `vpns_india`
--
ALTER TABLE `vpns_india`
  ADD PRIMARY KEY (`vpn_id`);

--
-- Indexes for table `vpns_us`
--
ALTER TABLE `vpns_us`
  ADD PRIMARY KEY (`vpn_id`);

--
-- Indexes for table `vpn_master_table`
--
ALTER TABLE `vpn_master_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votes_china`
--
ALTER TABLE `votes_china`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votes_global`
--
ALTER TABLE `votes_global`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `votes_india`
--
ALTER TABLE `votes_india`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votes_us`
--
ALTER TABLE `votes_us`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vpn_master_table`
--
ALTER TABLE `vpn_master_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes_china`
--
ALTER TABLE `votes_china`
  ADD CONSTRAINT `fk_votes_china_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes_global`
--
ALTER TABLE `votes_global`
  ADD CONSTRAINT `fk_votes_global_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes_india`
--
ALTER TABLE `votes_india`
  ADD CONSTRAINT `fk_votes_india_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes_us`
--
ALTER TABLE `votes_us`
  ADD CONSTRAINT `fk_votes_us_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_china`
--
ALTER TABLE `vpns_china`
  ADD CONSTRAINT `fk_vpns_china_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_global`
--
ALTER TABLE `vpns_global`
  ADD CONSTRAINT `fk_vpns_global_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_india`
--
ALTER TABLE `vpns_india`
  ADD CONSTRAINT `fk_vpns_india_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_us`
--
ALTER TABLE `vpns_us`
  ADD CONSTRAINT `fk_vpns_us_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpn_master_table` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
