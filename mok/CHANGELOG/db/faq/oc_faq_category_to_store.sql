/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_category_to_store`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_category_to_store`;
CREATE TABLE `oc_faq_category_to_store` (
  `faq_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_category_to_store
-- ----------------------------
INSERT INTO `oc_faq_category_to_store` VALUES ('13', '0');
INSERT INTO `oc_faq_category_to_store` VALUES ('14', '0');
INSERT INTO `oc_faq_category_to_store` VALUES ('15', '0');
INSERT INTO `oc_faq_category_to_store` VALUES ('16', '0');
