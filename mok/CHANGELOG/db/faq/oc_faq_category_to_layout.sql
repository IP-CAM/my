/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_category_to_layout`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_category_to_layout`;
CREATE TABLE `oc_faq_category_to_layout` (
  `faq_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_category_to_layout
-- ----------------------------
INSERT INTO `oc_faq_category_to_layout` VALUES ('13', '0', '0');
INSERT INTO `oc_faq_category_to_layout` VALUES ('14', '0', '0');
INSERT INTO `oc_faq_category_to_layout` VALUES ('15', '0', '0');
INSERT INTO `oc_faq_category_to_layout` VALUES ('16', '0', '0');
