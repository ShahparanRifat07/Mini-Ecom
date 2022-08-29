-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 02:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `min_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `photo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `description`, `photo`) VALUES
(4, 'Smartphone', 'A mobile phone, cellular phone, cell phone, cellphone, handphone, hand phone or pocket phone, sometimes shortened to simply mobile, cell, or just phone, is a portable telephone that can make and receive calls over a radio frequency link while the user is moving within a telephone service area', 'uploads/phonePhone16615281812853362796308e87548e6c.jpg'),
(5, 'Watch', 'Watches are cool', 'uploads/watchesWatch16615282352407248816308e8abd150b.jpg'),
(6, 'Laptop', 'A laptop, laptop computer, or notebook computer is a small, portable personal computer with a screen and alphanumeric keyboard.', 'uploads/laptopLaptop16615282714102516806308e8cf4eb04.jpg'),
(7, 'Headphone ', 'Headphones are cool', 'uploads/headphoneHeadphone 16615428311556744448630921af6991d.jpg'),
(8, 'Garments', 'Ready-made garments are mass-produced finished textile products of the clothing industry. Ready-made are garments that can be bought off of store racks or online, and are ready to wear', 'uploads/garmentsGarments16617262061786982028630bedfe6ab1b.jpg'),
(9, 'Shoes', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion. The design of shoes.', 'uploads/shoeShoes1661727715711277951630bf3e32d696.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` varchar(9) NOT NULL,
  `quantity` varchar(9) NOT NULL,
  `photo` varchar(1024) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `category_id`, `price`, `quantity`, `photo`, `created_time`) VALUES
(1, 'Samsung Galaxy S22 Ultra', 'Upgrade to a new phone by buying the Samsung Galaxy S22 Ultra 5G that is available at the best prices online on Gadgets Now. Launched on February 9, 2022 (Official) in India, the mobile is available with striking features and adequate specifications at an introductory price of Rs 71,564.', 4, '700', '199', 'uploads_product/S22_Ultra_Greeen_UntitledSamsung Galaxy S22 Ultra166153349211854997496308fd3411de9.jpg', '2022-08-26 17:04:52'),
(3, 'Skullcandy Hesh Evo Wireless Headphones', 'WIRELESS SIMPLICITY WITH SUPERIOR SOUND.WIRELESS SIMPLICITY WITH SUPERIOR SOUND. With powerful 40mm drivers and exceptional acoustics, Hesh Evo features audio quality that has been refined over four generations of constant improvement.', 7, '150', '38', 'uploads_product/product_headphoneSkullcandy Hesh Evo1661545300153750145063092b5480e67.jpg', '2022-08-26 20:21:40'),
(6, 'MacBook Air (2022)', 'The M2 chip starts the next generation of Apple silicon, with even more of the speed and power efficiency of M1. So you can get more done faster with a more powerful 8‑core CPU. Create captivating images and animations with up to a 10-core GPU. Work with more streams of 4K and 8K ProRes video with the high‑performance media engine. And keep working — or playing — all day and into the night with up to 18 hours of battery life.2', 6, '1200', '19', 'uploads_product/MacbookMacBook Air (2022)1661559204673574046630961a452d45.jpg', '2022-08-27 00:13:24'),
(7, 'The Rigid Slouch Jean', 'Originally designed for miners, modern jeans were popularized as casual wear by Marlon Brando and James Dean in their 1950s films, particularly The Wild One and Rebel Without a Cause, leading to the fabric becoming a symbol of rebellion among teenagers, especially members of the greaser subculture.', 8, '10', '250', 'uploads_product/jeansnThe Rigid Slouch Jean1661727589227800877630bf36544f59.jpg', '2022-08-28 22:59:49'),
(8, 'Black Casual Slip-On Shoe For Men', 'Shoes are0 cool. Something Nothing', 9, '50', '50', 'uploads_product/shoe2Black Casual Slip-On Shoe For Men16617285301375528330630bf712b30cb.jpg', '2022-08-28 23:15:30'),
(9, 'Huawei P30 Pro', 'The Huawei P30 Pro is the Chinese manufacturer’s current flagship smartphone and comes with a triple-camera setup (quad-camera, if you count the time-of-flight sensor) that offers a plethora of improvements over both previous Huawei high-end devices, the P20 Pro and the Mate 20 Pro.', 4, '700', '30', 'uploads_product/HuaweiP30Pro_main-1024x768Huawei P30 Pro16617286661934034073630bf79a0ccd8.jpg', '2022-08-28 23:17:46'),
(14, 'iphone 13 pro max', 'The fastest chip in a smartphone. iPhone 13 Pro Max has · the best battery life ever on iPhone. · Shoot macro. A dramatically more powerful. Pro camera system.', 4, '1200', '40', 'uploads_product/iphoneiphone 13 pro max1661729879893263313630bfc5719e93.jpg', '2022-08-28 23:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(128) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `on_process` tinyint(1) NOT NULL DEFAULT 0,
  `delivered` tinyint(1) NOT NULL DEFAULT 0,
  `street` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `user_id`, `product_id`, `transaction_id`, `created_time`, `on_process`, `delivered`, `street`, `city`, `zip`, `country`) VALUES
(6, 2, 6, 'd0d1297d-7101-4200-b024-22071115dd49', '2022-08-27 23:38:14', 0, 0, 'Bikrompur', 'Dhaka', '1212', 'Bangladesh'),
(7, 2, 3, 'd63dea06-643e-45c4-9bdc-2635807ea01c', '2022-08-27 23:39:15', 0, 1, 'Bikrompur', 'Dhaka', '1212', 'Bangladesh'),
(8, 3, 3, '70ce864b-23bf-4a8a-90af-0d9252ec94b6', '2022-08-28 00:30:59', 0, 1, 'Madhabdi', 'Dhaka', '1204', 'Bangladesh'),
(9, 3, 1, '478247b7-be68-408c-90ad-19c68e0bd5dd', '2022-08-28 00:31:27', 1, 0, 'Madhabdi', 'Dhaka', '1204', 'Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(128) NOT NULL,
  `street` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `zip_code` varchar(16) NOT NULL,
  `country` varchar(64) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_loggedin` tinyint(1) NOT NULL DEFAULT 0,
  `profile_pic` varchar(128) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `street`, `city`, `zip_code`, `country`, `created_time`, `is_loggedin`, `profile_pic`, `is_admin`) VALUES
(1, 'Shahparan', 'Rifat', 'rifat@gmail.com', '01911467735', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Madhabdi', 'Dhaka', '1204', 'Bangladesh', '2022-08-24 22:56:34', 1, 'images/default.png', 1),
(2, 'Hasan', 'Saon', 'saon@gmail.com', '01957483762', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Bikrompur', 'Dhaka', '1212', 'Bangladesh', '2022-08-24 23:03:20', 0, 'images/default.png', 0),
(3, 'Rafiuddin', 'Alvi', 'alvi@gmail.com', '01876345298', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Madhabdi', 'Dhaka', '1204', 'Bangladesh', '2022-08-28 00:25:02', 0, 'images/default.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f1` (`category_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f2` (`user_id`),
  ADD KEY `f3` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `f1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `f2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `f3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
