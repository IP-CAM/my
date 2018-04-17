/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:47:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_product`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_product`;
CREATE TABLE `oc_blog_product` (
  `blog_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  UNIQUE KEY `blog_id` (`blog_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_product
-- ----------------------------
INSERT INTO `oc_blog_product` VALUES ('2', '48');
