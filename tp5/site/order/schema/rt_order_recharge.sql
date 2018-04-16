-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-05-18 10:39:10
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
-- 表的结构 `rt_order_recharge`
--

CREATE TABLE `rt_order_recharge` (
  `order_id` int(11) NOT NULL COMMENT '充值订单id',
  `rec_sn` varchar(25) NOT NULL COMMENT '充值订单号',
  `userid` int(11) NOT NULL COMMENT '用户id',
  `rec_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `rec_account` varchar(35) NOT NULL DEFAULT '0' COMMENT '充值账户',
  `pay_name` varchar(20) NOT NULL DEFAULT '0' COMMENT '支付方式',
  `pay_id` tinyint(1) NOT NULL COMMENT '支付方式id',
  `trade_no` varchar(35) NOT NULL DEFAULT '0' COMMENT '支付流水号',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `rec_ip` bigint(20) NOT NULL COMMENT '充值ip地址',
  `finish_time` int(11) NOT NULL COMMENT '完成时间',
  `referer` varchar(25) NOT NULL COMMENT '来源',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '充值状态 4无效订单 1申请中 2充值中 3充值完成'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单模块充值表';

--
-- 转存表中的数据 `rt_order_recharge`
--

INSERT INTO `rt_order_recharge` (`order_id`, `rec_sn`, `userid`, `rec_money`, `rec_account`, `pay_name`, `pay_id`, `trade_no`, `create_time`, `rec_ip`, `finish_time`, `referer`, `status`) VALUES
(1, '1231321131', 1, '100.00', '12122121', 'alipay', 1, 'dsa123123123', 1435222222, 0, 1435522222, '', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rt_order_recharge`
--
ALTER TABLE `rt_order_recharge`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `rec_sn` (`rec_sn`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `rt_order_recharge`
--
ALTER TABLE `rt_order_recharge`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '充值订单id', AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
