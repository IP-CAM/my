# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2017-01-17 09:29:43
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_topic_history"
#

CREATE TABLE `oc_topic_history` (
  `topic_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`topic_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
