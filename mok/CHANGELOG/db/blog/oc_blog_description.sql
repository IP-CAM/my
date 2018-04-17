/*
Navicat MySQL Data Transfer

Source Server         : 192.168.100.27
Source Server Version : 50515
Source Host           : 192.168.100.27:3306
Source Database       : mok

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2016-12-16 17:47:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_blog_description`
-- ----------------------------
DROP TABLE IF EXISTS `oc_blog_description`;
CREATE TABLE `oc_blog_description` (
  `blog_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `brief` text NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `tag` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of oc_blog_description
-- ----------------------------
INSERT INTO `oc_blog_description` VALUES ('2', '1', '你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。', '&lt;p&gt;神以神的肖像创造了你们。透过神给你们的力量，你们又创造了其余的。神创造了如你们所知的生命过程和生命本身。但是神也给了你们自由选择权，你们可\r\n以随心所欲的去过生活。以这种说法来看，你对自己的意愿也即是神对你的意愿。你就以你自己的方式过你的人生，我在这件事上并没有什么偏好。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;神\r\n的计划，是让你们去创造任何东西――每样东西――不论你们想要的是什么东西。在这种自由里，存在着神之为神的体验――而就是为了这个体验，我才创造你们，\r\n以及生命本身。（神赋予了人选择的自由、创造的自由，人的自由选择、创造，就是一种上帝的状态。）我什么都不轻视。神在悲伤和欢笑里，在苦与甜里。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;在神的眼里，每件事都“可以接受”。它们是生命，而生命就是礼物；无法形容的宝藏；神圣中的神圣。每件事背后都有一个神圣的目的――因而在每个东西里都有一个神圣的存在。我即生命，因为我是生命所是。其每个面向都有一个神圣的目的。&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '你对自己的意愿也即是神对你的意愿，每件事都是神圣的存在', '2,3,4');
