<?php
// HTTP
define('HTTP_SERVER', 'http://oc18.localweb.com/');

// HTTPS
define('HTTPS_SERVER', 'http://oc18.localweb.com/');

// DIR
define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
define('DIR_APPLICATION', DIR_ROOT.'catalog/');
define('DIR_SYSTEM', DIR_ROOT.'system/');
define('DIR_LANGUAGE', DIR_ROOT.'catalog/language/');
define('DIR_TEMPLATE', DIR_ROOT.'catalog/view/theme/');
define('DIR_CONFIG', DIR_ROOT.'system/config/');
define('DIR_IMAGE', DIR_ROOT.'image/');
define('DIR_CACHE', DIR_ROOT.'system/cache/');
define('DIR_DOWNLOAD', DIR_ROOT.'system/download/');
define('DIR_UPLOAD', DIR_ROOT.'system/upload/');
define('DIR_MODIFICATION', DIR_ROOT.'system/modification/');
define('DIR_LOGS', DIR_ROOT.'system/logs/');

// IMAGE HOST
define('DIR_IMAGEHOST', 'http://pic.18miss.com:88/img/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'oc18');
define('DB_PREFIX', 'oc_');