<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 下载表  Version 1.0  2016/3/14
// +----------------------------------------------------------------------
return array(
    'columns'=>array(
        'id'=>array(
            'type'  => 'int',
            'auto_inc' => true,
            'comment' => '主键',
        ),
        'name'=>array(
            'type'  => 'varchar',
            'length' => 40,
            'comment' => '模块名称',
        ),
        'version'=>array(
            'type'  => 'varchar',
            'length' => 40,
            'comment' => '模块版本',
        ),
        'config'=>array(
            'type'  => 'text',
            'length' => 40,
            'comment' => '序列化的配置参数',
        ),
        'status'=>array(
            'type'  => 'bool',
            'comment' => '状态',
        ),
        'sort'=>array(
            'type'  => 'int',
            'length' => 3,
            'comment' => '排序',
        ),
        'create_time'=>array(
            'type'  => 'int',
            'default' => 0,
            'comment' => '创建时间',
        ),
        'update_time'=>array(
            'type'  => 'int',
            'default' => 0,
            'comment' => '更新时间',
        ),
        'status_time'=>array(
            'type'  => 'int',
            'default' => 0,
            'comment' => '更新时间',
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
        'allow_uninstall'=>array(
            'type'  => 'bool',
            'default' => 0,
            'comment' => '排序',
        ),
        'is_del'=>array(
            'type'  => 'int',
            'default' => 0,
            'comment' => '是否已删除',
        ),
    ),
    'primary' => 'id',
    'index' =>  array(
        'ind_name' => ['columns' => ['name']],
    ),
    'comment' => '下载系统',
);