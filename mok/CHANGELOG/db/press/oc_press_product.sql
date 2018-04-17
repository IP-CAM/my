/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:10:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_press_product`
-- ----------------------------
DROP TABLE IF EXISTS `oc_press_product`;
CREATE TABLE `oc_press_product` (
  `press_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  UNIQUE KEY `press_id` (`press_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_press_product
-- ----------------------------
INSERT INTO `oc_press_product` VALUES ('1', '28');
INSERT INTO `oc_press_product` VALUES ('1', '41');
INSERT INTO `oc_press_product` VALUES ('1', '42');
INSERT INTO `oc_press_product` VALUES ('1', '47');
INSERT INTO `oc_press_product` VALUES ('1', '48');
INSERT INTO `oc_press_product` VALUES ('2', '41');
INSERT INTO `oc_press_product` VALUES ('2', '47');
