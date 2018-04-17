/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 11:00:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_pricing`
-- ----------------------------
DROP TABLE IF EXISTS `oc_pricing`;
CREATE TABLE `oc_pricing` (
  `pricing_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `show_image` varchar(255) NOT NULL COMMENT '展示图片',
  `description` text NOT NULL COMMENT '活动介绍',
  `product` int(11) NOT NULL COMMENT '商品',
  `product_image_description` varchar(255) NOT NULL COMMENT '商品描述的图片',
  `product_description` text NOT NULL COMMENT '商品介绍',
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`pricing_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_pricing
-- ----------------------------
INSERT INTO `oc_pricing` VALUES ('7', 'gfdgfd', 'catalog/shoujichanggui1212.png', '&lt;p&gt;规范的功夫过分的&lt;/p&gt;', '42', '', '&lt;p&gt;广泛的过分低估梵蒂冈&lt;/p&gt;', '2016-12-19 00:00:00', '2017-01-19 00:00:00', '0', '2016-12-19 15:50:06');
INSERT INTO `oc_pricing` VALUES ('8', '未来生活f', 'catalog/img1(1).jpg', '&lt;p&gt;ds放到沙发上的方式对方的身份大锅饭的&lt;/p&gt;', '28', 'catalog/detail_03.jpg', '&lt;p&gt;广泛的过分低估梵蒂冈负担&lt;/p&gt;', '2016-12-19 00:00:00', '2017-01-19 00:00:00', '1', '2016-12-19 19:17:31');
INSERT INTO `oc_pricing` VALUES ('9', '大王叫我来巡山咯', 'catalog/img1(1).jpg', '&lt;p&gt;呵呵呵呵&lt;/p&gt;', '41', '', '&lt;p&gt;啦啦啦&lt;/p&gt;', '2016-12-20 00:00:00', '2017-01-20 00:00:00', '0', '2016-12-20 15:46:51');
