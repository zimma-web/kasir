-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 06:30 AM
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
-- Database: `zimam_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` char(36) NOT NULL,
  `penjualan_id` char(36) NOT NULL,
  `produk_id` char(36) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `produk_id`, `nama_produk`, `jumlah_produk`, `subtotal`, `created_at`, `updated_at`) VALUES
('9e94aaca-fc8e-4268-bb8b-1e323a0e1189', 'PNJ250402001', 'PDK1', 'Nutriboost', 1, 7000.00, '2025-04-02 10:06:17', '2025-04-02 10:06:17'),
('9ea039c1-9df8-4bbb-ae3c-c1c83e94b2db', 'PNJ250408001', 'PDK11', 'Good Day', 3, 9000.00, '2025-04-08 04:00:09', '2025-04-08 04:00:09'),
('9ea039c2-354d-4a4d-9283-73908ed6bd5c', 'PNJ250408001', 'PDK5', 'Gery Malkist', 2, 12000.00, '2025-04-08 04:00:09', '2025-04-08 04:00:09'),
('9ea039c2-3659-44a5-8b50-05107b06c5f3', 'PNJ250408001', 'PDK2', 'Indomie', 4, 11600.00, '2025-04-08 04:00:09', '2025-04-08 04:00:09'),
('9ea1cdf9-e728-4175-a22a-000f8520a938', 'PNJ250409001', 'PDK1', 'Nutriboost', 1, 7000.00, '2025-04-08 22:50:26', '2025-04-08 22:50:26'),
('9ea1d4d3-8caa-40df-8145-dba6b60df133', 'PNJ250409002', 'PDK10', 'Beng Beng', 31, 77500.00, '2025-04-08 23:09:35', '2025-04-08 23:09:35'),
('9ea1d4d4-2980-42da-9129-df6792cbeec4', 'PNJ250409002', 'PDK8', 'Chitato', 13, 128700.00, '2025-04-08 23:09:35', '2025-04-08 23:09:35'),
('9ea1e9cf-db9b-43fc-a73c-f249a6913fa1', 'PNJ250409003', 'PDK10', 'Beng Beng', 1, 2500.00, '2025-04-09 00:08:16', '2025-04-09 00:08:16'),
('9ea1eaa2-21e0-4be9-ab7d-5f7d0dd83d2a', 'PNJ250409004', 'PDK3', 'Tango', 1, 5000.00, '2025-04-09 00:10:34', '2025-04-09 00:10:34'),
('9ea42c00-a1cb-4516-a79d-85cb5d88aac0', 'PNJ250410001', 'PDK2', 'Indomie', 1, 2900.00, '2025-04-10 03:05:00', '2025-04-10 03:05:00'),
('9ea42dfd-9faf-4268-a1d5-d52055811aa7', 'PNJ250410002', 'PDK10', 'Beng Beng', 1, 2500.00, '2025-04-10 03:10:34', '2025-04-10 03:10:34'),
('9ea42dfd-a264-4e3e-b904-e3a622a17229', 'PNJ250410002', 'PDK5', 'Gery Malkist', 7, 42000.00, '2025-04-10 03:10:34', '2025-04-10 03:10:34'),
('9ea42dfd-a364-41ff-a2cf-cd1aedad972b', 'PNJ250410002', 'PDK6', 'Nabati', 1, 4000.00, '2025-04-10 03:10:34', '2025-04-10 03:10:34'),
('9ea42dfd-a4aa-4e95-a0dd-5f987ca0812b', 'PNJ250410002', 'PDK1', 'Nutriboost', 1, 7000.00, '2025-04-10 03:10:34', '2025-04-10 03:10:34'),
('9ea5cc36-3cb3-49bc-8f2b-e209144874db', 'PNJ250411001', 'PDK11', 'Good Day', 1, 3000.00, '2025-04-10 22:28:49', '2025-04-10 22:28:49');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_15_065117_create_produk_table', 1),
(5, '2025_01_22_031422_create_pelanggan_table', 1),
(6, '2025_01_22_041423_create_penjualan_table', 1),
(7, '2025_01_22_042936_create_detail_penjualan_table', 1),
(8, '2025_01_26_093931_add_image_to_produk_table', 1),
(9, '2025_02_19_142056_add_soft_deletes_to_produk_table', 1),
(10, '2025_02_19_142823_add_nama_produk_to_detail_penjualan', 1),
(11, '2024_03_19_000002_update_id_formats', 2),
(12, '2024_03_19_000002_update_id_formats', 2),
(13, '2024_03_09_000001_add_soft_deletes_to_pelanggan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` char(36) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `jenis_pelanggan` enum('bukan_member','member_baru','member') NOT NULL DEFAULT 'member_baru',
  `points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat`, `nomor_telepon`, `jenis_pelanggan`, `points`, `created_at`, `updated_at`, `deleted_at`) VALUES
('PLG1', 'Andre', 'Cimahi', '0821654646848', 'member', 19, '2025-03-09 08:08:29', '2025-04-10 22:28:47', NULL),
('PLG2', 'Billie Eillish', 'nganjuk', '0858465464846', 'member', 27, '2025-04-08 23:06:04', '2025-04-10 03:10:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` char(36) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `nominal_bayar` decimal(10,2) NOT NULL,
  `kembalian` decimal(10,2) NOT NULL,
  `pelanggan_id` char(36) DEFAULT NULL,
  `user_id` char(36) NOT NULL,
  `points_earned` int(11) NOT NULL DEFAULT 0,
  `points_used` int(11) NOT NULL DEFAULT 0,
  `points_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal_penjualan`, `total_harga`, `nominal_bayar`, `kembalian`, `pelanggan_id`, `user_id`, `points_earned`, `points_used`, `points_discount`, `created_at`, `updated_at`) VALUES
('PNJ250402001', '2025-04-02', 7000.00, 10000.00, 3000.00, NULL, 'USR3', 0, 0, 0.00, '2025-04-02 10:06:17', '2025-04-02 10:06:17'),
('PNJ250408001', '2025-04-08', 32600.00, 50000.00, 17400.00, 'PLG1', 'USR3', 0, 0, 0.00, '2025-04-08 04:00:08', '2025-04-08 04:00:08'),
('PNJ250409001', '2025-04-09', 7000.00, 10000.00, 3000.00, NULL, 'USR3', 0, 0, 0.00, '2025-04-08 22:50:25', '2025-04-08 22:50:25'),
('PNJ250409002', '2025-04-09', 206200.00, 220000.00, 13800.00, 'PLG2', 'USR3', 20, 0, 0.00, '2025-04-08 23:09:34', '2025-04-08 23:09:34'),
('PNJ250409003', '2025-04-09', 500.00, 5000.00, 4500.00, 'PLG2', 'USR3', 0, 20, 2000.00, '2025-04-09 00:08:16', '2025-04-09 00:08:16'),
('PNJ250409004', '2025-04-09', 5000.00, 10000.00, 5000.00, 'PLG1', 'USR3', 0, 0, 0.00, '2025-04-09 00:10:34', '2025-04-09 00:10:34'),
('PNJ250410001', '2025-04-10', 900.00, 3000.00, 2100.00, 'PLG1', 'USR3', 1, 2, 2000.00, '2025-04-10 03:05:00', '2025-04-10 03:05:00'),
('PNJ250410002', '2025-04-10', 55500.00, 100000.00, 44500.00, 'PLG2', 'USR3', 27, 0, 0.00, '2025-04-10 03:10:34', '2025-04-10 03:10:34'),
('PNJ250411001', '2025-04-11', 2000.00, 5000.00, 3000.00, 'PLG1', 'USR3', 1, 1, 1000.00, '2025-04-10 22:28:47', '2025-04-10 22:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `point_settings`
--

CREATE TABLE `point_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `points_to_rupiah` int(11) NOT NULL DEFAULT 1,
  `amount_per_point` decimal(10,2) DEFAULT 10000.00,
  `description` text DEFAULT NULL,
  `earning_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_settings`
--

INSERT INTO `point_settings` (`id`, `points_to_rupiah`, `amount_per_point`, `description`, `earning_description`, `created_at`, `updated_at`) VALUES
(1, 1000, 2000.00, '1 point = Rp 1000', 'Promo Member', '2025-04-09 06:36:21', '2025-04-10 03:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` char(36) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga`, `stok`, `gambar`, `created_at`, `updated_at`, `deleted_at`) VALUES
('PDK1', 'Nutriboost', 7000.00, 17, 'produk/BqA3TEW6zC13bJlnfyNpN32Wjw5AQJQze6Pzujrr.jpg', '2025-03-07 04:43:01', '2025-04-10 23:08:32', NULL),
('PDK10', 'Beng Beng', 2500.00, 47, 'produk/k36BWw8QJ79Nvx6zZXpotNleQYILZLnKdpVnZHhc.jpg', '2025-03-07 04:43:01', '2025-04-10 23:14:00', NULL),
('PDK11', 'Good Day', 3000.00, 48, 'produk/GL7ZaExyyGnRpUAXyPJ1xe2ZNUqSm9Y7iEww64z6.jpg', '2025-03-07 04:43:01', '2025-04-10 23:14:32', NULL),
('PDK2', 'Indomie', 2900.00, 95, 'produk/GJ4yCzFDpSPQNwh4LyEMrecMXWyDfhGQBCdSZZdx.jpg', '2025-03-07 04:43:01', '2025-04-11 04:36:10', '2025-04-11 04:36:10'),
('PDK3', 'Tango', 5000.00, 29, 'produk/5ltMMu42ED4lz59eWsHKy861m9rc6fpVM3OPnHhR.jpg', '2025-03-07 04:43:01', '2025-04-10 23:14:54', NULL),
('PDK4', 'Aqua', 4000.00, 67, 'produk/AFwtCLb6vupt9A9c3PzAoqamwXjCxDs13gilbl66.jpg', '2025-03-07 04:43:01', '2025-04-10 23:15:05', NULL),
('PDK5', 'Gery Malkist', 6000.00, 13, 'produk/qP9pIknuKvblMpvDgg5VsRdySwel0MvW76pTD69j.jpg', '2025-03-07 04:43:01', '2025-04-10 23:15:17', NULL),
('PDK6', 'Nabati', 4000.00, 39, 'produk/XgzQvMWpw5rzS9AVOydDGzsHTUQHstYzHsI94EYO.jpg', '2025-03-07 04:43:01', '2025-04-10 23:15:30', NULL),
('PDK7', 'Teh Pucuk Harum', 3000.00, 50, 'produk/Ls2tkhkIMfdLslpONsmkOrw5BSVhh3gtXXuj5EDD.jpg', '2025-03-07 04:43:01', '2025-04-10 23:15:42', NULL),
('PDK8', 'Chitato', 9900.00, 22, 'produk/CRzX8Pe6M14X3SOAWttNlOZlTrkvVDs016LEnhYh.jpg', '2025-03-07 04:43:01', '2025-04-10 23:15:52', NULL),
('PDK9', 'Fruit Tea', 3500.00, 45, 'produk/I1UqWi2xwlcnvLOi4kBxUCVe29eRGk71J0ykdDjH.jpg', '2025-03-07 04:43:01', '2025-04-10 23:16:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0mmPkgM99Fpz0pKVBeRd0ZmaKEsXTYIlvD5Etuwq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazM4MHFrWDVxY0VBTjIyS25iMldBbDVvWlRBdW1BWXl2Y0NSWjhNSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371377),
('509G1i5JQBEGAWKcPvc1rdNc7ZAekslau35miJlf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlJtVGdIcDUxUmlYejlVZjdGenM0d1k1UWZaYTNKelpkdUx1akxpdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372822),
('6TQsS1et0dYmL6gxgS2fLbwZoIqbRrWzNsxKBA5K', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2hPQUhFWVlxMVllWW4wNEpkaTJrcTl1V2FTWHY0d00xSEduQ1pDViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371917),
('6wDenSJM3piS5XLXxxy13Jfg1BAyBW5oQRIbweez', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3AxcXZWbU5TVElGdnhuYWt5TUJoVjcxanVQUDdUVmoyTkwwaUJYNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371350),
('7MHQZr0Re9zM01g4t7kk8D4fyPv7qIUgYxw2DUb2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3ZOaG50QVJLbFBXekJiNVNlYnJZTHRuYmpCNFp1bzlxbVVpMzhFcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371965),
('9WG3QO0qnZj9Ww6FiAX3MBjps6ercVl0nM6R7aIM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzJGRFJ0Y2dTZ1ZrRmFZYTJobzRibTh4SzZEZmdadTd1R0Y1Q21yVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372821),
('9xWiBGY5ctkrc4UGt5S8k4NBcxXOd71t2H1y739b', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2pxYkROblFtQlA3UlJxakRBWEh4YTFDenpOSWNURVZKMGEzd0lLcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372031),
('a3P96mtpDrQS0DLlgpxkt1J4yl4SXTarGaCNgTIW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1h4dmJ2Y05LeHFHZUkxNll5aG84djZJdjgxZ2g2OGZDejdQOWVjbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371966),
('A7erW3R02ujhWprGBp8sZH7Gx0qYRhLn1eg5OWLY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1lUbUJYVGxDcFZCUVc3cDJEQVIyWFBNZkdaYXdZT2hWNzZUQ1JTSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372866),
('aJH5fvXPkKUbPZwDaLvUX2BE0t0ceUOVLTPsMX0r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHBpR0swcmZUR2dLRFZVS3BuU2MzYkVqWTRoQXRqRHdHSGNHcU44YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372239),
('BDKtLxHscBbcGGSmD21duxqzgVaSMjjb4zVorObP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDl4dHhVQzRxQjNoOThjUWVuanVvQlU2Y2ZIMzZpY2hzZHdkQXhPSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371392),
('BdXE3BttfGE6IArCfbEDndNkayOUbYLGUh2ehQFm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWtFUHBvU3R5aTdPS0dSYTVMYnFOMmhzTkViVWkyb0NDSWV1OFEzNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371378),
('bq0Zi2ohIAv5kSheNtJDg8YNQ2vpfFcoRW7Rse0R', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXFuRVhVWmRMOVlsNDVPVTVyWFMzOGs4MUJBNnZFMUd1eVhoWGlpSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371622),
('CU99DNDmmYB6IMKbAnXHMaAi2jVvomitIQQTbsgW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid21pOXlkNDVxckpQVkpEWlNBd3k0aGoxS2tOaUN5SWVNOGdaNWpBQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744432001),
('deNHEbUMtwdXcfabpXLcwFebbHTee9NfiUVemvHX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUdJMFF4aElhQ1dmOFFkMExNTk45M0xyTWpqbGcxOGdhR3htRG5kYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371398),
('E6Lye40Wu0c6yH0uRzBELWVDsf26g5bOKj9Hhqc3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2REOUtza0Z3bzh4a3RJNkIzQ3dyUWJYUXZ3a0Z5N2g4a2djV282NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371373),
('EUmORVwhLsoLBrdoYpDcUWDdEtk885V8NbsoJDlc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaE40QjdIdGFEd1JFd0Z3cmdNMnFOdXJWV3BlTFVOSER1OTY0YTJiZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372958),
('fHrMJZx338fJkwZKdJR7Kreagb9w61QWobJimGFS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFFEdUlyWURNNUZyd1hFNjV4eTVjamw4VEdCbGFZZlFJeWxEVkY4cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372060),
('FNe7qHg2s2X2AzyQ9AyWGkMLWPIK8FNeiNrcybpy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2U2WWxBaGhmRkNWUnVrRUVNMFJhbExVWnhGQjhvQXhPRExJYlE3UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372774),
('foF1d4l2otVcHdfbPE89j7kQ9Y4BuW77yxNgONdA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1c0ajU5WW5XdFN2WUt4OWdNaVBXT1RkblFBd3VOdEFLWnZRRmlDRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372239),
('FQaagsbZDE18ZiOMIYpxnQfRtzPKx3N00qt5Qdoo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGZzWWNGVjM0TXVFWnNwdUdkelM4ekRDbnJsZkY0QndRVFVmV3pTQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371373),
('fx7jwwN4Yu3cXslRvV9RRKkx7sPl8jilW5KOiy4R', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHNHTjlYUXJ4blphVlVBamtRUXhEbzNKOFFlU1NTQ1lsRWtPZDNpeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371682),
('FZa4h2Ej2jOv6pve7FVOjhPyWmFR5u9ct05GR4X3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnhxcE1BNGZhbmhvamN2MUIzakN0REk2Q3pqZFZnTHQ5MnJxeG5BSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371395),
('Gh3gczQnyRBmHT49x56HezsfW3lCBDVG2CSWPI0R', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlE1bDlvM3pkTU1ZeFc2dzlUVDQ0bzRsOUhkOG1NMjVoTmJPSHlqViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372246),
('GLmo3LxMzvplF5EGV2NsR80HG5oc45x06Y3bKgYa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmd6MjdHQmM4VHl0UVRsc1o4N0Z4cGxuWkpLd0czWTJHS1BuN3ZkUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744432001),
('GXt7Le1WAhgCBND6RD38lpXF2OC7Phti5ISoDjiD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUVJTlFRQWpaZXJxMEUwYWlMaW9pNWVSMTliQXdNa1hrOWwxa2htUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372472),
('hcyRcpmfwfIM3CayOFzDi4czFRHWrWnrDQqx3LkZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXNMdWxhd0IzZHVpb09keVpVd3U2dDhJQWFLS3Y5ZW1nRUlKOXlVeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371681),
('I6uwHndMvx5397pKd4yJmV9prKXbZLC19Z8AFtTP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDJJdDVBMkZwS0ZVeUhoeEtTc2FhcEJvR0p2aXdBcjV0M2NxbFMyeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371623),
('IEIkiAnifKvQNWobYeIzb5vPJrNv0DbxUnvKac8b', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEwwWnJEY0l0Sm56VzRYa2FUVzVMbVd0ZDRkSjRocHdpVnNNVDlKdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371395),
('Iwo2imsjbvwGVvmQ18DHWaxvrAeEqR3Nl11umq3Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDdkNk54STgyeWdQb0xEc0pTNlpSWEtLOURPWlhPWFNoM2VWRHRUdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371362),
('JuPLIgPRpXGinXHuN10niPc6ctTV7uBetxhr2muy', 'USR3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTm44a0h2dWxRbFFGMWhqdUVLNklCT1NsMHRCUmdaOVlDeW96RUFDRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1iZWxpYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czo0OiJVU1IzIjt9', 1744372956),
('kBnfsRPHNbkkoi8a7KvRwteaaLEoD79S0aPNa4VU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzd1cWx5MDU4ZWZMZEdia05xZVlDWUN6Mlp3UFRKMnJZRnpYUk5EeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744432096),
('KDi58YMiILXx5UVvpdsJfo1u2lsgKbpgxQ4AdgAv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVQwNjZxaXoyWW1zVGM3M2F2WDJhU0JVU3hFVFBjQWJkdDduOGk2WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371349),
('KiG8So2KbJFF9oxjYKHETztf0WUp4AuYZSyh5tNL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXhoSGR1WkVCNWJYZjV1WkR4SHpEVnZRa1FyRVRDTHFsVktaZE9wTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372773),
('mVaPsCz2YyvEXEFCCRMKDoid0vwPvte2XEW8hXQv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVdJT05nNmR5QVgybFhPcjB3VkJWbTc3aHg5U0IzOFlsRXJOaGFkRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372031),
('oasBU01L3AzZS1Z4G0SjJXaqkLFaTwA5O1bCF0wc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHZTODJTSG9JUm9YTnZpMVhrWU9SNXRUWTZaU3U3ejFkNFY4cHUxSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371588),
('PDdLhTsuXtCivwPsgozTsI0Py1ooNYfbV1IOjYSP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMllhbTVyVmhJbUx5Y2FseGVXVnR3c1dUUzRlNmtOYzYxT3Q1azZiaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371428),
('q80mi4OxJl6K7zPL5v7BAlXmSmW2hT8D04r2sGMU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVpvWldCQzBCZDZRYlY2Qm5SOHU1MVNtQkozYzhwQ0hhaUpmNjlJMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371954),
('qQtbfWQgfunX8bA50yZZIhPszlbGtuFDOm8AhK4G', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVp1dzJwVk9TRlljQ3htMWV4WFg3SkMzRlN2emlwODF6dmNaYkxDciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372247),
('QWBq3b6v36FLqj439dBiHpngFHZRwIXlzFRKEhIB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVG9HcWtYbnpqbHhGeGNDWVhRTFpSYklkM2F1ZmtRSE9oRnJ0cGtCWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744432095),
('suB945SY666HPua55xUsrtgLpcDkl9E2DSls1i1x', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUU3VG44QzJYTkJZdDhaMDhuRXRpZVY4NzNlY1J1eVpUbTFPbERtUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371362),
('SWbCscfbNR2LkbEkIUcd3J6HQnvskfNTmt0xqlYn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEhGUjhLb2pJWk5jWHRwSnRYUjhEZVhlaFM0czBSSVE5TVZDTlhUcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371955),
('T2hoSzj2NvNuuPWQNGyjzfIHfkxDecUszjxhPatR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmVsQzVlbThwUkZhZjRjcm9OaE1uZHh2OGhhRmtPM1ZyQzJWN0dNZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372959),
('TglafsoRZuTJM4dMpt19KWFA3x3vhNp5Hd4YzWyj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicENQdW12elJwNWk1dEZ1Z0VJckJ5TGtndHFqRG1FamRCb1BmN3MwYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371392),
('TYHzwMwaaLQ4OtfwBafpTVpcJk45sUjhiUQcDKUA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWRnbHZnbGNnZzd6SXpHUjhuSEM2QVozUzFqZENkWmRPbTduWnJQZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371399),
('U7HBMPkC0dOyDAcinosSGksGiM2vL014Vv73kMr3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVJOQmRLc1AyS3BGT3QwU0laOG5KaERVaUJBNGJwZzZqRFhZWUhwbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371386),
('UuB9sSTcWf4mII67jkCwQ5rMe6cFA6jMnFxVqrV4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM296Rjk1NHZnSXBRaEpwcnF1Tmt3aWtWdGFBY0NEN3VyUmNsSTgwVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372867),
('vBxilEOkHYXlGqbE78y6BghevxO1potYf62et9qi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2tqTmdlb1VsNlU1WW16VWtoQWhYUWJLYkNPb2E1Umc2blRiQ3F0SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372471),
('VEAt06pqgqlzcoTgvt1aoNooLiVWuj2SBlh0mQTb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT05CdnRjQnk3QnBEU3V4dGtySXRXZHBReTBNRzFRNVF6bWhFNHRpdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372244),
('VFvVAe60bKRg3vBFk0900sG8fAjSYtE6pWt2hr5f', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjhYNVAwaHBwdUNLV1lRVjg0REprZTI2a0hnNTZITXNhT0ZyanoySSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371547),
('VnUUKSBVNGsLtxsEgrseY4E4AVGFHB3sBTwJqd5y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVprc1NOR3M5UDlyS1ZTMEJVQjlOWTF4R0U3UTlPUHd5dm50Q3JZZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371356),
('WPM8zGXhmtJkjX3e0t6k9zkNro6zlUSLAtB0Cfdl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2dIUHhqc0NneTJLU2pUb2h5RWNWblZrRHBOeDhwZ010cUc0WWtjQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372243),
('WTGAGUP3GZjNkJnKTUtRVnSbmAnqjsMRnIu0RfLp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDdBd3B2SllaV3kwcnhUS1dWcGJkSVIycTVtZ1BjNWNmU0czUTQxayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371588),
('wXrAaAixYesA0IkMMt6IN2rFyDDka8UKbEhnodaf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlVyaExaaDNxa3pqRnJMMFZDQUZVWWhBcW5CRzdBbm1JYXBEcGVUTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371917),
('X6i4E7M05Nicq1DEZCjms3jODlnkGWNsu8wUeex1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic09PZzBTVHk1aGFOZFRFWkdUaFp2cVRJZ1pLeDNsM1ZWOTVydVZHSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371548),
('x7OyvGO6KOs5u21nrFnVq9ObeDhunQhQSoOFSI2r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2NzTUNDdWJlSWwxUTI4V3FCajFmSWJXYzN3RVhzbVJUNXIzSjlzeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371386),
('Xr7FDbU1IH9IdqQCACW1KsDAxct48ltsnqjNpsG3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFZCN1l1R1FUN3lNZURIUDlxNnhKelFyNXlvVnU5NVpSV256eHI1WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744372059),
('xSIrpQTJTFyNlxuhSXxv8T8kuXWssLQF5M24ftSs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicG0yOFZpWjRPRjBhYnJ1cWZIQ1FuZXpMVmtvamxFV2JvbUEzdHJxUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371356),
('YiY9k2tp2N6uWVcHEAgghjKrNkVNsxo2N5CVn4KC', 'USR3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSlFlSUJqb3RLaVdIQU12YWR0d3VnaDJIWjVYR0tzZ1g2Nm5PRGlFTSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbWJlbGlhbiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGVtYmVsaWFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6NDoiVVNSMyI7fQ==', 1744432093),
('zliQG6gbrjY50OovufGcl0p7eHaGW6hxnyFdrCWB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzk0a2pIRE91a2xjeFR1MVJVTDE5M1lndHY2cXIxeUM4NUJGektQdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744371428);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nama_lengkap`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
('USR1', 'admin', 'admin@gmail.com', '$2y$12$3Td/ViLVKS6ZQHihjr04T.ZYAgh4XlMZCzOHmh0XLb4yrnAqp1v86', 'Admin', 'admin', NULL, 'juuWIVytkTyydLXX9KiNZ3ScmDukE9lFJeEsXspPC4cYANmW9HvHKYZnPJgr', '2025-03-07 04:43:01', '2025-03-07 04:43:01'),
('USR2', 'zimam', 'zimam@gmail.com', '$2y$12$pRnvSZulN4pI8hgzhW/RwuC4qShLfSIlZ5fD0fLrYWrKCb4BXR6yO', 'Zimam Khoirul Irsad', 'admin', NULL, NULL, '2025-03-07 05:01:03', '2025-03-09 07:19:48'),
('USR3', 'kasir', 'kasir@gmail.com', '$2y$12$z9DSaWZYqHkie7xnEbWmIugpF3e.0HsgSoqyGki3TxqsOuJ6hKKSK', 'Petugas', 'petugas', NULL, NULL, '2025-03-07 23:34:26', '2025-04-02 10:11:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`) USING BTREE;

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`) USING BTREE;

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `detail_penjualan_penjualan_id_foreign` (`penjualan_id`) USING BTREE,
  ADD KEY `detail_penjualan_produk_id_foreign` (`produk_id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `jobs_queue_index` (`queue`) USING BTREE;

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `penjualan_pelanggan_id_foreign` (`pelanggan_id`) USING BTREE,
  ADD KEY `penjualan_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `point_settings`
--
ALTER TABLE `point_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `sessions_user_id_index` (`user_id`) USING BTREE,
  ADD KEY `sessions_last_activity_index` (`last_activity`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `point_settings`
--
ALTER TABLE `point_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  ADD CONSTRAINT `detail_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
