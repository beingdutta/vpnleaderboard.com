-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 12:13 PM
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
-- Database: `vpnboard`
--

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
(16, 3, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:06:35');

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
-- Table structure for table `vpns_all`
--

CREATE TABLE `vpns_all` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_all`
--

INSERT INTO `vpns_all` (`id`, `name`, `website_url`, `logo_path`, `created_at`) VALUES
(1, 'ExpressVPN', 'https://www.expressvpn.com', 'assets/expressvpn.png', '2025-09-16 05:33:48'),
(2, 'NordVPN', 'https://nordvpn.com', NULL, '2025-09-16 05:33:48'),
(3, 'Surfshark', 'https://surfshark.com', NULL, '2025-09-16 05:33:48'),
(6, 'Proton VPN', 'https://protonvpn.com', NULL, '2025-09-16 05:33:48'),
(10, 'TunnelBear', 'https://www.tunnelbear.com', NULL, '2025-09-16 05:33:48'),
(14, 'Hide.me', 'https://hide.me', 'assets\\hidemevpn.png', '2025-09-16 05:33:48'),
(16, 'CyberGhost', 'https://www.cyberghostvpn.com', 'assets/cyberghostvpn.png', '2025-09-16 10:00:26'),
(17, 'Atlas VPN', 'https://atlasvpn.com', 'assets/atlasvpn.png', '2025-09-16 10:00:26'),
(18, 'PureVPN', 'https://purevpn.com', 'assetspurevpn.png', '2025-09-16 10:00:26'),
(19, 'Avast SecureLine VPN', 'https://www.avast.com/secureline-vpn', 'assets/tunnelbearvpn.png', '2025-09-16 10:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `vpns_china`
--

CREATE TABLE `vpns_china` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_china`
--

INSERT INTO `vpns_china` (`vpn_id`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 0, NULL, NULL),
(2, 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 1, NULL, NULL),
(3, 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_global`
--

CREATE TABLE `vpns_global` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_global`
--

INSERT INTO `vpns_global` (`vpn_id`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 0, 'https://www.expressvpn.com/?srsltid=AfmBOorK8GTDgq751xnsKqdndaGTpXjZKPfOhLaOQWfhBj3QOxbBI0bk', 5.00),
(2, 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 0, '', 0.00),
(3, 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 0, NULL, NULL),
(6, 490, 'Privacy, Journalists', 85, 'Swiss-based; Secure Core', 0, '', 0.00),
(10, 410, 'Beginners', 45, 'Cute UI; Independent audits', 0, NULL, NULL),
(14, 360, 'Privacy', 47, 'Stealth Guard; Split tunneling', 1, '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_india`
--

CREATE TABLE `vpns_india` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_india`
--

INSERT INTO `vpns_india` (`vpn_id`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 0, NULL, NULL),
(2, 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 1, NULL, NULL),
(3, 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 0, '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_us`
--

CREATE TABLE `vpns_us` (
  `vpn_id` int(11) NOT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_us`
--

INSERT INTO `vpns_us` (`vpn_id`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 0, NULL, NULL),
(2, 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 0, NULL, NULL),
(3, 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `vpns_all`
--
ALTER TABLE `vpns_all`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `votes_china`
--
ALTER TABLE `votes_china`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votes_global`
--
ALTER TABLE `votes_global`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- AUTO_INCREMENT for table `vpns_all`
--
ALTER TABLE `vpns_all`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes_china`
--
ALTER TABLE `votes_china`
  ADD CONSTRAINT `fk_votes_china_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes_global`
--
ALTER TABLE `votes_global`
  ADD CONSTRAINT `fk_votes_global_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes_india`
--
ALTER TABLE `votes_india`
  ADD CONSTRAINT `fk_votes_india_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes_us`
--
ALTER TABLE `votes_us`
  ADD CONSTRAINT `fk_votes_us_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_china`
--
ALTER TABLE `vpns_china`
  ADD CONSTRAINT `fk_vpns_china_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_global`
--
ALTER TABLE `vpns_global`
  ADD CONSTRAINT `fk_vpns_global_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_india`
--
ALTER TABLE `vpns_india`
  ADD CONSTRAINT `fk_vpns_india_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vpns_us`
--
ALTER TABLE `vpns_us`
  ADD CONSTRAINT `fk_vpns_us_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_all` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
