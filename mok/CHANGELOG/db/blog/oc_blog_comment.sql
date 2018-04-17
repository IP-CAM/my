/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:47:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_comment`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_comment`;
CREATE TABLE `oc_blog_comment` (
  `blog_comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) unsigned NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`blog_comment_id`),
  KEY `FK_blog_comment` (`blog_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_comment
-- ----------------------------
INSERT INTO `oc_blog_comment` VALUES ('17', '1', '0', '測試ing', '測試評論內容', '1', '', '2016-02-09 20:17:23', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('18', '1', '0', 'testone', 'tesing now', '1', '', '2016-02-09 20:17:53', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('19', '2', '0', 'tesdfdfd', 'dsfsdfsfsd', '1', '', '2016-02-13 14:17:50', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('20', '1', '0', 'testtwo', 'testing ok ', '1', '', '2016-02-13 14:51:27', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('21', '1', '0', 'testing yang', 'testing now', '1', '', '2016-03-13 16:32:38', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('22', '1', '2', '测试一', 'Testing by Yang', '0', '', '2016-08-10 19:19:30', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('23', '1', '2', '测试一', 'Testing by Yang', '0', '', '2016-08-10 19:19:46', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('24', '1', '2', '测试一', 'Testing by Yang 2016', '0', '', '2016-08-10 19:25:17', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('25', '1', '2', '测试一', 'Testing by Yang 2016', '0', '', '2016-08-10 19:27:11', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('26', '1', '2', '测试一', 'Testing by Yang 2016', '0', '', '2016-08-10 19:35:37', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('27', '1', '2', '测试一', 'Testing by Yang 2016', '1', '', '2016-08-10 19:37:15', '2016-08-10 19:38:47');
INSERT INTO `oc_blog_comment` VALUES ('28', '1', '2', '测试一', 'ceshiing', '1', '', '2016-08-10 19:39:38', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('29', '4', '2', '测试一', '测试登陆才可以评论', '1', '', '2016-08-10 19:40:43', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('30', '15', '1', '杨兆锋', '测试中评论', '1', '', '2016-08-22 14:45:07', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('31', '15', '1', 'testone', '再次测试', '1', '', '2016-08-22 14:46:49', '2016-08-22 14:47:03');
INSERT INTO `oc_blog_comment` VALUES ('32', '10', '6', '11111', 'mmmmm', '1', '', '2016-08-26 23:21:50', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('33', '15', '1', '杨兆锋', '测试邮件发送内容', '1', '', '2016-09-02 14:58:31', '0000-00-00 00:00:00');
INSERT INTO `oc_blog_comment` VALUES ('34', '15', '1', '杨兆锋', '再次测试邮件发送标题', '1', '', '2016-09-02 15:02:18', '0000-00-00 00:00:00');
