# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2016-12-25 20:29:58
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_feedback"
#

CREATE TABLE `oc_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '反馈内容',
  `email` varchar(255) DEFAULT NULL COMMENT 'email',
  `status` char(1) DEFAULT NULL COMMENT '是否已回复',
  `created` varchar(255) DEFAULT NULL,
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
