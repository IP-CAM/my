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
      'comment' => '用户ID',
    ),
    'levelid' => 
    array (
      'type' => 'int(11)',
      'default' => '1',
    ),
    'nickname' => 
    array (
      'type' => 'char(20)',
    ),
    'username' => 
    array (
      'type' => 'char(16)',
      'comment' => '用户名',
    ),
    'password' => 
    array (
      'type' => 'char(32)',
      'comment' => '密码',
    ),
    'email' => 
    array (
      'type' => 'char(32)',
      'comment' => '用户邮箱',
    ),
    'mobile' => 
    array (
      'type' => 'char(11)',
      'comment' => '用户手机',
    ),
    'score' => 
    array (
      'type' => 'decimal(20,0)',
      'comment' => '用户积分',
    ),
    'headimg' => 
    array (
      'type' => 'varchar(255)',
    ),
    'sex' => 
    array (
      'type' => 'tinyint(1) unsigned',
    ),
    'login' => 
    array (
      'type' => 'int(11)',
      'comment' => '登陆次数',
    ),
    'verify' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '验证',
    ),
    'reg_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '注册时间',
    ),
    'reg_ip' => 
    array (
      'type' => 'bigint(20)',
      'comment' => '注册IP',
    ),
    'update_time' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '更新时间',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'key' => 'MUL',
      'default' => '1',
      'comment' => '用户状态',
    ),
    'langid' => 
    array (
      'type' => 'varchar(20)',
    ),
    'tag_id' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '用户标签id 关联用户标签表',
    ),
    'idcard' => 
    array (
      'type' => 'char(10)',
      'key' => 'MUL',
      'comment' => '唯一身份标识',
    ),
    'pidcard' => 
    array (
      'type' => 'char(10)',
      'comment' => '父级身份标识',
    ),
    'agent_id' => 
    array (
      'type' => 'int(10) unsigned',
      'comment' => '代理商级别，默认0不是代理商',
    ),
    'money' => 
    array (
      'type' => 'decimal(10,2) unsigned',
      'default' => '0.00',
      'comment' => '用户存款',
    ),
    'pay_pwd' => 
    array (
      'type' => 'char(32)',
      'comment' => '支付密码',
    ),
    'source' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '内部来源',
    ),
    'outsrc' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '外部来源',
    ),
    'last_login_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '最后一次登录时间',
    ),
    'last_login_ip' => 
    array (
      'type' => 'varchar(32)',
      'comment' => '最后登录IP',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'index' => 
  array (
    'status' => 
    array (
      0 => 'status',
    ),
    'idcard' => 
    array (
      0 => 'idcard',
    ),
  ),
  'comment' => '用户表',
);
