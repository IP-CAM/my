/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 11:09:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_weibo_connect`
-- ----------------------------
DROP TABLE IF EXISTS `oc_weibo_connect`;
CREATE TABLE `oc_weibo_connect` (
  `connect_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `weibo_uid` varchar(20) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`connect_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of oc_weibo_connect
-- ----------------------------
INSERT INTO `oc_weibo_connect` VALUES ('2', '24', '2.00L8vjvF_RYjlD6f8fb82b990Ek_bX', '5433860865', 'Leon7954', 'http://tva2.sinaimg.cn/crop.0.0.1328.1328.50/005VJVrbjw8fa19iqjrdtj310w10w0v8.jpg');
