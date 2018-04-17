/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 10:46:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_customer_collect`
-- ----------------------------
DROP TABLE IF EXISTS `oc_customer_collect`;
CREATE TABLE `oc_customer_collect` (
  `customer_collect_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `product_id` text NOT NULL,
  `article_id` text NOT NULL COMMENT '文章ID',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`customer_collect_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_customer_collect
-- ----------------------------
INSERT INTO `oc_customer_collect` VALUES ('1', '1', '[\"30\"]', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `oc_customer_collect` VALUES ('2', '24', '[\"28\",\"30\"]', '[\"2\",\"8\"]', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
