-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 04:12 PM
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
-- Database: `batang_kalye`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_user_name`, `password`, `date`) VALUES
(7, 'adminleo', '123', '2024-06-25'),
(8, 'santillanjb', '123', '2024-06-26'),
(9, 'ultra', 'haroldvonn', '2024-06-26'),
(10, 'jere', 'delosSantos123', '2024-06-26'),
(11, 'tony', 'villmor123', '2024-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `product_name`, `price`, `order_quantity`, `image`) VALUES
(19, 10, 1, 'HOOPX Premium Jersey Set', 600, 1, NULL),
(20, 10, 1, 'HOOPX Premium Jersey Set', 600, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `user_id`, `address`, `payment`) VALUES
(53, 'trisha', 10, '123', 'cash'),
(54, 'trisha', 10, '123', 'cash'),
(55, 'trisha', 10, '123', 'cash'),
(56, 'trisha', 10, '123', 'cash'),
(57, 'trisha', 10, '123', 'cash'),
(58, 'trisha', 10, '123', 'cash'),
(59, 'trisha', 10, '123', 'cash'),
(62, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(63, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(64, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(65, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(66, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(67, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(68, 'JB Santillan', 14, '123', 'cash'),
(69, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(70, 'JB Santillan', 14, '18 Dona Josefa Ave., Dona Josefa Village, Almanza Uno, LPC', 'cash'),
(71, 'JB', 14, '18 Dona Josefa', 'cash'),
(72, 'jbimbs', 14, '18 Dona Josefa', 'cash'),
(73, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(74, 'JB Santillan', 14, '18 Dona Josefa', 'cash'),
(75, 'jbimbs', 14, '18 Dona Josefa', 'cash'),
(76, 'JB Santillan', 14, '31', 'cash'),
(77, 'Leo Louise Jimenez', 15, 'Pulang Lupa', 'cash'),
(78, 'Leo Louise Jimenez', 15, 'Pulang Lupa', 'cash'),
(79, 'Leo Louise Jimenez', 15, 'Pulang Lupa', 'cash'),
(80, 'Leo Louise Jimenez', 15, 'Pulang Lupa', 'cash'),
(81, 'Leo Louise Jimenez', 15, 'Pulang Lupa', 'cash'),
(82, 'Harold Vonn Ultra', 16, 'Paliparan', 'cash'),
(83, 'Leo Louise Jimenez', 15, 'Pulang Lupa', 'cash');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dashboard_view`
-- (See below for the actual view)
--
CREATE TABLE `dashboard_view` (
`order_id` int(11)
,`product_id` int(11)
,`product_name` varchar(255)
,`price` decimal(65,0)
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `image`, `price`, `user_id`, `date`) VALUES
(58, 1, 'admin/uploads/product1.jpg', 600, 14, '2024-06-21 15:32:35'),
(59, 2, 'admin/uploads/product2.jpg', 500, 14, '2024-06-21 16:34:28'),
(61, 13, 'admin/uploads/product9.jpg', 700, 15, '2024-06-25 15:58:02'),
(62, 8, 'admin/uploads/product4.jpg', 899, 15, '2024-06-25 15:58:02'),
(63, 1, 'admin/uploads/product1.jpg', 600, 15, '2024-06-26 06:43:33'),
(64, 21, 'admin/uploads/product6.jpg', 900, 15, '2024-06-26 06:43:33'),
(65, 20, 'admin/uploads/product10.jpg', 700, 15, '2024-06-26 06:43:38'),
(66, 20, 'admin/uploads/product10.jpg', 700, 15, '2024-06-26 06:43:43'),
(67, 11, 'admin/uploads/product7.jpg', 700, 15, '2024-06-26 06:49:41'),
(68, 9, 'admin/uploads/product5.jpg', 600, 15, '2024-06-26 06:49:41'),
(69, 13, 'admin/uploads/product9.jpg', 700, 16, '2024-06-26 06:53:34'),
(70, 12, 'admin/uploads/product8.jpg', 899, 16, '2024-06-26 06:53:35'),
(71, 1, 'admin/uploads/product1.jpg', 600, 15, '2024-10-20 06:03:49'),
(72, 7, 'admin/uploads/product3.jpg', 600, 15, '2024-10-20 06:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `image`, `product_name`, `price`, `quantity`) VALUES
(1, 'uploads/product1.jpg', 'HOOPX Premium Jersey Set', 600, 100),
(2, 'uploads/product2.jpg', 'HOOPX Jersey', 500, 99),
(7, 'uploads/product3.jpg', 'HOOPX Jersey Set \"Teal Or Cream\"', 600, 98),
(8, 'uploads/product4.jpg', 'HOOPX Custom Jersey Set (High Quality Full Sublimation)', 899, 100),
(9, 'uploads/product5.jpg', 'HOOPX \"Gucciyaya\" Mesh Shorts', 600, 100),
(11, 'uploads/product7.jpg', 'Batang Kalye \"Dorayd\" Basket Ball', 700, 100),
(12, 'uploads/product8.jpg', 'Batang Kalye Spartans \"Kalye Irving\" Jersey Set', 899, 99),
(13, 'C:/Xampp3/htdocs/BatangKalye/uploads/product9.jpg', 'HOOPX', 700, 100),
(20, 'uploads/product10.jpg', 'HOOPX Premium Jersey Set', 700, 100),
(21, 'uploads/product6.jpg', 'HOOP X', 900, 100);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sales_view`
-- (See below for the actual view)
--
CREATE TABLE `sales_view` (
`order_id` int(11)
,`product_id` int(11)
,`image` varchar(255)
,`product_name` varchar(255)
,`price` decimal(65,0)
,`customer_id` int(11)
,`customer_name` varchar(255)
,`address` varchar(255)
,`date` timestamp
,`user_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sale_view`
-- (See below for the actual view)
--
CREATE TABLE `sale_view` (
`order_id` int(11)
,`product_id` int(11)
,`product_name` varchar(255)
,`price` decimal(65,0)
,`customer_id` int(11)
,`customer_name` varchar(255)
,`address` varchar(255)
,`date` timestamp
,`image` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_id`, `user_name`, `password`, `date`) VALUES
(1, 'super_admin', '123', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` int(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `arrival` datetime NOT NULL,
  `approved` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `order_id`, `product_id`, `image`, `product_name`, `price`, `customer_id`, `customer_name`, `address`, `user_id`, `date`, `arrival`, `approved`) VALUES
(30, 58, 1, 'admin/uploads/product1.jpg', 'HOOPX Premium Jersey Set', 600, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 16:54:24', '2024-07-06 18:13:42', 'being-delivered'),
(43, 58, 1, 'admin/uploads/product1.jpg', 'HOOPX Premium Jersey Set', 600, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 16:54:35', '2024-07-06 18:54:30', 'delivered'),
(44, 59, 2, 'admin/uploads/product2.jpg', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 16:58:59', '2024-07-06 18:58:48', 'delivered'),
(45, 59, 2, '', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', NULL, '2024-06-21 17:06:33', '2024-07-06 19:06:27', 'delivered'),
(46, 59, 2, '', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', NULL, '2024-06-21 17:06:47', '2024-07-06 19:06:42', 'delivered'),
(47, 59, 2, 'admin/uploads/product2.jpg', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 17:07:44', '2024-06-28 19:07:39', 'delivered'),
(48, 59, 2, 'admin/uploads/product2.jpg', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 17:08:04', '2024-06-28 19:07:56', 'delivered'),
(54, 59, 2, 'admin/uploads/product2.jpg', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 17:16:51', '2024-06-28 19:16:39', 'delivered'),
(55, 59, 2, 'admin/uploads/product2.jpg', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 17:18:08', '2024-06-28 19:17:08', 'delivered'),
(56, 59, 2, 'admin/uploads/product2.jpg', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 17:18:38', '2024-06-28 19:18:16', 'delivered'),
(57, 58, 1, 'admin/uploads/product1.jpg', 'HOOPX Premium Jersey Set', 600, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-21 17:35:56', '2024-06-28 19:18:20', 'being-delivered'),
(58, 62, 8, 'admin/uploads/product4.jpg', 'HOOPX Custom Jersey Set (High Quality Full Sublimation)', 899, 77, 'Leo Louise Jimenez', 'Pulang Lupa', 15, '2024-06-25 15:58:02', '2024-07-02 18:20:31', 'approved'),
(59, 61, 13, 'admin/uploads/product9.jpg', 'HOOPX', 700, 77, 'Leo Louise Jimenez', 'Pulang Lupa', 15, '2024-06-25 16:46:25', '2024-07-02 18:20:36', 'delivered'),
(60, 61, 13, 'admin/uploads/product9.jpg', 'HOOPX', 700, 77, 'Leo Louise Jimenez', 'Pulang Lupa', 15, '2024-06-25 15:58:02', '2024-07-02 18:55:58', 'approved'),
(61, 59, 2, 'admin/uploads/product2.jpg', 'HOOPX Jersey', 500, 62, 'JB Santillan', '18 Dona Josefa', 14, '2024-06-26 07:03:53', '2024-07-02 18:56:36', 'delivered'),
(62, 68, 9, 'admin/uploads/product5.jpg', 'HOOPX &quot;Gucciyaya&quot; Mesh Shorts', 600, 77, 'Leo Louise Jimenez', 'Pulang Lupa', 15, '2024-06-26 07:03:59', '2024-07-03 09:02:42', 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_image`, `user_name`, `password`, `phone_number`, `date`) VALUES
(4, '', 'santillan', '123', '', '2024-04-21'),
(5, '', 'onichan', '123', '', '2024-04-21'),
(6, '', 'Ascei', '123', '', '2024-05-24'),
(8, '', 'chan', '123', '', '2024-05-29'),
(9, '', 'JBSantillan', '123', '', '2024-05-29'),
(10, '', 'trisha', '123', '', '2024-05-29'),
(11, '', 'chan123', '123', '', '2024-05-29'),
(12, '', 'channn', '123', '', '2024-05-29'),
(13, '', 'trishmae', '123', '', '2024-05-29'),
(14, 'user_image_upload/666bebee56cba.jpg', 'santillanjb01', '3003', '', '2024-06-14'),
(15, 'user_image_upload/667bb934063e7.jpg', 'leo', '123', '', '2024-06-25'),
(16, '', 'ultra', '123', '', '2024-06-26');

-- --------------------------------------------------------

--
-- Structure for view `dashboard_view`
--
DROP TABLE IF EXISTS `dashboard_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard_view`  AS SELECT `o`.`order_id` AS `order_id`, `o`.`product_id` AS `product_id`, `p`.`product_name` AS `product_name`, `p`.`price` AS `price`, `o`.`date` AS `date` FROM (`orders` `o` join `product` `p` on(`o`.`product_id` = `p`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `sales_view`
--
DROP TABLE IF EXISTS `sales_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sales_view`  AS SELECT `o`.`order_id` AS `order_id`, `o`.`product_id` AS `product_id`, `o`.`image` AS `image`, `p`.`product_name` AS `product_name`, `p`.`price` AS `price`, `c`.`customer_id` AS `customer_id`, `c`.`customer_name` AS `customer_name`, `c`.`address` AS `address`, `o`.`date` AS `date`, `o`.`user_id` AS `user_id` FROM ((`orders` `o` join `customer` `c` on(`o`.`user_id` = `c`.`user_id`)) join `product` `p` on(`o`.`product_id` = `p`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `sale_view`
--
DROP TABLE IF EXISTS `sale_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sale_view`  AS SELECT `o`.`order_id` AS `order_id`, `o`.`product_id` AS `product_id`, `p`.`product_name` AS `product_name`, `p`.`price` AS `price`, `c`.`customer_id` AS `customer_id`, `c`.`customer_name` AS `customer_name`, `c`.`address` AS `address`, `o`.`date` AS `date`, `o`.`image` AS `image` FROM ((`orders` `o` join `customer` `c` on(`o`.`user_id` = `c`.`user_id`)) join `product` `p` on(`o`.`product_id` = `p`.`product_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
