/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_category`;
CREATE TABLE `oc_faq_category` (
  `faq_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`faq_category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_category
-- ----------------------------
INSERT INTO `oc_faq_category` VALUES ('13', '0', '1', '1', '2016-02-19 14:01:16', '2016-02-19 14:01:16');
INSERT INTO `oc_faq_category` VALUES ('14', '0', '2', '1', '2016-02-19 14:01:59', '2016-02-19 14:01:59');
INSERT INTO `oc_faq_category` VALUES ('15', '13', '1', '1', '2016-02-19 14:02:44', '2016-02-19 14:02:44');
INSERT INTO `oc_faq_category` VALUES ('16', '13', '2', '1', '2016-02-19 14:03:23', '2016-08-22 15:03:20');
