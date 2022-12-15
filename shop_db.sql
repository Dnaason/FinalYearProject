-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 14, 2022 at 08:52 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(8, 32, 'naason', 'naason@gmail.com', '0783827435', 'hi put some thing here'),
(9, 33, 'niyonkuru', 'niyo@gmail.com', '987654', 'hi how are u');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(12, 33, 'Muhire', '0783827435', 'muhire@gmail.com', 'cash on delivery', 'flat no. kicukiro kicukiro kicukiro kagarama Rwanda - 123445', ', imboga ( 1 )', 700, '04-Dec-2022', 'completed'),
(13, 33, 'Muhire', '0783827435', 'muhire@gmail.com', 'cash on delivery', 'flat no. kicukiro kicukiro kicukiro kagarama Rwanda - 123445', ', Tomato ( 3 ), Apple ( 4 )', 1500, '05-Dec-2022', 'pending'),
(14, 33, 'Zawadi', '0987654', 'zawadi@gmail.com', 'cash on delivery', 'flat no. Kigali kjh Kanome ga Rwanda - 5687', ', Apple ( 1 )', 300, '05-Dec-2022', 'completed'),
(15, 33, 'Niyonkura Naason', '87654567', 'niyonkuru@gmail.com', 'cash on delivery', 'flat no. Rulingo kk88 Bushenyi Nyirangarama Rd - 7654', ', Banana ( 6 ), Apple ( 1 ), Carrot ( 1 )', 9000, '05-Dec-2022', 'completed'),
(16, 36, 'mugisha', '078382345', 'mugisha@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 234', ', rice ( 43 )', 55900, '14-Dec-2022', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `farmer_id` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `farmer_id`, `name`, `category`, `quantity`, `details`, `price`, `image`) VALUES
(31, '', 'Beans', 'Food Crops', '210', 'fresh beans', 1000, 'pngegg (8).png'),
(32, '', 'Sweet Potatoes', 'Food Crops', '410', 'Sweet Potatoes', 300, 'pngegg (16).png'),
(33, '', 'rice', 'Cash Crops', '213', 'rice ', 1300, 'pngegg (5).png'),
(34, '35', 'Casava plants', 'Cash Crops', '320', 'casava plant', 400, 'pngegg (14).png'),
(35, '35', 'maize', 'Food Crops', '32', 'maize', 300, 'pngegg (6).png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `district` varchar(35) DEFAULT NULL,
  `sector` varchar(35) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `state`, `district`, `sector`, `password`, `user_type`, `image`) VALUES
(32, 'naason', 'naason@gmail.com', '', '', NULL, NULL, 'ed735d55415bee976b771989be8f7005', 'admin', 'cabbage.png'),
(33, 'Muhire', 'muhire@gmail.com', '', '', NULL, NULL, 'e9ca8852f856464e40f1065117e44991', 'user', 'pic-4.png'),
(34, 'Mukunzi', 'yannick@gmail.com', '', '', NULL, NULL, '911f6332e7f90b94b87f15377263995c', 'user', 'orange.png'),
(35, 'hono', 'hono@gmail.com', '', '', NULL, NULL, 'cf22a160789a91dd5f737cd3b2640cc2', 'farmer', 'blue grapes.png'),
(36, 'mugisha', 'mugisha@gmail.com', '078382723', 'Kigali', 'Nyarugenge', 'Muhima', '89aa4b196b48c8a13a6549bb1eaebd80', 'user', 'strawberry.png');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
