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
    'Clearsyslogs' =>
        [
            'description'   => 'Clear system logs',
            'schedule'      => '0 2 * * *',
            'status'        => 1,
        ],
    'Clearsellogs' =>
        [
            'description'   => 'Clear seller logs',
            'schedule'      => '0 3 * * *',
            'status'        => 0,
        ],
];
