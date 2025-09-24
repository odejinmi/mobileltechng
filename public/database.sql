-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2024 at 01:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billspaypointmobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(1) DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) DEFAULT 0,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Super Admin', 'admin@admin.com', 'admin', NULL, '64be96b928d1d1690212025.png', '$2y$10$QdNqJCB0cXeUDLPvXq/.1ubHxZ2JyaUVGGG342/2Nh9pbhsbc.Ur.', 1, 'aWxQi7Xbjj2vgASOTDNlLuznknQg7fCnoDpFHsWlDUccCvZk6tpkQxC4HH5E', NULL, '2023-07-24 15:20:25'),
(3, 1, 'Staff 1', 'staff1@staff1.com', 'staff1', NULL, NULL, '$2y$10$Mn5XTcqZbPebpwyDBvjr3uu4yQzNnZN3uXu6rnlwAn5kYvAA.cnQm', 1, NULL, '2024-01-08 17:06:31', '2024-01-08 18:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `click_url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `user_id`, `title`, `is_read`, `click_url`, `created_at`, `updated_at`) VALUES
(80, 1, 'New member registered', 0, '/admin/users/detail/1', '2023-08-18 15:27:59', '2023-08-18 15:27:59'),
(81, 0, 'SMS Error: Undefined property: App\\Notify\\Sms::$sn', 0, '#', '2023-08-18 17:18:02', '2023-08-18 17:18:02'),
(82, 0, 'SMS Error: Undefined property: App\\Notify\\Sms::$sn', 0, '#', '2023-08-18 17:19:15', '2023-08-18 17:19:15'),
(83, 0, 'SMS Error: Undefined property: App\\Notify\\Sms::$sn', 0, '#', '2023-08-18 17:19:22', '2023-08-18 17:19:22'),
(84, 0, 'SMS Error: Undefined property: App\\Notify\\Sms::$sn', 0, '#', '2023-08-18 17:19:48', '2023-08-18 17:19:48'),
(85, 0, 'SMS Error: Undefined property: App\\Notify\\Sms::$sn', 0, '#', '2023-08-18 17:19:56', '2023-08-18 17:19:56'),
(86, 0, 'SMS Error: Undefined property: App\\Notify\\Sms::$sn', 0, '#', '2023-08-18 17:31:46', '2023-08-18 17:31:46'),
(87, 0, 'SMS Error: Undefined property: App\\Notify\\Sms::$sn', 0, '#', '2023-08-18 17:31:55', '2023-08-18 17:31:55'),
(88, 1, 'Deposit successful via BKash Name', 0, '/admin/deposit/successful', '2023-08-28 19:23:43', '2023-08-28 19:23:43'),
(89, 1, 'Deposit successful via BKash Name', 0, '/admin/deposit/successful', '2023-08-28 20:28:10', '2023-08-28 20:28:10'),
(90, 1, 'Deposit successful via BKash Name', 0, '/admin/deposit/successful', '2023-08-29 19:49:40', '2023-08-29 19:49:40'),
(91, 1, 'Deposit successful via BKash Name', 0, '/admin/deposit/successful', '2023-08-29 19:52:03', '2023-08-29 19:52:03'),
(92, 1, 'Deposit successful via BKash Name', 0, '/admin/deposit/successful', '2023-08-29 20:27:31', '2023-08-29 20:27:31'),
(93, 1, 'Deposit successful via BKash Name', 0, '/admin/deposit/successful', '2023-08-29 20:32:04', '2023-08-29 20:32:04'),
(94, 1, 'Deposit successful via BKash Name', 0, '/admin/deposit/successful', '2023-08-29 20:35:00', '2023-08-29 20:35:00'),
(95, 1, 'New loan request', 0, '/admin/loan/all?search=WEVO1HSHPOYG', '2024-03-05 12:51:06', '2024-03-05 12:51:06'),
(96, 3, 'New member registered', 0, '/admin/users/detail/3', '2024-04-21 08:09:19', '2024-04-21 08:09:19'),
(97, 1, 'New loan request', 0, '/admin/loan/all?search=RBY438CXASAA', '2024-04-22 18:28:45', '2024-04-22 18:28:45'),
(98, 1, 'New loan request', 0, '/admin/loan/all?search=FP5Q2TSVJB5F', '2024-04-22 19:16:48', '2024-04-22 19:16:48'),
(99, 1, 'Deposit successful via PayStack - NGN', 0, '/admin/deposit/successful', '2024-04-24 08:49:41', '2024-04-24 08:49:41'),
(100, 1, 'Deposit request from test1234', 0, '/admin/deposit/details/46', '2024-04-24 09:31:39', '2024-04-24 09:31:39'),
(101, 1, 'New support ticket has opened', 0, '/admin/ticket/view/1', '2024-04-24 10:33:49', '2024-04-24 10:33:49'),
(102, 1, 'New member registered', 0, '/admin/users/detail/1', '2024-04-29 21:11:06', '2024-04-29 21:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_password_resets`
--

INSERT INTO `admin_password_resets` (`id`, `email`, `token`, `status`, `created_at`) VALUES
(1, 'admin@admin.com', '263441', 1, '2023-07-12 00:08:47'),
(2, 'admin@admin.com', '458064', 0, '2023-07-12 00:09:15'),
(3, 'admin@admin.com', '967792', 0, '2023-07-12 04:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `airtime_cashes`
--

CREATE TABLE `airtime_cashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `network` varchar(11) DEFAULT NULL,
  `min` float(10,2) DEFAULT NULL,
  `max` float(10,2) NOT NULL,
  `fee` varchar(20) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(191) DEFAULT NULL,
  `price` float(10,3) NOT NULL,
  `ticket_id` varchar(20) NOT NULL,
  `event_id` int(40) DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Enable : 1, Disable : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `escrow_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `buyer_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `seller_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=>running, 0=>closed',
  `is_group` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0=>only 2 person, 1=> also admin will be added',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `escrow_id`, `buyer_id`, `seller_id`, `status`, `is_group`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 0, 0, '2023-12-23 09:59:21', '2023-12-23 10:05:53'),
(2, 2, 1, 2, 0, 0, '2023-12-23 10:14:51', '2023-12-23 10:18:18'),
(3, 3, 2, 1, 0, 0, '2023-12-23 10:33:12', '2023-12-23 10:33:42'),
(4, 4, 1, 2, 0, 0, '2023-12-23 10:34:13', '2023-12-23 10:34:28'),
(5, 5, 1, 0, 0, 0, '2023-12-23 10:36:06', '2023-12-23 10:36:19'),
(6, 6, 1, 2, 0, 0, '2023-12-23 10:37:31', '2023-12-23 10:39:33'),
(7, 7, 1, 2, 1, 0, '2023-12-23 10:40:56', '2023-12-23 10:40:56'),
(8, 8, 1, 0, 1, 0, '2023-12-23 10:49:24', '2023-12-23 10:49:24'),
(9, 9, 0, 1, 1, 0, '2024-01-03 18:09:58', '2024-01-03 18:09:58'),
(10, 10, 2, 1, 1, 0, '2024-01-08 14:03:27', '2024-01-08 14:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `cron_jobs`
--

CREATE TABLE `cron_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `alias` varchar(40) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `cron_schedule_id` int(11) NOT NULL DEFAULT 0,
  `next_run` datetime DEFAULT NULL,
  `last_run` datetime DEFAULT NULL,
  `is_running` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_job_logs`
--

CREATE TABLE `cron_job_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cron_job_id` int(11) NOT NULL DEFAULT 0,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `error` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_schedules`
--

CREATE TABLE `cron_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `interval` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cron_schedules`
--

INSERT INTO `cron_schedules` (`id`, `name`, `interval`, `status`, `created_at`, `updated_at`) VALUES
(1, '5 Minutes', 300, 1, '2023-07-22 10:03:29', '2023-07-22 10:03:29'),
(2, '10 Minutes', 600, 1, '2023-07-22 10:03:35', '2023-07-22 10:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `cryptocurrencies`
--

CREATE TABLE `cryptocurrencies` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `symbol` varchar(191) DEFAULT NULL,
  `wallet_address` varchar(250) DEFAULT NULL,
  `account_details` varchar(230) DEFAULT NULL,
  `minimum_amount` varchar(20) DEFAULT NULL,
  `maximum_amount` varchar(20) DEFAULT NULL,
  `icon` varchar(22) DEFAULT NULL,
  `apipass` varchar(99) DEFAULT NULL,
  `apikey` text DEFAULT NULL,
  `price` varchar(191) DEFAULT NULL,
  `merchant_trx_fee` varchar(16) DEFAULT NULL,
  `api_trx_fee` varchar(15) DEFAULT NULL,
  `swap_rate` varchar(10) DEFAULT NULL,
  `buy_rate` varchar(10) DEFAULT NULL,
  `sell_rate` varchar(10) DEFAULT NULL,
  `api_processing_fee` varchar(16) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `code` varchar(10) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cryptocurrencies`
--

INSERT INTO `cryptocurrencies` (`id`, `name`, `symbol`, `wallet_address`, `account_details`, `minimum_amount`, `maximum_amount`, `icon`, `apipass`, `apikey`, `price`, `merchant_trx_fee`, `api_trx_fee`, `swap_rate`, `buy_rate`, `sell_rate`, `api_processing_fee`, `image`, `code`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ethereum', 'ETH', '0xb794f5ea0ba39494ce839613fffba74279579268', NULL, '100', '100', 'Ξ', 'kay226872', 'lkj', '1888.77', '1', '0.003', '100', '2502', '400', '0.23', 'eth.png', '145', 1, '2021-01-15 03:14:00', '2018-02-15 03:36:57', '2024-02-24 05:23:52'),
(2, 'Bitcoin', 'BTC', '2DdMZCCP2BVZGduC6m7ED4nqXnX5nbV7OiEgIauzBctYy6', 'FCMB 05117711 Adex Joe', '10000', '1', '₿', 'kay22687', '$2y$10$I97uqr.aDdMZCCP2BVZGduC6m7ED4nqXnX5nbV7OiEgIauzBctYy6', '31689', '10', '0.0001', '100', '700', '760', '0.23', 'btc.svg', '859', 1, '2021-01-15 03:14:00', '2018-02-15 03:36:57', '2024-04-22 08:58:43'),
(3, 'Bitcoin Cash', 'BCH', NULL, NULL, NULL, NULL, '₿', NULL, NULL, '436.22', '1', '0.01', NULL, NULL, NULL, '0.23', 'bch.png', '157', 1, '2021-01-15 03:13:29', '2018-02-15 03:36:57', '2021-07-19 05:11:20'),
(4, 'Litecoin', 'LTC', NULL, NULL, NULL, NULL, 'Ł', NULL, NULL, '118.15', '1', '0.01	', NULL, NULL, NULL, '0.23', 'ltc.png', '359', 1, '2021-01-15 03:13:25', '2018-02-15 03:36:57', '2021-07-19 05:11:20'),
(5, 'Dashcoin', 'DASH', NULL, NULL, NULL, NULL, 'D', NULL, NULL, '114.24', '1', '0.02', NULL, NULL, NULL, '0.23', 'dash.png', '1188', 1, NULL, '2021-01-22 00:39:38', '2021-07-19 05:11:20'),
(6, 'Test Coin', 'TCN', NULL, NULL, '100', '100', 'T', 'kay22687', '$2y$10$Zth1BhELUq89vHHl7686fOj2IbwQH3zHtxRoaztqsFUY2W3rwNx82', '1', '1', '0.0001', '100', '100', '100', '0.23', 'busd.png', '1209', 1, '2021-01-15 03:13:17', '2018-10-22 09:49:14', '2024-04-12 22:10:25'),
(7, 'Binance', 'BNB', NULL, NULL, NULL, NULL, 'B', '', '', '1', '1', '0.008', NULL, NULL, NULL, '0.23', 'busd.png', '1209', 1, '2021-01-15 03:13:17', '2018-10-22 09:49:14', '2021-03-30 20:44:31'),
(11, 'USD Teter', 'USDTERC20', NULL, NULL, NULL, NULL, 'U', NULL, NULL, '1', '1', '4', NULL, NULL, NULL, '0.23', 'usdt.png', '637', 1, '2021-01-15 03:13:17', '2018-10-22 09:49:14', '2021-07-19 03:39:08'),
(118, 'Doge', 'DOGE', NULL, NULL, NULL, NULL, 'D', NULL, NULL, '0.181255', '1', '7', NULL, NULL, NULL, '0.23', 'doge.svg', '280', 1, NULL, '2021-01-22 00:39:38', '2021-07-19 05:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `cryptotrxes`
--

CREATE TABLE `cryptotrxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coin_id` int(11) DEFAULT NULL,
  `hash` text DEFAULT NULL,
  `trxid` text DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `to_address` text DEFAULT NULL,
  `type` varchar(88) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` varchar(17) DEFAULT NULL,
  `usd` varchar(30) DEFAULT NULL,
  `explorer_url` text DEFAULT NULL,
  `wallet_id` text DEFAULT NULL,
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cryptowallets`
--

CREATE TABLE `cryptowallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coin_id` int(11) NOT NULL,
  `label` varchar(22) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `qrcode` varchar(88) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `balance` double(16,8) DEFAULT 0.00000000,
  `usd` varchar(88) DEFAULT '0',
  `status` int(55) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(80) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(30) DEFAULT NULL,
  `account_number` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Enable : 1, Disable : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `milestone_id` int(10) DEFAULT NULL,
  `method_code` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `method_currency` varchar(40) DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `final_amo` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `detail` text DEFAULT NULL,
  `btc_amo` varchar(255) DEFAULT NULL,
  `btc_wallet` varchar(255) DEFAULT NULL,
  `trx` varchar(40) DEFAULT NULL,
  `try` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`from_api`)),
  `val_1` varchar(250) DEFAULT NULL,
  `val_2` varchar(250) DEFAULT NULL,
  `admin_feedback` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `tickets` longtext DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `top_property` tinyint(1) DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'pending : 0, approved : 1, cancel : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_infos`
--

CREATE TABLE `event_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `lefts` int(11) NOT NULL DEFAULT 0,
  `floor` int(11) NOT NULL DEFAULT 0,
  `room` int(11) DEFAULT NULL,
  `bathroom` int(11) NOT NULL DEFAULT 0,
  `kitchen` int(11) NOT NULL DEFAULT 0,
  `car_parking` int(11) DEFAULT NULL,
  `square_feet` decimal(28,8) DEFAULT NULL,
  `price` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `available_time` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Enable : 1, Disable : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `script` text DEFAULT NULL,
  `shortcode` text DEFAULT NULL COMMENT 'object',
  `support` text DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"--------------------\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2022-12-05 12:30:04'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"--------------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"--------------------\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2022-12-05 12:29:59'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 23:16:05', '2023-07-26 15:28:26'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, '2022-10-26 04:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `fdrs`
--

CREATE TABLE `fdrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fdr_number` varchar(40) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL,
  `per_installment` decimal(28,8) NOT NULL,
  `installment_interval` int(11) NOT NULL COMMENT 'In Day',
  `profit` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 = Running, 2= Closed',
  `next_installment_date` date DEFAULT NULL,
  `locked_date` date DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fdr_plans`
--

CREATE TABLE `fdr_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `minimum_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `maximum_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `installment_interval` int(11) NOT NULL DEFAULT 0 COMMENT 'In Day',
  `interest_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `locked_days` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) DEFAULT NULL,
  `form_data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `act`, `form_data`, `created_at`, `updated_at`) VALUES
(2, 'loan_plan', '{\"reason_for_loan\":{\"name\":\"Reason For Loan\",\"label\":\"reason_for_loan\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"},\"state\":{\"name\":\"State\",\"label\":\"state\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2023-07-15 14:37:22', '2024-03-05 13:17:00'),
(3, 'manual_deposit', '{\"bank_name\":{\"name\":\"Bank Name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"account_number\":{\"name\":\"Account Number\",\"label\":\"account_number\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"}}', '2023-07-15 14:18:35', '2024-04-24 09:07:17'),
(4, 'manual_deposit', '{\"bank_name\":{\"name\":\"bank name\",\"label\":\"bank_name\",\"is_required\":\"required\",\"extensions\":null,\"options\":[],\"type\":\"text\"},\"me\":{\"name\":\"Me\",\"label\":\"me\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"fcmb\",\"access\"],\"type\":\"select\"},\"file\":{\"name\":\"file\",\"label\":\"file\",\"is_required\":\"optional\",\"extensions\":\"jpg,jpeg\",\"options\":[],\"type\":\"file\"},\"melody\":{\"name\":\"Melody\",\"label\":\"melody\",\"is_required\":\"optional\",\"extensions\":null,\"options\":[],\"type\":\"textarea\"},\"terms\":{\"name\":\"terms\",\"label\":\"terms\",\"is_required\":\"required\",\"extensions\":null,\"options\":[\"true\",\"false\"],\"type\":\"checkbox\"},\"radio\":{\"name\":\"radio\",\"label\":\"radio\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[\"true\",\"false\"],\"type\":\"radio\"}}', '2023-07-15 14:37:22', '2023-07-15 14:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(40) DEFAULT NULL,
  `data_values` longtext DEFAULT NULL,
  `val_1` int(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `val_1`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"giftcard\",\"amazon\",\"itunes\",\"store\",\"online\",\"card\"],\"description\":\"This is the best giftcard trading store online\",\"social_title\":\"sample\",\"social_description\":\"sample\",\"image\":\"6630d8b304aac1714477235.png\"}', NULL, '2020-07-04 23:42:52', '2024-04-30 10:40:35'),
(25, 'blog.content', '{\"heading\":\"Blog\",\"sub_heading\":\"Our Latest News Blog\"}', NULL, '2020-10-28 00:51:34', '2022-10-10 03:14:44'),
(27, 'contact_us.content', '{\"title\":\"Auctor gravida vestibulu\",\"short_details\":\"55f55\",\"email_address\":\"5555f\",\"contact_details\":\"5555h\",\"contact_number\":\"5555a\",\"latitude\":\"5555h\",\"longitude\":\"5555s\",\"website_footer\":\"5555qqq\"}', NULL, '2020-10-28 00:59:19', '2020-11-01 04:51:54'),
(36, 'service.content', '{\"has_image\":\"1\",\"heading\":\"Service\",\"sub_heading\":\"Our Premium Services\",\"image\":\"64df3a8a555d11692351114.png\"}', NULL, '2021-03-06 01:27:34', '2023-08-18 13:15:21'),
(39, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"Bills Pay Point\",\"sub_heading\":\"Pay bills from over 100 countries and 700plus service providers\",\"button\":\"Get Started Now\",\"button_link\":\"user\\/register\",\"image\":\"64df35a7639151692349863.png\"}', NULL, '2021-05-02 06:09:30', '2023-08-18 09:16:22'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How do we protect your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Do we disclose any information to outside parties?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">Changes to our Privacy Policy<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">How long we retain your information?<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><\\/div><div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What we don\\u2019t do with your data<\\/h3><p class=\\\"font-18\\\" style=\\\"margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\",\"status\":1}', NULL, '2020-07-04 23:42:52', '2022-03-30 11:23:12'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div>\"}', NULL, '2020-07-04 23:42:52', '2022-05-11 03:57:17'),
(50, 'action.content', '{\"heading\":\"Global Bills Payment System\",\"sub_heading\":\"Take Your Website To Next Level\",\"button\":\"Get Started Now\",\"button_url\":\"user\\/login\"}', NULL, '2022-10-10 03:12:05', '2023-08-18 13:14:16'),
(51, 'address.content', '{\"phone\":\"5488848798\",\"email\":\"demo@biilspaypoint.test\",\"address\":\"Oklahoma, Japan\"}', NULL, '2022-10-10 03:12:24', '2023-08-18 13:14:44'),
(53, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Lacus Nunc Suscipit Vitae Ncatqreet\",\"short_description\":\"Doloribus Enim Temporibus Deserunt Aperiam Velit Illo Neque Laboriosam Eum Impedit Perferendis\",\"description\":\"<div>Lorem Ipsum Dolor Sit Amet, Sed Diam Massa Id Odio Ornare In. Sit \\nDapibus Duis Libero Donec, Ac Maecenas Parturient Ipsum, Dolor Et Fusce \\nMauris Scelerisque Malesuada Ac. Nisl Placerat Ridicu Orci,In Libero Sit\\n Amet Hendrerit Ridiculus Etiam Ut. Auctor Et Aenean Hendrerit Posuere \\nPenatibus Elit Placerat, Ut Ut Turpis Aenean Class, Labore Elementum At \\nDiam Libero Ipsum, Aenean Sed Dapibus, In Sed Fusce. Amet Luctus Amet \\nSollicitudin Tincidunt In, Erat Nonummy Neque Scelerisque, Amet Rutrum \\nMagna Est Tristique Nullam<\\/div><div><br \\/><\\/div><div>In, Erat Nonummy \\nNeque Scelerisque, Amet Rutrum Magna Est Tristique Nullam. Viverra Eos \\nElit, Curabitur Sit Sollicitudin Volutpat Metus Vehicula. In Justo \\nConsequat Id, Ligula Eleifend Feugiat, Eget Eros. At Imperdiet Velit \\nTempor. Purus Eget, Lacus Nunc, Feugiat Magna Vel Erat Nullam Sociis \\nMattis, Platea Ultricies Feugiat Felis Non, Litora Pharetra Aliquet Ac \\nFringilla Luctus Tellus.Fringilla Luctus Tellus.Ndrerit Posuere \\nPenatibus Elit<\\/div><div><br \\/><\\/div><div>Aliquet Ac Fringilla Luctus \\nTellus.Ndrerit Posuere Penatibus Elit Placerat, Ut Ut Turpis Aenean \\nClass, Labore Elementum At Diam Libero Ipsum, Aenean Sed Dapibus, In Sed\\n Fusce. Alicitudin Tincidunt In, Erat Alicitudin Tincidunt<\\/div><div><br \\/><\\/div><div>Pellentesque\\n Vel, Eleifend Pellentesque Tortor Potenti, Arcu Ligula Ullamcorper \\nDolor Magna, Et A Turpis. Maecenas Integer Lorem Vitae Sit Urna, Feugiat\\n Nascetur, Elit At Enim Est Wisi Massa, Porttitor Suspendisse Lectus \\nFacilisis, Magna Eget. Orci Nulla Orci Consequat Lorem Eget Ligula, \\nIaculis Dapibus Turpis Eros, Mauris Dui Viverra In. Lectus Orci Interdum\\n Tellus Vel Eget. Torquent Tortor Sapien Ea, Turpis Sapien Ullamcorper \\nMassa Quis Magna Aliquam, Venenatis Odio, Curabitur Nec Quis Enim Saepe \\nNullam. Tellus Hendrerit Purus Tristique. Nec Ultricies Dolorem Diam, \\nQuisque Convallis Cras Sit Molestie Eget Ac, Varius Amet Venenatis. \\nTellus Nec Facilisis Vel Sem Sit, Ac Viverra, Et Praesent Lectus, Fusce \\nMorbi Purus Ut Rutrum Aliquam, Facilisi Et Rutrum Officia. Nec Risus \\nTristique Erat Id Quisque, Quis Fringilla Vulputate, Fringilla Tortor \\nEget Auctor.<\\/div><div><br \\/><\\/div><div>Nunc Odio Libero Sit, Vitae \\nLacinia Dui Porttitor. Nunc Congue Magna Ut Ut, Ornare Purus Varius \\nSuscipit Nteger Bibendum Semper Ut Congue, Ut Fusce Id Et Ullamcorper \\nAugue Consectetuer, Duis Torquent, Quisque Congue, Hendrerit In Ad Wisi.\\n In Id At, Erat Fermentum Euismod Sed Mi Turpis.<\\/div>\",\"image\":\"64c27d9b6295f1690467739.jpeg\"}', 12, '2022-10-10 03:16:13', '2023-08-28 23:29:13'),
(55, 'contact.content', '{\"has_image\":\"1\",\"image\":\"64a2f5637556e1688401251.png\"}', NULL, '2022-10-10 03:17:43', '2023-07-03 16:20:51'),
(56, 'counter.element', '{\"icon\":\"<i class=\\\"icon fa fa-users\\\"><\\/i>\",\"title\":\"ACTIVE USERS\",\"number\":\"17500\"}', NULL, '2022-10-10 03:18:19', '2023-07-23 23:21:41'),
(57, 'counter.element', '{\"icon\":\"<i class=\\\"icon fa fa-industry\\\"><\\/i>\",\"title\":\"TOTAL COMPANIES\",\"number\":\"1000\"}', NULL, '2022-10-10 03:18:39', '2023-07-23 23:21:59'),
(58, 'counter.element', '{\"icon\":\"<i class=\\\"icon fa fa-rocket\\\"><\\/i>\",\"title\":\"CAMPAIGN POSTED\",\"number\":\"3500\"}', NULL, '2022-10-10 03:18:55', '2023-07-23 23:22:52'),
(59, 'counter.element', '{\"icon\":\"<i class=\\\"icon fa fa-handshake-o\\\"><\\/i>\",\"title\":\"CUSTOMER SUPPORT\",\"number\":\"24H\"}', NULL, '2022-10-10 03:19:11', '2023-07-23 23:22:31'),
(60, 'testimonial.content', '{\"heading\":\"Clients feedback\",\"sub_heading\":\"1000+ Companies Have Switched To Our Company\"}', NULL, '2022-10-10 03:20:56', '2023-08-14 22:32:07'),
(61, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Sophia Sosa\",\"designation\":\"Engineer\",\"review\":\"Ad aut corrupti. Neque sunt maxime suscipit itaque minima voluptatem.\",\"Ratting_out_of_five\":\"5\",\"image\":\"6343b2e8179eb1665381096.png\"}', NULL, '2022-10-10 03:21:36', '2022-11-14 07:42:35'),
(62, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Lana Mcpherson\",\"designation\":\"Product Expert\",\"review\":\"Ad aut corrupti. Neque sunt maxime suscipit itaque minima voluptatem.\",\"Ratting_out_of_five\":\"4\",\"image\":\"6343b386391881665381254.png\"}', NULL, '2022-10-10 03:24:14', '2022-11-14 07:42:55'),
(63, 'testimonial.element', '{\"has_image\":\"1\",\"name\":\"Maxwell Morgan\",\"designation\":\"Consultant\",\"review\":\"Ad aut corrupti. Neque sunt maxime suscipit itaque minima voluptatem.\",\"Ratting_out_of_five\":\"5\",\"image\":\"6343b3c5e5dc81665381317.png\"}', NULL, '2022-10-10 03:25:17', '2022-11-14 07:43:03'),
(64, 'subscribe.content', '{\"heading\":\"Subscribe Our Social Now\"}', NULL, '2022-10-10 03:25:34', '2022-10-10 03:25:34'),
(70, 'service.element', '{\"icon\":\"<i class=\\\"icon fa fa-adn\\\"><\\/i>\",\"title\":\"Premium Giftcard System\",\"content\":\"Perspiciatis Praesentium Ipsum Aliquid Veritatis, Nobis Minima Corrupti Excepturi Quis Porro Ipsum Vel.\"}', NULL, '2022-10-10 03:29:02', '2023-07-27 12:36:11'),
(72, 'footer.element', '{\"social_icon\":\"<i class=\\\"icon fa fa-anchor\\\"><\\/i>\",\"social_url\":\"https:\\/\\/www.google.com\\/\"}', NULL, '2022-10-10 03:30:33', '2023-07-23 22:11:56'),
(73, 'footer.element', '{\"social_icon\":\"<i class=\\\"icon fa fa-instagram\\\"><\\/i>\",\"social_url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, '2022-10-10 03:30:56', '2023-07-23 22:23:59'),
(74, 'footer.element', '{\"social_icon\":\"<i class=\\\"icon fa fa-twitter\\\"><\\/i>\",\"social_url\":\"https:\\/\\/www.twitter.com\\/\"}', NULL, '2022-10-10 03:31:15', '2023-07-23 22:24:16'),
(75, 'footer.element', '{\"social_icon\":\"<i class=\\\"icon fa fa-facebook-square\\\"><\\/i>\",\"social_url\":\"https:\\/\\/www.facebook.com\\/\"}', NULL, '2022-10-10 03:31:31', '2023-07-23 22:24:26'),
(76, 'footer.content', '{\"content\":\"Minima Labore Vel Temporibus, Laborum, Quaerat Id Eius Minus Hic Culpa Dolor\"}', NULL, '2022-10-10 03:31:45', '2022-10-10 03:31:45'),
(77, 'feature.element', '{\"icon\":\"<i class=\\\"icon fa fa-picture-o\\\"><\\/i>\",\"title\":\"Airtime Vending\",\"content\":\"Perspiciatis Praesentium Ipsum Aliquid Veritatis, Nobis Minima Corrupti Excepturi Quis Porro Ipsum Vel.\"}', NULL, '2022-10-10 03:32:13', '2023-08-18 13:45:06'),
(78, 'feature.element', '{\"icon\":\"<i class=\\\"icon fa fa-align-right\\\"><\\/i>\",\"title\":\"Happy Customers\",\"content\":\"Perspiciatis Praesentium Ipsum Aliquid Veritatis, Nobis Minima Corrupti Excepturi Quis Porro Ipsum Vel.\"}', NULL, '2022-10-10 03:32:37', '2023-07-27 12:47:21'),
(79, 'feature.element', '{\"icon\":\"<i class=\\\"icon fa fa-key\\\"><\\/i>\",\"title\":\"Secure\",\"content\":\"Perspiciatis Praesentium Ipsum Aliquid Veritatis, Nobis Minima Corrupti Excepturi Quis Porro Ipsum Vel.\"}', NULL, '2022-10-10 03:32:56', '2023-07-27 12:48:52'),
(80, 'faq.content', '{\"heading\":\"Faq\",\"sub_heading\":\"Frequently Asked Questions\"}', NULL, '2022-10-10 03:33:43', '2024-04-30 10:49:31'),
(81, 'faq.element', '{\"question\":\"Repetition, injected humour or non ?\",\"answer\":\"The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \\\"de Finibus Bonorum et Malorum\\\" by Cicero are also\"}', NULL, '2022-10-10 03:33:59', '2022-10-10 03:33:59'),
(82, 'faq.element', '{\"question\":\"Inibus Bonorum \\\"Extremes of Good\\u201d ?\",\"answer\":\"The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \\\"de Finibus Bonorum et Malorum\\\" by Cicero are also\"}', NULL, '2022-10-10 03:34:13', '2022-10-10 03:34:13'),
(83, 'faq.element', '{\"question\":\"Duis eleifend molestie leo at mollis ?\",\"answer\":\"The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \\\"de Finibus Bonorum et Malorum\\\" by Cicero are also\"}', NULL, '2022-10-10 03:34:25', '2022-10-10 03:34:25'),
(86, 'about_1.content', '{\"has_image\":\"1\",\"title\":\"About Bills Pay Point\",\"description\":\"<p class=\\\"text-sm\\/relaxed tracking-wider text-gray-600 mb-5\\\">\\n                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam beatae vitae dicta sunt explicabo.\\n                    <\\/p>\\n                    <p class=\\\"text-sm\\/relaxed tracking-wider text-gray-600 mb-7\\\">\\n                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam beatae vitae dicta sunt explicabo.\\n                    <\\/p>\",\"image\":\"64db5f3d721271692098365.png\"}', NULL, '2022-10-24 06:33:01', '2023-08-18 13:13:55'),
(87, 'about_2.content', '{\"has_image\":\"1\",\"title\":\"Get The Pictures Of ROI\",\"description\":\"<span style=\\\"text-transform:capitalize;\\\">Ducimus Nulla Obcaecati Veritatis Inventore Amet Dignissimos, Eaque Molestias Id Eos Tempore Fuga Explicabo Distinctio, Animi Repellat Atque Reiciendis Fugit Alias Suscipit Voluptate Nam? Deleniti Aliquid Accusantium Voluptas Provident. Repudiandae Libero Asperiores Voluptatum<\\/span><br \\/>\",\"image\":\"63565531c04741666602289.png\"}', NULL, '2022-10-24 06:34:49', '2022-10-24 06:34:49'),
(88, 'about_3.content', '{\"has_image\":\"1\",\"title\":\"Add Multiple Team Members\",\"description\":\"<span style=\\\"color:rgb(117,139,159);text-transform:capitalize;\\\">Ducimus Nulla Obcaecati Veritatis Inventore Amet Dignissimos, Eaque Molestias Id Eos Tempore Fuga Explicabo Distinctio, Animi Repellat Atque Reiciendis Fugit Alias Suscipit Voluptate Nam? Deleniti Aliquid Accusantium Voluptas Provident. Repudiandae Libero Asperiores Voluptatum<\\/span><br \\/>\",\"image\":\"6356554e552e71666602318.png\"}', NULL, '2022-10-24 06:35:18', '2022-10-24 06:35:18'),
(91, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The standard Lorem Ipsum passage, used since the 1500s\",\"short_description\":\"\\\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut\",\"description\":\"<h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\">The standard Lorem Ipsum passage, used since the 1500s<\\/h3><p style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\">Section 1.10.32 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\">Section 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\", written by Cicero in 45 BC<\\/h3><p style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\\\"<\\/p><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\">1914 translation by H. Rackham<\\/h3><p style=\\\"margin-right:0px;margin-bottom:15px;margin-left:0px;padding:0px;text-align:justify;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;font-size:14px;\\\">\\\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\\\"<\\/p>\",\"image\":\"64c275b7df1421690465719.png\"}', 18, '2022-10-24 07:01:33', '2023-08-29 00:01:16'),
(93, 'privacy_policy.element', '{\"title\":\"Privacy and Policy\",\"content\":\"<h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:700;line-height:1.2em;font-size:24px;clear:both;color:rgb(3,28,108);text-transform:capitalize;font-family:Poppins, sans-serif;font-style:normal;letter-spacing:normal;text-align:left;text-indent:0px;white-space:normal;word-spacing:0px;\\\">What Information Do We Collect?<\\/h3><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/div><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><br \\/><\\/div><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:700;line-height:1.2em;font-size:24px;clear:both;color:rgb(3,28,108);text-transform:capitalize;font-family:Poppins, sans-serif;font-style:normal;letter-spacing:normal;text-align:left;text-indent:0px;white-space:normal;word-spacing:0px;\\\">How Do We Protect Your Information?<\\/h3><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">All provided delicate\\/credit data is sent through Stripe.<\\/div><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/div><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><br \\/><\\/div><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:700;line-height:1.2em;font-size:24px;clear:both;color:rgb(3,28,108);text-transform:capitalize;font-family:Poppins, sans-serif;font-style:normal;letter-spacing:normal;text-align:left;text-indent:0px;white-space:normal;word-spacing:0px;\\\">Do We Disclose Any Information To Outside Parties?<\\/h3><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/div><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><br \\/><\\/div><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:700;line-height:1.2em;font-size:24px;clear:both;color:rgb(3,28,108);text-transform:capitalize;font-family:Poppins, sans-serif;font-style:normal;letter-spacing:normal;text-align:left;text-indent:0px;white-space:normal;word-spacing:0px;\\\">Children\'s Online Privacy Protection Act Compliance<\\/h3><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/div><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><br \\/><\\/div><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:700;line-height:1.2em;font-size:24px;clear:both;color:rgb(3,28,108);text-transform:capitalize;font-family:Poppins, sans-serif;font-style:normal;letter-spacing:normal;text-align:left;text-indent:0px;white-space:normal;word-spacing:0px;\\\">Changes To Our Privacy Policy<\\/h3><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">If we decide to change our privacy policy, we will post those changes on this page.<\\/div><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><br \\/><\\/div><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:700;line-height:1.2em;font-size:24px;clear:both;color:rgb(3,28,108);text-transform:capitalize;font-family:Poppins, sans-serif;font-style:normal;letter-spacing:normal;text-align:left;text-indent:0px;white-space:normal;word-spacing:0px;\\\">How Long We Retain Your Information?<\\/h3><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/div><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><br \\/><\\/div><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:700;line-height:1.2em;font-size:24px;clear:both;color:rgb(3,28,108);text-transform:capitalize;font-family:Poppins, sans-serif;font-style:normal;letter-spacing:normal;text-align:left;text-indent:0px;white-space:normal;word-spacing:0px;\\\">What We Don\\u2019t Do With Your Data<\\/h3><div style=\\\"color:rgb(117,139,159);font-family:Poppins, sans-serif;font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-align:left;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\">We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/div>\"}', NULL, '2022-11-19 04:48:40', '2022-11-19 06:03:06'),
(94, 'privacy_policy.element', '{\"title\":\"Terms and  Condition\",\"content\":\"<div class=\\\"one_line_col\\\" style=\\\"color:rgb(33,37,41);font-family:\'system-ui\', \'-apple-system\', \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, \'Noto Sans\', \'Liberation Sans\', sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\', \'Noto Color Emoji\';font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><h2 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;font-size:2rem;\\\">Types of Data collected<\\/h2><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">Among the types of Personal Data that this Website collects, by itself or through third parties, there are: Cookies; Usage Data.<\\/p><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">Complete details on each type of Personal Data collected are provided in the dedicated sections of this privacy policy or by specific explanation texts displayed prior to the Data collection.<br \\/>Personal Data may be freely provided by the User, or, in case of Usage Data, collected automatically when using this Website.<br \\/>Unless specified otherwise, all Data requested by this Website is mandatory and failure to provide this Data may make it impossible for this Website to provide its services. In cases where this Website specifically states that some Data is not mandatory, Users are free not to communicate this Data without consequences to the availability or the functioning of the Service.<br \\/>Users who are uncertain about which Personal Data is mandatory are welcome to contact the Owner.<br \\/>Any use of Cookies \\u2013 or of other tracking tools \\u2013 by this Website or by the owners of third-party services used by this Website serves the purpose of providing the Service required by the User, in addition to any other purposes described in the present document and in the Cookie Policy, if available.<\\/p><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">Users are responsible for any third-party Personal Data obtained, published or shared through this Website and confirm that they have the third party\'s consent to provide the Data to the Owner.<\\/p><\\/div><div class=\\\"one_line_col\\\" style=\\\"color:rgb(33,37,41);font-family:\'system-ui\', \'-apple-system\', \'Segoe UI\', Roboto, \'Helvetica Neue\', Arial, \'Noto Sans\', \'Liberation Sans\', sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\', \'Noto Color Emoji\';font-size:16px;font-style:normal;font-weight:400;letter-spacing:normal;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;\\\"><h2 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;font-size:2rem;\\\">Mode and place of processing the Data<\\/h2><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;font-size:1.75rem;\\\">Methods of processing<\\/h3><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">The Owner takes appropriate security measures to prevent unauthorized access, disclosure, modification, or unauthorized destruction of the Data.<br \\/>The Data processing is carried out using computers and\\/or IT enabled tools, following organizational procedures and modes strictly related to the purposes indicated. In addition to the Owner, in some cases, the Data may be accessible to certain types of persons in charge, involved with the operation of this Website (administration, sales, marketing, legal, system administration) or external parties (such as third-party technical service providers, mail carriers, hosting providers, IT companies, communications agencies) appointed, if necessary, as Data Processors by the Owner. The updated list of these parties may be requested from the Owner at any time.<\\/p><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;font-size:1.75rem;\\\">Legal basis of processing<\\/h3><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">The Owner may process Personal Data relating to Users if one of the following applies:<\\/p><ul style=\\\"padding-left:2rem;margin-top:0px;margin-bottom:1rem;\\\"><li>Users have given their consent for one or more specific purposes. Note: Under some legislations the Owner may be allowed to process Personal Data until the User objects to such processing (\\u201copt-out\\u201d), without having to rely on consent or any other of the following legal bases. This, however, does not apply, whenever the processing of Personal Data is subject to European data protection law;<\\/li><li>provision of Data is necessary for the performance of an agreement with the User and\\/or for any pre-contractual obligations thereof;<\\/li><li>processing is necessary for compliance with a legal obligation to which the Owner is subject;<\\/li><li>processing is related to a task that is carried out in the public interest or in the exercise of official authority vested in the Owner;<\\/li><li>processing is necessary for the purposes of the legitimate interests pursued by the Owner or by a third party.<\\/li><\\/ul><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">In any case, the Owner will gladly help to clarify the specific legal basis that applies to the processing, and in particular whether the provision of Personal Data is a statutory or contractual requirement, or a requirement necessary to enter into a contract.<\\/p><h3 style=\\\"margin-top:0px;margin-bottom:0.5rem;font-weight:500;line-height:1.2;font-size:1.75rem;\\\">Place<\\/h3><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">The Data is processed at the Owner\'s operating offices and in any other places where the parties involved in the processing are located.<br \\/><br \\/>Depending on the User\'s location, data transfers may involve transferring the User\'s Data to a country other than their own. To find out more about the place of processing of such transferred Data, Users can check the section containing details about the processing of Personal Data.<\\/p><p style=\\\"margin-top:0px;margin-bottom:1rem;\\\">Users are also entitled to learn about the legal basis of Data transfers to a country outside the European Union or to any international organization governed by public international law or set up by two or more countries, such as the UN, and about the security measures taken by the Owner to safeguard their Data.<br \\/><br \\/>If any such transfer takes place, Users can find out more by checking the relevant sections of this document or inquire with the Owner using the information provided in the contact section.<\\/p><\\/div>\"}', NULL, '2022-11-19 04:49:08', '2022-11-19 05:01:11'),
(96, 'service.element', '{\"icon\":\"<i class=\\\"icon fa fa-amazon\\\"><\\/i>\",\"title\":\"Best Rates\",\"content\":\"We offer the best rates\"}', NULL, '2023-07-27 12:54:43', '2023-07-27 12:54:43'),
(97, 'feature.content', '{\"heading\":\"Our Features\",\"sub_heading\":\"Many reasons to use our services for your trading\"}', NULL, '2023-08-11 08:19:49', '2023-08-11 08:19:49'),
(98, 'partners.content', '{\"heading\":\"Our Premium Partners\",\"sub_heading\":\"Our premium valued partners\"}', NULL, '2023-08-14 22:38:16', '2023-08-14 22:47:38'),
(100, 'partners.element', '{\"has_image\":\"1\",\"image\":\"64ed344adfe141693267018.jpeg\"}', NULL, '2023-08-14 22:49:32', '2023-08-28 23:56:58'),
(101, 'partners.element', '{\"has_image\":\"1\",\"image\":\"64ed343f1029a1693267007.png\"}', NULL, '2023-08-14 22:50:25', '2023-08-28 23:56:47'),
(102, 'counter.content', '{\"heading\":\"Numbers dont lie\",\"sub_heading\":\"we are a brand with the best counter\"}', NULL, '2023-08-14 23:06:57', '2023-08-14 23:06:57'),
(103, 'login.content', '{\"has_image\":\"1\",\"heading\":\"Magic Begins Here\",\"sub_heading\":\"Pay bills from over 300 countries across the globe from over 700 bill payment service providers\",\"image\":\"64df3dd61d5221692351958.png\"}', NULL, '2023-08-18 09:43:57', '2023-08-18 09:47:45'),
(104, 'register.content', '{\"has_image\":\"1\",\"heading\":\"Register Your Account\",\"sub_heading\":\"Please fill the form to register an account\",\"image\":\"64df3f765ac771692352374.png\"}', NULL, '2023-08-18 09:52:37', '2023-08-18 09:52:54'),
(105, 'password.content', '{\"has_image\":\"1\",\"heading\":\"Reset your password with ease\",\"sub_heading\":\"Please follow the guidelines to reset password\",\"image\":\"64df3fefc8d271692352495.png\"}', NULL, '2023-08-18 09:54:55', '2023-08-18 09:54:55'),
(106, 'emailauth.content', '{\"has_image\":\"1\",\"heading\":\"Email Verification\",\"sub_heading\":\"Please enter the security code sent to your email address\",\"image\":\"64df42589c7991692353112.png\"}', NULL, '2023-08-18 10:04:40', '2023-08-18 10:05:12'),
(107, 'smsauth.content', '{\"has_image\":\"1\",\"heading\":\"SMS Verification\",\"sub_heading\":\"Enter the security code sent to your phone number\",\"image\":\"64df431c6ae681692353308.png\"}', NULL, '2023-08-18 10:08:28', '2023-08-18 10:08:28'),
(108, 'partners.element', '{\"has_image\":\"1\",\"image\":\"64ed345f8c7271693267039.png\"}', NULL, '2023-08-28 23:57:19', '2023-08-28 23:57:19'),
(109, 'partners.element', '{\"has_image\":\"1\",\"image\":\"64ed34655f3ed1693267045.jpeg\"}', NULL, '2023-08-28 23:57:25', '2023-08-28 23:57:25'),
(110, 'partners.element', '{\"has_image\":\"1\",\"image\":\"64ed347bbaa5d1693267067.png\"}', NULL, '2023-08-28 23:57:47', '2023-08-28 23:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `code` int(10) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `alias` varchar(40) NOT NULL DEFAULT 'NULL',
  `image` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text DEFAULT NULL,
  `supported_currencies` text DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', '5f6f1bd8678601601117144.jpg', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"--------------------\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:51'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', '5f6f1d2a742211601117482.jpg', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"--------------------\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:32:16'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', '5f6f1d4bc69e71601117515.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"--------------------\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:32:29'),
(4, 0, 104, 'Skrill', 'Skrill', '5f6f1d41257181601117505.jpg', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"--------------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"--------------------\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:32:25'),
(5, 0, 105, 'PayTM', 'Paytm', '5f6f1d1d3ec731601117469.jpg', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"--------------------\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"--------------------\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"--------------------\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:32:12'),
(6, 0, 106, 'Payeer', 'Payeer', '5f6f1bc61518b1601117126.jpg', 0, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"--------------------\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:48'),
(7, 0, 107, 'PayStack', 'Paystack', '5f7096563dfb71601214038.jpg', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_257c929b64cda13f16d17e16b6fdec762aef0559\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_ae65fab010dd2e551b8c9801528ed635c047baf2\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2023-07-22 14:03:36'),
(8, 0, 108, 'VoguePay', 'Voguepay', '5f6f1d5951a111601117529.jpg', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:32:41'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', '5f6f1b9e4bb961601117086.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"FLWPUBK_TEST-SANDBOXDEMOKEY-X\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"FLWSECK_TEST-SANDBOXDEMOKEY-X\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-01-03 08:19:10'),
(10, 0, 110, 'RazorPay', 'Razorpay', '5f6f1d3672dd61601117494.jpg', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"--------------------\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"--------------------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:32:21'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', '5f7096a31ed9a1601214115.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_4eC39HqLyjWDarjtT1zdp7dc\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"sk_test_4eC39HqLyjWDarjtT1zdp7dc\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:32:33'),
(12, 0, 112, 'Instamojo', 'Instamojo', '5f6f1babbdbb31601117099.jpg', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"--------------------\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"--------------------\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"--------------------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:33'),
(13, 0, 501, 'Blockchain', 'Blockchain', '5f6f1b2b20c6f1601116971.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------------------\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"--------------------\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:30:58'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', '5f6f1b6c02ecd1601117036.jpg', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"--------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:18'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '5f6f1b94e9b2b1601117076.jpg', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:24'),
(17, 0, 505, 'Coingate', 'Coingate', '5f6f1b5fe18ee1601117023.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:15'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '5f6f1b4c774af1601117004.jpg', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------------------\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\n\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:11'),
(19, 0, 500, 'Bkash', 'Bkash', '5f70968f3835789094A.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"4f6o0cjiki2rfm34kfdadl1eqq\"},\"api_secret\":{\"title\":\"API Secret Key\",\"global\":true,\"value\":\"2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b\"},\"username\":{\"title\":\"API Username\",\"global\":true,\"value\":\"sandboxTokenizedUser02\"},\"password\":{\"title\":\"API Password\",\"global\":true,\"value\":\"sandboxTokenizedUser02@12345\"},\"access\":{\"title\":\"API Access \'TEST or LIVE\'\",\"global\":true,\"value\":\"TEST\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2023-08-28 20:10:48'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', '5f6f1bec255c61601117164.jpg', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"--------------------\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"--------------------\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:56'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', '5f709684736321601214084.jpg', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2023-11-21 08:41:57'),
(27, 0, 115, 'Mollie', 'Mollie', '5f6f1bb765ab11601117111.jpg', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"--------------------\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"--------------------\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-12-05 12:31:41'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', '5f9a8b62bb4dd1603963746.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"--------------------\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"--------------------\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2022-12-05 12:31:06'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', '60f2ad85a82951626516869.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-12-05 12:31:36'),
(44, 0, 120, 'Authorize.net', 'Authorize', NULL, 0, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"--------------------\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"--------------------\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2023-07-13 12:46:09'),
(45, 0, 121, 'NMI', 'NMI', NULL, 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"-------\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2022-08-28 10:12:37'),
(48, 3, 1000, 'Bank Transfer', 'bank_transfer', NULL, 1, '[]', '[]', 0, NULL, 'This is the best one i want', '2023-07-15 14:18:35', '2023-07-15 14:18:35'),
(49, 4, 1001, 'Full Name', 'full_name', NULL, 0, '[]', '[]', 0, NULL, 'Test', '2023-07-15 14:37:22', '2024-04-24 09:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `currency` varchar(40) DEFAULT NULL,
  `symbol` varchar(40) DEFAULT NULL,
  `method_code` int(10) DEFAULT NULL,
  `gateway_alias` varchar(40) DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `max_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(255) DEFAULT NULL,
  `gateway_parameter` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateway_currencies`
--

INSERT INTO `gateway_currencies` (`id`, `name`, `currency`, `symbol`, `method_code`, `gateway_alias`, `min_amount`, `max_amount`, `percent_charge`, `fixed_charge`, `rate`, `image`, `gateway_parameter`, `created_at`, `updated_at`) VALUES
(152, 'NMI - USD', 'USD', '$', 121, 'NMI', '1.00000000', '100.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"-------\"}', '2022-12-05 11:49:46', '2022-12-05 11:49:46'),
(154, 'Authorize - USD', 'USD', '$', 120, 'Authorize', '1.00000000', '200.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"login_id\":\"--------------------\",\"transaction_key\":\"--------------------\"}', '2022-12-05 12:30:52', '2022-12-05 12:30:52'),
(155, 'Blockchain - BTC', 'BTC', '$', 501, 'Blockchain', '1.00000000', '1.11000000', '1.00', '11.00000000', '1.00000000', NULL, '{\"api_key\":\"--------------------\",\"xpub_code\":\"--------------------\"}', '2022-12-05 12:30:58', '2022-12-05 12:30:58'),
(156, 'Cashmaal - PKR', 'PKR', 'pkr', 116, 'Cashmaal', '1.00000000', '10000.00000000', '10.00', '1.00000000', '100.00000000', NULL, '{\"web_id\":\"--------------------\",\"ipn_key\":\"--------------------\"}', '2022-12-05 12:31:06', '2022-12-05 12:31:06'),
(157, 'Coinbase Commerce - USD', 'USD', '$', 506, 'CoinbaseCommerce', '1.00000000', '10000.00000000', '10.00', '1.00000000', '10.00000000', NULL, '{\"api_key\":\"--------------------\",\"secret\":\"--------------------\"}', '2022-12-05 12:31:11', '2022-12-05 12:31:11'),
(158, 'CoinPayments - ETH', 'JPY', '111', 506, 'CoinbaseCommerce', '1.00000000', '11.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"--------------------\",\"secret\":\"--------------------\"}', '2022-12-05 12:31:11', '2022-12-05 12:31:11'),
(159, 'Coingate - USD', 'USD', '$', 505, 'Coingate', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"--------------------\"}', '2022-12-05 12:31:15', '2022-12-05 12:31:15'),
(160, 'CoinPayments - BTC', 'BTC', '$', 503, 'Coinpayments', '1.00000000', '10000.00000000', '10.00', '1.00000000', '10.00000000', NULL, '{\"public_key\":\"---------------\",\"private_key\":\"------------\",\"merchant_id\":\"--------------------\"}', '2022-12-05 12:31:18', '2022-12-05 12:31:18'),
(161, 'CoinPayments Fiat - USD', 'USD', '$', 504, 'CoinpaymentsFiat', '1.00000000', '10000.00000000', '10.00', '1.00000000', '10.00000000', NULL, '{\"merchant_id\":\"--------------------\"}', '2022-12-05 12:31:24', '2022-12-05 12:31:24'),
(162, 'CoinPayments Fiat - AUD', 'AUD', '$', 504, 'CoinpaymentsFiat', '1.00000000', '10000.00000000', '0.00', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"--------------------\"}', '2022-12-05 12:31:24', '2022-12-05 12:31:24'),
(163, 'Instamojo - INR', 'INR', '₹', 112, 'Instamojo', '1.00000000', '10000.00000000', '1.00', '1.00000000', '75.00000000', NULL, '{\"api_key\":\"--------------------\",\"auth_token\":\"--------------------\",\"salt\":\"--------------------\"}', '2022-12-05 12:31:33', '2022-12-05 12:31:33'),
(164, 'Mollie - USD', 'USD', '$', 115, 'Mollie', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"mollie_email\":\"--------------------\",\"api_key\":\"--------------------\"}', '2022-12-05 12:31:42', '2022-12-05 12:31:42'),
(165, 'Payeer - USD', 'USD', '$', 106, 'Payeer', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"--------------------\",\"secret_key\":\"--------------------\"}', '2022-12-05 12:31:48', '2022-12-05 12:31:48'),
(166, 'Paypal - USD', 'USD', '$', 101, 'Paypal', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"paypal_email\":\"--------------------\"}', '2022-12-05 12:31:51', '2022-12-05 12:31:51'),
(167, 'Paypal Express - USD', 'USD', '$', 113, 'PaypalSdk', '1.00000000', '1000000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"clientId\":\"--------------------\",\"clientSecret\":\"--------------------\"}', '2022-12-05 12:31:56', '2022-12-05 12:31:56'),
(169, 'PayTM - AUD', 'AUD', '$', 105, 'Paytm', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"MID\":\"--------------------\",\"merchant_key\":\"--------------------\",\"WEBSITE\":\"--------------------\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\",\"transaction_status_url\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}', '2022-12-05 12:32:12', '2022-12-05 12:32:12'),
(170, 'PayTM - USD', 'USD', '$', 105, 'Paytm', '1.00000000', '10000.00000000', '1.00', '1.00000000', '2.00000000', NULL, '{\"MID\":\"--------------------\",\"merchant_key\":\"--------------------\",\"WEBSITE\":\"--------------------\",\"INDUSTRY_TYPE_ID\":\"Retail\",\"CHANNEL_ID\":\"WEB\",\"transaction_url\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\",\"transaction_status_url\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}', '2022-12-05 12:32:12', '2022-12-05 12:32:12'),
(171, 'Perfect Money - USD', 'USD', '$', 102, 'PerfectMoney', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"passphrase\":\"--------------------\",\"wallet_id\":\"U30603391\"}', '2022-12-05 12:32:16', '2022-12-05 12:32:16'),
(172, 'RazorPay - INR', 'INR', '$', 110, 'Razorpay', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"key_id\":\"--------------------\",\"key_secret\":\"--------------------\"}', '2022-12-05 12:32:21', '2022-12-05 12:32:21'),
(173, 'Skrill - AED', 'AED', '$', 104, 'Skrill', '1.00000000', '10000.00000000', '1.00', '1.00000000', '10.00000000', NULL, '{\"pay_to_email\":\"--------------------\",\"secret_key\":\"--------------------\"}', '2022-12-05 12:32:25', '2022-12-05 12:32:25'),
(174, 'Skrill - USD', 'USD', '$', 104, 'Skrill', '1.00000000', '10000.00000000', '1.00', '1.00000000', '2.00000000', NULL, '{\"pay_to_email\":\"--------------------\",\"secret_key\":\"--------------------\"}', '2022-12-05 12:32:25', '2022-12-05 12:32:25'),
(175, 'Stripe Hosted - USD', 'USD', '$', 103, 'Stripe', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"secret_key\":\"--------------------\",\"publishable_key\":\"--------------------\"}', '2022-12-05 12:32:29', '2022-12-05 12:32:29'),
(176, 'Stripe Storefront - USD', 'USD', '$', 111, 'StripeJs', '1.00000000', '10000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"secret_key\":\"sk_test_4eC39HqLyjWDarjtT1zdp7dc\",\"publishable_key\":\"sk_test_4eC39HqLyjWDarjtT1zdp7dc\"}', '2022-12-05 12:32:33', '2022-12-05 12:32:33'),
(178, 'VoguePay - USD', 'USD', '$', 108, 'Voguepay', '1.00000000', '1000.00000000', '0.00', '1.00000000', '1.00000000', NULL, '{\"merchant_id\":\"--------------------\"}', '2022-12-05 12:32:41', '2022-12-05 12:32:41'),
(182, 'Bank Transfer', 'NGN', '', 1000, 'bank_transfer', '1.00000000', '1000000.00000000', '2.00', '1.00000000', '1.00000000', NULL, NULL, '2023-07-15 14:18:35', '2024-04-24 09:07:17'),
(183, 'Full Name', 'NGN', '', 1001, 'full_name', '1.00000000', '1000.00000000', '1.00', '1.00000000', '1.00000000', NULL, NULL, '2023-07-15 14:37:22', '2023-07-15 14:46:11'),
(188, 'BKash Name', 'BDT', 'B', 500, 'Bkash', '1.00000000', '100.00000000', '2.00', '1.00000000', '1.00000000', NULL, '{\"api_key\":\"4f6o0cjiki2rfm34kfdadl1eqq\",\"api_secret\":\"2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b\",\"username\":\"sandboxTokenizedUser02\",\"password\":\"sandboxTokenizedUser02@12345\",\"access\":\"TEST\"}', '2023-08-28 20:10:48', '2023-08-28 20:10:48'),
(189, 'Stripe Checkout - USD', 'USD', 'USD', 114, 'StripeV3', '10.00000000', '1000.00000000', '0.00', '1.00000000', '1.00000000', NULL, '{\"secret_key\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\",\"publishable_key\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\",\"end_point\":\"--------------------\"}', '2023-11-21 08:41:57', '2023-11-21 08:41:57'),
(191, 'PayStack - NGN', 'NGN', '₦', 107, 'Paystack', '1.00000000', '10000.00000000', '1.40', '1.30000000', '1.20000000', NULL, '{\"public_key\":\"pk_test_257c929b64cda13f16d17e16b6fdec762aef0559\",\"secret_key\":\"sk_test_ae65fab010dd2e551b8c9801528ed635c047baf2\"}', '2023-11-27 18:29:23', '2023-11-27 18:29:23'),
(193, 'Flutterwave', 'NGN', '1', 109, 'Flutterwave', '1.00000000', '11000000.00000000', '1.00', '1.00000000', '1.00000000', NULL, '{\"public_key\":\"FLWPUBK_TEST-SANDBOXDEMOKEY-X\",\"secret_key\":\"FLWSECK_TEST-SANDBOXDEMOKEY-X\",\"encryption_key\":\"------------------\"}', '2024-01-03 08:19:10', '2024-01-03 08:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(40) DEFAULT NULL,
  `cur_text` varchar(40) DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) DEFAULT NULL,
  `email_template` text DEFAULT NULL,
  `sms_body` varchar(255) DEFAULT NULL,
  `sms_from` varchar(255) DEFAULT NULL,
  `base_color` varchar(40) DEFAULT NULL,
  `secondary_color` varchar(40) DEFAULT NULL,
  `mail_config` text DEFAULT NULL COMMENT 'email configuration',
  `sms_config` text DEFAULT NULL,
  `global_shortcodes` text DEFAULT NULL,
  `nuban_provider` varchar(10) DEFAULT NULL,
  `transfer_provider` varchar(30) DEFAULT NULL,
  `store_front` int(1) DEFAULT NULL,
  `store_front_fee` varchar(6) DEFAULT NULL,
  `qr` int(1) DEFAULT NULL,
  `event` int(1) DEFAULT NULL,
  `invoice` int(1) DEFAULT NULL,
  `airtime` int(1) DEFAULT 0,
  `airtime2cash` int(1) DEFAULT 0,
  `airtimelocal` int(1) DEFAULT NULL,
  `internet` int(1) NOT NULL DEFAULT 0,
  `internetsme` int(1) NOT NULL DEFAULT 0,
  `internetsme_provider` varchar(20) DEFAULT NULL,
  `internet_api_sme_provider` varchar(20) DEFAULT NULL,
  `airtime_provider` varchar(10) DEFAULT NULL,
  `cabletv_provider` varchar(10) DEFAULT NULL,
  `cabletv` int(1) DEFAULT 0,
  `utilityglobal` int(1) DEFAULT 0,
  `betting` int(1) DEFAULT NULL,
  `utilitylocal` int(1) NOT NULL DEFAULT 0,
  `insurance` int(1) NOT NULL DEFAULT 0,
  `virtualcard` int(1) DEFAULT NULL,
  `escrow` int(1) DEFAULT NULL,
  `voucher` int(1) DEFAULT NULL,
  `savings` int(1) DEFAULT NULL,
  `loan` int(1) DEFAULT NULL,
  `percent_charge` varchar(10) DEFAULT NULL,
  `fixed_charge` varchar(10) DEFAULT NULL,
  `charge_cap` varchar(10) DEFAULT NULL,
  `crypto` varchar(10) DEFAULT NULL,
  `crypto_auto` int(1) DEFAULT NULL,
  `giftcard_auto` int(1) DEFAULT NULL,
  `buy_giftcard` int(1) DEFAULT NULL,
  `sell_giftcard` int(1) DEFAULT NULL,
  `buy_crypto` int(1) DEFAULT NULL,
  `sell_crypto` int(1) DEFAULT NULL,
  `swap_crypto` int(1) DEFAULT NULL,
  `request_account` int(1) NOT NULL DEFAULT 0,
  `virtualcard_fee_percent` varchar(6) DEFAULT NULL,
  `virtualcard_fee_flat` varchar(6) DEFAULT NULL,
  `virtualcard_fee_type` varchar(10) DEFAULT NULL,
  `virtualcard_request_fee` varchar(10) DEFAULT NULL,
  `virtualcard_usd_rate` varchar(5) DEFAULT NULL,
  `p2p` int(1) NOT NULL DEFAULT 0,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `ln` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable language, 0 - disable, 1 -enable\r\n',
  `force_ssl` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `secure_password` tinyint(1) NOT NULL DEFAULT 0,
  `last_cron` datetime DEFAULT NULL,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `login_bonus` int(1) DEFAULT NULL,
  `login_earn` int(10) DEFAULT NULL,
  `welcome_bonus` int(1) DEFAULT NULL,
  `welcome_bonus_amount` varchar(10) DEFAULT NULL,
  `deposit_commission` int(1) DEFAULT NULL,
  `reg_commission` int(1) DEFAULT NULL,
  `task_commission` varchar(2) DEFAULT NULL,
  `commission_type` varchar(2) DEFAULT NULL,
  `active_template` varchar(40) DEFAULT NULL,
  `system_info` text DEFAULT NULL,
  `social_facebook` varchar(250) DEFAULT NULL,
  `social_twitter` varchar(250) DEFAULT NULL,
  `social_instagram` varchar(250) DEFAULT NULL,
  `social_mail` varchar(250) DEFAULT NULL,
  `social_phone` varchar(250) DEFAULT NULL,
  `social_whatsapp` varchar(250) DEFAULT NULL,
  `social_telegram` varchar(250) DEFAULT NULL,
  `social_youtube` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_body`, `sms_from`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `global_shortcodes`, `nuban_provider`, `transfer_provider`, `store_front`, `store_front_fee`, `qr`, `event`, `invoice`, `airtime`, `airtime2cash`, `airtimelocal`, `internet`, `internetsme`, `internetsme_provider`, `internet_api_sme_provider`, `airtime_provider`, `cabletv_provider`, `cabletv`, `utilityglobal`, `betting`, `utilitylocal`, `insurance`, `virtualcard`, `escrow`, `voucher`, `savings`, `loan`, `percent_charge`, `fixed_charge`, `charge_cap`, `crypto`, `crypto_auto`, `giftcard_auto`, `buy_giftcard`, `sell_giftcard`, `buy_crypto`, `sell_crypto`, `swap_crypto`, `request_account`, `virtualcard_fee_percent`, `virtualcard_fee_flat`, `virtualcard_fee_type`, `virtualcard_request_fee`, `virtualcard_usd_rate`, `p2p`, `ev`, `en`, `sv`, `sn`, `ln`, `force_ssl`, `maintenance_mode`, `secure_password`, `last_cron`, `agree`, `registration`, `login_bonus`, `login_earn`, `welcome_bonus`, `welcome_bonus_amount`, `deposit_commission`, `reg_commission`, `task_commission`, `commission_type`, `active_template`, `system_info`, `social_facebook`, `social_twitter`, `social_instagram`, `social_mail`, `social_phone`, `social_whatsapp`, `social_telegram`, `social_youtube`, `created_at`, `updated_at`) VALUES
(1, 'Smart Bills', 'NGN', '₦', 'info@cardmium.com', '<meta charset=\"utf-8\">\r\n  <meta name=\"x-apple-disable-message-reformatting\">\r\n  <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n  <meta name=\"format-detection\" content=\"telephone=no, date=no, address=no, email=no\">\r\n  <!--[if mso]>\r\n    <xml><o:officedocumentsettings><o:pixelsperinch>96</o:pixelsperinch></o:officedocumentsettings></xml>\r\n  <![endif]-->\r\n    <title>New Mail</title>\r\n    <link href=\"https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700\" rel=\"stylesheet\" media=\"screen\">\r\n    <style>\r\n.hover-underline:hover {\r\n  text-decoration: underline !important;\r\n}\r\n@media (max-width: 600px) {\r\n  .sm-w-full {\r\n    width: 100% !important;\r\n  }\r\n  .sm-px-24 {\r\n    padding-left: 24px !important;\r\n    padding-right: 24px !important;\r\n  }\r\n  .sm-py-32 {\r\n    padding-top: 32px !important;\r\n    padding-bottom: 32px !important;\r\n  }\r\n  .sm-leading-32 {\r\n    line-height: 32px !important;\r\n  }\r\n}\r\n</style>\r\n\r\n\r\n    <div style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; display: none;\">New Message.</div>\r\n  <div role=\"article\" aria-roledescription=\"email\" aria-label=\"New Message\" lang=\"en\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\">\r\n    <table style=\"width: 100%; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">\r\n      <tbody><tr>\r\n        <td align=\"center\" style=\"mso-line-height-rule: exactly; background-color: #eceff1; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;\">\r\n          <table class=\"sm-w-full\" style=\"width: 600px;\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">\r\n            <tbody><tr>\r\n  <td class=\"sm-py-32 sm-px-24\" style=\"mso-line-height-rule: exactly; padding: 48px; text-align: center; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;\">\r\n    <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\">\r\n      <img src=\"https://seeklogo.com/images/G/gmail-icon-logo-9ADB17D3F3-seeklogo.com.png\" width=\"155\" alt=\"Logo\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0;\">\r\n    </a>\r\n  </td>\r\n</tr>\r\n              <tr>\r\n                <td align=\"center\" class=\"sm-px-24\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\">\r\n                  <table style=\"width: 100%;\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">\r\n                    <tbody><tr>\r\n                      <td class=\"sm-px-24\" style=\"mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; font-size: 16px; line-height: 24px; color: #626262;\">\r\n                        <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;\">Hey</p>\r\n                        <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;\">{{fullname}}!</p>\r\n                        <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\"><span style=\"font-weight: var(--bs-body-font-weight);\">{{message}}</span></p><table cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" style=\"font-weight: var(--bs-body-font-weight); width: 100%;\"><tbody><tr><td style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;\"><div style=\"height: 1px; background-color: rgb(236, 239, 241); line-height: 1px;\">‌</div></td></tr></tbody></table>\r\n<p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px;\">\r\n  Not sure why you received this email? Please\r\n  <a href=\"mailto:support@example.com\" class=\"hover-underline\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;\">let us know</a>.\r\n</p>\r\n<p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px;\">Thanks, <br>{{site_name}}</p>\r\n                      </td>\r\n                    </tr>\r\n                    <tr>\r\n  <td style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; height: 20px;\"></td>\r\n</tr>\r\n<tr>\r\n  <td style=\"mso-line-height-rule: exactly; padding-left: 48px; padding-right: 48px; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; font-size: 14px; color: #eceff1;\">\r\n    <p align=\"center\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-bottom: 16px; cursor: default;\">\r\n      <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238; text-decoration: none;\"><img src=\"https://img.freepik.com/free-icon/facebook_318-157463.jpg\" width=\"17\" alt=\"Facebook\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0; margin-right: 12px;\"></a>\r\n      •\r\n      <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238; text-decoration: none;\"><img src=\"https://png.pngtree.com/png-vector/20221018/ourmid/pngtree-twitter-social-media-round-icon-png-image_6315985.png\" width=\"17\" alt=\"Twitter\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0; margin-right: 12px;\"></a>\r\n      •\r\n      <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238; text-decoration: none;\"><img src=\"https://clipart-library.com/new_gallery/410617_facebook-icon-transparent-png.jpg\" width=\"17\" alt=\"Instagram\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0; margin-right: 12px;\"></a>\r\n    </p>\r\n    <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238;\">\r\n      Use of our service and website is subject to our\r\n      <a href=\"https://pixinvent.com/\" class=\"hover-underline\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;\">Terms of Use</a> and\r\n      <a href=\"https://pixinvent.com/\" class=\"hover-underline\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;\">Privacy Policy</a>.\r\n    </p>\r\n  </td>\r\n</tr>\r\n<tr>\r\n  <td style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; height: 16px;\"></td>\r\n</tr>\r\n                  </tbody></table>\r\n                </td>\r\n              </tr>\r\n          </tbody></table>\r\n        </td>\r\n      </tr>\r\n    </tbody></table>\r\n  </div>', 'hi {{fullname}} ({{username}}), {{message}}', 'BillsPayPoint', '#340a94', '#154575', '{\"name\":\"php\"}', '{\"name\":\"bulksmsng\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"bulksmsng\":{\"token\":\"oyuzuMZsy9YAOddxos6qEgeA3OXpNKftQlNWOTpRLpyPHhVV6qBhzicjrTnU\",\"sender\":\"BulkSMSNG\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 'MONNIFY', 'STROWALLET', 1, '10', 1, 1, 1, 1, 1, 1, 1, 1, 'N3TDATA', 'SIMHOSTING', 'VTPASS', 'VTPASS', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '10', '100', NULL, '1', 0, 1, 1, 1, 1, 1, 1, 1, '10', '1', 'BOTH', '100', '1000', 1, 1, 1, 1, 1, 0, 0, 0, 0, '2023-08-20 17:22:18', 1, 0, 1, 22, 1, '22', 1, 1, '1', '1', 'basic', '[]', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', 'admin@admin.com', '08023444444', 'https://me.whatsapp.com', 'https://telegram.com', 'https://yoututbe.com', NULL, '2024-04-30 10:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `giftcards`
--

CREATE TABLE `giftcards` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `buy` varchar(191) DEFAULT '0',
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giftcards`
--

INSERT INTO `giftcards` (`id`, `name`, `buy`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Amazon Pay Card', '5', '5ee9fdeb2616f.jpg', 1, NULL, '2018-02-14 23:36:57', '2023-12-06 20:58:09'),
(3, 'Xbox Card', '6', '5ee9fdfa314ae.jpg', 1, NULL, '2018-02-14 23:36:57', '2020-06-17 09:26:50'),
(4, 'Itunes Card', '4', '5ee9fe0e82874.jpg', 1, NULL, '2018-02-14 23:36:57', '2020-06-17 09:27:10'),
(5, 'Sephora', '2', '5ee9fe24a3143.jpg', 1, NULL, '2018-02-14 23:36:57', '2023-08-13 16:37:45'),
(10, 'Walmart Card', '5', '5ee9fe40bc319.jpg', 1, NULL, '2018-02-14 23:36:57', '2020-06-17 09:28:00'),
(11, 'E-bay Card', '7', '5ee9fdd3730a5.jpg', 1, NULL, '2018-10-22 06:49:14', '2020-06-17 09:26:11'),
(12, 'Google Pay Card', '1', '5ee9fe6c8dec9.jpg', 1, NULL, '2018-02-14 23:36:57', '2020-06-17 09:28:44'),
(13, 'Play-Station Card', '7', '5ee9fe9558854.jpg', 1, NULL, '2018-02-14 23:36:57', '2020-06-17 09:29:25'),
(14, 'Sephortio', '0', '5ee9f527892b3.jpg', 0, '2020-06-17 09:20:58', '2020-06-17 08:36:21', '2020-06-17 09:20:58'),
(15, 'Footlocker Giftcard', '0', '5ee9ff07cdf22.jpg', 1, NULL, '2020-06-17 09:31:19', '2020-06-17 09:35:28'),
(16, 'Steam Giftcard', '0', '5ee9ff1b7e925.jpg', 1, NULL, '2020-06-17 09:31:39', '2020-06-17 09:35:24'),
(17, 'Nordstorm', '0', '5ee9ff366bf61.jpg', 1, NULL, '2020-06-17 09:32:06', '2020-06-17 09:35:21'),
(18, 'Adidas Giftcard', '0', '5ee9ffdc07c92.jpg', 1, NULL, '2020-06-17 09:34:52', '2023-12-06 20:54:32'),
(19, 'meteo', '0', '64d9056ff2b65.jpg', 0, NULL, '2023-08-13 16:31:43', '2023-08-13 16:37:50'),
(20, 'Facebook Like', '0', '6570e25dcf889.jpg', 0, '2023-12-06 21:07:34', '2023-12-06 21:06:37', '2023-12-06 21:07:34'),
(21, 'Adekunle Gold', '0', '6570e62608f91.jpg', 0, NULL, '2023-12-06 21:22:46', '2023-12-06 21:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `giftcardsales`
--

CREATE TABLE `giftcardsales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `amount` varchar(191) DEFAULT NULL,
  `currency` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `rate` varchar(55) DEFAULT NULL,
  `trx` varchar(191) DEFAULT NULL,
  `country` varchar(55) DEFAULT NULL,
  `pay` varchar(55) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `image` varchar(120) DEFAULT NULL,
  `image2` text DEFAULT NULL,
  `trx_type` varchar(10) DEFAULT NULL,
  `code` text DEFAULT NULL,
  `deleted_at` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giftcardtypes`
--

CREATE TABLE `giftcardtypes` (
  `id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `card_id` varchar(191) DEFAULT NULL,
  `sell_rate` varchar(191) DEFAULT NULL,
  `buy_rate` varchar(11) DEFAULT NULL,
  `currency` varchar(55) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giftcardtypes`
--

INSERT INTO `giftcardtypes` (`id`, `name`, `card_id`, `sell_rate`, `buy_rate`, `currency`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(19, 'I-Tunes Physical', '4', '23', '24', '$', 0, '2020-06-17 11:10:46', '2020-06-17 11:05:13', '2020-06-17 11:10:46'),
(20, 'Canada Itunes Physical', '4', '300', '300', '$', 1, NULL, '2020-06-17 11:06:00', '2023-12-06 21:32:45'),
(21, 'Australia Itunescard', '4', '120', '129', 'NGN', 1, NULL, '2020-06-17 12:09:08', '2023-12-06 21:40:15'),
(22, 'Belgium Itunes', '4', '600', '700', '$', 1, NULL, '2020-06-17 12:15:31', '2020-06-17 12:15:45'),
(23, 'UK Itunes', '4', '359', '345', '£', 1, NULL, '2020-06-17 14:58:25', '2020-06-17 15:00:07'),
(24, 'Facebook Like', '18', '400', '250', 'NGN', 0, '2023-08-13 16:10:02', '2023-08-13 16:03:13', '2023-08-13 16:10:02'),
(25, 'Lagos', '18', '400', '250', 'USD', 0, '2023-08-13 16:10:03', '2023-08-13 16:09:58', '2023-08-13 16:10:03'),
(29, 'Facebook Like', '4', '23', '32', 'USD', 0, '2023-12-06 21:32:39', '2023-12-06 21:32:34', '2023-12-06 21:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `installmentable_type` varchar(40) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `installmentable_id` int(10) UNSIGNED NOT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `delay_charge` decimal(28,8) UNSIGNED NOT NULL DEFAULT 0.00000000,
  `installment_date` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `given_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `purpose` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `is_test` int(1) DEFAULT NULL,
  `trx` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '2020-07-06 03:47:55', '2022-04-09 03:47:04'),
(5, 'Hindi', 'hn', 0, '2020-12-29 02:20:07', '2022-04-09 03:47:04'),
(9, 'Bangla', 'bn', 0, '2021-03-14 04:37:41', '2022-03-30 12:31:55'),
(11, 'Spanish', 'es', 0, '2022-12-05 09:45:47', '2022-12-05 09:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_number` varchar(40) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `per_installment` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `installment_interval` int(11) NOT NULL DEFAULT 0 COMMENT 'Days',
  `delay_value` int(11) NOT NULL DEFAULT 1,
  `charge_per_installment` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `delay_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `given_installment` int(11) NOT NULL DEFAULT 0,
  `total_installment` int(11) NOT NULL DEFAULT 0,
  `application_form` text DEFAULT NULL,
  `admin_feedback` text DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Running, 2 = Paid, 3 = Rejected',
  `due_notification_sent` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_plans`
--

CREATE TABLE `loan_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) NOT NULL,
  `minimum_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `maximum_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `per_installment` decimal(5,2) NOT NULL DEFAULT 0.00 COMMENT '%',
  `installment_interval` int(11) NOT NULL DEFAULT 0 COMMENT 'In Day',
  `total_installment` int(11) NOT NULL DEFAULT 0,
  `instruction` text DEFAULT NULL,
  `delay_value` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Enable : 1, Disable : 2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `conversation_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sender` varchar(40) DEFAULT NULL,
  `sent_from` varchar(40) DEFAULT NULL,
  `sent_to` varchar(40) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `notification_type` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_logs`
--

INSERT INTO `notification_logs` (`id`, `user_id`, `sender`, `sent_from`, `sent_to`, `subject`, `message`, `notification_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'php', 'info@cardmium.com', 'test@test.com', 'Please verify your email address', '<meta charset=\"utf-8\">\r\n  <meta name=\"x-apple-disable-message-reformatting\">\r\n  <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n  <meta name=\"format-detection\" content=\"telephone=no, date=no, address=no, email=no\">\r\n  <!--[if mso]>\r\n    <xml><o:officedocumentsettings><o:pixelsperinch>96</o:pixelsperinch></o:officedocumentsettings></xml>\r\n  <![endif]-->\r\n    <title>New Mail</title>\r\n    <link href=\"https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700\" rel=\"stylesheet\" media=\"screen\">\r\n    <style>\r\n.hover-underline:hover {\r\n  text-decoration: underline !important;\r\n}\r\n@media (max-width: 600px) {\r\n  .sm-w-full {\r\n    width: 100% !important;\r\n  }\r\n  .sm-px-24 {\r\n    padding-left: 24px !important;\r\n    padding-right: 24px !important;\r\n  }\r\n  .sm-py-32 {\r\n    padding-top: 32px !important;\r\n    padding-bottom: 32px !important;\r\n  }\r\n  .sm-leading-32 {\r\n    line-height: 32px !important;\r\n  }\r\n}\r\n</style>\r\n\r\n\r\n    <div style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; display: none;\">New Message.</div>\r\n  <div role=\"article\" aria-roledescription=\"email\" aria-label=\"New Message\" lang=\"en\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\">\r\n    <table style=\"width: 100%; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">\r\n      <tbody><tr>\r\n        <td align=\"center\" style=\"mso-line-height-rule: exactly; background-color: #eceff1; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;\">\r\n          <table class=\"sm-w-full\" style=\"width: 600px;\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">\r\n            <tbody><tr>\r\n  <td class=\"sm-py-32 sm-px-24\" style=\"mso-line-height-rule: exactly; padding: 48px; text-align: center; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;\">\r\n    <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\">\r\n      <img src=\"https://seeklogo.com/images/G/gmail-icon-logo-9ADB17D3F3-seeklogo.com.png\" width=\"155\" alt=\"Logo\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0;\">\r\n    </a>\r\n  </td>\r\n</tr>\r\n              <tr>\r\n                <td align=\"center\" class=\"sm-px-24\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\">\r\n                  <table style=\"width: 100%;\" cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\">\r\n                    <tbody><tr>\r\n                      <td class=\"sm-px-24\" style=\"mso-line-height-rule: exactly; border-radius: 4px; background-color: #ffffff; padding: 48px; text-align: left; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; font-size: 16px; line-height: 24px; color: #626262;\">\r\n                        <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-bottom: 0; font-size: 20px; font-weight: 600;\">Hey</p>\r\n                        <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-top: 0; font-size: 24px; font-weight: 700; color: #ff5850;\"> !</p>\r\n                        <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly;\"><span style=\"font-weight: var(--bs-body-font-weight);\"><br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;499831</span></font></div></div></span></p><table cellpadding=\"0\" cellspacing=\"0\" role=\"presentation\" style=\"font-weight: var(--bs-body-font-weight); width: 100%;\"><tbody><tr><td style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; padding-top: 32px; padding-bottom: 32px;\"><div style=\"height: 1px; background-color: rgb(236, 239, 241); line-height: 1px;\">‌</div></td></tr></tbody></table>\r\n<p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px;\">\r\n  Not sure why you received this email? Please\r\n  <a href=\"mailto:support@example.com\" class=\"hover-underline\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;\">let us know</a>.\r\n</p>\r\n<p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin: 0; margin-bottom: 16px;\">Thanks, <br>Smart Bills</p>\r\n                      </td>\r\n                    </tr>\r\n                    <tr>\r\n  <td style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; height: 20px;\"></td>\r\n</tr>\r\n<tr>\r\n  <td style=\"mso-line-height-rule: exactly; padding-left: 48px; padding-right: 48px; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; font-size: 14px; color: #eceff1;\">\r\n    <p align=\"center\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; margin-bottom: 16px; cursor: default;\">\r\n      <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238; text-decoration: none;\"><img src=\"https://img.freepik.com/free-icon/facebook_318-157463.jpg\" width=\"17\" alt=\"Facebook\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0; margin-right: 12px;\"></a>\r\n      •\r\n      <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238; text-decoration: none;\"><img src=\"https://png.pngtree.com/png-vector/20221018/ourmid/pngtree-twitter-social-media-round-icon-png-image_6315985.png\" width=\"17\" alt=\"Twitter\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0; margin-right: 12px;\"></a>\r\n      •\r\n      <a href=\"#\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238; text-decoration: none;\"><img src=\"https://clipart-library.com/new_gallery/410617_facebook-icon-transparent-png.jpg\" width=\"17\" alt=\"Instagram\" style=\"max-width: 100%; vertical-align: middle; line-height: 100%; border: 0; margin-right: 12px;\"></a>\r\n    </p>\r\n    <p style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #263238;\">\r\n      Use of our service and website is subject to our\r\n      <a href=\"https://pixinvent.com/\" class=\"hover-underline\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;\">Terms of Use</a> and\r\n      <a href=\"https://pixinvent.com/\" class=\"hover-underline\" style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; color: #7367f0; text-decoration: none;\">Privacy Policy</a>.\r\n    </p>\r\n  </td>\r\n</tr>\r\n<tr>\r\n  <td style=\"font-family: \'Montserrat\', sans-serif; mso-line-height-rule: exactly; height: 16px;\"></td>\r\n</tr>\r\n                  </tbody></table>\r\n                </td>\r\n              </tr>\r\n          </tbody></table>\r\n        </td>\r\n      </tr>\r\n    </tbody></table>\r\n  </div>', 'email', '2024-04-29 21:11:06', '2024-04-29 21:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `subj` varchar(255) DEFAULT NULL,
  `email_body` text DEFAULT NULL,
  `sms_body` text DEFAULT NULL,
  `shortcodes` text DEFAULT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2023-07-13 17:04:25'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Deposit - Automated - Successful', 'Deposit Completed Successfully', '<div>Your deposit of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit successfully by {{method_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:25:43'),
(4, 'DEPOSIT_APPROVE', 'Deposit - Manual - Approved', 'Your Deposit is Approved', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:26:07'),
(5, 'DEPOSIT_REJECT', 'Deposit - Manual - Rejected', 'Your Deposit Request is Rejected', '<div style=\"font-family: Montserrat, sans-serif;\">Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:45:27'),
(6, 'DEPOSIT_REQUEST', 'Deposit - Manual - Requested', 'Deposit Request Submitted Successfully', '<div>Your deposit request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Deposit requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:29:19'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(16, 'INVITATION_LINK', ' Invitation Link', 'You are invited to join with escrow', 'You are invited to this escrow site.&nbsp;<div>Please <a href=\"{{link}}\" title=\"\" target=\"_blank\">register now</a></div>', 'You are invited to this escrow site. please visit this site to register {{link}', '{\"link\":\"Registration link\"}', 1, 1, NULL, NULL),
(17, 'ESCROW_CANCELLED', 'Escrow Cancelled', 'Escrow Cancelled', 'Your escrow <b>\"{{title}}\" </b>has been canceled by the <b>{{canceller}}</b>.<div>The escrow amount was {{amount}} {{site_currency}} and the funded amount was {{total_fund}} {{site_currency}}</div>', 'Your escrow \"{{title}}\" has been canceled by the {{canceller}}.\r\nThe escrow amount was {{amount}} {{site_currency}} and the funded amount was {{total_fund}} {{site_currency}}', '{\"title\":\"Title of the escrow\",\"amount\":\"Amount of the escrow\",\"canceller\":\"Who cancelled the escrow\",\"total_fund\":\"How many amount was funded to the escrow\"}', 1, 1, NULL, '2022-04-03 21:38:00'),
(18, 'ESCROW_ACCEPTED', 'Escrow Accepted', 'Escrow Accepted', '<span style=\"color: rgb(33, 37, 41);\">Your escrow&nbsp;</span><span style=\"font-weight: bolder; color: rgb(33, 37, 41);\">\"{{title}}\"&nbsp;</span><span style=\"color: rgb(33, 37, 41);\">has been accepted by the&nbsp;</span><span style=\"font-weight: bolder; color: rgb(33, 37, 41);\">{{accepter}}</span><span style=\"color: rgb(33, 37, 41);\">.</span><div>The escrow amount was {{amount}} {{site_currency}} and the funded amount was {{total_fund}} {{site_currency}}</div>', 'Your escrow \"{{title}}\" has been accepted by the {{accepter}}.\r\nThe escrow amount was {{amount}} {{site_currency}} and the funded amount was {{total_fund}} {{site_currency}}', '{\"title\":\"Title of the escrow\",\"amount\":\"Amount of the escrow\",\"accepter\":\"Who accpet the escrow\",\"total_fund\":\"How many amount was funded to the escrow\"}', 1, 1, NULL, '2022-04-03 21:41:14'),
(19, 'ESCROW_PAYMENT_DISPATCHED', 'Escrow Payment Dispatched', 'Escrow Payment Dispatched', '<span style=\"color: rgb(33, 37, 41);\">Your escrow&nbsp;</span><span style=\"color: rgb(33, 37, 41); font-weight: bolder;\">\"{{title}}\"&nbsp;</span><span style=\"color: rgb(33, 37, 41);\">has been dispatched by the buyer.</span><div>The escrow amount was {{amount}} {{site_currency}} and the charge was {{charge}} {{site_currency}}.</div><div>We have cut {{seller_charge}} {{site_currency}} from your account after got paid. The transaction number is {{trx}} and your current balance is {{post_balance}} {{site_currency}}</div>', 'Your escrow \"{{title}}\" has been dispatched by the buyer.\r\nThe escrow amount was {{amount}} {{site_currency}} and the charge was {{charge}} {{site_currency}}.\r\nWe have cut {{seller_charge}} {{site_currency}} from your account after got paid. The transaction number is {{trx}} and your current balance is {{post_balance}} {{site_currency}}', '{\"title\":\"Title of the escrow\",\"amount\":\"Amount of the escrow\",\"charge\":\"Total charge of the escrow\",\"seller_charge\":\"Amount of the seller charge\",\"trx\":\"Transaction number\",\"post_balance\":\"Seller balance after transaction\"}', 1, 1, NULL, '2022-04-03 21:52:19'),
(20, 'ESCROW_DISPUTED', 'Escrow Disputed', 'Escrow Disputed', '<span style=\"color: rgb(33, 37, 41);\">Your escrow&nbsp;</span><span style=\"color: rgb(33, 37, 41); font-weight: bolder;\">\"{{title}}\"&nbsp;</span><span style=\"color: rgb(33, 37, 41);\">has been disputed by the <b>{{disputer}}</b>.&nbsp;</span><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">The escrow amount was {{amount}} {{site_currency}}.</span><div><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">{{total_fund}} {{site_currency}} was funded to the escrow.</span></div><div><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">The reason is : \"{{dispute_note}}\"</span></div><div><span style=\"color: rgb(33, 37, 41); font-size: 1rem;\">Our staff will join you by chat. Please wait for admin action.</span></div>', 'Your escrow \"{{title}}\" has been disputed by the {{disputer}}. The escrow amount was {{amount}} {{site_currency}}.\r\n{{total_fund}} {{site_currency}} was funded to the escrow.\r\nThe reason is : \"{{dispute_note}}\"\r\nOur staff will join you by chat. Please wait for admin action.', '{\"title\":\"Title of the escrow\",\"amount\":\"Amount of the escrow\",\"disputer\":\"Who dispute the escrow\",\"total_fund\":\"How many amount funded to the escrow\",\"dispute_note\":\"Dispute note\"}', 1, 1, NULL, '2022-04-03 22:00:26'),
(21, 'ESCROW_ADMIN_ACTION', 'Escrow Admin Action', 'Escrow Admin Action', '<span style=\"color: rgb(33, 37, 41);\">Your escrow&nbsp;</span><span style=\"color: rgb(33, 37, 41); font-weight: bolder;\">\"{{title}}\"&nbsp;</span><span style=\"color: rgb(33, 37, 41);\">was disputed and the admin has taken an action. Admin decided to give {{buyer_amount}} {{site_currency}} to buyer and {{seller_amount}} {{site_currency}} to seller.</span><br><div><span style=\"color: rgb(33, 37, 41);\">System has cut the {{charge}} {{site_currency}} as charge. Your current balance is {{post_balance}} {{site_currency}}. The transaction number is #{{trx}}.</span></div>', 'Your escrow \"{{title}}\" was disputed and the admin has taken an action. Admin decided to give {{buyer_amount}} {{site_currency}} to buyer and {{seller_amount}} {{site_currency}} to seller.\r\nSystem has cut the {{charge}} {{site_currency}} as charge. Your current balance is {{post_balance}} {{site_currency}}. The transaction number is #{{trx}}.', '{\"title\":\"Title of the escrow\",\"amount\":\"Amount of the escrow\",\"total_fund\":\"How many amount funded to the escrow\",\"seller_amount\":\"How many amount seller will get\",\"buyer_amount\":\"How many amount buyer will get\",\"charge\":\"How many charge will cut by admin\",\"trx\":\"Transaction number\",\"post_balance\":\"Balance after transaction\"}', 1, 1, NULL, '2022-04-03 22:08:38'),
(23, 'AIRTIME_BUY', 'Airtime Purchased - Successful', 'Airtime Purchased Successful', '<div>You have successfully purchased {{provider}}&nbsp;airtime.</div><div><b><br></b></div><div><b>Details:</b></div><div>Amount: {{amount}} {{currency}}</div><div><div>Rate: {{rate}} {{site_currency}}<br></div></div>Beneficiary: {{beneficiary}}<div>Network: {{provider}}<div>Date: {{purchase_at}}</div><div>Transaction Number : {{trx}}</div><div><br></div><div><br><br><br></div></div>', 'You have purchased {{provider}}  airtime successfully.', '{\"trx\":\"Transaction Number\",\"amount\":\"Product amount\",\"rate\":\"System Price\",\"currency\":\"Site Currency\",\"purchase_at\":\"Day of Purchased\",\"provider\":\"Service Provider Name\",\"beneficiary\":\"Details of the beneficiary\",\"product\":\" Product Details\",\"quantity\":\"Number of Quantity \"}', 1, 1, NULL, '2023-08-18 15:00:54'),
(24, 'INTERNET_BUY', 'Internet Purchased - Successful', 'Internet Plan Purchased Successful', '<div>You have successfully purchased {{provider}}&nbsp;internet plan.</div><div><b><br></b></div><div><b>Details:</b></div><div>Amount: {{amount}} {{currency}}</div><div>Rate: {{rate}} {{site_currency}}<br></div>Beneficiary: {{beneficiary}}<br class=\"Apple-interchange-newline\">Network: {{provider}}<br class=\"Apple-interchange-newline\">Plan: {{product}}<div>Date: {{purchase_at}}</div><div>Transaction Number : {{trx}}</div><div><br></div><div><br><br><br></div>', 'You have purchased {{product}}  internet plan successfully.', '{\"trx\":\"Transaction Number\",\"amount\":\"Product amount\",\"rate\":\"System Price\",\"currency\":\"Site Currency\",\"purchase_at\":\"Day of Purchased\",\"provider\":\"Service Provider Name\",\"beneficiary\":\"Details of the beneficiary\",\"product\":\" Product Details\",\"quantity\":\"Number of Quantity \"}', 1, 1, NULL, '2023-08-18 15:00:14'),
(25, 'CABLETV_BUY', 'Cable TV Plan Purchased - Successful', 'Cable TV Plan Purchased Successful', '<div>You have successfully purchased {{provider}}&nbsp;cable tv plan successfully.</div><div><b><br></b></div><div><b>Details:</b></div><div>Amount: {{amount}} {{site_currency}}</div><div><div>Rate: {{rate}} {{site_currency}}<br></div></div>Beneficiary: {{beneficiary}}<div>Decoder: {{provider}}<br class=\"Apple-interchange-newline\">Plan: {{product}}<div>Date: {{purchase_at}}</div><div>Transaction Number : {{trx}}</div><div><br></div><div><br><br><br></div></div>', 'You have purchased {{product}}  tv plan successfully.', '{\"trx\":\"Transaction Number\",\"amount\":\"Product amount\",\"rate\":\"System Price\",\"currency\":\"Site Currency\",\"purchase_at\":\"Day of Purchased\",\"provider\":\"Service Provider Name\",\"beneficiary\":\"Details of the beneficiary\",\"product\":\" Product Details\",\"quantity\":\"Number of Quantity \"}', 1, 1, NULL, '2023-08-18 16:12:23'),
(26, 'UTILITY_BUY', 'Utility Bill Purchased - Successful', 'Utility Bill Purchased Successful', '<div>You have successfully paid for {{provider}}&nbsp;utility bill.</div><div><b><br></b></div><div><b>Details:</b></div><div>Amount: {{amount}} {{site_currency}}</div><div><div>Rate: {{rate}} {{site_currency}}<br></div></div>Beneficiary: {{beneficiary}}<div>Company: {{provider}}<br class=\"Apple-interchange-newline\">Meter Type: {{type}}<br class=\"Apple-interchange-newline\">Meter Number: {{number}}<br class=\"Apple-interchange-newline\">Token: {{token}}<div>Date: {{purchase_at}}</div><div>Transaction Number : {{trx}}</div><div><br></div><div><br><br><br></div></div>', 'Your  {{provider}}  utility token is {{token}}', '{\"trx\":\"Transaction Number\",\"rate\":\"System Price\",\"number\":\"Meter Number\",\"amount\":\"Product amount\",\"currency\":\"Site Currency\",\"token\":\"Purchased Token\",\"purchase_at\":\"Day of Purchased\",\"provider\":\"Service Provider Name\",\"beneficiary\":\"Customer Name\",\"type\":\" Meter type\",\"quantity\":\"Number of Quantity \"}', 1, 1, NULL, '2023-08-18 15:48:28'),
(27, 'INSURANCE_BUY', 'Insurance Plan Purchased - Successful', 'Insurance Plan Purchased Successful', '<div>You have successfully purchased {{provider}}&nbsp;insurance plan successfully.</div><div><b><br></b></div><div><b>Details:</b></div><div>Amount: {{amount}} {{site_currency}}</div><div><div>Rate: {{rate}} {{site_currency}}<br></div></div>Beneficiary: {{beneficiary}}<div>Insurance: {{provider}}<br class=\"Apple-interchange-newline\">Plan: {{product}}<div>Date: {{purchase_at}}</div><div>Transaction Number : {{trx}}</div><div><br></div><div><br><br><br></div></div>', 'You have purchased {{product}}  tv plan successfully.', '{\"trx\":\"Transaction Number\",\"amount\":\"Product amount\",\"rate\":\"System Price\",\"currency\":\"Site Currency\",\"purchase_at\":\"Day of Purchased\",\"provider\":\"Service Provider Name\",\"beneficiary\":\"Details of the beneficiary\",\"product\":\" Product Details\",\"quantity\":\"Number of Quantity \"}', 1, 1, NULL, '2023-08-30 12:46:20'),
(28, 'QR_PAYMENT', 'QR Payment', 'QR Payment', '<div>You have successfully {{type}} a QR payment. Please find the payment details below.</div><div><b><br></b></div><div><b>Details:</b></div><div>Amount: {{amount}} {{site_currency}}</div><div><div>Merchant: {{merchant}}<br></div></div>Payer: {{payer}}<div>Transaction Number : {{trx}}</div><div><br></div><div><br><br><br></div></div>', 'You have {{type}} a QR Payment.', '{\"trx\":\"Transaction Number\",\"amount\":\"QR Payment amount\",\"type\":\"Transaction type\",\"merchant\":\"Beneficiary\",\"payer\":\"Customer\"}', 1, 1, NULL, '2023-08-30 12:46:20'),
(29, 'USER_MESSAGE', 'Global User Message', '{{subject}}', '<div>{{message}}</div>', '{{message}}', '{\"message\":\"The body of the message\",\"subject\":\"The subject of the message\"}', 1, 1, NULL, '2023-08-30 12:46:20'),
(30, 'BANK_TRANSFER', 'Bank Transfer', 'Bank Transfer', '<div>You have successfully transferred a QR payment. Please find the payment details below.</div><div><b><br></b></div><div><b>Details:</b></div><div>Amount: {{amount}} {{site_currency}}</div><div><div>Merchant: {{merchant}}<br></div></div>Payer: {{payer}}<div>Transaction Number : {{trx}}</div><div><br></div><div><br><br><br></div></div>', 'You have {{type}} a QR Payment.', '{\"trx\":\"Transaction Number\",\"amount\":\"QR Payment amount\",\"type\":\"Transaction type\",\"merchant\":\"Beneficiary\",\"payer\":\"Customer\"}', 1, 1, NULL, '2023-08-30 12:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `vendor_id` int(20) DEFAULT NULL,
  `store_id` int(10) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `deposit_code` varchar(100) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_logo` text DEFAULT NULL,
  `product_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `value` varchar(30) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `payment` float(10,2) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `status_code` varchar(10) DEFAULT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `trx` varchar(40) DEFAULT NULL,
  `source` varchar(10) DEFAULT NULL,
  `balance_before` float(6,2) DEFAULT NULL,
  `balance_after` float(6,2) DEFAULT NULL,
  `val_1` varchar(200) DEFAULT NULL,
  `val_2` varchar(200) DEFAULT NULL,
  `val_3` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p2ps`
--

CREATE TABLE `p2ps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `receiver` int(11) NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(40) DEFAULT NULL,
  `trx` varchar(40) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `remark` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `slug` varchar(40) DEFAULT NULL,
  `tempname` varchar(40) DEFAULT NULL COMMENT 'template name',
  `secs` text DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"faq\"]', 1, '2020-07-11 06:23:58', '2023-08-28 23:15:35'),
(22, 'FAQ', 'faq', 'templates.basic.', '[\"faq\"]', 0, '2023-08-28 23:30:31', '2023-08-28 23:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('test@test.com', '491909', '2024-04-21 07:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `group` varchar(40) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `group`, `code`) VALUES
(1, 'Dashboard', 'AdminController', 'admin.dashboard'),
(2, 'All Staff', 'StaffController', 'admin.staff.index'),
(3, 'Add New Staff', 'StaffController', 'admin.staff.save'),
(4, 'Change Staff Status', 'StaffController', 'admin.staff.status'),
(5, 'Staff Login', 'StaffController', 'admin.staff.login'),
(6, 'Roles', 'RolesController', 'admin.roles.index'),
(7, 'Add New Role - Page', 'RolesController', 'admin.roles.add'),
(8, 'Update Role - Page', 'RolesController', 'admin.roles.edit'),
(9, 'Add/Update Role', 'RolesController', 'admin.roles.save'),
(10, 'Notifications', 'AdminController', 'admin.notifications'),
(11, 'Notification Mark As Read', 'AdminController', 'admin.notification.read'),
(12, 'Notifications Mark All As Read', 'AdminController', 'admin.notifications.readAll'),
(13, 'Request Report', 'AdminController', 'admin.request.report'),
(14, 'Submit Request Report', 'AdminController', 'admin.request.report.submit'),
(15, 'View Beneficiary Details', 'AdminController', 'admin.beneficiary.details'),
(16, 'Download Attachment', 'AdminController', 'admin.download.attachment'),
(17, 'All Users', 'ManageUsersController', 'admin.users.all'),
(18, 'Active Users', 'ManageUsersController', 'admin.users.active'),
(19, 'Banned Users', 'ManageUsersController', 'admin.users.banned'),
(20, 'Email Verified Users', 'ManageUsersController', 'admin.users.email.verified'),
(21, 'Email Unverified Users', 'ManageUsersController', 'admin.users.email.unverified'),
(22, 'Mobile Unverified Users', 'ManageUsersController', 'admin.users.mobile.unverified'),
(23, 'Kyc Verified Users', 'ManageUsersController', 'admin.users.kyc.verified'),
(24, 'Kyc Unverified Users', 'ManageUsersController', 'admin.users.kyc.unverified'),
(25, 'Kyc Pending Users', 'ManageUsersController', 'admin.users.kyc.pending'),
(26, 'Mobile Verified Users', 'ManageUsersController', 'admin.users.mobile.verified'),
(27, 'Users With Balance', 'ManageUsersController', 'admin.users.with.balance'),
(28, 'Owes Users', 'ManageUsersController', 'admin.users.owes'),
(29, 'Owes Dps Users', 'ManageUsersController', 'admin.users.owes.dps'),
(30, 'Owes Loan Users', 'ManageUsersController', 'admin.users.owes.loan'),
(31, 'User Detail', 'ManageUsersController', 'admin.users.detail'),
(32, 'User Kyc Details', 'ManageUsersController', 'admin.users.kyc.details'),
(33, 'Kyc Approve', 'ManageUsersController', 'admin.users.kyc.approve'),
(34, 'Kyc Reject', 'ManageUsersController', 'admin.users.kyc.reject'),
(35, 'User Update', 'ManageUsersController', 'admin.users.update'),
(36, 'User Balance Addition Subtraction', 'ManageUsersController', 'admin.users.add.sub.balance'),
(37, 'Send Notification To Single User - Page', 'ManageUsersController', 'admin.users.notification.single'),
(39, 'Login As User', 'ManageUsersController', 'admin.users.login'),
(40, 'Change User Status', 'ManageUsersController', 'admin.users.status'),
(41, 'Send Notification To All Users - Page', 'ManageUsersController', 'admin.users.notification.all'),
(42, 'Send Notification To All Users', 'ManageUsersController', 'admin.users.notification.all.send'),
(43, 'Users Notification Log', 'ManageUsersController', 'admin.users.notification.log'),
(44, 'View User Beneficiaries', 'ManageUsersController', 'admin.users.beneficiaries'),
(45, 'Subscribers', 'SubscriberController', 'admin.subscriber.index'),
(46, 'Send Email To Subscribers - Page', 'SubscriberController', 'admin.subscriber.send.email'),
(47, 'Remove Subscriber', 'SubscriberController', 'admin.subscriber.remove'),
(48, 'Send Email To Subscribers', 'SubscriberController', 'admin.subscriber.send.email.submit'),
(49, 'Automatic Gateway', 'AutomaticGatewayController', 'admin.gateway.automatic.index'),
(50, 'Update Automatic Gateway - Page', 'AutomaticGatewayController', 'admin.gateway.automatic.edit'),
(51, 'Update Automatic Gateway', 'AutomaticGatewayController', 'admin.gateway.automatic.update'),
(52, 'Remove Automatic Gateway', 'AutomaticGatewayController', 'admin.gateway.automatic.remove'),
(53, 'Change Automatic Gateway Status', 'AutomaticGatewayController', 'admin.gateway.automatic.status'),
(54, 'Manual Gateway', 'ManualGatewayController', 'admin.gateway.manual.index'),
(55, 'Create Manual Gateway - Page', 'ManualGatewayController', 'admin.gateway.manual.create'),
(56, 'Create Gateway Manual', 'ManualGatewayController', 'admin.gateway.manual.store'),
(57, 'Update Manual Gateway - Page', 'ManualGatewayController', 'admin.gateway.manual.edit'),
(58, 'Update Manual Gateway', 'ManualGatewayController', 'admin.gateway.manual.update'),
(59, 'Change Manual Gateway Status', 'ManualGatewayController', 'admin.gateway.manual.status'),
(60, 'Deposits', 'DepositController', 'admin.deposit.list'),
(61, 'Pending Deposits', 'DepositController', 'admin.deposit.pending'),
(62, 'Rejected Deposits', 'DepositController', 'admin.deposit.rejected'),
(63, 'Approved Deposits', 'DepositController', 'admin.deposit.approved'),
(64, 'Successful Deposits', 'DepositController', 'admin.deposit.successful'),
(65, 'Initiated Deposits', 'DepositController', 'admin.deposit.initiated'),
(66, 'Deposit Details', 'DepositController', 'admin.deposit.details'),
(67, 'Reject Deposit', 'DepositController', 'admin.deposit.reject'),
(68, 'Approve Deposit', 'DepositController', 'admin.deposit.approve'),
(69, 'Pending Withdrawals', 'WithdrawalController', 'admin.withdraw.pending'),
(70, 'Approved Withdrawals', 'WithdrawalController', 'admin.withdraw.approved'),
(71, 'Rejected Withdrawals', 'WithdrawalController', 'admin.withdraw.rejected'),
(72, 'All Withdrawals', 'WithdrawalController', 'admin.withdraw.log'),
(73, 'Withdrawal Details', 'WithdrawalController', 'admin.withdraw.details'),
(74, 'Approve Withdrawal', 'WithdrawalController', 'admin.withdraw.approve'),
(75, 'Reject Withdrawal', 'WithdrawalController', 'admin.withdraw.reject'),
(76, 'Withdrawal Methods', 'WithdrawMethodController', 'admin.withdraw.method.index'),
(77, 'Create Withdrawal Method - Page', 'WithdrawMethodController', 'admin.withdraw.method.create'),
(78, 'Create Withdrawal Method', 'WithdrawMethodController', 'admin.withdraw.method.store'),
(79, 'Update Withdrawal Method - Page', 'WithdrawMethodController', 'admin.withdraw.method.edit'),
(80, 'Update Withdrawal Method', 'WithdrawMethodController', 'admin.withdraw.method.update'),
(81, 'Change Withdrawal Method Status', 'WithdrawMethodController', 'admin.withdraw.method.status'),
(82, 'Transaction Log', 'ReportController', 'admin.report.transaction'),
(83, 'Login History', 'ReportController', 'admin.report.login.history'),
(84, 'Login IpHistory', 'ReportController', 'admin.report.login.ipHistory'),
(85, 'Notification History', 'ReportController', 'admin.report.notification.history'),
(86, 'Email Details', 'ReportController', 'admin.report.email.details'),
(87, 'All Ticket', 'SupportTicketController', 'admin.ticket.index'),
(88, 'Pending Ticket', 'SupportTicketController', 'admin.ticket.pending'),
(89, 'Closed Ticket', 'SupportTicketController', 'admin.ticket.closed'),
(90, 'Answered Ticket', 'SupportTicketController', 'admin.ticket.answered'),
(91, 'View Ticket', 'SupportTicketController', 'admin.ticket.view'),
(92, 'Reply Ticket', 'SupportTicketController', 'admin.ticket.reply'),
(93, 'Close Ticket', 'SupportTicketController', 'admin.ticket.close'),
(94, 'Download Ticket', 'SupportTicketController', 'admin.ticket.download'),
(95, 'Delete Ticket', 'SupportTicketController', 'admin.ticket.delete'),
(96, 'Language', 'LanguageController', 'admin.language.manage'),
(97, 'Add New Language', 'LanguageController', 'admin.language.manage.store'),
(98, 'Delete Language', 'LanguageController', 'admin.language.manage.delete'),
(99, 'Update Language', 'LanguageController', 'admin.language.manage.update'),
(100, 'Add Language Key - Page', 'LanguageController', 'admin.language.key'),
(101, 'Import Language Keywords', 'LanguageController', 'admin.language.import.lang'),
(102, 'Add Language Key', 'LanguageController', 'admin.language.store.key'),
(103, 'Delete Language Key', 'LanguageController', 'admin.language.delete.key'),
(104, 'Update Language Key', 'LanguageController', 'admin.language.update.key'),
(105, 'General Setting', 'GeneralSettingController', 'admin.setting.index'),
(106, 'Update General Setting', 'GeneralSettingController', 'admin.setting.update'),
(107, 'System Configuration', 'GeneralSettingController', 'admin.setting.system.configuration'),
(108, 'Update System Configuration', 'GeneralSettingController', 'admin.setting.system.configuration.submit'),
(109, 'Logo & Favicon', 'GeneralSettingController', 'admin.setting.logo.icon'),
(110, 'Update Logo & Favicon', 'GeneralSettingController', 'admin.setting.logo.icon.update'),
(111, 'Custom Css', 'GeneralSettingController', 'admin.setting.custom.css'),
(112, 'Update Custom Css', 'GeneralSettingController', 'admin.setting.custom.css.submit'),
(113, 'Cookie Policy', 'GeneralSettingController', 'admin.setting.cookie'),
(114, 'Update Cookie Policy', 'GeneralSettingController', 'admin.setting.cookie.submit'),
(115, 'Maintenance Mode - Page', 'GeneralSettingController', 'admin.maintenance.mode'),
(116, 'Update Maintenance Mode', 'GeneralSettingController', 'admin.maintenance.mode.submit'),
(117, 'Kyc Setting - Page', 'KycController', 'admin.kyc.setting'),
(118, 'Update Kyc Setting', 'KycController', 'admin.kyc.setting.submit'),
(119, 'Referral Setting', 'ReferralSettingController', 'admin.referral.setting'),
(120, 'Update Referral Setting', 'ReferralSettingController', 'admin.referral.setting.save'),
(121, 'Count Referral Setting', 'ReferralSettingController', 'admin.referral.setting.count'),
(122, 'Global Template', 'NotificationController', 'admin.setting.notification.global'),
(123, 'Update Global Template', 'NotificationController', 'admin.setting.notification.global.update'),
(124, 'Templates', 'NotificationController', 'admin.setting.notification.templates'),
(125, 'Update Templates - Page', 'NotificationController', 'admin.setting.notification.template.edit'),
(126, 'Update Templates', 'NotificationController', 'admin.setting.notification.template.update'),
(127, 'Email Setting', 'NotificationController', 'admin.setting.notification.email'),
(129, 'Test Email', 'NotificationController', 'admin.setting.notification.email.test'),
(130, 'Sms Setting', 'NotificationController', 'admin.setting.notification.sms'),
(132, 'Test Sms', 'NotificationController', 'admin.setting.notification.sms.test'),
(133, 'Push Notification - Page', 'NotificationController', 'admin.setting.notification.push'),
(134, 'Update Push Notification', 'NotificationController', 'admin.setting.notification.push.setting'),
(135, 'Extensions', 'ExtensionController', 'admin.extensions.index'),
(136, 'Update Extensions', 'ExtensionController', 'admin.extensions.update'),
(137, 'Change Extensions Status', 'ExtensionController', 'admin.extensions.status'),
(138, 'Application System Info', 'SystemController', 'admin.system.info'),
(139, 'Server System Info', 'SystemController', 'admin.system.server.info'),
(140, 'System Optimize - Page', 'SystemController', 'admin.system.optimize'),
(141, 'Clear System Cache', 'SystemController', 'admin.system.optimize.clear'),
(142, 'Seo Manager', 'FrontendController', 'admin.seo'),
(143, 'Manage Templates - Page', 'FrontendController', 'admin.frontend.templates'),
(144, 'Set Active Templates', 'FrontendController', 'admin.frontend.templates.active'),
(145, 'Frontend Sections - Page', 'FrontendController', 'admin.frontend.sections'),
(146, 'Update Frontend Sections Content', 'FrontendController', 'admin.frontend.sections.content'),
(147, 'Frontend Sections Element - Page', 'FrontendController', 'admin.frontend.sections.element'),
(148, 'Remove Frontend Section', 'FrontendController', 'admin.frontend.remove'),
(149, 'Manage Pages', 'PageBuilderController', 'admin.frontend.manage.pages'),
(150, 'Add New Page', 'PageBuilderController', 'admin.frontend.manage.pages.save'),
(151, 'Update Page', 'PageBuilderController', 'admin.frontend.manage.pages.update'),
(152, 'Delete Page', 'PageBuilderController', 'admin.frontend.manage.pages.delete'),
(153, 'Manage Section - Page', 'PageBuilderController', 'admin.frontend.manage.section'),
(154, 'Update Manage Section', 'PageBuilderController', 'admin.frontend.manage.section.update'),
(155, 'Manage Airtime', 'BillsController', 'admin.bills.airtime'),
(156, 'Manage Internet', 'BillsController', 'admin.bills.internet'),
(157, 'Manage Cable TV', 'BillsController', 'admin.bills.cabletv'),
(158, 'Manage Utility Bills', 'BillsController', 'admin.bills.utility'),
(159, 'Manage Insurance', 'BillsController', 'admin.bills.insurance'),
(160, 'Manage Voucher', 'VoucherController', 'admin.voucher.log'),
(161, 'Create Voucher', 'VoucherController', 'admin.voucher.create'),
(162, 'Delete Voucher', 'VoucherController', 'admin.voucher.delete'),
(163, 'Manage Savings', 'SavingsController', 'admin.savings.log'),
(164, 'View Savings', 'SavingsController', 'admin.savings.view'),
(165, 'Manage Storefront', 'StorefrontController', 'admin.storefront.index'),
(166, 'Edit Storefront', 'StorefrontController', 'admin.storefront.edit'),
(167, 'Manage Virtual Card', 'BillsController', 'admin.bills.virtualcard'),
(168, 'View Virtual Card', 'BillsController', 'admin.bills.virtualcard.details'),
(169, 'Manage Giftcards', 'GiftcardController', 'admin.giftcardindex'),
(170, 'Manage Giftcard Type', 'GiftcardController', 'admin.editcardType'),
(171, 'Edit Giftcard', 'GiftcardController', 'admin.editcard'),
(172, 'Activate Giftcard', 'GiftcardController', 'admin.activatecard'),
(173, 'Deactivate Gofttcard', 'GiftcardController', 'admin.deactivatecard'),
(174, 'Delete Giftcard', 'GiftcardController', 'admin.deletecard'),
(175, 'Add New Giftcard Type', 'GiftcardController', 'admin.storecardType'),
(176, 'Activate Giftcard Type', 'GiftcardController', 'admin.activatecardtype'),
(177, 'Deactivate Giftcard Type', 'GiftcardController', 'admin.deactivatecardtype'),
(178, 'Delete Card Type', 'GiftcardController', 'admin.deletecardtype'),
(179, 'Update Gifttcard Type', 'GiftcardController', 'admin.updatecardType'),
(180, 'Create New Giftcard', 'GiftcardController', 'admin.storecard'),
(181, 'Manage Coin', 'CoinController', 'admin.crypto.currency'),
(182, 'Activate Coin', 'CoinController', 'admin.activatecoin'),
(183, 'Deactivate Coin', 'CoinController', 'admin.deactivatecoin'),
(219, 'Update Email Notification', 'NotificationController', 'admin.setting.notification.email.update'),
(220, 'Update Sms Notification', 'NotificationController', 'admin.setting.notification.sms.update'),
(221, 'Update Wire Transfer Setting', 'WireTransferSettingController', 'admin.wire.transfer.setting.save'),
(222, 'Update Wire Transfer Form', 'WireTransferSettingController', 'admin.wire.transfer.form.save'),
(223, 'Send Notification To Single User', 'ManageUsersController', 'admin.users.notification.single.send'),
(224, 'Language Get Key', 'LanguageController', 'admin.language.get.key'),
(225, 'System Update', 'SystemController', 'admin.system.update'),
(226, 'System Update Upload', 'SystemController', 'admin.system.update.upload'),
(227, 'All Cron List', 'CronConfigurationController', 'admin.cron.index'),
(228, 'Add new Cron', 'CronConfigurationController', 'admin.cron.store'),
(229, 'Update Cron', 'CronConfigurationController', 'admin.cron.update'),
(230, 'Delete Cron', 'CronConfigurationController', 'admin.cron.delete'),
(231, 'Cron Schedule List', 'CronConfigurationController', 'admin.cron.schedule'),
(232, 'Add new Cron Schedule', 'CronConfigurationController', 'admin.cron.schedule.store'),
(233, 'Change Cron Schedule Status', 'CronConfigurationController', 'admin.cron.schedule.status'),
(234, 'Pause Cron Schedule', 'CronConfigurationController', 'admin.cron.schedule.pause'),
(235, 'Cron Schedule Logs', 'CronConfigurationController', 'admin.cron.schedule.logs'),
(236, 'Cron Schedule Log Resolved', 'CronConfigurationController', 'admin.cron.schedule.log.resolved'),
(237, 'Cron Log Flush', 'CronConfigurationController', 'admin.cron.log.flush'),
(238, 'Manage Plans', 'FdrPlanController', 'admin.plans.fdr.index'),
(239, 'Add / Update Plan', 'FdrPlanController', 'admin.plans.fdr.save'),
(240, 'Change Plan Status', 'FdrPlanController', 'admin.plans.fdr.status'),
(241, 'Manage Wallets', 'CoinController', 'admin.crypto.wallet'),
(242, 'View Wallets', 'CoinController', 'admin.crypto.viewwallet'),
(243, 'Deactivate Wallet', 'CoinController', 'admin.crypto.deactivatewallet'),
(244, 'Activate Wallet', 'CoinController', 'admin.crypto.activatewallet'),
(245, 'View Wallet Transaction', 'CoinController', 'admin.crypto.viewwalletd'),
(246, 'Deactivate Currency', 'CoinController', 'admin.crypto.deactivatecoin'),
(247, 'Activate Currency', 'CoinController', 'admin.crypto.activatecoin'),
(248, 'Update Currency', 'CoinController', 'admin.crypto.edit'),
(249, 'Trade Sales', 'CoinController', 'admin.crypto.assetselltrade'),
(250, 'Trade Buys', 'CoinController', 'admin.crypto.assetbuytrade'),
(251, 'Manage City', 'CityController', 'admin.city.index'),
(252, 'Create City', 'CityController', 'admin.city.store'),
(253, 'Update City', 'CityController', 'admin.city.update'),
(255, 'Manage Location', 'LocationController', 'admin.location.index'),
(256, 'Create Location', 'LocationController', 'admin.location.store'),
(257, 'Update Location', 'LocationController', 'admin.location.update'),
(258, 'Create Event', 'EventController', 'admin.event.create'),
(259, 'All Events', 'EventController', 'admin.event.index'),
(260, 'Pending Events', 'EventController', 'admin.event.pending'),
(261, 'Approved Events', 'EventController', 'admin.event.approved'),
(262, 'Canceled Events', 'EventController', 'admin.event.cancel'),
(263, 'Edit Events', 'EventController', 'admin.event.edit'),
(264, 'View Event Ticket Sales', 'EventController', 'admin.event.info'),
(265, 'Update Event Status', 'EventController', 'admin.event.update.status'),
(266, 'Edit Events Tickets', 'EventController', 'admin.event.tickets'),
(267, 'Manage Events Types', 'EventTypeController', 'admin.event.type.index'),
(268, 'Create Event Types', 'EventTypeController', 'admin.event.type.store'),
(269, 'Update Event Types', 'EventTypeController', 'admin.event.type.update'),
(270, 'All Escrow', 'EscrowController', 'admin.escrow.index'),
(271, 'Accepted Escrow', 'EscrowController', 'admin.escrow.accepted'),
(272, 'Not Accepted Escrow', 'EscrowController', 'admin.escrow.not.accepted'),
(273, 'Completed Escrow', 'EscrowController', 'admin.escrow.completed'),
(274, 'Disputed Escrow', 'EscrowController', 'admin.escrow.disputed'),
(275, 'Cancelled Escrow', 'EscrowController', 'admin.escrow.canceled'),
(276, 'View Escrow Details', 'EscrowController', 'admin.escrow.details'),
(277, 'View Escrow Milestone', 'EscrowController', 'admin.escrow.milestone'),
(278, 'Update Escrow Status', 'EscrowController', 'admin.escrow.action'),
(279, 'Reply Escrow Chat', 'EscrowController', 'admin.escrow.message.reply'),
(280, 'View Escrow Chat', 'EscrowController', 'admin.escrow.message.get'),
(281, 'Manage Escrow Charge', 'ChargeController', 'admin.charge.global'),
(282, 'Create or Update Escrow Charge', 'ChargeController', 'admin.charge.store'),
(283, 'Delete Escrow Charge', 'ChargeController', 'admin.charge.remove'),
(284, 'Manage Escrow Category', 'CategoryController', 'admin.category.index'),
(285, 'Create or Update Escrow Category', 'CategoryController', 'admin.category.store'),
(286, 'Delete Escrow Category', 'CategoryController', 'admin.category.delete'),
(287, 'Change Escrow Category Status', 'CategoryController', 'admin.category.status'),
(288, 'Manage Airtime Swap', 'BillsController', 'admin.bills.airtime2cash');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `percent` varchar(191) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_payments`
--

CREATE TABLE `request_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(255) NOT NULL,
  `account_id` varchar(4) DEFAULT NULL,
  `amount` varchar(15) DEFAULT NULL,
  `rate` varchar(5) DEFAULT NULL,
  `fee` varchar(100) DEFAULT NULL,
  `pay` varchar(100) DEFAULT NULL,
  `proof` varchar(100) DEFAULT NULL,
  `trx` varchar(20) DEFAULT NULL,
  `details` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_payment_accounts`
--

CREATE TABLE `request_payment_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `currency` varchar(4) DEFAULT NULL,
  `rate` varchar(15) DEFAULT NULL,
  `fee` varchar(5) DEFAULT NULL,
  `details` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Role Manager', '2024-01-08 15:22:59', '2024-01-10 09:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `id` int(32) NOT NULL,
  `type` int(10) DEFAULT NULL,
  `user_id` int(32) NOT NULL,
  `amount` varchar(32) NOT NULL,
  `cycle` varchar(44) DEFAULT NULL,
  `recurrent` int(22) DEFAULT NULL,
  `recurrent_count` int(11) DEFAULT NULL,
  `next_recurrent` datetime DEFAULT NULL,
  `mature` datetime DEFAULT NULL,
  `balance` varchar(100) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `reference` varchar(32) NOT NULL,
  `val_1` varchar(200) DEFAULT NULL,
  `val_2` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` varchar(77) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saving_pays`
--

CREATE TABLE `saving_pays` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `saving_id` varchar(60) DEFAULT NULL,
  `plan_id` varchar(88) DEFAULT NULL,
  `amount` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(30) DEFAULT NULL,
  `trx` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `ticket` varchar(40) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `trx_id` varchar(50) NOT NULL,
  `event_id` int(100) NOT NULL,
  `ticket_id` varchar(30) NOT NULL,
  `ticket_type` int(10) DEFAULT NULL,
  `code` varchar(30) DEFAULT NULL,
  `gateway_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gateway_response`)),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Enable : 1, Disable : 2\r\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(40) DEFAULT NULL,
  `trx` varchar(250) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `remark` varchar(40) DEFAULT NULL,
  `val_1` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(40) DEFAULT NULL,
  `lastname` varchar(40) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `api_key` varchar(191) DEFAULT NULL,
  `webhook_url` varchar(250) DEFAULT NULL,
  `redirect_url` varchar(250) DEFAULT NULL,
  `country_code` varchar(40) DEFAULT NULL,
  `mobile` varchar(40) DEFAULT NULL,
  `ref_by` int(10) DEFAULT NULL,
  `balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `ref_balance` decimal(28,6) NOT NULL DEFAULT 0.000000,
  `hold_balance` float(8,2) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `trx_password` varchar(200) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `nuban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nuban`)),
  `nuban_ref` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL COMMENT 'contains full address',
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: mobile unverified, 1: mobile verified',
  `en` int(1) DEFAULT NULL,
  `sn` int(1) DEFAULT NULL,
  `profile_complete` tinyint(1) NOT NULL DEFAULT 0,
  `kyc_complete` int(1) DEFAULT NULL,
  `kyc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kyc`)),
  `ver_code` varchar(40) DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) DEFAULT NULL,
  `vendor` int(1) DEFAULT NULL,
  `api_access` int(1) DEFAULT NULL,
  `ban_reason` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `plan_id` int(10) DEFAULT NULL,
  `earn_at` datetime DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `customer_id` varchar(250) DEFAULT NULL,
  `customer_tier` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `api_key`, `webhook_url`, `redirect_url`, `country_code`, `mobile`, `ref_by`, `balance`, `ref_balance`, `hold_balance`, `password`, `trx_password`, `image`, `nuban`, `nuban_ref`, `address`, `gender`, `dob`, `status`, `ev`, `sv`, `en`, `sn`, `profile_complete`, `kyc_complete`, `kyc`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `vendor`, `api_access`, `ban_reason`, `remember_token`, `plan_id`, `earn_at`, `expire_at`, `customer_id`, `customer_tier`, `created_at`, `updated_at`) VALUES
(1, 'Oluwakayode', 'Adetunji', 'test1234', 'adetunjioluwakayode@gmail.com', NULL, NULL, NULL, 'NG', '2343453455345', 0, '22.00000000', '0.000000', NULL, '$2y$10$pP/QrGJ/WkGIqyKeSXKCWOAyXkDdIpB8LaFP4vFizfz01gyBbZwYe', NULL, NULL, NULL, NULL, '{\"address\":\"Akute\",\"city\":\"Ogun State\",\"state\":\"None Selected\",\"zip\":\"234\",\"country\":\"Nigeria\"}', NULL, NULL, 1, 1, 1, NULL, NULL, 1, 1, NULL, '499831', '2024-04-29 22:11:06', 0, 1, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-29 21:11:06', '2024-04-29 21:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_ip` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `country_code` varchar(40) DEFAULT NULL,
  `longitude` varchar(40) DEFAULT NULL,
  `latitude` varchar(40) DEFAULT NULL,
  `browser` varchar(40) DEFAULT NULL,
  `os` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `city`, `country`, `country_code`, `longitude`, `latitude`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', '', '', '', '', '', 'Handheld Browser', 'iPhone', '2024-04-29 21:11:06', '2024-04-29 21:11:06'),
(2, 1, '127.0.0.1', '', '', '', '', '', 'Chrome', 'Mac OS X', '2024-04-30 09:27:09', '2024-04-30 09:27:09'),
(3, 1, '127.0.0.1', '', '', '', '', '', 'Handheld Browser', 'iPhone', '2024-04-30 10:26:56', '2024-04-30 10:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `virtual_cards`
--

CREATE TABLE `virtual_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `customer_id` varchar(200) NOT NULL,
  `card_id` varchar(250) NOT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `currency` varchar(3) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `expiry_month` varchar(10) DEFAULT NULL,
  `expiry_year` varchar(10) DEFAULT NULL,
  `pan` varchar(40) DEFAULT NULL,
  `environment` varchar(10) NOT NULL,
  `api` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`api`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `beneficiary_id` int(10) DEFAULT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `code` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL,
  `wallet` varchar(10) DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `currency` varchar(40) NOT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx` varchar(40) NOT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `after_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `withdraw_information` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT 0.00000000,
  `max_limit` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `delay` varchar(191) DEFAULT NULL,
  `fixed_charge` decimal(28,8) DEFAULT 0.00000000,
  `rate` decimal(28,8) DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `user_data` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `affiliate` int(1) DEFAULT NULL,
  `payout_days` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airtime_cashes`
--
ALTER TABLE `airtime_cashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_job_logs`
--
ALTER TABLE `cron_job_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cron_schedules`
--
ALTER TABLE `cron_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cryptocurrencies`
--
ALTER TABLE `cryptocurrencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cryptotrxes`
--
ALTER TABLE `cryptotrxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cryptowallets`
--
ALTER TABLE `cryptowallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_infos`
--
ALTER TABLE `event_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fdrs`
--
ALTER TABLE `fdrs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fdr_number` (`fdr_number`);

--
-- Indexes for table `fdr_plans`
--
ALTER TABLE `fdr_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giftcards`
--
ALTER TABLE `giftcards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giftcardsales`
--
ALTER TABLE `giftcardsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giftcardtypes`
--
ALTER TABLE `giftcardtypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loan_number` (`loan_number`);

--
-- Indexes for table `loan_plans`
--
ALTER TABLE `loan_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p2ps`
--
ALTER TABLE `p2ps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_payments`
--
ALTER TABLE `request_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_payment_accounts`
--
ALTER TABLE `request_payment_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saving_pays`
--
ALTER TABLE `saving_pays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `virtual_cards`
--
ALTER TABLE `virtual_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `airtime_cashes`
--
ALTER TABLE `airtime_cashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cron_job_logs`
--
ALTER TABLE `cron_job_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cron_schedules`
--
ALTER TABLE `cron_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cryptocurrencies`
--
ALTER TABLE `cryptocurrencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `cryptotrxes`
--
ALTER TABLE `cryptotrxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cryptowallets`
--
ALTER TABLE `cryptowallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_infos`
--
ALTER TABLE `event_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fdrs`
--
ALTER TABLE `fdrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fdr_plans`
--
ALTER TABLE `fdr_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `giftcards`
--
ALTER TABLE `giftcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `giftcardsales`
--
ALTER TABLE `giftcardsales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giftcardtypes`
--
ALTER TABLE `giftcardtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_plans`
--
ALTER TABLE `loan_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p2ps`
--
ALTER TABLE `p2ps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_payments`
--
ALTER TABLE `request_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_payment_accounts`
--
ALTER TABLE `request_payment_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saving_pays`
--
ALTER TABLE `saving_pays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `virtual_cards`
--
ALTER TABLE `virtual_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
