/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 10:46:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_customer_attention`
-- ----------------------------
DROP TABLE IF EXISTS `oc_customer_attention`;
CREATE TABLE `oc_customer_attention` (
  `customer_attention_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `manufacturer_id` text NOT NULL COMMENT '品牌ID',
  `buyer_id` text NOT NULL COMMENT '买手ID',
  PRIMARY KEY (`customer_attention_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户关注表';

-- ----------------------------
-- Records of oc_customer_attention
-- ----------------------------
INSERT INTO `oc_customer_attention` VALUES ('1', '24', '[\"5\",\"6\",\"7\"]', '[\"23\",\"5\"]');
INSERT INTO `oc_customer_attention` VALUES ('2', '15', '', '[\"24\"]');
INSERT INTO `oc_customer_attention` VALUES ('3', '16', '', '[\"5\"]');
INSERT INTO `oc_customer_attention` VALUES ('4', '17', '', '[\"24\"]');
