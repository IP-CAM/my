-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2016 at 12:09 PM
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
-- Table structure for table `oc_po_supplier_group`
--

CREATE TABLE `oc_po_supplier_group` (
  `id` int(11) NOT NULL,
  `supplier_group_name` varchar(512) NOT NULL,
  `supplier_group_desc` varchar(512) NOT NULL,
  `delete_bit` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oc_po_supplier_group`
--

INSERT INTO `oc_po_supplier_group` (`id`, `supplier_group_name`, `supplier_group_desc`, `delete_bit`) VALUES
(1, 'Default', 'des', b'0'),
(2, 'Hair Suppliers', 'Hair suppliers from somewhere', b'0'),
(3, 'Aqua Suppliers', 'Aqua Suppliers from somewhere.', b'1'),
(4, 'supplier 1', 'sfsadf', b'0'),
(5, 'supplier 2', 'afsdf', b'0'),
(6, 'supplier 3', 'fsdas', b'0'),
(7, 'supplier 4', 'asdf', b'1'),
(8, 'supplier 5', 'asdfasd', b'0'),
(9, 'supplier 8', 'asdfasdf', b'0'),
(10, 'supplier 9', 'adfasdf', b'0'),
(11, 'supplier 10', 'asdfasdf', b'0'),
(12, 'supplier 32', 'asdfadfasdf', b'0'),
(13, 'supplier sdf', 'asdfasdf', b'0'),
(14, 'supplier asdf', 'asdfasdfasdf', b'0'),
(15, 'supplier 1321', 'asdfasdf', b'0'),
(16, 'supplier 56', 'asdfasdf', b'0'),
(17, 'fsasdfasdfasdf', 'asdfasdfasdf', b'1'),
(18, 'sadfasdf', 'asdfasdfasdfasdfasdfasdf', b'0'),
(19, 'asdasdfa', 'asdfasdfasdfasdf', b'0'),
(20, 'asdfasdfasdf', 'asdfasdfasdf', b'1'),
(21, 'asdfasdf', 'asdfasdf', b'1'),
(22, 'asdfasdf', 'asdfasdf', b'1'),
(23, 'turaab ali', 'asdfasdf', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_po_supplier_group`
--
ALTER TABLE `oc_po_supplier_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_po_supplier_group`
--
ALTER TABLE `oc_po_supplier_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
