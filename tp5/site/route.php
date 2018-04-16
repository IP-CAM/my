<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
use think\Route;

// 部署子域名
$sub  = APP_PATH . 'admin/extra/sub_domain.php';
$core = APP_PATH . 'admin/extra/index.php';
if (is_file($sub) && is_file($core)) {
    $sub  = include $sub;
    $core = include $core;
    if (isset($core['sub_domain_status']) && $core['sub_domain_status']) {
        if (isset($sub) && !empty($sub)) {
            foreach ($sub as $key => $value) {
                Route::domain($value, $key);
            }
        }
    }
}


return [
    //路由参数配置
    '__pattern__' => [
        'name' => '\w+',
        'id'   => '\d+',
    ],
    
    //域名部署
    '__domain__'  => [],
    
    '[index]' => [
        ':c/:a' => ['Index/:c/:a'],
    ],
    
    '[finance]' => [
        ':c/:a' => ['Finance/:c/:a'],
    ],
];
