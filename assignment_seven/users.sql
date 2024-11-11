-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2024 at 05:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barta`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Cedric', 'Ramirez', 'fewavera@mailinator.com', NULL, '$2y$12$rRb/5bt8dW10qxjWJ2kTtO0tLM5ORVobLdAWWeO2EBz3YgEogsana', NULL, '2024-11-10 02:04:15', NULL),
(2, 'Wynter', 'Hunt', 'gezec@mailinator.com', NULL, '$2y$12$lh8agKGZYWpsjnMq.bbyWef1ypYKWz2lmUdZNusQHzbJLykoIQ/V2', NULL, '2024-11-10 02:14:14', NULL),
(3, 'Dahlia', 'Delacruz', 'mymepolir@mailinator.com', NULL, '$2y$12$YLKaZNV8R35kptVQ0yceQugz4XJguKrnhiD70dNDcBpHXzS7qLni2', NULL, '2024-11-10 02:42:52', NULL),
(4, 'Ezekiel', 'Leon', 'zocyxu@mailinator.com', NULL, '$2y$12$VTU5cTVobFr6QjvXgucqzeZX5k2ty8nzztujKnS8PdDsXk7wIi2DO', NULL, '2024-11-10 02:46:17', NULL),
(5, 'Rokon', 'Pk', 'rokonuzzamancse@gmail.com', NULL, '$2y$12$8QD/wNOo9o5/2EwuANkuJ.DXg2X0bmJl0qf/pESfK/f3jbXidGQ9y', NULL, '2024-11-10 03:00:51', '2024-11-11 10:45:11'),
(6, 'Brielle', 'Oneil', 'wuji@mailinator.com', NULL, '$2y$12$xtRfIC84T.L7Fz9jEjxKc.FA3C2p/CGHYIiFe02UvF/QEOIGOebvW', NULL, '2024-11-10 11:59:20', NULL),
(7, 'Freya', 'Johnson', 'sokeloso@mailinator.com', NULL, '$2y$12$Ydv/w56NrLGZPyyGJkSpZe6diYQgYgjKKfsF.0BsziAnlkzEeQPFi', NULL, '2024-11-10 12:02:15', NULL),
(8, 'Pearl', 'Howard', 'labojuduwa@mailinator.com', NULL, '$2y$12$zI3IRBSOP2oZsmozuUqnvuwxhIHk0vrcMvfbn9B8WoD9kMWbAxOP6', NULL, '2024-11-10 12:06:36', NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
