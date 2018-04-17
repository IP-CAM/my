/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2017-01-16 11:52:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_special_description`
-- ----------------------------
DROP TABLE IF EXISTS `oc_special_description`;
CREATE TABLE `oc_special_description` (
  `special_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tag` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`special_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_special_description
-- ----------------------------
INSERT INTO `oc_special_description` VALUES ('5', '1', '爆款推荐', '&lt;br&gt;', '爆款推荐', '爆款推荐', '爆款推荐', '爆款推荐');
INSERT INTO `oc_special_description` VALUES ('6', '1', '上新', '&lt;br&gt;', '上新', '上新', '上新', '上新');
INSERT INTO `oc_special_description` VALUES ('7', '1', '防霾神器', '&lt;p&gt;防霾神器&lt;/p&gt;', '防霾神器', '防霾神器', '防霾神器', '防霾神器');
