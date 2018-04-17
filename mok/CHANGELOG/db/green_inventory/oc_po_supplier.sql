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
-- Table structure for table `oc_po_supplier`
--

CREATE TABLE `oc_po_supplier` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `supplier_group_id` int(11) NOT NULL,
  `date_added` date NOT NULL,
  `delete_bit` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oc_po_supplier`
--

INSERT INTO `oc_po_supplier` (`id`, `first_name`, `last_name`, `email`, `telephone`, `fax`, `supplier_group_id`, `date_added`, `delete_bit`) VALUES
(-1, 'default', '', '', '', '', 0, '0000-00-00', b'0'),
(1, 'Turaab', 'Ali', 'turaab.ali786@gmail.com', '03001234567', '123456789', 1, '2016-05-23', b'0'),
(2, 'Waqar', 'Ahmed', 'waqar.ahmed@gmail.com', '123456465', '123456789', 2, '2016-05-23', b'0'),
(3, 'Arham', 'Mughal', 'arham.mughal@gmail.com', '123456789', '123456879', 1, '2016-05-26', b'1'),
(4, 'tester', 'testing', 'tester@testing.com', '123456789', '123456798', 1, '2016-05-26', b'1'),
(5, 'Arham', 'Mughal', 'turaab.ali786@gmail.com', '03001234567', '123456798', 1, '2016-05-26', b'1'),
(6, 'Arham', 'Mughal', 'gresystechnologies@gmail.com', '03001234567', '123456789', 1, '2016-05-26', b'1'),
(7, 'tester', 'testing', 'tester@testing.com', '123456465', '123456798', 1, '2016-05-26', b'1'),
(8, 'tester', 'tester', 'turaab.ali786@gmail.com', '03001234567', '123456798', 5, '2016-06-20', b'1'),
(9, 'Abdul', 'Hadi', 'test@test.com', '1234568789', '123456789', 4, '2016-07-21', b'1'),
(10, 'Turaab', 'testing', 'turaab.ali786@yahoo.com', '123456789', '123456789', 1, '2016-08-22', b'0'),
(11, 'Aroosa', 'khan', 'aroosakhankhan4@gmail.com', '0552312363', '', 4, '2016-08-22', b'0'),
(12, 'fazilat', 'suleman', 'fazilat.990@gmail.com', '0552312363', '', 4, '2016-08-22', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_po_supplier`
--
ALTER TABLE `oc_po_supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_po_supplier`
--
ALTER TABLE `oc_po_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
