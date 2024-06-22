-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 06:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `item_price` bigint(20) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `status` enum('unpaid','paid') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Food & Drink', '2024-06-19 20:35:55', '2024-06-19 20:35:55'),
(2, 'Man Fashion', '2024-06-19 20:38:11', '2024-06-19 20:38:11'),
(3, 'Woman Fashion', '2024-06-19 20:38:21', '2024-06-19 20:38:21'),
(4, 'Beauty & Cosmetics', '2024-06-19 20:39:15', '2024-06-19 20:39:15'),
(7, 'Electronics', '2024-06-19 21:01:47', '2024-06-19 21:01:47'),
(8, 'Other Goods', '2024-06-20 00:02:59', '2024-06-20 00:02:59');

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
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2024_06_19_031720_create_products_table', 1),
(26, '2024_06_19_032352_create_categories_table', 1),
(27, '2024_06_19_032454_create_orders_table', 1),
(28, '2024_06_19_033233_create_carts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `status` enum('unpaid','paid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `category_id` smallint(6) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_desc`, `product_image`, `price`, `category_id`, `stock`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Zippo Lighter', 'A high-quality zippo lighter for your best ciggaretes', 'WWWyPFVw1CEyzTQbUZwA.jpeg', 12500, 8, 200, 1, '2024-06-19 22:15:09', '2024-06-22 09:13:08', NULL),
(3, 'Minyak Bimoli', 'Produk minyak bimoli dengan variant 500ml', 'cfXfdh6E3yfbz6FPwUVV.jpeg', 7000, 8, 14, 1, '2024-06-20 00:03:51', '2024-06-22 03:45:36', NULL),
(4, 'Kye Probiotics', 'Kye Probiotics Cleansing Water Jeju Tea Tree 200mL', 'tWUqLNhp8PPRhW0ClrFu.jpg', 29900, 4, 18, 1, '2024-06-20 03:20:54', '2024-06-22 04:46:25', NULL),
(5, 'Hanasui Body Spa', 'Hanasui Body Spa Exfoliating Gel Lemon 300mL', 'J6O66vgE2NGx0aZ5AEYa.jpg', 27500, 4, 23, 1, '2024-06-20 03:22:06', '2024-06-20 05:17:55', NULL),
(6, 'Kenmaster Raket Nyamuk', 'Kenmaster Raket Nyamuk+Sentered+Blue Light', 'oRpQNzbVuwlJznvFyZM0.jpg', 71500, 7, 15, 1, '2024-06-20 03:23:23', '2024-06-22 09:26:17', NULL),
(7, 'Kit Detailer Spray', 'Kit Detailer Spray 200Ml', 'rIlm7pP6zn0cRZmWj121.jpg', 30000, 8, 27, 1, '2024-06-20 03:25:28', '2024-06-20 05:18:24', NULL),
(8, 'Default Product', 'Default Product', 'hQ4tx81zdbTaP9sQS0DM.png', 99999, 1, 0, 0, '2024-06-20 05:00:59', '2024-06-22 09:24:32', NULL),
(9, 'Plastik', 'awokdkaowdkowak', 'X69W6CNOOfvsGHGn2DjI.png', 2312312, NULL, 12312, 1, '2024-06-22 09:25:34', '2024-06-22 09:25:39', '2024-06-22 09:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('administrator','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `address`, `phone`, `email_verified_at`, `password`, `roles`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin', 'admin@emart.com', 'Babadan Yogyakarta', '085900066448', NULL, '$2y$12$M4b1mHnlU5qph/42biIBNOlCwzB/6/kLAy/P6OyEm/kXhvKmnYHwG', 'administrator', NULL, NULL, NULL, NULL),
(2, 'Jonathan', 'Joe', 'jo.jonathan@gmail.com', 'Jl Parangtritis km 11, Bantul, Yogyakarta', '1234123', NULL, '$2y$12$c5zDUaW5fS1l2dB0Nr9.fe4.dKR1glooXXsWKPjGjLh10zEMSQp.2', 'user', NULL, '2024-06-19 00:33:11', '2024-06-19 20:52:37', '2024-06-19 20:52:37'),
(3, 'Josehp', 'Takapaha', 'irwanbtc171@gmail.com', 'Jl Parangtritis km 11, Bantul, Yogyakarta', '1234567', NULL, '$2y$12$wcn0d5jhy2l8CyZaLzP3YewE/Jb84rLq9pPTD/y7DrOqfXSzqK6Ay', 'user', NULL, '2024-06-19 00:37:18', '2024-06-19 20:04:08', '2024-06-19 20:04:08'),
(4, 'John', 'Doe', 'johndoe@admin.com', 'Babadan Yogyakarta', '08123123', NULL, '$2y$12$SxODCUHKp8nNHUHuUeJcougBg1PWl2NQMulpHSBBxR2q7I01TOSsm', 'administrator', NULL, '2024-06-19 00:51:21', '2024-06-19 20:52:58', '2024-06-19 20:52:58'),
(5, 'Irwan', 'Carlo', 'irwancarlo@gmail.com', 'Jl. Diponegoro No.05, Babadan, Bantul, Kec. Bantul, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55711', '9522331123', NULL, '$2y$12$G2LOrewW62l68gF32X2ZPeZtmjBCEcCDzM5/cSdCr/6rojUu5tFTG', 'user', NULL, '2024-06-20 01:07:53', '2024-06-20 01:07:53', NULL),
(6, 'Jonathan', 'Joe', 'jonathan.joe@gmail.com', 'Santa Maria Beach St. 5, New York, USA', '08591234567', NULL, '$2y$12$Nj7UPv8mQf46Bh0ztgqXe.y79m6FBY5oBIos099y6milGlkgG0zG2', 'user', NULL, '2024-06-22 09:16:16', '2024-06-22 09:16:16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
