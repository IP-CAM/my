<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:34
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(10) unsigned',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '配置ID',
    ),
    'name' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '配置名称',
    ),
    'type' => 
    array (
      'type' => 'tinyint(3) unsigned',
      'comment' => '配置类型',
    ),
    'title' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '配置说明',
    ),
    'group' => 
    array (
      'type' => 'tinyint(3) unsigned',
      'comment' => '配置分组',
    ),
    'extra' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '配置值',
    ),
    'remark' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '配置说明',
    ),
    'create_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '创建时间',
    ),
    'update_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '更新时间',
    ),
    'status' => 
    array (
      'type' => 'tinyint(4)',
      'comment' => '状态',
    ),
    'value' => 
    array (
      'type' => 'text',
      'comment' => '配置值',
    ),
    'sort' => 
    array (
      'type' => 'smallint(3) unsigned',
      'comment' => '排序',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'index' => 
  array (
    'id' => 
    array (
      0 => 'id',
    ),
  ),
  'comment' => '系统配置表',
);
