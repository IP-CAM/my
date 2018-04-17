# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2017-01-17 09:29:51
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_topic_product"
#

CREATE TABLE `oc_topic_product` (
  `topic_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`topic_product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
