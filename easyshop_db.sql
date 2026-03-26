-- phpMyAdmin SQL Dump
-- version 5.2.0
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2026
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Database: `easyshop_db`
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `easyshop_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `easyshop_db`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--
INSERT INTO `products` (`id`, `name`, `price`, `category`, `image`, `description`) VALUES
(1, 'Wireless Headphones', '99.99', 'Electronics', 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80', 'Experience pure sound with these premium noise-cancelling headphones.'),
(2, 'Smart Watch', '150.00', 'Wearables', 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80', 'Track your fitness, heart rate, and notifications.'),
(3, 'Gaming Keyboard', '120.00', 'Gaming', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=800&q=80', 'Tactile mechanical keyboard with customizable RGB backlighting.'),
(4, 'Office Chair', '200.00', 'Furniture', 'https://images.unsplash.com/photo-1505843490538-5133c6c7d0e1?w=800&q=80', 'Stay comfortable during long work hours.'),
(5, 'Action Camera', '349.00', 'Photography', 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=800&q=80', 'Capture your adventures in stunning 4K resolution.'),
(6, 'Water Bottle', '25.00', 'Accessories', 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=800&q=80', 'Sturdy stainless steel water bottle.'),
(7, 'Premium Leather Wallet', '45.00', 'Accessories', 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800&q=80', 'Elegant handcrafted leather wallet with multiple card slots.'),
(8, 'Wireless Mouse', '29.99', 'Electronics', 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=800&q=80', 'Ergonomic wireless mouse with precision tracking and long battery life.'),
(9, 'Casual Sneakers', '85.00', 'Fashion', 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80', 'Comfortable everyday sneakers, perfect for long walks.'),
(10, 'Classic Sunglasses', '110.00', 'Accessories', 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=800&q=80', 'UV-protection sunglasses with a timeless vintage design.'),
(11, 'Bluetooth Speaker', '60.00', 'Electronics', 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&q=80', 'Portable waterproof speaker offering deep bass and clear sound.'),
(12, 'Yoga Mat', '20.00', 'Fitness', 'https://images.unsplash.com/photo-1599422314077-f4dfdaa4cd09?w=800&q=80', 'Non-slip yoga mat providing optimal cushion for your workouts.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_prod` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
