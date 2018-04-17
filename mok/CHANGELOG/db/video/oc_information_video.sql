# Host: 192.168.100.27  (Version: 5.5.15-log)
# Date: 2016-12-07 11:58:29
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "oc_information_video"
#

CREATE TABLE `oc_information_video` (
  `information_video_id` int(11) NOT NULL AUTO_INCREMENT,
  `information_id` int(11) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`information_video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "oc_information_video"
#

INSERT INTO `oc_information_video` VALUES (1,6,'video20160430_111539-1481081106.mp4'),(2,6,'video20160430_111539-1481081113.mp4');
