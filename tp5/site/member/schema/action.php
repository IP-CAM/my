<?php
// +----------------------------------------------------------------------
// | RuntuerCMF
// +----------------------------------------------------------------------
// | Copyright (c) 2016/3/8 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author theseaer <theseaer@qq.com>.
// +----------------------------------------------------------------------
// | Description : 用户行为描述文件
// +----------------------------------------------------------------------

return  array(
    'columns'=>array(
        'id'=>array(
            'type'      => 'int',
            'auto_inc'  => true,
            'comment'   => 'ID',
            'label'     => 'ID',
        ),
        'name'=>array(
            'type'      => 'string',
            'length'    => '40',
            'comment'   => '行为唯一标识',
        ),
        'title'=>array(
            'type'      => 'string',
            'length'    => '80',
            'comment'   => '行为说明',
        ),
		'remark'=>array(
            'type'      => 'string',
            'length'    => '140',
            'comment'   => '行为描述',
        ),
		'rule'=>array(
            'type'      => 'text',
            'comment'   => '行为规则',
        ),
		'log'=>array(
            'type'      => 'text',
            'comment'   => '日志规则',
        ),
		'type'=>array(
            'type'      => array(
                    0   => 'Controller',
                    1   => 'View',
            ),
            'default'   => 1,
            'comment'   => '类型 0：控制器 1：视图',
        ),
		'status'=>array(
            'type'      => 'bool',
            'default'   => 0,
            'comment'   => '类型 0：禁止上 1：启用',
        ),
        'create_time'=>array(
            'type'      => 'int',
            'default'   => 0,
            'comment'   => '创建时间',
        ),
		'update_time'=>array(
            'type'      => 'int',
            'default'   => 0,
            'comment'   => '更新时间',
        ),
        'is_del'=>array(
            'type'  => 'int',
            'default' => 0,
            'comment' => '是否已删除',
        ),
    ),
    'primary' => '
    id',
    'comment' => '用户行为表',
);