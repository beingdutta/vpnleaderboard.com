-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 06:34 AM
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
(14, 2, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:04:33'),
(15, 7, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:04:37'),
(16, 3, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:06:35'),
(17, 6, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:06:38'),
(18, 11, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:06:41');

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
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `regions` varchar(64) DEFAULT 'GLOBAL,US,IN,CN',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_china`
--

INSERT INTO `vpns_china` (`id`, `name`, `website_url`, `logo_url`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `regions`, `created_at`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 'ExpressVPN', 'https://www.expressvpn.com', NULL, 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 'GLOBAL,US,IN,CN', '2025-09-16 03:51:07', 0, NULL, NULL),
(2, 'NordVPN', 'https://nordvpn.com', NULL, 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 'GLOBAL,US,IN,CN', '2025-09-16 03:51:07', 0, NULL, NULL),
(3, 'Surfshark', 'https://surfshark.com', NULL, 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 'GLOBAL,US,IN,CN', '2025-09-16 03:51:07', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_global`
--

CREATE TABLE `vpns_global` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `regions` varchar(64) DEFAULT 'GLOBAL,US,IN,CN',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_global`
--

INSERT INTO `vpns_global` (`id`, `name`, `website_url`, `logo_url`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `regions`, `created_at`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 'ExpressVPN', 'https://www.expressvpn.com', '', 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 'GLOBAL,US,IN,CN', '2025-09-15 17:29:52', 0, NULL, NULL),
(2, 'NordVPN', 'https://nordvpn.com', '', 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 'GLOBAL,US,IN,CN', '2025-09-15 17:29:52', 0, NULL, NULL),
(3, 'Surfshark', 'https://surfshark.com', '', 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 'GLOBAL,US,IN,CN', '2025-09-15 17:29:52', 0, NULL, NULL),
(4, 'CyberGhost', 'https://www.cyberghostvpn.com', '', 510, 'Streaming, Ease of use', 100, 'Dedicated streaming servers; No-logs', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(5, 'PIA', 'https://www.privateinternetaccess.com', '', 470, 'Customization, Torrenting', 90, 'Open-source; Port forwarding', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(6, 'Proton VPN', 'https://protonvpn.com', '', 490, 'Privacy, Journalists', 85, 'Swiss-based; Secure Core', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(7, 'IPVanish', 'https://www.ipvanish.com', '', 450, 'Power users', 75, 'WireGuard; SOCKS5', 'GLOBAL,US', '2025-09-15 17:29:52', 0, NULL, NULL),
(8, 'Mullvad', 'https://mullvad.net', '', 430, 'Privacy, Anon signup', 40, 'Cash payments; No email needed', 'GLOBAL,US,EU', '2025-09-15 17:29:52', 0, NULL, NULL),
(9, 'Hotspot Shield', 'https://www.hotspotshield.com', '', 420, 'Casual streaming', 80, 'Catapult Hydra protocol', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(10, 'TunnelBear', 'https://www.tunnelbear.com', '', 410, 'Beginners', 45, 'Cute UI; Independent audits', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(11, 'Windscribe', 'https://windscribe.com', '', 400, 'Free tier, Adblock', 69, 'ROBERT; Config generators', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(12, 'Atlas VPN', 'https://atlasvpn.com', '', 395, 'Budget', 40, 'Data breach monitor', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(13, 'PrivadoVPN', 'https://privadovpn.com', '', 370, 'Free tier focus', 48, 'SOCKS5; No-logs', 'GLOBAL,US,IN', '2025-09-15 17:29:52', 0, NULL, NULL),
(14, 'Hide.me', 'https://hide.me', '', 360, 'Privacy', 47, 'Stealth Guard; Split tunneling', 'GLOBAL,US,IN,CN', '2025-09-15 17:29:52', 0, NULL, NULL),
(15, 'VyprVPN', 'https://www.vyprvpn.com', '', 350, 'Bypass censorship', 70, 'Chameleon protocol', 'GLOBAL,US,IN,CN', '2025-09-15 17:29:52', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_india`
--

CREATE TABLE `vpns_india` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `regions` varchar(64) DEFAULT 'GLOBAL,US,IN,CN',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_india`
--

INSERT INTO `vpns_india` (`id`, `name`, `website_url`, `logo_url`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `regions`, `created_at`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 'ExpressVPN', 'https://www.expressvpn.com', NULL, 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 'GLOBAL,US,IN,CN', '2025-09-16 03:36:21', 0, NULL, NULL),
(2, 'NordVPN', 'https://nordvpn.com', NULL, 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 'GLOBAL,US,IN,CN', '2025-09-16 03:36:21', 0, NULL, NULL),
(3, 'Surfshark', 'https://surfshark.com', NULL, 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 'GLOBAL,US,IN,CN', '2025-09-16 03:36:21', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vpns_us`
--

CREATE TABLE `vpns_us` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `speed_mbps` int(11) DEFAULT NULL,
  `suitable_for` varchar(255) DEFAULT NULL,
  `supported_countries` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `regions` varchar(64) DEFAULT 'GLOBAL,US,IN,CN',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_promoted` tinyint(1) NOT NULL DEFAULT 0,
  `affiliate_link` varchar(255) DEFAULT NULL,
  `starting_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpns_us`
--

INSERT INTO `vpns_us` (`id`, `name`, `website_url`, `logo_url`, `speed_mbps`, `suitable_for`, `supported_countries`, `features`, `regions`, `created_at`, `is_promoted`, `affiliate_link`, `starting_price`) VALUES
(1, 'ExpressVPN', 'https://www.expressvpn.com', NULL, 580, 'Streaming, Privacy, Gaming', 105, 'AES-256; No-logs; Kill Switch; 24/7 support', 'GLOBAL,US,IN,CN', '2025-09-16 03:40:15', 0, NULL, NULL),
(2, 'NordVPN', 'https://nordvpn.com', NULL, 560, 'Streaming, Security', 111, 'Double VPN; Threat Protection; Meshnet', 'GLOBAL,US,IN,CN', '2025-09-16 03:40:15', 0, NULL, NULL),
(3, 'Surfshark', 'https://surfshark.com', NULL, 520, 'Budget, Unlimited devices', 100, 'CleanWeb; No-logs; Kill Switch', 'GLOBAL,US,IN,CN', '2025-09-16 03:40:15', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `votes_china`
--
ALTER TABLE `votes_china`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vpn_id` (`vpn_id`);

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
  ADD KEY `vpn_id` (`vpn_id`);

--
-- Indexes for table `votes_us`
--
ALTER TABLE `votes_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vpn_id` (`vpn_id`);

--
-- Indexes for table `vpns_china`
--
ALTER TABLE `vpns_china`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vpns_global`
--
ALTER TABLE `vpns_global`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vpns_india`
--
ALTER TABLE `vpns_india`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vpns_us`
--
ALTER TABLE `vpns_us`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `vpns_china`
--
ALTER TABLE `vpns_china`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vpns_global`
--
ALTER TABLE `vpns_global`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vpns_india`
--
ALTER TABLE `vpns_india`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vpns_us`
--
ALTER TABLE `vpns_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes_china`
--
ALTER TABLE `votes_china`
  ADD CONSTRAINT `votes_china_ibfk_1` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_china` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes_global`
--
ALTER TABLE `votes_global`
  ADD CONSTRAINT `fk_votes_vpn` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_global` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes_india`
--
ALTER TABLE `votes_india`
  ADD CONSTRAINT `votes_india_ibfk_1` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_india` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes_us`
--
ALTER TABLE `votes_us`
  ADD CONSTRAINT `votes_us_ibfk_1` FOREIGN KEY (`vpn_id`) REFERENCES `vpns_us` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
