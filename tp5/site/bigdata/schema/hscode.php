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
    'code' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '商品海关代码',
    ),
    'title' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '商品名称',
    ),
    'unit' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '包装单位',
    ),
    'hsrecord' => 
    array (
      'type' => 'varchar(120)',
      'comment' => '海关备案号',
    ),
    'hsmodel' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '海关型号',
    ),
    'hsnationalrecord' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '国检备案号',
    ),
    'hsquarantinemodel' => 
    array (
      'type' => 'varchar(200)',
      'comment' => '检疫型号',
    ),
    'country' => 
    array (
      'type' => 'varchar(50)',
      'comment' => '所属国家',
    ),
    'status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '状态',
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
    'visit_time' => 
    array (
      'type' => 'int(11)',
      'comment' => '最后一次访问时间',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '商品海关编码信息',
);
