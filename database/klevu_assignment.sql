-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2022 at 08:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klevu_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_stores`
--

CREATE TABLE `client_stores` (
  `store_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `hmac` varchar(255) DEFAULT NULL,
  `nonce` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `last_activity` datetime NOT NULL,
  `active` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_stores`
--

INSERT INTO `client_stores` (`store_id`, `client_id`, `store_name`, `token`, `hmac`, `nonce`, `url`, `last_activity`, `active`) VALUES
(2, 0, 'klevu-assignment', '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', NULL, NULL, 'klevu-assignment.myshopify.com', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_stores`
--
ALTER TABLE `client_stores`
  ADD PRIMARY KEY (`store_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_stores`
--
ALTER TABLE `client_stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
