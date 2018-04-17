/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2017-01-16 11:53:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_otp_data`
-- ----------------------------
DROP TABLE IF EXISTS `oc_otp_data`;
CREATE TABLE `oc_otp_data` (
  `otp_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `model` varchar(64) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtract` tinyint(1) NOT NULL,
  `price_prefix` varchar(1) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `special` decimal(15,4) NOT NULL,
  `weight_prefix` varchar(1) NOT NULL,
  `weight` decimal(15,4) NOT NULL,
  PRIMARY KEY (`otp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_otp_data
-- ----------------------------
INSERT INTO `oc_otp_data` VALUES ('1', '42', 'model', 'ex', '97', '1', '+', '200.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('2', '42', 'model', 'ex', '97', '1', '=', '100.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('3', '42', 'model', 'ex', '99', '1', '=', '150.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('4', '42', 'model', 'ex', '99', '1', '=', '200.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('5', '42', 'model', 'ex', '99', '1', '=', '200.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('6', '42', 'model', 'ex', '99', '1', '=', '300.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('7', '50', 'mod1', '49879874236', '99', '1', '=', '1000.0000', '150.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('8', '50', 'mod2', '4654sdf', '99', '1', '=', '2000.0000', '100.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('9', '50', 'mod3', 'sdf6546', '99', '1', '=', '3000.0000', '200.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('10', '50', 'mod4', 'sdf6546', '99', '1', '=', '4000.0000', '300.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('11', '50', 'mod5', 'sdf654', '99', '1', '=', '5000.0000', '400.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('12', '50', 'mod6', 'sdf6456', '99', '1', '=', '1000.0000', '500.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('13', '50', 'mod7', 'sdf6546', '99', '1', '=', '1000.0000', '700.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('14', '50', 'mod8', 'sfd6456', '99', '1', '=', '1000.0000', '200.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('15', '62', '', '', '0', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('16', '62', '', '', '0', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('17', '62', '', '', '0', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('18', '62', '', '', '0', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('19', '62', '', '', '0', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('20', '65', '', '', '0', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('21', '65', '', '', '0', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('22', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('23', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('24', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('25', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('26', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('27', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('28', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('29', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('30', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('31', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('32', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('33', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('34', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('35', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('36', '78', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('37', '89', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('38', '89', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('39', '89', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
INSERT INTO `oc_otp_data` VALUES ('40', '89', '', '', '1', '1', '=', '0.0000', '0.0000', '=', '0.0000');
