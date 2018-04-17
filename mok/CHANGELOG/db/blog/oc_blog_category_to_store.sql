/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:47:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_category_to_store`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_category_to_store`;
CREATE TABLE `oc_blog_category_to_store` (
  `blog_category_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_category_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_category_to_store
-- ----------------------------
INSERT INTO `oc_blog_category_to_store` VALUES ('1', '0');
INSERT INTO `oc_blog_category_to_store` VALUES ('2', '0');
INSERT INTO `oc_blog_category_to_store` VALUES ('5', '0');
INSERT INTO `oc_blog_category_to_store` VALUES ('6', '0');
