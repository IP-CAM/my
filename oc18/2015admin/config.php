<?php
// HTTP
define('HTTP_SERVER', 'http://oc18.localweb.com/2015admin/');
define('HTTP_CATALOG', 'http://oc18.localweb.com/');

// HTTPS
define('HTTPS_SERVER', 'http://oc18.localweb.com/2015admin/');
define('HTTPS_CATALOG', 'http://oc18.localweb.com/');

// DIR
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
define('DIR_APPLICATION', DIR_ROOT.'2015admin/');
define('DIR_SYSTEM', DIR_ROOT.'system/');
define('DIR_LANGUAGE', DIR_ROOT.'2015admin/language/');
define('DIR_TEMPLATE', DIR_ROOT.'2015admin/view/template/');
define('DIR_CONFIG', DIR_ROOT.'system/config/');
define('DIR_IMAGE', DIR_ROOT.'image/');
define('DIR_CACHE', DIR_ROOT.'system/cache/');
define('DIR_DOWNLOAD', DIR_ROOT.'system/download/');
define('DIR_UPLOAD', DIR_ROOT.'system/upload/');
define('DIR_LOGS', DIR_ROOT.'system/logs/');
define('DIR_MODIFICATION', DIR_ROOT.'system/modification/');
define('DIR_CATALOG', DIR_ROOT.'catalog/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'oc18');
define('DB_PREFIX', 'oc_');