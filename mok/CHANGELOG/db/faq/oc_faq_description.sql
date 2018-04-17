/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-25 20:05:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_faq_description`
-- ----------------------------
DROP TABLE IF EXISTS `oc_faq_description`;
CREATE TABLE `oc_faq_description` (
  `faq_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`faq_id`,`language_id`),
  KEY `name` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_faq_description
-- ----------------------------
INSERT INTO `oc_faq_description` VALUES ('26', '3', '问题2', '&lt;p&gt;问题2&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('26', '2', '问题2', '&lt;p&gt;问题2&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('26', '1', '问题2', '&lt;p&gt;问题2&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('27', '3', '问题3', '&lt;p&gt;问题3&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('27', '2', '问题3', '&lt;p&gt;问题3&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('27', '1', '问题3', '&lt;p&gt;问题3&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('25', '1', 'MyCnCart系统可以商用吗？', '&lt;p&gt;是的，完全可以！!！&lt;br&gt;&lt;br&gt;mycncart系统遵循GPL3协议，您可以用它来用作商业网站，并且免费使用。&lt;br&gt;&lt;br&gt;你所需要遵循的就是：如果您做了二次开发并且将其销售，则您必须保持所做的二次开发也是开源的，不能做任何加密。&lt;br&gt;&lt;br&gt;mycncart系统本身可以被免费使用，但不能包装起来后被销售。&lt;br&gt;&lt;br&gt;您可以将【技术支持 MyCnCart】移除， 但希望您能够做一捐款， 如此MyCnCart的开发者才能够投入更多的时间精力为大家提供更好的版本服务。&lt;br&gt;&lt;br&gt;请使用支付宝捐款至支付宝账户：tonyspace2010@gmail.com&amp;nbsp; 姓名： 杨兆锋&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('28', '1', '问题4', '&lt;p&gt;问题4&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('28', '2', '问题4', '&lt;p&gt;问题4&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('28', '3', '问题4', '&lt;p&gt;问题4&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('29', '1', '问题5', '&lt;p&gt;问题5&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('29', '2', '问题5', '&lt;p&gt;问题5&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('29', '3', '问题5', '&lt;p&gt;问题5&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('30', '1', '问题6', '&lt;p&gt;问题6&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('30', '2', '问题6', '&lt;p&gt;问题6&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('30', '3', '问题6', '&lt;p&gt;问题6&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('31', '1', '问题7', '&lt;p&gt;问题7&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('31', '2', '问题7', '&lt;p&gt;问题7&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('31', '3', '问题7', '&lt;p&gt;问题7&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('32', '1', '问题8', '&lt;p&gt;问题8&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('32', '2', '问题8', '&lt;p&gt;问题8&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('32', '3', '问题8', '&lt;p&gt;问题8&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('33', '1', '问题9', '&lt;p&gt;问题9&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('33', '2', '问题9', '&lt;p&gt;问题9&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('33', '3', '问题9', '&lt;p&gt;问题9&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('34', '1', '问题10', '&lt;p&gt;问题10&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('25', '2', 'MyCnCart系统可以商用吗？', '&lt;p&gt;是的，完全可以！!！&lt;br&gt;&lt;br&gt;mycncart系统遵循GPL3协议，您可以用它来用作商业网站，并且免费使用。&lt;br&gt;&lt;br&gt;你所需要遵循的就是：如果您做了二次开发并且将其销售，则您必须保持所做的二次开发也是开源的，不能做任何加密。&lt;br&gt;&lt;br&gt;mycncart系统本身可以被免费使用，但不能包装起来后被销售。&lt;br&gt;&lt;br&gt;您可以将【技术支持 MyCnCart】移除， 但希望您能够做一捐款， 如此MyCnCart的开发者才能够投入更多的时间精力为大家提供更好的版本服务。&lt;br&gt;&lt;br&gt;请使用支付宝捐款至支付宝账户：tonyspace2010@gmail.com&amp;nbsp; 姓名： 杨兆锋&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;');
INSERT INTO `oc_faq_description` VALUES ('25', '3', 'MyCnCart系统可以商用吗？', '&lt;p&gt;是的，完全可以！!！&lt;br&gt;&lt;br&gt;mycncart系统遵循GPL3协议，您可以用它来用作商业网站，并且免费使用。&lt;br&gt;&lt;br&gt;你所需要遵循的就是：如果您做了二次开发并且将其销售，则您必须保持所做的二次开发也是开源的，不能做任何加密。&lt;br&gt;&lt;br&gt;mycncart系统本身可以被免费使用，但不能包装起来后被销售。&lt;br&gt;&lt;br&gt;您可以将【技术支持 MyCnCart】移除， 但希望您能够做一捐款， 如此MyCnCart的开发者才能够投入更多的时间精力为大家提供更好的版本服务。&lt;br&gt;&lt;br&gt;请使用支付宝捐款至支付宝账户：tonyspace2010@gmail.com&amp;nbsp; 姓名： 杨兆锋&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;');
