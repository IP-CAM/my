# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2017-01-17 09:25:16
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_buyer_blog"
#

CREATE TABLE `oc_buyer_blog` (
  `buyer_blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `add_date` datetime NOT NULL,
  `language_id` tinyint(3) NOT NULL,
  PRIMARY KEY (`buyer_blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
