<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:54
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(10) unsigned',
      'key' => 'PRI',
      'extra' => 'auto_increment',
    ),
    'name' => 
    array (
      'type' => 'varchar(20)',
    ),
    'description' => 
    array (
      'type' => 'text',
      'comment' => '标签描述',
    ),
    'sort' => 
    array (
      'type' => 'tinyint(4) unsigned',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'comment' => '1启用 0禁用',
    ),
    'create_time' => 
    array (
      'type' => 'int(10) unsigned',
    ),
    'update_time' => 
    array (
      'type' => 'int(10) unsigned',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '',
);
