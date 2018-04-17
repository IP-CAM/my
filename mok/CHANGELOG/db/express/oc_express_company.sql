# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2016-12-09 17:09:46
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_express_company"
#

CREATE TABLE `oc_express_company` (
  `express_company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(255) NOT NULL,
  `sort_order` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`express_company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
