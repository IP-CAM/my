-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2016 at 12:08 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_po_return`
--

CREATE TABLE `oc_po_return` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `return_quantity` int(11) NOT NULL,
  `reason` varchar(512) NOT NULL,
  `return_date` date NOT NULL,
  `delete_bit` bit(1) NOT NULL DEFAULT b'0',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oc_po_return`
--

INSERT INTO `oc_po_return` (`id`, `order_id`, `product_id`, `supplier_id`, `return_quantity`, `reason`, `return_date`, `delete_bit`, `user_id`) VALUES
(1, 84, 154, 1, 5, '', '2016-06-17', b'0', 1),
(2, 84, 154, 2, 10, '', '2016-06-17', b'0', 1),
(3, 90, 175, 1, 30, '', '2016-06-17', b'0', 1),
(4, 84, 156, 2, 20, '', '2016-06-17', b'0', 1),
(5, 95, 181, 1, 30, '', '2016-06-17', b'1', 1),
(6, 95, 181, 1, 20, '', '2016-06-20', b'0', 1),
(7, 95, 182, 2, 30, '', '2016-06-20', b'0', 1),
(8, 84, 154, 2, 10, '', '2016-06-20', b'0', 1),
(9, 100, 195, 1, 20, '', '2016-07-10', b'0', 1),
(10, 101, 196, 1, 20, '', '2016-07-10', b'0', 1),
(11, 102, 197, 1, 20, '', '2016-07-10', b'0', 1),
(12, 103, 198, 1, 20, '', '2016-07-10', b'0', 1),
(13, 99, 194, 1, 20, '', '2016-07-10', b'0', 1),
(14, 98, 193, 1, 20, '', '2016-07-10', b'0', 1),
(15, 96, 183, 1, 30, '', '2016-07-10', b'0', 1),
(16, 96, 184, 2, 10, '', '2016-07-10', b'0', 1),
(17, 96, 185, 2, 10, '', '2016-07-10', b'0', 1),
(18, 96, 186, 2, 10, '', '2016-07-10', b'0', 1),
(19, 96, 187, 2, 30, '', '2016-07-10', b'0', 1),
(20, 96, 183, 1, 30, '', '2016-07-10', b'1', 1),
(21, 96, 190, 1, 30, '', '2016-07-10', b'0', 1),
(22, 96, 190, 1, 20, '', '2016-07-10', b'0', 1),
(23, 95, 181, 1, 10, '', '2016-07-10', b'0', 1),
(24, 207, 319, 10, 5, '', '2016-08-25', b'0', 1),
(25, 207, 319, 10, 3, '', '2016-08-25', b'0', 1),
(26, 207, 319, 10, 10, '', '2016-08-25', b'0', 1),
(27, 207, 319, 10, 40, '', '2016-08-25', b'0', 1),
(28, 209, 321, 2, 5, 'defaulty', '2016-08-25', b'0', 1),
(29, 199, 307, 1, 10, 'defaulty', '2016-08-26', b'0', 1),
(30, 216, 333, 1, 5, 'defaulty', '2016-08-26', b'0', 1),
(31, 217, 334, 2, 5, 'defaulty', '2016-08-29', b'0', 1),
(32, 250, 395, 11, 20, 'Defected', '2016-08-30', b'0', 1),
(33, 250, 395, 11, 10, 'Defected', '2016-08-30', b'0', 1),
(34, 254, 403, 11, 10, 'Defected', '2016-09-01', b'0', 1),
(35, 256, 407, 1, 20, 'Defected', '2016-09-01', b'0', 1),
(36, 256, 408, 11, 10, 'Defected', '2016-09-01', b'0', 1),
(37, 256, 409, 1, 20, 'Defected', '2016-09-01', b'0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_po_return`
--
ALTER TABLE `oc_po_return`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_po_return`
--
ALTER TABLE `oc_po_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
