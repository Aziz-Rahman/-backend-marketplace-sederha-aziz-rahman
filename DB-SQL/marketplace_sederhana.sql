/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 50733 (5.7.33)
 Source Host           : localhost:3306
 Source Schema         : db_marketplace_sederhana

 Target Server Type    : MySQL
 Target Server Version : 50733 (5.7.33)
 File Encoding         : 65001

 Date: 26/11/2024 16:00:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('6be76uv3dLf7PEhn', 's:7:\"forever\";', 2047961065);
INSERT INTO `cache` VALUES ('mmdQziiGV2ueQ3hQ', 's:7:\"forever\";', 2047958546);
INSERT INTO `cache` VALUES ('Yk9DfhxZlm4rjvPz', 's:7:\"forever\";', 2047956094);
INSERT INTO `cache` VALUES ('ZZiXS6VBQmPqVHSC', 's:7:\"forever\";', 2047913790);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `session_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `carts_customer_id_foreign`(`customer_id`) USING BTREE,
  INDEX `carts_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of carts
-- ----------------------------

-- ----------------------------
-- Table structure for checkouts
-- ----------------------------
DROP TABLE IF EXISTS `checkouts`;
CREATE TABLE `checkouts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_pos_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(10, 2) NOT NULL,
  `total_discount` int(11) NULL DEFAULT NULL,
  `shipping_cost` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `final_total_price` decimal(10, 2) NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of checkouts
-- ----------------------------
INSERT INTO `checkouts` VALUES (1, 4, 'Customer B', 'Jl. Kebahagiaan No.1', 'Semarang', '33344', '0898 4446 5477', 181430.00, 18143, 0.00, 163287.00, 'pending', '2024-11-26 05:54:52', '2024-11-26 05:54:52');
INSERT INTO `checkouts` VALUES (2, 4, 'Customer B', 'Jl. Kebahagiaan No.1', 'Semarang', '33344', '0898 4446 5477', 558000.00, 55800, 0.00, 502200.00, 'pending', '2024-11-26 06:03:11', '2024-11-26 06:03:11');
INSERT INTO `checkouts` VALUES (3, 2, 'Customer A', 'Jl. Kebahagiaan No.1', 'Semarang', '33344', '0898 4446 5477', 703300.00, 70330, 0.00, 632970.00, 'pending', '2024-11-26 07:41:43', '2024-11-26 07:41:43');
INSERT INTO `checkouts` VALUES (4, 5, 'Customer C', 'Jl. Kebahagiaan No.1', 'Semarang', '33344', '0898 4446 5477', 635300.00, 63530, 0.00, 571770.00, 'pending', '2024-11-26 08:33:42', '2024-11-26 08:33:42');
INSERT INTO `checkouts` VALUES (5, 6, 'Customer V', 'Jl. Kesuksesan No.99', 'Depok', '44456', '0898 5436 8888', 555444.00, 55544, 0.00, 499899.60, 'pending', '2024-11-26 08:50:54', '2024-11-26 08:50:54');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_11_05_030806_create_products_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_11_16_020620_create_carts_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_11_16_100412_create_checkout_table', 1);
INSERT INTO `migrations` VALUES (7, '2024_11_17_185100_create_order_details_table', 1);
INSERT INTO `migrations` VALUES (8, '2024_11_25_114232_create_personal_access_tokens_table', 2);

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `checkout_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `discount` int(11) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_details_checkout_id_foreign`(`checkout_id`) USING BTREE,
  INDEX `order_details_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `order_details_checkout_id_foreign` FOREIGN KEY (`checkout_id`) REFERENCES `checkouts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (1, 1, 6, NULL, 'Barang Bagus nih', 'Hehehehe hihihihii xxxxxxxxxx.', 2, 46890.00, 0, 93780.00, '2024-11-26 05:54:52', '2024-11-26 05:54:52');
INSERT INTO `order_details` VALUES (2, 1, 7, NULL, 'Barang Lucu', 'Wkwkwkwkww xxxxxxxxxx.', 1, 87650.00, 0, 87650.00, '2024-11-26 05:54:52', '2024-11-26 05:54:52');
INSERT INTO `order_details` VALUES (3, 2, 1, NULL, 'Produk 1 diubah judulnya', 'Deskripsi produk contoh 1.', 6, 93000.00, 0, 558000.00, '2024-11-26 06:03:11', '2024-11-26 06:03:11');
INSERT INTO `order_details` VALUES (4, 3, 2, NULL, 'Produk Contoh 2', 'Deskripsi produk contoh 2.', 1, 68000.00, 0, 68000.00, '2024-11-26 07:41:43', '2024-11-26 07:41:43');
INSERT INTO `order_details` VALUES (5, 3, 8, NULL, 'Barang Murah', 'Hmmmmm xxxxxxxxxx.', 2, 317650.00, 0, 635300.00, '2024-11-26 07:41:43', '2024-11-26 07:41:43');
INSERT INTO `order_details` VALUES (6, 4, 8, NULL, 'Barang Murah', 'Hmmmmm xxxxxxxxxx.', 2, 317650.00, 0, 635300.00, '2024-11-26 08:33:42', '2024-11-26 08:33:42');
INSERT INTO `order_details` VALUES (7, 5, 5, NULL, 'Produk Milik merchan xxxxxx', 'Deskripsi produk punya nswdwdi merchan xxxxxxxxxx.', 1, 555444.00, 0, 555444.00, '2024-11-26 08:50:54', '2024-11-26 08:50:54');

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `merchant_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `products_merchant_id_foreign`(`merchant_id`) USING BTREE,
  CONSTRAINT `products_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 1, NULL, 'Produk 1 diubah judulnya', 'Deskripsi produk contoh 1.', 93000, 11, '2024-11-25 12:49:41', '2024-11-26 04:00:23');
INSERT INTO `products` VALUES (2, 1, NULL, 'Produk Contoh 2', 'Deskripsi produk contoh 2.', 68000, 52, '2024-11-25 12:52:13', '2024-11-25 12:52:13');
INSERT INTO `products` VALUES (4, 1, NULL, 'Produk Milik merchan 2', 'Deskripsi produk punya nsi merchan 2.', 234900, 16, '2024-11-26 04:33:05', '2024-11-26 04:33:05');
INSERT INTO `products` VALUES (5, 3, NULL, 'Produk Milik merchan xxxxxx', 'Deskripsi produk punya nswdwdi merchan xxxxxxxxxx.', 555444, 66, '2024-11-26 04:43:09', '2024-11-26 04:43:09');
INSERT INTO `products` VALUES (6, 3, NULL, 'Barang Bagus nih', 'Hehehehe hihihihii xxxxxxxxxx.', 46890, 19, '2024-11-26 04:47:27', '2024-11-26 04:47:27');
INSERT INTO `products` VALUES (7, 3, NULL, 'Barang Lucu', 'Wkwkwkwkww xxxxxxxxxx.', 87650, 26, '2024-11-26 04:48:04', '2024-11-26 04:48:04');
INSERT INTO `products` VALUES (8, 3, NULL, 'Barang Murah', 'Hmmmmm xxxxxxxxxx.', 317650, 9, '2024-11-26 04:51:01', '2024-11-26 04:51:01');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('Ch2NCmLRRHTS51CN3XNlxqeyeFVyRWFJO1ibUpoj', NULL, '127.0.0.1', 'PostmanRuntime/7.42.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTRIczh5RDUzOXlqcm43Q29yMGEydmFmdTlLQ1pxUXIyZVhVSnFHVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6OTA5MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1732600339);
INSERT INTO `sessions` VALUES ('ubF76nLYT6ptIIDrgoctKosanegyZ4LKn8rFeOhJ', NULL, '127.0.0.1', 'PostmanRuntime/7.42.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnREc0ljb3dLWEk2aFRQR1dkZTNZenJQNTg5VTJFd1JINDdmWEhtNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6OTA5MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1732554654);
INSERT INTO `sessions` VALUES ('WLuo7YjG5h4bs6YKDEAaBgJzwVoaW4SFdL5fI0P6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmE1T1U5MWVvb3RpSDRHZHc2RklRQUw0Q1NuWUFWaHNtdVhYVDlHNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6OTA5MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1732592169);
INSERT INTO `sessions` VALUES ('YzyipXmf7DV5ABAT7zydIp4ohe3GxL4X54XEGKd5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDBRa0JyMXc5ejAzcXJveTRFM1ZhcFpWNlFEeXpLQXVCczBweTd6QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6OTA5MCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1732553310);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` enum('customer','merchant') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'merchant', 'Merchant A', 'merchant@example.com', NULL, '$2y$12$x1rGeSG.s8P7WR8UodMU8eFjhTQLv.OeVOQVE/gr/9rzkkWhZlolq', NULL, '2024-11-25 12:24:55', '2024-11-25 12:24:55');
INSERT INTO `users` VALUES (2, 'customer', 'Customer A', 'customer@example.com', NULL, '$2y$12$D71OK.p2ivYrX9pjxR8sX.dmxMsP.CCW4Q/8C7lljC3p0HTMSDuxe', NULL, '2024-11-25 12:25:57', '2024-11-25 12:25:57');
INSERT INTO `users` VALUES (3, 'merchant', 'Merchant B', 'merchant_b@example.com', NULL, '$2y$12$L3.Ud3CyTV.EXvr21G3/iue1C0ZyEg/MZbD554vsAEcRkPmKBT2v6', NULL, '2024-11-25 17:01:39', '2024-11-25 17:01:39');
INSERT INTO `users` VALUES (4, 'customer', 'Customer B', 'customer_b@example.com', NULL, '$2y$12$jMP9f/Ichh4oZGBWEnTYd.hJawBPFYjPCKXBhJznPabkeQs/0WGpW', NULL, '2024-11-25 17:02:02', '2024-11-25 17:02:02');
INSERT INTO `users` VALUES (5, 'customer', 'Customer C', 'customer_c@example.com', NULL, '$2y$12$NlocctoT51nCFXjKmLRXoucr.eKL5fDWvxhZQFUaKCAycoo7PCoq6', NULL, '2024-11-25 17:03:57', '2024-11-25 17:03:57');
INSERT INTO `users` VALUES (6, 'customer', 'Customer V', 'customer_vv@example.com', NULL, '$2y$12$OqT2PgNckeOPk6L8ayV/Hedp7Y/T42nlMVg.ZmpQGKBG7r1pO2x22', NULL, '2024-11-26 08:41:49', '2024-11-26 08:41:49');

SET FOREIGN_KEY_CHECKS = 1;
