-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-05-18 10:38:54
-- 服务器版本： 5.5.53
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp5`
--

-- --------------------------------------------------------

--
-- 表的结构 `rt_order_refund`
--

CREATE TABLE `rt_order_refund` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL COMMENT '订单ID',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `nickname` varchar(100) NOT NULL COMMENT '用户昵称',
  `orderprice` decimal(10,2) NOT NULL COMMENT '订单金额',
  `applyprice` decimal(10,2) NOT NULL COMMENT '申请退款金额',
  `rtype` tinyint(1) NOT NULL COMMENT '申请类型 0 退款(仅退款不退货) 1 退款退货 2 换货 ',
  `status` tinyint(1) NOT NULL COMMENT '状态 0申请 1 通过（等待商家寄回商品）2通过申请(需客户寄回商品) 3等待商家确认收货 4等待买家确认收货 5 关闭申请(换货完成) -1 驳回 -2 客户取消 ',
  `createtime` int(11) NOT NULL COMMENT '建立时间',
  `operatetime` int(11) NOT NULL COMMENT '操作时间',
  `sendtime` int(11) NOT NULL COMMENT '发送时间',
  `returntime` int(11) NOT NULL COMMENT '返回时间',
  `refundtime` int(11) NOT NULL COMMENT '退款时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单退款表';

--
-- 转存表中的数据 `rt_order_refund`
--

INSERT INTO `rt_order_refund` (`id`, `orderid`, `user_id`, `nickname`, `orderprice`, `applyprice`, `rtype`, `status`, `createtime`, `operatetime`, `sendtime`, `returntime`, `refundtime`, `endtime`) VALUES
(1, 1, 2, '雪', '1.00', '1.00', 1, 0, 1495101816, 1495101816, 1495101816, 1495101816, 1495101816, 1495101816),
(2, 2, 1, '雪', '1000.00', '100.00', 1, 2, 1495101816, 1495101816, 1495101816, 1495101816, 1495101816, 1495101816);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rt_order_refund`
--
ALTER TABLE `rt_order_refund`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `order_id` (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `rt_order_refund`
--
ALTER TABLE `rt_order_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
