<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:56
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
    'name' => 
    array (
      'type' => 'varchar(60)',
      'comment' => '开发者名称',
    ),
    'devauthid' => 
    array (
      'type' => 'int(11)',
      'comment' => '权限分组',
    ),
    'company' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '开发者所属公司',
    ),
    'domain' => 
    array (
      'type' => 'text',
      'comment' => '适合域名',
    ),
    'dkey' => 
    array (
      'type' => 'varchar(100)',
      'comment' => '开发者KEY',
    ),
    'secret:' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '开发者Secret',
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
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '状态',
    ),
    'sort' => 
    array (
      'type' => 'int(11)',
      'comment' => '排序',
    ),
    'remark' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '备注',
    ),
    'langid' => 
    array (
      'type' => 'text',
      'comment' => '语系',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '开发者',
);
