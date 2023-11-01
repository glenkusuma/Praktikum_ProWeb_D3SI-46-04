-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS blog_database;
USE blog_database;

-- Create the `posts` table
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`title`, `subtitle`, `content`, `image`, `slug`, `created_at`, `updated_at`) VALUES
('Mengenal Dasar-Dasar Pemrograman Web', 'Pengantar Pemrograman Web', 'Pemrograman web adalah bidang yang menarik yang melibatkan pembuatan situs web dan aplikasi web. Dalam artikel ini, kami akan memperkenalkan konsep dasar dalam pemrograman web.', 'https://picsum.photos/1200/300', 'dasar-pemrograman-web', NOW(), NOW()),
('Memulai Belajar PHP: Panduan Pemula', 'Pemrograman PHP dari Nol', 'PHP adalah bahasa pemrograman yang sangat populer dalam pengembangan web. Dalam artikel ini, kita akan memulai belajar PHP dari nol dan memahami konsep dasarnya.', 'gambar2.jpg', 'https://picsum.photos/1200/300', NOW(), NOW()),
('Menggunakan MySQL dengan PHP untuk Database Web', 'Pengembangan Aplikasi Web dengan PHP dan MySQL', 'Penggunaan database adalah bagian penting dalam pengembangan web. Di artikel ini, kita akan belajar cara menggunakan MySQL dengan PHP untuk mengelola data dalam aplikasi web.', 'https://picsum.photos/1200/300', 'mysql-dengan-php', NOW(), NOW());