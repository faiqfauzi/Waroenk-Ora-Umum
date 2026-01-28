-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 08:24 AM
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
-- Database: `ou`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1769580458),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1769580458;', 1769580458),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1769574253),
('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1769574253;', 1769574253);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Makanan', '2026-01-20 23:47:48', '2026-01-20 23:47:48'),
(3, 'Minuman', '2026-01-21 00:23:08', '2026-01-21 00:23:08'),
(4, 'Cemilan', '2026-01-21 00:23:16', '2026-01-21 00:23:16'),
(5, 'Snack', '2026-01-28 06:05:11', '2026-01-28 06:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
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
  `attempts` tinyint(3) UNSIGNED NOT NULL,
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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`, `category_id`, `menu_image`) VALUES
(1, 'Nasi Goreng Telor', 19000, 'Nasi Goreng Dengan Toping Telor Dengan Bumbu Basic Yg Sudah Pedas Tidak Bisa Request Tidak Pedas Ya Kakak', '2026-01-21 00:25:59', '2026-01-21 00:54:12', 2, '01KFFQ4AR2P8WH6CG1MZTYKDYV.jpg'),
(2, 'Indomie Ayam katsu', 30000, 'Indomie lauk chicken katsu dan coslow dengan pilihan beberapa saos', '2026-01-21 00:56:30', '2026-01-21 00:56:30', 2, '01KFFRW6CK820Q9KGCP8YQ8CTB.jpg'),
(3, 'Teh Tarik', 14250, 'Teh yang ditarik', '2026-01-21 00:57:43', '2026-01-21 00:57:43', 3, '01KFFRYD9GH9HW55XCX3T5VGEM.jpg'),
(4, 'joko', 10, 'ri1', '2026-01-23 00:11:36', '2026-01-23 00:11:36', 2, '01KFMV3DYV6W6Y772WEQ03ZBZP.png'),
(5, 'cimol', 1000, 'test', '2026-01-28 06:06:49', '2026-01-28 06:06:49', 5, '01KG1KCCNEX3A0ZV6FMTNR028D.jpg');

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
(4, '2026_01_19_045910_create_menus_table', 1),
(5, '2026_01_21_055405_create_categories_table', 1),
(6, '2026_01_21_055433_create_tables_table', 1),
(7, '2026_01_21_055435_create_orders_table', 1),
(8, '2026_01_21_055441_create_order_items_table', 1),
(9, '2026_01_21_061416_add_category_id_to_menus_table', 1),
(10, '2026_01_21_061445_add_icon_image_to_menus_table', 1),
(11, '2026_01_21_121257_add_payment_fields_to_orders_table', 2),
(12, '2026_01_21_121331_update_order_items_table', 2),
(13, '2026_01_21_133018_drop_table_id_from_order_items', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method` varchar(255) NOT NULL DEFAULT 'kasir',
  `subtotal` int(11) NOT NULL DEFAULT 0,
  `tax` int(11) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `proof` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `table_id`, `status`, `total`, `created_at`, `updated_at`, `method`, `subtotal`, `tax`, `notes`, `proof`) VALUES
(1, 1, 'selesai', 170500.00, '2026-01-21 05:34:42', '2026-01-21 09:37:23', 'qris', 155000, 15500, NULL, 'proofs/BHWArJTZCiscSBQqvc2GvZb5liAa0qU8NDLuRdXR.webp'),
(2, 1, 'selesai', 74800.00, '2026-01-21 06:24:13', '2026-01-21 09:56:05', 'qris', 68000, 6800, NULL, 'proofs/Ik1llETnCcBn3n8YkTOQhEZXxskPat4wA4FzPKp9.webp'),
(3, 1, 'selesai', 53900.00, '2026-01-21 06:31:03', '2026-01-21 09:37:40', 'qris', 49000, 4900, NULL, 'proofs/Y3HupBLRpL1AzZoUmW6BytfnlsSbGLOy20Z3hQq1.webp'),
(4, 1, 'selesai', 86900.00, '2026-01-21 06:33:44', '2026-01-21 09:38:14', 'qris', 79000, 7900, NULL, 'proofs/GG50zKdJVJqvnrDWcrMbYCjMbR1BMe6Hl9SAUdee.jpg'),
(5, 1, 'selesai', 47025.00, '2026-01-21 06:38:14', '2026-01-21 09:38:54', 'qris', 42750, 4275, NULL, 'proofs/sjIUqIdPokrHGU2s5OC5RiW0ftwYJhPQCYqncFLh.jpg'),
(6, 1, 'selesai', 36575.00, '2026-01-21 06:39:08', '2026-01-21 09:39:40', 'qris', 33250, 3325, NULL, 'proofs/R6KxeXZ8RvCAP1M48hExM06vMwPqF8MC1t0mphuw.jpg'),
(7, 1, 'selesai', 53900.00, '2026-01-21 06:41:33', '2026-01-21 09:39:55', 'kasir', 49000, 4900, NULL, NULL),
(8, 1, 'selesai', 121825.00, '2026-01-21 09:11:29', '2026-01-21 09:40:23', 'qris', 110750, 11075, NULL, 'proofs/6LJguNPEGIDmptHNwHe0qREYCqu0G7xr1F3eOw4P.png'),
(9, 1, 'selesai', 95700.00, '2026-01-21 09:19:47', '2026-01-21 09:40:44', 'qris', 87000, 8700, NULL, 'proofs/7CrgTBLjJuLtBWRYzgQ5ZpUOesnyXygQfCmumGiT.jpg'),
(10, 1, 'selesai', 31350.00, '2026-01-21 09:25:50', '2026-01-21 09:40:59', 'qris', 28500, 2850, NULL, 'proofs/XLUYld2CV1TbXkrCd67kWGw3Ek5vkujtYaMihg06.webp'),
(11, 1, 'selesai', 62700.00, '2026-01-21 09:41:41', '2026-01-21 09:42:38', 'qris', 57000, 5700, NULL, 'proofs/9WdNXXSiHRN5zLxAvUd2p9YDLePcTpwbZ6qU9Z7q.jpg'),
(12, 1, 'selesai', 20900.00, '2026-01-21 09:43:50', '2026-01-21 09:46:52', 'qris', 19000, 1900, NULL, 'proofs/UUmIgmIVs2LzpC2GEnNY86vK7cDzTHsa7GzSbkUV.jpg'),
(13, 1, 'selesai', 15675.00, '2026-01-21 09:50:02', '2026-01-21 09:52:55', 'qris', 14250, 1425, NULL, 'proofs/gg2Vtu8tYhwowmNPc0GYG8fEK94rhcN2GqNdStqf.jpg'),
(14, 1, 'selesai', 41800.00, '2026-01-21 09:52:25', '2026-01-21 09:55:43', 'qris', 38000, 3800, NULL, 'proofs/gMy9OegBUmNhyBfD3cClLabjyHMDZreeIkFdk4lO.jpg'),
(15, 1, 'selesai', 47025.00, '2026-01-21 09:56:34', '2026-01-21 10:00:23', 'qris', 42750, 4275, NULL, 'proofs/PEX6o8jd9ZxQAnXG1RBgn8nZl8x50grW09XvQJ3i.jpg'),
(16, 1, 'selesai', 33000.00, '2026-01-21 09:57:11', '2026-01-21 10:00:44', 'qris', 30000, 3000, NULL, 'proofs/g7aLig7B7i16X5AWalLOkV7spqc4sJTupVOtVYbt.jpg'),
(17, 1, 'selesai', 31350.00, '2026-01-21 10:01:19', '2026-01-21 10:02:02', 'qris', 28500, 2850, NULL, 'proofs/RY7KxerKtL9zQXS2PPewCdlXygSlJ8qwKfbwMEwZ.jpg'),
(18, 1, 'selesai', 41800.00, '2026-01-21 10:02:19', '2026-01-28 04:48:22', 'qris', 38000, 3800, NULL, 'proofs/p0OymO2yEGJqTFHhjwSXtQ53IHL9mWqBbDBYoVll.jpg'),
(19, 1, 'selesai', 107800.00, '2026-01-21 10:08:37', '2026-01-21 10:12:31', 'qris', 98000, 9800, NULL, 'proofs/BIP5W9NuXAOxcF4B8CHpkSxyNEjtVxVw8JSNrLe6.jpg'),
(20, 1, 'selesai', 41800.00, '2026-01-21 10:11:30', '2026-01-22 01:46:05', 'qris', 38000, 3800, NULL, 'proofs/9KVA3sm0x0n6fgLI22eiP0H9uWcpiWnJsckyyeCF.jpg'),
(21, 1, 'selesai', 53900.00, '2026-01-22 01:47:45', '2026-01-28 04:54:15', 'qris', 49000, 4900, NULL, 'proofs/dJduAaz5GIFgqQEhC20teGkuLWFyTRl28AixNBBv.jpg'),
(22, 1, 'selesai', 69575.00, '2026-01-22 01:48:33', '2026-01-28 04:53:55', 'qris', 63250, 6325, NULL, 'proofs/T4YxGV5pCaKqsuLHZCqJqoTRlQpBDv72lDcbFvbj.jpg'),
(23, 1, 'selesai', 47025.00, '2026-01-22 01:51:24', '2026-01-28 04:53:37', 'qris', 42750, 4275, NULL, 'proofs/Rdyb9R7QwsyUFs3G5M5PvBpyMnQ7Lw14y28B4Pv3.jpg'),
(24, 1, 'selesai', 47025.00, '2026-01-22 01:51:59', '2026-01-28 04:53:16', 'qris', 42750, 4275, NULL, 'proofs/gZdLvIWeixKrYgEnSykSafIjwXigfUftUx0UWSdX.jpg'),
(25, 1, 'selesai', 53900.00, '2026-01-22 02:01:05', '2026-01-28 04:52:59', 'qris', 49000, 4900, NULL, 'proofs/janAaAIC3XN44rNYR5M3sFzBSIMsGCWI9Z27UXxi.jpg'),
(26, 1, 'selesai', 41800.00, '2026-01-22 02:05:36', '2026-01-28 04:52:39', 'qris', 38000, 3800, NULL, 'proofs/Ql8Kkbsk4eC7ZaXBWWZ3WXsxjBFYzd5M9J9igRx1.png'),
(27, 1, 'selesai', 62700.00, '2026-01-22 02:07:07', '2026-01-28 04:52:18', 'qris', 57000, 5700, NULL, 'proofs/xukbgmjhaV53XeRNbVL1jBuDCBsHlEStgMd04Rrn.jpg'),
(28, 1, 'selesai', 53900.00, '2026-01-22 02:08:49', '2026-01-28 04:51:50', 'kasir', 49000, 4900, NULL, NULL),
(29, 1, 'selesai', 31350.00, '2026-01-22 02:13:57', '2026-01-28 04:51:21', 'qris', 28500, 2850, NULL, 'proofs/QXVbRxo9bUQY4saGfmNgXF5fZEdWDZlQn8UWSJTI.jpg'),
(30, 1, 'selesai', 41800.00, '2026-01-22 02:16:52', '2026-01-28 04:51:01', 'qris', 38000, 3800, NULL, 'proofs/GjVODLFmbyEmMeybfqE9UDRiRX56kkcweE1Myv03.jpg'),
(31, 1, 'selesai', 47025.00, '2026-01-22 02:20:59', '2026-01-28 04:50:37', 'qris', 42750, 4275, NULL, 'proofs/rIxZ2sTEanXFUBemv78z2lWjbtP1SWqhfTQy0k7n.jpg'),
(32, 1, 'selesai', 31350.00, '2026-01-22 02:24:35', '2026-01-28 04:50:01', 'kasir', 28500, 2850, NULL, NULL),
(33, 1, 'selesai', 47025.00, '2026-01-22 02:27:12', '2026-01-28 04:48:45', 'qris', 42750, 4275, NULL, 'proofs/MUuHj1XGTrLDh3rl8dL1NFtnfYSwYHGWREI1990l.jpg'),
(34, 1, 'selesai', 31350.00, '2026-01-22 02:33:45', '2026-01-22 23:22:35', 'qris', 28500, 2850, NULL, 'proofs/8WPk6KcBIYDPtn56FUJsZDwKxzCYkB8jnDDHH8nw.jpg'),
(35, 1, 'selesai', 15675.00, '2026-01-22 02:36:15', '2026-01-22 23:19:29', 'qris', 14250, 1425, NULL, 'proofs/dxRHHFg4RapJvBvUyVDbMa9ifSgDn69syeR9dANO.jpg'),
(36, 1, 'selesai', 78375.00, '2026-01-22 02:36:36', '2026-01-22 23:19:08', 'kasir', 71250, 7125, NULL, NULL),
(37, 1, 'selesai', 20900.00, '2026-01-22 23:54:42', '2026-01-28 04:47:55', 'kasir', 19000, 1900, NULL, NULL),
(38, 1, 'selesai', 33000.00, '2026-01-22 23:55:30', '2026-01-28 04:47:39', 'kasir', 30000, 3000, NULL, NULL),
(39, 1, 'selesai', 0.00, '2026-01-22 23:55:58', '2026-01-28 04:47:17', 'kasir', 0, 0, NULL, NULL),
(40, 1, 'selesai', 33000.00, '2026-01-22 23:56:38', '2026-01-28 04:47:00', 'kasir', 30000, 3000, NULL, NULL),
(41, 1, 'selesai', 15675.00, '2026-01-23 00:03:58', '2026-01-28 04:45:30', 'qris', 14250, 1425, NULL, 'proofs/8uJVWQ9OCUWFaUsPMsp1UqQbe8xtcg7jeknbTStL.jpg'),
(42, 1, 'selesai', 20900.00, '2026-01-23 00:16:10', '2026-01-28 04:45:08', 'kasir', 19000, 1900, NULL, NULL),
(43, 1, 'selesai', 20900.00, '2026-01-23 00:16:51', '2026-01-28 04:44:48', 'kasir', 19000, 1900, NULL, NULL),
(44, 1, 'selesai', 20900.00, '2026-01-23 00:28:49', '2026-01-28 04:44:32', 'kasir', 19000, 1900, 'Tidak Pedas', NULL),
(45, 1, 'selesai', 20900.00, '2026-01-23 00:42:12', '2026-01-28 04:44:12', 'kasir', 19000, 1900, NULL, NULL),
(46, 1, 'selesai', 20900.00, '2026-01-23 00:43:43', '2026-01-28 04:43:50', 'kasir', 19000, 1900, NULL, NULL),
(47, 1, 'selesai', 20900.00, '2026-01-23 00:45:24', '2026-01-28 04:43:19', 'kasir', 19000, 1900, NULL, NULL),
(48, 1, 'selesai', 20900.00, '2026-01-23 00:46:59', '2026-01-28 04:42:53', 'kasir', 19000, 1900, NULL, NULL),
(49, 1, 'selesai', 20900.00, '2026-01-23 00:54:47', '2026-01-28 04:42:15', 'kasir', 19000, 1900, NULL, NULL),
(50, 1, 'selesai', 20900.00, '2026-01-23 01:02:58', '2026-01-28 04:41:58', 'kasir', 19000, 1900, NULL, NULL),
(51, 1, 'selesai', 33000.00, '2026-01-23 01:07:50', '2026-01-28 04:41:37', 'kasir', 30000, 3000, NULL, NULL),
(52, 1, 'selesai', 20900.00, '2026-01-23 01:12:42', '2026-01-28 04:41:00', 'kasir', 19000, 1900, NULL, NULL),
(53, 1, 'selesai', 15675.00, '2026-01-23 01:13:57', '2026-01-28 04:40:44', 'qris', 14250, 1425, NULL, 'proofs/LBqKJ1LNA3Y7X4MxW4nmlRhMWlKdBGpVpwcKp1Is.jpg'),
(54, 1, 'selesai', 47025.00, '2026-01-23 01:15:19', '2026-01-28 04:40:14', 'kasir', 42750, 4275, NULL, NULL),
(55, 1, 'selesai', 66000.00, '2026-01-23 01:17:28', '2026-01-28 04:39:56', 'qris', 60000, 6000, NULL, 'proofs/5UKrq4ChK9EXIs88ecUJZhHBAaD9UeA9rjjQdnNV.jpg'),
(56, 1, 'selesai', 20900.00, '2026-01-23 01:24:16', '2026-01-28 04:39:39', 'kasir', 19000, 1900, NULL, NULL),
(57, 1, 'selesai', 62700.00, '2026-01-23 01:27:44', '2026-01-28 04:39:17', 'kasir', 57000, 5700, NULL, NULL),
(58, 1, 'selesai', 20900.00, '2026-01-23 01:29:28', '2026-01-28 04:39:00', 'kasir', 19000, 1900, NULL, NULL),
(59, 1, 'selesai', 20900.00, '2026-01-23 01:30:47', '2026-01-28 04:38:45', 'qris', 19000, 1900, NULL, 'proofs/G6PvncpJNyJRkzjZUbSBySq85eQwf2TArEryjm0s.webp'),
(60, 1, 'selesai', 20900.00, '2026-01-28 04:36:52', '2026-01-28 04:38:27', 'kasir', 19000, 1900, NULL, NULL),
(61, 1, 'selesai', 78375.00, '2026-01-28 05:48:04', '2026-01-28 05:48:30', 'kasir', 71250, 7125, NULL, NULL),
(62, 1, 'selesai', 41800.00, '2026-01-28 05:58:09', '2026-01-28 06:02:20', 'qris', 38000, 3800, 'tidak pedas', 'proofs/HAOjvvmftzrPSRCmwCHYfxrEClLbjZUpnO7pfNXL.png'),
(63, 1, 'selesai', 20900.00, '2026-01-28 06:02:46', '2026-01-28 06:07:57', 'kasir', 19000, 1900, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 3, 'Nasi Goreng Telor', 1, 19000, '2026-01-21 06:31:03', '2026-01-21 06:31:03'),
(2, 3, 'Indomie Ayam katsu', 1, 30000, '2026-01-21 06:31:03', '2026-01-21 06:31:03'),
(3, 4, 'Nasi Goreng Telor', 1, 19000, '2026-01-21 06:33:44', '2026-01-21 06:33:44'),
(4, 4, 'Indomie Ayam katsu', 2, 30000, '2026-01-21 06:33:44', '2026-01-21 06:33:44'),
(5, 5, 'Teh Tarik', 3, 14250, '2026-01-21 06:38:14', '2026-01-21 06:38:14'),
(6, 6, 'Nasi Goreng Telor', 1, 19000, '2026-01-21 06:39:08', '2026-01-21 06:39:08'),
(7, 6, 'Teh Tarik', 1, 14250, '2026-01-21 06:39:08', '2026-01-21 06:39:08'),
(8, 7, 'Nasi Goreng Telor', 1, 19000, '2026-01-21 06:41:33', '2026-01-21 06:41:33'),
(9, 7, 'Indomie Ayam katsu', 1, 30000, '2026-01-21 06:41:33', '2026-01-21 06:41:33'),
(10, 8, 'Nasi Goreng Telor', 2, 19000, '2026-01-21 09:11:29', '2026-01-21 09:11:29'),
(11, 8, 'Indomie Ayam katsu', 1, 30000, '2026-01-21 09:11:29', '2026-01-21 09:11:29'),
(12, 8, 'Teh Tarik', 3, 14250, '2026-01-21 09:11:29', '2026-01-21 09:11:29'),
(13, 9, 'Nasi Goreng Telor', 3, 19000, '2026-01-21 09:19:47', '2026-01-21 09:19:47'),
(14, 9, 'Indomie Ayam katsu', 1, 30000, '2026-01-21 09:19:47', '2026-01-21 09:19:47'),
(15, 10, 'Teh Tarik', 2, 14250, '2026-01-21 09:25:50', '2026-01-21 09:25:50'),
(16, 11, 'Teh Tarik', 4, 14250, '2026-01-21 09:41:41', '2026-01-21 09:41:41'),
(17, 12, 'Nasi Goreng Telor', 1, 19000, '2026-01-21 09:43:50', '2026-01-21 09:43:50'),
(18, 13, 'Teh Tarik', 1, 14250, '2026-01-21 09:50:02', '2026-01-21 09:50:02'),
(19, 14, 'Nasi Goreng Telor', 2, 19000, '2026-01-21 09:52:25', '2026-01-21 09:52:25'),
(20, 15, 'Teh Tarik', 3, 14250, '2026-01-21 09:56:34', '2026-01-21 09:56:34'),
(21, 16, 'Indomie Ayam katsu', 1, 30000, '2026-01-21 09:57:11', '2026-01-21 09:57:11'),
(22, 17, 'Teh Tarik', 2, 14250, '2026-01-21 10:01:19', '2026-01-21 10:01:19'),
(23, 18, 'Nasi Goreng Telor', 2, 19000, '2026-01-21 10:02:19', '2026-01-21 10:02:19'),
(24, 19, 'Nasi Goreng Telor', 2, 19000, '2026-01-21 10:08:37', '2026-01-21 10:08:37'),
(25, 19, 'Indomie Ayam katsu', 2, 30000, '2026-01-21 10:08:37', '2026-01-21 10:08:37'),
(26, 20, 'Nasi Goreng Telor', 2, 19000, '2026-01-21 10:11:30', '2026-01-21 10:11:30'),
(27, 21, 'Nasi Goreng Telor', 1, 19000, '2026-01-22 01:47:45', '2026-01-22 01:47:45'),
(28, 21, 'Indomie Ayam katsu', 1, 30000, '2026-01-22 01:47:45', '2026-01-22 01:47:45'),
(29, 22, 'Nasi Goreng Telor', 1, 19000, '2026-01-22 01:48:33', '2026-01-22 01:48:33'),
(30, 22, 'Indomie Ayam katsu', 1, 30000, '2026-01-22 01:48:33', '2026-01-22 01:48:33'),
(31, 22, 'Teh Tarik', 1, 14250, '2026-01-22 01:48:33', '2026-01-22 01:48:33'),
(32, 23, 'Teh Tarik', 3, 14250, '2026-01-22 01:51:24', '2026-01-22 01:51:24'),
(33, 24, 'Teh Tarik', 3, 14250, '2026-01-22 01:51:59', '2026-01-22 01:51:59'),
(34, 25, 'Nasi Goreng Telor', 1, 19000, '2026-01-22 02:01:05', '2026-01-22 02:01:05'),
(35, 25, 'Indomie Ayam katsu', 1, 30000, '2026-01-22 02:01:05', '2026-01-22 02:01:05'),
(36, 26, 'Nasi Goreng Telor', 2, 19000, '2026-01-22 02:05:36', '2026-01-22 02:05:36'),
(37, 27, 'Teh Tarik', 4, 14250, '2026-01-22 02:07:07', '2026-01-22 02:07:07'),
(38, 28, 'Nasi Goreng Telor', 1, 19000, '2026-01-22 02:08:49', '2026-01-22 02:08:49'),
(39, 28, 'Indomie Ayam katsu', 1, 30000, '2026-01-22 02:08:49', '2026-01-22 02:08:49'),
(40, 29, 'Teh Tarik', 2, 14250, '2026-01-22 02:13:57', '2026-01-22 02:13:57'),
(41, 30, 'Nasi Goreng Telor', 2, 19000, '2026-01-22 02:16:52', '2026-01-22 02:16:52'),
(42, 31, 'Teh Tarik', 3, 14250, '2026-01-22 02:20:59', '2026-01-22 02:20:59'),
(43, 32, 'Teh Tarik', 2, 14250, '2026-01-22 02:24:35', '2026-01-22 02:24:35'),
(44, 33, 'Teh Tarik', 3, 14250, '2026-01-22 02:27:12', '2026-01-22 02:27:12'),
(45, 34, 'Teh Tarik', 2, 14250, '2026-01-22 02:33:45', '2026-01-22 02:33:45'),
(46, 35, 'Teh Tarik', 1, 14250, '2026-01-22 02:36:15', '2026-01-22 02:36:15'),
(47, 36, 'Teh Tarik', 5, 14250, '2026-01-22 02:36:36', '2026-01-22 02:36:36'),
(48, 37, 'Nasi Goreng Telor', 1, 19000, '2026-01-22 23:54:42', '2026-01-22 23:54:42'),
(49, 38, 'Indomie Ayam katsu', 1, 30000, '2026-01-22 23:55:30', '2026-01-22 23:55:30'),
(50, 40, 'Indomie Ayam katsu', 1, 30000, '2026-01-22 23:56:38', '2026-01-22 23:56:38'),
(51, 41, 'Teh Tarik', 1, 14250, '2026-01-23 00:03:58', '2026-01-23 00:03:58'),
(52, 42, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:16:10', '2026-01-23 00:16:10'),
(53, 43, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:16:51', '2026-01-23 00:16:51'),
(54, 44, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:28:49', '2026-01-23 00:28:49'),
(55, 45, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:42:12', '2026-01-23 00:42:12'),
(56, 46, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:43:43', '2026-01-23 00:43:43'),
(57, 47, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:45:24', '2026-01-23 00:45:24'),
(58, 48, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:46:59', '2026-01-23 00:46:59'),
(59, 49, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 00:54:47', '2026-01-23 00:54:47'),
(60, 50, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 01:02:58', '2026-01-23 01:02:58'),
(61, 51, 'Indomie Ayam katsu', 1, 30000, '2026-01-23 01:07:50', '2026-01-23 01:07:50'),
(62, 52, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 01:12:42', '2026-01-23 01:12:42'),
(63, 53, 'Teh Tarik', 1, 14250, '2026-01-23 01:13:57', '2026-01-23 01:13:57'),
(64, 54, 'Teh Tarik', 3, 14250, '2026-01-23 01:15:19', '2026-01-23 01:15:19'),
(65, 55, 'Indomie Ayam katsu', 2, 30000, '2026-01-23 01:17:28', '2026-01-23 01:17:28'),
(66, 56, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 01:24:16', '2026-01-23 01:24:16'),
(67, 57, 'Teh Tarik', 4, 14250, '2026-01-23 01:27:44', '2026-01-23 01:27:44'),
(68, 58, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 01:29:28', '2026-01-23 01:29:28'),
(69, 59, 'Nasi Goreng Telor', 1, 19000, '2026-01-23 01:30:47', '2026-01-23 01:30:47'),
(70, 60, 'Nasi Goreng Telor', 1, 19000, '2026-01-28 04:36:52', '2026-01-28 04:36:52'),
(71, 61, 'Teh Tarik', 5, 14250, '2026-01-28 05:48:04', '2026-01-28 05:48:04'),
(72, 62, 'Nasi Goreng Telor', 2, 19000, '2026-01-28 05:58:09', '2026-01-28 05:58:09'),
(73, 63, 'Nasi Goreng Telor', 1, 19000, '2026-01-28 06:02:46', '2026-01-28 06:02:46');

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
('ZE2J6gSneEw4z2GyRf9KOikDj8DnlWNX1XCpketl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoic2hXRjJMT2hGa2FFdktJN01LM3N6aGFYZEJsSHhFTzBOVjNiTU1WeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9vcmRlci1jb3VudC1jaGVjayI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiODk3ZjE5ZGE0NWJlYzU4M2UxZDU5ZTdmOWQ0NWIxMzE5YmRjNTkzNzI2MDJmYWU2OWJkMGI3ZjJhOTgzMWY1NCI7czo2OiJ0YWJsZXMiO2E6MTp7czoxOToiTGlzdE9yZGVyc19wZXJfcGFnZSI7czozOiJhbGwiO31zOjg6ImZpbGFtZW50IjthOjA6e319', 1769584357);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `qr_code`, `created_at`, `updated_at`) VALUES
(1, 'Meja 2', 'qrcodes/table_1.svg', '2026-01-20 23:42:23', '2026-01-28 06:09:02'),
(2, 'meja 3', 'qrcodes/table_2.svg', '2026-01-28 06:09:30', '2026-01-28 06:09:30');

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
(1, 'admin', 'admin@gmail.com', '2026-01-20 23:32:27', '$2y$12$JamA.ZCJB69qu8Tn1uA4Tet5kutn5d6qvqaqoB85glogqfjTB9LgC', 'zA9n0B4BHG', '2026-01-20 23:32:27', '2026-01-20 23:32:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_table_id_foreign` (`table_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
