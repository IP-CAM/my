/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:10:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_press_category_description`
-- ----------------------------
DROP TABLE IF EXISTS `oc_press_category_description`;
CREATE TABLE `oc_press_category_description` (
  `press_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`press_category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_press_category_description
-- ----------------------------
INSERT INTO `oc_press_category_description` VALUES ('1', '3', '新闻分类一', '&lt;p&gt;新闻分类一&lt;br&gt;&lt;/p&gt;', '新闻分类一', '新闻分类一', '新闻分类一');
INSERT INTO `oc_press_category_description` VALUES ('1', '2', '新闻分类一', '&lt;p&gt;新闻分类一&lt;br&gt;&lt;/p&gt;', '新闻分类一', '新闻分类一', '新闻分类一');
INSERT INTO `oc_press_category_description` VALUES ('1', '1', '新闻分类一', '&lt;p&gt;新闻分类一&lt;br&gt;&lt;/p&gt;', '新闻分类一', '新闻分类一', '新闻分类一');
INSERT INTO `oc_press_category_description` VALUES ('2', '1', '新闻分类二', '&lt;p&gt;新闻分类二&lt;br&gt;&lt;/p&gt;', '新闻分类二', '新闻分类二', '新闻分类二');
INSERT INTO `oc_press_category_description` VALUES ('2', '2', '新闻分类二', '&lt;p&gt;新闻分类二&lt;br&gt;&lt;/p&gt;', '新闻分类二', '新闻分类二', '新闻分类二');
INSERT INTO `oc_press_category_description` VALUES ('2', '3', '新闻分类二', '&lt;p&gt;新闻分类二&lt;br&gt;&lt;/p&gt;', '新闻分类二', '新闻分类二', '新闻分类二');
