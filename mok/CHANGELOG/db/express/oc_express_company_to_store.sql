# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2016-12-09 17:10:00
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_express_company_to_store"
#

CREATE TABLE `oc_express_company_to_store` (
  `express_company_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`express_company_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
