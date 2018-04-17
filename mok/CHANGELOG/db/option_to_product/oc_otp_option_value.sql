/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2017-01-16 11:53:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_otp_option_value`
-- ----------------------------
DROP TABLE IF EXISTS `oc_otp_option_value`;
CREATE TABLE `oc_otp_option_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `parent_option_id` int(11) NOT NULL,
  `child_option_id` int(11) NOT NULL,
  `grandchild_option_id` int(11) NOT NULL,
  `parent_option_value_id` int(11) NOT NULL,
  `child_option_value_id` int(11) NOT NULL,
  `grandchild_option_value_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_otp_option_value
-- ----------------------------
INSERT INTO `oc_otp_option_value` VALUES ('1', '42', '20', '21', '0', '112', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('2', '42', '20', '21', '0', '112', '118', '0');
INSERT INTO `oc_otp_option_value` VALUES ('3', '42', '20', '21', '0', '112', '116', '0');
INSERT INTO `oc_otp_option_value` VALUES ('4', '42', '20', '21', '0', '115', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('5', '42', '20', '21', '0', '114', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('6', '42', '20', '21', '0', '113', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('7', '50', '20', '21', '0', '112', '118', '0');
INSERT INTO `oc_otp_option_value` VALUES ('8', '50', '20', '21', '0', '112', '116', '0');
INSERT INTO `oc_otp_option_value` VALUES ('9', '50', '20', '21', '0', '112', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('10', '50', '20', '21', '0', '115', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('11', '50', '20', '21', '0', '114', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('12', '50', '20', '21', '0', '113', '117', '0');
INSERT INTO `oc_otp_option_value` VALUES ('13', '50', '20', '21', '0', '114', '118', '0');
INSERT INTO `oc_otp_option_value` VALUES ('14', '50', '20', '21', '0', '113', '116', '0');
INSERT INTO `oc_otp_option_value` VALUES ('15', '62', '23', '20', '24', '119', '113', '121');
INSERT INTO `oc_otp_option_value` VALUES ('16', '62', '23', '20', '24', '119', '112', '121');
INSERT INTO `oc_otp_option_value` VALUES ('17', '62', '23', '20', '24', '119', '112', '122');
INSERT INTO `oc_otp_option_value` VALUES ('18', '62', '23', '20', '24', '120', '115', '121');
INSERT INTO `oc_otp_option_value` VALUES ('19', '62', '23', '20', '24', '120', '114', '121');
INSERT INTO `oc_otp_option_value` VALUES ('20', '65', '23', '20', '0', '119', '123', '0');
INSERT INTO `oc_otp_option_value` VALUES ('21', '65', '23', '20', '0', '120', '123', '0');
INSERT INTO `oc_otp_option_value` VALUES ('22', '78', '17', '18', '0', '73', '76', '0');
INSERT INTO `oc_otp_option_value` VALUES ('23', '78', '17', '18', '0', '73', '77', '0');
INSERT INTO `oc_otp_option_value` VALUES ('24', '78', '17', '18', '0', '73', '78', '0');
INSERT INTO `oc_otp_option_value` VALUES ('25', '78', '17', '18', '0', '73', '79', '0');
INSERT INTO `oc_otp_option_value` VALUES ('26', '78', '17', '18', '0', '73', '80', '0');
INSERT INTO `oc_otp_option_value` VALUES ('27', '78', '17', '18', '0', '74', '76', '0');
INSERT INTO `oc_otp_option_value` VALUES ('28', '78', '17', '18', '0', '74', '77', '0');
INSERT INTO `oc_otp_option_value` VALUES ('29', '78', '17', '18', '0', '74', '78', '0');
INSERT INTO `oc_otp_option_value` VALUES ('30', '78', '17', '18', '0', '74', '79', '0');
INSERT INTO `oc_otp_option_value` VALUES ('31', '78', '17', '18', '0', '74', '80', '0');
INSERT INTO `oc_otp_option_value` VALUES ('32', '78', '17', '18', '0', '75', '76', '0');
INSERT INTO `oc_otp_option_value` VALUES ('33', '78', '17', '18', '0', '75', '77', '0');
INSERT INTO `oc_otp_option_value` VALUES ('34', '78', '17', '18', '0', '75', '78', '0');
INSERT INTO `oc_otp_option_value` VALUES ('35', '78', '17', '18', '0', '75', '79', '0');
INSERT INTO `oc_otp_option_value` VALUES ('36', '78', '17', '18', '0', '75', '80', '0');
INSERT INTO `oc_otp_option_value` VALUES ('37', '89', '20', '24', '0', '124', '125', '0');
INSERT INTO `oc_otp_option_value` VALUES ('38', '89', '20', '24', '0', '124', '126', '0');
INSERT INTO `oc_otp_option_value` VALUES ('39', '89', '20', '24', '0', '115', '125', '0');
INSERT INTO `oc_otp_option_value` VALUES ('40', '89', '20', '24', '0', '115', '126', '0');
