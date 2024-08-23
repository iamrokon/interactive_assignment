-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2024 at 03:09 PM
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
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `amount` bigint NOT NULL,
  `type` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `user_id`, `amount`, `type`, `time`) VALUES
(1, 2, 650, 'balance', '2024-08-23 14:27:50'),
(2, 2, 650, 'balance', '2024-08-23 14:27:55'),
(3, 2, 650, 'balance', '2024-08-23 14:28:16'),
(4, 4, 1050, 'balance', '2024-08-23 14:28:23'),
(5, 3, 600, 'balance', '2024-08-23 14:28:33'),
(6, 3, 600, 'balance', '2024-08-23 14:28:54'),
(7, 3, 600, 'balance', '2024-08-23 14:29:00'),
(8, 4, 1050, 'balance', '2024-08-23 14:29:35'),
(9, 4, 1050, 'balance', '2024-08-23 14:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `amount` bigint NOT NULL,
  `type` varchar(50) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `type`, `time`) VALUES
(1, 2, 400, 'cashin', '2024-08-23'),
(2, 2, 200, 'cashout', '2024-08-23'),
(3, 2, 600, 'cashin', '2024-08-23'),
(4, 3, 800, 'cashin', '2024-08-23'),
(5, 3, 100, 'cashout', '2024-08-23'),
(6, 4, 900, 'cashin', '2024-08-23'),
(7, 4, 100, 'cashout', '2024-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `amount` bigint NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `user_id`, `amount`, `email`, `type`, `time`) VALUES
(1, 2, 100, 'jashim@gmail.com', 'transfer', '2024-08-23'),
(2, 2, 200, 'razon@gmail.com', 'transfer', '2024-08-23'),
(3, 3, 300, 'jashim@gmail.com', 'transfer', '2024-08-23'),
(4, 4, 150, 'mamun@gmail.com', 'transfer', '2024-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `slug` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `slug`, `type`) VALUES
(1, 'Rokon', 'rokon@gmail.com', '$2y$10$eYCterfSQ4m.0CjpH65EE.v0nOIk/c4a2Lp1DB06zNAzAhOlvBuza', 'R', 'admin'),
(2, 'Mamun', 'mamun@gmail.com', '$2y$10$2KP9.JkMfzdd3urPaF8x8uQe8JALJ745KIpllLh54AUjRgDk5yYJu', 'M', 'customer'),
(3, 'Razon', 'razon@gmail.com', '$2y$10$hA8bemDSdfxaO2eGgLCXWOqHCcJuSvGy8FMgYsoTM67eLJjbVJqmW', 'R', 'customer'),
(4, 'Jashim', 'jashim@gmail.com', '$2y$10$tMYeJGynSmbtRNL0wlaGOON2A2.bxAt6Aa7W7tsaailBDihui.zJu', 'J', 'customer');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_transactions`
-- (See below for the actual view)
--
CREATE TABLE `v_transactions` (
`amount` bigint
,`id` int
,`time` date
,`type` varchar(50)
,`user_id` bigint
,`user_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_transfer`
-- (See below for the actual view)
--
CREATE TABLE `v_transfer` (
`amount` bigint
,`id` int
,`receiver_email` varchar(100)
,`receiver_name` varchar(100)
,`sender_email` varchar(100)
,`sender_name` varchar(100)
,`time` date
);

-- --------------------------------------------------------

--
-- Structure for view `v_transactions`
--
DROP TABLE IF EXISTS `v_transactions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transactions`  AS SELECT `transactions`.`id` AS `id`, `transactions`.`user_id` AS `user_id`, `transactions`.`amount` AS `amount`, `transactions`.`type` AS `type`, `transactions`.`time` AS `time`, `users`.`name` AS `user_name` FROM (`transactions` left join `users` on((`users`.`id` = `transactions`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_transfer`
--
DROP TABLE IF EXISTS `v_transfer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transfer`  AS SELECT `transfers`.`id` AS `id`, `sender`.`name` AS `sender_name`, `sender`.`email` AS `sender_email`, `transfers`.`amount` AS `amount`, `receiver`.`name` AS `receiver_name`, `transfers`.`email` AS `receiver_email`, `transfers`.`time` AS `time` FROM ((`transfers` left join `users` `sender` on((`transfers`.`user_id` = `sender`.`id`))) left join `users` `receiver` on((`transfers`.`email` = `receiver`.`email`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
