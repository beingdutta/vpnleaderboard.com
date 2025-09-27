-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2025 at 09:45 AM
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

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `NAME`, `email`, `country`, `message`, `created_at`) VALUES
(1, 'test', 'test@gmail.com', 'India', 'Hi', '2025-09-24 19:41:26'),
(2, 'Aritra Dutta', 'c.h.es.r.a.eb.liss.ar@gmail.com', 'India', 'ghjg', '2025-09-24 19:41:55');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `voted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_china`
--

INSERT INTO `votes_china` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`, `voted_at`) VALUES
(1, 3, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:07:22', '2025-09-26 13:42:44');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `voted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_global`
--

INSERT INTO `votes_global` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`, `voted_at`) VALUES
(26, 14, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-26 07:22:44', '2025-09-26 13:42:44'),
(27, 3, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-26 07:22:48', '2025-09-26 13:42:44'),
(28, 2, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-26 07:23:22', '2025-09-26 13:42:44'),
(29, 6, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-26 13:43:27', '2025-09-26 13:43:27'),
(30, 20, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'down', '2025-09-26 13:43:32', '2025-09-26 13:43:32'),
(31, 14, 'dummy-b20d5035c9c44cbc', 0x00000000, 'up', '2025-09-27 07:36:08', '2025-09-27 07:36:08'),
(33, 2, 'dummy-231b83501857399b', 0x0a15d1cf, 'up', '2025-09-27 07:37:08', '2025-09-27 07:37:08'),
(34, 2, 'dummy-b2816153f188cba0', 0x0a3483d2, 'up', '2025-09-27 07:37:08', '2025-09-27 07:37:08'),
(35, 2, 'dummy-5c14a8af4286fa98', 0x0ae57949, 'up', '2025-09-27 07:37:08', '2025-09-27 07:37:08'),
(36, 2, 'dummy-4bcff2d83b5be523', 0x0a4d847a, 'up', '2025-09-27 07:37:08', '2025-09-27 07:37:08'),
(37, 2, 'dummy-ed33d64fe0e3d90f', 0x0a85d0c3, 'up', '2025-09-27 07:37:08', '2025-09-27 07:37:08');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `voted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_india`
--

INSERT INTO `votes_india` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`, `voted_at`) VALUES
(1, 1, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 03:49:15', '2025-09-26 13:42:44'),
(2, 3, 'dedf132325b71dfd-8ae246e7', 0x00000000000000000000000000000001, 'up', '2025-09-26 07:44:11', '2025-09-26 13:42:44');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `voted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes_us`
--

INSERT INTO `votes_us` (`id`, `vpn_id`, `user_id`, `ip_address`, `vote`, `created_at`, `voted_at`) VALUES
(1, 3, '46db61b317a816c0-819f8c7a', 0x00000000000000000000000000000001, 'up', '2025-09-16 04:07:14', '2025-09-26 13:42:44');

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
(1, NULL, 0, 'https://www.expressvpn.com/', 92.34),
(2, NULL, 1, 'https://nordvpn.com/', 92.64),
(3, NULL, 0, 'https://surfshark.com/', 113.66),
(6, NULL, 0, 'https://protonvpn.com/', 71.27),
(14, NULL, 0, 'https://hide.me/', 70.92),
(16, NULL, 0, 'https://www.cyberghostvpn.com/', 92.64),
(18, NULL, 0, 'https://www.purevpn.com/', 78.05);

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
(1, NULL, 0, 'https://www.expressvpn.com/', 12.99),
(2, NULL, 0, 'https://nordvpn.com/', 12.99),
(3, NULL, 0, 'https://surfshark.com/', 15.95),
(6, NULL, 0, 'https://protonvpn.com/', 9.99),
(10, NULL, 0, 'https://www.tunnelbear.com/', 9.99),
(14, NULL, 0, 'https://hide.me/en/', 9.95),
(20, NULL, 0, 'https://windscribe.com/', 9.00);

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
(1, NULL, 0, 'https://www.expressvpn.com/', 1153.12),
(2, NULL, 1, 'https://nordvpn.com/', 1153.12),
(3, NULL, 0, 'https://surfshark.com/', 1415.88),
(10, NULL, 0, 'https://www.tunnelbear.com/', 886.81),
(18, NULL, 0, 'https://www.purevpn.com/', 1149.57),
(20, NULL, 0, 'https://windscribe.com/', 798.93);

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
(1, NULL, 0, 'https://www.expressvpn.com/', 12.95),
(2, NULL, 0, 'https://nordvpn.com/', 12.99),
(3, NULL, 1, 'https://surfshark.com/', 15.45),
(14, NULL, 0, 'https://hide.me/', 9.95),
(16, 67, 0, '', 33.00),
(20, NULL, 0, 'https://windscribe.com/', 9.00),
(21, NULL, 0, 'https://privatevpn.com/', NULL);

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
  `based_in` varchar(100) DEFAULT NULL,
  `Free_available` tinyint(1) DEFAULT NULL,
  `Platform` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vpn_master_table`
--

INSERT INTO `vpn_master_table` (`id`, `name`, `website_url`, `logo_path`, `created_at`, `suitable_for`, `supported_countries`, `features`, `server_count`, `device_limit`, `protocols_supported`, `logging_policy`, `based_in`, `Free_available`, `Platform`) VALUES
(1, 'ExpressVPN', 'https://www.expressvpn.com', 'assets/expressvpn.png', '2025-09-16 05:33:48', 'Streaming, travel/censorship, privacy, gaming', 105, 'TrustedServer (RAM-only) servers; Lightway protocol; Threat Manager tracker; malware blocking; MediaStreamer smart DNS for devices without VPN apps', 3000, 14, 'Lightway, OpenVPN, IKEv2', 'No activity or connection logs (audited)', 'British Virgin Islands', 0, 'Windows, macOS, iOS, Android, Linux, Routers'),
(2, 'NordVPN', 'https://nordvpn.com', 'assets\\nordvpn.png', '2025-09-16 05:33:48', 'Security-focused browsing, streaming, torrenting', 118, 'Threat Protection Pro; Double VPN; Onion over VPN', 7400, 10, 'NordLynx (WireGuard), OpenVPN, IKEv2', 'No-logs policy (audited)', 'Panama', 0, 'Windows, macOS, iOS, Android, Linux, Routers'),
(3, 'Surfshark', 'https://surfshark.com', 'assets\\surfsharkvpn.png', '2025-09-16 05:33:48', 'Households (unlimited devices), streaming, privacy in restrictive networks', 100, 'Unlimited devices; CleanWeb malware blocking; MultiHop (double VPN); Camouflage/Stealth (obfuscation)', 3200, 0, 'WireGuard, OpenVPN, IKEv2', 'No-logs policy (audited)', 'Netherlands', 0, 'Windows, macOS, iOS, Android, Linux, Routers'),
(6, 'Proton VPN', 'https://protonvpn.com', 'assets\\protonvpn.png', '2025-09-16 05:33:48', 'Privacy & censorship bypass (journalists/activists), streaming', 126, 'Secure Core; NetShield; Stealth protocol to evade DPI/firewalls; VPN Accelerator; independently audited no-logs (2025)', 12377, 10, 'WireGuard, OpenVPN, IKEv2', 'Strict no-logs policy (independently audited)', 'Switzerland', 1, 'Windows, macOS, iOS, Android, Linux, Routers'),
(10, 'TunnelBear', 'https://www.tunnelbear.com', 'assets\\tunnelbearvpn.png', '2025-09-16 05:33:48', 'Beginner-friendly privacy, basic streaming', 47, 'GhostBear (obfuscation); VigilantBear (kill switch); SplitBear (split tunneling)', NULL, NULL, 'WireGuard, OpenVPN, IKEv2', 'No-logs policy (audited)', 'Canada', 1, 'Windows, macOS, iOS, Android, Browser extensions'),
(14, 'Hide.me', 'https://hide.me', 'assets\\hidemevpn.png', '2025-09-16 05:33:48', 'Power users & P2P, privacy, gaming (port forwarding)', 91, 'Zero-log (independently audited); Bolt & Multihop; dynamic Port Forwarding; full IPv6 support; up to 10 devices on Premium', 2600, 10, 'WireGuard, OpenVPN, IKEv2', 'Zero-log (independently audited)', 'Malaysia', 1, 'Windows, macOS, iOS, Android, Linux'),
(16, 'CyberGhost', 'https://www.cyberghostvpn.com', 'assets/cyberghostvpn.png', '2025-09-16 10:00:26', 'Streaming (one-click profiles), general privacy', 100, 'NoSpy servers (in-house, Romania); streaming-optimized servers; optional Dedicated IP', 9800, 7, 'WireGuard, OpenVPN, IKEv2', 'No-logs policy (audited)', 'Romania', 0, 'Windows, macOS, iOS, Android, Linux, Routers'),
(17, 'Atlas VPN', 'https://atlasvpn.com', 'assets/atlasvpn.png', '2025-09-16 10:00:26', 'Gaming', 0, 'Service discontinued (see website)', 0, 0, NULL, 'Service discontinued (Apr 2024)', NULL, 0, 'Windows, macOS'),
(18, 'PureVPN', 'https://purevpn.com', 'assets\\purevpn.png', '2025-09-16 10:00:26', 'Dedicated IP / Port forwarding users (remote access, servers, P2P)', 65, 'Add-ons: Dedicated IP and Port Forwarding; (Linux client fix for IPv6/firewall leak pending mid-Oct 2025)', 6000, 10, 'WireGuard, OpenVPN, IKEv2', 'No-logs policy (audited)', 'British Virgin Islands', 0, 'Windows, macOS, iOS, Android, Linux, Routers'),
(19, 'Avast SecureLine VPN', 'https://www.avast.com/secureline-vpn', 'assets/tunnelbearvpn.png', '2025-09-16 10:00:26', 'Simple privacy & streaming on desktop/mobile', 35, 'Kill Switch; Split tunneling / connection rules on Android; Wi-Fi Threat Shield', 700, 10, 'WireGuard, OpenVPN', 'No activity logs; connection metadata may be retained', 'Czech Republic', 0, 'Windows, macOS, iOS, Android'),
(20, 'Windscribe', 'https://windscribe.com/', 'assets\\windscribevpn.png', '2025-09-23 07:38:27', 'Power users, ad/tracker blocking, P2P/port-forwarding', 69, 'R.O.B.E.R.T. customizable DNS blocker; Split tunneling; optional Static IP; multiple protocols incl. obfuscation', NULL, NULL, 'WireGuard, OpenVPN, IKEv2', 'No identifying logs', 'Canada', 1, 'Windows, macOS, iOS, Android, Linux, Routers'),
(21, 'PrivateVPN', 'http://privatevpn.com/', 'assets\\privatevpn.png', '2025-09-23 07:44:30', 'Torrenting/P2P and bypassing restrictions', 63, 'Stealth VPN (obfuscation); Port forwarding support', 200, 10, 'WireGuard, OpenVPN, IKEv2', 'No-logs policy', 'Sweden', 0, 'Windows, macOS, iOS, Android, Linux');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `votes_china`
--
ALTER TABLE `votes_china`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `votes_global`
--
ALTER TABLE `votes_global`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `votes_india`
--
ALTER TABLE `votes_india`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
