/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_category_description`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_category_description`;
CREATE TABLE `oc_faq_category_description` (
  `faq_category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`faq_category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_category_description
-- ----------------------------
INSERT INTO `oc_faq_category_description` VALUES ('13', '1', '常见问题分类一', '&lt;p&gt;常见问题分类一&lt;br&gt;&lt;/p&gt;', '常见问题分类一', '常见问题分类一', '常见问题分类一');
INSERT INTO `oc_faq_category_description` VALUES ('13', '2', '常见问题分类一', '&lt;p&gt;常见问题分类一&lt;br&gt;&lt;/p&gt;', '常见问题分类一', '常见问题分类一', '常见问题分类一');
INSERT INTO `oc_faq_category_description` VALUES ('13', '3', '常见问题分类一', '&lt;p&gt;常见问题分类一&lt;br&gt;&lt;/p&gt;', '常见问题分类一', '常见问题分类一', '常见问题分类一');
INSERT INTO `oc_faq_category_description` VALUES ('14', '1', '常见问题分类二', '&lt;p&gt;常见问题分类二&lt;br&gt;&lt;/p&gt;', '常见问题分类二', '常见问题分类二', '常见问题分类二');
INSERT INTO `oc_faq_category_description` VALUES ('14', '2', '常见问题分类二', '&lt;p&gt;常见问题分类二&lt;br&gt;&lt;/p&gt;', '常见问题分类二', '常见问题分类二', '常见问题分类二');
INSERT INTO `oc_faq_category_description` VALUES ('14', '3', '常见问题分类二', '&lt;p&gt;常见问题分类二&lt;br&gt;&lt;/p&gt;', '常见问题分类二', '常见问题分类二', '常见问题分类二');
INSERT INTO `oc_faq_category_description` VALUES ('15', '1', '苹果问题', '&lt;p&gt;苹果问题&lt;br&gt;&lt;/p&gt;', '苹果问题', '苹果问题', '苹果问题');
INSERT INTO `oc_faq_category_description` VALUES ('15', '2', '苹果问题', '&lt;p&gt;苹果问题&lt;br&gt;&lt;/p&gt;', '苹果问题', '苹果问题', '苹果问题');
INSERT INTO `oc_faq_category_description` VALUES ('15', '3', '苹果问题', '&lt;p&gt;苹果问题&lt;br&gt;&lt;/p&gt;', '苹果问题', '苹果问题', '苹果问题');
INSERT INTO `oc_faq_category_description` VALUES ('16', '3', '桔子问题', '&lt;p&gt;桔子问题&lt;br&gt;&lt;/p&gt;', '桔子问题', '桔子问题', '桔子问题');
INSERT INTO `oc_faq_category_description` VALUES ('16', '1', '桔子问题', '&lt;p&gt;桔子问题&lt;br&gt;&lt;/p&gt;', '桔子问题', '桔子问题', '桔子问题');
INSERT INTO `oc_faq_category_description` VALUES ('16', '2', '桔子问题', '&lt;p&gt;桔子问题&lt;br&gt;&lt;/p&gt;', '桔子问题', '桔子问题', '桔子问题');
