# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2017-01-17 09:24:04
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_address_ext"
#

CREATE TABLE `oc_address_ext` (
  `address_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `district_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
