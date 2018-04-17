/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:10:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_press`
-- ----------------------------
DROP TABLE IF EXISTS `oc_press`;
CREATE TABLE `oc_press` (
  `press_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`press_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_press
-- ----------------------------
INSERT INTO `oc_press` VALUES ('1', '', '1', '1', '2015-12-29 19:27:12', '2016-02-25 13:55:10');
INSERT INTO `oc_press` VALUES ('2', '', '2', '1', '2016-02-18 14:02:30', '2016-02-18 14:02:51');
INSERT INTO `oc_press` VALUES ('3', '', '1', '1', '2016-02-18 14:35:34', '0000-00-00 00:00:00');
INSERT INTO `oc_press` VALUES ('4', '', '1', '1', '2016-02-25 10:35:26', '2016-08-22 12:06:16');
INSERT INTO `oc_press` VALUES ('5', '', '1', '1', '2016-02-25 10:40:23', '2016-08-22 12:06:23');
INSERT INTO `oc_press` VALUES ('6', '', '1', '1', '2016-02-25 10:40:51', '0000-00-00 00:00:00');
INSERT INTO `oc_press` VALUES ('7', '', '1', '1', '2016-02-25 10:41:20', '0000-00-00 00:00:00');
INSERT INTO `oc_press` VALUES ('8', '', '1', '1', '2016-02-25 10:41:47', '0000-00-00 00:00:00');
INSERT INTO `oc_press` VALUES ('9', '', '1', '1', '2016-02-25 10:42:17', '0000-00-00 00:00:00');
INSERT INTO `oc_press` VALUES ('10', '', '1', '1', '2016-02-25 10:42:48', '2016-08-22 12:06:01');
