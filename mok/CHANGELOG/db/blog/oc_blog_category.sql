/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:46:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_category`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_category`;
CREATE TABLE `oc_blog_category` (
  `blog_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_group` smallint(6) NOT NULL DEFAULT '2',
  `width` varchar(255) DEFAULT NULL,
  `submenu_width` varchar(255) DEFAULT NULL,
  `colum_width` varchar(255) DEFAULT NULL,
  `submenu_colum_width` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `colums` varchar(255) DEFAULT '1',
  `type` varchar(255) NOT NULL,
  `is_content` smallint(6) NOT NULL DEFAULT '2',
  `show_title` smallint(6) NOT NULL DEFAULT '1',
  `level_depth` smallint(6) NOT NULL DEFAULT '0',
  `published` smallint(6) NOT NULL DEFAULT '1',
  `store_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `position` int(11) unsigned NOT NULL DEFAULT '0',
  `show_sub` smallint(6) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(25) DEFAULT NULL,
  `privacy` smallint(5) unsigned NOT NULL DEFAULT '0',
  `position_type` varchar(25) DEFAULT 'top',
  `menu_class` varchar(25) DEFAULT NULL,
  `left` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `sort_order` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`blog_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_category
-- ----------------------------
INSERT INTO `oc_blog_category` VALUES ('1', '', '0', '2', null, null, null, null, null, '1', '', '2', '1', '0', '1', '0', '0', '0', null, null, '0', 'top', null, '0', '0', '', '0', '1', '2016-01-13 21:18:53', '2016-12-16 10:41:46');
INSERT INTO `oc_blog_category` VALUES ('2', '', '0', '2', null, null, null, null, null, '1', '', '2', '1', '0', '1', '0', '0', '0', null, null, '0', 'top', null, '0', '0', '', '2', '1', '2016-01-21 11:30:13', '2016-12-16 10:42:38');
INSERT INTO `oc_blog_category` VALUES ('5', '', '1', '2', null, null, null, null, null, '1', '', '2', '1', '0', '1', '0', '0', '0', null, null, '0', 'top', null, '0', '0', '', '0', '1', '2016-01-21 11:32:22', '2016-12-16 10:42:08');
INSERT INTO `oc_blog_category` VALUES ('6', '', '0', '2', null, null, null, null, null, '1', '', '2', '1', '0', '1', '0', '0', '0', null, null, '0', 'top', null, '0', '0', '', '0', '1', '2016-01-21 11:33:00', '2016-12-16 10:42:23');
