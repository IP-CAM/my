<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:37
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(11)',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '自动 ID',
    ),
    'name' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '姓名',
    ),
    'cardno' => 
    array (
      'type' => 'varchar(25)',
      'comment' => '身份证号',
    ),
    'addr' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '身份证地址',
    ),
    'newaddr' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '迁址后的身份证地址',
    ),
    'sex' => 
    array (
      'type' => 'enum(\'男\',\'女\')',
      'default' => '男',
      'comment' => '性别',
    ),
    'mobile' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '最后手机号',
    ),
    'positive' => 
    array (
      'type' => 'text',
      'comment' => '身份证正面',
    ),
    'opposite' => 
    array (
      'type' => 'text',
      'comment' => '身份证反面',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '状态 ',
    ),
    'create_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '录入时间',
    ),
    'update_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '更新时间',
    ),
    'last_use_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '最后一次使用时间',
    ),
    'langid' => 
    array (
      'type' => 'text',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '身份信息',
);
