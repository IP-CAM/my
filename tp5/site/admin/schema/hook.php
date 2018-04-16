<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:35
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(11) unsigned',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '自增ID',
    ),
    'clan' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '类名',
    ),
    'np' => 
    array (
      'type' => 'varchar(200)',
      'comment' => '名字空间',
    ),
    'func' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '函数名称',
    ),
    'update_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '加入时间',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '钩子',
);
