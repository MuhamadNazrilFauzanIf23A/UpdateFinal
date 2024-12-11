-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2024 at 01:23 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zahrarental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email_or_phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `role` enum('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email_or_phone`, `password`, `created_at`, `role`) VALUES
(1, 'admin15@gmail.com', '$2y$10$d1mF/OmqdVH6x/E9TypCEuizImP7HQFYhVxE.v.M5uQ2ZPPko28sK', '2024-12-06 17:56:34', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tempat_tinggal` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_transfer` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listmobil`
--

CREATE TABLE `listmobil` (
  `id_mobil` int NOT NULL,
  `foto_mobil` text NOT NULL,
  `nama_mobil` varchar(255) NOT NULL,
  `deskripsi_mobil` varchar(255) NOT NULL,
  `harga_sewa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `listmobil`
--

INSERT INTO `listmobil` (`id_mobil`, `foto_mobil`, `nama_mobil`, `deskripsi_mobil`, `harga_sewa`) VALUES
(1, 'carsss.jpg', 'Agya', 'Pepe', '200k');

-- --------------------------------------------------------

--
-- Table structure for table `list_mobil`
--

CREATE TABLE `list_mobil` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expires_at`) VALUES
(1, 1, '5c09b98bf98fcc039f2315cc733bc6d1bb71be4cf97fe518b869ba74eca9fa660724d21b3b012e36f3a521a097d12d8b6222', '2024-12-10 06:44:46'),
(2, 5, 'e304ff7f88a5562ab38c3d50ad2b18b9b0f53c635da3dc303b450c7baf39340b092f33a78fd203086d8fb2502d2eb1a3bdf2', '2024-12-10 06:48:58'),
(3, 4, 'dda2f2284052cedc36ebd8ffe9b9a19f1ed05a7ee9c65545bcf5af883ed4c1fb9fcff5dbb92aba2cda719cfc1163fc867687', '2024-12-10 06:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email_or_phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_or_phone`, `password`, `created_at`, `role`) VALUES
(1, 'ghianpratama646@gmail.com', '$2y$10$uAiS4oQWN8SJcgdg22.ulOq1owL4vZB/gLWzZ1TMnI6PnjL7lkn.G', '2024-12-04 03:24:38', 'user'),
(3, 'fauzan', '$2y$10$ry/T5zw05UnLifgnGPc.I.yZlFaddNSsgaKODG31JdsxQrqvGZ5P.', '2024-12-04 04:18:15', 'user'),
(4, 'nazrilfauzan15@gmail.com', '$2y$10$8Xiukz8rHjnf.vYElv38IuL5CX1oUAUcfX6JJ5FtTHPI.mhWlz1fS', '2024-12-04 04:37:22', 'user'),
(5, 'test@gmail.com', '$2y$10$RUHQnPIlnmkv97utaG6uFOo8XiRthVb0HqvhuzIJExMN3o.VgzS7G', '2024-12-06 10:07:12', 'user'),
(6, 'apdppdp', '$2y$10$1hYXtN0kYeeTeKXo9pn/jen5TK0VHzML9w/6TCYkplBPOt5kv.CcW', '2024-12-10 05:29:12', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listmobil`
--
ALTER TABLE `listmobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `list_mobil`
--
ALTER TABLE `list_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listmobil`
--
ALTER TABLE `listmobil`
  MODIFY `id_mobil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `list_mobil`
--
ALTER TABLE `list_mobil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
