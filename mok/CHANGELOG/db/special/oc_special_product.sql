/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2017-01-16 11:52:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_special_product`
-- ----------------------------
DROP TABLE IF EXISTS `oc_special_product`;
CREATE TABLE `oc_special_product` (
  `special_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `special_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`special_product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_special_product
-- ----------------------------
INSERT INTO `oc_special_product` VALUES ('42', '5', '90');
INSERT INTO `oc_special_product` VALUES ('41', '5', '93');
INSERT INTO `oc_special_product` VALUES ('40', '5', '87');
INSERT INTO `oc_special_product` VALUES ('39', '5', '92');
