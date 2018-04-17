/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:10:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_press_to_press_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_press_to_press_category`;
CREATE TABLE `oc_press_to_press_category` (
  `press_id` int(11) NOT NULL,
  `press_category_id` int(11) NOT NULL,
  PRIMARY KEY (`press_id`,`press_category_id`),
  KEY `press_category_id` (`press_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_press_to_press_category
-- ----------------------------
INSERT INTO `oc_press_to_press_category` VALUES ('1', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('2', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('3', '1');
INSERT INTO `oc_press_to_press_category` VALUES ('3', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('4', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('5', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('6', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('7', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('8', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('9', '2');
INSERT INTO `oc_press_to_press_category` VALUES ('10', '2');
