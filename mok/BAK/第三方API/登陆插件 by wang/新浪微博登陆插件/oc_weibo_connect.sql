/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : mannay

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2016-11-21 23:26:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_weibo_connect`
-- ----------------------------
DROP TABLE IF EXISTS `oc_weibo_connect`;
CREATE TABLE `oc_weibo_connect` (
  `connect_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `weibo_uid` varchar(20) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  PRIMARY KEY (`connect_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_weibo_connect
-- ----------------------------
INSERT INTO `oc_weibo_connect` VALUES ('2', '2', '1876624880', '盼盼乖宝贝');
