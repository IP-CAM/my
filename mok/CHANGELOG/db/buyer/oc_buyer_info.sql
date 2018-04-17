# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2017-01-17 09:25:30
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_buyer_info"
#

CREATE TABLE `oc_buyer_info` (
  `buyer_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `intro` varchar(64) NOT NULL,
  `introduce` varchar(255) NOT NULL,
  `head_image` varchar(255) NOT NULL,
  `show_image` varchar(255) NOT NULL,
  `language_id` tinyint(2) NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`buyer_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
