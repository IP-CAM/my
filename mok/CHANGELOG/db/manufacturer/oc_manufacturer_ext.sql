/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 10:49:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_manufacturer_ext`
-- ----------------------------
DROP TABLE IF EXISTS `oc_manufacturer_ext`;
CREATE TABLE `oc_manufacturer_ext` (
  `manufacturer_id` int(11) NOT NULL,
  `show_image` varchar(255) NOT NULL COMMENT '展示图片',
  `introduce` varchar(255) NOT NULL COMMENT '品牌介绍'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_manufacturer_ext
-- ----------------------------
INSERT INTO `oc_manufacturer_ext` VALUES ('13', 'catalog/img1(1).jpg', '淡淡的淡淡的淡淡的淡淡的淡淡淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡的淡淡                        ');
INSERT INTO `oc_manufacturer_ext` VALUES ('8', 'catalog/img1(1).jpg', '59反对双方的身份的舒服的沙发上的放松放松的分手费');
INSERT INTO `oc_manufacturer_ext` VALUES ('7', '', '');
INSERT INTO `oc_manufacturer_ext` VALUES ('5', 'catalog/shoujichanggui1212.png', '发的事实上是事实是事实是事实是事实是事实是事实是事实是事实事实上身上所属事实上事实上身上');
