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
      'type' => 'mediumint(11) unsigned',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '自增ID',
    ),
    'tag' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '级别标识',
    ),
    'name' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '级别名称',
    ),
    'alias' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '会员组变量名',
    ),
    'quota' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '消费额度',
    ),
    'discount' => 
    array (
      'type' => 'tinyint(3)',
      'comment' => '折扣',
    ),
    'maxempirical' => 
    array (
      'type' => 'bigint(20)',
      'comment' => '最大经验值',
    ),
    'maxpoint' => 
    array (
      'type' => 'bigint(20)',
      'comment' => '最大积分',
    ),
    'minempirical' => 
    array (
      'type' => 'bigint(20)',
      'comment' => '最小经验值',
    ),
    'minpoint' => 
    array (
      'type' => 'bigint(20)',
      'comment' => '最小积分',
    ),
    'langid' => 
    array (
      'type' => 'text',
      'comment' => '适用语言',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '状态0禁用，1启用',
    ),
    'mark' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '会员 组描述',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '会员等级',
);
