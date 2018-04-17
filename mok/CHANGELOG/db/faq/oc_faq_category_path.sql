/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_category_path`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_category_path`;
CREATE TABLE `oc_faq_category_path` (
  `faq_category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_category_path
-- ----------------------------
INSERT INTO `oc_faq_category_path` VALUES ('13', '13', '0');
INSERT INTO `oc_faq_category_path` VALUES ('14', '14', '0');
INSERT INTO `oc_faq_category_path` VALUES ('15', '13', '0');
INSERT INTO `oc_faq_category_path` VALUES ('15', '15', '1');
INSERT INTO `oc_faq_category_path` VALUES ('16', '13', '0');
INSERT INTO `oc_faq_category_path` VALUES ('16', '16', '1');
