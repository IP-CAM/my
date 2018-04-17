/*
Navicat MySQL Data Transfer

Source Server         : 27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-27 11:08:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_telephone_captcha`
-- ----------------------------
DROP TABLE IF EXISTS `oc_telephone_captcha`;
CREATE TABLE `oc_telephone_captcha` (
  `telephone_captcha_id` int(11) NOT NULL AUTO_INCREMENT,
  `behavior` varchar(255) NOT NULL,
  `security_code` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `res_code` varchar(255) NOT NULL,
  `send_status` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`telephone_captcha_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_telephone_captcha
-- ----------------------------
INSERT INTO `oc_telephone_captcha` VALUES ('25', '', '0192', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15889449876', '72904717828473', 'success', '2016-12-20 12:05:25');
INSERT INTO `oc_telephone_captcha` VALUES ('26', '', '8966', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '127.0.0.1', '18627812025', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:00:27');
INSERT INTO `oc_telephone_captcha` VALUES ('27', '', '4701', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '127.0.0.1', '18627812025', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:00:29');
INSERT INTO `oc_telephone_captcha` VALUES ('28', '', '1108', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '127.0.0.1', '18627812025', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:00:30');
INSERT INTO `oc_telephone_captcha` VALUES ('29', '', '5920', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '127.0.0.1', '18627812026', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:00:35');
INSERT INTO `oc_telephone_captcha` VALUES ('30', '', '8706', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36', '127.0.0.1', '18627812025', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:00:42');
INSERT INTO `oc_telephone_captcha` VALUES ('31', '', '4597', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15889449876', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:04:50');
INSERT INTO `oc_telephone_captcha` VALUES ('39', '', '7203', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15888888888', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:09:19');
INSERT INTO `oc_telephone_captcha` VALUES ('33', '', '1558', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15889449876', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:04:56');
INSERT INTO `oc_telephone_captcha` VALUES ('38', '', '0295', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15889449888', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:09:10');
INSERT INTO `oc_telephone_captcha` VALUES ('35', '', '4074', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15889449876', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:05:32');
INSERT INTO `oc_telephone_captcha` VALUES ('36', '', '0976', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15889449876', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:06:06');
INSERT INTO `oc_telephone_captcha` VALUES ('37', '', '6542', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36', '127.0.0.1', '15889449876', 'Unauthorized IP address ,please login to your account [huaqiangbei] and add \'113.104.197.188\' to the IP white list.', 'error', '2016-12-26 21:07:08');
INSERT INTO `oc_telephone_captcha` VALUES ('40', '', '1111', '', '', '18627812025', '', 'success', '2016-12-27 09:12:04');
