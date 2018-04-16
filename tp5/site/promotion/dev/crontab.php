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
    'Couponsdel' =>
        [
            'description'   => 'Coupons expire del',
            'schedule'      => '* 1-7/1 * * *',
            'status'        => 1,
        ],
    'Activedel' =>
        [
            'description'   => 'Active expire del',
            'schedule'      => '59 0 * * *',
            'status'        => 1,
        ],
    'Activenotic' =>
        [
            'description'   => 'Active notice',
            'schedule'      => '10 * * * *',
            'status'        => 1,
        ],
];
