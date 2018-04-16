<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

    // [ 应用入口文件 ]
    header("Content-type: text/html; charset=utf-8");
    

    // 检测PHP环境
    if (version_compare(PHP_VERSION, '5.0.0', '<')) die('require PHP > 7.0.0 !');
    // 定义应用名称
    define('APP_NAME', 'site');
    define('DEV_PATH', 'custom');  // 定义开发目录 与APP_PATH同级的目录
    define('APP_PATH', __DIR__ . '/../' . APP_NAME . '/');  // 定义应用目录
    define('ADDON_PATH', __DIR__ . '/../plugins/');         // 定义钩子目录
    define('DATA_BACKUP_PATH', __DIR__ . '/../data/');         // 定义钩子目录

    //define('CONF_PATH', __DIR__ . '/../config/');         // 配置文件路径
    // 加载框架引导文件

// ajax跨域请求
$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
$re_origin = str_replace('http://','',$origin);
$re_origin = str_replace('https://','',$re_origin);

$sub = APP_PATH.'admin/extra/sub_domain.php';
$allow_origin = [];
if(is_file($sub)){
    $sub = include $sub;
    if(is_array($sub)){
        $allow_origin = $sub;
    }
}
if(in_array($re_origin, $allow_origin)){
    header('Access-Control-Allow-Origin:'.$origin);
}
 header('Access-Control-Allow-Origin: *');



    require __DIR__ . '/../core/start.php';