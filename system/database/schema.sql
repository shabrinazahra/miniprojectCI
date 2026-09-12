-- =========================================================
-- Database: db_produk
-- Aplikasi Manajemen Produk & Variasi (CodeIgniter 3)
-- =========================================================

CREATE DATABASE IF NOT EXISTS `db_produk` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_produk`;

-- ---------------------------------------------------------
-- Tabel: products
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_code` VARCHAR(50) NOT NULL,
  `product_name` VARCHAR(150) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `price` DECIMAL(15,2) NOT NULL,
  `status` ENUM('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_product_code` (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------
-- Tabel: product_colors (Warna) -> relasi ke products
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `product_colors` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` INT UNSIGNED NOT NULL,
  `color_name` VARCHAR(50) NOT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_product_id` (`product_id`),
  CONSTRAINT `fk_colors_product`
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------
-- Tabel: product_sizes (Ukuran) -> relasi ke product_colors
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `color_id` INT UNSIGNED NOT NULL,
  `size_name` VARCHAR(20) NOT NULL,
  `stock` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_color_id` (`color_id`),
  CONSTRAINT `fk_sizes_color`
    FOREIGN KEY (`color_id`) REFERENCES `product_colors` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------------
-- Data contoh (opsional)
-- ---------------------------------------------------------
INSERT INTO `products` (`product_code`, `product_name`, `category`, `price`, `status`) VALUES
('KS-001', 'Kaos Basic', 'Pakaian Pria', 75000, 'Aktif'),
('CD-002', 'Celana Denim', 'Pakaian Pria', 150000, 'Aktif');

INSERT INTO `product_colors` (`product_id`, `color_name`) VALUES
(1, 'Hitam'),
(1, 'Putih');

INSERT INTO `product_sizes` (`color_id`, `size_name`, `stock`) VALUES
(1, 'S', 10),
(1, 'M', 15),
(1, 'L', 12),
(1, 'XL', 8),
(2, 'S', 5),
(2, 'M', 9),
(2, 'L', 7);