# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2017-01-17 09:29:28
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_topic_category"
#

CREATE TABLE `oc_topic_category` (
  `topic_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
