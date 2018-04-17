/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 10:45:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_ext`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_ext`;
CREATE TABLE `oc_blog_ext` (
  `blog_ext_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `video_path` varchar(255) NOT NULL,
  PRIMARY KEY (`blog_ext_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_ext
-- ----------------------------
