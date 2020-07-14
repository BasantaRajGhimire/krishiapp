-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2020 at 07:37 AM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softmaha_ebidding`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_services`
--

CREATE TABLE `add_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_services`
--

INSERT INTO `add_services` (`id`, `service_type_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Electrical and Lighting', 'Vendor is responsible for installation of all laying,cabelling  and fittings of wires,lights,boards and related accessories', NULL, NULL),
(2, 2, 'Civil design(Eg:Structural design)', 'Vendor provides all civil drawings and design', NULL, NULL),
(3, 3, 'Equipment leasing(Eg:Tower Cranes,Concrete Batch,,Concrete pumps,exavator etc.)', 'Vendor provides Leasing of construction tools and  machines', NULL, NULL),
(4, 1, 'Piping and Plumbing', 'Vendor provides all plumbing works', NULL, NULL),
(5, 1, 'Tiles and Marbles', 'Vendor provides all Tiles , marble and granite works', NULL, NULL),
(6, 1, 'Paint Works', 'vendor provides all paint jobs', NULL, NULL),
(7, 2, 'Architectural design(Eg: Interior and exterior design)', 'Vendor provides all architectural design', NULL, NULL),
(8, 2, 'Consultation(Eg:IEA,DPR,Estimation)', 'Vendor provides all consultation services like IEA,DPR,ESTIMATION etc', NULL, NULL),
(9, 3, 'Equipment buying(Eg:Tower Cranes,Concrete Batch,,Concrete pumps,exavator etc.)', 'Vendor provides selling of construction tool and machines', NULL, NULL),
(10, 1, 'General Contracting', 'Vendor provides all contracting service from start to end of project', NULL, NULL),
(11, 4, 'Manufacturing', 'Vendor is manufacturer who supplies products in bulk and cheap', NULL, NULL),
(12, 4, 'Wholeselling and Retailing', 'Vendor provides all  Wholeselling and Retailing of different materials', NULL, NULL),
(13, 1, 'Furniture and Carpentry', 'Vendor provides all furniture and carpentry works', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@admin.com', NULL, '$2y$10$w0FF0RsYGpWrxCzcckXK1et9XN3BGT2TNMXseJ81C86y9798TDfZG', 1, NULL, NULL, NULL),
(2, 'Admin User2', 'admin@admin2.com', NULL, '$2y$10$jg7oDILVgxyDs1U4Zmcwc.Li9odxFWDuOoqyLJOUS29TWiFAzDmQu', 0, NULL, NULL, NULL),
(3, 'Admin User4', 'admin@admin4.com', NULL, '$2y$10$k0Dt2TpXkMRbcqGWFSsXte8LJQCjYY3mOgeaOzXxNptk6eWuejejm', 0, NULL, NULL, NULL),
(4, 'Binod', 'touchbinod@gmail.com', NULL, '$2y$10$exNpePkUxHXnkBawiixGRuH3D5CRZKdmxpci72S.TzgPthKc4L5Nu', 0, NULL, '2019-09-26 16:58:16', '2019-09-26 16:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Silver Badge', 'Silver vendor', NULL, NULL),
(2, 'Gold Badge', 'Gold Vendor', NULL, NULL),
(3, 'Platinum Badge', 'Platinum vendor', NULL, NULL),
(4, 'Diamond Badge', 'Diamond vendor', NULL, NULL),
(6, 'No Badge', 'No badge', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_forget_password`
--

CREATE TABLE `client_forget_password` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `_token` varchar(100) NOT NULL,
  `token_verified_at` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0->pending, 1->completed,2->expire',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_forget_password`
--

INSERT INTO `client_forget_password` (`id`, `user_id`, `email`, `_token`, `token_verified_at`, `status`, `created_at`, `updated_at`) VALUES
(2, '1', 'raju.poudel42@gmail.com', 'TCJt8kur9aYoAnG1G6IBV0wPpeYIPjeIWi9ClFnH', NULL, 2, '2019-09-30 09:48:59', '2019-09-30 10:39:39'),
(3, '1', 'raju.poudel42@gmail.com', '7b92387942d37c0c387df24ef0acf915', '2019-09-30 11:16:55', 1, '2019-09-30 10:39:39', '2019-09-30 11:16:55'),
(4, '1', 'raju.poudel42@gmail.com', '1f8a8b59ba65d9dd497bf618dbe78436', '2019-09-30 11:23:55', 1, '2019-09-30 11:23:27', '2019-09-30 11:23:55'),
(5, '1', 'raju.poudel42@gmail.com', '863444332c7a19bf78d094412bb43177', '2019-09-30 21:41:37', 1, '2019-09-30 11:55:50', '2019-09-30 11:56:37'),
(6, '21', 'touchbinod@gmail.com', '4b514250ed978e58840937e48d37b2b0', NULL, 0, '2019-11-14 09:42:38', '2019-11-14 09:42:38'),
(7, '26', 'chandra@mailinator.com', '32a95d12aaf8a84b71049abfa6ee2a75', NULL, 0, '2019-12-07 02:56:25', '2019-12-07 02:56:25'),
(8, '1', 'raju.poudel42@gmail.com', 'e354925ca81681751208c88bcd5d3e76', '2019-12-21 18:52:56', 1, '2019-12-21 08:06:20', '2019-12-21 08:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `client_post`
--

CREATE TABLE `client_post` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `category` char(1) NOT NULL COMMENT 'M->materials, S->services',
  `district` int(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0->pending, 1->approved, 2->rejected, 3->completed, 4->expired, 5->on_delivery',
  `file_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estimated_cost` int(5) DEFAULT NULL,
  `duration_days` int(2) DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_post`
--

INSERT INTO `client_post` (`id`, `client_id`, `category`, `district`, `address`, `description`, `status`, `file_id`, `created_at`, `updated_at`, `estimated_cost`, `duration_days`, `expired_at`) VALUES
(69, 31, 'M', 1, 'Kalanki', 'i need one lakh unit of red clay bricks for my new building project to be delivered at location in 10 delivery', 4, NULL, '2019-12-30 13:51:43', '2020-01-09 13:52:02', 1500000, 10, '2020-01-10 00:36:43'),
(70, 31, 'S', 3, 'Bhaktapur', 'i need engineering drawing services both interior and exterior', 4, NULL, '2019-12-31 08:30:05', '2020-01-07 08:31:02', 500000, 8, '2020-01-07 19:15:05'),
(71, 32, 'M', 1, 'Bharatpur-20, kathmandu', 'dfsd fsdfsdfsdfsdf', 5, NULL, '2020-01-01 04:28:48', '2020-01-01 04:29:51', 10000, 12, '2020-01-13 15:13:48'),
(72, 32, 'S', 1, 'Bharatpur-20, kathmandu', 'szff sdsadasdasd asd asd as', 3, NULL, '2020-01-01 04:30:49', '2020-01-01 04:32:54', 12000, 12, '2020-01-13 15:15:49'),
(73, 31, 'S', 2, 'lalitpur', 'i want to design 4 storey home.', 5, NULL, '2020-01-01 06:24:15', '2020-01-03 14:16:58', NULL, 6, '2020-01-07 17:09:15'),
(74, 33, 'S', 2, 'lalitpur', 'i need jcb dozer to remove earth works', 4, NULL, '2020-01-06 15:36:42', '2020-01-09 15:37:02', 100000, 3, '2020-01-10 02:21:42'),
(76, 35, 'S', 3, 'Kathamndu', 'hfg', 4, NULL, '2020-02-13 11:29:05', '2020-02-27 11:30:03', 1000000, 14, '2020-02-27 22:14:05'),
(77, 35, 'S', 2, 'Imadol, Imadol', 'hdtdfbsf', 4, NULL, '2020-02-13 11:36:48', '2020-06-24 11:37:02', 1000000, 132, '2020-06-24 21:21:48'),
(78, 31, 'S', 1, 'kathmandu', 'i need building design', 4, NULL, '2020-02-18 07:29:15', '2020-02-23 07:30:04', 100000, 5, '2020-02-23 18:14:15'),
(79, 41, 'M', 2, 'Mahalaxmisthan', 'I want 840 PPC non branded cements for reconstruction of my house...', 5, NULL, '2020-03-13 06:40:48', '2020-03-13 07:26:16', NULL, 5, '2020-03-18 16:25:48'),
(80, 41, 'M', 1, '54y 45 y45', 'tr 4y45 y4 5y45y', 3, NULL, '2020-03-16 07:08:58', '2020-03-16 07:24:20', 9000, 12, '2020-03-28 16:53:58'),
(81, 41, 'M', 1, 'Bhaktapur, Lalitpur', 'I need floor tile with diagonal line design. Also the color must be green.', 4, NULL, '2020-03-16 11:21:00', '2020-03-26 11:21:01', 10000, 10, '2020-03-26 21:06:00'),
(82, 44, 'S', 1, 'Kathmandu', 'Construction of building fencing using brick wall', 4, NULL, '2020-05-31 06:40:35', '2020-06-10 06:41:02', 1000000, 10, '2020-06-10 16:25:35'),
(83, 44, 'S', 2, 'thapathali', 'new item', 4, 10, '2020-05-31 06:50:13', '2020-06-15 06:51:02', 100000, 15, '2020-06-15 16:35:13'),
(85, 31, 'S', 1, 'kathmandu', 'i want general contracting service', 4, NULL, '2020-06-11 12:59:12', '2020-06-26 13:00:03', 10000000, 15, '2020-06-26 22:44:12'),
(86, 31, 'M', 1, 'kathmandu', 'i want 10,000 bags of cement', 4, NULL, '2020-06-11 13:12:08', '2020-06-18 13:13:02', 10000000, 7, '2020-06-18 22:57:08'),
(87, 31, 'S', 1, 'kathmandu', 'i want to design a building', 4, NULL, '2020-06-21 03:39:41', '2020-06-28 03:40:03', 10000000, 7, '2020-06-28 13:24:41'),
(88, 31, 'M', 1, 'kathmandu', 'Bid as soon possible', 4, NULL, '2020-06-24 10:25:13', '2020-07-01 10:26:02', 5000, 7, '2020-07-01 20:10:13'),
(89, 31, 'S', 1, 'Ranipokhari', 'Testing', 1, NULL, '2020-06-25 16:28:37', '2020-06-25 17:00:07', 500000, 10, '2020-07-06 02:13:37'),
(90, 31, 'S', 1, 'sankhamul', 'i want to design new building', 1, NULL, '2020-06-30 08:50:47', '2020-06-30 08:52:26', 100000, 7, '2020-07-07 18:35:47'),
(91, 31, 'S', 1, 'sankhamul', 'i want new house map', 1, NULL, '2020-06-30 08:59:18', '2020-06-30 08:59:41', 200000, 5, '2020-07-05 18:44:18');

-- --------------------------------------------------------

--
-- Table structure for table `client_post_materials`
--

CREATE TABLE `client_post_materials` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL DEFAULT 0,
  `material_type_id` int(11) NOT NULL DEFAULT 0,
  `brand_id` int(11) NOT NULL DEFAULT 0,
  `quantity` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_post_materials`
--

INSERT INTO `client_post_materials` (`id`, `client_id`, `post_id`, `material_id`, `material_type_id`, `brand_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(44, 31, 69, 3, 10, 19, 100000, 0, '2019-12-30 13:51:43', '2019-12-30 13:51:43'),
(45, 32, 71, 1, 1, 4, 12, 0, '2020-01-01 04:28:48', '2020-01-01 04:28:48'),
(46, 41, 79, 1, 2, 7, 840, 0, '2020-03-13 06:40:48', '2020-03-13 06:40:48'),
(47, 41, 80, 1, 1, 4, 84, 0, '2020-03-16 07:08:58', '2020-03-16 07:08:58'),
(48, 41, 81, 2, 4, 8, 19, 0, '2020-03-16 11:21:00', '2020-03-16 11:21:00'),
(49, 44, 84, 6, 20, 32, 5, 0, '2020-06-01 09:28:27', '2020-06-01 09:28:27'),
(50, 31, 86, 1, 1, 4, 10000, 0, '2020-06-11 13:12:08', '2020-06-11 13:12:08'),
(51, 31, 88, 2, 4, 9, 500, 0, '2020-06-24 10:25:13', '2020-06-24 10:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `client_post_services`
--

CREATE TABLE `client_post_services` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `land_area` varchar(255) DEFAULT NULL,
  `no_of_storey` int(10) UNSIGNED DEFAULT NULL,
  `floor_space` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_post_services`
--

INSERT INTO `client_post_services` (`id`, `post_id`, `client_id`, `service_type_id`, `service_id`, `status`, `created_at`, `updated_at`, `land_area`, `no_of_storey`, `floor_space`) VALUES
(40, 70, 31, 2, 7, 0, '2019-12-31 08:30:05', '2019-12-31 08:30:05', NULL, NULL, NULL),
(41, 72, 32, 1, 1, 0, '2020-01-01 04:30:49', '2020-01-01 04:30:49', NULL, NULL, NULL),
(42, 73, 31, 2, 2, 0, '2020-01-01 06:24:15', '2020-01-01 06:24:15', '5', 4, '1500'),
(43, 74, 33, 3, 3, 0, '2020-01-06 15:36:42', '2020-01-06 15:36:42', NULL, NULL, NULL),
(44, 75, 34, 2, 7, 0, '2020-01-07 02:42:52', '2020-01-07 02:42:52', NULL, NULL, NULL),
(45, 76, 35, 1, 5, 0, '2020-02-13 11:29:05', '2020-02-13 11:29:05', NULL, NULL, NULL),
(46, 77, 35, 2, 2, 0, '2020-02-13 11:36:48', '2020-02-13 11:36:48', '12', 7, '12'),
(47, 78, 31, 2, 2, 0, '2020-02-18 07:29:15', '2020-02-18 07:29:15', '5', 4, '1000'),
(48, 82, 44, 1, 10, 0, '2020-05-31 06:40:35', '2020-05-31 06:40:35', NULL, NULL, NULL),
(49, 83, 44, 1, 10, 0, '2020-05-31 06:50:13', '2020-05-31 06:50:13', '3', 2, '1500'),
(50, 85, 31, 1, 10, 0, '2020-06-11 12:59:12', '2020-06-11 12:59:12', NULL, NULL, NULL),
(51, 87, 31, 2, 2, 0, '2020-06-21 03:39:41', '2020-06-21 03:39:41', '10', 4, '1500'),
(52, 89, 31, 1, 1, 0, '2020-06-25 16:28:37', '2020-06-25 16:28:37', NULL, NULL, NULL),
(53, 90, 31, 2, 7, 0, '2020-06-30 08:50:47', '2020-06-30 08:50:47', NULL, NULL, NULL),
(54, 90, 31, 2, 7, 0, '2020-06-30 08:51:59', '2020-06-30 08:51:59', NULL, NULL, NULL),
(55, 91, 31, 2, 2, 0, '2020-06-30 08:59:18', '2020-06-30 08:59:18', '4', 5, '2000');

-- --------------------------------------------------------

--
-- Table structure for table `client_tickets`
--

CREATE TABLE `client_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenshot` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_tickets`
--

INSERT INTO `client_tickets` (`id`, `client_id`, `category_id`, `ticket_id`, `title`, `priority`, `message`, `status`, `screenshot`, `remarks`, `created_at`, `updated_at`) VALUES
(24, 31, 2, 'EF2R67IXCA', '2', 'high', 'bank deposited balance not updated in my account.\r\nThankyou', 'Closed', 'screenshot1577781314.png', 'Your issue has been solved', '2019-12-31 08:35:14', '2019-12-31 08:51:25'),
(25, 35, 1, 'PSASRGQWIH', '1', 'medium', 'dsafasf', 'Open', '', NULL, '2020-02-13 11:32:48', '2020-02-13 11:32:48'),
(26, 35, 1, 'M90ZC0W25X', '1', 'medium', 'dsafasf', 'Open', '', NULL, '2020-02-13 11:32:49', '2020-02-13 11:32:49'),
(27, 37, 1, '9LX1MUZNRY', '1', 'medium', 'fdfdsfdsf', 'Processing', '', 'drtret retretret', '2020-02-18 11:18:29', '2020-02-18 11:20:53'),
(28, 37, 1, 'CSVVMJI9SX', '1', 'medium', 'fdfdsfdsf', 'Closed', '', 'fdgfdgdfgdfg', '2020-02-18 11:19:04', '2020-02-18 11:19:41'),
(29, 40, 1, 'JAFEF4K3YE', '1', 'low', 'fdgdsfdsfsdf', 'Open', '', NULL, '2020-02-18 11:31:16', '2020-02-18 11:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `client_ticket_category`
--

CREATE TABLE `client_ticket_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_ticket_category`
--

INSERT INTO `client_ticket_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Login', NULL, NULL),
(2, 'Escrow payment', NULL, NULL),
(3, 'Bidding', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_ticket_title`
--

CREATE TABLE `client_ticket_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_ticket_title`
--

INSERT INTO `client_ticket_title` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'login credential not working properly', '1', NULL, NULL),
(2, 'Balance release amount not displaying accurately', '2', NULL, NULL),
(3, 'cannot able to post a bid', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_users`
--

CREATE TABLE `client_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` int(11) NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1->Active; 2->Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_users`
--

INSERT INTO `client_users` (`id`, `name`, `email`, `dob`, `mobile`, `occupation`, `district`, `gender`, `address`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(31, 'Binod BK', 'touchbinod@gmail.com', '1989-05-07', '9851203275', 'business', 1, 'Male', 'Sankhamul', '2019-12-31 00:33:15', '$2y$10$uvECu1fM6DEg.eFpvxCBF.PoKOquyIX3FVUL5TRHR1J5kOMU5DHCC', 'onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 1, '2019-12-31 00:30:35', '2019-12-31 00:33:15'),
(32, 'Raju Poudel', 'raju.poudel42@gmail.com', '2020-01-01', '9845807543', 'Student', 1, 'Male', 'Bharatpur-20, kathmandu', '2020-01-01 15:13:10', '$2y$10$VuhiTLnTdRzRSsoRQgHvs.7c7E6qgkw/zUqCjnhZgczs7PHDD/gpS', 'pKBzkDQNhsBYQEO6mYRhGYko1LphlLoUDX7bQJxT', 1, '2020-01-01 15:12:47', '2020-01-01 15:13:10'),
(33, 'Sudikshya', 'sudikshya.sharma22@gmail.com', '0994-11-12', '9849603275', 'job holder', 1, 'Female', 'sankhamul', '2020-01-07 01:53:23', '$2y$10$G9QwbsNo1JzDcMqFgCRmue.GjTkBURGhrFcTIN0UweF0EAY.idyuy', '6HRYjiTANPAkSZhwEJMFgPq7Lz3preCA5EwnRvSS', 1, '2020-01-07 01:49:16', '2020-01-07 01:53:23'),
(34, 'Overcrash', 'overcrash007@gmail.com', '1990-10-16', '9841320000', 'Cement Retailer', 1, 'Male', '1103323sdfs', '2020-01-07 13:25:03', '$2y$10$BOXeTKBf1F0kDqRzy./dLOiVpw6XFMaZWBhLnw5zSrchXuIsCzX9C', 'glbgySCnaRJH2bqCfgfUmWuV2JAHwtfceCJag0fn', 1, '2020-01-07 13:23:56', '2020-01-07 13:25:03'),
(35, 'Prem Singh', 'upasargatechnology@gmail.com', '2006-06-13', '9849654930', 'ENGINEER', 1, 'Male', 'Imadol, Imadol', NULL, '$2y$10$EMWUqBvODzB4BGe/yh5HUOlIDClkcXGsP7McZ9r1JeKpTYCIf/t8C', 'tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 1, '2020-02-13 22:08:56', '2020-02-13 22:08:56'),
(36, 'Ashok Singh', 'premsingh@gmail.com', '2020-02-13', '9815720356', 'ENGINEER', 1, 'Male', 'Kathamndu', NULL, '$2y$10$hwSu3LVP/mxa1L4hCiIEY.McN6pzlJeJ8KAjQxyqJNq82qZ.LBh5a', 'tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 1, '2020-02-13 22:11:14', '2020-02-13 22:11:14'),
(40, 'Raju Poudel', 'facebookcommuni@gmail.com', '2020-02-05', '9812121211', 'Student', 1, 'Male', 'Bharatpur-20, kathmandu', '2020-02-18 22:15:51', '$2y$10$mMAsW6B4SiMS2SRaGcqtiOF9lhN6/fmCbxaEQK7fDG9Z9HsVWV0J2', 'GUU3fK0QZ6gCbjBnURolhTcjySCwyYlBFEcwhOXB', 1, '2020-02-18 22:14:26', '2020-02-18 22:15:51'),
(41, 'documentation', 'p59aeqt@upcmaill.com', '1987-12-18', '9849808471', 'QA', 1, 'Male', 'Lalitpur', '2020-03-13 16:21:31', '$2y$10$YuBjtUONaqeYKAsyk7Mvr.lUB5QLQQ763rNKm/XZosaB0iea/VyxG', 'YPaf8tWBkU2q3VMq81xEywGw0s9vMvDQDt82wVoA', 1, '2020-03-13 16:21:03', '2020-03-13 16:21:31'),
(42, 'awdawd', 'p59aeqt@upmaill.com', '2020-03-14', '9849808471', 'awdawd', 1, 'Male', 'awdawdawd', NULL, '$2y$10$aGihe4xTH53w/5IM6.TJYerEpfPOmTBZyjeRN7D9Dke2pvpy294Gm', 'duMrV8E5nqFalFg6MaNV7DPBasiyVZbMn5NwJSkw', 1, '2020-03-13 20:29:50', '2020-03-13 20:29:50'),
(43, 'asdasdasd', 'sepev26720@newe-mail.com', '2020-03-28', '9848484646', 'QA', 1, 'Male', 'awdadw', NULL, '$2y$10$MCtWn7ZQeXjhKT8oEcahTOUNMB7LdmpcfEs9a.xtA2n9S4rzAqyD2', 'duMrV8E5nqFalFg6MaNV7DPBasiyVZbMn5NwJSkw', 1, '2020-03-13 20:45:10', '2020-03-13 20:45:10'),
(44, 'subash', 'adhikarisubash@live.com', '1992-04-23', '9840067556', 'Test', 1, 'Male', 'Kathmandu', NULL, '$2y$10$fdN5K6aYo/liNuhIWYuTUebt20twxEKN1K.gei/zt8eHoga94exUq', 'sis6gN8N1NDyGm3pJuNnUfBSGDHbWdoLiVBCLqgd', 1, '2020-05-31 16:00:34', '2020-05-31 16:00:34'),
(45, 'Test User', 'test@test.com', '2019-12-10', '9841351128', 'Test', 1, 'Male', 'Test Place', NULL, '$2y$10$m7/7HZlPF7Zp3VBkv.USZues6FLsrfVNHHeiPtjyVwOZggCn7GXrm', 'NQ5OZExEsR621ML0eEoPdbS8yHM8GffCIXXD1D2z', 1, '2020-06-24 19:57:38', '2020-06-24 19:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `client_users1`
--

CREATE TABLE `client_users1` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint(11) NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` int(5) NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1->active, 2->inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_users1`
--

INSERT INTO `client_users1` (`id`, `name`, `email`, `dob`, `phone_number`, `mobile`, `district`, `gender`, `address`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Raju Poudel', 'raju.poudel42@gmail.com', '', 9845807543, '', 0, '', '', '2019-08-04 03:36:41', '$2y$10$nsqZB5F2jvweNOuHnYt.Cei5xsVZqcrFCyenq0M3D9MhM3KLXI0q6', '$2y$10$w0FF0RsYGpWrxCzcckXK1et9XN3BGT2TNMXseJ81C86y9798TDfZG', 1, NULL, NULL),
(2, 'Ram Dhakal', 'ram@dhakal.com', '', 9845807543, '', 0, '', '', NULL, '$2y$10$w0FF0RsYGpWrxCzcckXK1et9XN3BGT2TNMXseJ81C86y9798TDfZG', '$2y$10$MjeeAG18dHuilZvQcgUQ0.DOrJWoxIr4nw/0t.dtqf0zWKD2GWbas', 1, NULL, NULL),
(3, 'Ram Dhakal', 'ram@dkl.com', '', 9845807543, '', 0, '', '', NULL, '$2y$10$OBA3f2G0nqmwjRaWlhnW4.K8JiuQbxi65uvey9vScH..uZxh/QDea', '$2y$10$OBA3f2G0nqmwjRaWlhnW4.K8JiuQbxi65uvey9vScH..uZxh/Qaa', 1, NULL, NULL),
(4, 'Ram Dhakal', 'ram@dkl1.com', '', 9845807543, '', 0, '', '', NULL, '$2y$10$otauUTZpLDrnDqL6MVfI2erk15yiVg0gu5nGAB.pWeJEY78fFWa9O', '$2y$10$otauUTZpLDrnDqL6MVfI2erk15yiVg0gu5nGAB.pWeJEY78fFWa12', 1, NULL, NULL),
(17, 'Raju Poudel', 'raju.poudel43@gmail.com', '', 9845807543, '', 0, '', '', '2019-08-12 10:07:49', '$2y$10$oyZU27F6K2v2qtKExsSZwuIBaZ.Pdde1VYMLg8wXCDIz4mGrAjUD6', 'FMObdzKNt6CSVehFSC0wPkAJ09p4ju6jKYkHm3ee', 1, NULL, NULL),
(18, 'Raju Poudel', 'raju.podel44@gmail.com', '2019-09-09', 9845807543, '9812121211', 1, 'Male', 'Kathmandu-12, Anamnagar', NULL, '$2y$10$TElJvY5nvphQcRDZ4zdzh.3cCYmI9F1C8Hvnv8SiYUq/E.LV5nN8S', '07BtbQhVxN0J8aQvxwfvx0PVfTWyV9kibxpqTtHA', 1, NULL, NULL),
(19, 'Admin User3', 'raju@saipal.org', '1995-06-25', 9845807543, '9876543211', 1, 'Male', 'Kathmandu-12, Anamnagar', '2019-09-09 11:13:19', '$2y$10$/tF6Se.QejO2qCvLlGHwi.SAM1MUI2NonpCzhgKTaB9vNbuKP9Q/O', '07BtbQhVxN0J8aQvxwfvx0PVfTWyV9kibxpqTtHA', 1, NULL, NULL),
(20, 'Admin User', 'admin@admin.com', '2019-09-09', 987654321, '9812121212', 1, 'Male', 'Kathmandu-12, Anamnagar', NULL, '$2y$10$7dw5/vjsfeF7HULf9Dylf.e9JH.OklKV1M8hILPgzGItfQv/Vi4bu', '07BtbQhVxN0J8aQvxwfvx0PVfTWyV9kibxpqTtHA', 1, NULL, NULL),
(21, 'Binod B.k', 'touchbinod@gmail.com', '2005-09-13', 9851203275, '9851203273', 1, 'Male', 'Kathmandu', '2019-09-15 20:11:34', '$2y$10$Gzdivo.l9lVSN7LsJ.rvEOItgbWkEQ49RkSu8nRvsKMhv93odpMmm', 'AsFHRwE505iS70ldNsogGdpFCGtcCNZk96iCMvC5', 1, NULL, NULL),
(22, 'Season', 'emailpost549@gmail.com', '2000-01-01', 9849603275, '9849603275', 1, 'Male', 'Kalanki', '2019-09-27 23:37:35', '$2y$10$8h.jJMQUy0RV3ggzlztVSeWuoqYJ2PbDsmDlrsMwAL2n5UVAblboa', 'Zgymht9ifUlz8SIBRA4Q5CVffrMAnrIOjDsa0zvW', 1, NULL, NULL),
(23, 'Aashish Hamal', 'aashish@softmahal.com', '2000-01-07', 9801111111111111, '9812345678', 1, 'Male', 'Demo', '2019-09-30 15:01:31', '$2y$10$DbUYV63VVGbZFfwCsfc1zu2l1RniIlTD.glKfZl/1u7vV1GzSvBb2', '6yI5WhFpAqJ5CQGTYUq6IXnDpmc2VTFyJar7bT1U', 1, NULL, NULL),
(24, 'adsfghj', 'sdffdbadsfdfb@fdgg.com', '2019-01-01', 9801111111111111, '9812345678', 1, 'Male', 'Demo', NULL, '$2y$10$rE86NuNTxwAsv3aOjvRgreJu1iAxH9tHDwhSfvm7yAkYpa6AHK0.a', 'ZAdSIMLUvxuF0XZoiRAcdIZb7M0vUYWXFI4YSio5', 1, NULL, NULL),
(25, 'Laxman Panthi', 'laxpanthi@aol.com', '1991-04-06', 99560111, '9848820719', 1, 'Male', '10277 s lake', NULL, '$2y$10$si2Oi4khhYvHbLaokfpf7O1sp4v27t/9s5miSqD6fICskLPHTm6Q.', 'YNsNk9x4wJBBQM5B1iwoceHR9rtr2nEPm6IWfCOG', 1, NULL, NULL),
(26, 'Chandra Ghimire', 'chandra@mailinator.com', '2000-01-01', 787899777, '9822222222', 1, 'Male', 'test address', NULL, '$2y$10$ZBc6FNJaGAEVuRAPUmcCzOlKL.ixUMWPm.x0MZwyUiHs9oa2bM/yG', 'XUuAxyfHttE6AW5aov8h8BPrQToeklCEQACNY9bn', 1, NULL, NULL),
(27, 'Anup Subedi', 'subedianup2075@gmail.com', '1996-05-09', 9860342400, '9809469670', 1, 'Male', 'Sankhamul', NULL, '$2y$10$Cfqfvo4xwZic6AkLVnbJyea2D10pt0jexhCqyk801BEL4rxvsnTKm', '0X9knL7qEI4lXORUUjGEvCVTxinxUCYK9igBeNKD', 1, NULL, NULL),
(28, 'Sangina Maharjan', 'sangina014@gmail.com', '1995-01-05', 5541479, '9849089808', 3, 'Female', 'Shankhamul', '2019-11-20 13:29:46', '$2y$10$2J9txcTJUckw6OxTnSN9q.aF0RQYOHOB62k9lGYW4bayPsIrYRHnq', '4Lj9JDO0VNaTtVdUM5Nvn5SUumhR7UGL8MHDuE8p', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_class`
--

CREATE TABLE `company_class` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_class`
--

INSERT INTO `company_class` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A', '2019-09-23 05:15:01', '2019-09-23 05:15:01'),
(2, 'B', '2019-09-23 05:15:45', '2019-09-23 05:16:01'),
(3, 'C', '2019-09-26 13:33:05', '2019-09-26 13:33:05'),
(4, 'D', '2019-09-26 13:33:13', '2019-11-13 10:41:32'),
(7, 'None', '2019-10-21 10:20:53', '2019-10-21 10:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_form`
--

CREATE TABLE `contact_us_form` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` longtext NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `replied_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_us_form`
--

INSERT INTO `contact_us_form` (`id`, `name`, `email`, `message`, `status`, `created_at`, `updated_at`, `replied_message`) VALUES
(1, 'Saroj Sir', 'sarojsir@gmail.com', 'asdasdasdasdascddv dasdasd as ad sd as a  htr wfgergas thtrsf eff wgwf', 'REJECTED', '2019-09-25 11:28:36', '2019-12-21 08:40:00', 'sfsdfsdf sdfsd f'),
(2, 'Saroj Sir', 'sarojsir@gmail.com', 'asdasdasdasdascddv dasdasd as ad sd as a  htr wfgergas thtrsf eff wgwf', 'PENDING', '2019-09-25 11:31:55', '2019-09-25 11:31:55', NULL),
(3, 'Saroj Sir', 'sarojsir@gmail.com', 'asdasdasdasdascddv dasdasd as ad sd as a  htr wfgergas thtrsf eff wgwf', 'PENDING', '2019-09-25 11:32:30', '2019-09-25 11:32:30', NULL),
(4, 'adasdasd', 'admin@admin.com', 'adasASasASaasdsadasdasdasfdfgsdf sfsa f ef ew wewe e fef w ew ewf', 'PENDING', '2019-09-25 11:33:25', '2019-09-25 11:33:25', NULL),
(5, 'Raju Poudel', 'raju.poudel42@gmail.com', 'I want to join your company. So, how can i contact you?', 'APPROVED', '2019-12-06 10:58:29', '2019-12-17 10:03:29', NULL),
(6, 'Binod', 'touchbinod@gmail.com', 'hello, i want to join your company is there any vacancy for me.\r\nthankyou', 'APPROVED', '2019-12-07 03:06:23', '2019-12-07 03:09:46', NULL),
(7, 'Test', 'test@test.com', 'test', 'PENDING', '2019-12-11 11:38:59', '2019-12-11 11:38:59', NULL),
(8, 'Aashish Hamal', 'hamaldon@gmail.com', 'dfgvhnbscbv', 'PENDING', '2019-12-11 11:40:26', '2019-12-11 11:40:26', NULL),
(9, 'starwoods', 'touchbinod@gmail.com', 'Hello,i want to join your company.', 'APPROVED', '2019-12-17 09:36:03', '2019-12-17 09:37:17', NULL),
(10, 'Binod', 'touchbinod@gmail.com', 'hello i want to join your company', 'APPROVED', '2019-12-18 15:51:25', '2019-12-18 15:52:51', 'Please stay updated in our vacancy page'),
(11, 'Raju Poudel', 'raju.poudel42@gmail.com', 'asjsd asdasda da', 'PENDING', '2019-12-21 07:30:40', '2019-12-21 07:30:40', NULL),
(12, 'Raju Poudel', 'raju.poudel42@gmail.com', 'asjsd asdasda da', 'PENDING', '2019-12-21 07:31:14', '2019-12-21 07:31:14', NULL),
(13, 'Raju Poudel', 'raju.poudel42@gmail.com', 'asfsf dsfsf dsfds fsd fsd f sd', 'PENDING', '2019-12-21 07:31:37', '2019-12-21 07:31:37', NULL),
(14, 'Raju Poudel', 'raju.poudel42@gmail.com', 'safsa sdadas d', 'APPROVED', '2019-12-21 07:33:14', '2019-12-21 08:39:47', 'efsdfsd fdfsdf'),
(15, 'Technical', 'raju.poudel42@gmail.com', 'asfs fdsf sdf sd fdsf sd fsdf sdfsdf dsf ds fdsddddddsdf dddddsf sdf sdf dsf sdfdsf sdf f sdf dsf dsf ds fsdf', 'APPROVED', '2019-12-21 08:42:32', '2019-12-26 08:58:40', 'thankyou for mailing us'),
(16, 'BINOD', 'TOUCHBINOD@GMAIL.COM', 'I WANT TO GROW MY BUSINESS FROM YOUR PLATFORM. LETS PLAN A E MEETING \r\nTHANKYOU\r\nBINOD BK\r\nSTARWOODS ARCHITECTURE', 'APPROVED', '2019-12-30 14:09:37', '2019-12-30 14:11:34', 'THANKYOU FOFR YOUR INTEREST. WE LL CONTACT YOU SHORTLY FOR FURTHER COMMUNICATIONS'),
(17, 'Anup Subedi', 'subedianup2075@gmail.com', 'I need a one pcs daraz.', 'PENDING', '2019-12-30 15:04:40', '2019-12-30 15:04:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dblog`
--

CREATE TABLE `dblog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_table` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `line_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dblog`
--

INSERT INTO `dblog` (`id`, `user_id`, `user_table`, `action`, `exception`, `created_at`, `updated_at`, `line_number`) VALUES
(152, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Creating default object from empty value (View: /home/softmaha/ebidding.softmahal.com/resources/views/service_provider/main.blade.php)', '2019-12-31 00:40:21', '2019-12-31 00:40:21', 30),
(153, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Call to a member function setCookie() on null', '2019-12-31 00:40:21', '2019-12-31 00:40:21', 180),
(154, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 00:40:21', '2019-12-31 00:40:21', 151),
(155, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 00:40:21', '2019-12-31 00:40:21', 131),
(156, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Creating default object from empty value (View: /home/softmaha/ebidding.softmahal.com/resources/views/service_provider/main.blade.php)', '2019-12-31 00:40:34', '2019-12-31 00:40:34', 30),
(157, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Call to a member function setCookie() on null', '2019-12-31 00:40:34', '2019-12-31 00:40:34', 180),
(158, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 00:40:34', '2019-12-31 00:40:34', 151),
(159, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 00:40:34', '2019-12-31 00:40:34', 131),
(160, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Creating default object from empty value (View: /home/softmaha/ebidding.softmahal.com/resources/views/service_provider/main.blade.php)', '2019-12-31 00:42:16', '2019-12-31 00:42:16', 30),
(161, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Call to a member function setCookie() on null', '2019-12-31 00:42:16', '2019-12-31 00:42:16', 180),
(162, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 00:42:16', '2019-12-31 00:42:16', 151),
(163, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 00:42:16', '2019-12-31 00:42:16', 131),
(164, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Creating default object from empty value (View: /home/softmaha/ebidding.softmahal.com/resources/views/service_provider/main.blade.php)', '2019-12-31 00:42:54', '2019-12-31 00:42:54', 30),
(165, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Call to a member function setCookie() on null', '2019-12-31 00:42:54', '2019-12-31 00:42:54', 180),
(166, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 00:42:54', '2019-12-31 00:42:54', 151),
(167, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 00:42:54', '2019-12-31 00:42:54', 131),
(168, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Creating default object from empty value (View: /home/softmaha/ebidding.softmahal.com/resources/views/service_provider/main.blade.php)', '2019-12-31 00:42:55', '2019-12-31 00:42:55', 30),
(169, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Call to a member function setCookie() on null', '2019-12-31 00:42:55', '2019-12-31 00:42:55', 180),
(170, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 00:42:55', '2019-12-31 00:42:55', 151),
(171, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 00:42:55', '2019-12-31 00:42:55', 131),
(172, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Creating default object from empty value (View: /home/softmaha/ebidding.softmahal.com/resources/views/service_provider/main.blade.php)', '2019-12-31 00:52:27', '2019-12-31 00:52:27', 30),
(173, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Call to a member function setCookie() on null', '2019-12-31 00:52:27', '2019-12-31 00:52:27', 180),
(174, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 00:52:27', '2019-12-31 00:52:27', 151),
(175, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 00:52:27', '2019-12-31 00:52:27', 131),
(176, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Creating default object from empty value (View: /home/softmaha/ebidding.softmahal.com/resources/views/service_provider/main.blade.php)', '2019-12-31 15:12:56', '2019-12-31 15:12:56', 30),
(177, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Call to a member function setCookie() on null', '2019-12-31 15:12:56', '2019-12-31 15:12:56', 180),
(178, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 15:12:56', '2019-12-31 15:12:56', 151),
(179, '15', 'Service Provider', 'http://ebidding.softmahal.com/service-provider', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 15:12:56', '2019-12-31 15:12:56', 131),
(180, '15', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 15 and `status` = 4 group by `created_at`)', '2019-12-31 15:26:56', '2019-12-31 15:26:56', 664),
(181, '15', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2019-12-31 15:26:56', '2019-12-31 15:26:56', 180),
(182, '15', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 15:26:56', '2019-12-31 15:26:56', 151),
(183, '15', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 15:26:56', '2019-12-31 15:26:56', 131),
(184, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'CSRF token mismatch.', '2019-12-31 19:05:54', '2019-12-31 19:05:54', 82),
(185, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 19:05:54', '2019-12-31 19:05:54', 151),
(186, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 19:05:54', '2019-12-31 19:05:54', 131),
(187, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 39 and `status` = 4 group by `created_at`)', '2019-12-31 19:44:10', '2019-12-31 19:44:10', 664),
(188, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2019-12-31 19:44:10', '2019-12-31 19:44:10', 180),
(189, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2019-12-31 19:44:10', '2019-12-31 19:44:10', 151),
(190, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2019-12-31 19:44:10', '2019-12-31 19:44:10', 131),
(191, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'The given data was invalid.', '2020-01-01 00:29:43', '2020-01-01 00:29:43', 315),
(192, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Call to a member function setCookie() on null', '2020-01-01 00:29:44', '2020-01-01 00:29:44', 180),
(193, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-01 00:29:44', '2020-01-01 00:29:44', 151),
(194, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-01 00:29:44', '2020-01-01 00:29:44', 131),
(195, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'The given data was invalid.', '2020-01-01 00:29:53', '2020-01-01 00:29:53', 315),
(196, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Call to a member function setCookie() on null', '2020-01-01 00:29:53', '2020-01-01 00:29:53', 180),
(197, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-01 00:29:53', '2020-01-01 00:29:53', 151),
(198, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-01 00:29:53', '2020-01-01 00:29:53', 131),
(199, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 32 and `status` = 4 group by `created_at`)', '2020-01-01 01:18:41', '2020-01-01 01:18:41', 664),
(200, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-01-01 01:18:41', '2020-01-01 01:18:41', 180),
(201, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-01 01:18:41', '2020-01-01 01:18:41', 151),
(202, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-01 01:18:41', '2020-01-01 01:18:41', 131),
(203, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Undefined offset: 0 (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/single_post.blade.php)', '2020-01-01 17:12:25', '2020-01-01 17:12:25', 2073),
(204, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Call to a member function setCookie() on null', '2020-01-01 17:12:25', '2020-01-01 17:12:25', 180),
(205, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-01 17:12:25', '2020-01-01 17:12:25', 151),
(206, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-01 17:12:26', '2020-01-01 17:12:26', 131),
(207, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Undefined offset: 0 (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/single_post.blade.php)', '2020-01-01 17:12:56', '2020-01-01 17:12:56', 2073),
(208, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Call to a member function setCookie() on null', '2020-01-01 17:12:56', '2020-01-01 17:12:56', 180),
(209, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-01 17:12:56', '2020-01-01 17:12:56', 151),
(210, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-01 17:12:56', '2020-01-01 17:12:56', 131),
(211, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 39 and `status` = 4 group by `created_at`)', '2020-01-02 01:45:58', '2020-01-02 01:45:58', 664),
(212, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-01-02 01:45:58', '2020-01-02 01:45:58', 180),
(213, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-02 01:45:58', '2020-01-02 01:45:58', 151),
(214, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-02 01:45:58', '2020-01-02 01:45:58', 131),
(215, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Undefined offset: 0 (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/single_post.blade.php)', '2020-01-04 00:51:00', '2020-01-04 00:51:00', 2073),
(216, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Call to a member function setCookie() on null', '2020-01-04 00:51:00', '2020-01-04 00:51:00', 180),
(217, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-04 00:51:00', '2020-01-04 00:51:00', 151),
(218, '31', 'Admin', 'http://ebidding.softmahal.com/client/client-post/70?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-04 00:51:00', '2020-01-04 00:51:00', 131),
(219, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 32 and `status` = 4 group by `created_at`)', '2020-01-04 00:56:44', '2020-01-04 00:56:44', 664),
(220, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-01-04 00:56:44', '2020-01-04 00:56:44', 180),
(221, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-04 00:56:44', '2020-01-04 00:56:44', 151),
(222, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-04 00:56:44', '2020-01-04 00:56:44', 131),
(223, '34', 'Client', 'http://ebidding.softmahal.com/client/client-post/75?post_token=glbgySCnaRJH2bqCfgfUmWuV2JAHwtfceCJag0fn', 'Undefined offset: 0 (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/single_post.blade.php)', '2020-01-07 13:28:01', '2020-01-07 13:28:01', 2073),
(224, '34', 'Client', 'http://ebidding.softmahal.com/client/client-post/75?post_token=glbgySCnaRJH2bqCfgfUmWuV2JAHwtfceCJag0fn', 'Call to a member function setCookie() on null', '2020-01-07 13:28:01', '2020-01-07 13:28:01', 180),
(225, '34', 'Client', 'http://ebidding.softmahal.com/client/client-post/75?post_token=glbgySCnaRJH2bqCfgfUmWuV2JAHwtfceCJag0fn', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-07 13:28:01', '2020-01-07 13:28:01', 151),
(226, '34', 'Client', 'http://ebidding.softmahal.com/client/client-post/75?post_token=glbgySCnaRJH2bqCfgfUmWuV2JAHwtfceCJag0fn', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-07 13:28:01', '2020-01-07 13:28:01', 131),
(227, '1', 'Admin', 'http://ebidding.softmahal.com/client/auth/login', 'CSRF token mismatch.', '2020-01-15 01:21:49', '2020-01-15 01:21:49', 82),
(228, '1', 'Admin', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-15 01:21:49', '2020-01-15 01:21:49', 151),
(229, '1', 'Admin', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-15 01:21:49', '2020-01-15 01:21:49', 131),
(230, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'CSRF token mismatch.', '2020-01-15 01:25:16', '2020-01-15 01:25:16', 82),
(231, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-15 01:25:16', '2020-01-15 01:25:16', 151),
(232, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-15 01:25:16', '2020-01-15 01:25:16', 131),
(233, '32', 'Service Provider', 'http://ebidding.softmahal.com/client/auth/login', 'CSRF token mismatch.', '2020-01-15 23:52:58', '2020-01-15 23:52:58', 82),
(234, '32', 'Service Provider', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-15 23:52:58', '2020-01-15 23:52:58', 151),
(235, '32', 'Service Provider', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-15 23:52:58', '2020-01-15 23:52:58', 131),
(236, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 32 and `status` = 4 group by `created_at`)', '2020-01-18 00:13:40', '2020-01-18 00:13:40', 664),
(237, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-01-18 00:13:40', '2020-01-18 00:13:40', 180),
(238, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-01-18 00:13:40', '2020-01-18 00:13:40', 151),
(239, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-01-18 00:13:40', '2020-01-18 00:13:40', 131),
(240, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Undefined offset: 0 (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/single_post.blade.php)', '2020-02-13 22:17:25', '2020-02-13 22:17:25', 2073),
(241, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Call to a member function setCookie() on null', '2020-02-13 22:17:25', '2020-02-13 22:17:25', 180),
(242, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-13 22:17:25', '2020-02-13 22:17:25', 151),
(243, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-13 22:17:25', '2020-02-13 22:17:25', 131),
(244, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials 71sm954171ywd.59 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials 71sm954171ywd.59 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials 71sm954171ywd.59 - gsmtp\r\n\".', '2020-02-13 22:17:49', '2020-02-13 22:17:49', 191),
(245, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Call to a member function setCookie() on null', '2020-02-13 22:17:49', '2020-02-13 22:17:49', 180),
(246, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-13 22:17:49', '2020-02-13 22:17:49', 151),
(247, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-13 22:17:49', '2020-02-13 22:17:49', 131),
(248, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials u136sm824745ywf.101 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials u136sm824745ywf.101 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials u136sm824745ywf.101 - gsmtp\r\n\".', '2020-02-13 22:17:50', '2020-02-13 22:17:50', 191),
(249, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Call to a member function setCookie() on null', '2020-02-13 22:17:50', '2020-02-13 22:17:50', 180),
(250, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-13 22:17:50', '2020-02-13 22:17:50', 151),
(251, '35', 'Client', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-13 22:17:50', '2020-02-13 22:17:50', 131),
(252, '35', 'Client', 'http://ebidding.softmahal.com/client/updateProfile/35', 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'softmaha_ebidding.client_users:email\' doesn\'t exist (SQL: select count(*) as aggregate from `client_users:email` where `email` = upasargatechnology@gmail.com)', '2020-02-13 22:18:52', '2020-02-13 22:18:52', 664),
(253, '35', 'Client', 'http://ebidding.softmahal.com/client/updateProfile/35', 'Call to a member function setCookie() on null', '2020-02-13 22:18:52', '2020-02-13 22:18:52', 180),
(254, '35', 'Client', 'http://ebidding.softmahal.com/client/updateProfile/35', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-13 22:18:52', '2020-02-13 22:18:52', 151),
(255, '35', 'Client', 'http://ebidding.softmahal.com/client/updateProfile/35', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-13 22:18:52', '2020-02-13 22:18:52', 131),
(256, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Undefined offset: 0 (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/single_post.blade.php)', '2020-02-13 22:22:03', '2020-02-13 22:22:03', 2073),
(257, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Call to a member function setCookie() on null', '2020-02-13 22:22:03', '2020-02-13 22:22:03', 180),
(258, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-13 22:22:03', '2020-02-13 22:22:03', 151),
(259, '35', 'Client', 'http://ebidding.softmahal.com/client/client-post/76?post_token=tHrEsE0T1mRdIsqvGAj4cMfyLFIxqYil8rZSau9o', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-13 22:22:03', '2020-02-13 22:22:03', 131),
(260, '32', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 32 and `status` = 4 group by `created_at`)', '2020-02-14 02:59:01', '2020-02-14 02:59:01', 664),
(261, '32', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-02-14 02:59:01', '2020-02-14 02:59:01', 180),
(262, '32', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-14 02:59:01', '2020-02-14 02:59:01', 151),
(263, '32', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-14 02:59:01', '2020-02-14 02:59:01', 131),
(264, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'CSRF token mismatch.', '2020-02-18 18:10:51', '2020-02-18 18:10:51', 82),
(265, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 18:10:51', '2020-02-18 18:10:51', 151),
(266, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 18:10:51', '2020-02-18 18:10:51', 131),
(267, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/44/approve', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials p62sm1551635ywc.44 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials p62sm1551635ywc.44 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials p62sm1551635ywc.44 - gsmtp\r\n\".', '2020-02-18 21:41:18', '2020-02-18 21:41:18', 191),
(268, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/44/approve', 'Call to a member function setCookie() on null', '2020-02-18 21:41:18', '2020-02-18 21:41:18', 180),
(269, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/44/approve', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 21:41:18', '2020-02-18 21:41:18', 151),
(270, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/44/approve', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 21:41:18', '2020-02-18 21:41:18', 131),
(271, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/45/reject', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials h203sm1340548ywb.98 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials h203sm1340548ywb.98 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials h203sm1340548ywb.98 - gsmtp\r\n\".', '2020-02-18 21:41:27', '2020-02-18 21:41:27', 191),
(272, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/45/reject', 'Call to a member function setCookie() on null', '2020-02-18 21:41:27', '2020-02-18 21:41:27', 180),
(273, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/45/reject', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 21:41:27', '2020-02-18 21:41:27', 151),
(274, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/45/reject', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 21:41:27', '2020-02-18 21:41:27', 131),
(275, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/25/approve', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials k135sm1546820ywe.2 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials k135sm1546820ywe.2 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials k135sm1546820ywe.2 - gsmtp\r\n\".', '2020-02-18 21:46:25', '2020-02-18 21:46:25', 191),
(276, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/25/approve', 'Call to a member function setCookie() on null', '2020-02-18 21:46:25', '2020-02-18 21:46:25', 180),
(277, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/25/approve', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 21:46:25', '2020-02-18 21:46:25', 151),
(278, '32', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/25/approve', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 21:46:25', '2020-02-18 21:46:25', 131);
INSERT INTO `dblog` (`id`, `user_id`, `user_table`, `action`, `exception`, `created_at`, `updated_at`, `line_number`) VALUES
(279, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials z2sm1534445ywb.13 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials z2sm1534445ywb.13 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials z2sm1534445ywb.13 - gsmtp\r\n\".', '2020-02-18 22:03:31', '2020-02-18 22:03:31', 191),
(280, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Call to a member function setCookie() on null', '2020-02-18 22:03:31', '2020-02-18 22:03:31', 180),
(281, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:03:31', '2020-02-18 22:03:31', 151),
(282, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:03:31', '2020-02-18 22:03:31', 131),
(283, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials p126sm1482156ywe.12 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials p126sm1482156ywe.12 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials p126sm1482156ywe.12 - gsmtp\r\n\".', '2020-02-18 22:04:05', '2020-02-18 22:04:05', 191),
(284, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Call to a member function setCookie() on null', '2020-02-18 22:04:05', '2020-02-18 22:04:05', 180),
(285, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:04:05', '2020-02-18 22:04:05', 151),
(286, '37', 'Admin', 'http://ebidding.softmahal.com/client/support-ticket', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:04:05', '2020-02-18 22:04:05', 131),
(287, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/28?remarks=fdgfdgdfgdfg&status=Closed', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials 124sm1567600ywm.25 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials 124sm1567600ywm.25 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials 124sm1567600ywm.25 - gsmtp\r\n\".', '2020-02-18 22:04:42', '2020-02-18 22:04:42', 191),
(288, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/28?remarks=fdgfdgdfgdfg&status=Closed', 'Call to a member function setCookie() on null', '2020-02-18 22:04:42', '2020-02-18 22:04:42', 180),
(289, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/28?remarks=fdgfdgdfgdfg&status=Closed', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:04:42', '2020-02-18 22:04:42', 151),
(290, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/28?remarks=fdgfdgdfgdfg&status=Closed', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:04:42', '2020-02-18 22:04:42', 131),
(291, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/27?remarks=drtret%20retretret&status=Processing', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials s68sm1519248ywg.69 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials s68sm1519248ywg.69 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials s68sm1519248ywg.69 - gsmtp\r\n\".', '2020-02-18 22:05:54', '2020-02-18 22:05:54', 191),
(292, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/27?remarks=drtret%20retretret&status=Processing', 'Call to a member function setCookie() on null', '2020-02-18 22:05:54', '2020-02-18 22:05:54', 180),
(293, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/27?remarks=drtret%20retretret&status=Processing', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:05:54', '2020-02-18 22:05:54', 151),
(294, '37', 'Admin', 'http://ebidding.softmahal.com/admin/client-ticket/open/27?remarks=drtret%20retretret&status=Processing', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:05:54', '2020-02-18 22:05:54', 131),
(295, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Trying to get property \'name\' of non-object (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/main.blade.php)', '2020-02-18 22:08:22', '2020-02-18 22:08:22', 178),
(296, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Call to a member function setCookie() on null', '2020-02-18 22:08:22', '2020-02-18 22:08:22', 180),
(297, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:08:22', '2020-02-18 22:08:22', 151),
(298, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:08:22', '2020-02-18 22:08:22', 131),
(299, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Trying to get property \'name\' of non-object (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/main.blade.php)', '2020-02-18 22:08:35', '2020-02-18 22:08:35', 178),
(300, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Call to a member function setCookie() on null', '2020-02-18 22:08:35', '2020-02-18 22:08:35', 180),
(301, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:08:35', '2020-02-18 22:08:35', 151),
(302, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:08:35', '2020-02-18 22:08:35', 131),
(303, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Trying to get property \'name\' of non-object (View: /home/softmaha/ebidding.softmahal.com/resources/views/client/main.blade.php)', '2020-02-18 22:08:47', '2020-02-18 22:08:47', 178),
(304, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Call to a member function setCookie() on null', '2020-02-18 22:08:47', '2020-02-18 22:08:47', 180),
(305, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:08:47', '2020-02-18 22:08:47', 151),
(306, '37', 'Admin', 'http://ebidding.softmahal.com/client', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:08:47', '2020-02-18 22:08:47', 131),
(307, '1', 'Admin', 'http://ebidding.softmahal.com/client/register-form', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials a12sm1535329ywa.95 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials a12sm1535329ywa.95 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials a12sm1535329ywa.95 - gsmtp\r\n\".', '2020-02-18 22:11:45', '2020-02-18 22:11:45', 191),
(308, '1', 'Admin', 'http://ebidding.softmahal.com/client/register-form', 'Call to a member function setCookie() on null', '2020-02-18 22:11:45', '2020-02-18 22:11:45', 180),
(309, '1', 'Admin', 'http://ebidding.softmahal.com/client/register-form', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-18 22:11:45', '2020-02-18 22:11:45', 151),
(310, '1', 'Admin', 'http://ebidding.softmahal.com/client/register-form', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-18 22:11:45', '2020-02-18 22:11:45', 131),
(311, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'CSRF token mismatch.', '2020-02-19 15:43:09', '2020-02-19 15:43:09', 82),
(312, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-02-19 15:43:09', '2020-02-19 15:43:09', 151),
(313, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-02-19 15:43:09', '2020-02-19 15:43:09', 131),
(314, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 46 and `status` = 4 group by `created_at`)', '2020-03-13 17:10:34', '2020-03-13 17:10:34', 664),
(315, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-03-13 17:10:34', '2020-03-13 17:10:34', 180),
(316, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-03-13 17:10:34', '2020-03-13 17:10:34', 151),
(317, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-03-13 17:10:34', '2020-03-13 17:10:34', 131),
(318, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 46 and `status` = 4 group by `created_at`)', '2020-03-13 17:12:21', '2020-03-13 17:12:21', 664),
(319, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-03-13 17:12:21', '2020-03-13 17:12:21', 180),
(320, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-03-13 17:12:21', '2020-03-13 17:12:21', 151),
(321, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-03-13 17:12:21', '2020-03-13 17:12:21', 131),
(322, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/addProfile', 'The given data was invalid.', '2020-03-13 17:14:51', '2020-03-13 17:14:51', 315),
(323, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Call to a member function setCookie() on null', '2020-03-13 17:14:51', '2020-03-13 17:14:51', 180),
(324, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-03-13 17:14:51', '2020-03-13 17:14:51', 151),
(325, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/addProfile', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-03-13 17:14:51', '2020-03-13 17:14:51', 131),
(326, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 46 and `status` = 4 group by `created_at`)', '2020-03-13 17:15:13', '2020-03-13 17:15:13', 664),
(327, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-03-13 17:15:13', '2020-03-13 17:15:13', 180),
(328, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-03-13 17:15:13', '2020-03-13 17:15:13', 151),
(329, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-03-13 17:15:13', '2020-03-13 17:15:13', 131),
(330, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 46 and `status` = 4 group by `created_at`)', '2020-03-13 17:52:22', '2020-03-13 17:52:22', 664),
(331, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-03-13 17:52:22', '2020-03-13 17:52:22', 180),
(332, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-03-13 17:52:22', '2020-03-13 17:52:22', 151),
(333, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-03-13 17:52:22', '2020-03-13 17:52:22', 131),
(334, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 46 and `status` = 4 group by `created_at`)', '2020-03-17 15:04:11', '2020-03-17 15:04:11', 664),
(335, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-03-17 15:04:11', '2020-03-17 15:04:11', 180),
(336, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-03-17 15:04:11', '2020-03-17 15:04:11', 151),
(337, '46', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-03-17 15:04:11', '2020-03-17 15:04:11', 131),
(338, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/30/approve', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials n12sm5753377iog.25 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials n12sm5753377iog.25 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials n12sm5753377iog.25 - gsmtp\r\n\".', '2020-05-31 16:14:23', '2020-05-31 16:14:23', 191),
(339, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/30/approve', 'Call to a member function setCookie() on null', '2020-05-31 16:14:23', '2020-05-31 16:14:23', 180),
(340, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/30/approve', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-05-31 16:14:23', '2020-05-31 16:14:23', 151),
(341, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/30/approve', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-05-31 16:14:23', '2020-05-31 16:14:23', 131),
(342, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/47/approve', 'Failed to authenticate on SMTP server with username \"ethekka@gmail.com\" using 3 possible authenticators. Authenticator LOGIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials l21sm7925641ili.8 - gsmtp\r\n\". Authenticator PLAIN returned Expected response code 235 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials l21sm7925641ili.8 - gsmtp\r\n\". Authenticator XOAUTH2 returned Expected response code 250 but got code \"535\", with message \"535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials l21sm7925641ili.8 - gsmtp\r\n\".', '2020-05-31 16:54:47', '2020-05-31 16:54:47', 191),
(343, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/47/approve', 'Call to a member function setCookie() on null', '2020-05-31 16:54:47', '2020-05-31 16:54:47', 180),
(344, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/47/approve', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-05-31 16:54:47', '2020-05-31 16:54:47', 151),
(345, '1', 'Admin', 'http://ebidding.softmahal.com/admin/serviceprovider-user/47/approve', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-05-31 16:54:47', '2020-05-31 16:54:47', 131),
(346, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 39 and `status` = 4 group by `created_at`)', '2020-05-31 20:05:01', '2020-05-31 20:05:01', 664),
(347, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-05-31 20:05:01', '2020-05-31 20:05:01', 180),
(348, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-05-31 20:05:01', '2020-05-31 20:05:01', 151),
(349, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-05-31 20:05:01', '2020-05-31 20:05:01', 131),
(350, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'CSRF token mismatch.', '2020-06-01 19:24:26', '2020-06-01 19:24:26', 82),
(351, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-01 19:24:26', '2020-06-01 19:24:26', 151),
(352, '1', 'Admin', 'http://ebidding.softmahal.com/service-provider/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-01 19:24:26', '2020-06-01 19:24:26', 131),
(353, '39', 'Service Provider', 'http://ebidding.softmahal.com/client/auth/login', 'CSRF token mismatch.', '2020-06-11 00:26:33', '2020-06-11 00:26:33', 82),
(354, '39', 'Service Provider', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-11 00:26:33', '2020-06-11 00:26:33', 151),
(355, '39', 'Service Provider', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-11 00:26:33', '2020-06-11 00:26:33', 131),
(356, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 38 and `status` = 4 group by `created_at`)', '2020-06-11 00:43:28', '2020-06-11 00:43:28', 664),
(357, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-11 00:43:28', '2020-06-11 00:43:28', 180),
(358, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-11 00:43:28', '2020-06-11 00:43:28', 151),
(359, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-11 00:43:28', '2020-06-11 00:43:28', 131),
(360, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 38 and `status` = 4 group by `created_at`)', '2020-06-11 00:44:16', '2020-06-11 00:44:16', 664),
(361, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-11 00:44:16', '2020-06-11 00:44:16', 180),
(362, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-11 00:44:16', '2020-06-11 00:44:16', 151),
(363, '44', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-11 00:44:16', '2020-06-11 00:44:16', 131),
(364, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 38 and `status` = 4 group by `created_at`)', '2020-06-11 22:52:11', '2020-06-11 22:52:11', 664),
(365, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-11 22:52:11', '2020-06-11 22:52:11', 180),
(366, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-11 22:52:11', '2020-06-11 22:52:11', 151),
(367, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-11 22:52:11', '2020-06-11 22:52:11', 131),
(368, '1', 'Admin', 'http://ebidding.softmahal.com/client/auth/login', 'CSRF token mismatch.', '2020-06-21 13:22:20', '2020-06-21 13:22:20', 82),
(369, '1', 'Admin', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-21 13:22:21', '2020-06-21 13:22:21', 151),
(370, '1', 'Admin', 'http://ebidding.softmahal.com/client/auth/login', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-21 13:22:21', '2020-06-21 13:22:21', 131),
(371, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 38 and `status` = 4 group by `created_at`)', '2020-06-21 13:28:00', '2020-06-21 13:28:00', 664),
(372, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-21 13:28:00', '2020-06-21 13:28:00', 180),
(373, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-21 13:28:00', '2020-06-21 13:28:00', 151),
(374, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-21 13:28:00', '2020-06-21 13:28:00', 131),
(375, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 38 and `status` = 4 group by `created_at`)', '2020-06-21 13:30:30', '2020-06-21 13:30:30', 664),
(376, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-21 13:30:30', '2020-06-21 13:30:30', 180),
(377, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-21 13:30:30', '2020-06-21 13:30:30', 151),
(378, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-21 13:30:30', '2020-06-21 13:30:30', 131),
(379, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 38 and `status` = 4 group by `created_at`)', '2020-06-21 15:35:37', '2020-06-21 15:35:37', 664),
(380, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-21 15:35:37', '2020-06-21 15:35:37', 180),
(381, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-21 15:35:37', '2020-06-21 15:35:37', 151),
(382, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-21 15:35:37', '2020-06-21 15:35:37', 131),
(383, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 38 and `status` = 4 group by `created_at`)', '2020-06-21 15:36:06', '2020-06-21 15:36:06', 664),
(384, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-21 15:36:06', '2020-06-21 15:36:06', 180),
(385, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-21 15:36:06', '2020-06-21 15:36:06', 151),
(386, '31', 'Admin', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-21 15:36:06', '2020-06-21 15:36:06', 131),
(387, '31', 'Client', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 39 and `status` = 4 group by `created_at`)', '2020-06-24 20:08:06', '2020-06-24 20:08:06', 664),
(388, '31', 'Client', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-24 20:08:06', '2020-06-24 20:08:06', 180),
(389, '31', 'Client', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-24 20:08:06', '2020-06-24 20:08:06', 151),
(390, '31', 'Client', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-24 20:08:06', '2020-06-24 20:08:06', 131),
(391, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 39 and `status` = 4 group by `created_at`)', '2020-06-26 01:19:48', '2020-06-26 01:19:48', 664),
(392, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-26 01:19:48', '2020-06-26 01:19:48', 180),
(393, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-26 01:19:48', '2020-06-26 01:19:48', 151),
(394, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-26 01:19:48', '2020-06-26 01:19:48', 131),
(395, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 39 and `status` = 4 group by `created_at`)', '2020-06-26 02:27:01', '2020-06-26 02:27:01', 664),
(396, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-26 02:27:01', '2020-06-26 02:27:01', 180),
(397, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-26 02:27:01', '2020-06-26 02:27:01', 151),
(398, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-26 02:27:01', '2020-06-26 02:27:01', 131);
INSERT INTO `dblog` (`id`, `user_id`, `user_table`, `action`, `exception`, `created_at`, `updated_at`, `line_number`) VALUES
(399, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'SQLSTATE[42000]: Syntax error or access violation: 1055 \'softmaha_ebidding.serviceprovider_bid_post.bid_id\' isn\'t in GROUP BY (SQL: select * from `serviceprovider_bid_post` where `service_provider_id` = 39 and `status` = 4 group by `created_at`)', '2020-06-26 02:27:25', '2020-06-26 02:27:25', 664),
(400, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Call to a member function setCookie() on null', '2020-06-26 02:27:25', '2020-06-26 02:27:25', 180),
(401, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Session\\Middleware\\StartSession::addCookieToResponse() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php on line 60', '2020-06-26 02:27:25', '2020-06-26 02:27:25', 151),
(402, '39', 'Service Provider', 'http://ebidding.softmahal.com/service-provider/get-monthly-bid-graph', 'Argument 1 passed to Illuminate\\Cookie\\Middleware\\EncryptCookies::encrypt() must be an instance of Symfony\\Component\\HttpFoundation\\Response, instance of Illuminate\\View\\View given, called in /home/softmaha/ebidding.softmahal.com/vendor/laravel/framework/src/Illuminate/Cookie/Middleware/EncryptCookies.php on line 66', '2020-06-26 02:27:25', '2020-06-26 02:27:25', 131);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  `district_code` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`, `district_code`, `created_at`, `updated_at`) VALUES
(1, 'Kathmandu', 1, '2019-07-18 09:16:45', '2019-07-18 09:16:45'),
(2, 'Bhaktapur', 2, '2019-07-18 09:16:45', '2019-07-18 09:16:45'),
(3, 'Lalitpur', 3, '2019-07-18 09:16:56', '2019-07-18 09:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `escrowsystem_clientpost_relation_paymentfile`
--

CREATE TABLE `escrowsystem_clientpost_relation_paymentfile` (
  `id` int(11) NOT NULL,
  `esp_id` int(11) NOT NULL,
  `payment_file_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `escrowsystem_clientpost_relation_paymentfile`
--

INSERT INTO `escrowsystem_clientpost_relation_paymentfile` (`id`, `esp_id`, `payment_file_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-01-03 14:27:13', '2020-01-03 14:27:13'),
(2, 2, 2, '2020-01-03 14:27:16', '2020-01-03 14:27:16'),
(3, 3, 2, '2020-01-03 14:27:16', '2020-01-03 14:27:16'),
(4, 3, 3, '2020-01-03 14:31:35', '2020-01-03 14:31:35'),
(5, 4, 3, '2020-01-03 14:31:35', '2020-01-03 14:31:35'),
(6, 4, 4, '2020-01-03 14:35:06', '2020-01-03 14:35:06'),
(7, 9, 5, '2020-06-21 05:51:56', '2020-06-21 05:51:56'),
(8, 10, 5, '2020-06-21 05:51:56', '2020-06-21 05:51:56'),
(9, 11, 5, '2020-06-21 05:51:56', '2020-06-21 05:51:56'),
(10, 12, 5, '2020-06-21 05:51:56', '2020-06-21 05:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `escrowsystem_client_cancel_serviceprovider_paymentrequest`
--

CREATE TABLE `escrowsystem_client_cancel_serviceprovider_paymentrequest` (
  `id` int(11) NOT NULL,
  `espid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `client_comment` longtext DEFAULT NULL,
  `serviceprovider_comment` longtext DEFAULT NULL,
  `phase` varchar(7) NOT NULL,
  `is_solved` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `escrowsystem_client_depo_details`
--

CREATE TABLE `escrowsystem_client_depo_details` (
  `id` int(11) NOT NULL,
  `post_id` varchar(11) NOT NULL,
  `voucher_id` varchar(30) NOT NULL,
  `payment_slip` varchar(100) NOT NULL,
  `amount_deposit` int(11) NOT NULL DEFAULT 0,
  `deposit_from` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `escrowsystem_client_depo_details`
--

INSERT INTO `escrowsystem_client_depo_details` (`id`, `post_id`, `voucher_id`, `payment_slip`, `amount_deposit`, `deposit_from`, `status`, `created_at`, `updated_at`) VALUES
(1, '73', '123', 'payment-slip1578061434-.jpg', 50000, 'Bank of Kathmandu', 'APPROVED', '2020-01-03 14:23:54', '2020-01-03 14:27:13'),
(2, '73', 'jdjweu254', 'payment-slip1578061551-.jpg', 51000, 'Bank of Kathmandu', 'APPROVED', '2020-01-03 14:25:51', '2020-01-03 14:27:16'),
(3, '73', 'uis854', 'payment-slip1578061861-.jpg', 55000, 'Bank of Kathmandu', 'APPROVED', '2020-01-03 14:31:01', '2020-01-03 14:31:35'),
(4, '73', 'iucv458', 'payment-slip1578062088-.jpg', 49000, 'Bank Of Kathmandu', 'APPROVED', '2020-01-03 14:34:48', '2020-01-03 14:35:06'),
(5, '79', '123', 'payment-slip1584085989-.png', 1223, 'asdad', 'APPROVED', '2020-03-13 07:53:09', '2020-06-21 05:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `escrowsystem_client_phase_wise_payment`
--

CREATE TABLE `escrowsystem_client_phase_wise_payment` (
  `id` int(11) NOT NULL,
  `client_id` varchar(20) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `total_amount` int(10) NOT NULL DEFAULT 0,
  `deposit_amount` int(10) NOT NULL DEFAULT 0,
  `remaining_amount` int(10) NOT NULL DEFAULT 0,
  `phase` varchar(10) NOT NULL DEFAULT 'Initial',
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `escrowsystem_client_phase_wise_payment`
--

INSERT INTO `escrowsystem_client_phase_wise_payment` (`id`, `client_id`, `post_id`, `total_amount`, `deposit_amount`, `remaining_amount`, `phase`, `status`, `created_at`, `updated_at`) VALUES
(1, '31', '73', 50000, 50000, 0, 'First', 'Completed', '2020-01-03 14:22:23', '2020-01-03 14:27:13'),
(2, '31', '73', 50000, 50000, 0, 'Second', 'Completed', '2020-01-03 14:22:23', '2020-01-03 14:27:16'),
(3, '31', '73', 50000, 50000, 0, 'Third', 'Completed', '2020-01-03 14:22:23', '2020-01-03 14:31:35'),
(4, '31', '73', 50000, 50000, 0, 'Final', 'Completed', '2020-01-03 14:22:23', '2020-01-03 14:35:06'),
(9, '41', '79', 250, 250, 0, 'First', 'Completed', '2020-03-13 07:53:39', '2020-06-21 05:51:56'),
(10, '41', '79', 250, 250, 0, 'Second', 'Completed', '2020-03-13 07:53:39', '2020-06-21 05:51:56'),
(11, '41', '79', 250, 250, 0, 'Third', 'Completed', '2020-03-13 07:53:39', '2020-06-21 05:51:56'),
(12, '41', '79', 250, 250, 0, 'Final', 'Completed', '2020-03-13 07:53:39', '2020-06-21 05:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `escrowsystem_client_winpost_serviceprovider`
--

CREATE TABLE `escrowsystem_client_winpost_serviceprovider` (
  `id` int(11) NOT NULL,
  `client_id` varchar(20) NOT NULL,
  `service_provider_id` varchar(20) NOT NULL,
  `win_id` varchar(20) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `status` varchar(3) NOT NULL DEFAULT 'OFF',
  `amount_deposit` int(6) DEFAULT 0,
  `bid_amount` int(10) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `escrowsystem_serviceprovider_getpayment_details`
--

CREATE TABLE `escrowsystem_serviceprovider_getpayment_details` (
  `id` int(11) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `essppwp_id` varchar(20) NOT NULL,
  `voucher_id` varchar(50) NOT NULL,
  `deposit_from` varchar(50) NOT NULL,
  `deposit_amount` decimal(10,2) NOT NULL,
  `payment_slip` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `escrowsystem_serviceprovider_getpayment_details`
--

INSERT INTO `escrowsystem_serviceprovider_getpayment_details` (`id`, `post_id`, `essppwp_id`, `voucher_id`, `deposit_from`, `deposit_amount`, `payment_slip`, `created_at`, `updated_at`) VALUES
(1, '73', '1', 'bhsjdf123', 'Global bank', 40000.00, 'payment-slip1578061719-.jpg', '2020-01-03 14:28:39', '2020-01-03 14:28:39'),
(2, '73', '2', 'bsbd987', 'Global Bank', 40000.00, 'payment-slip1578061973-.jpg', '2020-01-03 14:32:53', '2020-01-03 14:32:53'),
(3, '73', '3', 'uiegpx', 'Global Bnak', 40000.00, 'payment-slip1578062184-.jpg', '2020-01-03 14:36:24', '2020-01-03 14:36:24'),
(4, '73', '4', 'jkbdkjf778', 'Global Bank', 80000.00, 'payment-slip1578062357-.jpg', '2020-01-03 14:39:17', '2020-01-03 14:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `escrowsystem_serviceprovider_phase_wise_payment`
--

CREATE TABLE `escrowsystem_serviceprovider_phase_wise_payment` (
  `id` int(11) NOT NULL,
  `service_provider_id` varchar(20) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `total_amount` int(10) NOT NULL DEFAULT 0,
  `withdraw_amount` int(10) NOT NULL DEFAULT 0,
  `remaining_amount` int(10) NOT NULL DEFAULT 0,
  `phase` varchar(10) NOT NULL DEFAULT 'Initial',
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  `is_approved` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `escrowsystem_serviceprovider_phase_wise_payment`
--

INSERT INTO `escrowsystem_serviceprovider_phase_wise_payment` (`id`, `service_provider_id`, `post_id`, `total_amount`, `withdraw_amount`, `remaining_amount`, `phase`, `status`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, '32', '73', 40000, 40000, 0, 'First', 'Released', 1, '2020-01-03 14:22:23', '2020-01-03 14:28:39'),
(2, '32', '73', 40000, 40000, 0, 'Second', 'Released', 1, '2020-01-03 14:22:23', '2020-01-03 14:32:53'),
(3, '32', '73', 40000, 40000, 0, 'Third', 'Released', 1, '2020-01-03 14:22:23', '2020-01-03 14:36:24'),
(4, '32', '73', 80000, 80000, 0, 'Final', 'Released', 1, '2020-01-03 14:22:23', '2020-01-03 14:39:17'),
(9, '46', '79', 200, 0, 200, 'First', 'Pending', 0, '2020-03-13 07:53:39', '2020-03-13 07:53:39'),
(10, '46', '79', 200, 0, 200, 'Second', 'Pending', 0, '2020-03-13 07:53:39', '2020-03-13 07:53:39'),
(11, '46', '79', 200, 0, 200, 'Third', 'Pending', 0, '2020-03-13 07:53:39', '2020-03-13 07:53:39'),
(12, '46', '79', 400, 0, 400, 'Final', 'Pending', 0, '2020-03-13 07:53:39', '2020-03-13 07:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `frontend_brandlogo`
--

CREATE TABLE `frontend_brandlogo` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_logo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `frontend_brandlogo`
--

INSERT INTO `frontend_brandlogo` (`id`, `brand_name`, `brand_logo`, `created_at`, `updated_at`) VALUES
(10, 'Gabo', '/brand_logo/Gabo-1569493882.png', '2019-09-26 10:31:22', '2019-09-26 10:31:22'),
(11, 'Logo1', '/brand_logo/Logo1-1569493894.png', '2019-09-26 10:31:34', '2019-09-26 10:31:34'),
(12, 'Logo2', '/brand_logo/Logo2-1569493904.png', '2019-09-26 10:31:44', '2019-09-26 10:31:44'),
(13, 'Logo8', '/brand_logo/Logo8-1569493930.png', '2019-09-26 10:32:10', '2019-09-26 10:32:10'),
(15, 'Logo5', '/brand_logo/Logo5-1569494288.png', '2019-09-26 10:38:09', '2019-09-26 10:38:09'),
(16, 'Logo6', '/brand_logo/Logo6-1569494301.png', '2019-09-26 10:38:21', '2019-09-26 10:38:21'),
(17, 'Logo7', '/brand_logo/Logo7-1569494310.png', '2019-09-26 10:38:30', '2019-09-26 10:38:30'),
(18, 'Logo8', '/brand_logo/Logo8-1569494320.png', '2019-09-26 10:38:40', '2019-09-26 10:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `frontend_faqpage`
--

CREATE TABLE `frontend_faqpage` (
  `id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `answer` longtext NOT NULL,
  `question_number` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `frontend_faqpage`
--

INSERT INTO `frontend_faqpage` (`id`, `question`, `answer`, `question_number`, `created_at`, `updated_at`) VALUES
(1, '1Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, quae?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio praesentium nemo quos aperiam tenetur quas ducimus, repellat officia quasi aliquid suscipit, commodi consequuntur esse corporis, natus excepturi? Deleniti ad rerum quam quaerat at ab reiciendis fugit maiores tenetur laborum! Magnam dolorum numquam ipsam fuga ut provident, veritatis dicta perspiciatis voluptatum vero quas reprehenderit, quisquam consectetur unde vel similique in! Hic, nesciunt. Quos eos quo eaque id enim nobis labore voluptate voluptates esse eum tempore eius consequuntur mollitia, repellendus laudantium quae molestias vero nostrum quasi hic quibusdam ea sed debitis? Distinctio delectus alias enim aperiam, facilis quod perferendis numquam, itaque, animi unde qui deserunt et natus in assumenda. Similique temporibus praesentium accusantium unde tenetur? Officia recusandae, repellat illo ducimus quas obcaecati similique, debitis nostrum nulla nisi exercitationem blanditiis unde id ratione nam omnis. Voluptatum repellendus facere dicta voluptatem voluptates quis quasi ipsam dolores fugit necessitatibus ab nesciunt eum maiores, sint deleniti, nulla eaque. Quos nulla a, alias dolorem voluptates eveniet nemo quae. Dolore fuga eligendi officia repudiandae. Expedita eveniet nisi architecto exercitationem rem sed! Expedita, totam? Cum, maiores officiis nemo incidunt alias veniam aut corporis error, neque provident architecto excepturi dignissimos, earum odio exercitationem accusantium nostrum libero consequuntur dolorem est! Alias sit esse inventore voluptatibus fugit praesentium repellendus modi cupiditate magni! Ut temporibus maxime, aliquam odio itaque modi, tenetur totam iste ipsam deleniti quam assumenda vitae quis. Corporis velit sed fuga eveniet soluta, sint pariatur ipsa reprehenderit nam eaque iste libero laudantium delectus quisquam voluptatibus quas ad voluptates dolor dolores, itaque facere alias ullam? Vel dicta temporibus laborum placeat quos reprehenderit ad laboriosam at error labore aperiam numquam, tempore commodi ipsam sapiente molestias', 1, '2019-09-25 05:16:43', '2019-09-25 05:59:13'),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, quae?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio praesentium nemo quos aperiam tenetur quas ducimus, repellat officia quasi aliquid suscipit, commodi consequuntur esse corporis, natus excepturi? Deleniti ad rerum quam quaerat at ab reiciendis fugit maiores tenetur laborum! Magnam dolorum numquam ipsam fuga ut provident, veritatis dicta perspiciatis voluptatum vero quas reprehenderit, quisquam consectetur unde vel similique in! Hic, nesciunt. Quos eos quo eaque id enim nobis labore voluptate voluptates esse eum tempore eius consequuntur mollitia, repellendus laudantium quae molestias vero nostrum quasi hic quibusdam ea sed debitis.', 2, '2019-09-25 05:59:44', '2019-09-25 05:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `frontend_imagesliders`
--

CREATE TABLE `frontend_imagesliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontend_imagesliders`
--

INSERT INTO `frontend_imagesliders` (`id`, `title`, `description`, `banner_image`, `created_at`, `updated_at`) VALUES
(1, 'For Manufacturers', '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>', '/image_slider/for-manufacturers-1575359812.jpg', '2019-12-03 18:41:52', '2019-12-06 20:33:04'),
(2, 'For Contractors', '<div style=\"text-align: justify;\">\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>', '/image_slider/for-contractors-1575359861.jpg', '2019-12-03 18:42:41', '2019-12-03 18:42:41'),
(3, 'For Investors', '<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>', '/image_slider/for-investors-1575359883.jpg', '2019-12-03 18:43:03', '2019-12-03 18:43:03'),
(4, 'For Home Owners', '<p style=\"padding-left: 60px; text-align: justify;\"><span style=\"color: #343434; font-family: freight-text-pro, Georgia, sans-serif; font-size: 27px; letter-spacing: 0.1px;\">There are many decisions that must be made when it comes to home construction and remodeling. One of the biggest decisions that must be made is who will you enlist to help you complete your project. If you have a home construction remodel in mind, there are several</span>benefits of hiring a general contractor<span style=\"color: #343434; font-family: freight-text-pro, Georgia, sans-serif; font-size: 27px; letter-spacing: 0.1px;\">.&nbsp;</span></p>', '/image_slider/for-home-owners-1575362221.jpg', '2019-12-03 19:22:01', '2019-12-21 00:25:20'),
(5, 'Wholesaler and Retailer', '<p style=\"text-align: justify;\"><span style=\"color: #222222; font-family: Rubik, Arial, sans-serif; font-size: 17px;\">The wholesaler makes money by being able to buy the product(s) from the manufacturer at a lower price than other businesses would have to pay for the same products from the same manufacturer usually through discounts based on volume buying.</span><span style=\"color: #222222; font-family: Rubik, Arial, sans-serif; font-size: 17px;\">For instance, wholesalers and manufacturers may choose to deal only with businesses that are able to buy particular volumes of merchandise, or sign contracts to supply goods for definite periods of time.</span><span style=\"color: #222222; font-family: Rubik, Arial, sans-serif; font-size: 17px;\">Some may not be willing to ship products to other countries. Fortunately, many are and importing</span><span style=\"color: #222222; font-family: Rubik, Arial, sans-serif; font-size: 17px;\">&nbsp;</span><span style=\"color: #222222; font-family: Rubik, Arial, sans-serif; font-size: 17px;\">may be the only option you have for getting the products you want to sell.</span></p>', '/image_slider/wholesaler-and-retailer-1575981190.jpg', '2019-12-10 23:18:10', '2019-12-10 23:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `frontend_page`
--

CREATE TABLE `frontend_page` (
  `id` int(11) NOT NULL,
  `slug` varchar(3) NOT NULL COMMENT 'AU->aboutus, TAC->terms & conditions, PP->privacy & policy ',
  `content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `frontend_page`
--

INSERT INTO `frontend_page` (`id`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'AU', '<p>This is our open bidding platform where anyone who opens a bid will get vendors participation in the bid and gets products and service delivered as quoted by vendors where client has his her own will to award bid to a vendor due to many factors.This is our open bidding platform where anyone who opens a bid will get vendors participation in the bid and gets products and service delivered as quoted by vendors where client has his her own will to award bid to a vendor due to many factors.This is our open bidding platform where anyone who opens a bid will get vendors participation in the bid and gets products and service delivered as quoted by vendors where client has his her own will to award bid to a vendor due to many factors.This is our open bidding platform where anyone who opens a bid will get vendors participation in the bid and gets products and service delivered as quoted by vendors where client has his her own will to award bid to a vendor due to many factors.This is our open bidding platform where anyone who opens a bid will get vendors participation in the bid and gets products and service delivered as quoted by vendors where client has his her own will to award bid to a vendor due to many factors.This is our open bidding platform where anyone who opens a bid will get vendors participation in the bid and gets products and service delivered as quoted by vendors where client has his her own will to award bid to a vendor due to many factors.This is our open bidding platform where anyone who opens a bid will get vendors participation in the bid and gets products and service delivered as quoted by vendors where client has his her own will to award bid to a vendor due to many factors.</p>', '2019-09-24 11:16:21', '2019-12-20 13:49:22'),
(3, 'TAC', '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae aspernatur quae adipisci ipsam sapiente laudantium vel qui perferendis cumque saepe recusandae blanditiis incidunt, quas nemo, at dignissimos commodi velit vero, eos sunt pariatur et tenetur animi atque! Ea, et blanditiis adipisci quidem, velit sint nisi eveniet ipsa minus porro facere. Sed natus tempore vero dolore asperiores! Omnis magni non eum vel voluptate neque eveniet voluptatibus cum labore repellendus aut deserunt alias iste, officiis distinctio, at optio fuga numquam nulla, exercitationem nihil maxime ea esse? Tempora sint et ea, magni fugiat repellendus eligendi eius rem deleniti qui aliquid ex quod reprehenderit ab sapiente modi numquam id. Molestias corrupti possimus facilis esse assumenda, vel voluptas. Culpa placeat necessitatibus atque blanditiis asperiores nostrum ipsum eius consectetur, accusantium magnam neque dolorum veritatis sit aliquam. Necessitatibus omnis a, iure ratione, laudantium dicta autem minus fugit animi voluptate assumenda quod molestiae iusto, numquam odit. Neque velit quia magni tempore odio quam enim esse ipsum voluptatem itaque, natus aliquid quasi molestiae architecto nostrum rem dicta ducimus deserunt tempora atque saepe voluptate libero.</p>\r\n<p style=\"text-align: justify;\">Dolorum facere ipsa dolore, impedit incidunt omnis inventore eius maxime fugit. Ratione corporis iure iste! Esse obcaecati ipsa eligendi, autem corporis possimus voluptatibus animi numquam rerum molestias aspernatur, qui beatae reiciendis ullam unde quam. Cumque doloremque cupiditate corporis ratione porro pariatur animi quisquam quis error quos repellat sit, repellendus, iste, distinctio nam expedita iure assumenda maxime at beatae amet maiores non sunt culpa! Non neque vitae deserunt quia omnis exercitationem voluptas natus ex accusantium voluptatum! Commodi delectus dolores veniam fugit voluptas obcaecati similique aliquid velit praesentium quaerat rerum, nam explicabo quas iste, facilis inventore voluptatem. Accusantium voluptates iste totam culpa dicta quod, cumque, sed repellendus temporibus tempora saepe? Error dolore ullam corporis a dolores aspernatur sequi, deserunt dolorem distinctio modi eligendi itaque quaerat perferendis commodi optio, temporibus deleniti culpa ad quod officiis assumenda. Perspiciatis sequi autem neque corporis impedit nisi eum exercitationem. Modi ipsa harum non eveniet blanditiis in obcaecati, cupiditate quisquam animi suscipit aliquam fugit. Assumenda libero quasi in, doloremque blanditiis beatae autem ipsa fuga fugiat soluta cum maxime praesentium nobis voluptates dignissimos officiis sed debitis maiores sapiente illum ad corporis voluptatem labore qui! Enim sunt at accusantium eius illo quo velit quam perspiciatis quasi voluptas hic error officiis doloremque dolorem distinctio in blanditiis, omnis odit repellendus reprehenderit. Voluptates obcaecati voluptatibus, aliquid deserunt ducimus consectetur illo aspernatur id. Ullam aliquam nisi maxime perspiciatis voluptate corporis tempora omnis rerum tenetur quos suscipit inventore, laborum, pariatur rem modi corrupti placeat consequuntur ad. Veritatis delectus, officiis laudantium quo ad eum quae? Temporibus labore minus libero dolores error eaque soluta quisquam. Earum, pariatur doloribus. Consequuntur voluptate temporibus dicta voluptatem culpa molestias, beatae reprehenderit reiciendis nostrum earum quos amet ea facilis dolorum maxime nam perferendis tempora assumenda? At aspernatur magnam similique, modi sequi itaque maiores perferendis aut. Repellat, fugiat.</p>\r\n<p style=\"text-align: justify;\">Quaerat rem sunt eius reiciendis? Laborum perferendis rem aut non doloremque harum, perspiciatis ducimus voluptatem natus, nostrum, distinctio ipsa sed veniam? Ducimus modi, voluptatem suscipit minima totam iure omnis iste aut corrupti, nisi ut. Porro quaerat quibusdam pariatur. At totam quidem nisi adipisci saepe repellendus veniam, est, porro explicabo, tempora hic vel recusandae magnam. Necessitatibus ullam doloremque rem! Deleniti, minus necessitatibus facere impedit cumque ratione molestiae corporis libero rem id possimus consequuntur beatae ipsa. Qui optio ratione harum tenetur ipsa dolores iusto voluptas hic quas ipsam cum dolorum quia, illo esse explicabo expedita id doloribus? Nemo aspernatur repellendus, vitae facilis natus optio! Possimus sit animi dignissimos quaerat est nemo modi, voluptas eligendi cumque deserunt, quod laboriosam dolorem nihil mollitia eveniet inventore rerum tenetur minus dolorum nobis, quae eaque. Qui officiis nam necessitatibus sint aut neque dolores voluptate nulla eveniet porro dolorem cumque error in cupiditate, corrupti ipsam explicabo id placeat ipsa hic excepturi? Officia repudiandae quis laboriosam quo eius at sit et tenetur blanditiis, autem animi labore omnis corporis commodi maiores ea dolorum possimus ab numquam itaque? Similique animi non in a tenetur ut temporibus nobis, dicta molestiae sunt cum perspiciatis praesentium iste optio ad suscipit, vitae tempore dolores quae ipsam dolore odio asperiores! Asperiores esse illum unde odio consectetur, ducimus dolor? Facilis repellat expedita nihil illo esse ipsa nemo aspernatur pariatur qui dignissimos, officiis, sunt vel maxime ullam consequuntur in doloremque non eaque hic quae sed quod temporibus vero. Beatae, unde corrupti maxime sequi illo quo velit pariatur architecto animi. Totam sed quis odit illum ut, enim magni tempora reprehenderit velit beatae ab quidem pariatur quo id error dicta? Laboriosam recusandae sequi suscipit quis? Iusto excepturi, nesciunt delectus nobis molestiae mollitia assumenda fugit officia rem nihil hic eos eius tempore odit velit. Deserunt distinctio vitae voluptatibus laudantium cum non fugiat nesciunt quos sunt magni blanditiis dolorem dolorum repellendus facilis aliquid, ad eligendi, omnis veniam atque nisi? Debitis laboriosam, perferendis quas ea, corporis dignissimos sint provident totam in odio mollitia quae pariatur! Asperiores expedita, et dicta vitae nisi commodi obcaecati consequatur inventore sed iste porro error omnis quam veniam dolorem delectus! Repudiandae officia beatae aut porro sed aliquam ea! Asperiores voluptatum cupiditate cumque quis, voluptatem fuga velit quisquam totam minima eos et exercitationem doloribus dolorum autem illo porro atque magni quasi tempore rem! Alias laboriosam ipsum est reiciendis possimus quaerat rerum laudantium sint asperiores facere, molestiae fugiat quo pariatur veniam distinctio repudiandae temporibus eius? Laboriosam maxime, vel obcaecati iste, est blanditiis debitis, enim neque officia harum a. Odit vero facilis exercitationem rerum, nam est blanditiis? Beatae deserunt non dolores at magni velit nisi aliquid porro mollitia amet.</p>\r\n<p style=\"text-align: justify;\">Aut maxime distinctio aliquid vel sequi quisquam nemo amet doloribus aliquam animi incidunt exercitationem vero unde soluta corrupti impedit quam inventore nihil, dolores omnis commodi ad odio sapiente. Atque iste sapiente perferendis? Maiores saepe officia placeat odio earum ratione doloribus molestiae provident delectus amet. Dolore vitae odit sed deserunt numquam, soluta veritatis velit, saepe ex deleniti quasi? Exercitationem, consectetur provident? Vitae totam, animi in, nesciunt mollitia incidunt reiciendis molestiae ipsam voluptatem esse iusto dignissimos possimus maxime quidem asperiores ipsum distinctio pariatur quia aliquam expedita. Animi reprehenderit perferendis corrupti libero doloribus sequi harum exercitationem.</p>', '2019-09-24 11:49:26', '2019-09-25 04:48:07'),
(4, 'PP', '<p style=\"text-align: justify;\"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae aspernatur quae adipisci ipsam sapiente laudantium vel qui perferendis cumque saepe recusandae blanditiis incidunt, quas nemo, at dignissimos commodi velit vero, eos sunt pariatur et tenetur animi atque! Ea, et blanditiis adipisci quidem, velit sint nisi eveniet ipsa minus porro facere. Sed natus tempore vero dolore asperiores! Omnis magni non eum vel voluptate neque eveniet voluptatibus cum labore repellendus aut deserunt alias iste, officiis distinctio, at optio fuga numquam nulla, exercitationem nihil maxime ea esse? Tempora sint et ea, magni fugiat repellendus eligendi eius rem deleniti qui aliquid ex quod reprehenderit ab sapiente modi numquam id. Molestias corrupti possimus facilis esse assumenda, vel voluptas. Culpa placeat necessitatibus atque blanditiis asperiores nostrum ipsum eius consectetur, accusantium magnam neque dolorum veritatis sit aliquam. Necessitatibus omnis a, iure ratione, laudantium dicta autem minus fugit animi voluptate assumenda quod molestiae iusto, numquam odit. Neque velit quia magni tempore odio quam enim esse ipsum voluptatem itaque, natus aliquid quasi molestiae architecto nostrum rem dicta ducimus deserunt tempora atque saepe voluptate libero.</p>\r\n<p style=\"text-align: justify;\">Dolorum facere ipsa dolore, impedit incidunt omnis inventore eius maxime fugit. Ratione corporis iure iste! Esse obcaecati ipsa eligendi, autem corporis possimus voluptatibus animi numquam rerum molestias aspernatur, qui beatae reiciendis ullam unde quam. Cumque doloremque cupiditate corporis ratione porro pariatur animi quisquam quis error quos repellat sit, repellendus, iste, distinctio nam expedita iure assumenda maxime at beatae amet maiores non sunt culpa! Non neque vitae deserunt quia omnis exercitationem voluptas natus ex accusantium voluptatum! Commodi delectus dolores veniam fugit voluptas obcaecati similique aliquid velit praesentium quaerat rerum, nam explicabo quas iste, facilis inventore voluptatem. Accusantium voluptates iste totam culpa dicta quod, cumque, sed repellendus temporibus tempora saepe? Error dolore ullam corporis a dolores aspernatur sequi, deserunt dolorem distinctio modi eligendi itaque quaerat perferendis commodi optio, temporibus deleniti culpa ad quod officiis assumenda. Perspiciatis sequi autem neque corporis impedit nisi eum exercitationem. Modi ipsa harum non eveniet blanditiis in obcaecati, cupiditate quisquam animi suscipit aliquam fugit. Assumenda libero quasi in, doloremque blanditiis beatae autem ipsa fuga fugiat soluta cum maxime praesentium nobis voluptates dignissimos officiis sed debitis maiores sapiente illum ad corporis voluptatem labore qui! Enim sunt at accusantium eius illo quo velit quam perspiciatis quasi voluptas hic error officiis doloremque dolorem distinctio in blanditiis, omnis odit repellendus reprehenderit. Voluptates obcaecati voluptatibus, aliquid deserunt ducimus consectetur illo aspernatur id. Ullam aliquam nisi maxime perspiciatis voluptate corporis tempora omnis rerum tenetur quos suscipit inventore, laborum, pariatur rem modi corrupti placeat consequuntur ad. Veritatis delectus, officiis laudantium quo ad eum quae? Temporibus labore minus libero dolores error eaque soluta quisquam. Earum, pariatur doloribus. Consequuntur voluptate temporibus dicta voluptatem culpa molestias, beatae reprehenderit reiciendis nostrum earum quos amet ea facilis dolorum maxime nam perferendis tempora assumenda? At aspernatur magnam similique, modi sequi itaque maiores perferendis aut. Repellat, fugiat.</p>\r\n<p style=\"text-align: justify;\">Quaerat rem sunt eius reiciendis? Laborum perferendis rem aut non doloremque harum, perspiciatis ducimus voluptatem natus, nostrum, distinctio ipsa sed veniam? Ducimus modi, voluptatem suscipit minima totam iure omnis iste aut corrupti, nisi ut. Porro quaerat quibusdam pariatur. At totam quidem nisi adipisci saepe repellendus veniam, est, porro explicabo, tempora hic vel recusandae magnam. Necessitatibus ullam doloremque rem! Deleniti, minus necessitatibus facere impedit cumque ratione molestiae corporis libero rem id possimus consequuntur beatae ipsa. Qui optio ratione harum tenetur ipsa dolores iusto voluptas hic quas ipsam cum dolorum quia, illo esse explicabo expedita id doloribus? Nemo aspernatur repellendus, vitae facilis natus optio! Possimus sit animi dignissimos quaerat est nemo modi, voluptas eligendi cumque deserunt, quod laboriosam dolorem nihil mollitia eveniet inventore rerum tenetur minus dolorum nobis, quae eaque. Qui officiis nam necessitatibus sint aut neque dolores voluptate nulla eveniet porro dolorem cumque error in cupiditate, corrupti ipsam explicabo id placeat ipsa hic excepturi? Officia repudiandae quis laboriosam quo eius at sit et tenetur blanditiis, autem animi labore omnis corporis commodi maiores ea dolorum possimus ab numquam itaque? Similique animi non in a tenetur ut temporibus nobis, dicta molestiae sunt cum perspiciatis praesentium iste optio ad suscipit, vitae tempore dolores quae ipsam dolore odio asperiores! Asperiores esse illum unde odio consectetur, ducimus dolor? Facilis repellat expedita nihil illo esse ipsa nemo aspernatur pariatur qui dignissimos, officiis, sunt vel maxime ullam consequuntur in doloremque non eaque hic quae sed quod temporibus vero. Beatae, unde corrupti maxime sequi illo quo velit pariatur architecto animi. Totam sed quis odit illum ut, enim magni tempora reprehenderit velit beatae ab quidem pariatur quo id error dicta? Laboriosam recusandae sequi suscipit quis? Iusto excepturi, nesciunt delectus nobis molestiae mollitia assumenda fugit officia rem nihil hic eos eius tempore odit velit. Deserunt distinctio vitae voluptatibus laudantium cum non fugiat nesciunt quos sunt magni blanditiis dolorem dolorum repellendus facilis aliquid, ad eligendi, omnis veniam atque nisi? Debitis laboriosam, perferendis quas ea, corporis dignissimos sint provident totam in odio mollitia quae pariatur! Asperiores expedita, et dicta vitae nisi commodi obcaecati consequatur inventore sed iste porro error omnis quam veniam dolorem delectus! Repudiandae officia beatae aut porro sed aliquam ea! Asperiores voluptatum cupiditate cumque quis, voluptatem fuga velit quisquam totam minima eos et exercitationem doloribus dolorum autem illo porro atque magni quasi tempore rem! Alias laboriosam ipsum est reiciendis possimus quaerat rerum laudantium sint asperiores facere, molestiae fugiat quo pariatur veniam distinctio repudiandae temporibus eius? Laboriosam maxime, vel obcaecati iste, est blanditiis debitis, enim neque officia harum a. Odit vero facilis exercitationem rerum, nam est blanditiis? Beatae deserunt non dolores at magni velit nisi aliquid porro mollitia amet.</p>\r\n<p style=\"text-align: justify;\">Aut maxime distinctio aliquid vel sequi quisquam nemo amet doloribus aliquam animi incidunt exercitationem vero unde soluta corrupti impedit quam inventore nihil, dolores omnis commodi ad odio sapiente. Atque iste sapiente perferendis? Maiores saepe officia placeat odio earum ratione doloribus molestiae provident delectus amet. Dolore vitae odit sed deserunt numquam, soluta veritatis velit, saepe ex deleniti quasi? Exercitationem, consectetur provident? Vitae totam, animi in, nesciunt mollitia incidunt reiciendis molestiae ipsam voluptatem esse iusto dignissimos possimus maxime quidem asperiores ipsum distinctio pariatur quia aliquam expedita. Animi reprehenderit perferendis corrupti libero doloribus sequi harum exercitationem.</p>', '2019-09-24 11:49:56', '2019-09-25 04:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `material_brands`
--

CREATE TABLE `material_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_type_id` int(11) DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `brand_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_brands`
--

INSERT INTO `material_brands` (`id`, `material_id`, `material_type_id`, `brand_name`, `amount`, `brand_description`, `created_at`, `updated_at`) VALUES
(2, 3, NULL, 'Door1', 400, 'ksjdskjdskjd', '2019-07-18 05:34:37', NULL),
(4, 1, 1, 'All Branded Cements', 700, 'All branded opc cements', '2019-09-18 15:18:16', NULL),
(5, 1, 1, 'All non branded Cements', 850, 'All non branded', '2019-09-18 15:19:07', NULL),
(6, 1, 2, 'All Branded PPc cements', 1000, 'all branded PPC cements', '2019-09-18 15:20:06', NULL),
(7, 1, 2, 'All non Branded PPC cements', 900, 'All non branded PPc cements', '2019-09-18 15:20:43', NULL),
(8, 2, 4, 'Branded', 25, 'all branded tiles', '2019-09-18 15:21:34', NULL),
(9, 2, 4, 'Non Branded', 20, 'all non Branded', '2019-09-18 15:22:26', NULL),
(10, 2, 5, 'Branded', 25, 'all branded', '2019-09-18 15:23:10', NULL),
(11, 2, 5, 'Non Branded', 20, 'all non branded', '2019-09-18 15:23:33', NULL),
(12, 2, 6, 'Non Branded', 30, 'all non branded', '2019-09-18 15:24:17', NULL),
(13, 2, 8, 'Branded', 500, 'all branded', '2019-09-18 15:26:33', NULL),
(14, 2, 8, 'Non Branded', 300, 'all non branded', '2019-09-18 15:26:59', NULL),
(15, 2, 9, 'Branded', 300, 'all branded', '2019-09-18 15:27:47', NULL),
(16, 2, 9, 'Non Branded', 200, 'All Non branded', '2019-09-18 15:28:44', NULL),
(17, 2, 24, 'Branded', 50, 'All branded', '2019-09-18 15:29:31', NULL),
(18, 2, 24, 'Non Branded', 30, 'all non branded', '2019-09-18 15:30:08', NULL),
(19, 3, 10, 'No Brand needed', 15, 'not required', '2019-09-18 15:34:25', NULL),
(20, 3, 11, 'No brand needed', 20, 'no brand required', '2019-09-18 15:35:11', NULL),
(21, 3, 12, 'No brand needed', 60, 'no brand required', '2019-09-18 15:35:46', NULL),
(22, 3, 13, 'No Brand needed', 80, 'no brand required', '2019-09-18 15:36:33', NULL),
(23, 4, 14, 'Branded', 90, 'all branded rebar', '2019-09-18 16:15:25', NULL),
(24, 4, 14, 'Non Branded', 80, 'all non Branded', '2019-09-18 16:16:01', NULL),
(25, 4, 15, 'Branded', 1500, 'All branded', '2019-09-18 16:16:56', NULL),
(26, 4, 15, 'Non Branded', 1200, 'all non branded', '2019-09-18 16:17:22', NULL),
(27, 5, 16, 'No Brand needed', 5500, 'no brand required', '2019-09-18 16:19:52', NULL),
(28, 5, 17, 'Branded', 120, 'all branded', '2019-09-18 16:20:21', NULL),
(29, 5, 17, 'non branded', 80, 'non branded', '2019-09-18 16:21:03', NULL),
(30, 6, 18, 'no brand needed', 100, 'no brand', '2019-09-18 16:21:36', NULL),
(31, 6, 19, 'no brand needed', 80, 'no brand needed', '2019-09-18 16:23:13', NULL),
(32, 6, 20, 'no brand needed', 120, 'no brand needed', '2019-09-18 16:23:42', NULL),
(33, 7, 21, 'branded', 1200, 'all branded', '2019-09-18 16:24:47', NULL),
(34, 7, 21, 'Non branded', 800, 'non branded', '2019-09-18 16:25:17', NULL),
(35, 7, 22, 'Branded', 1000, 'all branded', '2019-09-18 16:26:00', NULL),
(36, 7, 23, 'no brand needed', 500, 'no brand needed', '2019-09-18 16:26:51', NULL),
(37, 8, 25, 'Standard Quality', 800, 'Based on quality', '2019-09-18 16:28:05', NULL),
(38, 8, 25, 'Cheap quality', 600, 'cheap quality', '2019-09-18 16:29:00', NULL),
(39, 8, 26, 'Standard quality', 800, 'standard quality', '2019-09-18 16:29:51', NULL),
(40, 8, 26, 'Cheap quality', 600, 'cheap quality', '2019-09-18 16:30:43', NULL),
(41, 8, 27, 'Standard Quality', 800, 'All standard quality', '2019-09-18 16:31:53', NULL),
(42, 8, 27, 'Cheap Quality', 500, 'all cheap quality', '2019-09-18 16:32:37', NULL),
(43, 8, 28, 'Standard quality', 800, 'All standard quality', '2019-09-18 16:33:32', NULL),
(44, 8, 28, 'Cheap quality', 600, 'All cheap quality', '2019-09-18 16:34:19', NULL),
(45, 9, 29, 'Indian', 60, 'per sqft', '2019-09-18 16:35:27', NULL),
(46, 9, 29, 'Chinese', 50, 'per sqft', '2019-09-18 16:35:54', NULL),
(47, 9, 30, 'Indian', 90, 'per sqft', '2019-09-18 16:36:26', NULL),
(48, 9, 30, 'Chinese', 75, 'per sqft', '2019-09-18 16:36:59', NULL),
(49, 9, 31, 'Indian', 150, 'per sqft', '2019-09-18 16:37:22', NULL),
(50, 9, 31, 'Chinese', 120, 'per sqft', '2019-09-18 16:37:47', NULL),
(51, 9, 32, 'No brand needed', 300, 'per sqft', '2019-09-18 16:38:28', NULL),
(52, 3, NULL, 'Door1', 400, 'ksjdskjdskjd', '2019-09-22 11:56:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_items`
--

CREATE TABLE `material_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_items`
--

INSERT INTO `material_items` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cement', 'Vendor provides all kinds of cement', NULL, NULL),
(2, 'Tiles and Marble', 'Vendor provide all kinds of tiles and marbles', NULL, NULL),
(3, 'Bricks and Blocks', 'Vendor provides all kind of bricks and blocks', NULL, NULL),
(4, 'Steels and Iron', 'vendor provides all steel and iron products', NULL, NULL),
(5, 'Timber and Plywood', 'Vendor provides timbers and plywood', NULL, NULL),
(6, 'Sand and Aggregates', 'Vendor provides all kinds of sand and aggregates', NULL, NULL),
(7, 'Paint and Chemicals', 'Vendor provides all kinds of paints and chemicals', NULL, NULL),
(8, 'UPVC and Aluminium fabrication', 'Vendor provides all kinds of upvc and aluminuim products', NULL, NULL),
(9, 'Glass and glazing', 'All kinds of glazing works', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_types`
--

CREATE TABLE `material_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_types`
--

INSERT INTO `material_types` (`id`, `material_id`, `material_type_name`, `type_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'OPC', 'This opc cement.', NULL, NULL),
(2, 1, 'PPC', 'This is ppc cement.', NULL, NULL),
(4, 2, 'Floor Tiles', 'This types of tiles are used  in floor.', NULL, NULL),
(5, 2, 'Wall Tiles', 'This type of tiles are used in wall.', NULL, NULL),
(6, 2, 'Concrete Tiles', 'This types of tiles are used in outdoors and parking areas.', NULL, NULL),
(8, 2, 'Granites', 'Granites of all varities', NULL, NULL),
(9, 2, 'Marbles', 'Marbles of all varities', NULL, NULL),
(10, 3, 'Clay Fired Bricks', 'Clay bricks from brick chimney', NULL, NULL),
(11, 3, 'Chinese Bricks', 'Smooth shape brick used for exterior display and decoration', NULL, NULL),
(12, 3, 'Concrete Hollow Blocks', 'Used as clay brick alternative', NULL, NULL),
(13, 3, 'AAC block', 'Used as alternative of  clay bricks', NULL, NULL),
(14, 4, 'Rebar', 'used in structural section of all construction', NULL, NULL),
(15, 4, 'Iron Pipes and Sheets', 'Used in multiple work of construction', NULL, NULL),
(16, 5, 'Timber', 'All kinds of woods and timbers', NULL, NULL),
(17, 5, 'Plywood', 'all kinds of plywood', NULL, NULL),
(18, 6, 'Fine Sand', 'fine sand', NULL, NULL),
(19, 6, 'coarse sand', 'coarse sand', NULL, NULL),
(20, 6, 'Crushed stones', 'crushed stone', NULL, NULL),
(21, 7, 'Interior paints', 'Paints used in interior surface of a building', NULL, NULL),
(22, 7, 'Exterior Paints', 'Paints Used in exterior surface of wall', NULL, NULL),
(23, 7, 'Chemicals', 'water profing and construction chemicals', NULL, NULL),
(24, 2, 'Terracota tiles', 'Decorative tiles', NULL, NULL),
(25, 8, 'UPVC doors and Window', 'Upvc door and window', NULL, NULL),
(26, 8, 'Upvc Partition', 'upvc partition', NULL, NULL),
(27, 8, 'Aluminium Door and Windows', 'Aluminium Door and Windows', NULL, NULL),
(28, 8, 'Aluminium Partition', 'Aluminium Partition', NULL, NULL),
(29, 9, 'Plain Glass', 'Plain Glass', NULL, NULL),
(30, 9, 'Reflective Glass', 'Reflective Glass', NULL, NULL),
(31, 9, 'Decorative glass', 'Decorative glass', NULL, NULL),
(32, 9, 'Toughened glass', 'Toughened glass', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `menu_parent_id` int(11) NOT NULL DEFAULT 0,
  `menu_name` varchar(100) NOT NULL,
  `menu_url` varchar(200) NOT NULL,
  `menu_icon` varchar(50) DEFAULT NULL,
  `menu_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_parent_id`, `menu_name`, `menu_url`, `menu_icon`, `menu_order`) VALUES
(1, 0, 'Dashboard', '/admin', 'fa fa-dashboard', 1),
(2, 0, 'Materials', '#', 'fa fa-building', 2),
(3, 0, 'Services', '#', 'fa fa-compass', 3),
(4, 0, 'Client', '#', 'fa fa-user', 4),
(5, 0, 'Service Provider', '#', 'fa fa-user', 5),
(6, 0, 'Bidding', '#', 'fa fa-user', 6),
(7, 0, 'Client Tickets', '#', 'fa fa-ticket', 7),
(8, 0, 'Vendor Tickets', '#', 'fa fa-ticket', 8),
(9, 0, 'User Management', '#', 'fa fa-user', 9),
(10, 2, 'Add Materials', 'admin/material', NULL, 1),
(11, 2, 'Add Material Type', 'admin/material-type', NULL, 2),
(12, 2, 'Add Brand', 'admin/material-brand', NULL, 3),
(13, 3, 'Add Service Types', 'admin/service-type', NULL, 1),
(14, 3, 'Add Service', 'admin/services', NULL, 2),
(15, 9, 'Users', 'admin/users', NULL, 1),
(16, 9, 'Users Permission', 'admin/user-roles', NULL, 2),
(17, 7, 'Open Tickets', 'admin/client-ticket/open', NULL, 3),
(18, 7, 'Processing Tickets', 'admin/client-ticket/processing', NULL, 4),
(19, 7, 'Closed Tickets', 'admin/client-ticket/closed', NULL, 5),
(20, 8, 'Open Tickets', 'admin/serviceprovider-ticket/open', NULL, 3),
(21, 8, 'Processing Tickets', 'admin/serviceprovider-ticket/processing', NULL, 4),
(22, 8, 'Closed Tickets', 'admin/serviceprovider-ticket/closed', NULL, 5),
(23, 6, 'In Process Posts', 'admin/client-post/proccessfor-bidding', NULL, 1),
(24, 6, 'Completed Bid Posts', 'admin/client-post/completed-bids', NULL, 2),
(25, 4, 'Users', 'admin/client-users', NULL, 1),
(26, 4, 'User Post', 'admin/client-post', NULL, 2),
(27, 5, 'User Request', 'admin/serviceprovider-user/request', NULL, 3),
(28, 5, 'Authorized Users', 'admin/serviceprovider-user', NULL, 4),
(29, 0, 'Escrow System', '#', 'fa fa-gear', 10),
(30, 29, 'Request Load Amount', 'admin/client-post/request-load-amount', NULL, 1),
(31, 29, 'Balance Release', 'admin/client-post/approved-amount-loaded', NULL, 2),
(32, 29, 'Conflict Resolution', 'admin/client-post/no-response-payment', NULL, 3),
(33, 5, 'Comany Class', 'admin/company-class', NULL, 1),
(34, 0, 'Frontend', '#', 'fa fa-file', 11),
(35, 34, 'Aboutus Page', 'admin/aboutus', NULL, 1),
(36, 34, 'Privacy & Policy Page', 'admin/privacy-policy', NULL, 2),
(37, 34, 'Terms & Conditions Page', 'admin/tac', NULL, 3),
(38, 34, 'FAQ Page', 'admin/faq', NULL, 4),
(39, 34, 'ContactUs Request', 'admin/contactus', NULL, 5),
(40, 34, 'Brand Logo Page', 'admin/brand-logo', NULL, 6),
(41, 0, 'Report', '#', 'fa fa-bar-chart', 12),
(42, 41, 'Client Report', 'admin/client-report', NULL, 1),
(43, 41, 'Service Provider Report', 'admin/serviceprovider-report', NULL, 2),
(44, 34, 'Quote Request', 'admin/request-quote', NULL, 7),
(45, 34, 'Image Slider', 'admin/image-slider', NULL, 8),
(46, 7, 'Ticket Category Setup', 'admin/client-ticket/category', NULL, 1),
(47, 7, 'Ticket Title Setup', 'admin/client-ticket/title', NULL, 2),
(48, 8, 'Ticket Category Setup', 'admin/serviceprovider-ticket/category', NULL, 1),
(49, 8, 'Ticket Title Setup', 'admin/serviceprovider-ticket/title', NULL, 2),
(50, 5, 'Add Badge', 'admin/badge', NULL, 2),
(51, 0, 'Error Log Activity', 'admin/error-log', 'fa fa-bug', 13);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_07_11_065420_create_admin_users_table', 1),
(8, '2019_07_11_115432_create_client_users_table', 1),
(9, '2019_07_12_054253_create_material_items_table', 1),
(10, '2019_07_12_061440_create_material_types_table', 2),
(11, '2019_07_12_073123_create_material_brands_table', 3),
(13, '2019_07_14_050606_create_add_services_table', 4),
(15, '2019_07_14_075212_create_service_types_table', 5),
(16, '2019_07_24_051640_create_notifications_table', 6),
(17, '2019_07_30_115344_create_ticket_categories_table', 7),
(20, '2019_07_30_121849_create_client_tickets_table', 8),
(21, '2019_07_30_122309_create_service_provider_tickets_table', 8),
(23, '2019_08_05_120044_create_service_provider_profile_table', 9),
(24, '2019_08_05_155315_add_profile_progress_column_to_service_provider_users_table', 10),
(25, '2019_08_14_114101_add_structural_service_fields_to_client_post_services_table', 10),
(26, '2019_08_19_103850_create_uploads_table', 11),
(27, '2019_08_19_103856_create_upload_groups_table', 11),
(28, '2019_08_19_110509_add_file_id_column_to_client_post_table', 11),
(29, '2019_11_11_170302_create_batches_table', 12),
(30, '2019_11_12_104632_add_batch_column_to_service_provider_users_table', 12),
(31, '2019_11_13_103603_create_dblog_table', 12),
(32, '2019_11_13_111003_add_line_number_to_dblog_table', 12),
(33, '2019_11_20_131931_create_client_ticket_category_table', 13),
(34, '2019_11_20_132235_create_serviceprovider_ticket_category_table', 13),
(35, '2019_11_20_132446_create_client_ticket_title_table', 13),
(36, '2019_11_20_132456_create_serviceprovider_ticket_title_table', 13),
(37, '2019_11_20_210045_add_icon_column_to_batches_table', 13),
(38, '2019_11_22_105554_create_months_table', 14),
(39, '2019_11_26_112033_create_vendor_category_table', 14),
(40, '2019_11_26_124329_create_client_users_table', 14),
(41, '2019_11_26_132525_create_requested_for_quotes_table', 14),
(42, '2019_11_27_145744_create_frontend_imagesliders_table', 14),
(43, '2019_12_18_113630_add_replied_message_column_to_contact_us_form', 15),
(44, '2019_12_18_135654_add_replied_message_column_to_requested_for_quotes', 15);

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `name`, `month_num`, `created_at`, `updated_at`) VALUES
(1, 'January', '01', NULL, NULL),
(2, 'February', '02', NULL, NULL),
(3, 'March', '03', NULL, NULL),
(4, 'April', '04', NULL, NULL),
(5, 'May', '05', NULL, NULL),
(6, 'June', '06', NULL, NULL),
(7, 'July', '07', NULL, NULL),
(8, 'August', '08', NULL, NULL),
(9, 'September', '09', NULL, NULL),
(10, 'October', '10', NULL, NULL),
(11, 'November', '11', NULL, NULL),
(12, 'December', '12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requested_for_quotes`
--

CREATE TABLE `requested_for_quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `replied_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requested_for_quotes`
--

INSERT INTO `requested_for_quotes` (`id`, `product_name`, `user_name`, `mobile`, `email_address`, `description`, `status`, `created_at`, `updated_at`, `replied_message`) VALUES
(1, 'BRICKS', 'BINOD', '9851203275', 'TOUCHBINOD@GMAIL.COM', 'I NEED ONE LAKH RED CLAY FIRED BRICKS IN KATHMANDU', 'APPROVED', '2019-12-31 00:52:44', '2019-12-31 00:57:48', 'WE LL CONTACT YOU SHORTLY\r\nTHANKYOU');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_bid_post`
--

CREATE TABLE `serviceprovider_bid_post` (
  `bid_id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `bid_amount` int(7) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0->pending,1->processing, 2->win_expired, 3->bid_win, 4->bid_completed',
  `comment_on_bid` longtext DEFAULT NULL,
  `min_bider` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprovider_bid_post`
--

INSERT INTO `serviceprovider_bid_post` (`bid_id`, `service_provider_id`, `post_id`, `bid_amount`, `status`, `comment_on_bid`, `min_bider`, `created_at`, `updated_at`) VALUES
(371, 5, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(372, 14, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(373, 22, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(374, 23, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(375, 30, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(376, 31, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(377, 32, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(378, 33, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(379, 36, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(380, 37, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(381, 38, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(382, 40, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(383, 41, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(384, 42, 70, 0, 2, NULL, 0, '2019-12-31 08:30:57', '2020-01-07 08:31:02'),
(385, 1, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(386, 6, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(387, 13, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(388, 14, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(389, 15, 71, 10000, 4, 'sdf dsfsdfdsfs', 0, '2020-01-01 04:29:00', '2020-01-01 04:29:51'),
(390, 16, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(391, 21, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(392, 24, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(393, 25, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(394, 27, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(395, 28, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(396, 35, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(397, 39, 71, 0, 0, NULL, 0, '2020-01-01 04:29:00', '2020-01-01 04:29:00'),
(398, 5, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(399, 14, 72, 10000, 3, 'kdnaskj asdsakdasd', 0, '2020-01-01 04:31:39', '2020-01-01 04:32:54'),
(400, 22, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(401, 23, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(402, 30, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(403, 31, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(404, 32, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(405, 33, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(406, 36, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(407, 37, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(408, 38, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(409, 40, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(410, 41, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(411, 42, 72, 0, 0, NULL, 0, '2020-01-01 04:31:39', '2020-01-01 04:31:39'),
(412, 5, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(413, 14, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(414, 22, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(415, 23, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(416, 30, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(417, 31, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(418, 32, 73, 200000, 4, 'RS two lakhs for 2D civil structural and front elevation architectural design', 0, '2020-01-01 06:25:07', '2020-01-03 14:16:58'),
(419, 33, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(420, 36, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(421, 37, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(422, 38, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(423, 40, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(424, 41, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(425, 42, 73, 0, 0, NULL, 0, '2020-01-01 06:25:07', '2020-01-01 06:25:07'),
(426, 5, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(427, 14, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(428, 22, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(429, 23, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(430, 30, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(431, 31, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(432, 32, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(433, 33, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(434, 36, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(435, 37, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(436, 38, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(437, 40, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(438, 41, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(439, 42, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(440, 43, 74, 0, 2, NULL, 0, '2020-01-06 15:38:20', '2020-01-09 15:37:02'),
(441, 5, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(442, 14, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(443, 22, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(444, 23, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(445, 30, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(446, 31, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(447, 32, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(448, 33, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(449, 36, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(450, 37, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(451, 38, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(452, 40, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(453, 41, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(454, 42, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(455, 43, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(456, 44, 76, 0, 2, NULL, 0, '2020-02-13 11:31:37', '2020-02-27 11:30:03'),
(457, 5, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(458, 14, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(459, 22, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(460, 23, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(461, 30, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(462, 31, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(463, 32, 77, 200000, 2, 'we can finish in 200k package on structural design', 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(464, 33, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(465, 36, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(466, 37, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(467, 38, 77, 1000, 2, 'ok', 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(468, 40, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(469, 41, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(470, 42, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(471, 43, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(472, 44, 77, 0, 2, NULL, 0, '2020-02-13 11:40:04', '2020-06-24 11:37:02'),
(473, 5, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(474, 14, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(475, 22, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(476, 23, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(477, 30, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(478, 31, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(479, 32, 78, 99000, 2, 'thankyou', 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(480, 33, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(481, 36, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(482, 37, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(483, 38, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(484, 40, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(485, 41, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(486, 42, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(487, 43, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(488, 44, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(489, 45, 78, 0, 2, NULL, 0, '2020-02-18 07:29:59', '2020-02-23 07:30:04'),
(490, 1, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(491, 6, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(492, 13, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(493, 14, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(494, 15, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(495, 16, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(496, 21, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(497, 24, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(498, 25, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(499, 27, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(500, 28, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(501, 35, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(502, 39, 79, 0, 0, NULL, 0, '2020-03-13 07:10:59', '2020-03-13 07:10:59'),
(503, 46, 79, 1000, 4, 'Mic drop', 0, '2020-03-13 07:10:59', '2020-03-13 07:26:16'),
(504, 1, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(505, 6, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(506, 13, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(507, 14, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(508, 15, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(509, 16, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(510, 21, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(511, 24, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(512, 25, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(513, 27, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(514, 28, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(515, 35, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(516, 39, 80, 0, 0, NULL, 0, '2020-03-16 07:10:16', '2020-03-16 07:10:16'),
(517, 46, 80, 900, 3, 'I will help you', 0, '2020-03-16 07:10:16', '2020-03-16 07:24:20'),
(518, 1, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(519, 6, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(520, 13, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(521, 14, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(522, 15, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(523, 16, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(524, 21, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(525, 24, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(526, 25, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(527, 27, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(528, 28, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(529, 35, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(530, 39, 81, 0, 2, NULL, 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(531, 46, 81, 5000, 2, 'tax: 890', 0, '2020-03-16 11:21:42', '2020-03-26 11:21:01'),
(532, 5, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(533, 14, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(534, 22, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(535, 23, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(536, 30, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(537, 31, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(538, 32, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(539, 33, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(540, 36, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(541, 37, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(542, 38, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(543, 40, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(544, 41, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(545, 42, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(546, 43, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(547, 44, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(548, 45, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(549, 47, 82, 0, 2, NULL, 0, '2020-05-31 08:43:49', '2020-06-10 06:41:02'),
(550, 5, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(551, 14, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(552, 22, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(553, 23, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(554, 30, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(555, 31, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(556, 32, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(557, 33, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(558, 36, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(559, 37, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(560, 38, 83, 80000, 2, 'new bid', 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(561, 40, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(562, 41, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(563, 42, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(564, 43, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(565, 44, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(566, 45, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(567, 47, 83, 0, 2, NULL, 0, '2020-05-31 08:45:53', '2020-06-15 06:51:02'),
(568, 38, 85, 9000000, 2, 'we can do in 90 lacs', 0, '2020-06-11 13:00:22', '2020-06-26 13:00:03'),
(569, 39, 86, 900, 2, '900 per bag', 0, '2020-06-11 13:12:35', '2020-06-18 13:13:02'),
(570, 38, 87, 9000000, 2, 'ok', 0, '2020-06-21 03:41:03', '2020-06-28 03:40:03'),
(571, 39, 88, 2000, 2, 'abcdef', 0, '2020-06-24 10:26:48', '2020-07-01 10:26:02'),
(572, 5, 89, 0, 0, NULL, 0, '2020-06-25 17:00:07', '2020-06-25 17:00:07'),
(573, 14, 89, 0, 0, NULL, 0, '2020-06-25 17:00:07', '2020-06-25 17:00:07'),
(574, 32, 89, 0, 0, NULL, 0, '2020-06-25 17:00:07', '2020-06-25 17:00:07'),
(575, 33, 89, 0, 0, NULL, 0, '2020-06-25 17:00:07', '2020-06-25 17:00:07'),
(576, 38, 89, 0, 0, NULL, 0, '2020-06-25 17:00:07', '2020-06-25 17:00:07'),
(577, 43, 89, 0, 0, NULL, 0, '2020-06-25 17:00:07', '2020-06-25 17:00:07'),
(578, 38, 90, 0, 0, NULL, 0, '2020-06-30 08:52:26', '2020-06-30 08:52:26'),
(579, 38, 91, 190000, 1, 'we ll finish in 190k', 0, '2020-06-30 08:59:41', '2020-06-30 09:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_forget_password`
--

CREATE TABLE `serviceprovider_forget_password` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `_token` varchar(100) NOT NULL,
  `token_verified_at` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0->pending, 1->completed,2->expire',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprovider_forget_password`
--

INSERT INTO `serviceprovider_forget_password` (`id`, `user_id`, `email`, `_token`, `token_verified_at`, `status`, `created_at`, `updated_at`) VALUES
(2, '1', 'raju.poudel42@gmail.com', 'TCJt8kur9aYoAnG1G6IBV0wPpeYIPjeIWi9ClFnH', NULL, 2, '2019-09-30 09:48:59', '2019-09-30 10:39:39'),
(3, '1', 'raju.poudel42@gmail.com', '7b92387942d37c0c387df24ef0acf915', '2019-09-30 11:16:55', 1, '2019-09-30 10:39:39', '2019-09-30 11:16:55'),
(4, '1', 'raju.poudel42@gmail.com', '1f8a8b59ba65d9dd497bf618dbe78436', '2019-09-30 11:23:55', 1, '2019-09-30 11:23:27', '2019-09-30 11:23:55'),
(5, '15', 'raju.poudel42@gmail.com', 'e43aa0f3a5bf8cd73ede33b7aeff7c49', '2019-09-30 11:44:46', 1, '2019-09-30 11:43:00', '2019-09-30 11:44:46'),
(6, '15', 'raju.poudel42@gmail.com', '6d2b139d70085517dfeab74696cdce8b', NULL, 2, '2019-12-21 08:20:41', '2019-12-21 08:21:28'),
(7, '15', 'raju.poudel42@gmail.com', 'ce4fa1ee625003a0da3e145f388dfbd8', NULL, 2, '2019-12-21 08:21:28', '2019-12-21 08:22:13'),
(8, '15', 'raju.poudel42@gmail.com', 'ee0501e9ec983f90cd3bbc61a541e24f', '2019-12-21 19:07:52', 1, '2019-12-21 08:22:13', '2019-12-21 08:22:52'),
(9, '15', 'raju.poudel42@gmail.com', 'eb8ed495ca34efea9428b4777e663099', '2019-12-30 17:19:31', 1, '2019-12-30 06:33:45', '2019-12-30 06:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_loadamount`
--

CREATE TABLE `serviceprovider_loadamount` (
  `id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `load_amount` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprovider_loadamount`
--

INSERT INTO `serviceprovider_loadamount` (`id`, `service_provider_id`, `load_amount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 10000, 'Load Load', '2019-08-05 05:46:46', '2019-08-05 05:46:46'),
(2, 33, 10000, 'Payment', '2019-09-30 07:15:19', '2019-09-30 07:15:19'),
(3, 32, 10000, 'testbalance', '2019-11-14 09:48:21', '2019-11-14 09:48:21'),
(4, 15, 10000, 'test balance', '2019-11-14 10:23:25', '2019-11-14 10:23:25'),
(5, 39, 10000, 'test balance', '2019-11-28 12:44:21', '2019-11-28 12:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_material`
--

CREATE TABLE `serviceprovider_material` (
  `id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprovider_material`
--

INSERT INTO `serviceprovider_material` (`id`, `service_provider_id`, `material_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-07-16 04:44:26', '2019-07-20 12:35:26'),
(2, 1, 2, '2019-07-16 04:44:26', '2019-07-20 12:35:30'),
(3, 1, 3, '2019-07-16 04:44:35', '2019-07-20 12:35:34'),
(4, 14, 1, '2019-07-20 09:17:01', '2019-07-20 09:17:01'),
(5, 6, 1, '2019-07-16 04:44:26', '2019-07-20 12:35:26'),
(6, 6, 2, '2019-07-16 04:44:26', '2019-07-20 12:35:30'),
(7, 6, 3, '2019-07-16 04:44:35', '2019-07-20 12:35:34'),
(8, 14, 2, '2019-07-20 09:17:01', '2019-07-22 09:59:08'),
(9, 15, 2, '2019-08-12 06:06:57', '2019-08-12 06:06:57'),
(10, 15, 3, '2019-08-12 06:06:57', '2019-08-12 06:06:57'),
(11, 15, 4, '2019-08-12 06:06:57', '2019-08-12 06:06:57'),
(12, 16, 1, '2019-09-11 12:37:45', '2019-09-11 12:37:45'),
(13, 16, 2, '2019-09-11 12:37:45', '2019-09-11 12:37:45'),
(14, 16, 3, '2019-09-11 12:37:45', '2019-09-11 12:37:45'),
(15, 16, 4, '2019-09-11 12:37:45', '2019-09-11 12:37:45'),
(16, 18, 1, '2019-09-12 05:41:23', '2019-09-12 05:41:23'),
(17, 18, 2, '2019-09-12 05:41:23', '2019-09-12 05:41:23'),
(18, 18, 3, '2019-09-12 05:41:23', '2019-09-12 05:41:23'),
(19, 18, 4, '2019-09-12 05:41:23', '2019-09-12 05:41:23'),
(20, 19, 1, '2019-09-12 06:14:37', '2019-09-12 06:14:37'),
(21, 19, 2, '2019-09-12 06:14:37', '2019-09-12 06:14:37'),
(22, 19, 3, '2019-09-12 06:14:37', '2019-09-12 06:14:37'),
(23, 19, 4, '2019-09-12 06:14:37', '2019-09-12 06:14:37'),
(24, 20, 1, '2019-09-12 09:38:31', '2019-09-12 09:38:31'),
(25, 20, 2, '2019-09-12 09:38:31', '2019-09-12 09:38:31'),
(26, 20, 3, '2019-09-12 09:38:31', '2019-09-12 09:38:31'),
(27, 20, 4, '2019-09-12 09:38:31', '2019-09-12 09:38:31'),
(28, 21, 1, '2019-09-16 05:00:07', '2019-09-16 05:00:07'),
(29, 21, 2, '2019-09-16 05:00:07', '2019-09-16 05:00:07'),
(30, 21, 3, '2019-09-16 05:00:07', '2019-09-16 05:00:07'),
(31, 21, 4, '2019-09-16 05:00:07', '2019-09-16 05:00:07'),
(32, 24, 1, '2019-09-22 11:47:40', '2019-09-22 11:47:40'),
(33, 24, 2, '2019-09-22 11:47:40', '2019-09-22 11:47:40'),
(34, 24, 3, '2019-09-22 11:47:40', '2019-09-22 11:47:40'),
(35, 25, 1, '2019-09-22 11:49:39', '2019-09-22 11:49:39'),
(36, 26, 1, '2019-09-22 11:49:58', '2019-09-22 11:49:58'),
(37, 26, 2, '2019-09-22 11:49:58', '2019-09-22 11:49:58'),
(38, 26, 3, '2019-09-22 11:49:58', '2019-09-22 11:49:58'),
(39, 26, 4, '2019-09-22 11:49:58', '2019-09-22 11:49:58'),
(40, 26, 5, '2019-09-22 11:49:58', '2019-09-22 11:49:58'),
(41, 26, 6, '2019-09-22 11:49:58', '2019-09-22 11:49:58'),
(42, 27, 2, '2019-09-22 11:53:00', '2019-09-22 11:53:00'),
(43, 28, 1, '2019-09-22 11:56:38', '2019-09-22 11:56:38'),
(44, 34, 1, '2019-10-14 10:16:23', '2019-10-14 10:16:23'),
(45, 34, 2, '2019-10-14 10:16:23', '2019-10-14 10:16:23'),
(46, 34, 3, '2019-10-14 10:16:23', '2019-10-14 10:16:23'),
(47, 35, 1, '2019-10-14 11:18:12', '2019-10-14 11:18:12'),
(48, 35, 2, '2019-10-14 11:18:12', '2019-10-14 11:18:12'),
(49, 35, 3, '2019-10-14 11:18:12', '2019-10-14 11:18:12'),
(50, 35, 4, '2019-10-14 11:18:12', '2019-10-14 11:18:12'),
(51, 39, 2, '2019-11-21 11:14:04', '2019-11-21 11:14:04'),
(52, 39, 7, '2019-11-21 11:14:04', '2019-11-21 11:14:04'),
(53, 46, 1, '2020-03-13 06:50:48', '2020-03-13 06:50:48'),
(54, 46, 2, '2020-03-13 06:50:48', '2020-03-13 06:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_pastproject`
--

CREATE TABLE `serviceprovider_pastproject` (
  `id` int(11) NOT NULL,
  `project_detail` longtext NOT NULL,
  `project_link` varchar(50) DEFAULT NULL,
  `service_provider_id` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprovider_pastproject`
--

INSERT INTO `serviceprovider_pastproject` (`id`, `project_detail`, `project_link`, `service_provider_id`, `created_at`, `updated_at`) VALUES
(1, 'sdsdasddddddddddddddddddd', NULL, '5', '2019-09-12 05:41:23', '2019-09-12 05:41:23'),
(2, 'asfgfgfsdfsdf', NULL, '5', '2019-09-12 06:14:37', '2019-09-12 06:14:37'),
(3, 'sadasdasdasdasd', NULL, '5', '2019-09-12 06:14:37', '2019-09-12 06:14:37'),
(4, 'sdasdsdsd', 'sdsds', '5', '2019-09-16 05:00:07', '2019-09-16 05:00:07'),
(5, 'dad aw wa wad awaw dwa wa aw d', NULL, '5', '2020-03-13 06:50:48', '2020-03-13 06:50:48'),
(6, 'daw awd awd awd awd awd aw awdwad wa wa aw', NULL, '5', '2020-03-13 06:50:48', '2020-03-13 06:50:48'),
(7, 'house', 'link.com/aa', '5', '2020-05-31 06:36:10', '2020-05-31 06:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_penalty_for_newbid`
--

CREATE TABLE `serviceprovider_penalty_for_newbid` (
  `id` int(11) NOT NULL,
  `service_provider_id` varchar(20) NOT NULL,
  `warning_attempt` int(1) NOT NULL,
  `days` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_services`
--

CREATE TABLE `serviceprovider_services` (
  `id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprovider_services`
--

INSERT INTO `serviceprovider_services` (`id`, `service_provider_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-07-20 09:14:22', '2019-07-21 04:58:45'),
(2, 13, 2, '2019-07-20 09:14:22', '2019-07-20 09:14:22'),
(3, 14, 1, '2019-07-20 09:17:01', '2019-07-20 09:17:01'),
(4, 5, 1, '2019-07-20 09:14:22', '2019-07-21 04:58:45'),
(5, 5, 2, '2019-07-20 09:14:22', '2019-07-20 09:14:22'),
(7, 13, 1, '2019-07-20 09:14:22', '2019-07-20 09:14:22'),
(8, 29, 13, '2019-09-24 06:53:54', '2019-09-24 06:53:54'),
(9, 30, 13, '2019-09-24 07:26:00', '2019-09-24 07:26:00'),
(10, 36, 13, '2019-11-11 07:02:45', '2019-11-11 07:02:45'),
(11, 40, 9, '2019-11-24 08:22:03', '2019-11-24 08:22:03'),
(12, 41, 12, '2019-11-28 12:19:28', '2019-11-28 12:19:28'),
(13, 42, 9, '2019-12-03 11:13:20', '2019-12-03 11:13:20'),
(14, 43, 3, '2020-01-06 15:27:38', '2020-01-06 15:27:38'),
(15, 43, 9, '2020-01-06 15:27:38', '2020-01-06 15:27:38'),
(16, 44, 8, '2020-02-13 10:51:10', '2020-02-13 10:51:10'),
(17, 45, 3, '2020-02-13 11:51:41', '2020-02-13 11:51:41'),
(18, 45, 9, '2020-02-13 11:51:41', '2020-02-13 11:51:41'),
(19, 47, 1, '2020-05-31 06:36:10', '2020-05-31 06:36:10'),
(20, 47, 4, '2020-05-31 06:36:10', '2020-05-31 06:36:10'),
(21, 47, 10, '2020-05-31 06:36:10', '2020-05-31 06:36:10'),
(22, 47, 13, '2020-05-31 06:36:10', '2020-05-31 06:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_ticket_category`
--

CREATE TABLE `serviceprovider_ticket_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serviceprovider_ticket_category`
--

INSERT INTO `serviceprovider_ticket_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Login', NULL, NULL),
(2, 'Escrow payment', NULL, NULL),
(3, 'Bidding', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_ticket_title`
--

CREATE TABLE `serviceprovider_ticket_title` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serviceprovider_ticket_title`
--

INSERT INTO `serviceprovider_ticket_title` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'login not working properly', '1', NULL, NULL),
(2, 'balance amount not displaying', '2', NULL, NULL),
(3, 'cannot participate in bidding', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_win_clientpost`
--

CREATE TABLE `serviceprovider_win_clientpost` (
  `winid` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0->unpaid, 1->paid, 2->expire',
  `stars` int(11) NOT NULL DEFAULT -1,
  `remarks` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expired_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviceprovider_win_clientpost`
--

INSERT INTO `serviceprovider_win_clientpost` (`winid`, `service_provider_id`, `bid_id`, `post_id`, `client_id`, `amount`, `status`, `stars`, `remarks`, `created_at`, `updated_at`, `expired_at`) VALUES
(45, 15, 389, 71, 32, 10000, 1, -1, NULL, '2020-01-01 04:29:34', '2020-01-01 04:29:51', '2020-01-04 04:59:00'),
(46, 14, 399, 72, 32, 10000, 0, -1, NULL, '2020-01-01 04:32:54', '2020-01-01 04:32:54', '2020-01-04 04:59:00'),
(47, 32, 418, 73, 31, 200000, 1, -1, NULL, '2020-01-03 14:15:37', '2020-01-03 14:16:58', '2020-01-06 04:59:00'),
(51, 46, 503, 79, 41, 1000, 1, 5, NULL, '2020-03-13 07:23:32', '2020-03-13 07:28:15', '2020-03-16 03:59:00'),
(52, 46, 517, 80, 41, 900, 0, -1, NULL, '2020-03-16 07:24:20', '2020-03-16 07:24:20', '2020-03-19 03:59:00'),
(53, 46, 517, 80, 41, 900, 0, -1, NULL, '2020-03-16 07:24:54', '2020-03-16 07:24:54', '2020-03-19 03:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_profile`
--

CREATE TABLE `service_provider_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_provider_profile`
--

INSERT INTO `service_provider_profile` (`id`, `service_provider_id`, `type`, `name`, `number`, `created_at`, `updated_at`) VALUES
(20, 32, 'staff', 'Senior Engineers', 5, '2019-11-14 20:37:15', '2019-11-14 20:37:15'),
(21, 32, 'staff', 'Junior Engineers', 4, '2019-11-14 20:37:52', '2019-11-14 20:37:52'),
(22, 32, 'staff', 'Office Helper', 2, '2019-11-14 20:38:28', '2019-11-14 20:38:28'),
(23, 32, 'staff', 'Administrative staff', 2, '2019-11-14 20:38:55', '2019-11-14 20:38:55'),
(24, 32, 'vehicle', 'Jeep', 1, '2019-11-14 20:39:45', '2019-11-14 20:39:45'),
(25, 32, 'machine', 'Photocopy Machines', 2, '2019-11-14 20:40:47', '2019-11-14 20:40:47'),
(26, 32, 'machine', 'Graphicplotter', 1, '2019-11-14 20:41:02', '2019-11-14 20:41:02'),
(27, 32, 'machine', 'Theodolite', 2, '2019-11-14 20:41:24', '2019-11-14 20:41:24'),
(40, 15, 'vehicle', 'Car', 2, '2019-12-30 17:16:33', '2019-12-30 17:16:33'),
(42, 15, 'staff', 'Hr', 2, '2019-12-30 17:16:54', '2019-12-30 17:16:54'),
(43, 15, 'machine', 'Crane', 2, '2019-12-30 17:54:50', '2019-12-30 17:54:50'),
(44, 39, 'staff', 'Management team', 5, '2019-12-31 19:07:49', '2019-12-31 19:07:49'),
(45, 39, 'vehicle', 'Mini Truck', 3, '2019-12-31 19:08:07', '2019-12-31 19:08:07'),
(46, 39, 'machine', 'Forklift', 2, '2019-12-31 19:08:27', '2019-12-31 19:08:27'),
(47, 32, 'vehicle', 'staff bus', 10, '2020-01-01 00:29:59', '2020-01-01 00:29:59'),
(48, 32, 'vehicle', 'motorcycle', 5, '2020-01-01 01:20:29', '2020-01-01 01:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_tickets`
--

CREATE TABLE `service_provider_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_provider_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenshot` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_provider_tickets`
--

INSERT INTO `service_provider_tickets` (`id`, `service_provider_id`, `category_id`, `ticket_id`, `title`, `priority`, `message`, `status`, `screenshot`, `remarks`, `created_at`, `updated_at`) VALUES
(19, 46, 2, 'ESFGFTLDMZ', '2', 'medium', 'Testing support ticket', 'Open', '', NULL, '2020-03-13 07:30:57', '2020-03-13 07:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_users`
--

CREATE TABLE `service_provider_users` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `vendor_type` int(6) NOT NULL,
  `service_category` char(1) NOT NULL COMMENT 'M->materials, S->services, B-both',
  `mobile` varchar(12) NOT NULL,
  `district` varchar(5) DEFAULT '0',
  `address` varchar(100) DEFAULT NULL,
  `reg_date` date NOT NULL,
  `reg_num` varchar(40) NOT NULL,
  `company_class` char(1) DEFAULT NULL,
  `owner_type` int(1) NOT NULL,
  `owner_name` varchar(200) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  `company_phone1` varchar(12) NOT NULL,
  `company_phone2` varchar(12) DEFAULT NULL,
  `vat_no` varchar(30) NOT NULL,
  `website` varchar(30) DEFAULT NULL,
  `have_branches` int(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 2 COMMENT '0->unverified, 1->active, 2->not active, 3->rejected, 4->deactivated',
  `average_stars` decimal(10,1) NOT NULL DEFAULT 0.0,
  `total_reviews` int(10) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_progress` int(10) UNSIGNED NOT NULL DEFAULT 40,
  `badge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_provider_users`
--

INSERT INTO `service_provider_users` (`id`, `contact_name`, `company_name`, `email`, `password`, `vendor_type`, `service_category`, `mobile`, `district`, `address`, `reg_date`, `reg_num`, `company_class`, `owner_type`, `owner_name`, `company_address`, `company_email`, `company_phone1`, `company_phone2`, `vat_no`, `website`, `have_branches`, `status`, `average_stars`, `total_reviews`, `email_verified_at`, `description`, `created_at`, `updated_at`, `profile_progress`, `badge`) VALUES
(1, 'Hari Adhikari', 'xyz company', 'raju.poudel41@gmail.com', '$2y$10$AFB0tHDf2jy63KiQe.rBO.Bolh5VCatN56VV/ZV13rrlHj5aicpPe', 1, 'M', '9812121211', '2', 'Kathmandu, Baneshwor-8', '0000-00-00', '0', NULL, 0, '', '', '', '0', NULL, '0', NULL, 0, 1, 0.0, 0, NULL, 'Nothing to say', '2019-07-15 11:23:43', '2019-12-14 04:38:06', 40, 5),
(5, 'Shyam Bhandari', 'xss distributor', 'shyam@bhandari.com', '$2y$10$JZIkIuH8U.lTO8NddimOFOQnS6pryeiIkOFUR6EZHVX5LnyA80E9S', 3, 'S', '9812121212', '2', NULL, '0000-00-00', '0', NULL, 0, '', '', '', '0', NULL, '0', NULL, 0, 1, 0.0, 0, NULL, NULL, '2019-07-16 06:59:47', '2019-12-03 06:10:17', 40, 1),
(6, 'Admin Adhikari', 'xyz company', 'admin@admin.com', '$2y$10$ZU1ffry3JjgXh14mZ5P/4eaFof14e/0DXWznIBzB/WP584Rhqk0LW', 1, 'M', '9812121212', '2', NULL, '0000-00-00', '0', NULL, 0, '', '', '', '0', NULL, '0', NULL, 0, 1, 0.0, 0, NULL, NULL, '2019-07-19 12:07:43', '2019-12-03 06:10:17', 40, 1),
(13, 'Lokesh Bhandari', 'ABC company', 'lokesh@gmail.com', '$2y$10$mZ3IXSDiDSCEehoBHTNaBOjSmuDYFFoUsuOVQKTJ0h4Dqb87VqrYK', 1, 'M', '9845807543', '1', NULL, '0000-00-00', '0', NULL, 0, '', '', '', '0', NULL, '0', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-07-20 09:14:22', '2019-12-03 06:10:17', 40, 1),
(14, 'Hari Admin', 'Hari Distributor', 'hari@admin.com', '$2y$10$gdjPTOERTjrpNhY.x70n6urY2TaLesAgx1BEUzuc7PFiZwwcZnrl2', 3, 'B', '9834323232', '1', NULL, '0000-00-00', '0', NULL, 0, '', '', '', '0', NULL, '0', NULL, 0, 1, 0.0, 0, NULL, NULL, '2019-07-20 09:17:01', '2019-12-03 06:10:17', 40, 1),
(15, 'John Wrick', 'XYZ Company', 'raju.poudel42@gmail.com', '$2y$10$6oRLDtrxyH7oEpngUwFsne0gnvhwh4S/MX7hhhnklhZ/E2By9NyIe', 3, 'M', '9845323232', '1', 'Kathmandu, Baneshwor-8', '0000-00-00', '0', NULL, 0, '', '', '', '0', NULL, '0', NULL, 0, 1, 4.0, 3, NULL, NULL, '2019-08-12 06:06:57', '2020-02-18 11:41:58', 100, 0),
(16, 'Lokesh Bhandari', '2012-08-10', 'raju.poudel45@gmail.com', '$2y$10$q5no6B1DnnckcW7dg4ttVeOEoE9TVapnskKpjXQV66KhY62HgNNTC', 2, 'M', '9875432239', '0', NULL, '0000-00-00', '0', NULL, 0, '', '', '', '0', NULL, '0', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-09-11 12:37:45', '2019-12-03 06:10:17', 40, 1),
(21, 'Shreekhanda Parajuli', 'Hari Distributor', 'meshreekhanda@gmail.com', '$2y$10$UpkdjDs/G0ZDUkG7N7CsnO0KfRCGPsHIncpdnRYqNUR2j3lrowjDS', 2, 'M', '9845807543', '1', 'Kathmandu-12, Anamnagar', '2019-09-02', '765432', 'A', 1, 'shreekhanda parajuli', 'sddasdas', 'asdasd@aadadsd', '9876543654', '9876543654', '65432', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-09-16 05:00:07', '2019-12-03 06:10:17', 40, 1),
(22, 'Binod', 'Starwood Architect', 'binod1@mailinator.com', '$2y$10$HiGCZpK6rEbQ8kHNMZHm2OyLrg1c.1VrPx/fZB6G2CUODpBk3soxa', 4, 'S', '9849603275', '2', 'bhaktapur', '2000-01-01', '12354', 'A', 1, 'Binod', 'Bhaktapur', 'starwoods@mailinator.com', '9849603275', NULL, '6557894', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-09-21 05:39:19', '2019-12-03 06:10:17', 40, 1),
(23, 'sawrwa', 'dasdawd', 'admin1@admin.com', '$2y$10$fdetxLReXo.JMBcg8XWZnuajx0Wj4GQvW4ipOOLN6ozCLh7W1zDQ2', 2, 'S', '9849808471', '2', 'Mahalaxmisthan, Lalitpur', '2019-09-12', '123', 'A', 1, 'adawd', 'Bhaktapur', 'sarox@softmahal.com', '121212', '12121212', '1212', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-09-22 11:46:44', '2019-12-03 06:10:17', 40, 1),
(24, 'Binod shjdbsh', 'ABC company', 'binod@mailinator.com', '$2y$10$R3iCkPbOVg2WuXXhn44VYOn/.dntsh6ihWys9bDzSaOBg5ZN5XNKa', 1, 'M', '9876543211', '1', 'Kathmandu-12, Anamnagar', '2019-09-16', '8765432', 'A', 1, 'Binod', 'Kathmandu-12, Nepal', 'raju.poudel42@gmail.com', '9845807543', '9845807543', '5432111', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-09-22 11:47:40', '2019-12-03 06:10:17', 40, 1),
(25, 'Saroj Poudel', 'SoftMahal Technologies Pvt. Ltd.', 'sarox14@gmail.com', '$2y$10$LCjjCrD87WWBnRORWa5oa.UIBe.axpbxeb7VCxS2i43ccSpZjc1QO', 1, 'M', '9849808471', '1', 'Mahalaxmisthan, Lalitpur', '2019-03-13', '834347', 'A', 1, 'Saroj Poudel', 'Mid Baneshwor, Lalitpur', 'saroj@softmahal.com', '9849808471', '98498084871', '12', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-09-22 11:49:39', '2020-02-18 11:01:23', 40, 6),
(27, 'adawd', 'SoftMahal Technologies Pvt. Ltd.', '3dol5@web-inc.net', '$2y$10$tV/pNCZu/ckHaVS1QqRYmesIAx8PRrbZgnuIgF6/6f.D.6/GzvmyW', 1, 'M', '9849808471', '1', 'Mahalaxmisthn, Lalitpur', '2019-09-01', '123', 'A', 1, 'Saroj Poudel', 'Kathmandu', '3dol5@web-inc.net', '9849808471', '9849808471', '123', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-09-22 11:53:00', '2019-12-03 06:10:17', 40, 1),
(28, 'Saroj', 'awdawdawd', 'saroj@mailinator.com', '$2y$10$ag5VY3LCRIaeN./S1Ssj4OVxDie6YfCDzULRzvKL058wLiomWKrCC', 2, 'M', '9849808471', '2', 'Mahalaxmisthan, Patan, Nepal', '2019-09-01', '12121212', 'A', 1, 'awda', 'Bhaktapur', 'saroj@mailinator.com', '9849808471', '9849808471', '8324', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-09-22 11:56:38', '2019-12-03 06:10:17', 40, 1),
(30, 'Abc Company', 'Abc Company', 'raju@softmahal.com', '$2y$10$1GiyhelubeAIXWMKuq.mquCYCKyRwFnbshOj4Ig/BPH3eo8wY.8CG', 1, 'S', '9845807543', '1', NULL, '2019-08-27', '7654322', '1', 1, 'fssasdas', 'sddasdas', 'raju@softmahal.com', '9876543333', '9876543333', '65432', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-09-24 07:26:00', '2020-05-31 06:29:22', 40, 6),
(31, 'StarWoods Architects Pvt.Ltd', 'StarWoods Architects Pvt.Ltd', 'starwoodsfurniture@gmail.com', '$2y$10$x/kr8wgo5JZhQOzzEuWLZe6M/iZNqw7155F0AG.Fq7ucO1K4Mo1V6', 2, 'S', '98496032375', '3', NULL, '2000-05-05', '-2', '2', 1, 'Myself', 'Jawalakhel', 'starwoodsfurniture@gmail.com', '9849603275', '4569874560', '60357598', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-09-26 13:28:41', '2019-12-03 06:10:17', 40, 1),
(32, 'StarWoods Architect Pvt.Ltd', 'StarWoods Architect Pvt.Ltd', 'furniturestarwoods@gmail.com', '$2y$10$9K7d7cA9GSULfRNi0sCXfu/WoGsn49LzRBiF9G3ChL59W9YhSIMFe', 2, 'S', '9849603275', '3', NULL, '2000-01-01', '56849775', '4', 1, 'Myself', 'jawalakhel', 'furniturestarwoods@gmail.com', '9849603275', '5648798', '654687995', NULL, 0, 1, 2.0, 2, '2019-09-26 23:55:01', NULL, '2019-09-26 14:07:18', '2019-12-31 14:34:13', 76, 4),
(33, 'ABC', 'ABC', 'aashish1@softmahal.com', '$2y$10$ITJznUQVzJ6IG/TLkqSkx.9JnpGhH.HiBKy8MoOHQqZ9XGj.ckH8q', 1, 'S', '9851033008', '1', NULL, '2019-01-02', '123456787', '1', 1, 'Aashish Hamal', 'Kathmandu', 'aashish@softmahal.com', '11234567', '14567897', '123456789', NULL, 0, 1, 0.0, 0, '2019-09-30 16:56:07', NULL, '2019-09-30 07:05:42', '2019-12-03 06:10:17', 40, 1),
(35, 'Abc Company', 'Abc Company', 'raju@saipal.org', '$2y$10$X2q4d5Y5woo.49dC4K2nYOzK1M/UwmjYrUntJQ5QegGg9He9.UyvK', 10001, 'M', '9845807543', '1', NULL, '2019-10-07', '87654322', '1', 1, 'ssdsadsa', 'sddasdas', 'raju@saipal.org', '98765436', '98765433', '65433333', NULL, 0, 1, 0.0, 0, '2019-10-14 21:25:14', NULL, '2019-10-14 11:18:12', '2019-12-03 06:10:17', 40, 1),
(36, 'Shyam Bhandari', 'Shyam Bhandari', 'sas@asa.com', '$2y$10$u1reKI7O81ZHOG2BRL2Wvec736VCAJCmYTsCj27pr/k2RLowd7fDO', 1, 'S', '9845807543', '1', NULL, '2019-11-06', '544535', '7', 1, 'erewre', 'sddasdas', 'sas@asa.com', '9845807543', '9845807543', '34343434', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-11-11 07:02:45', '2019-12-03 06:10:17', 40, 1),
(37, 'starwoods contractor', 'starwoods contractor', 'starcontractor@mailinator.com', '$2y$10$45.aNHJpEhQcAE/WH/X0pOgzGzzSSqDtx5tpkILbKXfVePo2OkdxS', 1, 'S', '9851203275', '1', NULL, '2000-01-01', '9875464', '7', 2, 'ram,shyam,sita,gita', 'jorpati', 'starcontractor@mailinator.com', '15549151', '9851203275', '60376406645879', NULL, 0, 0, 0.0, 0, NULL, NULL, '2019-11-17 14:06:32', '2019-12-03 06:10:17', 40, 1),
(38, 'Kathmandu Engineering consultant', 'Kathmandu Engineering consultant', 'emailpost549@gmail.com', '$2y$10$OEn3UfwYgDdby/kIIkxCiu4jMfh7iB86YrYAV/jc9no/VIkl0NiFq', 2, 'S', '9849603275', '1', NULL, '2008-02-05', '125789369', '7', 1, 'Binod', 'newbaneswor', 'emailpost549@gmail.com', '15549151', '9849603275', '658974123', NULL, 0, 1, 0.0, 0, '2019-11-19 22:23:12', NULL, '2019-11-19 11:35:26', '2020-01-17 13:40:41', 40, 1),
(39, 'jagadamba Enterprises', 'jagadamba Enterprises', 'cleanquail@maildrop.cc', '$2y$10$JVkYpxzKito4UVY0YqGrKOPck4CFpZpG0DyWMrg8QljfxAi5mnWmC', 10002, 'M', '9849603275', '3', NULL, '2005-01-02', '1478965', '7', 1, 'Joshi', 'Satdobato', 'cleanquail@maildrop.cc', '15549154', '9845327536', '65745896', NULL, 0, 1, 0.0, 1, '2019-11-21 22:07:21', NULL, '2019-11-21 11:14:04', '2019-12-31 08:24:08', 100, 2),
(40, 'JCB manchines', 'JCB manchines', 'SlimyFox@maildrop.cc', '$2y$10$oXixdo1dsT0FBgBamkUuqeUgA4hMhs/dkGT60MNr/6DVD.hWZ4eZq', 3, 'S', '9845612323', '2', NULL, '2001-01-01', '754896', '7', 1, 'ram', 'bhaktapur', 'SlimyFox@maildrop.cc', '15549151', '15549151', '603257845', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-11-24 08:22:03', '2019-12-11 10:22:07', 40, 1),
(41, 'ABC supply company', 'ABC supply company', 'OneMole@maildrop.cc', '$2y$10$beXSD8Wp3o/GhJDSbGPQxeI0/gIraJTEyJmMyqDvYCiGVA8xuOtS.', 4, 'S', '9849603275', '1', NULL, '2003-01-02', '632547869', '7', 1, 'binod', 'Thapathali,Kathmandu', 'OneMole@maildrop.cc', '15549151', '9851203275', '6032547896', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-11-28 12:19:28', '2019-12-11 10:21:55', 40, 1),
(42, 'ABC machines', 'ABC machines', 'LegalCod@maildrop.cc', '$2y$10$3chcbgwJwLxELHxCCzMEKeCM9gncHMAdgFCCz0b8HDyEB7YoHk0pq', 3, 'S', '9851203275', '2', NULL, '2003-01-02', '632567899', '7', 1, 'Binod', 'bhaktapur', 'LegalCod@maildrop.cc', '15549151', '9851203275', '63356789', NULL, 0, 3, 0.0, 0, NULL, NULL, '2019-12-03 11:13:20', '2019-12-11 10:22:02', 40, NULL),
(43, 'JCB manchines', 'JCB manchines', 'JuicyGoldfish@maildrop.cc', '$2y$10$XQ9rJ3cHB35KanMovbWOlepKoa/QV.kKJJN41t6rrmzVIzx7JJT4e', 3, 'S', '9851203275', '1', NULL, '2001-01-01', '2357602', '7', 1, 'Binod BK', 'Sankhamul', 'JuicyGoldfish@maildrop.cc', '9851203275', '9849603275', '6037640', NULL, 0, 1, 0.0, 0, '2020-01-07 02:16:31', NULL, '2020-01-06 15:27:38', '2020-01-06 15:33:10', 40, NULL),
(44, 'Upasarga Technology Pvt. Ltd.', 'Upasarga Technology Pvt. Ltd.', 'info@upasarga.com', '$2y$10$G5jZwsUr350AkKX3uc0Oe.4MJmfFiYXzP.dUV2xSIu9JSBnvwJNtC', 2, 'S', '9851131100', '3', NULL, '2072-01-04', '984985454', '7', 1, 'Prem Singh', 'Imadol, Imadol', 'info@upasarga.com', '9849654930', '9849654930', '603500996', NULL, 0, 0, 0.0, 0, NULL, NULL, '2020-02-13 10:51:10', '2020-02-18 10:56:16', 40, 6),
(45, 'Prem', 'Prem', 'info@xyx.com', '$2y$10$GSS1bUSMUSDjA/wcWWxXJ.X2UnQkf6QGyOiwDBDOSvpkPwYai47Ua', 3, 'S', '9849654930', '3', NULL, '2020-02-09', '21555', '2', 2, 'xcbxc', 'Imadol, Imadol', 'info@xyx.com', '9849654930', '9849654930', '15551554', NULL, 0, 3, 0.0, 0, NULL, NULL, '2020-02-13 11:51:41', '2020-02-18 10:56:26', 40, NULL),
(46, 'Manufacturer', 'Manufacturer', 'p59aeqt@upcmaill.com', '$2y$10$2XtVldFAOC6pqy7.auGK3uEeFHK2z5y2bZ.6I8riHfUUnbS0ZfRNG', 10001, 'M', '9849808471', '1', NULL, '1989-02-09', '1234567890', '2', 1, 'p59aeqt', 'KAthmandu', 'p59aeqt@upcmaill.com', '9849808471', '9849808471', '457', NULL, 0, 1, 5.0, 1, '2020-03-13 17:06:00', NULL, '2020-03-13 06:50:48', '2020-03-13 07:28:15', 40, 6),
(47, 'Subash', 'Subash', 'subash.adhikari01@gmail.com', '$2y$10$yUz4DZ9AwIwPn0Ad0WkDxOhLTE1Cq9gNYQkgG685bYToQ0sn9p.du', 1, 'S', '9840067556', '1', NULL, '2015-04-05', '12345', '1', 1, 'Subash Adhikari', 'baneshore', 'subash.adhikari01@gmail.com', '9615367310', '0142014567', '12345678', NULL, 0, 0, 0.0, 0, NULL, NULL, '2020-05-31 06:36:10', '2020-05-31 07:09:46', 40, 4);

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `service_type_name`, `type_description`, `created_at`, `updated_at`) VALUES
(1, 'Contracting', 'This service covers all aspects of project construction like civil,structural and architectural from project start to end', NULL, NULL),
(2, 'Engineering Design and Consulting', 'This service covers all aspects of engineering drawings, planning and consultation', NULL, NULL),
(3, 'Construction Tools and Machines', 'This service provides facility of selling, leasing and renting any kinds of construction machines', NULL, NULL),
(4, 'Supply and Delivery', 'This service provides buying of all building materials like,cement,sand,brick,aggregate,steel,plywood,timber etc', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `user_table` char(1) NOT NULL COMMENT 'C->client_users, S->service_provider_users',
  `title` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `user_id`, `user_table`, `title`, `type`, `url`, `read_at`, `created_at`, `updated_at`) VALUES
(1, '32', 'C', 'Your awarded bid has been approved.See more...', 'Approved Awarded Bid', 'client-post/71?post_token=pKBzkDQNhsBYQEO6mYRhGYko1LphlLoUDX7bQJxT', NULL, '2020-01-01 04:29:51', '2020-01-01 04:29:51'),
(2, '15', 'V', 'Click here to view client details', 'Paid Rewarded Bid Post', 'post/71', NULL, '2020-01-01 04:29:51', '2020-01-01 04:29:51'),
(3, '31', 'C', 'Your awarded bid has been approved.See more...', 'Approved Awarded Bid', 'client-post/73?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', NULL, '2020-01-03 14:16:58', '2020-01-03 14:16:58'),
(4, '32', 'V', 'Click here to view client details', 'Paid Rewarded Bid Post', 'post/73', '2020-01-04 01:09:15', '2020-01-03 14:16:58', '2020-01-03 14:24:15'),
(5, '32', 'V', 'Client activated escrow system for payment phase.', 'Escrow System Activated', 'post/73', '2020-01-04 01:24:31', '2020-01-03 14:22:23', '2020-01-03 14:39:31'),
(6, '31', 'C', 'Your service provider has requested payment', 'Request Phase Payment ', 'client-post/73?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', '2020-01-04 01:22:41', '2020-01-03 14:25:01', '2020-01-03 14:37:41'),
(7, '32', 'V', 'Client requested amount has been released to your account', 'Payment released', 'post/73', NULL, '2020-01-03 14:28:39', '2020-01-03 14:28:39'),
(8, '31', 'C', 'Your service provider has requested payment', 'Request Phase Payment ', 'client-post/73?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', NULL, '2020-01-03 14:29:50', '2020-01-03 14:29:50'),
(9, '32', 'V', 'Client requested amount has been released to your account', 'Payment released', 'post/73', NULL, '2020-01-03 14:32:53', '2020-01-03 14:32:53'),
(10, '31', 'C', 'Your service provider has requested payment', 'Request Phase Payment ', 'client-post/73?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', NULL, '2020-01-03 14:35:20', '2020-01-03 14:35:20'),
(11, '32', 'V', 'Client requested amount has been released to your account', 'Payment released', 'post/73', NULL, '2020-01-03 14:36:24', '2020-01-03 14:36:24'),
(12, '31', 'C', 'Your service provider has requested payment', 'Request Phase Payment ', 'client-post/73?post_token=onokJIdHZWUS7vSEndYENflr9foO7n1IjFdEUsuj', '2020-01-04 01:25:39', '2020-01-03 14:36:46', '2020-01-03 14:40:39'),
(13, '32', 'V', 'Client requested amount has been released to your account', 'Payment released', 'post/73', NULL, '2020-01-03 14:39:17', '2020-01-03 14:39:17'),
(14, '41', 'C', 'Your awarded bid has been approved.See more...', 'Approved Awarded Bid', 'client-post/79?post_token=YPaf8tWBkU2q3VMq81xEywGw0s9vMvDQDt82wVoA', '2020-03-13 17:41:33', '2020-03-13 07:26:16', '2020-03-13 07:56:33'),
(15, '46', 'V', 'Click here to view client details', 'Paid Rewarded Bid Post', 'post/79', '2020-03-13 17:13:50', '2020-03-13 07:26:16', '2020-03-13 07:28:50'),
(16, '46', 'V', 'Client activated escrow system for payment phase.', 'Escrow System Activated', 'post/79', '2020-03-13 17:55:12', '2020-03-13 07:32:23', '2020-03-13 08:10:12'),
(17, '46', 'V', 'Client activated escrow system for payment phase.', 'Escrow System Activated', 'post/79', '2020-03-13 17:54:24', '2020-03-13 07:53:39', '2020-03-13 08:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `temp_table`
--

CREATE TABLE `temp_table` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_table`
--

INSERT INTO `temp_table` (`id`, `post_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 2),
(8, 1),
(9, 3),
(10, 4),
(11, 5),
(12, 6),
(13, 2),
(14, 3),
(15, 2),
(16, 3),
(17, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Technical', NULL, NULL),
(2, 'Client Post Requirement', NULL, NULL),
(3, 'Bidding Amount', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filebasepath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `original_filename`, `filepath`, `filebasepath`, `upload_type`, `upload_size`, `mime_type`, `created_at`, `updated_at`) VALUES
(1, '2030239.pdf', 'document(2).pdf', 'client_posts/1', 'client_posts', 'pdf', '29376', 'doc', '2019-08-20 04:39:45', '2019-08-20 04:39:45'),
(2, 'payment-slip1566277037.pdf', 'invoice(1).pdf', 'client_posts/2', 'client_posts', 'pdf', '1137', 'doc', '2019-08-20 04:57:17', '2019-08-20 04:57:17'),
(3, 'client_posts1566277073.pdf', 'document.pdf', 'client_posts/3', 'client_posts', 'pdf', '15474', 'doc', '2019-08-20 04:57:53', '2019-08-20 04:57:53'),
(4, 'client_posts1566277591.xlsx', 'Book1.xlsx', 'client_posts/4', 'client_posts', 'xlsx', '10797', 'doc', '2019-08-20 05:06:31', '2019-08-20 05:06:31'),
(5, 'client_posts1566456202.pdf', 'document(4).pdf', 'client_posts/5', 'client_posts', 'pdf', '29391', 'doc', '2019-08-22 06:43:23', '2019-08-22 06:43:23'),
(6, 'client_posts1566720833.pdf', 'document(1).pdf', 'client_posts/6', 'client_posts', 'pdf', '15838', 'doc', '2019-08-25 08:13:54', '2019-08-25 08:13:54'),
(7, 'client_posts1569733806.pdf', 'invoice(1).pdf', 'client_posts/7', 'client_posts', 'pdf', '1137', 'doc', '2019-09-29 14:55:06', '2019-09-29 14:55:06'),
(8, 'client_posts1569735028.pdf', 'document(11).pdf', 'client_posts/8', 'client_posts', 'pdf', '110016', 'doc', '2019-09-29 15:15:28', '2019-09-29 15:15:28'),
(9, 'client_posts1574162525.pdf', 'VATrelated.pdf', 'client_posts/9', 'client_posts', 'pdf', '406279', 'doc', '2019-11-19 22:07:05', '2019-11-19 22:07:05'),
(10, 'client_posts1590907813.pdf', '1398-CC-0212 R10.pdf', 'client_posts/10', 'client_posts', 'pdf', '468441', 'doc', '2020-05-31 16:35:13', '2020-05-31 16:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `upload_groups`
--

CREATE TABLE `upload_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upload_groups`
--

INSERT INTO `upload_groups` (`id`, `group_id`, `upload_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-08-20 04:39:46', '2019-08-20 04:39:46'),
(2, 2, 2, '2019-08-20 04:57:17', '2019-08-20 04:57:17'),
(3, 3, 3, '2019-08-20 04:57:53', '2019-08-20 04:57:53'),
(4, 4, 4, '2019-08-20 05:06:31', '2019-08-20 05:06:31'),
(5, 5, 5, '2019-08-22 06:43:23', '2019-08-22 06:43:23'),
(6, 6, 6, '2019-08-25 08:13:54', '2019-08-25 08:13:54'),
(7, 7, 7, '2019-09-29 14:55:06', '2019-09-29 14:55:06'),
(8, 8, 8, '2019-09-29 15:15:28', '2019-09-29 15:15:28'),
(9, 9, 9, '2019-11-19 22:07:05', '2019-11-19 22:07:05'),
(10, 10, 10, '2020-05-31 16:35:13', '2020-05-31 16:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_menus`
--

CREATE TABLE `user_menus` (
  `user_menu_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menus`
--

INSERT INTO `user_menus` (`user_menu_id`, `user_id`, `menu_id`) VALUES
(43, 2, 1),
(89, 4, 7),
(90, 4, 8),
(103, 1, 1),
(104, 1, 2),
(105, 1, 3),
(106, 1, 4),
(107, 1, 5),
(108, 1, 6),
(109, 1, 7),
(110, 1, 8),
(111, 1, 9),
(112, 1, 29),
(113, 1, 34),
(114, 1, 41),
(115, 1, 51);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_category`
--

CREATE TABLE `vendor_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M: Material; S:service;',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_category`
--

INSERT INTO `vendor_category` (`id`, `name`, `vendor_type`, `created_at`, `updated_at`) VALUES
(1, 'Contracting', 'S', NULL, NULL),
(2, 'Engineering Design and Consulting', 'S', NULL, NULL),
(3, 'Construction Tools and Machines', 'S', NULL, NULL),
(4, 'Supply and Delivery', 'S', NULL, NULL),
(10001, 'Manufacturer', 'M', NULL, NULL),
(10002, 'WholeSeller/Retailer', 'M', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_type`
--

CREATE TABLE `vendor_type` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_type`
--

INSERT INTO `vendor_type` (`id`, `name`, `description`, `created_at`) VALUES
(10001, 'Manufacturer', NULL, '2019-07-15 10:28:47'),
(10002, 'WholeSeller/Retailer', NULL, '2019-07-15 10:28:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_services`
--
ALTER TABLE `add_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_forget_password`
--
ALTER TABLE `client_forget_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_post`
--
ALTER TABLE `client_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_post_materials`
--
ALTER TABLE `client_post_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_post_services`
--
ALTER TABLE `client_post_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_tickets`
--
ALTER TABLE `client_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_ticket_category`
--
ALTER TABLE `client_ticket_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_ticket_title`
--
ALTER TABLE `client_ticket_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_users`
--
ALTER TABLE `client_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_users_email_unique` (`email`);

--
-- Indexes for table `client_users1`
--
ALTER TABLE `client_users1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_class`
--
ALTER TABLE `company_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_form`
--
ALTER TABLE `contact_us_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dblog`
--
ALTER TABLE `dblog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrowsystem_clientpost_relation_paymentfile`
--
ALTER TABLE `escrowsystem_clientpost_relation_paymentfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrowsystem_client_cancel_serviceprovider_paymentrequest`
--
ALTER TABLE `escrowsystem_client_cancel_serviceprovider_paymentrequest`
  ADD PRIMARY KEY (`id`,`espid`);

--
-- Indexes for table `escrowsystem_client_depo_details`
--
ALTER TABLE `escrowsystem_client_depo_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrowsystem_client_phase_wise_payment`
--
ALTER TABLE `escrowsystem_client_phase_wise_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrowsystem_client_winpost_serviceprovider`
--
ALTER TABLE `escrowsystem_client_winpost_serviceprovider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrowsystem_serviceprovider_getpayment_details`
--
ALTER TABLE `escrowsystem_serviceprovider_getpayment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrowsystem_serviceprovider_phase_wise_payment`
--
ALTER TABLE `escrowsystem_serviceprovider_phase_wise_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontend_brandlogo`
--
ALTER TABLE `frontend_brandlogo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontend_faqpage`
--
ALTER TABLE `frontend_faqpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontend_imagesliders`
--
ALTER TABLE `frontend_imagesliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontend_page`
--
ALTER TABLE `frontend_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_brands`
--
ALTER TABLE `material_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_items`
--
ALTER TABLE `material_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_types`
--
ALTER TABLE `material_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `requested_for_quotes`
--
ALTER TABLE `requested_for_quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_bid_post`
--
ALTER TABLE `serviceprovider_bid_post`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `serviceprovider_forget_password`
--
ALTER TABLE `serviceprovider_forget_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_loadamount`
--
ALTER TABLE `serviceprovider_loadamount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_material`
--
ALTER TABLE `serviceprovider_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_pastproject`
--
ALTER TABLE `serviceprovider_pastproject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_penalty_for_newbid`
--
ALTER TABLE `serviceprovider_penalty_for_newbid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_services`
--
ALTER TABLE `serviceprovider_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_ticket_category`
--
ALTER TABLE `serviceprovider_ticket_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_ticket_title`
--
ALTER TABLE `serviceprovider_ticket_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceprovider_win_clientpost`
--
ALTER TABLE `serviceprovider_win_clientpost`
  ADD PRIMARY KEY (`winid`);

--
-- Indexes for table `service_provider_profile`
--
ALTER TABLE `service_provider_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_provider_profile_service_provider_id_foreign` (`service_provider_id`);

--
-- Indexes for table `service_provider_tickets`
--
ALTER TABLE `service_provider_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_provider_users`
--
ALTER TABLE `service_provider_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_table`
--
ALTER TABLE `temp_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_groups`
--
ALTER TABLE `upload_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menus`
--
ALTER TABLE `user_menus`
  ADD PRIMARY KEY (`user_menu_id`);

--
-- Indexes for table `vendor_category`
--
ALTER TABLE `vendor_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_type`
--
ALTER TABLE `vendor_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_services`
--
ALTER TABLE `add_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `client_forget_password`
--
ALTER TABLE `client_forget_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `client_post`
--
ALTER TABLE `client_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `client_post_materials`
--
ALTER TABLE `client_post_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `client_post_services`
--
ALTER TABLE `client_post_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `client_tickets`
--
ALTER TABLE `client_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `client_ticket_category`
--
ALTER TABLE `client_ticket_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_ticket_title`
--
ALTER TABLE `client_ticket_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_users`
--
ALTER TABLE `client_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `client_users1`
--
ALTER TABLE `client_users1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `company_class`
--
ALTER TABLE `company_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_us_form`
--
ALTER TABLE `contact_us_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dblog`
--
ALTER TABLE `dblog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `escrowsystem_clientpost_relation_paymentfile`
--
ALTER TABLE `escrowsystem_clientpost_relation_paymentfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `escrowsystem_client_cancel_serviceprovider_paymentrequest`
--
ALTER TABLE `escrowsystem_client_cancel_serviceprovider_paymentrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `escrowsystem_client_depo_details`
--
ALTER TABLE `escrowsystem_client_depo_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `escrowsystem_client_phase_wise_payment`
--
ALTER TABLE `escrowsystem_client_phase_wise_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `escrowsystem_client_winpost_serviceprovider`
--
ALTER TABLE `escrowsystem_client_winpost_serviceprovider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `escrowsystem_serviceprovider_getpayment_details`
--
ALTER TABLE `escrowsystem_serviceprovider_getpayment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `escrowsystem_serviceprovider_phase_wise_payment`
--
ALTER TABLE `escrowsystem_serviceprovider_phase_wise_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `frontend_brandlogo`
--
ALTER TABLE `frontend_brandlogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `frontend_faqpage`
--
ALTER TABLE `frontend_faqpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `frontend_imagesliders`
--
ALTER TABLE `frontend_imagesliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `frontend_page`
--
ALTER TABLE `frontend_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `material_brands`
--
ALTER TABLE `material_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `material_items`
--
ALTER TABLE `material_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `material_types`
--
ALTER TABLE `material_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requested_for_quotes`
--
ALTER TABLE `requested_for_quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `serviceprovider_bid_post`
--
ALTER TABLE `serviceprovider_bid_post`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=580;

--
-- AUTO_INCREMENT for table `serviceprovider_forget_password`
--
ALTER TABLE `serviceprovider_forget_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `serviceprovider_loadamount`
--
ALTER TABLE `serviceprovider_loadamount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `serviceprovider_material`
--
ALTER TABLE `serviceprovider_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `serviceprovider_pastproject`
--
ALTER TABLE `serviceprovider_pastproject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `serviceprovider_penalty_for_newbid`
--
ALTER TABLE `serviceprovider_penalty_for_newbid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `serviceprovider_services`
--
ALTER TABLE `serviceprovider_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `serviceprovider_ticket_category`
--
ALTER TABLE `serviceprovider_ticket_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `serviceprovider_ticket_title`
--
ALTER TABLE `serviceprovider_ticket_title`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `serviceprovider_win_clientpost`
--
ALTER TABLE `serviceprovider_win_clientpost`
  MODIFY `winid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `service_provider_profile`
--
ALTER TABLE `service_provider_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `service_provider_tickets`
--
ALTER TABLE `service_provider_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `service_provider_users`
--
ALTER TABLE `service_provider_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `temp_table`
--
ALTER TABLE `temp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `upload_groups`
--
ALTER TABLE `upload_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_menus`
--
ALTER TABLE `user_menus`
  MODIFY `user_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `vendor_category`
--
ALTER TABLE `vendor_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;

--
-- AUTO_INCREMENT for table `vendor_type`
--
ALTER TABLE `vendor_type`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10004;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service_provider_profile`
--
ALTER TABLE `service_provider_profile`
  ADD CONSTRAINT `service_provider_profile_service_provider_id_foreign` FOREIGN KEY (`service_provider_id`) REFERENCES `service_provider_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
