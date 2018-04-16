<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:53
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
    'rang' => 
    array (
      'type' => 'tinyint(4) unsigned',
      'default' => '72',
      'comment' => '有效期',
    ),
    'forinv' => 
    array (
      'type' => 'text',
      'comment' => '被邀请者手机或邮箱',
    ),
    'welcome' => 
    array (
      'type' => 'varchar(200)',
      'comment' => '邀请语',
    ),
    'create_time' => 
    array (
      'type' => 'int(10) unsigned',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'default' => '1',
    ),
    'langid' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '语言',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '',
);
