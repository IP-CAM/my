/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:46:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_category_description`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_category_description`;
CREATE TABLE `oc_blog_category_description` (
  `blog_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  PRIMARY KEY (`blog_category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_category_description
-- ----------------------------
INSERT INTO `oc_blog_category_description` VALUES ('1', '1', '专题', '&lt;p&gt;专题&lt;br&gt;&lt;/p&gt;', '专题', '', '');
INSERT INTO `oc_blog_category_description` VALUES ('2', '1', '视频', '&lt;p&gt;视频&lt;br&gt;&lt;/p&gt;', '视频', '视频', '视频');
INSERT INTO `oc_blog_category_description` VALUES ('5', '1', '数码', '&lt;p&gt;数码&lt;br&gt;&lt;/p&gt;', '数码', '数码', '数码');
INSERT INTO `oc_blog_category_description` VALUES ('6', '1', '测评', '&lt;p&gt;测评&lt;br&gt;&lt;/p&gt;', '测评', '测评', '测评');
