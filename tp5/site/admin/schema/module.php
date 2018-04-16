<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:36
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(11)',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => 'ID',
    ),
    'name' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '模块英文名称',
    ),
    'version' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '版本',
    ),
    'config' => 
    array (
      'type' => 'text',
      'comment' => '序列化的配置参数',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '状态',
    ),
    'sort' => 
    array (
      'type' => 'tinyint(3)',
      'comment' => '排序',
    ),
    'create_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '添加时间',
    ),
    'update_time' => 
    array (
      'type' => 'int(11)',
    ),
    'status_time' => 
    array (
      'type' => 'int(11)',
    ),
    'allow_uninstall' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '是否允许卸载：1允许，0不允许',
    ),
    'is_del' => 
    array (
      'type' => 'int(11)',
      'comment' => '是否已删除：有值 时已删除，空未删除',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '应用&模块表',
);
