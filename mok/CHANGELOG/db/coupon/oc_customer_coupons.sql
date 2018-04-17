/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 10:46:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_customer_coupons`
-- ----------------------------
DROP TABLE IF EXISTS `oc_customer_coupons`;
CREATE TABLE `oc_customer_coupons` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户优惠券id，主键',
  `coupon_id` int(10) NOT NULL COMMENT '优惠券id',
  `coupon_code` int(11) NOT NULL COMMENT '优惠券代码',
  `customer_id` int(10) NOT NULL COMMENT '会员id',
  `customer_name` varchar(100) NOT NULL COMMENT '会员名称',
  `status` char(1) NOT NULL COMMENT '优惠券状态：N 正常，U 已使用',
  `created` datetime NOT NULL COMMENT '创建时间',
  `modified` datetime NOT NULL COMMENT '最后修改时间',
  `used_time` datetime NOT NULL COMMENT '使用时间',
  `trade_sn` varchar(15) NOT NULL COMMENT '交易编号',
  `coupon_region` char(1) NOT NULL COMMENT '优惠券作用域 M：主站，W：批发站',
  PRIMARY KEY (`id`),
  KEY `user_coupon_tradesn_idx` (`trade_sn`),
  KEY `user_coupon_ctime_idx` (`created`),
  KEY `user_coupon_utime_idx` (`used_time`),
  KEY `user_memberid_coupon_id_idx` (`customer_id`,`coupon_id`),
  KEY `couponid_status_expire_idx` (`coupon_id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户优惠券表';

-- ----------------------------
-- Records of oc_customer_coupons
-- ----------------------------
INSERT INTO `oc_customer_coupons` VALUES ('1', '6', '0', '1', 'hualong', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('2', '6', '0', '1', 'hualong', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('3', '6', '0', '15', '皇德', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('4', '6', '0', '15', '皇德', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('5', '6', '0', '16', '123', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('6', '6', '0', '16', '123', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('7', '6', '0', '17', '', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('8', '6', '0', '17', '', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('12', '6', '0', '25', '', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('13', '6', '0', '26', '', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('14', '6', '0', '26', '', 'N', '2016-12-09 11:16:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('15', '5', '3333', '24', '', 'N', '2016-12-09 12:05:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('17', '5', '0', '1', 'hualong', 'N', '2016-12-09 17:25:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('18', '5', '0', '1', 'hualong', 'N', '2016-12-09 17:25:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('19', '5', '0', '1', 'hualong', 'N', '2016-12-09 17:25:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('20', '5', '0', '1', 'hualong', 'N', '2016-12-09 17:25:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('21', '5', '0', '1', 'hualong', 'N', '2016-12-09 17:25:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('22', '6', '0', '1', 'hualong', 'N', '2016-12-09 18:44:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('23', '6', '0', '1', 'hualong', 'N', '2016-12-09 18:44:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('24', '6', '0', '15', '皇德', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('25', '6', '0', '15', '皇德', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('26', '6', '0', '16', '123', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('27', '6', '0', '16', '123', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('28', '6', '0', '17', '', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('29', '6', '0', '17', '', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('32', '6', '0', '25', '', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('33', '6', '0', '25', '', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('34', '6', '0', '26', '', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('35', '6', '0', '26', '', 'N', '2016-12-09 18:44:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('40', '4', '2222', '24', 'hehe', 'N', '2016-12-22 10:52:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('41', '6', '1111', '24', 'hehe', 'N', '2016-12-22 10:52:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('42', '4', '2222', '24', 'hehe', 'N', '2016-12-22 10:58:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('43', '5', '3333', '24', 'hehe', 'N', '2016-12-23 20:12:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('44', '5', '3333', '24', 'hehe', 'N', '2016-12-23 20:12:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('45', '5', '3333', '24', 'hehe', 'N', '2016-12-23 20:12:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
INSERT INTO `oc_customer_coupons` VALUES ('46', '5', '3333', '24', 'hehe', 'N', '2016-12-23 20:12:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'M');
