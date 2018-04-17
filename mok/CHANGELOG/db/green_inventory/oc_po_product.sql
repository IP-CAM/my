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
-- Table structure for table `oc_po_product`
--

CREATE TABLE `oc_po_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attribute_group_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `received_products` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oc_po_product`
--

INSERT INTO `oc_po_product` (`id`, `product_id`, `name`, `attribute_group_id`, `quantity`, `order_id`, `received_products`) VALUES
(1, 43, 'MacBook', NULL, 5, 1, 5),
(2, 42, 'Apple Cinema 30"', NULL, 5, 1, 5),
(3, 40, 'iPhone', NULL, 25, 1, 25),
(4, 42, 'Apple Cinema 30"', NULL, 5, 2, 0),
(5, 42, 'Apple Cinema 30"', NULL, 5, 3, 0),
(6, 47, 'HP LP3065', NULL, 6, 4, 0),
(7, 30, 'Canon EOS 5D', NULL, 6, 5, 0),
(8, 47, 'HP LP3065', NULL, 6, 6, 0),
(9, 30, 'Canon EOS 5D', NULL, 12, 7, 0),
(10, 30, 'Canon EOS 5D', NULL, 6, 8, 0),
(11, 30, 'Canon EOS 5D', NULL, 6, 9, 0),
(12, 30, 'Canon EOS 5D', NULL, 6, 10, 0),
(13, 30, 'Canon EOS 5D', NULL, 5, 11, 5),
(14, 30, 'Canon EOS 5D', NULL, 25, 11, 25),
(15, 47, 'HP LP3065', NULL, 5, 11, 5),
(16, 47, 'HP LP3065', NULL, 5, 12, 1),
(17, 30, 'Canon EOS 5D', NULL, 5, 13, 1),
(18, 30, 'Canon EOS 5D', NULL, 5, 14, 0),
(19, 30, 'Canon EOS 5D', NULL, 6, 15, 6),
(20, 30, 'Canon EOS 5D', NULL, 6, 16, 6),
(21, 28, 'HTC Touch HD', NULL, 35, 17, 0),
(22, 28, 'HTC Touch HD', NULL, 6, 18, 6),
(23, 33, 'Samsung SyncMaster 941BW', NULL, 6, 19, 6),
(24, 47, 'HP LP3065', NULL, 6, 20, 6),
(25, 42, 'Apple Cinema 30"', NULL, 6, 21, 6),
(26, 42, 'Apple Cinema 30"', NULL, 5, 22, 0),
(27, 42, 'Apple Cinema 30"', NULL, 5, 23, 0),
(28, 42, 'Apple Cinema 30"', NULL, 6, 24, 0),
(29, 34, 'iPod Shuffle', NULL, 6, 24, 0),
(30, 42, 'Apple Cinema 30"', NULL, 5, 25, 0),
(31, 30, 'Canon EOS 5D', NULL, 5, 25, 0),
(32, 47, 'HP LP3065', NULL, 5, 25, 0),
(33, 42, 'Apple Cinema 30"', NULL, 5, 26, 0),
(34, 48, 'iPod Classic', NULL, 6, 26, 0),
(35, 30, 'Canon EOS 5D', NULL, 7, 26, 0),
(36, 30, 'Canon EOS 5D', NULL, 6, 31, 0),
(37, 28, 'HTC Touch HD', NULL, 5, 31, 0),
(38, 43, 'MacBook', NULL, 6, 31, 0),
(39, 30, 'Canon EOS 5D', NULL, 5, 32, 0),
(40, 42, 'Apple Cinema 30"', NULL, 6, 32, 0),
(41, 42, 'Apple Cinema 30"', NULL, 6, 32, 0),
(42, 28, 'HTC Touch HD', NULL, 6, 32, 0),
(43, 36, 'iPod Nano', NULL, 8, 32, 0),
(44, 30, 'Canon EOS 5D', NULL, 5, 32, 0),
(45, 30, 'Canon EOS 5D', NULL, 56, 32, 0),
(46, 42, 'Apple Cinema 30"', NULL, 6, 33, 0),
(47, 47, 'HP LP3065', NULL, 5, 33, 0),
(48, 30, 'Canon EOS 5D', NULL, 4, 33, 0),
(49, 47, 'HP LP3065', NULL, 4, 33, 0),
(50, 29, 'Palm Treo Pro', NULL, 4, 33, 0),
(51, 31, 'Nikon D300', NULL, 7, 33, 0),
(52, 30, 'Canon EOS 5D', NULL, 4, 33, 0),
(53, 47, 'HP LP3065', NULL, 7, 33, 0),
(54, 30, 'Canon EOS 5D', NULL, 87, 34, 0),
(55, 42, 'Apple Cinema 30"', NULL, 7, 34, 0),
(56, 47, 'HP LP3065', NULL, 9, 34, 0),
(57, 42, 'Apple Cinema 30"', NULL, 7, 35, 0),
(58, 30, 'Canon EOS 5D', NULL, 5, 35, 0),
(59, 42, 'Apple Cinema 30"', NULL, 5, 35, 0),
(60, 30, 'Canon EOS 5D', NULL, 6, 35, 0),
(61, 30, 'Canon EOS 5D', NULL, 5, 36, 0),
(62, 42, 'Apple Cinema 30"', NULL, 5, 37, 0),
(63, 42, 'Apple Cinema 30"', NULL, 5, 38, 0),
(64, 42, 'Apple Cinema 30"', NULL, 25, 42, 25),
(65, 42, 'Apple Cinema 30"', NULL, 25, 43, 0),
(66, 42, 'Apple Cinema 30"', NULL, 23, 43, 0),
(67, 30, 'Canon EOS 5D', NULL, 20, 44, 20),
(68, 47, 'HP LP3065', NULL, 23, 45, 0),
(69, 30, 'Canon EOS 5D', NULL, 21, 45, 0),
(70, 30, 'Canon EOS 5D', NULL, 23, 46, 23),
(71, 30, 'Canon EOS 5D', NULL, 23, 46, 23),
(72, 42, 'Apple Cinema 30"', NULL, 23, 47, 0),
(73, 42, 'Apple Cinema 30"', NULL, 22, 47, 0),
(74, 42, 'Apple Cinema 30"', NULL, 23, 48, 0),
(75, 30, 'Canon EOS 5D', NULL, 21, 48, 0),
(76, 30, 'Canon EOS 5D', NULL, 23, 49, 23),
(77, 42, 'Apple Cinema 30"', NULL, 21, 49, 21),
(78, 42, 'Apple Cinema 30"', NULL, 23, 50, 23),
(79, 30, 'Canon EOS 5D', NULL, 21, 50, 21),
(80, 42, 'Apple Cinema 30"', NULL, 23, 51, 23),
(81, 42, 'Apple Cinema 30"', NULL, 21, 51, 21),
(82, 30, 'Canon EOS 5D', NULL, 21, 52, 21),
(83, 30, 'Canon EOS 5D', NULL, 23, 52, 23),
(84, 42, 'Apple Cinema 30"', NULL, 23, 53, 23),
(85, 30, 'Canon EOS 5D', NULL, 25, 53, 25),
(86, 42, 'Apple Cinema 30"', NULL, 23, 54, 23),
(87, 42, 'Apple Cinema 30"', NULL, 25, 55, 20),
(88, 30, 'Canon EOS 5D', NULL, 23, 55, 20),
(89, 42, 'Apple Cinema 30"', NULL, 32, 56, 0),
(90, 30, 'Canon EOS 5D', NULL, 23, 56, 0),
(91, 42, 'Apple Cinema 30"', NULL, 32, 57, 0),
(92, 30, 'Canon EOS 5D', NULL, 23, 57, 0),
(93, 42, 'Apple Cinema 30"', NULL, 32, 58, 0),
(94, 30, 'Canon EOS 5D', NULL, 23, 58, 0),
(95, 42, 'Apple Cinema 30"', NULL, 32, 59, 0),
(96, 42, 'Apple Cinema 30"', NULL, 23, 59, 0),
(97, 42, 'Apple Cinema 30"', NULL, 6, 60, 0),
(98, 42, 'Apple Cinema 30"', NULL, 54, 60, 0),
(99, 42, 'Apple Cinema 30"', NULL, 6, 61, 0),
(100, 42, 'Apple Cinema 30"', NULL, 1, 61, 0),
(101, 30, 'Canon EOS 5D', NULL, 32, 62, 0),
(102, 47, 'HP LP3065', NULL, 32, 62, 0),
(103, 30, 'Canon EOS 5D', NULL, 3, 63, 0),
(104, 47, 'HP LP3065', NULL, 23, 63, 0),
(105, 30, 'Canon EOS 5D', NULL, 32, 64, 0),
(106, 30, 'Canon EOS 5D', NULL, 23, 64, 0),
(107, 30, 'Canon EOS 5D', NULL, 32, 66, 0),
(108, 42, 'Apple Cinema 30"', NULL, 23, 66, 0),
(109, 30, 'Canon EOS 5D', NULL, 32, 67, 0),
(110, 41, 'iMac', NULL, 23, 67, 0),
(111, 28, 'HTC Touch HD', NULL, 22, 67, 0),
(112, 30, 'Canon EOS 5D', NULL, 6, 68, 6),
(113, 30, 'Canon EOS 5D', NULL, 6, 68, 6),
(114, 28, 'HTC Touch HD', NULL, 7, 69, 0),
(115, 28, 'HTC Touch HD', NULL, 8, 69, 0),
(116, 28, 'HTC Touch HD', NULL, 7, 70, 7),
(117, 28, 'HTC Touch HD', NULL, 8, 70, 8),
(118, 41, 'iMac', NULL, 6, 71, 0),
(119, 41, 'iMac', NULL, 8, 71, 0),
(120, 30, 'Canon EOS 5D', NULL, 30, 72, 30),
(121, 28, 'HTC Touch HD', NULL, 20, 72, 20),
(122, 28, 'HTC Touch HD', NULL, 20, 73, 20),
(123, 36, 'iPod Nano', NULL, 23, 73, 23),
(124, 30, 'Canon EOS 5D', NULL, 21, 74, 21),
(125, 41, 'iMac', NULL, 20, 74, 20),
(126, 47, 'HP LP3065', NULL, 20, 75, 20),
(127, 40, 'iPhone', NULL, 32, 75, 32),
(128, 30, 'Canon EOS 5D', NULL, 20, 76, 20),
(129, 30, 'Canon EOS 5D', NULL, 30, 76, 30),
(130, 41, 'iMac', NULL, 20, 76, 20),
(131, 47, 'HP LP3065', NULL, 31, 77, 31),
(132, 30, 'Canon EOS 5D', NULL, 20, 77, 20),
(133, 30, 'Canon EOS 5D', NULL, 20, 77, 20),
(134, 45, 'MacBook Pro', NULL, 36, 77, 36),
(135, 45, 'MacBook Pro', NULL, 56, 77, 56),
(136, 31, 'Nikon D300', NULL, 50, 77, 50),
(137, 30, 'Canon EOS 5D', NULL, 30, 78, 30),
(138, 30, 'Canon EOS 5D', NULL, 20, 79, 20),
(139, 28, 'HTC Touch HD', NULL, 30, 79, 30),
(140, 47, 'HP LP3065', NULL, 30, 80, 30),
(141, 47, 'HP LP3065', NULL, 20, 80, 20),
(142, 47, 'HP LP3065', NULL, 32, 81, 32),
(143, 47, 'HP LP3065', NULL, 30, 81, 30),
(144, 48, 'iPod Classic', NULL, 20, 81, 20),
(145, 30, 'Canon EOS 5D', NULL, 20, 82, 0),
(146, 47, 'HP LP3065', NULL, 30, 82, 0),
(147, 32, 'iPod Touch', NULL, 25, 82, 0),
(148, 43, 'MacBook', NULL, 25, 82, 0),
(149, 45, 'MacBook Pro', NULL, 50, 82, 0),
(150, 30, 'Canon EOS 5D', NULL, 20, 83, 20),
(151, 30, 'Canon EOS 5D', NULL, 30, 83, 30),
(152, 28, 'HTC Touch HD', NULL, 20, 83, 20),
(153, 48, 'iPod Classic', NULL, 30, 83, 30),
(154, 30, 'Canon EOS 5D', NULL, 30, 84, 30),
(155, 41, 'iMac', NULL, 20, 84, 20),
(156, 40, 'iPhone', NULL, 30, 84, 30),
(157, 47, 'HP LP3065', NULL, 30, 85, 0),
(158, 47, 'HP LP3065', NULL, 20, 85, 0),
(159, 47, 'HP LP3065', NULL, 30, 85, 0),
(160, 29, 'Palm Treo Pro', NULL, 50, 85, 0),
(161, 49, 'Samsung Galaxy Tab 10.1', NULL, 30, 85, 0),
(162, 30, 'Canon EOS 5D', NULL, 30, 86, 0),
(163, 41, 'iMac', NULL, 20, 86, 0),
(164, 32, 'iPod Touch', NULL, 30, 86, 0),
(165, 47, 'HP LP3065', NULL, 50, 86, 0),
(166, 47, 'HP LP3065', NULL, 6, 86, 0),
(167, 30, 'Canon EOS 5D', NULL, 30, 87, 30),
(168, 30, 'Canon EOS 5D', NULL, 50, 87, 50),
(169, 28, 'HTC Touch HD', NULL, 60, 87, 60),
(170, 48, 'iPod Classic', NULL, 40, 87, 40),
(171, 40, 'iPhone', NULL, 60, 87, 60),
(172, 30, 'Canon EOS 5D', NULL, 30, 88, 30),
(173, 28, 'HTC Touch HD', NULL, 20, 88, 20),
(174, 47, 'HP LP3065', NULL, 50, 89, 50),
(175, 47, 'HP LP3065', NULL, 30, 90, 30),
(176, 28, 'HTC Touch HD', NULL, 30, 91, 30),
(177, 42, 'Apple Cinema 30', NULL, 50, 92, 50),
(178, 42, 'Apple Cinema 30', NULL, 30, 93, 30),
(179, 47, 'HP LP3065', NULL, 30, 93, 30),
(180, 30, 'Canon EOS 5D', NULL, 50, 94, 50),
(181, 42, 'Apple Cinema 30', NULL, 30, 95, 30),
(182, 30, 'Canon EOS 5D', NULL, 30, 95, 30),
(183, 42, 'Apple Cinema 30', NULL, 30, 96, 30),
(184, 30, 'Canon EOS 5D', NULL, 20, 96, 20),
(185, 47, 'HP LP3065', NULL, 30, 96, 30),
(186, 47, 'HP LP3065', NULL, 50, 96, 50),
(187, 47, 'HP LP3065', NULL, 30, 96, 30),
(188, 32, 'iPod Touch', NULL, 20, 96, 20),
(189, 32, 'iPod Touch', NULL, 30, 96, 30),
(190, 31, 'Nikon D300', NULL, 50, 96, 50),
(191, 29, 'Palm Treo Pro', NULL, 60, 96, 60),
(192, 30, 'Canon EOS 5D', NULL, 32, 97, 0),
(193, 42, 'Apple Cinema 30', NULL, 50, 98, 50),
(194, 47, 'HP LP3065', NULL, 30, 99, 30),
(195, 41, 'iMac', NULL, 80, 100, 80),
(196, 48, 'iPod Classic', NULL, 90, 101, 90),
(197, 41, 'iMac', NULL, 30, 102, 30),
(198, 34, 'iPod Shuffle', NULL, 30, 103, 30),
(199, 30, 'Canon EOS 5D', NULL, 50, 104, 0),
(200, 36, 'iPod Nano', NULL, 30, 105, 30),
(201, 41, 'iMac', NULL, 50, 106, 0),
(202, 40, 'iPhone', NULL, 40, 107, 0),
(203, 34, 'iPod Shuffle', NULL, 50, 108, 0),
(204, 43, 'MacBook', NULL, 20, 109, 20),
(205, 47, 'HP LP3065', NULL, 20, 110, 20),
(206, 34, 'iPod Shuffle', NULL, 20, 111, 20),
(207, 47, 'HP LP3065', NULL, 20, 112, 20),
(208, 28, 'HTC Touch HD', NULL, 30, 113, 30),
(209, 41, 'iMac', NULL, 50, 114, 50),
(210, 47, 'HP LP3065', NULL, 30, 115, 0),
(211, 41, 'iMac', NULL, 20, 115, 0),
(212, 44, 'MacBook Air', NULL, 50, 115, 0),
(213, 48, 'iPod Classic', NULL, 20, 115, 0),
(214, 30, 'Canon EOS 5D', NULL, 30, 116, 0),
(215, 40, 'iPhone', NULL, 50, 117, 0),
(216, 43, 'MacBook', NULL, 30, 118, 0),
(217, 44, 'MacBook Air', NULL, 30, 119, 0),
(218, 40, 'iPhone', NULL, 50, 120, 0),
(219, 28, 'HTC Touch HD', NULL, 50, 121, 0),
(220, 43, 'MacBook', NULL, 100, 122, 0),
(221, 40, 'iPhone', NULL, 700, 123, 0),
(222, 48, 'iPod Classic', NULL, 50, 124, 0),
(223, 43, 'MacBook', NULL, 50, 125, 0),
(224, 50, 'new product', NULL, 50, 126, 0),
(225, 40, 'iPhone', NULL, 60, 127, 0),
(226, 43, 'MacBook', NULL, 60, 128, 0),
(227, 40, 'iPhone', NULL, 60, 129, 0),
(228, 40, 'iPhone', NULL, 50, 130, 0),
(229, 30, 'Canon EOS 5D', NULL, 20, 131, 0),
(230, 47, 'HP LP3065', NULL, 30, 132, 0),
(231, 40, 'iPhone', NULL, 50, 132, 0),
(232, 28, 'HTC Touch HD', NULL, 50, 133, 50),
(233, 34, 'iPod Shuffle', NULL, 60, 133, 60),
(234, 47, 'HP LP3065', NULL, 50, 134, 0),
(235, 47, 'HP LP3065', NULL, 60, 134, 0),
(236, 41, 'iMac', NULL, 400, 135, 400),
(237, 48, 'iPod Classic', NULL, 500, 135, 500),
(238, 28, 'HTC Touch HD', NULL, 20, 136, 0),
(239, 30, 'Canon EOS 5D', NULL, 20, 137, 0),
(240, 47, 'HP LP3065', NULL, 20, 138, 0),
(241, 47, 'HP LP3065', NULL, 50, 138, 0),
(242, 30, 'Canon EOS 5D', NULL, 20, 139, 0),
(243, 40, 'iPhone', NULL, 30, 139, 0),
(244, 30, 'Canon EOS 5D', NULL, 20, 140, 0),
(245, 32, 'iPod Touch', NULL, 50, 140, 0),
(246, 41, 'iMac', NULL, 20, 141, 0),
(247, 30, 'Canon EOS 5D', NULL, 20, 141, 0),
(248, 41, 'iMac', NULL, 20, 142, 0),
(249, 30, 'Canon EOS 5D', NULL, 20, 142, 0),
(250, 47, 'HP LP3065', NULL, 20, 143, 0),
(251, 40, 'iPhone', NULL, 20, 144, 0),
(252, 40, 'iPhone', NULL, 20, 145, 0),
(253, 40, 'iPhone', NULL, 20, 146, 0),
(254, 30, 'Canon EOS 5D', NULL, 20, 147, 0),
(255, 34, 'iPod Shuffle', NULL, 30, 147, 0),
(256, 28, 'HTC Touch HD', NULL, 20, 148, 0),
(257, 30, 'Canon EOS 5D', NULL, 20, 149, 0),
(258, 30, 'Canon EOS 5D', NULL, 50, 150, 0),
(259, 28, 'HTC Touch HD', NULL, 50, 151, 0),
(260, 30, 'Canon EOS 5D', NULL, 20, 152, 0),
(261, 42, 'Apple Cinema 30"', NULL, 50, 153, 0),
(262, 30, 'Canon EOS 5D', NULL, 50, 154, 0),
(263, 30, 'Canon EOS 5D', NULL, 50, 155, 0),
(264, 47, 'HP LP3065', NULL, 50, 156, 0),
(265, 30, 'Canon EOS 5D', NULL, 50, 157, 0),
(266, 30, 'Canon EOS 5D', NULL, 50, 158, 0),
(267, 30, 'Canon EOS 5D', NULL, 50, 159, 0),
(268, 30, 'Canon EOS 5D', NULL, 50, 160, 0),
(269, 30, 'Canon EOS 5D', NULL, 50, 161, 0),
(270, 30, 'Canon EOS 5D', NULL, 50, 162, 0),
(271, 30, 'Canon EOS 5D', NULL, 50, 163, 0),
(272, 30, 'Canon EOS 5D', NULL, 50, 164, 0),
(273, 30, 'Canon EOS 5D', NULL, 50, 165, 0),
(274, 30, 'Canon EOS 5D', NULL, 50, 166, 0),
(275, 30, 'Canon EOS 5D', NULL, 50, 167, 0),
(276, 30, 'Canon EOS 5D', NULL, 50, 168, 0),
(277, 30, 'Canon EOS 5D', NULL, 50, 169, 0),
(278, 30, 'Canon EOS 5D', NULL, 50, 170, 0),
(279, 47, 'HP LP3065', NULL, 50, 171, 0),
(280, 28, 'HTC Touch HD', NULL, 20, 171, 0),
(281, 30, 'Canon EOS 5D', NULL, 50, 172, 0),
(282, 48, 'iPod Classic', NULL, 50, 173, 0),
(283, 48, 'iPod Classic', NULL, 50, 175, 0),
(284, 48, 'iPod Classic', NULL, 50, 176, 0),
(285, 30, 'Canon EOS 5D', NULL, 50, 177, 0),
(286, 30, 'Canon EOS 5D', NULL, 50, 178, 0),
(287, 30, 'Canon EOS 5D', NULL, 20, 179, 0),
(288, 42, 'Apple Cinema 30"', NULL, 20, 180, 0),
(289, 47, 'HP LP3065', NULL, 30, 181, 0),
(290, 30, 'Canon EOS 5D', NULL, 20, 182, 0),
(291, 30, 'Canon EOS 5D', NULL, 20, 183, 0),
(292, 30, 'Canon EOS 5D', NULL, 20, 184, 0),
(293, 28, 'HTC Touch HD', NULL, 30, 185, 0),
(294, 40, 'iPhone', NULL, 30, 186, 0),
(295, 30, 'Canon EOS 5D', NULL, 40, 187, 0),
(296, 41, 'iMac', NULL, 50, 188, 0),
(297, 48, 'iPod Classic', NULL, 50, 189, 0),
(298, 30, 'Canon EOS 5D', NULL, 100, 190, 0),
(299, 43, 'MacBook', NULL, 50, 191, 0),
(300, 30, 'Canon EOS 5D', NULL, 50, 192, 0),
(301, 36, 'iPod Nano', NULL, 20, 193, 0),
(302, 43, 'MacBook', NULL, 50, 194, 0),
(303, 29, 'Palm Treo Pro', NULL, 50, 195, 0),
(304, 47, 'HP LP3065', NULL, 50, 196, 0),
(305, 28, 'HTC Touch HD', NULL, 50, 197, 30),
(306, 30, 'Canon EOS 5D', NULL, 50, 198, 0),
(307, 30, 'Canon EOS 5D', NULL, 50, 199, 30),
(308, 47, 'HP LP3065', NULL, 20, 199, 10),
(309, 30, 'Canon EOS 5D', NULL, 20, 200, 10),
(310, 30, 'Canon EOS 5D', NULL, 30, 200, 20),
(311, 30, 'Canon EOS 5D', NULL, 20, 201, 10),
(312, 28, 'HTC Touch HD', NULL, 50, 201, 40),
(313, 44, 'MacBook Air', NULL, 20, 201, 10),
(314, 28, 'HTC Touch HD', NULL, 50, 202, 20),
(315, 30, 'Canon EOS 5D', NULL, 20, 203, 0),
(316, 30, 'Canon EOS 5D', NULL, 20, 204, 10),
(317, 30, 'Canon EOS 5D', NULL, 50, 205, 0),
(318, 47, 'HP LP3065', NULL, 50, 206, 20),
(319, 28, 'HTC Touch HD', NULL, 50, 207, 50),
(320, 28, 'HTC Touch HD', NULL, 50, 208, 0),
(321, 40, 'iPhone', NULL, 20, 209, 10),
(322, 36, 'iPod Nano', NULL, 20, 210, 0),
(323, 30, 'Canon EOS 5D', NULL, 20, 211, 0),
(324, 30, 'Canon EOS 5D', NULL, 50, 212, 20),
(325, 30, 'Canon EOS 5D', NULL, 20, 213, 20),
(326, 47, 'HP LP3065', NULL, 50, 213, 20),
(327, 45, 'MacBook Pro', NULL, 20, 213, 20),
(328, 35, 'Product 8', NULL, 20, 213, 20),
(329, 28, 'HTC Touch HD', NULL, 50, 214, 10),
(330, 47, 'HP LP3065', NULL, 20, 214, 10),
(331, 29, 'Palm Treo Pro', NULL, 50, 214, 10),
(332, 31, 'Nikon D300', NULL, 50, 214, 50),
(333, 30, 'Canon EOS 5D', NULL, 20, 216, 20),
(334, 30, 'Canon EOS 5D', NULL, 20, 217, 20),
(335, 41, 'iMac', NULL, 50, 218, 50),
(336, 40, 'iPhone', NULL, 100, 218, 100),
(337, 30, 'Canon EOS 5D', NULL, 20, 219, 20),
(338, 28, 'HTC Touch HD', NULL, 20, 219, 20),
(339, 30, 'Canon EOS 5D', NULL, 20, 220, 0),
(340, 28, 'HTC Touch HD', NULL, 20, 221, 20),
(341, 47, 'HP LP3065', NULL, 20, 222, 20),
(342, 28, 'HTC Touch HD', NULL, 20, 223, 10),
(343, 41, 'iMac', NULL, 20, 224, 20),
(344, 41, 'iMac', NULL, 30, 224, 30),
(345, 47, 'HP LP3065', NULL, 20, 225, 20),
(346, 41, 'iMac', NULL, 20, 225, 20),
(347, 30, 'Canon EOS 5D', NULL, 20, 226, 20),
(348, 41, 'iMac', NULL, 20, 226, 20),
(349, 41, 'iMac', NULL, 20, 227, 20),
(350, 36, 'iPod Nano', NULL, 20, 227, 20),
(351, 28, 'HTC Touch HD', NULL, 20, 228, 10),
(352, 28, 'HTC Touch HD', NULL, 30, 228, 30),
(353, 28, 'HTC Touch HD', NULL, 30, 229, 30),
(354, 41, 'iMac', NULL, 20, 229, 20),
(355, 40, 'iPhone', NULL, 20, 230, 10),
(356, 36, 'iPod Nano', NULL, 30, 230, 30),
(357, 47, 'HP LP3065', NULL, 20, 231, 10),
(358, 40, 'iPhone', NULL, 20, 231, 10),
(359, 32, 'iPod Touch', NULL, 50, 231, 50),
(360, 28, 'HTC Touch HD', NULL, 20, 232, 10),
(361, 40, 'iPhone', NULL, 30, 232, 30),
(362, 32, 'iPod Touch', NULL, 50, 232, 50),
(363, 41, 'iMac', NULL, 50, 233, 50),
(364, 48, 'iPod Classic', NULL, 30, 233, 30),
(365, 32, 'iPod Touch', NULL, 50, 233, 50),
(366, 28, 'HTC Touch HD', NULL, 20, 234, 0),
(367, 47, 'HP LP3065', NULL, 20, 235, 0),
(368, 28, 'HTC Touch HD', NULL, 20, 236, 0),
(369, 40, 'iPhone', NULL, 30, 236, 0),
(370, 36, 'iPod Nano', NULL, 20, 237, 0),
(371, 43, 'MacBook', NULL, 20, 237, 0),
(372, 48, 'iPod Classic', NULL, 20, 237, 0),
(373, 28, 'HTC Touch HD', NULL, 30, 238, 0),
(374, 41, 'iMac', NULL, 20, 239, 0),
(375, 41, 'iMac', NULL, 20, 240, 0),
(376, 41, 'iMac', NULL, 60, 241, 60),
(377, 28, 'HTC Touch HD', NULL, 20, 242, 0),
(378, 42, 'Apple Cinema 30"', NULL, 30, 242, 0),
(379, 36, 'iPod Nano', NULL, 30, 243, 30),
(380, 43, 'MacBook', NULL, 60, 243, 60),
(381, 41, 'iMac', NULL, 90, 244, 90),
(382, 34, 'iPod Shuffle', NULL, 60, 244, 60),
(383, 32, 'iPod Touch', NULL, 60, 244, 60),
(384, 47, 'HP LP3065', NULL, 20, 245, 10),
(385, 28, 'HTC Touch HD', NULL, 20, 245, 20),
(386, 47, 'HP LP3065', NULL, 20, 246, 10),
(387, 34, 'iPod Shuffle', NULL, 50, 246, 20),
(388, 41, 'iMac', NULL, 30, 247, 10),
(389, 41, 'iMac', NULL, 50, 247, 30),
(390, 40, 'iPhone', NULL, 200, 248, 200),
(391, 40, 'iPhone', NULL, 50, 248, 20),
(392, 42, 'Apple Cinema 30"', NULL, 30, 249, 10),
(393, 32, 'iPod Touch', NULL, 200, 249, 100),
(394, 48, 'iPod Classic', NULL, 50, 249, 30),
(395, 43, 'MacBook', NULL, 50, 250, 30),
(396, 41, 'iMac', NULL, 200, 251, 100),
(397, 40, 'iPhone', NULL, 300, 251, 50),
(398, 40, 'iPhone', NULL, 100, 252, 0),
(399, 40, 'iPhone', NULL, 20, 253, 10),
(400, 43, 'MacBook', NULL, 50, 253, 50),
(401, 30, 'Canon EOS 5D', NULL, 200, 253, 100),
(402, 47, 'HP LP3065', NULL, 300, 253, 200),
(403, 48, 'iPod Classic', NULL, 30, 254, 20),
(404, 40, 'iPhone', NULL, 300, 255, 100),
(405, 40, 'iPhone', NULL, 200, 255, 120),
(406, 40, 'iPhone', NULL, 100, 255, 100),
(407, 41, 'iMac', NULL, 300, 256, 100),
(408, 41, 'iMac', NULL, 300, 256, 130),
(409, 41, 'iMac', NULL, 200, 256, 100),
(410, 28, 'HTC Touch HD', NULL, 300, 257, 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_po_product`
--
ALTER TABLE `oc_po_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_po_product`
--
ALTER TABLE `oc_po_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;