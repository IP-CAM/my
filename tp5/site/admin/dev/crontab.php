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
    'Clearlog' =>
        [
            'description'   => 'fixed time clear logs',
            'schedule'      => '30 3 * * ',
            'status'        => 1,
        ],
];
