/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_to_faq_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_to_faq_category`;
CREATE TABLE `oc_faq_to_faq_category` (
  `faq_id` int(11) NOT NULL,
  `faq_category_id` int(11) NOT NULL,
  PRIMARY KEY (`faq_id`,`faq_category_id`),
  KEY `faq_category_id` (`faq_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_to_faq_category
-- ----------------------------
INSERT INTO `oc_faq_to_faq_category` VALUES ('25', '13');
INSERT INTO `oc_faq_to_faq_category` VALUES ('25', '15');
INSERT INTO `oc_faq_to_faq_category` VALUES ('26', '13');
INSERT INTO `oc_faq_to_faq_category` VALUES ('26', '16');
INSERT INTO `oc_faq_to_faq_category` VALUES ('27', '14');
INSERT INTO `oc_faq_to_faq_category` VALUES ('28', '16');
INSERT INTO `oc_faq_to_faq_category` VALUES ('29', '16');
INSERT INTO `oc_faq_to_faq_category` VALUES ('30', '16');
INSERT INTO `oc_faq_to_faq_category` VALUES ('31', '16');
INSERT INTO `oc_faq_to_faq_category` VALUES ('32', '16');
INSERT INTO `oc_faq_to_faq_category` VALUES ('33', '16');
INSERT INTO `oc_faq_to_faq_category` VALUES ('34', '13');
INSERT INTO `oc_faq_to_faq_category` VALUES ('34', '14');
INSERT INTO `oc_faq_to_faq_category` VALUES ('34', '15');
INSERT INTO `oc_faq_to_faq_category` VALUES ('34', '16');
