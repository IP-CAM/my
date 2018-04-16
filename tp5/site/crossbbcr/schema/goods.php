<?php
// +----------------------------------------------------------------------
// | RuntuerCMF
// +----------------------------------------------------------------------
// | Copyright (c) 2016/3/8 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author theseaer <theseaer@qq.com>.
// +----------------------------------------------------------------------
// | Description : 配置表
// +----------------------------------------------------------------------

return array(
    'columns'=>array(
        'id'=>array(
            'type'      => 'int',
            'auto_inc'  => true,
            'comment'   => '配置ID',
        ),
		'name'=>array(
            'type'      => 'varchar',
            'length'    => 50,
            'comment'   => '配置名称',
        ),
		'type'=>array(
            'type'      => array(
                    1   => 'int',
                    2   => 'str',
                    3   => 'txt',
                    4   => 'arr',
                    5   => 'enu',   //枚举
            ),
            'default'   => 1,
            'comment'   => '配置类型',
        ),
		'title'=>array(
            'type'      => 'varchar',
            'length'    => 50,
            'comment'   => '配置说明',
        ),
        'group'=>array(
            'type'      => array(
                    0   => 'ng',
                    1   => 'base',
                    2   => 'content',
                    3   => 'user',
                    4   => 'system',
                
            ),
            'comment'   => '配置分组',
        ),
        'extra'=>array(
            'type'      => 'text',
            'comment'   => '配置值',
        ),
        'value'=>array(
            'type'      => 'text',
            'comment'   => '配置值',
        ),
        'remark'=>array(
            'type'      => 'text',
            'comment'   => '配置说明',
        ),
        'sort'=>array(
            'type'      => 'int',
            'length'    => 30,
            'comment'   => '排序',
        ),
        'status'=>array(
            'type'      => 'bool',
            'default'   => 0,
            'comment'   => '状态 0：禁止上 1：启用',
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
        'status_time'=>array(
            'type'      => 'int',
            'default'   => 0,
            'comment'   => '更新时间',
        ),
        'platform'=>array(
            'type'  => array(
                0   => 'all',
                1   => 'pc',
                2   => 'wap',
                3   => 'app',
                4   => 'wechat',
            ),
            'default' => 0,
            'comment' => '适用平台',
        ),
        'lang'=>array(
            'type'      => 'varchar',
            'comment'   => '语种',
        ),
    ),
    'primary' => 'id',
    'index' =>  array(
        //'ind_code' => ['columns' => ['code']],
    ),
    'comment' => '商品表',
);