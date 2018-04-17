/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 11:02:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_qq_connect`
-- ----------------------------
DROP TABLE IF EXISTS `oc_qq_connect`;
CREATE TABLE `oc_qq_connect` (
  `connect_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `open_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`connect_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of oc_qq_connect
-- ----------------------------
INSERT INTO `oc_qq_connect` VALUES ('6', '25', '7E497D0985349A464AD6D81517EF9F4E', '0864C49D8D68174247CDD519BA1054E1', '麦芽糖', 'http://qzapp.qlogo.cn/qzapp/101251366/7E497D0985349A464AD6D81517EF9F4E/100');
