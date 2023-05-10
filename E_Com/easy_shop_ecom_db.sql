-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 09:16 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easy_shop_ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`) VALUES
(1, 'Bharat Pareek', 'bharat.pareek', 'bharat.pareek', 'bharatpareek444@gmail.com'),
(2, 'Bharat Parik', 'bharat', 'bharat', 'bharatparik@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `product_id`, `product_quantity`, `user_id`) VALUES
(1, 32, 0, 1),
(2, 33, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cat_id`, `cat_title`) VALUES
(2, 'Smartphones'),
(3, 'Laptops'),
(4, 'Books'),
(5, 'Sports'),
(6, 'Student Accessories'),
(7, 'Cloths'),
(8, 'Home Appliances'),
(9, 'Grocery'),
(10, 'Baby & Kids'),
(11, 'Footwears'),
(12, 'Fashion'),
(13, 'Softwares'),
(14, 'Electronic Accessories'),
(15, 'Smartwatch'),
(16, 'Sunglass');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_amount` double NOT NULL,
  `payment_status` varchar(1) NOT NULL DEFAULT 'N',
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `delivery_status` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `user_id`, `order_amount`, `payment_status`, `product_id`, `product_quantity`, `delivery_status`) VALUES
(1, 1, 59998, 'N', 32, 2, 'Y'),
(2, 1, 29999, 'N', 32, 1, 'N'),
(3, 1, 29999, 'Y', 32, 1, 'N'),
(4, 1, 126759, 'N', 34, 1, 'N'),
(5, 1, 320, 'N', 36, 1, 'N'),
(6, 1, 640, 'Y', 36, 2, 'N'),
(7, 1, 320, 'Y', 36, 1, 'Y'),
(8, 1, 1599, 'Y', 35, 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(15) NOT NULL,
  `product_short_description` varchar(255) NOT NULL,
  `product_description` varchar(400) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_title`, `product_cat_id`, `product_price`, `product_quantity`, `product_short_description`, `product_description`, `product_image`) VALUES
(32, 'iQOO Neo 7 5G ', 2, 29999, 19, '    Frost Blue, 8GB RAM, 128GB Storage), Dimensity 8200, only 4nm Processor in The Segment, 50% Charge in 10 mins, Motion Control & 90 FPS Gaming   vjugkjiuhlhvbkvcgvh', 'MediaTek Dimensity 8200 5G Mobile platform adopts TSMC 4nm process and has excellent Power Efficiency Performance. Also, Equipped with the LPDDR5 RAM & UFS 3.1 Storage.\r\nThe 120W FlashCharge charges from 1% to 50% in just 10 minutes (25 minutes for a full charge)\r\nMotion Control powered by Gyroscope & Acceleration Sensors to give 6 additional Phone movement-based control options while Gaming\r\n6.78', 'iqoo.jpg'),
(33, 'Oppo Reno 7 ', 2, 29999, 1220, ' 6 GB RAM, 128 GB ROM, Full HD+ Display, 108MP + 8MP + 2MP | 16MP Front Camera, 5000 mAh Battery, Mediatek Dimensity 1080 5G Processor    ', 'Display your personality and make a fashion statement with the Realme 10 Pro+ 5G, which gives you a fantastic user experience. With its 17.01 cm (6.7) AMOLED curved display screen that has 2160 Hz PWM Dimming, TUV Rheinland Low Blue Light Certificate, 1260 Hz Turbocharged Touch Sampling, With its 108 MP ProLight Camera, this smartphone also provides you with amazing photographic and filming featur', 'opporeno7.jpg'),
(34, 'ASUS Zenbook Pro', 3, 126759, 9, 'ASUS Zenbook Pro 14 Duo OLED (2022) Dual Screen Laptop, 14.5\" (36.83 cm) 2.8K OLED 120Hz Touch, Intel EVO Core i9 12th Gen, (32GB/1TB SSD/4GB RTX 3050 Ti/Win 11/Office/Black/1.75 Kg) UX8402ZE-LM921WS', 'rocessor: 12th Gen Intel EVO Core i9-12900H, 2.5 GHz Base Speed, 24MB Cache, Up to 5.0 GHz Max Turbo Boost, 14 Cores (6P+8E cores)\r\nMemory: 32GB LPDDR5 5200MHz RAM onboard | Storage: 1TB SSD M.2 NVMe PCIe 4.0 SSD\r\nGraphics: Dedicated NVIDIA GeForce RTX 3050 Ti GDDR6 4GB VRAM\r\nDisplay: 14.5-inch (36.83 cms), 2.8K (2880 x 1800) OLED 16:10 aspect ratio, LED Backlit, Touch screen, 0.2ms response time,', 'asus-zenbook.jpg'),
(35, 'Fastrack Reflex Beat+', 15, 1599, 20, 'New Fastrack Reflex Beat+ 1.69” UltraVU Display|500 Nits Brightness|60 Sports Modes|24*7 Heart Rate Monitor|SpO2 Monitor|Sleep Tracker|IP68 Water Resistant|Music & Camera Control', 'Fastrack Reflex Beat + with its 1.69” UltraVU Display is ready to style your wrist with bright pixel resolution and brand new amazing colours. Track advanced activity metrics for all new built-in 60 Sports Modes on your Beat + smartwatch\r\nWorried about your health? Track your 24*7 Heart Rate, SpO2 blood oxygen level on your best companion. You should know how well you sleep after that tiring day a', 'fastrack-reflex-plus.jpg'),
(36, 'Let Us C', 4, 320, 96, '  Over 3 Million Copies Sold.Reading books is a kind of enjoyment. Reading books is a good habit. We bring you a different kinds of books. You can carry this book where ever you want. ', ' “Simplicity”- that has been the hallmark of this book in not only its previous eighteen English editions, but also in the Hindi, Gujrati, Japanese, Korean, Chinese and US editions. This book doesn’t assume any programming background. It begins with the basics and steadily builds the pace so that the reader finds it easy to handle advanced topics towards the end of the book.', 'let-us-c-18-edition.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `mobile_number` bigint(12) NOT NULL,
  `profile_picture` varchar(150) NOT NULL,
  `user_info` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `address`, `mobile_number`, `profile_picture`, `user_info`) VALUES
(1, 'bharatpareek', '12345', 'bharat@gmail.com', 'Bharat', 'Pareek', 'Pareek Hostel Bikaner', 8976543234, 'mine.jpg', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_cat_id` (`product_cat_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `tbl_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`);

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`product_cat_id`) REFERENCES `tbl_categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
