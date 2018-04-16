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
      'type' => 'int(11)',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '附件DI',
    ),
    'name' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '图片名称',
    ),
    'path' => 
    array (
      'type' => 'text',
      'comment' => '附件路径',
    ),
    'size' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '大小',
    ),
    'type' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '附件类型',
    ),
    'module' => 
    array (
      'type' => 'varchar(30)',
      'comment' => '所属模块',
    ),
    'create_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '上传时间',
    ),
    'usetime' => 
    array (
      'type' => 'int(11)',
      'comment' => '使用次数',
    ),
    'uid' => 
    array (
      'type' => 'int(11)',
      'comment' => '用户ID',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '可用状态',
    ),
    'langid' => 
    array (
      'type' => 'text',
      'comment' => '语言系',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '附件表',
);
