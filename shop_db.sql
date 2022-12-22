-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2022 at 03:14 PM
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
(13, 33, 'Muhire', '0783827435', 'muhire@gmail.com', 'cash on delivery', 'flat no. kicukiro kicukiro kicukiro kagarama Rwanda - 123445', ', Tomato ( 3 ), Apple ( 4 )', 1500, '05-Dec-2022', 'completed'),
(14, 33, 'Zawadi', '0987654', 'zawadi@gmail.com', 'cash on delivery', 'flat no. Kigali kjh Kanome ga Rwanda - 5687', ', Apple ( 1 )', 300, '05-Dec-2022', 'completed'),
(15, 33, 'Niyonkura Naason', '87654567', 'niyonkuru@gmail.com', 'cash on delivery', 'flat no. Rulingo kk88 Bushenyi Nyirangarama Rd - 7654', ', Banana ( 6 ), Apple ( 1 ), Carrot ( 1 )', 9000, '05-Dec-2022', 'completed'),
(16, 36, 'mugisha', '078382345', 'mugisha@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 234', ', rice ( 43 )', 55900, '14-Dec-2022', 'completed'),
(17, 36, 'mugisha', '076543', 'mugisha@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 8765', ', Casava plants ( 6 ), maize ( 2 ), rice ( 1 )', 4300, '15-Dec-2022', 'completed'),
(18, 36, 'mugisha', '078234234', 'mugisha@gmail.com', 'credit card', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 233252', ', Sweet Potatoes ( 3 ), rice ( 5 )', 7400, '15-Dec-2022', 'completed'),
(19, 36, 'mugisha', '078765432', 'mugisha@gmail.com', 'paytm', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 87632', ', Sweet Potatoes ( 3 ), Casava plants ( 5 )', 2900, '15-Dec-2022', 'completed'),
(20, 36, 'mugisha', '07921346', 'mugisha@gmail.com', 'paytm', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 987654', ', maize ( 2 ), Casava plants ( 20 )', 8600, '15-Dec-2022', 'pending'),
(21, 36, 'Sweet Potatoes', '45554555', 'naason@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 4514', ', maize ( 2 ), Casava plants ( 20 )', 8600, '15-Dec-2022', 'completed'),
(22, 36, 'mugisha', '09876512', 'mugisha@gmail.com', 'paypal', 'flat no. kk012 gatenga kicukiro Kigali Rwanda - 098763', ', Casava plants ( 1 )', 400, '15-Dec-2022', 'pending'),
(23, 36, 'mugisha', '0987621', 'mugisha@gmail.com', 'paypal', 'flat no. kk132 gatenga kicukiro Kigali Rwanda - 124', ', maize ( 2 )', 600, '15-Dec-2022', 'pending'),
(24, 36, 'mugisha', '0677877', 'mugisha@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 12345', ', maize ( 1 ), Beans ( 78 ), rice ( 1 )', 79600, '20-Dec-2022', 'pending'),
(25, 36, 'mugisha', '12121212', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 1234', ', Beans ( 1 ), Sweet Potatoes ( 1 )', 1300, '20-Dec-2022', 'completed'),
(26, 36, 'mugisha', '122222', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 1234', ', Beans ( 11 ), Sweet Potatoes ( 1 )', 11300, '20-Dec-2022', 'completed'),
(27, 36, 'Sweet Potatoes', '12122', 'hono@gmail.com', 'cash on delivery', 'flat no. kk132 niboye kicukiro Kigali Rwanda - 1222', ', Beans ( 11 ), Sweet Potatoes ( 1 )', 11300, '20-Dec-2022', 'completed'),
(28, 36, 'mugisha', '122222', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 1234', ', Beans ( 1 ), rice ( 1 ), Casava plants ( 1 )', 2700, '20-Dec-2022', 'completed'),
(29, 36, 'mugisha', '12334443', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 niboye kicukiro Kigali Rwanda - 122', ', Beans ( 1 ), Sweet Potatoes ( 1 ), rice ( 1 ), Casava plants ( 1 ), maize ( 1 )', 3300, '20-Dec-2022', 'completed'),
(30, 36, 'Gisubizo', '078763762', 'gi@gmail.com', 'paytm', 'flat no. kk012 Cyuve Musanze South Rwanda - 123', ', maize ( 1 )', 300, '21-Dec-2022', 'completed'),
(31, 36, 'Gisubizo', '7', 'gi@gmail.com', 'cash on delivery', 'flat no. kk132 Cyuve Musanze South Rwanda - 89', ', Casava plants ( 1 )', 400, '21-Dec-2022', 'completed'),
(32, 36, 'mugisha', '1231', 'mugisha@gmail.com', 'cash on delivery', 'flat no. kk132 gatenga kicukiro South Rwanda - 123', ', Casava plants ( 1 )', 400, '21-Dec-2022', 'completed'),
(33, 36, 'blue', '324', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 Cyuve kicukiro Kigali Rwanda - 234', ', Casava plants ( 1 )', 400, '21-Dec-2022', 'completed'),
(34, 36, 'mugisha', '87654', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 niboye Musanze Kigali Rwanda - 87654', ', Sweet Potatoes ( 1 )', 300, '21-Dec-2022', 'completed'),
(35, 36, 'hono', '987654', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 Cyuve kicukiro South Rwanda - 987654', ', Beans ( 1 ), Sweet Potatoes ( 1 ), rice ( 1 ), Casava plants ( 1 ), maize ( 1 )', 3300, '21-Dec-2022', 'pending'),
(36, 36, 'mugisha', '23443', 'mugisha@gmail.com', 'cash on delivery', 'flat no. kk132 gatenga Musanze South Rwanda - 2342222', ', Sweet Potatoes ( 1 )', 300, '21-Dec-2022', 'completed'),
(37, 36, 'Gisubizo', '21', 'gi@gmail.com', 'cash on delivery', 'flat no. kk132 Cyuve Musanze South Rwanda - 233', ', maize ( 2 )', 600, '21-Dec-2022', 'pending'),
(38, 36, 'mugisha', '8765', 'gi@gmail.com', 'cash on delivery', 'flat no. kk132 gatenga Musanze South Rwanda - 4567', ', Casava plants ( 6 )', 2400, '21-Dec-2022', 'pending'),
(39, 36, 'Gisubizo', '98765', 'gi@gmail.com', 'cash on delivery', 'flat no. kk132 Cyuve Musanze South Rwanda - 4556', ', Casava plants ( 3 )', 1200, '21-Dec-2022', 'pending'),
(40, 36, 'Gisubizo', '54345', 'gi@gmail.com', 'cash on delivery', 'flat no. kk132 Cyuve Musanze South Rwanda - 876', ', maize ( 2 )', 600, '21-Dec-2022', 'pending'),
(41, 36, 'mugisha', '12222222', 'hono@gmail.com', 'cash on delivery', 'flat no. kk012 niboye Musanze Kigali Rwanda - 22222', ', Beans ( 1 ), Sweet Potatoes ( 1 ), rice ( 1 ), maize ( 1 ), Casava plants ( 1 )', 3300, '21-Dec-2022', 'pending'),
(42, 36, 'Gisubizo', '352532', 'gi@gmail.com', 'cash on delivery', 'flat no. h2837 Cyuve Musanze South Rwanda - 32', ', Casava flowers ( 10 ), maize ( 2 )', 7600, '21-Dec-2022', 'pending'),
(43, 36, 'Gisubizo', '8765', 'gi@gmail.com', 'cash on delivery', 'flat no. h2837 Cyuve Musanze South Rwanda - 687', ', Casava flowers ( 5 ), maize ( 3 )', 4400, '21-Dec-2022', 'pending');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `update status` AFTER UPDATE ON `orders` FOR EACH ROW UPDATE order_products SET status=NEW.payment_status WHERE order_id=NEW.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `opid` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `farmer_id` int(11) DEFAULT NULL,
  `status` text DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`opid`, `order_id`, `pid`, `price`, `farmer_id`, `status`) VALUES
(2, 28, 31, 1000, 35, 'completed'),
(3, 28, 33, 1300, 34, 'completed'),
(4, 28, 34, 400, 35, 'completed'),
(5, 29, 31, 1000, 35, 'completed'),
(6, 29, 32, 300, 35, 'completed'),
(7, 29, 33, 1300, 34, 'completed'),
(8, 29, 34, 400, 35, 'completed'),
(9, 29, 35, 300, 35, 'completed'),
(10, 30, 35, 300, 35, 'completed'),
(11, 31, 34, 400, 35, 'completed'),
(12, 33, 34, 400, 35, 'completed'),
(13, 34, 32, 300, 35, 'completed'),
(14, 35, 31, 1000, 35, 'pending'),
(15, 35, 32, 300, 35, 'pending'),
(16, 35, 33, 1300, 34, 'pending'),
(17, 35, 34, 400, 35, 'pending'),
(18, 35, 35, 300, 35, 'pending'),
(19, 36, 32, 300, 35, 'completed'),
(20, 37, 35, 600, 35, 'pending'),
(21, 38, 34, 2400, 35, 'pending'),
(22, 39, 34, 1200, 35, 'pending'),
(23, 40, 35, 600, 35, 'pending'),
(24, 41, 31, 1000, 35, 'pending'),
(25, 41, 32, 300, 35, 'pending'),
(26, 41, 33, 1300, 34, 'pending'),
(27, 41, 35, 300, 35, 'pending'),
(28, 41, 34, 400, 35, 'pending'),
(29, 42, 36, 7000, 37, 'pending'),
(30, 42, 35, 600, 35, 'pending'),
(31, 43, 36, 3500, 37, 'pending'),
(32, 43, 35, 900, 35, 'pending');

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
(31, '38', 'Beans', 'Food Crops', '105', 'fresh beans', 1000, 'pngegg (8).png'),
(32, '35', 'Sweet Potatoes', 'Food Crops', '402', 'Sweet Potatoes', 300, 'pngegg (16).png'),
(33, '38', 'rice', 'Cash Crops', '208', 'rice ', 1300, 'pngegg (5).png'),
(34, '35', 'Casava plants', 'Cash Crops', '29', 'casava plant', 400, 'pngegg (14).png'),
(35, '35', 'maize', 'Food Crops', '86', 'maize', 300, 'pngegg (6).png'),
(36, '37', 'Casava flowers', 'Cash Crops', '63', 'quality', 700, 'pngegg (4).png'),
(37, '37', 'Soya', 'Food Crops', '23', 'quality', 1200, 'pngegg (9).png'),
(38, '37', 'Bens', 'Food Crops', '53', 'high on quality', 500, 'pngegg (12).png');

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
(32, 'naason', 'naason@gmail.com', '0783827435', 'West', 'Nyabihu', 'Shyira', 'ed735d55415bee976b771989be8f7005', 'admin', 'cabbage.png'),
(33, 'Muhire', 'muhire@gmail.com', '0786910057', 'Kigali', 'Gasabo', 'Kacyiru', 'e9ca8852f856464e40f1065117e44991', 'user', 'pic-4.png'),
(34, 'Mukunzi', 'yannick@gmail.com', '0731658540', 'Kigali', 'Nyarugenge', 'Muhima', '911f6332e7f90b94b87f15377263995c', 'user', 'orange.png'),
(35, 'Hnorine', 'hono@gmail.com', '0787611242', 'East', 'Gisagara', 'Ndora', 'cf22a160789a91dd5f737cd3b2640cc2', 'farmer', 'orange.png'),
(36, 'mugisha', 'mugish@gmail.com', '0731658540', 'Kigali', 'Nyarugenge', 'Muhima', '89aa4b196b48c8a13a6549bb1eaebd80', 'user', 'strawberry.png'),
(37, 'Naason', 'na@gmail.com', '0731658540', 'South', 'Huye', 'Muhima', 'b5d9b59113086d3f9f9f108adaaa9ab5', 'farmer', 'broccoli.png'),
(38, 'Muhizi', 'muhizi@gmail.com', '0787611242', 'East', 'Bugesera', 'Ntarama', '967c0823cad1084501db462dca54ac1b', 'farmer', 'cauliflower.png');

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
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`opid`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `opid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
