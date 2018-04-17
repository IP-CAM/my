/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:10:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_press_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_press_category`;
CREATE TABLE `oc_press_category` (
  `press_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`press_category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_press_category
-- ----------------------------
INSERT INTO `oc_press_category` VALUES ('1', '', '0', '0', '1', '2015-12-29 19:20:03', '2016-02-09 21:35:11');
INSERT INTO `oc_press_category` VALUES ('2', 'catalog/demo/28_2.jpg', '0', '0', '1', '2015-12-29 19:25:58', '2016-02-09 21:35:26');
