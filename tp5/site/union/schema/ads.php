<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:02:03
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
    'gid' => 
    array (
      'type' => 'int(11)',
      'comment' => '广告分组ID',
    ),
    'uid' => 
    array (
      'type' => 'int(11)',
      'comment' => '用户ID',
    ),
    'ads_title' => 
    array (
      'type' => 'int(11)',
      'comment' => '广告标题',
    ),
    'create_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '创建时间',
    ),
    'update_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '更新时间',
    ),
    'sort' => 
    array (
      'type' => 'int(11)',
      'comment' => '排序',
    ),
    'status' => 
    array (
      'type' => 'int(11)',
      'comment' => '状态',
    ),
    'opid' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '操作者',
    ),
    'langid' => 
    array (
      'type' => 'text',
      'comment' => '语言',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '联盟广告列表',
);
