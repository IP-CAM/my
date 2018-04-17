/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:46:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_category_path`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_category_path`;
CREATE TABLE `oc_blog_category_path` (
  `blog_category_id` int(11) NOT NULL,
  `path_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`blog_category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_category_path
-- ----------------------------
INSERT INTO `oc_blog_category_path` VALUES ('1', '1', '0');
INSERT INTO `oc_blog_category_path` VALUES ('2', '2', '0');
INSERT INTO `oc_blog_category_path` VALUES ('5', '1', '0');
INSERT INTO `oc_blog_category_path` VALUES ('5', '5', '1');
INSERT INTO `oc_blog_category_path` VALUES ('6', '6', '0');
