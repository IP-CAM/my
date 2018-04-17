opencart源文件增删改记录,从下往上记录日志,不重复记录

*** replace ***
/system/library/mail.php

*** delete ***
\catalog\view\theme\default\template\common\header.tpl
\back\view\stylesheet\stylesheet.css

*** modified ***
ALTER TABLE `oc_cart` ADD `otp_id` int(11) NOT NULL;
ALTER TABLE `oc_cart` ADD `swap_id` int(11) NOT NULL;
ALTER TABLE `oc_order_product` ADD `otp_id` int(11) NOT NULL;


