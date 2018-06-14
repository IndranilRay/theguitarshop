-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2018 at 04:50 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guitar_shop`
--
CREATE DATABASE IF NOT EXISTS `guitar_shop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `guitar_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

DROP TABLE IF EXISTS `product_brand`;
CREATE TABLE `product_brand` (
  `brand_id` int(6) UNSIGNED NOT NULL,
  `brand_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`brand_id`, `brand_name`) VALUES
(1, 'C.F.Martin'),
(2, 'Gibson'),
(3, 'Guild Guitar'),
(4, 'SeaGull'),
(5, 'Yamaha Corp');

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

DROP TABLE IF EXISTS `product_cart`;
CREATE TABLE `product_cart` (
  `cart_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `user_id` tinyint(1) NOT NULL,
  `prod_quantity` int(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_cart`
--

INSERT INTO `product_cart` (`cart_id`, `prod_id`, `user_id`, `prod_quantity`, `created`) VALUES
(8, 2, 1, 1, '2018-06-09 20:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_guitar`
--

DROP TABLE IF EXISTS `product_guitar`;
CREATE TABLE `product_guitar` (
  `guitar_id` int(6) UNSIGNED NOT NULL,
  `prod_id` int(6) NOT NULL,
  `brand_id` int(6) NOT NULL,
  `model_id` int(6) NOT NULL,
  `name` varchar(250) NOT NULL,
  `no_of_strings` int(10) NOT NULL,
  `type` enum('e','w') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_guitar`
--

INSERT INTO `product_guitar` (`guitar_id`, `prod_id`, `brand_id`, `model_id`, `name`, `no_of_strings`, `type`) VALUES
(1, 2, 1, 1, 'C.F Martin acoustic Guitar', 5, 'w'),
(2, 3, 2, 2, 'Gibson acoustic guitar', 5, 'w'),
(3, 1, 4, 5, 'Seagull electric guitar', 4, 'e'),
(4, 4, 5, 3, 'Yamaha Acoustic Guitar', 5, 'e'),
(5, 5, 2, 5, 'Gibson 6 string Electric Guitar', 4, 'e'),
(6, 6, 3, 6, 'Guild Electric Guitar', 4, 'e'),
(7, 7, 5, 6, 'Yamaha electric guitar', 4, 'e');

-- --------------------------------------------------------

--
-- Table structure for table `product_guitar_accessories`
--

DROP TABLE IF EXISTS `product_guitar_accessories`;
CREATE TABLE `product_guitar_accessories` (
  `access_id` int(6) UNSIGNED NOT NULL,
  `access_name` varchar(250) NOT NULL,
  `attributes` varchar(250) NOT NULL,
  `prod_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_model`
--

DROP TABLE IF EXISTS `product_model`;
CREATE TABLE `product_model` (
  `model_id` int(6) UNSIGNED NOT NULL,
  `model_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_model`
--

INSERT INTO `product_model` (`model_id`, `model_name`) VALUES
(1, 'ACX01'),
(2, 'ACY02'),
(3, 'ACZ03'),
(4, 'ACP04'),
(5, 'ELX01'),
(6, 'ELX02'),
(7, 'ELX03'),
(8, 'ELX04');

-- --------------------------------------------------------

--
-- Table structure for table `product_products`
--

DROP TABLE IF EXISTS `product_products`;
CREATE TABLE `product_products` (
  `prod_id` int(6) UNSIGNED NOT NULL,
  `sku` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `product_added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` bit(1) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_products`
--

INSERT INTO `product_products` (`prod_id`, `sku`, `price`, `product_added_on`, `type`, `quantity`, `image`) VALUES
(1, 'AC-X-01-Guitar', 500.5, '2018-06-02 13:16:55', b'1', 20, 'acoustic-guitar-001.png'),
(2, 'AC-Y-02', 1600.2, '2018-06-04 19:36:42', b'1', 15, 'acoustic-guitar-002.jpg'),
(3, 'AC-Z-03', 150, '2018-06-04 19:36:05', b'1', 10, 'acoustic-guitar-003.jpg'),
(4, 'AC-ZZ-01', 200, '2018-06-09 19:22:03', b'1', 10, 'acoustic-guitar-004.jpg'),
(5, 'EL-XL-01', 300, '2018-06-09 19:22:03', b'0', 10, 'electric-guitar-001.jpg'),
(6, 'EL-YL-01', 400, '2018-06-09 19:31:48', b'0', 15, 'electric-guitar-002.png'),
(7, 'EL-XNU-02', 400, '2018-06-09 19:22:03', b'0', 10, 'electric-guitar-004.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `product_guitar`
--
ALTER TABLE `product_guitar`
  ADD PRIMARY KEY (`guitar_id`);

--
-- Indexes for table `product_guitar_accessories`
--
ALTER TABLE `product_guitar_accessories`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `product_model`
--
ALTER TABLE `product_model`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `product_products`
--
ALTER TABLE `product_products`
  ADD PRIMARY KEY (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `brand_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_cart`
--
ALTER TABLE `product_cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_guitar`
--
ALTER TABLE `product_guitar`
  MODIFY `guitar_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_model`
--
ALTER TABLE `product_model`
  MODIFY `model_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_products`
--
ALTER TABLE `product_products`
  MODIFY `prod_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
