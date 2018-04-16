<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:49
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
    'tag' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '级别标识',
    ),
    'title' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '代理名称',
    ),
    'alias' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '代理商级别别名',
    ),
    'description' => 
    array (
      'type' => 'text',
      'comment' => '代理商级别介绍',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'comment' => '状态',
    ),
    'discount' => 
    array (
      'type' => 'tinyint(3) unsigned',
      'comment' => '代理商级别享受的折扣',
    ),
    'quota' => 
    array (
      'type' => 'int(11)',
      'comment' => '消费额度',
    ),
    'rebate' => 
    array (
      'type' => 'decimal(5,2)',
      'default' => '0.00',
      'comment' => '返佣比例',
    ),
    'create_time' => 
    array (
      'type' => 'tinyint(10)',
    ),
    'langid' => 
    array (
      'type' => 'varchar(20)',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '代理商',
);
