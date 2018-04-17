/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_product`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_product`;
CREATE TABLE `oc_faq_product` (
  `faq_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  UNIQUE KEY `faq_id` (`faq_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_product
-- ----------------------------
INSERT INTO `oc_faq_product` VALUES ('25', '28');
INSERT INTO `oc_faq_product` VALUES ('25', '41');
INSERT INTO `oc_faq_product` VALUES ('25', '42');
INSERT INTO `oc_faq_product` VALUES ('25', '47');
INSERT INTO `oc_faq_product` VALUES ('26', '41');
INSERT INTO `oc_faq_product` VALUES ('26', '48');
INSERT INTO `oc_faq_product` VALUES ('27', '28');
INSERT INTO `oc_faq_product` VALUES ('27', '48');
