<?php
// Version
define('VERSION', '2.3.0.2');

// Configuration
require_once('../../../config.php');

date_default_timezone_set('PRC');
// Startup
require_once(DIR_SYSTEM . 'startup.php');
define('PAY_METHOD_CALLBACK', 'extension/module/qq_login/callback');
/*// VirtualQMOD
require_once('../../../vqmod/vqmod.php');
VQMod::bootup();

// VQMODDED Startup
require_once(VQMod::modCheck(DIR_SYSTEM . 'startup.php'));*/

start('catalog');