-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-05-18 10:38:37
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
-- 表的结构 `rt_order_order`
--

CREATE TABLE `rt_order_order` (
  `order_id` bigint(15) UNSIGNED NOT NULL,
  `order_sn` varchar(20) NOT NULL DEFAULT '',
  `order_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单类型 1正常订单 0系统自动生成',
  `user_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `order_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单状态 0待确认订单 1生成订单,2取消订单(客户触发),3作废订单(管理员触发),4完成订单,5售后 6取消订单（系统执行）',
  `shipping_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品配送情况;0未发货,1已发货,2已收货',
  `pay_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '支付状态;0未付款;1付款中;2已付款 ',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的姓名',
  `country` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '收货人的国家',
  `province` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '收货人的省份',
  `city` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '收货人的城市',
  `district` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '收货人的地区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '收货人的详细地址',
  `zipcode` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的邮编',
  `tel` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的电话',
  `mobile` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的手机',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的Email',
  `best_time` varchar(120) NOT NULL DEFAULT '' COMMENT '收货人的最佳送货时间',
  `sign_building` varchar(120) NOT NULL DEFAULT '' COMMENT '送货人的地址的标志性建筑',
  `postscript` varchar(255) NOT NULL DEFAULT '' COMMENT '订单附言,由用户提交订单前填写',
  `shipping_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '用户选择的配送方式id',
  `shipping_name` varchar(120) NOT NULL DEFAULT '' COMMENT '用户选择的配送方式的名称',
  `pay_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '用户选择的支付方式的id',
  `pay_name` varchar(120) NOT NULL DEFAULT '' COMMENT '用户选择的支付方式名称',
  `how_oos` varchar(120) NOT NULL DEFAULT '' COMMENT '缺货处理方式',
  `how_surplus` varchar(120) NOT NULL DEFAULT '',
  `pack_name` varchar(120) NOT NULL DEFAULT '' COMMENT '包装名称',
  `card_name` varchar(120) NOT NULL DEFAULT '' COMMENT '贺卡的名称',
  `card_message` varchar(255) NOT NULL DEFAULT '' COMMENT '贺卡内容',
  `inv_payee` varchar(120) NOT NULL DEFAULT '' COMMENT '发票抬头',
  `inv_content` varchar(120) NOT NULL DEFAULT '' COMMENT '发票内容',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品的总金额',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '配送费用',
  `insure_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '保价费用',
  `pay_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付费用',
  `pack_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '包装费用',
  `card_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '贺卡费用',
  `money_paid` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '已付款金额',
  `surplus` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '该订单使用金额的数量,取用户设定余额,用户可用余额,订单金额中最小者 ',
  `integral` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '使用的积分的数量,取用户使用积分,商品可用积分,用户拥有积分中最小者 ',
  `integral_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用积分金额',
  `bonus` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用红包金额',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应付款金额',
  `from_ad` smallint(5) NOT NULL DEFAULT '0' COMMENT '订单由某广告带来的广告id',
  `referer` varchar(255) NOT NULL DEFAULT '' COMMENT '订单的来源页面',
  `platform_type` varchar(8) NOT NULL DEFAULT 'pc',
  `add_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `confirm_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单确认时间',
  `pay_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单支付时间',
  `shipping_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '订单配送时间',
  `pack_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '包装id',
  `card_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '贺卡id',
  `bonus_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '红包id',
  `invoice_no` varchar(255) NOT NULL DEFAULT '' COMMENT '发货单号',
  `extension_code` varchar(30) NOT NULL DEFAULT '' COMMENT '通过活动购买的商品的代号,group_buy是团购; auction是拍卖;snatch夺宝奇兵;正常普通产品该处理为空 ',
  `extension_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '通过活动购买的物品id,取值ecs_good_activity;如果是正常普通商品,该处为0 ',
  `to_buyer` varchar(255) NOT NULL DEFAULT '' COMMENT '商家给客户的留言,当该字段值时可以在订单查询看到 ',
  `pay_note` varchar(255) NOT NULL DEFAULT '' COMMENT '付款备注',
  `agency_id` smallint(5) UNSIGNED NOT NULL COMMENT '该笔订单被指派给的办事处的id, 根据订单内容和办事处负责范围自动决定,也可以有管理员修改,取值于表agency',
  `inv_type` varchar(60) NOT NULL COMMENT '发票类型',
  `tax` decimal(10,2) NOT NULL COMMENT '发票税额',
  `trade_no` varchar(255) NOT NULL COMMENT '支付平台返回的流水号',
  `is_separate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未分成或等待分成;1已分成;2取消分成 ',
  `parent_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级id',
  `discount` decimal(10,2) NOT NULL,
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  `is_checkout` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否给商家货款',
  `langid` text NOT NULL COMMENT '下单所处语言',
  `partner` varchar(8) NOT NULL COMMENT '合作商',
  `pay_ip` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '支付IP',
  `pay_account` varchar(25) NOT NULL COMMENT '支付账户',
  `cancel_reason` varchar(255) NOT NULL COMMENT '取消原因',
  `cancel_time` int(11) NOT NULL COMMENT '订单取消时间',
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主订单表';

--
-- 转存表中的数据 `rt_order_order`
--

INSERT INTO `rt_order_order` (`order_id`, `order_sn`, `order_type`, `user_id`, `order_status`, `shipping_status`, `pay_status`, `consignee`, `country`, `province`, `city`, `district`, `address`, `zipcode`, `tel`, `mobile`, `email`, `best_time`, `sign_building`, `postscript`, `shipping_id`, `shipping_name`, `pay_id`, `pay_name`, `how_oos`, `how_surplus`, `pack_name`, `card_name`, `card_message`, `inv_payee`, `inv_content`, `goods_amount`, `shipping_fee`, `insure_fee`, `pay_fee`, `pack_fee`, `card_fee`, `money_paid`, `surplus`, `integral`, `integral_money`, `bonus`, `order_amount`, `from_ad`, `referer`, `platform_type`, `add_time`, `confirm_time`, `pay_time`, `shipping_time`, `pack_id`, `card_id`, `bonus_id`, `invoice_no`, `extension_code`, `extension_id`, `to_buyer`, `pay_note`, `agency_id`, `inv_type`, `tax`, `trade_no`, `is_separate`, `parent_id`, `discount`, `seller_id`, `is_checkout`, `langid`, `partner`, `pay_ip`, `pay_account`, `cancel_reason`, `cancel_time`, `status`) VALUES
(1, '2009051298180', 1, 1, 5, 0, 1, '刘先生', 1, 2, 52, 500, '[中国 北京 北京 海淀区] 中关村海兴大厦', '100085', '010-25851234', '13986765412', 'ecshop@ecshop.com', '中午', '法院', '', 5, '申通快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '385.00', '15.00', '0.00', '0.00', '0.00', '0.00', '0.00', '400.00', 0, '0.00', '0.00', '0.00', 0, '本站', 'pc', 1242142274, 1242142274, 1242142274, 1242142432, 0, 0, 0, '122', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(2, '2009051255518', 1, 1, 4, 2, 2, '刘先生', 1, 2, 52, 500, '[中国 北京 北京 海淀区] 中关村海兴大厦', '100085', '010-25851234', '13986765412', 'ecshop@ecshop.com', '中午', '法院', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '精品包装', '祝福贺卡', '晚来的祝福', '', '', '960.00', '10.00', '0.00', '0.00', '0.00', '5.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', 0, '本站', 'app', 1242142324, 1242142324, 1242142324, 1242142389, 1, 1, 0, '111', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(3, '2009051267570', 1, 1, 3, 0, 0, '刘先生', 1, 2, 52, 500, '[中国 北京 北京 海淀区] 中关村海兴大厦', '100085', '010-25851234', '13986765412', 'ecshop@ecshop.com', '中午', '法院', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '2300.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', 0, '本站', 'pc', 1242142549, 1242142549, 1242142549, 1242142589, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(4, '2009051230249', 1, 1, 1, 0, 2, '刘先生', 1, 2, 52, 500, '[中国 北京 北京 海淀区] 中关村海兴大厦', '100085', '010-25851234', '13986765412', 'ecshop@ecshop.com', '中午', '法院', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '5999.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5989.00', 0, '0.00', '20.00', '0.00', 0, '本站', 'wechat', 1242142681, 1242142681, 1242142681, 0, 0, 0, 1, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(5, '2009051276258', 1, 1, 1, 3, 2, '刘先生', 1, 2, 52, 500, '[中国 北京 北京 海淀区] 中关村海兴大厦', '100085', '010-25851234', '13986765412', 'ecshop@ecshop.com', '中午', '法院', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '8600.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '8610.00', 0, '0.00', '0.00', '0.00', 0, '本站', 'wechat', 1242142808, 1242142808, 1242142808, 0, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(6, '2009051217221', 1, 3, 4, 2, 2, '叶先生', 1, 2, 52, 510, '通州区旗舰凯旋小区', '', '13588104710', '', 'text@ecshop.com', '', '', '', 5, '申通快递', 2, '转帐/汇款', '等待所有商品备齐后再发', '', '', '', '', '', '', '20.00', '15.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '35.00', 0, '', 'pc', 1242143292, 0, 0, 0, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(7, '2009051227085', 1, 3, 1, 0, 2, '叶先生', 1, 2, 52, 510, '通州区旗舰凯旋小区', '', '13588104710', '', 'text@ecshop.com', '', '', '', 5, '申通快递', 2, '转帐/汇款', '等待所有商品备齐后再发', '', '', '', '', '', '', '2298.00', '15.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1000.00', 0, '0.00', '0.00', '1198.10', 0, '', 'wap', 1242143383, 1242143454, 0, 0, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '114.90', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(8, '2009051299732', 1, 3, 1, 0, 2, '叶先生', 1, 2, 52, 510, '通州区旗舰凯旋小区', '', '13588104710', '', 'text@ecshop.com', '', '', '', 5, '申通快递', 2, '转帐/汇款', '等待所有商品备齐后再发', '', '', '', '', '', '', '623.00', '15.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '638.00', 0, '', 'wap', 1242143444, 1420606339, 0, 0, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(9, '2009051210718', 1, 3, 1, 0, 2, '叶先生', 1, 2, 52, 510, '通州区旗舰凯旋小区', '', '13588104710', '', 'text@ecshop.com', '', '', '', 5, '申通快递', 2, '转帐/汇款', '等待所有商品备齐后再发', '', '', '', '', '', '', '2000.00', '15.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '2015.00', 0, '', 'pc', 1242143732, 1420606339, 0, 0, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(10, '2009051268194', 1, 1, 1, 0, 2, '刘先生', 1, 2, 52, 500, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '10.00', 17000, '0.00', '0.00', '0.00', 0, '', 'pc', 1242143920, 1242143920, 1242143920, 0, 0, 0, 0, '', 'exchange_goods', 24, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(11, '2009051264945', 1, 0, 1, 0, 2, '林小姐', 1, 2, 52, 500, '中关村海兴大厦', '', '135474510', '', 'linzi@116.com', '', '', '', 3, '城际快递', 2, '转帐/汇款', '', '', '', '', '', '', '', '3800.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '3810.00', 0, '管理员添加', 'pc', 1242144250, 1242144363, 0, 0, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(12, '2009051712919', 1, 1, 4, 2, 2, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 3, '货到付款', '等待所有商品备齐后再发', '', '', '', '', '', '', '238.00', '10.00', '0.00', '5.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '253.00', 0, '本站', 'pc', 1242576304, 0, 0, 0, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(13, '2009051719232', 1, 1, 1, 1, 2, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 3, '货到付款', '等待所有商品备齐后再发', '', '', '', '', '', '', '960.00', '10.00', '0.00', '5.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '975.00', 0, '本站', 'other', 1242576341, 1242576445, 0, 1242576445, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(14, '2009052224892', 1, 1, 1, 1, 2, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '14045.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '13806.60', 0, '0.00', '5.00', '0.00', 0, '本站', 'other', 1242976699, 1242976699, 1242976699, 1242976740, 0, 0, 2, '1123344', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '243.40', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(15, '2009061585887', 1, 1, 4, 2, 2, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 2, '转帐/汇款', '等待所有商品备齐后再发', '', '', '', '', '', '', '17044.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '17054.00', 0, '本站', 'pc', 1245044533, 1245044587, 1245044644, 1245045443, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(16, '2009061525429', 1, 1, 1, 1, 2, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '3186.30', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '3196.30', 0, '0.00', '0.00', '0.00', 0, '本站', 'pc', 1245045672, 1245045672, 1245045672, 1245045723, 0, 0, 0, '2009061525121', 'Promotion', 2, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(17, '2009061503335', 1, 1, 4, 2, 2, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '1900.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, '0.00', '0.00', '0.00', 0, '本站', 'app', 1245047978, 1245047978, 1245047978, 1245048189, 0, 0, 0, '', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(18, '2009061510313', 1, 1, 1, 0, 2, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '500.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '500.00', 0, '0.00', '0.00', '0.00', 0, '本站', 'pc', 1245048585, 1245048585, 1245048585, 0, 0, 0, 0, '', 'Group', 8, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0),
(19, '2009061909851', 1, 1, 1, 0, 0, '刘先生', 1, 2, 52, 502, '海兴大厦', '', '010-25851234', '13986765412', 'ecshop@ecshop.com', '', '', '', 3, '城际快递', 1, '余额支付', '等待所有商品备齐后再发', '', '', '', '', '', '', '5567.70', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '5577.70', 0, '0.00', '0.00', '0.00', 0, '本站', 'pc', 1245384008, 1245384008, 1245384008, 1245384049, 0, 0, 0, '232421', '', 0, '', '', 0, '', '0.00', '13213212313', 0, 0, '0.00', 0, 0, '', '', 292424497, 'zhifuzhanghu', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rt_order_order`
--
ALTER TABLE `rt_order_order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_sn` (`order_sn`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_status` (`order_status`),
  ADD KEY `shipping_status` (`shipping_status`),
  ADD KEY `pay_status` (`pay_status`),
  ADD KEY `shipping_id` (`shipping_id`),
  ADD KEY `pay_id` (`pay_id`),
  ADD KEY `extension_code` (`extension_code`,`extension_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `rt_order_order`
--
ALTER TABLE `rt_order_order`
  MODIFY `order_id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
