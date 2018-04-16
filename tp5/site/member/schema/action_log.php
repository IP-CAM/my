<?php
// +----------------------------------------------------------------------
// | RuntuerCMF
// +----------------------------------------------------------------------
// | Copyright (c) 2016/3/8 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author theseaer <theseaer@qq.com>.
// +----------------------------------------------------------------------
// | Description : 用户行为日志
// +----------------------------------------------------------------------

return array(
    'columns'=>array(
        'id'=>array(
            'type'      => 'int',
            'auto_inc'  => true,
            'comment'   => '主键',
        ),
		'action_id'=>array(
            'type'      => 'int',
            'default'   => 0,
            'comment'   => '行为ID',
        ),
		'uid'=>array(
            'type'      => 'int',
            'default'   => 0,
            'comment'   => '用户ID',
        ),
        'action_ip'=>array(
            'type'  => 'bigint',
            'length' => 20,
            'comment' => '执行行为者IP',
        ),
        'type'=>array(
            'type'  => array(
                0   => 'Systemlog',
                1   => 'Userlog',
                2   => 'Apilog',
            ),
            'comment' => '日志类型',
        ),
		'model'=>array(
            'type'  => 'varchar',
            'length' => 50,
            'comment' => '触发行为的表',
        ),
		'record_id'=>array(
            'type'  => 'int',
            'default' => 0,
            'comment' => '触发行为的数据id',
        ),
		'remark'=>array(
            'type'  => 'varchar',
            'default' => 'NULL',
            'comment' => '日志备注',
        ),
		'status'=>array(
            'type'  => array(
                0   => 'succ',
                1   => 'faild',
            ),
            'default' => 1,
            'comment' => '状态',
        ),
        'create_time'=>array(
            'type'  => 'int',
            'default' => 0,
            'comment' => '执行行为的时间',
        ),
    ),
    'primary' => 'id',
    'comment' => '用户行为日志表',
);