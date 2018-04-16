<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | corntab.php  Version 2017/3/4 定时任务控制文件
// +----------------------------------------------------------------------

return [
    'Tradecancel' =>
        [
            'description'   => 'Trade auto cancel',
            'schedule'      => '*/10 * * * *',
            'status'        => 1,
        ],
    'Tradecomplete' =>
        [
            'description'   => 'Trade auto complete',
            'schedule'      => '*/10 * * * *',
            'status'        => 1,
        ],
];
