/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:47:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_to_blog_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_to_blog_category`;
CREATE TABLE `oc_blog_to_blog_category` (
  `blog_id` int(11) NOT NULL,
  `blog_category_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`,`blog_category_id`),
  KEY `blog_category_id` (`blog_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_to_blog_category
-- ----------------------------
INSERT INTO `oc_blog_to_blog_category` VALUES ('2', '1');
INSERT INTO `oc_blog_to_blog_category` VALUES ('2', '2');
INSERT INTO `oc_blog_to_blog_category` VALUES ('2', '3');
INSERT INTO `oc_blog_to_blog_category` VALUES ('2', '4');
