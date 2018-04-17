/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:10:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_press_description`
-- ----------------------------
DROP TABLE IF EXISTS `oc_press_description`;
CREATE TABLE `oc_press_description` (
  `press_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`press_id`,`language_id`),
  KEY `name` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_press_description
-- ----------------------------
INSERT INTO `oc_press_description` VALUES ('1', '3', '新闻一', '&lt;p&gt;新闻一&lt;br&gt;&lt;/p&gt;', '新闻一', '新闻一', '新闻一');
INSERT INTO `oc_press_description` VALUES ('1', '2', '新闻一', '&lt;p&gt;新闻一&lt;br&gt;&lt;/p&gt;', '新闻一', '新闻一', '新闻一');
INSERT INTO `oc_press_description` VALUES ('1', '1', '新闻一', '&lt;p&gt;新闻一&lt;br&gt;&lt;/p&gt;', '新闻一', '新闻一', '新闻一');
INSERT INTO `oc_press_description` VALUES ('2', '3', '新闻二', '&lt;p&gt;新闻二&lt;br&gt;&lt;/p&gt;', '新闻二', '新闻二', '新闻二');
INSERT INTO `oc_press_description` VALUES ('2', '2', '新闻二', '&lt;p&gt;新闻二&lt;br&gt;&lt;/p&gt;', '新闻二', '新闻二', '新闻二');
INSERT INTO `oc_press_description` VALUES ('2', '1', '新闻二', '&lt;p&gt;新闻二&lt;br&gt;&lt;/p&gt;', '新闻二', '新闻二', '新闻二');
INSERT INTO `oc_press_description` VALUES ('3', '1', '新闻三', '&lt;p&gt;新闻三&lt;br&gt;&lt;/p&gt;', '新闻三', '新闻三', '新闻三');
INSERT INTO `oc_press_description` VALUES ('3', '2', '新闻三', '&lt;p&gt;新闻三&lt;br&gt;&lt;/p&gt;', '新闻三', '新闻三', '新闻三');
INSERT INTO `oc_press_description` VALUES ('3', '3', '新闻三', '&lt;p&gt;新闻三&lt;br&gt;&lt;/p&gt;', '新闻三', '新闻三', '新闻三');
INSERT INTO `oc_press_description` VALUES ('4', '3', '新闻4', '&lt;p&gt;新闻4&lt;br&gt;&lt;/p&gt;', '新闻4', '新闻4', '新闻4');
INSERT INTO `oc_press_description` VALUES ('4', '2', '新闻4', '&lt;p&gt;新闻4&lt;br&gt;&lt;/p&gt;', '新闻4', '新闻4', '新闻4');
INSERT INTO `oc_press_description` VALUES ('4', '1', '新闻4', '&lt;p&gt;新闻4&lt;br&gt;&lt;/p&gt;', '新闻4', '新闻4', '新闻4');
INSERT INTO `oc_press_description` VALUES ('5', '3', '新闻5', '&lt;p&gt;新闻5&lt;br&gt;&lt;/p&gt;', '新闻5', '新闻5', '新闻5');
INSERT INTO `oc_press_description` VALUES ('5', '2', '新闻5', '&lt;p&gt;新闻5&lt;br&gt;&lt;/p&gt;', '新闻5', '新闻5', '新闻5');
INSERT INTO `oc_press_description` VALUES ('5', '1', '新闻5', '&lt;p&gt;新闻5&lt;br&gt;&lt;/p&gt;', '新闻5', '新闻5', '新闻5');
INSERT INTO `oc_press_description` VALUES ('6', '1', '新闻6', '&lt;p&gt;新闻6&lt;br&gt;&lt;/p&gt;', '新闻6', '新闻6', '新闻6');
INSERT INTO `oc_press_description` VALUES ('6', '2', '新闻6', '&lt;p&gt;新闻6&lt;br&gt;&lt;/p&gt;', '新闻6', '新闻6', '新闻6');
INSERT INTO `oc_press_description` VALUES ('6', '3', '新闻6', '&lt;p&gt;新闻6&lt;br&gt;&lt;/p&gt;', '新闻6', '新闻6', '新闻6');
INSERT INTO `oc_press_description` VALUES ('7', '1', '新闻7', '&lt;p&gt;新闻7&lt;br&gt;&lt;/p&gt;', '新闻7', '新闻7', '新闻7');
INSERT INTO `oc_press_description` VALUES ('7', '2', '新闻7', '&lt;p&gt;新闻7&lt;br&gt;&lt;/p&gt;', '新闻7', '新闻7', '新闻7');
INSERT INTO `oc_press_description` VALUES ('7', '3', '新闻7', '&lt;p&gt;新闻7&lt;br&gt;&lt;/p&gt;', '新闻7', '新闻7', '新闻7');
INSERT INTO `oc_press_description` VALUES ('8', '1', '新闻8', '&lt;p&gt;新闻8&lt;br&gt;&lt;/p&gt;', '新闻8', '新闻8', '新闻8');
INSERT INTO `oc_press_description` VALUES ('8', '2', '新闻8', '&lt;p&gt;新闻8&lt;br&gt;&lt;/p&gt;', '新闻8', '新闻8', '新闻8');
INSERT INTO `oc_press_description` VALUES ('8', '3', '新闻8', '&lt;p&gt;新闻8&lt;br&gt;&lt;/p&gt;', '新闻8', '新闻8', '新闻8');
INSERT INTO `oc_press_description` VALUES ('9', '1', '新闻9', '&lt;p&gt;新闻9&lt;br&gt;&lt;/p&gt;', '新闻9', '新闻9', '新闻9');
INSERT INTO `oc_press_description` VALUES ('9', '2', '新闻9', '&lt;p&gt;新闻9&lt;br&gt;&lt;/p&gt;', '新闻9', '新闻9', '新闻9');
INSERT INTO `oc_press_description` VALUES ('9', '3', '新闻9', '&lt;p&gt;新闻9&lt;br&gt;&lt;/p&gt;', '新闻9', '新闻9', '新闻9');
INSERT INTO `oc_press_description` VALUES ('10', '3', '新闻10', '&lt;p&gt;新闻10&lt;br&gt;&lt;/p&gt;', '新闻10', '新闻10', '新闻10');
INSERT INTO `oc_press_description` VALUES ('10', '2', '新闻10', '&lt;p&gt;新闻10&lt;br&gt;&lt;/p&gt;', '新闻10', '新闻10', '新闻10');
INSERT INTO `oc_press_description` VALUES ('10', '1', '新闻10', '&lt;p&gt;新闻10&lt;br&gt;&lt;/p&gt;', '新闻10', '新闻10', '新闻10');
