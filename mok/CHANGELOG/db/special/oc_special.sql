/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2017-01-16 11:52:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_special`
-- ----------------------------
DROP TABLE IF EXISTS `oc_special`;
CREATE TABLE `oc_special` (
  `special_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `type` char(1) NOT NULL,
  `discount` decimal(15,4) NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `shipping` tinyint(1) NOT NULL,
  `total` decimal(15,4) NOT NULL,
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `uses_total` int(11) NOT NULL,
  `uses_customer` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`special_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_special
-- ----------------------------
INSERT INTO `oc_special` VALUES ('7', 'catalog/专题/3雾霾.jpg', 'wumai', 'P', '0.0000', '0', '0', '0.0000', '2016-12-29', '2017-01-29', '0', '0', '1', '2016-12-29 16:10:14');
INSERT INTO `oc_special` VALUES ('5', 'catalog/专题/2爆款.jpg', 'hot goods', 'P', '0.0000', '0', '0', '0.0000', '2017-01-01', '2018-01-01', '0', '0', '1', '2009-03-14 21:13:53');
INSERT INTO `oc_special` VALUES ('6', 'catalog/专题/1新品.jpg', 'new goods', 'P', '0.0000', '0', '0', '0.0000', '2014-01-01', '2020-01-01', '0', '0', '1', '2009-03-14 21:15:18');
