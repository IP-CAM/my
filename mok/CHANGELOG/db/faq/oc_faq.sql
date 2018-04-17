/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq`;
CREATE TABLE `oc_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq
-- ----------------------------
INSERT INTO `oc_faq` VALUES ('25', null, '1', '1', '2016-02-19 14:09:56', '2016-03-13 16:40:19');
INSERT INTO `oc_faq` VALUES ('26', null, '1', '1', '2016-02-19 14:10:24', '2016-02-19 14:40:46');
INSERT INTO `oc_faq` VALUES ('27', null, '1', '1', '2016-02-19 14:10:56', '2016-02-19 14:40:58');
INSERT INTO `oc_faq` VALUES ('28', null, '1', '1', '2016-02-25 10:23:07', '0000-00-00 00:00:00');
INSERT INTO `oc_faq` VALUES ('29', null, '1', '1', '2016-02-25 10:23:28', '0000-00-00 00:00:00');
INSERT INTO `oc_faq` VALUES ('30', null, '1', '1', '2016-02-25 10:23:49', '0000-00-00 00:00:00');
INSERT INTO `oc_faq` VALUES ('31', null, '1', '1', '2016-02-25 10:24:07', '0000-00-00 00:00:00');
INSERT INTO `oc_faq` VALUES ('32', null, '1', '1', '2016-02-25 10:24:25', '0000-00-00 00:00:00');
INSERT INTO `oc_faq` VALUES ('33', null, '1', '1', '2016-02-25 10:24:41', '0000-00-00 00:00:00');
INSERT INTO `oc_faq` VALUES ('34', null, '1', '1', '2016-02-25 10:24:57', '2016-12-25 16:26:22');
