/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 10:50:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_order_product_ext`
-- ----------------------------
DROP TABLE IF EXISTS `oc_order_product_ext`;
CREATE TABLE `oc_order_product_ext` (
  `order_product_ext_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_product_id` int(11) NOT NULL COMMENT '订单商品中的主键ID',
  `is_review` char(1) NOT NULL COMMENT '是否评价',
  PRIMARY KEY (`order_product_ext_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1884 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of oc_order_product_ext
-- ----------------------------
INSERT INTO `oc_order_product_ext` VALUES ('1', '1374', '1');
INSERT INTO `oc_order_product_ext` VALUES ('2', '1883', '0');
