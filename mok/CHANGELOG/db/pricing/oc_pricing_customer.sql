/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 11:00:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_pricing_customer`
-- ----------------------------
DROP TABLE IF EXISTS `oc_pricing_customer`;
CREATE TABLE `oc_pricing_customer` (
  `pricing_customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `pricing_id` int(11) NOT NULL COMMENT '定价活动ID',
  `customer_id` int(11) NOT NULL COMMENT '用户ID',
  `price` decimal(10,2) NOT NULL COMMENT '报价',
  `status` char(1) NOT NULL COMMENT '状态',
  `created` datetime NOT NULL COMMENT '报名时间',
  PRIMARY KEY (`pricing_customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户参加定价活动';

-- ----------------------------
-- Records of oc_pricing_customer
-- ----------------------------
INSERT INTO `oc_pricing_customer` VALUES ('1', '8', '15', '100.00', '0', '0000-00-00 00:00:00');
INSERT INTO `oc_pricing_customer` VALUES ('2', '9', '23', '80.00', '1', '0000-00-00 00:00:00');
INSERT INTO `oc_pricing_customer` VALUES ('4', '8', '24', '100.00', '0', '2016-12-21 16:18:36');
